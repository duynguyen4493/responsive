-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2018 at 04:47 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `18php02`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'guitar'),
(2, 'organ'),
(3, 'piano'),
(4, 'saxophone'),
(5, 'loa'),
(6, 'sÃ¡o'),
(7, 'trá»‘ng Ä‘á»“ng'),
(8, 'Ä‘Ã n báº§u'),
(9, 'Ä‘Ã n nhá»‹'),
(10, 'cajon');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf16 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(26, 'ÄÃ  Náºµng'),
(27, 'Quáº£ng Trá»‹'),
(28, 'ThÃ¡i BÃ¬nh'),
(29, 'tuyÃªn quang'),
(33, 'SÃ i GÃ²n'),
(34, 'Huáº¿');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `Price` int(15) NOT NULL,
  `dayPost` date NOT NULL,
  `dayEdit` date NOT NULL,
  `imageName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `categoryId`, `productName`, `Price`, `dayPost`, `dayEdit`, `imageName`) VALUES
(10, 1, 'guitar classic 1233', 600000, '2018-06-14', '2018-06-15', 'images/1122.jpg'),
(11, 1, 'Ä‘Ã n báº§u cá»• truyá»n', 1000000, '2018-06-14', '2018-06-15', 'images/Ä‘Ã n_báº§u.jpg'),
(12, 2, 'organ1277', 1200000, '2018-06-14', '2018-06-15', 'images/keyboard CTK 1300 Casio.jpg'),
(13, 1, 'AS711 Prelude Alto Saxophone', 800000, '2018-06-14', '2018-06-15', 'images/SAS711XXX-P.jpg'),
(14, 7, 'Trá»‘ng Pearl Export Lacquer EXL725FP 01', 4000000, '2018-06-14', '2018-06-15', 'images/exl-natural-cherry.jpg'),
(15, 5, 'Loa karaoke BMB CSE 312', 500000, '2018-06-15', '2018-06-15', 'images/Loa-karaoke-BMB-CSE-312.jpg'),
(16, 3, 'ÄÃ n Piano Kawai PW-300', 9000000, '2018-06-15', '0000-00-00', 'images/13956351596.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `id_cities` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `id_cities`) VALUES
(24, 'lien', 'van11@gmail.com', '0989863267', 1),
(25, 'duy', 'duy@gmail.com', '0933333', 1),
(26, 'hoa', 'hoa@gmail.com', '0985215', 2),
(27, 'hoa', 'hoa44@gmail.com', '0935215', 3),
(28, 'duyen', 'duyen@gmail.com', '09352323626', 1),
(29, 'quan', 'quan@gmail.com', '0937777', 2),
(30, 'quan', 'quan111@gmail.com', '0937777', 3),
(31, 'luyen', 'ly@gmail.com', '083274356', 0),
(32, 'nhan', 'nhan@gmail.com', '99026354236', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
