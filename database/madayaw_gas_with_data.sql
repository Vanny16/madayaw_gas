/*
Navicat MySQL Data Transfer

Source Server         : server
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2023-03-23 11:42:17
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
INSERT INTO `customers` VALUES ('1', '1', 'wn520n8rbs30y84o2l040domc18jvei0', 'Mark Glenn Rojas', 'Indangan', '09800989080', '0', '2,6,', '55.00,700.00,', null, null, '1');
INSERT INTO `customers` VALUES ('2', '1', 'kjur06unnk6yptmjaqhtgemkgm5196ci', 'DJV', 'ta', '12312312312', '0', '2,4,5,6,', '55.00,55.00,55.00,700.00,', null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of movement_logs
-- ----------------------------
INSERT INTO `movement_logs` VALUES ('1', '1', '2', '0', '0', '1', '0', '0', '1', '2023-03-22', '1');
INSERT INTO `movement_logs` VALUES ('2', '1', '2', '0', '0', '1', '0', '0', '1', '2023-03-22', '1');
INSERT INTO `movement_logs` VALUES ('3', '1', '4', '0', '0', '1', '0', '0', '1', '2023-03-22', '1');
INSERT INTO `movement_logs` VALUES ('4', '1', '4', '0', '0', '1', '0', '0', '1', '2023-03-22', '1');
INSERT INTO `movement_logs` VALUES ('5', '1', '4', '0', '0', '1', '0', '0', '1', '2023-03-22', '1');
INSERT INTO `movement_logs` VALUES ('6', '1', '2', '0', '0', '1', '0', '0', '1', '2023-03-22', '1');
INSERT INTO `movement_logs` VALUES ('7', '1', '2', '0', '0', '1', '0', '0', '1', '2023-03-22', '1');
INSERT INTO `movement_logs` VALUES ('8', '1', '4', '0', '0', '1', '0', '0', '1', '2023-03-22', '1');
INSERT INTO `movement_logs` VALUES ('9', '1', '2', '0', '0', '1', '0', '0', '1', '2023-03-22', '1');
INSERT INTO `movement_logs` VALUES ('10', '1', '2', '0', '0', '1000', '0', '0', '1', '2023-03-22', '1');
INSERT INTO `movement_logs` VALUES ('11', '1', '2', '500', '0', '0', '0', '0', '1', '2023-03-22', '1');
INSERT INTO `movement_logs` VALUES ('12', '1', '2', '0', '0', '0', '50', '0', '1', '2023-03-22', '1');
INSERT INTO `movement_logs` VALUES ('13', '1', '2', '0', '0', '0', '0', '50', '1', '2023-03-22', '1');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of oppositions
-- ----------------------------

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
  PRIMARY KEY (`pmnt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payments
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of production_logs
-- ----------------------------
INSERT INTO `production_logs` VALUES ('1', '2023-03-22', '19:16:02', null);

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
  `prd_quantity` decimal(10,2) DEFAULT '0.00',
  `prd_leakers` decimal(10,2) DEFAULT '0.00',
  `prd_empty_goods` decimal(10,2) DEFAULT '0.00',
  `prd_for_revalving` decimal(10,2) DEFAULT '0.00',
  `prd_scraps` double DEFAULT '0',
  `prd_reorder_point` decimal(10,2) DEFAULT NULL,
  `prd_image` varchar(255) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `prd_active` tinyint(4) DEFAULT '1',
  `prd_is_refillable` tinyint(4) DEFAULT '1',
  `prd_for_production` tinyint(4) DEFAULT '1',
  `prd_for_POS` tinyint(4) DEFAULT NULL,
  `prd_weight` decimal(10,0) DEFAULT NULL,
  `prd_raw_can_qty` int(11) DEFAULT '0',
  `prd_components` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`prd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '1', 'c0541b812dldf3t2zhp4oofdfsnbvpjp', 'MR Valve', 'Valve for Madayaw Round', 'MRValve', null, null, '0', '18994.00', '0.00', '0.00', '0.00', '0', '5000.00', null, '1', '1', '0', '1', '0', null, '0', null);
INSERT INTO `products` VALUES ('2', '1', '5nsflhfg73w8ylisbeh4s535yublb6mr', 'Madayaw Round', 'Madayaw Round 170g', 'MadayawRound170', null, '55.00', '20', '399.00', '1.00', '505.00', '50.00', '50', '5000.00', null, '2', '1', '1', '1', '1', '170', '18995', '1');
INSERT INTO `products` VALUES ('3', '1', 'guwtglcueorcx99mubsz359urcf231nj', 'MS Valve', 'MS Valve', 'MSValve', null, null, '0', '0.00', '0.00', '0.00', '0.00', '0', '5000.00', null, '1', '1', '0', '1', '0', null, '0', null);
INSERT INTO `products` VALUES ('4', '1', 'iofc9s4bq0wpj2qej140f3reab20s2tk', 'Madayaw Square', 'Madayaw Square 170g', 'Madayaw Square 170', null, '55.00', '20', '0.00', '0.00', '4.00', '0.00', '0', '5000.00', null, '2', '1', '1', '1', '1', '170', '0', '3');
INSERT INTO `products` VALUES ('5', '1', 'vo4h871ndml5nsni63so2r21fv4ia4m2', 'Botin', 'BOTIN 170g', 'BOTIN 170', null, '55.00', '20', '0.00', '0.00', '0.00', '0.00', '0', '5000.00', null, '2', '0', '1', '1', '1', '170', '0', '1');
INSERT INTO `products` VALUES ('6', '1', 'vhuz23zpg8hnyilvlh20s3b21039b8r2', 'Gas Stove 1 Burner', 'Gas Stove 1 Burner', 'GS1B', null, '700.00', '0', '1000.00', '0.00', '0.00', '0.00', '0', '100.00', null, '3', '1', '0', '0', '1', null, '0', null);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of purchases
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quantity_logs
-- ----------------------------
INSERT INTO `quantity_logs` VALUES ('1', '1', '1', '1', '20000', '2023-03-22 19:34:21', '1');
INSERT INTO `quantity_logs` VALUES ('2', '1', '2', '1', '1000', '2023-03-22 19:34:40', '1');
INSERT INTO `quantity_logs` VALUES ('3', '1', '2', '1', '9000', '2023-03-22 19:34:56', '1');
INSERT INTO `quantity_logs` VALUES ('4', '1', '2', '1', '0', '2023-03-22 19:35:13', '1');
INSERT INTO `quantity_logs` VALUES ('5', '1', '2', '1', '0', '2023-03-22 19:35:20', '1');
INSERT INTO `quantity_logs` VALUES ('6', '1', '1', '1', '0', '2023-03-22 19:35:25', '1');
INSERT INTO `quantity_logs` VALUES ('7', '1', '2', '1', '1000', '2023-03-22 19:38:32', '1');
INSERT INTO `quantity_logs` VALUES ('8', '1', '2', '1', '1000', '2023-03-22 19:38:47', '1');
INSERT INTO `quantity_logs` VALUES ('9', '1', '2', '1', '1000', '2023-03-22 19:39:04', '1');
INSERT INTO `quantity_logs` VALUES ('10', '1', '2', '1', '1', '2023-03-22 19:39:30', '1');
INSERT INTO `quantity_logs` VALUES ('11', '1', '2', '1', '1', '2023-03-22 19:40:12', '1');
INSERT INTO `quantity_logs` VALUES ('12', '1', '2', '1', '1', '2023-03-22 19:40:24', '1');
INSERT INTO `quantity_logs` VALUES ('13', '1', '2', '1', '1', '2023-03-22 19:41:18', '1');
INSERT INTO `quantity_logs` VALUES ('14', '1', '2', '1', '1', '2023-03-22 19:41:38', '1');
INSERT INTO `quantity_logs` VALUES ('15', '1', '2', '1', '1', '2023-03-22 19:41:55', '1');
INSERT INTO `quantity_logs` VALUES ('16', '1', '2', '1', '1', '2023-03-22 19:42:50', '1');
INSERT INTO `quantity_logs` VALUES ('17', '1', '2', '1', '1', '2023-03-22 19:43:00', '1');
INSERT INTO `quantity_logs` VALUES ('18', '1', '2', '1', '1', '2023-03-22 19:43:11', '1');
INSERT INTO `quantity_logs` VALUES ('19', '1', '2', '1', '1', '2023-03-22 19:44:18', '1');
INSERT INTO `quantity_logs` VALUES ('20', '1', '2', '1', '1', '2023-03-22 19:44:45', '1');
INSERT INTO `quantity_logs` VALUES ('21', '1', '2', '1', '1', '2023-03-22 19:45:34', '1');
INSERT INTO `quantity_logs` VALUES ('22', '1', '2', '1', '1', '2023-03-22 19:45:40', '1');
INSERT INTO `quantity_logs` VALUES ('23', '1', '4', '1', '1', '2023-03-22 19:45:43', '1');
INSERT INTO `quantity_logs` VALUES ('24', '1', '4', '1', '1', '2023-03-22 19:45:43', '1');
INSERT INTO `quantity_logs` VALUES ('25', '1', '4', '1', '1', '2023-03-22 19:45:51', '1');
INSERT INTO `quantity_logs` VALUES ('26', '1', '3', '1', '3', '2023-03-22 19:46:32', '1');
INSERT INTO `quantity_logs` VALUES ('27', '1', '4', '1', '3', '2023-03-22 19:46:34', '1');
INSERT INTO `quantity_logs` VALUES ('28', '1', '4', '1', '1', '2023-03-22 19:46:40', '1');
INSERT INTO `quantity_logs` VALUES ('29', '1', '2', '1', '1', '2023-03-22 19:46:43', '1');
INSERT INTO `quantity_logs` VALUES ('30', '1', '2', '1', '10000', '2023-03-22 19:47:10', '1');
INSERT INTO `quantity_logs` VALUES ('31', '1', '2', '1', '1', '2023-03-22 19:47:16', '1');
INSERT INTO `quantity_logs` VALUES ('32', '1', '2', '1', '1', '2023-03-22 19:49:19', '1');
INSERT INTO `quantity_logs` VALUES ('33', '1', '2', '1', '1', '2023-03-22 19:53:50', '1');
INSERT INTO `quantity_logs` VALUES ('34', '1', '2', '1', '1', '2023-03-22 19:54:50', '1');
INSERT INTO `quantity_logs` VALUES ('35', '1', '2', '1', '1', '2023-03-22 19:54:55', '1');
INSERT INTO `quantity_logs` VALUES ('36', '1', '4', '1', '1', '2023-03-22 19:54:57', '1');
INSERT INTO `quantity_logs` VALUES ('37', '1', '2', '1', '1', '2023-03-22 19:55:54', '1');
INSERT INTO `quantity_logs` VALUES ('38', '1', '2', '1', '1', '2023-03-22 19:56:00', '1');
INSERT INTO `quantity_logs` VALUES ('39', '1', '2', '1', '1', '2023-03-22 19:56:29', '1');
INSERT INTO `quantity_logs` VALUES ('40', '1', '2', '1', '1', '2023-03-22 19:56:47', '1');
INSERT INTO `quantity_logs` VALUES ('41', '1', '2', '1', '1', '2023-03-22 19:59:26', '1');
INSERT INTO `quantity_logs` VALUES ('42', '1', '2', '1', '1', '2023-03-22 19:59:35', '1');
INSERT INTO `quantity_logs` VALUES ('43', '1', '2', '1', '1', '2023-03-22 19:59:39', '1');
INSERT INTO `quantity_logs` VALUES ('44', '1', '4', '1', '1', '2023-03-22 19:59:42', '1');
INSERT INTO `quantity_logs` VALUES ('45', '1', '2', '1', '1', '2023-03-22 19:59:46', '1');
INSERT INTO `quantity_logs` VALUES ('46', '1', '2', '1', '1', '2023-03-22 20:02:23', '1');
INSERT INTO `quantity_logs` VALUES ('47', '1', '4', '1', '1', '2023-03-22 20:02:31', '1');
INSERT INTO `quantity_logs` VALUES ('48', '1', '2', '1', '1', '2023-03-22 20:02:34', '1');
INSERT INTO `quantity_logs` VALUES ('49', '1', '2', '1', '1', '2023-03-22 20:04:09', '1');
INSERT INTO `quantity_logs` VALUES ('50', '1', '2', '1', '1', '2023-03-22 20:04:32', '1');
INSERT INTO `quantity_logs` VALUES ('51', '1', '2', '1', '1', '2023-03-22 20:07:07', '1');
INSERT INTO `quantity_logs` VALUES ('52', '1', '2', '1', '1', '2023-03-22 20:08:08', '1');
INSERT INTO `quantity_logs` VALUES ('53', '1', '2', '1', '1', '2023-03-22 20:08:19', '1');
INSERT INTO `quantity_logs` VALUES ('54', '1', '2', '1', '1', '2023-03-22 20:08:39', '1');
INSERT INTO `quantity_logs` VALUES ('55', '1', '2', '1', '1', '2023-03-22 20:09:05', '1');
INSERT INTO `quantity_logs` VALUES ('56', '1', '4', '1', '1', '2023-03-22 20:09:12', '1');
INSERT INTO `quantity_logs` VALUES ('57', '1', '4', '1', '1', '2023-03-22 20:09:31', '1');
INSERT INTO `quantity_logs` VALUES ('58', '1', '3', '1', '1', '2023-03-22 20:09:38', '1');
INSERT INTO `quantity_logs` VALUES ('59', '1', '4', '1', '1', '2023-03-22 20:09:42', '1');
INSERT INTO `quantity_logs` VALUES ('60', '1', '2', '1', '1000', '2023-03-22 20:14:29', '1');
INSERT INTO `quantity_logs` VALUES ('61', '1', '4', '1', '1000', '2023-03-22 20:14:35', '1');
INSERT INTO `quantity_logs` VALUES ('62', '1', '2', '1', '500', '2023-03-22 20:14:48', '1');
INSERT INTO `quantity_logs` VALUES ('63', '1', '1', '1', '5000000', '2023-03-22 20:15:09', '1');
INSERT INTO `quantity_logs` VALUES ('64', '1', '2', '1', '500', '2023-03-22 20:24:07', '1');
INSERT INTO `quantity_logs` VALUES ('65', '1', '4', '1', '1', '2023-03-22 20:24:26', '1');
INSERT INTO `quantity_logs` VALUES ('66', '1', '2', '1', '1000', '2023-03-22 20:24:44', '1');
INSERT INTO `quantity_logs` VALUES ('67', '1', '2', '1', '1', '2023-03-22 20:24:57', '1');
INSERT INTO `quantity_logs` VALUES ('68', '1', '2', '1', '1', '2023-03-22 20:25:24', '1');
INSERT INTO `quantity_logs` VALUES ('69', '1', '2', '1', '1', '2023-03-22 20:25:53', '1');
INSERT INTO `quantity_logs` VALUES ('70', '1', '4', '1', '1000', '2023-03-22 20:26:01', '1');
INSERT INTO `quantity_logs` VALUES ('71', '1', '2', '1', '1000', '2023-03-22 20:26:11', '1');
INSERT INTO `quantity_logs` VALUES ('72', '1', '2', '1', '100', '2023-03-22 20:26:46', '1');
INSERT INTO `quantity_logs` VALUES ('73', '1', '2', '1', '100', '2023-03-22 20:26:59', '1');
INSERT INTO `quantity_logs` VALUES ('74', '1', '2', '1', '100', '2023-03-22 20:27:12', '1');
INSERT INTO `quantity_logs` VALUES ('75', '1', '2', '1', '100', '2023-03-22 20:27:23', '1');
INSERT INTO `quantity_logs` VALUES ('76', '1', '2', '1', '100', '2023-03-22 20:27:59', '1');
INSERT INTO `quantity_logs` VALUES ('77', '1', '2', '1', '50', '2023-03-22 20:28:11', '1');
INSERT INTO `quantity_logs` VALUES ('78', '1', '2', '1', '50', '2023-03-22 20:28:19', '1');
INSERT INTO `quantity_logs` VALUES ('79', '1', '6', '1', '1000', '2023-03-22 20:33:47', '1');

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
  `log_quantity` decimal(11,0) DEFAULT '0',
  `log_leakers` decimal(10,0) DEFAULT '0',
  `log_empty_goods` decimal(10,0) DEFAULT '0',
  `log_for_revalving` decimal(10,0) DEFAULT '0',
  `log_scraps` decimal(10,0) DEFAULT '0',
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
  PRIMARY KEY (`stk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stocks_logs
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES ('1', '39r57ilhoxtrzecku3b8wmq3p42vh16h', '1', 'Valve Supplier', 'Shenzen, China', '09123123123', 'New Supplier', null, '1');
INSERT INTO `suppliers` VALUES ('2', 'l80upc929cohqsqeiz5zylyjnz72lnm4', '1', 'Canister Supplier', 'Shenzen, China', '2212265', 'Updated Supplier', null, '1');
INSERT INTO `suppliers` VALUES ('3', 'jn7gkwxoyq3sv80gd715xfqb38du6bfj', '1', 'Davao City', 'Bunawan', '09234234242', null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tanks
-- ----------------------------
INSERT INTO `tanks` VALUES ('1', '1', 'LPG Tank', '5000000', '4915000', 'Updated Tank Details', null, '1');
INSERT INTO `tanks` VALUES ('2', '1', 'Tank 2', '5000000', '0', 'New Tank', null, '0');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tank_logs
-- ----------------------------

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
  PRIMARY KEY (`trx_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of transactions
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', '23423v ertegrtg545g36h453645h654', 'Aq Cee Admin', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', null, '1.jpg', '1', '1');

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
