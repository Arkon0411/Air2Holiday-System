<?php
session_start();
require_once __DIR__ . '/includes/functions.php';

$errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        
        // Validation
        if (empty($username)) {
            $errors['username'] = '<div class="alert alert-error">Username is required</div>';
        } elseif (strlen($username) < 3) {
            $errors['username'] = 'Username must be at least 3 characters';
        }
        
        if (empty($email)) {
            $errors['email'] = 'Email is required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = '<div class="alert alert-error">Please enter a valid email</div>';
        }
        
        if (empty($password)) {
            $errors['password'] = 'Password is required';
        } elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/', $password)) {
            $errors['password'] = 'Password must be at least 8 characters with a number, uppercase letter, and special character';
        }
        
        // Check if email exists
        if (empty($errors['email'])) {
            $existingUser = getUserByEmail($email);
            if ($existingUser) {
                $errors['email'] = 'Email already registered';
            }
        }
        
        // Check if username exists
        if (empty($errors['username'])) {
            $existingUser = getUserByUsername($username);
            if ($existingUser) {
                $errors['username'] = 'Username already taken';
            }
        }
        
        // Create account if no errors
        if (empty($errors)) {
            if (registerUser($username, $email, $password)) {
                $_SESSION['success'] = 'Registration successful! You can now log in.';
                header("Location: index.php");
                exit();
            } else {
                $errors['database'] = 'Registration failed. Please try again.';
            }
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Compass</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            <h1><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Create Account</h1>
            
            <?php if (!empty($errors['database'])): ?>
                <div class="alert alert-error"><?= htmlspecialchars($errors['database']) ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div style="background-color: antiquewhite; padding: 1rem; border-radius: 1rem;">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" 
                           value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
                    <?php if (!empty($errors['username'])): ?>
                        <span class="error-message"; style="color: red;"><?= htmlspecialchars($errors['username']) ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" 
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                    <?php if (!empty($errors['email'])): ?>
                        <span class="error-message"; style="color: red;"><?= htmlspecialchars($errors['email']) ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-input">
                        <input type="password" id="password" name="password" required>
                        <button type="button" class="password-toggle" aria-label="Show password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <?php if (!empty($errors['password'])): ?>
                        <span class="error-message"; style="color: red;"><?= htmlspecialchars($errors['password']) ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-actions">
                    <div style="text-align: center; width: 100%;">
                    <button type="submit" class="btn">Register</button>
                    </div>
                </div>
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
                        <a href="index.php" class="forgot-password">Already have an account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>