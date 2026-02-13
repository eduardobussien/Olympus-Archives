<?php
// gods.php by Eduardo Bussien
session_start();
require '../sql/db.php';

$gods = [];
$sql = "
    SELECT slug, name, type, domain, short_description
    FROM characters
    WHERE type LIKE '%God%' OR type LIKE '%Goddess%'
    ORDER BY name
";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $gods[] = $row;
    }
}

if (empty($gods)) {
    $conn->close();
    die('No gods found in the database.');
}

$selectedSlug = $_GET['slug'] ?? '';
$selected = null;

if ($selectedSlug === '') {
    $selectedSlug = $gods[0]['slug'];
}

$stmt = $conn->prepare("
    SELECT slug, name, type, domain, symbol, short_description, full_bio
    FROM characters
    WHERE slug = ?
    LIMIT 1
");
$stmt->bind_param('s', $selectedSlug);
$stmt->execute();
$res = $stmt->get_result();
$selected = $res->fetch_assoc();
$stmt->close();
$conn->close();

if (!$selected) {
    $selected = $gods[0];
    $selectedSlug = $gods[0]['slug'];
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

    <title>Olympus Archives | Gods</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/characters.css" />
</head>
<body class="godhertitmon-bg">
    <?php include 'nav.php'; ?>

    <main class="characters-page gods-page">
        <section class="page-titlech">
            <h2 class="fade-up">Greek Gods</h2>
            <p class="fade-up fade-delay-1">Browse the gods of Olympus. Select a name to see their story.</p>
        </section>

        <section class="characters-layout">
            <!-- Highlighted god -->
            <section class="character-highlight">
                <?php
                  $imgSlug = htmlspecialchars($selected['slug']);
                  $imagePath = "../img/gods/{$imgSlug}.png";
                ?>
                <article class="highlight-card fade-up fade-delay-1">
                    <div class="highlight-image"
                         style="background-image: url('<?php echo $imagePath; ?>');">
                        <div class="highlight-overlay"></div>
                    </div>

                    <div class="highlight-info">
                        <h3 class="highlight-name">
                            <?php echo htmlspecialchars($selected['name']); ?>
                        </h3>

                        <?php if (!empty($selected['domain'])): ?>
                            <p class="highlight-domain">
                                <?php echo htmlspecialchars($selected['domain']); ?>
                            </p>
                        <?php endif; ?>

                        <?php if (!empty($selected['symbol'])): ?>
                            <p class="highlight-meta">
                                <strong>Symbol:</strong>
                                <?php echo htmlspecialchars($selected['symbol']); ?>
                            </p>
                        <?php endif; ?>

                        <?php
                          $desc = $selected['full_bio'] ?? $selected['short_description'] ?? '';
                          if ($desc !== ''): ?>
                            <p class="highlight-desc">
                                <?php echo nl2br(htmlspecialchars($desc)); ?>
                            </p>
                        <?php endif; ?>

                        <div class="highlight-actions">
                            <a class="btn highlight-btn"
                               href="character.php?slug=<?php echo urlencode($selectedSlug); ?>">
                                View Full Profile
                            </a>

                            <?php if (isset($_SESSION['username'])): ?>
                                <form action="set_favorite_character.php"
                                      method="post"
                                      class="favorite-form-inline">
                                    <input type="hidden" name="character_name"
                                           value="<?php echo htmlspecialchars($selected['name']); ?>">
                                    <button type="submit" class="btn small-btn secondary">
                                        Save as Favorite
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
            </section>

            <!-- RIGHT: Scroll list of all gods -->
            <aside class="character-sidebar fade-up fade-delay-1">
                <h4 class="sidebar-title">Gods</h4>
                <div class="character-list">
                    <?php foreach ($gods as $god): ?>
                        <?php
                          $isActive = ($god['slug'] === $selectedSlug);
                        ?>
                        <a href="gods.php?slug=<?php echo urlencode($god['slug']); ?>"
                           class="character-list-item <?php echo $isActive ? 'active' : ''; ?>">
                            <span class="char-list-name">
                                <?php echo htmlspecialchars($god['name']); ?>
                            </span>
                            <?php if (!empty($god['domain'])): ?>
                                <span class="char-list-domain">
                                    <?php echo htmlspecialchars($god['domain']); ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </aside>
        </section>
    </main>

<?php include 'footer.php'; ?>

    <script src="../js/scripts.js"></script>
</body>
</html>
