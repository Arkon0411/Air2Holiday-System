<?php
require_once __DIR__ . '/../config/database.php';

$email = $argv[1] ?? 'a@aa.com';
try {
    $stmt = $pdo->prepare("SELECT COUNT(*) as c FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Email: $email - count: " . ($row['c'] ?? 0) . "\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
