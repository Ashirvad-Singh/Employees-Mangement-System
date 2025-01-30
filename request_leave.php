<?php
session_start();
include 'config.php';

if ($_SESSION['role'] != 'employee') {
    header("Location: login.php");
    exit();
}

$emp_id = $_SESSION['user_id'];

$employee = $conn->query("SELECT * FROM employees_tbl WHERE emp_id = '$emp_id'")->fetch_assoc();

if (!$employee) {
    echo "Employee not found.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = $_POST['reason'];

 
    if (strtotime($start_date) > strtotime($end_date)) {
        echo "Start date cannot be later than end date.";
        exit();
    }

    $query = "INSERT INTO leave_requests (employee_id, start_date, end_date, reason, status) 
              VALUES ('$emp_id', '$start_date', '$end_date', '$reason', 'pending')";

    if ($conn->query($query) === TRUE) {
        header("Location: employee_dashboard.php?message=Leave request submitted successfully.");
        exit();
    } else {
        echo "Error submitting leave request: " . $conn->error;
    }
}
?>
