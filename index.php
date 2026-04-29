<?php
// index.php by Eduardo Bussien
session_start();

require __DIR__ . '/sql/db.php';

$featuredMyth  = null;
$featuredError = '';
$charCount = 0;
$mythCount = 0;
$gameCount = 2; // which-god + trivia

$res = $conn->query("SELECT slug, title, short_description FROM myths ORDER BY RAND() LIMIT 1");
if ($res === false) {
    $featuredError = "Myth query error: " . $conn->error;
} else {
    $featuredMyth = $res->fetch_assoc();
}

$res = $conn->query("SELECT COUNT(*) AS c FROM characters");
if ($res) { $charCount = (int) $res->fetch_assoc()['c']; }

$res = $conn->query("SELECT COUNT(*) AS c FROM myths");
if ($res) { $mythCount = (int) $res->fetch_assoc()['c']; }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Olympus Archives — a digital compendium of Greek mythology. Discover the gods, titans, heroes, and legends that shaped the ancient world." />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/x-icon" href="img/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="manifest" href="img/favicon/site.webmanifest">

    <title>Olympus Archives | Home</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/index.css" />
  </head>

  <body>
    <header>
      <nav class="navbar">
        <div class="nav-left">
          <img src="img/olympuslogo.png" alt="Olympus Archives Logo" class="logo" />
          <h1 class="site-title"><a href="index.php">Olympus Archives</a></h1>
        </div>

        <ul class="nav-links">
          <li><a href="index.php">Home</a></li>

          <li class="dropdown">
            <a href="html/characters.php">Characters</a>
            <ul class="dropdown-content">
              <li><a href="html/gods.php">Gods</a></li>
              <li><a href="html/titans.php">Titans</a></li>
              <li><a href="html/heroes.php">Heroes</a></li>
              <li><a href="html/monsters.php">Monsters</a></li>
              <hr>
              <li><a href="html/characters.php"><strong>View All</strong></a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="html/myths.php">Myths</a>
            <ul class="dropdown-content">
              <li><a href="html/myths.php?category=Creation">Creation Stories</a></li>
              <li><a href="html/myths.php?category=Quest">Famous Quests</a></li>
              <li><a href="html/myths.php?category=Tragedy">Tragedies</a></li>
              <hr>
              <li><a href="html/myths.php"><strong>View All</strong></a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="html/games.php">Games</a>
            <ul class="dropdown-content">
              <li><a href="html/which-god.php">Which God Are You?</a></li>
              <li><a href="html/trivia.php">Trivia Challenge</a></li>
            </ul>
          </li>
        </ul>

        <div class="nav-right">
          <div class="dropdown more-dropdown">
            <a href="#">More ▾</a>
            <ul class="dropdown-content">
              <li><a href="html/about.php">About</a></li>
              <li><a href="html/contact.php">Contact</a></li>
              <li><a href="html/tech.php">Tech Used</a></li>
            </ul>
          </div>

          <div class="dropdown profile-dropdown">
            <?php if (isset($_SESSION['username'])): ?>
              <img
                src="<?= htmlspecialchars($_SESSION['profile_pic'] ?? 'img/placeholder.png'); ?>"
                alt="Profile"
                class="profile-pic"
              />
              <ul class="dropdown-content profile-menu">
                <li><a href="html/profile.php">Profile</a></li>
                <li><a href="html/logout.php">Log Out</a></li>
              </ul>
            <?php else: ?>
              <img src="img/placeholder.png" alt="Profile" class="profile-pic" />
              <ul class="dropdown-content profile-menu not-logged-in">
                <li><a href="html/login.php">Log In</a></li>
                <li><a href="html/register.php">Register</a></li>
              </ul>
            <?php endif; ?>
          </div>
        </div>
      </nav>

      <section class="hero-slideshow">
        <div class="slides-container">
          <div class="slide fade">
            <img src="img/slideshow/slide1.jpg" alt="Athens under attack" />
          </div>
          <div class="slide fade">
            <img src="img/slideshow/slide2.jpg" alt="Greek myth artwork" />
          </div>
          <div class="slide fade">
            <img src="img/slideshow/slide3.jpg" alt="Classical sculpture" />
          </div>
        </div>

        <div class="hero-overlay">
          <span class="hero-eyebrow">Olympus Archives</span>
          <h2 class="hero-title">The Library of the Gods</h2>
          <p class="hero-subtitle">A digital compendium of Greek myth, art, and memory.</p>
          <div class="hero-cta">
            <a href="html/characters.php" class="btn">Explore Characters</a>
            <a href="html/myths.php" class="btn-ghost">Read the Myths</a>
          </div>
        </div>
      </section>
    </header>

    <main class="index-main">

      <!-- INTRO BAND -->
      <section class="intro-band">
        <span class="ornament" aria-hidden="true">❦</span>
        <p class="intro-quote">
          “The wonders of mythology live with us still — in art, in language, and in story.”
        </p>
      </section>

      <!-- EXPLORE -->
      <section class="explore-section">
        <h2 class="section-heading"><span>Begin Your Journey</span></h2>
        <p class="section-sub">Three paths through the archives</p>

        <div class="explore-grid">
          <a class="explore-card" href="html/characters.php">
            <img src="img/previews/characters.png" alt="Characters" loading="lazy" />
            <div class="card-overlay">
              <h3>Characters</h3>
              <p>Meet the gods, titans, and heroes who shaped the ancient world.</p>
              <span class="explore-btn">Explore</span>
            </div>
          </a>

          <a class="explore-card" href="html/myths.php">
            <img src="img/previews/myths.png" alt="Myths" loading="lazy" />
            <div class="card-overlay">
              <h3>Myths</h3>
              <p>Uncover timeless stories of creation, tragedy, and triumph.</p>
              <span class="explore-btn">Read More</span>
            </div>
          </a>

          <a class="explore-card" href="html/games.php">
            <img src="img/previews/games.png" alt="Games" loading="lazy" />
            <div class="card-overlay">
              <h3>Games</h3>
              <p>Challenge your knowledge through divine quizzes and games.</p>
              <span class="explore-btn">Play</span>
            </div>
          </a>
        </div>
      </section>

      <!-- FEATURED MYTH (editorial) -->
      <?php if ($featuredMyth): ?>
        <section class="featured-myth-v2">
          <div class="myth-editorial">
            <div class="myth-editorial-img">
              <img src="img/myths/<?= htmlspecialchars($featuredMyth['slug']); ?>.png"
                   alt="<?= htmlspecialchars($featuredMyth['title']); ?>"
                   loading="lazy" />
            </div>
            <div class="myth-editorial-text">
              <span class="myth-eyebrow">Featured Myth</span>
              <h2><?= htmlspecialchars($featuredMyth['title']); ?></h2>
              <p class="lead">
                <?= htmlspecialchars($featuredMyth['short_description'] ?? 'A myth from ancient Greece.'); ?>
              </p>
              <a class="read-link"
                 href="html/myth.php?slug=<?= urlencode($featuredMyth['slug']); ?>">
                Read the Full Story
              </a>
            </div>
          </div>
        </section>
      <?php endif; ?>

      <!-- STATS BAND -->
      <section class="stats-band">
        <div class="stat-item">
          <div class="stat-num"><?= $charCount; ?></div>
          <div class="stat-lbl">Legendary Figures</div>
        </div>
        <div class="stat-divider" aria-hidden="true"></div>
        <div class="stat-item">
          <div class="stat-num"><?= $mythCount; ?></div>
          <div class="stat-lbl">Eternal Myths</div>
        </div>
        <div class="stat-divider" aria-hidden="true"></div>
        <div class="stat-item">
          <div class="stat-num"><?= $gameCount; ?></div>
          <div class="stat-lbl">Interactive Games</div>
        </div>
      </section>

      <!-- SEARCH -->
      <section class="search-section-v2">
        <h2 class="section-heading"><span>Search the Archives</span></h2>
        <p class="section-sub">Find any god, hero, monster, or myth</p>
        <form id="searchForm" class="search-bar" method="get" action="html/search.php">
          <input
            type="text"
            id="searchInput"
            name="q"
            placeholder="Try ‘Zeus’, ‘Trojan War’, or ‘Medusa’…"
          />
          <button type="submit">Search</button>
        </form>
      </section>

      <!-- ABOUT -->
      <section class="about-preview-v2">
        <div class="about-inner">
          <span class="ornament" aria-hidden="true">❦</span>
          <h2>About Olympus Archives</h2>
          <p>
            A digital compendium of Greek mythology blending art, history, and storytelling.
            Created to preserve the legends of gods, heroes, and monsters for the modern age,
            it offers an immersive journey through myth and memory.
          </p>
          <a href="html/about.php" class="btn">Learn More</a>
        </div>
      </section>

    </main>

    <?php $conn->close(); ?>
    <?php include 'html/footer.php'; ?>

    <script src="js/scripts.js"></script>
  </body>
</html>
