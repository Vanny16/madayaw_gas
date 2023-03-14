/*
Navicat MySQL Data Transfer

Source Server         : server
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2023-03-14 18:54:50
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
  `acc_id` int(11) DEFAULT NULL,
  `trx_id` int(11) NOT NULL,
  `bo_crates` int(20) DEFAULT '0',
  `bo_loose` int(20) DEFAULT '0',
  PRIMARY KEY (`bo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bad_orders
-- ----------------------------
INSERT INTO `bad_orders` VALUES ('1', '1', '1', null, '2');
INSERT INTO `bad_orders` VALUES ('2', '1', '2', null, '2');
INSERT INTO `bad_orders` VALUES ('3', '1', '3', null, '3');
INSERT INTO `bad_orders` VALUES ('4', '1', '1', '1', null);

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
  `cus_active` tinyint(11) DEFAULT '1',
  PRIMARY KEY (`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', '1', 'e4fs4jr0fniplvqzol9wlnitx7l1vaex', 'Raevin', 'Indangan', '09121212312', '0', '4,5,', '20.00,35.00,', null, null, '1');
INSERT INTO `customers` VALUES ('2', '1', '328ir56v3w6yn0r55zozn19cevcb7ete', 'Glenn', 'UNSPECIFIED', '09800989080', '0', '4,5,', '20.00,35.00,', null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of movement_logs
-- ----------------------------
INSERT INTO `movement_logs` VALUES ('1', '1', '4', '0', '0', '600', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('2', '1', '5', '0', '0', '120', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('3', '1', '5', '0', '0', '120', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('4', '1', '5', '0', '0', '120', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('5', '1', '5', '0', '0', '240', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('6', '1', '4', '120', '0', '0', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('7', '1', '5', '0', '0', '0', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('8', '1', '5', '120', '0', '0', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('9', '1', '4', '0', '1200', '0', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('10', '1', '4', '0', '10', '0', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('11', '1', '4', '0', '9', '0', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('12', '1', '4', '0', '0', '0', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('13', '1', '5', '0', '0', '0', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('14', '1', '5', '0', '0', '0', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('15', '1', '5', '0', '0', '0', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('16', '1', '4', '0', '0', '0', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('17', '1', '4', '0', '3', '0', '0', '0', '1', '2023-03-13', '1');
INSERT INTO `movement_logs` VALUES ('18', '1', '4', '0', '6', '0', '0', '0', '1', '2023-03-14', '1');
INSERT INTO `movement_logs` VALUES ('19', '1', '4', '0', '2', '0', '0', '0', '1', '2023-03-14', '1');
INSERT INTO `movement_logs` VALUES ('20', '1', '4', '0', '2', '0', '0', '0', '1', '2023-03-14', '1');
INSERT INTO `movement_logs` VALUES ('21', '1', '5', '0', '3', '0', '0', '0', '1', '2023-03-14', '1');
INSERT INTO `movement_logs` VALUES ('22', '1', '4', '120', '0', '0', '0', '0', '1', '2023-03-14', '1');
INSERT INTO `movement_logs` VALUES ('23', '1', '4', '0', '12', '0', '0', '0', '1', '2023-03-14', '1');
INSERT INTO `movement_logs` VALUES ('24', '1', '5', '0', '0', '0', '1', '0', '1', '2023-03-14', '1');
INSERT INTO `movement_logs` VALUES ('25', '1', '5', '0', '0', '0', '1', '0', '1', '2023-03-14', '1');
INSERT INTO `movement_logs` VALUES ('26', '1', '5', '0', '0', '0', '1', '0', '1', '2023-03-14', '1');
INSERT INTO `movement_logs` VALUES ('27', '1', '4', '0', '0', '0', '1', '0', '1', '2023-03-14', '1');
INSERT INTO `movement_logs` VALUES ('28', '1', '5', '0', '0', '0', '12', '0', '1', '2023-03-14', '1');
INSERT INTO `movement_logs` VALUES ('29', '1', '4', '0', '0', '0', '12', '0', '1', '2023-03-14', '1');

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
  `acc_id` int(10) NOT NULL,
  `pmnt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pmnt_ref_id` varchar(30) DEFAULT NULL,
  `trx_id` int(10) unsigned NOT NULL,
  `pmnt_amount` double(30,0) NOT NULL,
  `pmnt_attachment` varchar(70) DEFAULT NULL,
  `usr_id` int(10) NOT NULL,
  `pmnt_date` varchar(20) DEFAULT NULL,
  `pmnt_time` varchar(20) DEFAULT NULL,
  `trx_mode_of_payment` int(2) DEFAULT NULL,
  PRIMARY KEY (`pmnt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES ('1', '1', 'PMT20230313-1', '1', '100', null, '1', '2023-03-13', '04:49:12', '2');
INSERT INTO `payments` VALUES ('1', '2', 'PMT20230313-2', '2', '300', null, '1', '2023-03-13', '05:36:59', '1');
INSERT INTO `payments` VALUES ('1', '3', 'PMT20230313-3', '3', '0', null, '1', '2023-03-13', '07:16:06', '2');
INSERT INTO `payments` VALUES ('1', '4', 'PMT20230314-4', '3', '23', null, '1', '2023-03-14', '04:53:30', '1');
INSERT INTO `payments` VALUES ('1', '5', 'PMT20230314-5', '1', '40', null, '1', '2023-03-14', '04:56:20', '1');

-- ----------------------------
-- Table structure for `payment_types`
-- ----------------------------
DROP TABLE IF EXISTS `payment_types`;
CREATE TABLE `payment_types` (
  `mode_of_payment` int(2) NOT NULL,
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
INSERT INTO `production_logs` VALUES ('1', '2023-03-13', '16:14:17', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '1', 't7grqisb1ko1484anr8ynjlyjfrjqcqi', 'MR Valve', 'MR Valve', 'V1', null, null, '0', '394.00', '0.00', '0.00', '0.00', '0', '1000.00', null, '1', '1', '0', '1', '0', null, '0', null);
INSERT INTO `products` VALUES ('2', '1', 'oddgbdwp1jwrtbwn7292hnjc7dqculb3', 'MS Valve', 'MS Valve', 'V2', null, null, '0', '394.00', '0.00', '0.00', '0.00', '0', '1000.00', null, '1', '1', '0', '1', '0', null, '0', null);
INSERT INTO `products` VALUES ('4', '1', '8mzq85eng3zyynbokvo99c2k4j1yuaso', 'Madayaw Round', 'MR Valve', 'MR1', null, '20.00', '35', '167.00', '1256.00', '386.00', '13.00', '0', '1000.00', null, '1', '1', '1', '1', '1', '147', '400', '1');
INSERT INTO `products` VALUES ('5', '1', '9815pezcyubzinr2e3d60vf8ni5yhsq8', 'Madayaw Square', 'MS LPG', 'MS1', null, '35.00', '20', '85.00', '8.00', '492.00', '15.00', '0', '1000.00', null, '1', '1', '1', '1', '1', '170', '400', '2');

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
  `pur_deposit` double(10,2) DEFAULT NULL,
  `pur_total` double(10,2) DEFAULT NULL,
  `pur_qty` int(11) DEFAULT NULL,
  `prd_price` double(10,2) DEFAULT NULL,
  `pur_crate_in` int(11) DEFAULT NULL,
  `pur_loose_in` int(11) DEFAULT NULL,
  PRIMARY KEY (`pur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of purchases
-- ----------------------------
INSERT INTO `purchases` VALUES ('1', '1', '4', '1', '0', '0.00', '240.00', '12', '20.00', '1', '0');
INSERT INTO `purchases` VALUES ('2', '2', '4', '1', '0', '0.00', '240.00', '12', '20.00', '1', '0');
INSERT INTO `purchases` VALUES ('3', '3', '5', '1', '0', '0.00', '420.00', '12', '35.00', '1', '0');
INSERT INTO `purchases` VALUES ('4', '3', '4', '0', '2', '0.00', '40.00', '2', '20.00', '0', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quantity_logs
-- ----------------------------
INSERT INTO `quantity_logs` VALUES ('1', '1', '4', '1', '1200', '2023-03-13 16:29:51', '1');
INSERT INTO `quantity_logs` VALUES ('2', '1', '4', '1', '1200', '2023-03-13 16:30:16', '1');
INSERT INTO `quantity_logs` VALUES ('3', '1', '1', '1', '1000', '2023-03-13 16:30:27', '1');
INSERT INTO `quantity_logs` VALUES ('4', '1', '2', '1', '1000', '2023-03-13 16:30:33', '1');
INSERT INTO `quantity_logs` VALUES ('5', '1', '4', '1', '1000', '2023-03-13 16:30:38', '1');
INSERT INTO `quantity_logs` VALUES ('6', '1', '5', '1', '1000', '2023-03-13 16:31:43', '1');
INSERT INTO `quantity_logs` VALUES ('7', '1', '4', '1', '1200', '2023-03-13 16:31:53', '1');
INSERT INTO `quantity_logs` VALUES ('8', '1', '4', '1', '600', '2023-03-13 16:32:01', '1');
INSERT INTO `quantity_logs` VALUES ('9', '1', '5', '1', '600', '2023-03-13 16:32:07', '1');
INSERT INTO `quantity_logs` VALUES ('10', '1', '5', '1', '600', '2023-03-13 16:33:10', '1');
INSERT INTO `quantity_logs` VALUES ('11', '1', '5', '1', '600', '2023-03-13 16:33:54', '1');
INSERT INTO `quantity_logs` VALUES ('12', '1', '5', '1', '120', '2023-03-13 16:34:00', '1');
INSERT INTO `quantity_logs` VALUES ('13', '1', '5', '1', '480', '2023-03-13 16:34:21', '1');
INSERT INTO `quantity_logs` VALUES ('14', '1', '5', '1', '120', '2023-03-13 16:34:55', '1');
INSERT INTO `quantity_logs` VALUES ('15', '1', '5', '1', '120', '2023-03-13 16:34:59', '1');
INSERT INTO `quantity_logs` VALUES ('16', '1', '5', '1', '240', '2023-03-13 16:35:04', '1');
INSERT INTO `quantity_logs` VALUES ('17', '1', '1', '1', '5000', '2023-03-13 16:44:22', '1');
INSERT INTO `quantity_logs` VALUES ('18', '1', '4', '1', '120', '2023-03-13 16:47:18', '1');
INSERT INTO `quantity_logs` VALUES ('19', '1', '1', '1', '5000', '2023-03-13 16:47:33', '1');
INSERT INTO `quantity_logs` VALUES ('20', '1', '2', '1', '5000', '2023-03-13 16:47:37', '1');
INSERT INTO `quantity_logs` VALUES ('21', '1', '1', '1', '5000', '2023-03-13 16:47:58', '1');
INSERT INTO `quantity_logs` VALUES ('22', '1', '5', '1', '0', '2023-03-13 16:48:22', '1');
INSERT INTO `quantity_logs` VALUES ('23', '1', '5', '1', '1200', '2023-03-13 16:48:30', '1');
INSERT INTO `quantity_logs` VALUES ('24', '1', '5', '1', '120', '2023-03-13 16:48:40', '1');
INSERT INTO `quantity_logs` VALUES ('25', '1', '4', '1', '1200', '2023-03-13 16:50:55', '1');
INSERT INTO `quantity_logs` VALUES ('26', '1', '5', '1', '20', '2023-03-13 16:51:44', '1');
INSERT INTO `quantity_logs` VALUES ('27', '1', '4', '1', '10', '2023-03-13 16:52:21', '1');
INSERT INTO `quantity_logs` VALUES ('28', '1', '4', '1', '9', '2023-03-13 16:52:35', '1');
INSERT INTO `quantity_logs` VALUES ('29', '1', '4', '1', '8', '2023-03-13 16:52:45', '1');
INSERT INTO `quantity_logs` VALUES ('30', '1', '4', '1', '0', '2023-03-13 18:09:26', '1');
INSERT INTO `quantity_logs` VALUES ('31', '1', '5', '1', '0', '2023-03-13 18:35:10', '1');
INSERT INTO `quantity_logs` VALUES ('32', '1', '5', '1', '0', '2023-03-13 18:35:11', '1');
INSERT INTO `quantity_logs` VALUES ('33', '1', '5', '1', '0', '2023-03-13 18:35:12', '1');
INSERT INTO `quantity_logs` VALUES ('34', '1', '4', '1', '0', '2023-03-13 18:55:47', '1');
INSERT INTO `quantity_logs` VALUES ('35', '1', '4', '1', '3', '2023-03-13 19:05:40', '1');
INSERT INTO `quantity_logs` VALUES ('36', '1', '4', '1', '0', '2023-03-13 19:09:30', '1');
INSERT INTO `quantity_logs` VALUES ('37', '1', '5', '1', '0', '2023-03-13 19:14:04', '1');
INSERT INTO `quantity_logs` VALUES ('38', '1', '5', '1', '0', '2023-03-13 19:15:25', '1');
INSERT INTO `quantity_logs` VALUES ('39', '1', '5', '1', '0', '2023-03-13 19:16:21', '1');
INSERT INTO `quantity_logs` VALUES ('40', '1', '4', '1', '10', '2023-03-14 11:56:27', '1');
INSERT INTO `quantity_logs` VALUES ('41', '1', '4', '1', '0', '2023-03-14 12:27:35', '1');
INSERT INTO `quantity_logs` VALUES ('42', '1', '4', '1', '0', '2023-03-14 12:32:21', '1');
INSERT INTO `quantity_logs` VALUES ('43', '1', '5', '1', '1', '2023-03-14 12:33:27', '1');
INSERT INTO `quantity_logs` VALUES ('44', '1', '4', '1', '0', '2023-03-14 12:38:39', '1');
INSERT INTO `quantity_logs` VALUES ('45', '1', '4', '1', '0', '2023-03-14 12:38:52', '1');
INSERT INTO `quantity_logs` VALUES ('46', '1', '4', '1', '0', '2023-03-14 12:39:07', '1');
INSERT INTO `quantity_logs` VALUES ('47', '1', '4', '1', '0', '2023-03-14 12:39:59', '1');
INSERT INTO `quantity_logs` VALUES ('48', '1', '4', '1', '0', '2023-03-14 12:41:38', '1');
INSERT INTO `quantity_logs` VALUES ('49', '1', '4', '1', '0', '2023-03-14 12:42:59', '1');
INSERT INTO `quantity_logs` VALUES ('50', '1', '4', '1', '0', '2023-03-14 12:43:28', '1');
INSERT INTO `quantity_logs` VALUES ('51', '1', '4', '1', '0', '2023-03-14 12:47:45', '1');
INSERT INTO `quantity_logs` VALUES ('52', '1', '4', '1', '0', '2023-03-14 13:21:48', '1');
INSERT INTO `quantity_logs` VALUES ('53', '1', '4', '1', '0', '2023-03-14 13:24:39', '1');
INSERT INTO `quantity_logs` VALUES ('54', '1', '4', '1', '0', '2023-03-14 13:24:46', '1');
INSERT INTO `quantity_logs` VALUES ('55', '1', '4', '1', '0', '2023-03-14 13:33:16', '1');
INSERT INTO `quantity_logs` VALUES ('56', '1', '4', '1', '6', '2023-03-14 13:54:04', '1');
INSERT INTO `quantity_logs` VALUES ('57', '1', '4', '1', '6', '2023-03-14 13:54:17', '1');
INSERT INTO `quantity_logs` VALUES ('58', '1', '4', '1', '6', '2023-03-14 13:56:21', '1');
INSERT INTO `quantity_logs` VALUES ('59', '1', '4', '1', '4', '2023-03-14 14:19:45', '1');
INSERT INTO `quantity_logs` VALUES ('60', '1', '4', '1', '4', '2023-03-14 14:20:57', '1');
INSERT INTO `quantity_logs` VALUES ('61', '1', '4', '1', '4', '2023-03-14 14:22:25', '1');
INSERT INTO `quantity_logs` VALUES ('62', '1', '4', '1', '0', '2023-03-14 14:23:42', '1');
INSERT INTO `quantity_logs` VALUES ('63', '1', '4', '1', '0', '2023-03-14 14:24:02', '1');
INSERT INTO `quantity_logs` VALUES ('64', '1', '4', '1', '0', '2023-03-14 14:24:20', '1');
INSERT INTO `quantity_logs` VALUES ('65', '1', '4', '1', '0', '2023-03-14 14:25:46', '1');
INSERT INTO `quantity_logs` VALUES ('66', '1', '4', '1', '0', '2023-03-14 14:25:53', '1');
INSERT INTO `quantity_logs` VALUES ('67', '1', '4', '1', '0', '2023-03-14 14:26:24', '1');
INSERT INTO `quantity_logs` VALUES ('68', '1', '4', '1', '0', '2023-03-14 14:27:20', '1');
INSERT INTO `quantity_logs` VALUES ('69', '1', '4', '1', '0', '2023-03-14 14:27:42', '1');
INSERT INTO `quantity_logs` VALUES ('70', '1', '4', '1', '2', '2023-03-14 14:28:08', '1');
INSERT INTO `quantity_logs` VALUES ('71', '1', '4', '1', '2', '2023-03-14 14:28:36', '1');
INSERT INTO `quantity_logs` VALUES ('72', '1', '4', '1', '2', '2023-03-14 14:29:52', '1');
INSERT INTO `quantity_logs` VALUES ('73', '1', '5', '1', '3', '2023-03-14 14:30:15', '1');
INSERT INTO `quantity_logs` VALUES ('74', '1', '1', '1', '5000', '2023-03-14 15:00:17', '1');
INSERT INTO `quantity_logs` VALUES ('75', '1', '2', '1', '5000', '2023-03-14 15:01:34', '1');
INSERT INTO `quantity_logs` VALUES ('76', '1', '1', '1', '5000', '2023-03-14 15:13:37', '1');
INSERT INTO `quantity_logs` VALUES ('77', '1', '1', '1', '1000', '2023-03-14 16:03:14', '1');
INSERT INTO `quantity_logs` VALUES ('78', '1', '1', '1', '1000000', '2023-03-14 16:06:36', '1');
INSERT INTO `quantity_logs` VALUES ('79', '1', '2', '1', '1000000', '2023-03-14 16:29:55', '1');
INSERT INTO `quantity_logs` VALUES ('80', '1', '2', '1', '1000000', '2023-03-14 16:30:38', '1');
INSERT INTO `quantity_logs` VALUES ('81', '1', '2', '1', '100000', '2023-03-14 17:35:36', '1');
INSERT INTO `quantity_logs` VALUES ('82', '1', '4', '1', '120', '2023-03-14 17:39:55', '1');
INSERT INTO `quantity_logs` VALUES ('83', '1', '4', '1', '6', '2023-03-14 17:53:59', '1');
INSERT INTO `quantity_logs` VALUES ('84', '1', '5', '1', '0', '2023-03-14 17:55:40', '1');
INSERT INTO `quantity_logs` VALUES ('85', '1', '4', '1', '1', '2023-03-14 18:02:39', '1');
INSERT INTO `quantity_logs` VALUES ('86', '1', '4', '1', '12', '2023-03-14 18:02:53', '1');
INSERT INTO `quantity_logs` VALUES ('87', '1', '5', '1', '1', '2023-03-14 18:04:35', '1');
INSERT INTO `quantity_logs` VALUES ('88', '1', '5', '1', '1', '2023-03-14 18:04:47', '1');
INSERT INTO `quantity_logs` VALUES ('89', '1', '5', '1', '1', '2023-03-14 18:04:57', '1');
INSERT INTO `quantity_logs` VALUES ('90', '1', '4', '1', '1', '2023-03-14 18:07:10', '1');
INSERT INTO `quantity_logs` VALUES ('91', '1', '5', '1', '144', '2023-03-14 18:26:15', '1');
INSERT INTO `quantity_logs` VALUES ('92', '1', '5', '1', '12', '2023-03-14 18:26:23', '1');
INSERT INTO `quantity_logs` VALUES ('93', '1', '4', '1', '12', '2023-03-14 18:26:32', '1');

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
  `sup_active` tinyint(11) DEFAULT '1',
  PRIMARY KEY (`sup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES ('1', 'dyuregvgy6upldng3nbvfqebzgkw0vmm', '1', 'Madayaw Gas', 'Bunawan', '09871242342', null, null, '1');

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
INSERT INTO `tanks` VALUES ('1', '1', 'Tank 1', '5000000', '982360', null, null, '1');
INSERT INTO `tanks` VALUES ('2', '1', 'Tank2', '5000000', '2100000', null, null, '1');

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
INSERT INTO `tank_logs` VALUES ('1', '1', '0', null, null, '17');
INSERT INTO `tank_logs` VALUES ('2', '1', '1', null, null, '19');
INSERT INTO `tank_logs` VALUES ('3', '1', '1', '3', '3', '20');

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
  `trx_total` decimal(11,0) DEFAULT NULL,
  PRIMARY KEY (`trx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES ('1', 'POS-20230313-1', '1', '1', '1', '2023-03-13 04:49:12', '2023-03-13', '04:49:12', '100', '100', '240');
INSERT INTO `transactions` VALUES ('2', 'POS-20230313-2', '1', '1', '1', '2023-03-13 05:36:59', '2023-03-13', '05:36:59', '300', '-60', '240');
INSERT INTO `transactions` VALUES ('3', 'POS-20230313-3', '1', '1', '2', '2023-03-13 07:16:06', '2023-03-13', '07:16:06', '0', '437', '460');

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
  `usr_active` tinyint(255) DEFAULT '1',
  `typ_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', 'ribjm16on9j2hewbnp7f957tmckj7o58', 'Aq Cee Admin', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'University of Malagos', '1.jpg', '1', '1');

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
