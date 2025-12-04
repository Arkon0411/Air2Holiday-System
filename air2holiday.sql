-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 05:43 PM
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
-- Database: `air2holiday`
--

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `logo` varchar(255) NOT NULL DEFAULT 'img/loginsplash.jpeg',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`id`, `name`, `code`, `created_at`, `updated_at`, `logo`, `user_id`) VALUES
(1, 'Philippine Airlines', 'PR', '2025-10-16 13:39:53', '2025-11-25 10:11:09', 'img/airline_6925f13d845e34.18366073.png', 25),
(2, 'American Airlines', 'AA', '2025-11-25 10:55:46', '2025-11-25 23:23:44', 'img/airline_6925fbc626a3d0.77097109.png', 27),
(3, 'Japan Airlines', 'JL', '2025-11-25 10:59:45', '2025-11-25 23:28:58', 'img/airline_6925fca1507279.92484027.png', 28),
(4, 'Singapore Airlines', 'SQ', '2025-11-25 11:03:34', '2025-11-25 23:29:05', 'img/airline_6925fd868a2c23.92787704.png', 29),
(5, 'Korean Air', 'KE', '2025-11-25 11:07:55', '2025-11-25 23:29:13', 'img/airline_6925fe8bbf12f1.90177924.png', 30);

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `iata_code` varchar(10) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'img/loginsplash.jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id`, `name`, `iata_code`, `location`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Ninoy Aquino International Airport', 'MNL', 'Manila, Philippines', '2025-10-16 13:39:53', '2025-11-25 23:09:42', 'img/airport_6926a7b6e2d632.85862605.jpg'),
(2, 'Mactan–Cebu International Airport', 'CEB', 'Cebu, Philippines', '2025-10-16 13:39:53', '2025-11-25 22:48:32', 'img/airport_6926a2c03328b5.75647158.jpg'),
(3, 'Francisco Bangoy International Airport', 'DVO', 'Davao, Philippines', '2025-10-16 13:39:53', '2025-11-25 22:48:38', 'img/airport_6926a2c63a4d62.16603476.jpg'),
(4, 'Iloilo International Airport', 'ILO', 'Iloilo, Philippines', '2025-10-16 13:39:53', '2025-11-25 23:10:38', 'img/airport_6926a7ee33bbf6.68806995.jpg'),
(5, 'Laoag International Airport', 'LAO', 'Ilocos Norte, Philippines', '2025-10-16 13:39:53', '2025-11-25 23:13:09', 'img/airport_6926a885dcdff0.01603358.jpg'),
(6, 'Kalibo International Airport', 'KLO', 'Aklan, Philippines', '2025-10-16 13:39:53', '2025-11-25 23:13:25', 'img/airport_6926a89548de92.28478223.jpg'),
(7, 'Bacolod–Silay International Airport', 'BCD', 'Negros Occidental, Philippines', '2025-10-16 13:39:53', '2025-11-25 23:13:33', 'img/airport_6926a89d920f51.15593973.jpg'),
(8, 'Tacloban Airport', 'TAC', 'Leyte, Philippines', '2025-10-16 13:39:53', '2025-11-25 23:14:11', 'img/airport_6926a8c38f4f71.12441364.jpg'),
(9, 'Zamboanga International Airport', 'ZAM', 'Zamboanga City, Philippines', '2025-10-16 13:39:53', '2025-11-25 23:14:23', 'img/airport_6926a8cf65b147.89720635.jpg'),
(10, 'Puerto Princesa International Airport', 'PPS', 'Palawan, Philippines', '2025-10-16 13:39:53', '2025-11-25 23:14:38', 'img/airport_6926a8def13546.19669043.jpg'),
(11, 'Clark International Airport', 'CRK', 'Pampanga, Philippines', '2025-10-16 13:39:53', '2025-11-25 23:14:45', 'img/airport_6926a8e5edecc6.89825373.jpg'),
(12, 'Bohol–Panglao International Airport', 'TAG', 'Bohol, Philippines', '2025-10-16 13:39:53', '2025-11-25 23:14:57', 'img/airport_6926a8f1f16205.76253046.jpg'),
(14, 'Roxas Airport', 'RXS', 'Capiz, Philippines', '2025-10-16 13:39:53', '2025-11-25 23:15:06', 'img/airport_6926a8fabb3d20.28706150.jpeg'),
(15, 'Tuguegarao Airport', 'TUG', 'Cagayan, Philippines', '2025-10-16 13:39:53', '2025-11-25 23:22:29', 'img/airport_6926aab568e702.09930373.jpg'),
(16, 'Singapore Changi Airport', 'SIN', 'Changi, Singapore', '2025-10-16 13:39:53', '2025-11-25 23:17:30', 'img/airport_6926a98aed64a3.29361301.jpg'),
(17, 'Hong Kong International Airport', 'HKG', 'Hong Kong, China', '2025-10-16 13:39:53', '2025-11-25 23:18:21', 'img/airport_6926a9bdeb4ed7.55503881.jpg'),
(18, 'Narita International Airport', 'NRT', 'Tokyo, Japan', '2025-10-16 13:39:53', '2025-11-25 23:21:34', 'img/airport_6926aa7e627276.92281372.jpg'),
(19, 'Incheon International Airport', 'ICN', 'Seoul, South Korea', '2025-10-16 13:39:53', '2025-11-25 23:21:26', 'img/airport_6926aa76852ab2.94966522.jpg'),
(20, 'Los Angeles International Airport', 'LAX', 'Los Angeles, USA', '2025-10-16 13:39:53', '2025-11-25 23:20:54', 'img/airport_6926aa561b0233.08137218.jpg'),
(21, 'Beijing Capital International Airport', 'PEK', 'Beijing, China', '2025-11-25 06:49:50', '2025-11-25 23:20:44', 'img/airport_6926aa4cbab527.18140737.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entity_type` varchar(50) DEFAULT NULL,
  `entity_id` bigint(20) UNSIGNED DEFAULT NULL,
  `change_type` varchar(50) DEFAULT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `changed_by` varchar(50) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `entity_type`, `entity_id`, `change_type`, `changed_at`, `changed_by`, `details`, `created_at`, `updated_at`) VALUES
