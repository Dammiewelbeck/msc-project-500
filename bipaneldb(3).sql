-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 10:24 AM
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
-- Table structure for table `customers_reports`
--

CREATE TABLE `customers_reports` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `market_reports`
--

CREATE TABLE `market_reports` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(18, 'product_15688.jpg', 'Something New', 'SKU63728', 'Snacks', 423.00, 3435, 'dsfhtrhyt', '2024-12-04 11:58:05', '2024-12-04 13:21:02'),
(19, 'product_35638.webp', 'COCA-COLA', 'SKU24637', 'Soft Drinks', 63.00, 14623, 'Coca-Cola history began in 1886, when Dr. John Pemberton created a distinctive tasting soft drink, now known as Coca-Cola, the worlds favourite soft drink. Always responding to consumer needs, Coca-Cola also provides light and zero sugar options and a variety of different flavour and packaging choices.', '2024-12-04 13:03:21', '2024-12-04 13:03:21'),
(20, 'product_81757.webp', 'FANTA', 'SKU53826', 'Soft Drinks', 123.00, 213232, 'Bright, bubbly and popular, Fanta is the soft drink that intensifies fun. Introduced in 1940, Fanta is the second oldest brand of The Coca-Cola Company', '2024-12-04 13:05:16', '2024-12-04 13:05:16'),
(21, 'product_67976.webp', 'SPRITE', 'SKU23456', 'Soft Drinks', 23.00, 345, 'Crisp, refreshing and clean-tasting, Sprite is a lemon and lime-flavoured soft drink. It first hit shop shelves back in 1961 and today it’s sold in more than 190 countries.', '2024-12-04 13:07:15', '2024-12-04 13:07:15'),
(22, 'product_34848.webp', 'SCHWEPPES', 'SKU64573', 'Soft Drinks', 12.00, 1322, 'Schweppes is an adult soft drink that offers a range of delicately-balanced creations with ingredients selected with care, created to mix with or to quench your thirst.', '2024-12-04 13:08:14', '2024-12-04 13:08:14'),
(23, 'product_11519.webp', 'FIVE ALIVE JUICE', 'SKU64839', 'Juices', 45.00, 3535, '5Alive offers  a variety of products which consist of authentic, timeless and downright deliciously refreshing fruit goodness.', '2024-12-04 13:10:15', '2024-12-04 13:10:15'),
(24, 'product_47036.webp', 'PULPY ORANGE FRUIT DRINK', 'SKU03874', 'Juices', 123.00, 132, 'Five Alive Pulpy Orange Fruit Drink is a naturally refreshing juice drink with real juice and orange pulp, consumers can see and feel.', '2024-12-04 13:13:49', '2024-12-04 13:13:49'),
(25, 'product_62017.webp', 'MONSTER', 'SKU87456', 'Energy Drinks', 24.00, 3443, 'Tear into a can of Monster Energy, the meanest energy drink on the planet. It is the ideal combo of the right ingredients in the right proportion to deliver the big bad buzz that only Monster can. Monster packs a powerful punch but has a smooth easy drinking flavour.', '2024-12-04 13:15:47', '2024-12-04 13:15:47'),
(26, 'product_74861.webp', 'PREDATOR', 'SKU85734', 'Energy Drinks', 12.15, 234, 'Predator Energy, the first global affordable energy drink by Monster Energy exists to ignite your hustling spirit and allow you to thrive not just survive.', '2024-12-04 13:17:06', '2024-12-04 13:17:06'),
(27, 'product_31542.webp', 'EVA PREMIUM WATER', 'SKU92638', 'Snacks', 15.39, 134, 'Eva bottled water has been designed to be a perfect complement to everyday moments. It is grounded in providing pure, clean water in a sustainable way, that enlivens the body and mind.', '2024-12-04 13:19:54', '2024-12-04 13:19:54'),
(28, 'product_73118.webp', 'Famous Grouse', 'SKU27533', 'Beverages', 12.32, 234, 'Smooth and perfectly balanced. Scotlands favourite whisky blend of the finest malts and exceptional grain whiskies.', '2024-12-04 13:24:06', '2024-12-04 13:24:06');

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
  `user_id` int(11) NOT NULL,
  `report_type` enum('sales','market','customers') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `report_type`, `created_at`, `updated_at`) VALUES
