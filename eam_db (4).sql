-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2024 at 06:19 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eam_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `latitude`, `longitude`) VALUES
(2, 101, '2024-07-01', NULL, NULL),
(3, 101, '2024-07-02', NULL, NULL),
(5, 102, '2024-07-01', NULL, NULL),
(6, 102, '2024-07-02', NULL, NULL),
(7, 101, '2024-07-03', NULL, NULL),
(8, 101, '2024-07-04', NULL, NULL),
(9, 101, '2024-07-05', NULL, NULL),
(10, 101, '2024-07-06', NULL, NULL),
(11, 101, '2024-07-07', NULL, NULL),
(12, 101, '2024-07-08', NULL, NULL),
(13, 101, '2024-07-09', NULL, NULL),
(14, 101, '2024-07-10', NULL, NULL),
(15, 101, '2024-07-11', NULL, NULL),
(17, 101, '2024-07-12', NULL, NULL),
(18, 101, '2024-07-13', NULL, NULL),
(19, 101, '2024-07-14', NULL, NULL),
(20, 101, '2024-07-15', NULL, NULL),
(21, 101, '2024-07-16', NULL, NULL),
(22, 101, '2024-07-17', NULL, NULL),
(23, 101, '2024-07-18', NULL, NULL),
(24, 101, '2024-07-19', NULL, NULL),
(25, 101, '2024-07-20', NULL, NULL),
(27, 101, '2024-07-21', NULL, NULL),
(28, 101, '2024-07-22', NULL, NULL),
(30, 101, '2024-07-23', NULL, NULL),
(31, 101, '2024-07-24', NULL, NULL),
(32, 101, '2024-07-25', NULL, NULL),
(34, 101, '2024-07-26', NULL, NULL),
(35, 101, '2024-07-27', NULL, NULL),
(36, 101, '2024-07-28', NULL, NULL),
(37, 101, '2024-07-29', NULL, NULL),
(39, 101, '2024-07-30', NULL, NULL),
(41, 101, '2024-07-31', NULL, NULL),
(42, 102, '2024-07-27', NULL, NULL),
(43, 102, '2024-07-13', NULL, NULL),
(44, 102, '2024-07-21', NULL, NULL),
(45, 102, '2024-07-06', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(25) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1',
  `Branch` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `username`, `password`, `role`, `Branch`) VALUES
(101, 'cdmbranch', 'cdmbranch', 1, 'CDM BRANCH'),
(102, 'noor', 'noor', 1, 'cdm');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(60) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`department_id`, `department_name`, `status`) VALUES
(101, 'CDM BRANCH', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `emailid` varchar(120) NOT NULL,
  `password` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `employee_id` varchar(11) NOT NULL,
  `joining_date` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` int(10) NOT NULL,
  `department` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `salary` int(11) DEFAULT NULL,
  `acc_no` bigint(20) DEFAULT NULL,
  `designation` varchar(20) DEFAULT NULL,
  `employee_type` varchar(20) DEFAULT 'Full time',
  `location` varchar(50) DEFAULT NULL,
  `Father_name` varchar(50) NOT NULL,
  `House_rent` int(11) NOT NULL DEFAULT '0',
  `Telephone_bill` int(11) NOT NULL DEFAULT '0',
  `Extra` int(11) NOT NULL DEFAULT '0',
  `Travel_Allowance` int(11) NOT NULL DEFAULT '0',
  `Insentive` int(11) NOT NULL DEFAULT '0',
  `salary_deduction` int(11) NOT NULL DEFAULT '0',
  `gst` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `first_name`, `last_name`, `username`, `emailid`, `password`, `dob`, `employee_id`, `joining_date`, `gender`, `phone`, `department`, `status`, `role`, `salary`, `acc_no`, `designation`, `employee_type`, `location`, `Father_name`, `House_rent`, `Telephone_bill`, `Extra`, `Travel_Allowance`, `Insentive`, `salary_deduction`, `gst`) VALUES
(1, 'siva', 'r', 'siva', 'canikissyou@gmail.com', 'sivasiva', '2024-08-05', 'EMP-1', '2024-08-05', 'Male', 2147483647, 'CDM BRANCH', 1, 0, 50000, 5341469457465, 'manager', 'Full time', 'chidambaram', 'ravi k', 5000, 399, 50, 100, 100, 1000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `location` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`location`, `id`) VALUES
('chidambaram', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shift`
--

CREATE TABLE `tbl_shift` (
  `id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shift`
--

INSERT INTO `tbl_shift` (`id`, `start_time`, `end_time`, `status`) VALUES
(1, '06:00:00', '18:00:00', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`,`date`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`,`date`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD UNIQUE KEY `unique` (`username`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
