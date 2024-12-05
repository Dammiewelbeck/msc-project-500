-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 01:21 PM
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
-- Database: `bipaneldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `ratings` decimal(3,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `gender`, `ratings`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john.doe@example.com', '1234567890', 'Male', 4.50, '2024-12-01 23:19:32', '2024-12-01 23:19:32'),
(2, 'Jane Smith', 'jane.smith@example.com', '0987654321', 'Female', 4.80, '2024-12-01 23:19:32', '2024-12-01 23:19:32'),
(3, 'Sam Brown', 'sam.brown@example.com', '1122334455', 'Other', 4.00, '2024-12-01 23:19:32', '2024-12-01 23:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT '02.png',
  `name` varchar(255) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `image`, `name`, `sku`, `category`, `price`, `stock`, `description`, `created_at`, `updated_at`) VALUES
(1, '02.png', 'Coca-Cola Classic', 'SKU12345', 'Beverages', 1.50, 100, 'The original Coca-Cola.', '2024-12-01 23:19:32', '2024-12-04 12:04:47'),
(12, 'product_70352.jpg', 'French Fries', 'era345rfd', 'Juices', 23.00, 2356, 'javdhawhgerfvhera', '2024-12-03 17:17:08', '2024-12-04 00:29:46'),
(14, 'product_18593.jpg', 'Doreen Pie', 'SKU54321', 'Snacks', 1000.00, 10, 'doihd cauhbcuhse rgj sfuv eijfs vwjrtnilgsieawnf', '2024-12-03 17:24:02', '2024-12-03 17:24:02'),
(16, 'product_69172.jpg', 'French Fries', '34w6', 'Beverages', 45.00, 454, 'sfdzg', '2024-12-04 00:02:30', '2024-12-04 00:03:18'),
(18, 'product_25093.jpg', 'Something New', 'wefwr', 'Snacks', 423.00, 3435, 'dsfhtrhyt', '2024-12-04 11:58:05', '2024-12-04 11:58:28');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent` enum('North','East','West','South','North-East','North-West','South-East','South-West','Central') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `parent`, `created_at`, `updated_at`) VALUES
(1, 'Abuja', 'Central', '2024-12-01 23:44:30', '2024-12-01 23:44:30'),
(2, 'Edo', 'South', '2024-12-01 23:44:30', '2024-12-01 23:44:30'),
(3, 'Kano', 'North', '2024-12-01 23:44:30', '2024-12-01 23:44:30'),
(4, 'Lagos', 'South-West', '2024-12-01 23:44:30', '2024-12-01 23:44:30'),
(5, 'Oyo', 'South-West', '2024-12-01 23:44:30', '2024-12-01 23:44:30');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('Sales','Market Trends','Customer Insights') NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `name`, `type`, `product_id`, `region_id`, `start_date`, `end_date`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Monthly Sales Report', 'Sales', 1, 1, '2024-10-01', '2024-10-31', 'Sales report for October.', '2024-12-01 23:19:32', '2024-12-01 23:19:32'),
(2, 'Weekly Trends Report', 'Market Trends', NULL, 2, '2024-11-01', '2024-11-07', 'Market trends analysis for the first week of November.', '2024-12-01 23:19:32', '2024-12-01 23:19:32'),
(3, 'Customer Insights', 'Customer Insights', NULL, 3, '2024-11-01', '2024-11-15', 'Insights into customer behaviors.', '2024-12-01 23:19:32', '2024-12-01 23:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `revenue` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `quantity`, `region_id`, `revenue`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 20, 1, 30.00, '2024-11-01', '2024-12-01 23:19:32', '2024-12-01 23:19:32'),
(4, 14, 34, 2, 34.04, '2024-12-03', '2024-12-03 21:48:36', '2024-12-04 12:08:28');

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_reports`
--

CREATE TABLE `scheduled_reports` (
  `id` int(11) NOT NULL,
  `report_name` varchar(255) NOT NULL,
  `frequency` enum('Daily','Weekly','Monthly') NOT NULL,
  `last_run` date DEFAULT NULL,
  `next_run` date NOT NULL,
  `report_type` enum('Sales','Market Trends','Customer Insights') NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scheduled_reports`
--

INSERT INTO `scheduled_reports` (`id`, `report_name`, `frequency`, `last_run`, `next_run`, `report_type`, `region_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Monthly Sales Schedule', 'Monthly', '2024-10-31', '2024-11-30', 'Sales', 1, 'Monthly sales reports for all regions.', '2024-12-01 23:19:32', '2024-12-01 23:19:32'),
(2, 'Weekly Market Trends', 'Weekly', '2024-11-08', '2024-11-15', 'Market Trends', 2, 'Weekly trends for market data.', '2024-12-01 23:19:32', '2024-12-01 23:19:32'),
(3, 'Customer Overview Schedule', 'Daily', NULL, '2024-11-14', 'Customer Insights', 3, 'Daily customer insights updates.', '2024-12-01 23:19:32', '2024-12-01 23:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `application_name` varchar(255) NOT NULL,
  `theme` enum('Light','Dark') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `user_id`, `application_name`, `theme`, `created_at`, `updated_at`) VALUES
(1, 1, 'Control Panel', 'Light', '2024-12-01 23:19:32', '2024-12-01 23:19:32'),
(2, 2, 'BI Dashboard', 'Dark', '2024-12-01 23:19:32', '2024-12-01 23:19:32'),
(3, 3, 'Coca-Cola Panel', 'Light', '2024-12-01 23:19:32', '2024-12-01 23:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT '01.png',
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('Admin','Analyst','Viewer') NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `about` text DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `image`, `email`, `phone`, `role`, `region_id`, `password`, `address`, `about`, `username`, `created_at`, `updated_at`) VALUES
(1, 'Dammie', 'Admin', 'profile_64201.png', 'admin@example.com', '1234567890', 'Admin', 4, '$2y$10$uvODS0Mw8C9FlTJWVxowoeQQr5/Lrk/r5AGmbKg5Clo.2ze0.mWZS', 'No. 2, Banjo street, Agiliti Mile-12, Kosofe LGA, Lagos.', 'Administrator of the system.', 'Dammiewelbeck', '2024-12-01 23:19:32', '2024-12-04 11:24:16'),
(2, 'Jane', 'Analyst', '01.png', 'jane.analyst@example.com', '0987654321', 'Analyst', 2, 'password123', '456 Analyst Avenue', 'Analyzes market trends.', 'jane_analyst', '2024-12-01 23:19:32', '2024-12-04 10:00:35'),
(3, 'Sam', 'Viewer', '01.png', 'sam.viewer@example.com', '1122334455', 'Viewer', 3, 'password123', '789 Viewer Road', 'Views generated reports.', 'sam_viewer', '2024-12-01 23:19:32', '2024-12-04 10:00:36'),
(7, 'Owoseni', 'Kayode', '01.png', 'abc@gmail.com', '09075513819', 'Analyst', 4, '$2y$10$heLOBfqxwTCfvfkSu8iibemVdLRiOZmFcgHeRhUMfvTDJRK.fUOPa', NULL, NULL, 'asdwrq', '2024-12-04 07:53:40', '2024-12-04 10:00:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `scheduled_reports`
--
ALTER TABLE `scheduled_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `region_id` (`region_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `scheduled_reports`
--
ALTER TABLE `scheduled_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `scheduled_reports`
--
ALTER TABLE `scheduled_reports`
  ADD CONSTRAINT `scheduled_reports_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
