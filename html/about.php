<?php
// about.php by Eduardo Bussien
session_start();
require_once __DIR__ . '/../sql/db.php';

$charCount = 0;
$mythCount = 0;
$res = $conn->query("SELECT COUNT(*) AS c FROM characters");
if ($res) { $charCount = (int) $res->fetch_assoc()['c']; }
$res = $conn->query("SELECT COUNT(*) AS c FROM myths");
if ($res) { $mythCount = (int) $res->fetch_assoc()['c']; }
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="About Olympus Archives - a digital library devoted to Greek mythology, built by Eduardo Bussien." />
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

    <main class="about-main-v2">

      <!-- HERO -->
      <section class="about-hero-v2">
        <span class="about-eyebrow">A Digital Library</span>
        <h1>About Olympus Archives</h1>
        <p class="about-hero-sub">
          A sanctuary for the gods, heroes, monsters, and myths of ancient Greece -
          part archive, part interactive companion, built with care for storytelling
          and the craft behind it.
        </p>
      </section>

      <!-- STATS -->
      <section class="about-stats">
        <div class="about-stat">
          <div class="num"><?= $charCount; ?></div>
          <div class="lbl">Legendary Figures</div>
        </div>
        <div class="about-stat-divider" aria-hidden="true"></div>
        <div class="about-stat">
          <div class="num"><?= $mythCount; ?></div>
          <div class="lbl">Eternal Myths</div>
        </div>
        <div class="about-stat-divider" aria-hidden="true"></div>
        <div class="about-stat">
          <div class="num">3</div>
          <div class="lbl">Interactive Games</div>
        </div>
      </section>

      <!-- ORNAMENT -->
      <div class="about-ornament" aria-hidden="true">❦</div>

      <!-- MISSION -->
      <section class="about-section-v2">
        <div class="about-col-narrow">
          <span class="about-section-eyebrow">Mission</span>
          <h2>Why Olympus Archives</h2>
          <p>
            The myths of Greece are some of the oldest, strangest, and most
            beautifully human stories ever told. They explain the seasons, the stars,
            the sea - and the failings and triumphs of the people who tried to live
            beneath them. Olympus Archives exists to make those stories easy to find,
            pleasant to read, and worthy of the art that has carried them this far.
          </p>
          <p>
            This is a living project. New characters, new myths, and new games are
            added as the work progresses, with citations to the ancient sources so
            anyone who wants to read further can.
          </p>
        </div>
      </section>

      <!-- WHAT YOU'LL FIND -->
      <section class="about-section-v2 about-section-grid">
        <span class="about-section-eyebrow centered">What You'll Find</span>
        <h2 class="centered">Three Halls of the Archive</h2>

        <div class="about-feature-grid">
          <a class="about-feature-card" href="characters.php">
            <h3>Characters</h3>
            <p>Profiles of gods, titans, heroes, and monsters - domains, symbols, biographies, and the ancient sources that shaped them.</p>
            <span class="about-link">Explore →</span>
          </a>
          <a class="about-feature-card" href="myths.php">
            <h3>Myths</h3>
            <p>Creation stories, heroic quests, and tragedies - full retellings of the legends that defined the ancient Greek imagination.</p>
            <span class="about-link">Read →</span>
          </a>
          <a class="about-feature-card" href="games.php">
            <h3>Games</h3>
            <p>Three interactive challenges - discover your divine match, test your knowledge, and train your memory among the Olympians.</p>
            <span class="about-link">Play →</span>
          </a>
        </div>
      </section>

      <!-- ORNAMENT -->
      <div class="about-ornament" aria-hidden="true">❦</div>

      <!-- VIDEO -->
      <section class="about-section-v2">
        <div class="about-col-narrow">
          <span class="about-section-eyebrow">A Glimpse of the World</span>
          <h2>Greece Through Imagination</h2>
          <p>
            This short film, generated with AI tooling, offers a visual glimpse of
            what daily life in ancient Greece may have looked like - the marble, the
            shadow, the light. It is included as inspiration, not as historical record.
          </p>

          <div class="about-video-wrapper-v2">
            <video controls muted class="about-video-v2" preload="metadata">
              <source src="../vid/intro-mythology.mp4" type="video/mp4" />
              Your browser does not support the video tag.
            </video>
          </div>
          <p class="about-video-note-v2">
            Inspired by ancient Greece - created with AI to visualize the world of myth and legend.
          </p>
        </div>
      </section>

      <!-- BEHIND THE PROJECT -->
      <section class="about-section-v2 about-credit">
        <div class="about-col-narrow">
          <span class="about-section-eyebrow">Behind the Project</span>
          <h2>Built by Eduardo Bussien</h2>
          <p>
            Olympus Archives began as a passion project at the intersection of
            storytelling, art, and software. Every page - from the family trees of
            the Olympians to the curated myths and quizzes - was designed to spark
            curiosity and respect for the ancient world.
          </p>
          <p>
            The site is powered by HTML, CSS, JavaScript, PHP, and MySQL -
            a full-stack approach combining clean markup, expressive styling,
            and database-driven content.
          </p>
        </div>
      </section>

      <!-- CTA STRIP -->
      <section class="about-cta-strip">
        <h2>Begin your journey through the archives</h2>
        <div class="about-cta-actions">
          <a href="characters.php" class="btn">Meet the Gods</a>
          <a href="myths.php" class="btn-ghost">Read the Myths</a>
        </div>
      </section>

    </main>

    <?php include 'footer.php'; ?>
    <script src="../js/scripts.js"></script>
  </body>
</html>
