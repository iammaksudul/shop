-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 08, 2025 at 10:55 PM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m1ksu4ul1l1m_webxs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(10, 'dm@maksudulalam.com', '$2y$10$hahGA.mr.ONNagwrfyTjjOQP2eNgpGcjk2RGcjuL6Raicmb/1lqAm');

-- --------------------------------------------------------

--
-- Table structure for table `admin_logs`
--

CREATE TABLE `admin_logs` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_profiles`
--

CREATE TABLE `client_profiles` (
  `user_id` int(11) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `whatsapp`, `address`) VALUES
(1, 'John Doe', 'john.doe@example.com', '1234567890', '0987654321', '123 Street, City, Country'),
(2, 'Md Rahim', 'hostinglagbemarketingteam@gmail.com', '01710710987', '01126730327', 'Savar\r\nSavar'),
(4, 'Md Rahim', 'hostinglagbemarkfggetingteam@gmail.com', '01710710987', '01126730327', 'Savar\r\nSavar'),
(5, 'Kh Maksudul', 'kh.maksudusdsdl.alam.cse@gmail.com', '01854401643', '01854401643', 'Lohachura, Raninagar'),
(6, 'Kh Makssudul', 'kh.maksudusssdsdl.alam.cse@gmail.com', '018544001643', '018544001643', 'Lohachura, Raninagar'),
(9, 'Kh Maks1sudul', 'kh.maksudusssdsdl.aladdm.cse@gmail.com', '01854400111643', '01854400161143', 'Lohachura, Raninagar'),
(11, 'Kh Maksudul Alam', 'hostinglagbefffgfgfgmarketingteam@gmail.com', '0171071098711', '0171071098711', 'Khandakar parar, Lohachura\r\nRaninagar'),
(13, 'Rakib', 'alam@dontsp.am', '01787203830', '01787203830', '24, JALAN 1/27B'),
(15, 'Rakibc', 'alavcm@dontsp.am', '017872038310', '017872031830', '24, JALAN 1/27B1'),
(16, 'ABDUL AOWAL KAZI', 'kh.maksuduladadadadad.alam.cse@gmail.com', '0112673032744', '0112673032744', '14, Jalan Manis 4, Taman Segar'),
(18, 'ABDUL AOWAL KAZI', 'kh.maksuduladadadadbfdfgad.alam.cse@gmail.com', '01126730327441', '01126730327441', '14, Jalan Manis 4, Taman Segar'),
(19, 'ABDUL AOWAL KAZffI', 'kh.maksuduladadadadbfdfgadf.alam.cse@gmail.com', '011267303274341', '01126730327341', '14, Jalan Manis 4, Taman Segar'),
(20, 'ABDUL AOWAL KAZffI', 'kh.maksuduladadadadbfefefdfgadf.alam.cse@gmail.com', '01126730324474341', '0112673032447341', '14, Jalan Manis 4, Taman Segar'),
(21, 'ABDUL AOWAL KAZffI', 'kh.maksuduladadadadddbfefefdfgadf.alam.cse@gmail.com', '0112673550324474341', '0112673032445557341', '14, Jalan Manis 4, Taman Segar'),
(22, 'ABDUL AOWAL 55KAZffI', 'kh.maksuduladadadadd55dbfefefdfgadf.alam.cse@gmail.com', '011267355032447455341', '011267303244555557341', '14, Jalan Manis 4, Taman Segar'),
(23, 'Kh Maksudul', 'dm@mksudulalam.com', '018500016431', '018500016431', 'Khandakar parar, Lohachura\r\nRaninagar'),
(24, 'Kh. Mahbubul', 'whmcs10tetete@lesdstsencode.com', '0178453248633', '0178453248633', 'Raninagar\r\nNaogoan');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `domain_name` varchar(255) NOT NULL,
  `package_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `domain_name`, `package_id`, `order_date`, `total_amount`) VALUES
