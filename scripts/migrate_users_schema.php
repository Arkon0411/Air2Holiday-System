<?php
// Migration: add compatibility columns to `users` table so the application works
// with the `air2holiday` dump. Run from project root:
//   php scripts/migrate_users_schema.php

$host = '127.0.0.1';
$user = 'root';
$pass = '';
$dbName = 'air2holiday';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    echo "Connected to $dbName. Running migration...\n";

    $statements = [
        // Add username for backward compatibility
        "ALTER TABLE users ADD COLUMN IF NOT EXISTS username VARCHAR(255) DEFAULT NULL",
        // Backfill username from name
        // Add legacy password column (not used) to avoid errors
        "ALTER TABLE users ADD COLUMN IF NOT EXISTS password VARCHAR(255) DEFAULT NULL",
        // Add lockout / attempt tracking
        "ALTER TABLE users ADD COLUMN IF NOT EXISTS failed_attempts INT NOT NULL DEFAULT 0",
        "ALTER TABLE users ADD COLUMN IF NOT EXISTS last_failed_attempt DATETIME DEFAULT NULL",
        "ALTER TABLE users ADD COLUMN IF NOT EXISTS account_locked TINYINT(1) NOT NULL DEFAULT 0",
        // Password reset
        "ALTER TABLE users ADD COLUMN IF NOT EXISTS reset_token VARCHAR(255) DEFAULT NULL",
        "ALTER TABLE users ADD COLUMN IF NOT EXISTS reset_token_expiry DATETIME DEFAULT NULL",
    ];

    foreach ($statements as $stmt) {
        try {
            $pdo->exec($stmt);
            echo "Executed: $stmt\n";
        } catch (PDOException $e) {
            echo "Note: statement failed: " . $e->getMessage() . "\n";
        }
    }

    // Backfill username where null
    $pdo->exec("UPDATE users SET username = name WHERE (username IS NULL OR username = '') AND (name IS NOT NULL AND name != '')");
    echo "Backfilled username from name.\n";

    echo "Migration complete.\n";
} catch (PDOException $e) {
    echo "Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}

?>
