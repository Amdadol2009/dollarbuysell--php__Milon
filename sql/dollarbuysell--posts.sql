-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 03:38 PM
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
-- Database: `dollarbuysell--php`
--

-- --------------------------------------------------------

--
-- Table structure for table `dollarbuysell--posts`
--

CREATE TABLE `dollarbuysell--posts` (
  `id` int(11) NOT NULL,
  `gateway_sender` int(11) NOT NULL,
  `gateway_receiver` int(11) NOT NULL,
  `amount_send` double NOT NULL,
  `amount_receive` double NOT NULL,
  `account_no` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dollarbuysell--posts`
--

INSERT INTO `dollarbuysell--posts` (`id`, `gateway_sender`, `gateway_receiver`, `amount_send`, `amount_receive`, `account_no`) VALUES
(1, 3, 2, 1, 122, NULL),
(2, 2, 3, 122, 1, NULL),
(3, 1, 3, 117, 1, NULL),
(4, 3, 1, 1, 122, NULL),
(5, 3, 31, 1, 115, '01940489453'),
(6, 31, 3, 123, 1, 'U12343535'),
(7, 32, 3, 122, 1, 'Bank1309');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dollarbuysell--posts`
--
ALTER TABLE `dollarbuysell--posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dollarbuysell--posts`
--
ALTER TABLE `dollarbuysell--posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
