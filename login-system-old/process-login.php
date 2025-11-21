<?php
session_start();
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

$identifier = trim($_POST['identifier']);
$password = $_POST['password'];

$user = getUserByEmailOrUsername($identifier);

if (!$user) {
    header("Location: index.php?error=invalid_credentials");
    exit();
}

if (isAccountLocked($user)) {
    header("Location: index.php?error=account_locked");
    exit();
}

if ($user && isset($user['password_hash']) && password_verify($password, $user['password_hash'])) {
    resetFailedAttempts($user['id']);

    $_SESSION['user_id'] = $user['id'];
    // prefer username if available, otherwise fall back to name
    $_SESSION['username'] = $user['username'] ?? $user['name'] ?? '';

    header("Location: dashboard.php");
    exit();
} else {
    $attempts = $user['failed_attempts'] + 1;
    $locked = $attempts >= 3;
    
    updateFailedAttempts($user['id'], $attempts, $locked);
    
    if ($locked) {
        header("Location: index.php?error=account_locked");
    } else {
        header("Location: index.php?error=invalid_credentials");
    }
    exit();
}
?>