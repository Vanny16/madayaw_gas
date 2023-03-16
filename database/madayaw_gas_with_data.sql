/*
Navicat MySQL Data Transfer

Source Server         : server
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2023-03-15 21:33:50
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bad_orders
-- ----------------------------
INSERT INTO `bad_orders` VALUES ('1', 'BO-20230315-1', '1', '1', null, '1', null, null, null);
INSERT INTO `bad_orders` VALUES ('2', 'BO-20230315-2', '1', '1', null, '2', null, null, null);
INSERT INTO `bad_orders` VALUES ('3', 'BO-20230315-3', '1', '1', null, '1', null, null, null);
INSERT INTO `bad_orders` VALUES ('4', 'BO-20230315-4', '1', '1', null, '1', '2023-03-15', '13:19:23', '2023-03-15 13:19:23');
INSERT INTO `bad_orders` VALUES ('5', 'BO-20230315-5', '1', '1', null, '1', '2023-03-15', '14:07:01', '2023-03-15 14:07:01');
INSERT INTO `bad_orders` VALUES ('6', 'BO-20230315-6', '1', '1', null, '1', '2023-03-15', '14:43:41', '2023-03-15 14:43:41');

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
INSERT INTO `customers` VALUES ('1', '1', '8965kouty76zywo6m3in0j9m497kg0r0', 'Kim Dahyun', 'Seoultan Kudarat', '09987345345', '0', '3,4,5,', '20.00,20.00,500.00,', null, '1.jpg', '1');
INSERT INTO `customers` VALUES ('2', '1', 'qx8ujfxtaez69dv3rfbt11nyykyrbxp5', 'JYP', 'Seuolup', '09925434534', '0', '4,5,', '100.00,1000.00,', null, '2.jpg', '1');
INSERT INTO `customers` VALUES ('3', '1', 'vr6marxrfcgqnywbpkbcibmjf6kmbnkh', 'Myoui Mina', 'Indangan', '09823423423', '0', '3,4,5,', '20.00,20.00,500.00,', null, '3.jpg', '1');

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
INSERT INTO `movement_logs` VALUES ('1', '1', '3', '0', '0', '120', '0', '0', '1', '2023-03-15', '1');
INSERT INTO `movement_logs` VALUES ('2', '1', '4', '0', '0', '120', '0', '0', '1', '2023-03-15', '1');
INSERT INTO `movement_logs` VALUES ('3', '1', '3', '0', '0', '10', '0', '0', '1', '2023-03-15', '1');
INSERT INTO `movement_logs` VALUES ('4', '1', '3', '1', '0', '0', '0', '0', '1', '2023-03-15', '1');
INSERT INTO `movement_logs` VALUES ('5', '1', '3', '29', '0', '0', '0', '0', '1', '2023-03-15', '1');
INSERT INTO `movement_logs` VALUES ('6', '1', '4', '60', '0', '0', '0', '0', '1', '2023-03-15', '1');
INSERT INTO `movement_logs` VALUES ('7', '1', '3', '30', '0', '0', '0', '0', '1', '2023-03-15', '1');
INSERT INTO `movement_logs` VALUES ('8', '1', '3', '0', '1', '0', '0', '0', '1', '2023-03-15', '1');
INSERT INTO `movement_logs` VALUES ('9', '1', '3', '0', '2', '0', '0', '0', '1', '2023-03-15', '1');
INSERT INTO `movement_logs` VALUES ('10', '1', '4', '0', '1', '0', '0', '0', '1', '2023-03-15', '1');
INSERT INTO `movement_logs` VALUES ('11', '1', '4', '0', '1', '0', '0', '0', '1', '2023-03-15', '1');
INSERT INTO `movement_logs` VALUES ('12', '1', '4', '0', '1', '0', '0', '0', '1', '2023-03-15', '1');
INSERT INTO `movement_logs` VALUES ('13', '1', '3', '0', '1', '0', '0', '0', '1', '2023-03-15', '1');

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
INSERT INTO `news` VALUES ('1', 'welcom', 'asdsad', '2023-03-15', '11:55:06', '2023-03-15 11:55:06', null, '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES ('1', '1', 'PMT20230315-1', '1', '0', null, '1', '2023-03-15', '12:09:35', '2');
INSERT INTO `payments` VALUES ('1', '2', 'PMT20230315-2', '1', '40', null, '1', '2023-03-15', '12:10:44', '1');
INSERT INTO `payments` VALUES ('1', '3', 'PMT20230315-3', '1', '100', null, '1', '2023-03-15', '12:11:06', '1');
INSERT INTO `payments` VALUES ('1', '4', 'PMT20230315-4', '1', '200', '4.jpg', '1', '2023-03-15', '12:13:10', '3');
INSERT INTO `payments` VALUES ('1', '5', 'PMT20230315-2', '2', '12', null, '1', '2023-03-15', '01:25:57', '2');

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
INSERT INTO `production_logs` VALUES ('1', '2023-03-15', '11:20:53', null);

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
INSERT INTO `products` VALUES ('1', '1', 'x8eo9otjvcd011hhko84mw987qyk0uts', 'MR Valve', 'MR Valve', 'MRV', null, null, '0', '870.00', '0.00', '0.00', '0.00', '0', '1000.00', null, '1', '1', '0', '1', '0', null, '0', null);
INSERT INTO `products` VALUES ('2', '1', 'jsiln0zk20v0j6cslrmpztnr3bmsfdcf', 'MS Valve', 'MS Valve', 'MSV', null, null, '0', '880.00', '0.00', '0.00', '0.00', '0', '1000.00', null, '1', '1', '0', '1', '0', null, '0', null);
INSERT INTO `products` VALUES ('3', '1', 'a1gwsynlidh4xiq51uu0qgckz8e9obdh', 'Madayaw Round', 'MR LPG 170G', 'MR170G', null, '20.00', '35', '32.00', '4.00', '94.00', '0.00', '0', '1000.00', null, '1', '1', '1', '1', '1', '170', '870', '1');
INSERT INTO `products` VALUES ('4', '1', '755jzm0ud820ysxlz9c7nbdw7uuc2mk5', 'Madayaw Square', 'MS LPG 170G', 'MS170G', null, '20.00', '35', '33.00', '3.00', '84.00', '0.00', '0', '1000.00', null, '1', '1', '1', '1', '1', '170', '880', '2');
INSERT INTO `products` VALUES ('5', '1', 'j7akyk13xkh2i21r4a2yjwm7um8o1wjq', 'Gas Stove', 'Gas Stove', 'GS2B', null, '500.00', '0', '998.00', '0.00', '84.00', '0.00', '0', '100.00', null, '2', '1', '0', '0', '1', null, '0', null);
INSERT INTO `products` VALUES ('6', '1', '8210pcf21a1vt9vzgve5uvn2mf0qicyu', 'Madayaw Universal', 'MU170G', 'MU170G', null, '40.00', '50', '0.00', '0.00', '0.00', '0.00', '0', '1000.00', null, '1', '1', '1', '1', '1', '170', '0', '2,1');

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
  `pur_deposit` double(10,2) DEFAULT NULL,
  `pur_total` double(10,2) DEFAULT NULL,
  `pur_qty` int(11) DEFAULT NULL,
  `prd_price` double(10,2) DEFAULT NULL,
  `pur_crate_in` int(11) DEFAULT NULL,
  `pur_loose_in` int(11) DEFAULT NULL,
  PRIMARY KEY (`pur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of purchases
-- ----------------------------
INSERT INTO `purchases` VALUES ('1', '1', '5', '0', '1', '0.00', '400.00', '1', '400.00', '0', '0');
INSERT INTO `purchases` VALUES ('2', '1', '3', '1', '0', '0.00', '240.00', '12', '20.00', '1', '0');
INSERT INTO `purchases` VALUES ('3', '2', '4', '2', '0', '0.00', '480.00', '24', '20.00', '2', '0');
INSERT INTO `purchases` VALUES ('4', '2', '5', '0', '1', '0.00', '500.00', '1', '500.00', '0', '0');
INSERT INTO `purchases` VALUES ('5', '2', '3', '1', '0', '0.00', '240.00', '12', '20.00', '1', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quantity_logs
-- ----------------------------
INSERT INTO `quantity_logs` VALUES ('1', '1', '1', '1', '1000', '2023-03-15 11:51:43', '1');
INSERT INTO `quantity_logs` VALUES ('2', '1', '2', '1', '1000', '2023-03-15 11:51:48', '1');
INSERT INTO `quantity_logs` VALUES ('3', '1', '3', '1', '1000', '2023-03-15 11:51:52', '1');
INSERT INTO `quantity_logs` VALUES ('4', '1', '4', '1', '1000', '2023-03-15 11:51:56', '1');
INSERT INTO `quantity_logs` VALUES ('5', '1', '3', '1', '120', '2023-03-15 11:52:43', '1');
INSERT INTO `quantity_logs` VALUES ('6', '1', '4', '1', '120', '2023-03-15 11:52:55', '1');
INSERT INTO `quantity_logs` VALUES ('7', '1', '3', '1', '10', '2023-03-15 12:00:20', '1');
INSERT INTO `quantity_logs` VALUES ('8', '1', '3', '1', '120', '2023-03-15 12:01:13', '1');
INSERT INTO `quantity_logs` VALUES ('9', '1', '1', '1', '2500000', '2023-03-15 12:06:17', '1');
INSERT INTO `quantity_logs` VALUES ('10', '1', '3', '1', '1', '2023-03-15 12:06:43', '1');
INSERT INTO `quantity_logs` VALUES ('11', '1', '3', '1', '29', '2023-03-15 12:07:24', '1');
INSERT INTO `quantity_logs` VALUES ('12', '1', '4', '1', '60', '2023-03-15 12:07:44', '1');
INSERT INTO `quantity_logs` VALUES ('13', '1', '3', '1', '30', '2023-03-15 12:08:00', '1');
INSERT INTO `quantity_logs` VALUES ('14', '1', '5', '1', '1000', '2023-03-15 12:08:35', '1');
INSERT INTO `quantity_logs` VALUES ('15', '1', '3', '1', '1', '2023-03-15 12:59:32', '1');
INSERT INTO `quantity_logs` VALUES ('16', '1', '3', '1', '2', '2023-03-15 12:59:56', '1');
INSERT INTO `quantity_logs` VALUES ('17', '1', '4', '1', '1', '2023-03-15 13:05:43', '1');
INSERT INTO `quantity_logs` VALUES ('18', '1', '4', '1', '1', '2023-03-15 13:19:23', '1');
INSERT INTO `quantity_logs` VALUES ('19', '1', '4', '1', '1', '2023-03-15 14:07:01', '1');
INSERT INTO `quantity_logs` VALUES ('20', '1', '3', '1', '1', '2023-03-15 14:43:41', '1');

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
INSERT INTO `suppliers` VALUES ('1', '4v4nrhamperzvz6h54bsdmaw04l8n3oa', '1', 'Madayaw Gas', 'Bunawan', '09876898233', null, null, '1');
INSERT INTO `suppliers` VALUES ('2', 'vs8j2bv2v44lb62esz9o8klrwlk8xiwx', '1', 'Davao Supplier', 'Davao City', '09778342342', null, null, '1');

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
INSERT INTO `tanks` VALUES ('1', '1', 'Tank 1', '5000000', '2479600', null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES ('1', 'POS-20230315-1', '1', '1', '1', '2023-03-15 12:09:35', '2023-03-15', '12:09:35', '0', '300', '640');
INSERT INTO `transactions` VALUES ('2', 'POS-20230315-2', '1', '1', '3', '2023-03-15 01:25:57', '2023-03-15', '01:25:57', '12', '1208', '1220');

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