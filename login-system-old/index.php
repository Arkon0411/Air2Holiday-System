<?php
session_start();
require_once __DIR__ . '/includes/functions.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success']) . '</div>';
    unset($_SESSION['success']); // Clear the success message after displaying it
}

$error = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'invalid_credentials':
            $error = 'Invalid username/email or password.';
            break;
        case 'account_locked':
            $error = 'Account locked due to too many failed attempts. Try again later.';
            break;
        case 'login_required':
            $error = 'Please login to access that page.';
            break;
        default:
            $error = 'An error occurred during login.';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ancizar+Serif:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <style>
         .login-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 1.5rem;
            background-color: #eccbb6;
            border-radius: 1rem;
            padding-left: 4rem;
            padding-right: 4rem;
        }
        .login-logo {
            width: 200px;
            height: 200px;
            object-fit: contain;
            margin-bottom: 0.5rem;
        }
        .login-title {
            font-size: 1.8rem;
            font-weight: bold;
            margin: 0;
            background-color: white;
            padding:0.25em;
            padding-left: 1rem;
            padding-right: 1rem;
            border-radius: 0.75rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-brand">
                <img src="assets/img/compass-logo-brown.png" alt="Compass Logo" class="login-logo">
                <h1 class="login-title">Compass</h1>
            </div>
            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form id="loginForm" action="process-login.php" method="POST">
                <div class="form-group">
                    <label for="identifier">Username or Email</label>
                    <input type="text" id="identifier" name="identifier" required aria-required="true">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-input">
                        <input type="password" id="password" name="password" required aria-required="true">
                        <button type="button" id="togglePassword" class="password-toggle" aria-label="Show password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="form-actions">
                        <button type="submit" class="btn">Login</button>
                        <a href="forgot-password.php" class="forgot-password">Forgot Password?</a>
                </div>

                <div class="form-actions">
                    <div style="text-align: center; width: 100%;background-color: var(--secondary-color);
                    color: var(--white);
                    border: none;
                    padding: 0.25rem 0.25rem;
                    border-radius: 4px;
                    cursor: pointer;
                    font-size: 1rem;
                    transition: background-color 0.3s;">
                        <a href="register.php" class="forgot-password">No Account? Register Now</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>