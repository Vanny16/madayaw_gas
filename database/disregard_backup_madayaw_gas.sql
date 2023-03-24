/*
Navicat MySQL Data Transfer

Source Server         : server
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2023-03-24 15:38:58
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bad_orders
-- ----------------------------
INSERT INTO `bad_orders` VALUES ('1', 'BO-20230323-1', '1', '5', '4', null, '2', '2023-03-23', '15:04:42', '2023-03-23 15:04:42');
INSERT INTO `bad_orders` VALUES ('2', 'BO-20230323-2', '1', '6', '4', null, '3', '2023-03-23', '15:50:03', '2023-03-23 15:50:03');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', '1', 'lp9908qz4nbhd67tu69bo4axdfcjzqm7', 'Im Nayeon', 'Seoul Tan Kudarat', '09324234234', '0', '2,4,5,', '35.00,20.00,20.00,', null, '1.jpg', '1');
INSERT INTO `customers` VALUES ('2', '1', 'fw04igzm3c0kau4c2ryq2qqfprvzkmpi', 'Yoo Jeongyeon', 'Seoul Tan Kudarat', '08235434534', '0', '2,4,5,', '35.00,20.00,20.00,', null, '2.jpg', '1');
INSERT INTO `customers` VALUES ('3', '1', 'l9ctr0g90z1gxx3ii4c2o4z9wt259mpc', 'Hirai Momo', 'Shibuyas Bombei, Japen', '06787578232', '0', '2,4,5,6,', '35.00,20.00,20.00,700.00,', null, '3.jpg', '1');
INSERT INTO `customers` VALUES ('4', '1', 'vdvl03yj395h3av0fetyzt2cunw5epir', 'Minatozaki Sana', 'Shibu Shiti', null, '0', '2,4,5,', '35.00,20.00,20.00,', null, '4.jpg', '1');
INSERT INTO `customers` VALUES ('5', '1', '2w44i28onaqn4evui2svgbqv6d481o03', 'Park Jihyo', 'Seoul Tan Kudarat, South Kortabato', '09567568687', '0', '2,4,5,', '35.00,20.00,20.00,', null, '5.jpg', '1');
INSERT INTO `customers` VALUES ('6', '1', 't7gou40ztu0uctuzo6d28o1chxlv97vc', 'Myoui Mina', 'Nagoya Shardines, Japanacan', null, '0', '2,4,5,', '35.00,20.00,20.00,', null, '6.jpg', '1');
INSERT INTO `customers` VALUES ('7', '1', '9cww8cd4sluz6j95rch7d8o0fo7flv5x', 'Kim Dahyun', 'Seoulup', '08656523223', '0', '2,4,5,', '35.00,20.00,20.00,', null, '7.jpg', '1');
INSERT INTO `customers` VALUES ('8', '1', '947zwcnsfnl6pos6cjyerek0cc53sg5o', 'Son Chaeyoung', 'Gonjiam City', null, '0', '2,4,5,', '35.00,20.00,20.00,', null, '8.jpg', '1');
INSERT INTO `customers` VALUES ('9', '1', 'gul4ltv29a4xr77q4s482vpcezgprr37', 'Chou Tzuyu', 'Ajinomoto, Taiwan', null, '0', '2,4,5,', '35.00,20.00,20.00,', null, '9.jpg', '1');

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
INSERT INTO `movement_logs` VALUES ('1', '1', '2', '0', '0', '1200', '0', '0', '1', '2023-03-23', '1');
INSERT INTO `movement_logs` VALUES ('2', '1', '4', '0', '0', '1200', '0', '0', '1', '2023-03-23', '1');
INSERT INTO `movement_logs` VALUES ('3', '1', '5', '0', '0', '1200', '0', '0', '1', '2023-03-23', '1');
INSERT INTO `movement_logs` VALUES ('4', '1', '2', '120', '0', '0', '0', '0', '1', '2023-03-23', '1');
INSERT INTO `movement_logs` VALUES ('5', '1', '4', '120', '0', '0', '0', '0', '1', '2023-03-23', '1');
INSERT INTO `movement_logs` VALUES ('6', '1', '5', '120', '0', '0', '0', '0', '1', '2023-03-23', '1');
INSERT INTO `movement_logs` VALUES ('7', '1', '4', '0', '2', '0', '0', '0', '1', '2023-03-23', '1');
INSERT INTO `movement_logs` VALUES ('8', '1', '4', '0', '3', '0', '0', '0', '1', '2023-03-23', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of oppositions
-- ----------------------------
INSERT INTO `oppositions` VALUES ('1', null, 'Tripler', 'T1', 'Tripler', '72', null, null, '1', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES ('1', '1', 'PMT20230323-1', '1', '0', null, '1', '2023-03-23', '01:32:57', '2', '0', '0');
INSERT INTO `payments` VALUES ('1', '2', 'PMT20230323-2', '2', '0', null, '1', '2023-03-23', '01:33:47', '2', '0', '0');
INSERT INTO `payments` VALUES ('1', '3', 'PMT20230323-3', '3', '0', null, '1', '2023-03-23', '02:28:01', '2', '0', '0');
INSERT INTO `payments` VALUES ('1', '4', 'PMT20230323-4', '4', '0', null, '1', '2023-03-23', '02:54:08', '2', '0', '0');
INSERT INTO `payments` VALUES ('1', '5', 'PMT20230323-5', '5', '0', null, '1', '2023-03-23', '02:55:21', '2', '0', '0');
INSERT INTO `payments` VALUES ('1', '6', 'PMT20230323-6', '6', '0', null, '1', '2023-03-23', '02:59:45', '2', '0', '0');
INSERT INTO `payments` VALUES ('1', '7', 'PMT20230324-7', '1', '2000', '7.jpg', '1', '2023-03-24', '11:05:12', '3', '0', '0');
INSERT INTO `payments` VALUES ('1', '8', 'PMT20230324-8', '1', '20', '8.jpg', '1', '2023-03-24', '11:05:41', '1', '0', '0');
INSERT INTO `payments` VALUES ('1', '9', 'PMT20230324-9', '2', '60', null, '1', '2023-03-24', '11:06:58', '1', '0', '0');
INSERT INTO `payments` VALUES ('1', '10', 'PMT20230324-10', '2', '100', null, '1', '2023-03-24', '11:07:37', '1', '0', '0');
INSERT INTO `payments` VALUES ('1', '11', 'PMT20230324-11', '2', '100', '11.png', '1', '2023-03-24', '11:07:55', '3', '0', '0');
INSERT INTO `payments` VALUES ('1', '12', 'PMT20230324-12', '2', '0', null, '1', '2023-03-24', '11:32:47', '1', '0', '0');
INSERT INTO `payments` VALUES ('1', '13', 'PMT20230324-7', '7', '100', '13.jpg', '1', '2023-03-24', '11:48:27', '3', '0', '0');
INSERT INTO `payments` VALUES ('1', '14', 'PMT20230324-14', '7', '100', null, '1', '2023-03-24', '11:49:21', '1', '0', '0');
INSERT INTO `payments` VALUES ('1', '15', 'PMT20230324-15', '7', '100', '15.png', '1', '2023-03-24', '11:50:18', '3', '0', '0');
INSERT INTO `payments` VALUES ('1', '16', 'PMT20230324-8', '8', '0', null, '1', '2023-03-24', '11:54:38', '2', '0', '0');
INSERT INTO `payments` VALUES ('1', '17', 'PMT20230324-17', '8', '100', '17.png', '1', '2023-03-24', '11:57:50', '3', '0', '0');
INSERT INTO `payments` VALUES ('1', '18', 'PMT20230324-18', '8', '100', '18.png', '1', '2023-03-24', '12:00:06', '3', '0', '0');
INSERT INTO `payments` VALUES ('1', '19', 'PMT20230324-19', '7', '100', '19.png', '1', '2023-03-24', '12:01:48', '3', '0', '0');
INSERT INTO `payments` VALUES ('1', '20', 'PMT20230324-20', '8', '100', '20.png', '1', '2023-03-24', '12:03:03', '3', '0', '0');
INSERT INTO `payments` VALUES ('1', '21', 'PMT20230324-21', '8', '100', '21.png', '1', '2023-03-24', '12:11:16', '3', '0', '0');
INSERT INTO `payments` VALUES ('1', '22', 'PMT20230324-9', '9', '300', null, '1', '2023-03-24', '12:18:16', '1', '0', '0');
INSERT INTO `payments` VALUES ('1', '23', 'PMT20230324-10', '10', '0', null, '1', '2023-03-24', '01:34:07', '2', '0', '0');
INSERT INTO `payments` VALUES ('1', '24', 'PMT20230324-11', '11', '700', null, '1', '2023-03-24', '01:34:33', '1', '0', '0');
INSERT INTO `payments` VALUES ('1', '25', 'PMT20230324-12', '12', '1420', null, '1', '2023-03-24', '01:57:40', '1', '0', '0');
INSERT INTO `payments` VALUES ('1', '26', 'PMT20230324-13', '13', '500', null, '1', '2023-03-24', '02:06:45', '1', '1000', '500');
INSERT INTO `payments` VALUES ('1', '27', 'PMT20230324-14', '14', '35', null, '1', '2023-03-24', '02:08:35', '1', '50', '15');
INSERT INTO `payments` VALUES ('1', '28', 'PMT20230324-15', '15', '35', null, '1', '2023-03-24', '02:14:41', '1', '100', '65');
INSERT INTO `payments` VALUES ('1', '29', 'PMT20230324-29', '10', '200', null, '1', '2023-03-24', '02:41:06', '1', '200', '300');
INSERT INTO `payments` VALUES ('1', '30', 'PMT20230324-30', '2', '100', null, '1', '2023-03-24', '02:41:24', '1', '100', '200');
INSERT INTO `payments` VALUES ('1', '31', 'PMT20230324-31', '2', '100', null, '1', '2023-03-24', '02:52:53', '1', '100', '0');
INSERT INTO `payments` VALUES ('1', '32', 'PMT20230324-32', '2', '100', null, '1', '2023-03-24', '02:53:38', '1', '100', '0');
INSERT INTO `payments` VALUES ('1', '33', 'PMT20230324-33', '2', '-400', null, '1', '2023-03-24', '02:54:45', '1', '500', '500');
INSERT INTO `payments` VALUES ('1', '34', 'PMT20230324-34', '3', '20', null, '1', '2023-03-24', '02:55:13', '1', '20', '0');
INSERT INTO `payments` VALUES ('1', '35', 'PMT20230324-35', '3', '-100', null, '1', '2023-03-24', '02:55:32', '1', '500', '500');
INSERT INTO `payments` VALUES ('1', '36', 'PMT20230324-36', '4', '20', null, '1', '2023-03-24', '03:08:53', '1', '20', '700');
INSERT INTO `payments` VALUES ('1', '37', 'PMT20230324-37', '4', '200', null, '1', '2023-03-24', '03:10:31', '1', '200', '0');
INSERT INTO `payments` VALUES ('1', '38', 'PMT20230324-38', '4', '500', null, '1', '2023-03-24', '03:25:33', '1', '1000', '500');
INSERT INTO `payments` VALUES ('1', '39', 'PMT20230324-39', '5', '1220', null, '1', '2023-03-24', '03:26:10', '1', '1220', '0');
INSERT INTO `payments` VALUES ('1', '40', 'PMT20230324-40', '6', '1220', '40.jpg', '1', '2023-03-24', '03:26:35', '3', '1220', '0');
INSERT INTO `payments` VALUES ('1', '41', 'PMT20230324-41', '7', '300', '41.jpg', '1', '2023-03-24', '03:28:58', '3', '300', '0');
INSERT INTO `payments` VALUES ('1', '42', 'PMT20230324-42', '8', '100', null, '1', '2023-03-24', '03:30:41', '1', '100', '0');
INSERT INTO `payments` VALUES ('1', '43', 'PMT20230324-43', '8', '100', '43.png', '1', '2023-03-24', '03:31:00', '3', '100', '0');
INSERT INTO `payments` VALUES ('1', '44', 'PMT20230324-44', '8', '100', null, '1', '2023-03-24', '03:31:43', '1', '100', '0');
INSERT INTO `payments` VALUES ('1', '45', 'PMT20230324-45', '10', '50', null, '1', '2023-03-24', '03:34:04', '1', '50', '0');
INSERT INTO `payments` VALUES ('1', '46', 'PMT20230324-46', '10', '50', '46.jpg', '1', '2023-03-24', '03:35:02', '3', '50', '0');
INSERT INTO `payments` VALUES ('1', '47', 'PMT20230324-47', '10', '20', null, '1', '2023-03-24', '03:35:47', '1', '20', '0');

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
INSERT INTO `production_logs` VALUES ('1', '2023-03-23', '11:44:31', null);

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
INSERT INTO `products` VALUES ('1', '1', '3rf5quy9qwl9yavxj95bi0sa8g77n8tb', 'MR Valve', 'MR Valve', 'MRValve', null, null, '0', '7600.00', '0.00', '0.00', '0.00', '0', '100.00', null, '1', '1', '0', '1', '0', null, '0', null);
INSERT INTO `products` VALUES ('2', '1', 'mmeakqr1lm5uqfn1235xao7n6q4d5v5u', 'Madayaw Round', 'MR LPG 170G', 'MR170', null, '35.00', '20', '70.00', '0.00', '1130.00', '0.00', '0', '100.00', null, '1', '1', '1', '1', '1', '170', '8800', '1');
INSERT INTO `products` VALUES ('3', '1', '4n9ciw1ge3thftngzmkyg65mf1nqjpf5', 'MS Valve', 'MS Valve', 'MSV', null, null, '0', '8800.00', '0.00', '0.00', '0.00', '0', '100.00', null, '1', '1', '0', '1', '0', null, '0', null);
INSERT INTO `products` VALUES ('4', '1', 'p23fkdynhpa1azg3nksvacxyd39dk73d', 'Madayaw Square', 'MS LPG 170G', 'MS170', null, '20.00', '35', '43.00', '5.00', '1104.00', '0.00', '0', '100.00', null, '1', '1', '1', '1', '1', '170', '8800', '3');
INSERT INTO `products` VALUES ('5', '1', 'rnboxpaawb0d3xzr5lihiicpzf8bmffb', 'Botin', 'BOTIN170', 'BOTIN170', null, '20.00', '35', '60.00', '0.00', '1116.00', '0.00', '0', '100.00', null, '1', '1', '1', '1', '1', '170', '8800', '1');
INSERT INTO `products` VALUES ('6', '1', 'xvgfznrqv91jc90rg70dmgr419y7vqhp', 'Gas Stove', 'GS1', 'GS1', null, '700.00', '0', '991.00', '0.00', '0.00', '0.00', '0', '100.00', null, '2', '1', '0', '0', '1', null, '0', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of purchases
-- ----------------------------
INSERT INTO `purchases` VALUES ('1', '1', '2', '1', '0', '0.00', '0.00', '420.00', '12', '35.00', '2', '1', '0', '1');
INSERT INTO `purchases` VALUES ('2', '2', '2', '1', '0', '0.00', '0.00', '420.00', '12', '35.00', '2', '1', '0', '1');
INSERT INTO `purchases` VALUES ('3', '2', '5', '1', '0', '0.00', '0.00', '240.00', '12', '20.00', '2', '1', '0', '1');
INSERT INTO `purchases` VALUES ('4', '3', '2', '1', '0', '0.00', '0.00', '420.00', '12', '35.00', '1', '1', '0', '2');
INSERT INTO `purchases` VALUES ('5', '4', '4', '2', '0', '0.00', '420.00', '480.00', '24', '20.00', '1', '1', '0', '2');
INSERT INTO `purchases` VALUES ('6', '4', '5', '1', '0', '0.00', '-420.00', '240.00', '12', '20.00', '5', '2', '0', '1');
INSERT INTO `purchases` VALUES ('7', '5', '6', '0', '1', '200.00', '0.00', '500.00', '1', '700.00', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('8', '5', '5', '1', '0', '0.00', '-420.00', '240.00', '12', '20.00', '1', '2', '0', '2');
INSERT INTO `purchases` VALUES ('9', '5', '4', '2', '0', '0.00', '420.00', '480.00', '24', '20.00', '4', '1', '0', '1');
INSERT INTO `purchases` VALUES ('10', '6', '6', '0', '1', '200.00', '0.00', '500.00', '1', '700.00', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('11', '6', '5', '1', '0', '0.00', '-420.00', '240.00', '12', '20.00', '1', '2', '0', '2');
INSERT INTO `purchases` VALUES ('12', '6', '4', '2', '0', '0.00', '420.00', '480.00', '24', '20.00', '4', '1', '0', '1');
INSERT INTO `purchases` VALUES ('13', '7', '6', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('14', '8', '6', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('15', '9', '5', '1', '0', '0.00', '0.00', '240.00', '12', '20.00', '5', '1', '0', '1');
INSERT INTO `purchases` VALUES ('16', '10', '6', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('17', '11', '6', '0', '1', '0.00', '0.00', '700.00', '1', '700.00', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('18', '12', '2', '1', '0', '0.00', '0.00', '420.00', '12', '35.00', '2', '1', '0', '1');
INSERT INTO `purchases` VALUES ('19', '12', '6', '0', '1', '200.00', '0.00', '500.00', '1', '700.00', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('20', '12', '6', '0', '1', '200.00', '0.00', '500.00', '1', '700.00', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('21', '13', '6', '0', '1', '200.00', '0.00', '500.00', '1', '700.00', '0', '0', '0', '0');
INSERT INTO `purchases` VALUES ('22', '14', '2', '0', '1', '0.00', '0.00', '35.00', '1', '35.00', '2', '0', '1', '1');
INSERT INTO `purchases` VALUES ('23', '15', '2', '0', '1', '0.00', '0.00', '35.00', '1', '35.00', '2', '0', '1', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quantity_logs
-- ----------------------------
INSERT INTO `quantity_logs` VALUES ('1', '1', '1', '1', '5000000', '2023-03-23 11:45:07', '1');
INSERT INTO `quantity_logs` VALUES ('2', '1', '2', '1', '2500000', '2023-03-23 11:45:12', '1');
INSERT INTO `quantity_logs` VALUES ('3', '1', '1', '1', '10000', '2023-03-23 11:51:27', '1');
INSERT INTO `quantity_logs` VALUES ('4', '1', '2', '1', '10000', '2023-03-23 11:51:39', '1');
INSERT INTO `quantity_logs` VALUES ('5', '1', '3', '1', '10000', '2023-03-23 11:51:45', '1');
INSERT INTO `quantity_logs` VALUES ('6', '1', '4', '1', '10000', '2023-03-23 11:51:49', '1');
INSERT INTO `quantity_logs` VALUES ('7', '1', '5', '1', '10000', '2023-03-23 11:51:54', '1');
INSERT INTO `quantity_logs` VALUES ('8', '1', '2', '1', '1200', '2023-03-23 11:52:45', '1');
INSERT INTO `quantity_logs` VALUES ('9', '1', '4', '1', '1200', '2023-03-23 11:52:56', '1');
INSERT INTO `quantity_logs` VALUES ('10', '1', '5', '1', '1200', '2023-03-23 11:53:00', '1');
INSERT INTO `quantity_logs` VALUES ('11', '1', '2', '1', '120', '2023-03-23 13:26:20', '1');
INSERT INTO `quantity_logs` VALUES ('12', '1', '4', '1', '120', '2023-03-23 13:26:43', '1');
INSERT INTO `quantity_logs` VALUES ('13', '1', '5', '1', '120', '2023-03-23 13:26:48', '1');
INSERT INTO `quantity_logs` VALUES ('14', '1', '6', '1', '1000', '2023-03-23 14:50:53', '1');
INSERT INTO `quantity_logs` VALUES ('15', '1', '5', '1', '120', '2023-03-23 15:04:32', '1');
INSERT INTO `quantity_logs` VALUES ('16', '1', '4', '1', '2', '2023-03-23 15:04:42', '1');
INSERT INTO `quantity_logs` VALUES ('17', '1', '4', '1', '120', '2023-03-23 15:49:54', '1');
INSERT INTO `quantity_logs` VALUES ('18', '1', '4', '1', '3', '2023-03-23 15:50:03', '1');

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
  `stk_raw_materials` int(11) DEFAULT '0',
  `stk_empty_goods` int(11) DEFAULT '0',
  `stk_filled` int(11) DEFAULT '0',
  `stk_leakers` int(11) DEFAULT '0',
  `stk_for_revalving` int(11) DEFAULT '0',
  `stk_scraps` int(11) DEFAULT '0',
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
INSERT INTO `suppliers` VALUES ('1', '7bcs8lptw8tffns0mds26ywrd9tbbu6k', '1', 'Madayaw Gas', 'Bunawan', '09234232322', null, null, '1');
INSERT INTO `suppliers` VALUES ('2', '4uny6h5keefmuho3xoipfym5kztmf6dy', '1', 'Davao Supplier', 'Davao City', '09123123234', null, null, '1');

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
INSERT INTO `tanks` VALUES ('1', '1', 'Tank 1', '5000000', '4938800', null, null, '1');
INSERT INTO `tanks` VALUES ('2', '1', 'Tank 2', '5000000', '2500000', null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES ('1', 'POS-20230323-1', '1', '1', '2', '2023-03-23 01:32:57', '2023-03-23', '01:32:57', '0', '-1600', '420', '420');
INSERT INTO `transactions` VALUES ('2', 'POS-20230323-2', '1', '1', '5', '2023-03-23 01:33:47', '2023-03-23', '01:33:47', '0', '0', '660', '660');
INSERT INTO `transactions` VALUES ('3', 'POS-20230323-3', '1', '1', '1', '2023-03-23 02:28:01', '2023-03-23', '02:28:01', '0', '0', '420', '420');
INSERT INTO `transactions` VALUES ('4', 'POS-20230323-4', '1', '1', '3', '2023-03-23 02:54:08', '2023-03-23', '02:54:08', '0', '0', '720', '720');
INSERT INTO `transactions` VALUES ('5', 'POS-20230323-5', '1', '1', '3', '2023-03-23 02:55:21', '2023-03-23', '02:55:21', '0', '0', '1420', '1220');
INSERT INTO `transactions` VALUES ('6', 'POS-20230323-6', '1', '1', '3', '2023-03-23 02:59:45', '2023-03-23', '02:59:45', '0', '0', '1420', '1220');
INSERT INTO `transactions` VALUES ('7', 'POS-20230324-7', '1', '1', '3', '2023-03-24 11:48:27', '2023-03-24', '11:48:27', '100', '0', '700', '700');
INSERT INTO `transactions` VALUES ('8', 'POS-20230324-8', '1', '1', '3', '2023-03-24 11:54:38', '2023-03-24', '11:54:38', '0', '0', '700', '700');
INSERT INTO `transactions` VALUES ('9', 'POS-20230324-9', '1', '1', '1', '2023-03-24 12:18:16', '2023-03-24', '12:18:16', '300', '-60', '240', '240');
INSERT INTO `transactions` VALUES ('10', 'POS-20230324-10', '1', '1', '3', '2023-03-24 01:34:07', '2023-03-24', '01:34:07', '0', '380', '700', '700');
INSERT INTO `transactions` VALUES ('11', 'POS-20230324-11', '1', '1', '3', '2023-03-24 01:34:33', '2023-03-24', '01:34:33', '700', '0', '700', '700');
INSERT INTO `transactions` VALUES ('12', 'POS-20230324-12', '1', '1', '3', '2023-03-24 01:57:40', '2023-03-24', '01:57:40', '1420', '0', '1820', '1420');
INSERT INTO `transactions` VALUES ('13', 'POS-20230324-13', '1', '1', '3', '2023-03-24 02:06:45', '2023-03-24', '02:06:45', '500', '0', '700', '500');
INSERT INTO `transactions` VALUES ('14', 'POS-20230324-14', '1', '1', '2', '2023-03-24 02:08:35', '2023-03-24', '02:08:35', '35', '0', '35', '35');
INSERT INTO `transactions` VALUES ('15', 'POS-20230324-15', '1', '1', '2', '2023-03-24 02:14:41', '2023-03-24', '02:14:41', '35', '0', '35', '35');

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
