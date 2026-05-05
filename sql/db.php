<?php
// sql/db.php by Eduardo Bussien
// Database connection for Olympus Archives.
//
// Credentials are read from environment variables when available
// and fall back to local XAMPP defaults so the project runs
// out of the box. For a private deployment, override these in
// your environment or in sql/config.local.php (gitignored).

$localConfig = __DIR__ . '/config.local.php';
if (is_file($localConfig)) {
    require $localConfig;
}

$dbHost = getenv('OLYMPUS_DB_HOST') ?: ($GLOBALS['OLYMPUS_DB_HOST'] ?? '127.0.0.1');
$dbPort = getenv('OLYMPUS_DB_PORT') ?: ($GLOBALS['OLYMPUS_DB_PORT'] ?? '3307');
$dbUser = getenv('OLYMPUS_DB_USER') ?: ($GLOBALS['OLYMPUS_DB_USER'] ?? 'root');
$dbPass = getenv('OLYMPUS_DB_PASS');
if ($dbPass === false) {
    $dbPass = $GLOBALS['OLYMPUS_DB_PASS'] ?? '';
}
$dbName = getenv('OLYMPUS_DB_NAME') ?: ($GLOBALS['OLYMPUS_DB_NAME'] ?? 'olympus_db');

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName, (int) $dbPort);

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$conn->set_charset('utf8mb4');
