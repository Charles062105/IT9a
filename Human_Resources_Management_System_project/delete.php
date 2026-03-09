<?php
session_start();
require 'config.php';

// Security Check: Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get ID from URL
$id = $_GET['id'] ?? null;

// Validate ID is an integer
if (!is_numeric($id)) {
    header("Location: dashboard.php");
    exit();
}

// Delete Record
$stmt = $pdo->prepare("DELETE FROM leave_transactions WHERE id = ?");
if ($stmt->execute([$id])) {
    // Redirect back to dashboard
    header("Location: dashboard.php");
    exit();
} else {
    // Handle error
    echo "Error deleting record. <a href='dashboard.php'>Go Back</a>";
}
?>