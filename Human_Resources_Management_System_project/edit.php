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
$error = '';

// Fetch existing data
$stmt = $pdo->prepare("SELECT * FROM leave_transactions WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch();

// If record not found, redirect to dashboard
if (!$row) {
    header("Location: dashboard.php");
    exit();
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['employee_name']);
    $dept = trim($_POST['department']);
    $type = trim($_POST['leave_type']);
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];
    $status = $_POST['status'];

    // Input Validation
    if (empty($name) || empty($dept) || empty($type) || empty($start) || empty($end)) {
        $error = "All fields are required.";
    } elseif ($start > $end) {
        $error = "End date must be after start date.";
    } else {
        // Update using Prepared Statement
        $stmt = $pdo->prepare("UPDATE leave_transactions SET employee_name=?, department=?, leave_type=?, start_date=?, end_date=?, status=? WHERE id=?");
        if ($stmt->execute([$name, $dept, $type, $start, $end, $status, $id])) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Update failed. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit - HRMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">HRMS - Leave Management</a>
            <div class="navbar-nav ms-auto">
                <span class="nav-item nav-link text-white">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Edit Leave Request</h4>
            </div>
            <div class="card-body">
                <a href="dashboard.php" class="btn btn-secondary mb-3">← Back to Dashboard</a>
                
                <?php if($error): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="employee_name" class="form-label">Employee Name</label>
                        <input type="text" class="form-control" id="employee_name" name="employee_name" 
                               value="<?php echo htmlspecialchars($row['employee_name']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" class="form-control" id="department" name="department" 
                               value="<?php echo htmlspecialchars($row['department']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="leave_type" class="form-label">Leave Type</label>
                        <select class="form-select" id="leave_type" name="leave_type" required>
                            <option value="Sick Leave" <?php if($row['leave_type']=='Sick Leave') echo 'selected'; ?>>Sick Leave</option>
                            <option value="Casual Leave" <?php if($row['leave_type']=='Casual Leave') echo 'selected'; ?>>Casual Leave</option>
                            <option value="Annual Leave" <?php if($row['leave_type']=='Annual Leave') echo 'selected'; ?>>Annual Leave</option>
                        </select>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" 
                                   value="<?php echo htmlspecialchars($row['start_date']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" 
                                   value="<?php echo htmlspecialchars($row['end_date']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Pending" <?php if($row['status']=='Pending') echo 'selected'; ?>>Pending</option>
                            <option value="Approved" <?php if($row['status']=='Approved') echo 'selected'; ?>>Approved</option>
                            <option value="Rejected" <?php if($row['status']=='Rejected') echo 'selected'; ?>>Rejected</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-warning">Update Record</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>