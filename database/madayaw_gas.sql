/*
Navicat MySQL Data Transfer

Source Server         : server
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2023-02-14 13:18:56
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
  `cus_change` float DEFAULT NULL,
  `cus_accessibles` varchar(255) DEFAULT NULL,
  `cus_accessibles_prices` varchar(255) DEFAULT NULL,
  `cus_notes` varchar(255) DEFAULT NULL,
  `cus_image` varchar(255) DEFAULT NULL,
  `cus_active` tinyint(11) DEFAULT '1',
  PRIMARY KEY (`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('-1', '1', '', 'NOT SPECIFIED', 'NOT SPECIFIED', null, null, null, null, null, null, '1');
INSERT INTO `customers` VALUES ('0', '1', null, 'WALK IN', 'WALK IN', null, null, null, null, null, null, '1');
INSERT INTO `customers` VALUES ('1', '1', 'k2ffps6z9q3kdoq8a9v5f7sfptmie3xi', 'Raevin Jhon Palacio', 'Indangan, Davao City', '09876789876', null, null, null, 'Bugu ni sya bataa', '1.jpg', '1');
INSERT INTO `customers` VALUES ('2', '1', 'y7x0gpa9h0pidh1dzh2teaqbatmw740y', 'Klein Arandain', 'Baghdad, Bicol, Davao City', '09112345678', null, null, null, 'Gwenchanaeyo', '2.jpg', '1');
INSERT INTO `customers` VALUES ('3', '1', 'nzvhw6youarmhxy81sw759p999qjt97l', 'Kim Tae Hee', 'Seoulup, Davao Occidental', '09998789698', null, null, null, 'Korekong', '3.jpg', '1');
INSERT INTO `customers` VALUES ('38', '1', 'yx105wevbih5hfcxqlxa1r1jh0pmcrb5', 'Yllen Marquez', 'Toril, Davao Manila City Cebugay', '09998998765', null, null, null, 'gwapa', '38.jpg', '1');
INSERT INTO `customers` VALUES ('39', '1', 'zajnwmfcqz1rdt6rfep3k1cby9c2e1mp', 'Ylona Musk', 'New York Singapore', '09867557523', null, null, null, 'Budots', '39.jpg', '1');
INSERT INTO `customers` VALUES ('40', '1', '06ohp2x82zl91t1u70wr3og96u0v1wh9', 'GANI', 'iNAG', '09809890809', null, null, null, null, '40.jpg', '1');
INSERT INTO `customers` VALUES ('41', '1', 'z80bs6ipe21dwvakoin4a5asku6uz1c5', 'asas', 'asasa', '12321321321', null, null, null, null, null, '1');
INSERT INTO `customers` VALUES ('42', '1', 'vkv9ojmfnnhjge29sx41s4f6f1gdlve4', 'asdada', '234234234', '34234234234', null, null, null, null, null, '1');
INSERT INTO `customers` VALUES ('43', '1', 'u38hdqbdpai43jh49melxhzpfyy8lxz4', 'Segismundo', 'HIHIHI', '09890790182', null, null, null, null, '43.jpg', '1');
INSERT INTO `customers` VALUES ('44', '1', 'u6mj12uj3augbhco88dnr3lsrkjm6l53', 'Lee Joon Gi', 'Arthdal', '09877566756', null, null, null, null, null, '1');
INSERT INTO `customers` VALUES ('45', '1', 'rrtmausvrja4jv1y2g2wyz23cg52varu', 'Lee Seung Gi', 'Agdao', '09872342434', null, null, null, null, null, '1');
INSERT INTO `customers` VALUES ('46', '1', 'v1la2ny5eoqw9w9jurpd1c0gj0zhv92i', 'Song Hye Kyo', 'Malvar', '09856646464', null, null, null, null, null, '1');
INSERT INTO `customers` VALUES ('47', '1', 'nq0fzun6zg93a97l6qh26jxs72rntjzc', 'Jung Hae In', 'Bablok', '09097898789', null, null, null, null, null, '1');
INSERT INTO `customers` VALUES ('48', '1', 'fwcm46udocptbd9cci9dz9ayami0mh1q', '34534534', '345345345', '54345345345', null, null, null, null, null, '1');
INSERT INTO `customers` VALUES ('49', '1', 'm6s8ukdtda0tqn0akrcfx1h3h6vhbw8u', 'sdsdsd', '345345345', '54345345345', null, null, null, null, null, '1');
INSERT INTO `customers` VALUES ('50', '1', 'otjd79ssv5jq1utnncvtsht9rq82ov7m', 'Baby', 'NONO', '34323453453', null, null, null, null, null, '1');
INSERT INTO `customers` VALUES ('51', '1', '4dk7po8svvbm5sy4vvmj3fpcjcvzay32', 'Chloe Grace Moretz', 'New York', '22131232131', null, null, null, 'gwapa', '51.jpg', '1');
INSERT INTO `customers` VALUES ('52', '1', 'wogwtwtuz8xh6odvjugtmplllevqrkou', 'skalgy', 'Maplop', '09879878768', null, null, null, 'hahahah', null, '1');
INSERT INTO `customers` VALUES ('53', '1', 'yogv2zn56lq42cntyw5g43a7qazi8cpq', 'bambam', 'makmak', '09324242342', null, null, null, null, null, '1');
INSERT INTO `customers` VALUES ('54', '1', 'w23lrdly209omdzj0dysa6jgdvvso7m4', 'tetest', 'asdfa', '12313213123', null, null, null, null, null, '1');
INSERT INTO `customers` VALUES ('55', '1', '8j83vu0b2nre14hlpj3poiti7r225hci', 'testestestestest', 'testestestestest', '12312313131', null, '1, 3, ', null, null, null, '1');
INSERT INTO `customers` VALUES ('56', '1', 'ane878wuk7jdxlnya9oddgv4sfhgp76t', 'nightTest', 'nightTest', '12131231312', null, '1,3,8,9,', null, null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

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
  `ops_active` int(11) DEFAULT NULL,
  PRIMARY KEY (`ops_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of oppositions
-- ----------------------------
INSERT INTO `oppositions` VALUES ('1', null, 'sdfsdsf', 'sfsdffs', 'sfsdffs', '0', null, 'sfsdffs', '1', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of production_logs
-- ----------------------------
INSERT INTO `production_logs` VALUES ('1', '2022-12-07', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('2', '2022-12-07', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('3', '2022-12-09', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('4', '2022-12-09', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('5', '2022-12-09', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('6', '2022-12-09', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('7', '2022-12-09', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('8', '2022-12-09', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('9', '2022-12-09', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('10', '2022-12-09', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('11', '2022-12-09', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('12', '2022-12-09', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('13', '2022-12-09', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('14', '2022-12-09', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('15', '2022-12-09', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('16', '2022-12-12', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('17', '2022-12-12', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('18', '2022-12-12', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('19', '2022-12-12', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('20', '2022-12-13', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('21', '2022-12-13', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('22', '2022-12-14', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('23', '2022-12-14', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('24', '2022-12-14', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('25', '2022-12-14', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('26', '2022-12-14', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('27', '2022-12-14', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('28', '2022-12-14', null, '10:51:20');
INSERT INTO `production_logs` VALUES ('29', '2022-12-15', '06:02:43', '10:51:20');
INSERT INTO `production_logs` VALUES ('30', '2022-12-15', '06:02:53', '10:51:20');
INSERT INTO `production_logs` VALUES ('31', '2022-12-15', '06:03:12', '10:51:20');
INSERT INTO `production_logs` VALUES ('32', '2022-12-15', '06:07:40', '10:51:20');
INSERT INTO `production_logs` VALUES ('33', '2022-12-15', '14:08:00', '10:51:20');
INSERT INTO `production_logs` VALUES ('34', '2022-12-15', '14:08:08', '10:51:20');
INSERT INTO `production_logs` VALUES ('35', '2022-12-15', '14:50:47', '10:51:20');
INSERT INTO `production_logs` VALUES ('36', '2022-12-15', '14:54:57', '10:51:20');
INSERT INTO `production_logs` VALUES ('37', '2023-01-04', '09:50:47', '10:51:20');
INSERT INTO `production_logs` VALUES ('38', '2023-01-04', '10:04:54', '10:51:20');
INSERT INTO `production_logs` VALUES ('39', '2023-01-04', '11:25:42', '10:51:20');
INSERT INTO `production_logs` VALUES ('40', '2023-01-04', '11:27:20', '10:51:20');
INSERT INTO `production_logs` VALUES ('41', '2023-01-06', '12:04:03', '10:51:20');
INSERT INTO `production_logs` VALUES ('42', '2023-01-10', '13:17:10', '10:51:20');
INSERT INTO `production_logs` VALUES ('43', '2023-01-12', '11:03:55', '10:51:20');
INSERT INTO `production_logs` VALUES ('44', '2023-01-12', '17:08:44', '10:51:20');
INSERT INTO `production_logs` VALUES ('45', '2023-01-12', '17:09:16', '10:51:20');
INSERT INTO `production_logs` VALUES ('46', '2023-01-13', '10:24:44', '10:51:20');
INSERT INTO `production_logs` VALUES ('47', '2023-01-16', '09:41:07', '10:51:20');
INSERT INTO `production_logs` VALUES ('48', '2023-01-19', '14:13:05', '10:51:20');
INSERT INTO `production_logs` VALUES ('49', '2023-01-25', '14:50:54', '10:51:20');
INSERT INTO `production_logs` VALUES ('50', '2023-01-26', '12:25:52', '10:51:20');
INSERT INTO `production_logs` VALUES ('51', '2023-01-26', '16:31:51', '10:51:20');
INSERT INTO `production_logs` VALUES ('52', '2023-01-26', '16:32:00', '10:51:20');
INSERT INTO `production_logs` VALUES ('53', '2023-01-26', '16:32:12', '10:51:20');
INSERT INTO `production_logs` VALUES ('54', '2023-01-26', '16:32:47', '10:51:20');
INSERT INTO `production_logs` VALUES ('55', '2023-01-26', '16:47:07', '10:51:20');
INSERT INTO `production_logs` VALUES ('56', '2023-01-26', '16:47:24', '10:51:20');
INSERT INTO `production_logs` VALUES ('57', '2023-01-26', '16:48:03', '10:51:20');
INSERT INTO `production_logs` VALUES ('58', '2023-01-26', '16:48:27', '10:51:20');
INSERT INTO `production_logs` VALUES ('59', '2023-01-27', '11:21:27', '10:51:20');
INSERT INTO `production_logs` VALUES ('60', '2023-01-27', '11:33:01', '10:51:20');
INSERT INTO `production_logs` VALUES ('61', '2023-01-27', '11:39:05', '10:51:20');
INSERT INTO `production_logs` VALUES ('62', '2023-02-03', '11:01:30', '10:51:20');
INSERT INTO `production_logs` VALUES ('63', '2023-02-03', '11:10:00', '10:51:20');
INSERT INTO `production_logs` VALUES ('64', '2023-02-07', '16:36:11', '10:51:20');
INSERT INTO `production_logs` VALUES ('65', '2023-02-07', '16:37:02', '10:51:20');
INSERT INTO `production_logs` VALUES ('66', '2023-02-09', '10:51:23', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '1', 'v8ekyfm1otz5574togwczrlv8bckqcgn', 'Botin', 'Can', 'TFY86', null, '150.00', '50', '8.00', '0.00', '169.00', '0.00', '0', '10.00', null, '2', '1', '1', '1', '1', '170', null);
INSERT INTO `products` VALUES ('2', '1', 'j0tvnf2d1nxh336618ovmj168ot5c9up', 'Gas Stove', 'Single Burner', 'GHG87678', null, '2000.00', '0', '44.00', '0.00', '233.00', '0.00', '0', '50.00', null, '3', '1', '0', '0', '1', '100', null);
INSERT INTO `products` VALUES ('3', '1', 'sign3b6inu2a58tl13njkh03g1fkmxyg', 'Madayaw Round', 'Round Butane Can', 'TEST0123456789', null, '20.00', '100', '95.00', '4.00', '233.00', '22.00', '18', '50.00', null, '47', '1', '1', '1', '1', '170', null);
INSERT INTO `products` VALUES ('4', '1', 'ij1wajgnaj5z06aujgqv36ins9urm2u9', 'Butane Cap', 'Cap for the butane cans', 'TESTC4P4BU74N3', null, '0.50', '50', '14808.00', '0.00', '19.00', '0.00', '0', '2000.00', null, '47', '1', '0', '1', '0', '170', null);
INSERT INTO `products` VALUES ('5', '1', 'xd6wsvy4yablidejcak1knk8ruqv1tm3', 'Butane Can', 'can for butane', 'TESTC4N4BU74N3', null, '2.00', '50', '9795.00', '0.00', '19.00', '0.00', '0', '5000.00', null, '2', '1', '0', '1', '0', null, null);
INSERT INTO `products` VALUES ('6', '1', '0a0vbc4af603skdaa857ucqxz7m4tm2n', 'Butane Valve', 'valve for the butane cans', 'TESTV4LV34BU74N3', null, '3.00', '50', '9794.00', '0.00', '19.00', '0.00', '0', '5000.00', null, '52', '1', '0', '1', '0', null, null);
INSERT INTO `products` VALUES ('7', '1', 'z2lv0fmn11wd3j6ximnk82bysx7a3r38', 'Secret', 'For Canister', 'SEC878978', null, '800.00', '50', '9807.00', '0.00', '19.00', '0.00', '0', '100.00', null, '52', '1', '0', '1', '0', null, null);
INSERT INTO `products` VALUES ('8', '1', '8r9f0dor9l4px2fprrpas1jre4ddqeh2', 'Madayaw Square', 'bangga Buto', 'MNAS87678', null, '150.00', '50', '7.00', '0.00', '23.00', '1.00', '5', '0.00', null, '4', '1', '1', '1', '1', '17', null);
INSERT INTO `products` VALUES ('9', '1', 'xaf1j0efoh6uvy8rqxoxhlgwfvql1dc4', 'tesWeight', 'testforweight', 'TWNEN325132', null, '232.00', '50', '0.00', '0.00', '0.00', '0.00', '0', '2000.00', null, '1', '1', '1', '1', null, '17', null);
INSERT INTO `products` VALUES ('10', '1', 'hx5q5g7qbaaozcs2dku49hxoczq7no90', 'Tripler', 'gg', 'TR897234', null, '60.00', '50', '0.00', '0.00', '0.00', '0.00', '0', '45555.00', null, '1', '1', '0', '1', null, null, null);
INSERT INTO `products` VALUES ('11', '1', 'ndasdgvjgabu362sejolqrsarqzrlhe1', 'Madayaw Triangle', 'MT018230705970580MT018230705970580', 'MT018230705970580', null, '170.00', '50', '0.00', '0.00', '0.00', '0.00', '0', '2000.00', null, '1', '1', '1', '1', null, null, null);
INSERT INTO `products` VALUES ('12', '1', 'lw6v6d61xsqhc4giyesbj8pkokbmsaib', 'Madayaw Oblong', 'For Canister', 'OBKLG768', null, '100.00', '100', '950.00', '0.00', '50.00', '0.00', '0', '100.00', null, '2', '1', '1', '1', '1', '140', null);
INSERT INTO `products` VALUES ('13', '1', 'z3j0lbywcvq3osq87cqxribe2i2hfvv2', 'Tripler', 'BUGU', 'TUI876', null, null, null, '0.00', '0.00', '0.00', '0.00', '0', null, null, null, '1', '1', '1', null, null, null);
INSERT INTO `products` VALUES ('14', '1', '8gjyl8geie8z5f1retzt18eavn4id1da', 'Madayaw Rectangle', 'BOGO', 'RE767923', null, '120.00', '100', '1000.00', '0.00', '0.00', '0.00', '0', '1000.00', null, '3', '1', '1', '1', null, '147', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of purchases
-- ----------------------------
INSERT INTO `purchases` VALUES ('1', '1', '3', '2', '1', '100.00', '600.00', '25', '20.00', '2', '0');
INSERT INTO `purchases` VALUES ('2', '1', '2', '0', '1', '0.00', '2000.00', '1', '2000.00', '0', '0');
INSERT INTO `purchases` VALUES ('3', '1', '1', '1', '3', '100.00', '2350.00', '15', '150.00', '1', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quantity_logs
-- ----------------------------
INSERT INTO `quantity_logs` VALUES ('1', '1', '2', null, '1', '2022-11-14 00:00:00', null);
INSERT INTO `quantity_logs` VALUES ('2', '1', '2', null, '2', '2022-11-14 00:00:00', null);
INSERT INTO `quantity_logs` VALUES ('3', '1', '2', '1', '2', '2022-11-18 10:43:25', null);
INSERT INTO `quantity_logs` VALUES ('4', '1', '2', '1', '-54', '2022-11-18 11:11:24', null);
INSERT INTO `quantity_logs` VALUES ('5', '1', '2', '1', '-100', '2022-11-18 11:23:53', null);
INSERT INTO `quantity_logs` VALUES ('6', '1', '2', '1', '200', '2022-11-18 11:24:53', null);
INSERT INTO `quantity_logs` VALUES ('7', '1', '2', '1', '-100', '2022-11-18 11:25:01', null);
INSERT INTO `quantity_logs` VALUES ('8', '1', '1', '1', '500', '2022-11-18 16:54:03', null);
INSERT INTO `quantity_logs` VALUES ('9', '1', '1', '1', '1500', '2022-11-21 14:10:48', null);
INSERT INTO `quantity_logs` VALUES ('10', '1', '2', '1', '50', '2022-11-22 12:44:26', null);
INSERT INTO `quantity_logs` VALUES ('11', '1', '4', '1', '15000', '2022-12-09 14:45:22', null);
INSERT INTO `quantity_logs` VALUES ('12', '1', '4', '1', '1', '2022-12-12 10:09:08', null);
INSERT INTO `quantity_logs` VALUES ('13', '1', '4', '1', '1', '2022-12-12 10:09:14', null);
INSERT INTO `quantity_logs` VALUES ('14', '1', '3', '1', '1', '2022-12-12 10:09:26', null);
INSERT INTO `quantity_logs` VALUES ('15', '1', '3', '1', '1', '2022-12-12 10:25:39', null);
INSERT INTO `quantity_logs` VALUES ('16', '1', '3', '1', '1', '2022-12-12 10:26:25', null);
INSERT INTO `quantity_logs` VALUES ('17', '1', '3', '1', '1', '2022-12-12 10:26:34', null);
INSERT INTO `quantity_logs` VALUES ('18', '1', '3', '1', '1', '2022-12-12 14:50:08', null);
INSERT INTO `quantity_logs` VALUES ('19', '1', '3', '1', '1', '2022-12-12 14:50:36', null);
INSERT INTO `quantity_logs` VALUES ('20', '1', '3', '1', '1', '2022-12-12 14:50:56', null);
INSERT INTO `quantity_logs` VALUES ('21', '1', '3', '1', '1', '2022-12-12 14:53:17', null);
INSERT INTO `quantity_logs` VALUES ('22', '1', '3', '1', '1', '2022-12-12 14:53:49', null);
INSERT INTO `quantity_logs` VALUES ('23', '1', '8', '1', '22', '2022-12-12 16:13:14', null);
INSERT INTO `quantity_logs` VALUES ('24', '1', '5', '1', '10000', '2022-12-12 16:13:25', null);
INSERT INTO `quantity_logs` VALUES ('25', '1', '6', '1', '10000', '2022-12-12 16:13:27', null);
INSERT INTO `quantity_logs` VALUES ('26', '1', '7', '1', '10000', '2022-12-12 16:13:30', null);
INSERT INTO `quantity_logs` VALUES ('27', '1', '8', '1', '22', '2022-12-12 16:13:34', null);
INSERT INTO `quantity_logs` VALUES ('28', '1', '3', '1', '20', '2022-12-13 10:57:53', null);
INSERT INTO `quantity_logs` VALUES ('29', '1', '3', '1', '10', '2022-12-13 11:12:06', null);
INSERT INTO `quantity_logs` VALUES ('30', '1', '3', '1', '2', '2022-12-13 11:32:30', null);
INSERT INTO `quantity_logs` VALUES ('31', '1', '3', '1', '2', '2022-12-13 11:32:54', null);
INSERT INTO `quantity_logs` VALUES ('32', '1', '3', '1', '1', '2022-12-13 11:33:07', null);
INSERT INTO `quantity_logs` VALUES ('33', '1', '3', '1', '2', '2022-12-13 15:57:14', null);
INSERT INTO `quantity_logs` VALUES ('34', '1', '3', '1', '2', '2022-12-13 15:57:24', null);
INSERT INTO `quantity_logs` VALUES ('35', '1', '3', '1', '2', '2022-12-13 15:57:31', null);
INSERT INTO `quantity_logs` VALUES ('36', '1', '3', '1', '1', '2022-12-13 16:00:34', null);
INSERT INTO `quantity_logs` VALUES ('37', '1', '8', '1', '1', '2022-12-13 16:18:10', null);
INSERT INTO `quantity_logs` VALUES ('38', '1', '8', '1', '2', '2022-12-13 16:25:28', null);
INSERT INTO `quantity_logs` VALUES ('39', '1', '8', '1', '1', '2022-12-13 16:25:31', null);
INSERT INTO `quantity_logs` VALUES ('40', '1', '8', '1', '1', '2022-12-13 16:25:40', null);
INSERT INTO `quantity_logs` VALUES ('41', '1', '3', '1', '1', '2022-12-13 16:25:44', null);
INSERT INTO `quantity_logs` VALUES ('42', '1', '3', '1', '1', '2022-12-13 16:25:55', null);
INSERT INTO `quantity_logs` VALUES ('43', '1', '8', '1', '24', '2022-12-13 16:27:27', null);
INSERT INTO `quantity_logs` VALUES ('44', '1', '8', '1', '1', '2022-12-13 16:30:47', null);
INSERT INTO `quantity_logs` VALUES ('45', '1', '8', '1', '1', '2022-12-13 16:31:01', null);
INSERT INTO `quantity_logs` VALUES ('46', '1', '8', '1', '1', '2022-12-13 16:32:07', null);
INSERT INTO `quantity_logs` VALUES ('47', '1', '8', '1', '1', '2022-12-13 16:33:24', null);
INSERT INTO `quantity_logs` VALUES ('48', '1', '8', '1', '1', '2022-12-13 16:34:00', null);
INSERT INTO `quantity_logs` VALUES ('49', '1', '3', '1', '2', '2022-12-14 17:45:20', null);
INSERT INTO `quantity_logs` VALUES ('50', '1', '3', '1', '2', '2022-12-15 14:55:11', null);
INSERT INTO `quantity_logs` VALUES ('51', '1', '3', '1', '1', '2023-01-04 10:06:12', null);
INSERT INTO `quantity_logs` VALUES ('52', '1', '3', '1', '1', '2023-01-04 10:08:04', null);
INSERT INTO `quantity_logs` VALUES ('53', '1', '3', '1', '1', '2023-01-04 10:11:29', null);
INSERT INTO `quantity_logs` VALUES ('54', '1', '7', '1', '12', '2023-01-11 15:10:53', '42');
INSERT INTO `quantity_logs` VALUES ('55', '1', '4', '1', '10', '2023-01-13 10:25:12', '46');
INSERT INTO `quantity_logs` VALUES ('56', '1', '3', '1', '1', '2023-01-13 10:26:44', '46');
INSERT INTO `quantity_logs` VALUES ('57', '1', '3', '1', '12', '2023-01-13 10:29:55', '46');
INSERT INTO `quantity_logs` VALUES ('58', '1', '3', '1', '144', '2023-01-13 10:30:59', '46');
INSERT INTO `quantity_logs` VALUES ('59', '1', '8', '1', '24', '2023-01-13 11:01:49', '46');
INSERT INTO `quantity_logs` VALUES ('60', '1', '8', '1', '24', '2023-01-13 11:02:01', '46');
INSERT INTO `quantity_logs` VALUES ('61', '1', '3', '1', '1', '2023-01-13 11:19:54', '46');
INSERT INTO `quantity_logs` VALUES ('62', '1', '3', '1', '1', '2023-01-17 11:08:45', '47');
INSERT INTO `quantity_logs` VALUES ('63', '1', '3', '1', '1', '2023-01-17 11:08:56', '47');
INSERT INTO `quantity_logs` VALUES ('64', '1', '3', '1', '1', '2023-01-17 11:09:03', '47');
INSERT INTO `quantity_logs` VALUES ('65', '1', '12', '1', '1000', '2023-02-09 11:01:25', '66');
INSERT INTO `quantity_logs` VALUES ('66', '1', '1', '1', '1', '2023-02-09 14:49:24', '66');
INSERT INTO `quantity_logs` VALUES ('67', '1', '3', '1', '1', '2023-02-09 14:49:45', '66');
INSERT INTO `quantity_logs` VALUES ('68', '1', '3', '1', '1', '2023-02-09 14:50:28', '66');
INSERT INTO `quantity_logs` VALUES ('69', '1', '3', '1', '1', '2023-02-09 14:51:29', '66');
INSERT INTO `quantity_logs` VALUES ('70', '1', '3', '1', '1', '2023-02-09 15:43:51', '66');
INSERT INTO `quantity_logs` VALUES ('71', '1', '3', '1', '1', '2023-02-09 15:44:03', '66');
INSERT INTO `quantity_logs` VALUES ('72', '1', '3', '1', '1', '2023-02-09 15:45:00', '66');
INSERT INTO `quantity_logs` VALUES ('73', '1', '3', '1', '1', '2023-02-09 15:45:22', '66');
INSERT INTO `quantity_logs` VALUES ('74', '1', '3', '1', '1', '2023-02-09 15:48:11', '66');
INSERT INTO `quantity_logs` VALUES ('75', '1', '3', '1', '1', '2023-02-09 15:48:52', '66');
INSERT INTO `quantity_logs` VALUES ('76', '1', '3', '1', '1', '2023-02-09 15:49:32', '66');
INSERT INTO `quantity_logs` VALUES ('77', '1', '3', '1', '1', '2023-02-09 15:59:44', '66');
INSERT INTO `quantity_logs` VALUES ('78', '1', '3', '1', '1', '2023-02-09 16:00:02', '66');
INSERT INTO `quantity_logs` VALUES ('79', '1', '3', '1', '1', '2023-02-09 16:17:18', '66');
INSERT INTO `quantity_logs` VALUES ('80', '1', '3', '1', '1', '2023-02-09 16:39:47', '66');
INSERT INTO `quantity_logs` VALUES ('81', '1', '3', '1', '120', '2023-02-10 11:43:10', '66');
INSERT INTO `quantity_logs` VALUES ('82', '1', '1', '1', '-2326', '2023-02-10 12:35:35', '66');
INSERT INTO `quantity_logs` VALUES ('83', '1', '14', '1', '900', '2023-02-10 13:46:42', '66');
INSERT INTO `quantity_logs` VALUES ('84', '1', '14', '1', '100', '2023-02-10 13:46:54', '66');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sales_reports
-- ----------------------------
INSERT INTO `sales_reports` VALUES ('1', '-1', '1', '1', '0', '150', null, '42');
INSERT INTO `sales_reports` VALUES ('2', '-1', '2', '1', '0', '2000', null, '42');
INSERT INTO `sales_reports` VALUES ('3', '-1', '2', '1', '0', '2000', null, '42');
INSERT INTO `sales_reports` VALUES ('4', '-1', '2', '1', '0', '2000', null, '42');
INSERT INTO `sales_reports` VALUES ('5', '-1', '2', '1', '0', '2000', '11:07:01', '43');
INSERT INTO `sales_reports` VALUES ('6', '-1', '2', '1', '0', '2000', '11:07:33', '43');
INSERT INTO `sales_reports` VALUES ('7', '-1', '2', '1', '0', '2000', '11:07:36', '43');
INSERT INTO `sales_reports` VALUES ('8', '-1', '1', '1', '0', '150', '11:08:03', '43');
INSERT INTO `sales_reports` VALUES ('9', '-1', '1', '1', '0', '150', '00:28:09', '45');
INSERT INTO `sales_reports` VALUES ('10', '-1', '1', '1', '0', '150', '00:44:51', '45');
INSERT INTO `sales_reports` VALUES ('11', '-1', '2', '1', '0', '2000', '09:44:05', '48');
INSERT INTO `sales_reports` VALUES ('12', '-1', '3', '12', '0', '240', '14:54:59', '48');
INSERT INTO `sales_reports` VALUES ('13', '-1', '1', '12', '0', '1800', '14:55:45', '48');
INSERT INTO `sales_reports` VALUES ('14', '-1', '3', '2', '0', '40', '17:16:40', '48');
INSERT INTO `sales_reports` VALUES ('15', '-1', '2', '1', '0', '2000', '17:24:25', '48');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stockin_logs
-- ----------------------------
INSERT INTO `stockin_logs` VALUES ('1', '1', '2', '1', '0', '0', '0', '0', '2022-11-14');
INSERT INTO `stockin_logs` VALUES ('2', '1', '2', '2', '0', '0', '0', '0', '2022-11-14');

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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES ('1', 'knr6r0cayz618439dmo6zwzs086jy8xq', '1', 'Others', 'Unknown', '00000000000', 'This is for other products', '1.jpg', '1');
INSERT INTO `suppliers` VALUES ('2', 'lmv0pb2q8b9f9ovlf8ue90y64v9lat0v', '1', 'Escobar Cartel', 'Cra 8 No. 10 - 65 Bogotá Colombia', '09876567823', 'Adik bataa', null, '1');
INSERT INTO `suppliers` VALUES ('3', 'nhshp4dlwwvc6kihy4au8j92osgcvppw', '1', 'El Chapo', 'Columbia Candy Factory', '09876999923', 'Bugu gani', null, '1');
INSERT INTO `suppliers` VALUES ('4', 'u0d65yfcowz0wmfxk9w3k9mn9bbzm3lf', '1', 'Botin', 'Mawab, Davao de Oro', '09999777665', 'Gas ni sya', null, '1');
INSERT INTO `suppliers` VALUES ('5', 'ou4u5h59kt4fdbyuaedxcckmgy478w98', '1', 'Juan Paasa`', 'Cebu City', '09123123123', null, null, '1');
INSERT INTO `suppliers` VALUES ('45', 'ixo2hx540ymeq4ioskqetoxkgpfahzfq', '1', 'John Woke', 'Baghdad, Samar', '09876789889', null, null, '1');
INSERT INTO `suppliers` VALUES ('46', 'v8o56g7v4m3wt5g7g0mbu1qzgqohdpri', '1', 'Underground', 'Oyaji', '09877866544', 'Ayaw tandoga', null, '1');
INSERT INTO `suppliers` VALUES ('47', 'uwvsgqmf217g78i9143jos8mi8at2nr6', '1', 'TestSupplier', 'ITPark', '12312312312', null, null, '1');
INSERT INTO `suppliers` VALUES ('48', 'dlp800ob6nf4cenn9gd2e00d7c7fhphp', '1', 'Hamal', 'Cra 8 No. 10 - 65 Bogotá Colombia', '45678676597', null, null, '1');
INSERT INTO `suppliers` VALUES ('49', '4jlage99qhp9kfy9dwq8un0d0z89x8ci', '1', 'marjkk', 'sdf', '34433454354', null, null, '1');
INSERT INTO `suppliers` VALUES ('50', 'q6j3m56b827ihzkfobxdgut8fwj85inm', null, 'Nigs', 'Indangs', '91951951951', null, null, '1');
INSERT INTO `suppliers` VALUES ('51', '3nqd5rymh6lzjhaj6wvml1f9xhog0lz8', null, 'Russel', 'Uyanguren', '23132313123', null, null, '1');
INSERT INTO `suppliers` VALUES ('52', 'ep47tgxeztpdmuoyond0hnwzn52xf60m', '1', 'Narval Cartel', 'Malagos, Calinan, Toril, Mintal, Tugbok, Makilala, Cebugay, Digos, Davao Oriental', '09867675675', 'Adik ni sya', null, '1');
INSERT INTO `suppliers` VALUES ('53', 'jhv5tyiysf1epomioqj2uhdkgadi6swh', '1', 'TEST', 'INFINIT', '09103901293', null, null, '1');
INSERT INTO `suppliers` VALUES ('54', 'ppde3byagqemb60r9hc04c207xznnyf5', '1', null, null, null, null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES ('1', '20230214-1', '1', '1', '-1', '2023-02-14 11:58:27', '2023-02-14', '11:58:27', '5000', '50', '4950');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', 'ewx58n5e6syi8vqj9t2cix1urygehofa', 'Kim Ji Won', 'kimjiwon', 'c17b6630268dbe52c5cf042327a7e65a', 'Seoul Tann Kudarat, South Kortabato', '1.png', '1', '1');
INSERT INTO `users` VALUES ('2', '1', 's3anhknpd87r3fbdx0icyrq6nm99xr67', 'Xabara Satirani', 'xabara', '0425fd883a2436611041284f0fd3c1b2', 'Jubinol', '2.jpg', '1', '2');
INSERT INTO `users` VALUES ('3', '1', 'lv8r2fyf3gstlyp3o06l9k6fbbs4oh2k', 'Yoo In Na', 'yooinah', 'f9ed4bdb724da4c8ff4f643641335e9b', 'Toodongie Jang, Seoul, South Korea', '3.jpg', '1', '3');
INSERT INTO `users` VALUES ('4', '1', 'c238f96ny7lpt1kcmmsxmk6ru753r2kl', 'Kim Hee Ae', 'kimheeae', '65e63fefb00486abd78b96729ff6f7c6', 'Seoultan Kudarat, Manila, Philippines', '4.jpg', '0', '2');
INSERT INTO `users` VALUES ('5', '1', 'xxtal1sdqp1ww8fx5tuk20tv7l2rqq9s', 'Son Ye Ji', 'sonyeji', 'bf5e60282c1176ba438c7fcaa2bb6fd7', 'Iran Iwalk', null, '1', '3');
INSERT INTO `users` VALUES ('6', '1', '826hl7u51lvi1ko8yfzy9vvat65j9aiu', 'Chloe Grace Moretz', 'cgmoretz', '16291f5d11553b3e71104d6ac7f5ae41', 'America', '6.jpg', '1', '2');
INSERT INTO `users` VALUES ('7', '1', 'ha3egb7wywbs30yvmnsfij9rs2148ce1', 'Ma Dong Sok', 'madongsok', '90514a444e03185e003b08ede2dcf706', 'Incheon, Quirino St., Davao City, Philippines', '7.jpg', '1', '2');

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
