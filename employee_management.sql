-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2025 at 06:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees_tbl`
--

CREATE TABLE `employees_tbl` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `emp_fullname` varchar(100) NOT NULL,
  `emp_fathername` varchar(100) NOT NULL,
  `emp_address` text NOT NULL,
  `emp_phone` bigint(10) NOT NULL,
  `emp_email` varchar(100) NOT NULL,
  `emp_aadhar_card` bigint(16) NOT NULL,
  `emp_pan_card` varchar(10) NOT NULL,
  `emp_photo` varchar(255) NOT NULL,
  `emp_date_of_birth` date DEFAULT NULL,
  `emp_gender` varchar(10) DEFAULT NULL,
  `emp_department` varchar(255) DEFAULT NULL,
  `emp_designation` varchar(255) DEFAULT NULL,
  `emp_date_of_joining` date DEFAULT NULL,
  `emp_office_exit_date` date DEFAULT NULL,
  `emp_basic_salary` decimal(10,2) DEFAULT NULL,
  `emp_acc_holder_name` varchar(255) DEFAULT NULL,
  `emp_acc_num` varchar(20) DEFAULT NULL,
  `emp_bank_detail` text DEFAULT NULL,
  `emp_ifsc_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees_tbl`
--

INSERT INTO `employees_tbl` (`id`, `emp_id`, `emp_fullname`, `emp_fathername`, `emp_address`, `emp_phone`, `emp_email`, `emp_aadhar_card`, `emp_pan_card`, `emp_photo`, `emp_date_of_birth`, `emp_gender`, `emp_department`, `emp_designation`, `emp_date_of_joining`, `emp_office_exit_date`, `emp_basic_salary`, `emp_acc_holder_name`, `emp_acc_num`, `emp_bank_detail`, `emp_ifsc_code`) VALUES
(5, 34, 'Ashirvad Singh TOMARffgfdsgdfgdfgrf', 'Hello Ji', '1281 Near Mission Hospital Main road Faridpur Bareilly', 7817940937, 'ashirvad2912@gmail.com', 913399343558, 'OHUPS6680H', 'large-LC-Images_Shoulder OA-2 (1).jpg', '2004-12-28', 'Male', '', 'Web Developer', '2025-01-13', '2025-01-16', 5454.00, '', '', '', ''),
(9, 54, 'Ashirvad', 'Singh', '1281 Near Mission Hospital Main road Faridpur Bareilly', 7817940938, 'ashirvad2912879@gmail.com', 913399343559, 'OHUPS6690H', 'Lupus GB-EN (2).jpg', '2004-12-29', 'female', 'Designer', 'Graphics Designer', '2025-01-22', NULL, 8900.00, 'Ashirvad Singhsw', '4564565675678567879', '', 'SBIN0051019');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `employee_id`, `start_date`, `end_date`, `reason`, `status`) VALUES
(24, 54, '2025-01-22', '2025-01-29', 'Fever', 'pending'),
(25, 54, '2025-01-22', '2025-01-29', 'Fever', 'pending'),
(26, 34, '2025-01-29', '2025-02-26', 'fever', 'pending'),
(27, 34, '2025-01-29', '2025-02-26', 'fever', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','employee') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(2, 'admin', 'admin123', 'admin'),
(34, 'sakshama', 't%zrLePM9n50SF6rCPIap8t6', 'employee'),
(54, 'ram8790', '2912As#@', 'employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees_tbl`
--
ALTER TABLE `employees_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emp_phone` (`emp_phone`),
  ADD UNIQUE KEY `emp_aadhar_card` (`emp_aadhar_card`),
  ADD UNIQUE KEY `emp_email` (`emp_email`),
  ADD UNIQUE KEY `emp_pan_card` (`emp_pan_card`),
  ADD UNIQUE KEY `emp_acc_num` (`emp_acc_num`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees_tbl`
--
ALTER TABLE `employees_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
