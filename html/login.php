<?php
session_start();
require_once __DIR__ . '/../sql/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = "Please enter both username and password.";

    } else {

        $sql = "SELECT id, username, password_hash, profile_pic, favorite_character, favorite_myth 
                FROM users 
                WHERE username = ? 
                LIMIT 1";

        if ($stmt = $conn->prepare($sql)) {

            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {

                if (password_verify($password, $row['password_hash'])) {

                    // LOGIN SUCCESS - SET SESSION VARIABLES
                    $_SESSION['user_id']  = $row['id'];
                    $_SESSION['username'] = $row['username'];

                    // avatar - stored as filename in DB (e.g. "zeus.png")
                    $avatarFile = $row['profile_pic'] ?: 'placeholder.png';
                    $_SESSION['profile_pic'] = 'img/avatars/' . $avatarFile;

                    // favorites
                    $_SESSION['favorite_character'] = $row['favorite_character'] ?? '';
                    $_SESSION['favorite_myth']      = $row['favorite_myth'] ?? '';

                    $stmt->close();
                    header('Location: ../index.php');
                    exit;

                } else {
                    $error = "Incorrect username or password.";
                }

            } else {
                $error = "Incorrect username or password.";
            }

            $stmt->close();

        } else {
            $error = "Database error. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />
        
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="../img/favicon/favicon.ico">
        <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
        <link rel="manifest" href="../img/favicon/site.webmanifest">

        <title>Olympus Archives | Log-In</title>
        <link rel="stylesheet" href="../css/styles.css" />
        <link rel="stylesheet" href="../css/logs.css" />
    </head>

    <body class="auth-bg1">
        <?php include 'nav.php'; ?> 

        <main class="auth-page">
            <h2>Log In</h2>

            <?php if (!empty($error)): ?>
            <p class="auth-error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form method="post" action="login.php" class="auth-form">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <button type="submit">Log In</button>
            </form>

            <p class="auth-helper">
            Don't have an account?
            <a href="register.php">Register here</a>.
            </p>
        </main>

      <?php include 'footer.php'; ?>

    </body>
</html>