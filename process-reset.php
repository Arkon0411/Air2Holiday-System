<?php
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: forgot-password.php");
    exit();
}

$token = $_POST['token'];
$newPassword = $_POST['new_password'];
$confirmPassword = $_POST['confirm_password'];

$user = validateResetToken($token);

if (!$user) {
    header("Location: index.php?error=invalid_token");
    exit();
}

if ($newPassword !== $confirmPassword) {
    header("Location: reset-password.php?token=$token&error=password_mismatch");
    exit();
}

if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/', $newPassword)) {
    header("Location: reset-password.php?token=$token&error=password_requirements");
    exit();
}

if (updatePassword($user['id'], $newPassword)) {
    header("Location: index.php?success=reset");
} else {
    header("Location: reset-password.php?token=$token&error=reset_failed");
}
exit();
?>