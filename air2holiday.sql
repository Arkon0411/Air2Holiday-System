-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2025 at 02:11 PM
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Philippine Airlines', 'PR', '2025-10-16 13:39:53', '2025-10-16 13:39:53');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id`, `name`, `iata_code`, `location`, `created_at`, `updated_at`) VALUES
(1, 'Ninoy Aquino International Airport', 'MNL', 'Manila, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(2, 'Mactan–Cebu International Airport', 'CEB', 'Cebu, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(3, 'Francisco Bangoy International Airport', 'DVO', 'Davao, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(4, 'Iloilo International Airport', 'ILO', 'Iloilo, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(5, 'Laoag International Airport', 'LAO', 'Ilocos Norte, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(6, 'Kalibo International Airport', 'KLO', 'Aklan, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(7, 'Bacolod–Silay International Airport', 'BCD', 'Negros Occidental, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(8, 'Tacloban Airport', 'TAC', 'Leyte, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(9, 'Zamboanga International Airport', 'ZAM', 'Zamboanga City, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(10, 'Puerto Princesa International Airport', 'PPS', 'Palawan, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(11, 'Clark International Airport', 'CRK', 'Pampanga, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(12, 'Bohol–Panglao International Airport', 'TAG', 'Bohol, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(13, 'Caticlan Airport', 'MPH', 'Malay, Aklan, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(14, 'Roxas Airport', 'RXS', 'Capiz, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(15, 'Tuguegarao Airport', 'TUG', 'Cagayan, Philippines', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(16, 'Singapore Changi Airport', 'SIN', 'Singapore', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(17, 'Hong Kong International Airport', 'HKG', 'Hong Kong', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(18, 'Narita International Airport', 'NRT', 'Tokyo, Japan', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(19, 'Incheon International Airport', 'ICN', 'Seoul, South Korea', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(20, 'Los Angeles International Airport', 'LAX', 'Los Angeles, USA', '2025-10-16 13:39:53', '2025-10-16 13:39:53');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_date`, `status`, `user_id`, `payment_id`, `flight_id`, `seat_number`, `created_at`, `updated_at`) VALUES
(1, '2025-10-16 13:39:53', 'Confirmed', 1, 1, 1, '1A', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(2, '2025-10-16 13:39:53', 'Confirmed', 2, 2, 2, '1A', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(3, '2025-10-16 13:39:53', 'Pending', 3, 3, 3, '1A', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(4, '2025-10-16 13:39:53', 'Confirmed', 4, 4, 4, '1A', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(5, '2025-10-16 13:39:53', 'Cancelled', 5, 5, 5, '1A', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(6, '2025-10-16 13:39:53', 'Confirmed', 6, 6, 6, '1A', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(7, '2025-10-16 13:39:53', 'Confirmed', 7, 7, 7, '1A', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(8, '2025-10-16 13:39:53', 'Confirmed', 8, 8, 8, '1A', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(9, '2025-10-16 13:39:53', 'Refunded', 9, 9, 9, '1A', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(10, '2025-10-16 13:39:53', 'Confirmed', 10, 10, 10, '1A', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(11, '2025-10-16 13:39:53', 'Confirmed', 11, 11, 11, '2B', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(12, '2025-10-16 13:39:53', 'Confirmed', 12, 12, 12, '2B', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(13, '2025-10-16 13:39:53', 'Confirmed', 13, 13, 13, '2B', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(14, '2025-10-16 13:39:53', 'Confirmed', 14, 14, 14, '2B', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(15, '2025-10-16 13:39:53', 'Pending', 15, 15, 15, '2B', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(16, '2025-10-16 13:39:53', 'Confirmed', 16, 16, 16, '2B', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(17, '2025-10-16 13:39:53', 'Confirmed', 17, 17, 17, '2B', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(18, '2025-10-16 13:39:53', 'Confirmed', 18, 18, 18, '2B', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(19, '2025-10-16 13:39:53', 'Cancelled', 19, 19, 19, '2B', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(20, '2025-10-16 13:39:53', 'Confirmed', 20, 20, 20, '2B', '2025-10-16 13:39:53', '2025-10-16 13:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `flight_number`, `scheduled_departure`, `scheduled_arrival`, `actual_departure`, `actual_arrival`, `status`, `airline_id`, `departure_airport_id`, `arrival_airport_id`, `base_price`, `created_at`, `updated_at`) VALUES
(1, 'PR1001', '2025-10-20 00:00:00', '2025-10-20 02:00:00', NULL, NULL, 'Scheduled', 1, 1, 2, 3500.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(2, 'PR1002', '2025-10-20 03:00:00', '2025-10-20 05:00:00', NULL, NULL, 'Scheduled', 1, 1, 3, 4500.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(3, 'PR1003', '2025-10-21 01:30:00', '2025-10-21 03:00:00', NULL, NULL, 'Scheduled', 1, 1, 4, 2800.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(4, 'PR1004', '2025-10-21 23:00:00', '2025-10-22 01:30:00', NULL, NULL, 'Scheduled', 1, 1, 5, 3300.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(5, 'PR1005', '2025-10-22 07:00:00', '2025-10-22 09:30:00', NULL, NULL, 'Scheduled', 1, 1, 10, 5000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(6, 'PR1006', '2025-10-23 06:00:00', '2025-10-23 09:00:00', NULL, NULL, 'Scheduled', 1, 1, 16, 12000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(7, 'PR1007', '2025-10-23 01:00:00', '2025-10-23 04:30:00', NULL, NULL, 'Scheduled', 1, 1, 17, 11000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(8, 'PR1008', '2025-10-23 22:00:00', '2025-10-24 01:30:00', NULL, NULL, 'Scheduled', 1, 1, 18, 13500.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(9, 'PR1009', '2025-10-24 04:00:00', '2025-10-24 07:30:00', NULL, NULL, 'Scheduled', 1, 1, 19, 14000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(10, 'PR1010', '2025-10-25 12:00:00', '2025-10-25 22:00:00', NULL, NULL, 'Scheduled', 1, 1, 20, 48000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(11, 'PR1011', '2025-10-26 01:00:00', '2025-10-26 03:00:00', NULL, NULL, 'Scheduled', 1, 2, 1, 3500.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(12, 'PR1012', '2025-10-27 02:00:00', '2025-10-27 04:00:00', NULL, NULL, 'Scheduled', 1, 3, 1, 4500.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(13, 'PR1013', '2025-10-28 00:00:00', '2025-10-28 02:30:00', NULL, NULL, 'Scheduled', 1, 5, 1, 3300.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(14, 'PR1014', '2025-10-28 23:30:00', '2025-10-29 01:30:00', NULL, NULL, 'Scheduled', 1, 10, 1, 5000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(15, 'PR1015', '2025-10-30 05:00:00', '2025-10-30 08:30:00', NULL, NULL, 'Scheduled', 1, 16, 1, 12000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(16, 'PR1016', '2025-10-31 04:30:00', '2025-10-31 07:30:00', NULL, NULL, 'Scheduled', 1, 17, 1, 11000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(17, 'PR1017', '2025-11-01 02:00:00', '2025-11-01 05:00:00', NULL, NULL, 'Scheduled', 1, 18, 1, 13500.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(18, 'PR1018', '2025-11-02 00:00:00', '2025-11-02 03:30:00', NULL, NULL, 'Scheduled', 1, 19, 1, 14000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(19, 'PR1019', '2025-11-03 13:00:00', '2025-11-03 23:00:00', NULL, NULL, 'Scheduled', 1, 20, 1, 48000.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(20, 'PR1020', '2025-11-05 01:00:00', '2025-11-05 03:00:00', NULL, NULL, 'Scheduled', 1, 6, 1, 3900.00, '2025-10-16 13:39:53', '2025-10-16 13:39:53');

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
(4, '2025_09_22_145432_add_two_factor_columns_to_users_table', 1);

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
(2, 2, 'Maria Santos', 'P654321', '1993-11-20', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(3, 3, 'Pedro Ramos', 'P765432', '1989-01-08', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(4, 4, 'Anna Lopez', 'P222333', '1995-02-14', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(5, 5, 'Carlos Reyes', 'P111444', '1992-06-03', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(6, 6, 'Fatima Lim', 'P888999', '1988-07-25', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(7, 7, 'Jose Tan', 'P111555', '1985-03-19', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(8, 8, 'Ricardo Uy', 'P555111', '1991-10-10', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(9, 9, 'Andrea Cruz', 'P667788', '1998-12-12', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(10, 10, 'Miguel Garcia', 'P990011', '1986-04-28', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(11, 11, 'Admin One', NULL, '1984-01-10', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(12, 12, 'Admin Two', NULL, '1983-09-22', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(13, 13, 'Sofia Rivera', 'P112233', '1999-05-05', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(14, 14, 'Lorenzo dela Vega', 'P445566', '1997-07-07', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(15, 15, 'Isabel Ong', 'P778899', '1994-08-09', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(16, 16, 'Paolo Fernandez', 'P998877', '1992-02-02', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(17, 17, 'Cristina Navarro', 'P554433', '1993-09-09', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(18, 18, 'Jasmine Go', 'P223344', '1990-10-20', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(19, 19, 'Robert Chua', 'P665544', '1987-12-15', '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(20, 20, 'Elena Ramos', 'P009988', '1995-03-03', '2025-10-16 13:39:53', '2025-10-16 13:39:53');

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
(19, 19, '2B', 'Business', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(20, 20, '2B', 'Economy', 1, '2025-10-16 13:39:53', '2025-10-16 13:39:53');

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
('QQvsde5VOGnaLszzeFBYiFpLJkVe6kXoTitjKcqd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicEFGaVk5VEdvRWtQdWhtZ1liOUNUM1RzUUlJVkk2NFpZWkVXY2JvTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1763813595);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `passport`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Juan Dela Cruz', 'juan@gmail.com', '2025-11-22 02:04:46', '$2y$12$Y4YDjztZ7xICKrbUyH/r1.UNbl/F3dS5fiS.cE1FQ1pKdnIoI9Jma', 'customer', 'P123456', 'eyJpdiI6InJVMFd1d1Q2d2g5TnJ0Sm51QzJOVnc9PSIsInZhbHVlIjoiVnM5Uy9SRmlma3VwZTgvMXRseS9KajJwc1pyQ0pHMENpQXhmS3drcmVzaz0iLCJtYWMiOiJlYTY3YWUxOGVjNGMyMzNhNzVhZjU1MjY3OGM2MWJmYmNlNTUzYTQyYzM4ZTZkYWM4MjFjMmUyOWQ0Y2NlMTk2IiwidGFnIjoiIn0=', 'eyJpdiI6IjFDVVZIbm15MWFvYnhvNU4xT2RCYWc9PSIsInZhbHVlIjoianYxU1RLL2l6UFF6K085azlVYm04RUczalJ4Rk9Hajg2akdxV05iRGJTY1kvZFpJdUUxUUhuZEltaEhQOTc5ZTNTZDV5SDNmWWZMMXd5cW9KYVdCc2pVSFk1SEtGQ09tVUlFZ0dwdDNvdTNnRkI2Uk1uemEreGZHaUJrKytYK2QxNVRjUm5NOXBoNU9BSXpxY1piL2dENWZyRFNyd2RlYU51V0R3STFjQnVjWWNUVXIrR1hIWDVqZ3E4RUNEemFqbytYRlV0U3hhT3FGZWtCdkNjUVdJZnl1b0FpRXI3YUdsOUZWOGFzZXFMMzlUWXhMNVlWTHhOekh1TTVGY3ZudTh4d0ZTSmI5Wm9SYTU3U1c2a2pYZVE9PSIsIm1hYyI6IjVmYjFkMDllNmIxNmIzZmVmMTYwNTQ4ZGQwNWRjMjNjYzdjZDlkNjUwNGNiZjA3MDM0ODg4MDkyOWI1OGFlYjkiLCJ0YWciOiIifQ==', NULL, NULL, '2025-10-16 13:39:53', '2025-11-21 18:14:47'),
(2, 'Maria Santos', 'maria@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P654321', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(3, 'Pedro Ramos', 'pedro@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P765432', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(4, 'Anna Lopez', 'anna@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P222333', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(5, 'Carlos Reyes', 'carlos@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P111444', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(6, 'Fatima Lim', 'fatima@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P888999', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(7, 'Jose Tan', 'jose@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P111555', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(8, 'Ricardo Uy', 'ricardo@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P555111', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(9, 'Andrea Cruz', 'andrea@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P667788', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(10, 'Miguel Garcia', 'miguel@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P990011', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(11, 'Admin One', 'admin1@air2holiday.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL, NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(12, 'Admin Two', 'admin2@air2holiday.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL, NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(13, 'Sofia Rivera', 'sofia@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P112233', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(14, 'Lorenzo dela Vega', 'lorenzo@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P445566', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(15, 'Isabel Ong', 'isabel@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P778899', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(16, 'Paolo Fernandez', 'paolo@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P998877', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(17, 'Cristina Navarro', 'cristina@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P554433', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(18, 'Jasmine Go', 'jasmine@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P223344', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(19, 'Robert Chua', 'robert@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P665544', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(20, 'Elena Ramos', 'elena@gmail.com', '2025-11-22 02:04:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', 'P009988', NULL, NULL, NULL, NULL, '2025-10-16 13:39:53', '2025-10-16 13:39:53'),
(21, 'Emiel Benedict D. Jane', 'emieljane121@gmail.com', NULL, '$2y$12$k4WbhlGKTq/bw.82I7klhOpef4PytI72MQbjA6lpH5ia/GvdFrcPm', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-11-22 02:22:25', '2025-11-22 02:22:25'),
(22, 'skibidi amogus', 'skibidi@gmail.com', NULL, '$2y$12$GA134j.X5V1SM8d3ms4jOO.S/ZVtZCXkh1SahmUAMzr/XeloLXuGu', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-11-22 03:28:14', '2025-11-22 03:28:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `airlines_code_unique` (`code`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `airports`
--
ALTER TABLE `airports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

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
