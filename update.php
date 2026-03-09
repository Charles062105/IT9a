<?php
require 'db.php';
require 'functions.php';

$id = $_GET['id'];

// Fetch existing record
$stmt = $pdo->prepare("SELECT * FROM transactions WHERE id = :id");
$stmt->execute([':id' => $id]);
$data = $stmt->fetch();

if (!$data) {
    redirectPage("read.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    // Validation
    if (!validateNumber($price) || !validateNumber($qty)) {
        $_SESSION['error'] = "Invalid input. Price and Quantity cannot be negative.";
        redirectPage("read.php");
    }

    // Recompute total
    $total = computeTotal($price, $qty);

    $sql = "UPDATE transactions 
            SET item=:item, price=:price, qty=:qty, total=:total
            WHERE id=:id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':item' => $item,
        ':price' => $price,
        ':qty' => $qty,
        ':total' => $total,
        ':id' => $id
    ]);

    $_SESSION['success'] = "Transaction updated successfully!";
    redirectPage("read.php");
}
?>