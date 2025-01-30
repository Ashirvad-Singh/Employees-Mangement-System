<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 p-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="#" class="text-white text-2xl font-semibold">Dashboard</a>
            <div class="space-x-4">
                <?php if ($role === 'admin') { ?>
                    <a href="admin_dashboard.php" class="text-white hover:text-blue-200">Dashboard</a>
                    <a href="create_employee.php" class="text-white hover:text-blue-200">Create Employee</a>
                    <a href="manage_employees.php" class="text-white hover:text-blue-200">Manage Employees</a>
                <?php } elseif ($role === 'employee') { ?>
                    <a href="employee_dashboard.php" class="text-white hover:text-blue-200">My Dashboard</a>
                    <a href="apply_leave.php" class="text-white hover:text-blue-200">Attendence</a>
                    
                <?php } ?>
                <a href="logout.php" class="text-white hover:text-blue-200">Logout</a>
            </div>
        </div>
    </nav>
</body>
</html>