(17, 16, 'letssssfencode.com', 2, '2025-02-18 00:28:02', 149.00),
(18, 16, 'letssssfencode.com', 2, '2025-02-18 00:29:41', 149.00),
(19, 16, 'letssssfencode.com', 2, '2025-02-18 00:30:19', 149.00),
(20, 18, 'letssssfen1code.com', 2, '2025-02-18 00:30:30', 149.00),
(21, 18, 'letssssfen1code.com', 2, '2025-02-18 00:30:30', 149.00),
(22, 19, 'letssssfen1cof3de.com', 2, '2025-02-18 00:31:22', 149.00),
(23, 19, 'letssssfen1cof3de.com', 2, '2025-02-18 00:31:22', 149.00),
(24, 20, 'letssssfen1c44of3de.com', 2, '2025-02-18 00:32:17', 149.00),
(25, 20, 'letssssfen1c44of3de.com', 2, '2025-02-18 00:32:18', 149.00),
(26, 20, 'letssssfen1c44of3de.com', 2, '2025-02-18 00:32:35', 149.00),
(27, 21, 'letssssfen1c4455of3de.com', 2, '2025-02-18 00:35:19', 149.00),
(28, 21, 'letssssfen1c4455of3de.com', 2, '2025-02-18 00:35:20', 149.00),
(29, 22, 'letssssfen1c45455of3de.com', 2, '2025-02-18 00:38:10', 149.00),
(30, 22, 'letssssfen1c45455of3de.com', 2, '2025-02-18 00:38:10', 149.00),
(31, 23, 'letsencdwdwdode.com', 1, '2025-02-18 00:39:26', 99.00),
(32, 23, 'letsencdwdwdode.com', 1, '2025-02-18 00:39:27', 99.00),
(33, 24, 'letsenssfsfsfsfcode.com', 3, '2025-02-18 00:40:30', 399.00),
(35, 2, 'letsencodde.com', 1, '2025-03-08 16:39:38', 99.00),
(36, 2, 'letsencodde.com', 1, '2025-03-08 16:39:38', 99.00),
(37, 2, 'letsencodde.com', 1, '2025-03-08 16:39:45', 99.00);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `features` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `price`, `description`, `features`) VALUES
(1, 'Starter', 99.00, 'A basic package suitable for small portfolios and individual professionals.', 'Custom web design, Free .com domain, Free hosting & SSL, SEO & Mobile friendly'),
(2, 'Standard', 149.00, 'A well-rounded package for businesses with branding integration and SEO optimization.', 'Branding integration, Social media setup, Business email setup, SEO & Security'),
(3, 'Advanced', 399.00, 'Advanced ecommerce package with complete store functionality and order management.', 'Ecommerce functionality, Payment integration, Order management, Marketing tools');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending',
  `payment_method` varchar(50) DEFAULT 'paypal',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `payment_gateway` varchar(50) NOT NULL DEFAULT 'PayPal',
  `paypal_client_id` varchar(255) DEFAULT NULL,
  `paypal_secret` varchar(255) DEFAULT NULL,
  `stripe_publishable_key` varchar(255) DEFAULT NULL,
  `stripe_secret_key` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(20) DEFAULT NULL,
  `smtp_username` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `email_from_name` varchar(255) DEFAULT 'Admin',
  `email_from_address` varchar(255) DEFAULT 'admin@example.com',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `payment_gateway`, `paypal_client_id`, `paypal_secret`, `stripe_publishable_key`, `stripe_secret_key`, `smtp_host`, `smtp_port`, `smtp_username`, `smtp_password`, `email_from_name`, `email_from_address`, `updated_at`) VALUES
(1, 'PayPal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Admin', 'admin@example.com', '2025-02-18 02:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','client') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`, `created_at`) VALUES
(20, 'Md Rahim', 'hostinglagbemarketingteam@gmail.com', '$2y$10$9IA40LIv0.A7ppVyt4FQAOmYChcj.eqzHEaTCBiAJMOSXHyOYuHI2', 'client', '2025-03-08 16:39:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `client_profiles`
--
ALTER TABLE `client_profiles`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id_idx` (`customer_id`),
  ADD KEY `package_id_idx` (`package_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD CONSTRAINT `admin_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_profiles`
--
ALTER TABLE `client_profiles`
  ADD CONSTRAINT `client_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD CONSTRAINT `support_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
