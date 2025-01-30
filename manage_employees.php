<?php
session_start();
include 'config.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$employees = $conn->query("SELECT * FROM employees_tbl");
?>
<?php require('header.php');?>
    <title>Manage Employees</title>

    <div class="p-6 max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-blue-600 mb-6 text-center">Manage Employees</h1>
        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-4 text-left">Name</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Phone</th>
                    <th class="p-4 text-left">Role</th>
                    <th class="p-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($employee = $employees->fetch_assoc()) { ?>
                    <tr>
                        <td class="p-4"><?= $employee['emp_fullname'] ?></td>
                        <td class="p-4"><?= $employee['emp_email'] ?></td>
                        <td class="p-4"><?= $employee['emp_phone'] ?></td>
                        <td class="p-4"><?= $employee['emp_designation'] ?></td>
                        <td class="p-4">
                            <a href="edit_employee.php?emp_id=<?= $employee['emp_id'] ?>" class="text-blue-600" onclick="return confirm('Are you really Want to Edit?')">Edit</a> | 
                            <a href="delete_employee.php?emp_id=<?= $employee['emp_id'] ?>" class="text-red-600" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
