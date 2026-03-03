<?php
session_start();

// Destroy session
session_destroy();

// Clear cookies
setcookie("user_email", "", time() - 3600, "/");

// Redirect with GET parameter
header("Location: index.php?logout=success");
exit();
?>