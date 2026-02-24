<?php
session_start();

// Simple cookie for visits (works in background)
if (!isset($_COOKIE['visit'])) {
    setcookie('visit', '1', time() + 86400, '/');
} else {
    $v = $_COOKIE['visit'] + 1;
    setcookie('visit', $v, time() + 86400, '/');
}

// Simple session (works in background)
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = 'User_' . rand(100, 999);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transaction Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Transaction Details</h2>
        
        <form action="process.php" method="POST">
            <div class="form-row">
                <span class="label">Item Name:</span>
                <input type="text" name="item_name" required>
            </div>
            
            <div class="form-row">
                <span class="label">Price:</span>
                <input type="number" name="price" step="0.01" required>
            </div>
            
            <div class="form-row">
                <span class="label">Quantity:</span>
                <input type="number" name="quantity" min="1" required>
            </div>
            
            <div class="form-row">
                <span class="label"></span>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>