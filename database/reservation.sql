-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2026 at 07:21 AM
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
-- Database: `reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hall_id` varchar(11) DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `approval_status` varchar(50) DEFAULT NULL,
  `supervisor_remarks` mediumtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `booking_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `hall_id`, `purpose`, `start_datetime`, `end_datetime`, `approval_status`, `supervisor_remarks`, `created_at`, `booking_id`) VALUES
(6, 0, 'BM', 'KURSUS ADOBE PHOTOSHOP', '2026-03-17 21:20:00', '2026-03-18 21:21:00', 'Pending', NULL, '2026-03-12 21:21:11', NULL),
(7, 0, 'BM', 'KURSUS ADOBE PHOTOSHOP', '2026-03-17 17:21:00', '2026-03-17 18:21:00', 'Approved', '', '2026-03-12 21:22:07', NULL),
(12, 2, 'MAK', 'KURSUS ADOBE PHOTOSHOP', '2026-03-11 11:39:00', '2026-03-11 12:39:00', 'Rejected', '', '2026-03-12 23:40:00', NULL),
(13, 2, 'MK', 'KURSUS ADOBE PHOTOSHOP', '2026-04-13 11:46:00', '2026-04-16 23:46:00', 'Pending', NULL, '2026-03-12 23:46:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE `halls` (
  `id` int(11) NOT NULL,
  `hall_id` varchar(50) DEFAULT NULL,
  `hall_name` varchar(50) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`id`, `hall_id`, `hall_name`, `capacity`, `location`, `status`) VALUES
(1, 'BM', 'BILIK MESYUARAT', 50, 'TINGKAT 1 BLOK A', '1'),
(2, 'MAK', 'MAKMAL APLIKASI KOMPUTER', 50, 'TINGKAT 1 BLOK A', '1'),
(3, 'MK', 'MAKMAL KOMPUTER', 50, 'TINGKAT 1 BLOK A', '1'),
(4, 'MR1', 'MAKMAL RANGKAIAN 1', 60, NULL, '0'),
(5, 'DS', 'DEWAN SYARAHAN', 100, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `lookup_references`
--

CREATE TABLE `lookup_references` (
  `id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservationuggroups`
--

CREATE TABLE `reservationuggroups` (
  `GroupID` int(11) NOT NULL,
  `Label` varchar(300) DEFAULT NULL,
  `Provider` varchar(10) DEFAULT '',
  `Comment` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reservationuggroups`
--

