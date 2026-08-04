-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2020 at 08:00 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id11637391_parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `cust_name` varchar(50) NOT NULL,
  `cust_license` varchar(50) NOT NULL,
  `veh_id` varchar(50) NOT NULL,
  `slot_id` varchar(50) NOT NULL,
  `s_time` int(11) NOT NULL,
  `e_time` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `cust_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `bill`
--
DELIMITER $$
CREATE TRIGGER `customer` AFTER INSERT ON `bill` FOR EACH ROW DELETE FROM customer WHERE cust_id=new.cust_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pslot` AFTER INSERT ON `bill` FOR EACH ROW UPDATE pslot SET veh_id='',s_time=NULL WHERE slot_id=new.slot_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `vehicle` AFTER INSERT ON `bill` FOR EACH ROW DELETE FROM vehicle WHERE veh_nu=new.veh_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `number`, `email`, `address`) VALUES
('Debarghya Mondal', '+91 8116944435', 'deb.mvjce@gmail.com', 'New apartment, Channasandra, BLR-560067');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cname` varchar(50) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `license` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ename` varchar(50) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pslot`
--

CREATE TABLE `pslot` (
  `slot_id` varchar(50) NOT NULL,
  `veh_id` varchar(50) NOT NULL,
  `s_time` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pslot`
--

INSERT INTO `pslot` (`slot_id`, `veh_id`, `s_time`) VALUES
('slot_2', '', NULL),
('slot_3', '', NULL),
('slot_4', '', NULL),
('slot_1', '', NULL),
('slot_5', '', NULL),
('slot_7', '', NULL),
('slot_6', '', NULL),
('slot_8', '', NULL),
('slot_9', '', NULL),
('slot_10', '', NULL),
('slot_11', '', NULL),
('slot_12', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `veh_nu` varchar(50) NOT NULL,
  `veh_type` varchar(50) NOT NULL,
  `veh_model` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `vehicle`
--
DELIMITER $$
CREATE TRIGGER `cust_dlt_after_veh_delete` AFTER DELETE ON `vehicle` FOR EACH ROW DELETE FROM customer WHERE cust_id=old.cust_id
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20251;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
