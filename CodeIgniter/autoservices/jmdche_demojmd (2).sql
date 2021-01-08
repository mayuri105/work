-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 24, 2017 at 07:29 PM
-- Server version: 5.6.37
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jmdche_demojmd`
--

-- --------------------------------------------------------

--
-- Table structure for table `amc`
--

CREATE TABLE `amc` (
  `amc_id` int(11) UNSIGNED NOT NULL,
  `registration_date` varchar(100) DEFAULT NULL,
  `validity_from_date` varchar(100) DEFAULT NULL,
  `validity_to_date` varchar(100) DEFAULT NULL,
  `km` varchar(100) NOT NULL,
  `reg_no` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mob_no` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `make` varchar(200) NOT NULL,
  `amount` float NOT NULL,
  `sgst` float NOT NULL,
  `cgst` float NOT NULL,
  `total_amt` float NOT NULL,
  `gstin_no` varchar(200) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `amc`
--

INSERT INTO `amc` (`amc_id`, `registration_date`, `validity_from_date`, `validity_to_date`, `km`, `reg_no`, `customer`, `address`, `mob_no`, `email`, `make`, `amount`, `sgst`, `cgst`, `total_amt`, `gstin_no`, `added_date`) VALUES
(1, '17-08-2017', '17-08-2017', '17-08-2019', '160000', 'REG-001', 'Mayuri Patel', 'Vadodara Gujarat India', '7600861912', 'patelmayuri355@gmail.com', 'MODEL-00078', 8474.58, 762.71, 762.71, 10000, 'Gstin-0001', '2017-09-14 23:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `cares`
--

CREATE TABLE `cares` (
  `car_id` int(10) UNSIGNED NOT NULL,
  `certificate_no` varchar(100) DEFAULT NULL,
  `certificate_date` varchar(255) DEFAULT NULL,
  `name` varchar(90) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `registration_date` varchar(255) DEFAULT NULL,
  `benifit_fromdate` varchar(255) DEFAULT NULL,
  `benifit_todate` varchar(255) DEFAULT NULL,
  `cover_note` varchar(45) DEFAULT NULL,
  `policy_no` varchar(45) DEFAULT NULL,
  `expiry` varchar(255) DEFAULT NULL,
  `mob_no` varchar(100) DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  `reg_no` varchar(45) DEFAULT NULL,
  `amount` float UNSIGNED DEFAULT NULL,
  `sgst` float DEFAULT NULL,
  `cgst` float DEFAULT NULL,
  `total_amt` varchar(45) DEFAULT NULL,
  `payment_mode` varchar(20) DEFAULT NULL,
  `terms` varchar(500) DEFAULT NULL,
  `profitvalue` float DEFAULT NULL,
  `gstin_no` varchar(200) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cares`
--

INSERT INTO `cares` (`car_id`, `certificate_no`, `certificate_date`, `name`, `address`, `email`, `registration_date`, `benifit_fromdate`, `benifit_todate`, `cover_note`, `policy_no`, `expiry`, `mob_no`, `model`, `reg_no`, `amount`, `sgst`, `cgst`, `total_amt`, `payment_mode`, `terms`, `profitvalue`, `gstin_no`, `added_date`) VALUES
(1, 'CRT-001', '2017-08-14', 'demo test', '  Vadodara Gujarat India', 'devid@gmail.com', '2017-08-14', '2017-08-14', '2018-08-14', NULL, NULL, NULL, '6512345678', '001ADM', 'REG-001', 8474.58, 762.71, 762.71, '10000', 'cash', 'blog_dt2.jpg', 6000, '', '2017-08-14 15:32:29'),
(2, '4317', '29-08-2017', 'NITIN H KARNIK', '  E-205/206 KRISHNA CHS PLOT NO-10 SECTOR-36 KAMOTHE NAVI MUMBAI-410209', 'ankarnik002@gmail.com', '29-08-2017', '29-08-2017', '35-02-07', NULL, NULL, NULL, '7021967790', 'SKODA RAPID STYLE MT 1.6 MPI', 'MH46 BK 6048', 8283.05, 745.47, 745.47, '9774', 'CASH', 'NITIN_H_KARNIK_-Y.jpg', 9774, '', '2017-08-16 05:40:51'),
(3, 'CRT-003', '10-03-2017', 'demo test3', '    Vadodara Gujarat India', '', '2017-08-17', '2017-08-17', '2018-08-17', NULL, NULL, NULL, '3232323223', '004ADM', 'REG-004', 8474.58, 762.71, 762.71, '10000', 'cash', '2.jpg', 10000, 'Gstin-0001', '2017-08-17 13:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `claims_cares`
--

CREATE TABLE `claims_cares` (
  `cares_claim_id` int(11) NOT NULL,
  `cares_id` int(11) NOT NULL,
  `location` varchar(8) DEFAULT NULL,
  `invoiceno` varchar(100) DEFAULT NULL,
  `certi_date` varchar(255) DEFAULT NULL,
  `claim_date` varchar(255) DEFAULT NULL,
  `customer` varchar(46) DEFAULT NULL,
  `vehicleno` varchar(100) DEFAULT NULL,
  `totalamt` varchar(100) DEFAULT NULL,
  `insurancelaibility` varchar(100) DEFAULT NULL,
  `customerlaibility` varchar(100) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `claims_cares`
--

INSERT INTO `claims_cares` (`cares_claim_id`, `cares_id`, `location`, `invoiceno`, `certi_date`, `claim_date`, `customer`, `vehicleno`, `totalamt`, `insurancelaibility`, `customerlaibility`, `added_date`) VALUES
(1, 1, 'bhandup', 'INV-001', '2017-08-14', '2017-08-30', 'demo test', '00V1', '9000', '1000', '1000', '2017-08-14 15:34:16'),
(2, 1, 'bhandup', 'INV-002', '2017-08-14', '2017-09-07', 'demo test', '00V1', '8000', '1000', '1000', '2017-08-14 15:34:56'),
(3, 1, 'bhandup', 'INV-003', '2017-08-14', '2017-09-09', 'demo test', '00V1', '6000', '1000', '2000', '2017-08-14 15:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `claims_vfm`
--

CREATE TABLE `claims_vfm` (
  `vfm_claim_id` int(11) NOT NULL,
  `vfm_id` int(11) NOT NULL,
  `location` varchar(8) DEFAULT NULL,
  `invoiceno` varchar(100) DEFAULT NULL,
  `certi_date` varchar(255) DEFAULT NULL,
  `claim_date` varchar(255) DEFAULT NULL,
  `customer` varchar(46) DEFAULT NULL,
  `vehicleno` varchar(100) DEFAULT NULL,
  `totalamt` varchar(100) DEFAULT NULL,
  `insurancelaibility` varchar(100) DEFAULT NULL,
  `customerlaibility` varchar(100) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `claims_wtp`
--

CREATE TABLE `claims_wtp` (
  `wtp_claim_id` int(11) NOT NULL,
  `wtp_id` int(11) NOT NULL,
  `location` varchar(8) DEFAULT NULL,
  `invoiceno` varchar(100) DEFAULT NULL,
  `certi_date` varchar(255) DEFAULT NULL,
  `claim_date` varchar(255) DEFAULT NULL,
  `customer` varchar(46) DEFAULT NULL,
  `vehicleno` varchar(100) DEFAULT NULL,
  `totalamt` varchar(100) DEFAULT NULL,
  `insurancelaibility` varchar(100) DEFAULT NULL,
  `customerlaibility` varchar(100) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `name`, `added_date`) VALUES
(2, 'bhandup', '2017-08-11 03:18:09'),
(3, 'nerul', '2017-08-11 03:18:03'),
(4, 'Kandivali', '2017-08-16 05:53:32'),
(5, 'Testa', '2017-09-23 14:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `membership_id` int(11) UNSIGNED NOT NULL,
  `card_no` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `reg_no` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mob_no` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '0000-00-00',
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `gstin_no` varchar(200) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`membership_id`, `card_no`, `fromdate`, `todate`, `reg_no`, `customer`, `address`, `mob_no`, `birthdate`, `email`, `gstin_no`, `added_date`) VALUES
(2, 'saSA', '2017-08-11', '2017-08-11', '004', 'Mik  Patel', 'Vadodara Gujarat India', '7600861912', '2017-08-11', 'patelmayuri355@gmail.com', '', '2017-08-10 23:54:55'),
(3, 'ASD123', '2017-08-11', '2017-08-24', '005', 'Cevin Ray', 'Vadodara Gujarat India', '7600861912', '2017-08-18', 'patelmayuri355@gmail.com', '', '2017-08-10 23:55:19'),
(4, 'dasda009', '0000-00-00', '0000-00-00', '4234', 'dasdsa', 'dsdasdsad', '32423424234', '15-09-2017', 'mayuri@gmail.com', 'Gstin-0001', '2017-09-15 00:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `mfree`
--

CREATE TABLE `mfree` (
  `mfree_id` int(11) UNSIGNED NOT NULL,
  `card_no` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `issue_date` varchar(100) DEFAULT NULL,
  `validity_from_date` varchar(100) DEFAULT NULL,
  `validity_to_date` varchar(100) DEFAULT NULL,
  `km` varchar(100) NOT NULL,
  `reg_no` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mob_no` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` float NOT NULL,
  `sgst` float NOT NULL,
  `cgst` float NOT NULL,
  `total_amt` float NOT NULL,
  `gstin_no` varchar(200) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mfree`
--

INSERT INTO `mfree` (`mfree_id`, `card_no`, `issue_date`, `validity_from_date`, `validity_to_date`, `km`, `reg_no`, `customer`, `address`, `mob_no`, `email`, `amount`, `sgst`, `cgst`, `total_amt`, `gstin_no`, `added_date`) VALUES
(1, 'CRD001', '17-08-2017', '17-08-2017', '17-08-2019', '160000', 'REG-001', 'Mayuri Patel', 'Vadodara Gujarat India', '7600861912', 'patelmayuri355@gmail.com', 8474.58, 762.71, 762.71, 10000, NULL, '2017-08-17 15:59:11'),
(2, 'dsads', '15-09-2017', '15-09-2017', '22-09-2017', '1200', '000123', 'dsds', 'sdsdsada', '32423424234', 'mayuri@gmail.com', 17966.1, 1616.95, 1616.95, 21200, 'Gstin-0001', '2017-09-23 14:25:52');

-- --------------------------------------------------------

--
-- Table structure for table `plus`
--

CREATE TABLE `plus` (
  `plus_id` int(11) UNSIGNED NOT NULL,
  `certificate_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `certi_date` varchar(100) DEFAULT NULL,
  `ben_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ben_addr` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ben_mobno` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_no` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `make` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `certi_fromdate` varchar(100) DEFAULT NULL,
  `certi_todate` varchar(100) DEFAULT NULL,
  `km` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `sgst` float NOT NULL,
  `cgst` float NOT NULL,
  `total_amt` float NOT NULL,
  `terms` varchar(255) NOT NULL,
  `gstin_no` varchar(200) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plus`
--

INSERT INTO `plus` (`plus_id`, `certificate_no`, `certi_date`, `ben_name`, `ben_addr`, `ben_mobno`, `email`, `reg_no`, `make`, `certi_fromdate`, `certi_todate`, `km`, `amount`, `sgst`, `cgst`, `total_amt`, `terms`, `gstin_no`, `added_date`) VALUES
(1, 'CRT-0012', '17-08-2017', 'Mayuri Patel', 'Vadodara Gujarat India', '07600861912', 'patelmayuri355@gmail.com', 'REG-001', '11234', '17-08-2017', '17-08-2019', '1600', 8474.58, 762.71, 762.71, 10000, '52.jpg', 'Gstin-0001', '2017-08-17 15:09:48');

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
(2, 'site_name', 'jmdchevrolet'),
(3, 'front_theme', 'default'),
(4, 'email_address', 'support@jmdchevrolet.com'),
(5, 'admin_forgott_mail_template', 'Hello {username} ,<br >Your password is {password}<br />To login click {login_page_link} ,<br ><br >Thank You<br />{company_name}'),
(7, 'mail_protocol', 'smtp'),
(8, 'smtp_host', 'mail.jmdchevrolet.com'),
(9, 'smtp_port', '465'),
(10, 'smtp_timeout', '50'),
(11, 'smtp_user', 'support@jmdchevrolet.com'),
(12, 'smtp_pass', 'jmdchevrolet'),
(13, 'customer_forgott_mail_template', 'Hello {username} ,<br >Your password is {password}<br />To login click {login_page_link} ,<br ><br >Thank You<br />{company_name}'),
(18, 'company_name', 'jmdchevrolet'),
(19, 'currency', 'USD'),
(20, 'facebook', 'http://Facebook.com/jmdchevrolet'),
(21, 'twitter', 'http://Twitter.com/jmdchevrolet'),
(22, 'instagram', 'http://instagram.com/jmdchevrolet'),
(23, 'googleplus', 'http://googleplus.com/jmdchevrolet'),
(40, 'owner', 'jmdchevrolet'),
(41, 'address', 'Repudiandae in voluptas saepe suscipit eos exercitationem id, tenetur voluptatum quia labore possimus, veritatis ea beatae.'),
(42, 'phone', '232323232323'),
(43, 'language', 'en'),
(44, 'gst', '9'),
(45, 'per_page', '10'),
(46, 'meta_titles', 'Consequat Est blanditiis iste quibusdam autem ad sint saepe voluptatem sit nesciunt voluptatem culpa'),
(47, 'meta_descriptions', 'Numquam odio accusantium hic quia totam aliquam ullamco harum qui tenetur voluptatem. Quam aspernatur doloribus ipsum.'),
(48, 'meta_keywords', 'Asperiores obcaecati velit, in reprehenderit, quod similique adipisci velit, in rerum debitis recusandae. Veniam.'),
(56, 'site_url', 'http://jmdchevrolet.com/'),
(57, 'domain_name', 'jmdchevrolet.com');

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
(1, 2, 'jmdadmin', 'e6e061838856bf47e1de730719fb2609', 'Devid', 'jhone', 'admin@admin.com', 1, '2017-09-23 14:23:50', '2017-09-23 14:20:14', '0000-00-00 00:00:00', '::1'),
(4, 1, 'jmdcare', '827ccb0eea8a706c4c34a16891f84e7b', 'Jhon', 'Roy', 'jhon@gmail.com', 1, '2017-09-23 16:24:22', '2017-06-29 08:15:54', '2017-06-29 08:08:52', '::1');

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
(1, 'admin', '[\"Cares\",\"Home\",\"Location\",\"Membership\",\"Menu\",\"Mfree\",\"Plus\",\"Users\",\"Users_groups\",\"Vfm\",\"Wtf\",\"Amc\"]', '[\"Home\",\"Location\",\"Menu\"]'),
(2, 'superadmin', '[\"Cares\",\"Home\",\"Location\",\"Membership\",\"Menu\",\"Mfree\",\"Plus\",\"Users\",\"Users_groups\",\"Vfm\",\"Wtf\",\"Amc\"]', '[\"Cares\",\"Home\",\"Location\",\"Membership\",\"Menu\",\"Mfree\",\"Plus\",\"Users\",\"Users_groups\",\"Vfm\",\"Wtf\",\"Amc\"]');

-- --------------------------------------------------------

--
-- Table structure for table `vfm`
--

CREATE TABLE `vfm` (
  `vfm_id` int(11) UNSIGNED NOT NULL,
  `certificate_no` varchar(100) DEFAULT NULL,
  `certificate_date` varchar(255) DEFAULT NULL,
  `name` varchar(90) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `registration_date` varchar(255) DEFAULT NULL,
  `benifit_fromdate` varchar(255) DEFAULT NULL,
  `benifit_todate` varchar(255) DEFAULT NULL,
  `cover_note` varchar(45) DEFAULT NULL,
  `policy_no` varchar(45) DEFAULT NULL,
  `expiry` varchar(255) DEFAULT NULL,
  `mob_no` varchar(100) DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  `reg_no` varchar(45) DEFAULT NULL,
  `amount` float UNSIGNED DEFAULT NULL,
  `sgst` float DEFAULT NULL,
  `cgst` float NOT NULL,
  `total_amt` varchar(45) DEFAULT NULL,
  `payment_mode` varchar(20) DEFAULT NULL,
  `terms` varchar(255) DEFAULT NULL,
  `gstin_no` varchar(200) DEFAULT NULL,
  `profitvalue` float DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vfm`
--

INSERT INTO `vfm` (`vfm_id`, `certificate_no`, `certificate_date`, `name`, `address`, `email`, `registration_date`, `benifit_fromdate`, `benifit_todate`, `cover_note`, `policy_no`, `expiry`, `mob_no`, `model`, `reg_no`, `amount`, `sgst`, `cgst`, `total_amt`, `payment_mode`, `terms`, `gstin_no`, `profitvalue`, `added_date`) VALUES
(1, 'CRT-001', '17-08-2017', 'Mayuri Patel', ' Vadodara Gujarat India', 'patelmayuri355@gmail.com', '17-08-2017', '17-08-2017', '17-08-2018', NULL, NULL, NULL, '7600861912', '001ADM', 'REG-001', 8474.58, 762.71, 762.71, '10000', 'cash', '3.jpg', 'Gstin-0001', 10000, '2017-08-17 17:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `wtp`
--

CREATE TABLE `wtp` (
  `wtp_id` int(11) UNSIGNED NOT NULL,
  `certificate_no` varchar(100) DEFAULT NULL,
  `certificate_date` varchar(255) DEFAULT NULL,
  `name` varchar(90) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `registration_date` varchar(255) DEFAULT NULL,
  `benifit_fromdate` varchar(255) DEFAULT NULL,
  `benifit_todate` varchar(255) DEFAULT NULL,
  `cover_note` varchar(45) DEFAULT NULL,
  `policy_no` varchar(45) DEFAULT NULL,
  `expiry` varchar(255) DEFAULT NULL,
  `mob_no` varchar(100) DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  `reg_no` varchar(45) DEFAULT NULL,
  `amount` float UNSIGNED DEFAULT NULL,
  `km` varchar(100) DEFAULT NULL,
  `sgst` float DEFAULT NULL,
  `cgst` float NOT NULL,
  `total_amt` varchar(45) DEFAULT NULL,
  `gstin_no` varchar(200) DEFAULT NULL,
  `payment_mode` varchar(20) DEFAULT NULL,
  `terms` varchar(255) DEFAULT NULL,
  `profitvalue` float DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wtp`
--

INSERT INTO `wtp` (`wtp_id`, `certificate_no`, `certificate_date`, `name`, `address`, `email`, `registration_date`, `benifit_fromdate`, `benifit_todate`, `cover_note`, `policy_no`, `expiry`, `mob_no`, `model`, `reg_no`, `amount`, `km`, `sgst`, `cgst`, `total_amt`, `gstin_no`, `payment_mode`, `terms`, `profitvalue`, `added_date`) VALUES
(1, 'CRT-001', '17-08-2017', 'Mayuri Patel', '     Vadodara Gujarat India', 'patelmayuri355@gmail.com', '17-08-2017', '17-08-2017', '17-08-2020', NULL, NULL, NULL, '7600861912', '001ADM', 'REG-001', 8474.58, '160000', 762.71, 762.71, '10000', 'Gstin-0001', 'cash', '21.jpg', 10000, '2017-08-17 16:19:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amc`
--
ALTER TABLE `amc`
  ADD PRIMARY KEY (`amc_id`);

--
-- Indexes for table `cares`
--
ALTER TABLE `cares`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `claims_cares`
--
ALTER TABLE `claims_cares`
  ADD PRIMARY KEY (`cares_claim_id`),
  ADD KEY `cares_id` (`cares_id`),
  ADD KEY `cares_id_2` (`cares_id`);

--
-- Indexes for table `claims_vfm`
--
ALTER TABLE `claims_vfm`
  ADD PRIMARY KEY (`vfm_claim_id`),
  ADD KEY `cares_id` (`vfm_id`),
  ADD KEY `cares_id_2` (`vfm_id`);

--
-- Indexes for table `claims_wtp`
--
ALTER TABLE `claims_wtp`
  ADD PRIMARY KEY (`wtp_claim_id`),
  ADD KEY `cares_id` (`wtp_id`),
  ADD KEY `cares_id_2` (`wtp_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`membership_id`);

--
-- Indexes for table `mfree`
--
ALTER TABLE `mfree`
  ADD PRIMARY KEY (`mfree_id`);

--
-- Indexes for table `plus`
--
ALTER TABLE `plus`
  ADD PRIMARY KEY (`plus_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `vfm`
--
ALTER TABLE `vfm`
  ADD PRIMARY KEY (`vfm_id`);

--
-- Indexes for table `wtp`
--
ALTER TABLE `wtp`
  ADD PRIMARY KEY (`wtp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amc`
--
ALTER TABLE `amc`
  MODIFY `amc_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cares`
--
ALTER TABLE `cares`
  MODIFY `car_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `claims_cares`
--
ALTER TABLE `claims_cares`
  MODIFY `cares_claim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `claims_vfm`
--
ALTER TABLE `claims_vfm`
  MODIFY `vfm_claim_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `claims_wtp`
--
ALTER TABLE `claims_wtp`
  MODIFY `wtp_claim_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `membership_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mfree`
--
ALTER TABLE `mfree`
  MODIFY `mfree_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `plus`
--
ALTER TABLE `plus`
  MODIFY `plus_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vfm`
--
ALTER TABLE `vfm`
  MODIFY `vfm_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wtp`
--
ALTER TABLE `wtp`
  MODIFY `wtp_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
