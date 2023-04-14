/*
Navicat MySQL Data Transfer

Source Server         : server
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2023-04-14 18:39:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `accounts`
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_uuid` varchar(255) DEFAULT NULL,
  `acc_name` varchar(255) DEFAULT NULL,
  `acc_image` varchar(255) DEFAULT NULL,
  `acc_website` varchar(255) DEFAULT NULL,
  `acc_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accounts
-- ----------------------------
INSERT INTO `accounts` VALUES ('1', null, 'Madayaw Gas', null, null, '1');

-- ----------------------------
-- Table structure for `bad_orders`
-- ----------------------------
DROP TABLE IF EXISTS `bad_orders`;
CREATE TABLE `bad_orders` (
  `bo_id` int(11) NOT NULL AUTO_INCREMENT,
  `bo_ref_id` varchar(30) DEFAULT NULL,
  `acc_id` int(11) DEFAULT NULL,
  `trx_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `bo_crates` int(11) DEFAULT '0',
  `bo_loose` int(11) DEFAULT '0',
  `bo_date` varchar(20) DEFAULT NULL,
  `bo_time` varchar(20) DEFAULT NULL,
  `bo_datetime` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`bo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bad_orders
-- ----------------------------
INSERT INTO `bad_orders` VALUES ('1', 'BO-20230413-1', '1', '22', '3', null, '1', '2023-04-13', '17:39:12', '2023-04-13 17:39:12');
INSERT INTO `bad_orders` VALUES ('2', 'BO-20230413-2', '1', '22', '3', null, '2', '2023-04-13', '17:39:51', '2023-04-13 17:39:51');
INSERT INTO `bad_orders` VALUES ('3', 'BO-20230413-3', '1', '22', '3', null, '4', '2023-04-13', '17:44:10', '2023-04-13 17:44:10');

-- ----------------------------
-- Table structure for `customers`
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `cus_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NOT NULL,
  `cus_uuid` varchar(255) DEFAULT NULL,
  `cus_name` varchar(255) DEFAULT NULL,
  `cus_address` varchar(255) DEFAULT NULL,
  `cus_contact` varchar(11) DEFAULT NULL,
  `cus_price_change` float DEFAULT '0',
  `cus_accessibles` varchar(255) DEFAULT NULL,
  `cus_accessibles_prices` varchar(255) DEFAULT NULL,
  `cus_notes` varchar(255) DEFAULT NULL,
  `cus_image` varchar(255) DEFAULT NULL,
  `cus_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', '1', 'b4pje0fqknvb69ss1ulsxxnrhpwxt82v', 'Mark Glenn Rojas', 'Indangan', '09800989080', '0', '3,4,6,', '30.00,15.00,700.00,', null, null, '1');
INSERT INTO `customers` VALUES ('2', '1', 'xoxh928ievszk8jcft7t3wf4mzhyu1hk', 'DJV', 'Indangan', '09800989080', '1.5', '3,4,5,6,', '20.00,20.00,20.00,700.00,', null, null, '1');

-- ----------------------------
-- Table structure for `fuel_prices`
-- ----------------------------
DROP TABLE IF EXISTS `fuel_prices`;
CREATE TABLE `fuel_prices` (
  `prc_id` int(11) NOT NULL AUTO_INCREMENT,
  `prc_date` date DEFAULT NULL,
  `prc_price` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`prc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fuel_prices
-- ----------------------------

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------

-- ----------------------------
-- Table structure for `movement_logs`
-- ----------------------------
DROP TABLE IF EXISTS `movement_logs`;
CREATE TABLE `movement_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) DEFAULT NULL,
  `prd_id` varchar(255) DEFAULT NULL,
  `log_filled` decimal(11,0) DEFAULT '0',
  `log_leakers` decimal(10,0) DEFAULT '0',
  `log_empty_goods` decimal(10,0) DEFAULT '0',
  `log_for_revalving` decimal(10,0) DEFAULT '0',
  `log_scraps` decimal(10,0) DEFAULT '0',
  `usr_id` int(11) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `pdn_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of movement_logs
-- ----------------------------
INSERT INTO `movement_logs` VALUES ('1', '1', '3', '0', '0', '1000', '0', '0', '1', '2023-03-30', '1');
INSERT INTO `movement_logs` VALUES ('2', '1', '4', '0', '0', '1000', '0', '0', '1', '2023-03-30', '1');
INSERT INTO `movement_logs` VALUES ('3', '1', '5', '0', '0', '1000', '0', '0', '1', '2023-03-30', '1');
INSERT INTO `movement_logs` VALUES ('4', '1', '3', '500', '0', '0', '0', '0', '1', '2023-03-30', '1');
INSERT INTO `movement_logs` VALUES ('5', '1', '4', '500', '0', '0', '0', '0', '1', '2023-03-30', '1');
INSERT INTO `movement_logs` VALUES ('6', '1', '5', '500', '0', '0', '0', '0', '1', '2023-03-30', '1');
INSERT INTO `movement_logs` VALUES ('7', '1', '3', '0', '100', '0', '0', '0', '1', '2023-03-30', '1');
INSERT INTO `movement_logs` VALUES ('8', '1', '3', '0', '0', '0', '50', '0', '1', '2023-03-30', '1');
INSERT INTO `movement_logs` VALUES ('9', '1', '3', '0', '0', '0', '0', '50', '1', '2023-03-30', '1');
INSERT INTO `movement_logs` VALUES ('10', '1', '3', '0', '0', '50', '0', '0', '1', '2023-03-30', '1');
INSERT INTO `movement_logs` VALUES ('11', '1', '7', '0', '0', '200', '0', '0', '1', '2023-03-30', '2');
INSERT INTO `movement_logs` VALUES ('12', '1', '7', '0', '0', '200', '0', '0', '1', '2023-03-30', '2');
INSERT INTO `movement_logs` VALUES ('13', '1', '3', '0', '0', '100', '0', '0', '1', '2023-03-30', '2');
INSERT INTO `movement_logs` VALUES ('14', '1', '7', '10', '0', '0', '0', '0', '1', '2023-03-30', '2');
INSERT INTO `movement_logs` VALUES ('15', '1', '3', '0', '100', '0', '0', '0', '1', '2023-03-30', '2');
INSERT INTO `movement_logs` VALUES ('16', '1', '3', '0', '0', '0', '100', '0', '1', '2023-03-30', '2');
INSERT INTO `movement_logs` VALUES ('17', '1', '3', '0', '0', '100', '0', '0', '1', '2023-03-30', '2');
INSERT INTO `movement_logs` VALUES ('18', '1', '3', '0', '1', '0', '0', '0', '1', '2023-04-13', '3');
INSERT INTO `movement_logs` VALUES ('19', '1', '3', '0', '2', '0', '0', '0', '1', '2023-04-13', '3');
INSERT INTO `movement_logs` VALUES ('20', '1', '3', '0', '4', '0', '0', '0', '1', '2023-04-13', '3');

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) DEFAULT NULL,
  `news_content` longtext,
  `news_date` varchar(20) DEFAULT NULL,
  `news_time` varchar(20) DEFAULT NULL,
  `news_datetime` varchar(20) DEFAULT NULL,
  `news_img` varchar(255) DEFAULT NULL,
  `news_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('1', 'Daot Ang Opaw', 'HAHAHAHAHA joke lang', '2023-03-30', '00:56:26', '2023-03-30 00:56:26', null, '1');

-- ----------------------------
-- Table structure for `oppositions`
-- ----------------------------
DROP TABLE IF EXISTS `oppositions`;
CREATE TABLE `oppositions` (
  `ops_id` int(11) NOT NULL AUTO_INCREMENT,
  `ops_uuid` varchar(255) DEFAULT NULL,
  `ops_name` varchar(255) DEFAULT NULL,
  `ops_sku` varchar(255) DEFAULT NULL,
  `ops_description` varchar(255) DEFAULT NULL,
  `ops_quantity` int(11) DEFAULT NULL,
  `ops_image` varchar(255) DEFAULT NULL,
  `ops_notes` varchar(255) DEFAULT NULL,
  `acc_id` int(11) DEFAULT NULL,
  `ops_active` int(11) DEFAULT '1',
  PRIMARY KEY (`ops_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of oppositions
-- ----------------------------
INSERT INTO `oppositions` VALUES ('1', 'kda2cl0kccsjmn9cg7elskjq9wtj0kd2', 'Tripler', 'T1', 'Tripler', '148', null, null, '1', '1');

-- ----------------------------
-- Table structure for `payments`
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `acc_id` int(11) NOT NULL,
  `pmnt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pmnt_ref_id` varchar(30) DEFAULT NULL,
  `trx_id` int(10) unsigned NOT NULL,
  `pmnt_amount` double(30,0) NOT NULL,
  `pmnt_attachment` varchar(70) DEFAULT NULL,
  `usr_id` int(11) NOT NULL,
  `pmnt_date` varchar(20) DEFAULT NULL,
  `pmnt_time` varchar(20) DEFAULT NULL,
  `trx_mode_of_payment` int(11) DEFAULT NULL,
  `pmnt_received` double(30,0) NOT NULL,
  `pmnt_change` double(30,0) NOT NULL,
  `pmnt_check_no` varchar(30) DEFAULT NULL,
  `pmnt_check_date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`pmnt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES ('1', '1', 'PMT20230330-1', '1', '1060', null, '1', '2023-03-30', '12:31:33', '1', '1060', '0', null, null);
INSERT INTO `payments` VALUES ('1', '2', 'PMT20230330-2', '2', '480', null, '1', '2023-03-30', '12:34:31', '2', '480', '0', null, null);
INSERT INTO `payments` VALUES ('1', '3', 'PMT20230330-3', '3', '1200', '3.jpg', '1', '2023-03-30', '12:36:27', '3', '1200', '0', null, null);
INSERT INTO `payments` VALUES ('1', '4', 'PMT20230331-4', '4', '0', null, '1', '2023-03-31', '11:51:55', '2', '0', '0', null, null);
INSERT INTO `payments` VALUES ('1', '5', 'PMT20230331-5', '5', '30', null, '1', '2023-03-31', '11:59:20', '1', '50', '20', null, null);
INSERT INTO `payments` VALUES ('1', '6', 'PMT20230405-6', '6', '0', null, '1', '2023-04-05', '07:44:29', '2', '0', '0', null, null);
INSERT INTO `payments` VALUES ('1', '7', 'PMT20230405-7', '7', '0', null, '1', '2023-04-05', '07:46:47', '2', '0', '0', null, null);
INSERT INTO `payments` VALUES ('1', '8', 'PMT20230405-8', '8', '700', '8.jpg', '1', '2023-04-05', '08:56:57', '3', '2000', '1300', '23488764', '2023');
INSERT INTO `payments` VALUES ('1', '9', 'PMT20230405-9', '9', '701', null, '1', '2023-04-05', '08:59:53', '4', '1212', '510', '12', '2023');
INSERT INTO `payments` VALUES ('1', '10', 'PMT20230405-10', '10', '12', '10.jpg', '1', '2023-04-05', '09:13:53', '4', '12', '0', '454', '2023-04-06');
INSERT INTO `payments` VALUES ('1', '11', 'PMT20230411-11', '11', '12', null, '1', '2023-04-11', '11:35:51', '4', '12', '0', '9081232', '2023-04-11');
INSERT INTO `payments` VALUES ('1', '12', 'PMT20230411-12', '12', '12', null, '1', '2023-04-11', '01:40:39', '4', '12', '0', '1232', '2023-04-11');
INSERT INTO `payments` VALUES ('1', '13', 'PMT20230411-13', '13', '0', null, '1', '2023-04-11', '01:42:11', '2', '0', '0', '0', '2023-04-11');
INSERT INTO `payments` VALUES ('1', '14', 'PMT20230411-14', '14', '345', null, '1', '2023-04-11', '14:21:33', '4', '345', '0', '1232', '2023-04-11');
INSERT INTO `payments` VALUES ('1', '15', 'PMT20230412-15', '15', '0', null, '1', '2023-04-12', '14:14:26', '2', '0', '0', '0', '2023-04-12');
INSERT INTO `payments` VALUES ('1', '16', 'PMT20230412-16', '16', '0', null, '1', '2023-04-12', '17:04:41', '2', '0', '0', '0', '2023-04-12');
INSERT INTO `payments` VALUES ('1', '17', 'PMT20230413-17', '17', '0', null, '1', '2023-04-13', '15:24:36', '2', '0', '0', '0', '2023-04-13');
INSERT INTO `payments` VALUES ('1', '18', 'PMT20230413-18', '18', '0', null, '1', '2023-04-13', '15:27:24', '2', '0', '0', '0', '2023-04-13');
INSERT INTO `payments` VALUES ('1', '19', 'PMT20230413-19', '19', '0', null, '1', '2023-04-13', '15:40:37', '2', '0', '0', '0', '2023-04-13');
INSERT INTO `payments` VALUES ('1', '20', 'PMT20230413-20', '20', '0', null, '1', '2023-04-13', '15:42:09', '2', '0', '0', '0', '2023-04-13');
INSERT INTO `payments` VALUES ('1', '21', 'PMT20230413-21', '21', '0', null, '1', '2023-04-13', '17:04:12', '2', '0', '0', '0', '2023-04-13');
INSERT INTO `payments` VALUES ('1', '22', 'PMT20230413-22', '22', '0', null, '1', '2023-04-13', '17:15:44', '2', '0', '0', '0', '2023-04-13');
INSERT INTO `payments` VALUES ('1', '23', 'PMT20230414-23', '23', '720', null, '1', '2023-04-14', '17:09:16', '4', '720', '0', '2323', '2023-04-14');
INSERT INTO `payments` VALUES ('1', '24', 'PMT20230414-24', '24', '258', null, '1', '2023-04-14', '17:10:13', '1', '258', '0', null, '2023-04-14');
INSERT INTO `payments` VALUES ('1', '25', 'PMT20230414-25', '25', '2', null, '1', '2023-04-14', '17:10:52', '3', '2', '0', null, '2023-04-14');
INSERT INTO `payments` VALUES ('1', '26', 'PMT20230414-26', '26', '1403', null, '1', '2023-04-14', '17:11:36', '4', '1403', '0', '12312', '2023-04-14');
INSERT INTO `payments` VALUES ('1', '27', 'PMT20230414-27', '27', '0', null, '1', '2023-04-14', '17:12:02', '2', '0', '0', null, '2023-04-14');
INSERT INTO `payments` VALUES ('1', '28', 'PMT20230414-28', '28', '20', null, '1', '2023-04-14', '17:12:31', '5', '20', '0', null, null);
INSERT INTO `payments` VALUES ('1', '29', 'PMT20230414-28', '28', '700', null, '1', '2023-04-14', '17:12:31', '5', '700', '0', null, null);
INSERT INTO `payments` VALUES ('1', '30', 'PMT20230414-29', '29', '4', null, '1', '2023-04-14', '17:32:06', '5', '64', '0', null, null);
INSERT INTO `payments` VALUES ('1', '31', 'PMT20230414-29', '29', '60', null, '1', '2023-04-14', '17:32:06', '5', '64', '0', null, null);
INSERT INTO `payments` VALUES ('1', '32', 'PMT20230414-30', '30', '116', null, '1', '2023-04-14', '17:53:41', '5', '516', '0', null, null);
INSERT INTO `payments` VALUES ('1', '33', 'PMT20230414-30', '30', '400', null, '1', '2023-04-14', '17:53:41', '5', '516', '0', null, null);
INSERT INTO `payments` VALUES ('1', '34', 'PMT20230414-31', '31', '500', '34.png', '1', '2023-04-14', '18:13:23', '5', '1290', '0', null, null);
INSERT INTO `payments` VALUES ('1', '35', 'PMT20230414-31', '31', '790', '35.jpg', '1', '2023-04-14', '18:13:24', '5', '1290', '0', '23423', '2023-04-14');
INSERT INTO `payments` VALUES ('1', '36', 'PMT20230414-32', '32', '116', null, '1', '2023-04-14', '18:17:38', '5', '516', '0', null, null);
INSERT INTO `payments` VALUES ('1', '37', 'PMT20230414-32', '32', '400', '37.jpg', '1', '2023-04-14', '18:17:38', '5', '516', '0', null, null);
INSERT INTO `payments` VALUES ('1', '38', 'PMT20230414-33', '33', '15', null, '1', '2023-04-14', '18:18:57', '5', '30', '0', null, null);
INSERT INTO `payments` VALUES ('1', '39', 'PMT20230414-33', '33', '15', '39.png', '1', '2023-04-14', '18:18:57', '5', '30', '0', 'BPI234', '2023-04-14');

-- ----------------------------
-- Table structure for `payment_types`
-- ----------------------------
DROP TABLE IF EXISTS `payment_types`;
CREATE TABLE `payment_types` (
  `mode_of_payment` int(11) NOT NULL,
  `payment_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`mode_of_payment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payment_types
-- ----------------------------
INSERT INTO `payment_types` VALUES ('1', 'Cash');
INSERT INTO `payment_types` VALUES ('2', 'Credit');
INSERT INTO `payment_types` VALUES ('3', 'G-Cash');
INSERT INTO `payment_types` VALUES ('4', 'Check');
INSERT INTO `payment_types` VALUES ('5', 'Split Payment');

-- ----------------------------
-- Table structure for `production_logs`
-- ----------------------------
DROP TABLE IF EXISTS `production_logs`;
CREATE TABLE `production_logs` (
  `pdn_id` int(11) NOT NULL AUTO_INCREMENT,
  `pdn_date` date DEFAULT NULL,
  `pdn_start_time` time DEFAULT NULL,
  `pdn_end_time` time DEFAULT NULL,
  PRIMARY KEY (`pdn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of production_logs
-- ----------------------------
INSERT INTO `production_logs` VALUES ('1', '2023-03-30', '00:22:19', '15:54:04');
INSERT INTO `production_logs` VALUES ('2', '2023-03-30', '13:43:24', '15:54:04');
INSERT INTO `production_logs` VALUES ('3', '2023-03-30', '15:56:27', null);

-- ----------------------------
-- Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `prd_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) DEFAULT NULL,
  `prd_uuid` varchar(255) DEFAULT NULL,
  `prd_name` varchar(255) DEFAULT NULL,
  `prd_description` varchar(255) DEFAULT NULL,
  `prd_sku` varchar(255) DEFAULT NULL,
  `prd_barcode` varchar(255) DEFAULT NULL,
  `prd_price` decimal(10,2) DEFAULT NULL,
  `prd_deposit` decimal(10,0) DEFAULT '0',
  `prd_quantity` int(10) DEFAULT '0',
  `prd_leakers` int(10) DEFAULT '0',
  `prd_empty_goods` int(10) DEFAULT '0',
  `prd_for_revalving` int(10) DEFAULT '0',
  `prd_scraps` int(11) DEFAULT '0',
  `prd_reorder_point` int(10) DEFAULT NULL,
  `prd_image` varchar(255) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `prd_active` tinyint(4) DEFAULT '1',
  `prd_is_refillable` tinyint(4) DEFAULT '1',
  `prd_for_production` tinyint(4) DEFAULT '1',
  `prd_for_POS` tinyint(4) DEFAULT NULL,
  `prd_weight` decimal(10,0) DEFAULT NULL,
  `prd_raw_can_qty` int(11) DEFAULT '0',
  `prd_components` int(11) DEFAULT NULL,
  `prd_seals` int(11) DEFAULT NULL,
  PRIMARY KEY (`prd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '1', '6yu8x39d3a8zr3s54o2x8zmk69y8j8q2', 'MR Valve', 'MR Valve', 'MRV', null, null, '0', '7895', '0', '0', '0', '0', '1000', null, '1', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('2', '1', 'm6hanwc9u1ik3y8inh2o1l7vwj8mc4o6', 'MS Valve', 'MS Valve', 'MSV', null, null, '0', '9000', '0', '0', '0', '0', '1000', null, '1', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('3', '1', 'ayrjsmj0z0hlhouabj6k9jksp47sv41z', 'Madayaw Round', 'MR LPG', 'MR170', null, '20.00', '35', '31', '12', '1127', '0', '50', '1000', null, '2', '1', '1', '1', '1', '170', '8898', '1', '8');
INSERT INTO `products` VALUES ('4', '1', 'reg89nc0wyi98jzr9hd7aiozsc6ba7tj', 'Madayaw Square', 'MS LPG', 'MS170', null, '20.00', '35', '287', '0', '556', '0', '0', '1000', null, '2', '1', '1', '1', '1', '170', '9000', '2', null);
INSERT INTO `products` VALUES ('5', '1', 'ydg5a6fi8dit015u5wr6ehi02la4jgfa', 'Botin', 'BOTIN170', 'BOTIN170', null, '20.00', '35', '452', '0', '500', '0', '0', '1000', null, '2', '1', '1', '1', '1', '170', '9001', '1', null);
INSERT INTO `products` VALUES ('6', '1', '851bmkfdi98c2gk2vom508y4m8q8gb58', 'Gas Stove', 'Gas Stove 1 Burner', 'GS1B', null, '700.00', '0', '992', '0', '0', '0', '0', '1000', null, '1', '1', '0', '0', '1', null, '0', null, null);
INSERT INTO `products` VALUES ('8', '1', 'qqh27g0i5x1t35vuhv3c40um2bla1ger', 'Seal', 'Seal', 'Seal', null, null, '0', '0', '0', '0', '0', '0', '12323', null, '1', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('9', '1', 'cfbgf3pnxws9svdsytvbou1n6d1fvzwk', 'Botin 2.0', 'BOTIN 2nd Version', 'Botin 2.0 170g', null, '20.00', '35', '0', '0', '0', '0', '0', '2000', null, '1', '1', '1', '1', '1', '170', '0', '1', '8');
INSERT INTO `products` VALUES ('10', '1', 'osge7t90by1h2zpaid2jktia76f5v6yo', 'Canister', 'Canister', 'Canister170', null, '20.00', '35', '0', '0', '0', '0', '0', '2000', null, '1', '1', '1', '1', '1', '170', '0', null, null);
INSERT INTO `products` VALUES ('11', '1', 'o9vys9nqjuvrogs72zri1i1rbnslnvvk', 'Canisters', 'asdfas', 'skskskskkskksskka', null, '20.00', '35', '0', '0', '0', '0', '0', '5000', null, '1', '1', '1', '1', '1', '170', '0', '2', '8');
INSERT INTO `products` VALUES ('12', '1', 'zmusxpf7i6hfx36zhpyh2zzesq0jxqix', '1', '6', '2', null, '3.00', '4', '0', '0', '0', '0', '0', '7', null, '1', '1', '1', '1', '1', '5', '0', '1', null);

-- ----------------------------
-- Table structure for `product_types`
-- ----------------------------
DROP TABLE IF EXISTS `product_types`;
CREATE TABLE `product_types` (
  `typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `typ_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`typ_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_types
-- ----------------------------

-- ----------------------------
-- Table structure for `purchases`
-- ----------------------------
DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases` (
  `pur_id` int(11) NOT NULL AUTO_INCREMENT,
  `trx_id` int(11) DEFAULT NULL,
  `prd_id` int(11) DEFAULT NULL,
  `pur_crate` int(11) DEFAULT NULL,
  `pur_loose` int(11) DEFAULT NULL,
  `pur_discount` double(10,2) DEFAULT '0.00',
  `pur_deposit` double(10,2) DEFAULT NULL,
  `pur_total` double(10,2) DEFAULT NULL,
  `pur_qty` int(11) DEFAULT NULL,
  `prd_price` double(10,2) DEFAULT NULL,
  `prd_id_in` int(11) DEFAULT NULL,
  `pur_crate_in` int(11) DEFAULT NULL,
  `pur_loose_in` int(11) DEFAULT NULL,
  `can_type_in` int(11) DEFAULT NULL,
  PRIMARY KEY (`pur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of purchases
-- ----------------------------
INSERT INTO `purchases` VALUES ('1', '1', '6', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('2', '1', '3', '2', '0', '0.00', '0.00', '360.00', '24', '15.00', '3', '2', '0', '1');
INSERT INTO `purchases` VALUES ('3', '2', '4', '2', '0', '0.00', '840.00', '480.00', '24', '20.00', '4', '0', '0', '1');
INSERT INTO `purchases` VALUES ('4', '2', '3', '2', '0', '0.00', '-840.00', '480.00', '24', '20.00', '3', '4', '0', '1');
INSERT INTO `purchases` VALUES ('5', '3', '3', '2', '0', '0.00', '840.00', '360.00', '24', '15.00', '3', '0', '0', '1');
INSERT INTO `purchases` VALUES ('6', '4', '3', '0', '1', '0.00', '0.00', '30.00', '1', '30.00', '3', '0', '1', '1');
INSERT INTO `purchases` VALUES ('7', '4', '3', '0', '1', '0.00', '0.00', '30.00', '1', '30.00', '3', '0', '1', '1');
INSERT INTO `purchases` VALUES ('8', '5', '3', '0', '1', '0.00', '0.00', '30.00', '1', '30.00', '3', '0', '1', '1');
INSERT INTO `purchases` VALUES ('9', '6', '4', '1', '0', '0.00', '0.00', '180.00', '12', '15.00', '4', '1', '0', '1');
INSERT INTO `purchases` VALUES ('10', '6', '3', '1', '0', '0.00', '0.00', '360.00', '12', '30.00', '3', '1', '0', '1');
INSERT INTO `purchases` VALUES ('11', '7', '3', '1', '0', '0.00', '0.00', '360.00', '12', '30.00', '3', '1', '0', '1');
INSERT INTO `purchases` VALUES ('12', '8', '6', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('13', '9', '6', '0', '1', '0.00', '0.00', '701.50', '1', '701.50', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('14', '10', '3', '1', '0', '0.00', '0.00', '360.00', '12', '30.00', '3', '1', '0', '1');
INSERT INTO `purchases` VALUES ('15', '11', '3', '0', '1', '0.00', '0.00', '30.00', '1', '30.00', '3', '0', '1', '1');
INSERT INTO `purchases` VALUES ('16', '12', '4', '0', '2', '0.00', '0.00', '30.00', '2', '15.00', '4', '0', '2', '1');
INSERT INTO `purchases` VALUES ('17', '12', '3', '0', '1', '0.00', '0.00', '30.00', '1', '30.00', '3', '0', '1', '1');
INSERT INTO `purchases` VALUES ('18', '13', '4', '0', '3', '0.00', '0.00', '45.00', '3', '15.00', '4', '0', '3', '1');
INSERT INTO `purchases` VALUES ('19', '13', '3', '0', '2', '0.00', '0.00', '60.00', '2', '30.00', '3', '0', '2', '1');
INSERT INTO `purchases` VALUES ('20', '14', '6', '0', '2', '0.00', '0.00', '1403.00', '2', '701.50', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('21', '15', '3', '2', '0', '0.00', '0.00', '516.00', '24', '21.50', '3', '2', '0', '1');
INSERT INTO `purchases` VALUES ('22', '16', '3', '3', '0', '0.00', '420.00', '1080.00', '36', '30.00', '3', '2', '0', '1');
INSERT INTO `purchases` VALUES ('23', '17', '3', '1', '0', '0.00', '0.00', '258.00', '12', '21.50', '3', '1', '0', '1');
INSERT INTO `purchases` VALUES ('24', '18', '6', '0', '2', '0.00', '0.00', '1403.00', '2', '701.50', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('25', '19', '4', '12', '0', '0.00', '0.00', '2160.00', '144', '15.00', '3', '12', '0', '1');
INSERT INTO `purchases` VALUES ('26', '20', '5', '1', '0', '0.00', '0.00', '258.00', '12', '21.50', '1', '1', '0', '2');
INSERT INTO `purchases` VALUES ('27', '21', '4', '0', '1', '0.00', '35.00', '15.00', '1', '15.00', '4', '0', '0', '1');
INSERT INTO `purchases` VALUES ('28', '22', '3', '1', '0', '0.00', '420.00', '360.00', '12', '30.00', '3', '0', '0', '1');
INSERT INTO `purchases` VALUES ('29', '23', '3', '2', '0', '0.00', '0.00', '720.00', '24', '30.00', '3', '2', '0', '1');
INSERT INTO `purchases` VALUES ('30', '24', '3', '1', '0', '0.00', '0.00', '258.00', '12', '21.50', '3', '1', '0', '1');
INSERT INTO `purchases` VALUES ('31', '25', '4', '0', '1', '0.00', '0.00', '15.00', '1', '15.00', '4', '0', '1', '1');
INSERT INTO `purchases` VALUES ('32', '26', '6', '0', '2', '0.00', '0.00', '1403.00', '2', '701.50', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('33', '27', '6', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('34', '28', '3', '2', '0', '0.00', '0.00', '720.00', '24', '30.00', '3', '2', '0', '1');
INSERT INTO `purchases` VALUES ('35', '29', '4', '0', '2', '0.00', '0.00', '43.00', '2', '21.50', '4', '0', '2', '1');
INSERT INTO `purchases` VALUES ('36', '29', '3', '0', '1', '0.00', '0.00', '21.50', '1', '21.50', '3', '0', '1', '1');
INSERT INTO `purchases` VALUES ('37', '30', '3', '1', '0', '0.00', '420.00', '258.00', '12', '21.50', '3', '0', '0', '1');
INSERT INTO `purchases` VALUES ('38', '30', '4', '1', '0', '0.00', '-420.00', '258.00', '12', '21.50', '4', '2', '0', '1');
INSERT INTO `purchases` VALUES ('39', '31', '5', '3', '0', '0.00', '0.00', '774.00', '36', '21.50', '1', '3', '0', '2');
INSERT INTO `purchases` VALUES ('40', '31', '4', '2', '0', '0.00', '0.00', '516.00', '24', '21.50', '4', '2', '0', '1');
INSERT INTO `purchases` VALUES ('41', '32', '3', '2', '0', '0.00', '0.00', '516.00', '24', '21.50', '3', '2', '0', '1');
INSERT INTO `purchases` VALUES ('42', '33', '3', '0', '1', '0.00', '0.00', '30.00', '1', '30.00', '3', '0', '1', '1');

-- ----------------------------
-- Table structure for `quantity_logs`
-- ----------------------------
DROP TABLE IF EXISTS `quantity_logs`;
CREATE TABLE `quantity_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) DEFAULT NULL,
  `prd_id` int(11) DEFAULT NULL,
  `usr_id` int(11) DEFAULT NULL,
  `log_quantity` int(11) DEFAULT NULL,
  `log_datetime` datetime DEFAULT NULL,
  `pdn_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quantity_logs
-- ----------------------------
INSERT INTO `quantity_logs` VALUES ('1', '1', '1', '1', '5000000', '2023-03-30 00:20:01', '0');
INSERT INTO `quantity_logs` VALUES ('2', '1', '1', '1', '10000', '2023-03-30 00:25:44', '1');
INSERT INTO `quantity_logs` VALUES ('3', '1', '2', '1', '10000', '2023-03-30 00:25:48', '1');
INSERT INTO `quantity_logs` VALUES ('4', '1', '3', '1', '10000', '2023-03-30 00:25:51', '1');
INSERT INTO `quantity_logs` VALUES ('5', '1', '4', '1', '10000', '2023-03-30 00:25:55', '1');
INSERT INTO `quantity_logs` VALUES ('6', '1', '5', '1', '10000', '2023-03-30 00:26:00', '1');
INSERT INTO `quantity_logs` VALUES ('7', '1', '3', '1', '1000', '2023-03-30 00:26:10', '1');
INSERT INTO `quantity_logs` VALUES ('8', '1', '4', '1', '1000', '2023-03-30 00:26:14', '1');
INSERT INTO `quantity_logs` VALUES ('9', '1', '5', '1', '1000', '2023-03-30 00:26:18', '1');
INSERT INTO `quantity_logs` VALUES ('10', '1', '3', '1', '500', '2023-03-30 00:26:30', '1');
INSERT INTO `quantity_logs` VALUES ('11', '1', '4', '1', '500', '2023-03-30 00:26:35', '1');
INSERT INTO `quantity_logs` VALUES ('12', '1', '5', '1', '500', '2023-03-30 00:26:40', '1');
INSERT INTO `quantity_logs` VALUES ('13', '1', '3', '1', '100', '2023-03-30 00:26:51', '1');
INSERT INTO `quantity_logs` VALUES ('14', '1', '3', '1', '50', '2023-03-30 00:27:13', '1');
INSERT INTO `quantity_logs` VALUES ('15', '1', '3', '1', '50', '2023-03-30 00:27:31', '1');
INSERT INTO `quantity_logs` VALUES ('16', '1', '3', '1', '50', '2023-03-30 00:28:15', '1');
INSERT INTO `quantity_logs` VALUES ('17', '1', '6', '1', '1000', '2023-03-30 00:29:59', '1');
INSERT INTO `quantity_logs` VALUES ('18', '1', '7', '1', '200', '2023-03-30 14:01:37', '2');
INSERT INTO `quantity_logs` VALUES ('19', '1', '7', '1', '200', '2023-03-30 14:01:52', '2');
INSERT INTO `quantity_logs` VALUES ('20', '1', '7', '1', '200', '2023-03-30 14:03:54', '2');
INSERT INTO `quantity_logs` VALUES ('21', '1', '7', '1', '200', '2023-03-30 14:04:32', '2');
INSERT INTO `quantity_logs` VALUES ('22', '1', '7', '1', '200', '2023-03-30 14:04:46', '2');
INSERT INTO `quantity_logs` VALUES ('23', '1', '7', '1', '200', '2023-03-30 14:04:50', '2');
INSERT INTO `quantity_logs` VALUES ('24', '1', '3', '1', '100', '2023-03-30 14:05:02', '2');
INSERT INTO `quantity_logs` VALUES ('25', '1', '7', '1', '10', '2023-03-30 14:05:23', '2');
INSERT INTO `quantity_logs` VALUES ('26', '1', '3', '1', '100', '2023-03-30 14:05:54', '2');
INSERT INTO `quantity_logs` VALUES ('27', '1', '3', '1', '100', '2023-03-30 14:06:07', '2');
INSERT INTO `quantity_logs` VALUES ('28', '1', '3', '1', '100', '2023-03-30 14:06:11', '2');
INSERT INTO `quantity_logs` VALUES ('29', '1', '7', '1', '1000', '2023-03-30 14:07:18', '2');
INSERT INTO `quantity_logs` VALUES ('30', '1', '5', '1', '120', '2023-04-11 14:05:07', '3');
INSERT INTO `quantity_logs` VALUES ('31', '1', '4', '1', '120', '2023-04-11 15:55:33', '3');
INSERT INTO `quantity_logs` VALUES ('32', '1', '5', '1', '1', '2023-04-12 12:36:04', '3');
INSERT INTO `quantity_logs` VALUES ('33', '1', '3', '1', '1', '2023-04-13 17:39:12', '3');
INSERT INTO `quantity_logs` VALUES ('34', '1', '3', '1', '24', '2023-04-13 17:39:42', '3');
INSERT INTO `quantity_logs` VALUES ('35', '1', '3', '1', '2', '2023-04-13 17:39:51', '3');
INSERT INTO `quantity_logs` VALUES ('36', '1', '4', '1', '1', '2023-04-13 17:43:53', '3');
INSERT INTO `quantity_logs` VALUES ('37', '1', '3', '1', '4', '2023-04-13 17:44:10', '3');
INSERT INTO `quantity_logs` VALUES ('38', '1', '4', '1', '4', '2023-04-13 17:44:20', '3');
INSERT INTO `quantity_logs` VALUES ('39', '1', '3', '1', '1478558558', '2023-04-13 17:44:37', '3');

-- ----------------------------
-- Table structure for `reset_password`
-- ----------------------------
DROP TABLE IF EXISTS `reset_password`;
CREATE TABLE `reset_password` (
  `rst_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_id` int(11) DEFAULT NULL,
  `rst_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`rst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of reset_password
-- ----------------------------

-- ----------------------------
-- Table structure for `sales_reports`
-- ----------------------------
DROP TABLE IF EXISTS `sales_reports`;
CREATE TABLE `sales_reports` (
  `sls_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_id` int(11) DEFAULT NULL,
  `prd_id` int(11) DEFAULT NULL,
  `sls_quantity` float DEFAULT NULL,
  `sls_discount` float DEFAULT NULL,
  `sls_sub_total` float DEFAULT NULL,
  `sls_time` time DEFAULT NULL,
  `pdn_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`sls_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sales_reports
-- ----------------------------

-- ----------------------------
-- Table structure for `stockin_logs`
-- ----------------------------
DROP TABLE IF EXISTS `stockin_logs`;
CREATE TABLE `stockin_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) DEFAULT NULL,
  `prd_id` varchar(255) DEFAULT NULL,
  `log_quantity` int(11) DEFAULT '0',
  `log_leakers` int(10) DEFAULT '0',
  `log_empty_goods` int(10) DEFAULT '0',
  `log_for_revalving` int(10) DEFAULT '0',
  `log_scraps` int(10) DEFAULT '0',
  `log_date` date DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stockin_logs
-- ----------------------------

-- ----------------------------
-- Table structure for `stocks_logs`
-- ----------------------------
DROP TABLE IF EXISTS `stocks_logs`;
CREATE TABLE `stocks_logs` (
  `stk_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) DEFAULT NULL,
  `prd_id` int(11) DEFAULT NULL,
  `opening_stocks` int(11) DEFAULT NULL,
  `closing_stocks` int(11) DEFAULT NULL,
  `pdn_id` int(11) DEFAULT NULL,
  `stk_raw_materials` int(11) DEFAULT '0',
  `stk_empty_goods` int(11) DEFAULT '0',
  `stk_filled` int(11) DEFAULT '0',
  `stk_leakers` int(11) DEFAULT '0',
  `stk_for_revalving` int(11) DEFAULT '0',
  `stk_scraps` int(11) DEFAULT '0',
  PRIMARY KEY (`stk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stocks_logs
-- ----------------------------
INSERT INTO `stocks_logs` VALUES ('1', '1', '3', null, '328', '1', '0', '21828', '0', '0', '50', '50');
INSERT INTO `stocks_logs` VALUES ('2', '1', '4', null, '476', '1', '0', '4626', '500', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('3', '1', '5', null, '500', '1', '0', '0', '500', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('4', '1', '3', '328', '228', '2', '0', '21828', '0', '0', '100', '0');
INSERT INTO `stocks_logs` VALUES ('5', '1', '4', '476', '476', '2', '0', '4626', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('6', '1', '5', '500', '500', '2', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('7', '1', '7', null, '10', '2', '1000', '0', '10', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('8', '1', '3', '228', null, '3', '0', '21828', '0', '7', '0', '0');
INSERT INTO `stocks_logs` VALUES ('9', '1', '4', '476', null, '3', '0', '4626', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('10', '1', '5', '500', null, '3', '1', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('11', '1', '7', '10', null, '3', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('12', '1', '9', null, null, '3', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('13', '1', '10', null, null, '3', '0', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `stock_statuses`
-- ----------------------------
DROP TABLE IF EXISTS `stock_statuses`;
CREATE TABLE `stock_statuses` (
  `stk_id` int(11) NOT NULL AUTO_INCREMENT,
  `stk_opening` double DEFAULT NULL,
  `stk_closing` double DEFAULT NULL,
  `pdn_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`stk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stock_statuses
-- ----------------------------

-- ----------------------------
-- Table structure for `stock_verifications`
-- ----------------------------
DROP TABLE IF EXISTS `stock_verifications`;
CREATE TABLE `stock_verifications` (
  `verify_id` int(11) NOT NULL AUTO_INCREMENT,
  `verify_stock_id` int(11) DEFAULT NULL,
  `verify_opening` int(11) DEFAULT NULL,
  `verify_closing` int(11) DEFAULT NULL,
  `verify_is_product` int(11) DEFAULT NULL,
  `verify_pdn_id` int(11) DEFAULT NULL,
  `verify_acc_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`verify_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stock_verifications
-- ----------------------------
INSERT INTO `stock_verifications` VALUES ('1', '1', '5000000', '4745000', '0', '1', '1');
INSERT INTO `stock_verifications` VALUES ('2', '3', null, '328', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('3', '4', null, '476', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('4', '5', null, '500', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('5', '3', '328', '228', '1', '2', '1');
INSERT INTO `stock_verifications` VALUES ('6', '4', '476', '476', '1', '2', '1');
INSERT INTO `stock_verifications` VALUES ('7', '5', '500', '500', '1', '2', '1');
INSERT INTO `stock_verifications` VALUES ('8', '1', '4745000', '4635000', '0', '2', '1');
INSERT INTO `stock_verifications` VALUES ('9', '7', null, '10', '1', '2', '1');
INSERT INTO `stock_verifications` VALUES ('10', '3', '228', '228', '1', '3', '1');
INSERT INTO `stock_verifications` VALUES ('11', '4', '476', '476', '1', '3', '1');
INSERT INTO `stock_verifications` VALUES ('12', '5', '500', '500', '1', '3', '1');
INSERT INTO `stock_verifications` VALUES ('13', '7', '10', '10', '1', '3', '1');
INSERT INTO `stock_verifications` VALUES ('14', '1', '4635000', '4635000', '0', '3', '1');

-- ----------------------------
-- Table structure for `suppliers`
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `sup_id` int(11) NOT NULL AUTO_INCREMENT,
  `sup_uuid` varchar(255) DEFAULT NULL,
  `acc_id` int(11) DEFAULT NULL,
  `sup_name` varchar(255) DEFAULT NULL,
  `sup_address` varchar(255) DEFAULT NULL,
  `sup_contact` varchar(255) DEFAULT NULL,
  `sup_notes` varchar(255) DEFAULT NULL,
  `sup_image` varchar(255) DEFAULT NULL,
  `sup_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`sup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES ('1', '7rjisspndlls0j0zesyjm1tr9q026svf', '1', 'Davao Supplier', 'Bunawan', '23423423423', null, null, '1');
INSERT INTO `suppliers` VALUES ('2', 'elbjd6if90ecdqdny8vw7u1upgen0uxp', '1', 'Madayaw Gas', 'Bunawan', '23423423423', null, null, '1');

-- ----------------------------
-- Table structure for `tanks`
-- ----------------------------
DROP TABLE IF EXISTS `tanks`;
CREATE TABLE `tanks` (
  `tnk_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NOT NULL,
  `tnk_name` varchar(255) DEFAULT NULL,
  `tnk_capacity` decimal(11,0) DEFAULT '0',
  `tnk_remaining` decimal(11,0) DEFAULT '0',
  `tnk_notes` varchar(255) DEFAULT NULL,
  `tnk_uuid` int(11) DEFAULT NULL,
  `tnk_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`tnk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tanks
-- ----------------------------
INSERT INTO `tanks` VALUES ('1', '1', 'Tank 1', '5000000', '4635000', null, null, '1');

-- ----------------------------
-- Table structure for `tank_logs`
-- ----------------------------
DROP TABLE IF EXISTS `tank_logs`;
CREATE TABLE `tank_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) DEFAULT NULL,
  `tnk_id` int(11) DEFAULT NULL,
  `log_tnk_opening` decimal(10,0) DEFAULT NULL,
  `log_tnk_closing` decimal(10,0) DEFAULT NULL,
  `pdn_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tank_logs
-- ----------------------------
INSERT INTO `tank_logs` VALUES ('1', '1', '1', '5000000', '4745000', '1');
INSERT INTO `tank_logs` VALUES ('2', '1', '1', '4745000', '4635000', '2');
INSERT INTO `tank_logs` VALUES ('3', '1', '1', '4635000', null, '3');

-- ----------------------------
-- Table structure for `transactions`
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `trx_id` int(11) NOT NULL AUTO_INCREMENT,
  `trx_ref_id` varchar(30) DEFAULT NULL,
  `acc_id` tinyint(4) DEFAULT NULL,
  `usr_id` int(11) DEFAULT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `trx_datetime` datetime DEFAULT NULL,
  `trx_date` varchar(20) DEFAULT NULL,
  `trx_time` varchar(20) DEFAULT NULL,
  `trx_amount_paid` decimal(11,0) DEFAULT NULL,
  `trx_balance` decimal(11,0) DEFAULT NULL,
  `trx_gross` decimal(11,0) DEFAULT NULL,
  `trx_total` decimal(11,0) DEFAULT NULL,
  `trx_active` tinyint(2) DEFAULT '1',
  `trx_can_dec` varchar(30) DEFAULT NULL,
  `trx_del_rec` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`trx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES ('1', 'POS-20230330-1', '1', '1', '1', '2023-03-30 12:31:33', '2023-03-30', '12:31:33', '1060', '0', '1060', '1060', '1', null, null);
INSERT INTO `transactions` VALUES ('2', 'POS-20230330-2', '1', '1', '2', '2023-03-30 12:34:31', '2023-03-30', '12:34:31', '480', '480', '960', '960', '1', null, null);
INSERT INTO `transactions` VALUES ('3', 'POS-20230330-3', '1', '1', '1', '2023-03-30 12:36:27', '2023-03-30', '12:36:27', '1200', '0', '360', '1200', '1', null, null);
INSERT INTO `transactions` VALUES ('4', 'POS-20230331-4', '1', '1', '1', '2023-03-31 11:51:55', '2023-03-31', '11:51:55', '0', '30', '30', '30', '1', null, null);
INSERT INTO `transactions` VALUES ('5', 'POS-20230331-5', '1', '1', '1', '2023-03-31 11:59:20', '2023-03-31', '11:59:20', '30', '0', '30', '30', '1', null, null);
INSERT INTO `transactions` VALUES ('6', 'POS-20230405-6', '1', '1', '1', '2023-04-05 07:44:29', '2023-04-05', '07:44:29', '0', '540', '540', '540', '1', '21', '1');
INSERT INTO `transactions` VALUES ('7', 'POS-20230405-7', '1', '1', '1', '2023-04-05 07:46:47', '2023-04-05', '07:46:47', '0', '360', '360', '360', '1', '1', '1');
INSERT INTO `transactions` VALUES ('8', 'POS-20230405-8', '1', '1', '1', '2023-04-05 08:56:57', '2023-04-05', '08:56:57', '700', '0', '700', '700', '1', '21', '212');
INSERT INTO `transactions` VALUES ('9', 'POS-20230405-9', '1', '1', '2', '2023-04-05 08:59:53', '2023-04-05', '08:59:53', '702', '0', '702', '702', '1', '12', '12121');
INSERT INTO `transactions` VALUES ('10', 'POS-20230405-10', '1', '1', '1', '2023-04-05 09:13:53', '2023-04-05', '09:13:53', '12', '348', '360', '360', '1', '1212123', '5345345');
INSERT INTO `transactions` VALUES ('11', 'POS-20230411-11', '1', '1', '1', '2023-04-11 11:35:51', '2023-04-11', '11:35:51', '12', '18', '30', '30', '1', '0971231', '2323');
INSERT INTO `transactions` VALUES ('12', 'POS-20230411-12', '1', '1', '1', '2023-04-11 01:40:39', '2023-04-11', '01:40:39', '12', '48', '60', '60', '1', '0971231', '12312');
INSERT INTO `transactions` VALUES ('13', 'POS-20230411-13', '1', '1', '1', '2023-04-11 01:42:11', '2023-04-11', '01:42:11', '0', '105', '105', '105', '1', '0971231', '234');
INSERT INTO `transactions` VALUES ('14', 'POS-20230411-14', '1', '1', '2', '2023-04-11 14:21:33', '2023-04-11', '14:21:33', '345', '1058', '1403', '1403', '1', '1231', '434');
INSERT INTO `transactions` VALUES ('15', 'POS-20230412-15', '1', '1', '2', '2023-04-12 14:14:26', '2023-04-12', '14:14:26', '0', '516', '516', '516', '1', '1231', '2323');
INSERT INTO `transactions` VALUES ('16', 'POS-20230412-16', '1', '1', '1', '2023-04-12 17:04:41', '2023-04-12', '17:04:41', '0', '1500', '1080', '1500', '1', '1212', 'sdsd2');
INSERT INTO `transactions` VALUES ('17', 'POS-20230413-17', '1', '1', '2', '2023-04-13 15:24:36', '2023-04-13', '15:24:36', '0', '258', '258', '258', '1', 'fdsf2323', '234');
INSERT INTO `transactions` VALUES ('18', 'POS-20230413-18', '1', '1', '2', '2023-04-13 15:27:24', '2023-04-13', '15:27:24', '0', '1403', '1403', '1403', '1', '23', '234');
INSERT INTO `transactions` VALUES ('19', 'POS-20230413-19', '1', '1', '1', '2023-04-13 15:40:37', '2023-04-13', '15:40:37', '0', '2160', '2160', '2160', '1', 'df', 'd4');
INSERT INTO `transactions` VALUES ('20', 'POS-20230413-20', '1', '1', '2', '2023-04-13 15:42:09', '2023-04-13', '15:42:09', '0', '258', '258', '258', '1', 'df', 'sd');
INSERT INTO `transactions` VALUES ('21', 'POS-20230413-21', '1', '1', '1', '2023-04-13 17:04:12', '2023-04-13', '17:04:12', '0', '50', '15', '50', '1', 'sdf', 'sdf');
INSERT INTO `transactions` VALUES ('22', 'POS-20230413-22', '1', '1', '1', '2023-04-13 17:15:44', '2023-04-13', '17:15:44', '0', '780', '360', '780', '1', 'sadfsdf', 'sdfsd');
INSERT INTO `transactions` VALUES ('23', 'POS-20230414-23', '1', '1', '1', '2023-04-14 17:09:16', '2023-04-14', '17:09:16', '720', '0', '720', '720', '1', '0414', '2234');
INSERT INTO `transactions` VALUES ('24', 'POS-20230414-24', '1', '1', '2', '2023-04-14 17:10:13', '2023-04-14', '17:10:13', '258', '0', '258', '258', '1', '0971231', '32');
INSERT INTO `transactions` VALUES ('25', 'POS-20230414-25', '1', '1', '1', '2023-04-14 17:10:52', '2023-04-14', '17:10:52', '2', '13', '15', '15', '1', '231', '12');
INSERT INTO `transactions` VALUES ('26', 'POS-20230414-26', '1', '1', '2', '2023-04-14 17:11:36', '2023-04-14', '17:11:36', '1403', '0', '1403', '1403', '1', '123', '32');
INSERT INTO `transactions` VALUES ('27', 'POS-20230414-27', '1', '1', '1', '2023-04-14 17:12:02', '2023-04-14', '17:12:02', '0', '700', '700', '700', '1', '3', '231');
INSERT INTO `transactions` VALUES ('28', 'POS-20230414-28', '1', '1', '1', '2023-04-14 17:12:31', '2023-04-14', '17:12:31', '720', '0', '720', '720', '1', '234234', '2344');
INSERT INTO `transactions` VALUES ('29', 'POS-20230414-29', '1', '1', '2', '2023-04-14 17:32:06', '2023-04-14', '17:32:06', '64', '1', '65', '65', '1', '12312', '333');
INSERT INTO `transactions` VALUES ('30', 'POS-20230414-30', '1', '1', '2', '2023-04-14 17:53:41', '2023-04-14', '17:53:41', '516', '0', '516', '516', '1', '123', '2334');
INSERT INTO `transactions` VALUES ('31', 'POS-20230414-31', '1', '1', '2', '2023-04-14 18:13:23', '2023-04-14', '18:13:23', '1290', '0', '1290', '1290', '1', 'dfgdfg', 'wrwe23');
INSERT INTO `transactions` VALUES ('32', 'POS-20230414-32', '1', '1', '2', '2023-04-14 18:17:38', '2023-04-14', '18:17:38', '516', '0', '516', '516', '1', '213', '32');
INSERT INTO `transactions` VALUES ('33', 'POS-20230414-33', '1', '1', '1', '2023-04-14 18:18:57', '2023-04-14', '18:18:57', '30', '0', '30', '30', '1', '3453452', '23232');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) DEFAULT NULL,
  `usr_uuid` varchar(255) DEFAULT NULL,
  `usr_full_name` varchar(255) DEFAULT NULL,
  `usr_name` varchar(255) DEFAULT NULL,
  `usr_password` varchar(255) DEFAULT NULL,
  `usr_address` varchar(255) DEFAULT NULL,
  `usr_image` varchar(255) DEFAULT NULL,
  `usr_active` tinyint(4) DEFAULT '1',
  `typ_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', '23423v ertegrtg545g36h453645h654', 'Aq Cee Admin', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', null, '1.jpg', '1', '1');
INSERT INTO `users` VALUES ('2', '1', 'smd2fxqsidkfov8tnw6y45g9jqryc0gy', 'Kim Ji Won', 'kimjiwon', 'c17b6630268dbe52c5cf042327a7e65a', 'Seoul Tan Kudarat', null, '1', '3');
INSERT INTO `users` VALUES ('3', '1', '632uwv97etvmckms0k1sos0sz901ndhi', 'Mark', 'mark', 'ea82410c7a9991816b5eeeebe195e20a', 'Seoul Tan Kudarat', null, '1', '2');

-- ----------------------------
-- Table structure for `user_types`
-- ----------------------------
DROP TABLE IF EXISTS `user_types`;
CREATE TABLE `user_types` (
  `typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `typ_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`typ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_types
-- ----------------------------
INSERT INTO `user_types` VALUES ('1', 'Administrator');
INSERT INTO `user_types` VALUES ('2', 'Employee');
INSERT INTO `user_types` VALUES ('3', 'Observer');
INSERT INTO `user_types` VALUES ('4', 'Supervisor');
INSERT INTO `user_types` VALUES ('5', 'Plant Manager');
