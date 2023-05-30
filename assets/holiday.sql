-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 20, 2023 at 12:28 PM
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
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `id` int(11) NOT NULL,
  `holiday_name` varchar(255) NOT NULL,
  `holiday_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`id`, `holiday_name`, `holiday_date`) VALUES
(1, 'Sunday', '2023-01-01'),
(2, 'Sunday', '2023-01-08'),
(3, 'Sunday', '2023-01-15'),
(4, 'Sunday', '2023-01-22'),
(5, 'Sunday', '2023-01-29'),
(6, 'Sunday', '2023-02-05'),
(7, 'Sunday', '2023-02-12'),
(8, 'Sunday', '2023-02-19'),
(9, 'Sunday', '2023-02-26'),
(10, 'Sunday', '2023-03-05'),
(11, 'Sunday', '2023-03-12'),
(12, 'Sunday', '2023-03-19'),
(13, 'Sunday', '2023-03-26'),
(14, 'Sunday', '2023-04-02'),
(15, 'Sunday', '2023-04-09'),
(16, 'Sunday', '2023-04-16'),
(17, 'Sunday', '2023-04-23'),
(18, 'Sunday', '2023-04-30'),
(19, 'Sunday', '2023-05-07'),
(20, 'Sunday', '2023-05-14'),
(21, 'Sunday', '2023-05-21'),
(22, 'Sunday', '2023-05-28'),
(23, 'Sunday', '2023-06-04'),
(24, 'Sunday', '2023-06-11'),
(25, 'Sunday', '2023-06-18'),
(26, 'Sunday', '2023-06-25'),
(27, 'Sunday', '2023-07-02'),
(28, 'Sunday', '2023-07-09'),
(29, 'Sunday', '2023-07-16'),
(30, 'Sunday', '2023-07-23'),
(31, 'Sunday', '2023-07-30'),
(32, 'Sunday', '2023-08-06'),
(33, 'Sunday', '2023-08-13'),
(34, 'Sunday', '2023-08-20'),
(35, 'Sunday', '2023-08-27'),
(36, 'Sunday', '2023-09-03'),
(37, 'Sunday', '2023-09-10'),
(38, 'Sunday', '2023-09-17'),
(39, 'Sunday', '2023-09-24'),
(40, 'Sunday', '2023-10-01'),
(41, 'Sunday', '2023-10-08'),
(42, 'Sunday', '2023-10-15'),
(43, 'Sunday', '2023-10-22'),
(44, 'Sunday', '2023-10-29'),
(45, 'Sunday', '2023-11-05'),
(46, 'Sunday', '2023-11-12'),
(47, 'Sunday', '2023-11-19'),
(48, 'Sunday', '2023-11-26'),
(49, 'Sunday', '2023-12-03'),
(50, 'Sunday', '2023-12-10'),
(51, 'Sunday', '2023-12-17'),
(52, 'Sunday', '2023-12-24'),
(53, 'Sunday', '2023-12-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
