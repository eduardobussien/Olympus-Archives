<?php
// search.php by Eduardo Bussien
session_start();
require_once __DIR__ . '/../sql/db.php';

$q = trim($_GET['q'] ?? '');
$characters = [];
$myths = [];

if ($q !== '') {
    $like   = '%' . $q . '%';
    $starts = $q . '%';
    $exact  = $q;

    /* ---------- CHARACTERS ----------
       Smart-rank ordering:
         1 = exact name match     (e.g. "zeus" -> Zeus)
         2 = name starts with     ("athe" -> Athena)
         3 = name contains        ("us"   -> Cronus, Dionysus, ...)
         4 = type / domain / short description match
         5 = full_bio mentions    ("apollo" -> Artemis, Hermes, etc., because they appear in those bios)
       Same rank then ordered alphabetically.
       full_bio is checked with SHOW COLUMNS so older databases still work.
    */

    // Detect optional full_bio column (added by upgrade_bios.php)
    $hasBio = false;
    if ($res = $conn->query("SHOW COLUMNS FROM characters LIKE 'full_bio'")) {
        $hasBio = $res->num_rows > 0;
        $res->free();
    }

    if ($hasBio) {
        $sqlChars = "
            SELECT slug, name, type, domain, short_description,
              CASE
                WHEN LOWER(name) = LOWER(?)        THEN 1
                WHEN LOWER(name) LIKE LOWER(?)     THEN 2
                WHEN LOWER(name) LIKE LOWER(?)     THEN 3
                WHEN LOWER(type) LIKE LOWER(?)
                  OR LOWER(domain) LIKE LOWER(?)
                  OR LOWER(short_description) LIKE LOWER(?) THEN 4
                WHEN LOWER(full_bio) LIKE LOWER(?) THEN 5
                ELSE 6
              END AS rank
            FROM characters
            WHERE
                name LIKE ?
                OR type LIKE ?
                OR domain LIKE ?
                OR short_description LIKE ?
                OR full_bio LIKE ?
            ORDER BY rank ASC, name ASC
        ";
        if ($stmt = $conn->prepare($sqlChars)) {
            $stmt->bind_param(
                'ssssssssssss',                    // 12 placeholders
                $exact, $starts, $like,            // CASE 1,2,3 (3)
                $like, $like, $like,               // CASE 4 (3) — type, domain, short_description
                $like,                             // CASE 5 (1) — full_bio
                $like, $like, $like, $like, $like  // WHERE (5) — name, type, domain, short_desc, full_bio
            );
            $stmt->execute();
            $characters = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        }
    } else {
        // Fallback for pre-upgrade DB
        $sqlChars = "
            SELECT slug, name, type, domain, short_description,
              CASE
                WHEN LOWER(name) = LOWER(?)    THEN 1
                WHEN LOWER(name) LIKE LOWER(?) THEN 2
                WHEN LOWER(name) LIKE LOWER(?) THEN 3
                ELSE 4
              END AS rank
            FROM characters
            WHERE name LIKE ?
              OR type LIKE ?
              OR domain LIKE ?
              OR short_description LIKE ?
            ORDER BY rank ASC, name ASC
        ";
        if ($stmt = $conn->prepare($sqlChars)) {
            $stmt->bind_param('sssssss', $exact, $starts, $like, $like, $like, $like, $like);
            $stmt->execute();
            $characters = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        }
    }

    /* ---------- MYTHS ---------- */
    $hasFullText = false;
    if ($res = $conn->query("SHOW COLUMNS FROM myths LIKE 'full_text'")) {
        $hasFullText = $res->num_rows > 0;
        $res->free();
    }

    if ($hasFullText) {
        $sqlMyths = "
            SELECT slug, title, category, short_description, main_characters,
              CASE
                WHEN LOWER(title) = LOWER(?)            THEN 1
                WHEN LOWER(title) LIKE LOWER(?)         THEN 2
                WHEN LOWER(title) LIKE LOWER(?)         THEN 3
                WHEN LOWER(category) LIKE LOWER(?)
                  OR LOWER(main_characters) LIKE LOWER(?)
                  OR LOWER(short_description) LIKE LOWER(?) THEN 4
                WHEN LOWER(full_text) LIKE LOWER(?)     THEN 5
                ELSE 6
              END AS rank
            FROM myths
            WHERE
                title LIKE ?
                OR category LIKE ?
                OR short_description LIKE ?
                OR main_characters LIKE ?
                OR full_text LIKE ?
            ORDER BY rank ASC, title ASC
        ";
        if ($stmt = $conn->prepare($sqlMyths)) {
            $stmt->bind_param(
                'ssssssssssss',                    // 12 placeholders
                $exact, $starts, $like,            // CASE 1,2,3 (3)
                $like, $like, $like,               // CASE 4 (3) — category, main_characters, short_description
                $like,                             // CASE 5 (1) — full_text
                $like, $like, $like, $like, $like  // WHERE (5) — title, category, short_desc, main_chars, full_text
            );
            $stmt->execute();
            $myths = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        }
    } else {
        $sqlMyths = "
            SELECT slug, title, category, short_description, main_characters,
              CASE
                WHEN LOWER(title) = LOWER(?)    THEN 1
                WHEN LOWER(title) LIKE LOWER(?) THEN 2
                WHEN LOWER(title) LIKE LOWER(?) THEN 3
                ELSE 4
              END AS rank
            FROM myths
            WHERE title LIKE ?
              OR category LIKE ?
              OR short_description LIKE ?
              OR main_characters LIKE ?
            ORDER BY rank ASC, title ASC
        ";
        if ($stmt = $conn->prepare($sqlMyths)) {
            $stmt->bind_param('sssssss', $exact, $starts, $like, $like, $like, $like, $like);
            $stmt->execute();
            $myths = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        }
    }
}

