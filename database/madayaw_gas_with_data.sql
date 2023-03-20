/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 80030
Source Host           : localhost:3306
Source Database       : madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 80030
File Encoding         : 65001

Date: 2023-03-19 23:13:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `accounts`
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `acc_id` int NOT NULL AUTO_INCREMENT,
  `acc_uuid` varchar(255) DEFAULT NULL,
  `acc_name` varchar(255) DEFAULT NULL,
  `acc_image` varchar(255) DEFAULT NULL,
  `acc_website` varchar(255) DEFAULT NULL,
  `acc_active` tinyint DEFAULT '1',
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
  `bo_id` int NOT NULL AUTO_INCREMENT,
  `bo_ref_id` varchar(30) DEFAULT NULL,
  `acc_id` int DEFAULT NULL,
  `trx_id` int NOT NULL,
  `bo_crates` int DEFAULT '0',
  `bo_loose` int DEFAULT '0',
  `bo_date` varchar(20) DEFAULT NULL,
  `bo_time` varchar(20) DEFAULT NULL,
  `bo_datetime` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`bo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of bad_orders
-- ----------------------------

-- ----------------------------
-- Table structure for `customers`
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `cus_id` int NOT NULL AUTO_INCREMENT,
  `acc_id` int NOT NULL,
  `cus_uuid` varchar(255) DEFAULT NULL,
  `cus_name` varchar(255) DEFAULT NULL,
  `cus_address` varchar(255) DEFAULT NULL,
  `cus_contact` varchar(11) DEFAULT NULL,
  `cus_price_change` float DEFAULT '0',
  `cus_accessibles` varchar(255) DEFAULT NULL,
  `cus_accessibles_prices` varchar(255) DEFAULT NULL,
  `cus_notes` varchar(255) DEFAULT NULL,
  `cus_image` varchar(255) DEFAULT NULL,
  `cus_active` tinyint DEFAULT '1',
  PRIMARY KEY (`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', '1', 'lp9908qz4nbhd67tu69bo4axdfcjzqm7', 'Im Nayeon', 'Seoul Tan Kudarat', '09324234234', '0', '3,4,5,', '35.00,40.00,700.00,', null, '1.jpg', '1');
INSERT INTO `customers` VALUES ('2', '1', 'fw04igzm3c0kau4c2ryq2qqfprvzkmpi', 'Yoo Jeongyeon', 'Seoul Tan Kudarat', '08235434534', '0', '3,4,', '35.00,40.00,', null, '2.jpg', '1');
INSERT INTO `customers` VALUES ('3', '1', 'l9ctr0g90z1gxx3ii4c2o4z9wt259mpc', 'Hirai Momo', 'Shibuyas Bombei, Japen', '06787578232', '0', '5,', '700.00,', null, '3.jpg', '1');
INSERT INTO `customers` VALUES ('4', '1', 'vdvl03yj395h3av0fetyzt2cunw5epir', 'Minatozaki Sana', 'Shibu Shiti', null, '0', '3,4,5,', '35.00,40.00,700.00,', null, '4.jpg', '1');
INSERT INTO `customers` VALUES ('5', '1', '2w44i28onaqn4evui2svgbqv6d481o03', 'Park Jihyo', 'Seoul Tan Kudarat, South Kortabato', '09567568687', '0', '3,4,5,', '35.00,40.00,700.00,', null, '5.jpg', '1');
INSERT INTO `customers` VALUES ('6', '1', 't7gou40ztu0uctuzo6d28o1chxlv97vc', 'Myoui Mina', 'Nagoya Shardines, Japanacan', null, '0', '3,4,', '30.00,40.00,', null, '6.jpg', '1');
INSERT INTO `customers` VALUES ('7', '1', '9cww8cd4sluz6j95rch7d8o0fo7flv5x', 'Kim Dahyun', 'Seoulup', '08656523223', '0', '4,5,', '40.00,500.00,', null, '7.jpg', '1');
INSERT INTO `customers` VALUES ('8', '1', '947zwcnsfnl6pos6cjyerek0cc53sg5o', 'Son Chaeyoung', 'Gonjiam City', null, '0', '4,5,', '40.00,700.00,', null, '8.jpg', '1');
INSERT INTO `customers` VALUES ('9', '1', 'gul4ltv29a4xr77q4s482vpcezgprr37', 'Chou Tzuyu', 'Ajinomoto, Taiwan', null, '0', '3,4,5,', '35.00,40.00,500.00,', null, '9.jpg', '1');

