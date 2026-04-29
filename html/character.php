<?php
// character.php by Eduardo Bussien
session_start();
require '../sql/db.php';

$slug = $_GET['slug'] ?? '';

if ($slug === '') {
    http_response_code(400);
    echo "Character not specified.";
    exit;
}

$stmt = $conn->prepare("
    SELECT slug, name, type, domain, symbol, short_description, full_bio
    FROM characters
    WHERE slug = ?
    LIMIT 1
");
$stmt->bind_param('s', $slug);
$stmt->execute();
$character = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$character) {
    $conn->close();
    http_response_code(404);
    echo "Character not found.";
    exit;
}

// Pull up to 5 related characters of the same type (excluding current)
$related = [];
$stmt = $conn->prepare("
    SELECT slug, name
    FROM characters
    WHERE type = ? AND slug <> ?
    ORDER BY RAND()
    LIMIT 5
");
$stmt->bind_param('ss', $character['type'], $slug);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $related[] = $row;
}
$stmt->close();
$conn->close();

$imagePath = "../img/gods/" . $slug . ".png";

// Tagline = first sentence of short_description (fallback to whole thing)
$tagline = '';
if (!empty($character['short_description'])) {
    $sd = trim($character['short_description']);
    if (preg_match('/^(.+?[\.\!\?])(\s|$)/', $sd, $m)) {
        $tagline = $m[1];
    } else {
        $tagline = $sd;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?= htmlspecialchars($tagline ?: $character['name'] . ' — a figure from Greek mythology.'); ?>" />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/x-icon" href="../img/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
    <link rel="manifest" href="../img/favicon/site.webmanifest">

    <title>Olympus Archives | <?= htmlspecialchars($character['name']); ?></title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/characters.css" />
  </head>

  <body class="character-bg">
    <?php include 'nav.php'; ?>

    <main class="characters-page single-character-page">

      <!-- HERO BANNER -->
      <section class="char-hero-banner"
               style="--char-bg: url('<?= htmlspecialchars($imagePath); ?>');">
        <div class="char-hero-inner">
          <div class="char-portrait">
            <img src="<?= htmlspecialchars($imagePath); ?>"
                 alt="<?= htmlspecialchars($character['name']); ?>" />
          </div>

          <div class="char-hero-text">
            <span class="char-type"><?= htmlspecialchars($character['type']); ?></span>
            <h2><?= htmlspecialchars($character['name']); ?></h2>

            <?php if (!empty($tagline)): ?>
              <p class="char-tagline"><?= htmlspecialchars($tagline); ?></p>
            <?php endif; ?>

            <div class="char-hero-actions">
              <?php if (isset($_SESSION['username'])): ?>
                <form action="set_favorite_character.php"
                      method="post"
                      class="favorite-form-inline">
                  <input type="hidden" name="character_name"
                         value="<?= htmlspecialchars($character['name']); ?>" />
                  <button type="submit" class="highlight-btn">★ Save as Favorite</button>
                </form>
              <?php else: ?>
                <p class="fav-hint">
                  <a href="login.php">Log in</a> to save this as your favorite.
                </p>
              <?php endif; ?>

              <a href="characters.php" class="secondary">← All Characters</a>
            </div>
          </div>
        </div>
      </section>

      <!-- STAT TILES -->
      <section class="char-stats">
        <div class="stat-tile">
          <span class="stat-label">Type</span>
          <span class="stat-value"><?= htmlspecialchars($character['type']); ?></span>
        </div>

        <?php if (!empty($character['domain'])): ?>
          <div class="stat-tile">
            <span class="stat-label">Domain</span>
            <span class="stat-value"><?= htmlspecialchars($character['domain']); ?></span>
          </div>
        <?php endif; ?>

        <?php if (!empty($character['symbol'])): ?>
          <div class="stat-tile">
            <span class="stat-label">Symbol</span>
            <span class="stat-value"><?= htmlspecialchars($character['symbol']); ?></span>
          </div>
        <?php endif; ?>
      </section>

      <!-- DECORATIVE DIVIDER -->
      <div class="laurel-divider" aria-hidden="true">
        <span>❦</span>
      </div>

      <!-- BIOGRAPHY -->
      <section class="char-body">
        <article class="char-story-card">
          <h3>Biography</h3>
          <?php
            $bioRaw = trim($character['full_bio'] ?: $character['short_description'] ?: '');
            $bioRaw = str_replace(["\r\n", "\r"], "\n", $bioRaw);
            // Split on blank lines = real paragraph breaks
            $paragraphs = preg_split('/\n\s*\n/', $bioRaw);
            foreach ($paragraphs as $i => $para) {
                // Collapse single line breaks inside a paragraph into spaces
                $clean = trim(preg_replace('/\s*\n\s*/', ' ', $para));
                if ($clean === '') continue;
                $cls = ($i === 0) ? ' class="bio-lead"' : '';
                echo '<p' . $cls . '>' . htmlspecialchars($clean) . '</p>';
            }
          ?>
        </article>
      </section>

      <!-- RELATED CHARACTERS -->
      <?php if (!empty($related)): ?>
        <section class="char-related">
          <h3>More <?= htmlspecialchars($character['type']); ?>s</h3>
          <div class="char-related-grid">
            <?php foreach ($related as $rel): ?>
              <a href="character.php?slug=<?= urlencode($rel['slug']); ?>" class="related-card">
                <div class="related-card-img">
                  <img src="../img/gods/<?= htmlspecialchars($rel['slug']); ?>.png"
                       alt="<?= htmlspecialchars($rel['name']); ?>"
                       loading="lazy" />
                </div>
                <div class="related-card-name"><?= htmlspecialchars($rel['name']); ?></div>
              </a>
            <?php endforeach; ?>
          </div>
        </section>
      <?php endif; ?>

    </main>

    <?php include 'footer.php'; ?>

    <script src="../js/scripts.js"></script>
  </body>
</html>
