-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 11:04 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vpsgarage`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbill`
--

CREATE TABLE `tblbill` (
  `billno` int(11) NOT NULL,
  `dtdate` date NOT NULL,
  `bookid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbill`
--

INSERT INTO `tblbill` (`billno`, `dtdate`, `bookid`) VALUES
(1, '2023-07-01', 4),
(2, '2023-07-04', 5),
(3, '2023-07-04', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblbilllist`
--

CREATE TABLE `tblbilllist` (
  `billno` int(11) NOT NULL,
  `service` varchar(50) NOT NULL,
  `rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbilllist`
--

INSERT INTO `tblbilllist` (`billno`, `service`, `rate`) VALUES
(1, 'Cleaning', 800),
(1, 'Body Paint', 5000),
(2, 'Oil Change', 300),
(2, 'Color', 2500),
(2, 'Oil Change', 300),
(2, 'Color', 2500);

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `bookid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `vehicletype` varchar(50) NOT NULL,
  `booktype` varchar(10) NOT NULL,
  `vehicleno` varchar(50) NOT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `arrived` char(1) NOT NULL,
  `issue` text NOT NULL,
  `service` text NOT NULL,
  `garage` varchar(50) NOT NULL,
  `engg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`bookid`, `id`, `username`, `vehicletype`, `booktype`, `vehicleno`, `starttime`, `endtime`, `arrived`, `issue`, `service`, `garage`, `engg`) VALUES
(1, 2, 'aaa', 'Four Wheeler', 'offline', 'KA22 EY 1234', '2023-07-11 11:15:23', '2000-07-11 20:06:45', 'Y', 'Servicing', 'oil change', 'aaa', 'sunny'),
(2, 3, 'sunil', 'Four Wheeler', 'online', 'KA20 CB 4125', '2023-07-11 11:37:23', '0000-00-00 00:00:00', 'Y', 'Oil Change', '', 'bbb', 'vrushabh'),
(3, 4, 'shri', 'Four Wheeler', 'online', 'KA 22 K 1234', '2023-07-28 16:02:08', '0000-00-00 00:00:00', 'Y', 'sERVICING', '', 'auto', 'qwerty');

-- --------------------------------------------------------

--
-- Table structure for table `tblcust`
--

CREATE TABLE `tblcust` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcust`
--

INSERT INTO `tblcust` (`id`, `name`, `username`, `password`, `email`, `contact`) VALUES
(1, 'Sunil', 'sunil', 'sunil', 'sunil@gmail.com', '9568952147'),
(2, 'Vaibhav', 'vaibhav', 'vaibhav', 'vaibhav@gmail.com', '9658214785'),
(3, 'Bhushan', 'bhushan', 'bhushan', 'bhushan@gmail.com', '9880917783'),
(4, 'Shrishail', 'shri', '12345', 'shri@gmail.com', '9880917784');

-- --------------------------------------------------------

--
-- Table structure for table `tblengg`
--

CREATE TABLE `tblengg` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `garage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblengg`
--

INSERT INTO `tblengg` (`id`, `name`, `username`, `password`, `garage`) VALUES
(1, 'Sunny', 'sunny', 'sunny', 'aaa'),
(2, 'vrushabh', 'vrushabh', 'vrushabh', 'bbb'),
(3, 'qwerty', 'qwerty', 'qwerty', 'auto');

-- --------------------------------------------------------

--
-- Table structure for table `tbllogin`
--

CREATE TABLE `tbllogin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllogin`
--

INSERT INTO `tbllogin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tblprocess`
--

CREATE TABLE `tblprocess` (
  `id` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `service` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblprocess`
--

INSERT INTO `tblprocess` (`id`, `bid`, `service`) VALUES
(1, 2, 'gear box cleaning, oil change'),
(2, 3, 'washing\r\ngear box checking');

-- --------------------------------------------------------

--
-- Table structure for table `tblservice`
--

CREATE TABLE `tblservice` (
  `id` int(11) NOT NULL,
  `service` varchar(50) NOT NULL,
  `rate` float NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblservice`
--

INSERT INTO `tblservice` (`id`, `service`, `rate`, `username`) VALUES
(1, 'Cleaning', 800, 'aaa'),
(2, 'Body Paint', 5000, 'aaa'),
(4, 'Washing', 1000, 'bbb'),
(5, 'Oil Change', 500, 'bbb'),
(6, 'Oil Change', 300, 'auto'),
(7, 'Color', 2500, 'auto'),
(8, 'Wrapping', 4000, 'auto');

-- --------------------------------------------------------

--
-- Table structure for table `tblslots`
--

CREATE TABLE `tblslots` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `type` varchar(15) NOT NULL,
  `slots` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblslots`
--

INSERT INTO `tblslots` (`id`, `username`, `area`, `address`, `type`, `slots`) VALUES
(1, 'aaa', 'Angol', 'Main Road Angol', 'Two Wheeler', 5),
(2, 'aaa', 'Angol', 'Main Road Angol', 'Four Wheeler', 4),
(3, 'bbb', 'Belgaum City', 'College Road', 'Four Wheeler', 8),
(4, 'auto', 'Hindwadi', 'Main Road, |Near union bank', 'Four Wheeler', 8),
(5, 'auto', 'Hindwadi', 'Main Road, |Near union bank', 'Two Wheeler', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbltemp`
--

CREATE TABLE `tbltemp` (
  `bid` int(11) NOT NULL,
  `vno` varchar(50) NOT NULL,
  `service` varchar(50) NOT NULL,
  `rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbltemp`
--

INSERT INTO `tbltemp` (`bid`, `vno`, `service`, `rate`) VALUES
(4, 'GJ 01 KL 5258', 'Cleaning', 800),
(4, 'GJ 01 KL 5258', 'Body Paint', 5000),
(5, 'KA 22 A 1234', 'Oil Change', 300),
(5, 'KA 22 A 1234', 'Color', 2500);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(10) NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `name`, `username`, `password`, `area`, `address`, `contact`, `location`) VALUES
(1, 'AAA', 'aaa', 'aaa', 'Angol', 'Main Road Angol', '7896895412', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3838.5303843424913!2d74.50067981437483!3d15.82869738902991!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbf669f5095362f%3A0x82c5209c60971181!2sAshirwad%20Mangal%20Karyalay!5e0!3m2!1sen!2sin!4v1576760759549!5m2!1sen!2sin\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>'),
(2, 'BBB', 'bbb', 'bbb', 'Belgaum City', 'College Road', '8565214785', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3837.9167104496423!2d74.50749171437536!3d15.860974289009878!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbf66a51583cc51%3A0xcdf9ba28fd84015b!2sPant%20Prasad%20Complex!5e0!3m2!1sen!2sin!4v1576760726771!5m2!1sen!2sin\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>'),
(3, 'Automotive Garage', 'auto', '12345', 'Hindwadi', 'Main Road, |Near union bank', '9856521475', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3838.35846999309!2d74.50746191485555!3d15.837745889024246!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbf66855ef95153%3A0xc5f29be9536456d1!2sUnion%20Bank%20Of%20India!5e0!3m2!1sen!2sin!4v1688467148597!5m2!1sen!2sin\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbill`
--
ALTER TABLE `tblbill`
  ADD PRIMARY KEY (`billno`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`bookid`);

--
-- Indexes for table `tblcust`
--
ALTER TABLE `tblcust`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblengg`
--
ALTER TABLE `tblengg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblprocess`
--
ALTER TABLE `tblprocess`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblservice`
--
ALTER TABLE `tblservice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblslots`
--
ALTER TABLE `tblslots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbill`
--
ALTER TABLE `tblbill`
  MODIFY `billno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblcust`
--
ALTER TABLE `tblcust`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblengg`
--
ALTER TABLE `tblengg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblprocess`
--
ALTER TABLE `tblprocess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblservice`
--
ALTER TABLE `tblservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblslots`
--
ALTER TABLE `tblslots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
