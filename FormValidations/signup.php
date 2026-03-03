<?php
session_start();
include 'users.php';

$name = $email = "";
$nameErr = $emailErr = $passErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation 1: Name required
    if(empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = $_POST["name"];
    }
    
    // Validation 2: Email required & valid format
    if(empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    
    // Validation 3: Password required & minimum length
    if(empty($_POST["password"])) {
        $passErr = "Password is required";
    } elseif(strlen($_POST["password"]) < 6) {
        $passErr = "Password must be at least 6 characters";
    }
    
    // If no errors, save user
    if(empty($nameErr) && empty($emailErr) && empty($passErr)) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        
        if(saveUser($name, $email, $password)) {
            // Set cookie
            setcookie("user_email", $email, time() + 86400, "/");
            
            header("Location: login.php?success=registered");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $name; ?>">
                <span class="error"><?php echo $nameErr; ?></span>
            </div>
            
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
            
            <button type="submit">Register</button>
        </form>
        
        <p>Already have account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>