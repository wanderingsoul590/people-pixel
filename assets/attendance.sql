-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 20, 2023 at 10:35 AM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `no` int(22) NOT NULL,
  `id` int(22) NOT NULL,
  `checkin` varchar(22) NOT NULL,
  `checkout` varchar(22) DEFAULT NULL,
  `date` date NOT NULL,
  `day` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`no`, `id`, `checkin`, `checkout`, `date`, `day`) VALUES
(47, 23, '2023-05-18 13:27:11', '2023-05-19 18:32:56', '2023-05-18', 'Thursday'),
(48, 22, '2023-05-18 13:27:26', '2023-05-18 18:37:33', '2023-05-18', 'Thursday'),
(49, 24, '2023-05-18 13:28:15', '2023-05-18 18:36:46', '2023-05-18', 'Thursday'),
(50, 25, 'LEAVE', 'LEAVE', '2023-05-18', 'Thursday'),
(52, 23, '2023-05-19 11:01:08', '2023-05-19 18:32:56', '2023-05-19', 'Friday'),
(67, 22, '2023-05-19 12:59:14', '2023-05-19 18:31:54', '2023-05-19', 'Friday'),
(68, 24, '2023-05-19 14:01:00', '2023-05-19 18:31:44', '2023-05-19', 'Friday'),
(69, 25, 'LEAVE', 'LEAVE', '2023-05-19', 'Friday'),
(70, 22, '2023-05-20 10:12:01', NULL, '2023-05-20', 'Saturday'),
(71, 23, '2023-05-20 14:38:22', NULL, '2023-05-20', 'Saturday'),
(72, 24, '2023-05-20 15:18:09', NULL, '2023-05-20', 'Saturday');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `no` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
