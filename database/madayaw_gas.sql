/*
Navicat MySQL Data Transfer

Source Server         : server
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2023-02-16 18:59:56
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of movement_logs
-- ----------------------------
INSERT INTO `movement_logs` VALUES ('1', '1', '2', '1', '0', '0', '0', '0', null, '2022-11-14', null);
INSERT INTO `movement_logs` VALUES ('2', '1', '2', '2', '0', '0', '0', '0', null, '2022-11-14', null);
INSERT INTO `movement_logs` VALUES ('3', '1', '3', '1', '0', '0', '0', '0', null, '2022-12-12', '19');
INSERT INTO `movement_logs` VALUES ('4', '1', '8', '22', '0', '0', '0', '0', null, '2022-12-12', '19');
INSERT INTO `movement_logs` VALUES ('5', '1', '3', '20', '0', '0', '0', '0', null, '2022-12-13', '21');
INSERT INTO `movement_logs` VALUES ('6', '1', '3', '0', '0', '2', '0', '0', null, '2022-12-13', '21');
INSERT INTO `movement_logs` VALUES ('7', '1', '3', '0', '0', '1', '0', '0', null, '2022-12-13', '21');
INSERT INTO `movement_logs` VALUES ('8', '1', '8', '0', '1', '0', '0', '0', null, '2022-12-13', '21');
INSERT INTO `movement_logs` VALUES ('9', '1', '8', '0', '0', '0', '0', '1', null, '2022-12-13', '21');
INSERT INTO `movement_logs` VALUES ('10', '1', '8', '0', '0', '0', '0', '1', null, '2022-12-13', '21');
INSERT INTO `movement_logs` VALUES ('11', '1', '3', '0', '0', '0', '0', '1', null, '2022-12-13', '21');
INSERT INTO `movement_logs` VALUES ('12', '1', '3', '0', '0', '0', '1', '0', null, '2022-12-13', '21');
INSERT INTO `movement_logs` VALUES ('13', '1', '8', '0', '0', '0', '0', '1', null, '2022-12-13', '21');
INSERT INTO `movement_logs` VALUES ('14', '1', '3', '0', '0', '0', '2', '0', null, '2022-12-14', '27');
INSERT INTO `movement_logs` VALUES ('15', '1', '3', '0', '0', '0', '2', '0', null, '2022-12-15', '36');
INSERT INTO `movement_logs` VALUES ('16', '1', '3', '0', '0', '1', '0', '0', null, '2023-01-04', '38');
INSERT INTO `movement_logs` VALUES ('17', '1', '3', '1', '0', '0', '0', '0', null, '2023-01-04', '38');
INSERT INTO `movement_logs` VALUES ('18', '1', '3', '0', '1', '0', '0', '0', null, '2023-01-04', '38');
INSERT INTO `movement_logs` VALUES ('19', '1', '3', '0', '0', '1', '0', '0', null, '2023-01-13', '46');
INSERT INTO `movement_logs` VALUES ('20', '1', '3', '0', '0', '12', '0', '0', null, '2023-01-13', '46');
INSERT INTO `movement_logs` VALUES ('21', '1', '3', '0', '0', '144', '0', '0', null, '2023-01-13', '46');
INSERT INTO `movement_logs` VALUES ('22', '1', '3', '0', '0', '0', '0', '1', null, '2023-01-13', '46');
INSERT INTO `movement_logs` VALUES ('23', '1', '3', '0', '0', '0', '0', '1', null, '2023-01-17', '47');
INSERT INTO `movement_logs` VALUES ('24', '1', '3', '0', '0', '0', '0', '1', null, '2023-01-17', '47');
INSERT INTO `movement_logs` VALUES ('25', '1', '3', '0', '0', '0', '0', '1', null, '2023-01-17', '47');
INSERT INTO `movement_logs` VALUES ('26', '1', '3', '0', '0', '0', '1', '0', null, '2023-02-09', '66');
INSERT INTO `movement_logs` VALUES ('27', '1', '3', '0', '0', '0', '1', '0', null, '2023-02-09', '66');
INSERT INTO `movement_logs` VALUES ('28', '1', '3', '0', '0', '0', '1', '0', null, '2023-02-09', '66');
INSERT INTO `movement_logs` VALUES ('29', '1', '2', '0', '0', '1440', '0', '0', '1', '2023-02-16', '66');
INSERT INTO `movement_logs` VALUES ('30', '1', '2', '240', '0', '0', '0', '0', '1', '2023-02-16', '66');
INSERT INTO `movement_logs` VALUES ('31', '1', '2', '144', '0', '0', '0', '0', '1', '2023-02-16', '66');
INSERT INTO `movement_logs` VALUES ('32', '1', '2', '6', '0', '0', '0', '0', '1', '2023-02-16', '66');
INSERT INTO `movement_logs` VALUES ('33', '1', '2', '1', '0', '0', '0', '0', '1', '2023-02-16', '66');
INSERT INTO `movement_logs` VALUES ('34', '1', '2', '12', '0', '0', '0', '0', '1', '2023-02-16', '66');
INSERT INTO `movement_logs` VALUES ('35', '1', '3', '0', '0', '1200', '0', '0', '1', '2023-02-16', '66');
INSERT INTO `movement_logs` VALUES ('36', '1', '3', '1200', '0', '0', '0', '0', '1', '2023-02-16', '66');
INSERT INTO `movement_logs` VALUES ('37', '1', '3', '0', '0', '1200', '0', '0', '1', '2023-02-16', '66');
INSERT INTO `movement_logs` VALUES ('38', '1', '5', '0', '0', '1200', '0', '0', '1', '2023-02-16', '66');
INSERT INTO `movement_logs` VALUES ('39', '1', '5', '840', '0', '0', '0', '0', '1', '2023-02-16', '66');
INSERT INTO `movement_logs` VALUES ('40', '1', '4', '0', '0', '120', '0', '0', '1', '2023-02-16', null);
INSERT INTO `movement_logs` VALUES ('41', '1', '3', '0', '0', '240', '0', '0', '1', '2023-02-16', null);
INSERT INTO `movement_logs` VALUES ('42', '1', '3', '120', '0', '0', '0', '0', '1', '2023-02-16', null);
INSERT INTO `movement_logs` VALUES ('43', '1', '4', '120', '0', '0', '0', '0', '1', '2023-02-16', null);

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
-- Table structure for `production_logs`
-- ----------------------------
DROP TABLE IF EXISTS `production_logs`;
CREATE TABLE `production_logs` (
  `pdn_id` int(11) NOT NULL AUTO_INCREMENT,
  `pdn_date` date DEFAULT NULL,
  `pdn_start_time` time DEFAULT NULL,
  `pdn_end_time` time DEFAULT NULL,
  PRIMARY KEY (`pdn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of production_logs
-- ----------------------------

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
  `prd_type` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`prd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quantity_logs
-- ----------------------------
INSERT INTO `quantity_logs` VALUES ('1', '1', '1', '1', '1000', '2023-02-16 18:35:12', null);
INSERT INTO `quantity_logs` VALUES ('2', '1', '2', '1', '1000', '2023-02-16 18:35:25', null);
INSERT INTO `quantity_logs` VALUES ('3', '1', '3', '1', '12000', '2023-02-16 18:39:06', null);
INSERT INTO `quantity_logs` VALUES ('4', '1', '3', '1', '1200', '2023-02-16 18:39:41', null);
INSERT INTO `quantity_logs` VALUES ('5', '1', '3', '1', '600', '2023-02-16 18:39:49', null);
INSERT INTO `quantity_logs` VALUES ('6', '1', '3', '1', '600', '2023-02-16 18:40:20', null);
INSERT INTO `quantity_logs` VALUES ('7', '1', '4', '1', '120', '2023-02-16 18:40:38', null);
INSERT INTO `quantity_logs` VALUES ('8', '1', '1', '1', '1000', '2023-02-16 18:40:53', null);
INSERT INTO `quantity_logs` VALUES ('9', '1', '3', '1', '240', '2023-02-16 18:40:59', null);
INSERT INTO `quantity_logs` VALUES ('10', '1', '3', '1', '120', '2023-02-16 18:41:22', null);
INSERT INTO `quantity_logs` VALUES ('11', '1', '3', '1', '120', '2023-02-16 18:42:17', null);
INSERT INTO `quantity_logs` VALUES ('12', '1', '4', '1', '240', '2023-02-16 18:43:37', null);
INSERT INTO `quantity_logs` VALUES ('13', '1', '4', '1', '120', '2023-02-16 18:44:04', null);
INSERT INTO `quantity_logs` VALUES ('14', '1', '5', '1', '10', '2023-02-16 18:49:12', null);

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
  `sup_active` tinyint(11) DEFAULT '1',
  PRIMARY KEY (`sup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of suppliers
-- ----------------------------

-- ----------------------------
-- Table structure for `tank_logs`
-- ----------------------------
DROP TABLE IF EXISTS `tank_logs`;
CREATE TABLE `tank_logs` (
  `tnk_id` int(11) NOT NULL AUTO_INCREMENT,
  `tnk_quantity` decimal(10,0) DEFAULT NULL,
  `tnk_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`tnk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `usr_active` tinyint(255) DEFAULT '1',
  `typ_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', '23423v ertegrtg545g36h453645h654', 'Aq Cee Admin', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', null, null, '1', '1');

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
