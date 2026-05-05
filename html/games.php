<?php
// games.php by Eduardo Bussien
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Test your knowledge of Greek mythology - quizzes, personality games, and memory challenges in the Olympus Archives." />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/x-icon" href="../img/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
    <link rel="manifest" href="../img/favicon/site.webmanifest">

    <title>Olympus Archives | Games</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/games.css" />
  </head>

  <body>
    <?php include 'nav.php'; ?>

    <main class="gameshub-page">
      <header class="gameshub-hero">
        <span class="gameshub-eyebrow">Olympus Games</span>
        <h1>Trials of the Mind</h1>
        <p class="gameshub-tagline">Three challenges set by the gods. Choose your trial.</p>
      </header>

      <section class="gameshub-grid">

        <a href="which-god.php" class="gameshub-card">
          <div class="gameshub-card-img">
            <img src="../img/previews/which-god.png" alt="Which God Are You?" loading="lazy" />
          </div>
          <div class="gameshub-card-body">
            <span class="gameshub-card-eyebrow">Personality Quiz</span>
            <h2>Which God Are You?</h2>
            <p>Answer ten questions and discover the deity who shares your spirit.</p>
            <span class="gameshub-card-cta">Begin the Trial →</span>
          </div>
        </a>

        <a href="trivia.php" class="gameshub-card">
          <div class="gameshub-card-img">
            <img src="../img/previews/trivia.png" alt="Trivia Challenge" loading="lazy" />
          </div>
          <div class="gameshub-card-body">
            <span class="gameshub-card-eyebrow">Knowledge Test</span>
            <h2>Trivia Challenge</h2>
            <p>Prove your mastery of mythology, heroes, monsters, and ancient legends.</p>
            <span class="gameshub-card-cta">Take the Test →</span>
          </div>
        </a>

        <a href="memory.php" class="gameshub-card">
          <div class="gameshub-card-img">
            <img src="../img/previews/memory.png" alt="Memory of the Gods" loading="lazy" />
          </div>
          <div class="gameshub-card-body">
            <span class="gameshub-card-eyebrow">Memory Match</span>
            <h2>Memory of the Gods</h2>
            <p>Flip the tiles and find matching pairs of Olympians as quickly as you can.</p>
            <span class="gameshub-card-cta">Play Now →</span>
          </div>
        </a>

      </section>
    </main>

    <?php include 'footer.php'; ?>

    <script src="../js/scripts.js"></script>
  </body>
</html>
