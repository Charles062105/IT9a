<?php
require 'db.php';
require 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    // STEP 7: Validation Rules
    if (!validateNumber($price) || !validateNumber($qty)) {
        redirectPage("index.php?error=1");
    }

    // STEP 2: Compute total using function
    $total = computeTotal($price, $qty);

    $sql = "INSERT INTO transactions (item, price, qty, total)
            VALUES (:item, :price, :qty, :total)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':item' => $item,
        ':price' => $price,
        ':qty' => $qty,
        ':total' => $total
    ]);

    // STEP 2: Redirect using function
    redirectPage("read.php");
}
?>