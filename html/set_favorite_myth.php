<?php
session_start();
require_once __DIR__ . '/../sql/db.php';

if (!isset($_SESSION['username'], $_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = (int)$_SESSION['user_id'];
$myth = trim($_POST['myth_slug'] ?? '');

if ($myth !== '') {
    $_SESSION['favorite_myth'] = $myth;

    $stmt = $conn->prepare("UPDATE users SET favorite_myth = ? WHERE id = ?");
    $stmt->bind_param('si', $myth, $userId);
    $stmt->execute();
    $stmt->close();
}

$redirect = $_SERVER['HTTP_REFERER'] ?? 'profile.php';
header("Location: $redirect");
exit;
