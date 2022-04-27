-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 27, 2022 at 01:52 AM
-- Server version: 10.3.34-MariaDB-log-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybazuvf_vox`
--

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE `audits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint(20) UNSIGNED NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(1023) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audits`
--

INSERT INTO `audits` (`id`, `user_type`, `user_id`, `event`, `auditable_type`, `auditable_id`, `old_values`, `new_values`, `url`, `ip_address`, `user_agent`, `tags`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'created', 'App\\Models\\User', 1, '[]', '{\"name\":\"Developer\",\"email\":\"dev@test.com\",\"password\":\"$2y$10$T3NspuQLPE1mCtxYqvIgje0HJMbTCA8.QoyuoJEk1FaaG8lGubu8S\",\"id\":1}', 'http://localhost:8000/register', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', NULL, '2022-02-02 19:49:56', '2022-02-02 19:49:56'),
(2, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"password\":\"$2y$10$T3NspuQLPE1mCtxYqvIgje0HJMbTCA8.QoyuoJEk1FaaG8lGubu8S\"}', '{\"password\":\"$2y$10$TyBlpAztmEdz.eyjguHy0uZp7tg6F.JVkBrDsOXaSjgfx\\/i8UvkB.\"}', 'http://localhost:8000/admin/user-profile/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', NULL, '2022-02-02 20:32:47', '2022-02-02 20:32:47'),
(3, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"password\":\"$2y$10$TyBlpAztmEdz.eyjguHy0uZp7tg6F.JVkBrDsOXaSjgfx\\/i8UvkB.\",\"image\":null}', '{\"password\":\"$2y$10$m8RBVbWGTWgAgcxpG5XB2O\\/1\\/dF5v7L3JovT1P3T6indc3tYExwi.\",\"image\":\"1643835056_1.png\"}', 'http://localhost:8000/admin/user-profile/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', NULL, '2022-02-02 20:50:56', '2022-02-02 20:50:56'),
(4, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"password\":\"$2y$10$m8RBVbWGTWgAgcxpG5XB2O\\/1\\/dF5v7L3JovT1P3T6indc3tYExwi.\",\"image\":\"1643835056_1.png\"}', '{\"password\":\"$2y$10$BpksVgf6ySil3C4XOb60mezxX\\/Uyesous7yaNXSH\\/gjA886XZ08yy\",\"image\":\"1643835075_1.png\"}', 'http://localhost:8000/admin/user-profile/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', NULL, '2022-02-02 20:51:16', '2022-02-02 20:51:16'),
(5, NULL, NULL, 'updated', 'App\\Models\\User', 1, '{\"password\":\"$2y$10$BpksVgf6ySil3C4XOb60mezxX\\/Uyesous7yaNXSH\\/gjA886XZ08yy\",\"remember_token\":\"\"}', '{\"password\":\"$2y$10$x9qDiozbiS6FsOQsTXIQwufBRWc94252pGCe7aApkuZMKbm7wyp\\/.\",\"remember_token\":\"JauQJyKOyiDz3QF3599uVw4HyLk2Wk1P3uLufNcVyVo1O9ma3E6erGJY71mt\"}', 'http://localhost:8000/password/reset', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.74 Safari/537.36', NULL, '2022-03-21 14:33:21', '2022-03-21 14:33:21'),
(6, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"JauQJyKOyiDz3QF3599uVw4HyLk2Wk1P3uLufNcVyVo1O9ma3E6erGJY71mt\"}', '{\"remember_token\":\"VCMpqX0PEboFH9QG2ZJhfk8DKxeioR11m6K5mcdKFa53oRsyrIaLBaV729uL\"}', 'http://localhost:8000/admin/user-logout', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.74 Safari/537.36', NULL, '2022-03-21 14:34:04', '2022-03-21 14:34:04'),
(7, NULL, NULL, 'updated', 'App\\Models\\User', 1, '{\"password\":\"$2y$10$x9qDiozbiS6FsOQsTXIQwufBRWc94252pGCe7aApkuZMKbm7wyp\\/.\",\"remember_token\":\"VCMpqX0PEboFH9QG2ZJhfk8DKxeioR11m6K5mcdKFa53oRsyrIaLBaV729uL\"}', '{\"password\":\"$2y$10$76Y.cWd1gqBJl8xuzm47Nu0v.TKbMf3FUYyrqqWtjDoN8mXRMDOZa\",\"remember_token\":\"APkzpWPXRe6CQj5OOvkZ22Vpwwia4NZgMWVCHkcqUK8fImS1tJAoQl2APHnh\"}', 'http://localhost:8000/password/reset', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.74 Safari/537.36', NULL, '2022-03-21 14:41:27', '2022-03-21 14:41:27'),
(8, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"APkzpWPXRe6CQj5OOvkZ22Vpwwia4NZgMWVCHkcqUK8fImS1tJAoQl2APHnh\"}', '{\"remember_token\":\"Wbe7mqlx1wQdTe3xtKpODqPm5ASUQ6pqwK4gOrn3LxfKiF5cWzhzj93I76ik\"}', 'http://localhost:8000/admin/user-logout', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.74 Safari/537.36', NULL, '2022-03-21 14:41:44', '2022-03-21 14:41:44'),
(9, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"Wbe7mqlx1wQdTe3xtKpODqPm5ASUQ6pqwK4gOrn3LxfKiF5cWzhzj93I76ik\"}', '{\"remember_token\":\"gblyUBhYTPRViiRitZawXY5C8RIg8CyEUO3OpQwuNfxMEK9of8JhQ7I6bOIQ\"}', 'http://localhost:8000/admin/user-logout', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.74 Safari/537.36', NULL, '2022-03-21 17:03:21', '2022-03-21 17:03:21'),
(10, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"gblyUBhYTPRViiRitZawXY5C8RIg8CyEUO3OpQwuNfxMEK9of8JhQ7I6bOIQ\"}', '{\"remember_token\":\"0foKKyVsB9EodXcugwFGYtNGj5F6K5TTVCH2cXNVBvSFZPRk7IWp0BPBlI03\"}', 'http://localhost:8000/admin/user-logout', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.74 Safari/537.36', NULL, '2022-03-22 17:27:33', '2022-03-22 17:27:33'),
(11, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"0foKKyVsB9EodXcugwFGYtNGj5F6K5TTVCH2cXNVBvSFZPRk7IWp0BPBlI03\"}', '{\"remember_token\":\"E0sPl0UFpcCHwL9Yhx3snXRowFQBRRpVxvzTM7MpwVaoeHGv3PkTph4bMsYS\"}', 'http://localhost:8000/admin/user-logout', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:98.0) Gecko/20100101 Firefox/98.0', NULL, '2022-03-26 06:44:59', '2022-03-26 06:44:59'),
(12, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"E0sPl0UFpcCHwL9Yhx3snXRowFQBRRpVxvzTM7MpwVaoeHGv3PkTph4bMsYS\"}', '{\"remember_token\":\"TAM3ONCSDhFVF9AgzrpMi0OSOUQXQjmQM8iJK9pECzoSiwWCOA14PD0opDzv\"}', 'https://voxryde.com/admin/user-logout', '2402:3a80:1ac7:c858:3c7d:c843:5cba:dc05', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36', NULL, '2022-03-29 18:33:23', '2022-03-29 18:33:23'),
(13, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"TAM3ONCSDhFVF9AgzrpMi0OSOUQXQjmQM8iJK9pECzoSiwWCOA14PD0opDzv\"}', '{\"remember_token\":\"W63g56NDHYIOoxWpsjVP29Ei5uF75vb9DOfuTvC0PYEyzGIZoYu1Q03NVlFX\"}', 'https://voxryde.com/admin/user-logout', '116.206.58.193', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36', NULL, '2022-03-30 15:39:45', '2022-03-30 15:39:45'),
(14, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"W63g56NDHYIOoxWpsjVP29Ei5uF75vb9DOfuTvC0PYEyzGIZoYu1Q03NVlFX\"}', '{\"remember_token\":\"nWROWrCRDhuR3me2Kw00twYBBGqSuMiRS56lQsqu2Xz8F4Xx1cFHj4QqC0Zm\"}', 'https://voxryde.com/admin/user-logout', '75.34.153.36', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:98.0) Gecko/20100101 Firefox/98.0', NULL, '2022-04-01 04:53:33', '2022-04-01 04:53:33'),
(15, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"nWROWrCRDhuR3me2Kw00twYBBGqSuMiRS56lQsqu2Xz8F4Xx1cFHj4QqC0Zm\"}', '{\"remember_token\":\"SI7qlS4YqcR1tgcmcQil4phBtw4V60jTMgbHBQFyISGfSmUU4gCDZSIoH9Ft\"}', 'https://voxryde.com/admin/user-logout', '103.120.200.227', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.60 Safari/537.36', NULL, '2022-04-07 03:31:27', '2022-04-07 03:31:27'),
(16, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"SI7qlS4YqcR1tgcmcQil4phBtw4V60jTMgbHBQFyISGfSmUU4gCDZSIoH9Ft\"}', '{\"remember_token\":\"5cgs0a8t6pfqpHrxHshsOhseTkeTbGXMBSUcyoOo6s7nkvdpYn2d5JbpLSa9\"}', 'https://voxryde.com/admin/user-logout', '103.120.200.227', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.75 Safari/537.36', NULL, '2022-04-14 14:32:25', '2022-04-14 14:32:25'),
(17, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"5cgs0a8t6pfqpHrxHshsOhseTkeTbGXMBSUcyoOo6s7nkvdpYn2d5JbpLSa9\"}', '{\"remember_token\":\"3z1xptaCpqpuMZGrxLNtaXxJQ43Zf4cXWKt9AfEJZNGGzvk7gDUHLKK1NXUM\"}', 'https://voxryde.com/admin/user-logout', '103.120.200.227', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:99.0) Gecko/20100101 Firefox/99.0', NULL, '2022-04-14 16:28:49', '2022-04-14 16:28:49'),
(18, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"3z1xptaCpqpuMZGrxLNtaXxJQ43Zf4cXWKt9AfEJZNGGzvk7gDUHLKK1NXUM\"}', '{\"remember_token\":\"XziZ70FhSkCIyI7ZeSYNGKhQrOeDsHV2juRgnEwFfv0SSxGOdwKmFrfyNJeo\"}', 'https://voxryde.com/admin/user-logout', '103.120.200.227', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.75 Safari/537.36', NULL, '2022-04-14 18:00:42', '2022-04-14 18:00:42'),
(19, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"XziZ70FhSkCIyI7ZeSYNGKhQrOeDsHV2juRgnEwFfv0SSxGOdwKmFrfyNJeo\"}', '{\"remember_token\":\"DEfMMCPyWYsLcjf3zsVgNtKq9NWbZGpoWCbWZIfAZDqHg5XUZZI6VeegQhVF\"}', 'https://voxryde.com/admin/user-logout', '103.120.200.227', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.75 Safari/537.36', NULL, '2022-04-16 01:50:05', '2022-04-16 01:50:05'),
(20, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"DEfMMCPyWYsLcjf3zsVgNtKq9NWbZGpoWCbWZIfAZDqHg5XUZZI6VeegQhVF\"}', '{\"remember_token\":\"pg6B6zkaQZ1iRBk6VuC5YVStxn7dcNoSHeXvIC2SViDflKQTvPWRxBgGg9or\"}', 'https://voxryde.com/admin/user-logout', '103.120.200.227', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.75 Safari/537.36', NULL, '2022-04-16 01:54:48', '2022-04-16 01:54:48'),
(21, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"pg6B6zkaQZ1iRBk6VuC5YVStxn7dcNoSHeXvIC2SViDflKQTvPWRxBgGg9or\"}', '{\"remember_token\":\"N3KOocCdWajXTNsubeJV3x1t1hhGLIxbnXhJKpp6o6pMNeeDkIDVwWsaXypC\"}', 'https://voxryde.com/admin/user-logout', '103.120.200.227', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.75 Safari/537.36', NULL, '2022-04-16 02:03:28', '2022-04-16 02:03:28'),
(22, 'App\\Models\\User', 1, 'updated', 'App\\Models\\User', 1, '{\"remember_token\":\"N3KOocCdWajXTNsubeJV3x1t1hhGLIxbnXhJKpp6o6pMNeeDkIDVwWsaXypC\"}', '{\"remember_token\":\"cyzi2zWAGrrifWVxrknvJ5OF4cN6p1pmdt3jxo2ENOx1OpqgzKj0lbb8PhGv\"}', 'https://voxryde.com/admin/user-logout', '103.120.200.227', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36', NULL, '2022-04-20 21:34:31', '2022-04-20 21:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_registration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'See enum class',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `email`, `password`, `phone`, `image`, `address`, `company_name`, `company_registration`, `company_address`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Test Customer', 'customer@customer.com', '$2y$10$BpksVgf6ySil3C4XOb60mezxX/Uyesous7yaNXSH/gjA886XZ08yy', '12345678', 'customer.png', 'Megan Fox Address', 'Megan Fox', 'Registered', 'Megan Fox Company Address', 'active', '2022-03-05 07:21:06', '2022-03-05 07:21:06'),
(3, 'Christine August', 'chirstine@user.com', '$2y$10$PPVdO6rquywI6sdwA98WG.mq0L81ROhU80VxcLlQWacmjwNt.8sBy', '123456', 'customer.png', 'Christine Adrress', 'Personal', 'CP123456', 'West Dakota', 'inactive', '2022-03-05 13:34:00', '2022-03-05 13:34:00'),
(4, 'Chafiullah Shuvo', 'shuvo.sam2012@gmail.com', '$2y$10$LuaXV3zFY5OPc7zu0.lL8.fRArHtyJ0YjMiuCNRshAm8MFz6U9qh.', '01730159866', 'customer.png', 'lane street', NULL, NULL, NULL, 'active', '2022-04-07 03:35:14', '2022-04-07 03:35:14'),
(5, 'Test Customer', 'testcustomer1@test.com', '$2y$10$Eg41wvXMcUcxU9/gUiHH1.NDPuCEwst9ZhSLTcJTItRlLavXT3k7e', '01521211335', 'customer.png', 'Cumilla', NULL, NULL, NULL, 'active', '2022-04-16 18:25:06', '2022-04-16 18:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `customer_documents`
--

CREATE TABLE `customer_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL COMMENT 'customer_table_primary_key',
  `document_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_documents`
