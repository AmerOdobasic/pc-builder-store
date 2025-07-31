-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307/
-- Generation Time: Jul 31, 2025 at 02:16 AM
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
-- Database: `pcbuilder`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(7, 'Case'),
(1, 'CPU'),
(2, 'GPU'),
(6, 'Motherboard'),
(5, 'PSU'),
(3, 'RAM'),
(4, 'SSD');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `price`, `stock`, `description`, `image_url`, `created_at`) VALUES
(21, 'AMD RYZEN 7 9800X3D', 1, 649.99, 8, 'The best CPU for gaming', 'assets/images/71aHvYUgX1L._AC_SL1500_.jpg', '2025-07-23 05:54:09'),
(22, 'GIGABYTE RTX 4070 Ti SUPER', 2, 1255.27, 3, '1440p gaming GPU.', 'assets/images/lmX1wMuJvkK8-OhxrmHVlg.c-r.jpg', '2025-07-23 05:54:09'),
(23, 'TUFF GAMING RTX 5090', 2, 3999.99, 3, 'The most powerful GPU on the planet', 'assets/images/71h-T6Gez3L._AC_SL1500_.jpg', '2025-07-23 05:54:09'),
(24, 'CORSAIR VENGEANCE DDR5 RAM', 3, 120.99, 15, '32GB RAM for DDR5 supported motherboards', 'assets/images/51syuod9YwL._AC_SL1200_.jpg', '2025-07-23 05:54:09'),
(25, 'WD_BLACK 1TB NVMe SSD', 4, 107.99, 24, 'Reliable and fast 1TB SDD', 'assets/images/71+7Y1MFojL._AC_SL1500_.jpg', '2025-07-23 05:54:09'),
(26, 'Corsair RMx 1000-Watt', 5, 289.99, 12, '1000W Fully Modular Power Supply for all of your gaming needs', 'assets/images/71Ol9ncug1L._AC_SL1500_.jpg', '2025-07-23 05:54:09'),
(27, 'GIGABYTE B550M K MOTHERBOARD', 6, 129.99, 9, 'Micro-ATX Mobo for AMD AM4 CPUS', 'assets/images/71Gm7vworoL._AC_SL1500_.jpg', '2025-07-23 05:54:09'),
(28, 'Corsair 4000D Case', 7, 139.99, 8, 'High Airflow case for a ATX Mobo', 'assets/images/4000D_MODULAR_BLACK_1_1280x960_9db5c7e9-7637-402b-a90c-c561c0da769e_1280x960.jpg', '2025-07-23 05:54:09'),
(29, 'Gigabyte RX 7600 XT', 2, 419.99, 14, 'Budget friendly 1080p GPU', 'assets/images/71PSxIuhYJL._AC_SL1500_.jpg', '2025-07-23 05:54:09'),
(30, 'MSI B760 Gaming Plus WiFi Motherboard', 6, 199.99, 8, 'DDR5 Compatible Mobo for LGA Socket', 'assets/images/91uLE4tvpyL._AC_SL1500_.jpg', '2025-07-23 05:54:09'),
(31, 'EVGA 650W Power Supply', 5, 95.99, 6, '650W PSU for ATX Mobos', 'assets/images/61-WPd9RvJL._AC_SL1000_.jpg', '2025-07-23 05:54:09'),
(32, 'TEAMGROUP DDR4 RAM', 3, 49.99, 20, 'Fast DDR4 RAM', 'assets/images/61+0UEKmgoL._AC_SL1500_.jpg', '2025-07-23 05:54:09'),
(33, 'NZXT H9 Flow', 7, 159.99, 35, 'Sleek ATX Mid-Tower Case from NZXT', 'assets/images/51rOo9MITKL._AC_SL1000_.jpg', '2025-07-23 05:54:09'),
(34, 'SAMSUNG 870 EVO SATA III SSD', 4, 139.99, 13, 'Fast and reliable SATA SSD', 'assets/images/911ujeCkGfL._AC_SL1500_.jpg', '2025-07-23 05:54:09'),
(35, 'GIGABYTE X870 MOTHERBOARD', 6, 279.99, 8, 'High-end AM5 Only for the best gamers', 'assets/images/81zT2fwPK9L._AC_SL1500_.jpg', '2025-07-23 05:54:09'),
(36, 'DIYPC DIY MICRO-ATX CASE', 7, 59.99, 25, 'Small Case for Micro-ATX Motherboards', 'assets/images/11-353-239-01.jpg', '2025-07-23 05:54:09'),
(37, 'CORSAIR 128GB RGB RAM', 3, 514.99, 15, 'Super Fast RGB DDR5 RAM', 'assets/images/61EVf-QxpvL._AC_SL1500_.jpg\n', '2025-07-23 05:54:09'),
(38, 'AMD Ryzen 7 5800X', 1, 239.99, 4, '8-core AMD processor on AM4.', 'assets/images/61IIbwz-+ML._AC_SL1500_.jpg', '2025-07-23 05:54:09'),
(39, 'Intel i7-12700K', 1, 299.99, 10, '12th Gen CPU with high performance.', 'assets/images/51bW9uJzJFL._AC_SL1000_.jpg', '2025-07-23 05:54:09'),
(40, 'MSI RTX 5060', 2, 439.99, 45, 'The new popular mid-range GPU for budget gamers', 'assets/images/71edk5q7MPL._AC_SL1500_.jpg', '2025-07-23 05:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `product_options`
--

DROP TABLE IF EXISTS `product_options`;
CREATE TABLE `product_options` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option_name` varchar(100) NOT NULL,
  `option_value` varchar(100) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `override_price` decimal(10,2) DEFAULT NULL,
  `override_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_options`
--

INSERT INTO `product_options` (`id`, `product_id`, `option_name`, `option_value`, `image_url`, `override_price`, `override_name`) VALUES
(45, 28, 'Color', 'Black', 'assets/images/4000D_MODULAR_BLACK_1_1280x960_9db5c7e9-7637-402b-a90c-c561c0da769e_1280x960.jpg', NULL, NULL),
(46, 28, 'Color', 'White', 'assets/images/11-139-231-12.jpg', NULL, NULL),
(47, 21, 'Model', 'Ryzen 7 9800X3D', 'assets/images/71aHvYUgX1L._AC_SL1500_.jpg', NULL, NULL),
(48, 21, 'Model', '9900X3D Upgrade', 'assets/images/71aHvYUgX1L._AC_SL1500_.jpg', 799.99, 'AMD Ryzen 7 9900X3D'),
(49, 22, 'Options', 'GIGABYTE RTX 4070 Ti SUPER', 'assets/images/lmX1wMuJvkK8-OhxrmHVlg.c-r.jpg', NULL, NULL),
(50, 22, 'Options', 'Refurbished from ZOTAC', 'assets/images/810012084499.png', 1059.99, 'Refurbished ZOTAC RTX 4070 Ti SUPER'),
(51, 23, 'Model', 'TUFF GAMING RTX 5090', 'assets/images/71h-T6Gez3L._AC_SL1500_.jpg', NULL, NULL),
(52, 23, 'Model', 'ZOTAC 5090', 'assets/images/18931630.jpg', 3999.99, 'ZOTAC RGB RTX 5090'),
(53, 24, 'RAM Size', '32GB RAM', 'assets/images/51syuod9YwL._AC_SL1200_.jpg', NULL, NULL),
(54, 24, 'RAM Size', '64GB RAM', 'assets/images/51syuod9YwL._AC_SL1200_.jpg', NULL, NULL),
(55, 25, 'Storage Size', '1TB', 'assets/images/71+7Y1MFojL._AC_SL1500_.jpg', NULL, NULL),
(56, 25, 'Storage Size', '2TB', 'assets/images/71+7Y1MFojL._AC_SL1500_.jpg', NULL, NULL),
(57, 26, 'Wattage', '1000W', 'assets/images/71+7Y1MFojL._AC_SL1500_.jpg', NULL, NULL),
(58, 26, 'Wattage', '1200W', 'assets/images/811oS15In2L._AC_SL1500_.jpg', 199.99, 'Corsair RM1200x'),
(59, 27, 'Options', 'B550M K MOBO', 'assets/images/71+7Y1MFojL._AC_SL1500_.jpg', NULL, NULL),
(60, 27, 'Options', 'WIFI Option', 'assets/images/ezgif-276c1222ee30e2.jpg', 149.99, 'GIGABYTE B550 EAGLE MOTHERBOARD'),
(61, 29, 'Options', 'RX 7600 XT Gigabyte', 'assets/images/71PSxIuhYJL._AC_SL1500_.jpg', NULL, NULL),
(62, 29, 'Options', 'Compact Version', 'assets/images/19187147.jpeg', 429.99, 'Sapphire RX 7600XT'),
(63, 30, 'Color', 'Normal', 'assets/images/91uLE4tvpyL._AC_SL1500_.jpg', NULL, NULL),
(64, 30, 'Color', 'White', 'assets/images/b760-gaming-plus-wifi-ddr4-hero-block01.png', NULL, NULL),
(65, 31, 'Wattage', '650W', 'assets/images/61-WPd9RvJL._AC_SL1000_.jpg', NULL, NULL),
(66, 31, 'Wattage', '750W', 'assets/images/71z2ttTn6KL._AC_SL1200_.jpg', 129.99, 'EVGA 750 GQ, 80+ GOLD'),
(67, 32, 'RAM Size', '16GB RAM', 'assets/images/51syuod9YwL._AC_SL1200_.jpg', NULL, NULL),
(68, 32, 'RAM Size', '32GB RAM', 'assets/images/51syuod9YwL._AC_SL1200_.jpg', NULL, NULL),
(69, 33, 'Color', 'Black', 'assets/images/51rOo9MITKL._AC_SL1000_.jpg', NULL, NULL),
(70, 33, 'Color', 'White', 'assets/images/ezgif-5d14c67b191b3e.jpg', NULL, NULL),
(71, 34, 'Storage Size', '1TB', 'assets/images/51rOo9MITKL._AC_SL1000_.jpg', NULL, NULL),
(72, 34, 'Storage Size', '2TB', 'assets/images/51rOo9MITKL._AC_SL1000_.jpg', NULL, NULL),
(73, 35, 'Color', 'Black', 'assets/images/81zT2fwPK9L._AC_SL1500_.jpg', NULL, NULL),
(74, 35, 'Color', 'White', 'assets/images/81zT2fwPK9L._AC_SL1500_.jpg', NULL, NULL),
(75, 36, 'Color', 'Black', 'assets/images/11-353-239-01.jpg', NULL, NULL),
(76, 36, 'Color', 'White', 'assets/images/51l39Z01HkL._AC_SL1280_.jpg', NULL, NULL),
(77, 37, 'RAM SIZE', '128GB', 'assets/images/61EVf-QxpvL._AC_SL1500_.jpg', NULL, NULL),
(78, 37, 'RAM SIZE', '256GB', 'assets/images/61EVf-QxpvL._AC_SL1500_.jpg', 725.99, 'CORSAIR 256GB RGB RAM'),
(79, 38, 'Model', '5800X', 'assets/images/61IIbwz-+ML._AC_SL1500_.jpg', NULL, NULL),
(80, 38, 'Model', '5900X', 'assets/images/51S-lEYQZJL._AC_SL1500_.jpg', 369.99, 'Ryzen 9 5900X'),
(81, 39, 'Model', 'i7-12700K', 'assets/images/51bW9uJzJFL._AC_SL1000_.jpg', NULL, NULL),
(82, 39, 'Model', 'i9-12900K', 'assets/images/51klBAsxGHL._AC_SL1500_.jpg', 399.99, 'Intel I9-12900K'),
(83, 40, 'Color', 'Black', 'assets/images/71edk5q7MPL._AC_SL1500_.jpg', NULL, NULL),
(84, 40, 'Color', 'White', 'assets/images/71LwCtJ-DhL._AC_SL1500_.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

DROP TABLE IF EXISTS `support_messages`;
CREATE TABLE `support_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `response` text DEFAULT NULL,
  `responded_by` int(11) DEFAULT NULL,
  `responded_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `created_at`, `role`) VALUES
(4, 'user', 'user@gmail.com', '$2y$10$p0YK06tdVZP.WyiidC3Aqui53mJJ74FuE9TAM4ue/ccacCGqsGLDG', '2025-07-29 05:04:04', 'user'),
(5, 'admin', 'admin@gmail.com', '$2y$10$0lMkS8stjFDWK2PzmJmfi.z/1vztCYlatxYa.4oW5SWCcXalZZNLS', '2025-07-30 02:55:13', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_options`
--
ALTER TABLE `product_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_options`
--
ALTER TABLE `product_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_options`
--
ALTER TABLE `product_options`
  ADD CONSTRAINT `product_options_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
