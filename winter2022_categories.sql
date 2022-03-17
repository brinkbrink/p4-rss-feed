-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql.scriptedmiller.com
-- Generation Time: Mar 16, 2022 at 05:02 PM
-- Server version: 8.0.28-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miller_client_prototype_w22`
--

-- --------------------------------------------------------

--
-- Table structure for table `winter2022_categories`
--

CREATE TABLE `winter2022_categories` (
  `CategoryID` int UNSIGNED NOT NULL,
  `AdminID` int UNSIGNED DEFAULT '0',
  `Title` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `DateAdded` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `winter2022_categories`
--

INSERT INTO `winter2022_categories` (`CategoryID`, `AdminID`, `Title`, `DateAdded`) VALUES
(1, 1, 'Mushrooms', '2022-03-05 21:16:37'),
(2, 1, 'Music', '2022-03-05 21:16:37'),
(3, 1, 'Tech', '2022-03-05 21:16:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `winter2022_categories`
--
ALTER TABLE `winter2022_categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `winter2022_categories`
--
ALTER TABLE `winter2022_categories`
  MODIFY `CategoryID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
