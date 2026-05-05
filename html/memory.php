<?php
// memory.php by Eduardo Bussien
session_start();
require_once __DIR__ . '/../sql/db.php';

// Pull a roster of characters whose images we can use for the game tiles
$pool = [];
$res = $conn->query("
    SELECT slug, name
    FROM characters
    WHERE type IN ('Olympian God','Olympian Goddess','Underworld Goddess','Titan','Titaness','Hero')
    ORDER BY RAND()
    LIMIT 8
");
if ($res) {
    while ($row = $res->fetch_assoc()) {
        $pool[] = $row;
    }
}
$conn->close();

// Encode the roster for JS
$poolJson = json_encode($pool, JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Match the gods - a memory game from the Olympus Archives." />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/x-icon" href="../img/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
    <link rel="manifest" href="../img/favicon/site.webmanifest">

    <title>Olympus Archives | Memory of the Gods</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/games.css" />
    <link rel="stylesheet" href="../css/memory.css" />
  </head>

  <body class="memory-bg">
    <?php include 'nav.php'; ?>

    <main class="memory-page">
      <header class="memory-header">
        <span class="memory-eyebrow">Olympus Games</span>
        <h1>Memory of the Gods</h1>
        <p class="memory-sub">Flip the tiles to find matching pairs of Olympians. The gods reward a clear mind.</p>
      </header>

      <section class="memory-stats">
        <div class="memory-stat">
          <span class="memory-stat-label">Moves</span>
          <span class="memory-stat-value" id="memory-moves">0</span>
        </div>
        <div class="memory-stat">
          <span class="memory-stat-label">Pairs</span>
          <span class="memory-stat-value">
            <span id="memory-pairs">0</span> / <span id="memory-total">8</span>
          </span>
        </div>
        <div class="memory-stat">
          <span class="memory-stat-label">Time</span>
          <span class="memory-stat-value" id="memory-time">00:00</span>
        </div>
        <button id="memory-restart" class="game-btn secondary">↻ New Game</button>
      </section>

      <section class="memory-board" id="memory-board" aria-label="Memory game board">
        <!-- Tiles injected by JS -->
      </section>

      <section class="memory-win" id="memory-win" hidden>
        <h2>Victory!</h2>
        <p>You matched all the gods in <strong id="memory-win-moves">0</strong> moves
           and <strong id="memory-win-time">00:00</strong>.</p>
        <button id="memory-win-restart" class="game-btn">Play Again</button>
      </section>
    </main>

    <?php include 'footer.php'; ?>

    <script>
      window.MEMORY_POOL = <?= $poolJson; ?>;
    </script>
    <script src="../js/scripts.js"></script>
    <script src="../js/memory.js"></script>
  </body>
</html>
