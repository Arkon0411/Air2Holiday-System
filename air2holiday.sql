-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2025 at 08:42 PM
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
(2, 'American Airlines', 'AA', '2025-11-25 10:55:46', '2025-11-25 10:56:06', 'img/airline_6925fbc626a3d0.77097109.png', NULL),
(3, 'Japan Airlines', 'JL', '2025-11-25 10:59:45', '2025-11-25 10:59:45', 'img/airline_6925fca1507279.92484027.png', NULL),
(4, 'Singapore Airlines', 'SQ', '2025-11-25 11:03:34', '2025-11-25 11:03:34', 'img/airline_6925fd868a2c23.92787704.png', NULL),
(5, 'Korean Air', 'KE', '2025-11-25 11:07:55', '2025-11-25 11:07:55', 'img/airline_6925fe8bbf12f1.90177924.png', NULL);

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
(1, 'Ninoy Aquino International Airport', 'MNL', 'Manila, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(2, 'Mactan–Cebu International Airport', 'CEB', 'Cebu, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(3, 'Francisco Bangoy International Airport', 'DVO', 'Davao, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(4, 'Iloilo International Airport', 'ILO', 'Iloilo, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(5, 'Laoag International Airport', 'LAO', 'Ilocos Norte, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(6, 'Kalibo International Airport', 'KLO', 'Aklan, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(7, 'Bacolod–Silay International Airport', 'BCD', 'Negros Occidental, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(8, 'Tacloban Airport', 'TAC', 'Leyte, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(9, 'Zamboanga International Airport', 'ZAM', 'Zamboanga City, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(10, 'Puerto Princesa International Airport', 'PPS', 'Palawan, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(11, 'Clark International Airport', 'CRK', 'Pampanga, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(12, 'Bohol–Panglao International Airport', 'TAG', 'Bohol, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(13, 'Caticlan Airport', 'MPH', 'Malay, Aklan, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(14, 'Roxas Airport', 'RXS', 'Capiz, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(15, 'Tuguegarao Airport', 'TUG', 'Cagayan, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(16, 'Singapore Changi Airport', 'SIN', 'Singapore', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(17, 'Hong Kong International Airport', 'HKG', 'Hong Kong', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(18, 'Narita International Airport', 'NRT', 'Tokyo, Japan', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(19, 'Incheon International Airport', 'ICN', 'Seoul, South Korea', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(20, 'Los Angeles International Airport', 'LAX', 'Los Angeles, USA', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'img/loginsplash.jpeg'),
(21, 'Beijing Capital International Airport', 'PEK', 'Beijing, China', '2025-11-25 06:49:50', '2025-11-25 07:03:19', 'img/airport_6925c537dacb02.84437211.jpg');

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
(1, '2025-10-16 13:39:53', 'confirmed', 1, 1, 1, '5E', '2025-10-16 13:39:53', '2025-11-24 06:38:40', 'economy'),
(3, '2025-10-16 13:39:53', 'pending', 3, 3, 3, '1A', '2025-10-16 13:39:53', '2025-11-25 11:31:02', 'economy'),
(5, '2025-10-16 13:39:53', 'cancelled', 5, 5, 5, '1A', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'economy'),
(6, '2025-10-16 13:39:53', 'confirmed', 6, 6, 6, '1A', '2025-10-16 13:39:53', '2025-10-16 13:39:53', 'economy'),
(7, '2025-10-16 13:39:53', 'confirmed', 7, 7, 7, '1A', '2025-10-16 13:39:53', '2025-11-25 11:31:10', 'economy'),
(8, '2025-10-16 13:39:53', 'confirmed', 8, 8, 8, '1A', '2025-10-16 13:39:53', '2025-11-25 11:31:14', 'economy'),
(9, '2025-10-16 13:39:53', 'cancelled', 9, 9, 9, '1A', '2025-10-16 13:39:53', '2025-11-25 11:31:26', 'economy'),
(11, '2025-10-16 13:39:53', 'confirmed', 11, 11, 11, '2B', '2025-10-16 13:39:53', '2025-11-25 11:31:34', 'economy'),
(12, '2025-10-16 13:39:53', 'confirmed', 12, 12, 12, '2B', '2025-10-16 13:39:53', '2025-11-25 11:31:39', 'economy'),
(13, '2025-10-16 13:39:53', 'confirmed', 13, 13, 13, '2B', '2025-10-16 13:39:53', '2025-11-25 11:31:45', 'economy'),
(14, '2025-10-16 13:39:53', 'confirmed', 14, 14, 14, '2B', '2025-10-16 13:39:53', '2025-11-25 11:31:49', 'economy'),
(15, '2025-10-16 13:39:53', 'pending', 15, 15, 15, '2B', '2025-10-16 13:39:53', '2025-11-25 11:32:05', 'economy'),
(17, '2025-10-16 13:39:53', 'confirmed', 17, 17, 17, '2B', '2025-10-16 13:39:53', '2025-11-25 11:31:55', 'economy'),
(18, '2025-10-16 13:39:53', 'confirmed', 18, 18, 18, '2B', '2025-10-16 13:39:53', '2025-11-25 11:32:01', 'economy'),
(19, '2025-10-16 13:39:53', 'cancelled', 19, 19, 19, '2B', '2025-10-16 13:39:53', '2025-11-25 11:32:11', 'economy');

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
('laravel-cache-4b27b84871653d3fa657f5b11b84f783', 'i:1;', 1764095028),
('laravel-cache-4b27b84871653d3fa657f5b11b84f783:timer', 'i:1764095028;', 1764095028),
('laravel-cache-82062546cf153915035887efe4d3199f', 'i:1;', 1764094876),
('laravel-cache-82062546cf153915035887efe4d3199f:timer', 'i:1764094876;', 1764094876),
('laravel-cache-airline@philippineairline.com|127.0.0.1', 'i:1;', 1764094863),
('laravel-cache-airline@philippineairline.com|127.0.0.1:timer', 'i:1764094863;', 1764094863),
('laravel-cache-boost:mcp:database-schema:mysql:', 'a:3:{s:6:\"engine\";s:5:\"mysql\";s:6:\"tables\";a:36:{s:8:\"airlines\";a:5:{s:7:\"columns\";a:6:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:4:\"name\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:4:\"code\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:4:\"logo\";a:1:{s:4:\"type\";s:7:\"varchar\";}}s:7:\"indexes\";a:2:{s:20:\"airlines_code_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"code\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"airports\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:4:\"name\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:9:\"iata_code\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:8:\"location\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:5:\"image\";a:1:{s:4:\"type\";s:7:\"varchar\";}}s:7:\"indexes\";a:2:{s:25:\"airports_iata_code_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:9:\"iata_code\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:10:\"audit_logs\";a:5:{s:7:\"columns\";a:9:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:11:\"entity_type\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:9:\"entity_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:11:\"change_type\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"changed_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"changed_by\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:7:\"details\";a:1:{s:4:\"type\";s:4:\"text\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"bookings\";a:5:{s:7:\"columns\";a:10:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:12:\"booking_date\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:6:\"status\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:7:\"user_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:10:\"payment_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:9:\"flight_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:11:\"seat_number\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:5:\"class\";a:1:{s:4:\"type\";s:7:\"varchar\";}}s:7:\"indexes\";a:4:{s:37:\"bookings_flight_id_seat_number_unique\";a:4:{s:7:\"columns\";a:2:{i:0;s:9:\"flight_id\";i:1;s:11:\"seat_number\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:27:\"bookings_payment_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"payment_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:24:\"bookings_user_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:7:\"user_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:3:{i:0;a:7:{s:4:\"name\";s:26:\"bookings_flight_id_foreign\";s:7:\"columns\";a:1:{i:0;s:9:\"flight_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:7:\"flights\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:7:\"cascade\";}i:1;a:7:{s:4:\"name\";s:27:\"bookings_payment_id_foreign\";s:7:\"columns\";a:1:{i:0;s:10:\"payment_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:8:\"payments\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:8:\"set null\";}i:2;a:7:{s:4:\"name\";s:24:\"bookings_user_id_foreign\";s:7:\"columns\";a:1:{i:0;s:7:\"user_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:5:\"users\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:5:\"cache\";a:5:{s:7:\"columns\";a:3:{s:3:\"key\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:5:\"value\";a:1:{s:4:\"type\";s:10:\"mediumtext\";}s:10:\"expiration\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:3:\"key\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:11:\"cache_locks\";a:5:{s:7:\"columns\";a:3:{s:3:\"key\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:5:\"owner\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"expiration\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:3:\"key\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:11:\"failed_jobs\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:4:\"uuid\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"connection\";a:1:{s:4:\"type\";s:4:\"text\";}s:5:\"queue\";a:1:{s:4:\"type\";s:4:\"text\";}s:7:\"payload\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:9:\"exception\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:9:\"failed_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:23:\"failed_jobs_uuid_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"uuid\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:7:\"flights\";a:5:{s:7:\"columns\";a:14:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:13:\"flight_number\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:19:\"scheduled_departure\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:17:\"scheduled_arrival\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:16:\"actual_departure\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:14:\"actual_arrival\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:6:\"status\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"airline_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:20:\"departure_airport_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:18:\"arrival_airport_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:10:\"base_price\";a:1:{s:4:\"type\";s:7:\"decimal\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:20:\"business_class_price\";a:1:{s:4:\"type\";s:7:\"decimal\";}}s:7:\"indexes\";a:4:{s:26:\"flights_airline_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"airline_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:34:\"flights_arrival_airport_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:18:\"arrival_airport_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:36:\"flights_departure_airport_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:20:\"departure_airport_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:3:{i:0;a:7:{s:4:\"name\";s:26:\"flights_airline_id_foreign\";s:7:\"columns\";a:1:{i:0;s:10:\"airline_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:8:\"airlines\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:7:\"cascade\";}i:1;a:7:{s:4:\"name\";s:34:\"flights_arrival_airport_id_foreign\";s:7:\"columns\";a:1:{i:0;s:18:\"arrival_airport_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:8:\"airports\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:7:\"cascade\";}i:2;a:7:{s:4:\"name\";s:36:\"flights_departure_airport_id_foreign\";s:7:\"columns\";a:1:{i:0;s:20:\"departure_airport_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:8:\"airports\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:4:\"jobs\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:5:\"queue\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:7:\"payload\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:8:\"attempts\";a:1:{s:4:\"type\";s:7:\"tinyint\";}s:11:\"reserved_at\";a:1:{s:4:\"type\";s:3:\"int\";}s:12:\"available_at\";a:1:{s:4:\"type\";s:3:\"int\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:2:{s:16:\"jobs_queue_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"queue\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:11:\"job_batches\";a:5:{s:7:\"columns\";a:10:{s:2:\"id\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:4:\"name\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"total_jobs\";a:1:{s:4:\"type\";s:3:\"int\";}s:12:\"pending_jobs\";a:1:{s:4:\"type\";s:3:\"int\";}s:11:\"failed_jobs\";a:1:{s:4:\"type\";s:3:\"int\";}s:14:\"failed_job_ids\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:7:\"options\";a:1:{s:4:\"type\";s:10:\"mediumtext\";}s:12:\"cancelled_at\";a:1:{s:4:\"type\";s:3:\"int\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:3:\"int\";}s:11:\"finished_at\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:10:\"migrations\";a:5:{s:7:\"columns\";a:3:{s:2:\"id\";a:1:{s:4:\"type\";s:3:\"int\";}s:9:\"migration\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:5:\"batch\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:10:\"passengers\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:10:\"booking_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:4:\"name\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:8:\"passport\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:13:\"date_of_birth\";a:1:{s:4:\"type\";s:4:\"date\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:29:\"passengers_booking_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"booking_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:29:\"passengers_booking_id_foreign\";s:7:\"columns\";a:1:{i:0;s:10:\"booking_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:8:\"bookings\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:21:\"password_reset_tokens\";a:5:{s:7:\"columns\";a:3:{s:5:\"email\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:5:\"token\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"email\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"payments\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:6:\"amount\";a:1:{s:4:\"type\";s:7:\"decimal\";}s:6:\"method\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:12:\"payment_date\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:6:\"status\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:5:\"seats\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:9:\"flight_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:11:\"seat_number\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:5:\"class\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:12:\"is_available\";a:1:{s:4:\"type\";s:7:\"tinyint\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:34:\"seats_flight_id_seat_number_unique\";a:4:{s:7:\"columns\";a:2:{i:0;s:9:\"flight_id\";i:1;s:11:\"seat_number\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:23:\"seats_flight_id_foreign\";s:7:\"columns\";a:1:{i:0;s:9:\"flight_id\";}s:14:\"foreign_schema\";s:11:\"air2holiday\";s:13:\"foreign_table\";s:7:\"flights\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:8:\"restrict\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"sessions\";a:5:{s:7:\"columns\";a:6:{s:2:\"id\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:7:\"user_id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:10:\"ip_address\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"user_agent\";a:1:{s:4:\"type\";s:4:\"text\";}s:7:\"payload\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:13:\"last_activity\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:3:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:28:\"sessions_last_activity_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:13:\"last_activity\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:22:\"sessions_user_id_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:7:\"user_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:5:\"users\";a:5:{s:7:\"columns\";a:15:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:4:\"name\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:5:\"email\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:8:\"usertype\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:13:\"profile_photo\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:17:\"email_verified_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:8:\"password\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:4:\"role\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:8:\"passport\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:17:\"two_factor_secret\";a:1:{s:4:\"type\";s:4:\"text\";}s:25:\"two_factor_recovery_codes\";a:1:{s:4:\"type\";s:4:\"text\";}s:23:\"two_factor_confirmed_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:14:\"remember_token\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:18:\"users_email_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"email\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:13:\"pma__bookmark\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:20:\"pma__central_columns\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:16:\"pma__column_info\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:22:\"pma__designer_settings\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:21:\"pma__export_templates\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:13:\"pma__favorite\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:12:\"pma__history\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:21:\"pma__navigationhiding\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:14:\"pma__pdf_pages\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:11:\"pma__recent\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:13:\"pma__relation\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:18:\"pma__savedsearches\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:17:\"pma__table_coords\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:15:\"pma__table_info\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:18:\"pma__table_uiprefs\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:13:\"pma__tracking\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:15:\"pma__userconfig\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:15:\"pma__usergroups\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:10:\"pma__users\";a:5:{s:7:\"columns\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}}s:6:\"global\";a:4:{s:5:\"views\";a:0:{}s:17:\"stored_procedures\";a:0:{}s:9:\"functions\";a:0:{}s:9:\"sequences\";a:0:{}}}', 1764091921),
('laravel-cache-boost:mcp:database-schema:mysql:airports', 'a:3:{s:6:\"engine\";s:5:\"mysql\";s:6:\"tables\";a:1:{s:8:\"airports\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:4:\"name\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:9:\"iata_code\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:8:\"location\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:5:\"image\";a:1:{s:4:\"type\";s:7:\"varchar\";}}s:7:\"indexes\";a:2:{s:25:\"airports_iata_code_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:9:\"iata_code\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}}s:6:\"global\";a:4:{s:5:\"views\";a:0:{}s:17:\"stored_procedures\";a:0:{}s:9:\"functions\";a:0:{}s:9:\"sequences\";a:0:{}}}', 1764081818),
('laravel-cache-boost.roster.scan', 'a:2:{s:6:\"roster\";O:21:\"Laravel\\Roster\\Roster\":3:{s:13:\"\0*\0approaches\";O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:23:\"Laravel\\Roster\\Approach\":1:{s:11:\"\0*\0approach\";E:38:\"Laravel\\Roster\\Enums\\Approaches:ACTION\";}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:12:{i:0;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.30\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:FORTIFY\";s:14:\"\0*\0packageName\";s:15:\"laravel/fortify\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:6:\"\0*\0dev\";b:0;}i:1;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^12.0\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:LARAVEL\";s:14:\"\0*\0packageName\";s:17:\"laravel/framework\";s:10:\"\0*\0version\";s:7:\"12.39.0\";s:6:\"\0*\0dev\";b:0;}i:2;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.3.7\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PROMPTS\";s:14:\"\0*\0packageName\";s:15:\"laravel/prompts\";s:10:\"\0*\0version\";s:5:\"0.3.7\";s:6:\"\0*\0dev\";b:0;}i:3;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^2.6\";s:10:\"\0*\0package\";E:41:\"Laravel\\Roster\\Enums\\Packages:FLUXUI_FREE\";s:14:\"\0*\0packageName\";s:13:\"livewire/flux\";s:10:\"\0*\0version\";s:5:\"2.6.2\";s:6:\"\0*\0dev\";b:0;}i:4;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v3.7.0\";s:10:\"\0*\0package\";E:38:\"Laravel\\Roster\\Enums\\Packages:LIVEWIRE\";s:14:\"\0*\0packageName\";s:17:\"livewire/livewire\";s:10:\"\0*\0version\";s:5:\"3.7.0\";s:6:\"\0*\0dev\";b:0;}i:5;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^1.7.0\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:VOLT\";s:14:\"\0*\0packageName\";s:13:\"livewire/volt\";s:10:\"\0*\0version\";s:6:\"1.10.0\";s:6:\"\0*\0dev\";b:0;}i:6;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.3.4\";s:10:\"\0*\0package\";E:33:\"Laravel\\Roster\\Enums\\Packages:MCP\";s:14:\"\0*\0packageName\";s:11:\"laravel/mcp\";s:10:\"\0*\0version\";s:5:\"0.3.4\";s:6:\"\0*\0dev\";b:1;}i:7;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.24\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PINT\";s:14:\"\0*\0packageName\";s:12:\"laravel/pint\";s:10:\"\0*\0version\";s:6:\"1.25.1\";s:6:\"\0*\0dev\";b:1;}i:8;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.41\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:SAIL\";s:14:\"\0*\0packageName\";s:12:\"laravel/sail\";s:10:\"\0*\0version\";s:6:\"1.48.1\";s:6:\"\0*\0dev\";b:1;}i:9;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^3.8\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PEST\";s:14:\"\0*\0packageName\";s:12:\"pestphp/pest\";s:10:\"\0*\0version\";s:5:\"3.8.4\";s:6:\"\0*\0dev\";b:1;}i:10;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:7:\"11.5.33\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PHPUNIT\";s:14:\"\0*\0packageName\";s:15:\"phpunit/phpunit\";s:10:\"\0*\0version\";s:7:\"11.5.33\";s:6:\"\0*\0dev\";b:1;}i:11;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:41:\"Laravel\\Roster\\Enums\\Packages:TAILWINDCSS\";s:14:\"\0*\0packageName\";s:11:\"tailwindcss\";s:10:\"\0*\0version\";s:6:\"4.1.11\";s:6:\"\0*\0dev\";b:0;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:21:\"\0*\0nodePackageManager\";E:43:\"Laravel\\Roster\\Enums\\NodePackageManager:NPM\";}s:9:\"timestamp\";i:1764077913;}', 1764164313),
('laravel-cache-f6e1126cedebf23e1463aee73f9df08783640400', 'i:1;', 1764094952),
('laravel-cache-f6e1126cedebf23e1463aee73f9df08783640400:timer', 'i:1764094952;', 1764094952),
('laravel-cache-fee1bf06edf5cdddeda0ba8eca16467e', 'i:1;', 1764094863),
('laravel-cache-fee1bf06edf5cdddeda0ba8eca16467e:timer', 'i:1764094863;', 1764094863);

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
(1, 'PR1001', '2025-11-27 21:13:00', '2025-10-29 18:00:00', NULL, NULL, 'scheduled', 1, 1, 2, 3500.00, '2025-10-16 13:39:53', '2025-11-25 09:54:48', 5250.00),
(2, 'PR1002', '2025-11-25 11:13:48', '2025-10-20 05:00:00', NULL, NULL, 'Scheduled', 1, 1, 3, 4500.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 6750.00),
(3, 'PR1003', '2025-11-25 11:13:48', '2025-10-21 03:00:00', NULL, NULL, 'Scheduled', 1, 1, 4, 2800.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 4200.00),
(4, 'PR1004', '2025-11-25 11:13:48', '2025-10-22 01:30:00', NULL, NULL, 'Scheduled', 1, 1, 5, 3300.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 4950.00),
(5, 'PR1005', '2025-11-25 11:13:48', '2025-10-22 09:30:00', NULL, NULL, 'Scheduled', 1, 1, 10, 5000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 7500.00),
(6, 'PR1006', '2025-11-25 11:13:48', '2025-10-23 09:00:00', NULL, NULL, 'Scheduled', 1, 1, 16, 12000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 18000.00),
(7, 'PR1007', '2025-11-25 11:13:48', '2025-10-23 04:30:00', NULL, NULL, 'Scheduled', 1, 1, 17, 11000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 16500.00),
(8, 'PR1008', '2025-11-25 11:13:48', '2025-10-24 01:30:00', NULL, NULL, 'Scheduled', 1, 1, 18, 13500.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 20250.00),
(9, 'PR1009', '2025-11-25 11:13:48', '2025-10-24 07:30:00', NULL, NULL, 'Scheduled', 1, 1, 19, 14000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 21000.00),
(10, 'PR1010', '2025-11-25 11:13:48', '2025-10-25 22:00:00', NULL, NULL, 'Scheduled', 1, 1, 20, 48000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 72000.00),
(11, 'PR1011', '2025-11-25 11:13:48', '2025-10-26 03:00:00', NULL, NULL, 'Scheduled', 1, 2, 1, 3500.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 5250.00),
(12, 'PR1012', '2025-11-25 11:13:48', '2025-10-27 04:00:00', NULL, NULL, 'Scheduled', 1, 3, 1, 4500.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 6750.00),
(13, 'PR1013', '2025-11-25 11:13:48', '2025-10-28 02:30:00', NULL, NULL, 'Scheduled', 1, 5, 1, 3300.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 4950.00),
(14, 'PR1014', '2025-11-25 11:13:48', '2025-10-29 01:30:00', NULL, NULL, 'Scheduled', 1, 10, 1, 5000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 7500.00),
(15, 'PR1015', '2025-11-25 11:13:48', '2025-10-30 08:30:00', NULL, NULL, 'Scheduled', 1, 16, 1, 12000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 18000.00),
(16, 'PR1016', '2025-11-25 11:13:48', '2025-10-31 07:30:00', NULL, NULL, 'Scheduled', 1, 17, 1, 11000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 16500.00),
(17, 'PR1017', '2025-11-25 11:13:48', '2025-11-01 05:00:00', NULL, NULL, 'Scheduled', 1, 18, 1, 13500.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 20250.00),
(18, 'PR1018', '2025-11-25 11:13:48', '2025-11-02 03:30:00', NULL, NULL, 'Scheduled', 1, 19, 1, 14000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 21000.00),
(19, 'PR1019', '2025-11-25 11:13:48', '2025-11-03 23:00:00', NULL, NULL, 'Scheduled', 1, 20, 1, 48000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53', 72000.00);

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
(11, '2025_11_26_000004_add_columns_to_existing_airlines_table', 7);

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
(1, 5000.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(2, 3200.00, 'GCash', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(3, 6800.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(4, 4500.00, 'Debit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(5, 7000.00, 'GCash', '2025-10-16 13:39:53', 'Pending', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(6, 4800.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(7, 2500.00, 'Cash', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(8, 9100.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(9, 3500.00, 'PayMaya', '2025-10-16 13:39:53', 'Refunded', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(10, 6000.00, 'Debit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(11, 4800.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(12, 7200.00, 'GCash', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(13, 3100.00, 'PayMaya', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(14, 8500.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(15, 9990.00, 'GCash', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(16, 4000.00, 'Credit Card', '2025-10-16 13:39:53', 'Pending', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(17, 5400.00, 'Debit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(18, 3200.00, 'Cash', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(19, 3800.00, 'PayMaya', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(20, 12000.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid', '2025-10-16 13:39:53', '2025-10-16 13:39:53');

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
('vltMV1edk3JIdiTSJrD0HXwUmQNJcEJyTtp91xOW', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiakEzM1JlbVNuV09UakRSVGtDVTQ3UU9DNm5aVE1FZ2Y4cEdxY281NSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbnBhbmVsL2FpcnBvcnRzIjtzOjU6InJvdXRlIjtzOjI1OiJhZG1pbnBhbmVsLmFpcnBvcnRzLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7fQ==', 1764099348);

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
(4, 'Anna Lopez', 'anna@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P222333', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(5, 'Carlos Reyes', 'carlos@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P111444', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(6, 'Fatima Lim', 'fatima@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P888999', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(7, 'Jose Tan', 'jose@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P111555', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(8, 'Ricardo Uy', 'ricardo@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P555111', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(9, 'Andrea Cruz', 'andrea@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P667788', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(10, 'Miguel Garcia', 'miguel@gmail.com', 'user', NULL, '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P990011', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(11, 'Admin One', 'admin1@air2holiday.com', 'admin', NULL, '2025-11-22 02:04:46', '$2y$12$h7ws5wvyzoKYO3q7rBokBOW9ts9dkqkO9yVRofnr495U3fP39yTKe', 'admin', NULL, NULL, NULL, NULL, 'szOMZ5ZbErTZXXxV9nA3qG4OqawQiP8yDm7g3k7Qi0L1G1l44utw5USWHXES', '2025-10-16 13:39:53', '2025-11-25 08:22:40'),
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
(26, 'Maria Santos', 'maria@gmail.com', 'user', NULL, NULL, '$2y$12$Mnxt1V0VbjiZ3cSjQ7n61u3Sc3tC9zxinW/nsrb./U04o/rpeX2jK', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-11-25 06:05:35', '2025-11-25 06:05:35');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
