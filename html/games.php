<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />

    <title>Olympus Archives | Games</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/games.css" />
</head>

<body>

<?php include 'nav.php'; ?>

<main class="gameshub-page">

    <section class="gameshub-title">
        <h1 class="fade-up">Olympus Games</h1>
        <p class="fade-up fade-delay-1">Choose a game and test your knowledge or discover your divine match.</p>
    </section>

    <section class="gameshub-grid fade-up fade-delay-1">

        <a href="which-god.php" class="gameshub-card">
            <img src="../img/previews/which-god.png" alt="Which God Are You?" />
            <h2>Which God Are You?</h2>
            <p>Answer 10 questions and discover your divine match.</p>
        </a>

        <a href="trivia.php" class="gameshub-card">
            <img src="../img/previews/trivia.png" alt="Trivia Challenge" />
            <h2>Trivia Challenge</h2>
            <p>Test your knowledge of mythology, heroes, monsters, and legends.</p>
        </a>

    </section>

</main>

    <?php include 'footer.php'; ?>

    <script src="../js/scripts.js"></script>

</body>
</html>
