-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2025 at 02:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `concerts`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidings`
--

CREATE TABLE `bidings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ticket_qty` int(11) DEFAULT NULL,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bid_amt` decimal(19,2) DEFAULT NULL,
  `max_bid_amt` decimal(19,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `bid_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `bid_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bidings`
--

INSERT INTO `bidings` (`id`, `customer_id`, `ticket_id`, `ticket_qty`, `event_id`, `bid_amt`, `max_bid_amt`, `status`, `bid_time`, `bid_number`, `created_at`, `updated_at`) VALUES
(5, 1, 1, 1, 1, 3000.00, NULL, 'lost', '2025-02-23 13:50:02', NULL, '2025-02-23 13:50:02', '2025-04-01 10:37:38'),
(6, 2, 8, 1, 7, 3000.00, NULL, 'won', '2025-02-24 03:18:41', NULL, '2025-02-24 03:18:41', '2025-02-24 03:18:41'),
(7, 2, 8, 3, 7, 15000.00, NULL, 'processing', '2025-02-24 03:19:01', NULL, '2025-02-24 03:19:01', '2025-02-24 03:19:01'),
(8, 2, 4, 1, 1, 7000.00, NULL, 'own', '2025-02-24 04:07:48', NULL, '2025-02-24 04:07:48', '2025-02-24 06:28:14'),
(9, 2, 2, 1, 5, 1000.00, NULL, 'processing', '2025-02-24 04:09:18', NULL, '2025-02-24 04:09:18', '2025-02-24 04:09:18'),
(10, 2, 1, 1, 1, 2500.00, NULL, 'own', '2025-02-24 05:54:19', NULL, '2025-02-24 05:54:19', '2025-04-01 10:37:38'),
(11, 2, 5, 2, 6, 3500.00, NULL, 'processing', '2025-02-24 05:54:40', NULL, '2025-02-24 05:54:40', '2025-02-24 05:54:40'),
(12, 2, 5, 4, 6, 4000.00, NULL, 'processing', '2025-02-24 06:20:49', NULL, '2025-02-24 06:20:49', '2025-02-24 06:20:49'),
(13, 2, 5, 1, 6, 5000.00, NULL, 'processing', '2025-02-24 06:23:40', NULL, '2025-02-24 06:23:40', '2025-02-24 06:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `min_amt` decimal(19,2) DEFAULT NULL,
  `max_amt` decimal(19,2) DEFAULT NULL,
  `charges` decimal(19,2) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `count` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id`, `min_amt`, `max_amt`, `charges`, `note`, `category`, `count`, `status`, `created_at`, `updated_at`) VALUES