--

INSERT INTO `customer_documents` (`id`, `customer_id`, `document_name`, `document`, `expiry_date`, `created_at`, `updated_at`) VALUES
(4, 2, 'Test Doc', '1650038430_customer_2.html', '2022-04-15', '2022-04-16 02:00:30', '2022-04-16 02:00:30');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'blocked' COMMENT 'See the enum class',
  `vehicle_type` int(10) UNSIGNED NOT NULL,
  `vehicle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `email`, `contact`, `password`, `image`, `status`, `vehicle_type`, `vehicle_name`, `vehicle_color`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(2, 'Simon', 'driver@driver.com', '9800308', '$2y$10$BpksVgf6ySil3C4XOb60mezxX/Uyesous7yaNXSH/gjA886XZ08yy', 'Simon_1644031575_profile.png', 'approved', 2, 'Toyota', 'White', 23.7797376, 90.3970816, '2022-02-03 14:22:53', '2022-04-26 04:19:24'),
(3, 'David', 'david@driver.com', '9800418', '$2y$10$6/.jmoHJ3i2Ol/hR/qdzkuJdVVgIDUkL8rRfhE3MbiCMNGUunU4u2', 'David_1644031245_profile.png', 'approved', 2, 'Ford', 'Black', 0, NULL, '2022-02-05 03:20:45', '2022-02-05 03:20:45'),
(4, 'Joseph', 'josh@mail.com', '123456', '$2y$10$BOOqgZlKDdJdiMGo8SyYpelyiZk05eXgIGg9QxSXSrmEgx.FyGE2a', NULL, 'approved', 2, 'Toyota', 'White', 0, NULL, '2022-03-05 13:54:16', '2022-03-05 13:59:06'),
(7, 'Test Driver', 'driver@test.com', '123456789', '$2y$10$Y772y3m/2mOGyvuIwweRaOSc47byN8/9HqE/6vMss.CQIwjyne.bS', NULL, 'blocked', 2, 'Van', 'white', 0, NULL, '2022-04-14 18:02:50', '2022-04-14 18:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `driver_documents`
--

CREATE TABLE `driver_documents` (
  `id` int(11) NOT NULL,
  `driver_id` int(10) UNSIGNED NOT NULL,
  `document_id` int(10) UNSIGNED NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_documents`
