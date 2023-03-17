/*
Navicat MySQL Data Transfer

Source Server         : server
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2023-03-17 18:23:39
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
  `bo_crates` int(11) DEFAULT '0',
  `bo_loose` int(11) DEFAULT '0',
  `bo_date` varchar(20) DEFAULT NULL,
  `bo_time` varchar(20) DEFAULT NULL,
  `bo_datetime` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`bo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bad_orders
-- ----------------------------
INSERT INTO `bad_orders` VALUES ('1', 'BO-20230317-1', '1', '2', null, '1', '2023-03-17', '18:15:17', '2023-03-17 18:15:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', '1', 'p1rt404y1w386gezhilhayemydwvuq9z', 'Kim Dahyun', 'Seoul Tan Kudarat', '09800989080', '0', '3,4,5,', '20.00,20.00,700.00,', null, null, '1');
INSERT INTO `customers` VALUES ('2', '1', '716joaaj3uoueo9r1aw84dw8k6gz54or', 'Im Nayeon', 'Seuolup', '09123123122', '0', '3,4,', '20.00,30.00,', null, null, '1');
INSERT INTO `customers` VALUES ('3', '1', '54bb7u217nax70v809f5yubgxzrzgp6u', 'Myoui Mina', 'Gangnam', '09234234234', '0', '4,5,', '10.00,700.00,', null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of movement_logs
-- ----------------------------
INSERT INTO `movement_logs` VALUES ('1', '1', '3', '0', '0', '120', '0', '0', '1', '2023-03-17', '1');
INSERT INTO `movement_logs` VALUES ('2', '1', '4', '0', '0', '120', '0', '0', '1', '2023-03-17', '1');
INSERT INTO `movement_logs` VALUES ('3', '1', '4', '0', '0', '30', '0', '0', '1', '2023-03-17', '1');
INSERT INTO `movement_logs` VALUES ('4', '1', '3', '1', '0', '0', '0', '0', '1', '2023-03-17', '1');
INSERT INTO `movement_logs` VALUES ('5', '1', '3', '119', '0', '0', '0', '0', '1', '2023-03-17', '1');
INSERT INTO `movement_logs` VALUES ('6', '1', '3', '0', '0', '120', '0', '0', '1', '2023-03-17', '1');
INSERT INTO `movement_logs` VALUES ('7', '1', '4', '120', '0', '0', '0', '0', '1', '2023-03-17', '1');
INSERT INTO `movement_logs` VALUES ('8', '1', '3', '0', '1', '0', '0', '0', '1', '2023-03-17', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES ('1', '1', 'PMT20230317-1', '1', '0', null, '1', '2023-03-17', '02:10:28', '2');
INSERT INTO `payments` VALUES ('1', '2', 'PMT20230317-2', '2', '0', null, '1', '2023-03-17', '02:44:30', '2');
INSERT INTO `payments` VALUES ('1', '3', 'PMT20230317-3', '3', '0', null, '1', '2023-03-17', '02:47:48', '2');
INSERT INTO `payments` VALUES ('1', '4', 'PMT20230317-4', '4', '915', null, '1', '2023-03-17', '02:52:39', '1');
INSERT INTO `payments` VALUES ('1', '5', 'PMT20230317-5', '5', '915', null, '1', '2023-03-17', '02:59:57', '3');
INSERT INTO `payments` VALUES ('1', '6', 'PMT20230317-6', '6', '1000', null, '1', '2023-03-17', '03:07:44', '1');
INSERT INTO `payments` VALUES ('1', '7', 'PMT20230317-7', '7', '0', null, '1', '2023-03-17', '03:19:34', '2');
INSERT INTO `payments` VALUES ('1', '8', 'PMT20230317-8', '8', '0', null, '1', '2023-03-17', '03:20:45', '2');
INSERT INTO `payments` VALUES ('1', '9', 'PMT20230317-9', '9', '0', null, '1', '2023-03-17', '03:27:03', '2');
INSERT INTO `payments` VALUES ('1', '10', 'PMT20230317-10', '10', '0', null, '1', '2023-03-17', '03:28:09', '2');
INSERT INTO `payments` VALUES ('1', '11', 'PMT20230317-11', '11', '0', null, '1', '2023-03-17', '03:33:53', '2');
INSERT INTO `payments` VALUES ('1', '12', 'PMT20230317-12', '12', '0', null, '1', '2023-03-17', '03:37:18', '2');
INSERT INTO `payments` VALUES ('1', '13', 'PMT20230317-13', '13', '0', null, '1', '2023-03-17', '03:43:48', '2');
INSERT INTO `payments` VALUES ('1', '14', 'PMT20230317-14', '14', '0', null, '1', '2023-03-17', '03:48:21', '2');
INSERT INTO `payments` VALUES ('1', '15', 'PMT20230317-15', '15', '0', null, '1', '2023-03-17', '03:49:48', '2');
INSERT INTO `payments` VALUES ('1', '16', 'PMT20230317-16', '16', '0', null, '1', '2023-03-17', '03:51:10', '2');
INSERT INTO `payments` VALUES ('1', '17', 'PMT20230317-17', '17', '0', null, '1', '2023-03-17', '03:53:54', '2');
INSERT INTO `payments` VALUES ('1', '18', 'PMT20230317-18', '18', '0', null, '1', '2023-03-17', '03:58:21', '2');
INSERT INTO `payments` VALUES ('1', '19', 'PMT20230317-19', '19', '0', null, '1', '2023-03-17', '04:05:02', '2');
INSERT INTO `payments` VALUES ('1', '20', 'PMT20230317-20', '7', '12', null, '1', '2023-03-17', '04:19:14', '1');
INSERT INTO `payments` VALUES ('1', '21', 'PMT20230317-21', '7', '88', null, '1', '2023-03-17', '04:30:39', '1');
INSERT INTO `payments` VALUES ('1', '22', 'PMT20230317-22', '10', '8', null, '1', '2023-03-17', '04:42:16', '1');
INSERT INTO `payments` VALUES ('1', '23', 'PMT20230317-23', '7', '100', null, '1', '2023-03-17', '04:44:17', '1');
INSERT INTO `payments` VALUES ('1', '24', 'PMT20230317-24', '7', '100', null, '1', '2023-03-17', '04:59:30', '1');
INSERT INTO `payments` VALUES ('1', '25', 'PMT20230317-25', '1', '320', null, '1', '2023-03-17', '05:24:23', '1');
INSERT INTO `payments` VALUES ('1', '26', 'PMT20230317-26', '1', '12', null, '1', '2023-03-17', '05:25:09', '1');

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
INSERT INTO `production_logs` VALUES ('1', '2023-03-17', '13:50:42', null);

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
INSERT INTO `products` VALUES ('1', '1', '0xkbu1ip9lgdw4l1ecsbxayq46soxke2', 'MR Valve', 'MR Valve', 'MRV170', null, null, '0', '760.00', '0.00', '0.00', '0.00', '0', '100.00', null, '1', '1', '0', '1', '0', null, '0', null);
INSERT INTO `products` VALUES ('2', '1', 'luu8wi3rcedqis6it2wpysczqzl5ausr', 'MS Valve', 'MS Valve', 'MSV170', null, null, '0', '850.00', '0.00', '0.00', '0.00', '0', '100.00', null, '1', '1', '0', '1', '0', null, '0', null);
INSERT INTO `products` VALUES ('3', '1', 'fl05e7ri2bh7g248bkztqrioxuq7we8e', 'Madayaw Round', 'MR LPG 170G', 'MR170G', null, '20.00', '35', '35.00', '1.00', '204.00', '0.00', '0', '100.00', null, '1', '1', '1', '1', '1', '170', '760', '1');
INSERT INTO `products` VALUES ('4', '1', 'mdpa9mwfvs9duyriqsa791rllp8h4b0n', 'Madayaw Square', 'MS LPG 170G', 'MS170G', null, '20.00', '35', '96.00', '0.00', '54.00', '0.00', '0', '100.00', null, '1', '1', '1', '1', '1', '170', '850', '2');
INSERT INTO `products` VALUES ('5', '1', 'pmhw46v2un03w2r7oirgirh8ff7f0f6j', 'Gas Stove 1 Burner', 'GS 1 Burner', 'GS1', null, '700.00', '0', '984.00', '0.00', '0.00', '0.00', '0', '100.00', null, '2', '1', '0', '0', '1', null, '0', null);

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
  `pur_crate_in` int(11) DEFAULT NULL,
  `pur_loose_in` int(11) DEFAULT NULL,
  PRIMARY KEY (`pur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of purchases
-- ----------------------------
INSERT INTO `purchases` VALUES ('1', '1', '4', '1', '0', null, '0.00', '120.00', '12', '10.00', '1', '0');
INSERT INTO `purchases` VALUES ('2', '1', '5', '0', '1', null, '0.00', '700.00', '1', '700.00', '0', '0');
INSERT INTO `purchases` VALUES ('3', '2', '4', '1', '0', null, '0.00', '227.00', '12', '20.00', '1', '0');
INSERT INTO `purchases` VALUES ('4', '2', '3', '1', '0', null, '0.00', '228.00', '12', '20.00', '1', '0');
INSERT INTO `purchases` VALUES ('5', '3', '5', '0', '1', null, '13.00', '687.00', '1', '700.00', '0', '0');
INSERT INTO `purchases` VALUES ('6', '3', '3', '1', '0', null, '12.00', '228.00', '12', '20.00', '1', '0');
INSERT INTO `purchases` VALUES ('7', '4', '5', '0', '1', null, '13.00', '687.00', '1', '700.00', '0', '0');
INSERT INTO `purchases` VALUES ('8', '4', '3', '1', '0', null, '12.00', '228.00', '12', '20.00', '1', '0');
INSERT INTO `purchases` VALUES ('9', '5', '5', '0', '1', '13.00', '0.00', '687.00', '1', '700.00', '0', '0');
INSERT INTO `purchases` VALUES ('10', '5', '3', '1', '0', '12.00', '0.00', '228.00', '12', '20.00', '1', '0');
INSERT INTO `purchases` VALUES ('11', '6', '5', '0', '1', '13.00', '0.00', '687.00', '1', '700.00', '0', '0');
INSERT INTO `purchases` VALUES ('12', '6', '3', '1', '0', '12.00', '0.00', '228.00', '12', '20.00', '1', '0');
INSERT INTO `purchases` VALUES ('13', '7', '5', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0');
INSERT INTO `purchases` VALUES ('14', '8', '5', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0');
INSERT INTO `purchases` VALUES ('15', '9', '3', '1', '0', '2.00', '0.00', '238.00', '12', '20.00', '1', '0');
INSERT INTO `purchases` VALUES ('16', '10', '3', '1', '0', '2.00', '0.00', '238.00', '12', '20.00', '1', '0');
INSERT INTO `purchases` VALUES ('17', '11', '5', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0');
INSERT INTO `purchases` VALUES ('18', '12', '5', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0');
INSERT INTO `purchases` VALUES ('19', '13', '5', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0');
INSERT INTO `purchases` VALUES ('20', '14', '5', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0');
INSERT INTO `purchases` VALUES ('21', '15', '5', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0');
INSERT INTO `purchases` VALUES ('22', '16', '5', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0');
INSERT INTO `purchases` VALUES ('23', '17', '5', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0');
INSERT INTO `purchases` VALUES ('24', '18', '5', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0');
INSERT INTO `purchases` VALUES ('25', '19', '5', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quantity_logs
-- ----------------------------
INSERT INTO `quantity_logs` VALUES ('1', '1', '1', '1', '5000000', '2023-03-17 13:51:10', '1');
INSERT INTO `quantity_logs` VALUES ('2', '1', '2', '1', '2500000', '2023-03-17 13:51:15', '1');
INSERT INTO `quantity_logs` VALUES ('3', '1', '1', '1', '1000', '2023-03-17 14:00:12', '1');
INSERT INTO `quantity_logs` VALUES ('4', '1', '2', '1', '1000', '2023-03-17 14:00:16', '1');
INSERT INTO `quantity_logs` VALUES ('5', '1', '3', '1', '1000', '2023-03-17 14:00:19', '1');
INSERT INTO `quantity_logs` VALUES ('6', '1', '4', '1', '1000', '2023-03-17 14:00:23', '1');
INSERT INTO `quantity_logs` VALUES ('7', '1', '3', '1', '120', '2023-03-17 14:00:33', '1');
INSERT INTO `quantity_logs` VALUES ('8', '1', '4', '1', '120', '2023-03-17 14:00:39', '1');
INSERT INTO `quantity_logs` VALUES ('9', '1', '4', '1', '30', '2023-03-17 14:00:56', '1');
INSERT INTO `quantity_logs` VALUES ('10', '1', '3', '1', '1', '2023-03-17 14:01:22', '1');
INSERT INTO `quantity_logs` VALUES ('11', '1', '3', '1', '119', '2023-03-17 14:02:04', '1');
INSERT INTO `quantity_logs` VALUES ('12', '1', '3', '1', '120', '2023-03-17 14:02:10', '1');
INSERT INTO `quantity_logs` VALUES ('13', '1', '4', '1', '120', '2023-03-17 14:02:46', '1');
INSERT INTO `quantity_logs` VALUES ('14', '1', '5', '1', '1000', '2023-03-17 14:08:40', '1');
INSERT INTO `quantity_logs` VALUES ('15', '1', '4', '1', '0', '2023-03-17 18:14:59', '1');
INSERT INTO `quantity_logs` VALUES ('16', '1', '3', '1', '1', '2023-03-17 18:15:17', '1');

-- ----------------------------
-- Table structure for `reset_password`
-- ----------------------------
DROP TABLE IF EXISTS `reset_password`;
CREATE TABLE `reset_password` (
  `rst_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_id` int(11) DEFAULT NULL,
  `rst_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`rst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES ('1', 'mrrg06e1aur2lmbhfm26skwvdm7pnu40', '1', 'Madayaw Gas', 'Bunawan', '09856645643', null, null, '1');
INSERT INTO `suppliers` VALUES ('2', 'jc4z92d8os9zgiq9r2wlemleul9gur6z', '1', 'Davao Supplier', 'Bunawan', '09234234234', null, null, '1');

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
INSERT INTO `tanks` VALUES ('1', '1', 'Tank 1', '5000000', '4979600', null, null, '1');
INSERT INTO `tanks` VALUES ('2', '1', 'Tank 2', '5000000', '2479600', null, null, '1');

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
  `trx_total` decimal(11,0) DEFAULT NULL,
  PRIMARY KEY (`trx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES ('1', 'POS-20230317-1', '1', '1', '3', '2023-03-17 02:10:28', '2023-03-17', '02:10:28', '0', '488', '820');
INSERT INTO `transactions` VALUES ('2', 'POS-20230317-2', '1', '1', '1', '2023-03-17 02:44:30', '2023-03-17', '02:44:30', '0', '455', '455');
INSERT INTO `transactions` VALUES ('3', 'POS-20230317-3', '1', '1', '1', '2023-03-17 02:47:48', '2023-03-17', '02:47:48', '0', '915', '915');
INSERT INTO `transactions` VALUES ('4', 'POS-20230317-4', '1', '1', '1', '2023-03-17 02:52:39', '2023-03-17', '02:52:39', '915', '0', '915');
INSERT INTO `transactions` VALUES ('5', 'POS-20230317-5', '1', '1', '1', '2023-03-17 02:59:57', '2023-03-17', '02:59:57', '915', '0', '915');
INSERT INTO `transactions` VALUES ('6', 'POS-20230317-6', '1', '1', '1', '2023-03-17 03:07:44', '2023-03-17', '03:07:44', '1000', '-85', '915');
INSERT INTO `transactions` VALUES ('7', 'POS-20230317-7', '1', '1', '1', '2023-03-17 03:19:34', '2023-03-17', '03:19:34', '0', '400', '700');
INSERT INTO `transactions` VALUES ('8', 'POS-20230317-8', '1', '1', '1', '2023-03-17 03:20:45', '2023-03-17', '03:20:45', '0', '700', '700');
INSERT INTO `transactions` VALUES ('9', 'POS-20230317-9', '1', '1', '2', '2023-03-17 03:27:03', '2023-03-17', '03:27:03', '0', '238', '238');
INSERT INTO `transactions` VALUES ('10', 'POS-20230317-10', '1', '1', '2', '2023-03-17 03:28:09', '2023-03-17', '03:28:09', '0', '230', '238');
INSERT INTO `transactions` VALUES ('11', 'POS-20230317-11', '1', '1', '3', '2023-03-17 03:33:53', '2023-03-17', '03:33:53', '0', '700', '700');
INSERT INTO `transactions` VALUES ('12', 'POS-20230317-12', '1', '1', '3', '2023-03-17 03:37:18', '2023-03-17', '03:37:18', '0', '700', '700');
INSERT INTO `transactions` VALUES ('13', 'POS-20230317-13', '1', '1', '3', '2023-03-17 03:43:48', '2023-03-17', '03:43:48', '0', '700', '700');
INSERT INTO `transactions` VALUES ('14', 'POS-20230317-14', '1', '1', '1', '2023-03-17 03:48:21', '2023-03-17', '03:48:21', '0', '700', '700');
INSERT INTO `transactions` VALUES ('15', 'POS-20230317-15', '1', '1', '3', '2023-03-17 03:49:48', '2023-03-17', '03:49:48', '0', '700', '700');
INSERT INTO `transactions` VALUES ('16', 'POS-20230317-16', '1', '1', '1', '2023-03-17 03:51:10', '2023-03-17', '03:51:10', '0', '700', '700');
INSERT INTO `transactions` VALUES ('17', 'POS-20230317-17', '1', '1', '1', '2023-03-17 03:53:54', '2023-03-17', '03:53:54', '0', '700', '700');
INSERT INTO `transactions` VALUES ('18', 'POS-20230317-18', '1', '1', '3', '2023-03-17 03:58:21', '2023-03-17', '03:58:21', '0', '700', '700');
INSERT INTO `transactions` VALUES ('19', 'POS-20230317-19', '1', '1', '3', '2023-03-17 04:05:02', '2023-03-17', '04:05:02', '0', '700', '700');

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
