-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 13, 2025 at 02:29 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projonmo`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('projonmo-unnayan-mission-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1765124855),
('projonmo-unnayan-mission-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1765124855;', 1765124855),
('projonmo-unnayan-mission-cache-77de68daecd823babbb58edb1c8e14d7106e83bb', 'i:1;', 1765122400),
('projonmo-unnayan-mission-cache-77de68daecd823babbb58edb1c8e14d7106e83bb:timer', 'i:1765122400;', 1765122400),
('projonmo-unnayan-mission-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:1;', 1765280200),
('projonmo-unnayan-mission-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1765280200;', 1765280200),
('projonmo-unnayan-mission-cache-setting_currency', 's:3:\"BDT\";', 1765368915),
('projonmo-unnayan-mission-cache-setting_currency_symbol', 's:3:\"৳\";', 1765368915),
('projonmo-unnayan-mission-cache-setting_monthly_fee', 's:3:\"500\";', 1765368889),
('projonmo-unnayan-mission-cache-setting_organization_address', 's:38:\"ঢাকা, বাংলাদেশ\";', 1765368915),
('projonmo-unnayan-mission-cache-setting_organization_established_month', 's:2:\"11\";', 1765368889),
('projonmo-unnayan-mission-cache-setting_organization_established_year', 's:4:\"2024\";', 1765368889),
('projonmo-unnayan-mission-cache-setting_organization_logo', 's:50:\"logos/GFcJCp6LROx1uC4t0iCoJc3ck9JTffmGFz0O9b6n.png\";', 1765637416),
('projonmo-unnayan-mission-cache-setting_organization_name', 's:56:\"প্রজন্ম উন্নয়ন মিশন\";', 1765637416),
('projonmo-unnayan-mission-cache-setting_organization_name_en', 's:25:\"Projonmo Unnayan Mission1\";', 1765368915),
('projonmo-unnayan-mission-cache-setting_organization_phone', 's:11:\"01700000000\";', 1765368915),
('projonmo-unnayan-mission-cache-tyro:user:1:roles', 'a:3:{i:0;s:5:\"admin\";i:1;s:5:\"admin\";i:2;s:6:\"member\";}', 1765365588),
('projonmo-unnayan-mission-cache-tyro:user:2:roles', 'a:1:{i:0;s:6:\"member\";}', 1765280784),
('projonmo-unnayan-mission-cache-tyro:user:3:roles', 'a:1:{i:0;s:10:\"accountant\";}', 1765124888);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2022_05_17_181447_create_roles_table', 1),
(5, '2022_05_17_181456_create_user_roles_table', 1),
(6, '2025_01_01_000001_create_privileges_table', 1),
(7, '2025_01_01_000002_create_privilege_role_table', 1),
(8, '2025_01_01_000003_add_suspension_columns_to_users_table', 1),
(9, '2025_12_02_103302_create_personal_access_tokens_table', 1),
(10, '2025_12_02_105734_create_payments_table', 1),
(11, '2025_12_02_105751_create_settings_table', 1),
(12, '2025_12_03_000001_add_membership_id_to_users_table', 2),
(13, '2025_12_03_000002_create_payment_methods_table', 2),
(14, '2025_12_03_000003_modify_payments_table', 2),
(15, '2025_12_03_000004_create_notifications_table', 2),
(17, '2025_12_04_043711_add_address_to_users_table', 3),
(18, '2025_12_04_105906_create_user_monthly_dues_table', 3),
(19, '2025_12_04_000001_alter_notifications_table_for_custom_fields', 4),
(20, '2025_12_04_160000_update_payments_transaction_id_index', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `related_id` bigint UNSIGNED DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `message`, `related_id`, `read`, `created_at`, `updated_at`) VALUES
(1, 1, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 5, 1, '2025-12-04 08:44:43', '2025-12-04 09:43:45'),
(3, 1, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 9, 1, '2025-12-04 09:46:22', '2025-12-07 08:56:39'),
(4, 1, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 7, 1, '2025-12-04 09:46:37', '2025-12-07 08:56:39'),
(5, 1, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 10, 1, '2025-12-07 06:51:08', '2025-12-07 08:56:39'),
(6, 2, 'payment_rejected', 'আপনার December 2025 মাসের পেমেন্ট প্রত্যাখ্যাত হয়েছে। কারণ: Taka aseni', 20, 0, '2025-12-07 07:09:45', '2025-12-07 07:09:45'),
(7, 2, 'payment_rejected', 'আপনার December 2025 মাসের পেমেন্ট প্রত্যাখ্যাত হয়েছে। কারণ: Taka aseni', 20, 0, '2025-12-07 07:16:25', '2025-12-07 07:16:25'),
(8, 2, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 21, 0, '2025-12-07 07:19:54', '2025-12-07 07:19:54'),
(9, 2, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 22, 0, '2025-12-07 07:31:53', '2025-12-07 07:31:53'),
(10, 2, 'payment_approved', 'আপনার December 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 23, 0, '2025-12-07 07:31:55', '2025-12-07 07:31:55'),
(11, 1, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 11, 1, '2025-12-07 08:34:27', '2025-12-07 08:56:39'),
(12, 1, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 12, 1, '2025-12-07 08:34:58', '2025-12-07 08:56:39'),
(13, 1, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 14, 1, '2025-12-07 08:35:03', '2025-12-07 08:56:39'),
(14, 1, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 15, 1, '2025-12-07 08:35:08', '2025-12-07 08:56:39'),
(15, 1, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 13, 1, '2025-12-07 08:35:13', '2025-12-07 08:56:39'),
(16, 1, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 16, 1, '2025-12-07 08:35:17', '2025-12-07 08:56:39'),
(17, 1, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 17, 1, '2025-12-07 08:36:36', '2025-12-07 08:56:39'),
(18, 1, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 18, 1, '2025-12-07 08:37:10', '2025-12-07 08:56:39'),
(19, 1, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 19, 1, '2025-12-07 08:37:13', '2025-12-07 08:56:39'),
(20, 1, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 24, 1, '2025-12-07 08:42:43', '2025-12-07 08:56:22'),
(21, 1, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 25, 0, '2025-12-07 10:08:11', '2025-12-07 10:08:11'),
(22, 1, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 26, 0, '2025-12-07 10:26:48', '2025-12-07 10:26:48'),
(23, 2, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 27, 0, '2025-12-09 05:36:50', '2025-12-09 05:36:50'),
(24, 2, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 28, 0, '2025-12-09 05:37:09', '2025-12-09 05:37:09'),
(25, 2, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 29, 0, '2025-12-09 05:37:14', '2025-12-09 05:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method_id` bigint UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `proof_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `processed_at` timestamp NULL DEFAULT NULL,
  `processed_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `transaction_id`, `month`, `year`, `amount`, `method`, `payment_method_id`, `description`, `admin_note`, `proof_path`, `status`, `processed_at`, `processed_by`, `created_at`, `updated_at`) VALUES
