-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2020 at 01:39 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `userid` int(10) NOT NULL,
  `city` varchar(52) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`userid`, `city`) VALUES
(4, 'Gustavsberg'),
(6, 'Nybro'),
(7, 'Stockholm'),
(7, 'Nybro');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(1, 'moe', '$2y$10$kFhL78J97gD3MpufCi11K.vlijLBB375JjkDPgo0nCVdXDZH8a0fy'),
(2, 'mohammed', '$2y$10$ZgLyOgd/FDacqYodL0POjukbX.9kJTXcLb7JJ4V7Nz0z07SKnnBgW'),
(3, 'Maro', '$2y$10$38eL9hB5zh3ruq99b8ZE6eAqRdopc7/Is5YnKqK.0BzAjFtflL6GW'),
(4, 'test', '$2y$10$uypvU0hqE/7NkCd.I6Y4KODTMbjBOI4smOuGNo.M8vUo.WKtJkbLm'),
(5, '123', '$2y$10$QQCccBBsnPgRLxRoB4wXPOojVrE/DMPO14CmfQaxCprpXZic4Cle2'),
(6, 'marah', '$2y$10$3QQY7KM5A5F2KeCxUAETmOnE5HUpgFpCX0SuAHb.EYMp7DiuS7JfK'),
(7, 'test2', '$2y$10$JhX6rbbkEilEa27yFpRkpO22DXSc4Fz1ZGuzojw0sywYo8d4npRQ.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
