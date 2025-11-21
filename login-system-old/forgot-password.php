<?php
session_start();
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/vendor/autoload.php'; // Load Composer autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    
    // Validate email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: forgot-password.php?error=invalid_email");
        exit();
    }
    
    // Check if email exists
    $user = getUserByEmail($email);
    if (!$user) {
        header("Location: forgot-password.php?error=email_not_found");
        exit();
    }
    
    // Generate token
    $token = bin2hex(random_bytes(32));
    $expiry = date('Y-m-d H:i:s', strtotime('+24 hour'));
    
    // Store token in database
    if (!storeResetToken($user['id'], $token, $expiry)) {
        header("Location: forgot-password.php?error=token_error");
        exit();
    }
    
    // Send email with PHPMailer
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'emieljane121@gmail.com'; // SMTP username
        $mail->Password   = 'hixt vawt ulzj bbdu'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        // Recipients
        $mail->setFrom('no-reply@yourdomain.com', 'Compass App');
        $mail->addAddress($email, $user['username']);
        
        // Content
        $resetLink = "http://localhost/login-system/reset-password.php?token=$token";
        
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $mail->Body    = "
            <h2>Password Reset</h2>
            <p>Hello {$user['username']},</p>
            <p>You requested a password reset. Click the link below to reset your password:</p>
            <p><a href=\"$resetLink\">Reset Password</a></p>
            <p>This link will expire in 1 hour.</p>
            <p>If you didn't request this, please ignore this email.</p>
        ";
        $mail->AltBody = "Password Reset Link: $resetLink (expires in 1 hour)";
        
        $mail->send();
        header("Location: forgot-password.php?success=1");
        exit();
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        header("Location: forgot-password.php?error=mail_error");
        exit();
    }
}

// Error handling
$error = '';
if (isset($_GET['error'])) {
    $error = match($_GET['error']) {
        'invalid_email' => 'Please enter a valid email address',
        'email_not_found' => 'Email address not found',
        'token_error' => 'Error generating reset token',
        'mail_error' => 'Error sending reset email',
        default => 'An error occurred'
    };
}

$success = isset($_GET['success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ancizar+Serif:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <style>
        /* Override styles to remove gaps */
        body {
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('assets/img/travel.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .login-container {
            width: 100%;
            max-width: 100%;
            padding: 20px;
            margin: 0;
        }
        
        .login-box {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            padding: 2rem;
            box-sizing: border-box;
        }
        
        form {
            width: 100%;
            margin: 0;
            padding: 0;
        }
        
        .form-group {
            width: 100%;
            margin-bottom: 1.5rem;
        }
        
        .form-group input {
            width: 100%;
            box-sizing: border-box;
        }
        
        .form-actions {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 2rem;
            width: 100%;
        }
        
        .btn {
            flex: 1;
            min-width: 0;
        }
        
        .forgot-password {
            flex: 1;
            text-align: center;
            min-width: 0;
        }
        
        @media (max-width: 480px) {
            .login-box {
                padding: 1.5rem;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 1rem;
            }
            
            .btn, .forgot-password {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">  
            <?php if ($error): ?>
                <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success">
                    Password reset link has been sent to your email if it exists in our system.
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn">Reset Password</button>
                    <a href="index.php" class="forgot-password">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>