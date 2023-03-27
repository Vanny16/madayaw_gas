/*
Navicat MySQL Data Transfer

Source Server         : server
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2023-03-27 17:20:45
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of movement_logs
-- ----------------------------

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
  `pmnt_received` double(30,0) NOT NULL,
  `pmnt_change` double(30,0) NOT NULL,
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
  `prd_components` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`prd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quantity_logs
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of suppliers
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tanks
-- ----------------------------

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
