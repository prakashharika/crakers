-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 15, 2025 at 08:04 AM
-- Server version: 8.4.3
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boom`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

DROP TABLE IF EXISTS `advertisements`;
CREATE TABLE IF NOT EXISTS `advertisements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `property_id` bigint UNSIGNED NOT NULL,
  `seller_id` bigint UNSIGNED DEFAULT NULL,
  `ad_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `advertisements_property_id_foreign` (`property_id`),
  KEY `advertisements_seller_id_foreign` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `property_id`, `seller_id`, `ad_image`, `created_at`, `updated_at`) VALUES
(15, 28, NULL, 'advertisement/1738580562_IMAGE.png', '2025-02-03 11:02:42', '2025-02-03 11:02:42'),
(16, 29, NULL, 'advertisement/1738733705_main image.jpeg', '2025-02-03 11:09:13', '2025-02-05 05:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_details`
--

DROP TABLE IF EXISTS `general_details`;
CREATE TABLE IF NOT EXISTS `general_details` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `embaded` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_details`
--

INSERT INTO `general_details` (`id`, `logo`, `email`, `phone`, `address`, `instagram`, `linkedin`, `twitter`, `facebook`, `embaded`, `created_at`, `updated_at`) VALUES
(1, '1735188606.png', 'vcareupropertyservices@gmail.com', '+91 98403 96109, +91 98842 94365, +91 98404 31794', 'F-2 , First Floor, Plot No.10,\r\nThirumagal Nagar 1st Street,\r\nChitlapakkam,\r\nChennai-600 073,\r\nTamil Nadu. INDIA', 'https://www.instagram.com/', 'https://www.linkedin.com/', 'https://www.twitter.com/', 'https://www.facebook.com/', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.7829765566726!2d80.08951131108469!3d12.921665587336554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a525f722faf2fdf%3A0x8c73da26bfb432cd!2sJayam%20Web%20Solutions%20Pvt%20Ltd!5e0!3m2!1sen!2sin!4v1735187858396!5m2!1sen!2sin\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '2024-12-24 12:43:08', '2025-02-04 12:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `land_owners`
--

DROP TABLE IF EXISTS `land_owners`;
CREATE TABLE IF NOT EXISTS `land_owners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_this_whatsapp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `otp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `land_owners`
--

INSERT INTO `land_owners` (`id`, `name`, `email`, `phone_number`, `is_this_whatsapp`, `city`, `status`, `created_at`, `updated_at`, `otp`, `package_id`) VALUES
(5, 'Ram', 'jayamwebsolutions@gmail.com', '09876543210', 'on', 'Alaska', 1, '2024-12-06 00:02:28', '2024-12-06 00:02:28', NULL, NULL),
(6, 'Venki', 'jayamweb.developer@gmail.com', '09876543210', 'on', 'Alaska', 1, '2024-12-06 01:54:51', '2025-02-01 11:50:27', '$2y$12$z.8y0jmzKxaQtQTIHq/doOnHDkvOdGDQ8CreJk8TBmKc4OcmGoiXy', 1),
(7, 'Prakash', 'jayamweb.developer2@gmail.com', '09876543210', 'on', 'Alaska', 1, '2024-12-10 03:28:02', '2025-02-03 04:46:43', '$2y$12$X24FxHWYwwQPgpyb2vYXrOb48h8hqyS7eHDNkOWVe4vMvBMDYq4P.', 32),
(8, 'Maddy', 'prakash.m@jayamwebsolutions.com', '7452312542', 'off', 'chennai', 0, '2024-12-10 03:32:15', '2025-02-03 04:34:53', '$2y$12$oU.RvFKeLA8AwZTXkrBvlOef9x6dpH8Ot22Ch6vLlvqKWC6Ylu4gK', NULL),
(12, 'dfgdsfgdfg', 'fgsdg@dfgjhk.in', '4363462462', 'on', 'dfgssdfg', 0, '2024-12-11 04:43:13', '2024-12-11 04:43:16', NULL, 2),
(13, 'priya', 'admin@gmail.com', '9876543221', 'on', 'tambaram', 1, '2024-12-20 23:04:15', '2024-12-21 05:18:13', '$2y$12$5jGr7MlKSgQ54Bo1yVB5bu907amJeR5VuTRI3njg8IL9Oy8K6uLoq', 12),
(14, 'priya', 'someone@gmail.com', '9876543210', 'on', 'tambaram', 1, '2024-12-20 23:04:52', '2024-12-21 05:21:46', '$2y$12$O3PlMnfXRp1pJUa2conM0.AIjI3w8fh3sYA4sh36313BWnAKp5j8S', 11),
(15, 'g', 'hrllo@gmail.com', '8242222222', 'on', 't', 0, '2024-12-21 01:21:19', '2024-12-21 01:21:19', NULL, NULL),
(16, 'gy', 'clnt@gmail.com', '7896541230', 'on', 'tambaram', 0, '2024-12-21 05:16:30', '2024-12-21 05:16:30', NULL, NULL),
(17, 'test', 'test@gmail.com', '1234567890', 'on', 'tambaram', 0, '2024-12-21 12:08:22', '2024-12-23 11:16:06', '$2y$12$q53.L57c5thwc/Ce66jdBu/V9wkq1bknCtZZOtO7AKqr..Hdh9bXW', NULL),
(18, 'priyadarshini', 'priyadarshini@gmail.com', '3865213010', 'on', 'tambaram', 1, '2024-12-21 12:23:38', '2024-12-21 12:24:08', '$2y$12$ffDMXCV5bPyzLcfLBpP6Ju8rW3QQC/UkoShWjsG5U60fkyiyBQfF6', 20),
(19, 'find me', 'findme@gmail.com', '1234567890', 'on', 'tambaram', 0, '2024-12-21 12:34:46', '2024-12-21 12:34:46', NULL, NULL),
(20, 'jayamweb', 'designer@gmail.com', '9632145870', 'on', 'tambaram', 1, '2024-12-23 06:45:06', '2024-12-23 11:52:37', '$2y$12$lZ6JSsHG4f69lqLov82FXuULqR2g6S8S6gcmx3yhNZ234AuoWqDZe', 22),
(21, 'priyadarshini', 'priyadarshini0@gmail.com', '1236547890', 'on', 'tambaram', 1, '2024-12-23 10:55:10', '2024-12-23 12:09:01', '$2y$12$pZe2aU//GQCIaaibBUBQJee7dYHSh/Z6TU9FThKzzFZijUSg1y1Ci', 25),
(22, 'Prakash', 'prakash001@gmail.com', '9698647822', 'on', 'Perambalur', 1, '2024-12-23 11:10:29', '2024-12-23 11:11:24', '$2y$12$QBeMMIBRQL8Q3ZqVADNfV.4U4fyQXKykVqAx/fkf4otsMmVV8C682', 24),
(23, 'vacare', 'vcare@gmail.com', '1236547890', 'on', 'tambaram', 0, '2024-12-23 11:12:47', '2024-12-23 11:21:20', '$2y$12$X9YAl6RC86E5EM0gwW93/.rGoYolHj6GJURKpiaEAVBPwFagd0Zp6', NULL),
(24, 'Prakash', 'test4@gmail.com', '9698647822', 'on', 'Vijayapuram', 1, '2024-12-23 11:15:57', '2024-12-23 11:27:33', '$2y$12$0QFJ9jmnYH7lZ4pjcrC8p.n9D0eoZBJ2InjDHwt0LKoZ314BbRGN6', 26),
(25, 'hello', 'hello@gmail.com', '1234569870', 'on', 'tambaram', 1, '2024-12-23 11:28:38', '2024-12-23 11:30:29', '$2y$12$IXRzslthu48ub/fubPZ8Z.zauffsWtUZHMXUAbgen46dL6GutdRAK', 27),
(26, 'dharshini', 'dharshini@gmail.com', '9632587410', 'on', 'chennai', 1, '2024-12-23 12:11:33', '2024-12-23 12:28:39', '$2y$12$Lg1iBJZUe64lRLUsI7vG5uJ2y3gIQRJ/ISo7y5o0C.WNTy1dY7k5e', 29),
(27, 'riya', 'riya@gmail.com', '6325417890', 'on', 'tambaram', 0, '2024-12-23 12:30:36', '2024-12-23 12:30:36', NULL, NULL),
(28, 'Jewellery', 'gopi57485@gmail.com', '4654657687', 'on', 'chennai', 1, '2025-01-02 10:30:59', '2025-01-02 10:32:18', '$2y$12$9CrGOns8ms6ph0TDsAQFF.qGnir3AaIibCxqSS.Bk1kqS.VB9INXW', 31),
(29, 'Gasim Enking', 'rrszssjzziuj@dont-reply.me', '+14329676191', 'Glue Let s presence of the dense that they', 'Bogart', 0, '2025-01-16 02:18:00', '2025-01-16 02:18:00', NULL, NULL),
(30, 'Pittman Knoy', 'ablasmibmiuj@dont-reply.me', '+15055436512', 'Faster Just watch around but the sickbay as i asked Got it and', 'North Babylon', 0, '2025-01-26 16:15:07', '2025-01-26 16:15:07', NULL, NULL),
(31, 'Mahendran JayamWeb', 'mahendran.jayamweb@gmail.com', '6374444375', 'on', 'channai', 0, '2025-01-30 05:35:08', '2025-02-03 08:36:15', '$2y$12$a8gUb68XtblKyEq3KnQ1ruQ.vH6W4NWj.aNHQiH8XyXX.NNjI5V4u', NULL),
(32, 'Dinesh', 'dineshbabu.jws@gmail.com', '9876543210', 'on', 'Chennai', 1, '2025-02-04 08:25:41', '2025-02-04 08:33:39', '$2y$12$v/g77LTtUIKnjM0TKqJUKe7QyZ7YOhshNjD6QdPn.1b9mjbSNA8LS', 33);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_29_071354_create_properties_table', 2),
(8, '2024_12_02_043736_create_properties_lists_table', 3),
(9, '2024_12_02_113243_create_services_table', 4),
(11, '2024_12_05_071349_create_land_owners_table', 5),
(12, '2024_12_06_054943_create_packages_table', 6),
(15, '2024_12_10_102053_add_otp_to_land_owners_table', 7),
(16, '2024_12_11_071700_add_land_owner_id_to_properties_lists_table', 8),
(19, '2024_12_13_121714_add_plan_type_to_order_packages_table', 9),
(20, '2024_12_19_070903_create_sliders_table', 10),
(21, '2024_12_19_083101_create_terms_and_policies_table', 11),
(22, '2024_12_19_083102_create_terms_and_policies_table', 12),
(23, '2024_12_19_114414_create_sales_table', 13),
(24, '2024_12_20_070413_create_advertisements_table', 14),
(25, '2024_12_20_070413_create_advertisements_table2', 15),
(26, '2024_12_20_070415_create_advertisements_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `order_packages`
--

DROP TABLE IF EXISTS `order_packages`;
CREATE TABLE IF NOT EXISTS `order_packages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `land_owner_id` bigint UNSIGNED NOT NULL,
  `package_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `price_type` enum('month','year') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_property` int NOT NULL,
  `valid_days` int NOT NULL,
  `upto_images` int NOT NULL,
  `future_listing` int NOT NULL,
  `upto_videos` int NOT NULL,
  `payment_status` enum('success','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `plan_type` enum('past','present','future') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_packages_land_owner_id_foreign` (`land_owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_packages`
--

INSERT INTO `order_packages` (`id`, `land_owner_id`, `package_id`, `title`, `price`, `price_type`, `no_property`, `valid_days`, `upto_images`, `future_listing`, `upto_videos`, `payment_status`, `status`, `expire_date`, `created_at`, `updated_at`, `plan_type`, `start_date`) VALUES
(2, 6, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'active', '2025-03-11', '2024-12-11 06:26:36', '2024-12-11 06:26:36', 'past', NULL),
(4, 7, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'inactive', '2025-03-13', '2024-12-13 06:15:12', '2024-12-13 06:15:12', 'past', NULL),
(7, 7, 1, 'Basic', 1500, 'month', 1, 30, 3, 1, 2, 'success', 'inactive', '2025-04-12', '2024-12-13 07:00:58', '2024-12-13 07:00:58', 'future', '2025-03-13'),
(8, 7, 1, 'Basic', 1501, 'month', 1, 30, 3, 1, 2, 'success', 'inactive', '2025-05-12', '2024-12-20 02:01:29', '2024-12-20 02:01:29', 'future', '2025-04-12'),
(9, 7, 1, 'Basic', 1501, 'month', 1, 30, 3, 1, 2, 'success', 'inactive', '2025-01-19', '2024-12-20 02:02:35', '2025-01-18 18:30:02', 'past', '2024-12-20'),
(10, 14, 1, 'Basic', 1501, 'month', 1, 30, 3, 1, 2, 'success', 'inactive', '2025-01-20', '2024-12-20 23:05:00', '2025-01-19 18:30:03', 'past', '2024-12-21'),
(11, 14, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'active', '2025-03-21', '2024-12-20 23:05:05', '2024-12-20 23:05:05', 'present', '2024-12-21'),
(12, 13, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'active', '2025-03-21', '2024-12-21 02:57:38', '2024-12-21 02:57:38', 'present', '2024-12-21'),
(13, 13, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'inactive', '2025-06-19', '2024-12-21 02:57:39', '2024-12-21 02:57:39', 'future', '2025-03-21'),
(14, 13, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'inactive', '2025-06-19', '2024-12-21 02:57:39', '2024-12-21 02:57:39', 'future', '2025-03-21'),
(15, 13, 1, 'Basic', 1501, 'month', 1, 30, 3, 1, 2, 'success', 'inactive', '2025-04-20', '2024-12-21 02:57:40', '2024-12-21 02:57:40', 'future', '2025-03-21'),
(16, 13, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'inactive', '2025-06-19', '2024-12-21 02:57:48', '2024-12-21 02:57:48', 'future', '2025-03-21'),
(17, 13, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'inactive', '2025-06-19', '2024-12-21 05:16:36', '2024-12-21 05:16:36', 'future', '2025-03-21'),
(18, 7, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'inactive', '2025-04-19', '2024-12-21 05:23:53', '2024-12-21 05:23:53', 'future', '2025-01-19'),
(19, 7, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'inactive', '2025-04-19', '2024-12-21 12:08:36', '2024-12-21 12:08:36', 'future', '2025-01-19'),
(20, 18, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'active', '2025-03-21', '2024-12-21 12:23:58', '2024-12-21 12:23:58', 'present', '2024-12-21'),
(21, 18, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'inactive', '2025-06-19', '2024-12-21 12:35:00', '2024-12-21 12:35:00', 'future', '2025-03-21'),
(22, 20, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'active', '2025-03-23', '2024-12-23 06:45:14', '2024-12-23 06:45:14', 'present', '2024-12-23'),
(23, 20, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'inactive', '2025-06-21', '2024-12-23 10:55:23', '2024-12-23 10:55:23', 'future', '2025-03-23'),
(24, 22, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'active', '2025-03-23', '2024-12-23 11:10:32', '2024-12-23 11:10:32', 'present', '2024-12-23'),
(25, 21, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'active', '2025-03-23', '2024-12-23 11:12:51', '2024-12-23 11:12:51', 'present', '2024-12-23'),
(26, 24, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'active', '2025-03-23', '2024-12-23 11:16:02', '2024-12-23 11:16:02', 'present', '2024-12-23'),
(27, 25, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'active', '2025-03-23', '2024-12-23 11:28:41', '2024-12-23 11:28:41', 'present', '2024-12-23'),
(28, 21, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'inactive', '2025-06-21', '2024-12-23 12:11:49', '2024-12-23 12:11:49', 'future', '2025-03-23'),
(29, 26, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'active', '2025-03-23', '2024-12-23 12:28:39', '2024-12-23 12:28:39', 'present', '2024-12-23'),
(30, 26, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'inactive', '2025-06-21', '2024-12-23 12:30:41', '2024-12-23 12:30:41', 'future', '2025-03-23'),
(31, 28, 1, 'Basic', 1501, 'month', 1, 30, 3, 1, 2, 'success', 'inactive', '2025-02-01', '2025-01-02 10:31:07', '2025-01-31 18:30:04', 'past', '2025-01-02'),
(32, 7, 2, 'Professional', 4500, 'month', 5, 60, 5, 3, 1, 'success', 'active', '2025-04-02', '2025-02-01 11:23:34', '2025-02-01 11:23:34', 'present', '2025-02-01'),
(33, 32, 3, 'Premium', 7500, 'month', 10, 90, 7, 5, 3, 'success', 'active', '2025-05-05', '2025-02-04 08:27:27', '2025-02-04 08:27:27', 'present', '2025-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,0) NOT NULL,
  `price_type` enum('month','year') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `not_included` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `no_property_listing` int DEFAULT NULL,
  `property_visibility_days` int DEFAULT NULL,
  `upto_images` int DEFAULT NULL,
  `future_listing_days` int DEFAULT NULL,
  `upto_video` int DEFAULT NULL,
  `button_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `content`, `price`, `price_type`, `extra_features`, `not_included`, `no_property_listing`, `property_visibility_days`, `upto_images`, `future_listing_days`, `upto_video`, `button_title`, `created_at`, `updated_at`) VALUES
(1, 'Basic', 'Perfect for individual property owners', 1501, 'month', '[]', '[\"Featured listing\",\"Videos\",\"Social media sharing\"]', 1, 30, 3, 1, 2, 'Choose Basic', NULL, '2024-12-21 12:20:55'),
(2, 'Professional', 'Ideal for real estate agents', 4500, 'month', '[]', '[\"Social media sharing\"]', 5, 60, 5, 3, 1, 'Choose Professional', NULL, '2024-12-11 07:29:45'),
(3, 'Premium', 'Best for agencies and developers', 7500, 'month', '[\"Social media sharing\",\"Priority customer support\"]', '[]', 10, 90, 7, 5, 3, 'Choose Premium', NULL, '2024-12-10 01:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('jayamweb.developer2@gmail.com', '$2y$12$4PzzQiRc4GrIGc.raAJ32eL2OJyn2nozsQzMmUhRFo5c0cJ3LQoFa', '2024-12-21 05:33:30');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `name`, `image`, `description`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Apartments', 'properties/1734757290_apartments.jpg', 'Apartments', 1, 1, '2024-11-29 05:06:34', '2024-12-23 04:29:49'),
(2, 'Individual houses', 'properties/1738672540_landing page individual house.png', 'Individual houses', 3, 1, '2024-11-29 04:51:48', '2025-02-04 12:35:40'),
(3, 'Vacant Land', 'properties/1734928045_images.jpg', 'Vacant Land', 1, 1, '2024-11-29 04:52:05', '2024-12-23 08:34:11'),
(4, 'Commercial', 'properties/1734927905_e8469dafe0e75adb4b7f2199b5b8e8d7.jpg', 'Commercial', 1, 1, '2024-11-29 04:52:51', '2024-12-23 04:25:05'),
(5, 'VILLA', 'properties/1738672437_land page photo.jfif', 'Villa with Ground and First Floor and a open terrace with lift facility situated back side of Iskon Temple', 1, 1, '2024-11-29 04:53:11', '2025-02-04 12:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `properties_lists`
--

DROP TABLE IF EXISTS `properties_lists`;
CREATE TABLE IF NOT EXISTS `properties_lists` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `property_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `configuration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` bigint NOT NULL,
  `price_text` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_floors` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facing` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_age` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `optinal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `near_by_places` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_property` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `features` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `future_property` int DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `videos` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `land_owner_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `properties_lists_property_id_foreign` (`property_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties_lists`
--

INSERT INTO `properties_lists` (`id`, `property_id`, `title`, `area`, `configuration`, `location`, `price`, `price_text`, `address`, `total_floors`, `facing`, `property_age`, `optinal`, `near_by_places`, `about_property`, `features`, `future_property`, `status`, `images`, `videos`, `created_at`, `updated_at`, `land_owner_id`) VALUES
(28, 5, 'VILLA', '8000 Sq.Ft.,', '6 Bedrooms / 2 Kitchen / Dining / Utility / LIFT / Open Terrace', 'Iskon Temple Backside', 102500000, 'Market Rate', 'AKKARAI, ISKON TEMPLE BACK SIDE', '2', 'East Facing', '4 years old', NULL, '[{\"icon\":\"ri-ancient-gate-fill\",\"name\":\"ISKON TEMPLE BACKSIDE\"}]', 'Serene and Calm Villa away from the usual Hustle Bustle  with Lush Green Garden', '[{\"icon\":\"ri-run-fill\",\"name\":\"GYM\"}]', 0, '1', '[\"1738324883_1.jpeg\",\"1738324883_2.jpeg\",\"1738324883_3.jpeg\",\"1738578833_4.jpeg\",\"1738324883_5.jpeg\",\"1738324883_6.jpeg\",\"1738324883_7.jpeg\"]', '[]', '2025-01-31 12:01:23', '2025-02-05 09:45:50', NULL),
(29, 3, 'VACANT LAND @ THIRUVALLUR', '3.54 Acres', 'VACANT LAND', '15 KM FROM THIRUVALLUR COLLECTOR OFFICE', 106500000, 'PRICE NEGOTIABLE', 'ON THIRUVALLUR TO UTHUKOTTAI HIGHWAY', '', '', '', NULL, '[{\"icon\":\"ri-gas-station-line\",\"name\":\"GAS STATION\"}]', 'FULLY FENCED , CLEAR RECTANGULAR TYPE, SUITABLE FOR WARE HOUSE, LOGISTICS, CATTLE FARMING, GODWONS AND FACTORIES ETC', '[]', 0, '1', '[\"1738408074_1.jpeg\",\"1738408074_2.jpeg\",\"1738408074_3.jpeg\",\"1738408074_4.jpeg\",\"1738408074_5.jpeg\"]', '[]', '2025-02-01 11:07:54', '2025-02-04 11:36:45', NULL),
(33, 1, 'Test', '8000 Sq.Ft.,', '3 BHK', 'chennai', 1000000, 'all tax included', 'mudichur , bharathinagar', '3', 'EAST FACING', '5 years', NULL, '[{\"icon\":\"ri-shield-user-line\",\"name\":\"police station home backside\"},{\"icon\":\"ri-first-aid-kit-fill\",\"name\":\"near 2km\"},{\"icon\":\"ri-road-map-fill\",\"name\":\"50mns travel\"}]', 'very spacies and buget home', '[{\"icon\":\"ri-parking-line\",\"name\":\"breef parking space\"},{\"icon\":\"ri-mist-fill\",\"name\":\"24hrs swiming pool\"}]', 0, '1', '[\"1738660737_1.jpg\"]', '[]', '2025-02-04 09:18:57', '2025-02-05 04:38:53', NULL),
(34, 1, 'Radhika- jayam', '10000 sq.ft', 'Single Bed Room,Lift,With Restroom', 'Chennai Tamil Nadu', 200000, 'tax', '1/113 A East Street Avadi,chennai', '3', 'North', '2 Years', NULL, '[{\"icon\":\"ri-hotel-line\",\"name\":\"Radhika Hotel Avadi Chennai\"},{\"icon\":\"ri-film-line\",\"name\":\"RR Cinemas Avadi Chennai\"}]', 'Real estate is the buying, selling, and renting of properties, including land, buildings, and homes. It offers investment opportunities for both residential and commercial purposes.', '[{\"icon\":\"ri-parking-line\",\"name\":\"RR Parking Avadi chennai\"}]', 0, '1', '[\"1738747321_1.jpg\"]', '[]', '2025-02-05 09:16:09', '2025-02-05 10:43:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `register_posts`
--

DROP TABLE IF EXISTS `register_posts`;
CREATE TABLE IF NOT EXISTS `register_posts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `p1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `p2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `p3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `p1text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `p2text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `p3text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `btn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register_posts`
--

INSERT INTO `register_posts` (`id`, `title`, `subtitle`, `p1`, `p2`, `p3`, `p1text`, `p2text`, `p3text`, `btn`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Register to post your property', 'Sell Your Property', '10L+', '45L+', '2L+', 'Property Listings', 'Monthly Searches', 'Owners advertise monthly', 'Post your property', '1735042203.webp', '2024-12-24 11:57:29', '2024-12-24 12:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pro_id` int DEFAULT NULL,
  `isthiswhatsapp` enum('on','off') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `icon`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(24, 'ri-auction-fill', 'Identification of Property', '<p>At V Care U Property Services, we simplify the process of finding your ideal property. Whether you\'re looking for residential or commercial spaces, our team ensures tailored options that align with your preferences and budget. From prime locations to serene neighborhoods, we meticulously analyze market trends and property values to provide you with the best recommendations. Let us guide you in making informed decisions and finding a property that truly feels like home or aligns with your investment goal.</p>', 'uploads/services/1734947374.jpg', '2024-12-23 06:25:00', '2024-12-23 09:49:34'),
(27, 'ri-registered-fill', 'Legal Property Requirements', '<p>&nbsp;</p><p>Ensure compliance with all property regulations and legalities.Our team ensures that all properties are verified, legally compliant, and free of disputes. From title verification to compliance with local regulations, we handle every detail with precision. We provide expert guidance on property laws, ensuring your transactions are secure and hassle-free. Trust us to protect your interests while you focus on making the most of your investment.</p>', 'uploads/services/1734947507.jpg', '2024-12-23 09:51:47', '2024-12-23 09:52:20'),
(28, 'ri-pie-chart-2-fill', 'Housing Loans for Property', '<h2>&nbsp;</h2><p>At V Care U Property Services, we help you realize your dream of owning a property by assisting with housing loans. Our experts guide you through loan eligibility, application, and approval processes, ensuring smooth transactions. We collaborate with top financial institutions / NBFC\'s nationalized banks to provide competitive interest rates and flexible repayment options.</p>', 'uploads/services/1734947579.jpg', '2024-12-23 09:52:59', '2024-12-23 09:52:59'),
(29, 'ri-auction-fill', 'Documentation and Registration', '<h2>&nbsp;</h2><p>Ensure a smooth and efficient documentation and registration process with V Care U Property Services. We handle the preparation of sale deeds, agreements, and other critical paperwork with meticulous attention to detail. Our team ensures compliance with all legal and government requirements, saving you time and effort.</p>', 'uploads/services/1734949142.jpg', '2024-12-23 10:19:02', '2024-12-23 10:19:02'),
(30, 'ri-user-settings-fill', 'NRI Property Services', '<h2>&nbsp;</h2><p>V Care U Property Services specializes in catering to Non-Resident Indians (NRIs) looking to invest in or manage properties in India. We provide end-to-end services, from property selection to legal compliance and documentation. Our team addresses unique NRI challenges, such as tax implications, power of attorney, and property maintenance.</p>', 'uploads/services/1734949196.jpg', '2024-12-23 10:19:56', '2024-12-23 10:19:56'),
(31, NULL, 'Investment in Projects', '<h2>&nbsp;</h2><p>Maximize your returns by investing in lucrative projects with V Care U Property Services. We bring you exclusive opportunities in residential, commercial, and mixed-use developments. Our experts analyze market trends, project feasibility, and potential ROI to help you make informed decisions.</p>', 'uploads/services/1734949248.jpg', '2024-12-23 10:20:48', '2024-12-23 10:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BIXY5P37p2RgSyJEzmUmVw3dAS2mibHCZygu9Loq', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNEVWOW10b1R5Tm5kQ3d3dFlHWDBCMEt4NlFkZEpYWmJISGdFV0JqOCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vcHJvZmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1755243620),
('btZqDfo3SEfNGsqRjfAcgUIKPut0Atl7GsDtJmrT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRDdTTW1YWFhLMTlBb2tFZVQzbnZhOHJCVm5RdGVKSEpxRUZrcldHeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755243455),
('c14EU2nqmEvnAY3p1HShjaf5p6FsUQBHoSXj02Iu', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib1luVnZ4eFR1clA3c2ExekJYUll6RVdXSlhNOUMyOXVlZDVUUjhpSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1755242873),
('eEKPMnqRyPbmpWYZiEWgxRUQSiJJXZLUQagsZb7j', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVUQ3MTVlMGJHMzNOSXZDMzA3b0V6ampOVzJYV1RjYmw4ZXRGR09HRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9maWxlIjt9fQ==', 1755244975);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `title`, `description`, `created_at`, `updated_at`) VALUES
(2, '1738734727.jpg', 'Home is where your heart unfolds', '--', '2024-12-19 02:00:03', '2025-02-05 05:52:07'),
(4, '1734599672.jpg', 'Property Services - Identification to Occupation', '---', '2024-12-19 02:00:30', '2025-01-14 09:30:19'),
(5, '1734599689.png', 'Trusted, Dedicated and Dependable Services', '---', '2024-12-19 02:04:26', '2024-12-19 03:44:49'),
(8, '1734948673.png', 'Investment', 'Investment for vacre u', '2024-12-23 10:11:13', '2024-12-23 10:11:13');

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_policies`
--

DROP TABLE IF EXISTS `terms_and_policies`;
CREATE TABLE IF NOT EXISTS `terms_and_policies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms_and_policies`
--

INSERT INTO `terms_and_policies` (`id`, `content`, `created_at`, `updated_at`) VALUES
(1, '<h2>Terms and Conditions</h2><p><strong>Effective Date:</strong> November 27, 2024</p><p>Welcome to Vacreu Property Services! Please read the following Terms and Conditions carefully before using our website and services. By accessing or using our website, you agree to be bound by these Terms and Conditions.</p><h2>1. General Terms</h2><p>These Terms and Conditions govern your use of the Vacreu Property Services website and services. By accessing or using this website, you agree to comply with these terms and conditions and all applicable laws and regulations.</p><h2>2. Account Registration</h2><p>To use certain features of the website, you may be required to register for an account. You agree to provide accurate and complete information during the registration process and to update your details as necessary.</p><ul><li>You are responsible for maintaining the confidentiality of your account login information.</li><li>You agree to notify us immediately if you suspect any unauthorized use of your account.</li></ul><h2>3. Property Listings</h2><p>When listing a property on Vacreu Property Services, you must ensure that all information provided is accurate, truthful, and not misleading. You are responsible for updating your listings and ensuring that the property details are current.</p><h2>4. User Conduct</h2><p>You agree to use Vacreu Property Services in a lawful manner and refrain from engaging in the following activities:</p><ul><li>Posting false or misleading information.</li><li>Using the website for fraudulent or illegal activities.</li><li>Interfering with the functioning of the website or its services.</li></ul><h2>5. Privacy Policy</h2><p>By using our website, you agree to the terms of our Privacy Policy, which governs how we collect, use, and protect your personal information. You can review our Privacy Policy <a href=\"https://www.jayamdesigners.co.in/privacy-policy\">here</a>.</p><h2>6. Payment and Fees</h2><p>Vacreu Property Services may charge fees for certain services offered on the platform. All payments will be made through secure methods, and any applicable taxes or charges will be specified before payment is processed.</p><h2>7. Limitation of Liability</h2><p>Vacreu Property Services is not liable for any damages or losses arising from your use of the website or its services. We are not responsible for the accuracy of any property listings or the actions of other users.</p><h2>8. Termination of Access</h2><p>We reserve the right to suspend or terminate your access to Vacreu Property Services if we believe you have violated these Terms and Conditions or engaged in any unlawful activities.</p><h2>9. Changes to Terms</h2><p>We may update these Terms and Conditions from time to time. Any changes will be posted on this page, and the updated date will be indicated at the top. Please review these terms periodically to stay informed.</p><h2>10. Governing Law</h2><p>These Terms and Conditions are governed by the laws of India. Any disputes will be resolved in the appropriate courts of Chennai, India.</p><h2>11. Contact Us</h2><p>If you have any questions or concerns about these Terms and Conditions, please contact us at:</p><p><strong>Email:</strong> support@vacreu.com</p><p><strong>Phone:</strong> +91 1234567890</p><p><strong>Address:</strong> F1, First Floor, Plot No.10,<br>Thirumagal Nagar 1st Street,<br>Chitlapakkam,<br>Chennai-600 064.</p>', NULL, '2024-12-19 03:32:14'),
(2, '<h2>Privacy Policy</h2><p><strong>Effective Date:</strong> November 27, 2024</p><p>At Vcareu Property Services, we are committed to protecting your privacy and ensuring that your personal information is handled in a safe and responsible manner. This Privacy Policy outlines how we collect, use, and safeguard your information.</p><h2>1. Information We Collect</h2><p>We may collect the following information from you:</p><ul><li>Personal details such as name, email address, phone number, and mailing address.</li><li>Property preferences and details if you are listing or searching for properties.</li><li>Usage data such as IP address, browser type, and browsing behavior on our website.</li></ul><h2>2. How We Use Your Information</h2><p>We use the information we collect for the following purposes:</p><ul><li>To provide, operate, and improve our services.</li><li>To communicate with you about property listings, services, or inquiries.</li><li>To send promotional emails or offers related to our services (you can opt out anytime).</li><li>To ensure the security and functionality of our website.</li></ul><h2>3. Sharing Your Information</h2><p>We do not sell or rent your personal information to third parties. However, we may share your data with:</p><ul><li>Trusted service providers who assist us in operating our website and services.</li><li>Law enforcement agencies if required by law.</li><li>Potential buyers or tenants with your consent for property-related inquiries.</li></ul><h2>4. Security of Your Information</h2><p>We implement robust security measures to protect your personal data. However, no online service can guarantee absolute security. We recommend you keep your login credentials secure and report any unauthorized activity immediately.</p><h2>5. Your Rights</h2><p>You have the right to:</p><ul><li>Access and update your personal information.</li><li>Request deletion of your data (subject to legal obligations).</li><li>Opt out of marketing communications.</li></ul><h2>6. Cookies</h2><p>Our website uses cookies to enhance your browsing experience. Cookies help us understand user preferences and improve our services. You can manage your cookie settings through your browser preferences.</p><h2>7. Changes to This Policy</h2><p>We may update this Privacy Policy from time to time. The updated policy will be posted on this page with the revised date. Please review it periodically to stay informed.</p><h2>8. Contact Us</h2><p>If you have any questions about this Privacy Policy or how we handle your data, please contact us at:</p><p><strong>Email:</strong> support@Vcareu.com</p><p><strong>Phone:</strong> +91 1234567890</p><p><strong>Address:</strong> F1, First Floor, Plot No.10,<br>Thirumagal Nagar 1st Street,<br>Chitlapakkam,<br>Chennai-600 064.</p>', NULL, '2024-12-19 03:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'CPR Pyro Park', 'prakashbsc376@gmail.com', NULL, '$2y$12$C22Jj.aP3rwkPwBkdeyv/Os8FwrGaIrGt7RCKCLgswrg0QYZRPlIu', 'VlsFJESff1vPhKlrzGGDKYwV7ksmVCvn5XZHGUuFiktlxLx8SaxgSTcsCybG', '2024-11-28 01:30:08', '2025-08-15 07:26:04');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD CONSTRAINT `advertisements_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties_lists` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `advertisements_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `land_owners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_packages`
--
ALTER TABLE `order_packages`
  ADD CONSTRAINT `order_packages_land_owner_id_foreign` FOREIGN KEY (`land_owner_id`) REFERENCES `land_owners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties_lists`
--
ALTER TABLE `properties_lists`
  ADD CONSTRAINT `properties_lists_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