(5, 1, 'arman5435', 'November', 2024, '500.00', 'bKash', 2, 'asdf', NULL, NULL, 'approved', NULL, NULL, '2025-12-04 08:44:05', '2025-12-04 08:44:43'),
(6, 1, '0iuyi', 'December', 2024, '500.00', 'Hand Cash', 1, 'fgh', NULL, 'payment_proofs/TeMZaUplTOOAk601aeesQP9dYmRZFtdEfYnUzJUK.png', 'approved', '2025-12-04 08:57:00', 1, '2025-12-04 08:47:34', '2025-12-04 08:57:00'),
(7, 1, '456', 'January', 2025, '500.00', 'Hand Cash', 1, NULL, NULL, 'payment_proofs/qgvWiYxWSZSFljInjT0pIE8ArC52vM03EkTjm3o5.webp', 'approved', '2025-12-04 09:46:37', 1, '2025-12-04 08:59:28', '2025-12-04 09:46:37'),
(9, 1, 'asdfdf45u', 'February', 2025, '500.00', 'bKash', 2, 'test', NULL, 'payment_proofs/mNJu3z82zOffyx7UlW4YW7ZwNT0K2UHpsKqAr5JY.webp', 'approved', '2025-12-04 09:46:22', 1, '2025-12-04 09:12:26', '2025-12-04 09:46:22'),
(10, 1, 'asdf32', 'March', 2025, '500.00', 'bKash', 2, 'test', NULL, NULL, 'approved', '2025-12-07 06:51:08', 1, '2025-12-05 21:40:27', '2025-12-07 06:51:08'),
(11, 1, 'asdf32', 'April', 2025, '500.00', 'bKash', 2, 'test', NULL, NULL, 'approved', '2025-12-07 08:34:27', 1, '2025-12-05 21:40:27', '2025-12-07 08:34:27'),
(12, 1, 'asdf32', 'May', 2025, '500.00', 'bKash', 2, 'test', NULL, NULL, 'approved', '2025-12-07 08:34:58', 1, '2025-12-05 21:40:27', '2025-12-07 08:34:58'),
(13, 1, 'asdf32', 'June', 2025, '500.00', 'bKash', 2, 'test', NULL, NULL, 'approved', '2025-12-07 08:35:13', 1, '2025-12-05 21:40:27', '2025-12-07 08:35:13'),
(14, 1, 'asdf32', 'July', 2025, '500.00', 'bKash', 2, 'test', NULL, NULL, 'approved', '2025-12-07 08:35:03', 1, '2025-12-05 21:40:27', '2025-12-07 08:35:03'),
(15, 1, 'asdf32', 'August', 2025, '500.00', 'bKash', 2, 'test', NULL, NULL, 'approved', '2025-12-07 08:35:08', 1, '2025-12-05 21:40:27', '2025-12-07 08:35:08'),
(16, 1, 'asdf32', 'September', 2025, '500.00', 'bKash', 2, 'test', NULL, NULL, 'approved', '2025-12-07 08:35:16', 1, '2025-12-05 21:40:27', '2025-12-07 08:35:16'),
(17, 1, 'asdf32', 'October', 2025, '500.00', 'bKash', 2, 'test', NULL, NULL, 'approved', '2025-12-07 08:36:36', 1, '2025-12-05 21:40:27', '2025-12-07 08:36:36'),
(21, 2, 'dfssdf', 'December', 2025, '500.00', 'bKash', 2, NULL, NULL, 'payment_proofs/G6D4itVgYIsD5WNiATK7w3iRogi0NWlZhB9lJ3DN.jpg', 'approved', '2025-12-07 07:19:53', 1, '2025-12-07 07:19:44', '2025-12-07 07:19:53'),
(22, 2, 'sdaf', 'November', 2024, '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-07 07:31:53', 1, '2025-12-07 07:31:28', '2025-12-07 07:31:53'),
(23, 2, 'sdaf', 'December', 2024, '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-07 07:31:55', 1, '2025-12-07 07:31:28', '2025-12-07 07:31:55'),
(24, 1, 'arman', 'November', 2025, '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-07 08:42:43', 1, '2025-12-07 08:42:30', '2025-12-07 08:42:43'),
(26, 1, 'asdfasf', 'December', 2025, '500.00', 'bKash', 2, 'efsd', NULL, 'payment_proofs/EKeUdO0VAiTdTnk0u8AKc7XyFvTSk5ynjLyzhNgb.jpg', 'approved', '2025-12-07 10:26:48', 1, '2025-12-07 10:26:37', '2025-12-07 10:26:48'),
(27, 2, '4997', 'January', 2025, '500.00', 'bKash', 2, 'ar', NULL, 'payment_proofs/MwRPb3gUElJ3TpN6LCHki9y29okOiZEy7fICPsWF.jpg', 'approved', '2025-12-09 05:36:50', 1, '2025-12-09 05:35:48', '2025-12-09 05:36:50'),
(28, 2, '4997', 'February', 2025, '500.00', 'bKash', 2, 'ar', NULL, 'payment_proofs/MwRPb3gUElJ3TpN6LCHki9y29okOiZEy7fICPsWF.jpg', 'approved', '2025-12-09 05:37:09', 1, '2025-12-09 05:35:48', '2025-12-09 05:37:09'),
(29, 2, '4997', 'March', 2025, '500.00', 'bKash', 2, 'ar', NULL, 'payment_proofs/MwRPb3gUElJ3TpN6LCHki9y29okOiZEy7fICPsWF.jpg', 'approved', '2025-12-09 05:37:14', 1, '2025-12-09 05:35:48', '2025-12-09 05:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `name_bn`, `is_active`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Hand Cash', 'হাতে নগদ', 1, 1, '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
(2, 'bKash', 'বিকাশ', 1, 2, '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
(3, 'Nagad', 'নগদ', 1, 3, '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
(4, 'Rocket', 'রকেট', 1, 4, '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
(5, 'Bank Transfer', 'ব্যাংক ট্রান্সফার', 1, 5, '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
(6, 'Upay', 'উপায়', 1, 6, '2025-12-03 00:19:57', '2025-12-03 00:19:57');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Generate Reports', 'report.generate', 'Allows generating system-wide reports.', '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(2, 'Manage Users', 'users.manage', 'Allows creating, editing, and deleting users.', '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(3, 'Manage Roles', 'roles.manage', 'Allows editing Tyro roles.', '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(4, 'View Billing', 'billing.view', 'Allows viewing billing statements.', '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(5, 'Wildcard', '*', 'Grants every privilege.', '2025-12-02 05:00:05', '2025-12-02 05:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `privilege_role`
--

CREATE TABLE `privilege_role` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `privilege_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privilege_role`
--

INSERT INTO `privilege_role` (`id`, `role_id`, `privilege_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(2, 6, 1, '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(3, 1, 2, '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(4, 6, 2, '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(5, 6, 3, '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(6, 1, 4, '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(7, 2, 4, '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(8, 5, 5, '2025-12-02 05:00:05', '2025-12-02 05:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(2, 'User', 'user', '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(3, 'Customer', 'customer', '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(4, 'Editor', 'editor', '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(5, 'All', '*', '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(6, 'Super Admin', 'super-admin', '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(7, 'admin', 'admin', '2025-12-02 23:01:50', '2025-12-02 23:01:50'),
(8, 'accountant', 'accountant', '2025-12-02 23:01:50', '2025-12-02 23:01:50'),
(9, 'member', 'member', '2025-12-02 23:01:50', '2025-12-02 23:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ANm9QtDm1JT45PhXOdnPvgE5S3eXOwjarkQUCorc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRXRLaXNsejRCb0xkbERzOXZENFM3WGpza2dXdVFWQUlPUWk0NGc1eCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozOToiaHR0cDovL3Byb2pvbm1vLnRlc3QvYWRtaW4vdHJhbnNhY3Rpb25zIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9wcm9qb25tby50ZXN0L2xvZ2luIjtzOjU6InJvdXRlIjtzOjE2OiJ0eXJvLWxvZ2luLmxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMDoidHlyby1sb2dpbiI7YToxOntzOjc6ImNhcHRjaGEiO2E6MTp7czo1OiJsb2dpbiI7aToyO319fQ==', 1765633857);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES
('currency', 'BDT', '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
('currency_symbol', '৳', '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
('monthly_fee', '500', '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
('organization_address', 'ঢাকা, বাংলাদেশ', '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
('organization_established_month', '11', '2025-12-04 05:20:53', '2025-12-04 05:20:53'),
('organization_established_year', '2024', '2025-12-04 03:57:48', '2025-12-04 03:57:48'),
('organization_logo', 'logos/GFcJCp6LROx1uC4t0iCoJc3ck9JTffmGFz0O9b6n.png', '2025-12-03 00:19:57', '2025-12-04 00:16:37'),
('organization_name', 'প্রজন্ম উন্নয়ন মিশন', '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
('organization_name_en', 'Projonmo Unnayan Mission1', '2025-12-03 00:19:57', '2025-12-03 05:10:46'),
('organization_phone', '01700000000', '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
('organization_start_month', '2024-11', '2025-12-03 00:19:57', '2025-12-03 00:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `membership_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `permanent_address` text COLLATE utf8mb4_unicode_ci,
  `present_address` text COLLATE utf8mb4_unicode_ci,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `joined_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `suspension_reason` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `membership_id`, `name`, `email`, `phone`, `address`, `email_verified_at`, `password`, `father_name`, `dob`, `permanent_address`, `present_address`, `blood_group`, `profession`, `religion`, `nationality`, `position`, `profile_pic`, `status`, `joined_at`, `remember_token`, `created_at`, `updated_at`, `suspended_at`, `suspension_reason`) VALUES
(1, NULL, 'আরমান আজিজ', 'armanazij@gmail.com', '01916628339', NULL, NULL, '$2y$12$DVdEeDMUozij9AtohyI0SuvdaQ/A.NI2rsnSp02VgyfvWs9LCjeVa', 'উসমান গনি', '1996-05-15', 'কাটাবাড়িয়া, কিশোরগঞ্জ সদর, কিশোরগঞ্জ । ', 'কাটাবাড়িয়া, কিশোরগঞ্জ সদর, কিশোরগঞ্জ । ', 'B-', 'Engineer', 'ইসলাম', 'বাংলাদেশি', 'সদস্য', 'photos/LGsALuLg3uTqbSnA4aMjLKP7vAXBu1ZeH5eju1a6.png', 'active', NULL, NULL, '2025-12-02 05:00:05', '2025-12-04 00:05:37', NULL, NULL),
(2, NULL, 'Test Member', 'member@test.com', '01711111111', NULL, NULL, '$2y$12$zJMQjZjBYhJEiNJiQvlioerQxI3Q9vJijSR6P4XBsPKB6vkLEY0Me', 'Father Name', '1990-01-01', 'Dhaka, Bangladesh', 'Dhaka, Bangladesh', 'A+', 'Software Developer', 'Islam', 'Bangladeshi', NULL, NULL, 'active', NULL, NULL, '2025-12-02 22:45:26', '2025-12-02 22:45:26', NULL, NULL),
(3, NULL, 'Test Accountant', 'accountant@test.com', '01722222222', NULL, NULL, '$2y$12$eVG5kBqLW6Ocu2Pi8G0LxOlwgI8qLl4Ylbn72.ZrFXvErpay7XHT.', 'Father Name', '1985-01-01', 'Dhaka, Bangladesh', 'Dhaka, Bangladesh', 'B+', 'Accountant', 'Islam', 'Bangladeshi', NULL, 'profile-pics/wvniuvCWzcHkGYVrdzmOqp1WwafbVBNkfwccSy5M.jpg', 'active', NULL, NULL, '2025-12-02 22:45:51', '2025-12-07 09:45:48', NULL, NULL),
(4, NULL, 'Reed Morse', '+1 (343) 284-4907@placeholder.com', '+1 (343) 284-4907', NULL, NULL, '$2y$12$JaZgwQDz/TIJEyi/guJMXufvSYSDGdq.vfNPN8rfmu/FKNfJ1F4T.', 'Ira Ward', '1990-09-26', 'Nam ullam rerum est', 'Animi sit eum libe', 'A+', 'Modi adipisci sint s', 'Other', 'Molestiae in omnis e', NULL, NULL, 'pending', NULL, NULL, '2025-12-07 10:20:23', '2025-12-07 10:20:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_monthly_dues`
--

CREATE TABLE `user_monthly_dues` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `year` int NOT NULL,
  `month` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','overdue') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `due_date` timestamp NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-12-02 05:00:05', '2025-12-02 05:00:05'),
(2, 1, 7, NULL, NULL),
(3, 2, 9, NULL, NULL),
(4, 3, 8, NULL, NULL),
(5, 1, 9, '2025-12-04 05:47:05', '2025-12-04 05:47:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_processed_by_foreign` (`processed_by`),
  ADD KEY `payments_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `payments_transaction_id_index` (`transaction_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `privileges_slug_unique` (`slug`);

--
-- Indexes for table `privilege_role`
--
ALTER TABLE `privilege_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `privilege_role_role_id_privilege_id_unique` (`role_id`,`privilege_id`),
  ADD KEY `privilege_role_privilege_id_foreign` (`privilege_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_slug_index` (`slug`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_membership_id_unique` (`membership_id`);

--
-- Indexes for table `user_monthly_dues`
--
ALTER TABLE `user_monthly_dues`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_monthly_dues_user_id_year_month_unique` (`user_id`,`year`,`month`),
  ADD KEY `user_monthly_dues_user_id_status_index` (`user_id`,`status`),
  ADD KEY `user_monthly_dues_year_month_index` (`year`,`month`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_roles_user_id_role_id_unique` (`user_id`,`role_id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `privilege_role`
--
ALTER TABLE `privilege_role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_monthly_dues`
--
ALTER TABLE `user_monthly_dues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`),
  ADD CONSTRAINT `payments_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `privilege_role`
--
ALTER TABLE `privilege_role`
  ADD CONSTRAINT `privilege_role_privilege_id_foreign` FOREIGN KEY (`privilege_id`) REFERENCES `privileges` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `privilege_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_monthly_dues`
--
ALTER TABLE `user_monthly_dues`
  ADD CONSTRAINT `user_monthly_dues_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
