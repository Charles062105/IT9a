<?php
session_start();

// Functions
function calcSubtotal($p, $q) {
    return $p * $q;
}

function calcDiscount($s, $q) {
    return ($q > 10) ? $s * 0.05 : 0;
}

function calcTax($a) {
    return $a * 0.12;
}

function calcFinal($s, $d, $t) {
    return ($s - $d) + $t;
}

function formatNumber($a) {
    return number_format($a, 2);
}

// Update session (works in background)
$_SESSION['last_transaction'] = date('H:i:s');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transaction Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Transaction Result</h2>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $item = $_POST['item_name'];
            $price = $_POST['price'];
            $qty = $_POST['quantity'];
            
            // Calculate
            $subtotal = calcSubtotal($price, $qty);
            $discount = calcDiscount($subtotal, $qty);
            $tax = calcTax($subtotal - $discount);
            $final = calcFinal($subtotal, $discount, $tax);
            
            // Built-in functions
            $item_upper = strtoupper($item);
        ?>
        
        <div class="result">
            <p><strong>Item:</strong> <?php echo $item; ?> (<?php echo $item_upper; ?>)</p>
            <p><strong>Price:</strong> <?php echo $price; ?> x <?php echo $qty; ?></p>
            <p><strong>Subtotal:</strong> <?php echo formatNumber($subtotal); ?></p>
            <p><strong>Discount:</strong> -<?php echo formatNumber($discount); ?></p>
            <p><strong>Tax:</strong> +<?php echo formatNumber($tax); ?></p>
            <p class="total"><strong>FINAL:</strong> <?php echo formatNumber($final); ?></p>
        </div>
        
        <div class="links">
            <a href="index.php" class="btn">New Transaction</a>
        </div>
        
        <?php
        } else {
            echo "<p>No data received.</p>";
            echo "<a href='index.php' class='btn'>Go Back</a>";
        }
        ?>
    </div>
</body>
</html>