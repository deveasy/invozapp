-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 04, 2022 at 04:29 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gpha`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
CREATE TABLE IF NOT EXISTS `assets` (
  `asset_code` int NOT NULL AUTO_INCREMENT,
  `asset_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `asset_category` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `barcode` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `asset_image` mediumblob,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT CURRENT_TIMESTAMP,
  `reorder_level` int DEFAULT NULL,
  `serial_number` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `manufacture_date` datetime DEFAULT NULL,
  PRIMARY KEY (`asset_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `asset_categories`
--

DROP TABLE IF EXISTS `asset_categories`;
CREATE TABLE IF NOT EXISTS `asset_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) DEFAULT NULL,
  `category_description` text,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset_categories`
--

INSERT INTO `asset_categories` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'PCS, LAPTOPS & TABLE', 'Category for computing devices'),
(3, 'SERVERS', 'Category for all servers'),
(5, 'PRINTERS, SCANNERS & PHOTOCOPIERS', 'Category for all imaging devices in GPHA.'),
(6, 'NETWORK & COMMUNICATION DEVICES', 'Category for networking and communication equipments.');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `timestamp` int DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('052tuik65et1oqcid94k4pvj3689ojds', '::1', 1642680027, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323638303032373b6c6f676765645f696e7c613a353a7b733a383a2273746166665f6964223b733a313a2231223b733a393a2266697273746e616d65223b733a383a22456d6d616e75656c223b733a383a226c6173746e616d65223b733a363a22596172746579223b733a343a22726f6c65223b733a313a2231223b733a383a226c6f636174696f6e223b733a323a225332223b7d),
('3ol921sdoie92ob9bjfekck7qlog0mjt', '::1', 1643298253, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333239383035393b6c6f676765645f696e7c613a353a7b733a383a2273746166665f6964223b733a313a2231223b733a393a2266697273746e616d65223b733a383a22456d6d616e75656c223b733a383a226c6173746e616d65223b733a363a22596172746579223b733a343a22726f6c65223b733a313a2231223b733a383a226c6f636174696f6e223b733a323a225332223b7d),
('6lhg8jfq7oidi0sh258kdlvggkg2tbm4', '::1', 1643292221, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333239323231393b),
('8k47485fo23suhbcvsm89af6o020ms8u', '::1', 1643300249, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333330303234393b6c6f676765645f696e7c613a353a7b733a383a2273746166665f6964223b733a313a2231223b733a393a2266697273746e616d65223b733a383a22456d6d616e75656c223b733a383a226c6173746e616d65223b733a363a22596172746579223b733a343a22726f6c65223b733a313a2231223b733a383a226c6f636174696f6e223b733a323a225332223b7d),
('d47gn8r1t58obcf24p5leu0g9nqh0o07', '::1', 1643610628, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333631303632383b),
('e55oer7maa93on83fe4h23kegp74ibtv', '::1', 1642680633, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323638303633333b6c6f676765645f696e7c613a353a7b733a383a2273746166665f6964223b733a313a2231223b733a393a2266697273746e616d65223b733a383a22456d6d616e75656c223b733a383a226c6173746e616d65223b733a363a22596172746579223b733a343a22726f6c65223b733a313a2231223b733a383a226c6f636174696f6e223b733a323a225332223b7d),
('efk4j1vqvnaofeer6i4iiaafhcmtmg72', '::1', 1643356630, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333335363633303b),
('fprasg7kucnitgnunjrf0a1i7ijq0ugs', '::1', 1642678691, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323637383639313b6c6f676765645f696e7c613a353a7b733a383a2273746166665f6964223b733a313a2231223b733a393a2266697273746e616d65223b733a383a22456d6d616e75656c223b733a383a226c6173746e616d65223b733a363a22596172746579223b733a343a22726f6c65223b733a313a2231223b733a383a226c6f636174696f6e223b733a323a225332223b7d),
('frcc0vnlpjjv53tm2970l1i1skjkpbql', '::1', 1643299829, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333239393832393b6c6f676765645f696e7c613a353a7b733a383a2273746166665f6964223b733a313a2231223b733a393a2266697273746e616d65223b733a383a22456d6d616e75656c223b733a383a226c6173746e616d65223b733a363a22596172746579223b733a343a22726f6c65223b733a313a2231223b733a383a226c6f636174696f6e223b733a323a225332223b7d),
('hpk660ivqn2sg6pffs4rfi19mdmaqvo1', '::1', 1642679591, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323637393539313b6c6f676765645f696e7c613a353a7b733a383a2273746166665f6964223b733a313a2231223b733a393a2266697273746e616d65223b733a383a22456d6d616e75656c223b733a383a226c6173746e616d65223b733a363a22596172746579223b733a343a22726f6c65223b733a313a2231223b733a383a226c6f636174696f6e223b733a323a225332223b7d),
('io1i9kslrrpkoji0p1af7lodtr7ssm23', '::1', 1642680332, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323638303333323b6c6f676765645f696e7c613a353a7b733a383a2273746166665f6964223b733a313a2231223b733a393a2266697273746e616d65223b733a383a22456d6d616e75656c223b733a383a226c6173746e616d65223b733a363a22596172746579223b733a343a22726f6c65223b733a313a2231223b733a383a226c6f636174696f6e223b733a323a225332223b7d),
('jgk6s9brjohsa6dvmtmrrd4cptmhsi0u', '::1', 1642767720, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323736373731383b),
('m7lcfsnue8brt5nkkk7fllljro41r03f', '::1', 1642682843, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323638323734303b6c6f676765645f696e7c613a353a7b733a383a2273746166665f6964223b733a313a2231223b733a393a2266697273746e616d65223b733a383a22456d6d616e75656c223b733a383a226c6173746e616d65223b733a363a22596172746579223b733a343a22726f6c65223b733a313a2231223b733a383a226c6f636174696f6e223b733a323a225332223b7d),
('mdcfk938d9t4eq8bi03jdsjijlu1qnjh', '::1', 1643301127, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333330313132373b6c6f676765645f696e7c613a353a7b733a383a2273746166665f6964223b733a313a2231223b733a393a2266697273746e616d65223b733a383a22456d6d616e75656c223b733a383a226c6173746e616d65223b733a363a22596172746579223b733a343a22726f6c65223b733a313a2231223b733a383a226c6f636174696f6e223b733a323a225332223b7d),
('mh03togqluaumea5jrvh99gt6dku2s8t', '::1', 1643300584, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333330303538343b6c6f676765645f696e7c613a353a7b733a383a2273746166665f6964223b733a313a2231223b733a393a2266697273746e616d65223b733a383a22456d6d616e75656c223b733a383a226c6173746e616d65223b733a363a22596172746579223b733a343a22726f6c65223b733a313a2231223b733a383a226c6f636174696f6e223b733a323a225332223b7d),
('oeq89il5gvh2nh766dasq8c7jj9uii5m', '::1', 1643301127, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333330313132373b),
('rdbrlbrsatuv03egsrobt6h83a7vjiel', '::1', 1642680633, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323638303633333b6c6f676765645f696e7c613a353a7b733a383a2273746166665f6964223b733a313a2231223b733a393a2266697273746e616d65223b733a383a22456d6d616e75656c223b733a383a226c6173746e616d65223b733a363a22596172746579223b733a343a22726f6c65223b733a313a2231223b733a383a226c6f636174696f6e223b733a323a225332223b7d),
('suofjhqfalvieirinu987mtkhk0ldh9d', '::1', 1642682740, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323638323734303b6c6f676765645f696e7c613a353a7b733a383a2273746166665f6964223b733a313a2231223b733a393a2266697273746e616d65223b733a383a22456d6d616e75656c223b733a383a226c6173746e616d65223b733a363a22596172746579223b733a343a22726f6c65223b733a313a2231223b733a383a226c6f636174696f6e223b733a323a225332223b7d),
('tle6orgsnglk3trie6vcrf09c04gahlo', '::1', 1642679223, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323637393232333b6c6f676765645f696e7c613a353a7b733a383a2273746166665f6964223b733a313a2231223b733a393a2266697273746e616d65223b733a383a22456d6d616e75656c223b733a383a226c6173746e616d65223b733a363a22596172746579223b733a343a22726f6c65223b733a313a2231223b733a383a226c6f636174696f6e223b733a323a225332223b7d);

-- --------------------------------------------------------

--
-- Table structure for table `company_information`
--

DROP TABLE IF EXISTS `company_information`;
CREATE TABLE IF NOT EXISTS `company_information` (
  `company_code` int NOT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `postal_address` text,
  `headquarters` varchar(50) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`company_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `company` varchar(150) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `email_address` varchar(150) DEFAULT NULL,
  `job_title` varchar(50) DEFAULT NULL,
  `business_phone` varchar(50) DEFAULT NULL,
  `home_phone` varchar(50) DEFAULT NULL,
  `mobile_phone` varchar(50) DEFAULT NULL,
  `fax_number` varchar(50) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state_province` varchar(50) DEFAULT NULL,
  `zip_postal_code` varchar(50) DEFAULT NULL,
  `country_region` varchar(150) DEFAULT NULL,
  `webpage` varchar(150) DEFAULT NULL,
  `notes` text,
  `attachment` varchar(150) DEFAULT NULL,
  `fileas` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_waybills`
