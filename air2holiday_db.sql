-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2025 at 03:47 PM
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
  `id` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`id`, `name`, `code`) VALUES
('a1', 'Philippine Airlines', 'PR');

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `iata_code` varchar(10) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id`, `name`, `iata_code`, `location`) VALUES
('ap1', 'Ninoy Aquino International Airport', 'MNL', 'Manila, Philippines'),
('ap10', 'Puerto Princesa International Airport', 'PPS', 'Palawan, Philippines'),
('ap11', 'Clark International Airport', 'CRK', 'Pampanga, Philippines'),
('ap12', 'Bohol–Panglao International Airport', 'TAG', 'Bohol, Philippines'),
('ap13', 'Caticlan Airport', 'MPH', 'Malay, Aklan, Philippines'),
('ap14', 'Roxas Airport', 'RXS', 'Capiz, Philippines'),
('ap15', 'Tuguegarao Airport', 'TUG', 'Cagayan, Philippines'),
('ap16', 'Singapore Changi Airport', 'SIN', 'Singapore'),
('ap17', 'Hong Kong International Airport', 'HKG', 'Hong Kong'),
('ap18', 'Narita International Airport', 'NRT', 'Tokyo, Japan'),
('ap19', 'Incheon International Airport', 'ICN', 'Seoul, South Korea'),
('ap2', 'Mactan–Cebu International Airport', 'CEB', 'Cebu, Philippines'),
('ap20', 'Los Angeles International Airport', 'LAX', 'Los Angeles, USA'),
('ap3', 'Francisco Bangoy International Airport', 'DVO', 'Davao, Philippines'),
('ap4', 'Iloilo International Airport', 'ILO', 'Iloilo, Philippines'),
('ap5', 'Laoag International Airport', 'LAO', 'Ilocos Norte, Philippines'),
('ap6', 'Kalibo International Airport', 'KLO', 'Aklan, Philippines'),
('ap7', 'Bacolod–Silay International Airport', 'BCD', 'Negros Occidental, Philippines'),
('ap8', 'Tacloban Airport', 'TAC', 'Leyte, Philippines'),
('ap9', 'Zamboanga International Airport', 'ZAM', 'Zamboanga City, Philippines');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` varchar(36) NOT NULL,
  `entity_type` varchar(50) DEFAULT NULL,
  `entity_id` varchar(36) DEFAULT NULL,
  `change_type` varchar(50) DEFAULT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `changed_by` varchar(50) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `entity_type`, `entity_id`, `change_type`, `changed_at`, `changed_by`, `details`) VALUES
