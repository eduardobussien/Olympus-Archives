<!-- about.php by Eduardo Bussien -->
<?php
session_start();
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

    <title>Olympus Archives | About</title>
    <link rel="stylesheet" href="../css/styles.css" />
  </head>

  <body class="about-bg">
    <?php include 'nav.php'; ?> 

    <main class="about-main">
      <!-- HERO -->
      <section class="about-hero">
        <div class="about-hero-inner">
          <h1>About Olympus Archives</h1>
          <p>
            A digital sanctuary devoted to the gods, heroes, monsters, and myths of ancient Greece.
          </p>
        </div>
      </section>

      <!-- CONTENT CARD -->
      <section class="about-content">
        <div class="about-section">
          <h2>Purpose</h2>
          <p>
            Olympus Archives is a digital library dedicated to exploring and celebrating Greek mythology. 
            From the creation of the world to the rise of the Olympians, every tale reflects the beauty, 
            complexity, and imagination of ancient storytellers. This project brings those timeless legends 
            into an interactive, visual space - a place where history meets technology.
          </p>
        </div>

        <div class="about-section">
          <h2>What You'll Find</h2>
          <ul>
            <li>
              <strong><a href="characters.php">Characters</a>:</strong>
              Detailed profiles of gods, titans, heroes, and monsters - including domains, symbols, and stories.
            </li>
            <li>
              <strong><a href="myths.php">Myths</a>:</strong>
              Epic tales of love, betrayal, courage, and tragedy that shaped ancient Greek culture.
            </li>
            <li>
              <strong><a href="games.php">Games &amp; Quizzes</a>:</strong>
              A playful way to test your knowledge or discover which god you resemble.
            </li>
          </ul>
        </div>

        <!-- VIDEO SECTION (HTML5 VIDEO + YOUTUBE LINK) -->
        <div class="about-section about-video-section">
          <h2>Learn Through Perspective</h2>
          <p>
            Check out this AI generated video! It shows how life back in Greece could have looked like.
          </p>

        <div class="about-video-wrapper">
          <video controls muted class="about-video">
            <source src="../vid/intro-mythology.mp4" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        </div>


          <p class="about-video-note">
            Inspired by ancient Greece - created with AI to visualize the world of myth and legend.
          </p>

        </div>

        <div class="about-section">
          <h2>The Vision Behind the Project</h2>
          <p>
            Created by <strong>Eduardo Bussien</strong>, Olympus Archives was built as a passion project to merge storytelling,
            art, and software development. It serves as both an educational tool and a tribute to mythology's timeless
            influence on literature, art, and imagination.
          </p>
          <p>
            Every section of the site - from the gods' family connections to the curated myths and quizzes - was designed
            to spark curiosity and appreciation for the ancient world.
          </p>
        </div>

        <div class="about-section">
          <h2>Technology Used</h2>
          <p>
            Olympus Archives is powered by HTML5, CSS, JavaScript, and PHP, with a MySQL database managing characters,
            myths, and user profiles. From animated slideshows to interactive quizzes, each component was crafted to make
            Greek mythology feel alive and approachable.
          </p>
          <a href="tech.php" class="tech-text-link">
            Explore the technologies behind Olympus Archives &gt;
          </a>
        </div>

        <div class="about-section">
          <h2>The Goal</h2>
          <p>
            The goal of Olympus Archives is to make the stories of Olympus accessible to everyone - students, fans, and
            mythology enthusiasts around the world. Whether you're researching a specific god, tracing the genealogy of
            the Titans, or simply exploring for fun, this archive is your gateway into the imagination of the ancient Greeks.
          </p>
        </div>
      </section>
    </main>

    <?php include 'footer.php'; ?>
    <script src="../js/scripts.js"></script>
  </body>
</html>
