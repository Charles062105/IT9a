<?php
require_once 'config.php';

if (isset($_POST['submit'])) {
    $borrower_name = $_POST['borrower_name'];
    $book_title = $_POST['book_title'];
    $date_borrowed = $_POST['date_borrowed'];
    $due_date = $_POST['due_date'];
    
    $sql = "INSERT INTO borrow_transactions (borrower_name, book_title, date_borrowed, due_date) VALUES (:borrower_name, :book_title, :date_borrowed, :due_date)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':borrower_name', $borrower_name);
    $stmt->bindParam(':book_title', $book_title);
    $stmt->bindParam(':date_borrowed', $date_borrowed);
    $stmt->bindParam(':due_date', $due_date);
    
    if ($stmt->execute()) {
        header("Location: index.php?message=Transaction added successfully!");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Transaction</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add New Transaction</h1>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="borrower_name">Borrower Name</label>
                <input type="text" id="borrower_name" name="borrower_name" required>
            </div>
            
            <div class="form-group">
                <label for="book_title">Book Title</label>
                <input type="text" id="book_title" name="book_title" required>
            </div>
            
            <div class="form-group">
                <label for="date_borrowed">Date Borrowed</label>
                <input type="date" id="date_borrowed" name="date_borrowed" required>
            </div>
            
            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" id="due_date" name="due_date" required>
            </div>
            
            <div class="btn-group">
                <button type="submit" name="submit" class="btn">Save Transaction</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