$conn->close();

$totalResults = count($characters) + count($myths);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/x-icon" href="../img/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
    <link rel="manifest" href="../img/favicon/site.webmanifest">

    <title>Olympus Archives | Search Results</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/search.css" />
  </head>

  <body class="search-bg">
    <?php include 'nav.php'; ?>

    <main class="search-page">
      <header class="search-header">
        <span class="search-eyebrow">The Archive Index</span>
        <h1>Search the Archives</h1>

        <form action="search.php" method="get" class="search-bar search-page-bar">
          <input
            type="text"
            name="q"
            value="<?= htmlspecialchars($q); ?>"
            placeholder="Search gods, myths, heroes..."
            required
          />
          <button type="submit">Search</button>
        </form>

        <?php if ($q !== ''): ?>
          <p class="search-summary">
            <?= $totalResults; ?> result<?= $totalResults === 1 ? '' : 's' ?>
            for <strong><?= htmlspecialchars($q); ?></strong>
          </p>
        <?php else: ?>
          <p class="search-summary">
            Type a name, title, or keyword to search characters and myths.
          </p>
        <?php endif; ?>
      </header>

      <?php if ($q !== ''): ?>
        <section class="search-results">
          <!-- Characters block -->
          <?php if (!empty($characters)): ?>
            <section class="search-block">
              <h3><span class="search-block-count"><?= count($characters); ?></span> Characters</h3>
              <ul class="search-list">
                <?php foreach ($characters as $i => $char): ?>
                  <li class="search-item<?= $i === 0 ? ' top-match' : ''; ?>">
                    <a href="character.php?slug=<?= urlencode($char['slug']); ?>">
                      <div class="search-item-thumb">
                        <img
                          src="../img/gods/<?= htmlspecialchars($char['slug']); ?>.png"
                          alt="<?= htmlspecialchars($char['name']); ?>"
                          loading="lazy"
                          onerror="this.style.display='none'"
                        />
                      </div>
                      <div class="search-item-main">
                        <?php if ($i === 0): ?>
                          <span class="search-item-flag">Top Match</span>
                        <?php endif; ?>
                        <h4><?= htmlspecialchars($char['name']); ?></h4>
                        <p class="search-item-meta">
                          <?= htmlspecialchars($char['type']); ?>
                          <?php if (!empty($char['domain'])): ?>
                            <span class="dot">·</span> <?= htmlspecialchars($char['domain']); ?>
                          <?php endif; ?>
                        </p>
                        <?php if (!empty($char['short_description'])): ?>
                          <p class="search-item-desc">
                            <?= htmlspecialchars(mb_substr($char['short_description'], 0, 180)); ?>
                            <?php if (mb_strlen($char['short_description']) > 180) echo '…'; ?>
                          </p>
                        <?php endif; ?>
                      </div>
                      <span class="search-item-arrow" aria-hidden="true">→</span>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </section>
          <?php endif; ?>

          <!-- Myths block -->
          <?php if (!empty($myths)): ?>
            <section class="search-block">
              <h3><span class="search-block-count"><?= count($myths); ?></span> Myths</h3>
              <ul class="search-list">
                <?php foreach ($myths as $i => $myth): ?>
                  <li class="search-item<?= ($i === 0 && empty($characters)) ? ' top-match' : ''; ?>">
                    <a href="myth.php?slug=<?= urlencode($myth['slug']); ?>">
                      <div class="search-item-thumb">
                        <img
                          src="../img/myths/<?= htmlspecialchars($myth['slug']); ?>.png"
                          alt="<?= htmlspecialchars($myth['title']); ?>"
                          loading="lazy"
                          onerror="this.style.display='none'"
                        />
                      </div>
                      <div class="search-item-main">
                        <?php if ($i === 0 && empty($characters)): ?>
                          <span class="search-item-flag">Top Match</span>
                        <?php endif; ?>
                        <h4><?= htmlspecialchars($myth['title']); ?></h4>
                        <p class="search-item-meta">
                          <?= htmlspecialchars($myth['category']); ?>
                          <?php if (!empty($myth['main_characters'])): ?>
                            <span class="dot">·</span> <?= htmlspecialchars($myth['main_characters']); ?>
                          <?php endif; ?>
                        </p>
                        <?php if (!empty($myth['short_description'])): ?>
                          <p class="search-item-desc">
                            <?= htmlspecialchars(mb_substr($myth['short_description'], 0, 180)); ?>
                            <?php if (mb_strlen($myth['short_description']) > 180) echo '…'; ?>
                          </p>
                        <?php endif; ?>
                      </div>
                      <span class="search-item-arrow" aria-hidden="true">→</span>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </section>
          <?php endif; ?>

          <?php if (empty($characters) && empty($myths)): ?>
            <p class="search-empty global">
              No results found in the archives. Try a different name or keyword.
            </p>
          <?php endif; ?>
        </section>
      <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>
  </body>
</html>