('al1', 'flight', 'f1', 'Update', '2025-10-16 13:39:53', 'admin1@air2holiday.com', 'Updated status to Scheduled'),
('al2', 'booking', 'b5', 'Delete', '2025-10-16 13:39:53', 'admin2@air2holiday.com', 'Booking cancelled due to payment failure'),
('al3', 'user', 'u1', 'Update', '2025-10-16 13:39:53', 'admin1@air2holiday.com', 'Password reset request processed'),
('al4', 'payment', 'p9', 'Update', '2025-10-16 13:39:53', 'admin2@air2holiday.com', 'Refund processed successfully'),
('al5', 'flight', 'f10', 'Insert', '2025-10-16 13:39:53', 'admin1@air2holiday.com', 'New LAX route added');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` varchar(36) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT NULL,
  `user_id` varchar(36) NOT NULL,
  `payment_id` varchar(36) DEFAULT NULL,
  `flight_id` varchar(36) NOT NULL,
  `seat_number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_date`, `status`, `user_id`, `payment_id`, `flight_id`, `seat_number`) VALUES
('b1', '2025-10-16 13:39:53', 'Confirmed', 'u1', 'p1', 'f1', '1A'),
('b10', '2025-10-16 13:39:53', 'Confirmed', 'u10', 'p10', 'f10', '1A'),
('b11', '2025-10-16 13:39:53', 'Confirmed', 'u11', 'p11', 'f11', '2B'),
('b12', '2025-10-16 13:39:53', 'Confirmed', 'u12', 'p12', 'f12', '2B'),
('b13', '2025-10-16 13:39:53', 'Confirmed', 'u13', 'p13', 'f13', '2B'),
('b14', '2025-10-16 13:39:53', 'Confirmed', 'u14', 'p14', 'f14', '2B'),
('b15', '2025-10-16 13:39:53', 'Pending', 'u15', 'p15', 'f15', '2B'),
('b16', '2025-10-16 13:39:53', 'Confirmed', 'u16', 'p16', 'f16', '2B'),
('b17', '2025-10-16 13:39:53', 'Confirmed', 'u17', 'p17', 'f17', '2B'),
('b18', '2025-10-16 13:39:53', 'Confirmed', 'u18', 'p18', 'f18', '2B'),
('b19', '2025-10-16 13:39:53', 'Cancelled', 'u19', 'p19', 'f19', '2B'),
('b2', '2025-10-16 13:39:53', 'Confirmed', 'u2', 'p2', 'f2', '1A'),
('b20', '2025-10-16 13:39:53', 'Confirmed', 'u20', 'p20', 'f20', '2B'),
('b3', '2025-10-16 13:39:53', 'Pending', 'u3', 'p3', 'f3', '1A'),
('b4', '2025-10-16 13:39:53', 'Confirmed', 'u4', 'p4', 'f4', '1A'),
('b5', '2025-10-16 13:39:53', 'Cancelled', 'u5', 'p5', 'f5', '1A'),
('b6', '2025-10-16 13:39:53', 'Confirmed', 'u6', 'p6', 'f6', '1A'),
('b7', '2025-10-16 13:39:53', 'Confirmed', 'u7', 'p7', 'f7', '1A'),
('b8', '2025-10-16 13:39:53', 'Confirmed', 'u8', 'p8', 'f8', '1A'),
('b9', '2025-10-16 13:39:53', 'Refunded', 'u9', 'p9', 'f9', '1A');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` varchar(36) NOT NULL,
  `flight_number` varchar(20) NOT NULL,
  `scheduled_departure` timestamp NOT NULL DEFAULT current_timestamp(),
  `scheduled_arrival` timestamp NULL DEFAULT NULL,
  `actual_departure` timestamp NULL DEFAULT NULL,
  `actual_arrival` timestamp NULL DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `airline_id` varchar(36) NOT NULL,
  `departure_airport_id` varchar(36) NOT NULL,
  `arrival_airport_id` varchar(36) NOT NULL,
  `base_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `flight_number`, `scheduled_departure`, `scheduled_arrival`, `actual_departure`, `actual_arrival`, `status`, `airline_id`, `departure_airport_id`, `arrival_airport_id`, `base_price`) VALUES
('f1', 'PR1001', '2025-10-20 00:00:00', '2025-10-20 02:00:00', NULL, NULL, 'Scheduled', 'a1', 'ap1', 'ap2', 3500.00),
('f10', 'PR1010', '2025-10-25 12:00:00', '2025-10-25 22:00:00', NULL, NULL, 'Scheduled', 'a1', 'ap1', 'ap20', 48000.00),
('f11', 'PR1011', '2025-10-26 01:00:00', '2025-10-26 03:00:00', NULL, NULL, 'Scheduled', 'a1', 'ap2', 'ap1', 3500.00),
('f12', 'PR1012', '2025-10-27 02:00:00', '2025-10-27 04:00:00', NULL, NULL, 'Scheduled', 'a1', 'ap3', 'ap1', 4500.00),
('f13', 'PR1013', '2025-10-28 00:00:00', '2025-10-28 02:30:00', NULL, NULL, 'Scheduled', 'a1', 'ap5', 'ap1', 3300.00),
('f14', 'PR1014', '2025-10-28 23:30:00', '2025-10-29 01:30:00', NULL, NULL, 'Scheduled', 'a1', 'ap10', 'ap1', 5000.00),
('f15', 'PR1015', '2025-10-30 05:00:00', '2025-10-30 08:30:00', NULL, NULL, 'Scheduled', 'a1', 'ap16', 'ap1', 12000.00),
('f16', 'PR1016', '2025-10-31 04:30:00', '2025-10-31 07:30:00', NULL, NULL, 'Scheduled', 'a1', 'ap17', 'ap1', 11000.00),
('f17', 'PR1017', '2025-11-01 02:00:00', '2025-11-01 05:00:00', NULL, NULL, 'Scheduled', 'a1', 'ap18', 'ap1', 13500.00),
('f18', 'PR1018', '2025-11-02 00:00:00', '2025-11-02 03:30:00', NULL, NULL, 'Scheduled', 'a1', 'ap19', 'ap1', 14000.00),
('f19', 'PR1019', '2025-11-03 13:00:00', '2025-11-03 23:00:00', NULL, NULL, 'Scheduled', 'a1', 'ap20', 'ap1', 48000.00),
('f2', 'PR1002', '2025-10-20 03:00:00', '2025-10-20 05:00:00', NULL, NULL, 'Scheduled', 'a1', 'ap1', 'ap3', 4500.00),
('f20', 'PR1020', '2025-11-05 01:00:00', '2025-11-05 03:00:00', NULL, NULL, 'Scheduled', 'a1', 'ap6', 'ap1', 3900.00),
('f3', 'PR1003', '2025-10-21 01:30:00', '2025-10-21 03:00:00', NULL, NULL, 'Scheduled', 'a1', 'ap1', 'ap4', 2800.00),
('f4', 'PR1004', '2025-10-21 23:00:00', '2025-10-22 01:30:00', NULL, NULL, 'Scheduled', 'a1', 'ap1', 'ap5', 3300.00),
('f5', 'PR1005', '2025-10-22 07:00:00', '2025-10-22 09:30:00', NULL, NULL, 'Scheduled', 'a1', 'ap1', 'ap10', 5000.00),
('f6', 'PR1006', '2025-10-23 06:00:00', '2025-10-23 09:00:00', NULL, NULL, 'Scheduled', 'a1', 'ap1', 'ap16', 12000.00),
('f7', 'PR1007', '2025-10-23 01:00:00', '2025-10-23 04:30:00', NULL, NULL, 'Scheduled', 'a1', 'ap1', 'ap17', 11000.00),
('f8', 'PR1008', '2025-10-23 22:00:00', '2025-10-24 01:30:00', NULL, NULL, 'Scheduled', 'a1', 'ap1', 'ap18', 13500.00),
('f9', 'PR1009', '2025-10-24 04:00:00', '2025-10-24 07:30:00', NULL, NULL, 'Scheduled', 'a1', 'ap1', 'ap19', 14000.00);

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE `passengers` (
  `id` varchar(36) NOT NULL,
  `booking_id` varchar(36) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `passport` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`id`, `booking_id`, `name`, `passport`, `date_of_birth`) VALUES
('ps1', 'b1', 'Juan Dela Cruz', 'P123456', '1990-05-12'),
('ps10', 'b10', 'Miguel Garcia', 'P990011', '1986-04-28'),
('ps11', 'b11', 'Admin One', NULL, '1984-01-10'),
('ps12', 'b12', 'Admin Two', NULL, '1983-09-22'),
('ps13', 'b13', 'Sofia Rivera', 'P112233', '1999-05-05'),
('ps14', 'b14', 'Lorenzo dela Vega', 'P445566', '1997-07-07'),
('ps15', 'b15', 'Isabel Ong', 'P778899', '1994-08-09'),
('ps16', 'b16', 'Paolo Fernandez', 'P998877', '1992-02-02'),
('ps17', 'b17', 'Cristina Navarro', 'P554433', '1993-09-09'),
('ps18', 'b18', 'Jasmine Go', 'P223344', '1990-10-20'),
('ps19', 'b19', 'Robert Chua', 'P665544', '1987-12-15'),
('ps2', 'b2', 'Maria Santos', 'P654321', '1993-11-20'),
('ps20', 'b20', 'Elena Ramos', 'P009988', '1995-03-03'),
('ps3', 'b3', 'Pedro Ramos', 'P765432', '1989-01-08'),
('ps4', 'b4', 'Anna Lopez', 'P222333', '1995-02-14'),
('ps5', 'b5', 'Carlos Reyes', 'P111444', '1992-06-03'),
('ps6', 'b6', 'Fatima Lim', 'P888999', '1988-07-25'),
('ps7', 'b7', 'Jose Tan', 'P111555', '1985-03-19'),
('ps8', 'b8', 'Ricardo Uy', 'P555111', '1991-10-10'),
('ps9', 'b9', 'Andrea Cruz', 'P667788', '1998-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` varchar(36) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `method` varchar(50) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `method`, `payment_date`, `status`) VALUES
('p1', 5000.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid'),
('p10', 6000.00, 'Debit Card', '2025-10-16 13:39:53', 'Paid'),
('p11', 4800.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid'),
('p12', 7200.00, 'GCash', '2025-10-16 13:39:53', 'Paid'),
('p13', 3100.00, 'PayMaya', '2025-10-16 13:39:53', 'Paid'),
('p14', 8500.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid'),
('p15', 9990.00, 'GCash', '2025-10-16 13:39:53', 'Paid'),
('p16', 4000.00, 'Credit Card', '2025-10-16 13:39:53', 'Pending'),
('p17', 5400.00, 'Debit Card', '2025-10-16 13:39:53', 'Paid'),
('p18', 3200.00, 'Cash', '2025-10-16 13:39:53', 'Paid'),
('p19', 3800.00, 'PayMaya', '2025-10-16 13:39:53', 'Paid'),
('p2', 3200.00, 'GCash', '2025-10-16 13:39:53', 'Paid'),
('p20', 12000.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid'),
('p3', 6800.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid'),
('p4', 4500.00, 'Debit Card', '2025-10-16 13:39:53', 'Paid'),
('p5', 7000.00, 'GCash', '2025-10-16 13:39:53', 'Pending'),
('p6', 4800.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid'),
('p7', 2500.00, 'Cash', '2025-10-16 13:39:53', 'Paid'),
('p8', 9100.00, 'Credit Card', '2025-10-16 13:39:53', 'Paid'),
('p9', 3500.00, 'PayMaya', '2025-10-16 13:39:53', 'Refunded');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `flight_id` varchar(36) NOT NULL,
  `seat_number` varchar(10) NOT NULL,
  `class` varchar(50) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`flight_id`, `seat_number`, `class`, `is_available`) VALUES
('f1', '1A', 'Economy', 1),
('f10', '1A', 'Business', 1),
('f11', '2B', 'Economy', 1),
('f12', '2B', 'Economy', 1),
('f13', '2B', 'Economy', 1),
('f14', '2B', 'Economy', 1),
('f15', '2B', 'Business', 1),
('f16', '2B', 'Business', 1),
('f17', '2B', 'Business', 1),
('f18', '2B', 'Business', 1),
('f19', '2B', 'Business', 1),
('f2', '1A', 'Economy', 1),
('f20', '2B', 'Economy', 1),
('f3', '1A', 'Economy', 1),
('f4', '1A', 'Economy', 1),
('f5', '1A', 'Economy', 1),
('f6', '1A', 'Business', 1),
('f7', '1A', 'Business', 1),
('f8', '1A', 'Business', 1),
('f9', '1A', 'Business', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(36) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `passport` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `passport`, `role`, `created_at`) VALUES
('u1', 'Juan Dela Cruz', 'juan@gmail.com', 'hashedpass1', 'P123456', 'customer', '2025-10-16 13:39:53'),
('u10', 'Miguel Garcia', 'miguel@gmail.com', 'hashedpass10', 'P990011', 'customer', '2025-10-16 13:39:53'),
('u11', 'Admin One', 'admin1@air2holiday.com', '$2b$12$1wVwJmDjEmZ9Qfb7MKl5t.OTIfAHCKd5OjybsLfDo3C11BFk.lAGe', NULL, 'admin', '2025-10-16 13:39:53'),
('u12', 'Admin Two', 'admin2@air2holiday.com', 'adminhash2', NULL, 'admin', '2025-10-16 13:39:53'),
('u13', 'Sofia Rivera', 'sofia@gmail.com', 'hash13', 'P112233', 'customer', '2025-10-16 13:39:53'),
('u14', 'Lorenzo dela Vega', 'lorenzo@gmail.com', 'hash14', 'P445566', 'customer', '2025-10-16 13:39:53'),
('u15', 'Isabel Ong', 'isabel@gmail.com', 'hash15', 'P778899', 'customer', '2025-10-16 13:39:53'),
('u16', 'Paolo Fernandez', 'paolo@gmail.com', 'hash16', 'P998877', 'customer', '2025-10-16 13:39:53'),
('u17', 'Cristina Navarro', 'cristina@gmail.com', 'hash17', 'P554433', 'customer', '2025-10-16 13:39:53'),
('u18', 'Jasmine Go', 'jasmine@gmail.com', 'hash18', 'P223344', 'customer', '2025-10-16 13:39:53'),
('u19', 'Robert Chua', 'robert@gmail.com', 'hash19', 'P665544', 'customer', '2025-10-16 13:39:53'),
('u2', 'Maria Santos', 'maria@gmail.com', 'hashedpass2', 'P654321', 'customer', '2025-10-16 13:39:53'),
('u20', 'Elena Ramos', 'elena@gmail.com', 'hash20', 'P009988', 'customer', '2025-10-16 13:39:53'),
('u3', 'Pedro Ramos', 'pedro@gmail.com', 'hashedpass3', 'P765432', 'customer', '2025-10-16 13:39:53'),
('u4', 'Anna Lopez', 'anna@gmail.com', 'hashedpass4', 'P222333', 'customer', '2025-10-16 13:39:53'),
('u5', 'Carlos Reyes', 'carlos@gmail.com', 'hashedpass5', 'P111444', 'customer', '2025-10-16 13:39:53'),
('u6', 'Fatima Lim', 'fatima@gmail.com', 'hashedpass6', 'P888999', 'customer', '2025-10-16 13:39:53'),
('u7', 'Jose Tan', 'jose@gmail.com', 'hashedpass7', 'P111555', 'customer', '2025-10-16 13:39:53'),
('u8', 'Ricardo Uy', 'ricardo@gmail.com', 'hashedpass8', 'P555111', 'customer', '2025-10-16 13:39:53'),
('u9', 'Andrea Cruz', 'andrea@gmail.com', 'hashedpass9', 'P667788', 'customer', '2025-10-16 13:39:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iata_code` (`iata_code`);

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
  ADD UNIQUE KEY `flight_id` (`flight_id`,`seat_number`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `airline_id` (`airline_id`),
  ADD KEY `departure_airport_id` (`departure_airport_id`),
  ADD KEY `arrival_airport_id` (`arrival_airport_id`);

--
-- Indexes for table `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`flight_id`,`seat_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `passport` (`passport`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `flights_ibfk_2` FOREIGN KEY (`departure_airport_id`) REFERENCES `airports` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `flights_ibfk_3` FOREIGN KEY (`arrival_airport_id`) REFERENCES `airports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `passengers`
--
ALTER TABLE `passengers`
  ADD CONSTRAINT `passengers_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
