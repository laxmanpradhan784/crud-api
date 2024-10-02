-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2024 at 01:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `students`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `create_date_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_name`, `role`, `city`, `state`, `number`, `email`, `create_date_time`) VALUES
(1, 'Ananya Sharma', 'Graduate Student', 'Hyderabad', 'Telangana', '9876543211', 'ananya.sharma@example.com', '2024-09-24 14:12:38'),
(2, 'Rajesh ', 'Postgraduate Student', 'Mumbai', 'Maharashtra', '9988776655', 'kumar@example.com', '2024-09-24 14:12:38'),
(3, 'Aditya Mehta', 'Student', 'Bengaluru', 'Karnataka', '9876543212', 'aditya.mehta@example.com', '2024-09-24 14:12:38'),
(4, 'Sai Kumar', 'Student', 'Hyderabad', 'Telangana', '9876543213', 'sai.kumar@example.com', '2024-09-24 14:12:38'),
(5, 'Isha Gupta', 'Student', 'Chennai', 'Tamil Nadu', '9876543214', 'isha.gupta@example.com', '2024-09-24 14:12:38'),
(6, 'Anaya Verma', 'Student', 'Kolkata', 'West Bengal', '9876543215', 'anaya.verma@example.com', '2024-09-24 14:12:38'),
(7, 'Rohan Singh', 'Student', 'Pune', 'Maharashtra', '9876543216', 'rohan.singh@example.com', '2024-09-24 14:12:38'),
(8, 'Nisha Reddy', 'Student', 'Ahmedabad', 'Gujarat', '9876543217', 'nisha.reddy@example.com', '2024-09-24 14:12:38'),
(9, 'Kabir Joshi', 'Student', 'Jaipur', 'Rajasthan', '9876543218', 'kabir.joshi@example.com', '2024-09-24 14:12:38'),
(10, 'Saanvi Nair', 'Student', 'Lucknow', 'Uttar Pradesh', '9876543219', 'saanvi.nair@example.com', '2024-09-24 14:12:38'),
(11, 'Laxman', 'Student', 'Bangalore', 'Karnataka', '9876543210', 'laxman@example.com', '2024-09-24 14:26:43'),
(12, 'Ananya', 'Student', 'Hyderabad', 'Telangana', '9876543211', 'ananya@example.com', '2024-09-24 14:30:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