--

INSERT INTO `driver_documents` (`id`, `driver_id`, `document_id`, `file`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2_2_1650035588.html', '2022-04-16 01:13:08', '2022-04-16 01:13:08'),
(2, 2, 3, '2_3_1650035588.html', '2022-04-16 01:13:08', '2022-04-16 01:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `driver_orders`
--

CREATE TABLE `driver_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `driver_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_orders`
--

INSERT INTO `driver_orders` (`id`, `order_id`, `driver_id`, `created_at`, `updated_at`) VALUES
(3, 2, 3, '2022-04-26 03:54:21', '2022-04-26 03:54:21'),
(4, 1, 2, '2022-04-26 04:23:07', '2022-04-26 04:23:07'),
(5, 2, 2, '2022-04-26 04:45:32', '2022-04-26 04:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2021_11_18_101840_create_audits_table', 1),
(4, '2021_11_24_144150_create_permission_tables', 1),
(5, '2014_10_12_000000_create_users_table', 2),
(6, '2014_10_12_100000_create_password_resets_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `map_lat` double NOT NULL,
  `map_long` double NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parcel_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` double NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placement_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'placed' COMMENT 'See DeliveryStatus enum class',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `address`, `map_lat`, `map_long`, `name`, `phone`, `email`, `parcel_name`, `weight`, `details`, `additional_note`, `placement_status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Azampur Kaca Bazar, Uttara, Dhaka, Bangladesh', 23.8713307, 90.4042719, 'Test', '01521211335', 'shuvo.sam2012@gmail.com', 'Test Parcel', 5, 'Test', NULL, 'completed', '2022-04-26 02:59:39', '2022-04-26 03:00:32'),
(2, 2, 'Dhaka New Market, Mirpur Road, Dhaka, Bangladesh', 23.7331937, 90.3837664, 'Person Name', '01521211335', 'admin@admin.com', 'Person', 45, 'Test', NULL, 'completed', '2022-04-26 03:50:26', '2022-04-26 03:52:12');

-- --------------------------------------------------------

--
-- Table structure for table `orders_deliver_details`
--

CREATE TABLE `orders_deliver_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) UNSIGNED NOT NULL COMMENT 'orders table primary key',
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `map_lat` double NOT NULL,
  `map_long` double NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_deliver_details`
--

INSERT INTO `orders_deliver_details` (`id`, `order_id`, `address`, `map_lat`, `map_long`, `name`, `phone`, `email`, `details`, `created_at`, `updated_at`) VALUES
(1, 1, 'RUET Main Gate, Rajshahi, Bangladesh', 24.36277029999999, 88.6288943, 'NAIM', '1122334455', 'teacher@jaycollege.com', 'Test', '2022-04-26 03:00:13', '2022-04-26 03:00:13'),
(2, 2, 'Mawa Ferry Ghat, Mawa, Bangladesh', 23.4654339, 90.2872848, 'Person 2', '01730159866', 'admin@gmail.com', 'Test', '2022-04-26 03:51:08', '2022-04-26 03:51:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `preferred_vehicle` int(10) UNSIGNED NOT NULL,
  `distance` double NOT NULL,
  `price` int(11) UNSIGNED DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'See the ENUM class for this',
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'See the ENUM class for this',
  `delivery_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'See the ENUM class for this',
  `received_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `date`, `preferred_vehicle`, `distance`, `price`, `payment_type`, `payment_status`, `delivery_status`, `received_by`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-04-25', 2, 233, 932, 'cash', 'paid', 'delivered', 'Delivered to mister X', '2022-04-26 03:00:32', '2022-04-26 04:44:50'),
(2, 2, '2022-04-25', 2, 45, 180, 'cash', 'pending', 'accepted', NULL, '2022-04-26 03:52:12', '2022-04-26 04:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `order_timelines`
--

CREATE TABLE `order_timelines` (
  `id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) UNSIGNED NOT NULL,
  `delivery_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_timelines`
