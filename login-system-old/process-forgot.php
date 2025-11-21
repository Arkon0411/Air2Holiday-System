<?php
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: forgot-password.php");
    exit();
}

$email = trim($_POST['email']);

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: forgot-password.php?error=email_not_found");
    exit();
}

$token = bin2hex(random_bytes(32));

if (!createPasswordResetToken($email, $token)) {
    header("Location: forgot-password.php?error=reset_failed");
    exit();
}

header("Location: forgot-password.php?success=1");
exit();
?>