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
        // Generate a unique id similar to dump style
        $id = 'u' . bin2hex(random_bytes(8));
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Discover which columns exist in `users` to be tolerant of different schemas
        $colsRes = $pdo->query("SHOW COLUMNS FROM users")->fetchAll(PDO::FETCH_COLUMN);
        $available = array_map('strtolower', $colsRes ?: []);

        $insertCols = [];
        $values = [];

        // id
        if (in_array('id', $available)) {
            $insertCols[] = 'id';
            $values[] = $id;
        }
        // username (optional)
        if (in_array('username', $available)) {
            $insertCols[] = 'username';
            $values[] = $username;
        }
        // name (use username as name if exists)
        if (in_array('name', $available)) {
            $insertCols[] = 'name';
            $values[] = $username;
        }
        // email
        if (in_array('email', $available)) {
            $insertCols[] = 'email';
            $values[] = $email;
        }
        // password_hash
        if (in_array('password_hash', $available)) {
            $insertCols[] = 'password_hash';
            $values[] = $passwordHash;
        } elseif (in_array('password', $available)) {
            // fallback to legacy `password` column (not recommended)
            $insertCols[] = 'password';
            $values[] = $passwordHash;
        }
        // role
        if (in_array('role', $available)) {
            $insertCols[] = 'role';
            $values[] = 'customer';
        }

        if (empty($insertCols)) {
            throw new Exception('No valid columns found in users table to insert new user');
        }

        $placeholders = implode(', ', array_fill(0, count($insertCols), '?'));
        $colsSql = implode(', ', $insertCols);

        $sql = "INSERT INTO users ($colsSql) VALUES ($placeholders)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($values);
    } catch (PDOException $e) {
        error_log("Registration failed (PDO): " . $e->getMessage());
        // Also write a short diagnostics file to project logs for local debugging
        $logDir = __DIR__ . '/../logs';
        if (!is_dir($logDir)) {
            @mkdir($logDir, 0777, true);
        }
        $logFile = $logDir . '/db_errors.log';
        $message = date('c') . " REGISTER ERROR: " . $e->getMessage() . " | SQL: " . ($sql ?? '') . "\n";
        @file_put_contents($logFile, $message, FILE_APPEND);
        return false;
    }
}

function clearResetToken($userId) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("UPDATE users SET reset_token = NULL, reset_token_expiry = NULL WHERE id = ?");
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
        $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE id = ?");
        return $stmt->execute([$token, $expiry, $userId]);
    } catch (PDOException $e) {
        error_log("Failed to store reset token: " . $e->getMessage());
        return false;
    }
}

function getUserByEmailOrUsername($identifier) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$identifier, $identifier]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Failed to get user by email or username: " . $e->getMessage());
        return false;
    }
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
        $stmt = $pdo->prepare("UPDATE users SET failed_attempts = 0, last_failed_attempt = NULL, account_locked = 0 WHERE id = ?");
        return $stmt->execute([$userId]);
    } catch (PDOException $e) {
        error_log("Failed to reset failed attempts: " . $e->getMessage());
        return false;
    }
}

function createPasswordResetToken($email, $token) {
    global $pdo;

    try {
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
        return $stmt->execute([$token, $expiry, $email]);
    } catch (PDOException $e) {
        error_log("Failed to create password reset token: " . $e->getMessage());
        return false;
    }
}

function validateResetToken($token) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()");
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Failed to validate reset token: " . $e->getMessage());
        return false;
    }
}

function updatePassword($userId, $newPassword) {
    global $pdo;
    try {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password_hash = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?");
        return $stmt->execute([$hash, $userId]);
    } catch (PDOException $e) {
        error_log("Failed to update password: " . $e->getMessage());
        return false;
    }
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
        try {
            $lastAttempt = new DateTime($user['last_failed_attempt']);
        } catch (Exception $e) {
            return true; // If date invalid, assume locked
        }
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
        $stmt = $pdo->query(
            "SELECT travel_logs.*, users.username FROM travel_logs JOIN users ON travel_logs.user_id = users.id ORDER BY created_at DESC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching travel logs: " . $e->getMessage());
        return [];
    }
}

// Create a new travel log
function createTravelLog($pdo, $user_id, $title, $content, $image_path = null) {
    try {
        $stmt = $pdo->prepare("INSERT INTO travel_logs (user_id, title, content, image_path) VALUES (:user_id, :title, :content, :image_path)");
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

// Get simple site-wide counts (trips, users, travel logs)
function getSiteCounts() {
    global $pdo;
    try {
        $counts = [];
        $stmt = $pdo->query("SELECT COUNT(*) as c FROM trips");
        $counts['trips'] = (int) $stmt->fetchColumn();

        $stmt = $pdo->query("SELECT COUNT(*) as c FROM users");
        $counts['users'] = (int) $stmt->fetchColumn();

        $stmt = $pdo->query("SELECT COUNT(*) as c FROM travel_logs");
        $counts['travel_logs'] = (int) $stmt->fetchColumn();

        return $counts;
    } catch (PDOException $e) {
        error_log("Failed to fetch site counts: " . $e->getMessage());
        return ['trips' => 0, 'users' => 0, 'travel_logs' => 0];
    }
}

// Get upcoming/planned trips for a user
function getUserPlannedTrips($userId, $limit = 10) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT ut.*, t.title, t.image_url, t.activity_type, t.duration_hours, t.price
            FROM usertrips ut
            LEFT JOIN trips t ON ut.trip_id = t.id
            WHERE ut.user_id = ?
            ORDER BY ut.created_at DESC
            LIMIT ?");
        $stmt->execute([$userId, (int)$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Failed to fetch user planned trips: " . $e->getMessage());
        return [];
    }
}

// Get recent travel logs (with username)
function getRecentTravelLogs($limit = 5) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT travel_logs.*, users.username FROM travel_logs JOIN users ON travel_logs.user_id = users.id ORDER BY travel_logs.created_at DESC LIMIT ?");
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Failed to fetch recent travel logs: " . $e->getMessage());
        return [];
    }
}

/**
 * Get flights to a destination country.
 *
 * Expected `flights` table (best-effort):
 * id, airline, flight_number, from_airport, to_country, to_city,
 * departure_datetime, arrival_datetime, available_seats, price
 */
function getFlightsByCountry($country, $limit = 50) {
    global $pdo;
    try {
        $sql = "SELECT id, airline, flight_number, from_airport, to_country, to_city, departure_datetime, arrival_datetime, available_seats, price
                FROM flights WHERE to_country = ? ORDER BY departure_datetime ASC LIMIT ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $country);
        $stmt->bindValue(2, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // If the flights table doesn't exist or another error occurs, log and return empty array
        error_log("getFlightsByCountry failed: " . $e->getMessage());
        return [];
    }
}

function getFlightById($flightId) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM flights WHERE id = ? LIMIT 1");
        $stmt->execute([$flightId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("getFlightById failed: " . $e->getMessage());
        return false;
    }
}

?>
