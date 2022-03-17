-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql.scriptedmiller.com
-- Generation Time: Mar 16, 2022 at 08:21 PM
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
-- Table structure for table `winter2022_feeds`
--

CREATE TABLE `winter2022_feeds` (
  `FeedID` int UNSIGNED NOT NULL,
  `CategoryID` int UNSIGNED DEFAULT '0',
  `AdminID` int UNSIGNED DEFAULT '0',
  `Title` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `Link` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
  `DateAdded` datetime DEFAULT NULL,
  `LastUpdated` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `winter2022_feeds`
--

INSERT INTO `winter2022_feeds` (`FeedID`, `CategoryID`, `AdminID`, `Title`, `Link`, `DateAdded`, `LastUpdated`) VALUES
(1, 1, 1, 'Chanterelles', 'https://news.google.com/rss/search?q=chanterelle&hl=en-US&gl=US&ceid=US:en', '2022-03-05 21:16:38', '2022-03-06 05:16:38'),
(2, 1, 1, 'Morels', 'https://news.google.com/rss/search?q=morel&hl=en-US&gl=US&ceid=US:en', '2022-03-05 21:16:38', '2022-03-06 05:16:38'),
(3, 1, 1, 'Psilocybe', 'https://news.google.com/rss/search?q=psilocybe&hl=en-US&gl=US&ceid=US:en', '2022-03-05 21:16:38', '2022-03-06 05:16:38'),
(4, 2, 1, 'Jazz', 'https://news.google.com/rss/search?q=jazz&hl=en-US&gl=US&ceid=US:en', '2022-03-05 21:16:38', '2022-03-06 05:16:38'),
(5, 2, 1, 'Rock and Roll', 'https://news.google.com/rss/search?q=rockandroll&hl=en-US&gl=US&ceid=US:en', '2022-03-05 21:16:38', '2022-03-16 23:56:31'),
(6, 2, 1, 'Hip Hop', 'https://news.google.com/rss/search?q=hiphop&hl=en-US&gl=US&ceid=US:en', '2022-03-05 21:16:38', '2022-03-06 05:16:38'),
(7, 3, 1, 'New Yorker', 'https://www.newyorker.com/feed/tech', '2022-03-05 21:16:38', '2022-03-06 05:16:38'),
(8, 3, 1, 'Wired', 'https://www.wired.com/feed/category/gear/latest/rss', '2022-03-05 21:16:38', '2022-03-06 05:16:38'),
(9, 3, 1, 'Computer Weekly', 'https://www.computerweekly.com/rss/IT-careers-and-IT-skills.xml', '2022-03-05 21:16:38', '2022-03-06 05:16:38'),
(10, 2, 0, 'Pitchfork Album Reviews', 'https://pitchfork.com/feed/feed-album-reviews/rss', NULL, '0000-00-00 00:00:00'),
(11, 2, 1, 'Garage Hangover', 'https://garagehangover.com/feed', NULL, '0000-00-00 00:00:00'),
(12, 2, 1, 'Funk My Soul', 'https://www.funkmysoul.gr/feed', NULL, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `winter2022_feeds`
--
ALTER TABLE `winter2022_feeds`
  ADD PRIMARY KEY (`FeedID`),
  ADD KEY `CategoryID_index` (`CategoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `winter2022_feeds`
--
ALTER TABLE `winter2022_feeds`
  MODIFY `FeedID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `winter2022_feeds`
--
ALTER TABLE `winter2022_feeds`
  ADD CONSTRAINT `winter2022_feeds_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `winter2022_categories` (`CategoryID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