(1, 7, 'sales', '2024-12-04 23:43:53', '2024-12-04 23:43:53'),
(3, 7, 'sales', '2024-12-04 23:47:05', '2024-12-04 23:47:05'),
(4, 7, 'sales', '2024-12-05 09:03:31', '2024-12-05 09:03:31'),
(5, 1, 'sales', '2024-12-05 09:09:51', '2024-12-05 09:09:51');

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
(10, 23, 23, 1, 1523.00, '2024-12-04', '2024-12-04 13:26:06', '2024-12-04 13:26:06'),
(11, 20, 23, 2, 2344.00, '2024-12-04', '2024-12-04 13:26:59', '2024-12-04 13:26:59'),
(12, 19, 1234, 4, 24335.00, '2024-12-04', '2024-12-04 13:27:29', '2024-12-04 13:27:29'),
(13, 25, 214, 4, 34355.00, '2024-12-04', '2024-12-04 13:27:54', '2024-12-04 13:27:54'),
(14, 27, 1232, 5, 23454.00, '2024-12-04', '2024-12-04 13:28:57', '2024-12-04 13:28:57'),
(15, 26, 243, 2, 2354.00, '2024-12-04', '2024-12-04 13:30:29', '2024-12-04 13:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `sales_reports`
--

CREATE TABLE `sales_reports` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `frequency` enum('daily','weekly','monthly','yearly') NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_reports`
--

INSERT INTO `sales_reports` (`id`, `report_id`, `region_id`, `frequency`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'daily', 'This is a long details about this sales reports', '2024-12-04 23:43:53', '2024-12-04 23:43:53'),
(3, 3, 4, 'daily', 'qDWAFEFRS', '2024-12-04 23:47:05', '2024-12-04 23:47:05'),
(4, 4, 5, 'weekly', 'This is a long description.', '2024-12-05 09:03:31', '2024-12-05 09:03:31'),
(5, 5, 2, 'monthly', 'Long details', '2024-12-05 09:09:51', '2024-12-05 09:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `sales_report_items`
--

CREATE TABLE `sales_report_items` (
  `id` int(11) NOT NULL,
  `sales_report_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `revenue` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_report_items`
--

INSERT INTO `sales_report_items` (`id`, `sales_report_id`, `product_id`, `quantity`, `revenue`) VALUES
(1, 1, 25, 29, 1345.00),
(2, 1, 21, 23, 3455.00),
(3, 1, 19, 54, 2345.00),
(5, 3, 24, 123, 1243215.00),
(6, 4, 21, 20, 111.11),
(7, 4, 27, 20, 111.11),
(8, 4, 26, 20, 111.11),
(9, 4, 28, 20, 111.11),
(10, 4, 23, 20, 111.11),
(11, 5, 22, 10, 222.20),
(12, 5, 24, 10, 222.20),
(13, 5, 12, 10, 222.20);

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
(7, 'Owoseni', 'Kayode', 'profile_76588.jpg', 'abc@gmail.com', '09075513819', 'Analyst', 4, '$2y$10$heLOBfqxwTCfvfkSu8iibemVdLRiOZmFcgHeRhUMfvTDJRK.fUOPa', 'No. 2, Banjo street, Agiliti Mile-12, Kosofe LGA, Lagos.', 'Lorem snhdb dnjbhwfa jhfvesrungj isokmfs. Lorem snhdb dnjbhwfa jhfvesrungj isokmfs. Lorem snhdb dnjbhwfa jhfvesrungj isokmfs.', 'Malkayne', '2024-12-04 07:53:40', '2024-12-04 12:45:22');

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
-- Indexes for table `customers_reports`
--
ALTER TABLE `customers_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_id` (`report_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `market_reports`
--
ALTER TABLE `market_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_id` (`report_id`),
  ADD KEY `region_id` (`region_id`);

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
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `sales_reports`
--
ALTER TABLE `sales_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_id` (`report_id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `sales_report_items`
--
ALTER TABLE `sales_report_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_report_id` (`sales_report_id`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT for table `customers_reports`
--
ALTER TABLE `customers_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `market_reports`
--
ALTER TABLE `market_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sales_reports`
--
ALTER TABLE `sales_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales_report_items`
--
ALTER TABLE `sales_report_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- Constraints for table `customers_reports`
--
ALTER TABLE `customers_reports`
  ADD CONSTRAINT `customers_reports_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers_reports_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `market_reports`
--
ALTER TABLE `market_reports`
  ADD CONSTRAINT `market_reports_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `market_reports_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_reports`
--
ALTER TABLE `sales_reports`
  ADD CONSTRAINT `sales_reports_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_reports_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_report_items`
--
ALTER TABLE `sales_report_items`
  ADD CONSTRAINT `sales_report_items_ibfk_1` FOREIGN KEY (`sales_report_id`) REFERENCES `sales_reports` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_report_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

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
