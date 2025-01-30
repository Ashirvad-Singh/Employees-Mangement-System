<?php
session_start();
include 'config.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['emp_id'])) {
    $emp_id = $_GET['emp_id']; 

    $delete_employee_query = "DELETE FROM employees_tbl WHERE emp_id = '$emp_id'";

    if ($conn->query($delete_employee_query)) {
        header("Location: manage_employees.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Employee ID is missing.";
}
?>
