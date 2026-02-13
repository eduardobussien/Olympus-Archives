<?php
// which-god.php .. Personality Quiz: Which God Are You?
session_start();
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

    <title>Olympus Archives | Which God Are You?</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/games.css" />
</head>
<body class="which-god-bg">
    <?php include 'nav.php'; ?>

    <main class="game-page which-god-page">
        <section class="game-header">
            <h2>Which God Are You?</h2>
            <p class="game-intro">
                Answer 10 questions and discover which Greek god or goddess matches your personality.
            </p>
        </section>

        <section class="game-card" id="wg-card">
            <div class="trivia-status">
                <span id="wg-question-counter">Question 1 of 10</span>
            </div>

            <div class="trivia-question">
                <p id="wg-question-text">Loading question...</p>
            </div>

            <div class="trivia-options" id="wg-options-container">

            </div>

            <div class="trivia-controls">
                <button id="wg-next-btn" class="btn game-btn" disabled>Next</button>
                <button id="wg-restart-btn" class="btn game-btn secondary" style="display:none;">
                    Restart Quiz
                </button>
            </div>

            <div id="wg-feedback" class="trivia-feedback"></div>
        </section>

        <section id="wg-result" class="trivia-result" style="display:none;">
            <h3>Your Divine Match</h3>
            <h4 id="wg-result-name"></h4>
            <p id="wg-result-desc"></p>
        </section>
    </main>

    <?php include 'footer.php'; ?>

    <script src="../js/which-god.js"></script>
</body>
</html>
