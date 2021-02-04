-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 01, 2015 at 08:14 AM
-- Server version: 5.6.23
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mdollar_health_higen`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_addadv_material`
--

CREATE TABLE IF NOT EXISTS `db_addadv_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` varchar(100) NOT NULL,
  `sales_id` varchar(100) NOT NULL,
  `materialtype` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `db_addadv_material`
--

INSERT INTO `db_addadv_material` (`id`, `shop_id`, `sales_id`, `materialtype`, `qty`, `added_date`) VALUES
(1, '1', '6', 'standy', '6', '2015-08-22 08:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `db_adv_material`
--

CREATE TABLE IF NOT EXISTS `db_adv_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `db_adv_material`
--

INSERT INTO `db_adv_material` (`id`, `type`, `image`, `added_date`) VALUES
(0, 'Select Material', '', '2015-08-19 06:52:47'),
(1, ' brocher', 'Desert.jpg', '2015-08-22 03:24:59'),
(2, 'standy', 'Tulips.jpg', '2015-08-22 03:25:38'),
(3, 'gift box', 'Penguins.jpg', '2015-08-22 03:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `db_assignto_salesdept`
--

CREATE TABLE IF NOT EXISTS `db_assignto_salesdept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_typeid` varchar(100) NOT NULL,
  `sales_id` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `sale_price` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `db_assignto_salesdept`
--

INSERT INTO `db_assignto_salesdept` (`id`, `product_typeid`, `sales_id`, `qty`, `sale_price`, `date`, `added_date`) VALUES
(4, '2', '7', '707.88', '50', '2015-08-22', '2015-08-22 09:14:52'),
(8, '1', '1', '587', '100', '2015-08-27', '2015-08-27 07:01:13'),
(9, '2', '1', '707.88', '100', '2015-08-27', '2015-08-27 07:01:33'),
(10, '1', '6', '587', '100', '2015-08-27', '2015-08-27 09:18:36'),
(11, '2', '6', '707.88', '100', '2015-08-27', '2015-08-27 09:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `db_book_new_stock`
--

CREATE TABLE IF NOT EXISTS `db_book_new_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `qty` bigint(20) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `db_book_new_stock`
--

INSERT INTO `db_book_new_stock` (`id`, `product_type_id`, `sales_id`, `qty`, `status`, `date`) VALUES
(1, 1, 1, 5, 'His Stock', '2015-08-26'),
(2, 2, 1, 5, 'Company Stock', '2015-08-26'),
(3, 2, 1, 5, 'His Stock', '2015-08-26'),
(4, 2, 1, 2, 'His Stock', '2015-08-27'),
(5, 1, 2, 2, 'His Stock', '2015-08-27'),
(6, 1, 1, 5, 'company stock', '2015-08-27'),
(7, 2, 1, 5, 'His Stock', '2015-08-27'),
(8, 3, 1, 25, 'His Stock', '2015-08-27'),
(9, 5, 2, 5, 'His Stock', '2015-08-27'),
(10, 1, 1, 25, 'His Stock', '2015-08-27'),
(11, 1, 1, 25, 'His Stock', '2015-08-27'),
(12, 1, 3, 2, 'His Stock', '2015-08-27'),
(13, 1, 3, 25, 'His Stock', '2015-08-27'),
(14, 2, 1, 25, 'His Stock', '2015-08-27'),
(15, 4, 1, 2, 'His Stock', '2015-08-27'),
(16, 2, 1, 3, 'His Stock', '2015-08-27'),
(17, 1, 1, 25, 'company stock', '2015-08-27'),
(18, 1, 1, 2, 'His Stock', '2015-08-28'),
(19, 3, 1, 25, 'company stock', '2015-08-28'),
(20, 1, 1, 100, 'His Stock', '2015-08-31'),
(21, 1, 1, 158, 'company stock', '2015-08-29'),
(22, 1, 1, 22, 'His Stock', '2015-08-30'),
(23, 2, 1, 5, 'company stock', '2015-09-28');

-- --------------------------------------------------------

--
-- Table structure for table `db_neworder_status`
--

CREATE TABLE IF NOT EXISTS `db_neworder_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` varchar(100) NOT NULL,
  `sales_id` varchar(100) NOT NULL,
  `producttype_id` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `db_neworder_status`
--

INSERT INTO `db_neworder_status` (`id`, `shop_id`, `sales_id`, `producttype_id`, `qty`, `date`, `added_date`) VALUES
(1, '1', '6', '3', '7', '2015-8-22', '2015-08-22 08:55:30'),
(2, '1', '1', '4', '7', '2015-8-22', '2015-08-22 12:16:35'),
(3, '1', '1', '2', '6', '2015-8-22', '2015-08-22 12:37:14'),
(4, '2', '1', '4', '8', '2015-8-24', '2015-08-24 10:16:28'),
(5, '3', '1', '0', '9', '2015-8-24', '2015-08-24 10:28:23'),
(6, '5', '1', '4', '6', '2015-8-25', '2015-08-25 04:55:49'),
(7, '5', '1', '0', '7', '2015-8-26', '2015-08-26 07:18:04'),
(8, '8', '1', '3', '6', '2015-8-26', '2015-08-26 07:18:56'),
(9, '5', '1', '2', '6', '2015-8-26', '2015-08-26 07:23:04'),
(10, '7', '1', '1', '2', '2015-8-27', '2015-08-27 11:41:53'),
(11, '7', '1', '2', '5', '2015-8-27', '2015-08-27 11:43:15'),
(12, '4', '1', '1', '2', '2015-8-28', '2015-08-28 06:01:12'),
(13, '', '1', '3', '5', '2015-8-28', '2015-08-28 06:11:15'),
(14, '44', '1', '3', '100', '2015-8-28', '2015-08-28 06:51:20'),
(15, '6', '1', '0', '6', '2015-8-28', '2015-08-28 07:40:58'),
(16, '6', '1', '3', '6', '2015-8-28', '2015-08-28 07:41:54'),
(17, '3', '1', '1', '6', '2015-8-31', '2015-08-31 13:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `db_order`
--

CREATE TABLE IF NOT EXISTS `db_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` varchar(100) NOT NULL,
  `shop_id` varchar(100) NOT NULL,
  `producttype_id` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `replacement` varchar(100) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` varchar(255) NOT NULL,
  `longtitude` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `db_order`
--

INSERT INTO `db_order` (`id`, `sales_id`, `shop_id`, `producttype_id`, `qty`, `price`, `total`, `replacement`, `order_date`, `status`, `added_date`, `latitude`, `longtitude`, `address`) VALUES
(1, '1', '1', '1', '5', '100', '500', '', '2015-08-31', 'done', '2015-08-31 10:57:57', '73.16119833333333', '22.32495833333333', '110, Subhanpura, Vadodara, Gujarat 390003,India'),
(2, '1', '1', '1', '6', '100', '600', '', '2015-08-31', 'done', '2015-08-31 10:58:09', '73.1611983', '22.3249583', '110, Subhanpura, Vadodara, Gujarat 390003,India'),
(3, '1', '3', '1', '8', '100', '800', '', '2015-08-31', 'done', '2015-08-31 13:08:18', '73.16435833333334', '22.32194833333333', '13, Subhanpura, Vadodara, Gujarat 390003,India'),
(4, '1', '3', '2', '7', '100', '700', '', '2015-08-31', 'done', '2015-08-31 13:08:36', '73.16435833333334', '22.32194833333333', '13, Subhanpura, Vadodara, Gujarat 390003,India'),
(5, '1', '3', '2', '6', '100', '600', '', '2015-08-31', 'done', '2015-08-31 13:32:02', '73.16435833333334', '22.32194833333333', '13, Subhanpura, Vadodara, Gujarat 390003,India'),
(6, '1', '3', '1', '6', '100', '600', '', '2015-08-31', '', '2015-08-31 13:32:12', '73.16435833333334', '22.32194833333333', '13, Subhanpura, Vadodara, Gujarat 390003,India');

-- --------------------------------------------------------

--
-- Table structure for table `db_order1`
--

CREATE TABLE IF NOT EXISTS `db_order1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` varchar(100) NOT NULL,
  `shop_id` varchar(100) NOT NULL,
  `producttype_id` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `replacement` varchar(100) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `db_payment_cash`
--

CREATE TABLE IF NOT EXISTS `db_payment_cash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) NOT NULL,
  `producttype_id` varchar(100) NOT NULL,
  `sales_id` varchar(100) NOT NULL,
  `shop_id` varchar(100) NOT NULL,
  `total` varchar(300) NOT NULL,
  `ammount` varchar(100) NOT NULL,
  `rammount` varchar(300) NOT NULL,
  `invoice_img` varchar(300) NOT NULL,
  `date` varchar(100) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `db_payment_cash`
--

INSERT INTO `db_payment_cash` (`id`, `order_id`, `producttype_id`, `sales_id`, `shop_id`, `total`, `ammount`, `rammount`, `invoice_img`, `date`, `added_date`) VALUES
(1, '', '', '6', '1', '7000', '3000', '4000', '1440233568909.jpg', '2015-8-22', '2015-08-22 08:53:05'),
(2, '', '', '6', '1', '8000', '799', '7201', '1440234297928.jpg', '2015-8-22', '2015-08-22 09:05:12'),
(3, '', '', '7', '1', '8600', '6679', '1921', '1440235069549.jpg', '2015-8-22', '2015-08-22 09:18:05'),
(4, '', '', '1', '5', '200', '12', '188', '1440655678695.jpg', '2015-8-27', '2015-08-27 06:08:30'),
(5, '4,5', '', '1', '2', '400', '50', '350', '1440657798714.jpg', '2015-8-27', '2015-08-27 06:43:39'),
(6, '9,10,', '', '1', '6', '1100', '8', '1092', '1440659370659.jpg', '2015-8-27', '2015-08-27 07:09:40'),
(7, '7,15,16', '', '1', '2', '1700', '86', '1614', '1440660512369.jpg', '2015-8-27', '2015-08-27 07:28:49'),
(8, '1', '', '6', '5', '500', '8', '492', '1440667291145.jpg', '2015-8-27', '2015-08-27 09:21:37'),
(9, '1', '', '6', '5', '500', '8', '492', '1440667352502.jpg', '2015-8-27', '2015-08-27 09:22:39'),
(10, '4', '', '6', '4', '700', '80', '620', '1440667630421.jpg', '2015-8-27', '2015-08-27 09:27:15'),
(11, '3', '', '6', '4', '600', '6', '594', '1440667685791.jpg', '2015-8-27', '2015-08-27 09:28:14'),
(12, '5,7,8,6', '', '1', '5', '2400', '6', '2394', '1440676529526.jpg', '2015-8-27', '2015-08-27 11:55:31'),
(13, '12', '', '1', '5', '600', '58', '542', '1440677541165.jpg', '2015-8-27', '2015-08-27 12:12:26'),
(14, '1', '', '1', '5', '500', '69', '431', '1440731792909.jpg', '2015-8-28', '2015-08-28 03:16:35'),
(15, '3', '', '1', '39', '3500', '3000', '500', '1440742494304.jpg', '2015-8-28', '2015-08-28 06:10:20'),
(16, '6', '', '1', '44', '10000', '5000', '5000', '1440744879837.jpg', '2015-8-28', '2015-08-28 06:50:06'),
(17, '9', '', '1', '45', '600', '300', '300', '1440747541442.jpg', '2015-8-28', '2015-08-28 07:39:04'),
(18, '1,2', '', '1', '1', '1100', '100', '1000', '1441018739192.jpg', '2015-8-31', '2015-08-31 10:58:59'),
(19, '3', '', '1', '3', '800', '200', '600', '1441026557336.jpg', '2015-8-31', '2015-08-31 13:09:18'),
(20, '5', '', '1', '3', '600', '80', '520', '1441027961129.jpg', '2015-8-31', '2015-08-31 13:32:43');

-- --------------------------------------------------------

--
-- Table structure for table `db_payment_cheque`
--

CREATE TABLE IF NOT EXISTS `db_payment_cheque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) NOT NULL,
  `producttype_id` varchar(100) NOT NULL,
  `sales_id` varchar(100) NOT NULL,
  `shop_id` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `ammount` varchar(100) NOT NULL,
  `cheque_img` varchar(300) NOT NULL,
  `date` varchar(200) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `db_payment_cheque`
--

INSERT INTO `db_payment_cheque` (`id`, `order_id`, `producttype_id`, `sales_id`, `shop_id`, `total`, `ammount`, `cheque_img`, `date`, `added_date`) VALUES
(1, '', '', '6', '1', '7000', '3000', '1440233621117.jpg', '2015-8-22', '2015-08-22 08:54:04'),
(2, '', '', '6', '1', '8000', '5555', '1440234341663.jpg', '2015-8-22', '2015-08-22 09:05:56'),
(3, '9,11', '', '1', '5', '1200', '45', '1440677498455.jpg', '2015-8-27', '2015-08-27 12:11:50'),
(4, '2', '', '1', '5', '600', '700', '1440731826148.jpg', '2015-8-28', '2015-08-28 03:17:07'),
(5, '4', '', '1', '39', '5600', '600', '1440742551588.jpg', '2015-8-28', '2015-08-28 06:11:21'),
(6, '10', '', '1', '45', '600', '300', '1440747596306.jpg', '2015-8-28', '2015-08-28 07:39:57'),
(7, '4', '', '1', '3', '700', '600', '1441026594201.jpg', '2015-8-31', '2015-08-31 13:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `db_product_type`
--

CREATE TABLE IF NOT EXISTS `db_product_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `db_product_type`
--

INSERT INTO `db_product_type` (`id`, `pname`, `price`, `qty`, `date`, `status`, `added_date`) VALUES
(0, 'Select Product', '', '', '', 0, '2015-08-01 07:06:47'),
(1, 'No More Germs', '200', '45', '2015-08-01', 1, '2015-08-07 11:42:36'),
(2, 'No More Mosquitoes', '200', '45', '2015-08-02', 1, '2015-08-02 06:30:43'),
(3, 'No More Itchy Bites', '500', '25', '2015-08-07', 1, '2015-08-07 11:00:13'),
(4, 'No More Infection', '500', '100', '2015-08-07', 1, '2015-08-07 11:00:47'),
(5, 'No More Stains', '700', '100', '2015-08-07', 1, '2015-08-07 11:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `db_sales_history`
--

CREATE TABLE IF NOT EXISTS `db_sales_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` varchar(100) NOT NULL,
  `logtime` varchar(100) NOT NULL,
  `outtime` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `statusin` varchar(100) NOT NULL,
  `statusout` varchar(100) NOT NULL,
  `transport` varchar(100) NOT NULL,
  `added_date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `db_sales_history`
--

INSERT INTO `db_sales_history` (`id`, `sales_id`, `logtime`, `outtime`, `location`, `statusin`, `statusout`, `transport`, `added_date`) VALUES
(1, '1', '12 am', '2:00 pm', 'baroda', 'in', 'out', 'by bus', '2015-08-27'),
(2, '1', '10:04:50 AM', '10:46:12 AM', '23, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', 'out', 'By Auto', '2015-08-27'),
(3, '1', '10:45:49 AM', '10:46:12 AM', '23, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', 'out', 'By Auto', '2015-08-27'),
(4, '1', '10:47:59 AM', '10:48:09 AM', '23, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', 'out', 'By Bike', '2015-08-27'),
(5, '1', '10:51:43 AM', '17:11:35 PM', '23, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', 'out', 'By Auto', '2015-08-27'),
(6, '1', '03:23:54 AM', '17:11:35 PM', '', 'IN', 'out', 'null', '2015-08-27'),
(7, '1', '15:48:47 PM', '17:11:35 PM', '12, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', 'out', 'null', '2015-08-27'),
(8, '1', '17:06:44 PM', '17:11:35 PM', '', 'IN', 'out', 'By Auto', '2015-08-27'),
(9, '1', '17:11:16 PM', '17:11:35 PM', '', 'IN', 'out', 'null', '2015-08-27'),
(10, '1', '17:12:53 PM', '17:27:37 PM', '', 'IN', 'out', 'By Auto', '2015-08-27'),
(11, '1', '17:33:59 PM', '17:42:49 PM', '23, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', 'out', 'By Auto', '2015-08-27'),
(12, '1', '17:42:09 PM', '17:42:49 PM', '', 'IN', 'out', 'By Auto', '2015-08-27'),
(13, '1', '18:29:24 PM', '18:30:50 PM', '', 'IN', 'out', 'By Auto', '2015-08-27'),
(14, '1', '10:51:57 AM', '10:52:02 AM', '23, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', 'out', 'null', '2015-08-28'),
(15, '1', '11:05:09 AM', '11:05:25 AM', '', 'IN', 'out', 'null', '2015-08-28'),
(16, '1', '11:08:09 AM', '11:08:20 AM', 'Subhanpura Rd, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', 'out', 'null', '2015-08-28'),
(17, '1', '11:08:31 AM', '11:22:25 AM', 'Subhanpura Rd, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', 'out', 'null', '2015-08-28'),
(18, '1', '11:09:07 AM', '11:22:25 AM', 'Subhanpura Rd, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', 'out', 'null', '2015-08-28'),
(19, '1', '11:21:48 AM', '11:22:25 AM', '', 'IN', 'out', 'null', '2015-08-28'),
(20, '1', '11:33:54 AM', '11:29:50 am', '23, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', 'out', 'By Bike', '2015-08-28'),
(21, '1', '12:07:21 PM', '12:20:32 PM', '23, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', 'out', 'By Bike', '2015-08-28'),
(25, '3', '12:13:23 PM', '', '23, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', '', 'By Auto', '2015-08-28'),
(26, '3', '12:17:34 PM', '', '23, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', '', 'null', '2015-08-28'),
(27, '1', '12:38:03 PM', '13:04:39 PM', '23, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', 'out', 'By Bike', '2015-08-28'),
(28, '1', '12:57:29 PM', '13:04:39 PM', '', 'IN', 'out', 'null', '2015-08-28'),
(29, '1', '13:04:13 PM', '13:04:39 PM', '23, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', 'out', 'By Bike', '2015-08-28'),
(30, '1', '14:54:33 PM', '14:54:41 PM', '', 'IN', 'out', 'By Auto', '2015-08-28'),
(31, '1', '14:54:45 PM', '14:54:52 PM', '', 'IN', 'out', 'By Auto', '2015-08-28'),
(32, '1', '15:01:31 PM', '15:01:34 PM', '', 'IN', 'out', 'By Auto', '2015-08-28'),
(33, '1', '15:39:52 PM', '15:40:03 PM', 'IO Exception trying to get address:java.io.IOException: Timed out waiting for response from server', 'IN', 'out', 'By Auto', '2015-08-28'),
(34, '1', '15:52:58 PM', '15:53:09 PM', 'IO Exception trying to get address:java.io.IOException: Timed out waiting for response from server', 'IN', 'out', 'By Bike', '2015-08-28'),
(35, '1', '15:53:19 PM', '15:53:21 PM', 'IO Exception trying to get address:java.io.IOException: Timed out waiting for response from server', 'IN', 'out', 'By Auto', '2015-08-28'),
(36, '1', '16:11:55 PM', '16:12:12 PM', 'Subhanpura Rd, Subhanpura, Vadodara, Gujarat 390023,India', 'IN', 'out', 'By Bike', '2015-08-28'),
(37, '1', '09:32:57 AM', '09:33:06 AM', '', 'IN', 'out', 'null', '2015-08-31'),
(38, '1', '18:35:02 PM', '18:35:19 PM', '13, Subhanpura, Vadodara, Gujarat 390003,India', 'IN', 'out', 'By Auto', '2015-08-31'),
(39, '1', '18:35:33 PM', '18:35:40 PM', '13, Subhanpura, Vadodara, Gujarat 390003,India', 'IN', 'out', 'By Bike', '2015-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `db_sales_register`
--

CREATE TABLE IF NOT EXISTS `db_sales_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `contactno` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uniqueid` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `db_sales_register`
--

INSERT INTO `db_sales_register` (`id`, `fname`, `lname`, `dob`, `address`, `contactno`, `role`, `status`, `added_date`, `uniqueid`) VALUES
(1, 'udit', 'Choudhary', '1988-3-12', '16 NX-2 Sch .No. 71 Indore\r\nstate M.P\r\nLocated: Baroda', '8980006126', 'Sales Person', 1, '2015-08-12 13:07:15', 'Udi03Sal'),
(3, 'lalit', 'Soni', '1981-5-31', 'C/O Dr. R.C.Soni\r\nVishal Narsing Home \r\nKrishnapura Marg Biaora\r\nLocated:Baroda', '8980008227', 'Sales Person', 1, '2015-08-12 13:13:23', 'Lal5-Sal'),
(4, 'ikshit', 'amin', '2015-8-1', '9 - Parishram Society , \r\nSubhanpura road, \r\nvadodara', '9510929408', 'Admin', 1, '2015-08-13 06:35:35', 'iks08Adm'),
(5, 'vaishakh', 'patel', '2015-08-20', 'vadodara', '9898989898', 'sales person', 0, '2015-08-20 03:40:15', 'vai08sal');

-- --------------------------------------------------------

--
-- Table structure for table `db_shop_history`
--

CREATE TABLE IF NOT EXISTS `db_shop_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` varchar(100) NOT NULL,
  `shop_id` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `in_time` varchar(100) NOT NULL,
  `out_time` varchar(100) NOT NULL,
  `statusin` varchar(100) NOT NULL,
  `statusout` varchar(100) NOT NULL,
  `diff_let_log` varchar(100) NOT NULL,
  `shop_diff_time` varchar(100) NOT NULL,
  `shop_distance` varchar(100) NOT NULL,
  `history_date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `db_shop_history`
--

INSERT INTO `db_shop_history` (`id`, `sales_id`, `shop_id`, `location`, `in_time`, `out_time`, `statusin`, `statusout`, `diff_let_log`, `shop_diff_time`, `shop_distance`, `history_date`) VALUES
(1, '', '53', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '16:51:52', '17:45:44 PM', 'In', 'OUT', 'OUT', '0/0/0 , 0:0:9', '0.0', '2015-08-28'),
(2, '', '47', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '', '28/08/2015 16:53:18 PM', '', 'OUT', '', '', '', ''),
(3, '', '48', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '', '28/08/2015 16:55:08 PM', '', 'OUT', '', '', '', ''),
(4, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '28/08/2015 17:11:04 PM', '', 'In', '', '', '', '', '2015-08-28'),
(5, '1', '51', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '17:24:18 PM', '17:28:02 PM', 'In', 'OUT', 'OUT', '0/0/0 , 0:0:10', '0.0', '2015-08-28'),
(6, '', '50', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '', '17:25:45 PM', '', 'OUT', '', '', '', ''),
(7, '', '51', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '', '17:27:52 PM', '', 'OUT', '', '', '', ''),
(8, '1', '52', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '17:29:41 PM', '17:31:28 PM', 'In', 'OUT', 'OUT', '0/0/0 , 0:0:5', '0.0', '2015-08-28'),
(9, '', '52', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '', '17:31:23 PM', '', 'OUT', '', '', '', ''),
(10, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '17:43:50 PM', '', 'In', '', '', '', '', '2015-08-28'),
(11, '', '53', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '', '17:45:35 PM', '', 'OUT', '', '', '', ''),
(12, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '09:37:54 AM', '', 'In', '', '', '', '', '2015-08-31'),
(13, '', '54', '42,Subhanpura,Vadodara, Gujarat 390023,India,', '', '09:38:58 AM', '', 'OUT', '', '', '', ''),
(14, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '09:41:27 AM', '', 'In', '', '', '', '', '2015-08-31'),
(15, '', '55', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '', '09:42:31 AM', '', 'OUT', '', '', '', ''),
(16, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '09:43:02 AM', '', 'In', '', '', '', '', '2015-08-31'),
(17, '', '5', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '09:44:03 AM', '09:44:52 AM', 'In', 'OUT', 'OUT', '0/0/0 , 0:0:26', '0.0', '2015-08-31'),
(18, '', '5', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '', '09:44:26 AM', '', 'OUT', '', '', '', ''),
(19, '1', '20', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '09:50:10 AM', '09:51:23 AM', 'In', 'OUT', 'OUT', '0/0/0 , 0:0:42', '0.0', '2015-08-31'),
(20, '1', '20', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '', '09:50:41 AM', '', 'OUT', '', '', '', ''),
(21, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '10:02:47 AM', '', 'In', '', '', '', '', '2015-08-31'),
(22, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '10:05:52 AM', '', 'In', '', '', '', '', '2015-08-31'),
(23, '1', '4', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '', '10:06:22 AM', '', 'OUT', '', '', '', ''),
(24, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '10:17:08 AM', '', 'In', '', '', '', '', '2015-08-31'),
(25, '1', '8', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '', '10:17:32 AM', '', 'OUT', '', '', '', ''),
(26, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '10:23:10 AM', '10:23:24 AM', 'In', 'OUT', 'OUT', '0/0/0 , 0:0:10', '0.0', '2015-08-31'),
(27, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '', '10:23:14 AM', '', 'OUT', '', '', '', ''),
(28, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '10:24:20 AM', '10:24:45 AM', 'In', 'OUT', 'OUT', '0/0/0 , 0:0:10', '0.0', '2015-08-31'),
(29, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '', '10:24:35 AM', '', 'OUT', '', '', '', ''),
(30, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '10:24:56 AM', '', 'In', '', '', '', '', '2015-08-31'),
(31, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '14:21:15 PM', '', 'In', '', '', '', '', '2015-08-31'),
(32, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '15:00:03 PM', '', 'In', '', '', '', '', '2015-08-31'),
(33, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '15:25:11 PM', '', 'In', '', '', '', '', '2015-08-31'),
(34, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '15:28:21 PM', '', 'In', '', '', '', '', '2015-08-31'),
(35, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '15:30:46 PM', '', 'In', '', '', '', '', '2015-08-31'),
(36, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '15:31:32 PM', '', 'In', '', '', '', '', '2015-08-31'),
(37, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '16:24:07 PM', '', 'In', '', '', '', '', '2015-08-31'),
(38, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '16:27:33 PM', '', 'In', '', '', '', '', '2015-08-31'),
(39, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '18:15:40 PM', '', 'In', '', '', '', '', '2015-08-31'),
(40, '1', '2', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '18:16:45 PM', '18:18:13 PM', 'In', 'OUT', 'OUT', '0/0/0 , 0:0:10', '0.0', '2015-08-31'),
(41, '1', '2', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '', '18:18:03 PM', '', 'OUT', '', '', '', ''),
(42, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '18:36:06 PM', '', 'In', '', '', '', '', '2015-08-31'),
(43, '1', '3', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '18:40:21 PM', '18:41:19 PM', 'In', 'OUT', 'OUT', '0/0/0 , 0:0:4', '0.01', '2015-08-31'),
(44, '1', '3', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '', '18:41:15 PM', '', 'OUT', '', '', '', ''),
(45, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '18:44:37 PM', '', 'In', '', '', '', '', '2015-08-31'),
(46, '1', '', '23,Subhanpura,Vadodara, Gujarat 390023,India,', '19:01:38 PM', '', 'In', '', '', '', '', '2015-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `db_shop_register`
--

CREATE TABLE IF NOT EXISTS `db_shop_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(100) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `contactno` varchar(100) NOT NULL,
  `street` varchar(300) NOT NULL,
  `address` varchar(200) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longtitude` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `suggestion` text NOT NULL,
  `shop_image` varchar(100) NOT NULL,
  `audio` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `db_shop_register`
--

INSERT INTO `db_shop_register` (`id`, `shop_name`, `client_name`, `contactno`, `street`, `address`, `latitude`, `longtitude`, `comment`, `suggestion`, `shop_image`, `audio`, `status`, `added_date`) VALUES
(1, 'krishna medical', 'krish patel', '5556663322', 'parishram', '23, Subhanpura, Vadodara, Gujarat 390023,India', '22.3204112', '73.1643759', '', 'no', '1441013438152.jpg', 'record20150831150045.ogg', 'hot', '2015-08-31 09:30:38'),
(2, 'fhh', 'fggff', '66995522331', 'hhhhh', '23, Subhanpura, Vadodara, Gujarat 390023,India', '22.3204363', '73.164381', '', 'no', '1441014972502.jpg', 'record20150831152619.ogg', 'hot', '2015-08-31 09:56:12'),
(3, 'radhe medical', 'ashish', '9944223311', 'dfgg', '13, Subhanpura, Vadodara, Gujarat 390003,India', '22.32194833333333', '73.16435833333334', '', 'no', '1441026432619.jpg', 'record20150831183725.ogg', 'hot', '2015-08-31 13:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `db_stock`
--

CREATE TABLE IF NOT EXISTS `db_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `db_stock`
--

INSERT INTO `db_stock` (`id`, `product_type`, `qty`, `added_date`) VALUES
(1, '1', '1000', '2015-08-22 08:45:13'),
(2, '2', '1000', '2015-08-22 09:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `db_target`
--

CREATE TABLE IF NOT EXISTS `db_target` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target_type` varchar(100) NOT NULL,
  `sales_id` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `incentive` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `db_target`
--

INSERT INTO `db_target` (`id`, `target_type`, `sales_id`, `qty`, `incentive`, `start_date`, `end_date`, `added_date`) VALUES
(1, 'daily', '1', '10', '10', '2015-08-28', '', '2015-08-28 13:56:04'),
(2, 'weekly', '1', '100', '10', '2015-08-28', '2015-09-04', '2015-08-28 13:56:04'),
(5, 'daily', '1', '100', '10', '2015-08-31', '', '2015-08-31 02:00:22'),
(6, 'weekly', '1', '700', '10', '2015-08-31', '2015-09-07', '2015-08-31 02:00:22');

-- --------------------------------------------------------

--
-- Table structure for table `db_target1`
--

CREATE TABLE IF NOT EXISTS `db_target1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` varchar(100) NOT NULL,
  `producttype_id` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `db_target1`
--

INSERT INTO `db_target1` (`id`, `sales_id`, `producttype_id`, `qty`, `date`, `added_date`) VALUES
(1, '1', '1', '500', '2015-08-22', '2015-08-22 08:46:50'),
(2, '6', '1', '100', '2015-08-22', '2015-08-22 08:58:21'),
(3, '1', '1', '100', '2015-08-24', '2015-08-24 13:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `db_target_my`
--

CREATE TABLE IF NOT EXISTS `db_target_my` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target_type` varchar(100) NOT NULL,
  `sales_id` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `incentive` varchar(100) NOT NULL,
  `month` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `db_target_my`
--

INSERT INTO `db_target_my` (`id`, `target_type`, `sales_id`, `qty`, `incentive`, `month`, `year`, `added_date`) VALUES
(1, 'monthly', '1', '1000', '10', '2015-08', '2015-09', '2015-08-28 13:56:04'),
(2, 'yearly', '1', '1500', '10', '2015', '2016', '2015-08-28 13:56:04'),
(5, 'monthly', '1', '2100', '10', '2015-08', '2015-08', '2015-08-31 02:00:22'),
(6, 'yearly', '1', '12000', '10', '2015', '2016', '2015-08-31 02:00:22');

-- --------------------------------------------------------

--
-- Table structure for table `db_user_review`
--

CREATE TABLE IF NOT EXISTS `db_user_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` varchar(100) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `audio` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `db_user_review`
--

INSERT INTO `db_user_review` (`id`, `sales_id`, `event_name`, `location`, `audio`) VALUES
(1, '1', 'abc', '23, Subhanpura, Vadodara, Gujarat 390023,India', 'record20150828082522.ogg'),
(2, '1', 'fghg', '23, Subhanpura, Vadodara, Gujarat 390023,India', 'record20150828105226.ogg'),
(3, '1', 'hh promotion', '4, O P Rd, J P Nagar, IOC Nagar, Haripura, Vadodara, Gujarat 390007,India', 'Voice 016.m4a'),
(4, '1', 'ff', '13, Subhanpura, Vadodara, Gujarat 390003,India', 'record20150831184242.ogg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(100) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_password` varchar(200) NOT NULL,
  `admin_last_logged` datetime NOT NULL,
  `admin_last_updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `admin_username`, `admin_email`, `admin_password`, `admin_last_logged`, `admin_last_updated`) VALUES
(1, 'ikshitamin', 'vaishakhpatel06@gmail.com', 'health@123$', '2013-03-04 10:42:19', '2013-06-10 09:55:31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
