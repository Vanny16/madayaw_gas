/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50733
Source Host           : localhost:3306
Source Database       : madayaw_gas_with_production_data

Target Server Type    : MYSQL
Target Server Version : 50733
File Encoding         : 65001

Date: 2023-05-11 17:25:00
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', '1', 'h7ht4ciq7asdzf2u6ttdv724uln1ubzo', 'APEIRON', 'apeiron', '09111111111', '17.8', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');
INSERT INTO `customers` VALUES ('2', '1', 'mxvwihmxno425tfsz40pewod6ryopj5g', 'DJV DIGOS', 'djv digos', '09111111111', '14.9', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');
INSERT INTO `customers` VALUES ('3', '1', '76cgx451m5z155d5p5y808431vdcptx8', 'FUELSOURCE', 'fuelsource', '09111111111', '16.55', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');
INSERT INTO `customers` VALUES ('4', '1', 'wqlp4cll87rd9dqmuwr1nidcp1qgbjfn', 'ALONA', 'alona', '09111111111', '17.19', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');
INSERT INTO `customers` VALUES ('5', '1', 'hjtl8q4ah2v53jle50krdk83lwwc0zik', 'ROBERT SASA', 'robert sasa', '09111111111', '0', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');
INSERT INTO `customers` VALUES ('6', '1', '8sww249hid6s4gz8o6aq706skuqjrriy', 'DUDZ SASA', 'dudz sasa', '09111111111', '0', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');
INSERT INTO `customers` VALUES ('7', '1', 'x3ktke6dj6d9rcrjxpiio2crziek2vxr', 'WILSON PANACAN', 'wilson panacan', '09111111111', '0', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');
INSERT INTO `customers` VALUES ('8', '1', 'wpiomy1kbnvtwua96r8l5jyk54ruznl7', 'REY PANACAN', 'rey panacan', '09111111111', '0', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');
INSERT INTO `customers` VALUES ('9', '1', '7mhr6jrg31cecw61qxhza79mnfssb070', 'YANGCO', 'yangco', '09111111111', '17.8', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');
INSERT INTO `customers` VALUES ('10', '1', 'jvg2dsezsxa0fe7jg31bmjojgjo1yhgg', 'DJV DAVAO', 'djv davao', '09111111111', '16.9', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');
INSERT INTO `customers` VALUES ('11', '1', 'kcc1rqypv8gvjqp1i99ikcn8is0oy6ix', 'KWADRO', 'kwadro', '09111111111', '17.8', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');
INSERT INTO `customers` VALUES ('12', '1', 'xo2ikexsinf6tl38czldvgsufav9szv9', 'ALFRED SANTOS', 'alfred santos', '09111111111', '17.8', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');
INSERT INTO `customers` VALUES ('13', '1', '51lekkesv3yih1cpj2qkr1iy3yhrsjaa', 'ADON', 'adon', '09111111111', '17.8', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');
INSERT INTO `customers` VALUES ('14', '1', '5ca3ayygrc79g3738iyei19z15avw7sh', 'HOUSE', 'house', '09111111111', '17.8', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');
INSERT INTO `customers` VALUES ('15', '1', '0hlswfhfxvdflrwxe2cgfsi05nn9lqrq', 'BRGY SAN ISIDRO', 'brgy san isidro', '09111111111', '19.5', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');
INSERT INTO `customers` VALUES ('16', '1', 'lgmhpam2eqzxk1b203i4tett9qnh1wse', 'DENNIS DAGONDON', 'dennis dagondon', '09111111111', '17.8', '3,4,5,', '20.00,20.00,20.00,', null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of movement_logs
-- ----------------------------
INSERT INTO `movement_logs` VALUES ('1', '1', '3', '0', '0', '32618', '0', '0', '1', '2023-04-29', '1');
INSERT INTO `movement_logs` VALUES ('2', '1', '4', '0', '0', '9962', '0', '0', '1', '2023-04-29', '1');
INSERT INTO `movement_logs` VALUES ('3', '1', '5', '0', '0', '3400', '0', '0', '1', '2023-04-29', '1');
INSERT INTO `movement_logs` VALUES ('4', '1', '3', '20490', '0', '0', '0', '0', '1', '2023-04-29', '1');
INSERT INTO `movement_logs` VALUES ('5', '1', '4', '1483', '0', '0', '0', '0', '1', '2023-04-29', '1');
INSERT INTO `movement_logs` VALUES ('6', '1', '5', '1927', '0', '0', '0', '0', '1', '2023-04-29', '1');
INSERT INTO `movement_logs` VALUES ('7', '1', '3', '0', '250', '0', '0', '0', '1', '2023-04-29', '1');
INSERT INTO `movement_logs` VALUES ('8', '1', '3', '0', '0', '0', '229', '0', '1', '2023-04-29', '1');
INSERT INTO `movement_logs` VALUES ('9', '1', '4', '0', '142', '0', '0', '0', '1', '2023-04-29', '1');
INSERT INTO `movement_logs` VALUES ('10', '1', '4', '0', '0', '0', '142', '0', '1', '2023-04-29', '1');
INSERT INTO `movement_logs` VALUES ('11', '1', '5', '0', '792', '0', '0', '0', '1', '2023-04-29', '1');
INSERT INTO `movement_logs` VALUES ('12', '1', '5', '0', '0', '0', '792', '0', '1', '2023-04-29', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of oppositions
-- ----------------------------
INSERT INTO `oppositions` VALUES ('1', '1wmpuwc7jtlfup5vlwwzhmrzry73oalr', 'Tripler', 'Tripler', 'Tripler', '23849', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('2', 'ualt7xgswzmyidb6d67pcplry9csuuea', 'Budget', 'Budget', 'Budget', '534', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('3', 'ku19p38ds83mujbzwjttdb9g94lcmev2', 'Rufran', 'Rufran', 'Rufran', '3161', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('4', '50wunf8lobcqn0266d7ln8pkrf0u63id', 'PIPC', 'PIPC', 'PIPC', '1145', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('5', '7thfgmnxzsos3h72g80vfla9u8k7j21i', 'Agela', 'Agela', 'Agela', '437', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('6', 'dvn9mu1y0jvjkhyxx0kzo4xe6ldlbzy5', '10 Can', '10 Can', '10 Can', '5064', null, null, '1', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES ('1', '1', 'PMT20230511-1', '1', '0', null, '2', '2023-05-11', '17:13:44', '2', '0', '0', null, null);
INSERT INTO `payments` VALUES ('1', '2', 'PMT20230511-2', '2', '0', null, '2', '2023-05-11', '17:23:41', '2', '0', '0', null, null);

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
INSERT INTO `production_logs` VALUES ('1', '2023-04-29', '21:59:39', '16:56:15');
INSERT INTO `production_logs` VALUES ('2', '2023-05-05', '16:56:11', '16:56:15');
INSERT INTO `production_logs` VALUES ('3', '2023-05-11', '16:45:05', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '1', 'dsn7ksch9vvrv1qei5r3v1aboe8trypd', 'Valve', 'Valve', 'Valve1', null, null, '0', '0', '0', '0', '0', '0', '100', null, '1', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('2', '1', '9bd36ybm25cnp3hdypv80938ihs0cluk', 'Seal', 'Seal', 'Seal1', null, null, '0', '22080', '0', '0', '0', '0', '100', null, '2', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('3', '1', 'iccitks09lc1v707co3afiroxfo7aray', 'Madayaw Round', 'MR LPG 170G', 'MR170G', null, '20.00', '35', '6851', '21', '16176', '229', '0', '100', null, '4', '1', '1', '1', '1', '170', '0', '1', '2');
INSERT INTO `products` VALUES ('4', '1', '3hy5b5ht0e95vdal6tg8wqptvmgrro1e', 'Madayaw Square', 'MS LPG 170G', 'MS170G', null, '20.00', '35', '2705', '0', '8535', '142', '0', '100', null, '4', '1', '1', '1', '1', '170', '0', '1', '2');
INSERT INTO `products` VALUES ('5', '1', '7yb1wqk0skpffoi5tu4nufoc03jr6mln', 'Botin', 'Botin170G', 'Botin170G', null, '20.00', '35', '2485', '0', '1660', '792', '0', '100', null, '4', '1', '1', '1', '1', '170', '0', '1', '2');

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
INSERT INTO `purchases` VALUES ('1', '1', '3', '1', '0', '0.00', '0.00', '453.60', '12', '37.80', '3', '1', '0', '2');
INSERT INTO `purchases` VALUES ('2', '1', '3', '3', '0', '0.00', '0.00', '1360.80', '36', '37.80', '1', '3', '0', '2');
INSERT INTO `purchases` VALUES ('3', '1', '3', '4', '0', '0.00', '0.00', '1814.40', '48', '37.80', '4', '4', '0', '1');
INSERT INTO `purchases` VALUES ('4', '1', '3', '52', '0', '0.00', '0.00', '23587.20', '624', '37.80', '3', '52', '0', '1');
INSERT INTO `purchases` VALUES ('5', '2', '3', '49', '5', '0.00', '0.00', '20695.70', '593', '34.90', '3', '49', '5', '2');
INSERT INTO `purchases` VALUES ('6', '2', '3', '15', '7', '0.00', '0.00', '6526.30', '187', '34.90', '5', '15', '7', '1');
INSERT INTO `purchases` VALUES ('7', '2', '3', '0', '8', '0.00', '0.00', '279.20', '8', '34.90', '4', '0', '8', '1');
INSERT INTO `purchases` VALUES ('8', '2', '3', '285', '16', '0.00', '0.00', '119916.40', '3436', '34.90', '3', '285', '4', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quantity_logs
-- ----------------------------
INSERT INTO `quantity_logs` VALUES ('1', '1', '1', '1', '4154000', '2023-04-29 21:58:34', '0');
INSERT INTO `quantity_logs` VALUES ('2', '1', '1', '1', '45980', '2023-04-29 22:09:04', '1');
INSERT INTO `quantity_logs` VALUES ('3', '1', '2', '1', '45980', '2023-04-29 22:21:50', '1');
INSERT INTO `quantity_logs` VALUES ('4', '1', '3', '1', '32618', '2023-04-29 22:27:15', '1');
INSERT INTO `quantity_logs` VALUES ('5', '1', '4', '1', '9962', '2023-04-29 22:28:16', '1');
INSERT INTO `quantity_logs` VALUES ('6', '1', '5', '1', '3400', '2023-04-29 22:30:08', '1');
INSERT INTO `quantity_logs` VALUES ('7', '1', '3', '1', '20490', '2023-04-29 22:38:24', '1');
INSERT INTO `quantity_logs` VALUES ('8', '1', '3', '1', '20490', '2023-04-29 22:38:46', '1');
INSERT INTO `quantity_logs` VALUES ('9', '1', '3', '1', '20000', '2023-04-29 22:39:57', '1');
INSERT INTO `quantity_logs` VALUES ('10', '1', '3', '1', '20490', '2023-04-29 22:40:41', '1');
INSERT INTO `quantity_logs` VALUES ('11', '1', '3', '1', '490', '2023-04-29 22:44:19', '1');
INSERT INTO `quantity_logs` VALUES ('12', '1', '3', '1', '20490', '2023-04-29 22:48:26', '1');
INSERT INTO `quantity_logs` VALUES ('13', '1', '3', '1', '20490', '2023-04-29 22:50:16', '1');
INSERT INTO `quantity_logs` VALUES ('14', '1', '3', '1', '20490', '2023-04-29 22:51:37', '1');
INSERT INTO `quantity_logs` VALUES ('15', '1', '3', '1', '32618', '2023-04-29 22:52:30', '1');
INSERT INTO `quantity_logs` VALUES ('16', '1', '4', '1', '9962', '2023-04-29 22:52:50', '1');
INSERT INTO `quantity_logs` VALUES ('17', '1', '5', '1', '3400', '2023-04-29 22:53:03', '1');
INSERT INTO `quantity_logs` VALUES ('18', '1', '3', '1', '20490', '2023-04-29 22:54:01', '1');
INSERT INTO `quantity_logs` VALUES ('19', '1', '4', '1', '1483', '2023-04-29 22:55:54', '1');
INSERT INTO `quantity_logs` VALUES ('20', '1', '4', '1', '1483', '2023-04-29 22:56:49', '1');
INSERT INTO `quantity_logs` VALUES ('21', '1', '4', '1', '1483', '2023-04-29 22:57:50', '1');
INSERT INTO `quantity_logs` VALUES ('22', '1', '4', '1', '1483', '2023-04-29 22:58:07', '1');
INSERT INTO `quantity_logs` VALUES ('23', '1', '4', '1', '1483', '2023-04-29 22:58:10', '1');
INSERT INTO `quantity_logs` VALUES ('24', '1', '4', '1', '1483', '2023-04-29 22:59:48', '1');
INSERT INTO `quantity_logs` VALUES ('25', '1', '5', '1', '1927', '2023-04-29 23:01:34', '1');
INSERT INTO `quantity_logs` VALUES ('26', '1', '5', '1', '1927', '2023-04-29 23:02:06', '1');
INSERT INTO `quantity_logs` VALUES ('27', '1', '3', '1', '250', '2023-04-29 23:03:46', '1');
INSERT INTO `quantity_logs` VALUES ('28', '1', '3', '1', '229', '2023-04-29 23:04:29', '1');
INSERT INTO `quantity_logs` VALUES ('29', '1', '4', '1', '142', '2023-04-29 23:05:32', '1');
INSERT INTO `quantity_logs` VALUES ('30', '1', '4', '1', '142', '2023-04-29 23:05:38', '1');
INSERT INTO `quantity_logs` VALUES ('31', '1', '5', '1', '792', '2023-04-29 23:06:01', '1');
INSERT INTO `quantity_logs` VALUES ('32', '1', '5', '1', '792', '2023-04-29 23:06:09', '1');
INSERT INTO `quantity_logs` VALUES ('33', '1', '2', '1', '4154000', '2023-05-11 15:48:24', '2');
INSERT INTO `quantity_logs` VALUES ('34', '1', '1', '1', '4000000', '2023-05-11 15:48:35', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stocks_logs
-- ----------------------------
INSERT INTO `stocks_logs` VALUES ('1', '1', '3', null, '32618', '1', '0', '28928', '0', '0', '229', '0');
INSERT INTO `stocks_logs` VALUES ('2', '1', '4', null, '9962', '1', '0', '17062', '0', '0', '142', '0');
INSERT INTO `stocks_logs` VALUES ('3', '1', '5', null, '3400', '1', '0', '1660', '0', '0', '792', '0');
INSERT INTO `stocks_logs` VALUES ('4', '1', '3', '32618', '32618', '2', '0', '28928', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('5', '1', '4', '9962', '9962', '2', '0', '17062', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('6', '1', '5', '3400', '3400', '2', '0', '1660', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('7', '1', '3', '24173', null, '3', '0', '28928', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('8', '1', '4', '11326', null, '3', '0', '17062', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('9', '1', '5', '4750', null, '3', '0', '1660', '0', '0', '0', '0');

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
  `verify_prd_id` int(11) DEFAULT NULL,
  `verify_opening` int(11) DEFAULT NULL,
  `verify_opening_filled` int(11) DEFAULT NULL,
  `verify_opening_empty` int(11) DEFAULT NULL,
  `verify_opening_leakers` int(11) DEFAULT NULL,
  `verify_opening_for_revalving` int(11) DEFAULT NULL,
  `verify_opening_scraps` int(11) DEFAULT NULL,
  `verify_closing` int(11) DEFAULT NULL,
  `verify_closing_filled` int(11) DEFAULT NULL,
  `verify_closing_empty` int(11) DEFAULT NULL,
  `verify_closing_leakers` int(11) DEFAULT NULL,
  `verify_closing_for_revalving` int(11) DEFAULT NULL,
  `verify_closing_scraps` int(11) DEFAULT NULL,
  `verify_is_product` int(11) DEFAULT NULL,
  `verify_pdn_id` int(11) DEFAULT NULL,
  `verify_acc_id` int(11) DEFAULT NULL,
  `verify_user_type` int(11) DEFAULT NULL,
  `verify_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`verify_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stock_verifications
-- ----------------------------
INSERT INTO `stock_verifications` VALUES ('1', '3', '24173', '11795', '12128', '21', '229', '0', null, null, null, null, null, null, '1', '3', '1', '5', '3');
INSERT INTO `stock_verifications` VALUES ('2', '4', '11326', '2705', '8479', '0', '142', '0', null, null, null, null, null, null, '1', '3', '1', '5', '3');
INSERT INTO `stock_verifications` VALUES ('3', '5', '4750', '2485', '1473', '0', '792', '0', null, null, null, null, null, null, '1', '3', '1', '5', '3');
INSERT INTO `stock_verifications` VALUES ('4', '1', '4091000', null, null, null, null, null, null, null, null, null, null, null, '0', '3', '1', '5', '3');
INSERT INTO `stock_verifications` VALUES ('5', '2', '4154000', null, null, null, null, null, null, null, null, null, null, null, '0', '3', '1', '5', '3');
INSERT INTO `stock_verifications` VALUES ('6', '3', '24173', '11795', '12128', '21', '229', '0', null, null, null, null, null, null, '1', '3', '1', '4', '2');
INSERT INTO `stock_verifications` VALUES ('7', '4', '11326', '2705', '8479', '0', '142', '0', null, null, null, null, null, null, '1', '3', '1', '4', '2');
INSERT INTO `stock_verifications` VALUES ('8', '5', '4750', '2485', '1473', '0', '792', '0', null, null, null, null, null, null, '1', '3', '1', '4', '2');
INSERT INTO `stock_verifications` VALUES ('9', '1', '4091000', null, null, null, null, null, null, null, null, null, null, null, '0', '3', '1', '4', '2');
INSERT INTO `stock_verifications` VALUES ('10', '2', '4154000', null, null, null, null, null, null, null, null, null, null, null, '0', '3', '1', '4', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES ('1', 'ozsaeqqxhwxvvl63yxqv4efem71gc2g2', '1', 'Valve Supplier', 'Unknown', '00000000000', null, null, '1');
INSERT INTO `suppliers` VALUES ('2', 'cnm8jbdt3nhllkla0hy8vrdg4qqfp2lw', '1', 'Seal Supplier', 'Unknown', '00000000000', null, null, '1');
INSERT INTO `suppliers` VALUES ('4', 'qmjqqga3em6vhvdqqf4dwi6u304w2stc', '1', 'Canister Supplier', 'Unknown', '00000000000', null, null, '1');

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
INSERT INTO `tanks` VALUES ('1', '1', 'Tank 1', '4154000', '4091000', null, null, '1');
INSERT INTO `tanks` VALUES ('2', '1', 'Tank 2', '4154000', '4154000', null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tank_logs
-- ----------------------------
INSERT INTO `tank_logs` VALUES ('1', '1', '1', '4154000', '4154000', '1');
INSERT INTO `tank_logs` VALUES ('2', '1', '1', '4154000', '91000', '2');
INSERT INTO `tank_logs` VALUES ('3', '1', '1', '4091000', null, '3');
INSERT INTO `tank_logs` VALUES ('4', '1', '2', '4154000', null, '3');

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
  `trx_confirm` tinyint(1) DEFAULT '0',
  `pdn_id` int(30) DEFAULT NULL,
  PRIMARY KEY (`trx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES ('1', 'POS-20230511-1', '1', '2', '1', '2023-05-11 17:13:44', '2023-05-11', '17:13:44', '0', '27216', '27216', '27216', '1', '3565', '1757', '0', '3');
INSERT INTO `transactions` VALUES ('2', 'POS-20230511-2', '1', '2', '2', '2023-05-11 17:23:41', '2023-05-11', '17:23:41', '0', '147838', '147418', '147838', '1', '3567', '1758', '0', '3');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', 'mldnxhk4yqs9sn5rbonzuras79f3ayc9', 'Aq Cee Admin', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'University of Malagos', '1.jpg', '1', '1');
INSERT INTO `users` VALUES ('2', '1', 'uph89gph7a9787mc08kdwxcszmr70u6x', 'Kim Ji Won', 'kimjiwon', 'c17b6630268dbe52c5cf042327a7e65a', 'Seoul Tan Kudarat', null, '1', '4');
INSERT INTO `users` VALUES ('3', '1', 'd1zj73150d84yfubm7a6pku3uvy84y6a', 'Mark', 'mark', 'ea82410c7a9991816b5eeeebe195e20a', 'Seoul Tan Kudarat', null, '1', '5');
INSERT INTO `users` VALUES ('4', '1', 'g967l6nbg57kxjc6m030y3xjfzm5zr6t', 'Ma Dong-seok', 'madongseok', 'df33c062ef7333db904e32f50ce3db66', 'Seoulud Davao', null, '1', '2');

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
INSERT INTO `user_types` VALUES ('4', 'Plant Manager');
INSERT INTO `user_types` VALUES ('5', 'Supervisor');
