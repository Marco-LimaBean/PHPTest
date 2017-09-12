-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2017 at 04:24 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dvd_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(6) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `contact_number` varchar(18) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sa_id_number` char(13) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `surname`, `contact_number`, `email`, `sa_id_number`, `address`) VALUES
(1, 'fFirst', 'sFirst', '0123456789012', 'first@gmail.com', '0123456789012', '14 Limabean'),
(2, 'fFirsu', 'sFirsu', '123456789014', 'first@gmail.com', '1234567890141', '14 Limabeao'),
(3, 'fFirsv', 'sFirsv', '123456789016', 'first@gmail.com', '1234567890161', '14 Limabeap'),
(4, 'fFirsw', 'sFirsw', '123456789018', 'first@gmail.com', '1234567890181', '14 Limabeaq'),
(5, 'fFirsx', 'sFirsx', '123456789020', 'first@gmail.com', '1234567890201', '14 Limabear'),
(6, 'fFirsy', 'sFirsy', '123456789022', 'first@gmail.com', '1234567890221', '14 Limabeas'),
(7, 'fFirsz', 'sFirsz', '123456789024', 'first@gmail.com', '1234567890241', '14 Limabeat'),
(8, 'fFirta', 'sFirta', '123456789026', 'first@gmail.com', '1234567890261', '14 Limabeau'),
(9, 'fFirtb', 'sFirtb', '123456789028', 'first@gmail.com', '1234567890281', '14 Limabeav'),
(11, 'Stephan', 'Wessels', '0818181818', 'badcoffee@limabean.com', '1234567890301', 'The Office'),
(17, 'Stephan', 'Of His Existence', '0818181818', 'isawesome@limabean.com', '1234567890301', 'Sales'),
(18, 'Jason', 'Wyk', '12039123011', 'email@check.com', '1234567890301', 'Other side');

-- --------------------------------------------------------

--
-- Table structure for table `dvd`
--

CREATE TABLE `dvd` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `release_date` date NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dvd`
--
ALTER TABLE `dvd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `dvd`
--
ALTER TABLE `dvd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dvd`
--
ALTER TABLE `dvd`
  ADD CONSTRAINT `dvd_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;