(1, 0.00, 500.00, 30.00, NULL, NULL, NULL, 'active', '2025-02-20 05:13:24', '2025-02-20 05:13:24'),
(2, 501.00, 1000.00, 52.00, NULL, NULL, NULL, 'active', '2025-02-20 05:16:21', '2025-02-20 05:16:21'),
(3, 1001.00, 2000.00, 103.00, NULL, NULL, NULL, 'active', '2025-02-20 05:17:02', '2025-02-20 05:17:02'),
(5, 2001.00, 4000.00, 202.00, NULL, NULL, NULL, 'active', '2025-02-20 05:25:32', '2025-02-20 05:25:32'),
(6, 4001.00, 6000.00, 301.00, NULL, NULL, NULL, 'active', '2025-02-20 05:26:07', '2025-02-20 05:26:07'),
(8, 6001.00, 8000.00, 405.00, NULL, NULL, NULL, 'active', '2025-02-20 05:27:21', '2025-02-20 05:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `artist_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_time` varchar(255) DEFAULT NULL,
  `event_location` varchar(255) DEFAULT NULL,
  `stadium_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event_stadium` varchar(255) DEFAULT NULL,
  `event_photo` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `feature_status` varchar(255) DEFAULT NULL,
  `demo` varchar(255) DEFAULT NULL,
  `crowd_status` varchar(255) DEFAULT NULL,
  `addition` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `view_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`view_ids`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `artist_name`, `description`, `event_date`, `event_time`, `event_location`, `stadium_id`, `event_stadium`, `event_photo`, `status`, `feature_status`, `demo`, `crowd_status`, `addition`, `created_at`, `updated_at`, `category`, `view_ids`) VALUES
(1, 'Arijit Singh Show', 'Arijit Singh', 'Arijit Singh (born April 25, 1987) is one of the most successful singers and composers of India. Singh has set a record of six “Best Male Playback Singer Filmfare awards.” As of 2020, Arijit is the most streamed artist for Spotify India. Arijit started his career on a reality show named “Fame Gurukul.” In spite of not winning nor getting proper exposure, he got acknowledged by Mithoon. With Mithoon’s help, he would get into the mainstream through his first single, “Phir Mohabbat.” As he was finding his footing in the mainstream as a playback singer, he was offered the soundtrack on the movie Aashiqui 2. Singles from the movie which includes “Tum Hi Ho” and “Chahun Main Ya Naa” helped him gain the exposure and recognization that he always deserved.', '2025-01-28', '20:45', 'Mumbai', 1, 'D Y Patil', 'queues_event954918044.webp', 'active', NULL, NULL, NULL, 'On', '2025-01-25 06:09:46', '2025-04-01 10:38:24', 'Rock Music', NULL),
(3, 'Martin Garrix Music Show', 'Martin Garrix', 'Martin Garrix Music Show Martin Garrix Music Show Martin Garrix Music Show Martin Garrix Music Show Martin Garrix Music Show Martin Garrix Music Show', '2025-02-04', '19:15', 'Mumbai', 1, 'D Y Patil', 'queues_event439957754.webp', 'active', NULL, NULL, NULL, NULL, '2025-01-25 06:15:09', '2025-01-25 06:15:09', 'Rock Music', NULL),
(5, 'Diljit Dosanjh', 'Diljit Dosanjh', 'Diljit Dosanjh is an Indian singer-songwriter, actor, film producer and television presenter who works in Punjabi and Hindi cinema. He made his Bollywood debut in 2016 with the crime thriller Udta Punjab for which he earned the Filmfare Award for Best Male Debut, in addition for a nomination for the Filmfare Award for Best Supporting Actor. However, this was followed by films that failed to propel his career forward in the Hindi film industry. This changed with his supporting role in the 2019 comedy Good Newwz, for which he received his second nomination for the Filmfare Award for Best Supporting Actor. As of 2020, he has won the most five PTC Award for Best Actor. He has also appeared as a judge in three seasons of the reality show Rising Star. In 2020, Dosanjh entered Social 50 chart by Billboard, following the release of his eleventh album G.O.A.T. Also, the album entered top 20 in Canadian Albums Chart (2021). His twelfth album MoonChild Era entered in Billboard Canadian Top Albums Chart.', '2025-03-27', '19:00', 'Mumbai', 1, 'D Y Patil', 'queues_event1031063397.webp', 'active', NULL, NULL, NULL, NULL, '2025-01-25 10:46:06', '2025-01-25 10:46:06', 'Pop', NULL),
(6, 'Samay Raina Comedy Show', 'Samay Raina', 'Samay Raina Comedy Show Samay Raina Comedy Show Samay Raina Comedy Show Samay Raina Comedy Show Samay Raina Comedy Show', '2025-02-03', '19:20', 'Gujarat', 2, 'Narendra Modi Stadium', 'queues_event846913119.jpg', 'active', NULL, NULL, NULL, NULL, '2025-01-27 05:40:18', '2025-01-27 05:40:18', 'Comedy', NULL),
(7, 'Sonu Nigam Music Show', 'Sonu Nigam', 'Sonu Nigam Music Show Sonu Nigam Music Show Sonu Nigam Music Show Sonu Nigam Music Show Sonu Nigam Music Show Sonu Nigam Music Show Sonu Nigam Music Show Sonu Nigam Music Show', '2025-03-19', '19:00', 'Gujarat', 2, 'Narendra Modi Stadium', 'queues_event1631950697.webp', 'active', NULL, NULL, NULL, 'On', '2025-01-29 06:10:55', '2025-04-01 10:39:25', 'Pop', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_01_15_074300_create_stadia_table', 1),
(6, '2025_01_15_073856_create_events_table', 2),
(7, '2025_01_16_114657_create_seats_table', 3),
(9, '2025_01_20_132741_create_tickets_table', 4),
(10, '2025_01_28_111822_add_category_column_to_events_table', 5),
(11, '2025_01_30_100740_create_paymentsinfos_table', 6),
(13, '2025_02_20_100145_create_charges_table', 8),
(14, '2025_01_30_115309_create_bidings_table', 9),
(16, '2025_03_29_102535_add_reason_column_to_tickets_table', 10),
(17, '2025_04_03_130341_create_orders_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bid_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ticket_price` decimal(19,2) DEFAULT NULL,
  `no_of_tickets` int(11) DEFAULT NULL,
  `total_price` decimal(19,2) DEFAULT NULL,
  `gst` decimal(10,2) DEFAULT NULL,
  `discount` decimal(19,2) DEFAULT NULL,
  `mode` varchar(255) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `customer_id`, `ticket_id`, `bid_id`, `ticket_price`, `no_of_tickets`, `total_price`, `gst`, `discount`, `mode`, `payment_id`, `status`, `note`, `created_at`, `updated_at`) VALUES
