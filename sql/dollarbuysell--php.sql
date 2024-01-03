-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2023 at 02:24 PM
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
-- Table structure for table `dollarbuysell--currencies`
--

CREATE TABLE `dollarbuysell--currencies` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `name` text DEFAULT NULL,
  `prefix` text DEFAULT NULL,
  `stock` double NOT NULL,
  `min` int(11) NOT NULL,
  `icon` text DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dollarbuysell--currencies`
--

INSERT INTO `dollarbuysell--currencies` (`id`, `active`, `name`, `prefix`, `stock`, `min`, `icon`, `date`) VALUES
(1, 1, 'Perfect Money', 'USD', 100, 1, '657ffb652731b.png', '0000-00-00'),
(2, 1, 'Nagad', 'BDT', 22000, 122, '657ffb8812eec.png', '0000-00-00'),
(3, 1, 'Bkash', 'BDT', 12200, 122, '657ffba391d4e.png', '0000-00-00'),
(4, 1, 'Rocket', 'BDT', 12200, 122, '657ffbc17bba5.png', '0000-00-00'),
(5, 1, 'Bank Wire', 'BDT', 99999, 0, '6588400b43d74.png', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `dollarbuysell--orders`
--

CREATE TABLE `dollarbuysell--orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `send_gateway` int(11) NOT NULL,
  `receive_gateway` int(11) NOT NULL,
  `amount_sent` text NOT NULL,
  `amount_receive` text NOT NULL,
  `date` date NOT NULL,
  `account_no` text DEFAULT NULL,
  `trx_id` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dollarbuysell--orders`
--

INSERT INTO `dollarbuysell--orders` (`id`, `user_id`, `send_gateway`, `receive_gateway`, `amount_sent`, `amount_receive`, `date`, `account_no`, `trx_id`, `status`) VALUES
(1, 1, 1, 2, '﻿10', '1150.00', '2023-12-18', '0123467888', 'trx677556788', 0),
(2, 1, 1, 2, '﻿5.5', '632.50', '2023-12-18', '67886576576', 'ertertrt', 1),
(3, 1, 1, 2, '﻿3.6', '414.00', '2023-12-18', NULL, NULL, 0),
(4, 3, 1, 2, '4.5', '517.50', '2023-12-19', NULL, NULL, 0),
(5, 3, 1, 2, '4.5', '517.50', '2023-12-19', '923473473', 'sdfdsfdsf', 0),
(6, 1, 1, 2, '﻿1', '115', '2023-12-20', NULL, NULL, 0),
(7, 1, 1, 2, '﻿1', '115', '2023-12-20', NULL, NULL, 0),
(8, 1, 1, 2, '﻿10', '1150.00', '2023-12-30', '0999', '0', 1),
(9, 1, 1, 2, '﻿1', '115', '2023-12-30', NULL, NULL, 0),
(10, 5, 2, 1, '﻿122', '1', '2023-12-31', NULL, NULL, 0),
(11, 5, 2, 1, '﻿122', '1', '2023-12-31', NULL, NULL, 0);

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
(1, 1, 2, 1, 115, 'U12343535'),
(2, 2, 1, 122, 1, '01940489453');

-- --------------------------------------------------------

--
-- Table structure for table `dollarbuysell--settings`
--

CREATE TABLE `dollarbuysell--settings` (
  `id` int(11) NOT NULL,
  `notification_text` text DEFAULT NULL,
  `column3` int(11) DEFAULT NULL,
  `column4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dollarbuysell--settings`
--

INSERT INTO `dollarbuysell--settings` (`id`, `notification_text`, `column3`, `column4`) VALUES
(1, 'lorem ipsum dolor sit emit lorem ipsum dolor sit emit lorem ipsum dolor sit emit lorem ipsum dolor sit emit', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dollarbuysell--users`
--

CREATE TABLE `dollarbuysell--users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text DEFAULT NULL,
  `mobile` text NOT NULL,
  `trx_count` int(11) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dollarbuysell--users`
--

INSERT INTO `dollarbuysell--users` (`id`, `name`, `email`, `password`, `mobile`, `trx_count`, `reg_date`) VALUES
(1, 'A.RAHAMAN MEMBER', 'khajababa488@gmail.com', 'bbebb63f58999e60d84774239bf4ba45', '+8801834941971', 5, '2023-12-18'),
(2, 'assad', 'khajababa@gmail.com', '25d55ad283aa400af464c76d713c07ad', '012348923482372', 0, '2023-12-19'),
(4, 'A.RAHAMAN MEMBER', 'khajababa488@gmail.com', '130b8217531535180d0273144917a9ba', '+8801834941971', 0, '2023-12-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dollarbuysell--currencies`
--
ALTER TABLE `dollarbuysell--currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dollarbuysell--orders`
--
ALTER TABLE `dollarbuysell--orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dollarbuysell--posts`
--
ALTER TABLE `dollarbuysell--posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dollarbuysell--settings`
--
ALTER TABLE `dollarbuysell--settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dollarbuysell--users`
--
ALTER TABLE `dollarbuysell--users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dollarbuysell--currencies`
--
ALTER TABLE `dollarbuysell--currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dollarbuysell--orders`
--
ALTER TABLE `dollarbuysell--orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dollarbuysell--posts`
--
ALTER TABLE `dollarbuysell--posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dollarbuysell--settings`
--
ALTER TABLE `dollarbuysell--settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dollarbuysell--users`
--
ALTER TABLE `dollarbuysell--users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
