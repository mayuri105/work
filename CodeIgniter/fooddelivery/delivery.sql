-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2016 at 11:48 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `apt_name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` int(10) DEFAULT NULL,
  `phone_no` bigint(150) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ads_order`
--

CREATE TABLE `ads_order` (
  `ao_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `store_name` varchar(50) DEFAULT NULL,
  `package_id` int(11) NOT NULL,
  `package_name` varchar(50) DEFAULT NULL,
  `package_price` decimal(10,2) DEFAULT NULL,
  `package_periods` int(10) DEFAULT NULL,
  `payment_type` varchar(50) NOT NULL,
  `payment_done` int(1) DEFAULT NULL,
  `ads_approved` int(1) DEFAULT NULL,
  `merchant_id` int(11) NOT NULL,
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ads_package`
--

CREATE TABLE `ads_package` (
  `asp_id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `package_price` decimal(10,2) NOT NULL,
  `package_periods` int(11) NOT NULL,
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads_package`
--

INSERT INTO `ads_package` (`asp_id`, `package_name`, `package_price`, `package_periods`, `added_date`) VALUES
(1, 'Silver', '50.00', 1, '2015-12-02'),
(2, 'Gold', '100.00', 3, '2015-12-02'),
(3, 'Platinum', '200.00', 6, '2015-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `parent_category` int(11) DEFAULT NULL,
  `start_time` date DEFAULT NULL,
  `end_time` date DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `category`, `store_id`, `status`, `discount`, `parent_category`, `start_time`, `end_time`, `created_on`) VALUES
(1, 'Appetizers', 1, 1, NULL, NULL, NULL, NULL, '2016-01-01 15:44:31'),
(2, 'Salad', 1, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:01:15'),
(3, 'Chicken', 1, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:12:42'),
(4, 'Starters', 2, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:30:41'),
(5, 'Soups and Salads', 2, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:34:41'),
(7, 'Chinese Cuisine : Soup and Appetizers', 3, 1, '0.00', NULL, '1970-01-01', '1970-01-01', '2016-01-01 17:25:05'),
(9, 'Thai Cuisine : Soup - Appetizers - Salad', 3, 1, '0.00', NULL, '1970-01-01', '1970-01-01', '2016-01-01 17:31:31'),
(11, 'Thai Cuisine : Fried Rice', 3, 1, '0.00', NULL, '1970-01-01', '1970-01-01', '2016-01-01 17:33:40'),
(12, 'Thai Cuisine : Dinner Specials', 3, 1, '0.00', NULL, '1970-01-01', '1970-01-01', '2016-01-01 17:34:59'),
(13, 'Liquor', 4, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:07:23'),
(14, 'Aperitifs', 4, 1, NULL, 13, NULL, NULL, '2016-01-01 18:07:37'),
(15, 'Armagnac', 4, 1, NULL, 13, NULL, NULL, '2016-01-01 18:10:35'),
(16, 'Bitters', 4, 1, NULL, 13, NULL, NULL, '2016-01-01 18:12:13'),
(17, 'Wine', 4, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:13:56'),
(18, 'Champagne', 4, 1, NULL, 17, NULL, NULL, '2016-01-01 18:14:09'),
(19, 'Toasted Bagels', 5, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:28:10'),
(20, 'BAGLES', 5, 1, '0.00', 19, '1970-01-01', '1970-01-01', '2016-01-01 18:30:16'),
(21, 'Sandwiches', 5, 1, '0.00', NULL, '1970-01-01', '1970-01-01', '2016-01-01 18:32:14'),
(22, 'Specialty Sandwiches', 5, 1, NULL, 21, NULL, NULL, '2016-01-01 18:32:57'),
(23, 'Coffee & Tea', 5, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:39:17'),
(24, 'Coffee', 5, 1, NULL, 23, NULL, NULL, '2016-01-01 18:39:35'),
(25, 'Tea', 5, 1, NULL, 23, NULL, NULL, '2016-01-01 18:40:35'),
(26, 'Beverages', 5, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:40:59'),
(27, 'Aloe Drinks', 5, 1, NULL, 26, NULL, NULL, '2016-01-01 18:41:11'),
(28, 'Energy & Sports Drinks', 5, 1, NULL, 26, NULL, NULL, '2016-01-01 18:41:24'),
(29, 'Juice & Teas', 5, 1, NULL, 26, NULL, NULL, '2016-01-01 18:41:35'),
(30, 'Laundry', 6, 1, NULL, NULL, NULL, NULL, '2016-01-01 19:00:05'),
(31, 'Dry Cleaning', 6, 1, NULL, NULL, NULL, NULL, '2016-01-01 19:00:14'),
(32, 'Beer', 7, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:33:23'),
(33, 'Liquor', 7, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:33:47'),
(34, 'Wine', 7, 1, '0.00', NULL, '1970-01-01', '1970-01-01', '2016-01-04 10:34:04'),
(35, 'Chilled', 7, 1, NULL, 32, NULL, NULL, '2016-01-04 10:34:52'),
(36, 'Cordials & Liqueurs', 7, 1, NULL, 33, NULL, NULL, '2016-01-04 10:37:13'),
(37, 'Brandy & Cognac', 7, 1, NULL, 33, NULL, NULL, '2016-01-04 10:40:17'),
(38, 'Gin', 7, 1, NULL, 33, NULL, NULL, '2016-01-04 10:41:47'),
(39, 'Champagne & Sparkling Wine', 7, 1, NULL, 34, NULL, NULL, '2016-01-04 10:43:29'),
(40, 'White Wine', 7, 1, NULL, 34, NULL, NULL, '2016-01-04 10:43:42'),
(41, 'Red Wine', 7, 1, NULL, 34, NULL, NULL, '2016-01-04 10:43:56'),
(42, 'Specials', 8, 1, NULL, NULL, NULL, NULL, '2016-01-04 12:58:41'),
(43, 'Beverages', 8, 1, NULL, NULL, NULL, NULL, '2016-01-04 12:58:58'),
(44, 'Today', 8, 1, NULL, 42, NULL, NULL, '2016-01-04 12:59:15'),
(45, 'Coconut Water', 8, 1, '0.00', 43, '1970-01-01', '1970-01-01', '2016-01-04 13:57:38'),
(46, 'Mixers', 8, 1, NULL, 43, NULL, NULL, '2016-01-04 14:00:29'),
(47, 'Sports Drinks', 8, 1, NULL, 43, NULL, NULL, '2016-01-04 14:02:01'),
(48, 'Beer', 8, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:04:12'),
(49, 'Stong', 8, 1, NULL, 48, NULL, NULL, '2016-01-04 14:05:00'),
(50, 'Coffee & Tea', 8, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:06:45'),
(51, 'Coffee Drinks', 8, 1, NULL, 50, NULL, NULL, '2016-01-04 14:06:59'),
(52, 'Coffee', 8, 1, NULL, 50, NULL, NULL, '2016-01-04 14:08:23'),
(53, 'Tea', 8, 1, NULL, 50, NULL, NULL, '2016-01-04 14:13:05'),
(54, 'Dairy', 8, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:14:42'),
(55, 'Tofu', 8, 1, NULL, 54, NULL, NULL, '2016-01-04 14:14:52'),
(56, 'Milk & Milk Alternatives', 8, 1, NULL, 54, NULL, NULL, '2016-01-04 14:15:36'),
(57, 'Cream & Creamers', 8, 1, NULL, 54, NULL, NULL, '2016-01-04 14:17:57'),
(58, 'Eggs', 8, 1, NULL, 54, NULL, NULL, '2016-01-04 14:20:22'),
(60, 'Fresh Juices', 8, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:22:28'),
(61, 'Small Packs', 8, 1, NULL, 60, NULL, NULL, '2016-01-04 14:37:46'),
(62, 'Large Packs', 8, 1, NULL, 60, NULL, NULL, '2016-01-04 14:38:05'),
(63, 'Rice, Grains & Noodles', 8, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:42:45'),
(64, 'Rice', 8, 1, NULL, 63, NULL, NULL, '2016-01-04 14:47:42'),
(66, 'GRAINS', 8, 1, NULL, 63, NULL, NULL, '2016-01-04 14:49:55'),
(67, 'Noodles', 8, 1, NULL, 63, NULL, NULL, '2016-01-04 14:53:11'),
(68, 'Laundry', 9, 1, NULL, NULL, NULL, NULL, '2016-01-04 15:48:32'),
(69, 'Dry Cleaning', 9, 1, NULL, NULL, NULL, NULL, '2016-01-04 15:48:39'),
(70, 'Dry Cleaning - Homeware', 9, 1, NULL, NULL, NULL, NULL, '2016-01-04 15:48:52'),
(71, 'Tailoring', 9, 1, NULL, NULL, NULL, NULL, '2016-01-04 15:49:04'),
(72, 'Sushi and Sashimi', 10, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:55:30'),
(73, 'Isushi Rolls', 10, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:04:15'),
(74, 'Dessert', 10, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:31:00'),
(75, 'Beverages', 10, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:33:09'),
(76, 'Laundry', 11, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:31:37'),
(77, 'Dry Cleaning', 11, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:33:34'),
(78, 'Dry Cleaning - Homeware', 11, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:42:50'),
(79, 'Tailoring', 11, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:44:09'),
(80, 'Pizza', 12, 1, NULL, NULL, NULL, NULL, '2016-01-05 11:18:40'),
(81, 'Gourmet Pizza <br/> Choice of (10 inch), (14 inch), (16 inch) or (18 inch) pizza size.', 12, 1, NULL, NULL, NULL, NULL, '2016-01-05 11:27:43'),
(82, 'Italian Hot Sandwiches <br/> Served on long sub roll. Add French fries for an additional charge.', 12, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:09:18'),
(83, 'Pasta <br/>  Served with garlic knots.', 12, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:17:24'),
(84, 'Dessert', 12, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:48:22');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(255) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `feature_city` int(1) DEFAULT NULL,
  `city_image_url` varchar(255) DEFAULT NULL,
  `city_banner_image` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `state`, `feature_city`, `city_image_url`, `city_banner_image`, `status`) VALUES
(1, 'Chicago', 'IL', 1, 'xt1.jpg', 'c22.jpg', 1),
(2, 'New York City', 'NY', 1, 'newimages1.jpg', 'newimage1.jpg', 1),
(3, 'Los Angeles', 'CA', 1, 'losimage.jpg', 'losbanner.jpg', 1),
(4, 'San Francisco', 'CA', 1, 'sanbanner1.jpg', 'sanfranbanner.jpg', 1),
(5, 'Brookhaven', 'NY', NULL, 'brookimage.jpg', 'brookbanner.jpg', 1),
(6, ' Bronx', 'NY', NULL, 'bronoximage.jpg', 'bronoxbanner.jpg', 1),
(7, 'Arlington', 'VA', 1, 'arlington.jpg', 'arlingtonbanner1.jpg', 1),
(8, 'Miami', 'FL', 1, 'miamiimage.jpg', 'miamibanner.jpg', 1),
(9, 'Philadelphia', 'PA', 1, 'Philly-Skyline-2.jpg', 'phi2.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `city_zipcode`
--

CREATE TABLE `city_zipcode` (
  `cz_id` int(11) NOT NULL,
  `zipcode` int(10) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `enabled` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city_zipcode`
--