(1, 'order_QEdGwU6hhTMO2V', 2, 8, NULL, 2402.00, 1, 2402.00, NULL, NULL, 'online', NULL, 'pending', NULL, '2025-04-03 09:51:57', '2025-04-03 09:51:57'),
(2, 'order_QEdGwwode3uzuX', 2, 8, NULL, 2402.00, 1, 2402.00, NULL, NULL, 'online', NULL, 'pending', NULL, '2025-04-03 09:51:57', '2025-04-03 09:51:57'),
(3, 'order_QEdJExIX3eZxB4', 2, 8, NULL, 2402.00, 3, 2402.00, NULL, NULL, 'online', NULL, 'pending', NULL, '2025-04-03 09:54:07', '2025-04-03 09:54:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentsinfos`
--

CREATE TABLE `paymentsinfos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `banck_name` varchar(255) DEFAULT NULL,
  `ac_holder_name` varchar(255) DEFAULT NULL,
  `acc_number` varchar(255) DEFAULT NULL,
  `bank_branch` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `post_code` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paymentsinfos`
--

INSERT INTO `paymentsinfos` (`id`, `customer_id`, `banck_name`, `ac_holder_name`, `acc_number`, `bank_branch`, `ifsc_code`, `address`, `city`, `state`, `post_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Kotak Bank', 'Vinayak Sawant', '98765432123', 'Tilakawadi', 'AXIN5000645', 'Khanapur Road, Tilakwadi, Belgaum, Karnataka', 'Belgaum', 'Karnataka', '590001', 'active', NULL, '2025-04-02 06:19:09'),
(2, 6, 'State Bank Of India', 'Hrushikesh Patil', '98765432123', 'Belgaum', 'ABIN5480014', '3rd Cross Tilakawadi, 9 No. Building, Belagum', 'Belgaum', 'Karnataka', '590008', NULL, '2025-04-02 07:30:36', '2025-04-02 07:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stadium_id` bigint(20) UNSIGNED NOT NULL,
  `seat_level` varchar(255) DEFAULT NULL,
  `row` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `seat_type` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `stadium_id`, `seat_level`, `row`, `number`, `seat_type`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Level BC', 'ABCC', 831, 'VIP', NULL, '2025-01-26 06:38:50', '2025-01-26 06:38:50'),
(2, 1, 'Block A', 'awb', NULL, '4A', NULL, '2025-01-27 05:24:37', '2025-01-27 05:24:37'),
(4, 2, 'Block A', 'awb', NULL, 'VIP', NULL, '2025-01-27 05:25:10', '2025-01-27 05:25:10'),
(5, 2, 'Block M - Lower', 'acctw', NULL, 'Normal', NULL, '2025-01-27 05:25:31', '2025-01-27 05:25:31');

-- --------------------------------------------------------

--
-- Table structure for table `stadia`
--

CREATE TABLE `stadia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stadium_name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `image4` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stadia`
--

INSERT INTO `stadia` (`id`, `stadium_name`, `location`, `image1`, `image2`, `image3`, `image4`, `status`, `created_at`, `updated_at`) VALUES
(1, 'D Y Patil', 'Mumbai', 'queues_1038798788.jpg', 'queues_263903817.jpeg', NULL, NULL, NULL, '2025-01-25 03:23:58', '2025-01-25 03:23:58'),
(2, 'Narendra Modi Stadium', 'Gujarat', 'queues_497272135.jpg', NULL, NULL, NULL, NULL, '2025-01-27 05:16:11', '2025-01-27 05:16:11');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_name` varchar(255) DEFAULT NULL,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `seat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `number_of_tickets` int(11) DEFAULT NULL,
  `seat_numbers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`seat_numbers`)),
  `min_price` decimal(19,2) DEFAULT NULL,
  `max_price` decimal(19,2) DEFAULT NULL,
  `total_min_price` decimal(19,2) DEFAULT NULL,
  `total_max_price` decimal(19,2) DEFAULT NULL,
  `sell_type` varchar(255) DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `comments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`comments`)),
  `restrictions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`restrictions`)),
  `limitations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`limitations`)),
  `owner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchaser_id` bigint(20) UNSIGNED DEFAULT NULL,
  `biding_status` varchar(255) DEFAULT NULL,
  `min_bid_price` decimal(19,2) DEFAULT NULL,
  `max_bid_price` decimal(19,2) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `download_status` varchar(255) DEFAULT NULL,
  `ticket_image1` varchar(255) DEFAULT NULL,
  `ticket_image2` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `about_you` varchar(255) DEFAULT NULL,
  `listing_type` varchar(255) DEFAULT NULL,
  `delivery_type` varchar(255) DEFAULT NULL,
  `about_ticket` text DEFAULT NULL,
  `t_and_c_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `ticket_name`, `event_id`, `seat_id`, `number_of_tickets`, `seat_numbers`, `min_price`, `max_price`, `total_min_price`, `total_max_price`, `sell_type`, `features`, `comments`, `restrictions`, `limitations`, `owner_id`, `purchaser_id`, `biding_status`, `min_bid_price`, `max_bid_price`, `payment_status`, `download_status`, `ticket_image1`, `ticket_image2`, `status`, `rating`, `about_you`, `listing_type`, `delivery_type`, `about_ticket`, `t_and_c_status`, `created_at`, `updated_at`, `reason`) VALUES
(1, NULL, 1, 1, 1, NULL, 1234.00, 1337.00, NULL, NULL, 'Indivisual', '[\"Access to VIP Lounge\",\"Aisle Seat\",\"Ticket & Meal Package\"]', NULL, NULL, '[\"Side Or Rear View\"]', 2, NULL, 'On', NULL, NULL, NULL, NULL, 'queues_208571883.pdf', NULL, 'Verified', NULL, 'Neither of Two', 'Paper Tickets', 'I am ready to ship', 'Hello', NULL, '2025-01-26 13:06:58', '2025-01-31 05:05:18', NULL),
(2, NULL, 5, 1, 3, NULL, 1550.00, 1653.00, 4650.00, NULL, 'Together', '[\"Access to VIP Lounge\",\"Include Parking\",\"Include VIP Pass\"]', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'queues_1494203545.pdf', NULL, 'Verified', NULL, 'Neither of Two', 'Paper Tickets', 'I am ready to ship', 'Hi', NULL, '2025-01-26 13:19:09', '2025-01-27 01:05:42', NULL),
(4, NULL, 1, 2, 1, NULL, 4355.00, 4357.00, NULL, NULL, 'Indivisual', '[\"Aisle Seat\",\"Include Parking\",\"Include VIP Pass\"]', NULL, NULL, '[\"Obstructed view of the stage\",\"Alcohol Free Zone\"]', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'queues_765647544.pdf', NULL, 'Verified', NULL, 'Employed with Queues', 'E-Tickets', 'I am ready to ship', 'Hello', NULL, '2025-01-27 05:30:02', '2025-04-11 01:18:16', NULL),
(5, NULL, 6, 4, 2, NULL, 2500.00, 2702.00, 5000.00, NULL, 'Together', '[\"Access to VIP Lounge\",\"Aisle Seat\",\"Include VIP Pass\"]', NULL, NULL, '[\"Obstructed view of the stage\",\"Alcohol Free Zone\"]', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'queues_1214430072.pdf', NULL, 'Verified', NULL, 'Event Organiser', 'E-Tickets', 'I am ready to ship', 'Hello', NULL, '2025-01-27 05:45:38', '2025-01-27 05:46:29', NULL),
(7, NULL, 5, 2, 1, NULL, 1200.00, 1303.00, NULL, NULL, 'Indivisual', '[\"Access to VIP Lounge\",\"Aisle Seat\"]', NULL, NULL, '[\"Alcohol Free Zone\",\"Limited Legroom\"]', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'queues_1516972969.pdf', NULL, 'Verified', NULL, 'Event Organiser', 'Paper Tickets', 'I am ready to ship', 'hello hello hello by by', NULL, '2025-02-22 11:16:31', '2025-04-11 01:18:27', NULL),
(8, NULL, 7, 5, 3, NULL, 2200.00, 2402.00, 6600.00, 7206.00, 'Together', '[\"Access to VIP Lounge\",\"Include VIP Pass\",\"Ticket & Meal Package\"]', NULL, NULL, '[\"Alcohol Free Zone\",\"Limited Legroom\"]', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'queues_989927645.pdf', NULL, 'Unverified', NULL, 'Employed with Queues', 'E-Tickets', 'I am ready to ship', 'Hello World!', NULL, '2025-02-22 11:19:49', '2025-02-22 11:19:49', NULL),
(9, NULL, 1, 2, 2, NULL, 2000.00, 2103.00, 4000.00, 4206.00, 'Together', '[\"Access to VIP Lounge\",\"Include Parking\"]', NULL, NULL, '[\"Alcohol Free Zone\",\"Limited Legroom\"]', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'queues_1549593478.jpeg', NULL, 'Unverified', NULL, 'Neither of Two', 'E-Tickets', 'I am ready to ship', 'Hey!!', NULL, '2025-03-29 05:05:14', '2025-03-29 05:05:14', 'Out of Town'),
(11, NULL, 6, 4, 2, NULL, 1000.00, 1052.00, 2000.00, 2104.00, 'Individual', '[\"Include Parking\",\"Include VIP Pass\"]', NULL, NULL, '[\"Alcohol Free Zone\",\"Limited Legroom\"]', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'queues_1234918533.pdf', NULL, 'Unverified', NULL, 'Event Organiser', 'Paper Tickets', 'I am ready to ship', 'Hello Testing', NULL, '2025-04-07 05:12:08', '2025-04-07 05:12:08', 'Out of Town'),
(12, NULL, 6, 4, 1, NULL, 2050.00, 2252.00, NULL, 2252.00, 'Together', '[\"Include Parking\",\"Include VIP Pass\"]', NULL, NULL, '[\"Obstructed view of the stage\",\"Alcohol Free Zone\"]', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'queues_908523273.jpg', NULL, 'Unverified', NULL, 'Neither of Two', 'E-Tickets', 'I am ready to ship', 'Hey Testing', NULL, '2025-04-07 05:13:19', '2025-04-07 05:13:19', 'Other'),
(13, NULL, 6, 4, 3, '[\"123456675\",\"23456754\",\"34556755\"]', 3580.00, 3782.00, 10740.00, 11346.00, 'Individual', '[\"Aisle Seat\",\"Include Parking\"]', NULL, NULL, '[\"Limited Legroom\",\"Side Or Rear View\"]', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'queues_1189773525.png', NULL, 'Unverified', NULL, 'Event Organiser', 'E-Tickets', 'I am ready to ship', 'Hey! test......', NULL, '2025-04-11 00:34:33', '2025-04-11 00:34:33', 'Medical Emergency'),
(15, NULL, 7, 4, 2, '[\"23456754\",\"23456345\"]', 3000.00, 3202.00, 6000.00, 6404.00, 'Individual', '[\"Include Parking\",\"Include VIP Pass\"]', NULL, NULL, '[\"Obstructed view of the stage\",\"Side Or Rear View\"]', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'queues_454995003.jpg', NULL, 'Unverified', NULL, 'Event Organiser', 'E-Tickets', 'I am ready to ship', 'Hello', NULL, '2025-04-11 01:52:39', '2025-04-11 01:52:39', 'Out of Town');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `admin_role` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `last_login` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `phone`, `role`, `admin_role`, `status`, `profile`, `last_login`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hrushi Patil', 'developer@mail.com', NULL, '8310903228', 'admin', 'super', 'active', NULL, NULL, '$2y$12$ep48yf26kbBSpPtvWv8wuOPUVZ9P2QCVMm5c4xSR1QPt1pR9pEKFC', NULL, '2025-01-25 03:14:27', '2025-02-14 06:44:53'),
(2, 'Vinayak Sawant', 'vinayak@gmail.com', NULL, '8884224112', 'customer', NULL, 'active', NULL, NULL, '$2y$12$82gu4qPJpj0/6pFsteHkJuz7sspG1kms7ohwfj3RryeaMswDgbuZa', NULL, '2025-01-25 03:16:32', '2025-02-13 06:11:19'),
(3, 'John Deo', 'john@gmail.com', NULL, '8310906668', 'customer', NULL, 'inactive', NULL, NULL, '$2y$12$s/FkYuCsjV14otAL8zgKUOQNtXmOgaGLiJMfrUkWkbG0qTUeum8jK', NULL, '2025-02-13 06:12:00', '2025-02-13 06:12:00'),
(4, 'Sarvesh Kakkeri', 'kakkeri32@gmail.com', NULL, '7673635362', 'customer', NULL, 'inactive', NULL, NULL, '$2y$12$5am0mC1tVDJ7G5ox3uEETeY8unZ7.LMcCWDH.nRRYpTDCJ5iAmfVa', NULL, '2025-02-13 06:15:44', '2025-02-13 06:22:52'),
(5, 'Kunal Kumar', 'kunal@mail.com', NULL, '8884224112', 'customer', NULL, 'active', NULL, NULL, '$2y$12$bpotChyozXLwV.eeyCHLfO0cZTnspzj1FjoNLafn16VpbL8Y2NRBO', NULL, '2025-03-31 11:59:34', '2025-03-31 11:59:34'),
(6, 'Hrushikesh patil', 'hrushikesh@mail.com', NULL, '8050203388', 'customer', NULL, 'active', NULL, NULL, '$2y$12$jNoR/snrgugbNmvMptHUaul02Swul6EQu1QcJzjqzCNCYKdoS0p5.', NULL, '2025-04-02 06:20:07', '2025-04-02 06:20:07'),
(7, 'Kuldip Patil', 'kuldip@gmail.com', NULL, '8310903228', 'customer', NULL, 'active', NULL, NULL, '$2y$12$eFC20uXqH2LyjoNRbmo5lOxEXuNDTV2i3a9laqbz1rIwxKrsIr0MC', NULL, '2025-04-02 07:42:36', '2025-04-02 07:42:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidings`
--
ALTER TABLE `bidings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bidings_customer_id_foreign` (`customer_id`),
  ADD KEY `bidings_ticket_id_foreign` (`ticket_id`),
  ADD KEY `bidings_event_id_foreign` (`event_id`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_stadium_id_foreign` (`stadium_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_ticket_id_foreign` (`ticket_id`),
  ADD KEY `orders_bid_id_foreign` (`bid_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `paymentsinfos`
--
ALTER TABLE `paymentsinfos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paymentsinfos_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seats_stadium_id_foreign` (`stadium_id`);

--
-- Indexes for table `stadia`
--
ALTER TABLE `stadia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_event_id_foreign` (`event_id`),
  ADD KEY `tickets_seat_id_foreign` (`seat_id`),
  ADD KEY `tickets_owner_id_foreign` (`owner_id`),
  ADD KEY `tickets_purchaser_id_foreign` (`purchaser_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidings`
--
ALTER TABLE `bidings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paymentsinfos`
--
ALTER TABLE `paymentsinfos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stadia`
--
ALTER TABLE `stadia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bidings`
--
ALTER TABLE `bidings`
  ADD CONSTRAINT `bidings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bidings_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bidings_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_stadium_id_foreign` FOREIGN KEY (`stadium_id`) REFERENCES `stadia` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_bid_id_foreign` FOREIGN KEY (`bid_id`) REFERENCES `bidings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paymentsinfos`
--
ALTER TABLE `paymentsinfos`
  ADD CONSTRAINT `paymentsinfos_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_stadium_id_foreign` FOREIGN KEY (`stadium_id`) REFERENCES `stadia` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_purchaser_id_foreign` FOREIGN KEY (`purchaser_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_seat_id_foreign` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
