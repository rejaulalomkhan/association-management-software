-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2026 at 04:00 PM
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
-- Table structure for table `bank_deposits`
--

CREATE TABLE `bank_deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_type` enum('deposit','withdrawal','deduction','profit') COLLATE utf8mb4_unicode_ci DEFAULT 'deposit',
  `amount` decimal(15,2) NOT NULL,
  `balance_after` decimal(15,2) NOT NULL,
  `month` int NOT NULL,
  `year` int NOT NULL,
  `bank_message_screenshot` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposited_by` bigint UNSIGNED NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_deposits`
--

INSERT INTO `bank_deposits` (`id`, `transaction_type`, `amount`, `balance_after`, `month`, `year`, `bank_message_screenshot`, `bank_receipt`, `deposited_by`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'deposit', '8000.00', '8000.00', 12, 2025, 'bank_deposits/U3tOeDZZhuqwLRGGX3qr0tHigzzwYh4ILYB64xSb.jpg', NULL, 1, 'Jjgxhfuoiuof', '2025-12-17 17:23:39', '2025-12-17 17:23:39'),
(2, 'deposit', '7500.00', '15500.00', 11, 2025, 'bank_deposits/tlCEp5CyZnp4OPPtuZw8Ks8ieIzh5cTHRX1xtuh4.jpg', NULL, 1, NULL, '2025-12-20 13:56:43', '2025-12-20 13:56:43'),
(3, 'deposit', '8000.00', '23500.00', 11, 2024, 'bank_deposits/HNYEKW0BoVRtcIqdV4ZLODKLqK9fnGDYBVh8uSlz.jpg', NULL, 1, NULL, '2025-12-20 13:58:18', '2025-12-20 13:58:18'),
(4, 'deposit', '8000.00', '31500.00', 12, 2024, 'bank_deposits/0x3sivGwlX0sLEW61BVpoLhwwtse3Yr1wtFMoOqb.jpg', NULL, 1, NULL, '2025-12-20 13:59:09', '2025-12-20 13:59:09'),
(5, 'deposit', '8000.00', '39500.00', 1, 2025, 'bank_deposits/hNOmcjlE8vtObwgVfpIUEDHR1VXdJOHHmACynVqG.jpg', NULL, 1, NULL, '2025-12-20 14:00:27', '2025-12-20 14:00:27'),
(6, 'deposit', '8000.00', '47500.00', 2, 2025, 'bank_deposits/LD1Ctniouup7QzSmfSEeAw3PGhcwZJNYkAtWicO5.jpg', NULL, 1, NULL, '2025-12-20 14:03:27', '2025-12-20 14:03:27'),
(7, 'deposit', '7500.00', '55000.00', 3, 2025, 'bank_deposits/aQdvCNgiFJaBXObAJqNldTA8JcYwZG0DGTVnd9bh.jpg', NULL, 5, NULL, '2025-12-26 12:36:51', '2025-12-26 12:36:51'),
(8, 'deposit', '7500.00', '62500.00', 4, 2025, 'bank_deposits/7G3EDv2AaeNOSSXNEkDyytZlUPcASw8vypH7Ltnq.jpg', 'bank_deposits/i1167k4xGWcfQhYN7UWOav82z18kSB2wbTeKSqwA.jpg', 5, NULL, '2025-12-26 12:37:49', '2025-12-26 12:37:49'),
(9, 'deposit', '7500.00', '70000.00', 5, 2025, 'bank_deposits/PiTMzybLJG3j3h826oMlzMjagfbnJTgpDYP3hSHc.jpg', NULL, 5, NULL, '2025-12-26 12:38:40', '2025-12-26 12:38:40'),
(10, 'deposit', '7500.00', '77500.00', 6, 2025, 'bank_deposits/150jVwQPjUWsDtpfSwvcSg3lGHScGSMXckJ8sTlt.jpg', NULL, 5, NULL, '2025-12-26 12:39:23', '2025-12-26 12:39:23'),
(11, 'deposit', '7500.00', '85000.00', 7, 2025, 'bank_deposits/8fuA8gqjj4asQKAoKLR04W9grnZijfOyqJLND8WG.jpg', NULL, 5, NULL, '2025-12-26 12:40:57', '2025-12-26 12:40:57'),
(12, 'deposit', '7500.00', '92500.00', 8, 2025, 'bank_deposits/wyJOquWailsBm7fbfHpK8s8jdhPuTLzTuHUamrBY.jpg', NULL, 5, NULL, '2025-12-26 12:41:35', '2025-12-26 12:41:35'),
(13, 'deposit', '7500.00', '100000.00', 9, 2025, 'bank_deposits/5N3ALEixPdMWd16xqyPip97wNX3SbPyajSUCnJ3E.jpg', NULL, 5, NULL, '2025-12-26 12:42:13', '2025-12-26 12:42:13'),
(14, 'deposit', '7500.00', '107500.00', 10, 2025, 'bank_deposits/uSSebX459ajpeZmWxfvSGLH2qBtKxFtmgOvDWyEm.jpg', NULL, 5, NULL, '2025-12-26 12:54:06', '2025-12-26 12:54:06'),
(15, 'deposit', '14200.00', '121700.00', 1, 2026, 'bank_deposits/Q0GWzQweLSigzBexadY2tvMqN0PZcpP6RULDjW8I.jpg', NULL, 5, NULL, '2026-02-07 12:03:32', '2026-02-07 12:03:32'),
(16, 'profit', '739.00', '122439.00', 6, 2025, 'bank_deposits/RN6hZohU7vCqqKsUSIYXLMfWXU75A6PzLVVZVBPK.png', NULL, 1, 'Bank Interest', '2026-02-26 09:00:42', '2026-02-26 09:00:42'),
(17, 'profit', '1824.00', '124263.00', 12, 2025, 'bank_deposits/LUlPrZxWx2yDXicxSA00R30b9iCYtSqsv6LwYpJu.png', NULL, 1, 'December-2025 Bank Interest', '2026-02-26 09:02:30', '2026-02-26 09:02:30'),
(18, 'deduction', '561.50', '123701.50', 12, 2025, 'bank_deposits/frgjkULUUOPuykCGOHNO5zW2Rv7ISX2ankLNZwH4.png', NULL, 1, '274+230+57.50=561.50TK (bank-deduction-december-2025)', '2026-02-26 09:05:42', '2026-02-26 09:05:42'),
(19, 'deduction', '341.00', '123360.50', 6, 2025, 'bank_deposits/QKeV5YiXYHJJr9udX8OBiE1dbS9Z8wxPHmc2oeek.png', NULL, 1, '111+230=341TK (bank-deduction-jun-2025)', '2026-02-26 09:08:26', '2026-02-26 09:08:26'),
(20, 'deduction', '92.00', '123268.50', 7, 2025, 'bank_deposits/fy1g1D9apryrTEDyFn6JYWam6m6ct3aaS7NHlsjg.png', NULL, 1, '23x4=92TK (bank-deduction-july-2025)', '2026-02-26 09:10:24', '2026-02-26 09:10:24'),
(21, 'deposit', '8000.00', '131268.50', 2, 2026, 'bank_deposits/4AAVAlrlGx21IvZOeAXgFvXTS9WPxKZrVeniT77k.jpg', NULL, 1, 'Dear sir, Your A/C: 4803***8918 is credited TK   8000.00 as On-Line Cash from Kishoreganj Branch on 24-02-2026. Bal. TK   131268.50', '2026-02-26 09:13:01', '2026-02-26 09:13:01'),
(22, 'deposit', '8000.00', '139268.50', 3, 2026, 'bank_deposits/TyxSz0eq0Lqu9d5udEedt3LTJqVAnZI5I4h8zZo0.jpg', NULL, 5, NULL, '2026-03-25 11:22:16', '2026-03-25 11:22:16');

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
('projonmo-unnayan-mission-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1777046377),
('projonmo-unnayan-mission-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1777046377;', 1777046377),
('projonmo-unnayan-mission-cache-setting_bank_account_holder', 's:24:\"Projonmo unnayan mission\";', 1777049572),
('projonmo-unnayan-mission-cache-setting_bank_account_number', 's:14:\"48030311138918\";', 1777049572),
('projonmo-unnayan-mission-cache-setting_bank_branch', 's:11:\"Kishoreganj\";', 1777049572),
('projonmo-unnayan-mission-cache-setting_bank_name', 's:22:\"Bangladesh Krishi Bank\";', 1777049572),
('projonmo-unnayan-mission-cache-setting_currency', 's:3:\"BDT\";', 1777049416),
('projonmo-unnayan-mission-cache-setting_currency_symbol', 's:3:\"৳\";', 1777049416),
('projonmo-unnayan-mission-cache-setting_monthly_fee', 's:3:\"500\";', 1777049572),
('projonmo-unnayan-mission-cache-setting_organization_address', 's:38:\"ঢাকা, বাংলাদেশ\";', 1777049572),
('projonmo-unnayan-mission-cache-setting_organization_email', 's:0:\"\";', 1777049572),
('projonmo-unnayan-mission-cache-setting_organization_established_month', 's:1:\"1\";', 1777049572),
('projonmo-unnayan-mission-cache-setting_organization_established_year', 's:4:\"2021\";', 1777049572),
('projonmo-unnayan-mission-cache-setting_organization_logo', 's:50:\"logos/GFcJCp6LROx1uC4t0iCoJc3ck9JTffmGFz0O9b6n.png\";', 1777047583),
('projonmo-unnayan-mission-cache-setting_organization_name', 's:98:\"কিশোরগঞ্জ ইঞ্জিনিয়ার্স এসোসিয়েশন\";', 1777049567),
('projonmo-unnayan-mission-cache-setting_organization_name_en', 's:33:\"Kishoreganj Engineers Association\";', 1777049572),
('projonmo-unnayan-mission-cache-setting_organization_phone', 's:11:\"01700000000\";', 1777049572),
('projonmo-unnayan-mission-cache-setting_organization_short_name', 's:34:\"প্রজন্ম উন্ন\";', 1777048705),
('projonmo-unnayan-mission-cache-setting_payment_term', 's:7:\"monthly\";', 1777049572),
('projonmo-unnayan-mission-cache-setting_registration_terms', 's:3818:\"<h3 class=\"text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100\">১. সাধারণ শর্তাবলী</h3>\n<p class=\"text-gray-700 dark:text-gray-300 mb-4\">\n    {org_name}-এ সদস্য হিসেবে নিবন্ধন করার মাধ্যমে আপনি নিম্নলিখিত শর্তাবলী মেনে নিতে সম্মত হচ্ছেন।\n    এই শর্তাবলী সংগঠনের নিয়ম-কানুন এবং আপনার দায়িত্ব ও অধিকার নির্ধারণ করে।\n</p>\n\n<h3 class=\"text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100\">২. সদস্যপদের যোগ্যতা</h3>\n<ul class=\"list-disc list-inside text-gray-700 dark:text-gray-300 mb-4 space-y-2\">\n    <li>আবেদনকারীকে অবশ্যই বাংলাদেশী নাগরিক হতে হবে</li>\n    <li>ন্যূনতম বয়স ১৮ বছর হতে হবে</li>\n    <li>সকল তথ্য সঠিক এবং সত্য হতে হবে</li>\n    <li>সংগঠনের উদ্দেশ্য ও লক্ষ্যের সাথে একমত হতে হবে</li>\n</ul>\n\n<h3 class=\"text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100\">৩. সদস্যের দায়িত্ব</h3>\n<ul class=\"list-disc list-inside text-gray-700 dark:text-gray-300 mb-4 space-y-2\">\n    <li>সংগঠনের নিয়ম-কানুন মেনে চলা</li>\n    <li>সংগঠনের কার্যক্রমে সক্রিয় অংশগ্রহণ করা</li>\n    <li>সংগঠনের সুনাম রক্ষা করা</li>\n    <li>নির্ধারিত সদস্য ফি যথাসময়ে পরিশোধ করা</li>\n    <li>প্রদত্ত তথ্য হালনাগাদ রাখা</li>\n</ul>\n\n<h3 class=\"text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100\">৪. গোপনীয়তা নীতি</h3>\n<p class=\"text-gray-700 dark:text-gray-300 mb-4\">\n    আপনার ব্যক্তিগত তথ্য সম্পূর্ণ গোপনীয় রাখা হবে এবং শুধুমাত্র সংগঠনের অভ্যন্তরীণ কাজে ব্যবহার করা হবে।\n    আপনার অনুমতি ছাড়া কোনো তথ্য তৃতীয় পক্ষের সাথে শেয়ার করা হবে না।\n</p>\n\n<h3 class=\"text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100\">৫. সদস্যপদ বাতিল</h3>\n<p class=\"text-gray-700 dark:text-gray-300 mb-4\">\n    সংগঠনের নিয়ম লঙ্ঘন, মিথ্যা তথ্য প্রদান, বা সংগঠনের সুনাম ক্ষুণ্ণ করার মতো কাজের জন্য\n    প্রশাসন যে কোনো সময় সদস্যপদ বাতিল করার অধিকার সংরক্ষণ করে।\n</p>\n\n<h3 class=\"text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100\">৬. অনুমোদন প্রক্রিয়া</h3>\n<p class=\"text-gray-700 dark:text-gray-300 mb-4\">\n    নিবন্ধন আবেদন জমা দেওয়ার পর প্রশাসন আপনার তথ্য যাচাই করবে। অনুমোদন পেতে ৭-১৫ কার্যদিবস সময় লাগতে পারে।\n    অনুমোদনের পর আপনি ইমেইল/ফোনে বিজ্ঞপ্তি পাবেন।\n</p>\";', 1777048783),
('projonmo-unnayan-mission-cache-setting_registration_terms_acceptance_label', 's:276:\"আমি উপরের সকল শর্তাবলী পড়েছি এবং সম্মত হয়েছি। আমি নিশ্চিত করছি যে আমার প্রদত্ত সকল তথ্য সঠিক এবং সত্য।\";', 1777048783),
('projonmo-unnayan-mission-cache-tyro:user:1:roles', 'a:2:{i:0;s:5:\"admin\";i:1;s:6:\"member\";}', 1777046605),
('projonmo-unnayan-mission-cache-tyro:user:18:roles', 'a:1:{i:0;s:6:\"member\";}', 1776942580);

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
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` int NOT NULL,
  `uploaded_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `subject`, `description`, `file_path`, `file_name`, `file_type`, `file_size`, `uploaded_by`, `created_at`, `updated_at`) VALUES
