<?php
require_once __DIR__ . '/includes/functions.php';

$token = $_GET['token'] ?? '';
$user = validateResetToken($token);

if (!$user) {
    header("Location: index.php?error=invalid_token");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($newPassword !== $confirmPassword) {
        $error = "Passwords don't match";
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/', $newPassword)) {
        $error = "Password must be at least 8 characters and include a number, uppercase letter, and special character";
    } else {
        // Update password
        if (updatePassword($user['id'], $newPassword)) {
            clearResetToken($user['id']);
            $_SESSION['success'] = 'Reset password successful! You can now log in.';
            header("Location: index.php?reset_success=1");
            exit();
        } else {
            $error = "Password update failed";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            width: 100%;
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
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form action="process-reset.php" method="POST">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <div class="password-input">
                        <input type="password" id="new_password" name="new_password" required aria-required="true">
                        <button type="button" class="password-toggle" aria-label="Show password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <small>Password must be at least 8 characters and include a number, uppercase letter, and special character.</small>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="password-input">
                        <input type="password" id="confirm_password" name="confirm_password" required aria-required="true">
                        <button type="button" class="password-toggle" aria-label="Show password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>