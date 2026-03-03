<?php
session_start();
include 'users.php';

$email = "";
$emailErr = $passErr = $loginErr = "";

// Check for cookie
if(isset($_COOKIE['user_email'])) {
    $email = $_COOKIE['user_email'];
}

// Check GET parameters
if(isset($_GET['success'])) {
    $loginErr = "Registration successful! Please login.";
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if(empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
    }
    
    // Validate password
    if(empty($_POST["password"])) {
        $passErr = "Password is required";
    }
    
    if(empty($emailErr) && empty($passErr)) {
        $user = authenticateUser($_POST["email"], $_POST["password"]);
        
        if($user) {
            // Set session
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            
            // Set remember me cookie
            if(isset($_POST['remember'])) {
                setcookie("user_email", $user['email'], time() + 86400, "/");
            }
            
            // Set last visit cookie
            setcookie("last_visit", date("Y-m-d H:i:s"), time() + 86400, "/");
            
            header("Location: dashboard.php");
            exit();
        } else {
            $loginErr = "Invalid email or password";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        
        <?php if($loginErr): ?>
            <div class="message"><?php echo $loginErr; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $email; ?>">
                <span class="error"><?php echo $emailErr; ?></span>
            </div>
            
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password">
                <span class="error"><?php echo $passErr; ?></span>
            </div>
            
            <div class="form-group">
                <input type="checkbox" name="remember"> Remember Me
            </div>
            
            <button type="submit">Login</button>
        </form>
        
        <p>No account? <a href="signup.php">Register here</a></p>
    </div>
</body>
</html>