INSERT INTO `reservationuggroups` (`GroupID`, `Label`, `Provider`, `Comment`) VALUES
(1, 'Pemohon', '', NULL),
(2, 'Penyelia', '', NULL),
(3, 'Pentadbir', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservationugmembers`
--

CREATE TABLE `reservationugmembers` (
  `UserName` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL,
  `Provider` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reservationugmembers`
--

INSERT INTO `reservationugmembers` (`UserName`, `GroupID`, `Provider`) VALUES
('admin', -1, '');

-- --------------------------------------------------------

--
-- Table structure for table `reservationugrights`
--

CREATE TABLE `reservationugrights` (
  `TableName` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL,
  `AccessMask` varchar(10) DEFAULT NULL,
  `Page` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reservationugrights`
--

INSERT INTO `reservationugrights` (`TableName`, `GroupID`, `AccessMask`, `Page`) VALUES
('<global>', -1, 'ADESPIM', NULL),
('bookings', -1, 'ADESPIM', NULL),
('halls', -1, 'ADESPIM', NULL),
('lookup_references', -1, 'ADESPIM', NULL),
('users', -1, 'ADESPIM', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_audit`
--

CREATE TABLE `reservation_audit` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `ip` varchar(40) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `table` varchar(300) DEFAULT NULL,
  `action` varchar(250) NOT NULL,
  `description` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reservation_audit`
--

INSERT INTO `reservation_audit` (`id`, `datetime`, `ip`, `user`, `table`, `action`, `description`) VALUES
(1, '2026-03-12 11:13:04', '127.0.0.1', 'admin', 'users', 'failed login', ''),
(2, '2026-03-12 11:13:55', '127.0.0.1', 'admin', 'users', 'login', ''),
(3, '2026-03-12 11:51:38', '127.0.0.1', 'admin', 'users', 'login', ''),
(4, '2026-03-12 12:50:08', '127.0.0.1', 'admin', 'users', 'logout', ''),
(5, '2026-03-12 12:50:14', '127.0.0.1', 'admin', 'users', 'login', ''),
(6, '2026-03-13 23:39:25', '127.0.0.1', 'admin', 'users', 'login', ''),
(7, '2026-03-13 23:39:58', '127.0.0.1', 'admin', 'users', 'login', ''),
(8, '2026-03-13 23:41:05', '127.0.0.1', 'admin', 'users', 'login', ''),
(9, '2026-03-13 23:41:21', '127.0.0.1', 'admin', 'users', 'logout', ''),
(10, '2026-03-13 23:41:34', '127.0.0.1', 'admin', 'users', 'logout', ''),
(11, '2026-03-13 23:50:22', '127.0.0.1', 'admin', 'users', 'login', ''),
(12, '2026-03-13 23:50:26', '127.0.0.1', 'admin', 'users', 'logout', ''),
(13, '2026-03-13 23:53:51', '127.0.0.1', 'admin', 'users', 'login', ''),
(14, '2026-03-14 00:23:40', '127.0.0.1', 'admin', 'users', 'login', ''),
(15, '2026-03-14 00:33:35', '127.0.0.1', 'admin', 'users', 'login', ''),
(16, '2026-03-14 00:45:07', '127.0.0.1', 'admin', 'users', 'logout', ''),
(17, '2026-03-14 00:48:02', '127.0.0.1', 'admin', 'users', 'login', ''),
(18, '2026-03-14 00:48:12', '127.0.0.1', 'admin', 'users', 'logout', ''),
(19, '2026-03-14 00:48:34', '127.0.0.1', 'admin', 'users', 'login', ''),
(20, '2026-03-14 00:54:35', '127.0.0.1', 'admin', 'users', 'logout', ''),
(21, '2026-03-14 00:54:49', '127.0.0.1', 'admin', 'users', 'login', ''),
(22, '2026-03-14 00:58:08', '127.0.0.1', 'admin', 'users', 'logout', ''),
(23, '2026-03-14 00:59:59', '127.0.0.1', 'admin', 'users', 'login', ''),
(24, '2026-03-14 01:00:37', '127.0.0.1', 'admin', 'users', 'logout', ''),
(25, '2026-03-14 01:00:42', '127.0.0.1', 'user', 'users', 'login', ''),
(26, '2026-03-14 01:05:29', '127.0.0.1', 'user', 'users', 'logout', ''),
(27, '2026-03-14 01:06:23', '127.0.0.1', 'penyelia', 'users', 'login', ''),
(28, '2026-03-14 01:09:18', '127.0.0.1', 'penyelia', 'users', 'logout', ''),
(29, '2026-03-14 01:09:22', '127.0.0.1', 'admin', 'users', 'login', ''),
(30, '2026-03-14 01:09:49', '127.0.0.1', 'admin', 'users', 'logout', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `userpic` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone_number`, `role`, `full_name`, `userpic`) VALUES
(2, 'admin', '033275840560F137889CD35605B1F82B', 'admin@admin.com', NULL, '3', 'admin', NULL),
(3, 'user', '2BAE297D2BB380D6DFDD09968E1F56EC', 'user@user.com', NULL, '1', 'user', NULL),
(4, 'penyelia', '3360BFBA997296D530D60B5E1F8C051B', 'penyelia@penyelia.com', NULL, '2', 'penyelia', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `halls`
--
ALTER TABLE `halls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookup_references`
--
ALTER TABLE `lookup_references`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservationuggroups`
--
ALTER TABLE `reservationuggroups`
  ADD PRIMARY KEY (`GroupID`);

--
-- Indexes for table `reservationugmembers`
--
ALTER TABLE `reservationugmembers`
  ADD PRIMARY KEY (`UserName`(50),`GroupID`,`Provider`);

--
-- Indexes for table `reservationugrights`
--
ALTER TABLE `reservationugrights`
  ADD PRIMARY KEY (`TableName`(50),`GroupID`);

--
-- Indexes for table `reservation_audit`
--
ALTER TABLE `reservation_audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `halls`
--
ALTER TABLE `halls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lookup_references`
--
ALTER TABLE `lookup_references`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservationuggroups`
--
ALTER TABLE `reservationuggroups`
  MODIFY `GroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservation_audit`
--
ALTER TABLE `reservation_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
