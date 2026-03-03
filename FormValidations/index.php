<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>HRMS Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Human Resource Management System</h2>
        
        <?php if(isset($_SESSION['name'])): ?>
            <p>Welcome, <?php echo $_SESSION['name']; ?>!</p>
            <a href="dashboard.php">Go to Dashboard</a> |
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <p>Please login or register</p>
            <a href="login.php">Login</a> |
            <a href="signup.php">Register</a>
        <?php endif; ?>
    </div>
</body>
</html>