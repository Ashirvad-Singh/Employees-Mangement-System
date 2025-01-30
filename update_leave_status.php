<?php
session_start();
include 'config.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['action'])) {
    $leave_id = $_GET['id']; 
    $action = $_GET['action'];

    if ($action != 'approve' && $action != 'reject') {
        echo "Invalid action.";
        exit();
    }


    $new_status = ($action == 'approve') ? 'approved' : 'rejected';


    $update_leave_query = "UPDATE leave_requests SET status = '$new_status' WHERE id = '$leave_id'";

   
    if ($conn->query($update_leave_query)) {
        header("Location: leave_requests.php?message=Leave request $new_status successfully.");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Missing leave request ID or action.";
}
?>