(1, 'flight', 1, 'Update', '2025-10-16 13:39:53', 'admin1@air2holiday.com', 'Updated status to Scheduled', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(2, 'booking', 5, 'Delete', '2025-10-16 13:39:53', 'admin2@air2holiday.com', 'Booking cancelled due to payment failure', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(3, 'user', 1, 'Update', '2025-10-16 13:39:53', 'admin1@air2holiday.com', 'Password reset request processed', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(4, 'payment', 9, 'Update', '2025-10-16 13:39:53', 'admin2@air2holiday.com', 'Refund processed successfully', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(5, 'flight', 10, 'Insert', '2025-10-16 13:39:53', 'admin1@air2holiday.com', 'New LAX route added', '2025-10-16 13:39:53', '2025-10-16 13:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `flight_id` bigint(20) UNSIGNED NOT NULL,
  `seat_number` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `class` varchar(50) NOT NULL DEFAULT 'economy'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_date`, `status`, `user_id`, `payment_id`, `flight_id`, `seat_number`, `created_at`, `updated_at`, `class`) VALUES
(1, '2025-10-16 13:39:53', 'confirmed', 1, 1, 1, '4A', '2025-10-16 13:39:53', '2025-11-24 06:38:40', 'economy'),
(3, '2025-10-16 13:39:53', 'pending', 3, 3, 3, '3A', '2025-10-16 13:39:53', '2025-11-25 11:31:02', 'economy'),
(5, '2025-10-16 13:39:53', 'cancelled', 5, 5, 5, '3B', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'economy'),
(6, '2025-10-16 13:39:53', 'confirmed', 6, 6, 6, '1A', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'business'),
(7, '2025-10-16 13:39:53', 'confirmed', 7, 7, 7, '1B', '2025-10-16 13:39:53', '2025-11-25 11:31:10', 'business'),
(8, '2025-10-16 13:39:53', 'confirmed', 8, 8, 8, '1C', '2025-10-16 13:39:53', '2025-11-25 11:31:14', 'business'),
(9, '2025-10-16 13:39:53', 'cancelled', 9, 9, 9, '1D', '2025-10-16 13:39:53', '2025-11-25 11:31:26', 'business'),
(11, '2025-10-16 13:39:53', 'confirmed', 11, 11, 11, '3C', '2025-10-16 13:39:53', '2025-11-25 11:31:34', 'economy'),
(12, '2025-10-16 13:39:53', 'confirmed', 12, 12, 12, '3D', '2025-10-16 13:39:53', '2025-11-25 11:31:39', 'economy'),
(13, '2025-10-16 13:39:53', 'confirmed', 13, 13, 13, '3E', '2025-10-16 13:39:53', '2025-11-25 11:31:45', 'economy'),
(14, '2025-10-16 13:39:53', 'confirmed', 14, 14, 14, '3F', '2025-10-16 13:39:53', '2025-11-25 11:31:49', 'economy'),
(15, '2025-10-16 13:39:53', 'pending', 15, 15, 15, '1E', '2025-10-16 13:39:53', '2025-11-25 11:32:05', 'business'),
(17, '2025-10-16 13:39:53', 'confirmed', 17, 17, 17, '1F', '2025-10-16 13:39:53', '2025-11-25 11:31:55', 'business'),
(18, '2025-10-16 13:39:53', 'confirmed', 18, 18, 18, '2A', '2025-10-16 13:39:53', '2025-11-25 11:32:01', 'business'),
(19, '2025-10-16 13:39:53', 'cancelled', 19, 19, 19, '2B', '2025-10-16 13:39:53', '2025-11-25 11:32:11', 'business'),
(20, '2025-11-20 00:15:30', 'confirmed', 26, 21, 21, '3C', '2025-11-20 00:15:30', '2025-11-26 02:00:00', 'economy'),
(21, '2025-11-21 06:20:15', 'confirmed', 31, 22, 22, '1A', '2025-11-21 06:20:15', '2025-11-26 02:00:00', 'business'),
(22, '2025-11-19 01:30:45', 'pending', 32, 23, 23, '3D', '2025-11-19 01:30:45', '2025-11-26 02:00:00', 'economy'),
(23, '2025-11-22 08:45:00', 'confirmed', 33, 24, 24, '3E', '2025-11-22 08:45:00', '2025-11-26 02:00:00', 'economy'),
(24, '2025-11-18 03:00:00', 'confirmed', 34, 25, 25, '1B', '2025-11-18 03:00:00', '2025-11-26 02:00:00', 'business'),
(25, '2025-11-23 05:15:20', 'confirmed', 35, 26, 26, '3F', '2025-11-23 05:15:20', '2025-11-26 02:00:00', 'economy'),
(26, '2025-11-17 02:30:00', 'cancelled', 36, 27, 27, '1C', '2025-11-17 02:30:00', '2025-11-26 02:00:00', 'business'),
(27, '2025-11-24 07:45:30', 'confirmed', 37, 28, 28, '4A', '2025-11-24 07:45:30', '2025-11-26 02:00:00', 'economy'),
(28, '2025-11-16 04:20:00', 'confirmed', 38, 29, 29, '1D', '2025-11-16 04:20:00', '2025-11-26 02:00:00', 'business'),
(29, '2025-11-25 01:00:15', 'pending', 39, 30, 30, '4B', '2025-11-25 01:00:15', '2025-11-26 02:00:00', 'economy'),
(30, '2025-11-15 06:35:00', 'confirmed', 40, 31, 31, '4C', '2025-11-15 06:35:00', '2025-11-26 02:00:00', 'economy'),
(31, '2025-11-20 03:50:45', 'confirmed', 41, 32, 32, '4D', '2025-11-20 03:50:45', '2025-11-26 02:00:00', 'economy'),
(32, '2025-11-14 08:20:30', 'confirmed', 42, 33, 33, '1E', '2025-11-14 08:20:30', '2025-11-26 02:00:00', 'business'),
(33, '2025-11-21 02:15:00', 'confirmed', 43, 34, 34, '4E', '2025-11-21 02:15:00', '2025-11-26 02:00:00', 'economy'),
(34, '2025-11-13 05:40:20', 'cancelled', 44, 35, 35, '4F', '2025-11-13 05:40:20', '2025-11-26 02:00:00', 'economy'),
(35, '2025-11-22 07:00:00', 'confirmed', 45, 36, 36, '1F', '2025-11-22 07:00:00', '2025-11-26 02:00:00', 'business'),
(36, '2025-11-12 01:25:45', 'confirmed', 46, 37, 37, '5A', '2025-11-12 01:25:45', '2025-11-26 02:00:00', 'economy'),
(37, '2025-11-23 04:10:30', 'pending', 47, 38, 38, '2A', '2025-11-23 04:10:30', '2025-11-26 02:00:00', 'business'),
(38, '2025-11-11 06:55:00', 'confirmed', 48, 39, 39, '5B', '2025-11-11 06:55:00', '2025-11-26 02:00:00', 'economy'),
(39, '2025-11-24 00:30:15', 'confirmed', 49, 40, 40, '5C', '2025-11-24 00:30:15', '2025-11-26 02:00:00', 'economy'),
(40, '2025-11-10 03:45:30', 'confirmed', 50, 41, 41, '2B', '2025-11-10 03:45:30', '2025-11-26 02:00:00', 'business'),
(41, '2025-11-25 08:20:00', 'confirmed', 51, 42, 42, '5D', '2025-11-25 08:20:00', '2025-11-26 02:00:00', 'economy'),
(42, '2025-11-09 05:00:45', 'confirmed', 52, 43, 43, '5E', '2025-11-09 05:00:45', '2025-11-26 02:00:00', 'economy'),
(43, '2025-11-20 02:35:20', 'cancelled', 53, 44, 44, '2C', '2025-11-20 02:35:20', '2025-11-26 02:00:00', 'business'),
(44, '2025-11-08 07:50:00', 'confirmed', 54, 45, 45, '5F', '2025-11-08 07:50:00', '2025-11-26 02:00:00', 'economy'),
(45, '2025-11-21 01:15:30', 'confirmed', 55, 46, 46, '2D', '2025-11-21 01:15:30', '2025-11-26 02:00:00', 'business'),
(46, '2025-11-07 04:40:15', 'pending', 56, 47, 47, '6A', '2025-11-07 04:40:15', '2025-11-26 02:00:00', 'economy'),
(47, '2025-11-22 06:25:00', 'confirmed', 57, 48, 48, '6B', '2025-11-22 06:25:00', '2025-11-26 02:00:00', 'economy'),
(48, '2025-11-06 08:10:45', 'confirmed', 58, 49, 49, '6C', '2025-11-06 08:10:45', '2025-11-26 02:00:00', 'economy'),
(49, '2025-11-23 03:00:30', 'confirmed', 59, 50, 50, '2E', '2025-11-23 03:00:30', '2025-11-26 02:00:00', 'business'),
(50, '2025-11-05 05:55:20', 'confirmed', 60, 51, 51, '6D', '2025-11-05 05:55:20', '2025-11-26 02:00:00', 'economy'),
(51, '2025-11-24 02:20:00', 'confirmed', 61, 52, 52, '6E', '2025-11-24 02:20:00', '2025-11-26 02:00:00', 'economy'),
(52, '2025-11-04 07:40:45', 'cancelled', 62, 53, 53, '2F', '2025-11-04 07:40:45', '2025-11-26 02:00:00', 'business'),
(53, '2025-11-25 04:05:30', 'confirmed', 63, 54, 54, '6F', '2025-11-25 04:05:30', '2025-11-26 02:00:00', 'economy'),
(54, '2025-11-03 01:30:15', 'confirmed', 64, 55, 55, '3A', '2025-11-03 01:30:15', '2025-11-26 02:00:00', 'economy'),
(55, '2025-11-20 06:50:00', 'pending', 65, 56, 56, '1A', '2025-11-20 06:50:00', '2025-11-26 02:00:00', 'business'),
(56, '2025-11-02 03:15:45', 'confirmed', 66, 57, 57, '3B', '2025-11-02 03:15:45', '2025-11-26 02:00:00', 'economy'),
(57, '2025-11-21 00:40:30', 'confirmed', 67, 58, 58, '3C', '2025-11-21 00:40:30', '2025-11-26 02:00:00', 'economy'),
(58, '2025-11-01 05:25:20', 'confirmed', 68, 59, 59, '1B', '2025-11-01 05:25:20', '2025-11-26 02:00:00', 'business'),
(59, '2025-11-22 08:10:00', 'confirmed', 69, 60, 60, '3D', '2025-11-22 08:10:00', '2025-11-26 02:00:00', 'economy'),
(60, '2025-10-31 02:00:45', 'confirmed', 70, 61, 61, '3E', '2025-10-31 02:00:45', '2025-11-26 02:00:00', 'economy'),
(61, '2025-11-23 07:35:30', 'cancelled', 31, 62, 62, '1C', '2025-11-23 07:35:30', '2025-11-26 02:00:00', 'business'),
(62, '2025-10-30 04:20:15', 'confirmed', 32, 63, 63, '3F', '2025-10-30 04:20:15', '2025-11-26 02:00:00', 'economy'),
(63, '2025-11-24 01:05:00', 'confirmed', 33, 64, 64, '4A', '2025-11-24 01:05:00', '2025-11-26 02:00:00', 'economy'),
(64, '2025-10-29 06:50:45', 'pending', 34, 65, 65, '4B', '2025-10-29 06:50:45', '2025-11-26 02:00:00', 'economy'),
(65, '2025-11-25 03:30:30', 'confirmed', 35, 66, 66, '1D', '2025-11-25 03:30:30', '2025-11-26 02:00:00', 'business'),
(66, '2025-10-28 08:15:20', 'confirmed', 36, 67, 67, '4C', '2025-10-28 08:15:20', '2025-11-26 02:00:00', 'economy'),
(67, '2025-11-20 05:00:00', 'confirmed', 37, 68, 68, '4D', '2025-11-20 05:00:00', '2025-11-26 02:00:00', 'economy'),
(68, '2025-10-27 02:45:45', 'confirmed', 38, 69, 69, '1E', '2025-10-27 02:45:45', '2025-11-26 02:00:00', 'business'),
(69, '2025-11-21 07:25:30', 'confirmed', 39, 70, 70, '4E', '2025-11-21 07:25:30', '2025-11-26 02:00:00', 'economy'),
(70, '2025-10-26 04:10:15', 'confirmed', 40, 71, 71, '4F', '2025-10-26 04:10:15', '2025-11-26 02:00:00', 'economy'),
(71, '2025-11-22 00:55:00', 'cancelled', 41, 72, 72, '1F', '2025-11-22 00:55:00', '2025-11-26 02:00:00', 'business'),
(72, '2025-10-25 06:40:45', 'confirmed', 42, 73, 73, '5A', '2025-10-25 06:40:45', '2025-11-26 02:00:00', 'economy'),
(73, '2025-11-23 02:20:30', 'confirmed', 43, 74, 74, '5B', '2025-11-23 02:20:30', '2025-11-26 02:00:00', 'economy'),
(74, '2025-10-24 08:05:20', 'pending', 44, 75, 75, '5C', '2025-10-24 08:05:20', '2025-11-26 02:00:00', 'economy'),
(75, '2025-11-26 08:33:59', 'confirmed', 1, NULL, 84, '2F', '2025-11-26 08:33:59', '2025-11-26 08:33:59', 'economy'),
(76, '2025-11-26 08:46:58', 'confirmed', 1, NULL, 90, '1E', '2025-11-26 08:46:58', '2025-11-26 08:46:58', 'economy'),
(77, '2025-12-04 12:50:45', 'confirmed', 1, 76, 91, '1A', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(78, '2025-12-04 12:50:45', 'confirmed', 1, 77, 97, '2A', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(79, '2025-12-04 12:50:45', 'confirmed', 3, 78, 92, '1B', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(80, '2025-12-04 12:50:45', 'confirmed', 3, 79, 103, '1A', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'business'),
(81, '2025-12-04 12:50:45', 'confirmed', 4, 80, 113, '3A', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(82, '2025-12-04 12:50:45', 'confirmed', 4, 81, 114, '2B', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(83, '2025-12-04 12:50:45', 'confirmed', 5, 82, 115, '1C', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(84, '2025-12-04 12:50:45', 'confirmed', 5, 83, 98, '3B', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(85, '2025-12-04 12:50:45', 'confirmed', 6, 84, 93, '1D', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'business'),
(86, '2025-12-04 12:50:45', 'confirmed', 6, 85, 99, '2C', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(87, '2025-12-04 12:50:45', 'confirmed', 7, 86, 94, '1E', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'business'),
(88, '2025-12-04 12:50:45', 'confirmed', 7, 87, 104, '3C', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(89, '2025-12-04 12:50:45', 'confirmed', 8, 88, 95, '1F', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'business'),
(90, '2025-12-04 12:50:45', 'confirmed', 8, 89, 116, '2D', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(91, '2025-12-04 12:50:45', 'confirmed', 9, 90, 96, '2E', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'business'),
(92, '2025-12-04 12:50:45', 'confirmed', 9, 91, 109, '4A', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(93, '2025-12-04 12:50:45', 'confirmed', 13, 92, 132, '1G', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'business'),
(94, '2025-12-04 12:50:45', 'confirmed', 13, 93, 141, '2F', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(95, '2025-12-04 12:50:45', 'confirmed', 14, 76, 122, '3D', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(96, '2025-12-04 12:50:45', 'confirmed', 14, 77, 128, '1H', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'business'),
(97, '2025-12-04 12:50:45', 'confirmed', 15, 78, 130, '4B', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(98, '2025-12-04 12:50:45', 'confirmed', 15, 79, 144, '2G', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(99, '2025-12-04 12:50:45', 'confirmed', 17, 80, 156, '1I', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'business'),
(100, '2025-12-04 12:50:45', 'confirmed', 17, 81, 162, '3E', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(101, '2025-12-04 12:50:45', 'confirmed', 18, 82, 117, '2H', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(102, '2025-12-04 12:50:45', 'confirmed', 18, 83, 150, '1J', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'business'),
(103, '2025-12-04 12:50:45', 'confirmed', 19, 84, 145, '3F', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(104, '2025-12-04 12:50:45', 'confirmed', 19, 85, 153, '2I', '2025-12-04 12:50:45', '2025-12-04 12:50:45', 'economy'),
(106, '2025-12-04 05:11:17', 'confirmed', 1, 106, 115, '2A', '2025-12-04 05:11:17', '2025-12-04 05:11:17', 'economy'),
(107, '2025-12-04 05:11:17', 'confirmed', 4, 107, 125, '2B', '2025-12-04 05:11:17', '2025-12-04 05:11:17', 'economy'),
(108, '2025-12-04 05:11:17', 'confirmed', 5, 108, 135, '2C', '2025-12-04 05:11:17', '2025-12-04 05:11:17', 'economy'),
(109, '2025-12-04 05:11:17', 'confirmed', 6, 109, 145, '2D', '2025-12-04 05:11:17', '2025-12-04 05:11:17', 'business'),
(110, '2025-12-04 05:11:17', 'confirmed', 7, 110, 155, '2E', '2025-12-04 05:11:17', '2025-12-04 05:11:17', 'economy'),
(111, '2025-12-04 05:11:17', 'confirmed', 8, 111, 165, '2F', '2025-12-04 05:11:17', '2025-12-04 05:11:17', 'business'),
(112, '2025-12-04 05:11:17', 'confirmed', 9, 112, 175, '3C', '2025-12-04 05:11:17', '2025-12-04 05:11:17', 'economy'),
(113, '2025-12-04 05:11:17', 'confirmed', 13, 113, 185, '3D', '2025-12-04 05:11:17', '2025-12-04 05:11:17', 'economy'),
(114, '2025-12-04 05:11:17', 'confirmed', 14, 114, 195, '3E', '2025-12-04 05:11:17', '2025-12-04 05:11:17', 'business'),
(115, '2025-12-04 05:11:17', 'confirmed', 15, 115, 205, '3F', '2025-12-04 05:11:17', '2025-12-04 05:11:17', 'economy'),
(116, '2025-12-04 05:11:17', 'confirmed', 17, 116, 215, '4A', '2025-12-04 05:11:17', '2025-12-04 05:11:17', 'economy'),
(117, '2025-12-04 05:11:17', 'confirmed', 18, 117, 225, '4B', '2025-12-04 05:11:17', '2025-12-04 05:11:17', 'business'),
(118, '2025-12-04 06:34:32', 'confirmed', 11, NULL, 91, '3E', '2025-12-04 06:34:32', '2025-12-04 06:34:32', 'economy'),
(119, '2025-12-04 06:46:33', 'pending', 11, NULL, 288, '5E', '2025-12-04 06:46:33', '2025-12-04 06:46:33', 'economy'),
(120, '2025-12-04 06:48:04', 'confirmed', 11, NULL, 126, '1D', '2025-12-04 06:48:04', '2025-12-04 06:48:04', 'business');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-1ddc505f84ff01831e2cb7da5a9a6d8a', 'i:1;', 1764854919),
('laravel-cache-1ddc505f84ff01831e2cb7da5a9a6d8a:timer', 'i:1764854919;', 1764854919),
('laravel-cache-4b27b84871653d3fa657f5b11b84f783', 'i:1;', 1764860861),
('laravel-cache-4b27b84871653d3fa657f5b11b84f783:timer', 'i:1764860861;', 1764860861),
('laravel-cache-4b49b3936b53fdaff3cde3443b1c7135', 'i:1;', 1764860652),
('laravel-cache-4b49b3936b53fdaff3cde3443b1c7135:timer', 'i:1764860652;', 1764860652),
('laravel-cache-82062546cf153915035887efe4d3199f', 'i:1;', 1764854951),
('laravel-cache-82062546cf153915035887efe4d3199f:timer', 'i:1764854951;', 1764854951),
('laravel-cache-93bab59343e8392f7bc8b4d32afc522f', 'i:1;', 1764150460),
('laravel-cache-93bab59343e8392f7bc8b4d32afc522f:timer', 'i:1764150460;', 1764150460),
('laravel-cache-admin@air2holiday.com|127.0.0.1', 'i:1;', 1764150460),
('laravel-cache-admin@air2holiday.com|127.0.0.1:timer', 'i:1764150460;', 1764150460),
('laravel-cache-admin@philippineairlines.com|127.0.0.1', 'i:1;', 1764854919),
('laravel-cache-admin@philippineairlines.com|127.0.0.1:timer', 'i:1764854919;', 1764854919),
('laravel-cache-admin1@air2holidayscom|127.0.0.1', 'i:1;', 1764150496),
('laravel-cache-admin1@air2holidayscom|127.0.0.1:timer', 'i:1764150496;', 1764150496),
('laravel-cache-airline@philippineairline.com|127.0.0.1', 'i:1;', 1764854909),
('laravel-cache-airline@philippineairline.com|127.0.0.1:timer', 'i:1764854909;', 1764854909),
('laravel-cache-boost:mcp:database-schema:mysql:', 'a:3:{s:6:\"engine\";s:5:\"mysql\";s:6:\"tables\";a:36:{s:8:\"airlines\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:4:\"name\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:4:\"code\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:4:\"logo\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:7:\"user_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}}s:7:\"indexes\";a:3:{s:20:\"airlines_code_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"code\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:24:\"airlines_user_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:7:\"user_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:24:\"airlines_user_id_foreign\";s:7:\"columns\";a:1:{i:0;s:7:\"user_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:5:\"users\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:8:\"set null\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"airports\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:4:\"name\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:9:\"iata_code\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:8:\"location\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:5:\"image\";a:1:{s:4:\"type\";s:7:\"varchar\";}}s:7:\"indexes\";a:2:{s:25:\"airports_iata_code_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:9:\"iata_code\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:10:\"audit_logs\";a:5:{s:7:\"columns\";a:9:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:11:\"entity_type\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:9:\"entity_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:11:\"change_type\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"changed_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"changed_by\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:7:\"details\";a:1:{s:4:\"type\";s:4:\"text\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"bookings\";a:5:{s:7:\"columns\";a:10:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:12:\"booking_date\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:6:\"status\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:7:\"user_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:10:\"payment_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:9:\"flight_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:11:\"seat_number\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:5:\"class\";a:1:{s:4:\"type\";s:7:\"varchar\";}}s:7:\"indexes\";a:4:{s:37:\"bookings_flight_id_seat_number_unique\";a:4:{s:7:\"columns\";a:2:{i:0;s:9:\"flight_id\";i:1;s:11:\"seat_number\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:27:\"bookings_payment_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"payment_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:24:\"bookings_user_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:7:\"user_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:3:{i:0;a:7:{s:4:\"name\";s:26:\"bookings_flight_id_foreign\";s:7:\"columns\";a:1:{i:0;s:9:\"flight_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:7:\"flights\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:7:\"cascade\";}i:1;a:7:{s:4:\"name\";s:27:\"bookings_payment_id_foreign\";s:7:\"columns\";a:1:{i:0;s:10:\"payment_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:8:\"payments\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:8:\"set null\";}i:2;a:7:{s:4:\"name\";s:24:\"bookings_user_id_foreign\";s:7:\"columns\";a:1:{i:0;s:7:\"user_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:5:\"users\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:5:\"cache\";a:5:{s:7:\"columns\";a:3:{s:3:\"key\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:5:\"value\";a:1:{s:4:\"type\";s:10:\"mediumtext\";}s:10:\"expiration\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:3:\"key\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:11:\"cache_locks\";a:5:{s:7:\"columns\";a:3:{s:3:\"key\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:5:\"owner\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"expiration\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:3:\"key\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:11:\"failed_jobs\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:4:\"uuid\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"connection\";a:1:{s:4:\"type\";s:4:\"text\";}s:5:\"queue\";a:1:{s:4:\"type\";s:4:\"text\";}s:7:\"payload\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:9:\"exception\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:9:\"failed_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:23:\"failed_jobs_uuid_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"uuid\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:7:\"flights\";a:5:{s:7:\"columns\";a:14:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:13:\"flight_number\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:19:\"scheduled_departure\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:17:\"scheduled_arrival\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:16:\"actual_departure\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:14:\"actual_arrival\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:6:\"status\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"airline_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:20:\"departure_airport_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:18:\"arrival_airport_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:10:\"base_price\";a:1:{s:4:\"type\";s:7:\"decimal\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:14:\"business_price\";a:1:{s:4:\"type\";s:7:\"decimal\";}}s:7:\"indexes\";a:4:{s:26:\"flights_airline_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"airline_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:34:\"flights_arrival_airport_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:18:\"arrival_airport_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:36:\"flights_departure_airport_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:20:\"departure_airport_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:3:{i:0;a:7:{s:4:\"name\";s:26:\"flights_airline_id_foreign\";s:7:\"columns\";a:1:{i:0;s:10:\"airline_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:8:\"airlines\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:7:\"cascade\";}i:1;a:7:{s:4:\"name\";s:34:\"flights_arrival_airport_id_foreign\";s:7:\"columns\";a:1:{i:0;s:18:\"arrival_airport_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:8:\"airports\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:7:\"cascade\";}i:2;a:7:{s:4:\"name\";s:36:\"flights_departure_airport_id_foreign\";s:7:\"columns\";a:1:{i:0;s:20:\"departure_airport_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:8:\"airports\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:4:\"jobs\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:5:\"queue\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:7:\"payload\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:8:\"attempts\";a:1:{s:4:\"type\";s:7:\"tinyint\";}s:11:\"reserved_at\";a:1:{s:4:\"type\";s:3:\"int\";}s:12:\"available_at\";a:1:{s:4:\"type\";s:3:\"int\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:2:{s:16:\"jobs_queue_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"queue\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:11:\"job_batches\";a:5:{s:7:\"columns\";a:10:{s:2:\"id\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:4:\"name\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"total_jobs\";a:1:{s:4:\"type\";s:3:\"int\";}s:12:\"pending_jobs\";a:1:{s:4:\"type\";s:3:\"int\";}s:11:\"failed_jobs\";a:1:{s:4:\"type\";s:3:\"int\";}s:14:\"failed_job_ids\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:7:\"options\";a:1:{s:4:\"type\";s:10:\"mediumtext\";}s:12:\"cancelled_at\";a:1:{s:4:\"type\";s:3:\"int\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:3:\"int\";}s:11:\"finished_at\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:10:\"migrations\";a:5:{s:7:\"columns\";a:3:{s:2:\"id\";a:1:{s:4:\"type\";s:3:\"int\";}s:9:\"migration\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:5:\"batch\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:10:\"passengers\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:10:\"booking_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:4:\"name\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:8:\"passport\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:13:\"date_of_birth\";a:1:{s:4:\"type\";s:4:\"date\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:29:\"passengers_booking_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"booking_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:29:\"passengers_booking_id_foreign\";s:7:\"columns\";a:1:{i:0;s:10:\"booking_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:8:\"bookings\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:21:\"password_reset_tokens\";a:5:{s:7:\"columns\";a:3:{s:5:\"email\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:5:\"token\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"email\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"payments\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:6:\"amount\";a:1:{s:4:\"type\";s:7:\"decimal\";}s:6:\"method\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:12:\"payment_date\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:6:\"status\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:5:\"seats\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:9:\"flight_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:11:\"seat_number\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:5:\"class\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:12:\"is_available\";a:1:{s:4:\"type\";s:7:\"tinyint\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:34:\"seats_flight_id_seat_number_unique\";a:4:{s:7:\"columns\";a:2:{i:0;s:9:\"flight_id\";i:1;s:11:\"seat_number\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:23:\"seats_flight_id_foreign\";s:7:\"columns\";a:1:{i:0;s:9:\"flight_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:7:\"flights\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"sessions\";a:5:{s:7:\"columns\";a:6:{s:2:\"id\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:7:\"user_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:10:\"ip_address\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"user_agent\";a:1:{s:4:\"type\";s:4:\"text\";}s:7:\"payload\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:13:\"last_activity\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:3:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:28:\"sessions_last_activity_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:13:\"last_activity\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:22:\"sessions_user_id_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:7:\"user_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:5:\"users\";a:5:{s:7:\"columns\";a:15:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:4:\"name\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:5:\"email\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:8:\"usertype\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:13:\"profile_photo\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:17:\"email_verified_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:8:\"password\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:4:\"role\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:8:\"passport\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:17:\"two_factor_secret\";a:1:{s:4:\"type\";s:4:\"text\";}s:25:\"two_factor_recovery_codes\";a:1:{s:4:\"type\";s:4:\"text\";}s:23:\"two_factor_confirmed_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:14:\"remember_token\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:18:\"users_email_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"email\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:13:\"pma__bookmark\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:20:\"pma__central_columns\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:16:\"pma__column_info\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:22:\"pma__designer_settings\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:21:\"pma__export_templates\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:13:\"pma__favorite\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:12:\"pma__history\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:21:\"pma__navigationhiding\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:14:\"pma__pdf_pages\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:11:\"pma__recent\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:13:\"pma__relation\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:18:\"pma__savedsearches\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:17:\"pma__table_coords\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:15:\"pma__table_info\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:18:\"pma__table_uiprefs\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:13:\"pma__tracking\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:15:\"pma__userconfig\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:15:\"pma__usergroups\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:10:\"pma__users\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}}s:6:\"global\";a:4:{s:5:\"views\";a:0:{}s:17:\"stored_procedures\";a:0:{}s:9:\"functions\";a:0:{}s:9:\"sequences\";a:0:{}}}', 1764154603),
('laravel-cache-boost:mcp:database-schema:mysql:airports', 'a:3:{s:6:\"engine\";s:5:\"mysql\";s:6:\"tables\";a:1:{s:8:\"airports\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:4:\"name\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:9:\"iata_code\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:8:\"location\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:5:\"image\";a:1:{s:4:\"type\";s:7:\"varchar\";}}s:7:\"indexes\";a:2:{s:25:\"airports_iata_code_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:9:\"iata_code\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}}s:6:\"global\";a:4:{s:5:\"views\";a:0:{}s:17:\"stored_procedures\";a:0:{}s:9:\"functions\";a:0:{}s:9:\"sequences\";a:0:{}}}', 1764175971),
('laravel-cache-boost.roster.scan', 'a:2:{s:6:\"roster\";O:21:\"Laravel\\Roster\\Roster\":3:{s:13:\"\0*\0approaches\";O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:23:\"Laravel\\Roster\\Approach\":1:{s:11:\"\0*\0approach\";E:38:\"Laravel\\Roster\\Enums\\Approaches:ACTION\";}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:12:{i:0;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.30\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:FORTIFY\";s:14:\"\0*\0packageName\";s:15:\"laravel/fortify\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:6:\"\0*\0dev\";b:0;}i:1;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^12.0\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:LARAVEL\";s:14:\"\0*\0packageName\";s:17:\"laravel/framework\";s:10:\"\0*\0version\";s:7:\"12.39.0\";s:6:\"\0*\0dev\";b:0;}i:2;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.3.7\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PROMPTS\";s:14:\"\0*\0packageName\";s:15:\"laravel/prompts\";s:10:\"\0*\0version\";s:5:\"0.3.7\";s:6:\"\0*\0dev\";b:0;}i:3;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^2.6\";s:10:\"\0*\0package\";E:41:\"Laravel\\Roster\\Enums\\Packages:FLUXUI_FREE\";s:14:\"\0*\0packageName\";s:13:\"livewire/flux\";s:10:\"\0*\0version\";s:5:\"2.6.2\";s:6:\"\0*\0dev\";b:0;}i:4;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v3.7.0\";s:10:\"\0*\0package\";E:38:\"Laravel\\Roster\\Enums\\Packages:LIVEWIRE\";s:14:\"\0*\0packageName\";s:17:\"livewire/livewire\";s:10:\"\0*\0version\";s:5:\"3.7.0\";s:6:\"\0*\0dev\";b:0;}i:5;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^1.7.0\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:VOLT\";s:14:\"\0*\0packageName\";s:13:\"livewire/volt\";s:10:\"\0*\0version\";s:6:\"1.10.0\";s:6:\"\0*\0dev\";b:0;}i:6;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.3.4\";s:10:\"\0*\0package\";E:33:\"Laravel\\Roster\\Enums\\Packages:MCP\";s:14:\"\0*\0packageName\";s:11:\"laravel/mcp\";s:10:\"\0*\0version\";s:5:\"0.3.4\";s:6:\"\0*\0dev\";b:1;}i:7;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.24\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PINT\";s:14:\"\0*\0packageName\";s:12:\"laravel/pint\";s:10:\"\0*\0version\";s:6:\"1.25.1\";s:6:\"\0*\0dev\";b:1;}i:8;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.41\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:SAIL\";s:14:\"\0*\0packageName\";s:12:\"laravel/sail\";s:10:\"\0*\0version\";s:6:\"1.48.1\";s:6:\"\0*\0dev\";b:1;}i:9;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^3.8\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PEST\";s:14:\"\0*\0packageName\";s:12:\"pestphp/pest\";s:10:\"\0*\0version\";s:5:\"3.8.4\";s:6:\"\0*\0dev\";b:1;}i:10;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:7:\"11.5.33\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PHPUNIT\";s:14:\"\0*\0packageName\";s:15:\"phpunit/phpunit\";s:10:\"\0*\0version\";s:7:\"11.5.33\";s:6:\"\0*\0dev\";b:1;}i:11;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:41:\"Laravel\\Roster\\Enums\\Packages:TAILWINDCSS\";s:14:\"\0*\0packageName\";s:11:\"tailwindcss\";s:10:\"\0*\0version\";s:6:\"4.1.11\";s:6:\"\0*\0dev\";b:0;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:21:\"\0*\0nodePackageManager\";E:43:\"Laravel\\Roster\\Enums\\NodePackageManager:NPM\";}s:9:\"timestamp\";i:1764173686;}', 1764260086),
('laravel-cache-e63c416c2ffd0db1188631046cb06f7b', 'i:1;', 1764175761),
('laravel-cache-e63c416c2ffd0db1188631046cb06f7b:timer', 'i:1764175761;', 1764175761),
('laravel-cache-f47c2887a152af98e2ebe5a53dbabefc', 'i:1;', 1764150496),
('laravel-cache-f47c2887a152af98e2ebe5a53dbabefc:timer', 'i:1764150496;', 1764150496),
('laravel-cache-fee1bf06edf5cdddeda0ba8eca16467e', 'i:1;', 1764854909),
('laravel-cache-fee1bf06edf5cdddeda0ba8eca16467e:timer', 'i:1764854909;', 1764854909);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flight_number` varchar(20) NOT NULL,
  `scheduled_departure` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `scheduled_arrival` timestamp NULL DEFAULT NULL,
  `actual_departure` timestamp NULL DEFAULT NULL,
  `actual_arrival` timestamp NULL DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `airline_id` bigint(20) UNSIGNED NOT NULL,
  `departure_airport_id` bigint(20) UNSIGNED NOT NULL,
  `arrival_airport_id` bigint(20) UNSIGNED NOT NULL,
  `base_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `business_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `flight_number`, `scheduled_departure`, `scheduled_arrival`, `actual_departure`, `actual_arrival`, `status`, `airline_id`, `departure_airport_id`, `arrival_airport_id`, `base_price`, `created_at`, `updated_at`, `business_price`) VALUES
(1, 'PR1001', '2025-12-04 12:50:45', '2025-10-29 18:00:00', NULL, NULL, 'landed', 1, 1, 2, 3500.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 5250.00),
(2, 'PR1002', '2025-12-04 12:50:45', '2025-10-20 05:00:00', NULL, NULL, 'landed', 1, 1, 3, 4500.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 6750.00),
(3, 'PR1003', '2025-12-04 12:50:45', '2025-10-21 03:00:00', NULL, NULL, 'landed', 1, 1, 4, 2800.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 4200.00),
(4, 'PR1004', '2025-12-04 12:50:45', '2025-10-22 01:30:00', NULL, NULL, 'landed', 1, 1, 5, 3300.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 4950.00),
(5, 'PR1005', '2025-12-04 12:50:45', '2025-10-22 09:30:00', NULL, NULL, 'landed', 1, 1, 10, 5000.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 7500.00),
(6, 'PR1006', '2025-12-04 12:50:45', '2025-10-23 09:00:00', NULL, NULL, 'landed', 1, 1, 16, 12000.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 18000.00),
(7, 'PR1007', '2025-12-04 12:50:45', '2025-10-23 04:30:00', NULL, NULL, 'landed', 1, 1, 17, 11000.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 16500.00),
(8, 'PR1008', '2025-12-04 12:50:45', '2025-10-24 01:30:00', NULL, NULL, 'landed', 1, 1, 18, 13500.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 20250.00),
(9, 'PR1009', '2025-12-04 12:50:45', '2025-10-24 07:30:00', NULL, NULL, 'landed', 1, 1, 19, 14000.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 21000.00),
(10, 'PR1010', '2025-12-04 12:50:45', '2025-10-25 22:00:00', NULL, NULL, 'landed', 1, 1, 20, 48000.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 72000.00),
(11, 'PR1011', '2025-12-04 12:50:45', '2025-10-26 03:00:00', NULL, NULL, 'landed', 1, 2, 1, 3500.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 5250.00),
(12, 'PR1012', '2025-12-04 12:50:45', '2025-10-27 04:00:00', NULL, NULL, 'landed', 1, 3, 1, 4500.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 6750.00),
(13, 'PR1013', '2025-12-04 12:50:45', '2025-10-28 02:30:00', NULL, NULL, 'landed', 1, 5, 1, 3300.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 4950.00),
(14, 'PR1014', '2025-12-04 12:50:45', '2025-10-29 01:30:00', NULL, NULL, 'landed', 1, 10, 1, 5000.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 7500.00),
(15, 'PR1015', '2025-12-04 12:50:45', '2025-10-30 08:30:00', NULL, NULL, 'landed', 1, 16, 1, 12000.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 18000.00),
(16, 'PR1016', '2025-12-04 12:50:45', '2025-10-31 07:30:00', NULL, NULL, 'landed', 1, 17, 1, 11000.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 16500.00),
(17, 'PR1017', '2025-12-04 12:50:45', '2025-11-01 05:00:00', NULL, NULL, 'landed', 1, 18, 1, 13500.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 20250.00),
(18, 'PR1018', '2025-12-04 12:50:45', '2025-11-02 03:30:00', NULL, NULL, 'landed', 1, 19, 1, 14000.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 21000.00),
(19, 'PR1019', '2025-12-04 12:50:45', '2025-11-03 23:00:00', NULL, NULL, 'landed', 1, 20, 1, 48000.00, '2025-10-16 13:39:53', '2025-11-25 23:40:19', 72000.00),
(21, 'AM6304', '2025-12-04 12:50:45', '2026-02-03 02:03:53', NULL, NULL, 'landed', 2, 9, 20, 40774.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 52514.50),
(22, 'PH7963', '2025-11-26 07:40:19', '2026-02-17 14:41:59', '2026-02-17 02:41:59', '2026-02-17 14:41:59', 'landed', 1, 14, 6, 5810.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 48665.50),
(23, 'SI6823', '2025-12-04 12:50:45', '2026-02-13 07:27:52', NULL, NULL, 'landed', 4, 18, 15, 34948.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 128459.50),
(24, 'KO7625', '2025-11-26 07:40:19', '2026-01-05 05:03:52', '2026-01-04 17:03:52', '2026-01-05 05:03:52', 'landed', 5, 20, 5, 6223.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 34918.00),
(25, 'PH6069', '2025-12-04 12:50:45', '2026-01-21 10:52:32', NULL, NULL, 'landed', 1, 10, 6, 45822.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 64098.00),
(26, 'SI3117', '2025-12-04 12:50:45', '2026-01-05 13:43:05', NULL, NULL, 'landed', 4, 3, 1, 35933.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 74521.50),
(27, 'JA7166', '2025-12-04 12:50:45', '2026-01-02 00:58:49', NULL, NULL, 'landed', 3, 20, 5, 46062.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 115312.50),
(28, 'JA6555', '2025-11-26 07:40:19', '2026-01-29 16:52:26', '2026-01-29 05:52:26', '2026-01-29 16:52:26', 'landed', 3, 15, 1, 49095.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 36855.00),
(29, 'JA7853', '2025-12-04 12:50:45', '2026-02-16 05:34:27', NULL, NULL, 'landed', 3, 16, 10, 33986.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 83293.00),
(30, 'KO5263', '2025-11-26 07:40:19', '2025-12-03 22:11:08', '2025-12-03 20:11:08', '2025-12-03 22:11:08', 'landed', 5, 12, 4, 38472.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 40662.00),
(31, 'PH5633', '2025-11-26 07:40:19', '2025-12-14 04:55:52', '2025-12-13 21:55:52', '2025-12-14 04:55:52', 'landed', 1, 6, 14, 47597.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 28647.00),
(32, 'PH9325', '2025-12-04 12:50:45', '2026-02-18 10:15:44', NULL, NULL, 'landed', 1, 5, 3, 35435.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 42377.50),
(33, 'KO6557', '2025-12-04 12:50:45', '2026-01-26 14:32:20', NULL, NULL, 'landed', 5, 6, 17, 34688.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 109355.00),
(34, 'JA8573', '2025-12-04 12:50:45', '2026-02-06 10:11:31', NULL, NULL, 'landed', 3, 19, 12, 19186.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 37944.00),
(35, 'KO9773', '2025-12-04 12:50:45', '2025-12-31 19:14:11', '2025-12-31 08:14:11', NULL, 'landed', 5, 3, 5, 21869.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 131151.00),
(36, 'PH4201', '2025-12-04 12:50:45', '2026-02-11 03:37:49', NULL, NULL, 'landed', 1, 18, 8, 30716.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 110285.00),
(37, 'PH746', '2025-12-04 12:50:45', '2026-02-11 08:14:03', NULL, NULL, 'landed', 1, 8, 3, 14207.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 59577.50),
(38, 'SI1364', '2025-12-04 12:50:45', '2026-01-20 11:15:01', NULL, NULL, 'landed', 4, 14, 7, 27234.50, '2025-11-25 23:37:05', '2025-11-26 01:48:49', 103473.50),
(39, 'KO5579', '2025-12-04 12:50:45', '2026-02-08 16:48:19', NULL, NULL, 'landed', 5, 3, 10, 15513.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 31200.50),
(40, 'KO9309', '2025-12-04 12:50:45', '2026-02-02 18:13:53', NULL, NULL, 'landed', 5, 15, 8, 14682.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 76863.00),
(41, 'PH738', '2025-12-04 12:50:45', '2025-11-28 06:20:33', NULL, NULL, 'landed', 1, 1, 19, 43043.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 84914.50),
(42, 'JA4142', '2025-12-04 12:50:45', '2026-01-16 20:45:08', NULL, NULL, 'landed', 3, 19, 9, 38200.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 29418.50),
(43, 'KO6713', '2025-12-04 12:50:45', '2025-12-17 07:13:14', '2025-12-16 22:13:14', NULL, 'landed', 5, 8, 12, 36975.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 54911.00),
(44, 'JA3415', '2025-12-04 12:50:45', '2026-02-22 10:56:27', '2026-02-22 08:56:27', NULL, 'landed', 3, 8, 12, 11405.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 131738.50),
(45, 'PH6406', '2025-12-04 12:50:45', '2025-12-08 20:55:06', NULL, NULL, 'landed', 1, 4, 18, 20855.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 46190.50),
(46, 'PH5440', '2025-11-26 07:40:19', '2026-01-01 21:44:24', '2026-01-01 12:44:24', '2026-01-01 21:44:24', 'landed', 1, 3, 17, 35570.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 103519.00),
(47, 'PH7736', '2025-12-04 12:50:45', '2025-12-13 13:34:46', NULL, NULL, 'landed', 1, 15, 1, 19018.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 72887.00),
(48, 'KO4666', '2025-12-04 12:50:45', '2026-01-09 02:34:07', '2026-01-08 21:34:07', NULL, 'landed', 5, 21, 12, 45461.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 41748.00),
(49, 'SI774', '2025-12-04 12:50:45', '2025-12-09 16:51:33', '2025-12-09 10:51:33', NULL, 'landed', 4, 2, 14, 5521.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 144574.00),
(50, 'PH6199', '2025-11-26 07:40:19', '2026-01-12 03:43:13', '2026-01-11 15:43:13', '2026-01-12 03:43:13', 'landed', 1, 10, 7, 47091.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 40422.50),
(51, 'KO4613', '2025-12-04 12:50:45', '2026-01-24 06:01:59', NULL, NULL, 'landed', 5, 6, 10, 40091.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 37986.50),
(52, 'AM6258', '2025-12-04 12:50:45', '2026-01-26 18:41:26', NULL, NULL, 'landed', 2, 4, 9, 9821.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 48678.00),
(53, 'JA5761', '2025-12-04 12:50:45', '2025-12-12 23:45:42', NULL, NULL, 'landed', 3, 17, 8, 6838.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 30106.50),
(54, 'KO4521', '2025-12-04 12:50:45', '2025-12-18 05:11:47', NULL, NULL, 'landed', 5, 6, 17, 37476.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 139450.50),
(55, 'JA4144', '2025-12-04 12:50:45', '2026-01-22 15:58:41', NULL, NULL, 'landed', 3, 8, 21, 34631.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 70603.50),
(56, 'PH4988', '2025-12-04 12:50:45', '2026-01-09 07:34:47', NULL, NULL, 'landed', 1, 12, 1, 9864.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 83919.00),
(57, 'SI2523', '2025-12-04 12:50:45', '2025-12-15 00:21:03', NULL, NULL, 'landed', 4, 5, 18, 29812.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 137150.50),
(58, 'JA1012', '2025-12-04 12:50:45', '2026-02-14 06:41:34', NULL, NULL, 'landed', 3, 15, 21, 32201.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 40397.50),
(59, 'SI4972', '2025-12-04 12:50:45', '2025-12-23 15:21:54', NULL, NULL, 'landed', 4, 12, 17, 36972.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 41054.00),
(60, 'SI9865', '2025-12-04 12:50:45', '2026-02-24 06:45:39', NULL, NULL, 'landed', 4, 9, 19, 46491.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 62027.50),
(61, 'JA9190', '2025-12-04 12:50:45', '2025-12-28 06:55:40', '2025-12-28 01:55:40', NULL, 'landed', 3, 4, 2, 37542.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 49095.00),
(62, 'KO9680', '2025-12-04 12:50:45', '2026-01-22 02:56:04', NULL, NULL, 'landed', 5, 19, 16, 35096.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 73154.50),
(63, 'SI5113', '2025-12-04 12:50:45', '2026-02-13 23:32:02', '2026-02-13 15:32:02', NULL, 'landed', 4, 14, 6, 44614.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 76010.00),
(64, 'AM4662', '2025-11-26 07:40:19', '2026-02-20 13:28:09', '2026-02-20 02:28:09', '2026-02-20 13:28:09', 'landed', 2, 9, 12, 8087.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 63269.00),
(65, 'SI3040', '2025-12-04 12:50:45', '2025-12-02 14:58:18', NULL, NULL, 'landed', 4, 15, 14, 24828.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 48810.50),
(66, 'PH4019', '2025-11-26 07:40:19', '2025-12-29 14:12:55', '2025-12-29 10:12:55', '2025-12-29 14:12:55', 'landed', 1, 19, 1, 27559.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 62529.00),
(67, 'AM4894', '2025-12-04 12:50:45', '2026-01-17 16:32:14', NULL, NULL, 'landed', 2, 17, 8, 25114.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 72701.00),
(68, 'AM9313', '2025-12-04 12:50:45', '2026-01-03 04:38:43', NULL, NULL, 'landed', 2, 14, 7, 20904.00, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 40305.00),
(69, 'PH7743', '2025-12-04 12:50:45', '2025-12-07 16:29:42', NULL, NULL, 'landed', 1, 4, 14, 43857.50, '2025-11-25 23:37:05', '2025-11-26 01:28:29', 91901.50),
(70, 'SI7911', '2025-12-04 12:50:45', '2026-01-25 20:20:09', NULL, NULL, 'landed', 4, 8, 5, 6921.50, '2025-11-25 23:37:05', '2025-11-25 23:40:19', 55740.50),
(71, 'AM4392', '2025-12-04 12:50:45', '2025-11-30 08:23:18', NULL, NULL, 'landed', 2, 1, 10, 47430.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 55934.00),
(72, 'SI5493', '2025-12-04 12:50:45', '2025-12-02 22:33:18', NULL, NULL, 'landed', 4, 7, 18, 45674.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 88108.00),
(73, 'KO2808', '2025-12-04 12:50:45', '2025-11-29 13:12:18', NULL, NULL, 'landed', 5, 19, 14, 36457.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 25641.00),
(74, 'AM7795', '2025-12-04 12:50:45', '2025-11-28 01:42:18', NULL, NULL, 'landed', 2, 3, 12, 33163.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 51227.00),
(75, 'JA5874', '2025-12-04 12:50:45', '2025-11-30 11:19:18', NULL, NULL, 'landed', 3, 12, 14, 29897.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 69579.00),
(76, 'AM9858', '2025-12-04 12:50:45', '2025-11-27 06:12:18', NULL, NULL, 'landed', 2, 14, 18, 26257.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 43839.00),
(77, 'PH1433', '2025-12-04 12:50:45', '2025-11-30 11:09:18', NULL, NULL, 'landed', 1, 8, 12, 48735.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 41426.00),
(78, 'PH4300', '2025-12-04 12:50:45', '2025-12-03 19:35:18', NULL, NULL, 'landed', 1, 20, 6, 39026.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 58553.00),
(79, 'AM467', '2025-12-04 12:50:45', '2025-11-28 11:53:18', NULL, NULL, 'landed', 2, 16, 11, 27629.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 47302.00),
(80, 'KO5545', '2025-12-04 12:50:45', '2025-11-28 09:05:18', NULL, NULL, 'landed', 5, 18, 20, 20337.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 90932.00),
(81, 'JA844', '2025-12-04 12:50:45', '2025-11-26 13:47:18', NULL, NULL, 'landed', 3, 1, 6, 39998.00, '2025-11-25 23:45:18', '2025-11-26 01:56:29', 45191.00),
(82, 'PH8692', '2025-12-04 12:50:45', '2025-12-04 03:34:18', NULL, NULL, 'landed', 1, 12, 1, 33501.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 106761.00),
(83, 'AM7091', '2025-12-04 12:50:45', '2025-11-27 19:14:18', NULL, NULL, 'landed', 2, 16, 12, 31621.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 108536.00),
(84, 'KO2931', '2025-12-04 12:50:45', '2025-12-01 04:53:18', NULL, NULL, 'landed', 5, 19, 21, 46646.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 120771.00),
(85, 'SI5648', '2025-12-04 12:50:45', '2025-11-26 12:09:18', NULL, NULL, 'landed', 4, 11, 2, 47591.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 137418.00),
(86, 'PH973', '2025-12-04 12:50:45', '2025-11-29 23:27:18', NULL, NULL, 'landed', 1, 17, 20, 42982.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 133734.00),
(87, 'SI4303', '2025-12-04 12:50:45', '2025-12-03 05:32:18', NULL, NULL, 'landed', 4, 10, 9, 6168.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 98892.00),
(88, 'JA7681', '2025-12-04 12:50:45', '2025-11-30 16:58:18', NULL, NULL, 'landed', 3, 10, 18, 5257.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 43973.00),
(89, 'PH1294', '2025-12-04 12:50:45', '2025-12-02 00:10:18', NULL, NULL, 'landed', 1, 17, 11, 21140.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 118145.00),
(90, 'AM8055', '2025-12-04 12:50:45', '2025-11-29 05:30:18', NULL, NULL, 'landed', 2, 6, 14, 34259.00, '2025-11-25 23:45:18', '2025-11-25 23:45:18', 69941.00),
(91, 'PR2501', '2025-12-05 13:00:00', '2025-12-05 19:30:00', NULL, NULL, 'scheduled', 1, 1, 18, 15500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 23250.00),
(92, 'PR2502', '2025-12-05 14:30:00', '2025-12-05 21:00:00', NULL, NULL, 'scheduled', 1, 2, 18, 16200.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 24300.00),
(93, 'PR2503', '2025-12-06 13:15:00', '2025-12-06 19:45:00', NULL, NULL, 'scheduled', 1, 3, 18, 17000.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 25500.00),
(94, 'PR2504', '2025-12-06 14:00:00', '2025-12-06 20:30:00', NULL, NULL, 'scheduled', 1, 4, 18, 15800.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 23700.00),
(95, 'PR2505', '2025-12-07 13:00:00', '2025-12-07 19:30:00', NULL, NULL, 'scheduled', 1, 5, 18, 16500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 24750.00),
(96, 'PR2506', '2025-12-07 14:45:00', '2025-12-07 21:15:00', NULL, NULL, 'scheduled', 1, 6, 18, 15900.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 23850.00),
(97, 'PR2507', '2025-12-05 13:30:00', '2025-12-05 17:00:00', NULL, NULL, 'scheduled', 1, 1, 16, 8500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 12750.00),
(98, 'PR2508', '2025-12-05 15:00:00', '2025-12-05 18:30:00', NULL, NULL, 'scheduled', 1, 7, 16, 9200.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 13800.00),
(99, 'PR2509', '2025-12-06 13:45:00', '2025-12-06 17:15:00', NULL, NULL, 'scheduled', 1, 8, 16, 8800.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 13200.00),
(100, 'PR2510', '2025-12-06 14:30:00', '2025-12-06 18:00:00', NULL, NULL, 'scheduled', 1, 9, 16, 9500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 14250.00),
(101, 'PR2511', '2025-12-07 13:15:00', '2025-12-07 16:45:00', NULL, NULL, 'scheduled', 1, 10, 16, 8900.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 13350.00),
(102, 'PR2512', '2025-12-07 15:30:00', '2025-12-07 19:00:00', NULL, NULL, 'scheduled', 1, 12, 16, 9100.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 13650.00),
(103, 'PR2513', '2025-12-05 13:00:00', '2025-12-05 18:00:00', NULL, NULL, 'scheduled', 1, 1, 19, 12500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 18750.00),
(104, 'PR2514', '2025-12-05 15:15:00', '2025-12-05 20:15:00', NULL, NULL, 'scheduled', 1, 11, 19, 13200.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 19800.00),
(105, 'PR2515', '2025-12-06 13:30:00', '2025-12-06 18:30:00', NULL, NULL, 'scheduled', 1, 14, 19, 12900.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 19350.00),
(106, 'PR2516', '2025-12-06 14:45:00', '2025-12-06 19:45:00', NULL, NULL, 'scheduled', 1, 15, 19, 13100.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 19650.00),
(107, 'PR2517', '2025-12-07 13:00:00', '2025-12-07 18:00:00', NULL, NULL, 'scheduled', 1, 17, 19, 12800.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 19200.00),
(108, 'PR2518', '2025-12-07 15:00:00', '2025-12-07 20:00:00', NULL, NULL, 'scheduled', 1, 21, 19, 13400.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 20100.00),
(109, 'PR2519', '2025-12-05 13:00:00', '2025-12-06 05:00:00', NULL, NULL, 'scheduled', 1, 1, 20, 42000.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 63000.00),
(110, 'PR2520', '2025-12-05 16:00:00', '2025-12-06 08:00:00', NULL, NULL, 'scheduled', 1, 2, 20, 43500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 65250.00),
(111, 'PR2521', '2025-12-06 13:30:00', '2025-12-06 05:30:00', NULL, NULL, 'scheduled', 1, 3, 20, 44000.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 66000.00),
(112, 'PR2522', '2025-12-07 14:00:00', '2025-12-07 06:00:00', NULL, NULL, 'scheduled', 1, 4, 20, 42500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 63750.00),
(113, 'PR2523', '2025-12-05 13:00:00', '2025-12-05 14:30:00', NULL, NULL, 'scheduled', 1, 1, 2, 2800.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 4200.00),
(114, 'PR2524', '2025-12-05 14:00:00', '2025-12-05 15:30:00', NULL, NULL, 'scheduled', 1, 1, 3, 3200.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 4800.00),
(115, 'PR2525', '2025-12-05 15:30:00', '2025-12-05 17:00:00', NULL, NULL, 'scheduled', 1, 1, 4, 2900.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 4350.00),
(116, 'PR2526', '2025-12-06 13:00:00', '2025-12-06 14:30:00', NULL, NULL, 'scheduled', 1, 2, 1, 2800.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 4200.00),
(117, 'PR2527', '2025-12-06 14:00:00', '2025-12-06 15:30:00', NULL, NULL, 'scheduled', 1, 3, 1, 3200.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 4800.00),
(118, 'PR2528', '2025-12-06 15:00:00', '2025-12-06 16:30:00', NULL, NULL, 'scheduled', 1, 4, 1, 2900.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 4350.00),
(119, 'PR2529', '2025-12-07 13:15:00', '2025-12-07 14:45:00', NULL, NULL, 'scheduled', 1, 5, 1, 3100.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 4650.00),
(120, 'PR2530', '2025-12-07 14:30:00', '2025-12-07 16:00:00', NULL, NULL, 'scheduled', 1, 6, 1, 3000.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 4500.00),
(121, 'PR2531', '2025-12-07 15:15:00', '2025-12-07 16:45:00', NULL, NULL, 'scheduled', 1, 12, 1, 3300.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 4950.00),
(122, 'AA2501', '2025-12-05 13:00:00', '2025-12-06 16:00:00', NULL, NULL, 'scheduled', 2, 20, 1, 42000.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 63000.00),
(123, 'AA2502', '2025-12-05 15:00:00', '2025-12-06 18:00:00', NULL, NULL, 'scheduled', 2, 20, 2, 43500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 65250.00),
(124, 'AA2503', '2025-12-06 13:30:00', '2025-12-07 16:30:00', NULL, NULL, 'scheduled', 2, 20, 3, 44000.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 66000.00),
(125, 'AA2504', '2025-12-07 14:00:00', '2025-12-08 17:00:00', NULL, NULL, 'scheduled', 2, 20, 4, 42500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 63750.00),
(126, 'AA2505', '2025-12-05 13:00:00', '2025-12-07 07:00:00', NULL, NULL, 'scheduled', 2, 20, 16, 39000.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 58500.00),
(127, 'AA2506', '2025-12-06 14:00:00', '2025-12-08 08:00:00', NULL, NULL, 'scheduled', 2, 20, 16, 40000.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 60000.00),
(128, 'AA2507', '2025-12-05 13:00:00', '2025-12-06 17:00:00', NULL, NULL, 'scheduled', 2, 20, 18, 38000.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 57000.00),
(129, 'AA2508', '2025-12-06 15:00:00', '2025-12-07 19:00:00', NULL, NULL, 'scheduled', 2, 20, 18, 39000.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 58500.00),
(130, 'AA2509', '2025-12-05 13:00:00', '2025-12-06 15:00:00', NULL, NULL, 'scheduled', 2, 20, 19, 37000.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 55500.00),
(131, 'AA2510', '2025-12-07 14:00:00', '2025-12-08 16:00:00', NULL, NULL, 'scheduled', 2, 20, 19, 38000.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 57000.00),
(132, 'JL2501', '2025-12-05 13:00:00', '2025-12-05 19:30:00', NULL, NULL, 'scheduled', 3, 18, 1, 15500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 23250.00),
(133, 'JL2502', '2025-12-05 14:30:00', '2025-12-05 21:00:00', NULL, NULL, 'scheduled', 3, 18, 2, 16200.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 24300.00),
(134, 'JL2503', '2025-12-06 13:15:00', '2025-12-06 19:45:00', NULL, NULL, 'scheduled', 3, 18, 3, 17000.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 25500.00),
(135, 'JL2504', '2025-12-06 14:00:00', '2025-12-06 20:30:00', NULL, NULL, 'scheduled', 3, 18, 4, 15800.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 23700.00),
(136, 'JL2505', '2025-12-07 13:00:00', '2025-12-07 19:30:00', NULL, NULL, 'scheduled', 3, 18, 5, 16500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 24750.00),
(137, 'JL2506', '2025-12-07 14:45:00', '2025-12-07 21:15:00', NULL, NULL, 'scheduled', 3, 18, 6, 15900.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 23850.00),
(138, 'JL2507', '2025-12-05 13:00:00', '2025-12-05 16:30:00', NULL, NULL, 'scheduled', 3, 18, 16, 8200.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 12300.00),
(139, 'JL2508', '2025-12-06 14:00:00', '2025-12-06 17:30:00', NULL, NULL, 'scheduled', 3, 18, 16, 8500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 12750.00),
(140, 'JL2509', '2025-12-07 13:30:00', '2025-12-07 17:00:00', NULL, NULL, 'scheduled', 3, 18, 16, 8400.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 12600.00),
(141, 'JL2510', '2025-12-05 13:00:00', '2025-12-05 15:00:00', NULL, NULL, 'scheduled', 3, 18, 19, 4500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 6750.00),
(142, 'JL2511', '2025-12-06 14:30:00', '2025-12-06 16:30:00', NULL, NULL, 'scheduled', 3, 18, 19, 4800.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 7200.00),
(143, 'JL2512', '2025-12-07 13:15:00', '2025-12-07 15:15:00', NULL, NULL, 'scheduled', 3, 18, 19, 4700.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 7050.00),
(144, 'SQ2501', '2025-12-05 13:30:00', '2025-12-05 17:00:00', NULL, NULL, 'scheduled', 4, 16, 1, 8500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 12750.00),
(145, 'SQ2502', '2025-12-05 15:00:00', '2025-12-05 18:30:00', NULL, NULL, 'scheduled', 4, 16, 2, 9200.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 13800.00),
(146, 'SQ2503', '2025-12-06 13:45:00', '2025-12-06 17:15:00', NULL, NULL, 'scheduled', 4, 16, 3, 8800.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 13200.00),
(147, 'SQ2504', '2025-12-06 14:30:00', '2025-12-06 18:00:00', NULL, NULL, 'scheduled', 4, 16, 4, 9500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 14250.00),
(148, 'SQ2505', '2025-12-07 13:15:00', '2025-12-07 16:45:00', NULL, NULL, 'scheduled', 4, 16, 5, 8900.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 13350.00),
(149, 'SQ2506', '2025-12-07 15:30:00', '2025-12-07 19:00:00', NULL, NULL, 'scheduled', 4, 16, 6, 9100.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 13650.00),
(150, 'SQ2507', '2025-12-05 13:00:00', '2025-12-05 16:30:00', NULL, NULL, 'scheduled', 4, 16, 18, 8200.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 12300.00),
(151, 'SQ2508', '2025-12-06 14:00:00', '2025-12-06 17:30:00', NULL, NULL, 'scheduled', 4, 16, 18, 8500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 12750.00),
(152, 'SQ2509', '2025-12-07 13:30:00', '2025-12-07 17:00:00', NULL, NULL, 'scheduled', 4, 16, 18, 8400.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 12600.00),
(153, 'SQ2510', '2025-12-05 13:00:00', '2025-12-05 15:00:00', NULL, NULL, 'scheduled', 4, 16, 19, 4500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 6750.00),
(154, 'SQ2511', '2025-12-06 14:30:00', '2025-12-06 16:30:00', NULL, NULL, 'scheduled', 4, 16, 19, 4800.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 7200.00),
(155, 'SQ2512', '2025-12-07 13:15:00', '2025-12-07 15:15:00', NULL, NULL, 'scheduled', 4, 16, 19, 4700.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 7050.00),
(156, 'KE2501', '2025-12-05 13:00:00', '2025-12-05 18:00:00', NULL, NULL, 'scheduled', 5, 19, 1, 12500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 18750.00),
(157, 'KE2502', '2025-12-05 15:15:00', '2025-12-05 20:15:00', NULL, NULL, 'scheduled', 5, 19, 2, 13200.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 19800.00),
(158, 'KE2503', '2025-12-06 13:30:00', '2025-12-06 18:30:00', NULL, NULL, 'scheduled', 5, 19, 3, 12900.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 19350.00),
(159, 'KE2504', '2025-12-06 14:45:00', '2025-12-06 19:45:00', NULL, NULL, 'scheduled', 5, 19, 4, 13100.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 19650.00),
(160, 'KE2505', '2025-12-07 13:00:00', '2025-12-07 18:00:00', NULL, NULL, 'scheduled', 5, 19, 5, 12800.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 19200.00),
(161, 'KE2506', '2025-12-07 15:00:00', '2025-12-07 20:00:00', NULL, NULL, 'scheduled', 5, 19, 6, 13400.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 20100.00),
(162, 'KE2507', '2025-12-05 13:00:00', '2025-12-05 15:00:00', NULL, NULL, 'scheduled', 5, 19, 18, 4500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 6750.00),
(163, 'KE2508', '2025-12-06 14:30:00', '2025-12-06 16:30:00', NULL, NULL, 'scheduled', 5, 19, 18, 4800.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 7200.00),
(164, 'KE2509', '2025-12-07 13:15:00', '2025-12-07 15:15:00', NULL, NULL, 'scheduled', 5, 19, 18, 4700.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 7050.00),
(165, 'KE2510', '2025-12-05 13:00:00', '2025-12-05 15:00:00', NULL, NULL, 'scheduled', 5, 19, 16, 4500.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 6750.00),
(166, 'KE2511', '2025-12-06 14:30:00', '2025-12-06 16:30:00', NULL, NULL, 'scheduled', 5, 19, 16, 4800.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 7200.00),
(167, 'KE2512', '2025-12-07 13:15:00', '2025-12-07 15:15:00', NULL, NULL, 'scheduled', 5, 19, 16, 4700.00, '2025-12-04 12:50:45', '2025-12-04 12:50:45', 7050.00),
(168, 'PR2401', '2025-12-05 05:00:00', '2025-12-05 06:45:00', NULL, NULL, 'scheduled', 1, 1, 12, 2500.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3750.00),
(169, 'PR2402', '2025-12-06 05:30:00', '2025-12-06 07:15:00', NULL, NULL, 'scheduled', 1, 1, 12, 2500.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3750.00),
(170, 'PR2403', '2025-12-07 06:00:00', '2025-12-07 07:45:00', NULL, NULL, 'scheduled', 1, 1, 12, 2500.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3750.00),
(171, 'PR2404', '2025-12-05 07:30:00', '2025-12-05 09:15:00', NULL, NULL, 'scheduled', 1, 12, 1, 2500.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3750.00),
(172, 'PR2405', '2025-12-06 07:45:00', '2025-12-06 09:30:00', NULL, NULL, 'scheduled', 1, 12, 1, 2500.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3750.00),
(173, 'PR2406', '2025-12-07 08:00:00', '2025-12-07 09:45:00', NULL, NULL, 'scheduled', 1, 12, 1, 2500.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3750.00),
(174, 'PR2407', '2025-12-05 05:15:00', '2025-12-05 06:30:00', NULL, NULL, 'scheduled', 1, 1, 15, 2200.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3300.00),
(175, 'PR2408', '2025-12-06 05:45:00', '2025-12-06 07:00:00', NULL, NULL, 'scheduled', 1, 1, 15, 2200.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3300.00),
(176, 'PR2409', '2025-12-07 06:15:00', '2025-12-07 07:30:00', NULL, NULL, 'scheduled', 1, 1, 15, 2200.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3300.00),
(177, 'PR2410', '2025-12-05 07:00:00', '2025-12-05 08:15:00', NULL, NULL, 'scheduled', 1, 15, 1, 2200.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3300.00),
(178, 'PR2411', '2025-12-06 07:30:00', '2025-12-06 08:45:00', NULL, NULL, 'scheduled', 1, 15, 1, 2200.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3300.00),
(179, 'PR2412', '2025-12-07 08:00:00', '2025-12-07 09:15:00', NULL, NULL, 'scheduled', 1, 15, 1, 2200.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3300.00),
(180, 'PR2413', '2025-12-05 05:30:00', '2025-12-05 07:00:00', NULL, NULL, 'scheduled', 1, 1, 14, 2400.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3600.00),
(181, 'PR2414', '2025-12-06 06:00:00', '2025-12-06 07:30:00', NULL, NULL, 'scheduled', 1, 1, 14, 2400.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3600.00),
(182, 'PR2415', '2025-12-07 06:30:00', '2025-12-07 08:00:00', NULL, NULL, 'scheduled', 1, 1, 14, 2400.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3600.00),
(183, 'PR2416', '2025-12-05 07:15:00', '2025-12-05 08:45:00', NULL, NULL, 'scheduled', 1, 14, 1, 2400.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3600.00),
(184, 'PR2417', '2025-12-06 07:45:00', '2025-12-06 09:15:00', NULL, NULL, 'scheduled', 1, 14, 1, 2400.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3600.00),
(185, 'PR2418', '2025-12-07 08:15:00', '2025-12-07 09:45:00', NULL, NULL, 'scheduled', 1, 14, 1, 2400.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3600.00),
(186, 'PR2419', '2025-12-05 05:45:00', '2025-12-05 07:30:00', NULL, NULL, 'scheduled', 1, 1, 9, 3100.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4650.00),
(187, 'PR2420', '2025-12-06 06:15:00', '2025-12-06 08:00:00', NULL, NULL, 'scheduled', 1, 1, 9, 3100.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4650.00),
(188, 'PR2421', '2025-12-07 06:45:00', '2025-12-07 08:30:00', NULL, NULL, 'scheduled', 1, 1, 9, 3100.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4650.00),
(189, 'PR2422', '2025-12-05 08:00:00', '2025-12-05 09:45:00', NULL, NULL, 'scheduled', 1, 9, 1, 3100.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4650.00),
(190, 'PR2423', '2025-12-06 08:30:00', '2025-12-06 10:15:00', NULL, NULL, 'scheduled', 1, 9, 1, 3100.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4650.00),
(191, 'PR2424', '2025-12-07 09:00:00', '2025-12-07 10:45:00', NULL, NULL, 'scheduled', 1, 9, 1, 3100.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4650.00),
(192, 'PR2425', '2025-12-05 06:00:00', '2025-12-05 06:45:00', NULL, NULL, 'scheduled', 1, 1, 11, 1800.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 2700.00),
(193, 'PR2426', '2025-12-06 06:30:00', '2025-12-06 07:15:00', NULL, NULL, 'scheduled', 1, 1, 11, 1800.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 2700.00),
(194, 'PR2427', '2025-12-07 07:00:00', '2025-12-07 07:45:00', NULL, NULL, 'scheduled', 1, 1, 11, 1800.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 2700.00),
(195, 'PR2428', '2025-12-05 07:15:00', '2025-12-05 08:00:00', NULL, NULL, 'scheduled', 1, 11, 1, 1800.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 2700.00),
(196, 'PR2429', '2025-12-06 07:45:00', '2025-12-06 08:30:00', NULL, NULL, 'scheduled', 1, 11, 1, 1800.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 2700.00),
(197, 'PR2430', '2025-12-07 08:15:00', '2025-12-07 09:00:00', NULL, NULL, 'scheduled', 1, 11, 1, 1800.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 2700.00),
(198, 'PR2431', '2025-12-05 06:15:00', '2025-12-05 08:00:00', NULL, NULL, 'scheduled', 1, 1, 10, 2900.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4350.00),
(199, 'PR2432', '2025-12-06 06:45:00', '2025-12-06 08:30:00', NULL, NULL, 'scheduled', 1, 1, 10, 2900.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4350.00),
(200, 'PR2433', '2025-12-07 07:15:00', '2025-12-07 09:00:00', NULL, NULL, 'scheduled', 1, 1, 10, 2900.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4350.00),
(201, 'PR2434', '2025-12-05 08:30:00', '2025-12-05 10:15:00', NULL, NULL, 'scheduled', 1, 10, 1, 2900.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4350.00),
(202, 'PR2435', '2025-12-06 09:00:00', '2025-12-06 10:45:00', NULL, NULL, 'scheduled', 1, 10, 1, 2900.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4350.00),
(203, 'PR2436', '2025-12-07 09:30:00', '2025-12-07 11:15:00', NULL, NULL, 'scheduled', 1, 10, 1, 2900.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4350.00),
(204, 'PR2437', '2025-12-05 06:30:00', '2025-12-05 08:00:00', NULL, NULL, 'scheduled', 1, 1, 7, 2700.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4050.00),
(205, 'PR2438', '2025-12-06 07:00:00', '2025-12-06 08:30:00', NULL, NULL, 'scheduled', 1, 1, 7, 2700.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4050.00),
(206, 'PR2439', '2025-12-07 07:30:00', '2025-12-07 09:00:00', NULL, NULL, 'scheduled', 1, 1, 7, 2700.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4050.00),
(207, 'PR2440', '2025-12-05 08:15:00', '2025-12-05 09:45:00', NULL, NULL, 'scheduled', 1, 7, 1, 2700.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4050.00),
(208, 'PR2441', '2025-12-06 08:45:00', '2025-12-06 10:15:00', NULL, NULL, 'scheduled', 1, 7, 1, 2700.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4050.00),
(209, 'PR2442', '2025-12-07 09:15:00', '2025-12-07 10:45:00', NULL, NULL, 'scheduled', 1, 7, 1, 2700.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 4050.00),
(210, 'PR2443', '2025-12-05 06:45:00', '2025-12-05 08:15:00', NULL, NULL, 'scheduled', 1, 1, 8, 2600.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3900.00),
(211, 'PR2444', '2025-12-06 07:15:00', '2025-12-06 08:45:00', NULL, NULL, 'scheduled', 1, 1, 8, 2600.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3900.00),
(212, 'PR2445', '2025-12-07 07:45:00', '2025-12-07 09:15:00', NULL, NULL, 'scheduled', 1, 1, 8, 2600.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3900.00),
(213, 'PR2446', '2025-12-05 08:45:00', '2025-12-05 10:15:00', NULL, NULL, 'scheduled', 1, 8, 1, 2600.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3900.00),
(214, 'PR2447', '2025-12-06 09:00:00', '2025-12-06 10:30:00', NULL, NULL, 'scheduled', 1, 8, 1, 2600.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3900.00),
(215, 'PR2448', '2025-12-07 09:30:00', '2025-12-07 11:00:00', NULL, NULL, 'scheduled', 1, 8, 1, 2600.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 3900.00),
(216, 'AA2511', '2025-12-05 05:00:00', '2025-12-06 01:00:00', NULL, NULL, 'scheduled', 2, 20, 17, 35000.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 52500.00),
(217, 'AA2512', '2025-12-07 06:00:00', '2025-12-08 02:00:00', NULL, NULL, 'scheduled', 2, 20, 17, 36000.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 54000.00),
(218, 'AA2513', '2025-12-05 05:00:00', '2025-12-06 03:00:00', NULL, NULL, 'scheduled', 2, 20, 21, 38000.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 57000.00),
(219, 'AA2514', '2025-12-06 07:00:00', '2025-12-07 05:00:00', NULL, NULL, 'scheduled', 2, 20, 21, 38500.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 57750.00),
(220, 'JL2513', '2025-12-05 05:00:00', '2025-12-05 07:00:00', NULL, NULL, 'scheduled', 3, 18, 17, 12500.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 18750.00),
(221, 'JL2514', '2025-12-06 06:30:00', '2025-12-06 08:30:00', NULL, NULL, 'scheduled', 3, 18, 17, 12800.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 19200.00),
(222, 'JL2515', '2025-12-07 05:15:00', '2025-12-07 07:15:00', NULL, NULL, 'scheduled', 3, 18, 17, 12700.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 19050.00),
(223, 'JL2516', '2025-12-05 05:00:00', '2025-12-05 06:30:00', NULL, NULL, 'scheduled', 3, 18, 21, 9500.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 14250.00),
(224, 'JL2517', '2025-12-06 06:00:00', '2025-12-06 07:30:00', NULL, NULL, 'scheduled', 3, 18, 21, 9800.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 14700.00),
(225, 'JL2518', '2025-12-07 05:30:00', '2025-12-07 07:00:00', NULL, NULL, 'scheduled', 3, 18, 21, 9700.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 14550.00),
(226, 'SQ2513', '2025-12-05 05:00:00', '2025-12-05 06:30:00', NULL, NULL, 'scheduled', 4, 16, 17, 8500.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 12750.00),
(227, 'SQ2514', '2025-12-06 06:30:00', '2025-12-06 08:00:00', NULL, NULL, 'scheduled', 4, 16, 17, 8800.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 13200.00),
(228, 'SQ2515', '2025-12-07 05:15:00', '2025-12-07 06:45:00', NULL, NULL, 'scheduled', 4, 16, 17, 8700.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 13050.00),
(229, 'SQ2516', '2025-12-05 05:00:00', '2025-12-05 07:30:00', NULL, NULL, 'scheduled', 4, 16, 21, 6500.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 9750.00),
(230, 'SQ2517', '2025-12-06 06:00:00', '2025-12-06 08:30:00', NULL, NULL, 'scheduled', 4, 16, 21, 6800.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 10200.00),
(231, 'SQ2518', '2025-12-07 05:30:00', '2025-12-07 08:00:00', NULL, NULL, 'scheduled', 4, 16, 21, 6700.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 10050.00),
(232, 'KE2513', '2025-12-05 05:00:00', '2025-12-05 06:30:00', NULL, NULL, 'scheduled', 5, 19, 17, 8200.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 12300.00),
(233, 'KE2514', '2025-12-06 06:30:00', '2025-12-06 08:00:00', NULL, NULL, 'scheduled', 5, 19, 17, 8500.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 12750.00),
(234, 'KE2515', '2025-12-07 05:15:00', '2025-12-07 06:45:00', NULL, NULL, 'scheduled', 5, 19, 17, 8400.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 12600.00),
(235, 'KE2516', '2025-12-05 05:00:00', '2025-12-05 06:30:00', NULL, NULL, 'scheduled', 5, 19, 21, 5500.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 8250.00),
(236, 'KE2517', '2025-12-06 06:30:00', '2025-12-06 08:00:00', NULL, NULL, 'scheduled', 5, 19, 21, 5800.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 8700.00),
(237, 'KE2518', '2025-12-07 05:15:00', '2025-12-07 06:45:00', NULL, NULL, 'scheduled', 5, 19, 21, 5700.00, '2025-12-04 05:08:53', '2025-12-04 05:08:53', 8550.00),
(238, 'PR2401', '2025-12-05 05:00:00', '2025-12-05 06:45:00', NULL, NULL, 'scheduled', 1, 1, 12, 2500.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3750.00),
(239, 'PR2402', '2025-12-06 05:30:00', '2025-12-06 07:15:00', NULL, NULL, 'scheduled', 1, 1, 12, 2500.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3750.00),
(240, 'PR2403', '2025-12-07 06:00:00', '2025-12-07 07:45:00', NULL, NULL, 'scheduled', 1, 1, 12, 2500.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3750.00),
(241, 'PR2404', '2025-12-05 07:30:00', '2025-12-05 09:15:00', NULL, NULL, 'scheduled', 1, 12, 1, 2500.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3750.00),
(242, 'PR2405', '2025-12-06 07:45:00', '2025-12-06 09:30:00', NULL, NULL, 'scheduled', 1, 12, 1, 2500.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3750.00),
(243, 'PR2406', '2025-12-07 08:00:00', '2025-12-07 09:45:00', NULL, NULL, 'scheduled', 1, 12, 1, 2500.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3750.00),
(244, 'PR2407', '2025-12-05 05:15:00', '2025-12-05 06:30:00', NULL, NULL, 'scheduled', 1, 1, 15, 2200.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3300.00),
(245, 'PR2408', '2025-12-06 05:45:00', '2025-12-06 07:00:00', NULL, NULL, 'scheduled', 1, 1, 15, 2200.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3300.00),
(246, 'PR2409', '2025-12-07 06:15:00', '2025-12-07 07:30:00', NULL, NULL, 'scheduled', 1, 1, 15, 2200.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3300.00),
(247, 'PR2410', '2025-12-05 07:00:00', '2025-12-05 08:15:00', NULL, NULL, 'scheduled', 1, 15, 1, 2200.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3300.00),
(248, 'PR2411', '2025-12-06 07:30:00', '2025-12-06 08:45:00', NULL, NULL, 'scheduled', 1, 15, 1, 2200.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3300.00),
(249, 'PR2412', '2025-12-07 08:00:00', '2025-12-07 09:15:00', NULL, NULL, 'scheduled', 1, 15, 1, 2200.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3300.00),
(250, 'PR2413', '2025-12-05 05:30:00', '2025-12-05 07:00:00', NULL, NULL, 'scheduled', 1, 1, 14, 2400.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3600.00),
(251, 'PR2414', '2025-12-06 06:00:00', '2025-12-06 07:30:00', NULL, NULL, 'scheduled', 1, 1, 14, 2400.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3600.00),
(252, 'PR2415', '2025-12-07 06:30:00', '2025-12-07 08:00:00', NULL, NULL, 'scheduled', 1, 1, 14, 2400.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3600.00),
(253, 'PR2416', '2025-12-05 07:15:00', '2025-12-05 08:45:00', NULL, NULL, 'scheduled', 1, 14, 1, 2400.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3600.00),
(254, 'PR2417', '2025-12-06 07:45:00', '2025-12-06 09:15:00', NULL, NULL, 'scheduled', 1, 14, 1, 2400.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3600.00),
(255, 'PR2418', '2025-12-07 08:15:00', '2025-12-07 09:45:00', NULL, NULL, 'scheduled', 1, 14, 1, 2400.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3600.00),
(256, 'PR2419', '2025-12-05 05:45:00', '2025-12-05 07:30:00', NULL, NULL, 'scheduled', 1, 1, 9, 3100.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4650.00),
(257, 'PR2420', '2025-12-06 06:15:00', '2025-12-06 08:00:00', NULL, NULL, 'scheduled', 1, 1, 9, 3100.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4650.00),
(258, 'PR2421', '2025-12-07 06:45:00', '2025-12-07 08:30:00', NULL, NULL, 'scheduled', 1, 1, 9, 3100.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4650.00),
(259, 'PR2422', '2025-12-05 08:00:00', '2025-12-05 09:45:00', NULL, NULL, 'scheduled', 1, 9, 1, 3100.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4650.00),
(260, 'PR2423', '2025-12-06 08:30:00', '2025-12-06 10:15:00', NULL, NULL, 'scheduled', 1, 9, 1, 3100.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4650.00),
(261, 'PR2424', '2025-12-07 09:00:00', '2025-12-07 10:45:00', NULL, NULL, 'scheduled', 1, 9, 1, 3100.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4650.00),
(262, 'PR2425', '2025-12-05 06:00:00', '2025-12-05 06:45:00', NULL, NULL, 'scheduled', 1, 1, 11, 1800.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 2700.00),
(263, 'PR2426', '2025-12-06 06:30:00', '2025-12-06 07:15:00', NULL, NULL, 'scheduled', 1, 1, 11, 1800.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 2700.00),
(264, 'PR2427', '2025-12-07 07:00:00', '2025-12-07 07:45:00', NULL, NULL, 'scheduled', 1, 1, 11, 1800.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 2700.00),
(265, 'PR2428', '2025-12-05 07:15:00', '2025-12-05 08:00:00', NULL, NULL, 'scheduled', 1, 11, 1, 1800.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 2700.00),
(266, 'PR2429', '2025-12-06 07:45:00', '2025-12-06 08:30:00', NULL, NULL, 'scheduled', 1, 11, 1, 1800.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 2700.00),
(267, 'PR2430', '2025-12-07 08:15:00', '2025-12-07 09:00:00', NULL, NULL, 'scheduled', 1, 11, 1, 1800.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 2700.00),
(268, 'PR2431', '2025-12-05 06:15:00', '2025-12-05 08:00:00', NULL, NULL, 'scheduled', 1, 1, 10, 2900.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4350.00),
(269, 'PR2432', '2025-12-06 06:45:00', '2025-12-06 08:30:00', NULL, NULL, 'scheduled', 1, 1, 10, 2900.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4350.00),
(270, 'PR2433', '2025-12-07 07:15:00', '2025-12-07 09:00:00', NULL, NULL, 'scheduled', 1, 1, 10, 2900.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4350.00),
(271, 'PR2434', '2025-12-05 08:30:00', '2025-12-05 10:15:00', NULL, NULL, 'scheduled', 1, 10, 1, 2900.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4350.00),
(272, 'PR2435', '2025-12-06 09:00:00', '2025-12-06 10:45:00', NULL, NULL, 'scheduled', 1, 10, 1, 2900.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4350.00),
(273, 'PR2436', '2025-12-07 09:30:00', '2025-12-07 11:15:00', NULL, NULL, 'scheduled', 1, 10, 1, 2900.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4350.00),
(274, 'PR2437', '2025-12-05 06:30:00', '2025-12-05 08:00:00', NULL, NULL, 'scheduled', 1, 1, 7, 2700.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4050.00),
(275, 'PR2438', '2025-12-06 07:00:00', '2025-12-06 08:30:00', NULL, NULL, 'scheduled', 1, 1, 7, 2700.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4050.00),
(276, 'PR2439', '2025-12-07 07:30:00', '2025-12-07 09:00:00', NULL, NULL, 'scheduled', 1, 1, 7, 2700.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4050.00),
(277, 'PR2440', '2025-12-05 08:15:00', '2025-12-05 09:45:00', NULL, NULL, 'scheduled', 1, 7, 1, 2700.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4050.00),
(278, 'PR2441', '2025-12-06 08:45:00', '2025-12-06 10:15:00', NULL, NULL, 'scheduled', 1, 7, 1, 2700.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4050.00),
(279, 'PR2442', '2025-12-07 09:15:00', '2025-12-07 10:45:00', NULL, NULL, 'scheduled', 1, 7, 1, 2700.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 4050.00),
(280, 'PR2443', '2025-12-05 06:45:00', '2025-12-05 08:15:00', NULL, NULL, 'scheduled', 1, 1, 8, 2600.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3900.00),
(281, 'PR2444', '2025-12-06 07:15:00', '2025-12-06 08:45:00', NULL, NULL, 'scheduled', 1, 1, 8, 2600.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3900.00),
(282, 'PR2445', '2025-12-07 07:45:00', '2025-12-07 09:15:00', NULL, NULL, 'scheduled', 1, 1, 8, 2600.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3900.00),
(283, 'PR2446', '2025-12-05 08:45:00', '2025-12-05 10:15:00', NULL, NULL, 'scheduled', 1, 8, 1, 2600.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3900.00),
(284, 'PR2447', '2025-12-06 09:00:00', '2025-12-06 10:30:00', NULL, NULL, 'scheduled', 1, 8, 1, 2600.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3900.00),
(285, 'PR2448', '2025-12-07 09:30:00', '2025-12-07 11:00:00', NULL, NULL, 'scheduled', 1, 8, 1, 2600.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 3900.00),
(286, 'AA2511', '2025-12-05 05:00:00', '2025-12-06 01:00:00', NULL, NULL, 'scheduled', 2, 20, 17, 35000.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 52500.00),
(287, 'AA2512', '2025-12-07 06:00:00', '2025-12-08 02:00:00', NULL, NULL, 'scheduled', 2, 20, 17, 36000.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 54000.00),
(288, 'AA2513', '2025-12-05 05:00:00', '2025-12-06 03:00:00', NULL, NULL, 'scheduled', 2, 20, 21, 38000.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 57000.00),
(289, 'AA2514', '2025-12-06 07:00:00', '2025-12-07 05:00:00', NULL, NULL, 'scheduled', 2, 20, 21, 38500.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 57750.00),
(290, 'JL2513', '2025-12-05 05:00:00', '2025-12-05 07:00:00', NULL, NULL, 'scheduled', 3, 18, 17, 12500.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 18750.00),
(291, 'JL2514', '2025-12-06 06:30:00', '2025-12-06 08:30:00', NULL, NULL, 'scheduled', 3, 18, 17, 12800.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 19200.00),
(292, 'JL2515', '2025-12-07 05:15:00', '2025-12-07 07:15:00', NULL, NULL, 'scheduled', 3, 18, 17, 12700.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 19050.00),
(293, 'JL2516', '2025-12-05 05:00:00', '2025-12-05 06:30:00', NULL, NULL, 'scheduled', 3, 18, 21, 9500.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 14250.00),
(294, 'JL2517', '2025-12-06 06:00:00', '2025-12-06 07:30:00', NULL, NULL, 'scheduled', 3, 18, 21, 9800.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 14700.00),
(295, 'JL2518', '2025-12-07 05:30:00', '2025-12-07 07:00:00', NULL, NULL, 'scheduled', 3, 18, 21, 9700.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 14550.00),
(296, 'SQ2513', '2025-12-05 05:00:00', '2025-12-05 06:30:00', NULL, NULL, 'scheduled', 4, 16, 17, 8500.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 12750.00),
(297, 'SQ2514', '2025-12-06 06:30:00', '2025-12-06 08:00:00', NULL, NULL, 'scheduled', 4, 16, 17, 8800.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 13200.00),
(298, 'SQ2515', '2025-12-07 05:15:00', '2025-12-07 06:45:00', NULL, NULL, 'scheduled', 4, 16, 17, 8700.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 13050.00),
(299, 'SQ2516', '2025-12-05 05:00:00', '2025-12-05 07:30:00', NULL, NULL, 'scheduled', 4, 16, 21, 6500.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 9750.00),
(300, 'SQ2517', '2025-12-06 06:00:00', '2025-12-06 08:30:00', NULL, NULL, 'scheduled', 4, 16, 21, 6800.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 10200.00),
(301, 'SQ2518', '2025-12-07 05:30:00', '2025-12-07 08:00:00', NULL, NULL, 'scheduled', 4, 16, 21, 6700.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 10050.00),
(302, 'KE2513', '2025-12-05 05:00:00', '2025-12-05 06:30:00', NULL, NULL, 'scheduled', 5, 19, 17, 8200.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 12300.00),
(303, 'KE2514', '2025-12-06 06:30:00', '2025-12-06 08:00:00', NULL, NULL, 'scheduled', 5, 19, 17, 8500.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 12750.00),
(304, 'KE2515', '2025-12-07 05:15:00', '2025-12-07 06:45:00', NULL, NULL, 'scheduled', 5, 19, 17, 8400.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 12600.00),
(305, 'KE2516', '2025-12-05 05:00:00', '2025-12-05 06:30:00', NULL, NULL, 'scheduled', 5, 19, 21, 5500.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 8250.00),
(306, 'KE2517', '2025-12-06 06:30:00', '2025-12-06 08:00:00', NULL, NULL, 'scheduled', 5, 19, 21, 5800.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 8700.00),
(307, 'KE2518', '2025-12-07 05:15:00', '2025-12-07 06:45:00', NULL, NULL, 'scheduled', 5, 19, 21, 5700.00, '2025-12-04 05:09:34', '2025-12-04 05:09:34', 8550.00),
(308, 'PR2401', '2025-12-05 05:00:00', '2025-12-05 06:45:00', NULL, NULL, 'scheduled', 1, 1, 12, 2500.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3750.00),
(309, 'PR2402', '2025-12-06 05:30:00', '2025-12-06 07:15:00', NULL, NULL, 'scheduled', 1, 1, 12, 2500.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3750.00);
INSERT INTO `flights` (`id`, `flight_number`, `scheduled_departure`, `scheduled_arrival`, `actual_departure`, `actual_arrival`, `status`, `airline_id`, `departure_airport_id`, `arrival_airport_id`, `base_price`, `created_at`, `updated_at`, `business_price`) VALUES
(310, 'PR2403', '2025-12-07 06:00:00', '2025-12-07 07:45:00', NULL, NULL, 'scheduled', 1, 1, 12, 2500.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3750.00),
(311, 'PR2404', '2025-12-05 07:30:00', '2025-12-05 09:15:00', NULL, NULL, 'scheduled', 1, 12, 1, 2500.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3750.00),
(312, 'PR2405', '2025-12-06 07:45:00', '2025-12-06 09:30:00', NULL, NULL, 'scheduled', 1, 12, 1, 2500.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3750.00),
(313, 'PR2406', '2025-12-07 08:00:00', '2025-12-07 09:45:00', NULL, NULL, 'scheduled', 1, 12, 1, 2500.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3750.00),
(314, 'PR2407', '2025-12-05 05:15:00', '2025-12-05 06:30:00', NULL, NULL, 'scheduled', 1, 1, 15, 2200.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3300.00),
(315, 'PR2408', '2025-12-06 05:45:00', '2025-12-06 07:00:00', NULL, NULL, 'scheduled', 1, 1, 15, 2200.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3300.00),
(316, 'PR2409', '2025-12-07 06:15:00', '2025-12-07 07:30:00', NULL, NULL, 'scheduled', 1, 1, 15, 2200.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3300.00),
(317, 'PR2410', '2025-12-05 07:00:00', '2025-12-05 08:15:00', NULL, NULL, 'scheduled', 1, 15, 1, 2200.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3300.00),
(318, 'PR2411', '2025-12-06 07:30:00', '2025-12-06 08:45:00', NULL, NULL, 'scheduled', 1, 15, 1, 2200.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3300.00),
(319, 'PR2412', '2025-12-07 08:00:00', '2025-12-07 09:15:00', NULL, NULL, 'scheduled', 1, 15, 1, 2200.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3300.00),
(320, 'PR2413', '2025-12-05 05:30:00', '2025-12-05 07:00:00', NULL, NULL, 'scheduled', 1, 1, 14, 2400.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3600.00),
(321, 'PR2414', '2025-12-06 06:00:00', '2025-12-06 07:30:00', NULL, NULL, 'scheduled', 1, 1, 14, 2400.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3600.00),
(322, 'PR2415', '2025-12-07 06:30:00', '2025-12-07 08:00:00', NULL, NULL, 'scheduled', 1, 1, 14, 2400.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3600.00),
(323, 'PR2416', '2025-12-05 07:15:00', '2025-12-05 08:45:00', NULL, NULL, 'scheduled', 1, 14, 1, 2400.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3600.00),
(324, 'PR2417', '2025-12-06 07:45:00', '2025-12-06 09:15:00', NULL, NULL, 'scheduled', 1, 14, 1, 2400.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3600.00),
(325, 'PR2418', '2025-12-07 08:15:00', '2025-12-07 09:45:00', NULL, NULL, 'scheduled', 1, 14, 1, 2400.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3600.00),
(326, 'PR2419', '2025-12-05 05:45:00', '2025-12-05 07:30:00', NULL, NULL, 'scheduled', 1, 1, 9, 3100.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4650.00),
(327, 'PR2420', '2025-12-06 06:15:00', '2025-12-06 08:00:00', NULL, NULL, 'scheduled', 1, 1, 9, 3100.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4650.00),
(328, 'PR2421', '2025-12-07 06:45:00', '2025-12-07 08:30:00', NULL, NULL, 'scheduled', 1, 1, 9, 3100.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4650.00),
(329, 'PR2422', '2025-12-05 08:00:00', '2025-12-05 09:45:00', NULL, NULL, 'scheduled', 1, 9, 1, 3100.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4650.00),
(330, 'PR2423', '2025-12-06 08:30:00', '2025-12-06 10:15:00', NULL, NULL, 'scheduled', 1, 9, 1, 3100.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4650.00),
(331, 'PR2424', '2025-12-07 09:00:00', '2025-12-07 10:45:00', NULL, NULL, 'scheduled', 1, 9, 1, 3100.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4650.00),
(332, 'PR2425', '2025-12-05 06:00:00', '2025-12-05 06:45:00', NULL, NULL, 'scheduled', 1, 1, 11, 1800.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 2700.00),
(333, 'PR2426', '2025-12-06 06:30:00', '2025-12-06 07:15:00', NULL, NULL, 'scheduled', 1, 1, 11, 1800.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 2700.00),
(334, 'PR2427', '2025-12-07 07:00:00', '2025-12-07 07:45:00', NULL, NULL, 'scheduled', 1, 1, 11, 1800.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 2700.00),
(335, 'PR2428', '2025-12-05 07:15:00', '2025-12-05 08:00:00', NULL, NULL, 'scheduled', 1, 11, 1, 1800.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 2700.00),
(336, 'PR2429', '2025-12-06 07:45:00', '2025-12-06 08:30:00', NULL, NULL, 'scheduled', 1, 11, 1, 1800.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 2700.00),
(337, 'PR2430', '2025-12-07 08:15:00', '2025-12-07 09:00:00', NULL, NULL, 'scheduled', 1, 11, 1, 1800.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 2700.00),
(338, 'PR2431', '2025-12-05 06:15:00', '2025-12-05 08:00:00', NULL, NULL, 'scheduled', 1, 1, 10, 2900.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4350.00),
(339, 'PR2432', '2025-12-06 06:45:00', '2025-12-06 08:30:00', NULL, NULL, 'scheduled', 1, 1, 10, 2900.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4350.00),
(340, 'PR2433', '2025-12-07 07:15:00', '2025-12-07 09:00:00', NULL, NULL, 'scheduled', 1, 1, 10, 2900.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4350.00),
(341, 'PR2434', '2025-12-05 08:30:00', '2025-12-05 10:15:00', NULL, NULL, 'scheduled', 1, 10, 1, 2900.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4350.00),
(342, 'PR2435', '2025-12-06 09:00:00', '2025-12-06 10:45:00', NULL, NULL, 'scheduled', 1, 10, 1, 2900.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4350.00),
(343, 'PR2436', '2025-12-07 09:30:00', '2025-12-07 11:15:00', NULL, NULL, 'scheduled', 1, 10, 1, 2900.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4350.00),
(344, 'PR2437', '2025-12-05 06:30:00', '2025-12-05 08:00:00', NULL, NULL, 'scheduled', 1, 1, 7, 2700.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4050.00),
(345, 'PR2438', '2025-12-06 07:00:00', '2025-12-06 08:30:00', NULL, NULL, 'scheduled', 1, 1, 7, 2700.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4050.00),
(346, 'PR2439', '2025-12-07 07:30:00', '2025-12-07 09:00:00', NULL, NULL, 'scheduled', 1, 1, 7, 2700.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4050.00),
(347, 'PR2440', '2025-12-05 08:15:00', '2025-12-05 09:45:00', NULL, NULL, 'scheduled', 1, 7, 1, 2700.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4050.00),
(348, 'PR2441', '2025-12-06 08:45:00', '2025-12-06 10:15:00', NULL, NULL, 'scheduled', 1, 7, 1, 2700.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4050.00),
(349, 'PR2442', '2025-12-07 09:15:00', '2025-12-07 10:45:00', NULL, NULL, 'scheduled', 1, 7, 1, 2700.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 4050.00),
(350, 'PR2443', '2025-12-05 06:45:00', '2025-12-05 08:15:00', NULL, NULL, 'scheduled', 1, 1, 8, 2600.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3900.00),
(351, 'PR2444', '2025-12-06 07:15:00', '2025-12-06 08:45:00', NULL, NULL, 'scheduled', 1, 1, 8, 2600.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3900.00),
(352, 'PR2445', '2025-12-07 07:45:00', '2025-12-07 09:15:00', NULL, NULL, 'scheduled', 1, 1, 8, 2600.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3900.00),
(353, 'PR2446', '2025-12-05 08:45:00', '2025-12-05 10:15:00', NULL, NULL, 'scheduled', 1, 8, 1, 2600.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3900.00),
(354, 'PR2447', '2025-12-06 09:00:00', '2025-12-06 10:30:00', NULL, NULL, 'scheduled', 1, 8, 1, 2600.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3900.00),
(355, 'PR2448', '2025-12-07 09:30:00', '2025-12-07 11:00:00', NULL, NULL, 'scheduled', 1, 8, 1, 2600.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 3900.00),
(356, 'AA2511', '2025-12-05 05:00:00', '2025-12-06 01:00:00', NULL, NULL, 'scheduled', 2, 20, 17, 35000.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 52500.00),
(357, 'AA2512', '2025-12-07 06:00:00', '2025-12-08 02:00:00', NULL, NULL, 'scheduled', 2, 20, 17, 36000.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 54000.00),
(358, 'AA2513', '2025-12-05 05:00:00', '2025-12-06 03:00:00', NULL, NULL, 'scheduled', 2, 20, 21, 38000.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 57000.00),
(359, 'AA2514', '2025-12-06 07:00:00', '2025-12-07 05:00:00', NULL, NULL, 'scheduled', 2, 20, 21, 38500.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 57750.00),
(360, 'JL2513', '2025-12-05 05:00:00', '2025-12-05 07:00:00', NULL, NULL, 'scheduled', 3, 18, 17, 12500.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 18750.00),
(361, 'JL2514', '2025-12-06 06:30:00', '2025-12-06 08:30:00', NULL, NULL, 'scheduled', 3, 18, 17, 12800.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 19200.00),
(362, 'JL2515', '2025-12-07 05:15:00', '2025-12-07 07:15:00', NULL, NULL, 'scheduled', 3, 18, 17, 12700.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 19050.00),
(363, 'JL2516', '2025-12-05 05:00:00', '2025-12-05 06:30:00', NULL, NULL, 'scheduled', 3, 18, 21, 9500.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 14250.00),
(364, 'JL2517', '2025-12-06 06:00:00', '2025-12-06 07:30:00', NULL, NULL, 'scheduled', 3, 18, 21, 9800.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 14700.00),
(365, 'JL2518', '2025-12-07 05:30:00', '2025-12-07 07:00:00', NULL, NULL, 'scheduled', 3, 18, 21, 9700.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 14550.00),
(366, 'SQ2513', '2025-12-05 05:00:00', '2025-12-05 06:30:00', NULL, NULL, 'scheduled', 4, 16, 17, 8500.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 12750.00),
(367, 'SQ2514', '2025-12-06 06:30:00', '2025-12-06 08:00:00', NULL, NULL, 'scheduled', 4, 16, 17, 8800.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 13200.00),
(368, 'SQ2515', '2025-12-07 05:15:00', '2025-12-07 06:45:00', NULL, NULL, 'scheduled', 4, 16, 17, 8700.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 13050.00),
(369, 'SQ2516', '2025-12-05 05:00:00', '2025-12-05 07:30:00', NULL, NULL, 'scheduled', 4, 16, 21, 6500.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 9750.00),
(370, 'SQ2517', '2025-12-06 06:00:00', '2025-12-06 08:30:00', NULL, NULL, 'scheduled', 4, 16, 21, 6800.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 10200.00),
(371, 'SQ2518', '2025-12-07 05:30:00', '2025-12-07 08:00:00', NULL, NULL, 'scheduled', 4, 16, 21, 6700.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 10050.00),
(372, 'KE2513', '2025-12-05 05:00:00', '2025-12-05 06:30:00', NULL, NULL, 'scheduled', 5, 19, 17, 8200.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 12300.00),
(373, 'KE2514', '2025-12-06 06:30:00', '2025-12-06 08:00:00', NULL, NULL, 'scheduled', 5, 19, 17, 8500.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 12750.00),
(374, 'KE2515', '2025-12-07 05:15:00', '2025-12-07 06:45:00', NULL, NULL, 'scheduled', 5, 19, 17, 8400.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 12600.00),
(375, 'KE2516', '2025-12-05 05:00:00', '2025-12-05 06:30:00', NULL, NULL, 'scheduled', 5, 19, 21, 5500.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 8250.00),
(376, 'KE2517', '2025-12-06 06:30:00', '2025-12-06 08:00:00', NULL, NULL, 'scheduled', 5, 19, 21, 5800.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 8700.00),
(377, 'KE2518', '2025-12-07 05:15:00', '2025-12-07 06:45:00', NULL, NULL, 'scheduled', 5, 19, 21, 5700.00, '2025-12-04 05:11:17', '2025-12-04 05:11:17', 8550.00);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_22_145432_add_two_factor_columns_to_users_table', 1),
(5, '2025_11_23_000001_add_profile_photo_to_users_table', 2),
(6, '2025_11_23_000002_add_image_to_flights_table', 3),
(7, '2025_11_24_000001_add_usertype_to_users_table', 4),
(8, '2025_11_25_111258_update_aviation_tables', 5),
(9, '2025_11_26_000002_add_business_price_to_flights_table', 6),
(10, '2025_11_26_000003_add_class_to_bookings_table', 7),
(11, '2025_11_26_000004_add_columns_to_existing_airlines_table', 7),
(12, '2025_12_04_000002_add_flights_to_missing_airports', 8);

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE `passengers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `passport` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`id`, `booking_id`, `name`, `passport`, `date_of_birth`, `created_at`, `updated_at`) VALUES
(1, 1, 'Juan Dela Cruz', 'P123456', '1990-05-12', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(3, 3, 'Pedro Ramos', 'P765432', '1989-01-08', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(5, 5, 'Carlos Reyes', 'P111444', '1992-06-03', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(6, 6, 'Fatima Lim', 'P888999', '1988-07-25', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(7, 7, 'Jose Tan', 'P111555', '1985-03-19', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(8, 8, 'Ricardo Uy', 'P555111', '1991-10-10', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(9, 9, 'Andrea Cruz', 'P667788', '1998-12-12', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(11, 11, 'Admin One', NULL, '1984-01-10', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(12, 12, 'Admin Two', NULL, '1983-09-22', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(13, 13, 'Sofia Rivera', 'P112233', '1999-05-05', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(14, 14, 'Lorenzo dela Vega', 'P445566', '1997-07-07', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(15, 15, 'Isabel Ong', 'P778899', '1994-08-09', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(17, 17, 'Cristina Navarro', 'P554433', '1993-09-09', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(18, 18, 'Jasmine Go', 'P223344', '1990-10-20', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(19, 19, 'Robert Chua', 'P665544', '1987-12-15', '2025-10-16 13:39:53', '2025-10-16 13:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('emieljane121@gmail.com', '$2y$12$27P39aqxR8IABnGDvwRTP.czUlCwEUxc2RW3SsgYcoaGOqgSkLGtW', '2025-11-22 02:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `method` varchar(50) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `method`, `payment_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 3500.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(2, 3200.00, 'GCash', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(3, 2800.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(4, 4500.00, 'Debit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(5, 5000.00, 'GCash', '2025-10-16 13:39:53', 'Pending', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(6, 18000.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(7, 16500.00, 'Cash', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(8, 20250.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(9, 21000.00, 'PayMaya', '2025-10-16 13:39:53', 'Refunded', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(10, 6000.00, 'Debit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(11, 3500.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(12, 4500.00, 'GCash', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(13, 3300.00, 'PayMaya', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(14, 5000.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(15, 18000.00, 'GCash', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(16, 4000.00, 'Credit Card', '2025-10-16 13:39:53', 'Pending', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(17, 20250.00, 'Debit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(18, 21000.00, 'Cash', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(19, 72000.00, 'PayMaya', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(20, 12000.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(21, 40774.00, 'Credit Card', '2025-11-20 00:15:30', 'Paid', '2025-11-20 00:15:30', '2025-11-20 00:15:30'),
(22, 48665.50, 'GCash', '2025-11-21 06:20:15', 'Paid', '2025-11-21 06:20:15', '2025-11-21 06:20:15'),
(23, 34948.50, 'Debit Card', '2025-11-19 01:30:45', 'Pending', '2025-11-19 01:30:45', '2025-11-19 01:30:45'),
(24, 6223.00, 'PayMaya', '2025-11-22 08:45:00', 'Paid', '2025-11-22 08:45:00', '2025-11-22 08:45:00'),
(25, 64098.00, 'Credit Card', '2025-11-18 03:00:00', 'Paid', '2025-11-18 03:00:00', '2025-11-18 03:00:00'),
(26, 35933.00, 'GCash', '2025-11-23 05:15:20', 'Paid', '2025-11-23 05:15:20', '2025-11-23 05:15:20'),
(27, 115312.50, 'Credit Card', '2025-11-17 02:30:00', 'Refunded', '2025-11-17 02:30:00', '2025-11-17 02:30:00'),
(28, 49095.00, 'PayMaya', '2025-11-24 07:45:30', 'Paid', '2025-11-24 07:45:30', '2025-11-24 07:45:30'),
(29, 83293.00, 'Debit Card', '2025-11-16 04:20:00', 'Paid', '2025-11-16 04:20:00', '2025-11-16 04:20:00'),
(30, 38472.00, 'GCash', '2025-11-25 01:00:15', 'Pending', '2025-11-25 01:00:15', '2025-11-25 01:00:15'),
(31, 47597.00, 'Credit Card', '2025-11-15 06:35:00', 'Paid', '2025-11-15 06:35:00', '2025-11-15 06:35:00'),
(32, 35435.50, 'PayMaya', '2025-11-20 03:50:45', 'Paid', '2025-11-20 03:50:45', '2025-11-20 03:50:45'),
(33, 109355.00, 'Credit Card', '2025-11-14 08:20:30', 'Paid', '2025-11-14 08:20:30', '2025-11-14 08:20:30'),
(34, 19186.00, 'Debit Card', '2025-11-21 02:15:00', 'Paid', '2025-11-21 02:15:00', '2025-11-21 02:15:00'),
(35, 21869.50, 'GCash', '2025-11-13 05:40:20', 'Refunded', '2025-11-13 05:40:20', '2025-11-13 05:40:20'),
(36, 110285.00, 'Credit Card', '2025-11-22 07:00:00', 'Paid', '2025-11-22 07:00:00', '2025-11-22 07:00:00'),
(37, 14207.50, 'PayMaya', '2025-11-12 01:25:45', 'Paid', '2025-11-12 01:25:45', '2025-11-12 01:25:45'),
(38, 103473.50, 'Debit Card', '2025-11-23 04:10:30', 'Pending', '2025-11-23 04:10:30', '2025-11-23 04:10:30'),
(39, 15513.00, 'GCash', '2025-11-11 06:55:00', 'Paid', '2025-11-11 06:55:00', '2025-11-11 06:55:00'),
(40, 14682.00, 'Credit Card', '2025-11-24 00:30:15', 'Paid', '2025-11-24 00:30:15', '2025-11-24 00:30:15'),
(41, 84914.50, 'PayMaya', '2025-11-10 03:45:30', 'Paid', '2025-11-10 03:45:30', '2025-11-10 03:45:30'),
(42, 38200.50, 'Debit Card', '2025-11-25 08:20:00', 'Paid', '2025-11-25 08:20:00', '2025-11-25 08:20:00'),
(43, 36975.00, 'GCash', '2025-11-09 05:00:45', 'Paid', '2025-11-09 05:00:45', '2025-11-09 05:00:45'),
(44, 131738.50, 'Credit Card', '2025-11-20 02:35:20', 'Refunded', '2025-11-20 02:35:20', '2025-11-20 02:35:20'),
(45, 20855.00, 'PayMaya', '2025-11-08 07:50:00', 'Paid', '2025-11-08 07:50:00', '2025-11-08 07:50:00'),
(46, 103519.00, 'Debit Card', '2025-11-21 01:15:30', 'Paid', '2025-11-21 01:15:30', '2025-11-21 01:15:30'),
(47, 19018.00, 'GCash', '2025-11-07 04:40:15', 'Pending', '2025-11-07 04:40:15', '2025-11-07 04:40:15'),
(48, 45461.00, 'Credit Card', '2025-11-22 06:25:00', 'Paid', '2025-11-22 06:25:00', '2025-11-22 06:25:00'),
(49, 5521.50, 'PayMaya', '2025-11-06 08:10:45', 'Paid', '2025-11-06 08:10:45', '2025-11-06 08:10:45'),
(50, 47091.50, 'Debit Card', '2025-11-23 03:00:30', 'Paid', '2025-11-23 03:00:30', '2025-11-23 03:00:30'),
(51, 40091.50, 'GCash', '2025-11-05 05:55:20', 'Paid', '2025-11-05 05:55:20', '2025-11-05 05:55:20'),
(52, 9821.00, 'Credit Card', '2025-11-24 02:20:00', 'Paid', '2025-11-24 02:20:00', '2025-11-24 02:20:00'),
(53, 30106.50, 'PayMaya', '2025-11-04 07:40:45', 'Refunded', '2025-11-04 07:40:45', '2025-11-04 07:40:45'),
(54, 139450.50, 'Debit Card', '2025-11-25 04:05:30', 'Paid', '2025-11-25 04:05:30', '2025-11-25 04:05:30'),
(55, 34631.00, 'GCash', '2025-11-03 01:30:15', 'Paid', '2025-11-03 01:30:15', '2025-11-03 01:30:15'),
(56, 83919.00, 'Credit Card', '2025-11-20 06:50:00', 'Pending', '2025-11-20 06:50:00', '2025-11-20 06:50:00'),
(57, 137150.50, 'PayMaya', '2025-11-02 03:15:45', 'Paid', '2025-11-02 03:15:45', '2025-11-02 03:15:45'),
(58, 32201.50, 'Debit Card', '2025-11-21 00:40:30', 'Paid', '2025-11-21 00:40:30', '2025-11-21 00:40:30'),
(59, 41054.00, 'GCash', '2025-11-01 05:25:20', 'Paid', '2025-11-01 05:25:20', '2025-11-01 05:25:20'),
(60, 46491.50, 'Credit Card', '2025-11-22 08:10:00', 'Paid', '2025-11-22 08:10:00', '2025-11-22 08:10:00'),
(61, 37542.00, 'PayMaya', '2025-10-31 02:00:45', 'Paid', '2025-10-31 02:00:45', '2025-10-31 02:00:45'),
(62, 73154.50, 'Debit Card', '2025-11-23 07:35:30', 'Refunded', '2025-11-23 07:35:30', '2025-11-23 07:35:30'),
(63, 44614.00, 'GCash', '2025-10-30 04:20:15', 'Paid', '2025-10-30 04:20:15', '2025-10-30 04:20:15'),
(64, 8087.00, 'Credit Card', '2025-11-24 01:05:00', 'Paid', '2025-11-24 01:05:00', '2025-11-24 01:05:00'),
(65, 24828.50, 'PayMaya', '2025-10-29 06:50:45', 'Pending', '2025-10-29 06:50:45', '2025-10-29 06:50:45'),
(66, 62529.00, 'Debit Card', '2025-11-25 03:30:30', 'Paid', '2025-11-25 03:30:30', '2025-11-25 03:30:30'),
(67, 72701.00, 'GCash', '2025-10-28 08:15:20', 'Paid', '2025-10-28 08:15:20', '2025-10-28 08:15:20'),
(68, 20904.00, 'Credit Card', '2025-11-20 05:00:00', 'Paid', '2025-11-20 05:00:00', '2025-11-20 05:00:00'),
(69, 91901.50, 'PayMaya', '2025-10-27 02:45:45', 'Paid', '2025-10-27 02:45:45', '2025-10-27 02:45:45'),
(70, 55740.50, 'Debit Card', '2025-11-21 07:25:30', 'Paid', '2025-11-21 07:25:30', '2025-11-21 07:25:30'),
(71, 47430.00, 'GCash', '2025-10-26 04:10:15', 'Paid', '2025-10-26 04:10:15', '2025-10-26 04:10:15'),
(72, 88108.00, 'Credit Card', '2025-11-22 00:55:00', 'Refunded', '2025-11-22 00:55:00', '2025-11-22 00:55:00'),
(73, 36457.00, 'PayMaya', '2025-10-25 06:40:45', 'Paid', '2025-10-25 06:40:45', '2025-10-25 06:40:45'),
(74, 33163.00, 'Debit Card', '2025-11-23 02:20:30', 'Paid', '2025-11-23 02:20:30', '2025-11-23 02:20:30'),
(75, 29897.00, 'GCash', '2025-10-24 08:05:20', 'Pending', '2025-10-24 08:05:20', '2025-10-24 08:05:20'),
(76, 3200.00, 'Credit Card', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(77, 15500.00, 'GCash', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(78, 8500.00, 'Debit Card', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(79, 12500.00, 'Credit Card', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(80, 2800.00, 'PayMaya', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(81, 16200.00, 'GCash', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(82, 9200.00, 'Debit Card', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(83, 13200.00, 'Credit Card', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(84, 17000.00, 'PayMaya', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(85, 8800.00, 'GCash', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(86, 12900.00, 'Debit Card', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(87, 3300.00, 'Credit Card', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(88, 15800.00, 'PayMaya', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(89, 9500.00, 'GCash', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(90, 13100.00, 'Debit Card', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(91, 42000.00, 'Credit Card', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(92, 38000.00, 'GCash', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(93, 37000.00, 'Debit Card', '2025-12-04 12:50:45', 'Paid', '2025-12-04 12:50:45', '2025-12-04 12:50:45'),
(94, 2500.00, 'Credit Card', '2025-12-04 05:08:53', 'Paid', '2025-12-04 05:08:53', '2025-12-04 05:08:53'),
(95, 3100.00, 'GCash', '2025-12-04 05:08:53', 'Paid', '2025-12-04 05:08:53', '2025-12-04 05:08:53'),
(96, 2900.00, 'Debit Card', '2025-12-04 05:08:53', 'Paid', '2025-12-04 05:08:53', '2025-12-04 05:08:53'),
(97, 2400.00, 'PayMaya', '2025-12-04 05:08:53', 'Paid', '2025-12-04 05:08:53', '2025-12-04 05:08:53'),
(98, 2200.00, 'Credit Card', '2025-12-04 05:08:53', 'Paid', '2025-12-04 05:08:53', '2025-12-04 05:08:53'),
(99, 1800.00, 'GCash', '2025-12-04 05:08:53', 'Paid', '2025-12-04 05:08:53', '2025-12-04 05:08:53'),
(100, 2600.00, 'Debit Card', '2025-12-04 05:08:53', 'Paid', '2025-12-04 05:08:53', '2025-12-04 05:08:53'),
(101, 2700.00, 'Credit Card', '2025-12-04 05:08:53', 'Paid', '2025-12-04 05:08:53', '2025-12-04 05:08:53'),
(102, 35000.00, 'PayMaya', '2025-12-04 05:08:53', 'Paid', '2025-12-04 05:08:53', '2025-12-04 05:08:53'),
(103, 12500.00, 'GCash', '2025-12-04 05:08:53', 'Paid', '2025-12-04 05:08:53', '2025-12-04 05:08:53'),
(104, 8500.00, 'Debit Card', '2025-12-04 05:08:53', 'Paid', '2025-12-04 05:08:53', '2025-12-04 05:08:53'),
(105, 5500.00, 'Credit Card', '2025-12-04 05:08:53', 'Paid', '2025-12-04 05:08:53', '2025-12-04 05:08:53'),
(106, 2500.00, 'Credit Card', '2025-12-04 05:11:17', 'Paid', '2025-12-04 05:11:17', '2025-12-04 05:11:17'),
(107, 3100.00, 'GCash', '2025-12-04 05:11:17', 'Paid', '2025-12-04 05:11:17', '2025-12-04 05:11:17'),
(108, 2900.00, 'Debit Card', '2025-12-04 05:11:17', 'Paid', '2025-12-04 05:11:17', '2025-12-04 05:11:17'),
(109, 2400.00, 'PayMaya', '2025-12-04 05:11:17', 'Paid', '2025-12-04 05:11:17', '2025-12-04 05:11:17'),
(110, 2200.00, 'Credit Card', '2025-12-04 05:11:17', 'Paid', '2025-12-04 05:11:17', '2025-12-04 05:11:17'),
(111, 1800.00, 'GCash', '2025-12-04 05:11:17', 'Paid', '2025-12-04 05:11:17', '2025-12-04 05:11:17'),
(112, 2600.00, 'Debit Card', '2025-12-04 05:11:17', 'Paid', '2025-12-04 05:11:17', '2025-12-04 05:11:17'),
(113, 2700.00, 'Credit Card', '2025-12-04 05:11:17', 'Paid', '2025-12-04 05:11:17', '2025-12-04 05:11:17'),
(114, 35000.00, 'PayMaya', '2025-12-04 05:11:17', 'Paid', '2025-12-04 05:11:17', '2025-12-04 05:11:17'),
(115, 12500.00, 'GCash', '2025-12-04 05:11:17', 'Paid', '2025-12-04 05:11:17', '2025-12-04 05:11:17'),
(116, 8500.00, 'Debit Card', '2025-12-04 05:11:17', 'Paid', '2025-12-04 05:11:17', '2025-12-04 05:11:17'),
(117, 5500.00, 'Credit Card', '2025-12-04 05:11:17', 'Paid', '2025-12-04 05:11:17', '2025-12-04 05:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flight_id` bigint(20) UNSIGNED NOT NULL,
  `seat_number` varchar(10) NOT NULL,
  `class` varchar(50) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `flight_id`, `seat_number`, `class`, `is_available`, `created_at`, `updated_at`) VALUES
(1, 1, '1A', 'Economy', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(2, 2, '1A', 'Economy', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(3, 3, '1A', 'Economy', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(4, 4, '1A', 'Economy', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(5, 5, '1A', 'Economy', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(6, 6, '1A', 'Business', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(7, 7, '1A', 'Business', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(8, 8, '1A', 'Business', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(9, 9, '1A', 'Business', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(10, 10, '1A', 'Business', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(11, 11, '2B', 'Economy', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(12, 12, '2B', 'Economy', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(13, 13, '2B', 'Economy', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(14, 14, '2B', 'Economy', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(15, 15, '2B', 'Business', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(16, 16, '2B', 'Business', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(17, 17, '2B', 'Business', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(18, 18, '2B', 'Business', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(19, 19, '2B', 'Business', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('nzv7Uz3gdXJfdefSjCzUrK73ilqDZhlyNEe7v9V4', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVGlzc1luNGJPZDlyS3NxSkxuTENUMUhrREJmRnp5TlBBZkRDYXd1OCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbnBhbmVsL2FpcnBvcnRzIjtzOjU6InJvdXRlIjtzOjI1OiJhZG1pbnBhbmVsLmFpcnBvcnRzLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7fQ==', 1764860852);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT 'user',
  `profile_photo` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'customer',
  `passport` varchar(50) DEFAULT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `usertype`, `profile_photo`, `email_verified_at`, `password`, `role`, `passport`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'John Dela Cruz', 'juan@gmail.com', 'user', 'img/profile_6923306e732fc3.43387345.jpg', '2025-11-22 02:04:46', '$2y$12$Y4YDjztZ7xICKrbUyH/r1.UNbl/F3dS5fiS.cE1FQ1pKdnIoI9Jma', 'customer', 'P123456', 'eyJpdiI6InJVMFd1d1Q2d2g5TnJ0Sm51QzJOVnc9PSIsInZhbHVlIjoiVnM5Uy9SRmlma3VwZTgvMXRseS9KajJwc1pyQ0pHMENpQXhmS3drcmVzaz0iLCJtYWMiOiJlYTY3YWUxOGVjNGMyMzNhNzVhZjU1MjY3OGM2MWJmYmNlNTUzYTQyYzM4ZTZkYWM4MjFjMmUyOWQ0Y2NlMTk2IiwidGFnIjoiIn0=', 'eyJpdiI6IjFDVVZIbm15MWFvYnhvNU4xT2RCYWc9PSIsInZhbHVlIjoianYxU1RLL2l6UFF6K085azlVYm04RUczalJ4Rk9Hajg2akdxV05iRGJTY1kvZFpJdUUxUUhuZEltaEhQOTc5ZTNTZDV5SDNmWWZMMXd5cW9KYVdCc2pVSFk1SEtGQ09tVUlFZ0dwdDNvdTNnRkI2Uk1uemEreGZHaUJrKytYK2QxNVRjUm5NOXBoNU9BSXpxY1piL2dENWZyRFNyd2RlYU51V0R3STFjQnVjWWNUVXIrR1hIWDVqZ3E4RUNEemFqbytYRlV0U3hhT3FGZWtCdkNjUVdJZnl1b0FpRXI3YUdsOUZWOGFzZXFMMzlUWXhMNVlWTHhOekh1TTVGY3ZudTh4d0ZTSmI5Wm9SYTU3U1c2a2pYZVE9PSIsIm1hYyI6IjVmYjFkMDllNmIxNmIzZmVmMTYwNTQ4ZGQwNWRjMjNjYzdjZDlkNjUwNGNiZjA3MDM0ODg4MDkyOWI1OGFlYjkiLCJ0YWciOiIifQ==', NULL, NULL, '2025-10-16 13:39:53', '2025-11-25 06:26:44'),
(3, 'Pedro Ramos', 'pedro@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P765432', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(4, 'Anna Lopez', 'anna@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$12$QMnP6ELcvNDzYuTfCR.Oge8fgGEJGUk6CNvkxog.L.wsHZivcDZPe', 'customer', 'P222333', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-11-26 08:48:22'),
(5, 'Carlos Reyes', 'carlos@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P111444', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(6, 'Fatima Lim', 'fatima@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P888999', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(7, 'Jose Tan', 'jose@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P111555', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(8, 'Ricardo Uy', 'ricardo@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P555111', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(9, 'Andrea Cruz', 'andrea@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P667788', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(10, 'Miguel Garcia', 'miguel@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P990011', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(11, 'Admin One', 'admin1@air2holiday.com', 'admin', NULL, '2025-11-22 02:04:46', '$2y$12$h7ws5wvyzoKYO3q7rBokBOW9ts9dkqkO9yVRofnr495U3fP39yTKe', 'admin', NULL, NULL, NULL, NULL, 'PLfxoTauckO5L5Sv7KdkfDKrRpeP9z0iKyL4MyiEU8B6E7jHV7tykERAz0Dq', '2025-10-16 13:39:53', '2025-11-25 08:22:40'),
(12, 'Admin Two', 'admin2@air2holiday.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL, NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(13, 'Sofia Rivera', 'sofia@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P112233', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(14, 'Lorenzo dela Vega', 'lorenzo@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P445566', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(15, 'Isabel Ong', 'isabel@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P778899', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(16, 'Paolo Fernandez', 'paolo@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P998877', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(17, 'Cristina Navarro', 'cristina@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P554433', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(18, 'Jasmine Go', 'jasmine@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P223344', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(19, 'Robert Chua', 'robert@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P665544', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(21, 'Emiel Benedict D. Jane', 'emieljane121@gmail.com', 'user', NULL, NULL, '$2y$12$k4WbhlGKTq/bw.82I7klhOpef4PytI72MQbjA6lpH5ia/GvdFrcPm', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-11-22 02:22:25', '2025-11-22 23:09:03'),
(25, 'Philippine Airlines', 'airline@philippineairlines.com', 'airline', 'img/profile_6925f3af76d815.31089810.png', NULL, '$2y$12$DfcRct0qACONLcozGHe6y.r.P2Fhy7IN7U253Idc8rfysVIUso5im', 'airline', NULL, NULL, NULL, NULL, NULL, '2025-11-25 03:13:48', '2025-11-25 10:21:35'),
(26, 'Maria Santos', 'maria@gmail.com', 'user', NULL, NULL, '$2y$12$Mnxt1V0VbjiZ3cSjQ7n61u3Sc3tC9zxinW/nsrb./U04o/rpeX2jK', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-11-25 06:05:35', '2025-11-25 06:05:35'),
(27, 'American Airlines', 'admin@americanairlines.com', 'airline', NULL, NULL, '$2y$12$bC9Q3lvY/tJmFFlv/SNzHuB/x0wuNDv9AaNmfho5Lml/8MHT.cBq.', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-11-25 23:23:36', '2025-11-25 23:23:36'),
(28, 'Japan Airlines', 'admin@japanairlines.com', 'airline', NULL, NULL, '$2y$12$OxVAezkwdvyve4n7Iob64OTBCnl6a64rsmdDWABN2RDUanpd6vWN.', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-11-25 23:25:56', '2025-11-25 23:25:56'),
(29, 'Singapore Airlines', 'admin@singaporeairlines.com', 'airline', NULL, NULL, '$2y$12$3eoPlCyOrvSb.ofK4/7jX.V9/.qV8ZwEwXwI5ykTE0jm.Yb3sXg6i', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-11-25 23:26:28', '2025-11-25 23:27:24'),
(30, 'Korean Air', 'admin@koreanair.com', 'airline', NULL, NULL, '$2y$12$ijkpbeFugfa1ovXII5A2zOoWcFeglEj6dtlwyKYEmSsJOP2uyrdi2', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-11-25 23:28:36', '2025-11-25 23:28:42'),
(31, 'Claudie Emard', 'tokuneva@example.net', 'user', NULL, '2025-11-25 23:31:41', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, '9F8A6QzmqP', 'GE2vAdCHqI', '2025-11-25 23:31:42', '26T34TQ0Xh', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(32, 'Walton Gottlieb', 'naomi96@example.net', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'IK2yd8s8Ng', 'PMZgdjbW5i', '2025-11-25 23:31:42', 'e67r1dQA7T', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(33, 'Dr. Kelton Leuschke', 'dubuque.lavern@example.com', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'hGWPKqWjTu', 'JiMwq7BxLk', '2025-11-25 23:31:42', '1o18g5hOHB', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(34, 'Carolyne Larkin', 'hintz.elda@example.com', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, '2KiNGVWxau', 'z745ol5WUm', '2025-11-25 23:31:42', 'fEUqcOZyky', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(35, 'Prof. Kianna Medhurst', 'jkihn@example.org', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'izu3udgfGX', 'u98DksS99q', '2025-11-25 23:31:42', 'xIKUFff3r5', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(36, 'Addison Balistreri', 'atorp@example.com', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'DOtpQ2HlBQ', 'wtZGZJ97yQ', '2025-11-25 23:31:42', 'SHH07uhoJ9', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(37, 'Fred Herzog', 'zkeebler@example.org', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'YXX1ROWlXn', 'ATFGHTF6fU', '2025-11-25 23:31:42', 'hcKnnrDuCp', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(38, 'Jacquelyn Ankunding', 'osinski.royal@example.org', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'PTHIKZBl3n', 'Fk5xm6bSkM', '2025-11-25 23:31:42', 'fjjKXf3RFM', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(39, 'Miss Loren Heathcote', 'amaya25@example.net', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'gVIfd5mCgd', 'oJj5wjLFES', '2025-11-25 23:31:42', 'LY134eu0I7', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(40, 'Maude Lind', 'alyce10@example.net', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, '8AHiUFo0aR', '3qMJ6cX4xz', '2025-11-25 23:31:42', '1vJYBUNb2A', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(41, 'Mertie Hayes', 'lcole@example.org', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'Ey5vpSUal2', 'zDY8LqAqHe', '2025-11-25 23:31:42', 'Bsd3zK3FWB', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(42, 'Amelia Abernathy', 'jevon64@example.net', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'cM2RP8ggjy', 'ZVLGhUj4E0', '2025-11-25 23:31:42', 'nuXNwxul9V', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(43, 'Unique Gottlieb', 'xhansen@example.com', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'QhuFNMN4bR', '6yyZpiopy3', '2025-11-25 23:31:42', 'ebFWKVddTU', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(44, 'Pedro Stokes', 'lavonne18@example.com', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'zQGwNWm7L0', '1ld30mM0V8', '2025-11-25 23:31:42', 'aTwgpTubJC', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(45, 'Alessandro Toy', 'udickens@example.com', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'dhRb5QJ948', 'wKeVFZyab1', '2025-11-25 23:31:42', 'oipjN8bN8L', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(46, 'Prof. Avery Rau Jr.', 'thirthe@example.com', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'NKbOlAaSVq', 'S8rJ4L5dGP', '2025-11-25 23:31:42', 'kIvjQkIfHn', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(47, 'Mr. Maurice Rodriguez I', 'lois84@example.com', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'WnRnTqQ3cW', 'ibznHVK1kq', '2025-11-25 23:31:42', 'JxtX0m4gCS', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(48, 'Andre Ledner', 'garland.cruickshank@example.net', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'ezZ3xifMEr', 'YgguEdIlj3', '2025-11-25 23:31:42', 'NsYwAQSnoY', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(49, 'Hilario Ratke', 'ohara.camylle@example.com', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, '1XOSiukzj0', 'kuwrAsxHDS', '2025-11-25 23:31:42', 'IZbPNUMdTm', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(50, 'Hallie Hudson', 'dangelo.gutmann@example.com', 'user', NULL, '2025-11-25 23:31:42', '$2y$12$6e.vXT9CKkxM/.Z665ORTuTOSSbz7ElVRY5DW1LnvnzwseKjBCUhi', 'customer', NULL, 'zTHHfbvLqq', 'SbeEGAErDA', '2025-11-25 23:31:42', 'auuWIBnMFK', '2025-11-25 23:31:42', '2025-11-25 23:31:42'),
(51, 'Elyse Emmerich', 'bartell.barbara@example.net', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'OSqXGPtU0v', 'OHvzQEciPd', '2025-11-25 23:32:42', 'AgEEZgO2ig', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(52, 'Dr. Esteban Wunsch DDS', 'dwindler@example.com', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'JAnLrxTo5h', '3EH2WAU1eV', '2025-11-25 23:32:42', '6BDaOYqONn', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(53, 'Ruben Gottlieb', 'kaelyn.ankunding@example.com', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'afYJMfytdL', '5jy9Fhr99P', '2025-11-25 23:32:42', '28gxTZcT8x', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(54, 'Hollis Mohr Sr.', 'dakota.bradtke@example.com', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'sLHgN3T6MC', '2ajMSHcENQ', '2025-11-25 23:32:42', 'tpgAW57s5z', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(55, 'Bessie Nienow', 'thora.kuvalis@example.org', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'BOEQWRylDP', '5tlwpH86tL', '2025-11-25 23:32:42', 'BRhmP36S2O', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(56, 'Lafayette Nader', 'thomas67@example.com', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'IUzIXrUXpM', '55EZhtTH3j', '2025-11-25 23:32:42', '0eygTstdNe', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(57, 'Mr. Gussie Reichel II', 'diamond97@example.net', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'fUVA4f0xOi', 'uDiJX1dN25', '2025-11-25 23:32:42', '9QYfspPxp3', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(58, 'Mr. Felix Bailey', 'ayden27@example.net', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'eSZASVLeSw', 'jIHLldjazV', '2025-11-25 23:32:42', 'guIzmoLA3L', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(59, 'Prof. Larue Bogisich PhD', 'newton.hane@example.com', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'QtvJaf1SXw', '9YtimBzlqE', '2025-11-25 23:32:42', 'M0UbnfHbhZ', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(60, 'Kaia Fadel', 'goldner.corrine@example.net', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'AiTYrTy6kn', 'DCLSAX3aAe', '2025-11-25 23:32:42', 'yfubNkkjh1', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(61, 'Reid Yundt', 'omoore@example.org', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'Eu5suwTxom', 'eBlybKHM0h', '2025-11-25 23:32:42', 'AJJuyQAP4i', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(62, 'Magdalen Smith', 'jgrady@example.net', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'sAUR3QQzyW', 'CP4cTQv5qL', '2025-11-25 23:32:42', 'TrMBsESO3l', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(63, 'Wellington Price', 'mozell.simonis@example.net', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'ImJVBdqXis', 'XgBeOcbQIh', '2025-11-25 23:32:42', 'Nqgz4J7e9L', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(64, 'Forrest Rau', 'corrine42@example.org', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'xKO6TRveNw', 'oSPfAhE5xG', '2025-11-25 23:32:42', 'VmwbWiztS8', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(65, 'Stevie Considine V', 'bbailey@example.org', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'IurOuIeoTl', 'TPvph5aaej', '2025-11-25 23:32:42', '2DfkhRX55q', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(66, 'Alexane Donnelly', 'mcdermott.herman@example.com', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'HQxrFBjaIu', 'duwljZssWG', '2025-11-25 23:32:42', 'eV5Np13M8I', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(67, 'Lottie Jacobs', 'erdman.marianna@example.org', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'EtgsU4eEFz', '4SmCHNfbkt', '2025-11-25 23:32:42', 'khcU7BKie4', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(68, 'Joelle Schumm', 'lambert.goyette@example.org', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, '7jXOfx7wx4', 'Skg3etrIZO', '2025-11-25 23:32:42', 'w9qxqpqhYB', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(69, 'Taurean Cormier', 'vernie25@example.net', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, 'c2SplL5TZ0', 'FZ4uwpv6Gz', '2025-11-25 23:32:42', 'Wm4U2LgxHr', '2025-11-25 23:32:42', '2025-11-25 23:32:42'),
(70, 'Jevon Gerlach', 'randal81@example.com', 'user', NULL, '2025-11-25 23:32:42', '$2y$12$VhFti/K4m3hqUa98YZWbM.wbd1t9PHKbiZMSX74Xvl9XZ.8cxkbxS', 'customer', NULL, '0JJakEaw9v', 'nHMtXInvOw', '2025-11-25 23:32:42', '2ly1kwpkH3', '2025-11-25 23:32:42', '2025-11-25 23:32:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `airlines_code_unique` (`code`),
  ADD KEY `airlines_user_id_foreign` (`user_id`);

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `airports_iata_code_unique` (`iata_code`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_flight_id_seat_number_unique` (`flight_id`,`seat_number`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_payment_id_foreign` (`payment_id`);

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
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flights_airline_id_foreign` (`airline_id`),
  ADD KEY `flights_departure_airport_id_foreign` (`departure_airport_id`),
  ADD KEY `flights_arrival_airport_id_foreign` (`arrival_airport_id`);

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
-- Indexes for table `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passengers_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seats_flight_id_seat_number_unique` (`flight_id`,`seat_number`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `airports`
--
ALTER TABLE `airports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=378;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `airlines`
--
ALTER TABLE `airlines`
  ADD CONSTRAINT `airlines_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_flight_id_foreign` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_airline_id_foreign` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `flights_arrival_airport_id_foreign` FOREIGN KEY (`arrival_airport_id`) REFERENCES `airports` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `flights_departure_airport_id_foreign` FOREIGN KEY (`departure_airport_id`) REFERENCES `airports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `passengers`
--
ALTER TABLE `passengers`
  ADD CONSTRAINT `passengers_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_flight_id_foreign` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