-- ----------------------------
-- Table structure for `movement_logs`
-- ----------------------------
DROP TABLE IF EXISTS `movement_logs`;
CREATE TABLE `movement_logs` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `acc_id` int DEFAULT NULL,
  `prd_id` varchar(255) DEFAULT NULL,
  `log_filled` decimal(11,0) DEFAULT '0',
  `log_leakers` decimal(10,0) DEFAULT '0',
  `log_empty_goods` decimal(10,0) DEFAULT '0',
  `log_for_revalving` decimal(10,0) DEFAULT '0',
  `log_scraps` decimal(10,0) DEFAULT '0',
  `usr_id` int DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `pdn_id` int DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of movement_logs
-- ----------------------------
INSERT INTO `movement_logs` VALUES ('1', '1', '3', '0', '0', '120', '0', '0', '1', '2023-03-19', '1');
INSERT INTO `movement_logs` VALUES ('2', '1', '3', '0', '0', '120', '0', '0', '1', '2023-03-19', '1');
INSERT INTO `movement_logs` VALUES ('3', '1', '3', '0', '0', '120', '0', '0', '1', '2023-03-19', '1');
INSERT INTO `movement_logs` VALUES ('4', '1', '3', '120', '0', '0', '0', '0', '1', '2023-03-19', '1');
INSERT INTO `movement_logs` VALUES ('5', '1', '4', '120', '0', '0', '0', '0', '1', '2023-03-19', '1');

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `news_id` int NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) DEFAULT NULL,
  `news_content` longtext,
  `news_date` varchar(20) DEFAULT NULL,
  `news_time` varchar(20) DEFAULT NULL,
  `news_datetime` varchar(20) DEFAULT NULL,
  `news_img` varchar(255) DEFAULT NULL,
  `news_active` tinyint DEFAULT '1',
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of news
-- ----------------------------

