<?php
require 'functions.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Transaction</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Add Transaction</h2>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="notification" style="background: #fed7d7; border-left-color: #f56565;">
                <div class="notification-title" style="color: #c53030;">Error!</div>
                Invalid input. Price and Quantity cannot be negative.
            </div>
        <?php endif; ?>

        <!-- Permission Request Bar -->
        <div id="permissionBar" class="permission-bar warning">
            <div class="permission-header">
                <span class="permission-icon">⚠️</span>
                <span class="permission-title">Permission Request</span>
            </div>
            <div class="permission-message" id="permissionMessage">
                You entered a negative value. Do you want to allow negative numbers?
            </div>
            <div class="permission-actions">
                <button class="permission-btn" onclick="denyNegative()">Block</button>
                <button class="permission-btn primary" onclick="allowNegative()">Allow</button>
            </div>
        </div>

        <form method="post" action="create.php" id="transactionForm">
            <div class="form-group">
                <label>Item:</label>
                <input type="text" name="item" required>
            </div>
            
            <div class="form-group">
                <label>Price:</label>
                <input type="number" name="price" id="price" required step="0.01" onchange="checkNegative(this)">
            </div>
            
            <div class="form-group">
                <label>Quantity:</label>
                <input type="number" name="qty" id="qty" required onchange="checkNegative(this)">
            </div>
            
            <button type="submit" class="btn btn-primary">Save Transaction</button>
        </form>
        
        <div class="links">
            <a href="read.php" class="btn btn-secondary">View Transactions</a>
        </div>
    </div>

    <script>
    let negativeAllowed = false;
    let lastNegativeField = null;

    function checkNegative(input) {
        if (parseFloat(input.value) < 0 && !negativeAllowed) {
            lastNegativeField = input;
            document.getElementById('permissionBar').classList.add('visible');
            document.getElementById('permissionMessage').textContent = 
                `You entered a negative value (${input.value}) in the ${input.name} field. Do you want to allow negative numbers?`;
            input.value = '';
        }
    }

    function allowNegative() {
        negativeAllowed = true;
        document.getElementById('permissionBar').classList.remove('visible');
        if (lastNegativeField) {
            lastNegativeField.value = lastNegativeField.defaultValue;
        }
    }

    function denyNegative() {
        negativeAllowed = false;
        document.getElementById('permissionBar').classList.remove('visible');
        if (lastNegativeField) {
            lastNegativeField.value = '';
            lastNegativeField.focus();
        }
    }

    // Reset permission when form submits
    document.getElementById('transactionForm').onsubmit = function() {
        negativeAllowed = false;
    };
    </script>
</body>
</html>