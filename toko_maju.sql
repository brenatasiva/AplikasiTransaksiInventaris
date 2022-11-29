-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 09:03 AM
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

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`history_id`, `date`, `total`) VALUES
(11, '2022-09-23 19:18:49', 1200),
(12, '2022-09-23 19:20:39', 3600),
(13, '2022-09-23 19:22:56', 3600),
(14, '2022-09-23 19:23:06', 65),
(15, '2022-09-23 19:24:59', 1300),
(16, '2022-09-23 19:31:13', 50000),
(17, '2022-09-30 13:50:47', 0),
(18, '2022-09-30 13:51:51', 37500),
(19, '2022-09-30 13:52:25', 25000),
(20, '2022-09-30 13:54:34', 0),
(26, '2022-11-29 07:10:01', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `history_details`
--

CREATE TABLE `history_details` (
  `history_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `buy_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history_details`
--

INSERT INTO `history_details` (`history_id`, `item_id`, `buy_price`, `quantity`, `subtotal`) VALUES
(11, 1, 100, 6, 600),
(11, 2, 120, 5, 600),
(12, 2, 1200, 3, 3600),
(13, 2, 1200, 3, 3600),
(14, 1, 13, 5, 65),
(15, 2, 130, 10, 1300),
(16, 2, 10000, 5, 50000),
(18, 4, 7500, 5, 37500),
(19, 4, 5000, 5, 25000),
(26, 1, 2000, 10, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `customer_name` text NOT NULL,
  `total` double NOT NULL,
  `profit` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `user_id`, `date`, `customer_name`, `total`, `profit`) VALUES
(1, 1, '2022-09-26 17:58:49', 'Bejo', 80000, 0),
(2, 1, '2022-09-30 15:40:57', 'Andi', 50000, 0),
(4, 1, '2022-10-01 18:11:30', 'Bolly', 8000, 0),
(5, 1, '2022-10-01 18:13:12', 'Bolly2', 3000, 0),
(6, 1, '2022-11-29 14:23:49', 'Jhonny', 0, 0),
(7, 1, '2022-11-29 14:26:28', 'Jhonny', 10000, 0),
(8, 1, '2022-11-29 14:40:07', 'Mike', 10000, 2500);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `invoice_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `buy_price` double DEFAULT 0,
  `quantity` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`invoice_id`, `item_id`, `price`, `buy_price`, `quantity`, `subtotal`) VALUES
(1, 1, 20000, 0, 3, 60000),
(4, 1, 2000, 0, 1, 2000),
(5, 1, 1000, 0, 1, 1000),
(7, 1, 2000, 1500, 5, 10000),
(8, 1, 2000, 1500, 5, 10000),
(1, 2, 10000, 0, 2, 20000),
(4, 2, 3000, 0, 2, 6000),
(5, 2, 1000, 0, 2, 2000),
(2, 4, 10000, 0, 5, 50000);

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
(1, 'Pipa PVC - Diameter 10cm', 2000, 1500, 'Meter', 5),
(2, 'Paku Payung', 3000, 0, 'Pcs', 18),
(4, 'Palu', 10000, 0, 'Pcs', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `role` enum('Admin','Pegawai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `email`, `role`) VALUES
(1, 'Admin', '$2y$10$eRQ9G1j3Il/JLIfRyN6BouwT4blVFNfAJtRE91eJ4fi6FwBKMFMyi', 'admin@gmail.com', 'Admin');

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
  ADD PRIMARY KEY (`history_id`,`item_id`),
  ADD KEY `fk_items_has_histories_histories1_idx` (`history_id`),
  ADD KEY `fk_items_has_histories_items1_idx` (`item_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `fk_invoice_users1_idx` (`user_id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`item_id`,`invoice_id`),
  ADD KEY `fk_invoice_has_item_item1_idx` (`item_id`),
  ADD KEY `fk_invoice_has_item_invoice_idx` (`invoice_id`);

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
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history_details`
--
ALTER TABLE `history_details`
  ADD CONSTRAINT `fk_items_has_histories_histories1` FOREIGN KEY (`history_id`) REFERENCES `histories` (`history_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_items_has_histories_items1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_invoice_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `fk_invoice_has_item_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`invoice_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_invoice_has_item_item1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