-- ----------------------------
-- Table structure for `oppositions`
-- ----------------------------
DROP TABLE IF EXISTS `oppositions`;
CREATE TABLE `oppositions` (
  `ops_id` int NOT NULL AUTO_INCREMENT,
  `ops_uuid` varchar(255) DEFAULT NULL,
  `ops_name` varchar(255) DEFAULT NULL,
  `ops_sku` varchar(255) DEFAULT NULL,
  `ops_description` varchar(255) DEFAULT NULL,
  `ops_quantity` int DEFAULT NULL,
  `ops_image` varchar(255) DEFAULT NULL,
  `ops_notes` varchar(255) DEFAULT NULL,
  `acc_id` int DEFAULT NULL,
  `ops_active` int DEFAULT '1',
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
  `acc_id` int NOT NULL,
  `pmnt_id` int unsigned NOT NULL AUTO_INCREMENT,
  `pmnt_ref_id` varchar(30) DEFAULT NULL,
  `trx_id` int unsigned NOT NULL,
  `pmnt_amount` double(30,0) NOT NULL,
  `pmnt_attachment` varchar(70) DEFAULT NULL,
  `usr_id` int NOT NULL,
  `pmnt_date` varchar(20) DEFAULT NULL,
  `pmnt_time` varchar(20) DEFAULT NULL,
  `trx_mode_of_payment` int DEFAULT NULL,
  PRIMARY KEY (`pmnt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES ('1', '1', 'PMT20230319-1', '1', '400', null, '1', '2023-03-19', '04:25:09', '1');

-- ----------------------------
-- Table structure for `payment_types`
-- ----------------------------
DROP TABLE IF EXISTS `payment_types`;
CREATE TABLE `payment_types` (
  `mode_of_payment` int NOT NULL,
  `payment_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`mode_of_payment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
  `pdn_id` int NOT NULL AUTO_INCREMENT,
  `pdn_date` date DEFAULT NULL,
  `pdn_start_time` time DEFAULT NULL,
  `pdn_end_time` time DEFAULT NULL,
  PRIMARY KEY (`pdn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of production_logs
-- ----------------------------
INSERT INTO `production_logs` VALUES ('1', '2023-03-19', '15:56:23', null);

-- ----------------------------
-- Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `prd_id` int NOT NULL AUTO_INCREMENT,
  `acc_id` int DEFAULT NULL,
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
  `sup_id` int DEFAULT NULL,
  `prd_active` tinyint DEFAULT '1',
  `prd_is_refillable` tinyint DEFAULT '1',
  `prd_for_production` tinyint DEFAULT '1',
  `prd_for_POS` tinyint DEFAULT NULL,
  `prd_weight` decimal(10,0) DEFAULT NULL,
  `prd_raw_can_qty` int DEFAULT '0',
  `prd_components` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`prd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '1', 'j97mm4ga2qp72gsiyde2hbferueen9zk', 'MR Valve', 'MRV', 'MRV', null, null, '0', '640.00', '0.00', '0.00', '0.00', '0', '100.00', null, '1', '1', '0', '1', '0', null, '0', null);
INSERT INTO `products` VALUES ('2', '1', 'esvbm0x4ecnhypf26cnsr1is97r189mh', 'MS Valve', 'MSV', 'MSV', null, null, '0', '1000.00', '0.00', '0.00', '0.00', '0', '100.00', null, '1', '1', '0', '1', '0', null, '0', null);
INSERT INTO `products` VALUES ('3', '1', 'uk6ws9c3rwf2njqjppoqfmhgaa2728ug', 'Madayaw Round', 'MR LPG 170G', 'MR LPG 170G', null, '35.00', '20', '108.00', '0.00', '252.00', '0.00', '0', '100.00', null, '2', '1', '1', '1', '1', '170', '640', '1');
INSERT INTO `products` VALUES ('4', '1', '7z7dsq04gdfiqk08rmidvamfkz6od2vo', 'Madayaw Square', 'MS LPG 170G', 'MS LPG 170G', null, '40.00', '50', '120.00', '0.00', '240.00', '0.00', '0', '100.00', null, '2', '1', '1', '1', '1', '170', '1000', '');
INSERT INTO `products` VALUES ('5', '1', '6fsvzhxa9sr4gv9tnzpaoct1644qmsub', 'Gas Stove 1  Burner', '1 Burner Stove', 'GS1B', null, '700.00', '0', '100.00', '0.00', '0.00', '0.00', '0', '100.00', null, '1', '1', '0', '0', '1', null, '0', null);

-- ----------------------------
-- Table structure for `purchases`
-- ----------------------------
DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases` (
  `pur_id` int NOT NULL AUTO_INCREMENT,
  `trx_id` int DEFAULT NULL,
  `prd_id` int DEFAULT NULL,
  `pur_crate` int DEFAULT NULL,
  `pur_loose` int DEFAULT NULL,
  `pur_discount` double(10,2) DEFAULT '0.00',
  `pur_deposit` double(10,2) DEFAULT NULL,
  `pur_total` double(10,2) DEFAULT NULL,
  `pur_qty` int DEFAULT NULL,
  `prd_price` double(10,2) DEFAULT NULL,
  `pur_crate_in` int DEFAULT NULL,
  `pur_loose_in` int DEFAULT NULL,
  PRIMARY KEY (`pur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of purchases
-- ----------------------------
INSERT INTO `purchases` VALUES ('1', '1', '3', '1', '0', '20.00', '0.00', '400.00', '12', '35.00', '1', '0');

-- ----------------------------
-- Table structure for `quantity_logs`
-- ----------------------------
DROP TABLE IF EXISTS `quantity_logs`;
CREATE TABLE `quantity_logs` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `acc_id` int DEFAULT NULL,
  `prd_id` int DEFAULT NULL,
  `usr_id` int DEFAULT NULL,
  `log_quantity` int DEFAULT NULL,
  `log_datetime` datetime DEFAULT NULL,
  `pdn_id` int DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of quantity_logs
-- ----------------------------
INSERT INTO `quantity_logs` VALUES ('1', '1', '1', '1', '4000000', '2023-03-19 15:54:18', '0');
INSERT INTO `quantity_logs` VALUES ('2', '1', '2', '1', '5000000', '2023-03-19 15:55:40', '0');
INSERT INTO `quantity_logs` VALUES ('3', '1', '3', '1', '120', '2023-03-19 16:01:15', '1');
INSERT INTO `quantity_logs` VALUES ('4', '1', '1', '1', '1000', '2023-03-19 16:01:23', '1');
INSERT INTO `quantity_logs` VALUES ('5', '1', '2', '1', '1000', '2023-03-19 16:01:29', '1');
INSERT INTO `quantity_logs` VALUES ('6', '1', '3', '1', '1000', '2023-03-19 16:01:34', '1');
INSERT INTO `quantity_logs` VALUES ('7', '1', '4', '1', '1000', '2023-03-19 16:01:40', '1');
INSERT INTO `quantity_logs` VALUES ('8', '1', '3', '1', '120', '2023-03-19 16:01:53', '1');
INSERT INTO `quantity_logs` VALUES ('9', '1', '3', '1', '120', '2023-03-19 16:01:54', '1');
INSERT INTO `quantity_logs` VALUES ('10', '1', '4', '1', '120', '2023-03-19 16:02:00', '1');
INSERT INTO `quantity_logs` VALUES ('11', '1', '4', '1', '120', '2023-03-19 16:02:01', '1');
INSERT INTO `quantity_logs` VALUES ('12', '1', '4', '1', '120', '2023-03-19 16:02:05', '1');
INSERT INTO `quantity_logs` VALUES ('13', '1', '3', '1', '120', '2023-03-19 16:02:26', '1');
INSERT INTO `quantity_logs` VALUES ('14', '1', '3', '1', '120', '2023-03-19 16:02:39', '1');
INSERT INTO `quantity_logs` VALUES ('15', '1', '4', '1', '120', '2023-03-19 16:02:46', '1');
INSERT INTO `quantity_logs` VALUES ('16', '1', '5', '1', '100', '2023-03-19 16:05:23', '1');

-- ----------------------------
-- Table structure for `reset_password`
-- ----------------------------
DROP TABLE IF EXISTS `reset_password`;
CREATE TABLE `reset_password` (
  `rst_id` int NOT NULL AUTO_INCREMENT,
  `usr_id` int DEFAULT NULL,
  `rst_active` tinyint DEFAULT '1',
  PRIMARY KEY (`rst_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of reset_password
-- ----------------------------

-- ----------------------------
-- Table structure for `sales_reports`
-- ----------------------------
DROP TABLE IF EXISTS `sales_reports`;
CREATE TABLE `sales_reports` (
  `sls_id` int NOT NULL AUTO_INCREMENT,
  `cus_id` int DEFAULT NULL,
  `prd_id` int DEFAULT NULL,
  `sls_quantity` float DEFAULT NULL,
  `sls_discount` float DEFAULT NULL,
  `sls_sub_total` float DEFAULT NULL,
  `sls_time` time DEFAULT NULL,
  `pdn_id` int DEFAULT NULL,
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
  `log_id` int NOT NULL AUTO_INCREMENT,
  `acc_id` int DEFAULT NULL,
  `prd_id` varchar(255) DEFAULT NULL,
  `log_quantity` decimal(11,0) DEFAULT '0',
  `log_leakers` decimal(10,0) DEFAULT '0',
  `log_empty_goods` decimal(10,0) DEFAULT '0',
  `log_for_revalving` decimal(10,0) DEFAULT '0',
  `log_scraps` decimal(10,0) DEFAULT '0',
  `log_date` date DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of stockin_logs
-- ----------------------------

-- ----------------------------
-- Table structure for `stocks_logs`
-- ----------------------------
DROP TABLE IF EXISTS `stocks_logs`;
CREATE TABLE `stocks_logs` (
  `stk_id` int NOT NULL AUTO_INCREMENT,
  `acc_id` int DEFAULT NULL,
  `prd_id` int DEFAULT NULL,
  `opening_stocks` int DEFAULT NULL,
  `closing_stocks` int DEFAULT NULL,
  `pdn_id` int DEFAULT NULL,
  PRIMARY KEY (`stk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of stocks_logs
-- ----------------------------

-- ----------------------------
-- Table structure for `stock_statuses`
-- ----------------------------
DROP TABLE IF EXISTS `stock_statuses`;
CREATE TABLE `stock_statuses` (
  `stk_id` int NOT NULL AUTO_INCREMENT,
  `stk_opening` double DEFAULT NULL,
  `stk_closing` double DEFAULT NULL,
  `pdn_id` int DEFAULT NULL,
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
  `sup_id` int NOT NULL AUTO_INCREMENT,
  `sup_uuid` varchar(255) DEFAULT NULL,
  `acc_id` int DEFAULT NULL,
  `sup_name` varchar(255) DEFAULT NULL,
  `sup_address` varchar(255) DEFAULT NULL,
  `sup_contact` varchar(255) DEFAULT NULL,
  `sup_notes` varchar(255) DEFAULT NULL,
  `sup_image` varchar(255) DEFAULT NULL,
  `sup_active` tinyint DEFAULT '1',
  PRIMARY KEY (`sup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES ('1', 'bqxw405xz8rxalti2xk2e85b0ccx48mx', '1', 'Underground', 'Oyaji', '09877866544', null, null, '1');
INSERT INTO `suppliers` VALUES ('2', 'zjf7xgvva6uq0ylxl118tx8noo8t7oq9', '1', 'Madayaw Gas', 'Bunawan', '09456223232', null, null, '1');

-- ----------------------------
-- Table structure for `tanks`
-- ----------------------------
DROP TABLE IF EXISTS `tanks`;
CREATE TABLE `tanks` (
  `tnk_id` int NOT NULL AUTO_INCREMENT,
  `acc_id` int NOT NULL,
  `tnk_name` varchar(255) DEFAULT NULL,
  `tnk_capacity` decimal(11,0) DEFAULT '0',
  `tnk_remaining` decimal(11,0) DEFAULT '0',
  `tnk_notes` varchar(255) DEFAULT NULL,
  `tnk_uuid` int DEFAULT NULL,
  `tnk_active` tinyint DEFAULT '1',
  PRIMARY KEY (`tnk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of tanks
-- ----------------------------
INSERT INTO `tanks` VALUES ('1', '1', 'Tank 1', '5000000', '3979600', null, null, '1');
INSERT INTO `tanks` VALUES ('2', '1', 'Tank 2', '5000000', '4979600', null, null, '1');

-- ----------------------------
-- Table structure for `tank_logs`
-- ----------------------------
DROP TABLE IF EXISTS `tank_logs`;
CREATE TABLE `tank_logs` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `acc_id` int DEFAULT NULL,
  `tnk_id` int DEFAULT NULL,
  `log_tnk_opening` decimal(10,0) DEFAULT NULL,
  `log_tnk_closing` decimal(10,0) DEFAULT NULL,
  `pdn_id` int DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tank_logs
-- ----------------------------
INSERT INTO `tank_logs` VALUES ('1', '1', '1', '0', null, '1');
INSERT INTO `tank_logs` VALUES ('2', '1', '2', '0', null, '1');

-- ----------------------------
-- Table structure for `transactions`
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `trx_id` int NOT NULL AUTO_INCREMENT,
  `trx_ref_id` varchar(30) DEFAULT NULL,
  `acc_id` tinyint DEFAULT NULL,
  `usr_id` int DEFAULT NULL,
  `cus_id` int DEFAULT NULL,
  `trx_datetime` datetime DEFAULT NULL,
  `trx_date` varchar(20) DEFAULT NULL,
  `trx_time` varchar(20) DEFAULT NULL,
  `trx_amount_paid` decimal(11,0) DEFAULT NULL,
  `trx_balance` decimal(11,0) DEFAULT NULL,
  `trx_gross` decimal(11,0) DEFAULT NULL,
  `trx_total` decimal(11,0) DEFAULT NULL,
  PRIMARY KEY (`trx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES ('1', 'POS-20230319-1', '1', '1', '1', '2023-03-19 04:25:09', '2023-03-19', '04:25:09', '400', '0', '400', '400');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `usr_id` int NOT NULL AUTO_INCREMENT,
  `acc_id` int DEFAULT NULL,
  `usr_uuid` varchar(255) DEFAULT NULL,
  `usr_full_name` varchar(255) DEFAULT NULL,
  `usr_name` varchar(255) DEFAULT NULL,
  `usr_password` varchar(255) DEFAULT NULL,
  `usr_address` varchar(255) DEFAULT NULL,
  `usr_image` varchar(255) DEFAULT NULL,
  `usr_active` tinyint DEFAULT '1',
  `typ_id` int DEFAULT NULL,
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
  `typ_id` int NOT NULL AUTO_INCREMENT,
  `typ_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`typ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_types
-- ----------------------------
INSERT INTO `user_types` VALUES ('1', 'Administrator');
INSERT INTO `user_types` VALUES ('2', 'Employee');
INSERT INTO `user_types` VALUES ('3', 'Observer');
