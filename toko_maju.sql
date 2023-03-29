-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 05:00 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_maju`
--

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `history_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `history_details`
--

CREATE TABLE `history_details` (
  `history_details_id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL,
  `item_name` text NOT NULL,
  `buy_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `seller_name` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `customer_name` text NOT NULL DEFAULT '-',
  `total` double NOT NULL,
  `pay` int(11) NOT NULL,
  `profit` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `seller_name`, `date`, `customer_name`, `total`, `pay`, `profit`) VALUES
(181, 'Admin', '2023-03-29 11:14:06', '-', 5000, 100000, 3000),
(182, 'Admin', '2023-03-29 12:20:20', '-', 95000, 100000, 55480),
(183, 'Admin', '2023-03-29 12:25:48', '-', 15000, 20000, 6480);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `invoice_details_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `item_name` text NOT NULL,
  `price` double NOT NULL,
  `buy_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`invoice_details_id`, `invoice_id`, `item_name`, `price`, `buy_price`, `quantity`, `subtotal`) VALUES
(148, 181, 'Cutter', 5000, 2000, 1, 5000),
(149, 182, 'Cutter', 5000, 2000, 5, 25000),
(150, 182, 'Lem Fox', 3000, 1500, 5, 15000),
(151, 182, 'Lem UHU', 3000, 1500, 5, 15000),
(152, 182, 'Paku Payung', 3000, 1704, 5, 15000),
(153, 182, 'Pipa PVC - Diameter 10cm', 5000, 1200, 5, 25000),
(154, 183, 'Paku Payung', 3000, 1704, 5, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` double DEFAULT 0,
  `buy_price` double DEFAULT 0,
  `unit` text NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`, `price`, `buy_price`, `unit`, `stock`) VALUES
(2, 'Paku Payung', 3000, 1704, 'Pcs', 85),
(8, 'Pipa PVC - Diameter 10cm', 5000, 1200, 'Meter', 20),
(9, 'Cutter', 5000, 2000, 'Pcs', -105),
(10, 'Lem Fox', 3000, 1500, 'Pcs', 145),
(12, 'Lem UHU', 3000, 1500, 'Pcs', 114);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `role` enum('Admin','Pegawai') NOT NULL DEFAULT 'Pegawai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `email`, `role`) VALUES
(1, 'Admin', '$2y$10$eRQ9G1j3Il/JLIfRyN6BouwT4blVFNfAJtRE91eJ4fi6FwBKMFMyi', 'admin@gmail.com', 'Admin'),
(2, 'Pegawai', '$2y$10$MwVfPRdBZpkhoNP02zq.Eu7KQJBQ1nXawHVxA0u61LOsJgo2n6ue.', 'pegawai@gmail.com', 'Pegawai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `history_details`
--
ALTER TABLE `history_details`
  ADD PRIMARY KEY (`history_details_id`),
  ADD KEY `fk` (`history_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`invoice_details_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_details`
--
ALTER TABLE `history_details`
  MODIFY `history_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `invoice_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history_details`
--
ALTER TABLE `history_details`
  ADD CONSTRAINT `fk` FOREIGN KEY (`history_id`) REFERENCES `histories` (`history_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
