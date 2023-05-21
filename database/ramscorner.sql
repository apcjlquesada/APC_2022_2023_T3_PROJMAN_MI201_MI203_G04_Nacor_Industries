-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 08:39 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ramscorner`
--

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
-- Table structure for table `k_b_s`
--

CREATE TABLE `k_b_s` (
  `kb_ID` bigint(20) UNSIGNED NOT NULL,
  `kb_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kb_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kb_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `kb_resolution` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `kb_view` tinyint(1) NOT NULL DEFAULT 0,
  `kb_approved` tinyint(1) NOT NULL DEFAULT 0,
  `kb_modify` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `dateModified` timestamp NOT NULL DEFAULT current_timestamp(),
  `kb_watch` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `k_b_s`
--

INSERT INTO `k_b_s` (`kb_ID`, `kb_title`, `kb_category`, `kb_content`, `kb_resolution`, `kb_view`, `kb_approved`, `kb_modify`, `dateModified`, `kb_watch`) VALUES
(1, 'Computer Doesn\'t Start', 'Infrastructure', 'When a computer does not start, it typically means that the system is unable to boot up and display the operating system. This can be caused by a variety of hardware or software issues, such as improper wiring, power supply failure, a faulty RAM module, a corrupted operating system, or a malfunctioning motherboard. Troubleshooting steps may involve checking the power supply and cables, running diagnostic tests, resetting the BIOS, or attempting to repair the operating system. In some cases, professional assistance may be necessary to identify and fix the underlying problem.', 'Listed below are the possible self-troubleshooting methods that you can do alone:\r\n1. Check PC for power  \r\n2. Charge laptop for 1 hour (for Mobile Devices)\r\n3. Check if monitor cables are properly plugged in\r\n4. Force shutdown your device\r\n5. Unplug external devices\r\n***\r\nIf none of the above solutions work, then consider sending us a detailed ticket at ITRO!', 1, 1, 'Jose Castillo', '2023-03-21 05:19:37', 5),
(2, 'Fixing blue screen', 'Software', 'Blue screen error', '1. Restart your computer\r\n2. Scan for viruses\r\n3. Check device drivers\r\n4. Check storage space\r\n5. Perform diagnostic test', 1, 0, 'Jose Castillo', '2023-03-22 23:39:32', 0);

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
(1, '2014_10_12_000000_create_reporters_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_01_060720_create_tickets_table', 1),
(6, '2023_02_01_064019_create_status_histories_table', 1),
(7, '2023_02_01_064349_create_k_b_s_table', 1),
(8, '2023_03_16_211202_create_notifications_table', 1),
(9, '2023_03_17_094040_create_ticket_messages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `nID` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `n_message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`nID`, `user_id`, `n_message`, `ticket_id`, `read_at`, `created_at`, `updated_at`) VALUES
(7, 1, 'A new ticket is awaiting for your response!', 5, '2023-03-21 02:52:56', '2023-03-21 02:51:24', '2023-03-21 02:52:56'),
(8, 2, 'A new ticket is awaiting for your response!', 5, '2023-03-21 02:52:39', '2023-03-21 02:51:24', '2023-03-21 02:52:39'),
(9, 1, 'A ticket has been assigned to you. Check it out!', 5, '2023-03-21 02:53:20', '2023-03-21 02:53:08', '2023-03-21 02:53:20'),
(10, 2, 'Your ticket has been updated!', 5, '2023-03-21 03:09:24', '2023-03-21 02:53:08', '2023-03-21 03:09:24'),
(11, 1, 'A new ticket is awaiting for your response!', 6, '2023-03-21 06:31:48', '2023-03-21 05:51:19', '2023-03-21 06:31:48'),
(12, 2, 'A new ticket is awaiting for your response!', 6, '2023-03-21 06:34:21', '2023-03-21 05:51:19', '2023-03-21 06:34:21'),
(13, 2, 'A ticket has been assigned to you. Check it out!', 6, '2023-03-21 06:32:54', '2023-03-21 06:31:56', '2023-03-21 06:32:54'),
(14, 3, 'Your ticket has been updated!', 6, '2023-03-21 06:32:13', '2023-03-21 06:31:56', '2023-03-21 06:32:13'),
(15, 3, 'Your ticket has been updated!', 6, '2023-03-21 07:06:54', '2023-03-21 06:34:09', '2023-03-21 07:06:54'),
(16, 3, 'Your ticket has been updated!', 6, '2023-03-21 07:06:47', '2023-03-21 06:36:01', '2023-03-21 07:06:47'),
(17, 3, 'Your ticket has been updated!', 6, '2023-03-21 06:58:29', '2023-03-21 06:44:34', '2023-03-21 06:58:29'),
(18, 1, 'A new reopened ticket is awaiting for your response!', 8, '2023-03-21 06:59:23', '2023-03-21 06:58:51', '2023-03-21 06:59:23'),
(19, 2, 'A new reopened ticket is awaiting for your response!', 8, '2023-03-21 07:09:27', '2023-03-21 06:58:51', '2023-03-21 07:09:27'),
(20, 1, 'A new ticket is awaiting for your response!', 9, '2023-03-21 07:18:47', '2023-03-21 07:17:55', '2023-03-21 07:18:47'),
(21, 2, 'A new ticket is awaiting for your response!', 9, '2023-03-21 07:20:00', '2023-03-21 07:17:55', '2023-03-21 07:20:00'),
(22, 1, 'A ticket has been assigned to you. Check it out!', 9, '2023-03-21 07:19:36', '2023-03-21 07:19:23', '2023-03-21 07:19:36'),
(23, 2, 'Your ticket has been updated!', 9, '2023-03-21 07:20:08', '2023-03-21 07:19:23', '2023-03-21 07:20:08'),
(24, 1, 'A new ticket is awaiting for your response!', 10, '2023-03-21 07:59:04', '2023-03-21 07:57:58', '2023-03-21 07:59:04'),
(25, 2, 'A new ticket is awaiting for your response!', 10, '2023-03-22 23:30:15', '2023-03-21 07:57:58', '2023-03-22 23:30:15'),
(26, 2, 'A ticket has been assigned to you. Check it out!', 10, '2023-03-21 08:15:53', '2023-03-21 07:59:48', '2023-03-21 08:15:53'),
(27, 6, 'Your ticket has been updated!', 10, '2023-03-21 08:02:09', '2023-03-21 07:59:48', '2023-03-21 08:02:09'),
(28, 6, 'Your ticket has been updated!', 10, NULL, '2023-03-21 08:14:58', '2023-03-21 08:14:58'),
(29, 6, 'Your ticket has been updated!', 10, NULL, '2023-03-21 08:16:16', '2023-03-21 08:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `u_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Reporter', 3, 'API TOKEN', '7ba5074ca1f97df3c8ca0cd2a4b5c035e26d7d6baa49da101764c4ef06154f0f', '[\"*\"]', NULL, NULL, '2023-03-20 19:49:46', '2023-03-20 19:49:46'),
(2, 'App\\Models\\Reporter', 1, 'API TOKEN', 'd1d9519e74fb1b420ee16f5a4ee147b983f7d324a1ca7100e57267afa167bb9b', '[\"*\"]', NULL, NULL, '2023-03-20 19:51:10', '2023-03-20 19:51:10'),
(3, 'App\\Models\\Reporter', 2, 'API TOKEN', '7aa7dda2f697bea7d681190708c0a16bb25ebd95b59cbb00bf6877e6bd326c71', '[\"*\"]', NULL, NULL, '2023-03-20 20:42:31', '2023-03-20 20:42:31'),
(4, 'App\\Models\\Reporter', 2, 'API TOKEN', '885cd6105d43b5255a802dc9a73699e02662fb31570039198e489c1b90b7497d', '[\"*\"]', NULL, NULL, '2023-03-20 20:47:49', '2023-03-20 20:47:49'),
(5, 'App\\Models\\Reporter', 3, 'API TOKEN', '7d12b48c5e3a357f3985b2a0643ca613c71d9d993f50bd300463fe749564d8b7', '[\"*\"]', NULL, NULL, '2023-03-20 20:52:31', '2023-03-20 20:52:31'),
(6, 'App\\Models\\Reporter', 1, 'API TOKEN', '8fbef8e3db6d09906ece21a6da93aea3b5c6a2520f818c01beb9e061e6bf65f6', '[\"*\"]', NULL, NULL, '2023-03-21 02:15:54', '2023-03-21 02:15:54'),
(7, 'App\\Models\\Reporter', 3, 'API TOKEN', '0748805618ae3190bbdb89bec43ee97a47fefa7ff75c44b5a40cdf622f68215a', '[\"*\"]', NULL, NULL, '2023-03-21 02:18:23', '2023-03-21 02:18:23'),
(8, 'App\\Models\\Reporter', 2, 'API TOKEN', '2d14e8a018f122c0066407f41109827792df29226c90e9a32b546e6d90684a52', '[\"*\"]', NULL, NULL, '2023-03-21 02:39:58', '2023-03-21 02:39:58'),
(9, 'App\\Models\\Reporter', 1, 'API TOKEN', '8cc9afbdde59bc6d2bce55ba39fef202e58bededd49d2c19bd2bf226cdb8be5e', '[\"*\"]', NULL, NULL, '2023-03-21 02:44:37', '2023-03-21 02:44:37'),
(10, 'App\\Models\\Reporter', 1, 'API TOKEN', 'b404702a16c8043893e10005f567b63b9be1b2a2491ffba5f87e131bbca6bae2', '[\"*\"]', NULL, NULL, '2023-03-21 05:02:22', '2023-03-21 05:02:22'),
(11, 'App\\Models\\Reporter', 3, 'API TOKEN', '6303b6d2c5f517e0aa60f231a295d8aa8cda86a7e1771ac845cd91c6d040f8a6', '[\"*\"]', NULL, NULL, '2023-03-21 05:49:58', '2023-03-21 05:49:58'),
(12, 'App\\Models\\Reporter', 3, 'API TOKEN', '1d20f9321a5cb004ae9a9371807ddfa58a93bee182f76a590901b63be11731a5', '[\"*\"]', NULL, NULL, '2023-03-21 06:31:30', '2023-03-21 06:31:30'),
(13, 'App\\Models\\Reporter', 2, 'API TOKEN', '6382a72be9656d54afe276644f5f8aecff42fddfe61a45541a940cf19a6190e9', '[\"*\"]', NULL, NULL, '2023-03-21 06:32:45', '2023-03-21 06:32:45'),
(14, 'App\\Models\\Reporter', 3, 'API TOKEN', '68854a19aa78f09d60d0df114ffaef0291aab4138efe39359c05a12396129348', '[\"*\"]', NULL, NULL, '2023-03-21 06:58:25', '2023-03-21 06:58:25'),
(15, 'App\\Models\\Reporter', 1, 'API TOKEN', '4b7ec7edabc0b72d990f7652ce2e302826d27714ca887423e7f83cdad65986e9', '[\"*\"]', NULL, NULL, '2023-03-21 06:59:18', '2023-03-21 06:59:18'),
(16, 'App\\Models\\Reporter', 2, 'API TOKEN', '6583155a88130702e7c6d5e9932bf4456bd7b750f8eb597ad1c7d6010b076981', '[\"*\"]', NULL, NULL, '2023-03-21 07:09:21', '2023-03-21 07:09:21'),
(17, 'App\\Models\\Reporter', 6, 'API TOKEN', 'f637f2476395bcc4a2ee518533a98fe89764ab5cea1d4c054e8e59c6750b5342', '[\"*\"]', NULL, NULL, '2023-03-21 07:24:05', '2023-03-21 07:24:05'),
(18, 'App\\Models\\Reporter', 1, 'API TOKEN', 'c919255bdb65bf6deeb5e23a5b75b59999a6f1d6fc8f9f5555a8defb9c94247a', '[\"*\"]', NULL, NULL, '2023-03-21 07:53:04', '2023-03-21 07:53:04'),
(19, 'App\\Models\\Reporter', 6, 'API TOKEN', '3441b4a2a284478fae62267a439ffa5774a3c63b27952c853304864cc6ff72b9', '[\"*\"]', NULL, NULL, '2023-03-21 07:55:06', '2023-03-21 07:55:06'),
(20, 'App\\Models\\Reporter', 2, 'API TOKEN', 'b5f04ab9a2d43ca785e0ce0c5d79fcd2a79597e496043b972846de9d49bbd9b9', '[\"*\"]', NULL, NULL, '2023-03-21 08:15:48', '2023-03-21 08:15:48'),
(21, 'App\\Models\\Reporter', 1, 'API TOKEN', 'ae273f71b44da2e9bd21738c78e7f6182f9feadaae245a73259d8108831d3a8c', '[\"*\"]', NULL, NULL, '2023-03-21 08:18:11', '2023-03-21 08:18:11'),
(22, 'App\\Models\\Reporter', 3, 'API TOKEN', '62460cb260c4a5b5900d5cc5bf106e4759a0e2e936ef176b6b51a192a049bd14', '[\"*\"]', NULL, NULL, '2023-03-22 23:24:30', '2023-03-22 23:24:30'),
(23, 'App\\Models\\Reporter', 2, 'API TOKEN', '059d93d5381ad0560e6bd5e05032adbb17398ed2b281b54431dec147837e3ed6', '[\"*\"]', NULL, NULL, '2023-03-22 23:28:49', '2023-03-22 23:28:49'),
(24, 'App\\Models\\Reporter', 1, 'API TOKEN', '491670abc53a8032e9810aab81b16288b41c8c194c722f275598348255df657b', '[\"*\"]', NULL, NULL, '2023-03-22 23:34:59', '2023-03-22 23:34:59'),
(25, 'App\\Models\\Reporter', 3, 'API TOKEN', '2e7d8af97e073c464b37cbf16988bcb3b6ee6a2a5576958f028410f5e9ac2f77', '[\"*\"]', NULL, NULL, '2023-03-22 23:48:54', '2023-03-22 23:48:54'),
(26, 'App\\Models\\Reporter', 2, 'API TOKEN', '045ec5922da119c6850375b7860344a963ad13065486911fde89ffa23938c79c', '[\"*\"]', NULL, NULL, '2023-03-22 23:49:38', '2023-03-22 23:49:38'),
(27, 'App\\Models\\Reporter', 1, 'API TOKEN', '1d03343f79bd9c942787ea20501ef91c6f653c2834803f8f6b50a0317157c930', '[\"*\"]', NULL, NULL, '2023-05-02 16:58:25', '2023-05-02 16:58:25'),
(28, 'App\\Models\\Reporter', 2, 'API TOKEN', 'e43b99f83f40f35430a887eee183475b26b113823aa6b6604803a39e3c5965dd', '[\"*\"]', NULL, NULL, '2023-05-02 16:58:46', '2023-05-02 16:58:46');

-- --------------------------------------------------------

--
-- Table structure for table `reporters`
--

CREATE TABLE `reporters` (
  `u_ID` bigint(20) UNSIGNED NOT NULL,
  `u_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `u_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `u_division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `u_divRole` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reporters`
--

INSERT INTO `reporters` (`u_ID`, `u_name`, `email`, `email_verified_at`, `u_role`, `password`, `u_profile`, `u_division`, `u_divRole`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jose Castillo', 'itro3498@outlook.com', NULL, 'Admin', '$2y$10$n.I/JeQrlUJwV3YZ5rx.quV15il2YMB28iV1jq2qbY3WwQMhfZA.q', 'default.png', 'ITRO', 'ITRO Head', NULL, NULL, NULL),
(2, 'Val Rodelas', 'itrostaff3498@outlook.com', NULL, 'Staff', '$2y$10$ik6iTS0NVIlLFh.c5nl/Z.IsSdPRyS0yYtLeDuyn0Imw5uomTOKQa', 'default.png', 'Infrastructure', 'Server and Cloud Services', NULL, NULL, NULL),
(3, 'Vincent Nacor', 'vanacor@student.apc.edu.ph', NULL, 'Client', '$2y$10$ordjrjEfM7gTDDhmxqEGUObAN76dMeHZJh6pgH2p29gFIbzAUzy6W', 'default.png', NULL, NULL, NULL, NULL, NULL),
(4, 'Allan Vincent Nefalar', 'aonefalar2@student.apc.edu.ph', NULL, 'Client', '$2y$10$NSkm.5w/OWpJ60Ylw8Wme.UgNwXEN7J/NmMg63GCaYppucEMc9S06', 'default.png', NULL, NULL, NULL, '2023-03-21 04:15:55', NULL),
(5, 'Kieyl Ponce', 'kdponce@student.apc.edu.ph', NULL, 'Client', '$2y$10$V8JGFBphA.IvqIlTYrPt/eUaOiWl715S6LmVU9Ej1qLR72UHk/2lu', 'default.png', NULL, NULL, NULL, '2023-03-21 04:15:55', NULL),
(6, 'Manuel Calimlim Jr.', 'manuelc@apc.edu.ph', NULL, 'Client', '$2y$10$dhl48LN4X0coAF.3rhSn6OXcfjh5tGR3g5be4mvKJEkzGsacycVWK', 'default.png', NULL, NULL, NULL, '2023-03-21 04:15:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status_histories`
--

CREATE TABLE `status_histories` (
  `sh_ID` bigint(20) UNSIGNED NOT NULL,
  `t_ID` bigint(20) UNSIGNED NOT NULL,
  `sh_Status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NEW',
  `sh_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `sh_AssignedTo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sh_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sh_doneBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_histories`
--

INSERT INTO `status_histories` (`sh_ID`, `t_ID`, `sh_Status`, `sh_datetime`, `sh_AssignedTo`, `sh_message`, `sh_doneBy`) VALUES
(7, 5, 'NEW', '2023-03-20 16:00:00', NULL, NULL, NULL),
(8, 5, 'OPENED', '2023-03-20 16:00:00', 'Jose Castillo', NULL, 'Jose Castillo'),
(9, 6, 'NEW', '2023-03-20 16:00:00', NULL, NULL, NULL),
(10, 6, 'OPENED', '2023-03-20 16:00:00', 'Val Rodelas', NULL, 'Jose Castillo'),
(11, 6, 'RESOLVED', '2023-03-20 16:00:00', 'Val Rodelas', 'Please reply in the email notification if your ticket has already been resolved. Otherwise, after 48 hours and we did not receive your reply, we will automatically close the ticket. Thank you.', 'Val Rodelas'),
(12, 6, 'CLOSED', '2023-03-20 16:00:00', 'Val Rodelas', NULL, 'Val Rodelas'),
(13, 7, 'REOPENED', '2023-03-20 16:00:00', NULL, NULL, NULL),
(14, 6, 'REOPENED', '2023-03-20 16:00:00', NULL, 'This ticket is Reopened by the Client', NULL),
(15, 6, 'CLOSED', '2023-03-20 16:00:00', 'Val Rodelas', NULL, 'Val Rodelas'),
(16, 8, 'REOPENED', '2023-03-21 06:58:51', NULL, NULL, NULL),
(17, 6, 'REOPENED', '2023-03-21 06:58:51', NULL, 'This ticket is Reopened by the Client', NULL),
(18, 8, 'ESCALATED', '2023-03-21 07:09:35', 'Jose Castillo', NULL, 'Val Rodelas'),
(19, 9, 'NEW', '2023-03-21 07:17:55', NULL, NULL, NULL),
(20, 9, 'OPENED', '2023-03-21 07:19:23', 'Jose Castillo', NULL, 'Jose Castillo'),
(21, 10, 'NEW', '2023-03-21 07:57:58', NULL, NULL, NULL),
(22, 10, 'OPENED', '2023-03-21 07:59:48', 'Val Rodelas', 'The ticket is under investigation, We\'ll notify you once we have the resolution.', 'Jose Castillo'),
(23, 10, 'RESOLVED', '2023-03-21 08:14:58', 'Val Rodelas', NULL, 'Jose Castillo'),
(24, 10, 'RESOLVED', '2023-03-21 08:16:16', 'Val Rodelas', NULL, 'Val Rodelas');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `t_ID` bigint(20) UNSIGNED NOT NULL,
  `u_ID` bigint(20) UNSIGNED NOT NULL,
  `t_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NEW',
  `t_impact` int(11) NOT NULL DEFAULT 3,
  `t_urgency` int(11) NOT NULL DEFAULT 3,
  `t_priority` int(11) NOT NULL DEFAULT 3,
  `t_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `t_due` timestamp NULL DEFAULT NULL,
  `t_assignedTo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Assigned',
  `t_cc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_resolution` longtext COLLATE utf8mb4_unicode_ci DEFAULT 'Not Yet Resolved',
  `t_views` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`t_ID`, `u_ID`, `t_status`, `t_impact`, `t_urgency`, `t_priority`, `t_category`, `t_datetime`, `t_due`, `t_assignedTo`, `t_cc`, `t_title`, `t_image`, `t_description`, `t_resolution`, `t_views`) VALUES
(5, 2, 'OPENED', 2, 2, 3, 'SOFTWARE', '2023-03-21 05:00:00', '2023-03-23 16:00:00', 'Jose Castillo', NULL, 'Data Analysis for Enrollment', '', 'Data Analysis for enrollment in 3rd term', 'Not Yet Resolved', 12),
(6, 3, 'REOPENED', 3, 3, 3, 'INFRASTRUCTURE', '2023-03-21 07:00:00', '2023-03-27 16:00:00', 'Val Rodelas', NULL, 'Broken Monitor', '', 'Broken Monitor in room 314', 'Not Yet Resolved', 19),
(7, 2, 'NEW', 3, 3, 3, 'INFRASTRUCTURE', '2023-03-20 16:00:00', NULL, 'Not Assigned', NULL, 'Broken Monitor', '', 'The monitor was bvroken again after being resolved', 'Not Yet Resolved', 1),
(8, 3, 'ESCALATED', 1, 1, 0, 'INFRASTRUCTURE', '2023-03-21 06:58:51', '2023-03-21 09:09:35', 'Jose Castillo', NULL, 'Broken Monitor', '', 'Broken Monitor again in 314', 'Not Yet Resolved', 11),
(9, 2, 'OPENED', 3, 3, 3, 'INFRASTRUCTURE', '2023-03-21 07:17:55', '2023-03-28 07:17:55', 'Jose Castillo', 'Jose Castillo', 'Malfunctioning mouse in library', 'Vtix_file.2023-03-2117.jpg', 'Malfunctioning mouse in library. Need new bunch of new mouse', 'Not Yet Resolved', 6),
(10, 6, 'RESOLVED', 3, 3, 3, 'INFRASTRUCTURE', '2023-03-21 07:57:58', '2023-03-28 07:57:58', 'Val Rodelas', 'Jose Castillo', 'Projector not connecting to HDMI', 'Mtix_file.2023-03-2157.jpg', 'Projector not connecting to HDMI in room 314', 'Not Yet Resolved', 7);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_messages`
--

CREATE TABLE `ticket_messages` (
  `mID` bigint(20) UNSIGNED NOT NULL,
  `us_id` bigint(20) UNSIGNED NOT NULL,
  `tix_id` bigint(20) UNSIGNED NOT NULL,
  `m_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `k_b_s`
--
ALTER TABLE `k_b_s`
  ADD PRIMARY KEY (`kb_ID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`nID`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_ticket_id_foreign` (`ticket_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`u_email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reporters`
--
ALTER TABLE `reporters`
  ADD PRIMARY KEY (`u_ID`),
  ADD UNIQUE KEY `reporters_email_unique` (`email`);

--
-- Indexes for table `status_histories`
--
ALTER TABLE `status_histories`
  ADD PRIMARY KEY (`sh_ID`),
  ADD KEY `status_histories_t_id_foreign` (`t_ID`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`t_ID`),
  ADD KEY `tickets_u_id_foreign` (`u_ID`);

--
-- Indexes for table `ticket_messages`
--
ALTER TABLE `ticket_messages`
  ADD PRIMARY KEY (`mID`),
  ADD KEY `ticket_messages_us_id_foreign` (`us_id`),
  ADD KEY `ticket_messages_tix_id_foreign` (`tix_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `k_b_s`
--
ALTER TABLE `k_b_s`
  MODIFY `kb_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `nID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `reporters`
--
ALTER TABLE `reporters`
  MODIFY `u_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `status_histories`
--
ALTER TABLE `status_histories`
  MODIFY `sh_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `t_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ticket_messages`
--
ALTER TABLE `ticket_messages`
  MODIFY `mID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`t_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `reporters` (`u_ID`) ON DELETE CASCADE;

--
-- Constraints for table `status_histories`
--
ALTER TABLE `status_histories`
  ADD CONSTRAINT `status_histories_t_id_foreign` FOREIGN KEY (`t_ID`) REFERENCES `tickets` (`t_ID`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_u_id_foreign` FOREIGN KEY (`u_ID`) REFERENCES `reporters` (`u_ID`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_messages`
--
ALTER TABLE `ticket_messages`
  ADD CONSTRAINT `ticket_messages_tix_id_foreign` FOREIGN KEY (`tix_id`) REFERENCES `tickets` (`t_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_messages_us_id_foreign` FOREIGN KEY (`us_id`) REFERENCES `reporters` (`u_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
