-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 10, 2025 at 02:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



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

INSERT INTO `employees_tbl` (`id`, `emp_id`, `emp_fullname`, `emp_fathername`, `emp_address`, `emp_phone`, `emp_email`, `emp_aadhar_card`, `emp_pan_card`, `emp_photo`, `emp_date_of_birth`, `emp_gender`, `emp_department`, `emp_designation`, `emp_date_of_joining`, `emp_office_exit_date`, `emp_basic_salary`, `emp_acc_holder_name`, `emp_acc_num`, `emp_bank_detail`, `emp_ifsc_code`) VALUES
(1, 25, 'Ashirvad', 'Hello Ji', '1281 Near Mission Hospital Main road Faridpur Bareilly', 7817940937, 'ashirvad2912@gmail.com', 913399343558, 'OHUPS6680H', 'large-MDD B (4).jpg', '2025-01-15', 'male', 'Development', 'Web Developer', '2025-01-15', '2025-01-15', 546546.00, 'Ashirvad Singh', '4564565675678567878', 'hdfc', '4564564545645');

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
(2, 4, '2024-12-31', '2025-01-09', 'Fever', 'rejected');

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
(8, 'admin@gmail.com', '$2y$10$5MjE4us30zDm2/OVVLVC1.8PLnkQxa1d6maaA3NL008nudkIziTVG', 'employee'),
(10, 'sakshama', 't%zrLePM9n50SF6rCPIap8t6', 'employee'),
(11, 'ashirvad', '2912As#@', 'employee'),
(13, 'adminerter', '$2y$10$Qk1BaY1uo8CIykoR0NTJV.POBADb7MgfMeP2PbKoCLJypoqr5pUd2', 'employee'),
(15, 'adminerterewrtert', '$2y$10$PYNAkD47jY6IF3pgt17sJ.hCgvF/3aIIt7gPGD6oA0CayHL1W6lLG', 'employee'),
(16, 'rahul', 'rahul123', 'employee'),
(19, 'dfgr', 'rahul123', 'employee'),
(20, 'dfgrfdg', 'dfgrfdg', 'employee'),
(22, 'dfgrfdgdgf', 'dfgrfdgdgf', 'employee'),
(23, 'dfgrfdgdgffd', 'dfgrfdgdgffd', 'employee'),
(24, 'dssg', 'dssg', 'employee'),
(25, 'dsf', 'dsf', 'employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees_tbl`
--
ALTER TABLE `employees_tbl`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
