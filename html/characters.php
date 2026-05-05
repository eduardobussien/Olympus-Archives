<?php
// characters.php by Eduardo Bussien
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Browse all characters of Greek mythology - gods, titans, heroes, and monsters in the Olympus Archives." />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/x-icon" href="../img/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
    <link rel="manifest" href="../img/favicon/site.webmanifest">

    <title>Olympus Archives | Characters</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/characters.css" />
  </head>

  <body class="character-bg">
    <?php include 'nav.php'; ?>

    <main class="characters-page">
      <section class="page-titlech">
        <h2>Characters of Olympus</h2>
        <p>Browse gods, titans, heroes, and monsters from Greek mythology.</p>
      </section>

      <?php
        require '../sql/db.php';

        function render_character_section(mysqli $conn, string $title, array $types): void {
            if (empty($types)) {
                return;
            }
            $placeholders = implode(',', array_fill(0, count($types), '?'));
            $sql = "
                SELECT slug, name, type, domain, symbol, short_description
                FROM characters
                WHERE type IN ($placeholders)
                ORDER BY name
            ";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                return;
            }
            $stmt->bind_param(str_repeat('s', count($types)), ...$types);
            $stmt->execute();
            $result = $stmt->get_result();

            if (!$result || $result->num_rows === 0) {
                $stmt->close();
                return;
            }
            ?>
            <section class="characters-section">
              <h3 class="characters-heading">
                <?= htmlspecialchars($title); ?>
              </h3>

              <div class="characters-grid">
                <?php while ($row = $result->fetch_assoc()): ?>
                  <?php
                    $slug      = $row['slug'];
                    $imagePath = "../img/gods/" . $slug . ".png";
                    $profileUrl = "character.php?slug=" . urlencode($slug);
                  ?>
                  <a href="<?= htmlspecialchars($profileUrl); ?>" class="character-card">
                    <div class="character-card-img">
                      <img
                        src="<?= htmlspecialchars($imagePath); ?>"
                        alt="<?= htmlspecialchars($row['name']); ?>"
                        loading="lazy"
                      />
                    </div>

                    <div class="character-card-body">
                      <span class="char-type-label"><?= htmlspecialchars($row['type']); ?></span>
                      <h4 class="character-name"><?= htmlspecialchars($row['name']); ?></h4>

                      <?php if (!empty($row['domain'])): ?>
                        <p class="char-meta"><span>Domain</span><?= htmlspecialchars($row['domain']); ?></p>
                      <?php endif; ?>

                      <?php if (!empty($row['symbol'])): ?>
                        <p class="char-meta"><span>Symbol</span><?= htmlspecialchars($row['symbol']); ?></p>
                      <?php endif; ?>

                      <?php if (!empty($row['short_description'])): ?>
                        <p class="char-desc">
                          <?= htmlspecialchars($row['short_description']); ?>
                        </p>
                      <?php endif; ?>

                      <span class="char-profile-link">View Profile →</span>
                    </div>
                  </a>
                <?php endwhile; ?>
              </div>
            </section>
            <?php
            $stmt->close();
        }

        render_character_section(
          $conn,
          'Gods & Olympians',
          ['Olympian God', 'Olympian Goddess', 'Underworld Goddess']
        );

        render_character_section(
          $conn,
          'Titans & Titanesses',
          ['Titan', 'Titaness']
        );

        render_character_section(
          $conn,
          'Heroes',
          ['Hero']
        );

        render_character_section(
          $conn,
          'Monsters',
          ['Monster']
        );

        $conn->close();
      ?>

      <p class="soon">More characters coming soon...</p>
    </main>

    <?php include 'footer.php'; ?>

    <script src="../js/scripts.js"></script>
  </body>
</html>
