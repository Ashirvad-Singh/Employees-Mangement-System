<?php
session_start();
include 'config.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$errors = [];  


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
$emp_office_exit_date = isset($_POST['emp_office_exit_date']) && $_POST['emp_office_exit_date'] != '' ? $_POST['emp_office_exit_date'] : NULL;
$emp_basic_salary = $_POST['emp_basic_salary'];
$emp_acc_holder_name = $_POST['emp_acc_holder_name'];
$emp_acc_num = $_POST['emp_acc_num'];
$emp_bank_detail = $_POST['emp_bank_detail'];
$emp_ifsc_code = $_POST['emp_ifsc_code'];
$username = $_POST['username'];
$password = $_POST['password'];

$emp_photo = $_FILES['emp_photo']['name'];
if ($emp_photo != "") {
    $photo_tmp = $_FILES['emp_photo']['tmp_name'];
    $photo_folder = 'uploads/' . $emp_photo;
    if (move_uploaded_file($photo_tmp, $photo_folder)) {
    } else {
        $errors['emp_photo'] = "Failed to upload photo.";
    }
} else {
    $emp_photo = NULL;
}

$check_phone_query = "SELECT * FROM employees_tbl WHERE emp_phone = '$emp_phone'";
$check_phone_result = $conn->query($check_phone_query);
if ($check_phone_result->num_rows > 0) {
    $errors['emp_phone'] = "Error: The phone number '$emp_phone' is already registered.";
}

$check_email_query = "SELECT * FROM employees_tbl WHERE emp_email = '$emp_email'";
$check_email_result = $conn->query($check_email_query);
if ($check_email_result->num_rows > 0) {
    $errors['emp_email'] = "Error: The email '$emp_email' is already registered.";
}

$check_aadhar_query = "SELECT * FROM employees_tbl WHERE emp_aadhar_card = '$emp_aadhar_card'";
$check_aadhar_result = $conn->query($check_aadhar_query);
if ($check_aadhar_result->num_rows > 0) {
    $errors['emp_aadhar_card'] = "Error: The Aadhar card '$emp_aadhar_card' is already registered.";
}

if (!empty($errors)) {
    foreach ($errors as $field => $message) {
        echo "<p class='error'>$field: $message</p>";  
    }
}

$user_query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'employee')";
if ($conn->query($user_query)) {
    $emp_id = $conn->insert_id; 

    $employee_query = "INSERT INTO employees_tbl(
        emp_id,
        emp_fullname,
        emp_fathername,
        emp_address,
        emp_phone,
        emp_email,
        emp_aadhar_card,
        emp_pan_card,
        emp_photo,
        emp_date_of_birth,
        emp_gender,
        emp_department,
        emp_designation,
        emp_date_of_joining,
        emp_office_exit_date,
        emp_basic_salary,
        emp_acc_holder_name,
        emp_acc_num,
        emp_bank_detail,
        emp_ifsc_code
    ) VALUES (
        '$emp_id', '$emp_fullname', '$emp_fathername', '$emp_address', '$emp_phone', '$emp_email', '$emp_aadhar_card',
        '$emp_pan_card', '$emp_photo', '$emp_date_of_birth', '$emp_gender', '$emp_department', '$emp_designation',
        '$emp_date_of_joining', " . ($emp_office_exit_date ? "'$emp_office_exit_date'" : 'NULL') . ",
        '$emp_basic_salary', '$emp_acc_holder_name', '$emp_acc_num', '$emp_bank_detail', '$emp_ifsc_code'
    )";

    if ($conn->query($employee_query)) {
        header("Location: manage_employees.php");
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Error: " . $conn->error;
}

?>
