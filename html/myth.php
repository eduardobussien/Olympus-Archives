<?php
// myth.php by Eduardo Bussien
session_start();
require_once __DIR__ . '/../sql/db.php';

$slug = $_GET['slug'] ?? '';

if ($slug === '') {
    http_response_code(400);
    echo "Myth not specified.";
    exit;
}

$stmt = $conn->prepare("
    SELECT slug, title, category, short_description, full_text, main_characters
    FROM myths
    WHERE slug = ?
    LIMIT 1
");
$stmt->bind_param('s', $slug);
$stmt->execute();
$result = $stmt->get_result();
$myth = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$myth) {
    http_response_code(404);
    echo "Myth not found.";
    exit;
}
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

    <title>Olympus Archives | <?= htmlspecialchars($myth['title']); ?></title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/myths.css" />
  </head>

  <body class="myths-bg">
    <?php include 'nav.php'; ?>

    <main class="myth-detail-page">
      <section class="myth-detail-hero">
        <?php
          $imagePath = "../img/myths/" . htmlspecialchars($myth['slug']) . ".png";
        ?>
        <div class="myth-detail-image">
          <img src="<?= $imagePath; ?>" alt="<?= htmlspecialchars($myth['title']); ?>">
        </div>
        <div class="myth-detail-heading">
          <p class="myth-category-label">
            <?= htmlspecialchars($myth['category']); ?>
          </p>
          <h2><?= htmlspecialchars($myth['title']); ?></h2>
          <?php if (!empty($myth['short_description'])): ?>
            <p class="myth-tagline"><?= htmlspecialchars($myth['short_description']); ?></p>
          <?php endif; ?>
          <?php if (!empty($myth['main_characters'])): ?>
            <p class="myth-characters">
              <span>Main figures:</span>
              <?= htmlspecialchars($myth['main_characters']); ?>
            </p>
          <?php endif; ?>
        </div>
      </section>

      <section class="myth-detail-body">
        <article class="myth-story-card">
          <h3>The Story</h3>
          <p>
            <?= nl2br(htmlspecialchars($myth['full_text'])); ?>
          </p>
        </article>

        <!-- Button row: Back + Favourite -->
        <div class="myth-buttons-row">
          <!-- Back button (yellow, existing style) -->
          <a href="myths.php" class="btn myth-btn back-btn">← Back to Myths</a>

          <!-- Favourite button (only if logged in) -->
          <?php if (isset($_SESSION['username'])): ?>
            <form action="set_favorite_myth.php" method="POST" class="fav-form">
              <input type="hidden"
                     name="myth_slug"
                     value="<?= htmlspecialchars($myth['slug']); ?>">
              <button type="submit" class="fav-btn">
                Favourite
              </button>
            </form>
          <?php endif; ?>
        </div>
      </section>

    </main>

    <?php include 'footer.php'; ?>

    <script src="../js/scripts.js"></script>
  </body>
</html>
