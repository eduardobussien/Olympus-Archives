<?php
// myths.php by Eduardo Bussien
session_start();
require_once __DIR__ . '/../sql/db.php';

$allowedCategories = ['Creation', 'Quest', 'Tragedy'];
$category = $_GET['category'] ?? '';

if (!in_array($category, $allowedCategories, true)) {
    $category = ''; // show all if invalid / missing
}

// Get list of myths (for the right-hand list)
if ($category) {
    $stmt = $conn->prepare("
        SELECT slug, title, category, short_description
        FROM myths
        WHERE category = ?
        ORDER BY title
    ");
    $stmt->bind_param('s', $category);
} else {
    $stmt = $conn->prepare("
        SELECT slug, title, category, short_description
        FROM myths
        ORDER BY 
            FIELD(category, 'Creation', 'Quest', 'Tragedy'),
            title
    ");
}

$stmt->execute();
$result = $stmt->get_result();
$myths = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Which myth is highlighted on the left?
$currentSlug = $_GET['slug'] ?? ($myths[0]['slug'] ?? null);

$currentMyth = null;
if ($currentSlug) {
    $detailStmt = $conn->prepare("
        SELECT slug, title, category, short_description, full_text, main_characters
        FROM myths
        WHERE slug = ?
        LIMIT 1
    ");
    $detailStmt->bind_param('s', $currentSlug);
    $detailStmt->execute();
    $detailRes = $detailStmt->get_result();
    $currentMyth = $detailRes->fetch_assoc();
    $detailStmt->close();
}

$conn->close();
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

    <title>Olympus Archives | Myths</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/myths.css" />
  </head>

  <body class="myths-bg">
    <?php include 'nav.php'; ?>

    <main class="myths-page">
      <header class="myths-header">
        <h2 class="fade-up fade-delay-1">Myths of Greece</h2>
        <p class="fade-up fade-delay-2">Browse creation tales, heroic quests, and tragic stories passed down through the ages.</p>

        <div class="myth-category-tabs fade-up fade-delay-3">
          <a href="myths.php" class="<?= $category === '' ? 'active' : '' ?>">All</a>
          <a href="myths.php?category=Creation" class="<?= $category === 'Creation' ? 'active' : '' ?>">Creation Stories</a>
          <a href="myths.php?category=Quest" class="<?= $category === 'Quest' ? 'active' : '' ?>">Famous Quests</a>
          <a href="myths.php?category=Tragedy" class="<?= $category === 'Tragedy' ? 'active' : '' ?>">Tragedies</a>
        </div>
      </header>

      <section class="myths-layout">
        <!-- LEFT: Highlight card -->
        <article class="myth-highlight fade-up fade-delay-1">
          <?php if ($currentMyth): ?>
            <?php
              $imagePath = "../img/myths/" . htmlspecialchars($currentMyth['slug']) . ".png";
            ?>
            <div class="myth-highlight-card">
              <div class="myth-highlight-image">
                <img src="<?= $imagePath; ?>" alt="<?= htmlspecialchars($currentMyth['title']); ?>">
              </div>

              <div class="myth-highlight-content fade-up fade-delay-2">
                <p class="myth-category-label">
                  <?= htmlspecialchars($currentMyth['category']); ?>
                </p>

                <h3 class="myth-title fade-up">
                  <?= htmlspecialchars($currentMyth['title']); ?>
                </h3>

                <?php if (!empty($currentMyth['short_description'])): ?>
                  <p class="myth-tagline">
                    <?= htmlspecialchars($currentMyth['short_description']); ?>
                  </p>
                <?php endif; ?>

                <?php if (!empty($currentMyth['full_text'])): ?>
                  <p class="myth-excerpt">
                    <?= nl2br(htmlspecialchars(mb_substr($currentMyth['full_text'], 0, 650))) . (mb_strlen($currentMyth['full_text']) > 650 ? '…' : ''); ?>
                  </p>
                <?php endif; ?>

                <?php if (!empty($currentMyth['main_characters'])): ?>
                  <p class="myth-characters">
                    <span>Main figures:</span>
                    <?= htmlspecialchars($currentMyth['main_characters']); ?>
                  </p>
                <?php endif; ?>

                <a class="btn myth-btn"
                   href="myth.php?slug=<?= urlencode($currentMyth['slug']); ?>">
                  Read Full Myth
                </a>
              </div>
            </div>
          <?php else: ?>
            <p>No myths found.</p>
          <?php endif; ?>
        </article>

        <!-- HORIZONTAL SCROLLER UNDER THE HIGHLIGHT -->
        <section class="myth-carousel fade-up fade-delay-2">
          <h3>Explore More Myths</h3>

          <?php if (!empty($myths)): ?>
            <div class="myth-scroll-container fade-delay-1">
              <?php foreach ($myths as $myth): ?>
                <?php $isActive = ($myth['slug'] === $currentSlug); ?>
                <a 
                  href="myths.php?slug=<?= urlencode($myth['slug']); ?><?= $category ? '&category=' . urlencode($category) : ''; ?>"
                  class="myth-scroll-item <?= $isActive ? 'active' : '' ?>"
                >
                  <img 
                    src="../img/myths/<?= htmlspecialchars($myth['slug']); ?>.png"
                    alt="<?= htmlspecialchars($myth['title']); ?>"
                  >
                  <p><?= htmlspecialchars($myth['title']); ?></p>
                </a>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <p class="no-myths-msg">No myths found for this category.</p>
          <?php endif; ?>
        </section>

      </section>
    </main>

    <?php include 'footer.php'; ?>

    <script src="../js/scripts.js"></script>
  </body>
</html>
