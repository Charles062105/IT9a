<?php
session_start();

// Destroy session
$_SESSION = array();
session_destroy();

// Remove cookie
setcookie('user_name', '', time() - 3600, '/');

// Redirect back to form.php
header("Location: form.php?logged_out=1");
exit();
?>