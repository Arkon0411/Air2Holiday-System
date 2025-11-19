<?php
$host = 'localhost';
// Database name updated to the new Air2Holiday dump. Change back if you need the old DB.
$dbname = 'air2holiday';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>