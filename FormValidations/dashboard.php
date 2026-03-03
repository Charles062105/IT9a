<?php
session_start();

if(!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Dashboard</h2>
        
        <div class="protected">
            PROTECTED PAGE - HRMS ACCESS ONLY
        </div>
        
        <div class="info">
            <h3>Welcome, <?php echo $_SESSION['name']; ?>!</h3>
            <p>You are logged in as: <?php echo $_SESSION['email']; ?></p>
        </div>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>