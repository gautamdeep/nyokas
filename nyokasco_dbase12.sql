-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2019 at 04:47 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nyokasco_dbase12`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_request`
--

CREATE TABLE `account_request` (
  `id` int(11) NOT NULL,
  `businessname` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `mobile` varchar(111) NOT NULL,
  `referredby` varchar(255) NOT NULL,
  `account_associated` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_request`
--

INSERT INTO `account_request` (`id`, `businessname`, `city`, `address`, `landmark`, `firstname`, `lastname`, `email`, `phone`, `mobile`, `referredby`, `account_associated`, `created_at`, `updated_at`) VALUES
(1, 'Hotel Ganga', 'pokhara', 'lakeside ', 'near barahi hotel', 'santosh', 'timilsina', 'hotelganga@gmail.com', '123423423', '2342342342342', '', 2, '2017-05-29 10:47:06', '0000-00-00 00:00:00'),
(2, 'Maiti Ghar Production', 'test', 'addtest', 'here', 'Laxmi', 'Tamang', 'maile@maiti.com', '123123', '1231231231', 'INTERNT', 3, '2017-06-18 03:03:40', '0000-00-00 00:00:00'),
(3, 'student', 'beijing', 'dayuncun', 'blduing 10', 'Ananda', 'Gurung', 'anangurung@gmail.com', '13241302778', '13241303601', 'from abinash', 6, '2017-07-05 03:56:56', '0000-00-00 00:00:00'),
(4, 'Saroj Nyokas', 'Tersapatti', 'Pokhara', 'near ac house', 'Saroj ', 'Kayastha', 'er.skayastha@gmail.com', '9802812233', '9856033008', '', 4, '2017-07-09 12:42:27', '0000-00-00 00:00:00'),
(5, 'Ray\'s Enterprises', 'Pokhara', 'shabhagriha', 'Gandaki', 'Kiran', 'Kharel', 'info@rays.com.np', '061520998', '9846261005', 'saroj sir', 5, '2017-07-21 13:34:20', '0000-00-00 00:00:00'),
(6, 'abinash', 'pokhara', 'arva', '222222', 'Abinash', 'Baral', 'mechbaral@hotmail.com', '9779851179130', '9779851179130', 'self', 7, '2018-02-26 07:24:36', '0000-00-00 00:00:00'),
(7, 'outdrive enterprise', 'pokhara', 'naghdhunga', 'opposite of nyokas concern', 'deep', 'kiran', 'mojoking.black@gmail.com', '9804148195', '5456454564', 'sachin', 8, '2018-02-26 12:09:42', '0000-00-00 00:00:00'),
(8, 'noorain ', 'ekdarabela', 'mahottari', 'jaleshwor', 'noorain', 'ansari', 'ansarinoorain783@gmail.com', '009779844031748', '009779844031748', 'youtube', 0, '2018-05-09 10:23:11', '0000-00-00 00:00:00'),
(9, 'Htc Nepal', 'Chitwan', 'Ratnanagar', '148', 'Lekhnath ', 'Paudel', 'htcnepal01@gmail.com', '9845222148', '9845222148', 'youtube', 0, '2019-03-04 01:35:02', '0000-00-00 00:00:00'),
(10, 'gogreen', 'BEIJING', 'BEIJING', 'BEIJING', 'ABINASH', 'BARAL', 'mechbaral@gmail.com', '98517236123', '9871298369', 'ASKDHAILD', 9, '2019-06-04 08:42:16', '0000-00-00 00:00:00'),
(11, 'Segway Discovery', 'Beijing', 'beijing', 'beijing', 'ABINASH', 'baral', 'mechbaral@buaa.edu.cn', '13121738702', '15910509107', 'segway', 10, '2019-06-04 08:50:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ac_types`
--

CREATE TABLE `ac_types` (
  `id` int(11) NOT NULL,
  `typename` varchar(255) NOT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ac_types`
--

INSERT INTO `ac_types` (`id`, `typename`, `visibility`) VALUES
(1, 'Wall Mount', 1),
(2, 'Wall Mount : DC INVERTER', 1),
(4, 'Ceiling Cassette', 0),
(5, 'SEGWAY', 0),
(6, 'SEGWAY', 0);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brandname` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `addedby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brandname`, `description`, `addedby`) VALUES
(1, 'Gree', '', 1),
(2, 'Hitachi', '', 0),
(3, 'Daikin', '', 0),
(4, 'Midea', '', 0),
(5, 'Hyundai', '', 0),
(6, 'LG', '', 0),
(7, 'CG', '', 0),
(8, 'Hisense', '', 0),
(9, 'Voltas', '', 0),
(10, 'Chigoo', '', 1),
(11, 'Samsung', '', 0),
(12, 'asdf', 'asdf', 0),
(13, 'Segway ES', 'ES Scooter', 0);

-- --------------------------------------------------------

--
-- Table structure for table `calls`
--

CREATE TABLE `calls` (
  `id` int(25) NOT NULL,
  `callnumber` bigint(255) NOT NULL,
  `clientid` int(25) NOT NULL,
  `propertytypeid` int(11) NOT NULL,
  `calltypeid` int(11) NOT NULL,
  `callsource` varchar(25) NOT NULL,
  `term` varchar(255) NOT NULL,
  `regby_name` varchar(255) NOT NULL,
  `regby_phone` varchar(255) NOT NULL,
  `reg_datetime` date NOT NULL,
  `priority` tinyint(4) NOT NULL,
  `duedatetime` date NOT NULL,
  `callstatus` tinyint(4) NOT NULL,
  `calldetail` text NOT NULL,
  `internalnote` text NOT NULL,
  `complainremoval_request` varchar(255) NOT NULL,
  `deactivate` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calls`
--

INSERT INTO `calls` (`id`, `callnumber`, `clientid`, `propertytypeid`, `calltypeid`, `callsource`, `term`, `regby_name`, `regby_phone`, `reg_datetime`, `priority`, `duedatetime`, `callstatus`, `calldetail`, `internalnote`, `complainremoval_request`, `deactivate`, `created_at`, `updated_at`) VALUES
(1, 0, 3, 2, 1, '0', '0', '', '', '2019-07-04', 1, '2019-07-04', 1, '', '', '', 0, '2019-07-04 18:41:58', '0000-00-00 00:00:00'),
(2, 0, 4, 2, 1, '0', '0', '', '', '2019-07-04', 1, '2019-07-04', 1, '', '', '', 0, '2019-07-04 18:43:28', '0000-00-00 00:00:00'),
(3, 0, 2, 1, 1, '0', '0', '', '', '2019-07-04', 1, '2019-07-04', 1, '', '', '', 0, '2019-07-04 18:52:29', '0000-00-00 00:00:00'),
(4, 0, 2, 1, 1, '0', '0', '', '', '2019-07-04', 1, '2019-07-04', 1, '', '', '', 0, '2019-07-04 18:55:22', '0000-00-00 00:00:00'),
(5, 0, 3, 1, 1, '0', '0', '', '', '2019-07-04', 0, '2019-07-04', 1, '', '', '', 0, '2019-07-04 18:55:29', '0000-00-00 00:00:00'),
(6, 0, 3, 1, 2, '2', '3', 'test', '234', '2019-07-06', 1, '2019-07-06', 1, '', '', '', 0, '2019-07-06 17:48:03', '0000-00-00 00:00:00'),
(7, 0, 4, 1, 1, '1', '3', 'asdf', '234', '2019-07-06', 1, '2019-07-06', 0, 'test', 'test', '', 0, '2019-07-06 18:15:57', '0000-00-00 00:00:00'),
(8, 0, 3, 1, 1, '1', '3', 'asdf', '234', '2019-07-06', 1, '2019-07-06', 1, 'test', 'test', '', 0, '2019-07-06 18:18:13', '0000-00-00 00:00:00'),
(9, 0, 4, 1, 1, '1', '3', 'asdf', '234', '2019-07-06', 1, '2019-07-06', 1, 'test', 'test', '', 0, '2019-07-06 18:18:27', '0000-00-00 00:00:00'),
(10, 0, 4, 2, 2, '2', '2', 'asdf', 'ydr', '2019-07-06', 1, '2019-07-06', 0, '', '', '', 0, '2019-07-06 18:26:43', '0000-00-00 00:00:00'),
(11, 0, 4, 1, 2, '0', '0', '', '', '2019-07-06', 1, '2019-07-06', 0, '', '', '', 1, '2019-07-06 18:28:21', '0000-00-00 00:00:00'),
(12, 0, 3, 3, 1, '0', '0', '', '', '0000-00-00', 1, '0000-00-00', 2, '', '', '', 0, '2019-07-06 18:38:05', '2019-07-06 18:50:39'),
(13, 0, 3, 2, 1, '4', '1', '', '', '0000-00-00', 0, '0000-00-00', 0, '', '', '', 0, '2019-07-06 18:54:00', '2019-07-06 19:14:13'),
(14, 0, 17, 2, 2, '4', '3', 'Kundan', '9804148195', '0000-00-00', 1, '0000-00-00', 3, '', '', '', 0, '2019-07-06 19:14:43', '2019-07-06 19:42:07'),
(16, 0, 10, 1, 1, '1', '1', 'Saroj Sir', '9804148195', '2019-07-17', 1, '2019-07-20', 2, 'test', 'test', '', 0, '2019-07-20 09:47:03', '0000-00-00 00:00:00'),
(17, 0, 6, 1, 1, '2', '3', 'yrdy', '9804148195', '2019-07-20', 1, '2019-07-20', 0, '', '', '', 0, '2019-07-20 09:49:59', '0000-00-00 00:00:00'),
(18, 0, 4, 1, 1, '2', '3', 'yrdy', '9804148195', '2019-07-20', 1, '2019-07-20', 5, 'yrdy', '', '', 0, '2019-07-20 09:51:08', '2019-07-20 09:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `call_activity`
--

CREATE TABLE `call_activity` (
  `id` int(11) NOT NULL,
  `callid` int(11) NOT NULL,
  `technician` varchar(111) NOT NULL,
  `assumedproblem` varchar(255) NOT NULL,
  `steps` varchar(255) NOT NULL,
  `assumedresult` varchar(111) NOT NULL,
  `actualresult` varchar(111) NOT NULL,
  `materialused` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `call_activity`
--

INSERT INTO `call_activity` (`id`, `callid`, `technician`, `assumedproblem`, `steps`, `assumedresult`, `actualresult`, `materialused`, `remarks`) VALUES
(1, 5, '', 'dfas', 'asdfsdf', '', '', 'asdf', ''),
(2, 5, '', 'asdf', 'asdf', '', '', 'fasdf', ''),
(3, 9, '', 'ygyh', 'gyug', '', '', 'gyu', 'gyu'),
(4, 9, '', 'gyu8', 'ghuy', '', '', 'aa', 'aa'),
(5, 10, '', 'sdf', 'sdfa', '', '', 'sdfs', 'sdfs'),
(6, 10, '', 'sdf', 'sdfsdf', '', '', 'd', ''),
(7, 11, '', 'ojsadojiasdoajsd', 'als;jd;alsd;', '', '', '', ''),
(8, 11, '', 'DASDASD', 'ASDASDASDASDASD', '', '', '', ''),
(9, 12, '', 'asdf', 'asdf', '', '', 'asdf', 'asdf'),
(10, 12, '', 'sdfg', 'sdfg', '', '', 'sdfg', 'sdfg');

-- --------------------------------------------------------

--
-- Table structure for table `call_source`
--

CREATE TABLE `call_source` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `call_source`
--

INSERT INTO `call_source` (`id`, `title`, `description`, `position`) VALUES
(1, 'Direct Sales', '', 0),
(2, 'Phone', '', 0),
(3, 'Email', '', 0),
(4, 'Web', '', 0),
(5, 'Marketing', '', 0),
(6, 'Nyokas Staff', '', 0),
(7, 'Agent', '', 0),
(8, 'Other', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `call_status`
--

CREATE TABLE `call_status` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `call_status`
--

INSERT INTO `call_status` (`id`, `title`, `description`, `position`) VALUES
(1, 'None', '', 0),
(2, 'Open', '', 0),
(3, 'Acknoledge', '', 0),
(4, 'Process', '', 0),
(5, 'Completed', '', 0),
(6, 'Close', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `call_term`
--

CREATE TABLE `call_term` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `call_term`
--

INSERT INTO `call_term` (`id`, `title`, `description`, `position`) VALUES
(1, 'Sales Service', '', 0),
(2, 'After Sales Warranty', '', 0),
(3, 'Warranty Plan', '', 0),
(4, 'AMC Plan', '', 0),
(5, 'On Call', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `call_types`
--

CREATE TABLE `call_types` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `call_types`
--

INSERT INTO `call_types` (`id`, `title`, `position`) VALUES
(1, 'Installation', 0),
(2, 'Routine Service', 0),
(3, 'Complain', 0),
(4, 'Others', 0);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `businessname` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email1` varchar(255) NOT NULL,
  `phone1` varchar(255) NOT NULL,
  `mobile1` varchar(111) NOT NULL,
  `repfirstname` varchar(255) NOT NULL,
  `replastname` varchar(255) NOT NULL,
  `email2` varchar(255) NOT NULL,
  `phone2` varchar(255) NOT NULL,
  `mobile2` varchar(111) NOT NULL,
  `loadsheddinggroup` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `referredby` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `businessname`, `city`, `address`, `landmark`, `firstname`, `lastname`, `email1`, `phone1`, `mobile1`, `repfirstname`, `replastname`, `email2`, `phone2`, `mobile2`, `loadsheddinggroup`, `status`, `referredby`, `created_at`, `updated_at`) VALUES
(1, 'asdf', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, '', '2017-05-28 06:11:40', '0000-00-00 00:00:00'),
(2, 'Hotel Gangaasdfa', 'pokhara', 'lakeside ', 'near barahi hotel', 'santosh', 'timilsina', 'hotelganga@gmail.com', '123423423', '2342342342342', '', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Maiti Ghar Production', 'test', 'addtest', 'here', 'Laxmi', 'Tamang', 'maile@maiti.com', '123123', '1231231231', '', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Saroj Nyokas', 'Tersapatti', 'Pokhara', 'near ac house', 'Saroj ', 'Kayastha', 'er.skayastha@gmail.com', '9802812233', '9856033008', '', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Ray\'s Enterprises', 'Pokhara', 'shabhagriha', 'Gandaki', 'Kiran', 'Kharel', '', '', '', '', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'student', 'beijing', 'dayuncun', 'blduing 10', 'Ananda', 'Gurung', 'anangurung@gmail.com', '13241302778', '13241303601', '', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'abinash', 'pokhara', 'arva', '222222', 'Abinash', 'Baral', 'mechbaral@hotmail.com', '9779851179130', '9779851179130', '', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'segway', '', '', '', 'jason', '', '', '', '', '', '', '', '', '', 1, 0, '', '2019-06-04 08:12:40', '0000-00-00 00:00:00'),
(9, 'segway', 'beijing', '', '', 'loew', '', '', '', '', '', '', '', '', '', 1, 0, '', '2019-06-04 08:17:04', '0000-00-00 00:00:00'),
(10, 'gogreen', 'malayisa', '', '', 'Janisasda', '', '', '', '', '', '', '', '75667567', '', 1, 0, '', '2019-06-04 08:20:20', '0000-00-00 00:00:00'),
(11, 'gogreen', 'BEIJING', 'BEIJING', 'BEIJING', 'ABINASH3', 'BARAL3', 'mechbaral@gmail.com', '98517236123', '9871298369', '', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Segway Discovery', 'Beijing', 'beijing', 'beijing', 'ABINASH', 'baral', 'mechbaral@buaa.edu.cn', '13121738702', '15910509107', '', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Hotel Swapna Bagh', 'PO', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, '', '2019-06-30 19:22:47', '0000-00-00 00:00:00'),
(14, 'Hotel Swapna Bagh', 'Pokhara', 'lakeside', 'near queensland', 'mojo', 'mo', '', '123123', '', '', '', '', '', '', 1, 0, '', '2019-06-30 19:23:27', '0000-00-00 00:00:00'),
(15, 'Hotel Swapna Bagh', 'PO', 'lakeside', 'near queensland', 'mojo', 'mo', '', '123123', '', '', '', '', '', '', 1, 0, '', '2019-07-03 19:16:05', '2019-07-03 19:21:39'),
(16, 'Hotel Swapna Bagh', 'PO', 'lakeside', 'near queensland', 'mojo', 'mo', '', '123123', '', '', '', '', '', '', 1, 0, '', '2019-07-03 19:21:51', '0000-00-00 00:00:00'),
(17, 'Hotel Swapna Bagh', 'PO', 'lakeside', 'near queensland', 'mojo', '', '', '', '', '', '', '', '', '', 1, 0, '', '2019-07-06 17:48:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `complain_log`
--

CREATE TABLE `complain_log` (
  `id` int(25) NOT NULL,
  `clientid` int(25) NOT NULL,
  `complainsource` varchar(25) NOT NULL,
  `complainterm` varchar(255) NOT NULL,
  `regby_name` varchar(255) NOT NULL,
  `regby_phone` varchar(255) NOT NULL,
  `regby_datetime` varchar(111) NOT NULL,
  `complainerphone` varchar(255) NOT NULL,
  `reg_by` int(11) NOT NULL,
  `reg_datetime` datetime NOT NULL,
  `priority` tinyint(1) NOT NULL,
  `duedate` datetime NOT NULL,
  `complainstatus` tinyint(4) NOT NULL,
  `internalnote` text NOT NULL,
  `complainremoval_request` varchar(255) NOT NULL,
  `deactivate` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complain_log`
--

INSERT INTO `complain_log` (`id`, `clientid`, `complainsource`, `complainterm`, `regby_name`, `regby_phone`, `regby_datetime`, `complainerphone`, `reg_by`, `reg_datetime`, `priority`, `duedate`, `complainstatus`, `internalnote`, `complainremoval_request`, `deactivate`, `created_at`, `updated_at`) VALUES
(1, 1, '63', '7', 'sdf', 'sdf', 'sdf', 'sdf', 1, '2017-05-29 10:16:11', 0, '0000-00-00 00:00:00', 1, '', '', 0, '2017-05-29 10:16:11', '0000-00-00 00:00:00'),
(2, 1, '63', '7', 'sdf', 'asdf', 'sdf', '', 1, '2017-05-29 10:17:39', 0, '0000-00-00 00:00:00', 1, '', '', 0, '2017-05-29 10:17:39', '0000-00-00 00:00:00'),
(3, 1, '63', '6,7', 'test detail', 'test', 'test', '123', 1, '2017-05-29 10:21:31', 0, '0000-00-00 00:00:00', 1, '', '', 0, '2017-05-29 10:21:31', '0000-00-00 00:00:00'),
(4, 1, '63', '7', 'asdf', 'asdf', 'asdf', '23', 1, '2017-05-29 10:26:47', 0, '0000-00-00 00:00:00', 1, '', '', 0, '2017-05-29 10:26:47', '0000-00-00 00:00:00'),
(7, 2, '64', '10', '', 'Deep', '', '9804149105', 0, '2017-05-31 06:45:32', 0, '0000-00-00 00:00:00', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 3, '67', '1', 'test', '', '', '', 0, '2017-06-25 04:25:40', 0, '0000-00-00 00:00:00', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 2, '65', '10', 'y78ty78t678t6y7t', '', '', '', 1, '2018-02-26 07:32:19', 0, '0000-00-00 00:00:00', 1, '', '', 0, '2018-02-26 07:32:19', '0000-00-00 00:00:00'),
(10, 7, '68', '1', 'display is not working', 'deep', '', '985214', 0, '2018-02-26 12:14:26', 0, '0000-00-00 00:00:00', 2, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 7, '68', '5, 8', 'asdfasdfasdfaaaaa', 'this', '', '234234', 0, '2018-02-27 07:47:51', 0, '0000-00-00 00:00:00', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 12, '70', '2, 6, 8', '', 'rajesh', '', 'lkaskjdliasd', 0, '2019-06-04 08:54:53', 0, '0000-00-00 00:00:00', 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `complain_type`
--

CREATE TABLE `complain_type` (
  `id` int(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complain_type`
--

INSERT INTO `complain_type` (`id`, `name`, `displayorder`, `visibility`) VALUES
(1, 'Display Problem', 1, 1),
(2, 'Refrigerant Leak', 2, 1),
(3, 'No Heating/ Cooling', 0, 1),
(4, 'Blowing Hot Air', 0, 1),
(5, 'AC Trips', 0, 1),
(6, 'Making Noise', 0, 1),
(7, 'Coil/Outdoor Frozen', 0, 1),
(8, 'Drain/Water Leak', 0, 1),
(9, 'Need Checkup/Service', 0, 1),
(10, 'Other', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employeecode` varchar(25) NOT NULL,
  `firstname` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `citizenno` varchar(55) NOT NULL,
  `post` varchar(55) NOT NULL,
  `enrolldate` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employeecode`, `firstname`, `lastname`, `citizenno`, `post`, `enrolldate`, `status`) VALUES
(7, '', 'Saddam ', 'Ansari', '123', 'Technician', '2017-05-10', 0),
(8, '', 'Shambhu', 'Chaudhary', '2222', 'Technician', '2017-05-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loadshedding_group`
--

CREATE TABLE `loadshedding_group` (
  `id` int(11) NOT NULL,
  `groupname` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loadshedding_group`
--

INSERT INTO `loadshedding_group` (`id`, `groupname`, `description`) VALUES
(1, 'Group 1', 'This is gead'),
(8, 'Group 2', 'this is grnew');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(25) NOT NULL,
  `clientid` int(25) NOT NULL,
  `propertyname` varchar(255) NOT NULL,
  `brand` int(25) NOT NULL,
  `type` int(25) NOT NULL,
  `serialnumber` varchar(255) NOT NULL,
  `modelnumber` varchar(255) NOT NULL,
  `capacityinton` float NOT NULL,
  `assignname` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `installdate` date NOT NULL,
  `rundate` date NOT NULL,
  `status` int(11) NOT NULL,
  `deactivate` tinyint(1) NOT NULL,
  `createdat` datetime NOT NULL,
  `updatedat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `clientid`, `propertyname`, `brand`, `type`, `serialnumber`, `modelnumber`, `capacityinton`, `assignname`, `location`, `installdate`, `rundate`, `status`, `deactivate`, `createdat`, `updatedat`) VALUES
(63, 1, '', 10, 1, '', '', 1, '', '', '0000-00-00', '0000-00-00', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 2, 'Air Conditioner', 10, 1, '234234', '234q23423', 1.5, 'AC ONe', 'Restaurant', '0000-00-00', '0000-00-00', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 2, 'Air Conditioner', 1, 1, '234', '', 2, 'Kit Ac', 'Kichen', '0000-00-00', '0000-00-00', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 3, 'Air Conditioner', 1, 1, '', '', 1, 'room 1', 'floor 1', '0000-00-00', '0000-00-00', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 7, 'Air Conditioner', 1, 1, '2342', '234', 1, 'ac1', 'dining hall', '0000-00-00', '0000-00-00', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 6, 'Air Conditioner', 1, 5, 'KAKLSHDIAS', 'JJASDJKAS', 0, 'KLAJSD', 'BEIJING', '0000-00-00', '0000-00-00', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 12, 'Air Conditioner', 13, 5, '78836871268371', 'MAX', 21, 'Gogreeen', 'BEIJING', '2019-06-19', '2019-06-11', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `title`, `position`) VALUES
(1, 'Air Conditioner', 0),
(2, 'Washing Machine', 0),
(3, 'Fridge', 0),
(4, 'Others', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `clientid` int(25) NOT NULL,
  `firstname` varchar(22) NOT NULL,
  `lastname` varchar(22) NOT NULL,
  `email` varchar(111) NOT NULL,
  `username` varchar(22) NOT NULL,
  `password_show` varchar(255) NOT NULL,
  `password` varchar(111) NOT NULL,
  `userlevel` tinyint(1) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `createdat` datetime NOT NULL,
  `updatedat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `clientid`, `firstname`, `lastname`, `email`, `username`, `password_show`, `password`, `userlevel`, `verified`, `createdat`, `updatedat`) VALUES
(1, 0, 'nyokas', 'concern', 'nyokasconcern@gmail.com', 'nyokas', '', '7488e331b8b64e5794da3fa4eb10ad5d', 3, 1, '2017-04-02 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 'santosh', 'timilsina', 'hotelganga@gmail.com', 'hotelgang', 'hot490293', '291839cea9b6e6e3c97652b63ac51c1e', 1, 1, '2017-05-29 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 'Laxmi', 'Tamang', 'maile@maiti.com', 'maitighar', 'mai909341', '957c19b43a245dc46ee86f76c20e6058', 1, 1, '2017-06-18 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 'Saroj ', 'Kayastha', 'er.skayastha@gmail.com', 'sarojnyok', 'sar193621', '3835dcc7dbcfb0be61bde0d427ec1030', 1, 1, '2017-07-09 00:00:00', '0000-00-00 00:00:00'),
(5, 5, 'Kiran', 'Kharel', 'info@rays.com.np', 'ray\'sente', 'ray865668', '297b5fdf8932946545c265a7f4fc4fd0', 1, 1, '2017-07-23 00:00:00', '0000-00-00 00:00:00'),
(6, 6, 'Ananda', 'Gurung', 'anangurung@gmail.com', 'studentan', 'stu942719', '608b00fdaba270814c91b2e0d8cd9bcd', 1, 1, '2017-08-04 00:00:00', '0000-00-00 00:00:00'),
(7, 7, 'Abinash', 'Baral', 'mechbaral@hotmail.com', 'abinashab', 'abi111327', '550ad6555c03d20db5a59ff3c30d37d9', 1, 1, '2018-02-26 00:00:00', '0000-00-00 00:00:00'),
(8, 5, 'deep', 'kiran', 'mojoking.black@gmail.com', 'ray\'sente1', 'ray947596', '6725a82034057e3abcc62698dffd5982', 1, 1, '2018-02-26 00:00:00', '0000-00-00 00:00:00'),
(9, 11, 'ABINASH', 'BARAL', 'mechbaral@gmail.com', 'gogreenab', 'gog143664', '22d9820b316ebe601b56d148f3d098fa', 1, 1, '2019-06-04 00:00:00', '0000-00-00 00:00:00'),
(10, 12, 'ABINASH', 'baral', 'mechbaral@buaa.edu.cn', 'segwaydis', 'seg110801', '4fed087236284621911ccf4d4ab231bf', 1, 1, '2019-06-04 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_request`
--
ALTER TABLE `account_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ac_types`
--
ALTER TABLE `ac_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `call_activity`
--
ALTER TABLE `call_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `call_source`
--
ALTER TABLE `call_source`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `call_status`
--
ALTER TABLE `call_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `call_term`
--
ALTER TABLE `call_term`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `call_types`
--
ALTER TABLE `call_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complain_log`
--
ALTER TABLE `complain_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complain_type`
--
ALTER TABLE `complain_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loadshedding_group`
--
ALTER TABLE `loadshedding_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_request`
--
ALTER TABLE `account_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ac_types`
--
ALTER TABLE `ac_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `calls`
--
ALTER TABLE `calls`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `call_activity`
--
ALTER TABLE `call_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `call_source`
--
ALTER TABLE `call_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `call_status`
--
ALTER TABLE `call_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `call_term`
--
ALTER TABLE `call_term`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `call_types`
--
ALTER TABLE `call_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `complain_log`
--
ALTER TABLE `complain_log`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `complain_type`
--
ALTER TABLE `complain_type`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loadshedding_group`
--
ALTER TABLE `loadshedding_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
