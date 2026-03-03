<?php
session_start();

if (!isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    header("Location: form.php");
    exit();
}

$name = $_SESSION['name'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Dashboard</h2>
        
        <div class="protected">
            PROTECTED PAGE - Authorized Access Only
        </div>
        
        <div class="info">
            <h4>Session Data:</h4>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Session ID:</strong> <?php echo session_id(); ?></p>
        </div>
        
        <div class="actions">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
</body>
</html>