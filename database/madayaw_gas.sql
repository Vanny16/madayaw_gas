/*
Navicat MySQL Data Transfer

Source Server         : server
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2023-02-17 21:24:24
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', '1', '8trj04ov34cvstjz0fr78amtzh0aw1dx', 'H', 'hop', '09800989080', '0', '2,7890.00,3,100.00,', '7890.00,3,100.00,', null, null, '1');
INSERT INTO `customers` VALUES ('2', '1', 'k0ots08p91s1s3d8jxasm0yvpkn2h7um', 'asdad', 'qweqwe', '23424234242', '0', '7890.00,3,100.00,', '3,100.00,', null, null, '1');
INSERT INTO `customers` VALUES ('3', '1', '8odet1zgr1laobiqwcl3h4jgaqu97762', 'ddf', '435435', '34533453534', '0', '2,', '3,', null, null, '1');
INSERT INTO `customers` VALUES ('4', '1', 'swc1qw0p3dhdv60co3wfhuc09lrxqx1w', 'lkhn', 'ivjhn', '76897658766', '0', '2,', '', null, null, '1');
INSERT INTO `customers` VALUES ('5', '1', 'xf838wi3pav12mtkz0h1fymm48w6uvqo', '123', '100', '12312321312', '0', '2,', '', null, null, '1');
INSERT INTO `customers` VALUES ('6', '1', '8stkja9y88qs7x04qlc094t9u8anprgl', 'lijasd', 'klnsad', '09879078907', '0', '2,', '', null, null, '1');
INSERT INTO `customers` VALUES ('7', '1', 's4tgl16sdwbzlhwf9sghhcdbz3eso28f', 'Are', 'IULG', '89678967896', '0', '2,', '', null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of movement_logs
-- ----------------------------
INSERT INTO `movement_logs` VALUES ('1', '1', '2', '0', '0', '144', '0', '0', '1', '2023-02-17', '1');
INSERT INTO `movement_logs` VALUES ('2', '1', '2', '144', '0', '0', '0', '0', '1', '2023-02-17', '1');
INSERT INTO `movement_logs` VALUES ('3', '1', '2', '0', '0', '154', '0', '0', '1', '2023-02-17', '1');
INSERT INTO `movement_logs` VALUES ('4', '1', '2', '154', '0', '0', '0', '0', '1', '2023-02-17', '1');
INSERT INTO `movement_logs` VALUES ('5', '1', '2', '0', '120', '0', '0', '0', '1', '2023-02-17', '1');
INSERT INTO `movement_logs` VALUES ('6', '1', '2', '0', '0', '0', '0', '60', '1', '2023-02-17', '1');
INSERT INTO `movement_logs` VALUES ('7', '1', '2', '0', '0', '125', '0', '0', '1', '2023-02-17', '1');
INSERT INTO `movement_logs` VALUES ('8', '1', '2', '122', '0', '0', '0', '0', '1', '2023-02-17', '1');
INSERT INTO `movement_logs` VALUES ('9', '1', '2', '0', '123', '0', '0', '0', '1', '2023-02-17', '1');
INSERT INTO `movement_logs` VALUES ('10', '1', '2', '0', '0', '0', '0', '124', '1', '2023-02-17', '1');
INSERT INTO `movement_logs` VALUES ('11', '1', '2', '0', '0', '0', '0', '128', '1', '2023-02-17', '1');
INSERT INTO `movement_logs` VALUES ('12', '1', '2', '0', '0', '0', '0', '120', '1', '2023-02-17', '1');
INSERT INTO `movement_logs` VALUES ('13', '1', '2', '0', '0', '0', '0', '120', '1', '2023-02-17', '1');
INSERT INTO `movement_logs` VALUES ('14', '1', '2', '0', '0', '0', '0', '120', '1', '2023-02-17', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of production_logs
-- ----------------------------
INSERT INTO `production_logs` VALUES ('1', '2023-02-17', '16:46:12', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '1', 'bpuwb0hd442mwrepf8ke7isysl3pzgtr', 'Can', 'For Production', 'CAN00012', null, '10.00', '0', '9689.00', '0.00', '0.00', '0.00', '0', '1000.00', null, '6', '1', '0', '1', '0', null, null);
INSERT INTO `products` VALUES ('2', '1', '7greyb8ftz3lvs8rkmpytaxfe1npb92y', 'BU', 'ghbuhk', '8uh*(', null, '7890.00', '9879', '420.00', '300.00', '298.00', '0.00', '672', '98789.00', null, '23', '1', '1', '1', '1', '987', null);
INSERT INTO `products` VALUES ('3', '1', '6nlvcdbuqktondf8x278804tsezk9s3n', 'VOtin', 'For Prodction', 'V897', null, '100.00', '12', '0.00', '0.00', '0.00', '0.00', '0', '1000.00', null, '24', '1', '1', '1', '1', '12', null);
INSERT INTO `products` VALUES ('4', '1', 'ja3oe0iso070tg6edcm2hur2sngsdhsc', 'Valve', 'hhehe', 'v987', null, null, '0', '0.00', '0.00', '0.00', '0.00', '0', '19823.00', null, '25', '1', '0', '1', '0', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quantity_logs
-- ----------------------------
INSERT INTO `quantity_logs` VALUES ('1', '1', '1', '1', '102000', '2023-02-17 16:47:38', null);
INSERT INTO `quantity_logs` VALUES ('2', '1', '2', '1', '156', '2023-02-17 17:48:41', null);
INSERT INTO `quantity_logs` VALUES ('3', '1', '1', '1', '156', '2023-02-17 17:48:47', null);
INSERT INTO `quantity_logs` VALUES ('4', '1', '2', '1', '156', '2023-02-17 17:49:05', null);
INSERT INTO `quantity_logs` VALUES ('5', '1', '2', '1', '300', '2023-02-17 17:56:41', null);
INSERT INTO `quantity_logs` VALUES ('6', '1', '1', '1', '12', '2023-02-17 18:02:13', null);
INSERT INTO `quantity_logs` VALUES ('7', '1', '1', '1', '10000', '2023-02-17 18:02:25', null);
INSERT INTO `quantity_logs` VALUES ('8', '1', '2', '1', '120', '2023-02-17 18:02:37', null);
INSERT INTO `quantity_logs` VALUES ('9', '1', '2', '1', '120', '2023-02-17 18:02:58', null);
INSERT INTO `quantity_logs` VALUES ('10', '1', '2', '1', '10', '2023-02-17 18:05:59', null);
INSERT INTO `quantity_logs` VALUES ('11', '1', '2', '1', '144', '2023-02-17 18:15:04', null);
INSERT INTO `quantity_logs` VALUES ('12', '1', '2', '1', '144', '2023-02-17 18:15:10', null);
INSERT INTO `quantity_logs` VALUES ('13', '1', '2', '1', '154', '2023-02-17 18:15:21', null);
INSERT INTO `quantity_logs` VALUES ('14', '1', '2', '1', '154', '2023-02-17 18:15:30', null);
INSERT INTO `quantity_logs` VALUES ('15', '1', '2', '1', '144', '2023-02-17 18:16:12', null);
INSERT INTO `quantity_logs` VALUES ('16', '1', '2', '1', '60', '2023-02-17 18:16:18', null);
INSERT INTO `quantity_logs` VALUES ('17', '1', '2', '1', '120', '2023-02-17 18:16:34', null);
INSERT INTO `quantity_logs` VALUES ('18', '1', '2', '1', '60', '2023-02-17 18:16:58', null);
INSERT INTO `quantity_logs` VALUES ('19', '1', '1', '1', '100', '2023-02-17 18:17:16', null);
INSERT INTO `quantity_logs` VALUES ('20', '1', '2', '1', '125', '2023-02-17 18:17:44', null);
INSERT INTO `quantity_logs` VALUES ('21', '1', '2', '1', '122', '2023-02-17 18:17:56', null);
INSERT INTO `quantity_logs` VALUES ('22', '1', '2', '1', '123', '2023-02-17 18:18:07', null);
INSERT INTO `quantity_logs` VALUES ('23', '1', '2', '1', '124', '2023-02-17 18:18:17', null);
INSERT INTO `quantity_logs` VALUES ('24', '1', '2', '1', '128', '2023-02-17 18:18:23', null);
INSERT INTO `quantity_logs` VALUES ('25', '1', '2', '1', '120', '2023-02-17 18:28:06', null);
INSERT INTO `quantity_logs` VALUES ('26', '1', '2', '1', '120', '2023-02-17 18:28:36', null);
INSERT INTO `quantity_logs` VALUES ('27', '1', '2', '1', '120', '2023-02-17 18:28:47', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES ('1', '7rk7fh0kg7fb2gpust0hy5whknozsqmh', '1', '1', '1', '12343534534', '1', null, '1');
INSERT INTO `suppliers` VALUES ('2', 'udnk0ual3a93r0yjqgx8p3t1b1z1we7o', '1', '21', '23', '32323232323', null, null, '1');
INSERT INTO `suppliers` VALUES ('3', 'r2t1w6sdrtvk6l32ohhxy8zkrun6n7y9', '1', 'sdfcsdf', 'sdfsdfsd', '23123234232', null, null, '1');
INSERT INTO `suppliers` VALUES ('4', 'kupwj3yqgxq4adhel3rshstrjyueipxu', '1', '123', '123', '12312321321', null, null, '1');
INSERT INTO `suppliers` VALUES ('5', '9uceliu53mza0an1rei1o0o4vd26kzd6', '1', '232335345345', '345456456', '45645645645', null, null, '1');
INSERT INTO `suppliers` VALUES ('6', '81xk9pc67ilj3ir6ptb7e66bk2zgywp5', '1', 'Madayaw', 'IUNI', '09809534534', null, null, '1');
INSERT INTO `suppliers` VALUES ('7', 'rj5pynz7lwshdk16lsrrkuimdgqzbbes', '1', 'sup', '1231231231231231', '12342423423', null, null, '1');
INSERT INTO `suppliers` VALUES ('8', 'puuobeldcgelkj5ohgbkvowe8hcmennf', '1', 'sdf', 'sdf', '32312312321', 'sdfsfd', null, '1');
INSERT INTO `suppliers` VALUES ('9', 'zxqz7n0ee3kep841wipiwt8inxqgdvrt', '1', '12312wdf3', 'sdf', '24234234234', null, null, '1');
INSERT INTO `suppliers` VALUES ('10', 'h5jyfjd5k6aihvhnj11pqk73r3t187up', '1', 'saf', 'fds342', '23423434534', null, null, '1');
INSERT INTO `suppliers` VALUES ('11', '2oqixpqw72mzkq7r0h2nph5vvkq7lddk', '1', 'LOKO', 'BOGOKO', '09123667213', null, null, '1');
INSERT INTO `suppliers` VALUES ('12', '2p5voz1akqpux22r070waht3pb2jf3zb', '1', '123333dfsdfdfdf', '12312321', '12312321312', null, null, '1');
INSERT INTO `suppliers` VALUES ('13', 'tf7lt9qxo0qbj40w91102gbji61200u0', '1', 'sdf234234234234234', 'sdfsdf', '23423423423', null, null, '1');
INSERT INTO `suppliers` VALUES ('14', 'czx7ep9bxmlh7zs6sedmokb1gbyviyd8', '1', 'KOLO`', 'oijn', '98098098098', '9uh9', null, '1');
INSERT INTO `suppliers` VALUES ('15', '1swl6mby716qieyovuqww1cskpnqy5pz', '1', 'Mong', 'BUNalan', '78909786889', null, null, '1');
INSERT INTO `suppliers` VALUES ('16', 'raxhka7gr42esx2s2tbv7cke1uiobq3o', '1', 'sdfdsdfsdr345234', 'sdf', '23423423423', null, null, '1');
INSERT INTO `suppliers` VALUES ('17', 'jz031lnfir6i4ewiiw7ht2qm5x3u7ro5', '1', '123sdf324sdf234', 'asd', '21312321321', null, null, '1');
INSERT INTO `suppliers` VALUES ('18', 'v1z3q7gabay43msxyzhw8ru4oa0m844l', '1', 'hehe', 'hahh', '09782809123', null, null, '1');
INSERT INTO `suppliers` VALUES ('19', 'wsyfgg07718rjc9lbhkmutef4b63p11x', '1', 'jhbuh', '987n', '89098790798', null, null, '1');
INSERT INTO `suppliers` VALUES ('20', '3m1nyizsdkfppokaouvxnmgp8js990p4', '1', '123sdfsdfsd', 'sdfsdfsdff', '21321312321', 'fsdfsdfsdfsdf', null, '1');
INSERT INTO `suppliers` VALUES ('21', '5rdojvrs7xvgzhmo52w5m8v0wcgpgqol', '1', 'HYUOYUTR', 'ERT234', '12342134342', null, null, '1');
INSERT INTO `suppliers` VALUES ('22', 'wre976p7k4phwks0i3zqc7snmqvy7tvw', '1', 'Q', 'W', '23423423423', null, null, '1');
INSERT INTO `suppliers` VALUES ('23', 'ru0bkb6b0rws6kliuse5euneqvf5knas', '1', 'A', 'S', '23423423423', null, null, '1');
INSERT INTO `suppliers` VALUES ('24', '3bm1mynkn7yo8e5z92mzhofd129dq1mv', '1', 'heist', 'money', '09712312321', null, null, '1');
INSERT INTO `suppliers` VALUES ('25', 'deuu87fg0rk1ms74f2zq3v1l2361vb34', '1', 'sUNG', 'kANG', '09897234343', null, null, '1');

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
