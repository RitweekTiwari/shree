-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 11, 2020 at 05:09 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snsroot_sns1`
--

-- --------------------------------------------------------

--
-- Table structure for table `pbc_tc_history`
--

CREATE TABLE `pbc_tc_history` (
  `pbc_tc_id` int(11) NOT NULL,
  `pbc` varchar(64) NOT NULL,
  `date` double(8,2) NOT NULL,
  `qty` float(5,2) NOT NULL,
  `tc` float NOT NULL,
  `isTc` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pbc_tc_history`
--

INSERT INTO `pbc_tc_history` (`pbc_tc_id`, `pbc`, `date`, `qty`, `tc`, `isTc`, `deleted`) VALUES
(1, 'P5', 2020.00, 16.20, 1.2, 0, 0),
(2, 'P2451', 2020.00, 0.30, 0.3, 1, 0),
(3, 'P514', 2020.00, 3.00, 0.4, 1, 0),
(4, 'P515', 2020.00, 3.00, 0.4, 1, 0),
(5, 'P154', 2020.00, 10.60, 0.05, 1, 0),
(6, 'P2687', 2020.00, 22.25, 0.2, 1, 0),
(7, 'P2552', 2020.00, 26.50, 1.5, 1, 0),
(8, 'P143/1', 2020.00, 1.30, 1.3, 0, 0),
(9, 'P143/2', 2020.00, 1.30, 1.3, 0, 0),
(10, 'P143/3', 2020.00, 1.30, 1.3, 0, 0),
(11, 'P143/4', 2020.00, 1.30, 1.3, 0, 0),
(12, 'P143/5', 2020.00, 1.30, 1.3, 0, 0),
(13, 'P143/6', 2020.00, 1.30, 1.3, 0, 0),
(14, 'P143/7', 2020.00, 1.60, 1.6, 0, 0),
(15, 'P145/1', 2020.00, 1.30, 1.3, 0, 0),
(16, 'P145/2', 2020.00, 1.30, 1.3, 0, 0),
(17, 'P145/3', 2020.00, 1.30, 1.3, 0, 0),
(18, 'P145/4', 2020.00, 1.30, 1.3, 0, 0),
(19, 'P145/5', 2020.00, 1.30, 1.3, 0, 0),
(20, 'P145/6', 2020.00, 1.30, 1.3, 0, 0),
(21, 'P145/7', 2020.00, 1.60, 1.6, 0, 0),
(22, 'P149/1', 2020.00, 1.30, 1.3, 0, 0),
(23, 'P149/2', 2020.00, 1.30, 1.3, 0, 0),
(24, 'P149/3', 2020.00, 1.30, 1.3, 0, 0),
(25, 'P149/4', 2020.00, 1.30, 1.3, 0, 0),
(26, 'P149/5', 2020.00, 1.30, 1.3, 0, 0),
(27, 'P149/6', 2020.00, 1.30, 1.3, 0, 0),
(28, 'P149/7', 2020.00, 1.60, 1.6, 0, 0),
(29, 'P151/1', 2020.00, 1.30, 1.3, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pbc_tc_history`
--
ALTER TABLE `pbc_tc_history`
  ADD PRIMARY KEY (`pbc_tc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pbc_tc_history`
--
ALTER TABLE `pbc_tc_history`
  MODIFY `pbc_tc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
