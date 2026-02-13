<?php
// trivia.php – Greek Mythology Trivia
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

    <title>Olympus Archives | Trivia Challenge</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/games.css" />
</head>
<body class="trivia-bg">
    <?php include 'nav.php'; ?>
    <main class="game-page trivia-page">
        <section class="game-header">
            <h2>Trivia Challenge</h2>
            <p class="game-intro">
                Test your knowledge of Greek mythology with a quick 5-question quiz.
            </p>
        </section>

        <section class="game-card" id="trivia-card">
            <div id="trivia-status" class="trivia-status">
                <span id="question-counter">Question 1 of 5</span>
                <span id="score-counter">Score: 0</span>
            </div>

            <div class="trivia-question">
                <p id="question-text">Loading question...</p>
            </div>

            <div class="trivia-options" id="options-container">
                <!-- Options will be injected by trivia.js -->
            </div>

            <div class="trivia-controls">
                <button id="next-btn" class="btn game-btn" disabled>Next</button>
                <button id="restart-btn" class="btn game-btn secondary" style="display:none;">
                    Play Again
                </button>
            </div>

            <div id="trivia-feedback" class="trivia-feedback"></div>
        </section>

        <section id="trivia-result" class="trivia-result" style="display:none;">
            <h3>Your Results</h3>
            <p id="result-text"></p>
        </section>
    </main>

    <?php include 'footer.php'; ?>

    <script src="../js/trivia.js"></script>
</body>
</html>