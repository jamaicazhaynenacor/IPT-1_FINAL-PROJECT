-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 09:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin') NOT NULL DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `fullname`, `email`, `role`, `created_at`) VALUES
(4, 'jamaica12', '$2y$10$yaeqdtD.Wx/ncdxtSikkcOnPLpXePU2lfR0peVenUMozAtaQwtSYG', 'Jamaica Zhayne Nacor', 'jamaicazhaynenacor@example.com', 'admin', '2024-12-06 17:10:29'),
(6, 'princess13', '$2y$10$PVZ04FyVVQA1LuWNFnW6y.LCw59B8uB2t4ghrPLkuKn/7h4KSf2v.', 'Princess Vitto', 'princessvitto@example.com', 'admin', '2024-12-11 08:07:46'),
(7, 'leigh14', '$2y$10$/qBU15YZdKzH3qJPQfEWMOkPoKNsjbWBlqlhOwyQPfoD8jtV9c4Si', 'Lea Lyn Ancheta', 'leighancheta@example.com', 'admin', '2024-12-11 08:08:12'),
(8, 'earl15', '$2y$10$BwgTe.ti6fylyp8u5LjiRepTCMK6ofF4NHDaUaT/qKyx6p6HT1fAa', 'Earl Raisen Carretero', 'earlraisencarreteri@example.com', 'admin', '2024-12-11 08:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `clearances`
--

CREATE TABLE `clearances` (
  `id` int(11) NOT NULL,
  `clearance_code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `contact` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clearances`
--

INSERT INTO `clearances` (`id`, `clearance_code`, `name`, `address`, `age`, `purpose`, `date`, `contact`) VALUES
(1, 'BGC-20241209-7631', 'Jamaica Zhayne Nacor', 'San Antonio (Millabas)', 20, 'Work', '2024-12-05', '0912345679'),
(2, 'BGC-20241209-9686', 'Princess Vitto', 'San Antonio (Millabas)', 20, 'work', '2024-12-28', '0912345672'),
(3, 'BGC-20241209-3718', 'Lea Lyn Ancheta', 'San Antonio (Millabas)', 20, 'work', '2024-12-04', '0912345671'),
(4, 'BGC-20241211-5072', 'Earl Raisen Carretero', 'San Antonio (Millabas)', 20, 'work', '2024-12-21', '0912345672');

-- --------------------------------------------------------

--
-- Table structure for table `indigencies`
--

CREATE TABLE `indigencies` (
  `id` int(11) NOT NULL,
  `indigency_code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `purpose` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `role` enum('admin','viewer','editor') DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `address`, `username`, `password`, `email`, `phone`, `role`, `status`, `created_at`) VALUES
(19, 'Jamaica Zhayne Nacor', 'Estanza', 'jamaica00', '', 'jamaica@gmail.com', '0912345674', 'admin', 'active', '2024-12-06 01:03:26'),
(20, 'Princess Vitto', 'Millabas', 'cess1', '', 'cess@gmail.com', '0912345672', 'admin', 'active', '2024-12-06 01:04:41'),
(21, 'Lea Lyn Ancheta', 'n/a', 'leigh12', '', 'leigh@gmail.com', '0912345675', 'admin', 'active', '2024-12-06 01:05:17'),
(22, 'Earl Raisen Carretero', 'n/a', 'earl11', '', 'earl@gmail.com', '0912345673', 'admin', 'active', '2024-12-06 01:06:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `clearances`
--
ALTER TABLE `clearances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indigencies`
--
ALTER TABLE `indigencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `fullname` (`fullname`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clearances`
--
ALTER TABLE `clearances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `indigencies`
--
ALTER TABLE `indigencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
