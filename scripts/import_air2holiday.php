<?php
// Simple importer for the air2holiday SQL dump.
// Usage (CLI):
//   php scripts/import_air2holiday.php
// Edit the credentials below if needed (XAMPP default is root with empty password).

set_time_limit(0);
ini_set('memory_limit', '512M');

$host = '127.0.0.1';
$user = 'root';
$pass = '';
$dbName = 'air2holiday';
$sqlPath = __DIR__ . '/../air2holiday.sql';

if (!file_exists($sqlPath)) {
    echo "SQL file not found at: $sqlPath\n";
    echo "Please copy your `air2holiday.sql` into the project root (one level up from scripts/) and run this script again.\n";
    exit(1);
}

try {
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    echo "Connected to MySQL on $host\n";

    echo "Dropping database if exists and creating new database `$dbName`...\n";
    $pdo->exec("DROP DATABASE IF EXISTS `$dbName`");
    $pdo->exec("CREATE DATABASE `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    $pdo->exec("USE `$dbName`");

    echo "Importing SQL from $sqlPath ...\n";
    $sql = file_get_contents($sqlPath);

    // Remove phpMyAdmin comments and SET/START TRANSACTION lines to reduce noise
    $sql = preg_replace('/\/\*![0-9]+.*?\*\//s', '', $sql);
    $sql = preg_replace('/--.*?\n/', "\n", $sql);
    $sql = preg_replace('/^\s*SET .*?;\s*\n/mi', "", $sql);
    $sql = str_replace("\r", "\n", $sql);

    // Split statements by semicolon followed by newline. This is simple but works for typical dumps.
    $parts = preg_split('/;\s*\n/', $sql);

    $count = 0;
    foreach ($parts as $stmt) {
        $stmt = trim($stmt);
        if ($stmt === '') continue;

        try {
            $pdo->exec($stmt);
            $count++;
        } catch (PDOException $e) {
            // Log and continue - some statements (like repeated ALTERs on non-existing objects) may fail.
            echo "Warning: failed executing statement: " . $e->getMessage() . "\n";
        }
    }

    echo "Imported approximately $count statements.\n";
    echo "Finished. Update `config/database.php` to use database name `$dbName` if needed.\n";

} catch (PDOException $e) {
    echo "Connection or import failed: " . $e->getMessage() . "\n";
    exit(1);
}

?>
