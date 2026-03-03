<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['name']) && isset($_SESSION['email'])) {
    header("Location: dashboard.php");
    exit();
}

$name = $email = "";
$nameErr = $emailErr = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;
    
    // Validate Name - must not be empty
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $valid = false;
    } else {
        $name = trim($_POST["name"]);
    }
    
    // Validate Email - must not be empty
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $valid = false;
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $valid = false;
        }
    }
    
    if ($valid) {
        // Store data in session
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        
        // Store name in cookie
        setcookie('user_name', $name, time() + (86400 * 30), '/'); // 30 days
        
        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    }
}

if (isset($_GET['logged_out'])) {
    $message = "You have been logged out.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login Form</h2>
        
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                <span class="error"><?php echo $nameErr; ?></span>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <span class="error"><?php echo $emailErr; ?></span>
            </div>
            
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>