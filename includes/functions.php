<?php
require_once __DIR__ . '/../config/database.php';

function getUserByUsername($username) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Failed to get user by username: " . $e->getMessage());
        return false;
    }
}

/**
 * Register a new user
 */
function registerUser($username, $email, $password) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $password]);
    } catch (PDOException $e) {
        error_log("Registration failed: " . $e->getMessage());
        return false;
    }
}
function clearResetToken($userId) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("UPDATE users 
                              SET reset_token = NULL, 
                                  reset_token_expiry = NULL
                              WHERE id = ?");
        return $stmt->execute([$userId]);
    } catch (PDOException $e) {
        error_log("Failed to clear reset token: " . $e->getMessage());
        return false;
    }
}
function getUserByEmail($email) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Failed to get user by email: " . $e->getMessage());
        return false;
    }
}

/**
 * Store reset token in database
 */
function storeResetToken($userId, $token, $expiry) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("UPDATE users 
                              SET reset_token = ?, reset_token_expiry = ? 
                              WHERE id = ?");
        return $stmt->execute([$token, $expiry, $userId]);
    } catch (PDOException $e) {
        error_log("Failed to store reset token: " . $e->getMessage());
        return false;
    }
}

function getUserByEmailOrUsername($identifier) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$identifier, $identifier]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateFailedAttempts($userId, $attempts, $locked = false) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE users SET failed_attempts = ?, last_failed_attempt = NOW(), account_locked = ? WHERE id = ?");
        return $stmt->execute([$attempts, $locked, $userId]);
    } catch (PDOException $e) {
        error_log("Failed to update failed attempts: " . $e->getMessage());
        return false;
    }
}

function resetFailedAttempts($userId) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE users SET failed_attempts = 0, last_failed_attempt = NULL WHERE id = ?");
        return $stmt->execute([$userId]);
    } catch (PDOException $e) {
        error_log("Failed to reset failed attempts: " . $e->getMessage());
        return false;
    }
}

function createPasswordResetToken($email, $token) {
    global $pdo;
    
    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
    return $stmt->execute([$token, $expiry, $email]);
}

function validateResetToken($token) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()");
    $stmt->execute([$token]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updatePassword($userId, $newPassword) {
    global $pdo;
    
    $stmt = $pdo->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?");
    return $stmt->execute([$newPassword, $userId]);
}
function getUserById($userId) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Failed to get user by ID: " . $e->getMessage());
        return false;
    }
}

function isAccountLocked($user) {
    if (isset($user['account_locked']) && $user['account_locked']) {
        return true;
    }

    if (isset($user['last_failed_attempt']) && isset($user['failed_attempts']) && $user['failed_attempts'] >= 3) {
        $lastAttempt = new DateTime($user['last_failed_attempt']);
        $now = new DateTime();
        $interval = $lastAttempt->diff($now);
        
        if ($interval->i >= 30) {
            resetFailedAttempts($user['id']);
            return false;
        }
        return true;
    }
    
    return false;
}

// Get all travel logs
function getAllTravelLogs($pdo) {
    try {
        $stmt = $pdo->query("
            SELECT travel_logs.*, users.username 
            FROM travel_logs 
            JOIN users ON travel_logs.user_id = users.id 
            ORDER BY created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching travel logs: " . $e->getMessage());
        return [];
    }
}

// Create a new travel log
function createTravelLog($pdo, $user_id, $title, $content, $image_path = null) {
    try {
        $stmt = $pdo->prepare("
            INSERT INTO travel_logs (user_id, title, content, image_path) 
            VALUES (:user_id, :title, :content, :image_path)
        ");
        $stmt->execute([
            ':user_id' => $user_id,
            ':title' => $title,
            ':content' => $content,
            ':image_path' => $image_path
        ]);
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        error_log("Error creating travel log: " . $e->getMessage());
        return false;
    }
}

// Handle file upload
function handleFileUpload($file) {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null; // No file uploaded or error occurred
    }

    $upload_dir = __DIR__ . '/../uploads/travel_logs/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $file_name = uniqid('log_') . '.' . $file_ext;
    $target_path = $upload_dir . $file_name;

    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        return 'uploads/travel_logs/' . $file_name;
    }

    return null;
}

?>


