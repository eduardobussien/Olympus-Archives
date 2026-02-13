<?php
// search.php by Eduardo Bussien
session_start();
require_once __DIR__ . '/../sql/db.php';

$q = trim($_GET['q'] ?? '');
$characters = [];
$myths = [];

if ($q !== '') {
    $like = '%' . $q . '%';

    // --- Search characters ---
    $sqlChars = "
        SELECT slug, name, type, domain, short_description
        FROM characters
        WHERE 
            name LIKE ?
            OR type LIKE ?
            OR domain LIKE ?
            OR short_description LIKE ?
        ORDER BY name
    ";
    if ($stmt = $conn->prepare($sqlChars)) {
        $stmt->bind_param('ssss', $like, $like, $like, $like);
        $stmt->execute();
        $characters = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }

    // --- Search myths ---
    $sqlMyths = "
        SELECT slug, title, category, short_description, main_characters
        FROM myths
        WHERE
            title LIKE ?
            OR category LIKE ?
            OR short_description LIKE ?
            OR main_characters LIKE ?
        ORDER BY title
    ";
    if ($stmt = $conn->prepare($sqlMyths)) {
        $stmt->bind_param('ssss', $like, $like, $like, $like);
        $stmt->execute();
        $myths = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }
}

$conn->close();
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
      <section class="search-header">
        <h2 class="fade-delay">Search the Archives</h2>

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
            Showing results for: <strong><?= htmlspecialchars($q); ?></strong>
          </p>
        <?php else: ?>
          <p class="search-summary">
            Type a name, title, or keyword to search characters and myths.
          </p>
        <?php endif; ?>
      </section>

      <?php if ($q !== ''): ?>
        <section class="search-results">
          <!-- Characters block -->
          <section class="search-block">
            <h3>Characters</h3>
            <?php if (!empty($characters)): ?>
              <ul class="search-list">
                <?php foreach ($characters as $char): ?>
                  <li class="search-item">
                    <a href="character.php?slug=<?= urlencode($char['slug']); ?>">
                      <div class="search-item-main">
                        <h4><?= htmlspecialchars($char['name']); ?></h4>
                        <p class="search-item-meta">
                          <?= htmlspecialchars($char['type']); ?>
                          <?php if (!empty($char['domain'])): ?>
                            · <?= htmlspecialchars($char['domain']); ?>
                          <?php endif; ?>
                        </p>
                        <?php if (!empty($char['short_description'])): ?>
                          <p class="search-item-desc">
                            <?= htmlspecialchars(mb_substr($char['short_description'], 0, 160)); ?>
                            <?php if (mb_strlen($char['short_description']) > 160) echo '…'; ?>
                          </p>
                        <?php endif; ?>
                      </div>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <p class="search-empty">No characters matched this search.</p>
            <?php endif; ?>
          </section>

          <!-- Myths block -->
          <section class="search-block">
            <h3>Myths</h3>
            <?php if (!empty($myths)): ?>
              <ul class="search-list">
                <?php foreach ($myths as $myth): ?>
                  <li class="search-item">
                    <a href="myth.php?slug=<?= urlencode($myth['slug']); ?>">
                      <div class="search-item-main">
                        <h4><?= htmlspecialchars($myth['title']); ?></h4>
                        <p class="search-item-meta">
                          <?= htmlspecialchars($myth['category']); ?>
                          <?php if (!empty($myth['main_characters'])): ?>
                            · <?= htmlspecialchars($myth['main_characters']); ?>
                          <?php endif; ?>
                        </p>
                        <?php if (!empty($myth['short_description'])): ?>
                          <p class="search-item-desc">
                            <?= htmlspecialchars(mb_substr($myth['short_description'], 0, 160)); ?>
                            <?php if (mb_strlen($myth['short_description']) > 160) echo '…'; ?>
                          </p>
                        <?php endif; ?>
                      </div>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <p class="search-empty">No myths matched this search.</p>
            <?php endif; ?>
          </section>

          <?php if (empty($characters) && empty($myths)): ?>
            <p class="search-empty global">No results found in the archives.</p>
          <?php endif; ?>
        </section>
      <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>
  </body>
</html>