--

DROP TABLE IF EXISTS `customer_waybills`;
CREATE TABLE IF NOT EXISTS `customer_waybills` (
  `waybill_id` int NOT NULL AUTO_INCREMENT,
  `invoice_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `shipping_amount` decimal(10,2) DEFAULT NULL,
  `sales_order_id` int DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `product_source` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`waybill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `device_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `location` int DEFAULT NULL,
  `configuration` text,
  PRIMARY KEY (`device_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
CREATE TABLE IF NOT EXISTS `issues` (
  `purchase_order_id` int NOT NULL AUTO_INCREMENT,
  `order_date` date NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `creation_date` date NOT NULL,
  `shipping_fee` decimal(10,0) NOT NULL,
  `taxes` decimal(10,0) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` decimal(10,0) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `notes` text NOT NULL,
  `order_subtotal` decimal(10,0) NOT NULL,
  `order_total` decimal(10,0) NOT NULL,
  `submitted_by` varchar(50) NOT NULL,
  `submitted_date` date NOT NULL,
  `closed_by` varchar(50) NOT NULL,
  `closed_date` date NOT NULL,
  `completed` tinyint(1) NOT NULL,
  `expected_date` date NOT NULL,
  `submitted` tinyint(1) NOT NULL,
  `new` tinyint(1) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`purchase_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int NOT NULL AUTO_INCREMENT,
  `location_name` varchar(100) DEFAULT NULL,
  `physical_address` varchar(50) DEFAULT NULL,
  `location_type` varchar(32) DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `markup_rate` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location_inventory`
--

DROP TABLE IF EXISTS `location_inventory`;
CREATE TABLE IF NOT EXISTS `location_inventory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `location_id` varchar(6) NOT NULL,
  `asset_code` varchar(10) DEFAULT NULL,
  `cost_price` decimal(10,2) DEFAULT NULL,
  `selling_price` decimal(10,2) DEFAULT NULL,
  `markup` decimal(4,2) NOT NULL,
  `quantity_in_stock` int NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `purchase_uom` varchar(10) DEFAULT NULL,
  `pos_uom` varchar(10) DEFAULT NULL,
  `pos_uom_qty` int NOT NULL,
  `expiry_date` varchar(15) DEFAULT NULL,
  `last_edited` varchar(15) DEFAULT NULL,
  `date_created` varchar(15) DEFAULT NULL,
  `shelf` varchar(10) DEFAULT NULL,
  `product_category` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_code` (`asset_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location_orders`
--

DROP TABLE IF EXISTS `location_orders`;
CREATE TABLE IF NOT EXISTS `location_orders` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `location_id` varchar(4) DEFAULT NULL,
  `order_id` bigint DEFAULT NULL,
  `staff_id` int DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `status` varchar(15) DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location_order_details`
--

DROP TABLE IF EXISTS `location_order_details`;
CREATE TABLE IF NOT EXISTS `location_order_details` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `order_id` bigint DEFAULT NULL,
  `product_code` varchar(50) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `no_stock` tinyint(1) DEFAULT NULL,
  `allocated` tinyint(1) DEFAULT NULL,
  `invoiced` tinyint(1) DEFAULT NULL,
  `shipped` tinyint(1) DEFAULT NULL,
  `back_ordered` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_details`
--

DROP TABLE IF EXISTS `purchase_order_details`;
CREATE TABLE IF NOT EXISTS `purchase_order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quantity` int NOT NULL,
  `unit_cost` decimal(10,0) NOT NULL,
  `extended_price` decimal(10,0) NOT NULL,
  `date_received` date NOT NULL,
  `purchase_order_number` int NOT NULL,
  `posted_to_inventory` tinyint(1) NOT NULL,
  `submitted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL,
  `role_description` varchar(100) NOT NULL,
  `privileges` text,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_description`, `privileges`) VALUES
(1, 'Super User', 'The IT super user admin of the application', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

DROP TABLE IF EXISTS `sales_orders`;
CREATE TABLE IF NOT EXISTS `sales_orders` (
  `order_id` bigint NOT NULL,
  `order_sub_total` decimal(10,2) DEFAULT NULL,
  `order_total` decimal(10,2) DEFAULT NULL,
  `staff_id` int DEFAULT NULL,
  `location_id` varchar(4) DEFAULT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `shipped_date` date DEFAULT NULL,
  `ship_address` varchar(150) DEFAULT NULL,
  `ship_city` varchar(100) DEFAULT NULL,
  `ship_state` varchar(100) DEFAULT NULL,
  `ship_zip` varchar(100) DEFAULT NULL,
  `ship_country` varchar(150) DEFAULT NULL,
  `ship_fee` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `notes` text,
  `tax_rate` decimal(10,2) DEFAULT NULL,
  `order_month` varchar(20) DEFAULT NULL,
  `order_year` year DEFAULT NULL,
  `closed_date` date DEFAULT NULL,
  `order_quarter` varchar(20) DEFAULT NULL,
  `ship_name` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `ship_via` varchar(50) DEFAULT NULL,
  `completed` tinyint(1) DEFAULT NULL,
  `shipped` tinyint(1) DEFAULT NULL,
  `invoiced` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `customer` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_details`
--

DROP TABLE IF EXISTS `sales_order_details`;
CREATE TABLE IF NOT EXISTS `sales_order_details` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `order_id` bigint NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `discount` double DEFAULT NULL,
  `extended_price` decimal(10,2) DEFAULT NULL,
  `status_id` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `no_stock` tinyint(1) DEFAULT NULL,
  `allocated` tinyint(1) DEFAULT NULL,
  `invoiced` tinyint(1) DEFAULT NULL,
  `shipped` tinyint(1) DEFAULT NULL,
  `back_ordered` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `settings_name` varchar(20) DEFAULT NULL,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

DROP TABLE IF EXISTS `shifts`;
CREATE TABLE IF NOT EXISTS `shifts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `supervisor` int DEFAULT NULL,
  `shift_name` varchar(30) DEFAULT NULL,
  `start_time` varchar(10) DEFAULT NULL,
  `end_time` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `location_id` varchar(4) DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `gender` varchar(8) DEFAULT NULL,
  `nationality` varchar(150) DEFAULT NULL,
  `city` varchar(150) DEFAULT NULL,
  `mobile_phone` varchar(50) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `firstname`, `lastname`, `dob`, `location_id`, `role_id`, `address`, `gender`, `nationality`, `city`, `mobile_phone`, `username`, `password`, `last_login`) VALUES
(1, 'Emmanuel', 'Yartey', '2017-07-04', 'S2', 1, NULL, NULL, NULL, NULL, NULL, 'admin', '0192023a7bbd73250516f069df18b500', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_location`
--

DROP TABLE IF EXISTS `staff_location`;
CREATE TABLE IF NOT EXISTS `staff_location` (
  `id` int NOT NULL AUTO_INCREMENT,
  `staff_id` int NOT NULL,
  `location_id` varchar(5) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL COMMENT 'tracks whether in location or not',
  `date_change` date DEFAULT NULL COMMENT 'date status changed in location',
  PRIMARY KEY (`id`),
  UNIQUE KEY `location_id` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_shift`
--

DROP TABLE IF EXISTS `staff_shift`;
CREATE TABLE IF NOT EXISTS `staff_shift` (
  `id` int NOT NULL AUTO_INCREMENT,
  `staff_id` int NOT NULL,
  `shift_id` int NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company` varchar(100) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `contact_person_job_title` varchar(50) DEFAULT NULL,
  `business_phone` varchar(50) DEFAULT NULL,
  `home_phone` varchar(50) DEFAULT NULL,
  `mobile_phone` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state_province` varchar(50) DEFAULT NULL,
  `zip_postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(150) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `notes` text,
  `attachments` varchar(50) DEFAULT NULL,
  `supplier_name` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_products`
--

DROP TABLE IF EXISTS `suppliers_products`;
CREATE TABLE IF NOT EXISTS `suppliers_products` (
  `id` int NOT NULL,
  `supplier_id` int NOT NULL,
  `product_id` int NOT NULL,
  `order_qty` int NOT NULL,
  `current_qty` int NOT NULL,
  `estimated_order` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions_history`
--

DROP TABLE IF EXISTS `transactions_history`;
CREATE TABLE IF NOT EXISTS `transactions_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `details` text,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

DROP TABLE IF EXISTS `transfers`;
CREATE TABLE IF NOT EXISTS `transfers` (
  `transfer_id` int NOT NULL,
  `source` varchar(4) DEFAULT NULL,
  `destination` varchar(4) DEFAULT NULL,
  `transfer_date` varchar(10) DEFAULT NULL,
  `transfer_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `staff_id` int DEFAULT NULL,
  `seen_status` varchar(15) DEFAULT 'unseen',
  `dispatcher` varchar(30) DEFAULT NULL,
  `vehicle_number` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`transfer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_details`
--

DROP TABLE IF EXISTS `transfer_details`;
CREATE TABLE IF NOT EXISTS `transfer_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transfer_id` int DEFAULT NULL,
  `product_code` varchar(10) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `status` varchar(15) DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `units_of_measure`
--

DROP TABLE IF EXISTS `units_of_measure`;
CREATE TABLE IF NOT EXISTS `units_of_measure` (
  `id` int NOT NULL AUTO_INCREMENT,
  `short_description` varchar(5) DEFAULT NULL,
  `description` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
