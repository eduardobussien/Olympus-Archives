<?php
// sql/fix_dashes.php
// Replaces em-dashes (—) with regular hyphens (-) across all text columns
// in the characters and myths tables. Safe to re-run.

require_once __DIR__ . '/db.php';

header('Content-Type: text/plain; charset=utf-8');

// Columns to clean — table => list of text columns
$targets = [
    'characters' => ['name', 'domain', 'description', 'full_bio', 'sources'],
    'myths'      => ['title', 'summary', 'full_text', 'sources'],
];

$emDash = "\xE2\x80\x94"; // — U+2014
$enDash = "\xE2\x80\x93"; // – U+2013 (replace these too while we're at it)

$totalRows = 0;

foreach ($targets as $table => $cols) {
    echo "=== Table: {$table} ===\n";

    foreach ($cols as $col) {
        // Make sure the column actually exists (sources may not exist if upgrade scripts didn't run)
        $check = $conn->query("SHOW COLUMNS FROM `{$table}` LIKE '{$col}'");
        if (!$check || $check->num_rows === 0) {
            echo "  - skipped {$col} (column not found)\n";
            continue;
        }

        // em-dash → hyphen
        $sql1 = "UPDATE `{$table}` SET `{$col}` = REPLACE(`{$col}`, ?, '-') WHERE `{$col}` LIKE CONCAT('%', ?, '%')";
        if ($stmt = $conn->prepare($sql1)) {
            $stmt->bind_param('ss', $emDash, $emDash);
            $stmt->execute();
            $changed1 = $stmt->affected_rows;
            $stmt->close();
        } else {
            $changed1 = 0;
        }

        // en-dash → hyphen
        $sql2 = "UPDATE `{$table}` SET `{$col}` = REPLACE(`{$col}`, ?, '-') WHERE `{$col}` LIKE CONCAT('%', ?, '%')";
        if ($stmt = $conn->prepare($sql2)) {
            $stmt->bind_param('ss', $enDash, $enDash);
            $stmt->execute();
            $changed2 = $stmt->affected_rows;
            $stmt->close();
        } else {
            $changed2 = 0;
        }

        $changed = $changed1 + $changed2;
        $totalRows += $changed;
        echo "  - {$col}: {$changed} row(s) updated\n";
    }
    echo "\n";
}

echo "==============================\n";
echo "Total row updates: {$totalRows}\n";
echo "Done. You can re-run this safely — it only touches rows that still contain dashes.\n";
