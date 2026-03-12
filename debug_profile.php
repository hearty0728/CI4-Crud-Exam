<?php

// Debug script to check database and profile update
require_once __DIR__ . '/vendor/autoload.php';

$db = \Config\Database::connect();

echo "=== DATABASE CONNECTION TEST ===\n\n";

// Check if columns exist
echo "Checking users table structure:\n";
$query = $db->query("DESCRIBE users");
$columns = $query->getResultArray();

echo "\nExisting columns:\n";
foreach ($columns as $column) {
    echo "- " . $column['Field'] . " (" . $column['Type'] . ")\n";
}

// Check if profile columns exist
$profileColumns = ['student_id', 'course', 'year_level', 'section', 'phone', 'address', 'profile_image'];
$missingColumns = [];

foreach ($profileColumns as $col) {
    $found = false;
    foreach ($columns as $column) {
        if ($column['Field'] === $col) {
            $found = true;
            break;
        }
    }
    if (!$found) {
        $missingColumns[] = $col;
    }
}

if (empty($missingColumns)) {
    echo "\n✓ All profile columns exist!\n";
} else {
    echo "\n✗ Missing columns: " . implode(', ', $missingColumns) . "\n";
    echo "\nPlease run the migration SQL:\n";
    echo "ALTER TABLE `users` \n";
    foreach ($missingColumns as $col) {
        echo "ADD COLUMN `$col` VARCHAR(255) NULL,\n";
    }
}

// Test a simple update
echo "\n\n=== TESTING UPDATE ===\n";
$testData = ['phone' => '0999-999-9999'];
$result = $db->table('users')->where('id', 1)->update($testData);
echo "Update result: " . ($result ? "SUCCESS" : "FAILED") . "\n";

if (!$result) {
    echo "Error: " . $db->error()['message'] . "\n";
}