--

INSERT INTO `order_timelines` (`id`, `order_id`, `delivery_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'accepted', '2022-04-26 04:23:07', '2022-04-26 04:23:07'),
(2, 1, 'pick_start', '2022-04-26 04:42:54', '2022-04-26 04:42:54'),
(3, 1, 'arrived_pick_location', '2022-04-26 04:43:08', '2022-04-26 04:43:08'),
(4, 1, 'picked', '2022-04-26 04:43:19', '2022-04-26 04:43:19'),
(5, 1, 'drop_start', '2022-04-26 04:43:34', '2022-04-26 04:43:34'),
(6, 1, 'dropped', '2022-04-26 04:43:41', '2022-04-26 04:43:41'),
(7, 1, 'delivered', '2022-04-26 04:44:50', '2022-04-26 04:44:50'),
(8, 2, 'accepted', '2022-04-26 04:45:32', '2022-04-26 04:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` int(10) NOT NULL,
  `otp` int(10) NOT NULL,
  `order_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('shuvo.sam2012@gmail.com', '$2y$10$v.SPa3j.BH325tOkpw1Lpuqig2cYnVins/ns1Ka15byPBagxWn28q', '2022-03-21 14:59:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_customers`
--

CREATE TABLE `password_reset_customers` (
  `id` int(10) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_customers`
--

INSERT INTO `password_reset_customers` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(2, 'shuvo.sam2012@gmail.com', 'hjDevixdEk1AufVN0bj1oHOpsWtnWLmUvZgWa9JPL0VQ3ADIJ9l4nXrR6LzvXYZe', '2022-03-21 15:28:50', '2022-03-21 15:28:50'),
(3, 'shuvo.sam2012@gmail.com', 'blSGRsCa2HbFPwmigtXDV82ryOMBlUQdRr8DcPhe4MgrzhWbezlq5v5mnGi0FhzS', '2022-03-21 15:36:41', '2022-03-21 15:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'add-user', 'web', '2022-03-01 11:09:38', '2022-03-01 11:09:38');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(25, 'App\\Models\\Customer', 2, 'token', 'ec4ece8de01f0bc95cffef983485e7e5fcca4db7f2d7bb5981fd6e09a17e3fd7', '[\"*\"]', NULL, '2022-04-21 17:25:42', '2022-04-21 17:25:42'),
(26, 'App\\Models\\Customer', 2, 'token', 'e8397f1eb16c444989dadc48ce14b790943817c8638c5e482d97db44750f3074', '[\"*\"]', '2022-04-21 17:33:09', '2022-04-21 17:29:30', '2022-04-21 17:33:09'),
(27, 'App\\Models\\Customer', 2, 'token', 'ea94acb92ba58d38e3bf14c0e5306135b7dac0a4666d1f868837c445ead3def1', '[\"*\"]', '2022-04-21 17:33:21', '2022-04-21 17:33:14', '2022-04-21 17:33:21'),
(28, 'App\\Models\\Customer', 2, 'token', '7ca15a64ac2c9f7441302e02117324bbd695674e5c7e9f69a471ffcfff3974ce', '[\"*\"]', '2022-04-21 17:49:50', '2022-04-21 17:34:09', '2022-04-21 17:49:50'),
(29, 'App\\Models\\Customer', 2, 'token', '116f24c9907f8eaccf3aad556e114b664a7bff5d980978ede9fbecd6192b9927', '[\"*\"]', '2022-04-21 17:50:21', '2022-04-21 17:50:04', '2022-04-21 17:50:21'),
(30, 'App\\Models\\Customer', 2, 'token', '34283bf4b3cf9b86b83235966a6d0489c4d6d3abbbb2b8581b125d615d54417c', '[\"*\"]', NULL, '2022-04-21 18:11:20', '2022-04-21 18:11:20'),
(31, 'App\\Models\\Customer', 4, 'token', '0177957d5bb754144944f5efcafb5bd74412b276b0a20a50d379aad7bcdc8c7a', '[\"*\"]', '2022-04-23 05:00:36', '2022-04-23 04:54:04', '2022-04-23 05:00:36'),
(32, 'App\\Models\\Customer', 2, 'token', 'b1a3b55f89f3c6ad05d58f5fe15945d252b43dc89b5204130f53caca5e6427ca', '[\"*\"]', '2022-04-23 04:59:20', '2022-04-23 04:55:37', '2022-04-23 04:59:20'),
(33, 'App\\Models\\Customer', 2, 'token', '0c38cf0d86ce119b0bd31418b1e6ff9f0cbb0588ebaa7da8bdf62fdd3cc06a27', '[\"*\"]', '2022-04-23 18:21:21', '2022-04-23 05:01:53', '2022-04-23 18:21:21'),
(34, 'App\\Models\\Customer', 2, 'token', 'd9d94c0a0899469481d21cf49d6481a3313e2e4343b732762a743604ffb3bdef', '[\"*\"]', NULL, '2022-04-23 05:07:18', '2022-04-23 05:07:18'),
(35, 'App\\Models\\Customer', 2, 'token', 'ff3df44f5d1445b314707580a10ac4078ba0daba48349fc80a07c8976887b20f', '[\"*\"]', NULL, '2022-04-23 17:43:07', '2022-04-23 17:43:07'),
(36, 'App\\Models\\Customer', 2, 'token', '7e1394f8c03370eba4ec7537d7d01e60e311113e7d9b56d1e0ddd6e36b58bb96', '[\"*\"]', '2022-04-23 19:56:39', '2022-04-23 18:21:23', '2022-04-23 19:56:39'),
(37, 'App\\Models\\Customer', 2, 'token', '43808e457b572cf1b8a7d8546e50dc8d97a53ce0e15fe42ef6d5cfe389fcee44', '[\"*\"]', NULL, '2022-04-23 19:50:22', '2022-04-23 19:50:22'),
(38, 'App\\Models\\Customer', 2, 'token', '002472297562a573eb1d74bcc1240e9218b3b69bfa71721c0b1c81c98f35ac1e', '[\"*\"]', NULL, '2022-04-23 19:52:41', '2022-04-23 19:52:41'),
(39, 'App\\Models\\Customer', 2, 'token', 'fd5157a699daf925b645673680c79c66bb15e6de52a9673455afbea48081db55', '[\"*\"]', '2022-04-23 20:18:01', '2022-04-23 20:03:25', '2022-04-23 20:18:01'),
(40, 'App\\Models\\Customer', 2, 'token', '4fa26fbf5c794745f198e85db74127c30d6e09e8cda6031c88a9c759655e31cb', '[\"*\"]', '2022-04-23 21:21:10', '2022-04-23 20:04:47', '2022-04-23 21:21:10'),
(41, 'App\\Models\\Customer', 2, 'token', '68459451a51e614e3aae1358f87b440f3e62bfc34e48049ba6d92c319373c470', '[\"*\"]', '2022-04-23 20:54:07', '2022-04-23 20:32:37', '2022-04-23 20:54:07'),
(42, 'App\\Models\\Customer', 2, 'token', '6bbc579058d5be339190513f7f58681b955c4097ed06de6c62489943c1d50f2d', '[\"*\"]', '2022-04-23 20:54:51', '2022-04-23 20:47:42', '2022-04-23 20:54:51'),
(43, 'App\\Models\\Customer', 2, 'token', '7dff3002e9dda741b84dbb4335c717df646cca33a0cae41184c9619e2058eae1', '[\"*\"]', NULL, '2022-04-24 03:08:53', '2022-04-24 03:08:53'),
(44, 'App\\Models\\Customer', 2, 'token', '80ac7998ca8b0b74126b9a54dad7097ebeb61a65d7b2fa4ddac0ad53a745e39a', '[\"*\"]', NULL, '2022-04-24 03:13:48', '2022-04-24 03:13:48'),
(45, 'App\\Models\\Customer', 2, 'token', 'fbc94e555d67068f86751cdb1d1946f99c70a3d673a0025da37f3c3aed5d5d62', '[\"*\"]', NULL, '2022-04-24 03:54:02', '2022-04-24 03:54:02'),
(46, 'App\\Models\\Customer', 2, 'token', 'ff88f9591c5be7f0d95837d48f81e1f863a53a93b50c15c5acc79fc1adb56c76', '[\"*\"]', NULL, '2022-04-24 04:03:15', '2022-04-24 04:03:15'),
(47, 'App\\Models\\Customer', 2, 'token', '2c59447f31351481c4cce1672c6d69289c7fc624fe6e2c16e539e96b7ecc10ed', '[\"*\"]', NULL, '2022-04-25 03:43:27', '2022-04-25 03:43:27');

-- --------------------------------------------------------

--
-- Table structure for table `pricings`
--

CREATE TABLE `pricings` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_type` int(10) UNSIGNED NOT NULL,
  `service_charge_km` double NOT NULL,
  `price_per_km` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricings`
--

INSERT INTO `pricings` (`id`, `vehicle_type`, `service_charge_km`, `price_per_km`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, '2022-02-04 13:13:08', '2022-02-04 13:34:32'),
(2, 3, 3, 3, '2022-02-04 13:34:46', '2022-02-04 13:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `required_documents_driver`
--

CREATE TABLE `required_documents_driver` (
  `id` int(10) UNSIGNED NOT NULL,
  `document_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `required_level` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `required_documents_driver`
--

INSERT INTO `required_documents_driver` (`id`, `document_name`, `required_level`, `created_at`, `updated_at`) VALUES
(2, 'Car Registration Paper Soft Copy', 'High', '2022-04-14 15:48:17', '2022-04-14 15:48:17'),
(3, 'Car Plate Image', 'High', '2022-04-14 15:48:29', '2022-04-14 15:48:29'),
(4, 'Agreement with VoX', 'High', '2022-04-14 15:48:43', '2022-04-14 15:48:43'),
(5, 'ID Card', 'Optional', '2022-04-14 15:48:53', '2022-04-14 15:48:53'),
(6, 'Passport', 'Optional', '2022-04-14 15:49:01', '2022-04-14 15:49:01'),
(7, 'Valid Driver License', 'High', '2022-04-14 19:53:27', '2022-04-14 19:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-inactive, 1-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact`, `password`, `remember_token`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Developer', 'shuvo.sam2012@gmail.com', '01730159866', '$2y$10$76Y.cWd1gqBJl8xuzm47Nu0v.TKbMf3FUYyrqqWtjDoN8mXRMDOZa', 'cyzi2zWAGrrifWVxrknvJ5OF4cN6p1pmdt3jxo2ENOx1OpqgzKj0lbb8PhGv', '1643835075_1.png', 1, '2022-02-02 19:49:56', '2022-03-21 14:41:27');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selected_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `name`, `icon`, `selected_icon`, `created_at`, `updated_at`) VALUES
(2, 'Van', '1643893867_icon.png', '1643893867_selected_icon.png', '2022-02-03 13:11:07', '2022-02-03 13:11:07'),
(3, 'Truck', '1643981446_icon.png', '1643981446_selected_icon.png', '2022-02-04 13:30:46', '2022-02-04 13:30:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  ADD KEY `audits_user_id_user_type_index` (`user_id`,`user_type`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `company_registration` (`company_registration`);

--
-- Indexes for table `customer_documents`
--
ALTER TABLE `customer_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_foreign_key` (`customer_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact` (`contact`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `vehicle_id_foreign_key` (`vehicle_type`);

--
-- Indexes for table `driver_documents`
--
ALTER TABLE `driver_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_documents_fk_0` (`driver_id`),
  ADD KEY `driver_documents_fk_1` (`document_id`);

--
-- Indexes for table `driver_orders`
--
ALTER TABLE `driver_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_orders_fk_0` (`driver_id`),
  ADD KEY `driver_orders_fk_1` (`order_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_fk_0` (`customer_id`);

--
-- Indexes for table `orders_deliver_details`
--
ALTER TABLE `orders_deliver_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_detail_fk_0` (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_fk_0` (`order_id`),
  ADD KEY `order_details_fk_1` (`preferred_vehicle`);

--
-- Indexes for table `order_timelines`
--
ALTER TABLE `order_timelines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_timelines_fk_0` (`order_id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_customers`
--
ALTER TABLE `password_reset_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pricings`
--
ALTER TABLE `pricings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicle_type` (`vehicle_type`);

--
-- Indexes for table `required_documents_driver`
--
ALTER TABLE `required_documents_driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `contact` (`contact`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_documents`
--
ALTER TABLE `customer_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `driver_documents`
--
ALTER TABLE `driver_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `driver_orders`
--
ALTER TABLE `driver_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders_deliver_details`
--
ALTER TABLE `orders_deliver_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_timelines`
--
ALTER TABLE `order_timelines`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `password_reset_customers`
--
ALTER TABLE `password_reset_customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pricings`
--
ALTER TABLE `pricings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `required_documents_driver`
--
ALTER TABLE `required_documents_driver`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_documents`
--
ALTER TABLE `customer_documents`
  ADD CONSTRAINT `customer_foreign_key` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `vehicle_id_foreign_key` FOREIGN KEY (`vehicle_type`) REFERENCES `vehicle_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `driver_documents`
--
ALTER TABLE `driver_documents`
  ADD CONSTRAINT `driver_documents_fk_0` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `driver_documents_fk_1` FOREIGN KEY (`document_id`) REFERENCES `required_documents_driver` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `driver_orders`
--
ALTER TABLE `driver_orders`
  ADD CONSTRAINT `driver_orders_fk_0` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `driver_orders_fk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_fk_0` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_deliver_details`
--
ALTER TABLE `orders_deliver_details`
  ADD CONSTRAINT `orders_detail_fk_0` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_fk_0` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_fk_1` FOREIGN KEY (`preferred_vehicle`) REFERENCES `vehicle_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_timelines`
--
ALTER TABLE `order_timelines`
  ADD CONSTRAINT `order_timelines_fk_0` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pricings`
--
ALTER TABLE `pricings`
  ADD CONSTRAINT `vehicle_type_foreign_key` FOREIGN KEY (`vehicle_type`) REFERENCES `vehicle_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
