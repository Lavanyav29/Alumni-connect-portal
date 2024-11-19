-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 08:02 PM
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
-- Database: `jb`
--

-- --------------------------------------------------------

--
-- Table structure for table `hr`
--

CREATE TABLE `hr` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hr`
--

INSERT INTO `hr` (`id`, `full_name`, `mobile_number`, `company_name`, `email_address`, `designation`, `company_address`, `password`) VALUES
(1, 'Jorge', '1111', 'minvayu', 'jorge@gmail.com', 'project head', 'auroville', '$2y$10$KlLS4yMgWKjP7aFh.Eho0ukkwmLzMqH14XPiZWVf4LO4tvMvxlygG'),
(3, 'Jorge2', '1112', 'minvayu', 'jorge2@gmail.com', 'project head', 'auroville', '$2y$10$cxCVLy0vmUSkOnvyy7RfaudA98rGLvNp2dJQHUx8JqYALfALK0vOe'),
(4, 'md', '2', 'tcs', 'md@mgail.com', 'HR', 'chennai', '$2y$10$HP7qWanee8qUYirLefxH9e1koP4O41KARTTTKM3J5cully8qHH6ES');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hr`
--
ALTER TABLE `hr`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_address` (`email_address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hr`
--
ALTER TABLE `hr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
