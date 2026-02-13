<?php
// set_favorite_character.php
session_start();
require_once __DIR__ . '/../sql/db.php';

if (!isset($_SESSION['user_id'], $_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$userId = (int)$_SESSION['user_id'];
$character = trim($_POST['character_name'] ?? '');

if ($character !== '' && $userId > 0) {
    $_SESSION['favorite_character'] = $character;

    $stmt = $conn->prepare("UPDATE users SET favorite_character = ? WHERE id = ?");
    $stmt->bind_param('si', $character, $userId);
    $stmt->execute();
    $stmt->close();
}

$redirect = $_SERVER['HTTP_REFERER'] ?? 'profile.php';
header('Location: ' . $redirect);
exit;
