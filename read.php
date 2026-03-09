<?php
session_start();
require 'db.php';

// Fetch all records from the database
$stmt = $pdo->query("SELECT * FROM transactions ORDER BY id DESC");
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

$success = isset($_SESSION['success']) ? $_SESSION['success'] : '';
unset($_SESSION['success']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transaction List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container container-large">
        <h2>Transaction List</h2>
        
        <?php if ($success): ?>
            <div class="notification">
                <div class="notification-title">Success!</div>
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>
        
        <div class="links">
            <a href="index.php" class="btn btn-secondary">Add New Transaction</a>
        </div>
        
        <?php if (count($transactions) > 0): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $row): ?>
                        <tr>
                            <td>#<?= $row['id'] ?></td>
                            <td><strong><?= htmlspecialchars($row['item']) ?></strong></td>
                            <td>₱<?= number_format($row['price'], 2) ?></td>
                            <td><?= $row['qty'] ?></td>
                            <td><strong>₱<?= number_format($row['total'], 2) ?></strong></td>
                            <td class="action-links">
                                <button onclick="openEditModal(<?= $row['id'] ?>, '<?= htmlspecialchars($row['item']) ?>', <?= $row['price'] ?>, <?= $row['qty'] ?>)" class="btn-edit">Edit</button>
                                <a href="delete.php?id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this transaction?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <p>No transactions found. Add your first transaction!</p>
                <a href="index.php" class="btn btn-secondary">Add Transaction</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal-overlay">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Edit Transaction</h3>
                <button class="modal-close" onclick="closeEditModal()">×</button>
            </div>
            <div class="modal-body">
                <form id="editForm" class="edit-form" method="post" action="update.php">
                    <input type="hidden" name="id" id="editId">
                    
                    <div class="form-group">
                        <label for="editItem">Item Name:</label>
                        <input type="text" id="editItem" name="item" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="editPrice">Price (₱):</label>
                        <input type="number" id="editPrice" name="price" step="0.01" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="editQty">Quantity:</label>
                        <input type="number" id="editQty" name="qty" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="permission-btn" onclick="closeEditModal()">Cancel</button>
                <button class="permission-btn primary" onclick="submitEditForm()">Save Changes</button>
            </div>
        </div>
    </div>

    <script>
    function openEditModal(id, item, price, qty) {
        document.getElementById('editId').value = id;
        document.getElementById('editItem').value = item;
        document.getElementById('editPrice').value = price;
        document.getElementById('editQty').value = qty;
        document.getElementById('editModal').classList.add('visible');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.remove('visible');
    }

    function submitEditForm() {
        const form = document.getElementById('editForm');
        form.action = 'update.php?id=' + document.getElementById('editId').value;
        form.submit();
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if (event.target == modal) {
            closeEditModal();
        }
    }
    </script>
</body>
</html>