(1, 'ডিসেম্বর ২০২৫-এর হিসাব সংক্রান্ত নোট (সদস্য পরিবর্তন বিষয়ে)', 'ব্যাংক হিসেব ব্যাতিত ', 'documents/2025/12/18892d14-8983-4caa-9fd8-baabb2abf9e8.pdf', 'December-2025 হিসাব সংক্রান্ত নোট.pdf', 'pdf', 185887, 1, '2025-12-20 10:21:35', '2025-12-20 10:21:35'),
(2, 'ব্যাংক জমা রিসিট ', NULL, 'documents/2025/12/9d73862f-9c5d-4288-a745-40a6f36bbd10.jpg', 'Screenshot_20251226-182502.WhatsApp.jpg', 'jpg', 168014, 5, '2025-12-26 12:59:10', '2025-12-26 12:59:10'),
(3, 'ব্যাংক জমা রিসিট', NULL, 'documents/2025/12/b9b47d9b-ccd5-4321-a229-c120e59517c2.jpg', 'IMG-20251013-WA0002.jpg', 'jpg', 283166, 5, '2025-12-26 13:02:08', '2025-12-26 13:02:08'),
(4, 'ব্যাংক জমা রিসিট ', NULL, 'documents/2025/12/b6aaf864-902b-4bb2-b2e1-4a1941692bb4.jpg', 'IMG-20250310-WA0008.jpg', 'jpg', 312540, 5, '2025-12-26 13:03:06', '2025-12-26 13:03:06'),
(5, 'ব্যাংক জমা রিসিট', NULL, 'documents/2025/12/4b34afd5-02c3-4bac-9532-4ce4a2572030.jpg', 'IMG-20251116-WA0004.jpg', 'jpg', 72186, 5, '2025-12-26 13:03:49', '2025-12-26 13:03:49'),
(6, 'ব্যাংক জমা রিসিট', NULL, 'documents/2025/12/60f811bf-718d-4696-8d9c-7aa99d6c54be.jpg', 'IMG-20250220-WA0015.jpg', 'jpg', 65201, 5, '2025-12-26 13:04:24', '2025-12-26 13:04:24'),
(7, ' ব্যাংক স্টেমেন', NULL, 'documents/2025/12/382658e5-5531-4565-b5d5-07f89f369cfb.jpg', 'IMG-20250615-WA0004.jpg', 'jpg', 43879, 5, '2025-12-26 13:05:25', '2025-12-26 13:05:25'),
(8, 'ব্যাংক স্টেটমেন্ট ', NULL, 'documents/2025/12/d985b297-2a63-476c-8242-90c926e5b45a.jpg', 'IMG-20250717-WA0001.jpg', 'jpg', 56590, 5, '2025-12-26 13:07:30', '2025-12-26 13:07:30'),
(9, ' মানবিক সহায়তা ', 'মানবিক সহায়তার টাকা যে সদস্যগণ দিয়েছে \n১ রিতু  ২০০\n২ উজ্জল দিসে ১ হাজার \n৩ দ্বিন ইসলাম ২০০ টাকা \n৪এমদাূুল ১০০ \n৫ হুমায়ুন ২০০ \n৬ মনির ২০০ \n৭ আরমান ২০০ \n৮আনারুল  ৩০০ \n৯ তুহিন ৩০০ \n', 'documents/2026/02/d9554cca-da58-41ae-acb9-59be5f930b68.jpg', 'IMG_20260202_173417133_HDR.jpg', 'jpg', 3147870, 5, '2026-02-02 11:44:36', '2026-02-02 11:44:36'),
(10, 'ব্যাংক স্টেটমেন্ট  ', NULL, 'documents/2026/02/77039955-4986-4969-ab23-d35828efcc1c.jpg', 'IMG_20260205_114433556_HDR_AE.jpg', 'jpg', 3660006, 5, '2026-02-07 11:59:54', '2026-02-07 11:59:54'),
(11, 'ব্যাংক জমা রিসিট', NULL, 'documents/2026/02/ed4be77b-7712-4bfe-81e1-613cebc45c74.jpg', 'IMG-20260224-WA0001.jpg', 'jpg', 233036, 5, '2026-02-26 04:03:14', '2026-02-26 04:03:14'),
(12, 'রিসিট ', NULL, 'documents/2026/03/a97d268e-1281-4c43-83de-87919001d1e8.jpg', 'IMG-20260325-WA0001.jpg', 'jpg', 87114, 5, '2026-03-25 11:19:56', '2026-03-25 11:19:56');

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
(20, '2025_12_04_160000_update_payments_transaction_id_index', 5),
(21, '2025_12_14_101710_create_bank_deposits_table', 6),
(22, '2025_12_20_095858_create_documents_table', 7),
(23, '2025_12_02_105700_create_payment_methods_table', 8),
(24, '2026_04_23_042647_add_verification_token_to_users_table', 9),
(25, '2026_04_23_120000_add_monthly_fee_to_users_table', 10),
(26, '2026_04_23_130000_add_payment_term_to_users_and_payments', 11);

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
(21, 1, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 25, 1, '2025-12-07 10:08:11', '2025-12-17 17:08:53'),
(22, 1, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 26, 1, '2025-12-07 10:26:48', '2025-12-17 17:08:53'),
(26, 5, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 43, 1, '2025-12-13 18:28:23', '2025-12-26 13:12:57'),
(27, 7, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 46, 0, '2025-12-14 12:52:08', '2025-12-14 12:52:08'),
(28, 15, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 50, 0, '2025-12-15 07:08:06', '2025-12-15 07:08:06'),
(29, 15, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 51, 0, '2025-12-15 07:08:28', '2025-12-15 07:08:28'),
(30, 15, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 52, 0, '2025-12-15 07:08:33', '2025-12-15 07:08:33'),
(31, 15, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 53, 0, '2025-12-15 07:08:38', '2025-12-15 07:08:38'),
(32, 15, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 54, 0, '2025-12-15 07:08:42', '2025-12-15 07:08:42'),
(33, 15, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 55, 0, '2025-12-15 07:08:46', '2025-12-15 07:08:46'),
(34, 15, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 56, 0, '2025-12-15 07:08:50', '2025-12-15 07:08:50'),
(35, 15, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 57, 0, '2025-12-15 07:09:12', '2025-12-15 07:09:12'),
(36, 15, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 58, 0, '2025-12-15 07:09:15', '2025-12-15 07:09:15'),
(37, 15, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 59, 0, '2025-12-15 07:09:18', '2025-12-15 07:09:18'),
(38, 15, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 60, 0, '2025-12-15 07:09:21', '2025-12-15 07:09:21'),
(39, 7, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 47, 0, '2025-12-15 07:09:27', '2025-12-15 07:09:27'),
(40, 1, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 61, 1, '2025-12-17 17:06:58', '2025-12-17 17:08:53'),
(41, 5, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 32, 1, '2025-12-20 03:39:32', '2025-12-26 13:12:57'),
(42, 5, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 30, 1, '2025-12-20 03:41:44', '2025-12-26 13:12:57'),
(43, 15, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 48, 0, '2025-12-20 03:41:49', '2025-12-20 03:41:49'),
(44, 15, 'payment_approved', 'আপনার December 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 49, 0, '2025-12-20 03:41:52', '2025-12-20 03:41:52'),
(45, 7, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 44, 0, '2025-12-20 03:41:55', '2025-12-20 03:41:55'),
(46, 7, 'payment_approved', 'আপনার December 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 45, 0, '2025-12-20 03:41:58', '2025-12-20 03:41:58'),
(47, 5, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 33, 1, '2025-12-20 03:42:00', '2025-12-26 13:12:57'),
(48, 5, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 34, 1, '2025-12-20 03:42:04', '2025-12-26 13:12:57'),
(49, 5, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 35, 1, '2025-12-20 03:42:14', '2025-12-26 13:12:57'),
(50, 5, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 36, 1, '2025-12-20 03:42:18', '2025-12-26 13:12:57'),
(51, 5, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 37, 1, '2025-12-20 03:42:21', '2025-12-26 13:12:57'),
(52, 5, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 38, 1, '2025-12-20 03:42:25', '2025-12-26 13:12:57'),
(53, 5, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 39, 1, '2025-12-20 03:42:29', '2025-12-26 13:12:57'),
(54, 5, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 40, 1, '2025-12-20 03:42:31', '2025-12-26 13:12:57'),
(55, 5, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 41, 1, '2025-12-20 03:42:34', '2025-12-26 13:11:55'),
(56, 5, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 42, 1, '2025-12-20 03:42:37', '2025-12-26 13:11:55'),
(58, 18, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 62, 0, '2025-12-20 04:07:26', '2025-12-20 04:07:26'),
(59, 6, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 66, 0, '2025-12-20 04:10:58', '2025-12-20 04:10:58'),
(60, 6, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 68, 0, '2025-12-20 04:11:02', '2025-12-20 04:11:02'),
(61, 6, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 69, 0, '2025-12-20 04:11:04', '2025-12-20 04:11:04'),
(62, 6, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 67, 0, '2025-12-20 04:11:08', '2025-12-20 04:11:08'),
(63, 6, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 70, 0, '2025-12-20 04:11:11', '2025-12-20 04:11:11'),
(64, 6, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 71, 0, '2025-12-20 04:11:13', '2025-12-20 04:11:13'),
(65, 6, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 72, 0, '2025-12-20 04:11:16', '2025-12-20 04:11:16'),
(66, 6, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 73, 0, '2025-12-20 04:11:18', '2025-12-20 04:11:18'),
(67, 6, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 74, 0, '2025-12-20 04:11:20', '2025-12-20 04:11:20'),
(68, 6, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 75, 0, '2025-12-20 04:11:22', '2025-12-20 04:11:22'),
(69, 6, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 76, 0, '2025-12-20 04:11:25', '2025-12-20 04:11:25'),
(70, 6, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 64, 0, '2025-12-20 04:11:27', '2025-12-20 04:11:27'),
(71, 6, 'payment_approved', 'আপনার December 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 65, 0, '2025-12-20 04:11:29', '2025-12-20 04:11:29'),
(72, 6, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 63, 0, '2025-12-20 04:11:31', '2025-12-20 04:11:31'),
(73, 1, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 77, 1, '2025-12-20 04:20:06', '2025-12-20 07:24:50'),
(74, 1, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 78, 1, '2025-12-20 04:20:09', '2025-12-20 07:24:50'),
(75, 1, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 79, 1, '2025-12-20 04:20:12', '2025-12-20 07:24:50'),
(76, 1, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 80, 1, '2025-12-20 04:20:14', '2025-12-20 07:24:50'),
(77, 1, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 81, 1, '2025-12-20 04:20:16', '2025-12-20 07:24:50'),
(78, 1, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 82, 1, '2025-12-20 04:20:21', '2025-12-20 07:24:50'),
(79, 1, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 83, 1, '2025-12-20 04:20:23', '2025-12-20 07:24:50'),
(80, 1, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 84, 1, '2025-12-20 04:20:25', '2025-12-20 07:24:50'),
(81, 18, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 85, 0, '2025-12-20 05:22:06', '2025-12-20 05:22:06'),
(82, 18, 'payment_approved', 'আপনার December 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 86, 0, '2025-12-20 05:22:09', '2025-12-20 05:22:09'),
(83, 18, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 87, 0, '2025-12-20 05:22:57', '2025-12-20 05:22:57'),
(84, 18, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 88, 0, '2025-12-20 05:23:00', '2025-12-20 05:23:00'),
(85, 18, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 89, 0, '2025-12-20 05:23:02', '2025-12-20 05:23:02'),
(86, 18, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 90, 0, '2025-12-20 05:23:04', '2025-12-20 05:23:04'),
(87, 18, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 91, 0, '2025-12-20 05:23:07', '2025-12-20 05:23:07'),
(88, 18, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 92, 0, '2025-12-20 05:23:09', '2025-12-20 05:23:09'),
(89, 18, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 93, 0, '2025-12-20 05:23:11', '2025-12-20 05:23:11'),
(90, 18, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 94, 0, '2025-12-20 05:23:14', '2025-12-20 05:23:14'),
(91, 18, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 95, 0, '2025-12-20 05:23:16', '2025-12-20 05:23:16'),
(92, 18, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 96, 0, '2025-12-20 05:23:18', '2025-12-20 05:23:18'),
(93, 18, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 97, 0, '2025-12-20 05:23:20', '2025-12-20 05:23:20'),
(94, 10, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 98, 1, '2025-12-20 05:54:52', '2025-12-20 13:48:33'),
(95, 10, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 101, 1, '2025-12-20 05:55:41', '2025-12-20 13:48:33'),
(96, 10, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 102, 1, '2025-12-20 05:55:44', '2025-12-20 13:48:33'),
(97, 10, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 103, 1, '2025-12-20 05:55:46', '2025-12-20 13:48:33'),
(98, 10, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 104, 1, '2025-12-20 05:55:48', '2025-12-20 13:48:33'),
(99, 10, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 105, 1, '2025-12-20 05:55:50', '2025-12-20 13:48:33'),
(100, 10, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 106, 1, '2025-12-20 05:57:37', '2025-12-20 13:48:33'),
(101, 10, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 107, 1, '2025-12-20 05:57:42', '2025-12-20 13:48:33'),
(102, 10, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 108, 1, '2025-12-20 05:57:45', '2025-12-20 13:48:33'),
(103, 10, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 109, 1, '2025-12-20 05:57:47', '2025-12-20 13:48:33'),
(104, 10, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 110, 1, '2025-12-20 05:57:49', '2025-12-20 13:48:33'),
(105, 10, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 111, 1, '2025-12-20 05:57:51', '2025-12-20 13:48:33'),
(106, 10, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 99, 1, '2025-12-20 05:58:29', '2025-12-20 13:48:33'),
(107, 10, 'payment_approved', 'আপনার December 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 100, 1, '2025-12-20 05:58:31', '2025-12-20 13:48:33'),
(108, 11, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 112, 0, '2025-12-20 06:19:14', '2025-12-20 06:19:14'),
(109, 11, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 115, 0, '2025-12-20 06:19:36', '2025-12-20 06:19:36'),
(110, 11, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 116, 0, '2025-12-20 06:19:38', '2025-12-20 06:19:38'),
(111, 11, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 117, 0, '2025-12-20 06:19:40', '2025-12-20 06:19:40'),
(112, 11, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 118, 0, '2025-12-20 06:19:42', '2025-12-20 06:19:42'),
(113, 11, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 119, 0, '2025-12-20 06:19:45', '2025-12-20 06:19:45'),
(114, 11, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 120, 0, '2025-12-20 06:19:47', '2025-12-20 06:19:47'),
(115, 11, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 121, 0, '2025-12-20 06:19:49', '2025-12-20 06:19:49'),
(116, 11, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 122, 0, '2025-12-20 06:19:51', '2025-12-20 06:19:51'),
(117, 11, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 123, 0, '2025-12-20 06:19:53', '2025-12-20 06:19:53'),
(118, 11, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 124, 0, '2025-12-20 06:19:55', '2025-12-20 06:19:55'),
(119, 11, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 125, 0, '2025-12-20 06:19:57', '2025-12-20 06:19:57'),
(120, 11, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 113, 0, '2025-12-20 06:20:00', '2025-12-20 06:20:00'),
(121, 11, 'payment_approved', 'আপনার December 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 114, 0, '2025-12-20 06:20:02', '2025-12-20 06:20:02'),
(122, 13, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 126, 0, '2025-12-20 06:22:24', '2025-12-20 06:22:24'),
(123, 13, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 128, 0, '2025-12-20 06:22:29', '2025-12-20 06:22:29'),
(124, 13, 'payment_approved', 'আপনার December 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 127, 0, '2025-12-20 06:22:31', '2025-12-20 06:22:31'),
(125, 13, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 139, 0, '2025-12-20 06:22:34', '2025-12-20 06:22:34'),
(126, 13, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 138, 0, '2025-12-20 06:22:36', '2025-12-20 06:22:36'),
(127, 13, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 137, 0, '2025-12-20 06:22:38', '2025-12-20 06:22:38'),
(128, 13, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 129, 0, '2025-12-20 06:22:50', '2025-12-20 06:22:50'),
(129, 13, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 130, 0, '2025-12-20 06:22:52', '2025-12-20 06:22:52'),
(130, 13, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 131, 0, '2025-12-20 06:22:55', '2025-12-20 06:22:55'),
(131, 13, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 132, 0, '2025-12-20 06:22:57', '2025-12-20 06:22:57'),
(132, 13, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 133, 0, '2025-12-20 06:23:00', '2025-12-20 06:23:00'),
(133, 13, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 135, 0, '2025-12-20 06:23:02', '2025-12-20 06:23:02'),
(134, 13, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 136, 0, '2025-12-20 06:23:04', '2025-12-20 06:23:04'),
(135, 13, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 134, 0, '2025-12-20 06:23:06', '2025-12-20 06:23:06'),
(136, 15, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 143, 0, '2025-12-20 06:25:29', '2025-12-20 06:25:29'),
(137, 12, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 142, 0, '2025-12-20 06:25:31', '2025-12-20 06:25:31'),
(138, 8, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 140, 0, '2025-12-20 06:25:34', '2025-12-20 06:25:34'),
(139, 9, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 141, 0, '2025-12-20 06:25:36', '2025-12-20 06:25:36'),
(140, 20, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 180, 0, '2025-12-20 10:50:17', '2025-12-20 10:50:17'),
(141, 9, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 179, 0, '2025-12-20 10:53:01', '2025-12-20 10:53:01'),
(142, 12, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 166, 0, '2025-12-20 10:53:03', '2025-12-20 10:53:03'),
(143, 7, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 153, 0, '2025-12-20 10:53:06', '2025-12-20 10:53:06'),
(144, 20, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 181, 0, '2025-12-20 10:53:14', '2025-12-20 10:53:14'),
(145, 20, 'payment_approved', 'আপনার December 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 182, 0, '2025-12-20 10:53:17', '2025-12-20 10:53:17'),
(146, 9, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 169, 0, '2025-12-20 10:53:19', '2025-12-20 10:53:19'),
(147, 9, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 170, 0, '2025-12-20 10:53:22', '2025-12-20 10:53:22'),
(148, 9, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 171, 0, '2025-12-20 10:53:24', '2025-12-20 10:53:24'),
(149, 9, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 172, 0, '2025-12-20 10:53:26', '2025-12-20 10:53:26'),
(150, 9, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 173, 0, '2025-12-20 10:53:28', '2025-12-20 10:53:28'),
(151, 9, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 174, 0, '2025-12-20 10:53:32', '2025-12-20 10:53:32'),
(152, 9, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 175, 0, '2025-12-20 10:53:34', '2025-12-20 10:53:34'),
(153, 9, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 176, 0, '2025-12-20 10:53:36', '2025-12-20 10:53:36'),
(154, 9, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 177, 0, '2025-12-20 11:12:29', '2025-12-20 11:12:29'),
(155, 9, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 178, 0, '2025-12-20 11:12:34', '2025-12-20 11:12:34'),
(156, 12, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 157, 0, '2025-12-20 11:12:56', '2025-12-20 11:12:56'),
(157, 12, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 159, 0, '2025-12-20 11:13:02', '2025-12-20 11:13:02'),
(158, 9, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 167, 0, '2025-12-20 11:13:39', '2025-12-20 11:13:39'),
(159, 12, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 156, 0, '2025-12-20 11:13:43', '2025-12-20 11:13:43'),
(160, 12, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 161, 0, '2025-12-20 11:13:47', '2025-12-20 11:13:47'),
(161, 12, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 164, 0, '2025-12-20 11:13:51', '2025-12-20 11:13:51'),
(162, 12, 'payment_approved', 'আপনার December 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 155, 0, '2025-12-20 11:13:55', '2025-12-20 11:13:55'),
(163, 7, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 146, 0, '2025-12-20 11:13:59', '2025-12-20 11:13:59'),
(164, 7, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 147, 0, '2025-12-20 11:14:15', '2025-12-20 11:14:15'),
(165, 7, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 150, 0, '2025-12-20 11:14:20', '2025-12-20 11:14:20'),
(166, 7, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 149, 0, '2025-12-20 11:14:30', '2025-12-20 11:14:30'),
(167, 7, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 151, 0, '2025-12-20 11:14:33', '2025-12-20 11:14:33'),
(168, 7, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 152, 0, '2025-12-20 11:14:40', '2025-12-20 11:14:40'),
(169, 9, 'payment_approved', 'আপনার December 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 168, 0, '2025-12-20 11:15:04', '2025-12-20 11:15:04'),
(170, 12, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 160, 0, '2025-12-20 11:15:09', '2025-12-20 11:15:09'),
(171, 12, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 163, 0, '2025-12-20 11:15:12', '2025-12-20 11:15:12'),
(172, 12, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 158, 0, '2025-12-20 11:18:16', '2025-12-20 11:18:16'),
(173, 12, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 162, 0, '2025-12-20 11:18:18', '2025-12-20 11:18:18'),
(174, 12, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 165, 0, '2025-12-20 11:18:20', '2025-12-20 11:18:20'),
(175, 12, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 154, 0, '2025-12-20 11:18:22', '2025-12-20 11:18:22'),
(176, 7, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 144, 0, '2025-12-20 11:18:24', '2025-12-20 11:18:24'),
(177, 7, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 145, 0, '2025-12-20 11:18:26', '2025-12-20 11:18:26'),
(178, 7, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 148, 0, '2025-12-20 11:18:28', '2025-12-20 11:18:28'),
(179, 19, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 195, 0, '2025-12-20 11:25:49', '2025-12-20 11:25:49'),
(180, 19, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 194, 0, '2025-12-20 11:25:53', '2025-12-20 11:25:53'),
(181, 19, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 193, 0, '2025-12-20 11:25:58', '2025-12-20 11:25:58'),
(182, 19, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 192, 0, '2025-12-20 11:26:02', '2025-12-20 11:26:02'),
(183, 19, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 191, 0, '2025-12-20 11:26:07', '2025-12-20 11:26:07'),
(184, 19, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 189, 0, '2025-12-20 11:26:11', '2025-12-20 11:26:11'),
(185, 19, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 190, 0, '2025-12-20 11:26:15', '2025-12-20 11:26:15'),
(186, 19, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 188, 0, '2025-12-20 11:26:19', '2025-12-20 11:26:19'),
(187, 19, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 187, 0, '2025-12-20 11:26:22', '2025-12-20 11:26:22'),
(188, 19, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 186, 0, '2025-12-20 11:26:26', '2025-12-20 11:26:26'),
(189, 19, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 196, 0, '2025-12-20 11:26:30', '2025-12-20 11:26:30'),
(190, 19, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 184, 0, '2025-12-20 11:26:42', '2025-12-20 11:26:42'),
(191, 19, 'payment_approved', 'আপনার December 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 185, 0, '2025-12-20 11:26:44', '2025-12-20 11:26:44'),
(193, 19, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 183, 0, '2025-12-20 11:50:25', '2025-12-20 11:50:25'),
(194, 20, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 200, 0, '2025-12-20 11:58:14', '2025-12-20 11:58:14'),
(195, 20, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 201, 0, '2025-12-20 11:58:34', '2025-12-20 11:58:34'),
(196, 20, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 202, 0, '2025-12-20 11:58:48', '2025-12-20 11:58:48'),
(197, 20, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 209, 0, '2025-12-20 11:59:13', '2025-12-20 11:59:13'),
(198, 20, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 210, 0, '2025-12-20 11:59:19', '2025-12-20 11:59:19'),
(199, 20, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 203, 0, '2025-12-20 11:59:24', '2025-12-20 11:59:24'),
(200, 20, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 207, 0, '2025-12-20 11:59:28', '2025-12-20 11:59:28'),
(201, 20, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 204, 0, '2025-12-20 11:59:31', '2025-12-20 11:59:31'),
(202, 20, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 205, 0, '2025-12-20 11:59:35', '2025-12-20 11:59:35'),
(203, 20, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 206, 0, '2025-12-20 11:59:38', '2025-12-20 11:59:38'),
(204, 20, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 208, 0, '2025-12-20 11:59:42', '2025-12-20 11:59:42'),
(218, 8, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 222, 0, '2025-12-20 12:06:19', '2025-12-20 12:06:19'),
(219, 8, 'payment_approved', 'আপনার December 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 223, 0, '2025-12-20 12:06:21', '2025-12-20 12:06:21'),
(220, 8, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 227, 0, '2025-12-20 13:53:13', '2025-12-20 13:53:13'),
(221, 8, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 229, 0, '2025-12-20 13:53:17', '2025-12-20 13:53:17'),
(222, 8, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 230, 0, '2025-12-20 13:53:21', '2025-12-20 13:53:21'),
(223, 8, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 232, 0, '2025-12-20 13:53:24', '2025-12-20 13:53:24'),
(224, 8, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 233, 0, '2025-12-20 13:53:29', '2025-12-20 13:53:29'),
(225, 8, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 224, 0, '2025-12-20 13:53:33', '2025-12-20 13:53:33'),
(226, 8, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 225, 0, '2025-12-20 13:53:36', '2025-12-20 13:53:36'),
(227, 8, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 234, 0, '2025-12-20 13:53:39', '2025-12-20 13:53:39'),
(228, 8, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 228, 0, '2025-12-20 13:53:54', '2025-12-20 13:53:54'),
(229, 8, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 231, 0, '2025-12-20 13:53:56', '2025-12-20 13:53:56'),
(230, 8, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 226, 0, '2025-12-20 13:54:33', '2025-12-20 13:54:33'),
(231, 9, 'payment_rejected', 'আপনার January 2026 মাসের পেমেন্ট প্রত্যাখ্যাত হয়েছে। কারণ: আমি টাকা পাই নাই কেশ তাই এটা প্রত্যাখ্যান করলাম', 235, 0, '2026-01-05 15:49:07', '2026-01-05 15:49:07'),
(232, 19, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 236, 0, '2026-01-05 15:51:05', '2026-01-05 15:51:05'),
(233, 1, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 238, 1, '2026-01-05 16:02:38', '2026-01-26 04:39:31'),
(234, 8, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 237, 0, '2026-01-05 16:03:04', '2026-01-05 16:03:04'),
(235, 12, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 239, 0, '2026-01-05 16:26:37', '2026-01-05 16:26:37'),
(236, 10, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 240, 1, '2026-01-06 10:29:04', '2026-01-06 17:02:31'),
(237, 7, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 241, 0, '2026-01-06 11:11:18', '2026-01-06 11:11:18'),
(238, 9, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 242, 0, '2026-01-09 15:40:06', '2026-01-09 15:40:06'),
(240, 20, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 244, 0, '2026-01-09 15:41:30', '2026-01-09 15:41:30'),
(241, 6, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 245, 0, '2026-01-09 15:42:43', '2026-01-09 15:42:43'),
(242, 18, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 247, 0, '2026-01-09 15:44:13', '2026-01-09 15:44:13'),
(243, 22, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 246, 0, '2026-01-09 15:44:28', '2026-01-09 15:44:28'),
(244, 22, 'payment_approved', 'আপনার December 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 261, 0, '2026-01-13 15:26:26', '2026-01-13 15:26:26'),
(245, 22, 'payment_approved', 'আপনার November 2024 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 260, 0, '2026-01-13 15:26:30', '2026-01-13 15:26:30'),
(246, 22, 'payment_approved', 'আপনার September 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 256, 0, '2026-01-13 15:26:54', '2026-01-13 15:26:54'),
(247, 22, 'payment_approved', 'আপনার October 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 257, 0, '2026-01-13 15:26:58', '2026-01-13 15:26:58'),
(248, 22, 'payment_approved', 'আপনার November 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 258, 0, '2026-01-13 15:27:03', '2026-01-13 15:27:03'),
(249, 22, 'payment_approved', 'আপনার December 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 259, 0, '2026-01-13 15:27:07', '2026-01-13 15:27:07'),
(250, 22, 'payment_approved', 'আপনার January 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 248, 0, '2026-01-13 15:27:10', '2026-01-13 15:27:10'),
(251, 22, 'payment_approved', 'আপনার February 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 249, 0, '2026-01-13 15:27:13', '2026-01-13 15:27:13'),
(252, 22, 'payment_approved', 'আপনার March 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 250, 0, '2026-01-13 15:27:16', '2026-01-13 15:27:16'),
(253, 22, 'payment_approved', 'আপনার April 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 251, 0, '2026-01-13 15:27:22', '2026-01-13 15:27:22'),
(254, 22, 'payment_approved', 'আপনার May 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 252, 0, '2026-01-13 15:27:25', '2026-01-13 15:27:25'),
(255, 22, 'payment_approved', 'আপনার June 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 253, 0, '2026-01-13 15:27:28', '2026-01-13 15:27:28'),
(256, 22, 'payment_approved', 'আপনার July 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 254, 0, '2026-01-13 15:27:35', '2026-01-13 15:27:35'),
(257, 22, 'payment_approved', 'আপনার August 2025 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 255, 0, '2026-01-13 15:27:38', '2026-01-13 15:27:38'),
(258, 11, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 262, 0, '2026-01-13 17:55:20', '2026-01-13 17:55:20'),
(259, 13, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 263, 0, '2026-01-14 13:39:08', '2026-01-14 13:39:08'),
(261, 15, 'payment_approved', 'আপনার January 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 265, 0, '2026-01-19 12:42:40', '2026-01-19 12:42:40'),
(262, 5, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 266, 1, '2026-02-02 11:45:58', '2026-02-06 12:57:24'),
(263, 19, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 267, 0, '2026-02-06 12:58:15', '2026-02-06 12:58:15'),
(264, 22, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 269, 0, '2026-02-06 13:15:27', '2026-02-06 13:15:27'),
(265, 18, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 268, 0, '2026-02-06 13:15:36', '2026-02-06 13:15:36'),
(266, 20, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 270, 0, '2026-02-08 03:35:12', '2026-02-08 03:35:12'),
(267, 11, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 271, 0, '2026-02-12 07:07:19', '2026-02-12 07:07:19'),
(268, 1, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 272, 0, '2026-02-15 16:10:03', '2026-02-15 16:10:03'),
(269, 21, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 276, 0, '2026-02-15 16:13:09', '2026-02-15 16:13:09'),
(270, 9, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 275, 0, '2026-02-15 16:13:38', '2026-02-15 16:13:38'),
(271, 7, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 274, 0, '2026-02-15 16:14:40', '2026-02-15 16:14:40'),
(272, 13, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 273, 0, '2026-02-15 16:15:54', '2026-02-15 16:15:54'),
(273, 12, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 277, 0, '2026-02-15 16:18:49', '2026-02-15 16:18:49'),
(274, 15, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 278, 0, '2026-02-19 05:39:44', '2026-02-19 05:39:44'),
(275, 6, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 279, 0, '2026-02-19 06:09:06', '2026-02-19 06:09:06'),
(276, 10, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 280, 0, '2026-02-22 13:02:15', '2026-02-22 13:02:15'),
(277, 8, 'payment_approved', 'আপনার February 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 281, 0, '2026-02-23 16:24:34', '2026-02-23 16:24:34'),
(278, 5, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 282, 1, '2026-03-01 13:20:13', '2026-03-01 13:20:47'),
(279, 8, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 283, 0, '2026-03-05 13:28:45', '2026-03-05 13:28:45'),
(280, 12, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 284, 0, '2026-03-05 17:11:23', '2026-03-05 17:11:23'),
(281, 1, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 285, 0, '2026-03-07 11:22:28', '2026-03-07 11:22:28'),
(282, 20, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 286, 0, '2026-03-08 03:58:48', '2026-03-08 03:58:48'),
(283, 6, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 288, 0, '2026-03-08 09:49:31', '2026-03-08 09:49:31'),
(284, 13, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 287, 0, '2026-03-08 09:49:40', '2026-03-08 09:49:40'),
(285, 15, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 289, 0, '2026-03-08 11:45:48', '2026-03-08 11:45:48'),
(286, 7, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 290, 0, '2026-03-08 16:14:57', '2026-03-08 16:14:57'),
(287, 21, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 294, 0, '2026-03-10 04:09:17', '2026-03-10 04:09:17'),
(288, 11, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 293, 0, '2026-03-10 04:09:48', '2026-03-10 04:09:48'),
(289, 18, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 292, 0, '2026-03-10 04:10:03', '2026-03-10 04:10:03'),
(290, 22, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 291, 0, '2026-03-10 04:10:11', '2026-03-10 04:10:11'),
(291, 19, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 296, 0, '2026-03-12 13:16:48', '2026-03-12 13:16:48'),
(292, 9, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 295, 0, '2026-03-12 13:17:00', '2026-03-12 13:17:00'),
(293, 10, 'payment_approved', 'আপনার March 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 297, 0, '2026-03-17 06:30:05', '2026-03-17 06:30:05'),
(294, 19, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 300, 0, '2026-04-05 14:26:11', '2026-04-05 14:26:11'),
(295, 9, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 299, 0, '2026-04-05 14:26:24', '2026-04-05 14:26:24'),
(296, 15, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 298, 0, '2026-04-05 14:26:34', '2026-04-05 14:26:34'),
(297, 10, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 301, 0, '2026-04-07 10:54:29', '2026-04-07 10:54:29'),
(298, 1, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 302, 0, '2026-04-07 11:02:15', '2026-04-07 11:02:15'),
(299, 7, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 303, 0, '2026-04-08 13:00:46', '2026-04-08 13:00:46'),
(300, 8, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 304, 0, '2026-04-08 14:42:26', '2026-04-08 14:42:26'),
(301, 20, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 305, 0, '2026-04-09 03:41:45', '2026-04-09 03:41:45'),
(302, 13, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 306, 0, '2026-04-09 12:47:20', '2026-04-09 12:47:20'),
(303, 12, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 307, 0, '2026-04-09 12:48:19', '2026-04-09 12:48:19'),
(304, 18, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 310, 0, '2026-04-11 12:29:37', '2026-04-11 12:29:37'),
(305, 22, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 309, 0, '2026-04-11 12:29:49', '2026-04-11 12:29:49'),
(306, 11, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 308, 0, '2026-04-11 12:29:54', '2026-04-11 12:29:54'),
(307, 5, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 311, 1, '2026-04-11 12:31:05', '2026-04-11 12:31:29'),
(308, 21, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 313, 0, '2026-04-19 09:38:56', '2026-04-19 09:38:56'),
(309, 6, 'payment_approved', 'আপনার April 2026 মাসের ৳500.00 টাকার পেমেন্ট অনুমোদিত হয়েছে।', 312, 0, '2026-04-19 09:38:59', '2026-04-19 09:38:59');

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
  `term` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly' COMMENT 'What kind of payment this row represents: monthly|yearly.',
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

INSERT INTO `payments` (`id`, `user_id`, `transaction_id`, `month`, `year`, `term`, `amount`, `method`, `payment_method_id`, `description`, `admin_note`, `proof_path`, `status`, `processed_at`, `processed_by`, `created_at`, `updated_at`) VALUES
(5, 1, 'from Jamal vai', 'November', 2024, 'monthly', '500.00', 'Hand Cash', 2, 'asdf', NULL, NULL, 'approved', NULL, NULL, '2025-12-04 08:44:05', '2025-12-04 08:44:43'),
(6, 1, 'from Jamal vai', 'December', 2024, 'monthly', '500.00', 'Hand Cash', 1, 'fgh', NULL, 'payment_proofs/TeMZaUplTOOAk601aeesQP9dYmRZFtdEfYnUzJUK.png', 'approved', '2025-12-04 08:57:00', 1, '2025-12-04 08:47:34', '2025-12-04 08:57:00'),
(7, 1, 'from Jamal vai', 'January', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, 'payment_proofs/qgvWiYxWSZSFljInjT0pIE8ArC52vM03EkTjm3o5.webp', 'approved', '2025-12-04 09:46:37', 1, '2025-12-04 08:59:28', '2025-12-04 09:46:37'),
(9, 1, 'from Jamal vai', 'February', 2025, 'monthly', '500.00', 'Hand Cash', 2, 'test', NULL, 'payment_proofs/mNJu3z82zOffyx7UlW4YW7ZwNT0K2UHpsKqAr5JY.webp', 'approved', '2025-12-04 09:46:22', 1, '2025-12-04 09:12:26', '2025-12-04 09:46:22'),
(10, 1, 'from Jamal vai', 'March', 2025, 'monthly', '500.00', 'Hand Cash', 2, 'test', NULL, NULL, 'approved', '2025-12-07 06:51:08', 1, '2025-12-05 21:40:27', '2025-12-07 06:51:08'),
(26, 1, 'asdfasf', 'December', 2025, 'monthly', '500.00', 'Hand Cash', 2, 'efsd', NULL, 'payment_proofs/EKeUdO0VAiTdTnk0u8AKc7XyFvTSk5ynjLyzhNgb.jpg', 'approved', '2025-12-07 10:26:48', 1, '2025-12-07 10:26:37', '2025-12-07 10:26:48'),
(30, 5, NULL, 'November', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:41:44', 1, '2025-12-13 18:11:23', '2025-12-20 03:41:44'),
(31, 5, NULL, 'December', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:42:40', 1, '2025-12-13 18:11:23', '2025-12-20 03:42:40'),
(32, 5, NULL, 'January', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:39:32', 1, '2025-12-13 18:12:56', '2025-12-20 03:39:32'),
(33, 5, NULL, 'February', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:42:00', 1, '2025-12-13 18:12:56', '2025-12-20 03:42:00'),
(34, 5, NULL, 'March', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:42:04', 1, '2025-12-13 18:12:56', '2025-12-20 03:42:04'),
(35, 5, NULL, 'April', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:42:14', 1, '2025-12-13 18:12:56', '2025-12-20 03:42:14'),
(36, 5, NULL, 'May', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:42:18', 1, '2025-12-13 18:12:56', '2025-12-20 03:42:18'),
(37, 5, NULL, 'June', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:42:21', 1, '2025-12-13 18:12:56', '2025-12-20 03:42:21'),
(38, 5, NULL, 'July', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:42:25', 1, '2025-12-13 18:12:56', '2025-12-20 03:42:25'),
(39, 5, NULL, 'August', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:42:28', 1, '2025-12-13 18:12:56', '2025-12-20 03:42:28'),
(40, 5, NULL, 'September', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:42:31', 1, '2025-12-13 18:12:56', '2025-12-20 03:42:31'),
(41, 5, NULL, 'October', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:42:34', 1, '2025-12-13 18:12:56', '2025-12-20 03:42:34'),
(42, 5, NULL, 'November', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:42:37', 1, '2025-12-13 18:12:56', '2025-12-20 03:42:37'),
(43, 5, NULL, 'December', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-13 18:28:23', 1, '2025-12-13 18:21:29', '2025-12-13 18:28:23'),
(44, 7, NULL, 'November', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:41:55', 1, '2025-12-14 12:46:15', '2025-12-20 03:41:55'),
(45, 7, NULL, 'December', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:41:58', 1, '2025-12-14 12:46:15', '2025-12-20 03:41:58'),
(46, 7, NULL, 'December', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-14 12:52:08', 1, '2025-12-14 12:49:36', '2025-12-14 12:52:08'),
(47, 7, NULL, 'January', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-15 07:09:27', 1, '2025-12-14 12:50:50', '2025-12-15 07:09:27'),
(48, 15, NULL, 'November', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:41:49', 1, '2025-12-15 07:05:56', '2025-12-20 03:41:49'),
(49, 15, NULL, 'December', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 03:41:52', 1, '2025-12-15 07:05:56', '2025-12-20 03:41:52'),
(50, 15, NULL, 'January', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-15 07:08:06', 1, '2025-12-15 07:06:23', '2025-12-15 07:08:06'),
(51, 15, NULL, 'February', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-15 07:08:28', 1, '2025-12-15 07:06:23', '2025-12-15 07:08:28'),
(52, 15, NULL, 'March', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-15 07:08:33', 1, '2025-12-15 07:06:23', '2025-12-15 07:08:33'),
(53, 15, NULL, 'April', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-15 07:08:38', 1, '2025-12-15 07:06:23', '2025-12-15 07:08:38'),
(54, 15, NULL, 'May', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-15 07:08:42', 1, '2025-12-15 07:06:23', '2025-12-15 07:08:42'),
(55, 15, NULL, 'June', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-15 07:08:46', 1, '2025-12-15 07:06:23', '2025-12-15 07:08:46'),
(56, 15, NULL, 'July', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-15 07:08:50', 1, '2025-12-15 07:06:23', '2025-12-15 07:08:50'),
(57, 15, NULL, 'August', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-15 07:09:12', 1, '2025-12-15 07:06:23', '2025-12-15 07:09:12'),
(58, 15, NULL, 'September', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-15 07:09:15', 1, '2025-12-15 07:06:23', '2025-12-15 07:09:15'),
(59, 15, NULL, 'October', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-15 07:09:18', 1, '2025-12-15 07:06:23', '2025-12-15 07:09:18'),
(60, 15, NULL, 'November', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-15 07:09:21', 1, '2025-12-15 07:06:23', '2025-12-15 07:09:21'),
(62, 18, 'নগদ', 'December', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 04:07:26', 1, '2025-12-20 04:07:08', '2025-12-20 04:07:26'),
(63, 6, 'হাতে', 'December', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'হাতে ', NULL, NULL, 'approved', '2025-12-20 04:11:31', 1, '2025-12-20 04:09:14', '2025-12-20 04:11:31'),
(64, 6, 'হাতে', 'November', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 04:11:27', 1, '2025-12-20 04:09:55', '2025-12-20 04:11:27'),
(65, 6, 'হাতে', 'December', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 04:11:29', 1, '2025-12-20 04:09:55', '2025-12-20 04:11:29'),
(66, 6, 'হাতে', 'January', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 04:10:58', 1, '2025-12-20 04:10:39', '2025-12-20 04:10:58'),
(67, 6, 'হাতে', 'February', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 04:11:08', 1, '2025-12-20 04:10:39', '2025-12-20 04:11:08'),
(68, 6, 'হাতে', 'March', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 04:11:02', 1, '2025-12-20 04:10:39', '2025-12-20 04:11:02'),
(69, 6, 'হাতে', 'April', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 04:11:04', 1, '2025-12-20 04:10:39', '2025-12-20 04:11:04'),
(70, 6, 'হাতে', 'May', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 04:11:11', 1, '2025-12-20 04:10:39', '2025-12-20 04:11:11'),
(71, 6, 'হাতে', 'June', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 04:11:13', 1, '2025-12-20 04:10:39', '2025-12-20 04:11:13'),
(72, 6, 'হাতে', 'July', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 04:11:16', 1, '2025-12-20 04:10:39', '2025-12-20 04:11:16'),
(73, 6, 'হাতে', 'August', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 04:11:18', 1, '2025-12-20 04:10:39', '2025-12-20 04:11:18'),
(74, 6, 'হাতে', 'September', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 04:11:20', 1, '2025-12-20 04:10:39', '2025-12-20 04:11:20'),
(75, 6, 'হাতে', 'October', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 04:11:22', 1, '2025-12-20 04:10:39', '2025-12-20 04:11:22'),
(76, 6, 'হাতে', 'November', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 04:11:25', 1, '2025-12-20 04:10:39', '2025-12-20 04:11:25'),
(77, 1, 'CLK5ARRFMJ', 'November', 2025, 'monthly', '500.00', 'bKash', 2, 'আগের ৩ হাজার সহ এখন ৪০০০ দিয়ে মোট ৭০০০ বকেয়া ক্লিয়ার ', NULL, 'payment_proofs/t5lpQcNXLzweiodbFJ0qFR1KwFLovwOCDAFDXcJL.jpg', 'approved', '2025-12-20 04:20:06', 1, '2025-12-20 04:19:45', '2025-12-20 04:20:06'),
(78, 1, 'CLK5ARRFMJ', 'October', 2025, 'monthly', '500.00', 'bKash', 2, 'আগের ৩ হাজার সহ এখন ৪০০০ দিয়ে মোট ৭০০০ বকেয়া ক্লিয়ার ', NULL, 'payment_proofs/t5lpQcNXLzweiodbFJ0qFR1KwFLovwOCDAFDXcJL.jpg', 'approved', '2025-12-20 04:20:09', 1, '2025-12-20 04:19:45', '2025-12-20 04:20:09'),
(79, 1, 'CLK5ARRFMJ', 'September', 2025, 'monthly', '500.00', 'bKash', 2, 'আগের ৩ হাজার সহ এখন ৪০০০ দিয়ে মোট ৭০০০ বকেয়া ক্লিয়ার ', NULL, 'payment_proofs/t5lpQcNXLzweiodbFJ0qFR1KwFLovwOCDAFDXcJL.jpg', 'approved', '2025-12-20 04:20:11', 1, '2025-12-20 04:19:45', '2025-12-20 04:20:11'),
(80, 1, 'CLK5ARRFMJ', 'August', 2025, 'monthly', '500.00', 'bKash', 2, 'আগের ৩ হাজার সহ এখন ৪০০০ দিয়ে মোট ৭০০০ বকেয়া ক্লিয়ার ', NULL, 'payment_proofs/t5lpQcNXLzweiodbFJ0qFR1KwFLovwOCDAFDXcJL.jpg', 'approved', '2025-12-20 04:20:14', 1, '2025-12-20 04:19:45', '2025-12-20 04:20:14'),
(81, 1, 'CLK5ARRFMJ', 'July', 2025, 'monthly', '500.00', 'bKash', 2, 'আগের ৩ হাজার সহ এখন ৪০০০ দিয়ে মোট ৭০০০ বকেয়া ক্লিয়ার ', NULL, 'payment_proofs/t5lpQcNXLzweiodbFJ0qFR1KwFLovwOCDAFDXcJL.jpg', 'approved', '2025-12-20 04:20:16', 1, '2025-12-20 04:19:45', '2025-12-20 04:20:16'),
(82, 1, 'CLK5ARRFMJ', 'June', 2025, 'monthly', '500.00', 'bKash', 2, 'আগের ৩ হাজার সহ এখন ৪০০০ দিয়ে মোট ৭০০০ বকেয়া ক্লিয়ার ', NULL, 'payment_proofs/t5lpQcNXLzweiodbFJ0qFR1KwFLovwOCDAFDXcJL.jpg', 'approved', '2025-12-20 04:20:21', 1, '2025-12-20 04:19:45', '2025-12-20 04:20:21'),
(83, 1, 'CLK5ARRFMJ', 'May', 2025, 'monthly', '500.00', 'bKash', 2, 'আগের ৩ হাজার সহ এখন ৪০০০ দিয়ে মোট ৭০০০ বকেয়া ক্লিয়ার ', NULL, 'payment_proofs/t5lpQcNXLzweiodbFJ0qFR1KwFLovwOCDAFDXcJL.jpg', 'approved', '2025-12-20 04:20:23', 1, '2025-12-20 04:19:45', '2025-12-20 04:20:23'),
(84, 1, 'CLK5ARRFMJ', 'April', 2025, 'monthly', '500.00', 'bKash', 2, 'আগের ৩ হাজার সহ এখন ৪০০০ দিয়ে মোট ৭০০০ বকেয়া ক্লিয়ার ', NULL, 'payment_proofs/t5lpQcNXLzweiodbFJ0qFR1KwFLovwOCDAFDXcJL.jpg', 'approved', '2025-12-20 04:20:25', 1, '2025-12-20 04:19:45', '2025-12-20 04:20:25'),
(85, 18, 'cb', 'November', 2024, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 05:22:06', 1, '2025-12-20 05:21:40', '2025-12-20 05:22:06'),
(86, 18, 'cb', 'December', 2024, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 05:22:09', 1, '2025-12-20 05:21:40', '2025-12-20 05:22:09'),
(87, 18, 'previous-payemnts', 'January', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 05:22:57', 1, '2025-12-20 05:22:44', '2025-12-20 05:22:57'),
(88, 18, 'previous-payemnts', 'February', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 05:23:00', 1, '2025-12-20 05:22:44', '2025-12-20 05:23:00'),
(89, 18, 'previous-payemnts', 'March', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 05:23:02', 1, '2025-12-20 05:22:44', '2025-12-20 05:23:02'),
(90, 18, 'previous-payemnts', 'April', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 05:23:04', 1, '2025-12-20 05:22:44', '2025-12-20 05:23:04'),
(91, 18, 'previous-payemnts', 'May', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 05:23:07', 1, '2025-12-20 05:22:44', '2025-12-20 05:23:07'),
(92, 18, 'previous-payemnts', 'June', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 05:23:09', 1, '2025-12-20 05:22:44', '2025-12-20 05:23:09'),
(93, 18, 'previous-payemnts', 'July', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 05:23:11', 1, '2025-12-20 05:22:44', '2025-12-20 05:23:11'),
(94, 18, 'previous-payemnts', 'August', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 05:23:14', 1, '2025-12-20 05:22:44', '2025-12-20 05:23:14'),
(95, 18, 'previous-payemnts', 'September', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 05:23:16', 1, '2025-12-20 05:22:44', '2025-12-20 05:23:16'),
(96, 18, 'previous-payemnts', 'October', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 05:23:18', 1, '2025-12-20 05:22:44', '2025-12-20 05:23:18'),
(97, 18, 'previous-payemnts', 'November', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 05:23:20', 1, '2025-12-20 05:22:44', '2025-12-20 05:23:20'),
(98, 10, 'hate', 'December', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 05:54:52', 1, '2025-12-20 05:24:43', '2025-12-20 05:54:52'),
(99, 10, 'previous-payemnts', 'November', 2024, 'monthly', '500.00', 'bKash', 2, 'previous-payemnts', NULL, NULL, 'approved', '2025-12-20 05:58:29', 1, '2025-12-20 05:25:56', '2025-12-20 05:58:29'),
(100, 10, 'previous-payemnts', 'December', 2024, 'monthly', '500.00', 'bKash', 2, 'previous-payemnts', NULL, NULL, 'approved', '2025-12-20 05:58:31', 1, '2025-12-20 05:25:56', '2025-12-20 05:58:31'),
(101, 10, 'previous', 'January', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'previous payments', NULL, NULL, 'approved', '2025-12-20 05:55:41', 1, '2025-12-20 05:53:16', '2025-12-20 05:55:41'),
(102, 10, 'previous', 'February', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'previous payments', NULL, NULL, 'approved', '2025-12-20 05:55:44', 1, '2025-12-20 05:53:16', '2025-12-20 05:55:44'),
(103, 10, 'previous', 'March', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'previous payments', NULL, NULL, 'approved', '2025-12-20 05:55:46', 1, '2025-12-20 05:53:16', '2025-12-20 05:55:46'),
(104, 10, 'previous', 'April', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'previous payments', NULL, NULL, 'approved', '2025-12-20 05:55:48', 1, '2025-12-20 05:53:16', '2025-12-20 05:55:48'),
(105, 10, 'previous', 'May', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'previous payments', NULL, NULL, 'approved', '2025-12-20 05:55:50', 1, '2025-12-20 05:53:16', '2025-12-20 05:55:50'),
(106, 10, 'previous', 'June', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'previous payments', NULL, NULL, 'approved', '2025-12-20 05:57:37', 1, '2025-12-20 05:53:16', '2025-12-20 05:57:37'),
(107, 10, 'previous', 'July', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'previous payments', NULL, NULL, 'approved', '2025-12-20 05:57:42', 1, '2025-12-20 05:53:16', '2025-12-20 05:57:42'),
(108, 10, 'previous', 'August', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'previous payments', NULL, NULL, 'approved', '2025-12-20 05:57:45', 1, '2025-12-20 05:53:16', '2025-12-20 05:57:45'),
(109, 10, 'previous', 'September', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'previous payments', NULL, NULL, 'approved', '2025-12-20 05:57:47', 1, '2025-12-20 05:53:16', '2025-12-20 05:57:47'),
(110, 10, 'previous', 'October', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'previous payments', NULL, NULL, 'approved', '2025-12-20 05:57:49', 1, '2025-12-20 05:53:16', '2025-12-20 05:57:49'),
(111, 10, 'previous', 'November', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'previous payments', NULL, NULL, 'approved', '2025-12-20 05:57:51', 1, '2025-12-20 05:53:16', '2025-12-20 05:57:51'),
(112, 11, 'current-payment', 'December', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:19:14', 1, '2025-12-20 06:06:11', '2025-12-20 06:19:14'),
(113, 11, '24monir', 'November', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:20:00', 1, '2025-12-20 06:09:35', '2025-12-20 06:20:00'),
(114, 11, '24monir', 'December', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:20:02', 1, '2025-12-20 06:09:35', '2025-12-20 06:20:02'),
(115, 11, 'hatedisemonir', 'January', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:19:36', 1, '2025-12-20 06:19:06', '2025-12-20 06:19:36'),
(116, 11, 'hatedisemonir', 'March', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:19:38', 1, '2025-12-20 06:19:06', '2025-12-20 06:19:38'),
(117, 11, 'hatedisemonir', 'April', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:19:40', 1, '2025-12-20 06:19:06', '2025-12-20 06:19:40'),
(118, 11, 'hatedisemonir', 'May', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:19:42', 1, '2025-12-20 06:19:06', '2025-12-20 06:19:42'),
(119, 11, 'hatedisemonir', 'June', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:19:45', 1, '2025-12-20 06:19:06', '2025-12-20 06:19:45'),
(120, 11, 'hatedisemonir', 'July', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:19:47', 1, '2025-12-20 06:19:06', '2025-12-20 06:19:47'),
(121, 11, 'hatedisemonir', 'August', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:19:49', 1, '2025-12-20 06:19:06', '2025-12-20 06:19:49'),
(122, 11, 'hatedisemonir', 'September', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:19:51', 1, '2025-12-20 06:19:06', '2025-12-20 06:19:51'),
(123, 11, 'hatedisemonir', 'October', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:19:53', 1, '2025-12-20 06:19:06', '2025-12-20 06:19:53'),
(124, 11, 'hatedisemonir', 'November', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:19:55', 1, '2025-12-20 06:19:06', '2025-12-20 06:19:55'),
(125, 11, 'hatedisemonir', 'February', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:19:57', 1, '2025-12-20 06:19:06', '2025-12-20 06:19:57'),
(126, 13, 'sdf89sfkj2', 'December', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:22:24', 1, '2025-12-20 06:20:22', '2025-12-20 06:22:24'),
(127, 13, 'hatedisbe-df', 'December', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:22:31', 1, '2025-12-20 06:21:14', '2025-12-20 06:22:31'),
(128, 13, 'hatedisbe-df', 'November', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:22:29', 1, '2025-12-20 06:21:14', '2025-12-20 06:22:29'),
(129, 13, 'asdfw55fdg', 'January', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 06:22:50', 1, '2025-12-20 06:21:56', '2025-12-20 06:22:50'),
(130, 13, 'asdfw55fdg', 'February', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 06:22:52', 1, '2025-12-20 06:21:56', '2025-12-20 06:22:52'),
(131, 13, 'asdfw55fdg', 'March', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 06:22:55', 1, '2025-12-20 06:21:56', '2025-12-20 06:22:55'),
(132, 13, 'asdfw55fdg', 'April', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 06:22:57', 1, '2025-12-20 06:21:56', '2025-12-20 06:22:57'),
(133, 13, 'asdfw55fdg', 'May', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 06:23:00', 1, '2025-12-20 06:21:56', '2025-12-20 06:23:00'),
(134, 13, 'asdfw55fdg', 'June', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 06:23:06', 1, '2025-12-20 06:21:56', '2025-12-20 06:23:06'),
(135, 13, 'asdfw55fdg', 'July', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 06:23:02', 1, '2025-12-20 06:21:56', '2025-12-20 06:23:02'),
(136, 13, 'asdfw55fdg', 'August', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 06:23:04', 1, '2025-12-20 06:21:56', '2025-12-20 06:23:04'),
(137, 13, 'asdfw55fdg', 'September', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 06:22:38', 1, '2025-12-20 06:21:56', '2025-12-20 06:22:38'),
(138, 13, 'asdfw55fdg', 'October', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 06:22:36', 1, '2025-12-20 06:21:56', '2025-12-20 06:22:36'),
(139, 13, 'asdfw55fdg', 'November', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 06:22:34', 1, '2025-12-20 06:21:56', '2025-12-20 06:22:34'),
(140, 8, 'paid9834', 'December', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:25:34', 1, '2025-12-20 06:24:32', '2025-12-20 06:25:34'),
(141, 9, 'paids45sd', 'December', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'emdad dise', NULL, NULL, 'approved', '2025-12-20 06:25:36', 1, '2025-12-20 06:24:48', '2025-12-20 06:25:36'),
(142, 12, 'directbkash098s', 'December', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 06:25:31', 1, '2025-12-20 06:25:00', '2025-12-20 06:25:31'),
(143, 15, 'alamins09sdf', 'December', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 06:25:29', 1, '2025-12-20 06:25:16', '2025-12-20 06:25:29'),
(144, 7, 'Hatehate', 'February', 2025, 'monthly', '500.00', 'bKash', 2, 'Hate', NULL, NULL, 'approved', '2025-12-20 11:18:24', 1, '2025-12-20 09:13:31', '2025-12-20 11:18:24'),
(145, 7, 'Hatehate', 'March', 2025, 'monthly', '500.00', 'bKash', 2, 'Hate', NULL, NULL, 'approved', '2025-12-20 11:18:26', 1, '2025-12-20 09:13:31', '2025-12-20 11:18:26'),
(146, 7, 'Hatehate', 'April', 2025, 'monthly', '500.00', 'bKash', 2, 'Hate', NULL, NULL, 'approved', '2025-12-20 11:13:59', 1, '2025-12-20 09:13:31', '2025-12-20 11:13:59'),
(147, 7, 'Hatehate', 'May', 2025, 'monthly', '500.00', 'bKash', 2, 'Hate', NULL, NULL, 'approved', '2025-12-20 11:14:15', 1, '2025-12-20 09:13:31', '2025-12-20 11:14:15'),
(148, 7, 'Hatehate', 'June', 2025, 'monthly', '500.00', 'bKash', 2, 'Hate', NULL, NULL, 'approved', '2025-12-20 11:18:28', 1, '2025-12-20 09:13:31', '2025-12-20 11:18:28'),
(149, 7, 'Hatehate', 'July', 2025, 'monthly', '500.00', 'bKash', 2, 'Hate', NULL, NULL, 'approved', '2025-12-20 11:14:30', 1, '2025-12-20 09:13:31', '2025-12-20 11:14:30'),
(150, 7, 'Hatehate', 'August', 2025, 'monthly', '500.00', 'bKash', 2, 'Hate', NULL, NULL, 'approved', '2025-12-20 11:14:20', 1, '2025-12-20 09:13:31', '2025-12-20 11:14:20'),
(151, 7, 'Hatehate', 'September', 2025, 'monthly', '500.00', 'bKash', 2, 'Hate', NULL, NULL, 'approved', '2025-12-20 11:14:33', 1, '2025-12-20 09:13:31', '2025-12-20 11:14:33'),
(152, 7, 'Hatehate', 'October', 2025, 'monthly', '500.00', 'bKash', 2, 'Hate', NULL, NULL, 'approved', '2025-12-20 11:14:40', 1, '2025-12-20 09:13:31', '2025-12-20 11:14:40'),
(153, 7, 'Hatehate', 'November', 2025, 'monthly', '500.00', 'bKash', 2, 'Hate', NULL, NULL, 'approved', '2025-12-20 10:53:06', 1, '2025-12-20 09:13:31', '2025-12-20 10:53:06'),
(154, 12, 'Hsjnz', 'November', 2024, 'monthly', '500.00', 'bKash', 2, 'Hskbz', NULL, NULL, 'approved', '2025-12-20 11:18:22', 1, '2025-12-20 09:14:33', '2025-12-20 11:18:22'),
(155, 12, 'Hsjnz', 'December', 2024, 'monthly', '500.00', 'bKash', 2, 'Hskbz', NULL, NULL, 'approved', '2025-12-20 11:13:55', 1, '2025-12-20 09:14:33', '2025-12-20 11:13:55'),
(156, 12, 'Zbjbz', 'January', 2025, 'monthly', '500.00', 'bKash', 2, 'Xaxhs', NULL, NULL, 'approved', '2025-12-20 11:13:43', 1, '2025-12-20 09:15:35', '2025-12-20 11:13:43'),
(157, 12, 'Zbjbz', 'February', 2025, 'monthly', '500.00', 'bKash', 2, 'Xaxhs', NULL, NULL, 'approved', '2025-12-20 11:12:56', 1, '2025-12-20 09:15:35', '2025-12-20 11:12:56'),
(158, 12, 'Zbjbz', 'March', 2025, 'monthly', '500.00', 'bKash', 2, 'Xaxhs', NULL, NULL, 'approved', '2025-12-20 11:18:16', 1, '2025-12-20 09:15:35', '2025-12-20 11:18:16'),
(159, 12, 'Zbjbz', 'April', 2025, 'monthly', '500.00', 'bKash', 2, 'Xaxhs', NULL, NULL, 'approved', '2025-12-20 11:13:02', 1, '2025-12-20 09:15:35', '2025-12-20 11:13:02'),
(160, 12, 'Zbjbz', 'May', 2025, 'monthly', '500.00', 'bKash', 2, 'Xaxhs', NULL, NULL, 'approved', '2025-12-20 11:15:09', 1, '2025-12-20 09:15:35', '2025-12-20 11:15:09'),
(161, 12, 'Zbjbz', 'June', 2025, 'monthly', '500.00', 'bKash', 2, 'Xaxhs', NULL, NULL, 'approved', '2025-12-20 11:13:47', 1, '2025-12-20 09:15:35', '2025-12-20 11:13:47'),
(162, 12, 'Zbjbz', 'July', 2025, 'monthly', '500.00', 'bKash', 2, 'Xaxhs', NULL, NULL, 'approved', '2025-12-20 11:18:18', 1, '2025-12-20 09:15:35', '2025-12-20 11:18:18'),
(163, 12, 'Zbjbz', 'August', 2025, 'monthly', '500.00', 'bKash', 2, 'Xaxhs', NULL, NULL, 'approved', '2025-12-20 11:15:12', 1, '2025-12-20 09:15:35', '2025-12-20 11:15:12'),
(164, 12, 'Zbjbz', 'September', 2025, 'monthly', '500.00', 'bKash', 2, 'Xaxhs', NULL, NULL, 'approved', '2025-12-20 11:13:51', 1, '2025-12-20 09:15:35', '2025-12-20 11:13:51'),
(165, 12, 'Zbjbz', 'October', 2025, 'monthly', '500.00', 'bKash', 2, 'Xaxhs', NULL, NULL, 'approved', '2025-12-20 11:18:20', 1, '2025-12-20 09:15:35', '2025-12-20 11:18:20'),
(166, 12, 'Zbjbz', 'November', 2025, 'monthly', '500.00', 'bKash', 2, 'Xaxhs', NULL, NULL, 'approved', '2025-12-20 10:53:03', 1, '2025-12-20 09:15:35', '2025-12-20 10:53:03'),
(167, 9, 'Hsjsysusj', 'November', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 11:13:39', 1, '2025-12-20 09:16:47', '2025-12-20 11:13:39'),
(168, 9, 'Hsjsysusj', 'December', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 11:15:04', 1, '2025-12-20 09:16:47', '2025-12-20 11:15:04'),
(169, 9, 'Emdaderhate', 'January', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Paisi', NULL, NULL, 'approved', '2025-12-20 10:53:19', 1, '2025-12-20 09:17:32', '2025-12-20 10:53:19'),
(170, 9, 'Emdaderhate', 'February', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Paisi', NULL, NULL, 'approved', '2025-12-20 10:53:22', 1, '2025-12-20 09:17:32', '2025-12-20 10:53:22'),
(171, 9, 'Emdaderhate', 'March', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Paisi', NULL, NULL, 'approved', '2025-12-20 10:53:24', 1, '2025-12-20 09:17:32', '2025-12-20 10:53:24'),
(172, 9, 'Emdaderhate', 'April', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Paisi', NULL, NULL, 'approved', '2025-12-20 10:53:26', 1, '2025-12-20 09:17:32', '2025-12-20 10:53:26'),
(173, 9, 'Emdaderhate', 'May', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Paisi', NULL, NULL, 'approved', '2025-12-20 10:53:28', 1, '2025-12-20 09:17:32', '2025-12-20 10:53:28'),
(174, 9, 'Emdaderhate', 'June', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Paisi', NULL, NULL, 'approved', '2025-12-20 10:53:32', 1, '2025-12-20 09:17:32', '2025-12-20 10:53:32'),
(175, 9, 'Emdaderhate', 'July', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Paisi', NULL, NULL, 'approved', '2025-12-20 10:53:34', 1, '2025-12-20 09:17:32', '2025-12-20 10:53:34'),
(176, 9, 'Emdaderhate', 'August', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Paisi', NULL, NULL, 'approved', '2025-12-20 10:53:36', 1, '2025-12-20 09:17:32', '2025-12-20 10:53:36'),
(177, 9, 'Emdaderhate', 'September', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Paisi', NULL, NULL, 'approved', '2025-12-20 11:12:29', 1, '2025-12-20 09:17:32', '2025-12-20 11:12:29'),
(178, 9, 'Emdaderhate', 'October', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Paisi', NULL, NULL, 'approved', '2025-12-20 11:12:34', 1, '2025-12-20 09:17:32', '2025-12-20 11:12:34'),
(179, 9, 'Emdaderhate', 'November', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Paisi', NULL, NULL, 'approved', '2025-12-20 10:53:01', 1, '2025-12-20 09:17:32', '2025-12-20 10:53:01'),
(180, 20, NULL, 'December', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 10:50:17', 1, '2025-12-20 10:48:15', '2025-12-20 10:50:17'),
(181, 20, NULL, 'November', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 10:53:14', 1, '2025-12-20 10:51:59', '2025-12-20 10:53:14'),
(182, 20, NULL, 'December', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 10:53:17', 1, '2025-12-20 10:51:59', '2025-12-20 10:53:17'),
(183, 19, 'adfoiasjd4oe', 'December', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 11:50:25', 1, '2025-12-20 11:22:44', '2025-12-20 11:50:25'),
(184, 19, 'asdfaw5446hf', 'November', 2024, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 11:26:42', 1, '2025-12-20 11:23:51', '2025-12-20 11:26:42'),
(185, 19, 'asdfaw5446hf', 'December', 2024, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 11:26:44', 1, '2025-12-20 11:23:51', '2025-12-20 11:26:44'),
(186, 19, 'asdfds6f4gh984rtfhy', 'February', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:26:26', 1, '2025-12-20 11:25:00', '2025-12-20 11:26:26'),
(187, 19, 'asdfds6f4gh984rtfhy', 'March', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:26:22', 1, '2025-12-20 11:25:00', '2025-12-20 11:26:22'),
(188, 19, 'asdfds6f4gh984rtfhy', 'April', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:26:19', 1, '2025-12-20 11:25:00', '2025-12-20 11:26:19'),
(189, 19, 'asdfds6f4gh984rtfhy', 'May', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:26:11', 1, '2025-12-20 11:25:00', '2025-12-20 11:26:11'),
(190, 19, 'asdfds6f4gh984rtfhy', 'June', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:26:15', 1, '2025-12-20 11:25:00', '2025-12-20 11:26:15'),
(191, 19, 'asdfds6f4gh984rtfhy', 'July', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:26:07', 1, '2025-12-20 11:25:00', '2025-12-20 11:26:07'),
(192, 19, 'asdfds6f4gh984rtfhy', 'August', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:26:02', 1, '2025-12-20 11:25:00', '2025-12-20 11:26:02'),
(193, 19, 'asdfds6f4gh984rtfhy', 'September', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:25:58', 1, '2025-12-20 11:25:00', '2025-12-20 11:25:58'),
(194, 19, 'asdfds6f4gh984rtfhy', 'October', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:25:53', 1, '2025-12-20 11:25:00', '2025-12-20 11:25:53'),
(195, 19, 'asdfds6f4gh984rtfhy', 'November', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:25:49', 1, '2025-12-20 11:25:00', '2025-12-20 11:25:49'),
(196, 19, 'asdfds6f4gh984rtfhy', 'January', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:26:30', 1, '2025-12-20 11:25:00', '2025-12-20 11:26:30'),
(197, 21, NULL, 'December', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2025-12-20 11:50:00', 1, '2025-12-20 11:29:53', '2025-12-20 11:50:00'),
(198, 21, 'Asfcvbhb', 'November', 2024, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 11:59:44', 1, '2025-12-20 11:36:17', '2025-12-20 11:59:44'),
(199, 21, 'Asfcvbhb', 'December', 2024, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 11:59:48', 1, '2025-12-20 11:36:17', '2025-12-20 11:59:48'),
(200, 20, 'adfcvjh4', 'January', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:58:14', 1, '2025-12-20 11:55:40', '2025-12-20 11:58:14'),
(201, 20, 'adfcvjh4', 'February', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:58:34', 1, '2025-12-20 11:55:40', '2025-12-20 11:58:34'),
(202, 20, 'adfcvjh4', 'March', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:58:48', 1, '2025-12-20 11:55:40', '2025-12-20 11:58:48'),
(203, 20, 'adfcvjh4', 'April', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:59:24', 1, '2025-12-20 11:55:40', '2025-12-20 11:59:24'),
(204, 20, 'adfcvjh4', 'May', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:59:31', 1, '2025-12-20 11:55:40', '2025-12-20 11:59:31'),
(205, 20, 'adfcvjh4', 'June', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:59:35', 1, '2025-12-20 11:55:40', '2025-12-20 11:59:35'),
(206, 20, 'adfcvjh4', 'July', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:59:38', 1, '2025-12-20 11:55:40', '2025-12-20 11:59:38'),
(207, 20, 'adfcvjh4', 'August', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:59:28', 1, '2025-12-20 11:55:40', '2025-12-20 11:59:28'),
(208, 20, 'adfcvjh4', 'September', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:59:42', 1, '2025-12-20 11:55:40', '2025-12-20 11:59:42'),
(209, 20, 'adfcvjh4', 'October', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:59:13', 1, '2025-12-20 11:55:40', '2025-12-20 11:59:13'),
(210, 20, 'adfcvjh4', 'November', 2025, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2025-12-20 11:59:19', 1, '2025-12-20 11:55:40', '2025-12-20 11:59:19'),
(211, 21, 'Atygbvc', 'January', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 12:03:07', 1, '2025-12-20 12:02:54', '2025-12-20 12:03:07'),
(212, 21, 'Atygbvc', 'February', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 12:03:10', 1, '2025-12-20 12:02:54', '2025-12-20 12:03:10'),
(213, 21, 'Atygbvc', 'March', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 12:03:13', 1, '2025-12-20 12:02:54', '2025-12-20 12:03:13'),
(214, 21, 'Atygbvc', 'April', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 12:03:16', 1, '2025-12-20 12:02:54', '2025-12-20 12:03:16'),
(215, 21, 'Atygbvc', 'May', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 12:03:18', 1, '2025-12-20 12:02:54', '2025-12-20 12:03:18'),
(216, 21, 'Atygbvc', 'June', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 12:03:21', 1, '2025-12-20 12:02:54', '2025-12-20 12:03:21'),
(217, 21, 'Atygbvc', 'July', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 12:03:23', 1, '2025-12-20 12:02:54', '2025-12-20 12:03:23'),
(218, 21, 'Atygbvc', 'August', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 12:03:26', 1, '2025-12-20 12:02:54', '2025-12-20 12:03:26'),
(219, 21, 'Atygbvc', 'September', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 12:03:29', 1, '2025-12-20 12:02:54', '2025-12-20 12:03:29'),
(220, 21, 'Atygbvc', 'October', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 12:03:32', 1, '2025-12-20 12:02:54', '2025-12-20 12:03:32'),
(221, 21, 'Atygbvc', 'November', 2025, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 12:03:34', 1, '2025-12-20 12:02:54', '2025-12-20 12:03:34'),
(222, 8, 'Fttfchff', 'November', 2024, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 12:06:19', 1, '2025-12-20 12:05:52', '2025-12-20 12:06:19'),
(223, 8, 'Fttfchff', 'December', 2024, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2025-12-20 12:06:21', 1, '2025-12-20 12:05:52', '2025-12-20 12:06:21'),
(224, 8, 'Uci ufo hvo void ', 'January', 2025, 'monthly', '500.00', 'Nagad', 3, 'Jkhcuc', NULL, NULL, 'approved', '2025-12-20 13:53:33', 1, '2025-12-20 13:46:51', '2025-12-20 13:53:33'),
(225, 8, 'Uci ufo hvo void ', 'February', 2025, 'monthly', '500.00', 'Nagad', 3, 'Jkhcuc', NULL, NULL, 'approved', '2025-12-20 13:53:36', 1, '2025-12-20 13:46:51', '2025-12-20 13:53:36'),
(226, 8, 'Uci ufo hvo void ', 'March', 2025, 'monthly', '500.00', 'Nagad', 3, 'Jkhcuc', NULL, NULL, 'approved', '2025-12-20 13:54:33', 1, '2025-12-20 13:46:51', '2025-12-20 13:54:33'),
(227, 8, 'CASH-20251220134934-8', 'April', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Gjdhf', NULL, NULL, 'approved', '2025-12-20 13:53:13', 1, '2025-12-20 13:49:34', '2025-12-20 13:53:13'),
(228, 8, 'CASH-20251220134934-8', 'June', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Gjdhf', NULL, NULL, 'approved', '2025-12-20 13:53:54', 1, '2025-12-20 13:49:34', '2025-12-20 13:53:54'),
(229, 8, 'CASH-20251220134934-8', 'July', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Gjdhf', NULL, NULL, 'approved', '2025-12-20 13:53:17', 1, '2025-12-20 13:49:34', '2025-12-20 13:53:17'),
(230, 8, 'CASH-20251220134934-8', 'May', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Gjdhf', NULL, NULL, 'approved', '2025-12-20 13:53:21', 1, '2025-12-20 13:49:34', '2025-12-20 13:53:21'),
(231, 8, 'CASH-20251220134934-8', 'August', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Gjdhf', NULL, NULL, 'approved', '2025-12-20 13:53:56', 1, '2025-12-20 13:49:34', '2025-12-20 13:53:56'),
(232, 8, 'CASH-20251220134934-8', 'September', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Gjdhf', NULL, NULL, 'approved', '2025-12-20 13:53:24', 1, '2025-12-20 13:49:34', '2025-12-20 13:53:24'),
(233, 8, 'CASH-20251220134934-8', 'October', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Gjdhf', NULL, NULL, 'approved', '2025-12-20 13:53:29', 1, '2025-12-20 13:49:34', '2025-12-20 13:53:29'),
(234, 8, 'CASH-20251220134934-8', 'November', 2025, 'monthly', '500.00', 'Hand Cash', 1, 'Gjdhf', NULL, NULL, 'approved', '2025-12-20 13:53:39', 1, '2025-12-20 13:49:34', '2025-12-20 13:53:39'),
(235, 9, NULL, 'January', 2026, 'monthly', '500.00', 'bKash', 2, NULL, 'আমি টাকা পাই নাই কেশ তাই এটা প্রত্যাখ্যান করলাম', NULL, 'rejected', '2026-01-05 15:49:07', 5, '2026-01-04 10:00:59', '2026-01-05 15:49:07'),
(236, 19, 'CASH-20260105155044-19', 'January', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-05 15:51:05', 5, '2026-01-05 15:50:44', '2026-01-05 15:51:05'),
(237, 8, 'CASH-20260105160058-8', 'January', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-05 16:03:03', 5, '2026-01-05 16:00:58', '2026-01-05 16:03:03'),
(238, 1, 'jhhgve3', 'January', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, 'payment_proofs/UERbSRelnifMkTRdn3P2sJHzTdBwleHvZcTV2sWT.jpg', 'approved', '2026-01-05 16:02:38', 5, '2026-01-05 16:02:21', '2026-01-05 16:02:38'),
(239, 12, 'kjhgvv4', 'January', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-01-05 16:26:37', 5, '2026-01-05 16:26:19', '2026-01-05 16:26:37'),
(240, 10, 'tufft47', 'January', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-01-06 10:29:04', 5, '2026-01-06 10:28:49', '2026-01-06 10:29:04'),
(241, 7, 'CASH-20260106111050-7', 'January', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-06 11:11:18', 5, '2026-01-06 11:10:50', '2026-01-06 11:11:18'),
(242, 9, 'DA90WHNEJA', 'January', 2026, 'monthly', '500.00', 'bKash', 2, 'হুমায়ুনের টাকা ', NULL, 'payment_proofs/4DTunMONTdxlqDiKc0PZmPXUWyw7bvGR9tQzgPlh.jpg', 'approved', '2026-01-09 15:40:06', 5, '2026-01-09 14:04:32', '2026-01-09 15:40:06'),
(243, 5, 'CASH-20260109153934-5', 'January', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-09 15:40:19', 5, '2026-01-09 15:39:34', '2026-01-09 15:40:19'),
(244, 20, 'CASH-20260109154105-20', 'January', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-09 15:41:30', 5, '2026-01-09 15:41:05', '2026-01-09 15:41:30'),
(245, 6, 'CASH-20260109154209-6', 'January', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-09 15:42:43', 5, '2026-01-09 15:42:09', '2026-01-09 15:42:43'),
(246, 22, 'CASH-20260109154328-22', 'January', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-09 15:44:28', 5, '2026-01-09 15:43:28', '2026-01-09 15:44:28'),
(247, 18, 'CASH-20260109154354-18', 'January', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-09 15:44:13', 5, '2026-01-09 15:43:54', '2026-01-09 15:44:13'),
(248, 22, 'CASH-20260113151942-22', 'January', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-13 15:27:10', 5, '2026-01-13 15:19:42', '2026-01-13 15:27:10'),
(249, 22, 'CASH-20260113151942-22', 'February', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-13 15:27:12', 5, '2026-01-13 15:19:42', '2026-01-13 15:27:12'),
(250, 22, 'CASH-20260113151942-22', 'March', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-13 15:27:16', 5, '2026-01-13 15:19:42', '2026-01-13 15:27:16'),
(251, 22, 'CASH-20260113151942-22', 'April', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-13 15:27:22', 5, '2026-01-13 15:19:42', '2026-01-13 15:27:22'),
(252, 22, 'CASH-20260113151942-22', 'May', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-13 15:27:25', 5, '2026-01-13 15:19:42', '2026-01-13 15:27:25'),
(253, 22, 'CASH-20260113151942-22', 'June', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-13 15:27:28', 5, '2026-01-13 15:19:42', '2026-01-13 15:27:28'),
(254, 22, 'CASH-20260113151942-22', 'July', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-13 15:27:35', 5, '2026-01-13 15:19:42', '2026-01-13 15:27:35'),
(255, 22, 'CASH-20260113151942-22', 'August', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-13 15:27:38', 5, '2026-01-13 15:19:42', '2026-01-13 15:27:38'),
(256, 22, 'CASH-20260113151942-22', 'September', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-13 15:26:54', 5, '2026-01-13 15:19:42', '2026-01-13 15:26:54'),
(257, 22, 'CASH-20260113151942-22', 'October', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-13 15:26:58', 5, '2026-01-13 15:19:42', '2026-01-13 15:26:58'),
(258, 22, 'CASH-20260113151942-22', 'November', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-13 15:27:03', 5, '2026-01-13 15:19:42', '2026-01-13 15:27:03'),
(259, 22, 'CASH-20260113151942-22', 'December', 2025, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-13 15:27:07', 5, '2026-01-13 15:19:42', '2026-01-13 15:27:07'),
(260, 22, 'CASH-20260113152051-22', 'November', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-13 15:26:30', 5, '2026-01-13 15:20:51', '2026-01-13 15:26:30'),
(261, 22, 'CASH-20260113152136-22', 'December', 2024, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-13 15:26:26', 5, '2026-01-13 15:21:36', '2026-01-13 15:26:26'),
(262, 11, NULL, 'January', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, 'payment_proofs/YminDsn8rAJ97XhCdmHGGvkZbUiX6fcHt0j3XQc2.jpg', 'approved', '2026-01-13 17:55:20', 5, '2026-01-13 17:55:07', '2026-01-13 17:55:20'),
(263, 13, 'CASH-20260114132159-13', 'January', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-14 13:39:08', 5, '2026-01-14 13:21:59', '2026-01-14 13:39:08'),
(264, 21, '1efddd', 'January', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-01-15 13:01:07', 5, '2026-01-15 13:00:54', '2026-01-15 13:01:07'),
(265, 15, 'CASH-20260119124228-15', 'January', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-01-19 12:42:40', 5, '2026-01-19 12:42:28', '2026-01-19 12:42:40'),
(266, 5, 'CASH-20260202114546-5', 'February', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-02-02 11:45:58', 5, '2026-02-02 11:45:46', '2026-02-02 11:45:58'),
(267, 19, 'CASH-20260206125800-19', 'February', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-02-06 12:58:15', 5, '2026-02-06 12:58:00', '2026-02-06 12:58:15'),
(268, 18, 'hggffc4', 'February', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-02-06 13:15:36', 5, '2026-02-06 13:14:37', '2026-02-06 13:15:36'),
(269, 22, 'Rtyygg34', 'February', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-02-06 13:15:27', 5, '2026-02-06 13:15:03', '2026-02-06 13:15:27'),
(270, 20, 'DB81VU2J5J ', 'February', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-02-08 03:35:12', 5, '2026-02-08 03:34:55', '2026-02-08 03:35:12'),
(271, 11, NULL, 'February', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-02-12 07:07:19', 5, '2026-02-12 07:07:08', '2026-02-12 07:07:19'),
(272, 1, 'DBF84YTVUK', 'February', 2026, 'monthly', '500.00', 'bKash', 2, 'done', NULL, 'payment_proofs/EcL2G7tiILt7dwumzTO90eoDeGkbHg0hE8p1D7ST.png', 'approved', '2026-02-15 16:10:03', 5, '2026-02-15 09:03:10', '2026-02-15 16:10:03'),
(273, 13, 'CASH-20260215161056-13', 'February', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-02-15 16:15:54', 5, '2026-02-15 16:10:56', '2026-02-15 16:15:54'),
(274, 7, 'CASH-20260215161117-7', 'February', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-02-15 16:14:40', 5, '2026-02-15 16:11:17', '2026-02-15 16:14:40'),
(275, 9, 'CASH-20260215161151-9', 'February', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-02-15 16:13:38', 5, '2026-02-15 16:11:51', '2026-02-15 16:13:38'),
(276, 21, 'CASH-20260215161229-21', 'February', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-02-15 16:13:09', 5, '2026-02-15 16:12:29', '2026-02-15 16:13:09'),
(277, 12, NULL, 'February', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-02-15 16:18:49', 5, '2026-02-15 16:18:27', '2026-02-15 16:18:49'),
(278, 15, 'CASH-20260219053931-15', 'February', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-02-19 05:39:44', 5, '2026-02-19 05:39:31', '2026-02-19 05:39:44'),
(279, 6, 'Eyhgff5', 'February', 2026, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2026-02-19 06:09:06', 5, '2026-02-19 06:08:56', '2026-02-19 06:09:06'),
(280, 10, 'CASH-20260222130203-10', 'February', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-02-22 13:02:15', 5, '2026-02-22 13:02:03', '2026-02-22 13:02:15'),
(281, 8, 'CASH-20260223162421-8', 'February', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-02-23 16:24:34', 5, '2026-02-23 16:24:21', '2026-02-23 16:24:34'),
(282, 5, 'CASH-20260301131957-5', 'March', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-03-01 13:20:13', 5, '2026-03-01 13:19:57', '2026-03-01 13:20:13'),
(283, 8, 'CASH-20260305132830-8', 'March', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-03-05 13:28:45', 5, '2026-03-05 13:28:30', '2026-03-05 13:28:45'),
(284, 12, NULL, 'March', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-03-05 17:11:23', 5, '2026-03-05 17:11:13', '2026-03-05 17:11:23'),
(285, 1, NULL, 'March', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-03-07 11:22:28', 5, '2026-03-07 11:22:20', '2026-03-07 11:22:28'),
(286, 20, NULL, 'March', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-03-08 03:58:48', 5, '2026-03-08 03:58:33', '2026-03-08 03:58:48'),
(287, 13, 'CASH-20260308094852-13', 'March', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-03-08 09:49:40', 5, '2026-03-08 09:48:52', '2026-03-08 09:49:40'),
(288, 6, 'CASH-20260308094913-6', 'March', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-03-08 09:49:31', 5, '2026-03-08 09:49:13', '2026-03-08 09:49:31'),
(289, 15, 'CASH-20260308114538-15', 'March', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-03-08 11:45:48', 5, '2026-03-08 11:45:38', '2026-03-08 11:45:48'),
(290, 7, NULL, 'March', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-03-08 16:14:57', 5, '2026-03-08 16:14:41', '2026-03-08 16:14:57'),
(291, 22, 'CASH-20260310040807-22', 'March', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-03-10 04:10:11', 5, '2026-03-10 04:08:07', '2026-03-10 04:10:11'),
(292, 18, 'CASH-20260310040825-18', 'March', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-03-10 04:10:03', 5, '2026-03-10 04:08:25', '2026-03-10 04:10:03'),
(293, 11, NULL, 'March', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-03-10 04:09:48', 5, '2026-03-10 04:08:44', '2026-03-10 04:09:48'),
(294, 21, NULL, 'March', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-03-10 04:09:17', 5, '2026-03-10 04:08:58', '2026-03-10 04:09:17'),
(295, 9, 'CASH-20260312131609-9', 'March', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-03-12 13:17:00', 5, '2026-03-12 13:16:09', '2026-03-12 13:17:00');
INSERT INTO `payments` (`id`, `user_id`, `transaction_id`, `month`, `year`, `term`, `amount`, `method`, `payment_method_id`, `description`, `admin_note`, `proof_path`, `status`, `processed_at`, `processed_by`, `created_at`, `updated_at`) VALUES
(296, 19, 'CASH-20260312131634-19', 'March', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-03-12 13:16:48', 5, '2026-03-12 13:16:34', '2026-03-12 13:16:48'),
(297, 10, NULL, 'March', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-03-17 06:30:05', 5, '2026-03-17 06:29:54', '2026-03-17 06:30:05'),
(298, 15, 'CASH-20260405142414-15', 'April', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-04-05 14:26:34', 5, '2026-04-05 14:24:14', '2026-04-05 14:26:34'),
(299, 9, 'CASH-20260405142503-9', 'April', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-04-05 14:26:24', 5, '2026-04-05 14:25:03', '2026-04-05 14:26:24'),
(300, 19, 'CASH-20260405142600-19', 'April', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-04-05 14:26:11', 5, '2026-04-05 14:26:00', '2026-04-05 14:26:11'),
(301, 10, NULL, 'April', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-04-07 10:54:29', 5, '2026-04-07 10:54:19', '2026-04-07 10:54:29'),
(302, 1, NULL, 'April', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-04-07 11:02:15', 5, '2026-04-07 11:02:09', '2026-04-07 11:02:15'),
(303, 7, 'CASH-20260408130033-7', 'April', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-04-08 13:00:46', 5, '2026-04-08 13:00:33', '2026-04-08 13:00:46'),
(304, 8, 'CASH-20260408144218-8', 'April', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-04-08 14:42:26', 5, '2026-04-08 14:42:18', '2026-04-08 14:42:26'),
(305, 20, NULL, 'April', 2026, 'monthly', '500.00', 'Nagad', 3, NULL, NULL, NULL, 'approved', '2026-04-09 03:41:45', 5, '2026-04-09 03:41:31', '2026-04-09 03:41:45'),
(306, 13, 'CASH-20260409124711-13', 'April', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-04-09 12:47:20', 5, '2026-04-09 12:47:11', '2026-04-09 12:47:20'),
(307, 12, NULL, 'April', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-04-09 12:48:19', 5, '2026-04-09 12:48:10', '2026-04-09 12:48:19'),
(308, 11, NULL, 'April', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-04-11 12:29:54', 5, '2026-04-11 12:28:47', '2026-04-11 12:29:54'),
(309, 22, NULL, 'April', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-04-11 12:29:49', 5, '2026-04-11 12:29:07', '2026-04-11 12:29:49'),
(310, 18, NULL, 'April', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-04-11 12:29:37', 5, '2026-04-11 12:29:23', '2026-04-11 12:29:37'),
(311, 5, 'CASH-20260411123052-5', 'April', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-04-11 12:31:05', 5, '2026-04-11 12:30:52', '2026-04-11 12:31:05'),
(312, 6, 'CASH-20260419093833-6', 'April', 2026, 'monthly', '500.00', 'Hand Cash', 1, NULL, NULL, NULL, 'approved', '2026-04-19 09:38:59', 5, '2026-04-19 09:38:33', '2026-04-19 09:38:59'),
(313, 21, NULL, 'April', 2026, 'monthly', '500.00', 'bKash', 2, NULL, NULL, NULL, 'approved', '2026-04-19 09:38:56', 5, '2026-04-19 09:38:46', '2026-04-19 09:38:56');

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
('cPz6sFXZwBhdSffGQKAIrGWbs9rsPaChgNGarEHC', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoib1lBZEJFcDFQdXlkZjFDRng4T3AzWDg5UldtNUZsbnlHcWk4Y0FETCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMDoidHlyby1sb2dpbiI7YToxOntzOjc6ImNhcHRjaGEiO2E6MTp7czo1OiJsb2dpbiI7aToyO319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9wcm9qb25tby50ZXN0L2FkbWluL2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czoxNToiYWRtaW4uZGFzaGJvYXJkIjt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1777046403),
('cZUWbpbL3UX8ILrkX1ZjOnPowL3EWxG88vj2oK64', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicmZZQnFHdFd3Sk9OQ3ZUemxwZlBsdHF4ZXVGZVZlUUQ3VXo3RUllYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9wcm9qb25tby50ZXN0L21hbmlmZXN0Lmpzb24iO3M6NToicm91dGUiO3M6MTI6InB3YS5tYW5pZmVzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1777045972),
('k9BWiTXdEjQhzmHRRcZbZnaMmVF0zlb4evhw7hsr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlh3VUNzajVhaTFyd2Z2dVBEcGIzbEJHakM4RkJ3TDlDajJVa2pkZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9wcm9qb25tby50ZXN0L21hbmlmZXN0Lmpzb24iO3M6NToicm91dGUiO3M6MTI6InB3YS5tYW5pZmVzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1777046305),
('lC4yeCZ0zvBxRQ9K2VIifLjThjyJG9UaS9qIxX5A', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieFpNWkRHY1ZZaVhjRWZIZVpHWDR6M3FhRVp2Mk1Mc05ONmg1c2lLTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9wcm9qb25tby50ZXN0L21hbmlmZXN0Lmpzb24iO3M6NToicm91dGUiO3M6MTI6InB3YS5tYW5pZmVzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1777045106),
('NWfGM2WeQLuNMFktxRKoUNsNVSHdwHNh8VgZhDBf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2E5M0pZMUVtZ1UwZVIwMGI0bERDVzRBV256dlp6UjVYN0ZYNjdDWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9wcm9qb25tby50ZXN0L21hbmlmZXN0Lmpzb24iO3M6NToicm91dGUiO3M6MTI6InB3YS5tYW5pZmVzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1777045663),
('Zon0ZFWIaLTKDpX2ahzW2ZvAX1H0hDIj0xt7nHsi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoialAzZEpnS0o0MUpZREdoTHpVeDNGdTd1RVFrRlpUZ0NkeFN5WFhpRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9wcm9qb25tby50ZXN0L21hbmlmZXN0Lmpzb24iO3M6NToicm91dGUiO3M6MTI6InB3YS5tYW5pZmVzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1777046401);

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
('bank_account_holder', 'Projonmo unnayan mission', '2025-12-17 17:22:05', '2025-12-17 17:22:05'),
('bank_account_number', '48030311138918', '2025-12-17 17:22:05', '2025-12-20 12:10:03'),
('bank_branch', 'Kishoreganj', '2025-12-17 17:22:05', '2025-12-17 17:22:05'),
('bank_name', 'Bangladesh Krishi Bank', '2025-12-17 17:22:05', '2025-12-20 12:10:03'),
('currency', 'BDT', '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
('currency_symbol', '৳', '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
('monthly_fee', '500', '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
('organization_address', 'ঢাকা, বাংলাদেশ', '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
('organization_email', '', '2026-04-24 09:52:47', '2026-04-24 09:52:47'),
('organization_established_month', '1', '2025-12-04 05:20:53', '2026-04-24 09:52:47'),
('organization_established_year', '2021', '2025-12-04 03:57:48', '2026-04-24 09:52:47'),
('organization_logo', 'logos/GFcJCp6LROx1uC4t0iCoJc3ck9JTffmGFz0O9b6n.png', '2025-12-03 00:19:57', '2025-12-04 00:16:37'),
('organization_name', 'কিশোরগঞ্জ ইঞ্জিনিয়ার্স এসোসিয়েশন', '2025-12-03 00:19:57', '2026-04-24 09:52:47'),
('organization_name_en', 'Kishoreganj Engineers Association', '2025-12-03 00:19:57', '2026-04-24 09:52:47'),
('organization_phone', '01700000000', '2025-12-03 00:19:57', '2025-12-03 00:19:57'),
('organization_start_month', '2024-11', '2025-12-03 00:19:57', '2025-12-03 00:50:23'),
('payment_term', 'monthly', '2026-04-23 05:02:28', '2026-04-23 05:02:28'),
('registration_terms', '<h3 class=\"text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100\">১. সাধারণ শর্তাবলী</h3>\n<p class=\"text-gray-700 dark:text-gray-300 mb-4\">\n    {org_name}-এ সদস্য হিসেবে নিবন্ধন করার মাধ্যমে আপনি নিম্নলিখিত শর্তাবলী মেনে নিতে সম্মত হচ্ছেন।\n    এই শর্তাবলী সংগঠনের নিয়ম-কানুন এবং আপনার দায়িত্ব ও অধিকার নির্ধারণ করে।\n</p>\n\n<h3 class=\"text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100\">২. সদস্যপদের যোগ্যতা</h3>\n<ul class=\"list-disc list-inside text-gray-700 dark:text-gray-300 mb-4 space-y-2\">\n    <li>আবেদনকারীকে অবশ্যই বাংলাদেশী নাগরিক হতে হবে</li>\n    <li>ন্যূনতম বয়স ১৮ বছর হতে হবে</li>\n    <li>সকল তথ্য সঠিক এবং সত্য হতে হবে</li>\n    <li>সংগঠনের উদ্দেশ্য ও লক্ষ্যের সাথে একমত হতে হবে</li>\n</ul>\n\n<h3 class=\"text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100\">৩. সদস্যের দায়িত্ব</h3>\n<ul class=\"list-disc list-inside text-gray-700 dark:text-gray-300 mb-4 space-y-2\">\n    <li>সংগঠনের নিয়ম-কানুন মেনে চলা</li>\n    <li>সংগঠনের কার্যক্রমে সক্রিয় অংশগ্রহণ করা</li>\n    <li>সংগঠনের সুনাম রক্ষা করা</li>\n    <li>নির্ধারিত সদস্য ফি যথাসময়ে পরিশোধ করা</li>\n    <li>প্রদত্ত তথ্য হালনাগাদ রাখা</li>\n</ul>\n\n<h3 class=\"text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100\">৪. গোপনীয়তা নীতি</h3>\n<p class=\"text-gray-700 dark:text-gray-300 mb-4\">\n    আপনার ব্যক্তিগত তথ্য সম্পূর্ণ গোপনীয় রাখা হবে এবং শুধুমাত্র সংগঠনের অভ্যন্তরীণ কাজে ব্যবহার করা হবে।\n    আপনার অনুমতি ছাড়া কোনো তথ্য তৃতীয় পক্ষের সাথে শেয়ার করা হবে না।\n</p>\n\n<h3 class=\"text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100\">৫. সদস্যপদ বাতিল</h3>\n<p class=\"text-gray-700 dark:text-gray-300 mb-4\">\n    সংগঠনের নিয়ম লঙ্ঘন, মিথ্যা তথ্য প্রদান, বা সংগঠনের সুনাম ক্ষুণ্ণ করার মতো কাজের জন্য\n    প্রশাসন যে কোনো সময় সদস্যপদ বাতিল করার অধিকার সংরক্ষণ করে।\n</p>\n\n<h3 class=\"text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100\">৬. অনুমোদন প্রক্রিয়া</h3>\n<p class=\"text-gray-700 dark:text-gray-300 mb-4\">\n    নিবন্ধন আবেদন জমা দেওয়ার পর প্রশাসন আপনার তথ্য যাচাই করবে। অনুমোদন পেতে ৭-১৫ কার্যদিবস সময় লাগতে পারে।\n    অনুমোদনের পর আপনি ইমেইল/ফোনে বিজ্ঞপ্তি পাবেন।\n</p>', '2026-04-22 23:22:10', '2026-04-22 23:22:10'),
('registration_terms_acceptance_label', 'আমি উপরের সকল শর্তাবলী পড়েছি এবং সম্মত হয়েছি। আমি নিশ্চিত করছি যে আমার প্রদত্ত সকল তথ্য সঠিক এবং সত্য।', '2026-04-22 23:22:10', '2026-04-22 23:22:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `membership_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_token` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `monthly_fee` decimal(10,2) DEFAULT NULL COMMENT 'Per-member monthly fee override. NULL means use settings default.',
  `payment_term` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Per-member payment-term override: monthly|yearly. NULL = use settings default.',
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

INSERT INTO `users` (`id`, `membership_id`, `verification_token`, `name`, `email`, `phone`, `address`, `email_verified_at`, `password`, `father_name`, `dob`, `permanent_address`, `present_address`, `blood_group`, `profession`, `religion`, `nationality`, `position`, `monthly_fee`, `payment_term`, `profile_pic`, `status`, `joined_at`, `remember_token`, `created_at`, `updated_at`, `suspended_at`, `suspension_reason`) VALUES
(1, 'PUM-25-0001', '795823365d198e35e7852695e1d7e0ab', 'আরমান আজিজ', 'armanazij@gmail.com', '01916628339', NULL, NULL, '$2y$12$DVdEeDMUozij9AtohyI0SuvdaQ/A.NI2rsnSp02VgyfvWs9LCjeVa', 'উসমান গনি', '1996-05-15', 'কাটাবাড়িয়া, কিশোরগঞ্জ সদর, কিশোরগঞ্জ । ', 'কাটাবাড়িয়া, কিশোরগঞ্জ সদর, কিশোরগঞ্জ । ', 'B-', 'Engineer', 'ইসলাম', 'বাংলাদেশি', 'সদস্য', NULL, NULL, 'photos/LGsALuLg3uTqbSnA4aMjLKP7vAXBu1ZeH5eju1a6.png', 'active', '2025-12-01 09:44:02', '6a7QvLVX4NIFNjoPJ0bUfvdg7yZVmmZlOogTkkilHQAk1JSuwXDqO7ClgEs8', '2025-12-02 05:00:05', '2026-04-23 05:48:43', NULL, NULL),
(5, 'PUM-25-0002', 'cb8828a0a28e46e9bb223bfaaa078724', 'তুহিন', 'tuhinrana199@gmail.com', '01948391907', NULL, NULL, '$2y$12$2RxaCDjR.0da/NVOM.5xRes5pyjwfNT0oKtkPUMmUBJvQcVvYX1M.', 'মোঃ বারিক', '1997-04-22', 'কাটাবাড়িয়া, কিশোরগঞ্জ সদর , কিশোরগঞ্জ ', 'কাটাবাড়িয়া, কিশোরগঞ্জ সদর , কিশোরগঞ্জ ', 'A+', 'চাকরি ', 'Islam', 'Bangladeshi', 'ক্যাশিয়ার ', NULL, NULL, 'profile-pics/7h2jQ2XjtMJ37Xnwqv02Tga7js7x0Oo35KcRlm8L.jpg', 'active', '2025-12-13 17:40:07', NULL, '2025-12-13 17:40:07', '2026-04-22 23:20:59', NULL, NULL),
(6, 'PUM-25-0003', '7a923c4f2600b55f2868f241725bee90', 'ঋতু  আহসান', 'ritu.khan.12090@gmail.com', '01951203800', NULL, NULL, '$2y$12$p5ySlflDsG2ZlZufbTPVDeCSLVjMqvYkdbg21pP/UteyRHNdWNriy', 'আব্দুল খালেক ', '1995-01-01', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'B+', 'ব্যবসায়িক ', 'Islam', 'Bangladeshi', 'সদস্য ', NULL, NULL, 'profile-pics/l4zXOnUCYGXXz8HCQgwCfrtC7WY61vQpWTGDFRJZ.jpg', 'active', '2025-12-14 01:32:14', 'tFhAoqYmtMi1TRLIJZfnVoRqJFdXXA39dPhTxiCjtDyf0ih90TtaeE1Q490I', '2025-12-14 01:32:14', '2026-04-22 23:20:59', NULL, NULL),
(7, 'PUM-25-0004', 'a5656c4e8025c15211e5d7085b9d4451', 'মোঃ এমদাদুল হক ', 'Amdadulhaque@gmail.com', '01911552865', NULL, NULL, '$2y$12$wXhh3FdB/B0Ip.vznkeLbOFt0G6I6b1SEGEN1nG3wWW5kzdoYnMz6', 'মোঃ দুলাল মিয়া ', '1997-11-11', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'O+', 'ব্যবসায়িক ', 'Islam', 'Bangladeshi', 'কাউন্টার মাস্টার ', NULL, NULL, 'profile-pics/AUlqZw3dVhgnQNyQfh0iCpgdlKz3JpE21zEta7fc.jpg', 'active', '2025-12-14 01:37:15', 'jYRt9rEMH91fCV3aPBCP7ducP8GMyLcIinbNGah6clQhzWXwGCQtmo5qFzdm', '2025-12-14 01:37:15', '2026-04-22 23:20:59', NULL, NULL),
(8, 'PUM-25-0005', 'eb728941c4aba6932af607fd5a2d48b0', 'মোঃআনারুল ইসলাম ', 'anarulislam@gmil.com', '01771292101', NULL, NULL, '$2y$12$dT2lEciUIf9DkVaua466ZuwWJP2sf8rVARV3dz4LRv3mRiw6oNXAa', 'আব্দুস সাত্তার ', '1995-01-01', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'O+', 'ব্যবসায়িক ', 'Islam', 'Bangladeshi', 'উদ্যোক্তা ', NULL, NULL, 'profile-pics/uEHOavHcvJj72xs7m7DGnwqejeitFi00TyvL8JEZ.jpg', 'active', '2025-12-14 01:41:56', 'VLWGpq7npQOHlzfyqBj8BXQ8KcuYFI1p3v7kkgac63YTQHDsIZ9W1x736WAR', '2025-12-14 01:41:56', '2026-04-22 23:20:59', NULL, NULL),
(9, 'PUM-25-0006', '0814ba1e12013e65283823ba2f94998e', 'মোঃ হুমায়ুন কবির', 'humaunkabir@gmail.com', '01790767880', NULL, NULL, '$2y$12$7pLvY8Veu6RYXxsV8geIJOWMGgJzbAv2Y9xPGDugiRi12YkxLEKYK', 'মোঃ সাইদুর রহমান ', '1998-06-01', 'লতিভাবাদ কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'লতিভাবাদ কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'AB+', 'পরিবহন সেক্টর ', 'Islam', 'Bangladeshi', 'ইন্সট্রাক্টর ', NULL, NULL, 'profile-pics/5fiINt7zKWQBXKwwRZPja01vovXf48eBvzteUwiB.jpg', 'active', '2025-12-14 01:48:11', NULL, '2025-12-14 01:48:11', '2026-04-22 23:20:59', NULL, NULL),
(10, 'PUM-25-0007', '8d885e932b5184a5789f3e37d13b05b3', 'আবু দারদা বাপ্পী', 'bappy@gmail.com', '01919676099', NULL, NULL, '$2y$12$ZSecrHd20rc7yEVJ1.Dfa.4ZdNjKRTSNEdsNff2qtt8Sj30lgrcW6', 'শফিকুল ইসলাম ', '1994-10-19', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'B+', 'ব্যবসায়িক ', 'Islam', 'Bangladeshi', 'উদ্যোক্তা ', NULL, NULL, 'profile-pics/mWBjBlOCq44r1O5TT1DGZlqjgJGINJ8CIpG2WreE.jpg', 'active', '2025-12-14 01:53:53', 'DFhOh1t7RxLjBrCPLDvPRoj3L5ZH8TKR2lWiaV5KRILqZWBD55tGDJRqymsc', '2025-12-14 01:53:53', '2026-04-22 23:20:59', NULL, NULL),
(11, 'PUM-25-0008', 'e4c091b2851a1611f5ce59d10eae26ef', 'মনিরু জ্জামান', 'monirozzaman@gmil.com', '01912630313', NULL, NULL, '$2y$12$ahTdk3doBaJEiey8.NJqOuzNSrBqYj8rqE4jiHaMd1nUz0ORg2Z5C', 'মোঃ আলা উদ্দিন ', '1996-06-02', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'B-', 'ব্যবসায়ী ', 'Islam', 'Bangladeshi', 'উদ্যোক্ত ', NULL, NULL, 'profile-pics/1b4XaXhyhriZBsflWGClFphIhmyQu7t5et4W53KF.jpg', 'active', '2025-12-14 10:11:07', 'tE3Vp7JSaE2K2v6VElXQ3cVylRxYvmM69Xq1NrVXNFR9doR1FnddrVhkbnPR', '2025-12-14 10:11:07', '2026-04-22 23:20:59', NULL, NULL),
(12, 'PUM-25-0009', '236c3b3aa92a4c37c3f4c740a156bfbb', 'মোঃ দ্বীন ইসলাম ', 'dinislam@gmail.com', '01918287492', NULL, NULL, '$2y$12$2n/tBrRyWJhKeFjFw89lnewd0ifUBaNfsHXIweLsR9EgmYbDTx.l2', 'মোঃ হোসেন', '1993-04-02', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'O+', 'ব্যবসায়িক ', 'Islam', 'Bangladeshi', ' উদ্যোক্তা ', NULL, NULL, 'profile-pics/p0aZ4jbLifbSVjYdWPQ9yXUmIwozkR0LqGoD9sfb.jpg', 'active', '2025-12-14 10:15:36', 'OZNByrPgHKMpVdvgXP9FoYZmFZHEMwEwPqQPrwz9LFGGpwCaG99IedR5rjnE', '2025-12-14 10:15:36', '2026-04-22 23:20:59', NULL, NULL),
(13, 'PUM-25-00010', 'e498fc7062d2ab486de2ea06f127bcf6', 'মোঃ আব্দুল আহাদ ', 'abdulahad@gmail.com', '01932007959', NULL, NULL, '$2y$12$H4/wwv4qV7fJbfgFwTUjn.VatdXpr5.VKm6a7Z5f5IePxmaQUbTdG', 'চাঁদ মিয়া', '1996-12-12', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'B+', 'ব্যবসায়িক ', 'Islam', 'Bangladeshi', 'উদ্যোক্তা ', NULL, NULL, 'profile-pics/EdRt1ulzHohjDfEEo1dMMPrNJJwYb6bNAGxhid5g.jpg', 'active', '2025-12-14 10:19:21', NULL, '2025-12-14 10:19:21', '2026-04-22 23:20:59', NULL, NULL),
(15, 'PUM-25-0011', '972d2698a98778513ddab05b05848eb1', 'মোঃ আল- আমীন', 'smalamin0391@gmail.com', '01626025212', NULL, NULL, '$2y$12$lBPKFN/OXcEEoXRmOrRxe.P4Vo/hJUAwEgkq961H0N2izzl8/9cOq', 'মোঃ আব্দুর রাজ্জাক', '1998-02-19', 'ডাউকিয়া,কিশোরগঞ্জ সদর, কিশোরগঞ্জ', 'ডাউকিয়া,কিশোরগঞ্জ সদর, কিশোরগঞ্জ', 'B+', 'ব্যবসা', 'Islam', 'Bangladeshi', NULL, NULL, NULL, 'profile-pics/514SBk2iXRIMjtp05fKpqbihUSKLy20IHocVUTA0.jpg', 'active', '2025-12-15 07:03:44', NULL, '2025-12-15 07:03:44', '2026-04-22 23:20:59', NULL, NULL),
(18, 'PUM-25-0012', '33dc46bd590cf9bbed624d1cac3a98c4', 'Uzzal Khan', 'ujjol@gmail.com', '966596941188', NULL, NULL, '$2y$12$cF0Bc52pnAwZrsPldzfk5elGVx2oB/xX460zbLgoVs8rSDuNA/w6W', 'দুলাল মিয়া', '1997-08-03', 'কাটাবাড়ীয়া কিশোরগঞ্জ সদর, কিশোরগঞ্জ।', 'রিয়াদ, সৌদি আরব ', 'B+', 'প্রবাসী', 'Islam', 'Bangladeshi', 'সদস্য', '1000.00', NULL, 'profile-pics/5hwjWdJ6Z14VClDxXRQJJ4q7Mxr1demHDwvgxJmb.png', 'active', '2025-12-20 04:05:13', NULL, '2025-12-20 04:05:13', '2026-04-23 03:27:27', NULL, NULL),
(19, 'PUM-25-0013', '83150f494401b28748676db8a7e2503f', 'মোঃ আসাদুর জামান', 'asadurzaman@gmail.com', '01618131140', NULL, NULL, '$2y$12$0./KvQv4PKKv5XSQcboAEONiretR02xwFCcZ.fqFHNfittu.KOq0m', 'মোঃ লুৎপুর রহমান ', '1997-10-01', 'ডাউকিয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'ডাউকিয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'A-', 'স্বাস্থ্য রিলেটিভ ', 'Islam', 'Bangladeshi', 'সদস্য ', NULL, NULL, 'profile-pics/37Fz2LQ9jA3mxN1EOiKQqRnMLjfi4Z5RPE5nTYaX.jpg', 'active', '2025-12-20 10:34:19', NULL, '2025-12-20 10:34:19', '2026-04-22 23:20:59', NULL, NULL),
(20, 'PUM-25-0014', '8cccb20cb9f55dd21a163665370532bf', 'নূর মোহাম্মদ ', 'nurmuhammad@gmail.com', '01919606662', NULL, NULL, '$2y$12$ObB7KjzENbSYJFLJ2zGxuuE4I1qtI9xIApV2rAlQIx1TU3Q4YLJga', 'কলিম উদ্দীন', '1996-11-16', 'মুকসুদপুর কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'মুকসুদপুর কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'B+', 'চাকরি ', 'Islam', 'Bangladeshi', 'সদস্য ', NULL, NULL, 'profile-pics/oVWGVERfcmVijGkRDXnRpgrTZuojU1DdcsnI9Hht.jpg', 'active', '2025-12-20 10:38:18', NULL, '2025-12-20 10:38:18', '2026-04-22 23:20:59', NULL, NULL),
(21, 'PUM-25-0015', 'b40e3e8b641747258d6af75e9ae614fb', 'মোঃ আশরাফুল ইসলাম হাসান ', 'hasan@gmail.com', '01742149125', NULL, NULL, '$2y$12$ObB7KjzENbSYJFLJ2zGxuuE4I1qtI9xIApV2rAlQIx1TU3Q4YLJga', 'মোঃ আব্দুর রাজ্জাক ', '1998-01-01', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'কাটাবাড়িয়া কিশোরগঞ্জ সদর কিশোরগঞ্জ ', 'B+', 'চাকরি ', 'Islam', 'Bangladeshi', 'সদস্য ', NULL, NULL, 'profile-pics/f0kSk2rMkBOqLjeZwWgwfy6plWtg0UPOdNZhuLHO.jpg', 'active', '2025-12-20 10:42:36', '5XLV7XiW0TqCnY1qkEQT2a1RmFdEGsdqyBQF0tsrGPRsaUynBnpfmzXhiksw', '2025-12-20 10:42:36', '2026-04-22 23:20:59', NULL, NULL),
(22, 'PUM-26-0016', '4afcac976f6b244a06ad518d4d6102fc', 'Uzzal 2', 'uzzol2@gmail.com', '01715364758', NULL, NULL, '$2y$12$xRaiPHNwbUKiqIqDKN4ceOpOPAgCogS8O7PO5ryY./.mTfTuD6MMq', 'Md Dolal', '1997-01-08', 'কাটাবাড়িয়া, কিশোরগঞ্জ', 'কাটাবাড়িয়া, কিশোরগঞ্জ', 'B+', 'প্রবাসী ', 'Islam', 'Bangladeshi', 'সদস্য', NULL, NULL, NULL, 'active', '2026-01-06 18:09:13', NULL, '2026-01-06 18:09:13', '2026-04-22 23:20:59', NULL, NULL),
(23, NULL, NULL, 'Brady Bartlett', '01313780278@placeholder.com', '01313780278', NULL, NULL, '$2y$12$jdpptlHJ4lKgGTrj4m5scO9CSQFdI3Jrax5c5GyYfcIQDlQ4W0LiO', 'Allegra Pruitt', '2019-04-04', 'Molestiae ullam null', 'Modi adipisci anim c', 'AB-', 'Repellendus Nulla o', 'হিন্দু', 'Quaerat non autem es', NULL, NULL, NULL, NULL, 'pending', NULL, NULL, '2026-04-24 09:42:39', '2026-04-24 09:42:39', NULL, NULL);

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
(2, 1, 7, NULL, NULL),
(5, 1, 9, '2025-12-04 05:47:05', '2025-12-04 05:47:05'),
(6, 5, 9, '2025-12-13 17:40:07', '2025-12-13 17:40:07'),
(7, 6, 9, '2025-12-14 01:32:14', '2025-12-14 01:32:14'),
(8, 7, 9, '2025-12-14 01:37:15', '2025-12-14 01:37:15'),
(9, 8, 9, '2025-12-14 01:41:56', '2025-12-14 01:41:56'),
(10, 9, 9, '2025-12-14 01:48:11', '2025-12-14 01:48:11'),
(11, 10, 9, '2025-12-14 01:53:53', '2025-12-14 01:53:53'),
(12, 11, 9, '2025-12-14 10:11:07', '2025-12-14 10:11:07'),
(13, 12, 9, '2025-12-14 10:15:36', '2025-12-14 10:15:36'),
(14, 13, 9, '2025-12-14 10:19:21', '2025-12-14 10:19:21'),
(16, 15, 9, '2025-12-15 07:03:44', '2025-12-15 07:03:44'),
(19, 18, 9, '2025-12-20 04:05:13', '2025-12-20 04:05:13'),
(20, 19, 9, '2025-12-20 10:34:19', '2025-12-20 10:34:19'),
(21, 20, 9, '2025-12-20 10:38:18', '2025-12-20 10:38:18'),
(22, 21, 9, '2025-12-20 10:42:36', '2025-12-20 10:42:36'),
(23, 5, 7, '2025-12-20 12:04:25', '2025-12-20 12:04:25'),
(24, 15, 7, '2025-12-26 10:37:54', '2025-12-26 10:37:54'),
(25, 22, 9, '2026-01-06 18:09:13', '2026-01-06 18:09:13'),
(26, 23, 9, '2026-04-24 09:42:39', '2026-04-24 09:42:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_deposits`
--
ALTER TABLE `bank_deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_deposits_deposited_by_foreign` (`deposited_by`),
  ADD KEY `bank_deposits_year_month_index` (`year`,`month`),
  ADD KEY `bank_deposits_transaction_type_index` (`transaction_type`),
  ADD KEY `bank_deposits_created_at_index` (`created_at`);

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
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_created_at_index` (`created_at`),
  ADD KEY `documents_uploaded_by_index` (`uploaded_by`);

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
  ADD KEY `payments_transaction_id_index` (`transaction_id`),
  ADD KEY `payments_term_index` (`term`);

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
  ADD UNIQUE KEY `users_membership_id_unique` (`membership_id`),
  ADD UNIQUE KEY `users_verification_token_unique` (`verification_token`);

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
-- AUTO_INCREMENT for table `bank_deposits`
--
ALTER TABLE `bank_deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=314;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_monthly_dues`
--
ALTER TABLE `user_monthly_dues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_deposits`
--
ALTER TABLE `bank_deposits`
  ADD CONSTRAINT `bank_deposits_deposited_by_foreign` FOREIGN KEY (`deposited_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
