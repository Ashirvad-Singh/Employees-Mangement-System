<?php
session_start();
include 'config.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['emp_id'])) {
    $emp_id = $_GET['emp_id'];
    
    $query = "SELECT * FROM employees_tbl WHERE emp_id = '$emp_id'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    } else {
        echo "Employee not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emp_fullname = $_POST['emp_fullname'];
    $emp_fathername = $_POST['emp_fathername'];
    $emp_address = $_POST['emp_address'];
    $emp_phone = $_POST['emp_phone'];
    $emp_email = $_POST['emp_email'];
    $emp_aadhar_card = $_POST['emp_aadhar_card'];
    $emp_pan_card = $_POST['emp_pan_card'];
    $emp_date_of_birth = $_POST['emp_date_of_birth'];
    $emp_gender = $_POST['emp_gender'];
    $emp_department = $_POST['emp_department'];
    $emp_designation = $_POST['emp_designation'];
    $emp_date_of_joining = $_POST['emp_date_of_joining'];
    $emp_office_exit_date = $_POST['emp_office_exit_date'];
    $emp_basic_salary = $_POST['emp_basic_salary'];
    $emp_acc_holder_name = $_POST['emp_acc_holder_name'];
    $emp_acc_num = $_POST['emp_acc_num'];
    $emp_bank_detail = $_POST['emp_bank_detail'];
    $emp_ifsc_code = $_POST['emp_ifsc_code'];

    $emp_photo = $_FILES['emp_photo']['name'];
    if ($emp_photo != "") {
        $photo_tmp = $_FILES['emp_photo']['tmp_name'];
        $photo_folder = 'uploads/' . $emp_photo;

        if (move_uploaded_file($photo_tmp, $photo_folder)) {
            $photo_query = ", emp_photo = '$emp_photo'";
        } else {
            echo "Failed to upload the photo.";
            exit();
        }
    } else {
        $photo_query = "";
    }


    $update_query = "UPDATE employees_tbl SET 
        emp_fullname = '$emp_fullname',
        emp_fathername = '$emp_fathername',
        emp_address = '$emp_address',
        emp_phone = '$emp_phone',
        emp_email = '$emp_email',
        emp_aadhar_card = '$emp_aadhar_card',
        emp_pan_card = '$emp_pan_card',
        emp_date_of_birth = '$emp_date_of_birth',
        emp_gender = '$emp_gender',
        emp_department = '$emp_department',
        emp_designation = '$emp_designation',
        emp_date_of_joining = '$emp_date_of_joining',
        emp_office_exit_date = '$emp_office_exit_date',
        emp_basic_salary = '$emp_basic_salary',
        emp_acc_holder_name = '$emp_acc_holder_name',
        emp_acc_num = '$emp_acc_num',
        emp_bank_detail = '$emp_bank_detail',
        emp_ifsc_code = '$emp_ifsc_code'
        $photo_query
        WHERE emp_id = '$emp_id'";


    if ($conn->query($update_query)) {
        echo "Employee updated successfully."; 
        header("Location: manage_employees.php");
        exit();
    } else {
        echo "Error: " . $conn->error; 
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Edit Employee</title>
</head>
<body class="bg-gray-100 min-h-screen">

<!-- Navbar -->
<nav class="bg-blue-600 p-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <a href="admin_dashboard.php" class="text-white text-2xl font-semibold">Admin Dashboard</a>
        <div class="space-x-4">
            <a href="admin_dashboard.php" class="text-white hover:text-blue-200">Dashboard</a>
            <a href="create_employee.php" class="text-white hover:text-blue-200">Create Employee</a>
            <a href="manage_employees.php" class="text-white hover:text-blue-200">Manage Employees</a>
            <a href="request_leave.php" class="text-white hover:text-blue-200">Leave Requests</a>
            <a href="logout.php" class="text-white hover:text-blue-200">Logout</a>
        </div>
    </div>
</nav>

<div class="p-6 max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold text-blue-600 mb-6">Edit Employee</h1>
    <form action="edit_employee.php?emp_id=<?= $employee['emp_id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label for="emp_fullname" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="emp_fullname" value="<?= $employee['emp_fullname'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
            </div>
            <div>
                <label for="emp_fathername" class="block text-sm font-medium text-gray-700">Father's Name</label>
                <input type="text" name="emp_fathername" value="<?= $employee['emp_fathername'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
            </div>
            <div>
                <label for="emp_address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="emp_address" value="<?= $employee['emp_address'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
            </div>
            <div>
                <label for="emp_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="emp_phone" value="<?= $employee['emp_phone'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
            </div>
            <div>
                <label for="emp_email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="emp_email" value="<?= $employee['emp_email'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
            </div>
            <div>
                <label for="emp_aadhar_card" class="block text-sm font-medium text-gray-700">Aadhar Card</label>
                <input type="text" name="emp_aadhar_card" value="<?= $employee['emp_aadhar_card'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
            </div>
            <div>
                <label for="emp_pan_card" class="block text-sm font-medium text-gray-700">PAN Card</label>
                <input type="text" name="emp_pan_card" value="<?= $employee['emp_pan_card'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
            </div>
            <div>
                <label for="emp_basic_salary" class="block text-sm font-medium text-gray-700">Salary</label>
                <input type="number" name="emp_basic_salary" value="<?= $employee['emp_basic_salary'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
            </div>
            <div>
                <label for="emp_designation" class="block text-sm font-medium text-gray-700">Designation</label>
                <input type="text" name="emp_designation" value="<?= $employee['emp_designation'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
            </div>
            <div>
                <label for="emp_gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="emp_gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                    <option value="Male" <?= $employee['emp_gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $employee['emp_gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= $employee['emp_gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                </select>
            </div>
            <div>
                <label for="emp_date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="emp_date_of_birth" value="<?= $employee['emp_date_of_birth'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div>
                <label for="emp_date_of_joining" class="block text-sm font-medium text-gray-700">Date of Joining</label>
                <input type="date" name="emp_date_of_joining" value="<?= $employee['emp_date_of_joining'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div>
                <label for="emp_office_exit_date" class="block text-sm font-medium text-gray-700">Exit Date</label>
                <input type="date" name="emp_office_exit_date" value="<?= $employee['emp_office_exit_date'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div>
                <label for="emp_photo" class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="emp_photo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                <img src="uploads/<?= $employee['emp_photo'] ?>" alt="Employee Photo" class="mt-2 w-32 h-32 object-cover">
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg">Update Employee</button>
        </div>
    </form>
</div>

</body>
</html>
