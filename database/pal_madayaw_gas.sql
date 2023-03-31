/*
Navicat MySQL Data Transfer

Source Server         : server
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2023-03-31 18:41:20
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bad_orders
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

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
INSERT INTO `oppositions` VALUES ('1', 'kda2cl0kccsjmn9cg7elskjq9wtj0kd2', 'Tripler', 'T1', 'Tripler', '100', null, null, '1', '1');

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
  PRIMARY KEY (`pmnt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES ('1', '1', 'PMT20230330-1', '1', '1060', null, '1', '2023-03-30', '12:31:33', '1', '1060', '0');
INSERT INTO `payments` VALUES ('1', '2', 'PMT20230330-2', '2', '480', null, '1', '2023-03-30', '12:34:31', '2', '480', '0');
INSERT INTO `payments` VALUES ('1', '3', 'PMT20230330-3', '3', '1200', '3.jpg', '1', '2023-03-30', '12:36:27', '3', '1200', '0');
INSERT INTO `payments` VALUES ('1', '4', 'PMT20230331-4', '4', '0', null, '1', '2023-03-31', '11:51:55', '2', '0', '0');
INSERT INTO `payments` VALUES ('1', '5', 'PMT20230331-5', '5', '30', null, '1', '2023-03-31', '11:59:20', '1', '50', '20');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '1', '6yu8x39d3a8zr3s54o2x8zmk69y8j8q2', 'MR Valve', 'MR Valve', 'MRV', null, null, '0', '7898', '0', '0', '0', '0', '1000', null, '1', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('2', '1', 'm6hanwc9u1ik3y8inh2o1l7vwj8mc4o6', 'MS Valve', 'MS Valve', 'MSV', null, null, '0', '9000', '0', '0', '0', '0', '1000', null, '1', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('3', '1', 'ayrjsmj0z0hlhouabj6k9jksp47sv41z', 'Madayaw Round', 'MR LPG', 'MR170', null, '20.00', '35', '225', '0', '835', '0', '50', '1000', null, '2', '1', '1', '1', '1', '170', '8900', '1', '8');
INSERT INTO `products` VALUES ('4', '1', 'reg89nc0wyi98jzr9hd7aiozsc6ba7tj', 'Madayaw Square', 'MS LPG', 'MS170', null, '20.00', '35', '476', '0', '500', '0', '0', '1000', null, '2', '1', '1', '1', '1', '170', '9000', '2', null);
INSERT INTO `products` VALUES ('5', '1', 'ydg5a6fi8dit015u5wr6ehi02la4jgfa', 'Botin', 'BOTIN170', 'BOTIN170', null, '20.00', '35', '500', '0', '500', '0', '0', '1000', null, '2', '1', '1', '1', '1', '170', '9000', '1', null);
INSERT INTO `products` VALUES ('6', '1', '851bmkfdi98c2gk2vom508y4m8q8gb58', 'Gas Stove', 'Gas Stove 1 Burner', 'GS1B', null, '700.00', '0', '999', '0', '0', '0', '0', '1000', null, '1', '1', '0', '0', '1', null, '0', null, null);
INSERT INTO `products` VALUES ('8', '1', 'qqh27g0i5x1t35vuhv3c40um2bla1ger', 'Seal', 'Seal', 'Seal', null, null, '0', '0', '0', '0', '0', '0', '12323', null, '1', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('9', '1', 'cfbgf3pnxws9svdsytvbou1n6d1fvzwk', 'Botin 2.0', 'BOTIN 2nd Version', 'Botin 2.0 170g', null, '20.00', '35', '0', '0', '0', '0', '0', '2000', null, '1', '1', '1', '1', '1', '170', '0', '1', '8');
INSERT INTO `products` VALUES ('10', '1', 'osge7t90by1h2zpaid2jktia76f5v6yo', 'Canister', 'Canister', 'Canister170', null, '20.00', '35', '0', '0', '0', '0', '0', '2000', null, '1', '1', '1', '1', '1', '170', '0', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

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
INSERT INTO `stocks_logs` VALUES ('1', '1', '3', null, '328', '1', '0', '4320', '0', '0', '50', '50');
INSERT INTO `stocks_logs` VALUES ('2', '1', '4', null, '476', '1', '0', '500', '500', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('3', '1', '5', null, '500', '1', '0', '0', '500', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('4', '1', '3', '328', '228', '2', '0', '4320', '0', '0', '100', '0');
INSERT INTO `stocks_logs` VALUES ('5', '1', '4', '476', '476', '2', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('6', '1', '5', '500', '500', '2', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('7', '1', '7', null, '10', '2', '1000', '0', '10', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('8', '1', '3', '228', null, '3', '0', '4320', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('9', '1', '4', '476', null, '3', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('10', '1', '5', '500', null, '3', '0', '0', '0', '0', '0', '0');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES ('1', 'POS-20230330-1', '1', '1', '1', '2023-03-30 12:31:33', '2023-03-30', '12:31:33', '1060', '0', '1060', '1060', '1', null, null);
INSERT INTO `transactions` VALUES ('2', 'POS-20230330-2', '1', '1', '2', '2023-03-30 12:34:31', '2023-03-30', '12:34:31', '480', '480', '960', '960', '1', null, null);
INSERT INTO `transactions` VALUES ('3', 'POS-20230330-3', '1', '1', '1', '2023-03-30 12:36:27', '2023-03-30', '12:36:27', '1200', '0', '360', '1200', '1', null, null);
INSERT INTO `transactions` VALUES ('4', 'POS-20230331-4', '1', '1', '1', '2023-03-31 11:51:55', '2023-03-31', '11:51:55', '0', '30', '30', '30', '1', null, null);
INSERT INTO `transactions` VALUES ('5', 'POS-20230331-5', '1', '1', '1', '2023-03-31 11:59:20', '2023-03-31', '11:59:20', '30', '0', '30', '30', '1', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_types
-- ----------------------------
INSERT INTO `user_types` VALUES ('1', 'Administrator');
INSERT INTO `user_types` VALUES ('2', 'Employee');
INSERT INTO `user_types` VALUES ('3', 'Observer');
