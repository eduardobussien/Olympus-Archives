 <?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="../img/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
    <link rel="manifest" href="../img/favicon/site.webmanifest">

    <title>Olympus Archives | Characters </title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/characters.css" />
  </head>

  <body class="character-bg">
    <?php include 'nav.php'; ?> 

      <main class="characters-page">
      <section class="page-titlech">
        <h2 class="fade-up">Characters of Olympus</h2>
        <p class="fade-up fade-delay-1">Browse gods, titans, heroes, and monsters from Greek mythology.</p>
      </section>
      <?php
        require '../sql/db.php';

        function render_character_section(mysqli $conn, string $title, string $whereClause) {
            $sql = "
                SELECT slug, name, type, domain, symbol, short_description
                FROM characters
                WHERE $whereClause
                ORDER BY name
            ";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0): ?>
                <section class="characters-section">
                  <h3 class="characters-heading fade-up fade-delay-1"><?php echo htmlspecialchars($title); ?></h3>
                  <div class="characters-grid fade-up fade-delay-2">
                    <?php while($row = $result->fetch_assoc()): ?>
                      <article class="character-card"
                        style="background-image: url('../img/gods/<?php echo $row['slug']; ?>.png');">

                        <h4 class="character-name"><?php echo htmlspecialchars($row['name']); ?></h4>
                        <p class="char-type"><?php echo htmlspecialchars($row['type']); ?></p>

                        <?php if (!empty($row['domain'])): ?>
                          <p class="char-meta"><span>Domain:</span> <?php echo htmlspecialchars($row['domain']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($row['symbol'])): ?>
                          <p class="char-meta"><span>Symbol:</span> <?php echo htmlspecialchars($row['symbol']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($row['short_description'])): ?>
                          <p class="char-desc">
                            <?php echo nl2br(htmlspecialchars($row['short_description'])); ?>
                          </p>
                        <?php endif; ?>

                        <a
                          class="btn small-btn char-profile-link"
                          href="character.php?slug=<?php echo urlencode($row['slug']); ?>"
                        >
                          View Profile
                        </a>
                      </article>
                    <?php endwhile; ?>
                  </div>
                </section>
            <?php
            endif;
        }
      ?>

      <?php
        render_character_section(
          $conn,
          'Gods & Olympians',
          "type IN ('Olympian God','Olympian Goddess','Underworld Goddess')"
        );
      
        render_character_section(
          $conn,
          'Titans & Titanesses',
          "type IN ('Titan','Titaness')"
        );

        render_character_section(
          $conn,
          'Heroes',
          "type = 'Hero'"
        );

        render_character_section(
          $conn,
          'Monsters',
          "type = 'Monster'"
        );

        $conn->close();
      ?>
    <p class="soon">More characters coming soon...</p>
    </main>
    <?php include 'footer.php'; ?>
    
    <script src="../js/scripts.js"></script>

  </body>
</html>