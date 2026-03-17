<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['employee_name']);
    $dept = trim($_POST['department']);
    $type = trim($_POST['leave_type']);
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];

    if (empty($name) || empty($dept) || empty($type) || empty($start) || empty($end)) {
        $error = "All fields are required.";
    } elseif ($start > $end) {
        $error = "End date must be after start date.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO leave_transactions (employee_name, department, leave_type, start_date, end_date) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $dept, $type, $start, $end])) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Failed to insert record.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create - HRMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">HRMS - Leave Management</a>
            <div class="navbar-nav ms-auto">
                <span class="nav-item nav-link text-white">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Add New Leave Request</h4>
            </div>
            <div class="card-body">
                <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>
                <?php if($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
                
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Employee Name</label>
                        <input type="text" name="employee_name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Department</label>
                        <input type="text" name="department" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Leave Type</label>
                        <select name="leave_type" class="form-select" required>
                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Casual Leave">Casual Leave</option>
                            <option value="Annual Leave">Annual Leave</option>
                        </select>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success">Save Record</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
