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
    SELECT name, type, domain, symbol, short_description, full_bio
    FROM characters
    WHERE slug = ?
    LIMIT 1
");

$stmt->bind_param('s', $slug);
$stmt->execute();
$result = $stmt->get_result();
$character = $result->fetch_assoc();

$stmt->close();
$conn->close();

if (!$character) {
    http_response_code(404);
    echo "Character not found.";
    exit;
}
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

    <title>Olympus Archives | <?php echo htmlspecialchars($character['name']); ?></title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/characters.css" />
  </head>

  <body class="character-bg">
    <?php include 'nav.php'; ?>

    <main class="characters-page single-character-page">
      <!-- HERO: image + heading/meta + buttons -->
      <section class="char-hero">
        <?php
          $imagePath = "../img/gods/" . htmlspecialchars($slug) . ".png";
        ?>
        <div class="char-hero-image">
          <img src="<?= $imagePath; ?>" alt="<?= htmlspecialchars($character['name']); ?>">
        </div>

        <div class="char-hero-heading">
          <p class="char-type">
            <?= htmlspecialchars($character['type']); ?>
          </p>

          <h2><?= htmlspecialchars($character['name']); ?></h2>

          <?php if (!empty($character['domain'])): ?>
            <p class="char-meta-line">
              <span>Domain:</span> <?= htmlspecialchars($character['domain']); ?>
            </p>
          <?php endif; ?>

          <?php if (!empty($character['symbol'])): ?>
            <p class="char-meta-line">
              <span>Symbol:</span> <?= htmlspecialchars($character['symbol']); ?>
            </p>
          <?php endif; ?>

          <?php if (!empty($character['short_description'])): ?>
            <p class="char-short">
              <?= nl2br(htmlspecialchars($character['short_description'])); ?>
            </p>
          <?php endif; ?>

          <div class="char-hero-actions">
            <?php if (isset($_SESSION['username'])): ?>
              <form action="set_favorite_character.php" method="post" class="favorite-form-inline">
                <input type="hidden" name="character_name"
                       value="<?= htmlspecialchars($character['name']); ?>">
                <button type="submit" class="highlight-btn">
                  Save as Favorite
                </button>
              </form>
            <?php else: ?>
              <p class="fav-hint">
                <a href="login.php">Log in</a> to save this as your favorite character.
              </p>
            <?php endif; ?>

            <a href="characters.php" class="btn small-btn secondary">
              ← Back to Characters
            </a>
          </div>
        </div>
      </section>

      <section class="char-body">
        <article class="char-story-card">
          <h3>Biography</h3>
          <p>
            <?= nl2br(htmlspecialchars($character['full_bio'] ?: $character['short_description'])); ?>
          </p>
        </article>
      </section>
    </main>

    <?php include 'footer.php'; ?>

    <script src="../js/scripts.js"></script>
  </body>
</html>