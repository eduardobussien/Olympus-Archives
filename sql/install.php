<?php
// sql/install.php by Eduardo Bussien
// One-click installer for Olympus Archives.
// Visit http://localhost/olympus/sql/install.php once after creating the
// database. This script creates every table, runs the seeds, applies the
// content upgrades, and tidies the text. Re-running is safe.

require __DIR__ . '/db.php';

header('Content-Type: text/html; charset=utf-8');

$steps = [];
$startedAt = microtime(true);

function step(string $label, callable $work): void {
    global $steps;
    $stepStart = microtime(true);
    try {
        $work();
        $steps[] = [
            'label' => $label,
            'ok'    => true,
            'ms'    => (int) ((microtime(true) - $stepStart) * 1000),
        ];
    } catch (Throwable $e) {
        $steps[] = [
            'label' => $label,
            'ok'    => false,
            'ms'    => (int) ((microtime(true) - $stepStart) * 1000),
            'error' => $e->getMessage(),
        ];
    }
}

step('Create characters table', function () use ($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS characters (
        id INT AUTO_INCREMENT PRIMARY KEY,
        slug VARCHAR(80) NOT NULL UNIQUE,
        name VARCHAR(120) NOT NULL,
        type VARCHAR(80) NOT NULL,
        domain VARCHAR(255) NULL,
        symbol VARCHAR(255) NULL,
        short_description TEXT NULL,
        full_bio LONGTEXT NULL,
        sources TEXT NULL,
        INDEX idx_type (type)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if (!$conn->query($sql)) {
        throw new RuntimeException($conn->error);
    }
});

step('Create myths table', function () use ($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS myths (
        id INT AUTO_INCREMENT PRIMARY KEY,
        slug VARCHAR(80) NOT NULL UNIQUE,
        title VARCHAR(160) NOT NULL,
        category VARCHAR(60) NOT NULL,
        short_description TEXT NULL,
        full_text LONGTEXT NULL,
        main_characters TEXT NULL,
        sources TEXT NULL,
        INDEX idx_category (category)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if (!$conn->query($sql)) {
        throw new RuntimeException($conn->error);
    }
});

step('Create users table', function () use ($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(40) NOT NULL UNIQUE,
        email VARCHAR(120) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        profile_pic VARCHAR(80) NULL,
        favorite_character VARCHAR(80) NULL,
        favorite_myth VARCHAR(80) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if (!$conn->query($sql)) {
        throw new RuntimeException($conn->error);
    }
});

// The seed and upgrade scripts each call $conn->close() / exit at the end of
// their own runs in some cases, so we include them in a closure with output
// buffered so their progress messages don't break the install summary.
function run_script(string $relativePath): void {
    $path = __DIR__ . '/' . $relativePath;
    if (!is_file($path)) {
        throw new RuntimeException("Missing script: $relativePath");
    }
    ob_start();
    include $path;
    ob_end_clean();
}

step('Seed characters', function () { run_script('seed_characters.php'); });
step('Add additional heroes', function () { run_script('add_more_characters.php'); });
step('Expand character biographies', function () { run_script('upgrade_bios.php'); });

// The seeds close the connection, so reopen it for the myth phase.
require __DIR__ . '/db.php';

step('Seed myths', function () { run_script('seed_myths.php'); });
step('Add additional myths', function () { run_script('add_more_myths.php'); });
step('Expand myth narratives', function () { run_script('upgrade_myths.php'); });

require __DIR__ . '/db.php';

step('Normalize dashes', function () { run_script('fix_dashes.php'); });

$totalMs = (int) ((microtime(true) - $startedAt) * 1000);
$ok = array_reduce($steps, fn($carry, $s) => $carry && $s['ok'], true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Olympus Archives | Installer</title>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Cinzel', Georgia, serif; background:#f4f0e8; color:#1a1a1a; margin:0; padding:48px 24px; }
    main { max-width:720px; margin:0 auto; background:#fffaf0; border:1px solid #e3d8be; border-radius:6px; padding:32px 40px; box-shadow:0 4px 18px rgba(0,0,0,.06); }
    h1 { margin-top:0; letter-spacing:.04em; }
    .summary { padding:14px 18px; border-radius:4px; margin-bottom:24px; font-weight:700; }
    .summary.ok { background:#eaf3e6; color:#2d572c; border:1px solid #c5dfb8; }
    .summary.fail { background:#f7e2e2; color:#7a1f1f; border:1px solid #e3b5b5; }
    ul.steps { list-style:none; padding:0; margin:0; font-family:Georgia, serif; }
    ul.steps li { padding:10px 0; border-bottom:1px solid #efe6cf; display:flex; justify-content:space-between; gap:12px; }
    ul.steps li:last-child { border-bottom:0; }
    .badge { font-size:.85em; padding:2px 10px; border-radius:999px; }
    .badge.ok { background:#2d572c; color:#fff; }
    .badge.fail { background:#7a1f1f; color:#fff; }
    .ms { color:#7a6a3f; font-size:.9em; }
    .err { color:#7a1f1f; font-style:italic; font-size:.9em; }
    .meta { margin-top:24px; color:#5a4a1f; font-size:.95em; }
    a.cta { display:inline-block; margin-top:18px; padding:10px 22px; background:#1a1a1a; color:#EFBF04; text-decoration:none; border-radius:4px; letter-spacing:.05em; }
    a.cta:hover { background:#EFBF04; color:#1a1a1a; }
  </style>
</head>
<body>
  <main>
    <h1>Olympus Archives Installer</h1>
    <div class="summary <?= $ok ? 'ok' : 'fail' ?>">
      <?= $ok
        ? 'Installation completed successfully in ' . $totalMs . ' ms.'
        : 'Installation finished with errors. Review the failed steps below.' ?>
    </div>

    <ul class="steps">
      <?php foreach ($steps as $s): ?>
        <li>
          <span><?= htmlspecialchars($s['label']) ?>
            <?php if (!$s['ok']): ?>
              <div class="err">&mdash; <?= htmlspecialchars($s['error'] ?? 'Unknown error') ?></div>
            <?php endif; ?>
          </span>
          <span>
            <span class="ms"><?= $s['ms'] ?> ms</span>
            <span class="badge <?= $s['ok'] ? 'ok' : 'fail' ?>"><?= $s['ok'] ? 'OK' : 'FAIL' ?></span>
          </span>
        </li>
      <?php endforeach; ?>
    </ul>

    <p class="meta">
      Re-running the installer is safe. Seeds use <code>ON DUPLICATE KEY UPDATE</code>
      and schema changes use <code>CREATE TABLE IF NOT EXISTS</code>.
    </p>

    <?php if ($ok): ?>
      <a href="../index.php" class="cta">Enter the Archives</a>
    <?php endif; ?>
  </main>
</body>
</html>
