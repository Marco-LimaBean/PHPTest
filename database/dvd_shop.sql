-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2017 at 04:34 PM
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

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'Comedy'),
(2, 'Action'),
(3, 'Adventure'),
(4, 'Horror'),
(5, 'Family'),
(6, 'Childrens');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id`             int(6) NOT NULL,
  `name`           varchar(255) DEFAULT NULL,
  `surname`        varchar(255) DEFAULT NULL,
  `contact_number` varchar(18)  DEFAULT NULL,
  `email`          varchar(255) DEFAULT NULL,
  `sa_id_number`   char(13)     DEFAULT NULL,
  `address`        VARCHAR(255) DEFAULT NULL,
  `password`       VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `surname`, `contact_number`, `email`, `sa_id_number`, `address`, `password`)
VALUES
  (1, 'fFirst', 'sFirst', '0123456789012', 'first@gmail.com', '0123456789012', '14 Limabean',
   '$2y$10$TGkan3hUflOPSwnVevJheuOvlqM8aEhdZFel4stp2XFTHBm8aHxEm'),
  (2, 'fFirsu', 'sFirsu', '123456789014', 'first@gmail.com', '1234567890141', '14 Limabeao', '$2y$10$SbeSHUJp1XFNWzjZPnBsWeXEcd8w8n5XXT5Hd4hIzFHfKWmTF3rYK'),
  (3, 'fFirsv', 'sFirsv', '123456789016', 'first@gmail.com', '1234567890161', '14 Limabeap', '$2y$10$4uXYrk0kusDipGWO.zY.juQxB/7ZVh/bYQ0Yi/HGe1Zpo0Sf3GKYG'),
  (4, 'fFirsw', 'sFirsw', '123456789018', 'first@gmail.com', '1234567890181', '14 Limabeaq', '$2y$10$7Ulv0L4OI8HFvxAvaxwXFuWUeU2zBLzzIZ5aU4hanIymZOmmV1d8S'),
  (5, 'fFirsx', 'sFirsx', '123456789020', 'first@gmail.com', '1234567890201', '14 Limabear', '$2y$10$Cf/9RTmFArOrGTKhCBc7Xu4gHv.aA7y.UrdjkTr8oy6nstCCBr5cO'),
  (6, 'fFirsy', 'sFirsy', '123456789022', 'first@gmail.com', '1234567890221', '14 Limabeas', '$2y$10$7phwfTBf2BLs/Govh8UUYu/mgG35ctHM9bWMy32M2.la78qIGf3RC'),
  (7, 'fFirsz', 'sFirsz', '123456789024', 'first@gmail.com', '1234567890241', '14 Limabeat', '$2y$10$1i5eugvQMDkDP1BHGfJuS.ZsFS8ur3Z.sVXkv97qk.5yibk2Tmceu'),
  (8, 'fFirta', 'sFirta', '123456789026', 'first@gmail.com', '1234567890261', '14 Limabeau', '$2y$10$6YvabvyTOmp5EWuZHrjowusoFAhUuIKPZG2xDmlauUiZ7/CJodaf2'),
  (9, 'fFirtb', 'sFirtb', '123456789028', 'first@gmail.com', '1234567890281', '14 Limabeav', '$2y$10$SJe5ckfrPvNa/x/xeynwSeWE0RGft8r8q.0C6VNjuZdGsat6/SH2S'),
  (11, 'Stephan', 'Wessels', '0818181818', 'badcoffee@limabean.com', '1234567890301', 'The Office', '$2y$10$sCODY25Edcs5UEfEScdgqOt/M3te4AYbg7DZZjIVWqmcz/qT05t5m'),
  (17, 'Stephan', 'Of His Existence', '0818181818', 'isawesome@limabean.com', '1234567890301', 'Sales department', '$2y$10$Bs/XiTvQ/zypMlmr5Q4cpuW7BXNnDtfAF/0RYwBeZIVFLxQrniKQ.'),
  (19, 'Jason', 'Van Wyk', '0818181818', 'jason@limabean.co.za', '1234567890301', 'Other side', '$2y$10$pAYS2apeaFLR3i9WOrLdh./1d1pCO4ZBm.7iiq5HuejUemlHpK0z6'),
  (20, 'fFirsv', 'sFirsv', '123456789016', 'first@gmail.com', '1234567890161', '14 Limabeans', ''),
  (22, 'Another', 'Surname', '13123123123', 'email@check.com', '1234567890301', 'Test', ''),
  (23, 'fFirta', 'sFirta', '123456789026', 'first@gmail.com', '1234567890261', '14 Limabean', ''),
  (24, 'fFirtb', 'sFirtb', '123456789028', 'first@gmail.com', '1234567890281', '14 Limabean', ''),
  (25, 'fFirtb', 'sFirtb', '123456789028', 'first@gmail.com', '1234567890281', '14 Limabean', ''),
  (26, 'fFirtb', 'sFirtb', '123456789028', 'first@gmail.com', '1234567890281', '14 Limabean', ''),
  (27, 'fFirtb', 'sFirtb', '123456789028', 'first@gmail.com', '1234567890281', '14 Limabean', ''),
  (28, 'fFirtb', 'sFirtb', '123456789028', 'first@gmail.com', '1234567890281', '14 Limabeav', ''),
  (29, 'fFirtb', 'sFirtb', '123456789028', 'first@gmail.com', '1234567890281', '14 Limabean', ''),
  (30, 'fFirtb', 'sFirtb', '123456789028', 'first@gmail.com', '1234567890281', '14 Limabean', ''),
  (31, 'fFirtb', 'sFirtb', '123456789028', 'first@gmail.com', '1234567890281', '14 Limabean', ''),
  (32, 'fFirta', 'sFirta', '123456789026', 'first@gmail.com', '1234567890261', '14 Limabean', '');

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
-- Dumping data for table `dvd`
--

INSERT INTO `dvd` (`id`, `name`, `description`, `release_date`, `category_id`) VALUES
  (1, 'Die Hard', 'Snape\'s in it, you know you want to watch it.', '1998-09-01', 2),
  (2, 'Logan',
   'In the near future, a weary Logan (Hugh Jackman) cares for an ailing Professor X (Patrick Stewart) at a remote outpost on the Mexican border.',
   '2017-03-01', 3),
  (3, 'The Third Movie', 'This is the third movie entry in the database', '2017-09-14', 4);

-- --------------------------------------------------------

--
-- Table structure for table `dvd_order_line`
--

CREATE TABLE `dvd_order_line` (
  `id` int(11) NOT NULL,
  `dvd_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dvd_order_line`
--

INSERT INTO `dvd_order_line` (`id`, `dvd_id`, `order_id`) VALUES
  (0, 1, 1),
  (1, 2, 3),
  (2, 3, 3),
  (3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id`                 int(11) NOT NULL,
  `customer_id`        int(11) NOT NULL,
  `rent_date`          DATE    NOT NULL,
  `due_date`           DATE    NOT NULL,
  `actual_return_date` DATE DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `customer_id`, `rent_date`, `due_date`, `actual_return_date`) VALUES
  (1, 1, '2017-09-14', '2017-09-28', NULL),
  (2, 1, '2017-09-14', '2017-09-12', NULL),
  (3, 2, '2017-09-14', '2017-09-30', NULL);

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
-- Indexes for table `dvd_order_line`
--
ALTER TABLE `dvd_order_line`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dvd_id` (`dvd_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` INT(6) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 34;
--
-- AUTO_INCREMENT for table `dvd`
--
ALTER TABLE `dvd`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dvd`
--
ALTER TABLE `dvd`
  ADD CONSTRAINT `dvd_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `dvd_order_line`
--
ALTER TABLE `dvd_order_line`
  ADD CONSTRAINT `dvd_order_line_ibfk_1` FOREIGN KEY (`dvd_id`) REFERENCES `dvd` (`id`),
  ADD CONSTRAINT `dvd_order_line_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