INSERT INTO `city_zipcode` (`cz_id`, `zipcode`, `city_id`, `enabled`) VALUES
(1, 60601, 1, 1),
(2, 60602, 1, 1),
(3, 60603, 1, 1),
(4, 60604, 1, 1),
(5, 60605, 1, 1),
(6, 60606, 1, 1),
(7, 60607, 1, 1),
(8, 60608, 1, 1),
(9, 60609, 1, 1),
(10, 60610, 1, 1),
(11, 60611, 1, 1),
(12, 60612, 1, 1),
(13, 60613, 1, 1),
(14, 60614, 1, 1),
(15, 60615, 1, 1),
(16, 10001, 2, 1),
(17, 10002, 2, 1),
(18, 10003, 2, 1),
(19, 10004, 2, 1),
(20, 10005, 2, 1),
(21, 10006, 2, 1),
(22, 10007, 2, 1),
(23, 10008, 2, 1),
(24, 10009, 2, 1),
(25, 10010, 2, 1),
(26, 10011, 2, 1),
(27, 10012, 2, 1),
(28, 10013, 2, 1),
(29, 10014, 2, 1),
(30, 10015, 2, 1),
(31, 10016, 2, 1),
(32, 10017, 2, 1),
(33, 10018, 2, 1),
(34, 10019, 2, 1),
(35, 10020, 2, 1),
(36, 10021, 2, 1),
(37, 10022, 2, 1),
(38, 10023, 2, 1),
(39, 10024, 2, 1),
(40, 90001, 3, 1),
(41, 90002, 3, 1),
(42, 90003, 3, 1),
(43, 90004, 3, 1),
(44, 90005, 3, 1),
(45, 90006, 3, 1),
(46, 90007, 3, 1),
(47, 90008, 3, 1),
(48, 90009, 3, 1),
(49, 90010, 3, 1),
(50, 90011, 3, 1),
(51, 90012, 3, 1),
(52, 90013, 3, 1),
(53, 90014, 3, 1),
(54, 94101, 4, 1),
(55, 94102, 4, 1),
(56, 94103, 4, 1),
(57, 94104, 4, 1),
(58, 94105, 4, 1),
(59, 94106, 4, 1),
(60, 94107, 4, 1),
(61, 94108, 4, 1),
(62, 94109, 4, 1),
(63, 94110, 4, 1),
(64, 94111, 4, 1),
(65, 94112, 4, 1),
(66, 94113, 4, 1),
(67, 94114, 4, 1),
(68, 94115, 4, 1),
(69, 11719, 5, 1),
(70, 11733, 5, 1),
(71, 11772, 5, 1),
(72, 11776, 5, 1),
(73, 17777, 5, 1),
(74, 11790, 5, 1),
(75, 11794, 5, 1),
(76, 10451, 6, 1),
(77, 10452, 6, 1),
(78, 10453, 6, 1),
(79, 10454, 6, 1),
(80, 10455, 6, 1),
(81, 10456, 6, 1),
(82, 10457, 6, 1),
(83, 10458, 6, 1),
(84, 10459, 6, 1),
(85, 10460, 6, 1),
(86, 10461, 6, 1),
(87, 10462, 6, 1),
(88, 10463, 6, 1),
(89, 10464, 6, 1),
(90, 10465, 6, 1),
(91, 10466, 6, 1),
(92, 10467, 6, 1),
(93, 22101, 7, 1),
(94, 22102, 7, 1),
(95, 22103, 7, 1),
(96, 22104, 7, 1),
(97, 22105, 7, 1),
(98, 22106, 7, 1),
(99, 22107, 7, 1),
(100, 22108, 7, 1),
(101, 22109, 7, 1),
(102, 22110, 7, 1),
(103, 22111, 7, 1),
(104, 22112, 7, 1),
(105, 22113, 7, 1),
(106, 22114, 7, 1),
(107, 22115, 7, 1),
(108, 22116, 7, 1),
(109, 33101, 8, 1),
(110, 33102, 8, 1),
(111, 33103, 8, 1),
(112, 33104, 8, 1),
(113, 33105, 8, 1),
(114, 33106, 8, 1),
(115, 33107, 8, 1),
(116, 33108, 8, 1),
(117, 33109, 8, 1),
(118, 33110, 8, 1),
(119, 33111, 8, 1),
(120, 33112, 8, 1),
(121, 33113, 8, 1),
(122, 33114, 8, 1),
(123, 33115, 8, 1),
(124, 19101, 9, 1),
(125, 19102, 9, 1),
(126, 19103, 9, 1),
(127, 19104, 9, 1),
(128, 19105, 9, 1),
(129, 19106, 9, 1),
(130, 19107, 9, 1),
(131, 19108, 9, 1),
(132, 19109, 9, 1),
(133, 19110, 9, 1),
(134, 19111, 9, 1),
(135, 19112, 9, 1),
(136, 19113, 9, 1),
(137, 19114, 9, 1),
(138, 19115, 9, 1),
(139, 19116, 9, 1),
(140, 19117, 9, 1),
(141, 19118, 9, 1),
(142, 19119, 9, 1),
(143, 19120, 9, 1),
(144, 19121, 9, 1),
(145, 19122, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `conversion`
--

CREATE TABLE `conversion` (
  `conversion_id` int(11) NOT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `receiver_type` varchar(25) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `sender_type` varchar(11) DEFAULT NULL,
  `message` longtext NOT NULL,
  `message_read` int(1) DEFAULT NULL,
  `send_date` datetime DEFAULT NULL,
  `receiver_date` datetime DEFAULT NULL,
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `c_id` int(11) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `uses_per_coupon` int(11) DEFAULT NULL,
  `uses_per_customer` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`c_id`, `coupon_name`, `coupon_code`, `type`, `discount`, `total_amount`, `date_start`, `date_end`, `uses_per_coupon`, `uses_per_customer`, `status`) VALUES
(1, 'Savannah Talley', 'del100', 'F', '100.00', '1000.00', '2015-11-01', '2015-12-31', 100, 1, 1),
(2, 'del 150', 'del150', 'F', '150.00', '1000.00', '2015-11-01', '2015-12-31', 100, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupons_histroy`
--

CREATE TABLE `coupons_histroy` (
  `ch_id` int(11) NOT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `coupon_name` varchar(50) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `added_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cusine_data`
--

CREATE TABLE `cusine_data` (
  `cu_id` int(11) NOT NULL,
  `cusine_type` varchar(255) NOT NULL,
  `cuisine_image_url` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `featured_on` int(1) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cusine_data`
--

INSERT INTO `cusine_data` (`cu_id`, `cusine_type`, `cuisine_image_url`, `banner_image`, `status`, `featured_on`, `created_on`) VALUES
(1, 'American', 'americanimage1.jpg', 'american_banner.jpg', 1, NULL, '2016-01-01 09:33:15'),
(2, 'Pizza', 'pizzaimage1.jpg', 'pizza_banner.jpg', 1, 1, '2016-01-01 09:34:20'),
(3, 'Chinese', 'chinese2.jpg', 'chinese_banner.jpg', 1, 1, '2016-01-01 09:35:42'),
(4, 'Mexican', 'maxicanimage1.jpg', 'maxican_banner.jpg', 1, 1, '2016-01-01 09:36:48'),
(5, 'Sushi', 'sushiimage1.jpg', 'sushi_banner.jpg', 1, 1, '2016-01-01 09:38:20'),
(6, 'Fast food', 'fastfoodimage1.jpg', 'fast_food_banner.jpg', 1, 1, '2016-01-01 09:39:36'),
(7, 'Thai', 'thaiimage1.jpg', 'thai_banner.jpg', 1, 1, '2016-01-01 09:40:43'),
(8, 'BBQ', 'bbqimage1.jpg', 'bbq_banner.jpg', 1, NULL, '2016-01-01 09:42:01'),
(9, 'Deli', 'deliimage1.jpg', 'deli_image.jpg', 1, NULL, '2016-01-01 09:44:01'),
(10, 'Indian', 'india2.jpg', 'indian_banner.jpg', 1, NULL, '2016-01-01 09:46:11'),
(11, 'Mediterranean', 'Mediterraneanimage1.jpg', 'Mediterranean.jpg', 1, NULL, '2016-01-01 09:48:14'),
(12, 'Vegetarian', 'vegimage1.png', 'veg_image.png', 1, NULL, '2016-01-01 09:49:28'),
(13, 'Asian', 'asian2.jpg', 'asian_banner.jpg', 1, NULL, '2016-01-01 09:51:09'),
(14, 'Breakfast ', 'Breakfastimage1.jpg', 'Breakfast_banner.jpg', 1, NULL, '2016-01-01 09:53:49'),
(15, 'Desserts', 'Dessertsimage1.jpg', 'Desserts_banner.jpg', 1, NULL, '2016-01-01 09:56:54'),
(16, 'Italian', 'italianimage1.jpg', 'Italian_banner.jpg', 1, NULL, '2016-01-01 09:59:55'),
(17, 'Wings', 'wingsimage1.jpg', 'Wings_banner.jpg', 1, NULL, '2016-01-01 10:02:12'),
(18, 'Middle eastern', 'Middleeasternimage1.jpg', 'Middle_eastern_banner.jpg', 1, NULL, '2016-01-01 10:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `stripe_cust_id` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `ref_by` int(11) DEFAULT NULL,
  `share_code` varchar(255) NOT NULL,
  `newsletter` tinyint(4) DEFAULT NULL,
  `enabled` int(1) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `created_on` date NOT NULL,
  `last_login` datetime NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `first_name`, `last_name`, `email`, `phone`, `stripe_cust_id`, `password`, `ref_by`, `share_code`, `newsletter`, `enabled`, `ip`, `created_on`, `last_login`, `last_update`) VALUES
(1, 'demo', 'demo', 'demo@localhost.com', NULL, NULL, 'x0Jq96RNeKNP1uKi87DMyJXoC55T3xO0gx0YgkkiAR+A7pQ4/rKSbHO7ANQl9qeGgGtV/sziKhPN2b4xxBu4SQ==', NULL, 'demodemo', NULL, 1, '192.168.2.5', '2016-01-08', '2016-02-22 11:36:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer_card_details`
--

CREATE TABLE `customer_card_details` (
  `cc_id` int(11) NOT NULL,
  `credit_card_no` varchar(1000) DEFAULT NULL,
  `exp_month` int(11) DEFAULT NULL,
  `exp_year` int(11) DEFAULT NULL,
  `cvv` int(11) DEFAULT NULL,
  `billing_zip` int(10) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_reward`
--

CREATE TABLE `customer_reward` (
  `customer_reward_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail_templates`
--

CREATE TABLE `mail_templates` (
  `mt_id` int(11) NOT NULL,
  `mail_title` varchar(50) DEFAULT NULL,
  `mail_content` text,
  `added_date` date NOT NULL,
  `send_msg` int(1) DEFAULT NULL,
  `msg_template` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_templates`
--

INSERT INTO `mail_templates` (`mt_id`, `mail_title`, `mail_content`, `added_date`, `send_msg`, `msg_template`) VALUES
(1, 'customer_forgott_mail_template', 'Hello {username} ,<br >Your password is {password}<br />To login click {login_page_link} ,<br ><br >Thank You<br />{company_name}.', '2015-11-26', 1, 'Hello {username},Your password is {password},Thank You .{company_name}.'),
(2, 'admin_forgott_mail_template', 'Hello {username} ,<br >Your password is {password}<br />To login click {login_page_link} ,<br ><br >Thank You<br />{company_name}', '2015-11-26', NULL, NULL),
(3, 'order_mail_template', 'Dear {customername},\n\n<br>\n<br>\nYour order status for order id- {orderid}  has been  changed to {orderstatus}.\n<br>\n<br>\nThanks & regards\n<br>\n{storename}\n', '2015-12-07', 1, 'Dear {customername},Your order status for order id -{orderid}  has been  changed to {orderstatus},{storename}'),
(4, 'merchant_forgott_mail_template', 'Hello {username} ,<br >Your password is {password}<br />To login click {login_page_link} ,<br ><br >Thank You<br />{company_name}', '2015-11-26', 1, 'Hello {username},Your password is {password} .Thank You .{company_name}'),
(5, 'merchant_transaction', 'Hello vendor,\nYour account has been succeefully {transaction_type} by {amount}. ', '2015-12-14', 1, 'Hello vendor,\nYour account has been succeefully {transaction_type} by {amount}. '),
(6, 'customer_welcome_mail', 'Hello {username},\n<br>\nThanks for signup on {company_name}.Exclusive Foods ,Grocery,Alcohol and Laundry  on your finger tap.\n<br>\n<br ><br >Regards<br />\n{company_name}', '2015-12-14', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

CREATE TABLE `merchant` (
  `m_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `stripe_cust_id` varchar(255) DEFAULT NULL,
  `business_name` varchar(100) DEFAULT NULL,
  `physical_street` varchar(100) DEFAULT NULL,
  `physical_city` varchar(100) DEFAULT NULL,
  `physical_state` varchar(255) DEFAULT NULL,
  `physical_zip_code` int(10) DEFAULT NULL,
  `same_as_physical` int(1) DEFAULT NULL,
  `billing_street` varchar(100) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_state` varchar(50) DEFAULT NULL,
  `billing_zip_code` int(10) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `fax` bigint(15) DEFAULT NULL,
  `merchant_des` text,
  `federal_tax_id` varchar(255) DEFAULT NULL,
  `is_pverified` int(1) DEFAULT NULL,
  `payment_frequency` int(11) DEFAULT NULL,
  `payment_mode` varchar(50) DEFAULT NULL,
  `wire_details` text,
  `created_on` datetime DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`m_id`, `username`, `password`, `stripe_cust_id`, `business_name`, `physical_street`, `physical_city`, `physical_state`, `physical_zip_code`, `same_as_physical`, `billing_street`, `billing_city`, `billing_state`, `billing_zip_code`, `phone`, `fax`, `merchant_des`, `federal_tax_id`, `is_pverified`, `payment_frequency`, `payment_mode`, `wire_details`, `created_on`, `last_updated`, `last_login`, `ip`) VALUES
(1, 'paparomeo@mail.com', '3B1VHd1kyXS6r3i0vHCkUApWQ3LlYelLvbjq8tp9Th6pBXzdjl6c8e+3sT90O3QTWx/iHNdEOPtR7fVPicccuA==', NULL, 'Pappa Romeo''s Pizza', '6730 N Clark St, Chicago', 'Chicago', 'IL', 60606, 0, '', '', '', 0, '17732749898', 0, 'Simple pizzeria with a few tables but mostly take-out orders offering eats late into the night', '102315', 1, 15, 'Cash', '', '2016-01-01 11:10:48', NULL, NULL, NULL),
(2, 'fireplace@mail.com', 'YQqveZ3+/5v2M8nntCFRz/9zjX4VKQ8iaW4s1UNd604Wpt1ns9/YAJaFWt06UFhHFRfK7jSrUYxRKbtfBYQ+Yg==', NULL, 'The Fireplace Inn', '"1448 N Wells St', 'Chicago', 'IL', 60611, 0, '', '', '', 0, '13126645264', 13126645264, 'Tavern serving BBQ ribs, American fare & oversized vodka-lemonades in a cozy space with a fireplace', '564465', 1, 15, 'Cash', '', '2016-01-01 11:55:15', NULL, NULL, NULL),
(3, 'chopstick@mail.com', 'xVfpND33FSISGfx6jTLgrtPwt+glUhVZ9YNPGIufatx8mchDxv5jvqI3Avw9CWcSVSascajF4az5uXaxozM1ig==', NULL, 'Chopstick Asian Cuisine', '91-28 Corona Ave, Queens', 'New York City', 'NY', 10012, 0, '', '', '', 0, '17186990866', 123123121231, 'Chinese specialities plus sashimi & speciality rolls are served in a sedate setting with warm woods.', '126546546', 1, 15, 'Cash', '', '2016-01-01 12:25:48', NULL, NULL, NULL),
(4, 'crokandwines@mail.com', 'CQUDT75QCwkOXg5uRaRO7YjNwrQW3PvxYfdSvLNAyMy0e2lhla8zmOBtv6LBvqw4qe9rydiuho7sDgto8+/Wtg==', NULL, 'Cork Wines & Spirits', '383 1st Avenue', 'New York City', 'NY', 10010, 0, '', '', '', 0, '12126733600', 12126733600, 'Sleek, minimalist shop with a wide selection of wines & liquors, walk-in refrigerator & tastings', '3514521', 1, 15, 'Cash', '', '2016-01-01 13:33:08', NULL, NULL, NULL),
(5, 'hwmarket@mail.com', 'LRL9yx4J4lHrAwDB3XWdjRsKrN/mxcLors0zv7tBBhttKj5l+qR9xeQOTka9dxyN7okx04loXBSlatipuvdnCQ==', NULL, 'H & W Market', '801 Hayes St', 'San Francisco', 'CA', 94102, 0, '', '', '', 0, '14154318032', 14154318031, '', '54654544', 1, 15, 'Cash', '', '2016-01-01 13:54:26', NULL, NULL, NULL),
(6, 'sudzee@mail.com', 'MoDYpl4imPinCNJ0VqbLjJCodmuXDmg/2gL1IqOjJMrLCeNgKvoz9AbHJDropQ+55ZkRAF4l165JdMyjbORFFw==', NULL, 'Sudzee', '1901 McAllister St', 'San Francisco', 'CA', 94111, 0, '', '', '', 0, '14159978393', 14159978393, '', '25454', 1, 15, 'Cash', '', '2016-01-01 14:24:53', NULL, NULL, NULL),
(7, 'modernliquors@mail.com', 'FkyS4X+cLv9DboWHrTfZ6+SlIFYmuO735piY5WxkI9pWiflYcgLbKyfGwpsfQvqsGPsbqQpNVN4DRgpluDRb8A==', NULL, 'Modern Liquors', '1200 9th St NW,', 'Arlington', 'VA', 22103, 0, '', '', '', 0, '12022891414', 0, '', '544564541', 1, 15, 'Cash', '', '2016-01-04 06:00:11', NULL, NULL, NULL),
(8, 'indianprem@mail.com', '2nosfX92pWfAMxf65SjHqhgCq6GXwVUO040aCBOGAUl/aP/KwKvYso5Uxl07T1E/0UkSgdgANdBq5YLNpMQxvQ==', NULL, 'Indian Prem', '255 E Flagler St # 71', 'Miami', 'FL', 33111, 0, '255 E Flagler St # 71', 'Miami', 'FL', 0, '13053717736', 13053717736, '', '6548645', 1, 15, 'Cash', '', '2016-01-04 07:49:24', NULL, '2016-02-22 11:18:42', '192.168.2.5'),
(9, 'cleanersclubUSA@mail.com', 'fweneF6v+y0bWInN/nqWySzAFU3nKpuGn+J9jJwGvxhGc8DXRHcN/h6Y68BtkXjkRpOrNaD9ED10FmQol4q9xw==', NULL, 'Cleaners Club USA', '20610 Biscayne Blvd', 'Miami', 'FL', 33115, 0, '', '', '', 0, '13059350202', 13059350202, '', '645645', 1, 15, 'Cash', '', '2016-01-04 11:12:44', NULL, NULL, NULL),
(10, 'isushicafe@mail.com', 'AvQB0x9HMVVX3tsB9itDSSHdX1gX88FcS5e/cAToXkjTwUX5Yzyj3v5Dq3qLXmSD8M06NR2VlXFzo2p+pg+Taw==', NULL, 'Isushi Cafe', '3301 NE 1st Ave #107', 'Miami', 'FL', 33110, 0, '', '', '', 0, '13055488751', 13055488751, 'miamiisushicafe.com', '5464512', 1, 15, 'Cash', '', '2016-01-04 12:21:45', NULL, NULL, NULL),
(11, 'pauliepizza@mail.com', 'oraEZs1gJU5jFGE2zOWXMVEg3ghNZ+qMVoAwdNMs1Ra1n9xgaHHMVmS2NRjAIyg5XFIQIxo3VW11DJ1++dLSgA==', NULL, 'Paulie''s Pizza', '31 S 11TH ST', 'Philadelphia', 'PA', 19107, 0, '', '', '', 0, '12155924715', 12155924715, 'A mix of Italian & American food is offered by this pizzeria, ranging from burgers to pasta dishes.', '52123132', 1, 15, 'Cash', '', '2016-01-05 06:45:07', NULL, '2016-02-22 11:14:38', '192.168.2.5');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_contact`
--

CREATE TABLE `merchant_contact` (
  `mc_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `is_owner` tinyint(1) DEFAULT NULL,
  `is_manager` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merchant_contact`
--

INSERT INTO `merchant_contact` (`mc_id`, `m_id`, `first_name`, `last_name`, `mobile`, `email`, `is_owner`, `is_manager`) VALUES
(10, 11, '', '', 0, '', NULL, NULL),
(18, 10, '', '', 0, '', NULL, NULL),
(19, 9, '', '', 0, '', NULL, NULL),
(20, 8, '', '', 0, '', NULL, NULL),
(21, 7, '', '', 0, '', NULL, NULL),
(22, 6, '', '', 0, '', NULL, NULL),
(23, 5, '', '', 0, '', NULL, NULL),
(24, 4, '', '', 0, '', NULL, NULL),
(25, 3, '', '', 0, '', NULL, NULL),
(26, 2, '', '', 0, '', NULL, NULL),
(27, 1, '', '', 0, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `merchant_type`
--

CREATE TABLE `merchant_type` (
  `mt_id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `category_image_url` varchar(255) DEFAULT NULL,
  `type_banner_image` varchar(255) DEFAULT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merchant_type`
--

INSERT INTO `merchant_type` (`mt_id`, `type`, `category_image_url`, `type_banner_image`, `created_on`) VALUES
(1, 'food', 'Category_food_image_hp1.png', 'b151e80d_b_1920x3001.jpg', '2015-09-25'),
(2, 'grocery', 'Category_groceries_image_hp1.png', 'b151e80d_b_1920x3001.jpg', '2015-09-25'),
(3, 'liquor', 'Category_alcohol_image_hp1.png', 'b151e80d_b_1920x3001.jpg', '2015-09-25'),
(4, 'cleaner', 'Category_laundry_image_hp3.png', 'b151e80d_b_1920x3001.jpg', '2015-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_wallet`
--

CREATE TABLE `merchant_wallet` (
  `mw_id` int(11) NOT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `merchant_balance` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `merchant_wallet_history`
--

CREATE TABLE `merchant_wallet_history` (
  `mwh_id` int(11) NOT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `transaction_type` varchar(10) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `main_order` int(11) DEFAULT NULL,
  `sub_order_id` int(11) DEFAULT NULL,
  `description` varchar(100) NOT NULL,
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL,
  `invoice_no` int(11) DEFAULT NULL,
  `invoice_prefix` varchar(255) DEFAULT NULL,
  `order_status` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `delivery_option` varchar(255) DEFAULT NULL,
  `delivery_or_pic_datetime` datetime DEFAULT NULL,
  `special_inst` text,
  `tip_amount` double(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `total_amt` double(10,2) DEFAULT NULL,
  `payment_status` int(1) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `payment_address` varchar(100) DEFAULT NULL,
  `payment_apt_name` varchar(50) DEFAULT NULL,
  `payment_city` varchar(50) DEFAULT NULL,
  `payment_state` varchar(20) DEFAULT NULL,
  `payment_zip` int(10) DEFAULT NULL,
  `shipping_address` varchar(100) DEFAULT NULL,
  `shipping_apt_name` varchar(50) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(20) DEFAULT NULL,
  `shipping_zip` int(10) DEFAULT NULL,
  `read_by_merchant` int(1) DEFAULT NULL,
  `created_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_histroy`
--

CREATE TABLE `order_histroy` (
  `oh_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `sub_order_id` int(11) DEFAULT NULL,
  `order_status` int(11) NOT NULL,
  `comment` text,
  `customer_notify` int(1) DEFAULT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `oi_id` int(11) UNSIGNED NOT NULL,
  `o_id` int(11) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `pro_quantity` int(11) DEFAULT NULL,
  `special_inst` varchar(255) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_item_option`
--

CREATE TABLE `order_item_option` (
  `item_option_id` int(11) NOT NULL,
  `order_item_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `option_name` varchar(255) DEFAULT NULL,
  `option_value` varchar(255) DEFAULT NULL,
  `option_id` int(11) NOT NULL,
  `option_value_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_rating`
--

CREATE TABLE `order_rating` (
  `st_id` int(11) NOT NULL,
  `sto_id` int(11) DEFAULT NULL,
  `rating_star` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `setasfav` int(1) DEFAULT NULL,
  `on_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `name`) VALUES
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Complete'),
(6, 'Canceled Reversal'),
(5, 'Canceled'),
(1, 'Pending'),
(7, 'Failed'),
(8, 'Refunded'),
(9, 'Reversed'),
(10, 'Chargeback'),
(11, 'Expired'),
(12, 'Processed'),
(13, 'Voided');

-- --------------------------------------------------------

--
-- Table structure for table `order_store`
--

CREATE TABLE `order_store` (
  `so_id` int(11) NOT NULL,
  `o_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `store_name` varchar(250) DEFAULT NULL,
  `delivery_option` varchar(50) DEFAULT NULL,
  `order_status_id` int(11) NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `pickup_datetime` datetime DEFAULT NULL,
  `delivery_date_time` datetime NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `tip` decimal(10,2) DEFAULT NULL,
  `tip_in_currancy` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `date_added` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `p_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `content` text NOT NULL,
  `show_on_footer` int(1) DEFAULT NULL,
  `unique_alias` varchar(255) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`p_id`, `title`, `meta_keywords`, `meta_description`, `content`, `show_on_footer`, `unique_alias`, `created_on`) VALUES
(2, 'disclaimer', 'Est consectetur consequatur, pariatur? Maxime exercitation sunt, odio harum sed praesentium aspernatur obcaecati accusantium enim veniam, nulla labore in.', 'Est consectetur consequatur, pariatur? Maxime exercitation sunt, odio harum sed praesentium aspernatur obcaecati accusantium enim veniam, nulla labore in.', '<p>Est consectetur consequatur, pariatur? Maxime exercitation sunt, odio harum sed praesentium aspernatur obcaecati accusantium enim veniam, nulla labore in.Est consectetur consequatur, pariatur? Maxime exercitation sunt, odio harum sed praesentium aspernatur obcaecati accusantium enim veniam, nulla labore in.Est consectetur consequatur, pariatur? Maxime exercitation sunt, odio harum sed praesentium aspernatur obcaecati accusantium enim veniam, nulla labore in.Est consectetur consequatur, pariatur? Maxime exercitation sunt, odio harum sed praesentium aspernatur obcaecati accusantium enim veniam, nulla labore in.Est consectetur consequatur, pariatur? Maxime exercitation sunt, odio harum sed praesentium aspernatur obcaecati accusantium enim veniam, nulla labore in.</p>\r\n', 1, 'disclaimer', '2015-12-01 07:56:12');
INSERT INTO `page` (`p_id`, `title`, `meta_keywords`, `meta_description`, `content`, `show_on_footer`, `unique_alias`, `created_on`) VALUES
(4, 'privacy policy', 'In ea pariatur. Fugiat voluptas officia ut dolores aut voluptatem quisquam quaerat nostrum odit.', 'Quo dolores laborum. Veritatis incidunt, deserunt dolores excepteur consequatur? Blanditiis lorem eius rerum voluptates omnis aut iste exercitationem eu.', '<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n\r\n<div class="jqDnR" id="idTextPanel">\r\n<p style="text-align:left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifen', 1, 'privacy-policy', '2015-12-01 08:20:36');
INSERT INTO `page` (`p_id`, `title`, `meta_keywords`, `meta_description`, `content`, `show_on_footer`, `unique_alias`, `created_on`) VALUES
(5, 'terms of use', 'Excepturi vel rem omnis rerum ut qui vel libero labore cupiditate ut ex iste non enim cupidatat cupiditate.', 'Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.', '<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.Dolor ad dolorem cumque voluptas nostrum voluptatem, est, alias enim quia ab quidem est.</p>\r\n\r\n<p>&nbsp;</p>\r\n', NULL, 'terms-of-use', '2015-12-29 10:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `paypal_transaction_history`
--

CREATE TABLE `paypal_transaction_history` (
  `t_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `parent_transaction_id` varchar(255) DEFAULT NULL,
  `note` text,
  `msgsubid` varchar(255) DEFAULT NULL,
  `receipt_id` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `pending_reason` text,
  `transaction_entity` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `debug_data` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `small_desc` varchar(100) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `is_popular` int(1) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `start_time` date DEFAULT NULL,
  `end_time` date DEFAULT NULL,
  `added_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `merchant_id`, `store_id`, `product_name`, `small_desc`, `price`, `status`, `is_popular`, `discount`, `start_time`, `end_time`, `added_on`) VALUES
(1, 1, 1, 'Cheese Bread', 'Our Famous Chicago Style cheesy bread, piled high with the best cheese in town! Comes with a side of', 6.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 15:45:22'),
(8, 1, 1, 'Beer-Battered Fries', '', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 15:46:24'),
(9, 1, 1, 'Coleslaw', 'Our creamy coleslaw is perfect on its own or choose, with our barbecue or seafood dinners.', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 15:46:47'),
(10, 1, 1, 'Twisty Breadsticks', 'Eight pieces of our signature twisty bread-sticks - warm and soft inside with a delicate crisp crust', 3.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 15:47:13'),
(11, 1, 1, 'Garlic Bread', 'A half foot of our mouthwatering garlic bread.', 1.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 15:47:59'),
(12, 1, 1, 'Caesar Salad', 'Our Caesar conquers all other salads! Romaine lettuce, shredded red cabbage, carrots, cucumbers, cro', 5.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:01:42'),
(13, 1, 1, 'The Juliet Salad', 'Our signature namesake salad. Crisp Romaine lettuce, shredded red cabbage, carrots, almonds, raisins', 6.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:02:05'),
(14, 1, 1, 'Garden Salad', 'Fresh tomatoes and cucumbers, black olives and croutons over a bed of crisp Romaine lettuce.', 5.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:02:37'),
(15, 1, 1, 'Asian Sesame Salad', 'It may not be Italian, but it''s still good! Romaine lettuce, crunchy chow mein noodles, carrots, alm', 6.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:03:03'),
(16, 1, 1, 'House Salad', 'Fresh tomatoes, cucumbers, black olives and croutons over a bed of crispy Romaine lettuce.', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:03:36'),
(17, 1, 1, 'Buffalo Wings', 'Choice of plain, barbecue, hot, or Italian spice. Served with crisp celery sticks and bleu cheese.', 4.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:12:58'),
(18, 1, 1, 'Boneless Chicken Bites', 'Breaded all white meat chicken served with your choice of one sauce.', 10.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:13:23'),
(19, 2, 2, 'Chicken Tenders', 'Served deep-fried, grilled or buffalo style, served with your choice of BBQ sauce or honey mustard.', 8.50, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:32:18'),
(21, 2, 2, 'Chicken Wings', 'Served either BBQ''d, hot and spicy or Thai chili style.', 8.50, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:32:52'),
(22, 2, 2, 'BBQ Pizza', '7" pizza served with our pulled pork or grilled chicken breast, peppers, onions, cheddar and montere', 8.50, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:33:16'),
(23, 2, 2, 'Our Famous BBQ Baby Back Ribs', '', 8.50, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:33:37'),
(24, 2, 2, 'BBQ Meatballs', '', 6.50, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:33:58'),
(25, 2, 2, 'Potato Skins', 'Topped with cheddar cheese, bacon crumbles and green onion.', 6.50, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:34:25'),
(26, 2, 2, 'Baked Onion Soup', 'Served with a parmesan crouton and topped with your choice of gruyere or mozzarella cheese.', 6.50, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:46:29'),
(27, 2, 2, 'Spicy Tortilla Soup Bowl', '', 5.50, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:46:48'),
(28, 2, 2, 'Chicken Noodle Soup', '', 3.00, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:47:13'),
(29, 2, 2, 'F.P.I. Signature Salad', 'Romaine lettuce tossed with our house dressing, topped with blue cheese and seasoned croutons.', 9.50, 1, NULL, NULL, NULL, NULL, '2016-01-01 16:47:45'),
(31, 3, 3, 'C4. Chicken Wings (4)', '', 4.75, 1, NULL, '0.00', '1970-01-01', '1970-01-01', '2016-01-01 17:28:03'),
(32, 3, 3, 'C5. Steamed Dumplings (8)', '', 4.50, 1, NULL, NULL, NULL, NULL, '2016-01-01 17:29:38'),
(33, 3, 3, 'C5. Fried Dumplings (8)', '', 4.50, 1, NULL, NULL, NULL, NULL, '2016-01-01 17:29:58'),
(34, 3, 3, 'C6. French Fries', '', 3.00, 1, NULL, NULL, NULL, NULL, '2016-01-01 17:30:21'),
(35, 3, 3, 'C3. Hot and Sour Soup', '', 2.75, 1, NULL, NULL, NULL, NULL, '2016-01-01 17:30:41'),
(36, 3, 3, 'T3. Fried Calamari', 'Deep fried, breaded calamari Thai style.', 6.50, 1, NULL, NULL, NULL, NULL, '2016-01-01 17:32:05'),
(37, 3, 3, 'T1. Tom Yum Goong', 'Thai spicy and sour soup with shrimp, lemongrass, mushroom, pepper and lime juice. Hot and Spicy!', 4.00, 1, NULL, NULL, NULL, NULL, '2016-01-01 17:32:34'),
(38, 3, 3, 'T2. Coconut Soup', 'Spicy Thai coconut soup with chicken, mushroom, lime juice and galangal.', 4.00, 1, NULL, NULL, NULL, NULL, '2016-01-01 17:33:01'),
(39, 3, 3, 'T8. Thai Large Shrimp Fried Rice', '', 11.00, 1, NULL, NULL, NULL, NULL, '2016-01-01 17:33:51'),
(40, 3, 3, 'T10. Thai Beef Fried Rice', '', 11.00, 1, NULL, NULL, NULL, NULL, '2016-01-01 17:34:08'),
(41, 3, 3, 'T9. Thai Chicken Fried Rice', '', 10.00, 1, NULL, NULL, NULL, NULL, '2016-01-01 17:34:25'),
(42, 3, 3, 'T7. Vegetable Fried Rice', '', 9.00, 1, NULL, NULL, NULL, NULL, '2016-01-01 17:34:39'),
(43, 3, 3, 'T12. Kwyatio Thai Dinner Special', 'Fresh noodles stir-fried with vegetables and lime leaf. Hot and spicy.', 10.50, 1, NULL, NULL, NULL, NULL, '2016-01-01 17:35:16'),
(44, 3, 3, 'T13. Phad See Yu Thai Dinner Special', 'Thai country style stir-fried broad noodles with Chinese broccoli.', 10.50, 1, NULL, NULL, NULL, NULL, '2016-01-01 17:35:42'),
(45, 3, 3, 'T11. Pad Thai Dinner Special', 'Stir-fried Thai noodle with egg, bean sprouts, dry tofu and topped with ground peanuts. Hot and spic', 10.00, 1, NULL, NULL, NULL, NULL, '2016-01-01 17:36:19'),
(46, 4, 4, 'Aperol Aperitivo (750ml)', '', 24.19, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:08:36'),
(47, 4, 4, 'Averna Amaro (1L)', '', 38.49, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:08:54'),
(48, 4, 4, 'Campari Aperitif (1L)', '', 38.49, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:09:11'),
(49, 4, 4, 'Carpano Punt e Mes (750ml)', '', 21.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:09:25'),
(50, 4, 4, 'Nonino Quintessentia Amaro (750ml)', '', 49.49, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:09:41'),
(51, 4, 4, 'Pernod Anise 80 Proof (750ml)', '', 38.49, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:09:59'),
(52, 4, 4, 'Pimms (750ml)', '', 27.49, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:10:16'),
(53, 4, 4, 'Dartigalongue 15Yr Armagnac (750ml)', '', 76.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:10:54'),
(54, 4, 4, 'Delord 25Yr Armagnac (750ml)', '', 79.19, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:11:12'),
(55, 4, 4, 'Larresingle VSOP Armagnac (750ml)	', '', 51.69, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:11:32'),
(56, 4, 4, 'Napoleon Bas Armagnac (750ml)', '', 38.49, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:11:46'),
(57, 4, 4, 'The Bitter Truth Aromatic Bitters (200ml)', '', 17.59, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:12:24'),
(58, 4, 4, 'The Bitter Truth Grapefruit Bitters (200ml)', '', 17.59, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:12:39'),
(59, 4, 4, 'The Bitter Truth Orange Bitters (200ml)', '', 17.59, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:12:50'),
(60, 4, 4, 'The Bitter Truth Sample Set (50ml)', '', 21.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:13:03'),
(61, 4, 4, 'Billecart-Salmon Brut Rose (750ml)', '', 84.69, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:14:53'),
(62, 4, 4, 'Canard-Duchene Brut (750ml)', '', 38.49, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:15:09'),
(63, 4, 4, 'Deutz Classic Brut (750ml)', '', 54.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:15:27'),
(64, 4, 4, 'Krug Grande Cuvee Brut (375ml)', '', 76.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:15:45'),
(65, 4, 4, 'Taittinger Prestige Rose (750ml)', '', 65.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:16:02'),
(66, 5, 5, 'Bagel with Cream Cheese', '', 2.45, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:30:44'),
(67, 5, 5, 'Bagel with Cream Cheese and Tomato', '', 3.25, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:31:03'),
(68, 5, 5, 'Bagel with Cream Cheese and Salmon', '', 5.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:31:26'),
(70, 5, 5, 'Bagel with Cream Cheese and Jelly', '', 3.25, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:31:50'),
(71, 5, 5, 'Charlie Hustle', 'Turkey, Pepperjack cheese, pesto, mayo, tomato, lettuce, pickles, Dutch Crunch bread.', 7.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:33:14'),
(72, 5, 5, 'Killa''s-que', 'Roast beef, BBQ sauce, Cheddar cheese, onion, jalapeno, sour dough bread.', 7.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:33:38'),
(73, 5, 5, 'C Note Special', 'Turkey, salami, Pepperjack cheese, lettuce, tomato, onion, pickles, jalapenos, mayo and mustard. Ser', 7.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:33:59'),
(74, 5, 5, 'Abe''s Screamer', '', 7.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:38:54'),
(75, 5, 5, 'Hot Coffee', '', 1.45, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:39:46'),
(78, 5, 5, 'Hot Tea', '', 1.45, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:40:43'),
(79, 5, 5, 'Vivaloe Coconut Aloe (16.9 fl oz)', '', 1.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:41:50'),
(80, 5, 5, 'Vivaloe Honeydew Aloe (16.9 fl oz)', '', 1.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:42:08'),
(81, 5, 5, 'Vivaloe Original Aloe (16.9 fl oz)', '', 1.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:42:33'),
(82, 5, 5, 'Vivaloe Watermelon Aloe (16.9 fl oz)	', '', 1.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:42:46'),
(83, 5, 5, 'Monster Energy Drink, Regular (16 fl oz)', '', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:43:06'),
(84, 5, 5, 'Monster Lo-Carb Energy Drink (16 fl oz)', '', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:43:21'),
(85, 5, 5, 'Vitamin Water Focus Kiwi Strawberry (20 fl oz Bottle)', '', 1.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:43:37'),
(86, 5, 5, 'Vitamin Water Revive Fruit Punch (20 fl oz Bottle)', '', 1.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:43:53'),
(87, 5, 5, 'Minute Maid Fruit Punch (2 Liter Bottle)', '', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:44:09'),
(88, 5, 5, 'Minute Maid Pink Lemonade (20 fl oz Bottle)', '', 1.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:44:22'),
(89, 5, 5, 'Tazo Brambleberry (13.8 fl oz)', '', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:45:16'),
(90, 5, 5, 'Tazo Giant Peach (13.8 fl oz)', '', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:45:33'),
(91, 5, 5, 'Tazo Iced Black Tea (13.8 fl oz)', '', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-01 18:45:47'),
(92, 6, 6, 'Wash Fold &', '', 2.22, 1, NULL, '0.00', '1970-01-01', '1970-01-01', '2016-01-01 19:00:33'),
(93, 7, 7, 'Amstel Light 12pk (12oz Bottles)', '', 15.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:35:05'),
(94, 7, 7, 'Anchor Steam 6pk (12oz Bottles)', '', 10.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:35:23'),
(95, 7, 7, 'Budweiser 6pk (12oz Bottles)', '', 6.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:35:36'),
(96, 7, 7, 'Coors Light 12pk (12oz Cans)', '', 11.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:35:53'),
(97, 7, 7, 'Corona Extra 6pk (12oz Bottles)', '', 8.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:36:08'),
(98, 7, 7, 'Dos Equis Lager 6pk (12oz Bottles)', '', 7.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:36:25'),
(99, 7, 7, 'Sierra Nevada Torpedo IPA 6pk (12oz Bottles)', '', 10.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:36:40'),
(100, 7, 7, 'Stella Artois 6pk (12oz Bottles)', '', 9.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:36:53'),
(101, 7, 7, 'Bailey''s Irish Cream (750ml)', '', 24.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:37:27'),
(102, 7, 7, 'Drambuie (750ml)', '', 41.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:37:42'),
(103, 7, 7, 'Fernet Branca (750ml)', '', 32.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:38:05'),
(104, 7, 7, 'Frangelico (750ml)', '', 29.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:38:20'),
(105, 7, 7, 'Godiva Chocolate (750ml)', '', 30.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:38:37'),
(106, 7, 7, 'Goldschlager (750ml)', '', 31.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:38:53'),
(107, 7, 7, 'Grand Marnier Orange Liqueur (750ml)', '', 39.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:39:18'),
(108, 7, 7, 'Jagermeister (750ml)', '', 25.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:39:32'),
(109, 7, 7, 'Martini & Rossi Sweet Vermouth (750ml)', '', 9.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:39:47'),
(110, 7, 7, 'E & J (750ml)', '', 11.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:40:29'),
(111, 7, 7, 'Hennessy Privilege VSOP (750ml)', '', 59.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:40:45'),
(112, 7, 7, 'Hennessy VS (750ml)', '', 33.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:41:02'),
(113, 7, 7, 'Remy Martin Petit VS (750ml)', '', 35.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:41:18'),
(114, 7, 7, 'Remy Martin VSOP (750ml)', '', 46.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:41:32'),
(115, 7, 7, 'Beefeater Gin (750ml)', '', 18.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:42:12'),
(116, 7, 7, 'Bombay Gin 86 Proof (750ml)', '', 18.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:42:34'),
(117, 7, 7, 'Bombay Sapphire Gin (750ml)', '', 23.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:42:49'),
(118, 7, 7, 'Hendrick''s Gin 88 Proof (750ml)', '', 42.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:43:05'),
(119, 7, 7, 'Cup Cake Prosecco (750ml)', 'California', 9.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:45:59'),
(120, 7, 7, 'F Rockefeller Champagne (750ml)', 'France', 46.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:46:21'),
(121, 7, 7, 'Francois Montand Brut (750ml)', '', 14.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:46:45'),
(122, 7, 7, 'Laurent Perrier Brut (750ml)', 'France', 47.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:47:08'),
(123, 7, 7, 'Louis de Sacy Brut (750ml)', '', 38.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:47:28'),
(124, 7, 7, 'Moet Chandon Imperial Brut (750ml)', '', 55.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:47:49'),
(125, 7, 7, 'A to Z Chardonnay (750ml)', '', 17.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:48:19'),
(126, 7, 7, 'Box Head Chardonnay (750ml)', '', 15.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:48:35'),
(127, 7, 7, 'Chasewater Chardonnay (750ml)', '', 17.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:48:52'),
(128, 7, 7, 'Chimney Creek Sauvignon Blanc (750ml)', '', 10.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:49:09'),
(129, 7, 7, 'Dr Konstantin Frank Riesling Dry (750ml)', '', 19.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:49:26'),
(130, 7, 7, '1919 Malbec (750ml)', '', 11.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:49:47'),
(131, 7, 7, 'A to Z Pinot Noir (750ml)', '', 20.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:50:02'),
(132, 7, 7, 'Alexander Valley Vinyards Cabernet Sauvignon (750ml)', '', 21.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:50:18'),
(133, 7, 7, 'Arrowood Cabernet Sauvignon (750ml)', '', 26.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:50:35'),
(134, 7, 7, 'Banard Griffin Cabernet Sauvignon (750ml)', '', 19.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:51:09'),
(135, 7, 7, 'Hybrid Pinot Noir (750ml)', '', 10.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 10:51:30'),
(136, 8, 8, 'Snack Factory Pretzel Crisps', '', 2.50, 1, NULL, NULL, NULL, NULL, '2016-01-04 13:01:41'),
(137, 8, 8, 'Bonne Maman Fruit Spread Preserves - 13oz', '', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 13:02:54'),
(138, 8, 8, 'Coco Libre Organic Coconut Water - 1 Liter', '', 3.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 13:52:00'),
(139, 8, 8, 'Cookie Dough Cafe Gourmet Edible Cookie Dough - Pint', '', 6.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 13:52:20'),
(140, 8, 8, 'Orrington Farms Broth Base & Seasoning - 12oz', '', 3.69, 1, NULL, NULL, NULL, NULL, '2016-01-04 13:53:39'),
(141, 8, 8, 'Spectrum Coconut Oil - 16oz', 'Refined or unrefined.', 7.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 13:54:46'),
(142, 8, 8, 'Viki''s Granola - 12oz', '', 3.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 13:55:48'),
(143, 8, 8, 'Zico Coconut Water - 1-Liter', '', 5.69, 1, NULL, NULL, NULL, NULL, '2016-01-04 13:58:15'),
(144, 8, 8, 'Vita Coco Coconut Water with Pineapple - 16.9 oz', '', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 13:59:09'),
(145, 8, 8, 'Vita Coco Coconut Water with Tropical Fruit - 16.9 oz', '', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 13:59:28'),
(146, 8, 8, 'Vita Coco Coconut Water, Original - 33.8 oz', '', 5.69, 1, NULL, NULL, NULL, NULL, '2016-01-04 13:59:44'),
(147, 8, 8, 'Vita Coco Coconut Water with Peach & Mango - 16.9 oz', '', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 13:59:58'),
(148, 8, 8, 'Coco Libre Coconut Water - 1 Liter', '', 3.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:00:11'),
(149, 8, 8, 'McClure''s Bloody Mary Mixer - 32 oz', '', 8.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:00:45'),
(150, 8, 8, 'Lord Danley''s Bloody Mary Mix - 25.4oz', '', 7.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:01:02'),
(151, 8, 8, 'American Juice Company Cocktail Blend Blueberry Finn - 16oz', '', 11.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:01:17'),
(152, 8, 8, 'American Juice Company Cocktail Blend Ginger Gershwin - 16oz', '', 11.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:01:33'),
(153, 8, 8, 'Gatorade Fruit Punch - 32oz', '', 2.09, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:02:15'),
(154, 8, 8, 'Gatorade Orange - 32oz', '', 2.09, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:02:32'),
(155, 8, 8, 'Gatorade Cool Blue - 32oz', '', 2.09, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:02:59'),
(156, 8, 8, 'Gatorade Orange- 20oz', '', 1.50, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:03:17'),
(157, 8, 8, 'Vitamin Water Power-C - 20oz', '', 1.50, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:03:37'),
(158, 8, 8, '21st Amendment Bitter American Session Ale - 6 Pack', '', 12.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:05:17'),
(159, 8, 8, 'Brooklyn IPA - 6 Pack', '', 11.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:05:31'),
(160, 8, 8, 'Goose Island IPA - 6 Pack', '', 11.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:05:47'),
(161, 8, 8, 'Guinness Extra Stout - 6 Pack', '', 11.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:06:03'),
(162, 8, 8, 'Miller High Life Beer - 6 Pack', '', 7.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:06:19'),
(163, 8, 8, 'Califia Farms Vanilla Protein Almond Milk -10.5oz', '', 3.29, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:07:11'),
(164, 8, 8, 'Califia Farms Cocoa Noir Iced Coffee - 10.5oz', '', 3.29, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:07:32'),
(165, 8, 8, 'Califia Farms Salted Caramel Iced Coffee - 10.5oz', '', 3.29, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:07:50'),
(166, 8, 8, 'Grady''s Cold Brew Iced Coffee Concentrate - 16oz', '', 6.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:08:06'),
(167, 8, 8, 'Starbuck''s Breakfast Blend Coffee - 12oz', '', 10.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:08:40'),
(168, 8, 8, 'Jims Organic Coffee Italian - 12oz', '', 13.89, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:09:39'),
(169, 8, 8, 'Starbuck''s Aria Blend Coffee - 12oz', '', 10.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:10:52'),
(170, 8, 8, 'Equal Exchange Coffee French Roast - 12oz', '', 9.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:11:40'),
(171, 8, 8, 'Harney & Sons African Autumn Tea - 1.4 oz', '', 5.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:13:24'),
(172, 8, 8, 'Tazo Organic Darjeeling - 1.6oz', '', 4.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:13:46'),
(173, 8, 8, 'Yogi Classic India Spice Tea Bags - 1.12oz', '', 3.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:14:00'),
(174, 8, 8, 'Yogi Woman''s Mother To Be Tea Bags - 1.12oz', '', 3.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:14:16'),
(175, 8, 8, 'Organic Firm Tofu - 14 oz', '', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:15:05'),
(176, 8, 8, 'Organic Extra Firm Tofu - 14 oz', '', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:15:21'),
(177, 8, 8, 'Horizon 1% Milk - 64oz', '', 5.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:15:50'),
(178, 8, 8, 'Horizon DHA Whole Milk - 64oz', '', 5.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:16:04'),
(179, 8, 8, 'Horizon Whole Milk - 64oz', '', 5.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:16:19'),
(180, 8, 8, 'Organic Valley Fat Free Milk - 64oz', '', 5.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:17:03'),
(181, 8, 8, 'Lactaid 100% Whole Milk - 64oz', '', 5.29, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:17:19'),
(182, 8, 8, 'Reddi Whip Cream - 6.5oz', '', 3.19, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:18:17'),
(183, 8, 8, 'Organic Valley Heavy Cream - 16oz', '', 4.59, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:18:35'),
(184, 8, 8, 'Tuscan Heavy Cream - 8oz', '', 2.29, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:18:53'),
(185, 8, 8, 'Organic Valley Half & Half - 16oz', '', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:19:10'),
(186, 8, 8, 'Tuscan Half & Half - 32oz', '', 3.49, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:19:28'),
(187, 8, 8, 'Coffee Mate French Vanilla Creamer - 16oz', '', 2.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:19:47'),
(188, 8, 8, 'Nature Yoke Large Organic Eggs - 1 Dozen', '', 5.49, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:21:04'),
(189, 8, 8, 'Nature Yoke Organic Brown Eggs - 1/2 Dozen', '', 3.19, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:21:19'),
(190, 8, 8, 'Nature Yoke Jumbo Cage Free Eggs - 1 Dozen', '', 4.29, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:21:45'),
(191, 8, 8, 'Beet Me Up', 'Beets, apple, carrot, lemon, ginger.', 4.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:38:23'),
(192, 8, 8, 'Flu Buster', 'Kale, lemon, garlic, ginger, pear.', 4.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:38:53'),
(193, 8, 8, 'Flu Buster', '', 6.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:39:12'),
(194, 8, 8, 'Dr. Oz Special', 'Kale, lime, celery, cucumber, apple, ginger.', 4.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:40:14'),
(195, 8, 8, 'Dr. Oz Special', 'Kale, lime, celery, cucumber, apple, ginger.', 6.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:40:41'),
(196, 8, 8, 'Lundberg Brown Short Grain Rice - 32oz', '', 4.29, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:47:58'),
(197, 8, 8, 'Lundberg White Arborio Rice - 32oz', '', 8.09, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:48:26'),
(198, 8, 8, 'Lundberg Organic California Sushi Rice - 32oz', '', 7.49, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:48:38'),
(199, 8, 8, 'Lundberg California Brown Basmati Rice - 32oz', '', 5.19, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:48:53'),
(200, 8, 8, 'Lundberg Organic Brown Long Grain Rice - 32oz', '', 5.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:49:18'),
(201, 8, 8, 'Ancient Harvest Quinoa Organic Red - 12oz', '', 8.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:50:33'),
(202, 8, 8, 'Bob''s Natural Pearl Couscous - 16oz', '', 4.29, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:52:29'),
(203, 8, 8, 'Shiloh Farms Red Organic Quinoa- 16 oz', '', 10.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:52:47'),
(204, 8, 8, 'Annie Chuns Maifun Rice Noodles - 12oz', '', 6.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:53:24'),
(205, 8, 8, 'Annie Chuns Pad Thai Rice Noodles - 12oz', '', 6.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:53:40'),
(206, 8, 8, 'Annie Chuns Pad Thai Brown Rice Noodles - 12oz', '', 6.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:53:55'),
(207, 8, 8, 'Annie Chuns Soba Noodles - 12oz', '', 6.99, 1, NULL, NULL, NULL, NULL, '2016-01-04 14:54:10'),
(208, 9, 9, 'Wash & Fold (Per pound)', 'For the first 10 lbs, then $2.50 for each additional lb', 25.00, 1, NULL, '0.00', '1970-01-01', '1970-01-01', '2016-01-04 15:50:08'),
(209, 9, 9, 'Shirt', '', 2.25, 1, NULL, NULL, NULL, NULL, '2016-01-04 15:51:52'),
(210, 9, 9, 'Pants', '', 7.50, 1, NULL, NULL, NULL, NULL, '2016-01-04 15:53:46'),
(211, 9, 9, 'Blouse/Top', '', 7.50, 1, NULL, NULL, NULL, NULL, '2016-01-04 15:54:33'),
(212, 9, 9, 'Sweater', 'Waist-length garment that is lighter than a jacket and typically made of wool', 8.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 15:54:52'),
(213, 9, 9, 'Dress', '', 14.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 15:55:41'),
(214, 9, 9, 'Jacket', 'Waist-length garment that is heavier than a sweater and lighter than a coat', 7.50, 1, NULL, '0.00', '1970-01-01', '1970-01-01', '2016-01-04 15:56:37'),
(215, 9, 9, 'Suit', '', 15.00, 1, NULL, '0.00', '1970-01-01', '1970-01-01', '2016-01-04 16:00:20'),
(216, 9, 9, 'Skirt', '', 7.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:01:29'),
(217, 9, 9, 'Coat', '', 22.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:03:42'),
(219, 9, 9, 'Scarf', '', 8.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:05:29'),
(220, 9, 9, 'Tie', '', 3.50, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:05:45'),
(221, 9, 9, 'Comforter', '', 36.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:06:13'),
(222, 9, 9, 'Blanket', '', 25.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:06:26'),
(223, 9, 9, 'Pillow', '', 20.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:06:39'),
(224, 9, 9, 'Curtain', '', 25.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:06:51'),
(225, 9, 9, 'Duvet Cover', '', 25.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:07:08'),
(226, 9, 9, 'Pillow Case', '', 4.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:07:22'),
(227, 9, 9, 'Sheets', '', 15.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:07:36'),
(228, 9, 9, 'Hemming', '', 30.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:07:51'),
(229, 9, 9, 'Button', '', 2.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:09:14'),
(230, 9, 9, 'Patch', '', 8.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:09:28'),
(231, 9, 9, 'Zipper', '', 16.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:09:41'),
(232, 10, 10, 'Avocado', '', 1.50, 1, NULL, NULL, NULL, NULL, '2016-01-04 16:55:44'),
(233, 10, 10, 'Tamago', '', 0.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:00:17'),
(234, 10, 10, 'Ika', '', 2.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:01:23'),
(235, 10, 10, 'Inari', '', 1.50, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:02:07'),
(236, 10, 10, 'Shrimp', '', 2.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:03:03'),
(237, 10, 10, 'California Roll', '', 5.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:27:59'),
(238, 10, 10, 'California Roll with Tuna', '', 8.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:28:15'),
(239, 10, 10, 'California Roll with Salmon', '', 7.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:28:26'),
(240, 10, 10, 'Salmon C.C. Roll', '', 7.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:28:39'),
(241, 10, 10, 'Dancing Eel Roll', '', 9.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:28:52'),
(242, 10, 10, 'Rainbow Roll', 'California roll topped with assorted fish and shrimp.', 10.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:29:15'),
(243, 10, 10, 'Boston Roll', 'Shrimp, lettuce, avocado, and mayo Topped with shrimp.', 11.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:29:35'),
(244, 10, 10, 'LeBron James Roll', 'Fried crab and fish, shrimp temp, topped with w.fish, tuna, avocado, eel sauce, spicy mayo, tobiko a', 21.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:30:27'),
(245, 10, 10, 'Banana Tempura', '', 6.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:31:18'),
(246, 10, 10, 'Tempura Ice Cream', '', 6.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:31:54'),
(247, 10, 10, 'Mochi Ice Cream', 'All 3 flavors, strawberry, coffee and green tea.', 8.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:32:14'),
(248, 10, 10, 'Cheesecake Tempura', '', 6.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:32:30'),
(249, 10, 10, 'Green Tea Ice Cream', '', 6.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:32:48'),
(250, 10, 10, 'Can Soda', '', 2.00, 1, NULL, NULL, NULL, NULL, '2016-01-04 17:33:30'),
(251, 9, 11, 'Wash & Fold (Per pound)', 'please leave your clothes on the porch', 2.15, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:32:27'),
(252, 9, 11, 'Shirt', '', 2.91, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:33:48'),
(253, 9, 11, 'Pants', '', 6.81, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:35:35'),
(254, 9, 11, 'Blouse/Top', '', 6.48, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:36:09'),
(255, 9, 11, 'Sweater', 'Waist-length garment that is lighter than a jacket and typically made of wool', 7.57, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:36:30'),
(256, 9, 11, 'Dress', '', 10.06, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:37:25'),
(257, 9, 11, 'Jacket', 'Waist-length garment that is heavier than a sweater and lighter than a coat', 7.89, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:38:26'),
(258, 9, 11, 'Suit', '', 14.59, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:40:26'),
(259, 9, 11, 'Skirt', '', 6.81, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:41:50'),
(260, 9, 11, 'Comforter', '', 32.46, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:43:02'),
(261, 9, 11, 'Blanket', '', 21.64, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:43:15'),
(262, 9, 11, 'Duvet Cover', '', 32.46, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:43:28'),
(263, 9, 11, 'Pillow Case', '', 6.48, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:43:40'),
(264, 9, 11, 'Sheets', '', 10.81, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:43:54'),
(265, 9, 11, 'Hemming', '', 15.16, 1, NULL, '0.00', '1970-01-01', '1970-01-01', '2016-01-05 10:44:23'),
(266, 9, 11, 'Patch', '', 15.16, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:45:58'),
(267, 9, 11, 'Zipper', '', 23.82, 1, NULL, NULL, NULL, NULL, '2016-01-05 10:46:16'),
(268, 11, 12, 'Cheese Pizza (14 Inch)', '', 10.75, 1, NULL, NULL, NULL, NULL, '2016-01-05 11:19:13'),
(269, 11, 12, 'Cheese Pizza (16 Inch)', '', 11.50, 1, NULL, NULL, NULL, NULL, '2016-01-05 11:22:49'),
(270, 11, 12, 'Gluten Free Pizza (14 Inch)', '', 18.95, 1, NULL, NULL, NULL, NULL, '2016-01-05 11:24:38'),
(271, 11, 12, 'Broccoli & Sausage Gourmet Pizza', 'Sausage, broccoli, fresh garlic and Mozzarella cheese.', 0.00, 1, NULL, '0.00', '1970-01-01', '1970-01-01', '2016-01-05 11:28:14'),
(272, 11, 12, 'Paulie''s Special Gourmet Pizza', 'Pepperoni, sausage, mushroom, onion, green pepper, sauce and Mozzarella cheese.', 0.00, 1, NULL, '0.00', '1970-01-01', '1970-01-01', '2016-01-05 11:37:02'),
(273, 11, 12, 'Margherita Gourmet Pizza', 'Fresh Mozzarella cheese, sauce, oregano, basil and grated cheese. No meat.', 0.00, 1, NULL, '0.00', '1970-01-01', '1970-01-01', '2016-01-05 11:39:15'),
(274, 11, 12, 'Chicken Cutlet Hot Sandwich', 'With lettuce, tomato and mayo', 7.75, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:09:36'),
(275, 11, 12, 'Meatball Hot Sandwich', '', 7.25, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:10:42'),
(276, 11, 12, 'Meatball Parmigiana Hot Sandwich', 'Sauce and melted Mozzarella cheese.', 7.75, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:12:46'),
(277, 11, 12, 'Veal Parmigiana Hot Sandwich ', ' Sauce and melted Mozzarella cheese.', 8.25, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:13:44'),
(278, 11, 12, 'Eggplant Parmigiana Hot Sandwich ', 'Sauce and melted Mozzarella cheese. No meat.', 7.75, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:14:49'),
(279, 11, 12, 'Chicken Parmigiana Hot Sandwich ', ' Sauce and melted Mozzarella cheese.', 7.75, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:15:49'),
(280, 11, 12, 'Spaghetti Marinara ', 'No meat.', 6.99, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:17:49'),
(281, 11, 12, 'Stuffed Shells ', ' No meat.', 7.75, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:19:01'),
(282, 11, 12, 'Manicotti', '', 7.75, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:37:19'),
(286, 11, 12, 'Baked Penne Alfredo ', 'No meat.', 8.95, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:40:48'),
(287, 11, 12, 'Cheesecake (Plain)', '', 4.75, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:48:35'),
(288, 11, 12, 'Tiramisu', '', 4.75, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:49:22'),
(289, 11, 12, 'Cannoli', '', 3.75, 1, NULL, NULL, NULL, NULL, '2016-01-05 16:49:37');

-- --------------------------------------------------------

--
-- Table structure for table `product_option`
--

CREATE TABLE `product_option` (
  `option_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `option_name` varchar(255) DEFAULT NULL,
  `required` int(1) DEFAULT NULL,
  `multiple` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_option`
--

INSERT INTO `product_option` (`option_id`, `product_id`, `option_name`, `required`, `multiple`) VALUES
(1, 1, 'Pick One', 1, 1),
(2, 9, 'Coleslaw Preparation', 1, 1),
(3, 12, 'Choice of Dressing', 1, NULL),
(4, 12, 'Add Extra Dressing', NULL, NULL),
(5, 12, 'Add Extra Ingredient In Salad (Optional - Choose as many as you want)', NULL, NULL),
(6, 18, 'Pick One', 1, 1),
(7, 18, 'Choice of Sauce', 1, 1),
(8, 136, 'Choice of Pretzel Crisps', 1, 1),
(9, 137, 'Choice of Bonne Maman Preserves (Sale)', 1, 1),
(10, 139, 'Choice of Cookie Dough Cafe', 1, 1),
(11, 140, 'Choice of Orrington Farms', 1, 1),
(12, 141, 'Choice of Coconut Oil', 1, 1),
(13, 142, 'Choice of Viki''s Granola', 1, 1),
(14, 167, 'Choice of Coffee Preparation', 1, 1),
(15, 168, 'Choice of Coffee Preparation', 1, 1),
(16, 169, 'Choice of Coffee Preparation', 1, 1),
(17, 170, 'Choice of Coffee Preparation', 1, 1),
(18, 208, 'Extras', 1, 1),
(19, 209, 'Type', 1, 1),
(20, 210, 'Extras', 1, 1),
(21, 212, 'Extras', 1, 1),
(22, 213, 'Extras', 1, 1),
(23, 214, 'Type', 1, 1),
(24, 215, 'Type', 1, 1),
(25, 216, 'Extras', 1, 1),
(26, 217, 'Type', 1, 1),
(27, 228, 'Type', 1, 1),
(28, 231, 'Type', 1, 1),
(29, 232, 'Choice of Preparation ', 1, 1),
(30, 233, 'Choice of Preparation ', 1, 1),
(31, 234, 'Choice of Preparation', 1, 1),
(32, 235, 'Choice of Preparation', 1, 1),
(33, 236, 'Choice of Preparation', 1, 1),
(34, 250, 'Choice of Soda', 1, 1),
(35, 251, 'Extras', 1, 1),
(36, 252, 'Type', 1, 1),
(37, 253, 'Extras', 1, 1),
(38, 255, 'Extras', 1, 1),
(39, 256, 'Extras', 1, 1),
(40, 257, 'Type', 1, 1),
(41, 258, 'Type', 1, 1),
(42, 259, 'Extras', 1, 1),
(43, 265, 'Type', 1, NULL),
(44, 267, 'Type', 1, NULL),
(45, 268, 'Whole Pie Toppings (14 Inch)', 1, NULL),
(46, 269, 'Whole Pie Toppings (16 Inch) <br/>(Optional - Choose as many as you want)', 1, 1),
(47, 270, 'Add Half Toppings (Gluten Free)? <br/> (Optional)', NULL, NULL),
(48, 270, 'Whole Toppings Gluten Free Pizza <br/> (Optional - Choose as many as you want)', NULL, NULL),
(49, 271, 'Pick One <br/> (Required - Choose 1)', 1, NULL),
(50, 271, 'Choice of Pizza Sauce <br/> (Required - Choose 1)', 1, NULL),
(51, 272, 'Pick One <br/> (Required - Choose 1)', 1, NULL),
(52, 273, 'Pick One <br/> (Required - Choose 1)', 1, NULL),
(53, 274, 'Optional Side', NULL, NULL),
(54, 275, 'Optional Side', NULL, NULL),
(55, 276, 'Optional Side', NULL, NULL),
(56, 277, 'Optional Side', NULL, NULL),
(57, 278, 'Optional Side', NULL, NULL),
(58, 279, 'Optional Side', NULL, NULL),
(59, 280, 'Pasta Add-On', NULL, NULL),
(60, 281, 'Pasta Add-On', NULL, NULL),
(61, 282, 'Pasta Add-On', NULL, NULL),
(62, 286, 'Pasta Add-On', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_option_value`
--

CREATE TABLE `product_option_value` (
  `po_id` int(11) NOT NULL,
  `option_value` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `option_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_option_value`
--

INSERT INTO `product_option_value` (`po_id`, `option_value`, `price`, `option_group_id`) VALUES
(1, 'Small', '6.99', 1),
(2, 'Medium', '12.99', 1),
(3, 'Large', '14.99', 1),
(4, 'Extra - Large', '16.99', 1),
(5, ' Creamy', '0.00', 2),
(6, 'Barbecue', '0.00', 2),
(7, ' Seafood Dinners', '0.00', 2),
(8, 'No Thanks', '0.00', 3),
(9, ' Ranch', '0.00', 3),
(10, ' Italian', '0.00', 3),
(11, ' Thousand Island', '0.00', 3),
(12, ' Caesar', '0.00', 3),
(13, 'Asian Sesame', '0.00', 3),
(14, 'No, Thanks', '0.99', 4),
(15, 'Add Ranch', '0.99', 4),
(16, ' Add Caesar', '0.99', 4),
(18, ' Add Italian', '0.99', 4),
(19, ' Add Asian Sesame', '0.99', 4),
(20, 'Add Thousand Island', '0.99', 4),
(21, ' No, Thanks', '0.00', 5),
(22, ' Add Grilled Chicken', '2.00', 5),
(23, ' Add Bacon Bite', '0.75', 5),
(24, ' Add Dressing', '0.50', 5),
(25, ' 10 PC', '10.99', 6),
(26, ' No, Thanks', '0.00', 7),
(27, 'Honey Mustard Sauce', '0.00', 7),
(28, ' Hot Sauce', '0.00', 7),
(29, ' Barbecue Sauce', '0.00', 7),
(30, '20 PC', '18.99', 6),
(31, '30 PC', '28.99', 6),
(32, 'Original', '0.00', 8),
(33, 'Everything Style', '0.00', 8),
(34, 'Garlic Parmesan ', '0.00', 8),
(35, 'Sriracha & Lime', '0.00', 8),
(36, 'Cherry', '0.00', 9),
(37, 'Strawberry', '0.00', 9),
(38, 'Raspberry', '0.00', 9),
(39, 'Four Fruits', '0.00', 9),
(40, 'Blackberry', '0.00', 9),
(41, 'Fig', '0.00', 9),
(42, 'Orange', '0.00', 9),
(43, 'Peach', '0.00', 9),
(44, 'Apricot-Raspberry', '0.00', 9),
(45, 'Chocolate Chip', '0.00', 10),
(46, 'Monster', '0.00', 10),
(47, 'Oreo', '0.00', 10),
(48, 'Chicken', '0.00', 11),
(49, 'Vegetable', '0.00', 11),
(50, 'Refined Coconut Oil', '0.00', 12),
(51, 'Unrefined Coconut Oil', '0.00', 12),
(52, 'Viki''s Granola Original', '0.00', 13),
(53, 'Viki''s Granola Blueberry Almond', '0.00', 13),
(54, 'Viki''s Granola Maple Cranberry', '0.00', 13),
(55, 'Viki''s Granola Banana Walnut', '0.00', 13),
(56, 'Viki''s Granola Apple Cinnamon', '0.00', 13),
(57, 'Ground Coffee', '0.00', 14),
(58, 'Whole Bean', '0.00', 14),
(59, 'Ground Coffee', '0.00', 15),
(60, 'Whole Bean', '0.00', 15),
(61, 'Ground Coffee', '0.00', 16),
(62, 'Whole Bean', '0.00', 16),
(63, 'Ground Coffee', '0.00', 17),
(64, 'Whole Bean', '0.00', 17),
(65, 'Separate Colors', '0.00', 18),
(66, 'Bleach', '0.00', 18),
(67, 'Softener', '0.00', 18),
(68, 'Dress Shirt (Wash and Press on hanger)', '2.25', 19),
(69, 'Dress Shirt (Wash and Hand pressed)', '4.00', 19),
(70, 'Dress Shirt (Dry Cleaned on hanger)', '4.00', 19),
(71, 'Short Sleeved (Dry Cleaned on hanger)', '4.00', 19),
(72, 'Dress Shirt (Wash and Press boxed)', '6.00', 19),
(73, 'Leather', '37.50', 20),
(74, 'Cardigan', '0.00', 21),
(75, 'Delicate', '3.00', 22),
(76, 'Regular', '7.50', 23),
(77, 'Sport Jacket / Blazer / Sport Coat', '7.50', 23),
(78, 'Down', '25.00', 23),
(79, 'Heavy', '25.00', 23),
(80, 'Leather', '65.00', 23),
(81, '2 Piece', '15.00', 24),
(82, '3 Piece', '20.00', 24),
(83, 'Pleated or Delicate', '2.00', 25),
(84, 'Leather', '38.00', 25),
(85, '3/4 Length', '22.00', 26),
(86, 'Rain coat', '25.00', 26),
(87, 'Down', '25.00', 26),
(88, 'Overcoat/Full Length', '45.00', 26),
(89, 'Leather', '75.00', 26),
(90, 'Pants', '30.00', 27),
(91, 'Skirt/Dress', '15.00', 27),
(92, 'Sleeve', '20.00', 27),
(93, 'Pants', '16.00', 28),
(94, 'Jacket', '16.00', 28),
(95, 'Sushi', '0.00', 29),
(96, 'Sashimi ', '0.00', 29),
(97, 'Sushi ', '0.00', 30),
(98, 'Sashimi ', '0.00', 30),
(99, 'Sushi', '0.00', 31),
(100, 'Sashimi', '0.00', 31),
(101, 'Sushi', '0.00', 32),
(102, 'Sashimi', '0.00', 32),
(103, 'Sushi', '0.00', 33),
(104, 'Sashimi', '0.00', 33),
(105, 'Coke', '0.00', 34),
(106, 'Diet Coke', '0.00', 34),
(107, 'Sprite', '0.00', 34),
(108, ' Separate Colors', '0.00', 35),
(109, ' Bleach', '0.00', 35),
(110, ' Softener', '0.00', 35),
(111, 'Dress Shirt (Wash and Press on hanger)', '2.91', 36),
(112, ' Dress Shirt (Wash and Press boxed)', '3.56', 36),
(113, 'Dress Shirt (Wash and Hand pressed)', '3.56', 36),
(114, ' Dress Shirt (Dry Cleaned on hanger)', '5.40', 36),
(115, ' Short Sleeved (Dry Cleaned on hanger)', '5.40', 36),
(116, ' Leather', '25.97', 37),
(117, ' Cardigan', '0.00', 38),
(118, ' Delicate', '2.70', 39),
(119, ' Regular', '7.89', 40),
(120, 'Sport Jacket / Blazer / Sport Coat', '7.89', 40),
(121, ' Down', '11.90', 40),
(122, 'Heavy', '11.90', 40),
(123, ' Leather', '45.00', 40),
(124, ' 2 piece', '14.59', 41),
(125, '3 piece', '20.54', 41),
(126, 'Pleated or Delicate', '2.16', 42),
(127, ' Leather', '25.67', 42),
(128, 'Pants', '15.16', 43),
(129, 'Skirt/Dress', '15.16', 43),
(130, ' Sleeve', '19.48', 43),
(131, 'Pants', '23.82', 44),
(132, 'Jacket', '23.82', 44),
(133, 'Bacon', '1.25', 45),
(134, 'Ground Beef', '1.25', 45),
(135, ' Spinach', '1.25', 45),
(136, 'Sausage', '1.25', 45),
(137, 'Pepperoni', '1.25', 45),
(138, ' Mushroom', '1.25', 45),
(139, ' Bacon', '1.75', 46),
(140, ' Ground Beef', '1.75', 46),
(141, ' Spinach', '1.75', 46),
(142, 'Sausage', '1.75', 46),
(143, ' Yes', '0.00', 47),
(144, 'Bacon', '1.25', 48),
(145, ' Ground Beef', '1.25', 48),
(146, 'Spinach', '1.25', 48),
(147, 'Sausage', '1.25', 48),
(148, 'Pepperoni', '1.25', 48),
(149, '10 Inch', '8.50', 49),
(150, ' 14 inch ', '13.95', 49),
(151, ' 16 inch', '15.95', 49),
(152, '18 inch', '18.95', 49),
(153, ' With Sauce', '0.00', 50),
(154, 'No Sauce', '0.00', 50),
(155, '10 Inch', '8.50', 51),
(156, '14 Inch', '13.95', 51),
(157, '16 Inch', '15.95', 51),
(158, '18 Inch', '18.95', 51),
(159, '10 inch', '8.50', 52),
(160, '14 Inch', '13.95', 52),
(161, '16 Inch', '15.95', 52),
(162, '18 inch', '18.95', 52),
(163, 'French Fries', '1.50', 53),
(164, 'French Fries', '1.50', 54),
(165, 'French Fries', '1.50', 55),
(166, 'French Fries', '1.50', 56),
(167, 'French Fries', '1.50', 57),
(168, 'French Fries', '1.50', 58),
(169, 'Add Grilled Chicken', '2.75', 59),
(170, 'Add Grilled Chicken', '2.75', 60),
(171, 'Add Grilled Chicken', '2.75', 61),
(172, 'Add Grilled Chicken', '2.75', 62);

-- --------------------------------------------------------

--
-- Table structure for table `product_to_category`
--

CREATE TABLE `product_to_category` (
  `ptc_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_to_category`
--

INSERT INTO `product_to_category` (`ptc_id`, `product_id`, `category_id`) VALUES
(1, 1, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 2),
(13, 13, 2),
(14, 14, 2),
(15, 15, 2),
(16, 16, 2),
(17, 17, 3),
(18, 18, 3),
(19, 19, 4),
(21, 21, 4),
(22, 22, 4),
(23, 23, 4),
(24, 24, 4),
(25, 25, 4),
(26, 26, 5),
(27, 27, 5),
(28, 28, 5),
(29, 29, 5),
(31, 31, 7),
(32, 32, 7),
(33, 33, 7),
(34, 34, 7),
(35, 35, 7),
(36, 36, 9),
(37, 37, 9),
(38, 38, 9),
(39, 39, 11),
(40, 40, 11),
(41, 41, 11),
(42, 42, 11),
(43, 43, 12),
(44, 44, 12),
(45, 45, 12),
(46, 46, 14),
(47, 47, 14),
(48, 48, 14),
(49, 49, 14),
(50, 50, 14),
(51, 51, 14),
(52, 52, 14),
(53, 53, 15),
(54, 54, 15),
(55, 55, 15),
(56, 56, 15),
(57, 57, 16),
(58, 58, 16),
(59, 59, 16),
(60, 60, 16),
(61, 61, 18),
(62, 62, 18),
(63, 63, 18),
(64, 64, 18),
(65, 65, 18),
(66, 66, 20),
(67, 67, 20),
(68, 68, 20),
(70, 70, 20),
(71, 71, 22),
(72, 72, 22),
(73, 73, 22),
(74, 74, 22),
(75, 75, 24),
(78, 78, 25),
(79, 79, 27),
(80, 80, 27),
(81, 81, 27),
(82, 82, 27),
(83, 83, 28),
(84, 84, 28),
(85, 85, 28),
(86, 86, 28),
(87, 87, 29),
(88, 88, 29),
(89, 89, 29),
(90, 90, 29),
(91, 91, 29),
(92, 92, 30),
(93, 93, 35),
(94, 94, 35),
(95, 95, 35),
(96, 96, 35),
(97, 97, 35),
(98, 98, 35),
(99, 99, 35),
(100, 100, 35),
(101, 101, 36),
(102, 102, 36),
(103, 103, 36),
(104, 104, 36),
(105, 105, 36),
(106, 106, 36),
(107, 107, 36),
(108, 108, 36),
(109, 109, 36),
(110, 110, 37),
(111, 111, 37),
(112, 112, 37),
(113, 113, 37),
(114, 114, 37),
(115, 115, 38),
(116, 116, 38),
(117, 117, 38),
(118, 118, 38),
(119, 119, 39),
(120, 120, 39),
(121, 121, 39),
(122, 122, 39),
(123, 123, 39),
(124, 124, 39),
(125, 125, 40),
(126, 126, 40),
(127, 127, 40),
(128, 128, 40),
(129, 129, 40),
(130, 130, 41),
(131, 131, 41),
(132, 132, 41),
(133, 133, 41),
(134, 134, 41),
(135, 135, 41),
(136, 136, 44),
(137, 137, 44),
(138, 138, 44),
(139, 139, 44),
(140, 140, 44),
(141, 141, 44),
(142, 142, 44),
(143, 143, 45),
(144, 144, 45),
(145, 145, 45),
(146, 146, 45),
(147, 147, 45),
(148, 148, 45),
(149, 149, 46),
(150, 150, 46),
(151, 151, 46),
(152, 152, 46),
(153, 153, 47),
(154, 154, 47),
(155, 155, 47),
(156, 156, 47),
(157, 157, 47),
(158, 158, 49),
(159, 159, 49),
(160, 160, 49),
(161, 161, 49),
(162, 162, 49),
(163, 163, 51),
(164, 164, 51),
(165, 165, 51),
(166, 166, 51),
(167, 167, 52),
(168, 168, 52),
(169, 169, 52),
(170, 170, 52),
(171, 171, 53),
(172, 172, 53),
(173, 173, 53),
(174, 174, 53),
(175, 175, 55),
(176, 176, 55),
(177, 177, 56),
(178, 178, 56),
(179, 179, 56),
(180, 180, 56),
(181, 181, 56),
(182, 182, 57),
(183, 183, 57),
(184, 184, 57),
(185, 185, 57),
(186, 186, 57),
(187, 187, 57),
(188, 188, 58),
(189, 189, 58),
(190, 190, 58),
(191, 191, 61),
(192, 192, 61),
(193, 193, 62),
(194, 194, 61),
(195, 195, 62),
(196, 196, 64),
(197, 197, 64),
(198, 198, 64),
(199, 199, 64),
(200, 200, 64),
(201, 201, 66),
(202, 202, 66),
(203, 203, 66),
(204, 204, 67),
(205, 205, 67),
(206, 206, 67),
(207, 207, 67),
(208, 208, 68),
(209, 209, 69),
(210, 210, 69),
(211, 211, 69),
(212, 212, 69),
(213, 213, 69),
(214, 214, 69),
(215, 215, 69),
(216, 216, 69),
(217, 217, 69),
(219, 219, 69),
(220, 220, 69),
(221, 221, 70),
(222, 222, 70),
(223, 223, 70),
(224, 224, 70),
(225, 225, 70),
(226, 226, 70),
(227, 227, 70),
(228, 228, 71),
(229, 229, 71),
(230, 230, 71),
(231, 231, 71),
(232, 232, 72),
(233, 233, 72),
(234, 234, 72),
(235, 235, 72),
(236, 236, 72),
(237, 237, 73),
(238, 238, 73),
(239, 239, 73),
(240, 240, 73),
(241, 241, 73),
(242, 242, 73),
(243, 243, 73),
(244, 244, 73),
(245, 245, 74),
(246, 246, 74),
(247, 247, 74),
(248, 248, 74),
(249, 249, 74),
(250, 250, 75),
(251, 251, 76),
(252, 252, 77),
(253, 253, 77),
(254, 254, 77),
(255, 255, 77),
(256, 256, 77),
(257, 257, 77),
(258, 258, 77),
(259, 259, 77),
(260, 260, 78),
(261, 261, 78),
(262, 262, 78),
(263, 263, 78),
(264, 264, 78),
(265, 265, 79),
(266, 266, 79),
(267, 267, 79),
(268, 268, 80),
(269, 269, 80),
(270, 270, 80),
(271, 271, 81),
(272, 272, 81),
(273, 273, 81),
(274, 274, 82),
(275, 275, 82),
(276, 276, 82),
(277, 277, 82),
(278, 278, 82),
(279, 279, 82),
(280, 280, 83),
(281, 281, 83),
(282, 282, 83),
(286, 286, 83),
(287, 287, 84),
(288, 288, 84),
(289, 289, 84);

-- --------------------------------------------------------

--
-- Table structure for table `reedem_history`
--

CREATE TABLE `reedem_history` (
  `rh_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `reward_bucket_id` int(11) DEFAULT NULL,
  `earn_credit` decimal(10,2) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `refer_credit_history`
--

CREATE TABLE `refer_credit_history` (
  `rch_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `earn_credits` decimal(10,2) DEFAULT NULL,
  `ref_customer_id` int(11) DEFAULT NULL,
  `ref_order_id` int(11) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reward_bucket`
--

CREATE TABLE `reward_bucket` (
  `rb_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `points_reward` int(11) DEFAULT NULL,
  `credits` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reward_bucket`
--

INSERT INTO `reward_bucket` (`rb_id`, `title`, `points_reward`, `credits`, `image`, `description`) VALUES
(1, '$5 delivery.com Credit', 5000, '10.00', '5Credit_Asset1.png', '5000'),
(2, '$10 delivery.com Credit', 9500, '10.00', '10Credit_Asset.png', 'Treat yourself to $10 in delivery.com credit! All credit will be applied directly to your account for use on non-cash orders. Credits are not currently applicable on laundry orders.'),
(3, '$20 delivery.com Credit', 18000, '20.00', '20Credit_Asset.png', 'description'),
(4, 'Reprehende', 13000, '50.00', '20Credit_Asset1.png', 'Adipisicing reiciendis ad est, ipsam rerum consectetur, reiciendis rerum minim.');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_id` int(11) UNSIGNED NOT NULL,
  `set_key` varchar(255) DEFAULT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `set_key`, `value`) VALUES
(1, 'admin_theme', 'default'),
(2, 'site_name', 'Delivery'),
(3, 'front_theme', 'default'),
(4, 'email_address', 'shashikant0019@gmail.com'),
(5, 'admin_forgott_mail_template', 'Hello {username} ,<br >Your password is {password}<br />To login click {login_page_link} ,<br ><br >Thank You<br />{company_name}'),
(7, 'mail_protocol', 'smtp'),
(8, 'smtp_host', 'ssl://smtp.gmail.com'),
(9, 'smtp_port', '465'),
(10, 'smtp_timeout', '50'),
(11, 'smtp_user', 'krafty.developer@gmail.com'),
(12, 'smtp_pass', '!WSD#@Ca323afsd'),
(13, 'customer_forgott_mail_template', 'Hello {username} ,<br >Your password is {password}<br />To login click {login_page_link} ,<br ><br >Thank You<br />{company_name}'),
(14, 'paypal_test', '1'),
(15, 'paypal_username', 'krafty.developer_api1.gmail.com'),
(16, 'paypal_password', 'DKX2FEUWVZK5E8FL'),
(17, 'paypal_signature', 'AUQH9a2Eer-L.DkmrCLSXFYf0yqxAEX3tIhh8DeFO2e0-G9s6h2ZNQtM'),
(18, 'company_name', 'Delivery App'),
(19, 'currency', 'USD'),
(20, 'facebook', 'http://Facebook.com/demostore'),
(21, 'twitter', 'http://Twitter.com/demostore'),
(22, 'instagram', 'http://instagram.com/demostore'),
(23, 'googleplus', 'http://googleplus.com/demostore'),
(24, 'appstorelink', 'http://appstore.com/demostore'),
(25, 'playstorelink', 'http://playstore.com/demostores'),
(26, 'multiple_store_order', 'yes'),
(27, 'stripe_test_mode', 'true'),
(28, 'stripe_verify_ssl', 'false'),
(29, 'stripe_key_test_public', 'pk_test_lTHh1uNie87YrFzdHbpXeP6g'),
(30, 'stripe_key_test_secret', 'sk_test_zs2v8kudMTN0In2N6U0zqpHp'),
(31, 'stripe_key_live_public', 'pk_live_VAh4HvPecv1cnByabeDchaTF'),
(32, 'stripe_key_live_secret', 'sk_live_5QvtEyl2YieFBQ5E15VBMOTM '),
(33, 'stripe_currency_code', 'usd'),
(34, 'redeem_points', '20'),
(35, 'stripe_enable', '1'),
(36, 'paypal_enable', '1'),
(37, 'cod_enable', '1'),
(38, 'refbycredits', '13'),
(39, 'minorder_for_credits', '15'),
(40, 'owner', 'Recusandae'),
(41, 'address', 'Repudiandae in voluptas saepe suscipit eos exercitationem id, tenetur voluptatum quia labore possimus, veritatis ea beatae.'),
(42, 'phone', '232323232323'),
(43, 'language', 'en'),
(44, 'google_api_key', 'AIzaSyBhhmFWU2wnBGPblpdzHEALwfsh4WCTLwQ'),
(45, 'per_page', '10'),
(46, 'meta_titles', 'Consequat Est blanditiis iste quibusdam autem ad sint saepe voluptatem sit nesciunt voluptatem culpa'),
(47, 'meta_descriptions', 'Numquam odio accusantium hic quia totam aliquam ullamco harum qui tenetur voluptatem. Quam aspernatur doloribus ipsum.'),
(48, 'meta_keywords', 'Asperiores obcaecati velit, in reprehenderit, quod similique adipisci velit, in rerum debitis recusandae. Veniam.'),
(49, 'paypal_threshold_value', '300'),
(50, 'stripe_threshold_value', '300'),
(51, 'cash_threshold_value', '150'),
(52, 'twilio_sid', 'ACe76a2dcab70f227a348e2ddf762afc95'),
(53, 'twilio_auth_token', '938fe308dcf9f9427e1392439d9d25a8'),
(54, 'twilio_messaging_service_sid', 'MG89ac88e3e5beed7276b134c876fea10d'),
(55, 'sms_enabled', '1');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` char(2) NOT NULL,
  `name` varchar(64) NOT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `code`, `name`, `status`) VALUES
(1, 'AL', 'Alabama', 1),
(2, 'AK', 'Alaska', 1),
(3, 'AZ', 'Arizona', 1),
(4, 'AR', 'Arkansas', 1),
(5, 'CA', 'California', 1),
(6, 'CO', 'Colorado', 1),
(7, 'CT', 'Connecticut', 1),
(8, 'DE', 'Delaware', 1),
(9, 'DC', 'District of Columbia', 1),
(10, 'FL', 'Florida', 1),
(11, 'GA', 'Georgia', 1),
(12, 'HI', 'Hawaii', 1),
(13, 'ID', 'Idaho', 1),
(14, 'IL', 'Illinois', 1),
(15, 'IN', 'Indiana', 1),
(16, 'IA', 'Iowa', 1),
(17, 'KS', 'Kansas', 1),
(18, 'MN', 'Minnesota', 1),
(19, 'NE', 'Nebraska', 1),
(20, 'NV', 'Nevada', 1),
(21, 'NH', 'New Hampshire', 1),
(22, 'NJ', 'New Jersey', 1),
(23, 'NM', 'New Mexico', 1),
(24, 'NY', 'New York', 1),
(25, 'NC', 'North Carolina', 1),
(26, 'OH', 'Ohio', 1),
(27, 'OK', 'Oklahoma', 1),
(28, 'PA', 'Pennsylvania', 1),
(29, 'TN', 'Tennessee', 1),
(30, 'TX', 'Texas', 1),
(31, 'UT', 'Utah', 1),
(32, 'VA', 'Virginia', 1),
(33, 'WA', 'Washington', 1);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `store_name` varchar(200) DEFAULT NULL,
  `store_type` int(11) DEFAULT NULL,
  `store_phone` bigint(20) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `store_street` varchar(255) DEFAULT NULL,
  `store_city` varchar(255) DEFAULT NULL,
  `store_zip` int(10) DEFAULT NULL,
  `deliveryoption` varchar(255) DEFAULT NULL,
  `minorder` decimal(10,2) DEFAULT NULL,
  `delivery_fee` decimal(10,2) DEFAULT NULL,
  `delivery_periods` int(11) DEFAULT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `store_logo` varchar(255) DEFAULT NULL,
  `store_banner` varchar(255) DEFAULT NULL,
  `unique_alias` varchar(255) DEFAULT NULL,
  `store_commission` decimal(10,2) DEFAULT NULL,
  `sunday` int(1) DEFAULT NULL,
  `monday` int(1) DEFAULT NULL,
  `tuesday` int(1) DEFAULT NULL,
  `wednesday` int(1) DEFAULT NULL,
  `thursday` int(1) DEFAULT NULL,
  `friday` int(1) DEFAULT NULL,
  `saturday` int(1) DEFAULT NULL,
  `time_from` time DEFAULT NULL,
  `time_to` time DEFAULT NULL,
  `notice` varchar(255) DEFAULT NULL,
  `notice_start_date` date DEFAULT NULL,
  `notice_end_date` date DEFAULT NULL,
  `ads_status` int(1) DEFAULT NULL,
  `ads_start_date` date DEFAULT NULL,
  `ads_end_date` date DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `status`, `store_name`, `store_type`, `store_phone`, `meta_title`, `meta_keyword`, `meta_description`, `store_street`, `store_city`, `store_zip`, `deliveryoption`, `minorder`, `delivery_fee`, `delivery_periods`, `merchant_id`, `store_logo`, `store_banner`, `unique_alias`, `store_commission`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `time_from`, `time_to`, `notice`, `notice_start_date`, `notice_end_date`, `ads_status`, `ads_start_date`, `ads_end_date`, `created_on`) VALUES
(1, 1, 'Pappa Romeo''s Pizza 2.6', 1, 13126645264, '', '', '', '																																																																																																																							6730 N Clark St, 																																																																																																																', '1', 60606, 'Pick Up Only', '120.00', '10.00', NULL, 1, 'paparomeo.gif', 'paparomeobanner.jpg', 'pappa-romeos-pizza-2-6', '10.00', 1, 1, 1, 1, 1, 1, 1, '09:00:00', '10:00:00', '', '1970-01-01', '1970-01-01', 0, '1970-01-01', '1970-01-01', '2016-01-01 15:42:29'),
(2, 1, 'The Fireplace Inn', 1, 154654231321, '', '', '', '																																																																																																																																																																																																												1448 N Wells St, 																																		', '1', 60611, 'Delivery only', '150.00', '0.00', NULL, 2, 'fireplaceinn.jpg', 'fireplaceinnbanner.jpg', 'the-fireplace-inn', '12.00', NULL, 1, 1, 1, 1, 1, 1, '16:00:00', '23:00:00', '', '1970-01-01', '1970-01-01', 0, '1970-01-01', '1970-01-01', '2016-01-01 16:27:06'),
(3, 1, 'Chopstick', 1, 17186990866, '', '', '', '																																																																																					91-28 Corona Ave, Queens																																																																																', '2', 10012, 'Delivery & Pickup', '50.00', '10.00', NULL, 3, 'chopstick.png', 'chopstickbanner.jpg', 'chopstick', '15.00', 1, 1, 1, 1, 1, 1, 1, '10:00:00', '22:00:00', '', '1970-01-01', '1970-01-01', 0, '1970-01-01', '1970-01-01', '2016-01-01 16:59:38'),
(4, 1, 'Cork Wine and Spirits', 3, 12126733600, '', '', '', '																																		383 1st Avenue																																', '2', 10010, 'Delivery & Pickup', '20.00', '0.00', NULL, 4, 'CorkWineandSpirits1.jpg', 'CorkWineandSpirits_Banner1.jpg', 'cork-wine-and-spirits', '10.00', NULL, 1, 1, 1, 1, 1, 1, '08:00:00', '20:00:00', '', '1970-01-01', '1970-01-01', NULL, NULL, NULL, '2016-01-01 18:04:39'),
(5, 1, 'H & W Market', 2, 14154318032, '', '', '', '																																																			801 Hayes St																																																', '4', 94109, 'Delivery & Pickup', '100.00', '0.00', NULL, 5, 'hwmarket.png', 'hwmarketbanner.jpg', 'h-w-market', '8.00', NULL, 1, 1, 1, 1, 1, 1, '21:00:00', '09:00:00', '', '1970-01-01', '1970-01-01', NULL, NULL, NULL, '2016-01-01 18:26:46'),
(6, 1, 'sudzee & fort ', 4, 14159978393, '', '', '', '																																																																				1901 McAllister St,																																																																', '4', 94102, 'Delivery & Pickup', '10.00', '5.00', 5, 6, 'SH_icon_logo.jpg', 'WashingBanner1.jpg', 'sudzee-fort', '5.00', NULL, 1, 1, 1, 1, 1, 1, '10:00:00', '22:00:00', '', '1970-01-01', '1970-01-01', NULL, NULL, NULL, '2016-01-01 18:58:20'),
(7, 1, 'Modern Liquors', 3, 18662130890, '', '', '', '																																		1200 9th St NW (Between M & N St)																																', '7', 22103, 'Delivery & Pickup', '25.00', '5.00', NULL, 7, 'modernLiquorLOgo.jpg', 'modernLiquorbanner.jpg', 'modern-liquors', '10.00', 1, 1, 1, 1, 1, 1, 1, '08:00:00', '23:00:00', '', '1970-01-01', '1970-01-01', NULL, NULL, NULL, '2016-01-04 10:31:46'),
(8, 1, 'Indian Prem', 2, 13053717736, '', '', '', '																	255 E Flagler St # 71																', '8', 33108, 'Delivery & Pickup', '50.00', '0.00', NULL, 8, 'IndianPrem.jpg', 'hwmarketbanner1.jpg', 'indian-prem', '8.00', 1, 1, 1, 1, 1, 1, 1, '09:00:00', '22:00:00', '', '1970-01-01', '1970-01-01', NULL, NULL, NULL, '2016-01-04 12:47:43'),
(9, 1, 'Cleaners Club', 4, 13059350202, '', '', '', '																																		20610 Biscayne Blvd																																', '8', 33115, 'Delivery & Pickup', '20.00', '5.00', 2, 9, 'National-Arts-Centre-Logo.png', 'element-banner-water-940x246-940x246.jpg', 'cleaners-club', '10.00', NULL, 1, 1, 1, 1, 1, 1, '08:00:00', '20:00:00', '', '1970-01-01', '1970-01-01', NULL, NULL, NULL, '2016-01-04 15:46:02'),
(10, 1, 'Isushi Cafe', 1, 13055488751, '', '', '', '																	3301 NE 1st Ave #107																', '8', 33110, 'Delivery & Pickup', '25.00', '0.00', NULL, 10, 'merchant_logo_php.jpg', 'isushibanner.jpg', 'isushi-cafe', '12.00', 1, 1, 1, 1, 1, 1, 1, '07:00:00', '22:00:00', '', '1970-01-01', '1970-01-01', NULL, NULL, NULL, '2016-01-04 16:53:53'),
(11, 1, 'S&J Coin Laundry', 4, 12149050414, NULL, NULL, NULL, '5542 Maple Ave', '8', 33101, NULL, NULL, NULL, NULL, 9, '1-f.jpg', 'sandjlaudrybanner.jpg', 's-j-coin-laundry', '10.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-01-05 10:30:38'),
(12, 1, 'Paulie''s Pizza', 1, 12155924715, '', '', '', '																	31 S 11th St																', '9', 19107, 'Delivery & Pickup', '50.00', '0.00', NULL, 11, 'paulispizza.png', 'paulispizzabanner.png', 'paulies-pizza', '8.00', 1, 1, 1, 1, 1, 1, 1, '10:00:00', '23:00:00', '', '1970-01-01', '1970-01-01', NULL, NULL, NULL, '2016-01-05 11:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `store_cuisine_data`
--

CREATE TABLE `store_cuisine_data` (
  `scd_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `cuisine_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_cuisine_data`
--

INSERT INTO `store_cuisine_data` (`scd_id`, `s_id`, `cuisine_id`) VALUES
(48, 10, 5),
(49, 10, 15),
(55, 12, 2),
(56, 12, 6),
(57, 12, 16),
(58, 3, 3),
(59, 3, 7),
(60, 2, 1),
(61, 2, 8),
(62, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `store_delivery_zip`
--

CREATE TABLE `store_delivery_zip` (
  `sdz_id` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `zip_code_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_delivery_zip`
--

INSERT INTO `store_delivery_zip` (`sdz_id`, `store_id`, `zip_code_id`) VALUES
(308, 8, 109),
(309, 8, 110),
(310, 8, 111),
(311, 8, 112),
(312, 8, 113),
(313, 8, 114),
(314, 8, 115),
(315, 8, 116),
(316, 8, 117),
(317, 8, 118),
(318, 8, 119),
(319, 8, 120),
(320, 8, 121),
(321, 8, 122),
(322, 8, 123),
(331, 9, 109),
(332, 9, 113),
(333, 9, 114),
(334, 9, 115),
(335, 9, 118),
(336, 9, 119),
(337, 9, 122),
(338, 9, 123),
(339, 10, 109),
(340, 10, 110),
(341, 10, 111),
(342, 10, 112),
(343, 10, 113),
(344, 10, 114),
(345, 10, 115),
(346, 10, 116),
(347, 10, 117),
(348, 10, 118),
(349, 10, 119),
(350, 10, 120),
(351, 10, 121),
(352, 10, 122),
(353, 10, 123),
(361, 12, 124),
(362, 12, 125),
(363, 12, 126),
(364, 12, 127),
(365, 12, 128),
(366, 12, 129),
(367, 12, 130),
(368, 12, 131),
(369, 12, 132),
(370, 12, 133),
(371, 12, 134),
(372, 12, 135),
(373, 12, 136),
(374, 12, 137),
(375, 12, 138),
(376, 12, 139),
(377, 12, 140),
(378, 12, 141),
(379, 12, 142),
(380, 12, 143),
(381, 12, 144),
(382, 12, 145),
(383, 7, 93),
(384, 7, 94),
(385, 7, 95),
(386, 7, 96),
(387, 7, 97),
(388, 7, 98),
(389, 7, 99),
(390, 7, 100),
(391, 7, 101),
(392, 7, 102),
(393, 7, 103),
(394, 7, 104),
(395, 7, 105),
(396, 7, 106),
(397, 7, 107),
(398, 7, 108),
(399, 6, 54),
(400, 6, 55),
(401, 6, 56),
(402, 6, 57),
(403, 6, 58),
(404, 6, 59),
(405, 6, 60),
(406, 6, 61),
(407, 6, 62),
(408, 6, 63),
(409, 6, 64),
(410, 6, 65),
(411, 6, 66),
(412, 6, 67),
(413, 6, 68),
(414, 5, 54),
(415, 5, 55),
(416, 5, 56),
(417, 5, 57),
(418, 5, 58),
(419, 5, 59),
(420, 5, 60),
(421, 5, 61),
(422, 5, 62),
(423, 5, 63),
(424, 5, 64),
(425, 5, 65),
(426, 5, 66),
(427, 5, 67),
(428, 5, 68),
(429, 4, 16),
(430, 4, 17),
(431, 4, 18),
(432, 4, 19),
(433, 4, 20),
(434, 4, 21),
(435, 4, 22),
(436, 4, 23),
(437, 4, 24),
(438, 4, 25),
(439, 4, 26),
(440, 4, 30),
(441, 4, 32),
(442, 4, 33),
(443, 4, 37),
(444, 4, 39),
(445, 3, 16),
(446, 3, 17),
(447, 3, 18),
(448, 3, 19),
(449, 3, 20),
(450, 3, 21),
(451, 3, 22),
(452, 3, 23),
(453, 3, 24),
(454, 3, 25),
(455, 3, 26),
(456, 3, 27),
(457, 3, 28),
(458, 3, 29),
(459, 3, 30),
(460, 3, 31),
(461, 3, 32),
(462, 3, 33),
(463, 3, 34),
(464, 3, 35),
(465, 3, 36),
(466, 3, 37),
(467, 3, 38),
(468, 3, 39),
(469, 2, 1),
(470, 2, 3),
(471, 2, 5),
(472, 2, 7),
(473, 2, 8),
(474, 2, 10),
(475, 2, 12),
(476, 1, 1),
(477, 1, 2),
(478, 1, 3),
(479, 1, 5),
(480, 1, 6),
(481, 1, 9),
(482, 1, 11),
(483, 1, 12),
(484, 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `store_review`
--

CREATE TABLE `store_review` (
  `sr_id` int(11) NOT NULL,
  `review` text,
  `review_by` int(11) DEFAULT NULL,
  `review_rating` double(10,2) DEFAULT NULL,
  `review_on` datetime DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `approved` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) UNSIGNED NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `last_login` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  `ip` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `user_group_id`, `username`, `password`, `first_name`, `last_name`, `email`, `status`, `last_login`, `last_update`, `created_on`, `ip`) VALUES
(1, 1, 'superadmin', '56aCDWziMlVVkxcoTw3U2t/evnWl5cgIciyoi+6yxJVzP+0iPqrQohUfh2MRRPLnFlzQryP37bENyBDCJYRb+Q==', 'admin', 'super', 'admin@admin.com', 1, '2016-02-22 11:33:18', '2016-02-22 11:32:54', '0000-00-00 00:00:00', '192.168.2.5'),
(2, 2, 'admin', 'c0FOwe09cbVmp6BuBlH/vNVLZCvx80FKrdLLki9o6RgJG0fa+NTxZnEtHDtH9lgkNUnTn5034399j+jKSxgskg==', 'Admin', 'master', 'admin@mail.com', 1, '2016-02-22 11:34:19', '2016-02-22 11:30:41', '2016-01-06 14:19:22', '192.168.2.5');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `act_key` varchar(255) DEFAULT NULL,
  `data` text,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`activity_id`, `user_id`, `act_key`, `data`, `date_added`) VALUES
(1, 1, 'City Added', NULL, '2016-01-01 12:10:03'),
(2, 1, 'City Added', NULL, '2016-01-01 12:16:16'),
(3, 1, 'City Added', NULL, '2016-01-01 12:20:28'),
(4, 1, 'City Added', NULL, '2016-01-01 12:24:08'),
(5, 1, 'City Added', NULL, '2016-01-01 12:42:58'),
(6, 1, 'City Added', NULL, '2016-01-01 12:54:27'),
(7, 1, 'City Added', NULL, '2016-01-01 12:59:44'),
(8, 1, 'City Added', NULL, '2016-01-01 14:52:54'),
(9, 1, 'cuisine added', '{"cusine_type":"American","cuisine_image_url":"american_image.jpg","banner_image":"american_banner.jpg","status":"1","featured_on":null}', '2016-01-01 15:03:15'),
(10, 1, 'cuisine added', '{"cusine_type":"Pizza","cuisine_image_url":"pizza_image.jpg","banner_image":"pizza_banner.jpg","status":"1","featured_on":"1"}', '2016-01-01 15:04:20'),
(11, 1, 'cuisine added', '{"cusine_type":"Chinese","cuisine_image_url":"chinese.jpg","banner_image":"chinese_banner.jpg","status":"1","featured_on":"1"}', '2016-01-01 15:05:42'),
(12, 1, 'cuisine added', '{"cusine_type":"Mexican","cuisine_image_url":"maxican_imahe.jpg","banner_image":"maxican_banner.jpg","status":"1","featured_on":"1"}', '2016-01-01 15:06:48'),
(13, 1, 'cuisine added', '{"cusine_type":"Sushi","cuisine_image_url":"sushi_image.jpg","banner_image":"sushi_banner.jpg","status":"1","featured_on":"1"}', '2016-01-01 15:08:20'),
(14, 1, 'cuisine added', '{"cusine_type":"Fast food","cuisine_image_url":"fast_fode_image.jpg","banner_image":"fast_food_banner.jpg","status":"1","featured_on":"1"}', '2016-01-01 15:09:36'),
(15, 1, 'cuisine added', '{"cusine_type":"Thai","cuisine_image_url":"thai_image.jpg","banner_image":"thai_banner.jpg","status":"1","featured_on":"1"}', '2016-01-01 15:10:43'),
(16, 1, 'cuisine added', '{"cusine_type":"BBQ","cuisine_image_url":"bbq_image.jpg","banner_image":"bbq_banner.jpg","status":"1","featured_on":null}', '2016-01-01 15:12:01'),
(17, 1, 'cuisine added', '{"cusine_type":"Deli","cuisine_image_url":"deli_banner.jpg","banner_image":"deli_image.jpg","status":"1","featured_on":null}', '2016-01-01 15:14:01'),
(18, 1, 'cuisine added', '{"cusine_type":"Indian","cuisine_image_url":"india.jpg","banner_image":"indian_banner.jpg","status":"1","featured_on":null}', '2016-01-01 15:16:11'),
(19, 1, 'cuisine added', '{"cusine_type":"Mediterranean","cuisine_image_url":"MEDITERRANEAN-_image.jpg","banner_image":"Mediterranean.jpg","status":"1","featured_on":null}', '2016-01-01 15:18:14'),
(20, 1, 'cuisine added', '{"cusine_type":"Vegetarian","cuisine_image_url":"veg_banner.jpg","banner_image":"veg_image.png","status":"1","featured_on":null}', '2016-01-01 15:19:28'),
(21, 1, 'cuisine added', '{"cusine_type":"Asian","cuisine_image_url":"asian.jpg","banner_image":"asian_banner.jpg","status":"1","featured_on":null}', '2016-01-01 15:21:09'),
(22, 1, 'cuisine added', '{"cusine_type":"Breakfast ","cuisine_image_url":"Breakfast_image.jpg","banner_image":"Breakfast_banner.jpg","status":"1","featured_on":null}', '2016-01-01 15:23:49'),
(23, 1, 'cuisine added', '{"cusine_type":"Desserts","cuisine_image_url":"Desserts_image.jpg","banner_image":"Desserts_banner.jpg","status":"1","featured_on":null}', '2016-01-01 15:26:55'),
(24, 1, 'cuisine added', '{"cusine_type":"Italian","cuisine_image_url":"Italian_image.jpg","banner_image":"Italian_banner.jpg","status":"1","featured_on":null}', '2016-01-01 15:29:55'),
(25, 1, 'cuisine added', '{"cusine_type":"Wings","cuisine_image_url":"wings_image.jpg","banner_image":"Wings_banner.jpg","status":"1","featured_on":null}', '2016-01-01 15:32:13'),
(26, 1, 'cuisine added', '{"cusine_type":"Middle eastern","cuisine_image_url":"Middle_eastern_image.jpg","banner_image":"Middle_eastern_banner.jpg","status":"1","featured_on":null}', '2016-01-01 15:33:44'),
(27, 1, 'Merchant Added ', NULL, '2016-01-01 15:40:48'),
(28, 1, 'Store Created', NULL, '2016-01-01 15:42:29'),
(29, 1, 'Store Updated', NULL, '2016-01-01 15:44:00'),
(30, 1, 'Store Updated', NULL, '2016-01-01 16:13:57'),
(31, 1, 'Merchant Added ', NULL, '2016-01-01 16:25:15'),
(32, 1, 'Store Created', NULL, '2016-01-01 16:27:06'),
(33, 1, 'Merchant Updated ', NULL, '2016-01-01 16:27:38'),
(34, 1, 'Merchant Updated ', NULL, '2016-01-01 16:28:03'),
(35, 1, 'Merchant Updated ', NULL, '2016-01-01 16:28:33'),
(36, 1, 'Store Updated', NULL, '2016-01-01 16:30:03'),
(37, 1, 'Merchant Added ', NULL, '2016-01-01 16:55:48'),
(38, 1, 'Store Created', NULL, '2016-01-01 16:59:38'),
(39, 1, 'Store Updated', NULL, '2016-01-01 17:00:43'),
(40, 1, 'Store Updated', NULL, '2016-01-01 17:00:59'),
(41, 1, 'Store Updated', NULL, '2016-01-01 17:01:07'),
(42, 1, 'City Updated', NULL, '2016-01-01 17:08:23'),
(43, 1, 'Store Updated', NULL, '2016-01-01 17:09:06'),
(44, 1, 'City Updated', NULL, '2016-01-01 17:10:44'),
(45, 1, 'Store Updated', NULL, '2016-01-01 17:11:34'),
(46, 1, 'City Updated', NULL, '2016-01-01 17:15:16'),
(47, 1, 'City Updated', NULL, '2016-01-01 17:15:47'),
(48, 1, 'City Updated', NULL, '2016-01-01 17:16:52'),
(49, 1, 'Merchant Updated ', NULL, '2016-01-01 17:19:03'),
(50, 1, 'Store Updated', NULL, '2016-01-01 17:19:55'),
(51, 1, 'Store Updated', NULL, '2016-01-01 17:20:08'),
(52, 1, 'City Updated', NULL, '2016-01-01 17:21:22'),
(53, 1, 'Store Updated', NULL, '2016-01-01 17:24:47'),
(54, 1, 'Store Updated', NULL, '2016-01-01 17:25:09'),
(55, 1, 'Store Updated', NULL, '2016-01-01 17:37:04'),
(56, 1, 'Store Updated', NULL, '2016-01-01 17:37:16'),
(57, 1, 'Store Updated', NULL, '2016-01-01 17:37:54'),
(58, 1, 'Cuisine Updated', '{"cusine_type":"American","cuisine_image_url":"americanimage1.jpg","status":"1","featured_on":null}', '2016-01-01 17:44:44'),
(59, 1, 'Cuisine Updated', '{"cusine_type":"Pizza","cuisine_image_url":"pizzaimage1.jpg","status":"1","featured_on":"1"}', '2016-01-01 17:44:57'),
(60, 1, 'Cuisine Updated', '{"cusine_type":"Chinese","cuisine_image_url":"chinese2.jpg","status":"1","featured_on":"1"}', '2016-01-01 17:45:11'),
(61, 1, 'Cuisine Updated', '{"cusine_type":"Mexican","cuisine_image_url":"maxicanimage1.jpg","status":"1","featured_on":"1"}', '2016-01-01 17:45:32'),
(62, 1, 'Cuisine Updated', '{"cusine_type":"Sushi","cuisine_image_url":"sushiimage1.jpg","status":"1","featured_on":"1"}', '2016-01-01 17:45:44'),
(63, 1, 'Store Updated', NULL, '2016-01-01 17:45:57'),
(64, 1, 'Cuisine Updated', '{"cusine_type":"Fast food","cuisine_image_url":"fastfoodimage1.jpg","status":"1","featured_on":"1"}', '2016-01-01 17:46:00'),
(65, 1, 'Cuisine Updated', '{"cusine_type":"Thai","cuisine_image_url":"thaiimage1.jpg","status":"1","featured_on":"1"}', '2016-01-01 17:46:13'),
(66, 1, 'Cuisine Updated', '{"cusine_type":"BBQ","cuisine_image_url":"bbqimage1.jpg","status":"1","featured_on":"1"}', '2016-01-01 17:46:27'),
(67, 1, 'Cuisine Updated', '{"cusine_type":"Deli","cuisine_image_url":"deliimage1.jpg","status":"1","featured_on":null}', '2016-01-01 17:46:39'),
(68, 1, 'Cuisine Updated', '{"cusine_type":"Indian","cuisine_image_url":"india2.jpg","status":"1","featured_on":null}', '2016-01-01 17:46:56'),
(69, 1, 'Store Updated', NULL, '2016-01-01 17:47:16'),
(70, 1, 'Cuisine Updated', '{"cusine_type":"Mediterranean","cuisine_image_url":"Mediterraneanimage1.jpg","status":"1","featured_on":null}', '2016-01-01 17:47:16'),
(71, 1, 'Cuisine Updated', '{"cusine_type":"Vegetarian","cuisine_image_url":"vegimage1.png","status":"1","featured_on":null}', '2016-01-01 17:47:31'),
(72, 1, 'Cuisine Updated', '{"cusine_type":"Asian","cuisine_image_url":"asian2.jpg","status":"1","featured_on":null}', '2016-01-01 17:47:47'),
(73, 1, 'Cuisine Updated', '{"cusine_type":"Breakfast ","cuisine_image_url":"Breakfastimage1.jpg","status":"1","featured_on":null}', '2016-01-01 17:48:03'),
(74, 1, 'Cuisine Updated', '{"cusine_type":"Desserts","cuisine_image_url":"Dessertsimage1.jpg","status":"1","featured_on":null}', '2016-01-01 17:48:28'),
(75, 1, 'Store Updated', NULL, '2016-01-01 17:48:34'),
(76, 1, 'Store Updated', NULL, '2016-01-01 17:48:55'),
(77, 1, 'Cuisine Updated', '{"cusine_type":"Italian","cuisine_image_url":"italianimage1.jpg","status":"1","featured_on":null}', '2016-01-01 17:48:57'),
(78, 1, 'Cuisine Updated', '{"cusine_type":"Wings","cuisine_image_url":"wingsimage1.jpg","status":"1","featured_on":null}', '2016-01-01 17:49:13'),
(79, 1, 'Cuisine Updated', '{"cusine_type":"Middle eastern","cuisine_image_url":"Middleeasternimage1.jpg","status":"1","featured_on":null}', '2016-01-01 17:49:33'),
(80, 1, 'Cuisine Updated', '{"cusine_type":"BBQ","status":"1","featured_on":null}', '2016-01-01 17:49:58'),
(81, 1, 'Store Updated', NULL, '2016-01-01 17:51:29'),
(82, 1, 'City Updated', NULL, '2016-01-01 17:52:30'),
(83, 1, 'City Updated', NULL, '2016-01-01 17:52:52'),
(84, 1, 'City Updated', NULL, '2016-01-01 17:53:14'),
(85, 1, 'Store Updated', NULL, '2016-01-01 17:53:28'),
(86, 1, 'City Updated', NULL, '2016-01-01 17:53:49'),
(87, 1, 'City Updated', NULL, '2016-01-01 17:54:15'),
(88, 1, 'City Updated', NULL, '2016-01-01 17:54:36'),
(89, 1, 'City Updated', NULL, '2016-01-01 17:54:51'),
(90, 1, 'City Updated', NULL, '2016-01-01 17:55:08'),
(91, 1, 'Store Updated', NULL, '2016-01-01 17:57:20'),
(92, 1, 'Store Updated', NULL, '2016-01-01 18:01:18'),
(93, 1, 'Merchant Added ', NULL, '2016-01-01 18:03:08'),
(94, 1, 'Store Created', NULL, '2016-01-01 18:04:39'),
(95, 1, 'Store Updated', NULL, '2016-01-01 18:16:21'),
(96, 1, 'Merchant Added ', NULL, '2016-01-01 18:24:26'),
(97, 1, 'Store Created', NULL, '2016-01-01 18:26:47'),
(98, 1, 'Store Updated', NULL, '2016-01-01 18:27:49'),
(99, 1, 'Store Updated', NULL, '2016-01-01 18:45:55'),
(100, 1, 'Merchant Added ', NULL, '2016-01-01 18:54:53'),
(101, 1, 'Store Created', NULL, '2016-01-01 18:58:20'),
(102, 1, 'Store Updated', NULL, '2016-01-01 19:01:07'),
(103, 1, 'Store Updated', NULL, '2016-01-01 19:03:54'),
(104, 1, 'Store Updated', NULL, '2016-01-01 19:05:08'),
(105, 1, 'Merchant Added ', NULL, '2016-01-04 10:30:11'),
(106, 1, 'Store Created', NULL, '2016-01-04 10:31:46'),
(107, 1, 'Store Updated', NULL, '2016-01-04 11:17:15'),
(108, 1, 'City Updated', NULL, '2016-01-04 11:22:49'),
(109, 1, 'City Updated', NULL, '2016-01-04 11:26:41'),
(110, 1, 'Merchant Added ', NULL, '2016-01-04 12:19:24'),
(111, 1, 'Store Created', NULL, '2016-01-04 12:47:43'),
(112, 1, 'City Updated', NULL, '2016-01-04 15:04:01'),
(113, 1, 'City Updated', NULL, '2016-01-04 15:06:26'),
(114, 1, 'City Updated', NULL, '2016-01-04 15:13:32'),
(115, 1, 'Merchant Updated ', NULL, '2016-01-04 15:22:51'),
(116, 1, 'Store Updated', NULL, '2016-01-04 15:24:34'),
(117, 1, 'Merchant Added ', NULL, '2016-01-04 15:42:44'),
(118, 1, 'Store Created', NULL, '2016-01-04 15:46:02'),
(119, 1, 'Store Updated', NULL, '2016-01-04 16:29:01'),
(120, 1, 'Store Updated', NULL, '2016-01-04 16:29:09'),
(121, 1, 'Merchant Added ', NULL, '2016-01-04 16:51:45'),
(122, 1, 'Store Created', NULL, '2016-01-04 16:53:53'),
(123, 1, 'Store Updated', NULL, '2016-01-04 16:55:01'),
(124, 1, 'Store Created', NULL, '2016-01-05 10:30:38'),
(125, 1, 'Store Updated', NULL, '2016-01-05 10:49:58'),
(126, 1, 'City Added', NULL, '2016-01-05 11:14:06'),
(127, 1, 'City Updated', NULL, '2016-01-05 11:14:21'),
(128, 1, 'City Updated', NULL, '2016-01-05 11:14:48'),
(129, 1, 'Merchant Added ', NULL, '2016-01-05 11:15:07'),
(130, 1, 'Store Created', NULL, '2016-01-05 11:16:50'),
(131, 1, 'Store Updated', NULL, '2016-01-05 11:17:46'),
(132, 1, 'City Updated', NULL, '2016-01-05 11:49:36'),
(133, 1, 'City Updated', NULL, '2016-01-05 11:51:44'),
(134, 1, 'City Updated', NULL, '2016-01-05 11:53:01'),
(135, 1, 'City Updated', NULL, '2016-01-05 12:00:52'),
(136, 1, 'City Updated', NULL, '2016-01-05 18:18:28'),
(137, 1, 'City Updated', NULL, '2016-01-05 18:20:33'),
(138, 1, 'Users groups Created', NULL, '2016-01-06 18:47:40'),
(139, 1, 'User Created', NULL, '2016-01-06 18:49:22'),
(140, 1, 'Users groups Created', NULL, '2016-01-06 18:49:42'),
(141, 1, 'Merchant Updated ', NULL, '2016-01-19 18:51:25'),
(142, 1, 'Merchant Updated ', NULL, '2016-01-19 18:59:30'),
(143, 1, 'Merchant Updated ', NULL, '2016-01-19 19:00:07'),
(144, 1, 'Merchant Updated ', NULL, '2016-01-19 19:00:39'),
(145, 1, 'Merchant Updated ', NULL, '2016-01-19 19:01:08'),
(146, 1, 'Merchant Updated ', NULL, '2016-01-19 19:01:33'),
(147, 1, 'Merchant Updated ', NULL, '2016-01-19 19:01:45'),
(148, 1, 'Merchant Updated ', NULL, '2016-01-19 19:02:08'),
(149, 1, 'Merchant Updated ', NULL, '2016-01-19 19:02:21'),
(150, 1, 'Store Updated', NULL, '2016-02-22 10:48:30'),
(151, 1, 'Store Updated', NULL, '2016-02-22 10:48:46'),
(152, 1, 'Store Updated', NULL, '2016-02-22 10:49:04'),
(153, 1, 'Store Updated', NULL, '2016-02-22 10:49:22'),
(154, 1, 'Store Updated', NULL, '2016-02-22 10:49:33'),
(155, 1, 'Store Updated', NULL, '2016-02-22 10:50:05'),
(156, 1, 'Store Updated', NULL, '2016-02-22 10:50:17'),
(157, 1, 'Merchant Updated ', NULL, '2016-02-22 11:16:32'),
(158, 1, 'Merchant Updated ', NULL, '2016-02-22 11:16:49'),
(159, 1, 'Merchant Updated ', NULL, '2016-02-22 11:16:58'),
(160, 1, 'Merchant Updated ', NULL, '2016-02-22 11:17:09'),
(161, 1, 'Merchant Updated ', NULL, '2016-02-22 11:17:21'),
(162, 1, 'Merchant Updated ', NULL, '2016-02-22 11:17:32'),
(163, 1, 'Merchant Updated ', NULL, '2016-02-22 11:17:44'),
(164, 1, 'Merchant Updated ', NULL, '2016-02-22 11:17:55'),
(165, 1, 'Merchant Updated ', NULL, '2016-02-22 11:18:04'),
(166, 1, 'Merchant Updated ', NULL, '2016-02-22 11:18:14'),
(167, 1, 'Users groups Created', NULL, '2016-02-22 11:28:29'),
(168, 1, 'Users groups Created', NULL, '2016-02-22 11:29:35'),
(169, 1, 'User Update', NULL, '2016-02-22 11:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `group_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `permission` varchar(255) DEFAULT NULL,
  `modify` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`group_id`, `name`, `permission`, `modify`) VALUES
(1, 'administrator', '["Adspackage","Category","City","Conversion","Coupons","Cuisine","Customer","Index","Merchant","Orders","Page","Payments","Products","Reports","Rewardbucket","Settings","State","Store","Users","Users_groups"]', '["Adspackage","Category","City","Conversion","Coupons","Cuisine","Customer","Index","Merchant","Orders","Page","Payments","Products","Reports","Rewardbucket","Settings","State","Store","Users","Users_groups"]'),
(2, 'Guest', '["Adspackage","Category","City","Conversion","Coupons","Cuisine","Customer","Index","Merchant","Orders","Page","Payments","Products","Reports","Rewardbucket","Settings","State","Store","Users","Users_groups"]', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `w_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `credit` decimal(10,2) DEFAULT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_history`
--

CREATE TABLE `wallet_history` (
  `wh_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `credit_used` decimal(10,2) DEFAULT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `ads_order`
--
ALTER TABLE `ads_order`
  ADD PRIMARY KEY (`ao_id`);

--
-- Indexes for table `ads_package`
--
ALTER TABLE `ads_package`
  ADD PRIMARY KEY (`asp_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `city_zipcode`
--
ALTER TABLE `city_zipcode`
  ADD PRIMARY KEY (`cz_id`);

--
-- Indexes for table `conversion`
--
ALTER TABLE `conversion`
  ADD PRIMARY KEY (`conversion_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `coupons_histroy`
--
ALTER TABLE `coupons_histroy`
  ADD PRIMARY KEY (`ch_id`);

--
-- Indexes for table `cusine_data`
--
ALTER TABLE `cusine_data`
  ADD PRIMARY KEY (`cu_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `customer_card_details`
--
ALTER TABLE `customer_card_details`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `customer_reward`
--
ALTER TABLE `customer_reward`
  ADD PRIMARY KEY (`customer_reward_id`);

--
-- Indexes for table `mail_templates`
--
ALTER TABLE `mail_templates`
  ADD PRIMARY KEY (`mt_id`);

--
-- Indexes for table `merchant`
--
ALTER TABLE `merchant`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `merchant_contact`
--
ALTER TABLE `merchant_contact`
  ADD PRIMARY KEY (`mc_id`);

--
-- Indexes for table `merchant_type`
--
ALTER TABLE `merchant_type`
  ADD PRIMARY KEY (`mt_id`);

--
-- Indexes for table `merchant_wallet`
--
ALTER TABLE `merchant_wallet`
  ADD PRIMARY KEY (`mw_id`);

--
-- Indexes for table `merchant_wallet_history`
--
ALTER TABLE `merchant_wallet_history`
  ADD PRIMARY KEY (`mwh_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `order_histroy`
--
ALTER TABLE `order_histroy`
  ADD PRIMARY KEY (`oh_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`oi_id`);

--
-- Indexes for table `order_item_option`
--
ALTER TABLE `order_item_option`
  ADD PRIMARY KEY (`item_option_id`);

--
-- Indexes for table `order_rating`
--
ALTER TABLE `order_rating`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Indexes for table `order_store`
--
ALTER TABLE `order_store`
  ADD PRIMARY KEY (`so_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `paypal_transaction_history`
--
ALTER TABLE `paypal_transaction_history`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_option`
--
ALTER TABLE `product_option`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `product_option_value`
--
ALTER TABLE `product_option_value`
  ADD PRIMARY KEY (`po_id`);

--
-- Indexes for table `product_to_category`
--
ALTER TABLE `product_to_category`
  ADD PRIMARY KEY (`ptc_id`);

--
-- Indexes for table `reedem_history`
--
ALTER TABLE `reedem_history`
  ADD PRIMARY KEY (`rh_id`);

--
-- Indexes for table `refer_credit_history`
--
ALTER TABLE `refer_credit_history`
  ADD PRIMARY KEY (`rch_id`);

--
-- Indexes for table `reward_bucket`
--
ALTER TABLE `reward_bucket`
  ADD PRIMARY KEY (`rb_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `store_cuisine_data`
--
ALTER TABLE `store_cuisine_data`
  ADD PRIMARY KEY (`scd_id`);

--
-- Indexes for table `store_delivery_zip`
--
ALTER TABLE `store_delivery_zip`
  ADD PRIMARY KEY (`sdz_id`);

--
-- Indexes for table `store_review`
--
ALTER TABLE `store_review`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`w_id`);

--
-- Indexes for table `wallet_history`
--
ALTER TABLE `wallet_history`
  ADD PRIMARY KEY (`wh_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ads_order`
--
ALTER TABLE `ads_order`
  MODIFY `ao_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ads_package`
--
ALTER TABLE `ads_package`
  MODIFY `asp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `city_zipcode`
--
ALTER TABLE `city_zipcode`
  MODIFY `cz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT for table `conversion`
--
ALTER TABLE `conversion`
  MODIFY `conversion_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `coupons_histroy`
--
ALTER TABLE `coupons_histroy`
  MODIFY `ch_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cusine_data`
--
ALTER TABLE `cusine_data`
  MODIFY `cu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer_card_details`
--
ALTER TABLE `customer_card_details`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_reward`
--
ALTER TABLE `customer_reward`
  MODIFY `customer_reward_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mail_templates`
--
ALTER TABLE `mail_templates`
  MODIFY `mt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `merchant`
--
ALTER TABLE `merchant`
  MODIFY `m_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `merchant_contact`
--
ALTER TABLE `merchant_contact`
  MODIFY `mc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `merchant_type`
--
ALTER TABLE `merchant_type`
  MODIFY `mt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `merchant_wallet`
--
ALTER TABLE `merchant_wallet`
  MODIFY `mw_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `merchant_wallet_history`
--
ALTER TABLE `merchant_wallet_history`
  MODIFY `mwh_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_histroy`
--
ALTER TABLE `order_histroy`
  MODIFY `oh_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `oi_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_item_option`
--
ALTER TABLE `order_item_option`
  MODIFY `item_option_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_rating`
--
ALTER TABLE `order_rating`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `order_store`
--
ALTER TABLE `order_store`
  MODIFY `so_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `paypal_transaction_history`
--
ALTER TABLE `paypal_transaction_history`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;
--
-- AUTO_INCREMENT for table `product_option`
--
ALTER TABLE `product_option`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `product_option_value`
--
ALTER TABLE `product_option_value`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;
--
-- AUTO_INCREMENT for table `product_to_category`
--
ALTER TABLE `product_to_category`
  MODIFY `ptc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;
--
-- AUTO_INCREMENT for table `reedem_history`
--
ALTER TABLE `reedem_history`
  MODIFY `rh_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `refer_credit_history`
--
ALTER TABLE `refer_credit_history`
  MODIFY `rch_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reward_bucket`
--
ALTER TABLE `reward_bucket`
  MODIFY `rb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `store_cuisine_data`
--
ALTER TABLE `store_cuisine_data`
  MODIFY `scd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `store_delivery_zip`
--
ALTER TABLE `store_delivery_zip`
  MODIFY `sdz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=485;
--
-- AUTO_INCREMENT for table `store_review`
--
ALTER TABLE `store_review`
  MODIFY `sr_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;
--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wallet_history`
--
ALTER TABLE `wallet_history`
  MODIFY `wh_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
