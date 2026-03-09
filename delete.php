<?php
require 'db.php';
require 'functions.php';

$id = $_GET['id'];

// Security: Use prepared statement
$stmt = $pdo->prepare("DELETE FROM transactions WHERE id = :id");
$stmt->execute([':id' => $id]);

// Redirect using function
redirectPage("read.php");
?>