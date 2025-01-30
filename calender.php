<?php
session_start();
include 'config.php';

if ($_SESSION['role'] != 'employee') {
    header("Location: login.php");
    exit();
}
