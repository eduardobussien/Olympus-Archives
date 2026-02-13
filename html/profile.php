<?php
// profile.php by Eduardo Bussien
session_start();
require_once __DIR__ . '/../sql/db.php';

if (!isset($_SESSION['username'], $_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = (int)$_SESSION['user_id'];

$userId = (int)$_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT profile_pic, favorite_character, favorite_myth
    FROM users
    WHERE id = ?
    LIMIT 1
");
$stmt->bind_param('i', $userId);
$stmt->execute();
$stmt->bind_result($dbPic, $dbFavChar, $dbFavMyth);
$stmt->fetch();
$stmt->close();

if ($dbPic) {
    $_SESSION['profile_pic'] = 'img/avatars/' . $dbPic;
}
if ($dbFavChar) {
    $_SESSION['favorite_character'] = $dbFavChar;
}
if ($dbFavMyth) {
    $_SESSION['favorite_myth'] = $dbFavMyth;
}

$avatars = [
    'zeus'        => 'img/avatars/zeus.png',
    'hera'        => 'img/avatars/hera.png',
    'athena'      => 'img/avatars/athena.png',
    'poseidon'    => 'img/avatars/poseidon.png',
    'hades'       => 'img/avatars/hades.png',
    'persephone'  => 'img/avatars/persephone.png',
    'apollo'      => 'img/avatars/apollo.png',
    'aphrodite'   => 'img/avatars/aphrodite.png'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chosenAvatarKey = $_POST['avatar'] ?? '';

    if (isset($avatars[$chosenAvatarKey])) {
        $fullPath = $avatars[$chosenAvatarKey];
        $_SESSION['profile_pic'] = $fullPath;
        $filename = basename($fullPath);

        if ($userId > 0) {
            $stmt = $conn->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
            $stmt->bind_param('si', $filename, $userId);
            $stmt->execute();
            $stmt->close();
        }
    }
}


$avatarPath        = '../' . ($_SESSION['profile_pic'] ?? 'img/placeholder.png');
$username          = $_SESSION['username'];
$favoriteCharacter = $_SESSION['favorite_character'] ?? '';
$favoriteMyth      = $_SESSION['favorite_myth'] ?? '';
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

    <title>Olympus Archives | Profile</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/logs.css" />
  </head>

  <body class="profile-bg">
    <?php include 'nav.php'; ?>

    <main class="profile-page-simple">

      <div class="profile-layout">
        <div class="profile-avatar-large fade-up fade-delay-1">
          <img src="<?php echo htmlspecialchars($avatarPath); ?>" alt="Profile avatar">
        </div>

        <!-- Card with info + favorites + settings -->
        <section class="profile-card fade-up fade-delay-1">
          <h2><?php echo htmlspecialchars($username); ?></h2>
          <p class="profile-username-simple">@<?php echo htmlspecialchars($username); ?></p>
          <p class="profile-joined-simple">Joined December 2025</p>

          <hr class="profile-divider">

          <h3>Your Favorites</h3>
          <p>
            <strong>Favorite Character:</strong>
            <?php echo $favoriteCharacter !== '' ? htmlspecialchars($favoriteCharacter) : 'None selected yet.'; ?>
          </p>
          <p>
            <strong>Favorite Myth:</strong>
            <?php echo $favoriteMyth !== '' ? htmlspecialchars($favoriteMyth) : 'None selected yet.'; ?>
          </p>

          <p class="profile-hint">
            You can pick favorites from each character or myth page using the
            “Save as Favorite” button.
          </p>

          <hr class="profile-divider">


          <details class="profile-settings">
            <summary>Change avatar</summary>

            <form method="post" class="profile-avatar-form">
              <label for="avatar-select">Choose an avatar:</label>
              <select id="avatar-select" name="avatar">
                <?php foreach ($avatars as $key => $path): ?>
                  <option
                    value="<?php echo htmlspecialchars($key); ?>"
                    <?php
                      if (isset($_SESSION['profile_pic']) && $_SESSION['profile_pic'] === $path) {
                        echo 'selected';
                      }
                    ?>
                  >
                    <?php echo ucfirst($key); ?>
                  </option>
                <?php endforeach; ?>
              </select>

              <button type="submit" class="profile-save-btn">Save</button>
            </form>
          </details>


    </main>


      <?php include 'footer.php'; ?>

    <script src="../js/scripts.js"></script>
  </body>
</html>
