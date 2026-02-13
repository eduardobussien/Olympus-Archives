<?php
// index.php by Eduardo Bussien
session_start();

require __DIR__ . '/sql/db.php';  

$featuredMyth  = null;
$featuredError = '';

$sql = "SELECT slug, title, short_description FROM myths ORDER BY RAND() LIMIT 1";

$featuredQuery = $conn->query($sql);

if ($featuredQuery === false) {
    $featuredError = "Myth query error: " . $conn->error;
} else {
    $featuredMyth = $featuredQuery->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/x-icon" href="img/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="manifest" href="img/favicon/site.webmanifest">

    <title>Olympus Archives | Home Page </title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/index.css" />
  </head>

  <body>
    <header>
      <nav class="navbar">
        <div class="nav-left">
          <img src="img/olympuslogo.png" alt="Olympus Archives Logo" class="logo"/> 
          <h1 class="site-title"><a href="index.php">Olympus Archives </a></h1>
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

          <!-- Profile dropdown -->
          <div class="dropdown profile-dropdown">
            <?php if (isset($_SESSION['username'])): ?>
              <img 
                src="<?php echo htmlspecialchars($_SESSION['profile_pic'] ?? 'img/placeholder.png'); ?>" 
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
            <img src="img/slideshow/slide1.jpg" alt="Athens under Attack" />
            <div class="caption-small">Discover the Gods, Titans & Heroes</div>
          </div>

          <div class="slide fade">
            <img src="img/slideshow/slide2.jpg" alt="Greek Myth" />
            <div class="caption-small">Uncover the Myths of Old</div>
          </div>

          <div class="slide fade">
            <img src="img/slideshow/slide3.jpg" alt="Sculpture" />
            <div class="caption-small">Step into the Legends of Olympus</div>
          </div>
        </div>

        <div class="static-caption">
          <h2>The Library of the Gods</h2>
        </div>
      </section>
    </header>

    <main class="index-main">
      <section class="search-section">
        <h2 class="fade-up fade-delay-1">Search the Archives</h2>
        <form
          id="searchForm"
          class="search-bar fade-up fade-delay-2"
          method="get"
          action="html/search.php"
        >
          <input
            type="text"
            id="searchInput"
            name="q"
            placeholder="Search gods, myths, heroes..."
          />
          <button type="submit">Search</button>
        </form>
      </section>

      <section class="explore">
        <div class="explore-card">
          <img src="img/previews/characters.png" alt="Characters">
          <div class="card-overlay">
            <h3 class="fade-up fade-delay-1">Characters</h3>
            <p class="fade-up fade-delay-2">Meet the Gods, Titans, and Heroes who shaped the ancient world.</p>
            <a href="html/characters.php" class="explore-btn fade-up fade-delay-3">Explore</a>
          </div>
        </div>

        <div class="explore-card">
          <img src="img/previews/myths.png" alt="Myths">
          <div class="card-overlay">
            <h3 class="fade-up fade-delay-1">Myths</h3>
            <p class="fade-up fade-delay-2">Uncover timeless stories of creation, tragedy, and triumph.</p>
            <a href="html/myths.php" class="explore-btn fade-up fade-delay-3">Read More</a>
          </div>
        </div>

        <div class="explore-card">
          <img src="img/previews/games.png" alt="Games">
          <div class="card-overlay">
            <h3 class="fade-up fade-delay-1">Games</h3>
            <p class="fade-up fade-delay-2">Challenge your knowledge through divine quizzes and games.</p>
            <a href="html/games.php" class="explore-btn fade-up fade-delay-3">Play</a>
          </div>
        </div>
      </section>
            
      <section class="featured-myth fade-up fade-delay-1">
        <div class="featured-myth-inner">
          <?php if ($featuredMyth): ?>
            <?php
              $imagePath = "img/myths/" . htmlspecialchars($featuredMyth['slug']) . ".png";
            ?>

            <!-- LEFT: random featured myth card -->
            <div class="myth-feature">
              
              <img src="<?= $imagePath ?>" 
                   alt="<?= htmlspecialchars($featuredMyth['title']) ?>">

              <div class="myth-text">
                <h3><h2>Featured Myth</h2><br><?= htmlspecialchars($featuredMyth['title']) ?></h3>

                <p>
                  <?= htmlspecialchars($featuredMyth['short_description'] ?? "A myth from ancient Greece.") ?>
                </p>

                <a href="html/myth.php?slug=<?= urlencode($featuredMyth['slug']) ?>" 
                   class="btn">
                  Read the Full Story
                </a>
              </div>
            </div>

            <!-- RIGHT: quick-access buttons -->
            <aside class="featured-side-links">
              <h3>Explore the Archives</h3>
              <a href="html/myths.php" class="btn side-btn">Browse All Myths</a>
              <a href="html/characters.php" class="btn side-btn">Meet the Characters</a>
              <a href="html/games.php" class="btn side-btn">Play Mythic Games</a>
            </aside>

          <?php else: ?>
            <p>No myths available.</p>
          <?php endif; ?>
        </div>
      </section>


        
      <section class="about-preview full-banner">
        <div class="banner-content">
          <div class="banner-text">
            <h2 class="fade-up fade-delay-1">About Olympus Archives</h2>
            <p class="fade-up fade-delay-2">
              Olympus Archives is a digital compendium of Greek mythology; blending art, history, and storytelling.
              Created to preserve the legends of gods, heroes, and monsters for the modern age, it offers an immersive journey through myth and memory.
            </p>
          </div>
          <div class="banner-button fade-up fade-delay-3">
            <a href="html/about.php" class="btn">Learn More</a>
          </div>
        </div>
      </section>         

    </main>

    <?php include 'html/footer.php'; ?>

    <script src="js/scripts.js"></script>
    
  </body>
</html>