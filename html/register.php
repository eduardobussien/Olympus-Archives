<?php
// html/register.php
session_start();
require_once __DIR__ . '/../sql/db.php'; // your db connection (127.0.0.1:3307)

$errors = [];
$old = ['username' => '', 'email' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $pass     = $_POST['password'] ?? '';
    $pass2    = $_POST['confirm_password'] ?? '';
    $avatar   = $_POST['avatar'] ?? 'avatar-default.png'; // filename only, e.g. zeus.png

    // Save old values so form can repopulate
    $old['username'] = $username;
    $old['email']    = $email;

    // ---------- VALIDATION ----------
    if ($username === '' || !preg_match('/^[A-Za-z0-9_]{3,40}$/', $username)) {
        $errors[] = 'Username must be 3–40 characters (letters, numbers, underscore).';
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if (strlen($pass) < 8) {
        $errors[] = 'Password must be at least 8 characters long.';
    }

    if ($pass !== $pass2) {
        $errors[] = 'Passwords do not match.';
    }

    // ---------- CHECK DUPLICATE USERNAME/EMAIL ----------
    if (empty($errors)) {
        $sql = "SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $errors[] = 'That username or email is already taken.';
            }
            $stmt->close();
        } else {
            $errors[] = 'Database error (prepare failed).';
        }
    }

    // ---------- INSERT USER ----------
    if (empty($errors)) {
        $password_hash = password_hash($pass, PASSWORD_DEFAULT);

        // Insert username, email, hashed password, and avatar filename
        $sql = "INSERT INTO users (username, email, password_hash, profile_pic) VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $username, $email, $password_hash, $avatar);

            if ($stmt->execute()) {
                $newId = $stmt->insert_id;

                // Store session values
                $_SESSION['user_id']     = $newId;
                $_SESSION['username']    = $username;
                // store full path for navbar usage
                $_SESSION['profile_pic'] = 'img/avatars/' . $avatar;

                $stmt->close();
                header("Location: ../index.php");
                exit;
            } else {
                $errors[] = 'Error saving your account. Please try again.';
                $stmt->close();
            }
        } else {
            $errors[] = 'Database error (prepare failed on insert).';
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
    <link rel="icon" type="image/x-icon" href="../img/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
    <link rel="manifest" href="../img/favicon/site.webmanifest">

    <title>Olympus Archives | Register</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/logs.css" />
  </head>

  <body class="auth-bg2">
    <?php include 'nav.php'; ?> 

    <main class="auth-page">
        <h2>Create Your Account</h2>

        <?php if (!empty($errors)): ?>
            <div class="auth-error">
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" class="auth-form">

            <label for="username"><strong>Username</strong></label>
            <input
                id="username"
                name="username"
                type="text"
                required
                minlength="3"
                maxlength="40"
                value="<?= htmlspecialchars($old['username']) ?>"
                placeholder="Choose a username"
            >

            <label for="email"><strong>Email</strong></label>
            <input
                id="email"
                name="email"
                type="email"
                required
                value="<?= htmlspecialchars($old['email']) ?>"
                placeholder="you@example.com"
            >

            <label for="password"><strong>Password</strong></label>
            <input
                id="password"
                name="password"
                type="password"
                required
                minlength="8"
                placeholder="At least 8 characters"
            >

            <label for="confirm_password"><strong>Confirm Password</strong></label>
            <input
                id="confirm_password"
                name="confirm_password"
                type="password"
                required
            >

            <label for="avatar"><strong>Select Your Avatar</strong></label>
            <select id="avatar" name="avatar" required>
                <option value="zeus.png">Zeus</option>
                <option value="poseidon.png">Poseidon</option>
                <option value="hades.png">Hades</option>
                <option value="athena.png">Athena</option>
                <option value="apollo.png">Apollo</option>
                <option value="artemis.png">Artemis</option>
                <option value="aphrodite.png">Aphrodite</option>
                <option value="hera.png">Hera</option>
                <option value="persephone.png">Persephone</option>
            </select>
            <button type="submit">Create Account</button>
        </form>
        <p class="auth-helper">
            Already have an account?
            <a href="login.php">Log in here</a>.
        </p>

    </main>


<?php include 'footer.php'; ?>
  </body>
</html>
