-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2016 at 02:59 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `labhchar`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

DROP TABLE IF EXISTS `amenities`;
CREATE TABLE IF NOT EXISTS `amenities` (
  `amenities_id` int(11) NOT NULL AUTO_INCREMENT,
  `amenity_name` varchar(250) NOT NULL,
  `amenity_icon` varchar(50) DEFAULT NULL,
  `enabled` int(1) NOT NULL,
  PRIMARY KEY (`amenities_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`amenities_id`, `amenity_name`, `amenity_icon`, `enabled`) VALUES
(1, 'Baths', 'fa fa-gear', 1),
(2, 'Swimming Pool', 'fa fa-gear', 1);

-- --------------------------------------------------------

--
-- Table structure for table `amenities_to_property`
--

DROP TABLE IF EXISTS `amenities_to_property`;
CREATE TABLE IF NOT EXISTS `amenities_to_property` (
  `atp_id` bigint(100) NOT NULL AUTO_INCREMENT,
  `amenities_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`atp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=241 ;

--
-- Dumping data for table `amenities_to_property`
--

INSERT INTO `amenities_to_property` (`atp_id`, `amenities_id`, `property_id`) VALUES
(22, 2, 2),
(21, 1, 2),
(190, 2, 5),
(215, 1, 3),
(201, 1, 1),
(189, 1, 5),
(214, 2, 4),
(213, 2, 6),
(35, 1, 7),
(36, 2, 7),
(37, 1, 8),
(38, 2, 8),
(39, 1, 9),
(40, 2, 9),
(240, 2, 25),
(238, 2, 26),
(193, 2, 28),
(192, 1, 28),
(136, 2, 29),
(135, 1, 29),
(232, 2, 27),
(239, 1, 25),
(237, 1, 26);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `appointment_for` varchar(25) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` int(11) DEFAULT NULL,
  `appointment_note` varchar(255) DEFAULT NULL,
  `appointment_status` int(11) DEFAULT NULL,
  `assign_user_id` int(11) DEFAULT NULL,
  `added_date` date DEFAULT NULL,
  PRIMARY KEY (`appointment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `customer_id`, `property_id`, `appointment_for`, `appointment_date`, `appointment_time`, `appointment_note`, `appointment_status`, `assign_user_id`, `added_date`) VALUES
(5, 1, 1, 'rent', '2016-02-19', 2, 's', 2, NULL, '2016-02-03'),
(2, 1, NULL, 'rent', '2016-02-09', 2, 'Appointment not goes Here', 1, 1, '2016-02-03'),
(6, 1, NULL, 'rent', '2016-02-14', 1, 'sdfasdfasdf', 1, NULL, '2016-02-03'),
(4, 5, NULL, 'rent', '2016-02-07', 1, 'appointment notes', 1, 1, '2016-02-03'),
(9, 10, NULL, 'sale', '2016-02-12', 1, 'appointment note goes here', 1, NULL, '2016-02-08'),
(7, 1, NULL, 'sale', '2016-02-26', 1, 'checking', 1, NULL, '2016-02-06'),
(8, 1, NULL, 'sale', '2016-02-07', 1, 'fasdfasdfasdf', 1, NULL, '2016-02-06'),
(10, 2, NULL, 'sale', '2016-02-12', 3, 'asdfasdfasd', 1, NULL, '2016-02-08'),
(11, 1, NULL, 'sale', '2016-02-14', 6, 'Thsi mail checking', 1, NULL, '2016-02-08'),
(12, 1, NULL, 'rent', '2016-02-14', 5, '', 1, NULL, '2016-02-08'),
(13, 1, NULL, 'rent', '2016-02-19', 3, 'sdfasdfasdfasdf', 1, NULL, '2016-02-08'),
(14, 1, NULL, 'rent', '2016-02-13', 2, 'sdfasdfasdf', 1, NULL, '2016-02-08'),
(15, 1, NULL, 'rent', '2016-02-13', 2, 'sdfasdfasdf', 1, NULL, '2016-02-08'),
(16, 1, NULL, 'rent', '2016-02-13', 2, 'sdfasdfasdf', 1, NULL, '2016-02-08'),
(17, 3, 1, 'sale', '2016-02-14', 3, 'ddsdsdsd', 1, NULL, '2016-02-11'),
(18, 1, 5, 'sale', '2020-03-16', 6, 'sdfasdf', 2, NULL, '2016-02-11'),
(19, 3, 0, 'rent', '2016-03-26', 2, 'cvxcv', 2, NULL, '2016-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_status`
--

DROP TABLE IF EXISTS `appointment_status`;
CREATE TABLE IF NOT EXISTS `appointment_status` (
  `aps_id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_status` varchar(100) NOT NULL,
  PRIMARY KEY (`aps_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `appointment_status`
--

INSERT INTO `appointment_status` (`aps_id`, `appointment_status`) VALUES
(1, 'pending'),
(2, 'open'),
(3, 'close'),
(4, 'on hold'),
(5, 'cancle');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
CREATE TABLE IF NOT EXISTS `area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(250) NOT NULL,
  `enabled` int(1) NOT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`area_id`, `area_name`, `enabled`, `added_date`) VALUES
(2, 'Manjalpur', 1, '2016-02-03'),
(3, 'Kalali', 1, '2016-02-03'),
(4, 'Visat', 1, '2016-02-03'),
(5, 'C.G. Road', 1, '2016-02-03'),
(6, 'O.P. Road', 1, '2016-02-03'),
(7, 'Naranpura', 1, '2016-02-03'),
(8, 'Gitai Road', 1, '2016-02-03'),
(9, 'Ramanand Colony', 1, '2016-02-03'),
(10, 'Shikshak Wadi', 1, '2016-02-03'),
(11, 'Wadala', 1, '2016-02-03'),
(12, 'Trombay', 1, '2016-02-03'),
(13, 'Saki naka', 1, '2016-02-03'),
(14, 'Dombivalia', 1, '2016-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `attributes_groups`
--

DROP TABLE IF EXISTS `attributes_groups`;
CREATE TABLE IF NOT EXISTS `attributes_groups` (
  `ag_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  `enabled` int(1) DEFAULT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`ag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `attributes_groups`
--

INSERT INTO `attributes_groups` (`ag_id`, `group_name`, `enabled`, `added_date`) VALUES
(1, 'Flooring', 1, '0000-00-00'),
(2, 'Fitting', 1, '0000-00-00'),
(3, 'Walls', 1, '0000-00-00'),
(5, 'temp', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

DROP TABLE IF EXISTS `bid`;
CREATE TABLE IF NOT EXISTS `bid` (
  `bid_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `date_time` timestamp NOT NULL,
  PRIMARY KEY (`bid_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`bid_id`, `property_id`, `customer_id`, `amount`, `date_time`) VALUES
(1, 26, 10, 7950000, '2016-02-14 18:10:36'),
(2, 27, 11, 62800000, '2016-02-14 18:14:42'),
(3, 26, 1, 7900000, '2016-02-11 12:09:56'),
(4, 27, 1, 6300000, '2016-02-11 12:10:11'),
(5, 27, 12, 6200000, '2016-02-11 12:09:45'),
(6, 27, 13, 61000000, '2016-02-11 12:09:45'),
(7, 27, 14, 6000000, '2016-02-11 12:09:45'),
(8, 26, 1, 7900000, '2016-02-11 12:09:56'),
(9, 27, 14, 500000, '2016-02-11 12:09:45'),
(10, 4, 11, 1593500, '2016-02-11 18:32:06'),
(11, 27, 10, 62300000, '2016-02-14 18:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `bid_dates_property`
--

DROP TABLE IF EXISTS `bid_dates_property`;
CREATE TABLE IF NOT EXISTS `bid_dates_property` (
  `bdp_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `dates` date NOT NULL,
  PRIMARY KEY (`bdp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=203 ;

--
-- Dumping data for table `bid_dates_property`
--

INSERT INTO `bid_dates_property` (`bdp_id`, `property_id`, `dates`) VALUES
(1, 8, '1970-01-01'),
(2, 8, '1970-01-01'),
(3, 9, '1970-01-01'),
(4, 9, '1970-01-01'),
(5, 10, '1970-01-01'),
(6, 24, '2016-03-09'),
(165, 1, '2016-02-10'),
(180, 3, '2016-02-11'),
(202, 25, '2016-03-02'),
(179, 4, '2016-02-11'),
(178, 6, '2016-02-11'),
(201, 26, '2016-03-02'),
(198, 27, '2016-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `bid_time_table`
--

DROP TABLE IF EXISTS `bid_time_table`;
CREATE TABLE IF NOT EXISTS `bid_time_table` (
  `btt_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_notified` int(1) DEFAULT NULL,
  PRIMARY KEY (`btt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `bid_time_table`
--

INSERT INTO `bid_time_table` (`btt_id`, `date`, `start_time`, `end_time`, `is_notified`) VALUES
(2, '2016-02-08', '18:31:00', '23:15:00', NULL),
(3, '2016-02-09', '18:30:00', '17:35:00', 0),
(4, '2016-02-10', '08:00:00', '21:00:00', NULL),
(5, '2016-02-10', '09:30:00', '13:15:00', 0),
(6, '2016-03-01', '21:00:00', '23:00:00', NULL),
(7, '2016-03-02', '09:13:00', '17:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `parent_category` int(11) DEFAULT NULL,
  `enabled` int(1) DEFAULT NULL,
  `created_on` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `category`, `parent_category`, `enabled`, `created_on`) VALUES
(6, 'commercial', 0, 1, '2016-02-05 00:00:00'),
(7, 'residential', 0, 1, '2016-02-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `client_images`
--

DROP TABLE IF EXISTS `client_images`;
CREATE TABLE IF NOT EXISTS `client_images` (
  `ci_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(200) NOT NULL,
  PRIMARY KEY (`ci_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `client_images`
--

INSERT INTO `client_images` (`ci_id`, `image_name`) VALUES
(1, '01.png'),
(2, '02.png'),
(3, '03.png'),
(4, '04.png'),
(5, '05.png'),
(6, '06.png'),
(7, '07.png'),
(8, '08.png');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `message` int(11) NOT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`c_id`, `name`, `email`, `phone`, `message`, `added_date`) VALUES
(1, 'Hillary Walters', 'zalesimeg@hotmail.com', 243724124961, 0, '2016-01-29'),
(2, 'Ferdinand Giles', 'hogujuf@hotmail.com', 743753147297, 0, '2016-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `phone` bigint(10) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `city` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `state` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `newsletter` tinyint(4) DEFAULT NULL,
  `sms_enabled` int(1) DEFAULT NULL,
  `enabled` int(1) DEFAULT NULL,
  `ip` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `profile_picture` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created_on` date NOT NULL,
  `last_login` timestamp NOT NULL,
  `last_update` timestamp NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `city`, `state`, `password`, `newsletter`, `sms_enabled`, `enabled`, `ip`, `profile_picture`, `created_on`, `last_login`, `last_update`) VALUES
(1, 'krafty', 'Hardys', 'krafty.developer@gmail.com', 7574862602, NULL, NULL, NULL, 'DGER2M4kayJj33ThWXYMClKdBMAP3/g3aHaJ5zvEMa29R2vsVDhyfB8M7N9stXcH7itfKIkDexKakWunH2SGTA==', 1, NULL, 1, '127.0.0.1', NULL, '2016-01-29', '2016-02-11 15:28:49', '0000-00-00 00:00:00'),
(2, 'developer', NULL, 'krafty.developer@gmail.coms', 263921852623, NULL, NULL, NULL, 'DGER2M4kayJj33ThWXYMClKdBMAP3/g3aHaJ5zvEMa29R2vsVDhyfB8M7N9stXcH7itfKIkDexKakWunH2SGTA==', 0, NULL, 1, NULL, NULL, '2016-01-29', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'admin', NULL, 'Email@gmo.com', NULL, NULL, NULL, NULL, 'DGER2M4kayJj33ThWXYMClKdBMAP3/g3aHaJ5zvEMa29R2vsVDhyfB8M7N9stXcH7itfKIkDexKakWunH2SGTA==', 0, NULL, 1, NULL, NULL, '2016-01-30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'admin', NULL, 'sylawyg@yahoo.com', NULL, NULL, NULL, NULL, 'DGER2M4kayJj33ThWXYMClKdBMAP3/g3aHaJ5zvEMa29R2vsVDhyfB8M7N9stXcH7itfKIkDexKakWunH2SGTA==', 1, NULL, 1, NULL, NULL, '2016-01-30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Iris', 'Dejesus', 'iris@mail.com', 4628322869, '45 somya soc.', 'Vadodara', 'Gujarat', 'DGER2M4kayJj33ThWXYMClKdBMAP3/g3aHaJ5zvEMa29R2vsVDhyfB8M7N9stXcH7itfKIkDexKakWunH2SGTA==', 0, NULL, 1, '192.168.2.6', 'businessman-profile-icon-male-portrait-flat-design-vector-illustration-51814114.jpg', '2016-02-03', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'abcd', NULL, 'abc@gmail.com', 12121212121, NULL, NULL, NULL, 'DGER2M4kayJj33ThWXYMClKdBMAP3/g3aHaJ5zvEMa29R2vsVDhyfB8M7N9stXcH7itfKIkDexKakWunH2SGTA==', NULL, NULL, 1, NULL, NULL, '2016-02-07', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'sdfsdf', NULL, 'sylawyg@yahoo0.com', 7894561230, NULL, NULL, NULL, 'DGER2M4kayJj33ThWXYMClKdBMAP3/g3aHaJ5zvEMa29R2vsVDhyfB8M7N9stXcH7itfKIkDexKakWunH2SGTA==', NULL, NULL, 1, NULL, NULL, '2016-02-07', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '12312121212', NULL, 'xekogirep@yahoo.com', 12312121212, NULL, NULL, NULL, 'DGER2M4kayJj33ThWXYMClKdBMAP3/g3aHaJ5zvEMa29R2vsVDhyfB8M7N9stXcH7itfKIkDexKakWunH2SGTA==', NULL, NULL, 1, '192.168.2.5', NULL, '2016-02-07', '2016-02-10 18:47:54', '0000-00-00 00:00:00'),
(10, 'demo', 'demolast', 'demo@mail.com', 9332561480, '', '', '', 'DGER2M4kayJj33ThWXYMClKdBMAP3/g3aHaJ5zvEMa29R2vsVDhyfB8M7N9stXcH7itfKIkDexKakWunH2SGTA==', 0, NULL, 1, '192.168.2.5', NULL, '2016-02-08', '2016-02-14 18:06:07', '0000-00-00 00:00:00'),
(11, 'Ramona', NULL, 'ramona@gmail.com', 64916004095, NULL, NULL, NULL, 'DGER2M4kayJj33ThWXYMClKdBMAP3/g3aHaJ5zvEMa29R2vsVDhyfB8M7N9stXcH7itfKIkDexKakWunH2SGTA==', NULL, NULL, 1, '192.168.2.2', NULL, '2016-02-10', '2016-02-14 18:02:49', '0000-00-00 00:00:00'),
(12, 'asd', NULL, 'asd@gamil.com', 7867564545, NULL, NULL, NULL, '+mZTlIgw+i+e9+ekil62p6vY+BqFsgvyruVQasWS/hh/5nftnfVPqyWqYPpbwfHR3I9k0aab8NtZ3vCao3440w==', NULL, NULL, 1, NULL, NULL, '2016-02-22', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'cvc', 'cvv', 'cvc', 43434, '', '', '', 'KdXwZvMszctPc2gr6Sm/HISnxF8BFTPJWE/NdIdVLdlXk7HmXebR5bG49emQ+H3oGg/duR4mbsuS1+YYVPeExA==', 1, NULL, 1, '127.0.0.1', NULL, '2016-02-23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'mayuri', NULL, 'mayuri@gmail.com', 6756564545, NULL, NULL, NULL, 'ymAlMYNwVF8bMl5aYc1lXjU1dsqZMm8SpUIw8ncEd4JJfXVLCRMXZjiwmlRcPohrsMOyB64pqrUBcmT2+FDMLA==', NULL, NULL, 1, NULL, NULL, '2016-03-02', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer_buy_package`
--

DROP TABLE IF EXISTS `customer_buy_package`;
CREATE TABLE IF NOT EXISTS `customer_buy_package` (
  `cp_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `package_name` varchar(50) NOT NULL,
  `package_price` decimal(10,2) NOT NULL,
  `package_start_date` date NOT NULL,
  `package_end_date` date NOT NULL,
  `totalamt` decimal(10,2) NOT NULL,
  `payment_done` int(1) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `package_category_id` int(11) DEFAULT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`cp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customer_buy_package`
--

INSERT INTO `customer_buy_package` (`cp_id`, `package_id`, `customer_id`, `package_name`, `package_price`, `package_start_date`, `package_end_date`, `totalamt`, `payment_done`, `payment_method`, `package_category_id`, `added_date`) VALUES
(1, 2, 11, 'Gold', '500.00', '2016-02-11', '2016-02-17', '500.00', 0, 'PayUmoney', 2, '2016-02-11'),
(2, 2, 11, 'Gold', '500.00', '2016-02-11', '2016-02-17', '500.00', 1, 'PayUmoney', 2, '2016-02-11'),
(3, 2, 10, 'Gold', '500.00', '2016-02-14', '2016-02-20', '500.00', 1, 'PayUmoney', 2, '2016-02-14'),
(4, 1, 12, 'Silver', '100.00', '2016-02-22', '2016-02-23', '100.00', 0, 'PayUmoney', 1, '2016-02-22'),
(5, 1, 14, 'Silver', '100.00', '2016-03-02', '2016-03-03', '100.00', 0, 'PayUmoney', 1, '2016-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `customer_followed_pro`
--

DROP TABLE IF EXISTS `customer_followed_pro`;
CREATE TABLE IF NOT EXISTS `customer_followed_pro` (
  `cfp_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cfp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_package_history`
--

DROP TABLE IF EXISTS `customer_package_history`;
CREATE TABLE IF NOT EXISTS `customer_package_history` (
  `cp_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `package_name` varchar(50) NOT NULL,
  `package_price` decimal(10,2) NOT NULL,
  `package_start_date` date NOT NULL,
  `package_end_date` date NOT NULL,
  `totalamt` decimal(10,2) NOT NULL,
  `payment_done` int(1) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `package_category_id` int(11) DEFAULT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`cp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customer_package_history`
--

INSERT INTO `customer_package_history` (`cp_id`, `customer_id`, `package_name`, `package_price`, `package_start_date`, `package_end_date`, `totalamt`, `payment_done`, `payment_method`, `package_category_id`, `added_date`) VALUES
(1, 11, 'Gold', '500.00', '2016-02-11', '2016-02-17', '500.00', 0, 'PayUmoney', 2, '2016-02-11'),
(2, 11, 'Gold', '500.00', '2016-02-11', '2016-02-17', '500.00', 1, 'PayUmoney', 2, '2016-02-11'),
(3, 10, 'Gold', '500.00', '2016-02-14', '2016-02-20', '500.00', 1, 'PayUmoney', 2, '2016-02-14'),
(4, 12, 'Silver', '100.00', '2016-02-22', '2016-02-23', '100.00', 0, 'PayUmoney', 1, '2016-02-22'),
(5, 14, 'Silver', '100.00', '2016-03-02', '2016-03-03', '100.00', 0, 'PayUmoney', 1, '2016-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `mail_templates`
--

DROP TABLE IF EXISTS `mail_templates`;
CREATE TABLE IF NOT EXISTS `mail_templates` (
  `mt_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_title` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `mail_content` text CHARACTER SET latin1,
  `added_date` date NOT NULL,
  `send_msg` int(1) DEFAULT NULL,
  `msg_template` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`mt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `mail_templates`
--

INSERT INTO `mail_templates` (`mt_id`, `mail_title`, `mail_content`, `added_date`, `send_msg`, `msg_template`) VALUES
(1, 'customer_forgott_mail_template', 'Hello {username} ,<br >Your password is {password}<br />To login click {login_page_link} ,<br ><br >Thank You<br />{company_name}', '2015-11-26', 1, 'Hello {username},Your password is {password},Thank You .{company_name}.'),
(2, 'admin_forgott_mail_template', 'Hello {username} ,<br >Your password is {password}<br />To login click {login_page_link} ,<br ><br >Thank You<br />{company_name}', '2015-11-26', NULL, NULL),
(3, 'package_subscribed', 'Dear {customername},\n\nYour Package {package_name}  has been  Subscription successfully. <br> Please Check Your payment Details Below. <br> {package_name} - {price}-{date}.<br>\nThanks & regards\n<br>\n{company_name}\n', '2015-12-07', 0, 'Dear {customername},\nYour {package_name}  has been  Subscription successfully. Please Check Your payment Details Below. {package_name} - {price}-{date}.\nThanks & regards\n{company_name}\n'),
(9, 'package_expiry', 'Hello {username},\n<br>\nYour package is about to expire on {date}.\n<br>\nPlease buy package to continue services.', '2016-02-08', 1, 'Hello {username},\nYour package is about to expire on {date}.\nPlease buy package to continue services.'),
(10, 'schedule_appointment', 'Hello {username},<br>\nYour appointment has been scheduled on {date} at {time_slot}.\n<br>\nRegards,\n{company_name}.', '2016-02-08', 1, 'Hello {username},\nYour appointment has been scheduled on {date} at {time_slot}.'),
(11, 'reminder_appointment', 'Hello {username},<br>\nYou have an appointment for property at {time} today.<br>\nRegards,<br>\n{companyname}', '2016-02-08', 1, 'Hello {username},\nYou have an appointment for property at {time} today.\nRegards,\n{companyname}'),
(12, 'congratulation_bid_winner', 'Congratulation {username},\n<br>\nYou are invited to visit property as you are one of the top bidders.for schedule appointment {link}.', '2016-02-08', 1, 'Congratulation {username},\nYou are invited to visit property as you are one of the top bidders.Please schedule appointment.');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

DROP TABLE IF EXISTS `package`;
CREATE TABLE IF NOT EXISTS `package` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(50) DEFAULT NULL,
  `package_price` decimal(10,2) DEFAULT NULL,
  `package_periods` int(11) DEFAULT NULL,
  `package_category_id` int(11) NOT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `package_name`, `package_price`, `package_periods`, `package_category_id`, `added_date`) VALUES
(1, 'Silver', '100.00', 1, 1, '2016-02-02'),
(2, 'Gold', '500.00', 6, 2, '2016-01-22'),
(3, 'Platinum', '1000.00', 12, 3, '2016-01-25'),
(6, 'Sydney Haynes', '47.00', 54, 1, '2016-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `package_category`
--

DROP TABLE IF EXISTS `package_category`;
CREATE TABLE IF NOT EXISTS `package_category` (
  `package_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_category_name` varchar(255) DEFAULT NULL,
  `extend_days_for_same_package` int(11) DEFAULT NULL,
  PRIMARY KEY (`package_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `package_category`
--

INSERT INTO `package_category` (`package_category_id`, `package_category_name`, `extend_days_for_same_package`) VALUES
(1, 'Rental/Sale Package', 2),
(2, 'Bidding Packages', 10),
(3, 'Investment Opportunities Packages', 10);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `meta_keywords` text CHARACTER SET latin1 NOT NULL,
  `meta_description` text CHARACTER SET latin1 NOT NULL,
  `content` text CHARACTER SET latin1 NOT NULL,
  `show_on_menu` int(1) DEFAULT NULL,
  `unique_alias` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`p_id`, `title`, `meta_keywords`, `meta_description`, `content`, `show_on_menu`, `unique_alias`, `created_on`) VALUES
(2, 'disclaimer', 'Est consectetur consequatur, pariatur? Maxime exercitation sunt, odio harum sed praesentium aspernatur obcaecati accusantium enim veniam, nulla labore in.', 'Est consectetur consequatur, pariatur? Maxime exercitation sunt, odio harum sed praesentium aspernatur obcaecati accusantium enim veniam, nulla labore in.', '<p>Est consectetur consequatur, pariatur? Maxime exercitation sunt, odio harum sed praesentium aspernatur obcaecati accusantium enim veniam, nulla labore in.Est consectetur consequatur, pariatur? Maxime exercitation sunt, odio harum sed praesentium aspernatur obcaecati accusantium enim veniam, nulla labore in.Est consectetur consequatur, pariatur? Maxime exercitation sunt, odio harum sed praesentium aspernatur obcaecati accusantium enim veniam, nulla labore in.Est consectetur consequatur, pariatur? Maxime exercitation sunt, odio harum sed praesentium aspernatur obcaecati accusantium enim veniam, nulla labore in.Est consectetur consequatur, pariatur? Maxime exercitation sunt, odio harum sed praesentium aspernatur obcaecati accusantium enim veniam, nulla labore in.</p>\r\n', 1, 'disclaimer', '2015-12-01 07:56:12'),
(4, 'Privacy Policy', 'In ea pariatur. Fugiat voluptas officia ut dolores aut voluptatem quisquam quaerat nostrum odit.', 'Quo dolores laborum. Veritatis incidunt, deserunt dolores excepteur consequatur? Blanditiis lorem eius rerum voluptates omnis aut iste exercitationem eu.', '<h2>Privacy</h2>\r\n\r\n<ol>\r\n <li>This Privacy Policy is Demo And Build official online privacy policy and it applies to all personal information collected by Demo And Build. In this policy we explain how and why we collect your personal information, how we use it, and what controls you have over our use of it.</li>\r\n <li>Demo And Build is committed to complying with Commonwealth legislation governing privacy of personal information by businesses and to protecting and safeguarding your privacy when you deal with us.</li>\r\n</ol>\r\n\r\n<h3>Collection of information</h3>\r\n\r\n<ol start="3">\r\n <li>Some information provided to us by clients, customers, contractors and other third parties might be considered private or personal. Without these details we would not be able to carry on our business and provide our services to you. We will only collect such personal information if it is necessary for one of our functions or activities.</li>\r\n <li>In particular, personal information is collected from people in the following situations by Demo And Build:\r\n <ul>\r\n  <li>If you contact Demo And Build, we may keep a record of that correspondence.</li>\r\n  <li>When you submit your e-mail address to our web site mailing list.</li>\r\n </ul>\r\n </li>\r\n <li>At or before the time the personal information is collected by us we will take reasonable steps to ensure that you are made aware of who we are, the fact that you are able to gain access to the information held about you, the purpose of the collection, the type(s) of organisations to which we usually disclose the information collected about you, any laws requiring the collection of the information and the main consequences for you if all or part of the information is not collected.</li>\r\n</ol>\r\n\r\n<h3>Use of information collected and disclosure of personal information to others</h3>\r\n\r\n<ol start="6">\r\n <li>We may use or disclose personal information held about an individual for the primary purpose for which it is collected (eg. provision of our services, including administration of our services, notification to you about changes to our services, record-keeping following termination of our services to you and technical maintenance). We may also use such information for a purpose related to the primary purpose of collection and where it would reasonably be expected by you that we would use the information in such a way. This information is only disclosed to persons outside our business in the circumstances set out in this policy or as otherwise notified to you at the time of collection of the information.</li>\r\n <li>In addition we are permitted to use or disclose personal information held about you:\r\n <ul>\r\n  <li>Where you have consented to the use or disclosure;</li>\r\n  <li>Where we reasonably believe that the use or disclosure is necessary to lessen or prevent a serious, immediate threat to someone&#39;s health or safety or the public&#39;s health or safety;</li>\r\n  <li>Where we reasonably suspect that unlawful activity has been, is being or may be engaged in and the use or disclosure is a necessary part of our investigation or in reporting the matter to the relevant authorities;</li>\r\n  <li>Where such use or disclosure is required under or authorised by law (for example, to comply with a subpoena, a warrant or other order of a court or legal process);</li>\r\n  <li>Where we reasonably believe that the use or disclosure is reasonably necessary for prevention, investigation, prosecution and punishment of crimes or wrongdoings or the preparation for, conduct of, proceedings before any court or tribunal or the implementation of the orders of a court or tribunal by or on behalf of an enforcement body.</li>\r\n </ul>\r\n </li>\r\n</ol>\r\n', 1, 'privacy-policy', '2015-12-01 08:20:36'),
(5, 'Terms and Conditions', 'Excepturi vel rem omnis rerum ut qui vel libero labore cupiditate ut ex iste non enim cupidatat cupiditate.', 'Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.', '<p>Terms and Conditions</p>\r\n\r\n<h3>Information Collected</h3>\r\n\r\n<div>DEMO collects personally identifying information and data about individuals, their company, and the companies demographics “personally identifying information and data” including (i) when you provide information to DEMO, such as when you register or sign up for any of our products such as, but not limited to, events, conferences, on-line seminars contests, RSS Feeds, webcasts, and other communications with DEMO; (ii) when you register or sign up on any DEMO site, your information will be known to DEMO; and (iii) from time to time we may add other information that we collect from third party sources to enhance the information that you provided to DEMO.</div>\r\n\r\n<p> \r\n<h2>Notice of New Policy Changes</h2>\r\n</p>\r\n\r\n<div>Below is the current policy regarding the usage of personally identifying information and data collected by DEMO. We reevaluate this policy on an ongoing basis. DEMO reserves the right to change its privacy policy. However, if there are any changes to the use of personally identifying information and data that is different from that stated at the time of collection, we will notify you by posting a notice on our Web site.</div>\r\n\r\n<p> \r\n<h3>Cookies</h3>\r\n</p>\r\n\r\n<div>DEMO, or one of our IDG affiliated companies, or third party partners may place a "cookie" in the browser files of a user&#39;s computer. The cookie itself does not contain any personally identifying information, except when such information has been supplied by a user.</div>\r\n\r\n<p> \r\n<div>If you have visited our Web site, the information in your "cookie" is used to provide a more personalized experience on the Web site. This cookie identifies you as a unique user by means of a tracking ID. However, we cannot link that user ID with personal identifying information and data about you such as your name or e-mail address.</div>\r\n</p>\r\n\r\n<p> \r\n<div>Browsers or third-party software can allow you to block the use of cookies while you surf our site. Or, you can use third-party "anonymizer" services to mask information in your cookies, or even general data such as your IP address. In such cases, you would not be able to take advantage of most of the personalization services offered by DEMO.</div>\r\n</p>\r\n\r\n<p> \r\n<div>The aggregated information we collect may be used:</div>\r\n</p>\r\n\r\n<p> \r\n<div>\r\n<ol>\r\n <li>   to improve the content and design of the DEMO Web site.</li>\r\n <li>   to enable an audit bureau to verify our claims of traffic to the site</li>\r\n <li>   to help advertisers, potential advertiser, demonstrators (exhibitors), potential demonstrators, sponsors, potential sponsors, or marketers to assess the suitability of the site for their ad campaigns</li>\r\n <li>   we may create and use aggregate customer data to understand more about the interests of our customers and may use the data to offer goods and services we believe may be of interest to our customers, on behalf of DEMO or selection organizations.</li>\r\n</ol>\r\n</div>\r\n</p>\r\n', 1, 'terms-and-conditions', '2015-12-29 10:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

DROP TABLE IF EXISTS `property`;
CREATE TABLE IF NOT EXISTS `property` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_title` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `set_as_feature` int(1) DEFAULT NULL,
  `open_for_bid` int(1) DEFAULT '0',
  `property_slug` varchar(255) DEFAULT NULL,
  `property_small_desc` varchar(255) NOT NULL,
  `property_content` text NOT NULL,
  `property_type` int(11) NOT NULL,
  `property_action` varchar(100) NOT NULL,
  `beds` int(11) DEFAULT NULL,
  `bathrums` int(11) DEFAULT NULL,
  `landmark` varchar(100) DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `built_up_area` int(255) DEFAULT NULL,
  `property_owner` varchar(255) NOT NULL,
  `property_owner_phone` bigint(20) DEFAULT NULL,
  `transaction_type` varchar(255) DEFAULT NULL,
  `cost` bigint(20) DEFAULT NULL,
  `bid_difference` bigint(20) NOT NULL,
  `carpet_area` int(11) DEFAULT NULL,
  `posted_by_id` int(11) DEFAULT NULL,
  `approved` int(1) NOT NULL,
  `added_on` date DEFAULT NULL,
  `feature_image` varchar(255) DEFAULT NULL,
  `set_in_slider_img` int(11) DEFAULT NULL,
  `slider_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`property_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `property_title`, `status`, `set_as_feature`, `open_for_bid`, `property_slug`, `property_small_desc`, `property_content`, `property_type`, `property_action`, `beds`, `bathrums`, `landmark`, `area`, `built_up_area`, `property_owner`, `property_owner_phone`, `transaction_type`, `cost`, `bid_difference`, `carpet_area`, `posted_by_id`, `approved`, `added_on`, `feature_image`, `set_in_slider_img`, `slider_image`) VALUES
(1, '2 BHK Apartment 1207 sqft', '', 1, 1, '2-bhk-apartment-1207-sqft', 'Exercitation iure sed ipsam eius sed cillum minus ut quia laudantium proident ut qui', 'Consequat. Eaque et voluptatem. Ipsum, debitis illum, corrupti, quia aut amet.', 6, 'sale', 10, 10, 'Aut magni odit sunt fugiat', 0, 111, 'owener', 0, 'New Booking', 1100000, 250000, 0, 1, 1, '2016-02-10', 'property_11.jpg', NULL, ''),
(2, '3 BHK Apartment 1911 sqft', '', 0, 0, '3-bhk-apartment-1911-sqft', 'Ipsum minus ut sunt et aut non', 'Ipsum minus ut sunt et aut non', 6, 'rent', 1, 1, 'Autem animi nisi omnis eiusmod sit dicta voluptatem Excepturi proident id eaque enim praesentium', 1, 111, 'owener', NULL, 'Resale', 1100000, 0, 11, 1, 1, '2016-02-10', 'property_11.jpg', 0, ''),
(3, '2 BHK Apartment 1100 sqft', '', 1, 1, '2-bhk-apartment-1100-sqft', 'Recusandae Amet fugiat soluta itaque veniam doloribus aut deserunt voluptates in dolores in consequatur et error magni deserunt alias reprehenderit', 'Assumenda mollitia velit sit adipisci tenetur lorem illo in magnam quas rerum dolorem voluptatem qui eaque iusto est, dolores.', 6, 'sale', 1, 1, 'Modi nesciunt beatae aperiam sit nisi expedita ut similique ad', 0, 111, 'owener', 0, 'New Booking', 1100000, 75000, 110, 1, 1, '2016-02-10', 'property_11.jpg', NULL, ''),
(4, '4 BHK House 2200 sqft', 'On Sale', NULL, 1, '4-bhk-house-2200-sqft', 'Featuring high quality Vitrified in different rooms, this 2 bedroom house has a covered area of 838 Sq-ft. The house has a booking amount of Rs 5,00,000. There is 24 Hours Available water supply and No/Rare Powercut. The house has Store Room. It faces Eas', 'Featuring high quality Vitrified in different rooms, this 2 bedroom house has a covered area of 838 Sq-ft. The house has a booking amount of Rs 5,00,000. There is 24 Hours Available water supply and No/Rare Powercut. The house has Store Room. It faces East direction & overlooks Main Road .', 6, 'sale', 2, 3, 'Arc Comaplex', 6, 1500, '', 4125424544, 'New Booking', 1543500, 50000, 0, 1, 1, '2016-02-10', 'property_210.jpg', NULL, ''),
(5, '3 BHK Villa 2200 sqft', '', 1, 0, '3-bhk-villa-2200-sqft', '3 Bhk fully furnished row house available for sale with covered car parking. for site visit call us. ', '3 Bhk fully furnished row house available for sale with covered car parking. for site visit call us. ', 6, 'rent', 5, 4, 'kalali bridge', 3, 1500, 'builder', 0, 'New Booking', 150000000, 0, 0, 1, 1, '2016-02-10', 'property_36.jpg', NULL, ''),
(6, '3 BHK Villa 3500 sqft', 'On Sale', NULL, 1, '3-bhk-villa-3500-sqft', 'Gera''s Isle Royal at Bavdhan guarantees you peace, privacy and luxury all at the same time. Available 3BHK villa with world class amenities.', 'Gera''s Isle Royal at Bavdhan guarantees you peace, privacy and luxury all at the same time. Available 3BHK villa with world class amenities. Fully airconditioned villa,special attention has been paid to every furnishing and fitting, with the best brands adorning your home. Dip in the private pool, jacuzzi, yoga/meditation centre, basketball court, the grand club house, landscaped garden and tons of other options helps you relax at your home all the time. Moreover , it is centrally loacted that provides you easy access to all over the city yet it fantastically captures forest behind it.', 7, 'sale', 4, 4, 'Bavdhan', 11, 3500, 'Builder', 5211654163131, 'Resale', 32010000, 25000, 0, 1, 1, '2016-02-10', 'pe41.jpg', 1, 'p11.jpg'),
(25, '1 BHK Flat 584 sqft', 'On Sale', NULL, 1, '1-bhk-flat-584-sqft', 'This Apartment is located in Wagholi, Pune. It is a spacious and well-ventilated apartment loaded with state-of-the-art amenities. The key specifications include all the latest facilities. ', 'This Apartment is located in Wagholi, Pune. It is a spacious and well-ventilated apartment loaded with state-of-the-art amenities. The key specifications include all the latest facilities. ', 7, 'sale', 1, 1, '', 3, 584, 'builder', 5456454564, 'Resale', 2680000, 10000, 0, 1, 1, '2016-02-10', 'property_34.jpg', NULL, 'property_35.jpg'),
(26, '3 BHK Flat 1363 sqft', 'On Sale', 1, 1, '3-bhk-flat-1363-sqft', 'This apartment is located in Hinjewadi Adj to Infosys Phase II Pune. Its a spacious and well-ventilated apartment loaded with state-of-the-art amenities.Its a Free Hold Property with Beautiful Hill View & Cityscape. Good social infrastructure around the p', 'This apartment is located in Hinjewadi Adj to Infosys Phase II Pune. Its a spacious and well-ventilated apartment loaded with state-of-the-art amenities.Its a Free Hold Property with Beautiful Hill View & Cityscape. Good social infrastructure around the project will all the modern amenities, including Club House, Gymnasium, Swimming Pool, Wifi in Common areas & many more.', 7, 'sale', 4, 3, 'Hinjewadi Hospital', 12, 1200, 'Builder', 6546146416631632, 'New Booking', 7800000, 50000, 0, 1, 1, '2016-02-10', 'property_52.jpg', 1, 'demo3846.jpg'),
(27, '2 BHK Flat 1000 sqft', 'On Sale', NULL, 1, '2-bhk-flat-1000-sqft-1', 'It''s a 2 bedroom Flat with an adjoining hall. This Semi-Furnished flat has a covered area of 1000 Sq-ft & has 2 bathrooms. The flat has Marble, Vitrified, Wooden flooring. It overlooks Garden/Park , Pool , Main Road and faces East direction. The booking a', 'It''s a 2 bedroom Flat with an adjoining hall. This Semi-Furnished flat has a covered area of 1000 Sq-ft & has 2 bathrooms. The flat has Marble, Vitrified, Wooden flooring. It overlooks Garden/Park , Pool , Main Road and faces East direction. The booking amount is Rs 5,00,000. The flat is approved by Developer', 6, 'sale', 2, 2, 'Landmark', 10, 1000, 'Builder', 5456454564, '', 5900000, 100000, 0, 1, 1, '2016-02-10', 'pe23.jpg', NULL, 'pe24.jpg'),
(28, '2 BHK Flat 1000 sqft', 'On Rent', NULL, 0, '2-bhk-flat-1000-sqft', 'Bluewoods, 2 and 3 BHK premium apartments in Pimple Saudagar.  Balanced Living Urban living comes with its own delights and challenges. The phenomenal opportunities of city living have a price-tag of its hustle and bustle. That is why we are all in a sear', 'Bluewoods, 2 and 3 BHK premium apartments in Pimple Saudagar.\r\n\r\nBalanced Living Urban living comes with its own delights and challenges. The phenomenal opportunities of city living have a price-tag of its hustle and bustle. That is why we are all in a search for a quiet escape in sync with nature. Bluewoods is a peaceful and naturally blessed Nilgiri paradise in the heart of a bustling neighborhood. It''s the ideal escape - a place where you can enjoy nature and peace right in the heart of an urban conglomerate.\r\n', 6, 'rent', 2, 2, 'Near Kunal Icon Road.', 2, 1000, 'Builder', 4377378374454, 'New Booking', 5900000, 0, 0, 1, 1, '2016-02-10', 'property_29.jpg', 1, 'demo34145.jpg'),
(29, ' 61072 Residential Properties', 'On Investments', 1, 1, '61072-residential-properties', 'Ganga Acropolis is a beautiful project surrounded by green mountains in a pollution free area. The urban infrastructure and elegant designs are perfectly infused in every living spaces. The magnificent towers are grand and impressive while the lush greene', 'Ganga Acropolis is a beautiful project surrounded by green mountains in a pollution free area. The urban infrastructure and elegant designs are perfectly infused in every living spaces. The magnificent towers are grand and impressive while the lush greene', 7, 'investments', 2, 2, 'Landmark', 5, 1015, 'Builder', 1287545454, 'Resale', 2500000, 0, 0, 1, 1, '2016-02-10', 'demo13.jpg', 1, 'demo14.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `property_attributes`
--

DROP TABLE IF EXISTS `property_attributes`;
CREATE TABLE IF NOT EXISTS `property_attributes` (
  `pa_id` int(11) NOT NULL AUTO_INCREMENT,
  `attributes_id` int(11) NOT NULL,
  `attributes_value` varchar(255) NOT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`pa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=131 ;

--
-- Dumping data for table `property_attributes`
--

INSERT INTO `property_attributes` (`pa_id`, `attributes_id`, `attributes_value`, `property_id`) VALUES
(98, 1, 'glaz tiles', 5),
(111, 14, 'asedfasdfasdf', 6),
(4, 15, 'sdsd', 7),
(129, 15, '12', 26),
(130, 12, 'asdfasdfasdf', 25),
(126, 12, '12', 27),
(68, 1, '', 29),
(112, 2, '', 4),
(100, 7, 'Stylish Wooden', 28);

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

DROP TABLE IF EXISTS `property_images`;
CREATE TABLE IF NOT EXISTS `property_images` (
  `pi_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=361 ;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`pi_id`, `property_id`, `image_name`) VALUES
(283, 4, 'demo31.jpg'),
(227, 5, 'pp2.jpg'),
(226, 5, 'pp1.jpg'),
(224, 5, 'demo3.jpg'),
(225, 5, 'demo5.jpg'),
(223, 5, 'demo2.jpg'),
(16, 7, 'Desert.jpg'),
(344, 27, 'pre2.jpg'),
(360, 25, 'pp1.jpg'),
(343, 27, 'pre1.jpg'),
(122, 29, 'demo3.jpg'),
(121, 29, 'demo2.jpg'),
(120, 29, 'Demo1.jpg'),
(356, 26, 'property12.jpg'),
(234, 28, 'pp3.jpg'),
(233, 28, 'pp2.jpg'),
(232, 28, 'pp1.jpg'),
(342, 27, 'pre4.jpg'),
(341, 27, 'pre3.jpg'),
(359, 25, 'pp5.jpg'),
(355, 26, 'property13.jpg'),
(354, 26, 'property14.jpg'),
(353, 26, 'property15.jpg'),
(358, 25, 'pp6.jpg'),
(357, 25, 'pp7.jpg'),
(123, 29, 'demo4.jpg'),
(279, 6, 'pre4.jpg'),
(278, 6, 'pre1.jpg'),
(277, 6, 'pp10.jpg'),
(276, 6, 'pp8.jpg'),
(275, 6, 'pp7.jpg'),
(282, 4, 'demo42.jpg'),
(281, 4, 'demo23.jpg'),
(286, 3, 'pre2.jpg'),
(285, 3, 'pre1.jpg'),
(287, 3, 'pre3.jpg'),
(288, 3, 'property12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rented_propety`
--

DROP TABLE IF EXISTS `rented_propety`;
CREATE TABLE IF NOT EXISTS `rented_propety` (
  `rp_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `rent` decimal(10,2) NOT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`rp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rented_propety`
--

INSERT INTO `rented_propety` (`rp_id`, `property_id`, `customer_id`, `start_date`, `end_date`, `rent`, `added_date`) VALUES
(1, 5, 3, '2016-02-07', '2016-02-22', '5000.00', '2016-02-06');

-- --------------------------------------------------------

--
-- Table structure for table `roi_table`
--

DROP TABLE IF EXISTS `roi_table`;
CREATE TABLE IF NOT EXISTS `roi_table` (
  `roi_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `return_of_investment` int(11) NOT NULL,
  PRIMARY KEY (`roi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `roi_table`
--

INSERT INTO `roi_table` (`roi_id`, `property_id`, `year`, `return_of_investment`) VALUES
(25, 29, 4, 4),
(24, 29, 2, 10),
(23, 29, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale_property`
--

DROP TABLE IF EXISTS `sale_property`;
CREATE TABLE IF NOT EXISTS `sale_property` (
  `sale_property_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `bid_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`sale_property_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sale_property`
--

INSERT INTO `sale_property` (`sale_property_id`, `property_id`, `bid_id`, `customer_id`, `amount`, `date_added`) VALUES
(2, 27, NULL, 1, '100000.00', '2016-02-19'),
(3, 1, NULL, 1, '10.00', '2016-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `set_key` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `value` text CHARACTER SET latin1,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `set_key`, `value`) VALUES
(1, 'admin_theme', 'default'),
(2, 'site_name', 'Labh Char'),
(3, 'front_theme', 'default'),
(4, 'email_address', 'krafty.developer@gmail.com'),
(7, 'mail_protocol', 'smtp'),
(8, 'smtp_host', 'ssl://smtp.gmail.com'),
(9, 'smtp_port', '465'),
(10, 'smtp_timeout', '50'),
(11, 'smtp_user', 'krafty.developer@gmail.com'),
(12, 'smtp_pass', '!WSD#@Ca323afsd'),
(18, 'company_name', 'Labh Char'),
(19, 'currency', 'USD'),
(20, 'facebook', 'http://Facebook.com/labhchar'),
(21, 'twitter', 'http://Twitter.com/labhchar'),
(22, 'instagram', 'http://instagram.com/labhchar'),
(77, 'advancedlogin_gpwdsecret', '232323'),
(76, 'fb_app_id', '2342342'),
(40, 'owner', 'Dev'),
(41, 'address', '801/2 Signet Business Hub, \r\nAkshar chowk,  \r\nVadodara'),
(42, 'phone', '9876543210'),
(43, 'language', 'en'),
(45, 'per_page', '10'),
(46, 'meta_titles', 'Consequat Est blanditiis iste quibusdam autem ad sint saepe voluptatem sit nesciunt voluptatem culpa'),
(47, 'meta_descriptions', 'Numquam odio accusantium hic quia totam aliquam ullamco harum qui tenetur voluptatem. Quam aspernatur doloribus ipsum.'),
(48, 'meta_keywords', 'Asperiores obcaecati velit, in reprehenderit, quod similique adipisci velit, in rerum debitis recusandae. Veniam.'),
(75, 'secret', 'sdd'),
(74, 'google_client_id', 'asdfa'),
(73, 'google_client_secret', 'asdfasd'),
(52, 'config_sms_sender_id', 'KRAFTY'),
(53, 'config_sms_username', 'krafty'),
(54, 'config_sms_password', 'allencdsesewre'),
(55, 'sms_enabled', '1'),
(56, 'backimage', '421050b8c0cc4a5aa5f932feb1ad0f7e-cctv_camera_repair_and_service1.jpg'),
(57, 'logoimage', 'main-logo.png'),
(79, 'sidebar_ads', '<script type="text/javascript"> \r\napp=www.cricwaves.com"; mo="f1_zd"; nt="ban"; mats =""; tor =""; Width=''302px''; Height=''252px''; wi ="w"; \r\n co ="ban"; ad="1"; \r\n</script>\r\n<script type="text/javascript" src="http://www.cricwaves.com/cricket/widgets/script/scoreWidgets.js"></script>\r\n'),
(71, 'aboutus', 'The Labhchar, established in 2016, is one of Vadodara’s leading property portal. In a short span of years, Labhchar has successfully developed a sprawling area of 1,25,000 sq.ft. In Vadodara.'),
(61, 'payu_enable', '1'),
(72, 'open_day', '0,5,6'),
(63, 'payu_salt', 'RjWAdXh0'),
(64, 'payu_key', 'OwGF14'),
(65, 'payu_test', '1'),
(70, 'googleplus', 'googleplus.com');

-- --------------------------------------------------------

--
-- Table structure for table `specification_attributes`
--

DROP TABLE IF EXISTS `specification_attributes`;
CREATE TABLE IF NOT EXISTS `specification_attributes` (
  `sa_id` int(11) NOT NULL AUTO_INCREMENT,
  `attributes_name` varchar(250) DEFAULT NULL,
  `attributes_group_id` int(11) NOT NULL,
  PRIMARY KEY (`sa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `specification_attributes`
--

INSERT INTO `specification_attributes` (`sa_id`, `attributes_name`, `attributes_group_id`) VALUES
(1, 'Balcony', 1),
(2, 'Kitchen', 1),
(3, 'Living/Dinnig', 1),
(4, 'Master Bedroom', 1),
(5, 'Other Bedroom', 1),
(6, 'Toilet', 1),
(7, 'Main Door', 2),
(8, 'Internal Door', 2),
(9, 'Electrical', 2),
(10, 'Kitchen', 2),
(11, 'Windows', 2),
(12, 'Exterior', 3),
(13, 'Interior', 3),
(14, 'Kitchen', 3),
(15, 'Toilets', 3),
(17, 'Temp temp', 5);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

DROP TABLE IF EXISTS `testimonial`;
CREATE TABLE IF NOT EXISTS `testimonial` (
  `testimonial_id` int(11) NOT NULL AUTO_INCREMENT,
  `testimonial_name` varchar(100) DEFAULT NULL,
  `testimonial` varchar(300) DEFAULT NULL,
  `user_position` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`testimonial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`testimonial_id`, `testimonial_name`, `testimonial`, `user_position`, `user_image`, `added_date`) VALUES
(1, 'Nehru Bonnerasdfasd', 'Libero necessitatibus nisi sed ipsum soluta ipsum, velit assumenda commodo sunt, consequat. Et repellendus. Velit.', 'Illo N', 'appliances.png', '2016-01-30'),
(2, 'Nehru Bonner', 'dsd', 'sd', 'refrigerator.png', '2016-01-30'),
(3, 'Quintessa Clay', 'Consequatur? Ab ab voluptatem. Aut tempor et ut eum amet, maiores quis iste consequatur, mollit.', 'Cupiditate sunt aut', 'plumber.png', '2016-01-30');

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

DROP TABLE IF EXISTS `time_slot`;
CREATE TABLE IF NOT EXISTS `time_slot` (
  `ts_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `enabled` int(1) NOT NULL,
  PRIMARY KEY (`ts_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`ts_id`, `start_time`, `end_time`, `enabled`) VALUES
(1, '10:00:00', '11:00:00', 1),
(2, '11:00:00', '12:00:00', 1),
(3, '13:00:00', '14:00:00', 1),
(4, '14:00:00', '15:00:00', 1),
(5, '15:00:00', '16:00:00', 1),
(6, '16:00:00', '17:00:00', 1),
(7, '17:00:00', '18:00:00', 1),
(8, '18:00:00', '19:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

DROP TABLE IF EXISTS `transaction_details`;
CREATE TABLE IF NOT EXISTS `transaction_details` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `transaction_type` varchar(100) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `transaction_time` time DEFAULT NULL,
  `transaction_amt` decimal(10,2) DEFAULT NULL,
  `added_on` date NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`transaction_id`, `user_id`, `customer_id`, `transaction_type`, `transaction_date`, `transaction_time`, `transaction_amt`, `added_on`) VALUES
(2, 1, 7, 'purchase', '2016-06-28', '01:00:00', '7.00', '2016-01-25'),
(3, 1, 5, 'purchase', '2016-02-04', '23:00:00', '5.00', '2016-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `last_login` timestamp NOT NULL,
  `last_update` timestamp NOT NULL,
  `created_on` timestamp NOT NULL,
  `ip` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `user_group_id`, `username`, `password`, `first_name`, `last_name`, `email`, `status`, `last_login`, `last_update`, `created_on`, `ip`) VALUES
(1, 1, 'admin', '9DEQQz+U0F+OqqKYUbRDRgnKaOtW1Iob824qsJpXpeLtCqoCK9zBLJmrxg0CmhsVs5OiFCWFpHtHHNHW0hiEWw==', 'admin', 'admins', 'Mageept58@einrot.com', 1, '2016-03-02 12:07:51', '2016-01-21 10:40:33', '0000-00-00 00:00:00', NULL),
(4, 2, 'agent', '9DEQQz+U0F+OqqKYUbRDRgnKaOtW1Iob824qsJpXpeLtCqoCK9zBLJmrxg0CmhsVs5OiFCWFpHtHHNHW0hiEWw==', 'Sonya', 'Daniels', 'nafypot@hotmail.com', 1, '2016-01-28 07:13:12', '0000-00-00 00:00:00', '2015-12-19 06:32:49', NULL),
(6, 2, 'annamicky', 'YIiQILqvfNalxSeG0E2Px/uao1oI2CIU7+LMD665PMTmQHvsKZvLoj2I2bcMu71baQBDEUasfov4OQyCPQnRfA==', 'Anna', 'Micky', 'anna@maill.com', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-02-04 06:41:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE IF NOT EXISTS `user_activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `act_key` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `data` text CHARACTER SET latin1,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=259 ;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`activity_id`, `user_id`, `act_key`, `data`, `date_added`) VALUES
(1, 1, 'Transaction Added', NULL, '2016-01-25 15:27:00'),
(2, 1, 'transaction Updated', NULL, '2016-01-25 15:33:09'),
(3, 1, 'transaction Updated', NULL, '2016-01-25 15:33:37'),
(4, 1, 'transaction Updated', NULL, '2016-01-25 15:33:52'),
(5, 1, 'transaction Updated', NULL, '2016-01-25 15:34:09'),
(6, 1, 'transaction Updated', NULL, '2016-01-25 15:35:09'),
(7, 1, 'Transaction Added', NULL, '2016-01-25 15:43:08'),
(8, 1, 'Transaction Updated', NULL, '2016-01-25 15:43:33'),
(9, 1, 'Transaction Updated', NULL, '2016-01-25 15:43:47'),
(10, 1, 'transaction Deleted', NULL, '2016-01-25 15:46:53'),
(11, 1, 'Customer Created', NULL, '2016-01-25 15:48:57'),
(12, 1, 'package Updated', NULL, '2016-01-25 15:49:30'),
(13, 1, 'Package Added', NULL, '2016-01-25 15:49:45'),
(14, 1, 'package Updated', NULL, '2016-01-25 15:49:57'),
(15, 1, 'package Updated', NULL, '2016-01-25 15:50:02'),
(16, 1, 'package Updated', NULL, '2016-01-25 15:50:19'),
(17, 1, 'Subscription Package successfully added', NULL, '2016-01-27 14:44:25'),
(18, 1, 'Subscription Package successfully added', NULL, '2016-01-27 14:51:33'),
(19, 1, 'Subscription Package successfully added', NULL, '2016-01-27 14:53:05'),
(20, 1, 'Subscription Package successfully added', NULL, '2016-01-27 15:58:17'),
(21, 1, 'Rent a property successfully added', NULL, '2016-01-27 16:26:50'),
(22, 1, 'Rent a property successfully Updated', NULL, '2016-01-27 16:27:09'),
(23, 1, 'Rent a property successfully Updated', NULL, '2016-01-27 16:28:10'),
(24, 1, 'Rent a property successfully Updated', NULL, '2016-01-27 16:28:22'),
(25, 1, 'Package Deleted', NULL, '2016-01-27 16:28:41'),
(26, 1, 'Appointment Added', NULL, '2016-01-28 10:41:12'),
(27, 4, 'Appointment Added', NULL, '2016-01-28 14:19:37'),
(28, 4, 'Appointment Added', NULL, '2016-01-28 14:21:50'),
(29, 4, 'Appointment Added', NULL, '2016-01-28 14:24:08'),
(30, 4, 'Appointment Added', NULL, '2016-01-28 14:25:09'),
(31, 1, 'Appointment Added', NULL, '2016-01-28 14:42:27'),
(32, 1, 'appointment Updated', NULL, '2016-01-28 14:43:45'),
(33, 1, 'Appointment Added', NULL, '2016-01-28 14:44:38'),
(34, 1, 'Appointment Added', NULL, '2016-01-28 14:45:40'),
(35, 1, 'Appointment Added', NULL, '2016-01-28 14:46:39'),
(36, 1, 'Appointment Added', NULL, '2016-01-28 14:47:58'),
(37, 4, 'Appointment Added', NULL, '2016-01-28 14:58:23'),
(38, 1, 'Property Added', NULL, '2016-01-30 15:07:20'),
(39, 1, 'Projects Added', NULL, '2016-01-30 15:19:04'),
(40, 1, 'Property Added', NULL, '2016-02-01 16:03:12'),
(41, 1, 'Property Added', NULL, '2016-02-01 16:04:32'),
(42, 1, 'Property Added', NULL, '2016-02-01 16:06:43'),
(43, 1, 'Property Added', NULL, '2016-02-01 16:08:51'),
(44, 1, 'Projects Added', NULL, '2016-02-01 19:05:51'),
(45, 1, 'Customer Created', NULL, '2016-02-03 11:12:49'),
(46, 1, 'state Updated', NULL, '2016-02-03 11:18:00'),
(47, 1, 'state Added', NULL, '2016-02-03 11:18:14'),
(48, 1, 'state Added', NULL, '2016-02-03 11:18:32'),
(49, 1, 'Customer Updated', NULL, '2016-02-03 11:25:35'),
(50, 1, 'Customer Updated', NULL, '2016-02-03 11:26:32'),
(51, 1, 'Customer Created', NULL, '2016-02-03 11:33:13'),
(52, 1, 'Customer Deleted', NULL, '2016-02-03 11:33:24'),
(53, 1, 'Customer Updated', NULL, '2016-02-03 11:36:17'),
(54, 1, 'Appointment Added', NULL, '2016-02-03 11:37:02'),
(55, 1, 'Appointment Added', NULL, '2016-02-03 11:38:00'),
(56, 1, 'Appointment Added', NULL, '2016-02-03 11:59:33'),
(57, 1, 'appointment Updated', NULL, '2016-02-03 12:09:38'),
(58, 1, 'appointment Deleted', NULL, '2016-02-03 12:21:22'),
(59, 1, 'appointment Deleted', NULL, '2016-02-03 12:21:22'),
(60, 1, 'Package Added', NULL, '2016-02-03 12:24:21'),
(61, 1, 'package Updated', NULL, '2016-02-03 12:24:40'),
(62, 1, 'Package Deleted', NULL, '2016-02-03 12:25:22'),
(63, 1, 'Package Added', NULL, '2016-02-03 12:25:34'),
(64, 1, 'Package Deleted', NULL, '2016-02-03 12:25:45'),
(65, 1, 'Page Added', '{"title":"Test Page ","content":"<p><span [removed] 0, 0); font-family:arial,helvetica,sans; font-size:11px\\">\\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\\"<\\/span><\\/p>\\r\\n","show_on_menu":"1","meta_keywords":"testpage","meta_description":"testpage","created_on":"2016-02-03 08:20:12","unique_alias":"testpage"}', '2016-02-03 12:50:12'),
(66, 1, 'Page Updated', '{"title":"Test Page Edit","content":"<p><span [removed] 0, 0); font-family:arial,helvetica,sans; font-size:11px\\">\\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\\"<\\/span><\\/p>\\r\\n","show_on_menu":null,"meta_keywords":"testpageEdit","meta_description":"testpageedit","unique_alias":"testpageedit"}', '2016-02-03 12:51:53'),
(67, 1, 'Page Updated', '{"title":"Test Page Edit","content":"<p>\\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\\"<\\/p>\\r\\n","show_on_menu":"1","meta_keywords":"testpageEdit","meta_description":"testpageedit","unique_alias":"testpageedit"}', '2016-02-03 12:52:03'),
(68, 1, 'Page Added', '{"title":"Test Page ","content":"<p><span [removed] 0, 0); font-family:arial,helvetica,sans; font-size:11px\\">\\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\\"<\\/span><\\/p>\\r\\n","show_on_menu":null,"meta_keywords":"","meta_description":"","created_on":"2016-02-03 08:23:26","unique_alias":"testpage"}', '2016-02-03 12:53:26'),
(69, 1, 'state Deleted', NULL, '2016-02-03 15:05:52'),
(70, 1, 'city Added', NULL, '2016-02-03 15:14:46'),
(71, 1, 'city Added', NULL, '2016-02-03 15:15:03'),
(72, 1, 'city Added', NULL, '2016-02-03 15:15:13'),
(73, 1, 'city Added', NULL, '2016-02-03 15:15:38'),
(74, 1, 'city Added', NULL, '2016-02-03 15:15:48'),
(75, 1, 'city Deleted', NULL, '2016-02-03 15:17:16'),
(76, 1, 'area Deleted', NULL, '2016-02-03 15:18:11'),
(77, 1, 'area Added', NULL, '2016-02-03 15:18:25'),
(78, 1, 'area Added', NULL, '2016-02-03 15:18:33'),
(79, 1, 'area Added', NULL, '2016-02-03 15:18:43'),
(80, 1, 'area Added', NULL, '2016-02-03 15:18:54'),
(81, 1, 'area Added', NULL, '2016-02-03 15:19:05'),
(82, 1, 'area Added', NULL, '2016-02-03 15:22:08'),
(83, 1, 'area Added', NULL, '2016-02-03 15:22:47'),
(84, 1, 'area Added', NULL, '2016-02-03 15:23:23'),
(85, 1, 'area Added', NULL, '2016-02-03 15:23:56'),
(86, 1, 'area Added', NULL, '2016-02-03 15:24:16'),
(87, 1, 'area Added', NULL, '2016-02-03 15:24:24'),
(88, 1, 'area Added', NULL, '2016-02-03 15:24:34'),
(89, 1, 'area Added', NULL, '2016-02-03 15:24:50'),
(90, 1, 'testimonial Deleted', NULL, '2016-02-03 15:50:16'),
(91, 1, 'categories Added', NULL, '2016-02-03 16:17:47'),
(92, 1, 'categories Added', NULL, '2016-02-03 16:17:58'),
(93, 1, 'categories Added', NULL, '2016-02-03 16:18:13'),
(94, 1, 'categories Updated', NULL, '2016-02-03 16:18:41'),
(95, 1, 'categories Deleted', NULL, '2016-02-03 16:19:25'),
(96, 1, 'categories Updated', NULL, '2016-02-03 16:37:49'),
(97, 1, 'categories Deleted', NULL, '2016-02-03 17:11:23'),
(98, 1, 'Amenities Added', NULL, '2016-02-03 17:15:12'),
(99, 1, 'amenities Updated', NULL, '2016-02-03 17:15:36'),
(100, 1, 'amenities Updated', NULL, '2016-02-03 17:15:53'),
(101, 1, 'amenities Deleted', NULL, '2016-02-03 17:17:00'),
(102, 1, 'Groups Added', NULL, '2016-02-03 17:19:47'),
(103, 1, 'attributes Added', NULL, '2016-02-03 17:20:26'),
(104, 1, 'attributes Updated', NULL, '2016-02-03 17:20:35'),
(105, 1, 'attributes Updated', NULL, '2016-02-03 17:20:57'),
(106, 1, 'Groups Deleted', NULL, '2016-02-03 17:21:20'),
(107, 1, 'attributes Deleted', NULL, '2016-02-03 17:21:35'),
(108, 1, 'Groups Added', NULL, '2016-02-03 17:23:35'),
(109, 1, 'groups Updated', NULL, '2016-02-03 17:23:41'),
(110, 1, 'groups Updated', NULL, '2016-02-03 17:24:14'),
(111, 1, 'attributes Added', NULL, '2016-02-03 17:24:28'),
(112, 1, 'Property Added', NULL, '2016-02-03 18:46:20'),
(113, 1, 'Transaction Added', NULL, '2016-02-04 10:37:48'),
(114, 1, 'Transaction Added', NULL, '2016-02-04 10:41:20'),
(115, 1, 'Transaction Updated', NULL, '2016-02-04 10:41:48'),
(116, 1, 'transaction Deleted', NULL, '2016-02-04 10:45:19'),
(117, 1, 'User Created', NULL, '2016-02-04 11:10:25'),
(118, 1, 'User Created', NULL, '2016-02-04 11:11:12'),
(119, 1, 'Projects Added', NULL, '2016-02-04 12:23:04'),
(120, 1, 'area Updated', NULL, '2016-02-04 13:59:02'),
(121, 1, 'package_category Added', NULL, '2016-02-04 14:30:48'),
(122, 1, 'package_category Updated', NULL, '2016-02-04 14:33:09'),
(123, 1, 'Package Added', NULL, '2016-02-04 14:44:07'),
(124, 1, 'package Updated', NULL, '2016-02-04 14:44:54'),
(125, 1, 'package_category Added', NULL, '2016-02-04 14:47:33'),
(126, 1, 'package_category Added', NULL, '2016-02-04 14:50:12'),
(127, 1, 'package_category Added', NULL, '2016-02-04 14:50:30'),
(128, 1, 'package_category Added', NULL, '2016-02-04 14:50:46'),
(129, 1, 'Bid_time_table Added', NULL, '2016-02-04 16:10:05'),
(130, 1, 'area Deleted', NULL, '2016-02-04 16:17:00'),
(131, 1, 'area Deleted', NULL, '2016-02-04 16:17:08'),
(132, 1, 'area Deleted', NULL, '2016-02-04 16:17:40'),
(133, 1, 'area Deleted', NULL, '2016-02-04 16:17:49'),
(134, 1, 'bid_table Deleted', NULL, '2016-02-04 16:18:24'),
(135, 1, 'Property Added', NULL, '2016-02-04 16:45:15'),
(136, 1, 'Property Added', NULL, '2016-02-04 16:48:28'),
(137, 1, 'Property Added', NULL, '2016-02-04 17:41:03'),
(138, 1, 'Property Added', NULL, '2016-02-04 17:42:38'),
(139, 1, 'Property Added', NULL, '2016-02-04 17:43:54'),
(140, 1, 'Property Added', NULL, '2016-02-04 17:51:55'),
(141, 1, 'Property Added', NULL, '2016-02-04 17:52:27'),
(142, 1, 'Property Added', NULL, '2016-02-04 17:55:44'),
(143, 1, 'Property Deleted', NULL, '2016-02-04 17:56:10'),
(144, 1, 'Property Deleted', NULL, '2016-02-04 17:56:10'),
(145, 1, 'Property Deleted', NULL, '2016-02-04 17:56:10'),
(146, 1, 'Property Deleted', NULL, '2016-02-04 17:56:10'),
(147, 1, 'Property Deleted', NULL, '2016-02-04 17:56:10'),
(148, 1, 'Property Deleted', NULL, '2016-02-04 17:56:10'),
(149, 1, 'Property Deleted', NULL, '2016-02-04 17:56:10'),
(150, 1, 'Property Deleted', NULL, '2016-02-04 17:56:10'),
(151, 1, 'Property Deleted', NULL, '2016-02-04 17:56:10'),
(152, 1, 'Property Deleted', NULL, '2016-02-04 17:56:10'),
(153, 1, 'Property Deleted', NULL, '2016-02-04 17:56:25'),
(154, 1, 'Property Deleted', NULL, '2016-02-04 17:56:25'),
(155, 1, 'Property Deleted', NULL, '2016-02-04 17:56:25'),
(156, 1, 'Property Deleted', NULL, '2016-02-04 17:56:25'),
(157, 1, 'Property Deleted', NULL, '2016-02-04 17:56:25'),
(158, 1, 'Property Deleted', NULL, '2016-02-04 17:56:25'),
(159, 1, 'Property Deleted', NULL, '2016-02-04 17:56:25'),
(160, 1, 'Property Deleted', NULL, '2016-02-04 17:56:25'),
(161, 1, 'Property Added', NULL, '2016-02-04 18:01:00'),
(162, 1, 'Property Added', NULL, '2016-02-04 18:03:00'),
(163, 1, 'Property Added', NULL, '2016-02-04 18:49:40'),
(164, 1, 'categories Deleted', NULL, '2016-02-05 19:44:03'),
(165, 1, 'categories Deleted', NULL, '2016-02-05 19:44:03'),
(166, 1, 'categories Deleted', NULL, '2016-02-05 19:44:03'),
(167, 1, 'categories Added', NULL, '2016-02-05 19:44:13'),
(168, 1, 'categories Added', NULL, '2016-02-05 19:44:23'),
(169, 1, 'Bid_time_table Added', NULL, '2016-02-06 19:06:54'),
(170, 1, 'Subscription Package successfully added', NULL, '2016-02-06 19:14:43'),
(171, 1, 'Property Added', NULL, '2016-02-07 12:38:31'),
(172, 1, 'Appointment Added', NULL, '2016-02-08 10:46:50'),
(173, 1, 'Bid_time_table Added', NULL, '2016-02-10 12:19:22'),
(174, 1, 'Bid_time_table Added', NULL, '2016-02-10 12:27:09'),
(175, 1, 'Bid_time_table Added', NULL, '2016-02-10 12:28:20'),
(176, 1, 'Page Updated', '{"title":"privacy policy","content":"<div class=\\"jqDnR\\" id=\\"idTextPanel\\">\\r\\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p>\\r\\n\\r\\n<div class=\\"jqDnR\\" id=\\"idTextPanel\\">\\r\\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget,<\\/p>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n","show_on_menu":"1","meta_keywords":"In ea pariatur. Fugiat voluptas officia ut dolores aut voluptatem quisquam quaerat nostrum odit.","meta_description":"Quo dolores laborum. Veritatis incidunt, deserunt dolores excepteur consequatur? Blanditiis lorem eius rerum voluptates omnis aut iste exercitationem eu.","unique_alias":"privacy-policy"}', '2016-02-10 17:13:45'),
(177, 1, 'Page Updated', '{"title":"credit","content":"<p>The Labhchar, established in 2016, is one of Vadodara\\u2019s leading property portal. In a short span of years, Labhchar has successfully developed a sprawling area of 1,25,000 sq.ft. In Vadodara.<\\/p>\\r\\n","show_on_menu":"1","meta_keywords":"The Labhchar, established in 2016, is one of Vadodara\\u2019s leading property portal. In a short span of years, Labhchar has successfully developed a sprawling area of 1,25,000 sq.ft. In Vadodara.","meta_description":"The Labhchar, established in 2016, is one of Vadodara\\u2019s leading property portal. In a short span of years, Labhchar has successfully developed a sprawling area of 1,25,000 sq.ft. In Vadodara.","unique_alias":"credit"}', '2016-02-10 18:08:37'),
(178, 1, 'Page Updated', '{"title":"terms of use","content":"<p>If you wish to book a Technician\\/Private Repair Professional via our website <a href=\\"http:\\/\\/www.mrright.in\\/\\">www.labhchar.in<\\/a>, or mobile app, or by calling in at 18002003818, you must agree to the terms below as the exclusive basis which governs such booking and must click \\u201c <em>I agree to labhchar terms and conditions<\\/em>\\u201d box on the main registration and booking contacts information page. If you do not agree to any of the terms, do not book a Private Repair Professional\\/Technician via this website. If you are booking on behalf of someone else, by clicking <em>\\"I agree to Mr. Right\\u2019s Terms & Conditions<\\/em>\\", you are representing that you have their authorization to accept these terms and conditions on their behalf.<\\/p>\\r\\n\\r\\n<p><strong><u>READ THESE USER TERMS CAREFULLY BEFORE USING OUR WEBSITE<\\/u><\\/strong><\\/p>\\r\\n\\r\\n<p><strong>1. <\\/strong> <strong>General T&C<\\/strong><\\/p>\\r\\n\\r\\n<p><strong>Definitions<\\/strong><\\/p>\\r\\n\\r\\n<p>\\u00a0<\\/p>\\r\\n\\r\\n<ul>\\r\\n <li><strong>You \\u2013 <\\/strong> acting as a customer, registering a new booking\\/case with the company.<\\/li>\\r\\n <li><strong>Company \\u2013 <\\/strong> The Company hereby referred to as Mr. Right Services Private Limited.<strong> <\\/strong><\\/li>\\r\\n <li><strong>Booking\\/Case \\u2013<\\/strong> effected via the registration with the website for availing \\/ booking of the technician \\/ repair professional for availing the services. Bookings can be made for single services or split\\/multiple repair services.<\\/li>\\r\\n <li><strong>Agreed Time -<\\/strong> The appointed date and time for your services to be provided and as mentioned in the registration form.<\\/li>\\r\\n <li><strong>PRO\\/Service Provider \\u2013 <\\/strong> PRO and<strong> <\\/strong>Service Provider are interchangeable terms used for Technicians or Private Repair Professional registered with the Company to offer their services to the end customers.<\\/li>\\r\\n<\\/ul>\\r\\n\\r\\n<p><strong>2. <\\/strong> <strong>Services<\\/strong><\\/p>\\r\\n\\r\\n<p>\\u00a0<\\/p>\\r\\n\\r\\n<p>a) The Company provides technology based services for providing home solutions in Delhi \\/ NCR (National Capital Region) such as repairing \\/ services of home products to you and you agree to obtain the services offered by third party technicians \\/ Service Providers \\/ Private Repair Professionals (\\"the Service Provider\\"). All the Services provided by the Company to you by means of your use of the registration on website of the Company are hereinafter referred to as the \\"Service.\\"<\\/p>\\r\\n\\r\\n<p>b) The entire Booking request as may be directed by the customer shall be forward to the concerned repair professional\\/service provider by the Company. The Service Provider shall be provided on availability basis and the same shall be communicated to the customer through the company internal mechanism procedure, however, it is clarified that on availability of the Service Provider, the communication details of Service Provider & Customer shall be shared between both of them by the Company for the ease of both the parties to perform or exercise their rights & obligations.<\\/p>\\r\\n\\r\\n<p>c) In case, the Service Provider accepts the booking request made by you with the Company, your information is sent to the Service provider including your name, contact number etc.<\\/p>\\r\\n\\r\\n<p>d) Company shall endeavor reasonable efforts to bring you in contact with the Service Provider in order to render the required service subject to availability of the Service Provider in or around your location at the time of your booking request made to the Company.<\\/p>\\r\\n\\r\\n<p>e) It is pertinent to mention here that, the Company itself does not own \\/ regulate the Service providers and neither there exist any employer \\/ employee relation between them. It is the Service Provider who shall render the required services to you as per the relevant information submitted with the company while registering with the company. The provision of the services to be rendered by the Service Provider to you is therefore subject to the agreement (to be) entered into between you and the Service Provider and the Company shall never be a party to such agreement, in any manner whatsoever. Acceptance of booking request by the Company and the Service Provider does not reach your service location or decide not to render services, in that case \\/ event the Company shall not be held liable to you in any manner whatsoever and neither the Customer is under obligation to make any payment in lieu thereof.<\\/p>\\r\\n\\r\\n<p>f) You hereby certify and confirm that the relevant information you provide to the Company while registering your request or creation of account is accurate and complete in all respect as may be demanded by the Company in the application form. The Company is entitled to an all-time verify the information that you have provided. The Company shall not be liable if you do not visit the appropriate web portal or dial-in the correct call center number. The Company reserves the right to discontinue or introduce any of the modes of booking Service Provider.<\\/p>\\r\\n\\r\\n<p>g) You will treat Service provider introduced to you through us with respect and not to cause damage to them or engage in any unlawful, threatening, harassing, abusive behavior or activity whilst using their service;<\\/p>\\r\\n\\r\\n<p>h) Before handing over the products to be repaired the customer shall be cautious and ensure themselves about the credibility of the Service Provider and any defect in Service or theft\\/ damage to the asset; spare parts; accessories; products shall not be compensated by the Company in any manner whatsoever and it is clarified that that Company shall not be liable in any manner whatsoever, if any such harm\\/damage\\/ loss is caused to the Service Provider due to any such transfer or products to the Service provider for Service.<\\/p>\\r\\n\\r\\n<p>i) You should confirm & clarify from the service provider about the time involved and the spare parts required to render the service including the total\\/aggregate service charges involved therein except the minimum cost before initiation of the Service. In case the same is not discussed, it is implied that the customer is aware of the service charges and has consented to avail the services as may be informed or directed by the service provider.<\\/p>\\r\\n\\r\\n<p>j) You will compensate and defend the company fully against any claims or legal proceedings brought against us by any other person as a result of your breach of these Terms.<\\/p>\\r\\n\\r\\n<p>k) Please note that we are not responsible for the behavior, actions or inactions, accuracy, efficiency of Service Provider, quality of Service which you may use (through us or otherwise). Any Contract for the provision of services is exclusively between you and the Service provider and not us in any manner whatsoever and we simply provide a platform to introduce Service provider and Customer seeking the said service.<\\/p>\\r\\n\\r\\n<p><strong>3. <\\/strong> <strong>Charges and Payment<\\/strong><\\/p>\\r\\n\\r\\n<p>You will make payment in full to Service provider introduced to you through us for any services provided by such Service provider to you. You shall be required to pay the minimum charges & Repair charges along with the spare parts costs, if any installed or replaced \\/ substituted in the products, to the Service Provider and the minimum service charges rates can be found on the Website of the Company. The Service charges shall be updated or amended from time to time and it shall be your responsibility to remain informed about the prevailing minimum charges for the services. And you should confirm the same from the Service provider about the service charge for the repair of the products before initiation of the Service. You agree that you will pay for all services you avail from the Service Provider either by way of cash, cheque, online payment, or any other payment method introduced by the company. Any payment made is non-refundable. After the completion of the Service, we will facilitate for you to receive a copy of the acknowledgement from the Service Provider on your registered e-mail account with the Company.<\\/p>\\r\\n\\r\\n<p>\\u00a0<\\/p>\\r\\n\\r\\n<p><strong>4. <\\/strong> <strong>Indemnification<\\/strong><\\/p>\\r\\n\\r\\n<p>By accepting these User Terms, you agree that you shall defend, indemnify and hold the Company, its affiliates, its licensors, and each of their officers, directors, other users, employees, attorneys and agents harmless from and against any and all claims, costs, damages, losses, liabilities and expenses (including attorneys&#39; fees and costs) arising out of or in connection with: (a) your violation or breach of any term of these User Terms or any applicable law or regulation, whether or not referenced herein; (b) your violation of any rights of any third party, including Service Providers arranged via the Application, or (c) your use or misuse of the Website.<\\/p>\\r\\n\\r\\n<p><strong>5. <\\/strong> <strong>Liability<\\/strong><\\/p>\\r\\n\\r\\n<p>1. The information, recommendations provided to you on or through the Website is for general information purposes only and does not constitute any advice. The Company will reasonably keep the Website and its contents correct and up to date but does not guarantee that (the contents of) the Website are free of errors, defects, malware and viruses or that the Website are correct, up to date and accurate in all means.<\\/p>\\r\\n\\r\\n<p>2. The Company shall further not be liable for damages resulting from the use of (or the inability to use) electronic means of communication with the Website, including \\u2013 but not limited to \\u2013 damages resulting from failure or delay in delivery of electronic communications, interception or manipulation of electronic communications by third parties or by computer programs used for electronic communications and transmission of viruses.<\\/p>\\r\\n\\r\\n<p>3. Without prejudice to the foregoing, and insofar as allowed under mandatory applicable law, the Company&#39;s aggregate liability shall in no event exceed an amount of INR 1000.<\\/p>\\r\\n\\r\\n<p>4. The quality of the services requested through the use of the Application or the Service is entirely the responsibility of the Service Provider who ultimately provides such services to you. The Company under no circumstance accepts liability in connection with and\\/or arising from the services provided by the Service Provider or any acts, action, behavior, conduct, and\\/or negligence on the part of the Service Provider. Any complaints about the services provided by the Service Provider should therefore be submitted to the Service Provider.<\\/p>\\r\\n\\r\\n<p><strong>6. <\\/strong> <strong>INTELLECTUAL PROPERTY RIGHTS (Trademarks and Copyrights)<\\/strong><\\/p>\\r\\n\\r\\n<p>1. The Company is the sole owner of all the rights to the web site or any other digital media and its contents mentioned on the website. The content means its design, layout, text, images, graphics, sounds, video, etc. the website or any other digital media content embody trade secrets and intellectual property rights protected under applicable laws. All titles, ownership and intellectual property rights in the website and its content shall remain with the Company, its affiliates, agents, authorized representatives as the case may be.<\\/p>\\r\\n\\r\\n<p>2. All rights not otherwise claimed under this Terms and Conditions or by the Company are hereby reserved. The information contained in this web site is intended, solely to provide general information for the personal use of the reader, who accepts full responsibility for its use.<\\/p>\\r\\n\\r\\n<p>3. All related icons and logos are trademarks or service marks or word marks of the Company in various jurisdictions and are protected under applicable copyrights, trademarks and other proprietary rights laws. The unauthorized copying, modification, use or publication of these marks is strictly prohibited.<\\/p>\\r\\n\\r\\n<p><strong>7. <\\/strong> <strong>Modification of the Service and User Terms<\\/strong><\\/p>\\r\\n\\r\\n<p>The Company reserves the right, at its sole discretion, to modify or replace any of these User Terms, or change, suspend, or discontinue the Application (including without limitation, the availability of any feature, database, or content) at any time by posting a notice on the Website or by sending you notice through the Service, Application or via email. The Company may also impose limits on certain features and services or restrict your access to parts or all of the Service without notice or liability.<\\/p>\\r\\n\\r\\n<p><strong>8. <\\/strong> <strong>Notice<\\/strong><\\/p>\\r\\n\\r\\n<p>The Company may give notice by means of a general notice on the Service or Application, or by electronic mail to your email address on record in the Company&#39;s account information, or by written communication sent by regular mail to your address on record in Company&#39;s account information.<\\/p>\\r\\n\\r\\n<p><strong>9. <\\/strong> <strong>Privacy and Cookie Notice<\\/strong><\\/p>\\r\\n\\r\\n<p>The Company collects and processes the personal data of the visitors\\/ registered customers of the Website and the promotional offers may be send by the Company on time to time basis unless the same is denied by them by informing to the Company.<\\/p>\\r\\n\\r\\n<p><strong>10. <\\/strong> <strong>Excusable Delays (Force Majeure)<\\/strong><\\/p>\\r\\n\\r\\n<p>Neither party hereto shall be responsible for delays or failures in performance resulting from acts beyond its reasonable control and without its fault or negligence. Such excusable delays or failures may be caused by, among other things, strikes, lock-out, riots, rebellions, accidental explosions, floods, storms, acts of God and similar occurrences.<\\/p>\\r\\n\\r\\n<p><strong>11. <\\/strong> <strong>Miscellaneous<\\/strong><\\/p>\\r\\n\\r\\n<p>1. In the event of any dispute or difference between the Parties in respect of this Agreement, the construction of any provision of this Agreement or the rights, duties or liabilities of the Parties hereto under this Agreement, the same shall be referred to arbitration by a sole arbitrator to be appointed by the Company and the arbitration shall be conducted in accordance with the provisions of Arbitration and Conciliation Act, 1996. The venue of arbitration shall be at NOIDA. The arbitration proceedings shall be conducted in English. Any award made in such arbitration will be final and binding on the parties. The arbitrator shall have the authority to order specific performance of this agreement. Subject to the foregoing, the Courts at NOIDA, Uttar Pradesh only shall have exclusive jurisdiction.<\\/p>\\r\\n\\r\\n<p>2. The Courts of Delhi shall have the sole and exclusive jurisdiction in respect of any matters arising from the use of the services offered by the Company or the agreement or arrangement between the Service provider and the Customer. All claims and disputes arising under this Terms and Conditions should be notified to the Service Provider or Company within 30 days from the service date after which no claim shall be entertained.<\\/p>\\r\\n","show_on_menu":null,"meta_keywords":"Excepturi vel rem omnis rerum ut qui vel libero labore cupiditate ut ex iste non enim cupidatat cupiditate.","meta_description":"Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.","unique_alias":"terms-of-use"}', '2016-02-10 18:09:34'),
(179, 1, 'Page Updated', '{"title":"terms of conditions","content":"<p>If you wish to book a Technician\\/Private Repair Professional via our website <a href=\\"http:\\/\\/www.mrright.in\\/\\">www.labhchar.in<\\/a>, or mobile app, or by calling in at 18002003818, you must agree to the terms below as the exclusive basis which governs such booking and must click \\u201c <em>I agree to labhchar terms and conditions<\\/em>\\u201d box on the main registration and booking contacts information page. If you do not agree to any of the terms, do not book a Private Repair Professional\\/Technician via this website. If you are booking on behalf of someone else, by clicking <em>\\"I agree to Mr. Right\\u2019s Terms & Conditions<\\/em>\\", you are representing that you have their authorization to accept these terms and conditions on their behalf.<\\/p>\\r\\n\\r\\n<p><strong><u>READ THESE USER TERMS CAREFULLY BEFORE USING OUR WEBSITE<\\/u><\\/strong><\\/p>\\r\\n\\r\\n<p><strong>1. <\\/strong> <strong>General T&C<\\/strong><\\/p>\\r\\n\\r\\n<p><strong>Definitions<\\/strong><\\/p>\\r\\n\\r\\n<p>\\u00a0<\\/p>\\r\\n\\r\\n<ul>\\r\\n <li><strong>You \\u2013 <\\/strong> acting as a customer, registering a new booking\\/case with the company.<\\/li>\\r\\n <li><strong>Company \\u2013 <\\/strong> The Company hereby referred to as Mr. Right Services Private Limited.<strong> <\\/strong><\\/li>\\r\\n <li><strong>Booking\\/Case \\u2013<\\/strong> effected via the registration with the website for availing \\/ booking of the technician \\/ repair professional for availing the services. Bookings can be made for single services or split\\/multiple repair services.<\\/li>\\r\\n <li><strong>Agreed Time -<\\/strong> The appointed date and time for your services to be provided and as mentioned in the registration form.<\\/li>\\r\\n <li><strong>PRO\\/Service Provider \\u2013 <\\/strong> PRO and<strong> <\\/strong>Service Provider are interchangeable terms used for Technicians or Private Repair Professional registered with the Company to offer their services to the end customers.<\\/li>\\r\\n<\\/ul>\\r\\n\\r\\n<p><strong>2. <\\/strong> <strong>Services<\\/strong><\\/p>\\r\\n\\r\\n<p>\\u00a0<\\/p>\\r\\n\\r\\n<p>a) The Company provides technology based services for providing home solutions in Delhi \\/ NCR (National Capital Region) such as repairing \\/ services of home products to you and you agree to obtain the services offered by third party technicians \\/ Service Providers \\/ Private Repair Professionals (\\"the Service Provider\\"). All the Services provided by the Company to you by means of your use of the registration on website of the Company are hereinafter referred to as the \\"Service.\\"<\\/p>\\r\\n\\r\\n<p>b) The entire Booking request as may be directed by the customer shall be forward to the concerned repair professional\\/service provider by the Company. The Service Provider shall be provided on availability basis and the same shall be communicated to the customer through the company internal mechanism procedure, however, it is clarified that on availability of the Service Provider, the communication details of Service Provider & Customer shall be shared between both of them by the Company for the ease of both the parties to perform or exercise their rights & obligations.<\\/p>\\r\\n\\r\\n<p>c) In case, the Service Provider accepts the booking request made by you with the Company, your information is sent to the Service provider including your name, contact number etc.<\\/p>\\r\\n\\r\\n<p>d) Company shall endeavor reasonable efforts to bring you in contact with the Service Provider in order to render the required service subject to availability of the Service Provider in or around your location at the time of your booking request made to the Company.<\\/p>\\r\\n\\r\\n<p>e) It is pertinent to mention here that, the Company itself does not own \\/ regulate the Service providers and neither there exist any employer \\/ employee relation between them. It is the Service Provider who shall render the required services to you as per the relevant information submitted with the company while registering with the company. The provision of the services to be rendered by the Service Provider to you is therefore subject to the agreement (to be) entered into between you and the Service Provider and the Company shall never be a party to such agreement, in any manner whatsoever. Acceptance of booking request by the Company and the Service Provider does not reach your service location or decide not to render services, in that case \\/ event the Company shall not be held liable to you in any manner whatsoever and neither the Customer is under obligation to make any payment in lieu thereof.<\\/p>\\r\\n\\r\\n<p>f) You hereby certify and confirm that the relevant information you provide to the Company while registering your request or creation of account is accurate and complete in all respect as may be demanded by the Company in the application form. The Company is entitled to an all-time verify the information that you have provided. The Company shall not be liable if you do not visit the appropriate web portal or dial-in the correct call center number. The Company reserves the right to discontinue or introduce any of the modes of booking Service Provider.<\\/p>\\r\\n\\r\\n<p>g) You will treat Service provider introduced to you through us with respect and not to cause damage to them or engage in any unlawful, threatening, harassing, abusive behavior or activity whilst using their service;<\\/p>\\r\\n\\r\\n<p>h) Before handing over the products to be repaired the customer shall be cautious and ensure themselves about the credibility of the Service Provider and any defect in Service or theft\\/ damage to the asset; spare parts; accessories; products shall not be compensated by the Company in any manner whatsoever and it is clarified that that Company shall not be liable in any manner whatsoever, if any such harm\\/damage\\/ loss is caused to the Service Provider due to any such transfer or products to the Service provider for Service.<\\/p>\\r\\n\\r\\n<p>i) You should confirm & clarify from the service provider about the time involved and the spare parts required to render the service including the total\\/aggregate service charges involved therein except the minimum cost before initiation of the Service. In case the same is not discussed, it is implied that the customer is aware of the service charges and has consented to avail the services as may be informed or directed by the service provider.<\\/p>\\r\\n\\r\\n<p>j) You will compensate and defend the company fully against any claims or legal proceedings brought against us by any other person as a result of your breach of these Terms.<\\/p>\\r\\n\\r\\n<p>k) Please note that we are not responsible for the behavior, actions or inactions, accuracy, efficiency of Service Provider, quality of Service which you may use (through us or otherwise). Any Contract for the provision of services is exclusively between you and the Service provider and not us in any manner whatsoever and we simply provide a platform to introduce Service provider and Customer seeking the said service.<\\/p>\\r\\n\\r\\n<p><strong>3. <\\/strong> <strong>Charges and Payment<\\/strong><\\/p>\\r\\n\\r\\n<p>You will make payment in full to Service provider introduced to you through us for any services provided by such Service provider to you. You shall be required to pay the minimum charges & Repair charges along with the spare parts costs, if any installed or replaced \\/ substituted in the products, to the Service Provider and the minimum service charges rates can be found on the Website of the Company. The Service charges shall be updated or amended from time to time and it shall be your responsibility to remain informed about the prevailing minimum charges for the services. And you should confirm the same from the Service provider about the service charge for the repair of the products before initiation of the Service. You agree that you will pay for all services you avail from the Service Provider either by way of cash, cheque, online payment, or any other payment method introduced by the company. Any payment made is non-refundable. After the completion of the Service, we will facilitate for you to receive a copy of the acknowledgement from the Service Provider on your registered e-mail account with the Company.<\\/p>\\r\\n\\r\\n<p>\\u00a0<\\/p>\\r\\n\\r\\n<p><strong>4. <\\/strong> <strong>Indemnification<\\/strong><\\/p>\\r\\n\\r\\n<p>By accepting these User Terms, you agree that you shall defend, indemnify and hold the Company, its affiliates, its licensors, and each of their officers, directors, other users, employees, attorneys and agents harmless from and against any and all claims, costs, damages, losses, liabilities and expenses (including attorneys&#39; fees and costs) arising out of or in connection with: (a) your violation or breach of any term of these User Terms or any applicable law or regulation, whether or not referenced herein; (b) your violation of any rights of any third party, including Service Providers arranged via the Application, or (c) your use or misuse of the Website.<\\/p>\\r\\n\\r\\n<p><strong>5. <\\/strong> <strong>Liability<\\/strong><\\/p>\\r\\n\\r\\n<p>1. The information, recommendations provided to you on or through the Website is for general information purposes only and does not constitute any advice. The Company will reasonably keep the Website and its contents correct and up to date but does not guarantee that (the contents of) the Website are free of errors, defects, malware and viruses or that the Website are correct, up to date and accurate in all means.<\\/p>\\r\\n\\r\\n<p>2. The Company shall further not be liable for damages resulting from the use of (or the inability to use) electronic means of communication with the Website, including \\u2013 but not limited to \\u2013 damages resulting from failure or delay in delivery of electronic communications, interception or manipulation of electronic communications by third parties or by computer programs used for electronic communications and transmission of viruses.<\\/p>\\r\\n\\r\\n<p>3. Without prejudice to the foregoing, and insofar as allowed under mandatory applicable law, the Company&#39;s aggregate liability shall in no event exceed an amount of INR 1000.<\\/p>\\r\\n\\r\\n<p>4. The quality of the services requested through the use of the Application or the Service is entirely the responsibility of the Service Provider who ultimately provides such services to you. The Company under no circumstance accepts liability in connection with and\\/or arising from the services provided by the Service Provider or any acts, action, behavior, conduct, and\\/or negligence on the part of the Service Provider. Any complaints about the services provided by the Service Provider should therefore be submitted to the Service Provider.<\\/p>\\r\\n\\r\\n<p><strong>6. <\\/strong> <strong>INTELLECTUAL PROPERTY RIGHTS (Trademarks and Copyrights)<\\/strong><\\/p>\\r\\n\\r\\n<p>1. The Company is the sole owner of all the rights to the web site or any other digital media and its contents mentioned on the website. The content means its design, layout, text, images, graphics, sounds, video, etc. the website or any other digital media content embody trade secrets and intellectual property rights protected under applicable laws. All titles, ownership and intellectual property rights in the website and its content shall remain with the Company, its affiliates, agents, authorized representatives as the case may be.<\\/p>\\r\\n\\r\\n<p>2. All rights not otherwise claimed under this Terms and Conditions or by the Company are hereby reserved. The information contained in this web site is intended, solely to provide general information for the personal use of the reader, who accepts full responsibility for its use.<\\/p>\\r\\n\\r\\n<p>3. All related icons and logos are trademarks or service marks or word marks of the Company in various jurisdictions and are protected under applicable copyrights, trademarks and other proprietary rights laws. The unauthorized copying, modification, use or publication of these marks is strictly prohibited.<\\/p>\\r\\n\\r\\n<p><strong>7. <\\/strong> <strong>Modification of the Service and User Terms<\\/strong><\\/p>\\r\\n\\r\\n<p>The Company reserves the right, at its sole discretion, to modify or replace any of these User Terms, or change, suspend, or discontinue the Application (including without limitation, the availability of any feature, database, or content) at any time by posting a notice on the Website or by sending you notice through the Service, Application or via email. The Company may also impose limits on certain features and services or restrict your access to parts or all of the Service without notice or liability.<\\/p>\\r\\n\\r\\n<p><strong>8. <\\/strong> <strong>Notice<\\/strong><\\/p>\\r\\n\\r\\n<p>The Company may give notice by means of a general notice on the Service or Application, or by electronic mail to your email address on record in the Company&#39;s account information, or by written communication sent by regular mail to your address on record in Company&#39;s account information.<\\/p>\\r\\n\\r\\n<p><strong>9. <\\/strong> <strong>Privacy and Cookie Notice<\\/strong><\\/p>\\r\\n\\r\\n<p>The Company collects and processes the personal data of the visitors\\/ registered customers of the Website and the promotional offers may be send by the Company on time to time basis unless the same is denied by them by informing to the Company.<\\/p>\\r\\n\\r\\n<p><strong>10. <\\/strong> <strong>Excusable Delays (Force Majeure)<\\/strong><\\/p>\\r\\n\\r\\n<p>Neither party hereto shall be responsible for delays or failures in performance resulting from acts beyond its reasonable control and without its fault or negligence. Such excusable delays or failures may be caused by, among other things, strikes, lock-out, riots, rebellions, accidental explosions, floods, storms, acts of God and similar occurrences.<\\/p>\\r\\n\\r\\n<p><strong>11. <\\/strong> <strong>Miscellaneous<\\/strong><\\/p>\\r\\n\\r\\n<p>1. In the event of any dispute or difference between the Parties in respect of this Agreement, the construction of any provision of this Agreement or the rights, duties or liabilities of the Parties hereto under this Agreement, the same shall be referred to arbitration by a sole arbitrator to be appointed by the Company and the arbitration shall be conducted in accordance with the provisions of Arbitration and Conciliation Act, 1996. The venue of arbitration shall be at NOIDA. The arbitration proceedings shall be conducted in English. Any award made in such arbitration will be final and binding on the parties. The arbitrator shall have the authority to order specific performance of this agreement. Subject to the foregoing, the Courts at NOIDA, Uttar Pradesh only shall have exclusive jurisdiction.<\\/p>\\r\\n\\r\\n<p>2. The Courts of Delhi shall have the sole and exclusive jurisdiction in respect of any matters arising from the use of the services offered by the Company or the agreement or arrangement between the Service provider and the Customer. All claims and disputes arising under this Terms and Conditions should be notified to the Service Provider or Company within 30 days from the service date after which no claim shall be entertained.<\\/p>\\r\\n","show_on_menu":null,"meta_keywords":"Excepturi vel rem omnis rerum ut qui vel libero labore cupiditate ut ex iste non enim cupidatat cupiditate.","meta_description":"Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.","unique_alias":"terms-and-conditions"}', '2016-02-10 18:11:25');
INSERT INTO `user_activity` (`activity_id`, `user_id`, `act_key`, `data`, `date_added`) VALUES
(180, 1, 'Page Updated', '{"title":"Terms and Conditions","content":"<p>Terms and Conditions<\\/p>\\r\\n\\r\\n<h3>Information Collected<\\/h3>\\r\\n\\r\\n<div>DEMO collects personally identifying information and data about individuals, their company, and the companies demographics \\u201cpersonally identifying information and data\\u201d including (i) when you provide information to DEMO, such as when you register or sign up for any of our products such as, but not limited to, events, conferences, on-line seminars contests, RSS Feeds, webcasts, and other communications with DEMO; (ii) when you register or sign up on any DEMO site, your information will be known to DEMO; and (iii) from time to time we may add other information that we collect from third party sources to enhance the information that you provided to DEMO.<\\/div>\\r\\n\\r\\n<p>\\u00a0\\r\\n<h2>Notice of New Policy Changes<\\/h2>\\r\\n<\\/p>\\r\\n\\r\\n<div>Below is the current policy regarding the usage of personally identifying information and data collected by DEMO. We reevaluate this policy on an ongoing basis. DEMO reserves the right to change its privacy policy. However, if there are any changes to the use of personally identifying information and data that is different from that stated at the time of collection, we will notify you by posting a notice on our Web site.<\\/div>\\r\\n\\r\\n<p>\\u00a0\\r\\n<h3>Cookies<\\/h3>\\r\\n<\\/p>\\r\\n\\r\\n<div>DEMO, or one of our IDG affiliated companies, or third party partners may place a \\"cookie\\" in the browser files of a user&#39;s computer. The cookie itself does not contain any personally identifying information, except when such information has been supplied by a user.<\\/div>\\r\\n\\r\\n<p>\\u00a0\\r\\n<div>If you have visited our Web site, the information in your \\"cookie\\" is used to provide a more personalized experience on the Web site. This cookie identifies you as a unique user by means of a tracking ID. However, we cannot link that user ID with personal identifying information and data about you such as your name or e-mail address.<\\/div>\\r\\n<\\/p>\\r\\n\\r\\n<p>\\u00a0\\r\\n<div>Browsers or third-party software can allow you to block the use of cookies while you surf our site. Or, you can use third-party \\"anonymizer\\" services to mask information in your cookies, or even general data such as your IP address. In such cases, you would not be able to take advantage of most of the personalization services offered by DEMO.<\\/div>\\r\\n<\\/p>\\r\\n\\r\\n<p>\\u00a0\\r\\n<div>The aggregated information we collect may be used:<\\/div>\\r\\n<\\/p>\\r\\n\\r\\n<p>\\u00a0\\r\\n<div>\\r\\n<ol>\\r\\n <li>\\u00a0 \\u00a0to improve the content and design of the DEMO Web site.<\\/li>\\r\\n <li>\\u00a0 \\u00a0to enable an audit bureau to verify our claims of traffic to the site<\\/li>\\r\\n <li>\\u00a0 \\u00a0to help advertisers, potential advertiser, demonstrators (exhibitors), potential demonstrators, sponsors, potential sponsors, or marketers to assess the suitability of the site for their ad campaigns<\\/li>\\r\\n <li>\\u00a0 \\u00a0we may create and use aggregate customer data to understand more about the interests of our customers and may use the data to offer goods and services we believe may be of interest to our customers, on behalf of DEMO or selection organizations.<\\/li>\\r\\n<\\/ol>\\r\\n<\\/div>\\r\\n<\\/p>\\r\\n","show_on_menu":"1","meta_keywords":"Excepturi vel rem omnis rerum ut qui vel libero labore cupiditate ut ex iste non enim cupidatat cupiditate.","meta_description":"Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.","unique_alias":"terms-and-conditions"}', '2016-02-10 18:12:19'),
(181, 1, 'Page Updated', '{"title":"Privacy Policy","content":"<h2>Privacy<\\/h2>\\r\\n\\r\\n<ol>\\r\\n <li>This Privacy Policy is Demo And Build official online privacy policy and it applies to all personal information collected by Demo And Build. In this policy we explain how and why we collect your personal information, how we use it, and what controls you have over our use of it.<\\/li>\\r\\n <li>Demo And Build is committed to complying with Commonwealth legislation governing privacy of personal information by businesses and to protecting and safeguarding your privacy when you deal with us.<\\/li>\\r\\n<\\/ol>\\r\\n\\r\\n<h3>Collection of information<\\/h3>\\r\\n\\r\\n<ol start=\\"3\\">\\r\\n <li>Some information provided to us by clients, customers, contractors and other third parties might be considered private or personal. Without these details we would not be able to carry on our business and provide our services to you. We will only collect such personal information if it is necessary for one of our functions or activities.<\\/li>\\r\\n <li>In particular, personal information is collected from people in the following situations by Demo And Build:\\r\\n <ul>\\r\\n  <li>If you contact Demo And Build, we may keep a record of that correspondence.<\\/li>\\r\\n  <li>When you submit your e-mail address to our web site mailing list.<\\/li>\\r\\n <\\/ul>\\r\\n <\\/li>\\r\\n <li>At or before the time the personal information is collected by us we will take reasonable steps to ensure that you are made aware of who we are, the fact that you are able to gain access to the information held about you, the purpose of the collection, the type(s) of organisations to which we usually disclose the information collected about you, any laws requiring the collection of the information and the main consequences for you if all or part of the information is not collected.<\\/li>\\r\\n<\\/ol>\\r\\n\\r\\n<h3>Use of information collected and disclosure of personal information to others<\\/h3>\\r\\n\\r\\n<ol start=\\"6\\">\\r\\n <li>We may use or disclose personal information held about an individual for the primary purpose for which it is collected (eg. provision of our services, including administration of our services, notification to you about changes to our services, record-keeping following termination of our services to you and technical maintenance). We may also use such information for a purpose related to the primary purpose of collection and where it would reasonably be expected by you that we would use the information in such a way. This information is only disclosed to persons outside our business in the circumstances set out in this policy or as otherwise notified to you at the time of collection of the information.<\\/li>\\r\\n <li>In addition we are permitted to use or disclose personal information held about you:\\r\\n <ul>\\r\\n  <li>Where you have consented to the use or disclosure;<\\/li>\\r\\n  <li>Where we reasonably believe that the use or disclosure is necessary to lessen or prevent a serious, immediate threat to someone&#39;s health or safety or the public&#39;s health or safety;<\\/li>\\r\\n  <li>Where we reasonably suspect that unlawful activity has been, is being or may be engaged in and the use or disclosure is a necessary part of our investigation or in reporting the matter to the relevant authorities;<\\/li>\\r\\n  <li>Where such use or disclosure is required under or authorised by law (for example, to comply with a subpoena, a warrant or other order of a court or legal process);<\\/li>\\r\\n  <li>Where we reasonably believe that the use or disclosure is reasonably necessary for prevention, investigation, prosecution and punishment of crimes or wrongdoings or the preparation for, conduct of, proceedings before any court or tribunal or the implementation of the orders of a court or tribunal by or on behalf of an enforcement body.<\\/li>\\r\\n <\\/ul>\\r\\n <\\/li>\\r\\n<\\/ol>\\r\\n","show_on_menu":"1","meta_keywords":"In ea pariatur. Fugiat voluptas officia ut dolores aut voluptatem quisquam quaerat nostrum odit.","meta_description":"Quo dolores laborum. Veritatis incidunt, deserunt dolores excepteur consequatur? Blanditiis lorem eius rerum voluptates omnis aut iste exercitationem eu.","unique_alias":"privacy-policy"}', '2016-02-10 18:13:15'),
(182, 1, 'Customer Updated', NULL, '2016-02-10 18:22:01'),
(183, 1, 'bid_table Updated', NULL, '2016-02-10 18:32:19'),
(184, 1, 'bid_table Updated', NULL, '2016-02-10 18:32:52'),
(185, 1, 'bid_table Updated', NULL, '2016-02-10 18:33:43'),
(186, 1, 'bid_table Updated', NULL, '2016-02-10 18:59:22'),
(187, 1, 'bid_table Updated', NULL, '2016-02-10 19:20:43'),
(188, 1, 'bid_table Updated', NULL, '2016-02-10 19:40:00'),
(189, 1, 'bid_table Updated', NULL, '2016-02-10 19:40:12'),
(190, 1, 'bid_table Updated', NULL, '2016-02-10 19:40:38'),
(191, 1, 'bid_table Updated', NULL, '2016-02-10 19:41:02'),
(192, 1, 'bid_table Updated', NULL, '2016-02-10 19:54:51'),
(193, 1, 'bid_table Updated', NULL, '2016-02-11 09:58:58'),
(194, 1, 'bid_table Updated', NULL, '2016-02-11 09:59:18'),
(195, 1, 'bid_table Updated', NULL, '2016-02-11 10:00:13'),
(196, 1, 'bid_table Updated', NULL, '2016-02-11 10:00:37'),
(197, 1, 'bid_table Updated', NULL, '2016-02-11 12:11:18'),
(198, 1, 'bid_table Updated', NULL, '2016-02-11 13:51:34'),
(199, 1, 'Appointment Added', NULL, '2016-02-11 15:10:43'),
(200, 1, 'appointment Updated', NULL, '2016-02-11 15:17:22'),
(201, 1, 'bid_table Updated', NULL, '2016-02-11 16:25:28'),
(202, 1, 'bid_table Updated', NULL, '2016-02-11 16:50:26'),
(203, 1, 'Bid_time_table Added', NULL, '2016-02-11 18:06:17'),
(204, 1, 'bid_table Updated', NULL, '2016-02-11 18:10:17'),
(205, 1, 'bid_table Updated', NULL, '2016-02-11 18:10:43'),
(206, 1, 'bid_table Updated', NULL, '2016-02-11 18:26:29'),
(207, 1, 'bid_table Updated', NULL, '2016-02-11 18:26:54'),
(208, 1, 'bid_table Updated', NULL, '2016-02-11 18:27:15'),
(209, 1, 'bid_table Updated', NULL, '2016-02-11 18:27:23'),
(210, 1, 'bid_table Updated', NULL, '2016-02-11 18:36:35'),
(211, 1, 'bid_table Updated', NULL, '2016-02-11 18:36:47'),
(212, 1, 'bid_table Updated', NULL, '2016-02-11 18:40:15'),
(213, 1, 'bid_table Updated', NULL, '2016-02-11 18:43:17'),
(214, 1, 'appointment Updated', NULL, '2016-02-12 09:46:39'),
(215, 1, 'bid_table Updated', NULL, '2016-02-12 10:00:17'),
(216, 1, 'bid_table Updated', NULL, '2016-02-12 10:01:14'),
(217, 1, 'bid_table Updated', NULL, '2016-02-12 10:03:14'),
(218, 1, 'bid_table Updated', NULL, '2016-02-12 10:05:31'),
(219, 1, 'bid_table Updated', NULL, '2016-02-12 10:16:13'),
(220, 1, 'bid_table Updated', NULL, '2016-02-12 10:17:31'),
(221, 1, 'bid_table Updated', NULL, '2016-02-12 10:20:39'),
(222, 1, 'bid_table Updated', NULL, '2016-02-12 10:28:50'),
(223, 1, 'bid_table Updated', NULL, '2016-02-12 10:30:27'),
(224, 1, 'bid_table Updated', NULL, '2016-02-12 10:54:27'),
(225, 1, 'bid_table Updated', NULL, '2016-02-12 10:54:48'),
(226, 1, 'bid_table Updated', NULL, '2016-02-12 10:57:03'),
(227, 1, 'bid_table Updated', NULL, '2016-02-12 10:57:17'),
(228, 1, 'bid_table Updated', NULL, '2016-02-14 17:58:52'),
(229, 1, 'bid_table Updated', NULL, '2016-02-14 17:59:03'),
(230, 1, 'bid_table Updated', NULL, '2016-02-14 18:03:19'),
(231, 1, 'bid_table Updated', NULL, '2016-02-14 18:03:58'),
(232, 1, 'appointment Updated', NULL, '2016-02-22 13:54:41'),
(233, 1, 'appointment Updated', NULL, '2016-02-22 13:55:16'),
(234, 1, 'appointment Updated', NULL, '2016-02-22 13:55:53'),
(235, 1, 'appointment Updated', NULL, '2016-02-22 13:57:26'),
(236, 1, 'Customer Created', NULL, '2016-02-23 15:59:22'),
(237, 1, 'Appointment Added', NULL, '2016-02-27 16:36:50'),
(238, 1, 'bid_table Updated', NULL, '2016-03-01 14:00:20'),
(239, 1, 'bid_table Updated', NULL, '2016-03-01 14:10:15'),
(240, 1, 'bid_table Updated', NULL, '2016-03-01 14:29:46'),
(241, 1, 'bid_table Updated', NULL, '2016-03-01 14:49:56'),
(242, 1, 'bid_table Updated', NULL, '2016-03-01 15:13:59'),
(243, 1, 'bid_table Updated', NULL, '2016-03-01 16:18:13'),
(244, 1, 'bid_table Updated', NULL, '2016-03-01 16:18:32'),
(245, 1, 'bid_table Updated', NULL, '2016-03-01 16:27:13'),
(246, 1, 'bid_table Updated', NULL, '2016-03-01 16:39:38'),
(247, 1, 'bid_table Updated', NULL, '2016-03-01 17:24:08'),
(248, 1, 'bid_table Updated', NULL, '2016-03-01 17:24:26'),
(249, 1, 'bid_table Updated', NULL, '2016-03-02 10:28:19'),
(250, 1, 'bid_table Updated', NULL, '2016-03-02 11:09:40'),
(251, 1, 'bid_table Updated', NULL, '2016-03-02 11:14:32'),
(252, 1, 'bid_table Updated', NULL, '2016-03-02 11:18:04'),
(253, 1, 'bid_table Updated', NULL, '2016-03-02 11:44:53'),
(254, 1, 'bid_table Updated', NULL, '2016-03-02 11:46:32'),
(255, 1, 'bid_table Updated', NULL, '2016-03-02 12:08:13'),
(256, 1, 'bid_table Updated', NULL, '2016-03-02 12:11:20'),
(257, 1, 'bid_table Updated', NULL, '2016-03-02 12:12:26'),
(258, 1, 'bid_table Updated', NULL, '2016-03-02 15:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `permission` text CHARACTER SET latin1,
  `modify` text CHARACTER SET latin1,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`group_id`, `name`, `permission`, `modify`) VALUES
(1, 'admin', '["Amenities","Appointment","Area","Attributes","Bid_table","Categories","Company","Customer","Groups","Index","Module","Others","Package","Package_category","Page","Payment","Property","Reports","Scheduler","Settings","Testimonial","Transaction","Users","Users_groups"]', '["Amenities","Appointment","Area","Attributes","Bid_table","Categories","Company","Customer","Groups","Index","Module","Others","Package","Package_category","Page","Payment","Property","Reports","Scheduler","Settings","Testimonial","Transaction","Users","Users_groups"]'),
(2, 'agent', '["Appointment","Index","Projects","Property"]', '["Appointment","Index","Projects","Property"]'),
(4, 'New User Group', '["Categories","City","Company","Customer","Groups","Index","Module","Others","Package","Page","Payment","Projects","Property","Reports","Settings","State","Testimonial","Transaction","Users","Users_groups"]', '["Categories","City","Company","Customer","Groups","Index","Module","Others","Package","Page","Payment","Projects","Property","Reports","Settings","State","Testimonial","Transaction","Users","Users_groups"]');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
