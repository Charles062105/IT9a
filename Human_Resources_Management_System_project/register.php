<?php
session_start();
require 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $error = "Email already registered.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            if ($stmt->execute([$username, $email, $hashed_password])) {
                $success = "Registration successful! Please login.";
            } else {
                $error = "Registration failed.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - HRMS Leave Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <i class="bi bi-person-plus"></i>
                <h2>HRMS</h2>
                <p>Create New Account</p>
            </div>
            
            <div class="auth-body">
                <h3>Registration</h3>
                
                <?php if($error): ?>
                    <div class="auth-alert alert-danger">
                        <i class="bi bi-exclamation-circle"></i>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <?php if($success): ?>
                    <div class="auth-alert alert-success">
                        <i class="bi bi-check-circle"></i>
                        <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-person"></i>
                            Username
                        </label>
                        <input type="text" name="username" class="form-control" placeholder="Choose a username" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-envelope"></i>
                            Email Address
                        </label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-lock"></i>
                            Password
                        </label>
                        <input type="password" name="password" class="form-control" placeholder="Create a password (min. 6 characters)" required>
                        <small class="text-muted">Password must be at least 6 characters long</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-shield-lock"></i>
                            Confirm Password
                        </label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm your password" required>
                    </div>

                    <button type="submit" class="btn-auth">
                        <i class="bi bi-person-plus"></i>
                        Register
                    </button>
                </form>

                <div class="auth-links">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
