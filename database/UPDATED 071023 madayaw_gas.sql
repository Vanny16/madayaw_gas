/*
Navicat MySQL Data Transfer

Source Server         : server
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2023-07-10 19:25:45
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
  PRIMARY KEY (`acc_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

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
  PRIMARY KEY (`bo_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of bad_orders
-- ----------------------------
INSERT INTO `bad_orders` VALUES ('1', 'BO-20230601-1', '1', '3', '3', null, '3', '2023-06-01', '09:41:41', '2023-06-01 09:41:41');
INSERT INTO `bad_orders` VALUES ('2', 'BO-20230705-2', '1', '32', '3', null, '6', '2023-07-05', '06:17:10', '2023-07-05 06:17:10');

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
  `cus_price_change` double DEFAULT '0',
  `cus_accessibles` varchar(255) DEFAULT NULL,
  `cus_accessibles_prices` varchar(255) DEFAULT NULL,
  `cus_notes` varchar(255) DEFAULT NULL,
  `cus_image` varchar(255) DEFAULT NULL,
  `cus_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`cus_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', '1', '75z80q62059nbvtkvjc67v5znfz7fuvt', 'ADON', 'TORIL', '09566873302', '5', '3,5,6,', '16.50,16.50,440.00,', null, null, '1');
INSERT INTO `customers` VALUES ('2', '1', '3voy1ywbhwp2nec9162sl9pghs1u3u4p', 'ALONA', 'TAGUM', '09916527682', '0', '5,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('3', '1', '3wgy3d8gytzgvcwuz1nethf848d4v7p1', 'ALFRED SANTOS', 'SAMAL', '09982384646', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('4', '1', 'wreed94l2izxkq2q2m1x1r9xco49xcm7', 'APEIRON', 'TIGATTO, DAVAO CITY', '09279986820', '0', '3,4,', '16.50,16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('5', '1', 'lf1xvkjqqgow8rmahpgpf45ixdyq16je', 'BRGY. SAN ISIDRO', 'BRGY. SAN ISIDRO', '09678252501', '0', '3,4,', '16.50,16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('6', '1', '4q5yustf03fecoquqvn4r26c8aio7e76', 'CHECHE RTW', 'BRGY ILANG', '09307702777', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('7', '1', 'g4q185nsmlsqc3kx5pvgrmwl1tkkz3wx', 'DENNIS DAGONDON', 'COMMUNAL BUHANGIN', '09171881973', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('8', '1', 'er8bbhagbov9e76mopltlst4tzhxy3f1', 'DUDZ', 'SASA', '09959025762', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('9', '1', 'u88tb8godfwncx2ypec0gf9rhm513u19', 'FUELSOURCE', 'DIGOS', '09111111111', '0', '3,4,', '16.50,16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('10', '1', '0kupfw5owjebk1u357da19ki9doea7ps', 'DJV LPG CENTER', 'DIGOS CITY', '09066780227', '0', '3,', '14,', null, null, '1');
INSERT INTO `customers` VALUES ('11', '1', '09h5jxjsamxmotb23v370txthh3pzuvo', 'JOSIE CUYOS', 'BRGY SAN ISIDRO', '09486617966', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('12', '1', 't0opbcngljhleibjcaw7kz7txk4cnzwu', 'KENZOVAN', 'BUHANGIN', '09111111111', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('13', '1', '8xvfpbkg4gtxejrxws2qimzk4xb6aegm', 'REY CANTILLAS', 'PANACAN', '09067656906', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('14', '1', 'u44xooxs3yppj9ml8l9x6l8u9ye649n2', 'ROBERT MANDANAO', 'SASA', '09813635475', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('15', '1', 'w8k1k7cb22aef0wklmfvz09nmebj7vj4', 'ROMY FERNANDEZ', 'CATEEL', '09171921402', '0', '3,4,', '16.50,16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('16', '1', 'mfvbtelasbqw2eatpfn20wik9ydrx4kt', 'WILSON MALUMBAGA', 'PANACAN', '09926956912', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('17', '1', '3i43ayg3o8cufmuh5oc5faxhk847djh4', '(WALK-IN)', 'XXXXXXXX', '11111111111', '0', '3,4,5,', '20,20,20,', null, null, '1');
INSERT INTO `customers` VALUES ('18', '1', '2b7sqnhl95rvi0svrhp054d0cdd5y9da', '(HOUSE)', 'LANANG', '11111111111', '0', '3,4,', '16.50,16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('19', '1', 'i8wmzlus8jpv5148t624iiq1o6nhsi9u', 'ALFREDO ALCE', 'PRK. 13 TIBUNGCO', '09094702448', '0', '3,', '18,', null, null, '1');
INSERT INTO `customers` VALUES ('20', '1', '3gxmpz72gbjnh61sarregkh1g11wwhsl', 'ROLAN REYES', 'MAHAYAG,BUNAWAN', '09093839344', '0', '3,', '18,', null, null, '1');
INSERT INTO `customers` VALUES ('21', '1', '9wej1cucm5riy86owos4syfac346oaiu', 'HLI', 'SASA', '0999999999', '0', '3,', '18,', null, null, '1');
INSERT INTO `customers` VALUES ('22', '1', 'o4ez3wtwvp62rvp9i1prjnn7axzx5e52', 'GEORGE/ROLAN', 'CRYSTAL MEADOWS,SASA', '09292979703', '0', '3,4,', '19.60,19.60,', null, null, '1');
INSERT INTO `customers` VALUES ('23', '1', '21a25heqso3nplynndeac3mb0qm7690r', 'ROMY TARZO', 'SASA STORE/ PANACAN MALAGAMOT DROP', '09467432991', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('24', '1', 'vp85xzmn3u8cks357wlnti62xhtjzhpt', 'OROGATES', 'KM 10 SASA DAVAO CITY', '09177775909', '0', '7,8,9,', '601.87,601.87,2631.00,', null, null, '1');
INSERT INTO `customers` VALUES ('25', '1', 'e39sb1lfeo6cnrshejrwm5eghc4vbm9t', 'JUNE COSTILLAS', 'DAVAO', '09111111111', '0', '3,4,', '17,17,', null, null, '1');
INSERT INTO `customers` VALUES ('26', '1', 'emuirv7xqpn1lx4zi2cvnrlent1xcauf', 'HENRY ANG', 'DAVAO', '09111111111', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('27', '1', '2frf15i9uogksbgih2qkvjvt35juv87b', 'FREDDIE ALCE', 'DAVAO', '09111111111', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('28', '1', 'jwujgcqfmk4zfyxjbi45gkvnm7dm8fie', 'RONALD BANOG', 'DAVAO', '09111111111', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('29', '1', '5wsscz00klkfzeasw2tc9udv7di8srnb', 'ORLIE BANQUIL', 'DAVAO', '09111111111', '0', '3,', '16.50,', null, null, '1');

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
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of movement_logs
-- ----------------------------
INSERT INTO `movement_logs` VALUES ('1', '1', '3', '0', '0', '9503', '0', '0', '1', '2023-06-02', '1');
INSERT INTO `movement_logs` VALUES ('2', '1', '4', '0', '0', '12799', '0', '0', '1', '2023-06-02', '1');
INSERT INTO `movement_logs` VALUES ('3', '1', '5', '0', '0', '1145', '0', '0', '1', '2023-06-02', '1');
INSERT INTO `movement_logs` VALUES ('4', '1', '3', '0', '0', '864', '0', '0', '1', '2023-06-02', '1');
INSERT INTO `movement_logs` VALUES ('5', '1', '4', '0', '0', '209', '0', '0', '1', '2023-06-02', '1');
INSERT INTO `movement_logs` VALUES ('6', '1', '5', '0', '0', '995', '0', '0', '1', '2023-06-02', '1');
INSERT INTO `movement_logs` VALUES ('7', '1', '3', '7210', '0', '0', '0', '0', '1', '2023-06-02', '1');
INSERT INTO `movement_logs` VALUES ('8', '1', '4', '1799', '0', '0', '0', '0', '1', '2023-06-02', '1');
INSERT INTO `movement_logs` VALUES ('9', '1', '5', '2131', '0', '0', '0', '0', '1', '2023-06-02', '1');
INSERT INTO `movement_logs` VALUES ('10', '1', '3', '0', '864', '0', '0', '0', '1', '2023-06-02', '1');
INSERT INTO `movement_logs` VALUES ('11', '1', '4', '0', '209', '0', '0', '0', '1', '2023-06-02', '1');
INSERT INTO `movement_logs` VALUES ('12', '1', '5', '0', '995', '0', '0', '0', '1', '2023-06-02', '1');
INSERT INTO `movement_logs` VALUES ('13', '1', '3', '0', '0', '0', '463', '0', '1', '2023-06-02', '1');
INSERT INTO `movement_logs` VALUES ('14', '1', '4', '0', '0', '0', '173', '0', '1', '2023-06-02', '1');
INSERT INTO `movement_logs` VALUES ('15', '1', '5', '0', '0', '0', '858', '0', '1', '2023-06-02', '1');
INSERT INTO `movement_logs` VALUES ('16', '1', '3', '0', '3', '0', '0', '0', '1', '2023-06-01', '1');
INSERT INTO `movement_logs` VALUES ('17', '1', '8', '0', '0', '116', '0', '0', '1', '2023-06-01', '1');
INSERT INTO `movement_logs` VALUES ('18', '1', '7', '0', '0', '500', '0', '0', '1', '2023-06-01', '1');
INSERT INTO `movement_logs` VALUES ('19', '1', '9', '0', '0', '150', '0', '0', '1', '2023-06-01', '1');
INSERT INTO `movement_logs` VALUES ('20', '1', '9', '4', '0', '0', '0', '0', '1', '2023-06-01', '1');
INSERT INTO `movement_logs` VALUES ('21', '1', '5', '0', '0', '4629', '0', '0', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('22', '1', '4', '0', '0', '2084', '0', '0', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('23', '1', '4', '0', '0', '12451', '0', '0', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('24', '1', '5', '4532', '0', '0', '0', '0', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('25', '1', '5', '0', '3356', '0', '0', '0', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('26', '1', '5', '0', '0', '0', '1080', '0', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('27', '1', '5', '0', '0', '0', '0', '2010', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('28', '1', '4', '1716', '0', '0', '0', '0', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('29', '1', '4', '0', '670', '0', '0', '0', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('30', '1', '4', '0', '0', '0', '207', '0', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('31', '1', '4', '0', '0', '0', '0', '408', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('32', '1', '4', '368', '0', '0', '0', '0', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('33', '1', '3', '0', '0', '9855', '0', '0', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('34', '1', '3', '9849', '0', '0', '0', '0', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('35', '1', '3', '0', '5591', '0', '0', '0', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('36', '1', '3', '0', '0', '0', '1091', '0', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('37', '1', '3', '0', '0', '0', '0', '4300', '1', '2023-07-05', '1');
INSERT INTO `movement_logs` VALUES ('38', '1', '3', '0', '0', '0', '168', '0', '1', '2023-07-05', '2');
INSERT INTO `movement_logs` VALUES ('39', '1', '3', '0', '0', '368', '0', '0', '1', '2023-07-05', '2');
INSERT INTO `movement_logs` VALUES ('40', '1', '3', '0', '0', '10869', '0', '0', '1', '2023-07-05', '2');
INSERT INTO `movement_logs` VALUES ('41', '1', '3', '0', '0', '5250', '0', '0', '1', '2023-07-05', '2');
INSERT INTO `movement_logs` VALUES ('42', '1', '4', '0', '0', '32', '0', '0', '1', '2023-07-05', '2');
INSERT INTO `movement_logs` VALUES ('43', '1', '5', '0', '0', '26', '0', '0', '1', '2023-07-05', '2');
INSERT INTO `movement_logs` VALUES ('44', '1', '9', '0', '0', '101', '0', '0', '1', '2023-07-05', '2');
INSERT INTO `movement_logs` VALUES ('45', '1', '7', '0', '0', '464', '0', '0', '1', '2023-07-05', '2');
INSERT INTO `movement_logs` VALUES ('46', '1', '8', '0', '0', '73', '0', '0', '1', '2023-07-05', '2');
INSERT INTO `movement_logs` VALUES ('47', '1', '7', '149', '0', '0', '0', '0', '1', '2023-07-05', '2');
INSERT INTO `movement_logs` VALUES ('48', '1', '8', '27', '0', '0', '0', '0', '1', '2023-07-05', '2');
INSERT INTO `movement_logs` VALUES ('49', '1', '3', '10869', '0', '0', '0', '0', '1', '2023-07-05', '2');
INSERT INTO `movement_logs` VALUES ('50', '1', '4', '32', '0', '0', '0', '0', '1', '2023-07-05', '2');
INSERT INTO `movement_logs` VALUES ('51', '1', '3', '1415', '0', '0', '0', '0', '1', '2023-07-04', '3');
INSERT INTO `movement_logs` VALUES ('52', '1', '3', '9909', '0', '0', '0', '0', '1', '2023-07-04', '3');
INSERT INTO `movement_logs` VALUES ('53', '1', '3', '0', '725', '0', '0', '0', '1', '2023-07-04', '3');
INSERT INTO `movement_logs` VALUES ('54', '1', '3', '0', '0', '0', '0', '200', '1', '2023-07-04', '3');
INSERT INTO `movement_logs` VALUES ('55', '1', '3', '0', '0', '0', '257', '0', '1', '2023-07-04', '3');
INSERT INTO `movement_logs` VALUES ('56', '1', '4', '19', '0', '0', '0', '0', '1', '2023-07-04', '3');
INSERT INTO `movement_logs` VALUES ('57', '1', '4', '0', '0', '3', '0', '0', '1', '2023-07-04', '3');
INSERT INTO `movement_logs` VALUES ('58', '1', '5', '25', '0', '0', '0', '0', '1', '2023-07-04', '3');
INSERT INTO `movement_logs` VALUES ('59', '1', '3', '0', '6', '0', '0', '0', '1', '2023-07-05', '4');
INSERT INTO `movement_logs` VALUES ('60', '1', '3', '0', '0', '31', '0', '0', '1', '2023-07-05', '4');
INSERT INTO `movement_logs` VALUES ('61', '1', '3', '8011', '0', '0', '0', '0', '1', '2023-07-05', '4');
INSERT INTO `movement_logs` VALUES ('62', '1', '4', '383', '0', '0', '0', '0', '1', '2023-07-05', '4');
INSERT INTO `movement_logs` VALUES ('63', '1', '4', '0', '7', '0', '0', '0', '1', '2023-07-05', '4');
INSERT INTO `movement_logs` VALUES ('64', '1', '4', '0', '0', '0', '4', '0', '1', '2023-07-05', '4');
INSERT INTO `movement_logs` VALUES ('65', '1', '4', '0', '0', '423', '0', '0', '1', '2023-07-05', '4');
INSERT INTO `movement_logs` VALUES ('66', '1', '5', '0', '0', '543', '0', '0', '1', '2023-07-05', '4');
INSERT INTO `movement_logs` VALUES ('67', '1', '3', '731', '0', '0', '0', '0', '1', '2023-07-05', '4');
INSERT INTO `movement_logs` VALUES ('68', '1', '3', '19', '0', '0', '0', '0', '1', '2023-07-05', '4');
INSERT INTO `movement_logs` VALUES ('69', '1', '3', '0', '19', '0', '0', '0', '1', '2023-07-05', '4');
INSERT INTO `movement_logs` VALUES ('70', '1', '3', '0', '0', '796', '0', '0', '1', '2023-07-05', '4');

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
  PRIMARY KEY (`news_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
  PRIMARY KEY (`ops_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of oppositions
-- ----------------------------
INSERT INTO `oppositions` VALUES ('1', 'ypd1oerm2xfg3jxaq1zz9ejemjjce0sv', 'TRIPLER', 'TRIPLER', 'TRIPLER', '6876', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('2', 'brvyrfw8t0teazmcspcivzz91sjkzwn5', 'BUDGET GAS', 'BUDGET GAS', 'BUDGET GAS', '0', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('3', '88o8gnjcvxfafiwm57jmhuohyv4ww0k4', 'RUFRANCE', 'RUFRANCE', 'RUFRANCE', '15451', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('4', 'qbvqih6liz0rmk5pbbjmizxar5ifzc8n', 'PEPC', 'PEPC', 'PEPC', '1819', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('5', 'fjk1a403z8xeh16qhniub5cl1fpyj7pe', 'AGILA', 'AGILA', 'AGILA', '610', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('6', '01debiko2t4ederqbbvm41aq09h9ddtu', 'JEAM GAS', 'JEAM GAS', 'JEAM GAS', '0', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('7', null, 'EMPTY', 'EMPTY', 'EMPTY', '264', null, 'EMPTY FROM MADAYAW', '1', '1');

-- ----------------------------
-- Table structure for `payments`
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `acc_id` int(11) NOT NULL,
  `pmnt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pmnt_ref_id` varchar(30) DEFAULT NULL,
  `trx_id` int(10) unsigned NOT NULL,
  `pmnt_amount` double(30,2) NOT NULL,
  `pmnt_attachment` varchar(70) DEFAULT NULL,
  `usr_id` int(11) NOT NULL,
  `pmnt_date` varchar(20) DEFAULT NULL,
  `pmnt_time` varchar(20) DEFAULT NULL,
  `trx_mode_of_payment` int(11) DEFAULT NULL,
  `pmnt_received` double(30,2) NOT NULL,
  `pmnt_change` double(30,2) NOT NULL,
  `pmnt_check_no` varchar(30) DEFAULT NULL,
  `pmnt_check_date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`pmnt_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES ('1', '1', 'PMT20230601-1', '1', '0.00', null, '1', '2023-06-01', '09:32:04', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '2', 'PMT20230601-2', '2', '0.00', null, '1', '2023-06-01', '09:34:38', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '3', 'PMT20230601-3', '3', '0.00', null, '1', '2023-06-01', '09:38:36', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '4', 'PMT20230601-4', '3', '10000.00', null, '1', '2023-06-01', '10:30:22', '1', '10000.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '5', 'PMT20230601-5', '3', '3714.00', null, '1', '2023-06-01', '10:30:55', '1', '3714.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '6', 'PMT20230601-6', '4', '0.00', null, '1', '2023-06-01', '10:42:16', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '7', 'PMT-20230622-7', '6', '0.00', null, '1', '2023-06-22', '14:42:10', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '8', 'PMT-20230622-8', '1', '0.00', null, '1', '2023-06-22', '14:47:35', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '9', 'PMT-20230622-9', '2', '0.00', null, '1', '2023-06-22', '14:52:55', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '10', 'PMT20230622-10', '2', '12.00', null, '1', '2023-06-22', '14:58:25', '1', '12.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '11', 'PMT-20230703-11', '3', '0.00', null, '1', '2023-07-03', '13:39:06', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '12', 'PMT-20230703-12', '4', '0.00', null, '1', '2023-07-03', '13:39:54', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '13', 'PMT-20230703-13', '1', '0.00', null, '1', '2023-07-03', '15:04:12', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '14', 'PMT-20230703-14', '2', '0.00', null, '1', '2023-07-03', '15:06:51', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '15', 'PMT-20230703-15', '3', '0.00', null, '1', '2023-07-03', '15:08:24', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '16', 'PMT-20230703-16', '4', '27324.00', null, '1', '2023-07-03', '15:11:32', '1', '27324.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '17', 'PMT-20230703-17', '5', '100.00', null, '1', '2023-07-03', '15:17:18', '1', '100.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '18', 'PMT-20230703-18', '6', '11484.00', null, '1', '2023-07-03', '15:18:54', '1', '11484.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '19', 'PMT-20230703-19', '7', '1980.00', null, '1', '2023-07-03', '15:19:22', '1', '1980.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '20', 'PMT-20230703-20', '8', '1584.00', null, '1', '2023-07-03', '15:21:22', '1', '1584.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '21', 'PMT-20230703-21', '9', '100.00', null, '1', '2023-07-03', '15:22:14', '1', '100.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '22', 'PMT-20230703-22', '10', '2376.00', null, '1', '2023-07-03', '15:22:55', '1', '2376.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '23', 'PMT-20230703-23', '11', '3033.00', null, '1', '2023-07-03', '15:27:51', '1', '3033.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '24', 'PMT-20230703-24', '12', '2800.00', null, '1', '2023-07-03', '15:30:04', '1', '2800.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '25', 'PMT-20230703-25', '13', '4554.00', null, '1', '2023-07-03', '15:31:38', '1', '4554.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '26', 'PMT-20230704-26', '14', '0.00', null, '1', '2023-07-04', '06:16:27', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '27', 'PMT-20230704-27', '15', '0.00', null, '1', '2023-07-04', '06:18:25', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '28', 'PMT-20230704-28', '16', '408.00', null, '1', '2023-07-04', '06:19:10', '1', '408.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '29', 'PMT-20230704-29', '17', '17820.00', null, '1', '2023-07-04', '06:21:25', '1', '17820.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '30', 'PMT-20230704-30', '18', '2805.00', null, '1', '2023-07-04', '06:24:38', '1', '2805.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '31', 'PMT-20230704-31', '19', '9900.00', null, '1', '2023-07-04', '06:25:43', '1', '9900.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '32', 'PMT-20230704-32', '20', '1980.00', null, '1', '2023-07-04', '06:26:29', '1', '1980.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '33', 'PMT-20230704-33', '21', '1980.00', null, '1', '2023-07-04', '06:26:55', '1', '1980.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '34', 'PMT-20230704-34', '22', '2640.00', null, '1', '2023-07-04', '06:28:16', '1', '2640.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '35', 'PMT-20230704-35', '23', '2772.00', null, '1', '2023-07-04', '06:30:07', '1', '2772.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '36', 'PMT-20230704-36', '24', '7128.00', null, '1', '2023-07-04', '06:31:03', '1', '7128.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '37', 'PMT-20230704-37', '25', '2475.00', null, '1', '2023-07-04', '06:32:03', '1', '2475.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '38', 'PMT-20230704-38', '26', '2617.00', null, '1', '2023-07-04', '06:34:25', '1', '2617.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '39', 'PMT-20230704-39', '27', '3960.00', null, '1', '2023-07-04', '06:35:09', '1', '3960.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '40', 'PMT-20230704-40', '28', '0.00', null, '1', '2023-07-04', '07:51:52', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '41', 'PMT-20230705-41', '29', '180.00', null, '1', '2023-07-05', '06:10:31', '1', '180.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '42', 'PMT-20230705-42', '30', '2376.00', null, '1', '2023-07-05', '06:12:50', '1', '2376.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '43', 'PMT-20230705-43', '31', '3564.00', null, '1', '2023-07-05', '06:14:17', '1', '3564.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '44', 'PMT-20230705-44', '32', '2376.00', null, '1', '2023-07-05', '06:15:49', '1', '2376.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '45', 'PMT-20230705-45', '33', '2376.00', null, '1', '2023-07-05', '06:19:49', '1', '2376.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '46', 'PMT-20230705-46', '34', '1980.00', null, '1', '2023-07-05', '06:21:10', '1', '1980.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '47', 'PMT-20230705-47', '35', '6336.00', null, '1', '2023-07-05', '06:22:44', '1', '6336.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '48', 'PMT-20230705-48', '36', '520.00', null, '1', '2023-07-05', '06:31:03', '1', '520.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '49', 'PMT-20230705-49', '37', '15840.00', null, '1', '2023-07-05', '06:33:38', '1', '15840.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '50', 'PMT-20230705-50', '38', '2640.00', null, '1', '2023-07-05', '06:34:39', '1', '2640.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '51', 'PMT-20230705-51', '39', '320.00', null, '1', '2023-07-05', '06:35:34', '1', '320.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '52', 'PMT-20230705-52', '40', '320.00', null, '1', '2023-07-05', '06:36:57', '1', '320.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '53', 'PMT-20230710-53', '41', '0.00', null, '1', '2023-07-10', '18:55:50', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '54', 'PMT-20230710-54', '42', '12.00', null, '1', '2023-07-10', '18:57:29', '5', '12.00', '0.00', null, null);

-- ----------------------------
-- Table structure for `payment_types`
-- ----------------------------
DROP TABLE IF EXISTS `payment_types`;
CREATE TABLE `payment_types` (
  `mode_of_payment` int(11) NOT NULL,
  `payment_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`mode_of_payment`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
  PRIMARY KEY (`pdn_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of production_logs
-- ----------------------------
INSERT INTO `production_logs` VALUES ('1', '2023-06-01', '09:12:52', '06:01:51');
INSERT INTO `production_logs` VALUES ('2', '2023-07-05', '14:55:00', '06:01:51');
INSERT INTO `production_logs` VALUES ('3', '2023-07-04', '06:02:38', '06:01:51');
INSERT INTO `production_logs` VALUES ('4', '2023-07-05', '06:07:23', null);

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
  `prd_price` double(10,2) DEFAULT NULL,
  `prd_deposit` double(10,2) DEFAULT '0.00',
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
  `prd_weight` double(10,2) DEFAULT NULL,
  `prd_raw_can_qty` int(11) DEFAULT '0',
  `prd_components` int(11) DEFAULT NULL,
  `prd_seals` int(11) DEFAULT NULL,
  PRIMARY KEY (`prd_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '1', '0eqfa2whjhx90s8nrw83q987g9kl1stj', 'Seal', 'seal', 'seal', null, null, '0.00', '75492', '0', '0', '0', '0', '360000', null, '1', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('2', '1', '316xf5bh9z85yj265ssfxhlyrhsmxh0n', 'Valve', 'valve', 'valve', null, null, '0.00', '81634', '0', '0', '0', '0', '500000', null, '2', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('3', '1', '6f0lokdgcxp3xjp6pi62qnjy7ibugrna', 'Round', 'Madayaw Round Canister', 'MR170', null, '0.00', '60.00', '14433', '325', '1890', '1117', '4500', '10000', null, '1', '1', '1', '1', '1', '170.00', '92927', '2', '1');
INSERT INTO `products` VALUES ('4', '1', '03z7lbrja07ypsfva0f91y7i3h9bv73m', 'Square', 'Madayaw Square Canister', 'MS170', null, '0.00', '60.00', '1416', '58', '12541', '208', '408', '10000', null, '2', '1', '1', '1', '1', '170.00', '99576', '2', '1');
INSERT INTO `products` VALUES ('5', '1', 'lm4p6zbx0dcjc6ixwnk36pea2ax12byi', 'Botin', 'Botin Canister', 'Botin170', null, '0.00', '70.00', '1201', '266', '780', '1080', '2010', '10000', null, '2', '1', '1', '1', '1', '170.00', '99456', '2', '1');
INSERT INTO `products` VALUES ('6', '1', 'f1g86czlex1cyk4z3k1s0k7uuiwhdfce', 'PORTABLE STOVE', 'PORTABLE STOVE', 'PORTABLE STOVE', null, '440.00', '0.00', '0', '0', '0', '0', '0', '1500', null, '3', '1', '0', '0', '1', null, '0', null, null);
INSERT INTO `products` VALUES ('7', '1', 'pjq863zmt5nf4fh8ixtihap1jpe79ll0', 'A/S TYPE TANK', '11KG. A/S TYPE', '11KG. A/S TYPE', null, '601.87', '0.00', '149', '0', '315', '0', '0', '500', null, '4', '1', '1', '1', '1', '11000.00', '0', '2', '10');
INSERT INTO `products` VALUES ('8', '1', 'ohizg8boensypacr64haelqhrhsmoi8g', 'POL TYPE TANK', '11KG POL TYPE', '11KG POL TYPE', null, '601.87', '602.00', '27', '0', '46', '0', '0', '500', null, '4', '1', '1', '1', '1', '11000.00', '0', '2', '10');
INSERT INTO `products` VALUES ('9', '1', '3ny79p9wo9mzoc13wtehuhh66zkysof0', '50KG POL TYPE', '5OKG POL TYPE', '50KG POL TYPE', null, '2631.00', '2631.00', '0', '0', '101', '0', '0', '500', null, '4', '1', '1', '1', '1', '50000.00', '0', '2', '10');
INSERT INTO `products` VALUES ('10', '1', 'xthe4184cjs15zaoqfcanahn4bzpekpe', 'Tank Seal', 'tank seal', 'TANKSEAL', null, null, '0.00', '4824', '0', '0', '0', '0', '10000', null, '1', '1', '0', '1', '0', null, '0', null, null);

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
  PRIMARY KEY (`pur_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of purchases
-- ----------------------------
INSERT INTO `purchases` VALUES ('1', '1', '3', '0', '10', '0.00', '0.00', '165.00', '10', '16.50', '1', '0', '10', '2');
INSERT INTO `purchases` VALUES ('2', '1', '3', '15', '9', '0.00', '0.00', '3118.50', '189', '16.50', '3', '15', '9', '1');
INSERT INTO `purchases` VALUES ('3', '1', '4', '3', '8', '0.00', '0.00', '726.00', '44', '16.50', '4', '3', '8', '1');
INSERT INTO `purchases` VALUES ('4', '2', '3', '0', '6', '0.00', '0.00', '102.00', '6', '17.00', '1', '0', '6', '2');
INSERT INTO `purchases` VALUES ('5', '2', '3', '0', '1', '0.00', '0.00', '17.00', '1', '17.00', '5', '0', '1', '1');
INSERT INTO `purchases` VALUES ('6', '2', '3', '1', '5', '0.00', '0.00', '289.00', '17', '17.00', '3', '1', '5', '1');
INSERT INTO `purchases` VALUES ('7', '3', '3', '0', '3', '0.00', '0.00', '49.50', '3', '16.50', '3', '0', '3', '2');
INSERT INTO `purchases` VALUES ('8', '3', '3', '5', '4', '0.00', '0.00', '1056.00', '64', '16.50', '1', '5', '4', '2');
INSERT INTO `purchases` VALUES ('9', '3', '3', '40', '8', '0.00', '0.00', '8052.00', '488', '16.50', '3', '40', '8', '1');
INSERT INTO `purchases` VALUES ('10', '3', '4', '1', '9', '0.00', '0.00', '346.50', '21', '16.50', '4', '1', '9', '1');
INSERT INTO `purchases` VALUES ('11', '4', '3', '17', '10', '0.00', '0.00', '3531.00', '214', '16.50', '3', '17', '10', '2');
INSERT INTO `purchases` VALUES ('12', '4', '3', '23', '10', '0.00', '0.00', '4719.00', '286', '16.50', '1', '23', '10', '2');
INSERT INTO `purchases` VALUES ('13', '4', '3', '0', '4', '0.00', '0.00', '66.00', '4', '16.50', '5', '0', '4', '1');
INSERT INTO `purchases` VALUES ('14', '4', '3', '96', '0', '0.00', '0.00', '19008.00', '1152', '16.50', '3', '96', '0', '1');
INSERT INTO `purchases` VALUES ('15', '5', '3', '0', '2', '0.00', '0.00', '40.00', '2', '20.00', '1', '0', '2', '2');
INSERT INTO `purchases` VALUES ('16', '5', '3', '0', '3', '0.00', '0.00', '60.00', '3', '20.00', '3', '0', '3', '1');
INSERT INTO `purchases` VALUES ('17', '6', '3', '6', '0', '0.00', '0.00', '1188.00', '72', '16.50', '3', '6', '0', '2');
INSERT INTO `purchases` VALUES ('18', '6', '3', '12', '0', '0.00', '0.00', '2376.00', '144', '16.50', '1', '12', '0', '2');
INSERT INTO `purchases` VALUES ('19', '6', '3', '40', '0', '0.00', '0.00', '7920.00', '480', '16.50', '3', '40', '0', '1');
INSERT INTO `purchases` VALUES ('20', '7', '3', '10', '0', '0.00', '0.00', '1980.00', '120', '16.50', '3', '10', '0', '1');
INSERT INTO `purchases` VALUES ('21', '8', '3', '0', '4', '0.00', '0.00', '66.00', '4', '16.50', '3', '0', '4', '2');
INSERT INTO `purchases` VALUES ('22', '8', '3', '2', '0', '0.00', '0.00', '396.00', '24', '16.50', '1', '2', '0', '2');
INSERT INTO `purchases` VALUES ('23', '8', '3', '5', '8', '0.00', '0.00', '1122.00', '68', '16.50', '3', '5', '8', '1');
INSERT INTO `purchases` VALUES ('24', '9', '3', '0', '5', '0.00', '0.00', '100.00', '5', '20.00', '3', '0', '5', '1');
INSERT INTO `purchases` VALUES ('25', '10', '3', '1', '0', '0.00', '0.00', '198.00', '12', '16.50', '5', '1', '0', '1');
INSERT INTO `purchases` VALUES ('26', '10', '3', '11', '0', '0.00', '0.00', '2178.00', '132', '16.50', '3', '11', '0', '1');
INSERT INTO `purchases` VALUES ('27', '11', '3', '9', '11', '0.00', '360.00', '2224.50', '119', '16.50', '3', '9', '5', '2');
INSERT INTO `purchases` VALUES ('28', '11', '3', '2', '0', '0.00', '0.00', '396.00', '24', '16.50', '1', '2', '0', '2');
INSERT INTO `purchases` VALUES ('29', '11', '3', '2', '1', '0.00', '0.00', '412.50', '25', '16.50', '3', '2', '1', '1');
INSERT INTO `purchases` VALUES ('30', '12', '3', '0', '7', '0.00', '0.00', '140.00', '7', '20.00', '3', '0', '7', '2');
INSERT INTO `purchases` VALUES ('31', '12', '3', '0', '5', '0.00', '0.00', '100.00', '5', '20.00', '1', '0', '5', '2');
INSERT INTO `purchases` VALUES ('32', '12', '3', '0', '48', '0.00', '2400.00', '2560.00', '48', '20.00', '3', '0', '8', '1');
INSERT INTO `purchases` VALUES ('33', '13', '3', '5', '0', '0.00', '0.00', '990.00', '60', '16.50', '1', '5', '0', '2');
INSERT INTO `purchases` VALUES ('34', '13', '3', '18', '0', '0.00', '0.00', '3564.00', '216', '16.50', '3', '18', '0', '1');
INSERT INTO `purchases` VALUES ('35', '14', '3', '2', '0', '0.00', '0.00', '396.00', '24', '16.50', '7', '2', '0', '2');
INSERT INTO `purchases` VALUES ('36', '14', '3', '5', '0', '0.00', '0.00', '990.00', '60', '16.50', '3', '5', '0', '2');
INSERT INTO `purchases` VALUES ('37', '14', '3', '39', '0', '0.00', '0.00', '7722.00', '468', '16.50', '1', '39', '0', '2');
INSERT INTO `purchases` VALUES ('38', '14', '3', '4', '0', '0.00', '0.00', '792.00', '48', '16.50', '5', '4', '0', '1');
INSERT INTO `purchases` VALUES ('39', '14', '3', '196', '0', '0.00', '0.00', '38808.00', '2352', '16.50', '3', '196', '0', '1');
INSERT INTO `purchases` VALUES ('40', '15', '3', '54', '0', '0.00', '0.00', '9072.00', '648', '14.00', '3', '54', '0', '2');
INSERT INTO `purchases` VALUES ('41', '15', '3', '29', '0', '0.00', '0.00', '4872.00', '348', '14.00', '1', '29', '0', '2');
INSERT INTO `purchases` VALUES ('42', '15', '3', '2', '6', '0.00', '0.00', '420.00', '30', '14.00', '5', '2', '6', '1');
INSERT INTO `purchases` VALUES ('43', '15', '3', '234', '6', '0.00', '0.00', '39396.00', '2814', '14.00', '3', '234', '6', '1');
INSERT INTO `purchases` VALUES ('44', '16', '3', '0', '8', '0.00', '0.00', '136.00', '8', '17.00', '1', '0', '8', '2');
INSERT INTO `purchases` VALUES ('45', '16', '3', '1', '4', '0.00', '0.00', '272.00', '16', '17.00', '3', '1', '4', '1');
INSERT INTO `purchases` VALUES ('46', '17', '3', '9', '3', '0.00', '0.00', '1831.50', '111', '16.50', '3', '9', '3', '2');
INSERT INTO `purchases` VALUES ('47', '17', '3', '16', '7', '0.00', '0.00', '3283.50', '199', '16.50', '1', '16', '7', '2');
INSERT INTO `purchases` VALUES ('48', '17', '3', '0', '2', '0.00', '0.00', '33.00', '2', '16.50', '5', '0', '2', '1');
INSERT INTO `purchases` VALUES ('49', '17', '3', '64', '0', '0.00', '0.00', '12672.00', '768', '16.50', '3', '64', '0', '1');
INSERT INTO `purchases` VALUES ('50', '18', '3', '1', '2', '0.00', '0.00', '231.00', '14', '16.50', '3', '1', '2', '2');
INSERT INTO `purchases` VALUES ('51', '18', '3', '0', '1', '0.00', '0.00', '16.50', '1', '16.50', '5', '0', '1', '1');
INSERT INTO `purchases` VALUES ('52', '18', '3', '12', '11', '0.00', '0.00', '2557.50', '155', '16.50', '3', '12', '11', '1');
INSERT INTO `purchases` VALUES ('53', '19', '3', '2', '1', '0.00', '0.00', '412.50', '25', '16.50', '3', '2', '1', '2');
INSERT INTO `purchases` VALUES ('54', '19', '3', '5', '11', '0.00', '0.00', '1171.50', '71', '16.50', '1', '5', '11', '2');
INSERT INTO `purchases` VALUES ('55', '19', '3', '1', '0', '0.00', '0.00', '198.00', '12', '16.50', '5', '1', '0', '1');
INSERT INTO `purchases` VALUES ('56', '19', '3', '41', '0', '0.00', '0.00', '8118.00', '492', '16.50', '3', '41', '0', '1');
INSERT INTO `purchases` VALUES ('57', '20', '3', '2', '0', '0.00', '0.00', '396.00', '24', '16.50', '3', '2', '0', '2');
INSERT INTO `purchases` VALUES ('58', '20', '3', '2', '0', '0.00', '0.00', '396.00', '24', '16.50', '1', '2', '0', '2');
INSERT INTO `purchases` VALUES ('59', '20', '3', '0', '1', '0.00', '0.00', '16.50', '1', '16.50', '5', '0', '1', '1');
INSERT INTO `purchases` VALUES ('60', '20', '3', '5', '11', '0.00', '0.00', '1171.50', '71', '16.50', '3', '5', '11', '1');
INSERT INTO `purchases` VALUES ('61', '21', '3', '1', '0', '0.00', '0.00', '198.00', '12', '16.50', '1', '1', '0', '2');
INSERT INTO `purchases` VALUES ('62', '21', '3', '9', '0', '0.00', '0.00', '1782.00', '108', '16.50', '3', '9', '0', '1');
INSERT INTO `purchases` VALUES ('63', '22', '3', '2', '5', '0.00', '0.00', '478.50', '29', '16.50', '3', '2', '5', '2');
INSERT INTO `purchases` VALUES ('64', '22', '3', '0', '9', '0.00', '0.00', '148.50', '9', '16.50', '1', '0', '9', '2');
INSERT INTO `purchases` VALUES ('65', '22', '3', '10', '2', '0.00', '0.00', '2013.00', '122', '16.50', '3', '10', '2', '1');
INSERT INTO `purchases` VALUES ('66', '23', '3', '0', '9', '0.00', '0.00', '148.50', '9', '16.50', '3', '0', '9', '2');
INSERT INTO `purchases` VALUES ('67', '23', '3', '2', '7', '0.00', '0.00', '511.50', '31', '16.50', '1', '2', '7', '2');
INSERT INTO `purchases` VALUES ('68', '23', '3', '0', '1', '0.00', '0.00', '16.50', '1', '16.50', '5', '0', '1', '1');
INSERT INTO `purchases` VALUES ('69', '23', '3', '10', '7', '0.00', '0.00', '2095.50', '127', '16.50', '3', '10', '7', '1');
INSERT INTO `purchases` VALUES ('70', '24', '3', '7', '7', '0.00', '0.00', '1501.50', '91', '16.50', '3', '7', '7', '2');
INSERT INTO `purchases` VALUES ('71', '24', '3', '9', '0', '0.00', '0.00', '1782.00', '108', '16.50', '1', '9', '0', '2');
INSERT INTO `purchases` VALUES ('72', '24', '3', '0', '5', '0.00', '0.00', '82.50', '5', '16.50', '5', '0', '5', '1');
INSERT INTO `purchases` VALUES ('73', '24', '3', '19', '0', '0.00', '0.00', '3762.00', '228', '16.50', '3', '19', '0', '1');
INSERT INTO `purchases` VALUES ('74', '25', '3', '2', '3', '0.00', '0.00', '445.50', '27', '16.50', '1', '2', '3', '2');
INSERT INTO `purchases` VALUES ('75', '25', '3', '10', '3', '0.00', '0.00', '2029.50', '123', '16.50', '3', '10', '3', '1');
INSERT INTO `purchases` VALUES ('76', '26', '3', '1', '11', '0.00', '60.00', '423.00', '23', '16.50', '1', '1', '10', '2');
INSERT INTO `purchases` VALUES ('77', '26', '3', '11', '0', '0.00', '0.00', '2178.00', '132', '16.50', '3', '11', '0', '1');
INSERT INTO `purchases` VALUES ('78', '26', '3', '0', '1', '0.00', '0.00', '16.50', '1', '16.50', '4', '0', '1', '1');
INSERT INTO `purchases` VALUES ('79', '27', '3', '3', '11', '0.00', '0.00', '775.50', '47', '16.50', '3', '3', '11', '2');
INSERT INTO `purchases` VALUES ('80', '27', '3', '0', '9', '0.00', '0.00', '148.50', '9', '16.50', '1', '0', '9', '2');
INSERT INTO `purchases` VALUES ('81', '27', '3', '1', '3', '0.00', '0.00', '247.50', '15', '16.50', '5', '1', '3', '1');
INSERT INTO `purchases` VALUES ('82', '27', '3', '14', '1', '0.00', '0.00', '2788.50', '169', '16.50', '3', '14', '1', '1');
INSERT INTO `purchases` VALUES ('83', '28', '3', '20', '0', '0.00', '0.00', '3960.00', '240', '16.50', '7', '20', '0', '2');
INSERT INTO `purchases` VALUES ('84', '28', '4', '30', '0', '0.00', '21600.00', '21600.00', '360', '16.50', '4', '0', '0', '1');
INSERT INTO `purchases` VALUES ('85', '28', '3', '9', '0', '0.00', '0.00', '1782.00', '108', '16.50', '1', '9', '0', '2');
INSERT INTO `purchases` VALUES ('86', '28', '3', '261', '0', '0.00', '0.00', '51678.00', '3132', '16.50', '3', '261', '0', '1');
INSERT INTO `purchases` VALUES ('87', '29', '3', '0', '4', '0.00', '0.00', '80.00', '4', '20.00', '1', '0', '4', '2');
INSERT INTO `purchases` VALUES ('88', '29', '3', '0', '5', '0.00', '0.00', '100.00', '5', '20.00', '3', '0', '5', '1');
INSERT INTO `purchases` VALUES ('89', '30', '3', '0', '2', '0.00', '0.00', '33.00', '2', '16.50', '3', '0', '2', '2');
INSERT INTO `purchases` VALUES ('90', '30', '3', '1', '1', '0.00', '0.00', '214.50', '13', '16.50', '1', '1', '1', '2');
INSERT INTO `purchases` VALUES ('91', '30', '3', '10', '9', '0.00', '0.00', '2128.50', '129', '16.50', '3', '10', '9', '1');
INSERT INTO `purchases` VALUES ('92', '31', '3', '2', '8', '0.00', '0.00', '528.00', '32', '16.50', '3', '2', '8', '2');
INSERT INTO `purchases` VALUES ('93', '31', '3', '2', '3', '0.00', '0.00', '445.50', '27', '16.50', '1', '2', '3', '2');
INSERT INTO `purchases` VALUES ('94', '31', '3', '13', '1', '0.00', '0.00', '2590.50', '157', '16.50', '3', '13', '1', '1');
INSERT INTO `purchases` VALUES ('95', '32', '3', '2', '3', '0.00', '0.00', '445.50', '27', '16.50', '3', '2', '3', '2');
INSERT INTO `purchases` VALUES ('96', '32', '3', '1', '8', '0.00', '0.00', '330.00', '20', '16.50', '1', '1', '8', '2');
INSERT INTO `purchases` VALUES ('97', '32', '3', '8', '1', '0.00', '0.00', '1600.50', '97', '16.50', '3', '8', '1', '1');
INSERT INTO `purchases` VALUES ('98', '33', '3', '1', '4', '0.00', '0.00', '264.00', '16', '16.50', '3', '1', '4', '2');
INSERT INTO `purchases` VALUES ('99', '33', '3', '3', '4', '0.00', '0.00', '660.00', '40', '16.50', '1', '3', '4', '2');
INSERT INTO `purchases` VALUES ('100', '33', '3', '0', '3', '0.00', '0.00', '49.50', '3', '16.50', '5', '0', '3', '1');
INSERT INTO `purchases` VALUES ('101', '33', '3', '7', '1', '0.00', '0.00', '1402.50', '85', '16.50', '3', '7', '1', '1');
INSERT INTO `purchases` VALUES ('102', '34', '3', '0', '7', '0.00', '0.00', '115.50', '7', '16.50', '3', '0', '7', '2');
INSERT INTO `purchases` VALUES ('103', '34', '3', '9', '5', '0.00', '0.00', '1864.50', '113', '16.50', '3', '9', '5', '1');
INSERT INTO `purchases` VALUES ('104', '35', '3', '2', '4', '0.00', '0.00', '462.00', '28', '16.50', '3', '2', '4', '2');
INSERT INTO `purchases` VALUES ('105', '35', '3', '5', '7', '0.00', '0.00', '1105.50', '67', '16.50', '1', '5', '7', '2');
INSERT INTO `purchases` VALUES ('106', '35', '3', '0', '1', '0.00', '0.00', '16.50', '1', '16.50', '5', '0', '1', '1');
INSERT INTO `purchases` VALUES ('107', '35', '3', '24', '0', '0.00', '0.00', '4752.00', '288', '16.50', '3', '24', '0', '1');
INSERT INTO `purchases` VALUES ('108', '36', '3', '0', '6', '0.00', '0.00', '120.00', '6', '20.00', '3', '0', '6', '2');
INSERT INTO `purchases` VALUES ('109', '36', '3', '0', '1', '0.00', '0.00', '20.00', '1', '20.00', '1', '0', '1', '2');
INSERT INTO `purchases` VALUES ('110', '36', '3', '1', '5', '0.00', '60.00', '380.00', '17', '20.00', '3', '1', '4', '1');
INSERT INTO `purchases` VALUES ('111', '37', '3', '5', '0', '0.00', '0.00', '990.00', '60', '16.50', '3', '5', '0', '2');
INSERT INTO `purchases` VALUES ('112', '37', '3', '10', '9', '0.00', '0.00', '2128.50', '129', '16.50', '1', '10', '9', '2');
INSERT INTO `purchases` VALUES ('113', '37', '3', '0', '3', '0.00', '0.00', '49.50', '3', '16.50', '5', '0', '3', '1');
INSERT INTO `purchases` VALUES ('114', '37', '3', '64', '0', '0.00', '0.00', '12672.00', '768', '16.50', '3', '64', '0', '1');
INSERT INTO `purchases` VALUES ('115', '38', '3', '1', '11', '0.00', '0.00', '379.50', '23', '16.50', '3', '1', '11', '2');
INSERT INTO `purchases` VALUES ('116', '38', '3', '11', '5', '0.00', '0.00', '2260.50', '137', '16.50', '3', '11', '5', '1');
INSERT INTO `purchases` VALUES ('117', '39', '3', '1', '4', '0.00', '0.00', '320.00', '16', '20.00', '3', '1', '4', '1');
INSERT INTO `purchases` VALUES ('118', '40', '3', '0', '5', '0.00', '180.00', '220.00', '5', '20.00', '1', '0', '2', '2');
INSERT INTO `purchases` VALUES ('119', '40', '3', '0', '5', '0.00', '0.00', '100.00', '5', '20.00', '3', '0', '5', '1');
INSERT INTO `purchases` VALUES ('120', '41', '3', '0', '1', '0.00', '0.00', '21.50', '1', '21.50', '3', '0', '1', '1');
INSERT INTO `purchases` VALUES ('121', '42', '3', '0', '1', '0.00', '0.00', '21.50', '1', '21.50', '3', '0', '1', '1');

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
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of quantity_logs
-- ----------------------------
INSERT INTO `quantity_logs` VALUES ('1', '1', '1', '1', '360000', '2023-06-02 17:18:18', '1');
INSERT INTO `quantity_logs` VALUES ('2', '1', '2', '1', '500000', '2023-06-02 17:18:23', '1');
INSERT INTO `quantity_logs` VALUES ('3', '1', '3', '1', '10367', '2023-06-02 17:19:38', '1');
INSERT INTO `quantity_logs` VALUES ('4', '1', '4', '1', '13008', '2023-06-02 17:19:45', '1');
INSERT INTO `quantity_logs` VALUES ('5', '1', '5', '1', '2140', '2023-06-02 17:19:50', '1');
INSERT INTO `quantity_logs` VALUES ('6', '1', '3', '1', '9503', '2023-06-02 17:20:43', '1');
INSERT INTO `quantity_logs` VALUES ('7', '1', '4', '1', '12799', '2023-06-02 17:20:58', '1');
INSERT INTO `quantity_logs` VALUES ('8', '1', '5', '1', '1145', '2023-06-02 17:21:13', '1');
INSERT INTO `quantity_logs` VALUES ('9', '1', '3', '1', '864', '2023-06-02 17:21:47', '1');
INSERT INTO `quantity_logs` VALUES ('10', '1', '4', '1', '209', '2023-06-02 17:21:54', '1');
INSERT INTO `quantity_logs` VALUES ('11', '1', '5', '1', '995', '2023-06-02 17:22:01', '1');
INSERT INTO `quantity_logs` VALUES ('12', '1', '3', '1', '7210', '2023-06-02 17:23:07', '1');
INSERT INTO `quantity_logs` VALUES ('13', '1', '4', '1', '1799', '2023-06-02 17:23:38', '1');
INSERT INTO `quantity_logs` VALUES ('14', '1', '5', '1', '2131', '2023-06-02 17:23:55', '1');
INSERT INTO `quantity_logs` VALUES ('15', '1', '3', '1', '864', '2023-06-02 17:24:36', '1');
INSERT INTO `quantity_logs` VALUES ('16', '1', '4', '1', '209', '2023-06-02 17:24:52', '1');
INSERT INTO `quantity_logs` VALUES ('17', '1', '5', '1', '995', '2023-06-02 17:25:35', '1');
INSERT INTO `quantity_logs` VALUES ('18', '1', '3', '1', '463', '2023-06-02 17:26:43', '1');
INSERT INTO `quantity_logs` VALUES ('19', '1', '4', '1', '173', '2023-06-02 17:26:49', '1');
INSERT INTO `quantity_logs` VALUES ('20', '1', '5', '1', '858', '2023-06-02 17:26:54', '1');
INSERT INTO `quantity_logs` VALUES ('21', '1', '3', '1', '3', '2023-06-01 09:41:41', '1');
INSERT INTO `quantity_logs` VALUES ('22', '1', '6', '1', '3604', '2023-06-01 10:21:03', '1');
INSERT INTO `quantity_logs` VALUES ('23', '1', '1', '1', '3154000', '2023-06-01 10:35:39', '1');
INSERT INTO `quantity_logs` VALUES ('24', '1', '7', '1', '500', '2023-06-01 10:36:52', '1');
INSERT INTO `quantity_logs` VALUES ('25', '1', '8', '1', '116', '2023-06-01 10:37:06', '1');
INSERT INTO `quantity_logs` VALUES ('26', '1', '9', '1', '150', '2023-06-01 10:37:15', '1');
INSERT INTO `quantity_logs` VALUES ('27', '1', '7', '1', '500', '2023-06-01 10:37:41', '1');
INSERT INTO `quantity_logs` VALUES ('28', '1', '8', '1', '116', '2023-06-01 10:37:51', '1');
INSERT INTO `quantity_logs` VALUES ('29', '1', '9', '1', '150', '2023-06-01 10:37:58', '1');
INSERT INTO `quantity_logs` VALUES ('30', '1', '7', '1', '500', '2023-06-01 10:38:58', '1');
INSERT INTO `quantity_logs` VALUES ('31', '1', '2', '1', '10000', '2023-06-01 10:39:08', '1');
INSERT INTO `quantity_logs` VALUES ('32', '1', '8', '1', '116', '2023-06-01 10:39:20', '1');
INSERT INTO `quantity_logs` VALUES ('33', '1', '7', '1', '500', '2023-06-01 10:39:26', '1');
INSERT INTO `quantity_logs` VALUES ('34', '1', '9', '1', '150', '2023-06-01 10:39:30', '1');
INSERT INTO `quantity_logs` VALUES ('35', '1', '9', '1', '4', '2023-06-01 10:40:11', '1');
INSERT INTO `quantity_logs` VALUES ('36', '1', '9', '1', '4', '2023-06-01 10:40:47', '1');
INSERT INTO `quantity_logs` VALUES ('37', '1', '3', '1', '9849', '2023-07-05 13:47:28', '1');
INSERT INTO `quantity_logs` VALUES ('38', '1', '4', '1', '14535', '2023-07-05 13:47:37', '1');
INSERT INTO `quantity_logs` VALUES ('39', '1', '5', '1', '4629', '2023-07-05 13:47:43', '1');
INSERT INTO `quantity_logs` VALUES ('40', '1', '3', '1', '9849', '2023-07-05 13:48:09', '1');
INSERT INTO `quantity_logs` VALUES ('41', '1', '3', '1', '9849', '2023-07-05 13:48:24', '1');
INSERT INTO `quantity_logs` VALUES ('42', '1', '4', '1', '14535', '2023-07-05 13:48:30', '1');
INSERT INTO `quantity_logs` VALUES ('43', '1', '5', '1', '4629', '2023-07-05 13:48:36', '1');
INSERT INTO `quantity_logs` VALUES ('44', '1', '4', '1', '2084', '2023-07-05 13:52:13', '1');
INSERT INTO `quantity_logs` VALUES ('45', '1', '4', '1', '12451', '2023-07-05 13:52:54', '1');
INSERT INTO `quantity_logs` VALUES ('46', '1', '2', '1', '20000', '2023-07-05 13:53:06', '1');
INSERT INTO `quantity_logs` VALUES ('47', '1', '4', '1', '12451', '2023-07-05 13:53:17', '1');
INSERT INTO `quantity_logs` VALUES ('48', '1', '5', '1', '4532', '2023-07-05 13:56:15', '1');
INSERT INTO `quantity_logs` VALUES ('49', '1', '5', '1', '3356', '2023-07-05 13:56:57', '1');
INSERT INTO `quantity_logs` VALUES ('50', '1', '5', '1', '1080', '2023-07-05 13:57:19', '1');
INSERT INTO `quantity_logs` VALUES ('51', '1', '5', '1', '1080', '2023-07-05 13:57:26', '1');
INSERT INTO `quantity_logs` VALUES ('52', '1', '5', '1', '2010', '2023-07-05 13:57:33', '1');
INSERT INTO `quantity_logs` VALUES ('53', '1', '4', '1', '1716', '2023-07-05 13:58:17', '1');
INSERT INTO `quantity_logs` VALUES ('54', '1', '4', '1', '670', '2023-07-05 13:58:35', '1');
INSERT INTO `quantity_logs` VALUES ('55', '1', '4', '1', '207', '2023-07-05 13:58:40', '1');
INSERT INTO `quantity_logs` VALUES ('56', '1', '4', '1', '408', '2023-07-05 13:58:45', '1');
INSERT INTO `quantity_logs` VALUES ('57', '1', '4', '1', '368', '2023-07-05 13:59:30', '1');
INSERT INTO `quantity_logs` VALUES ('58', '1', '3', '1', '9855', '2023-07-05 14:04:26', '1');
INSERT INTO `quantity_logs` VALUES ('59', '1', '3', '1', '9849', '2023-07-05 14:09:52', '1');
INSERT INTO `quantity_logs` VALUES ('60', '1', '1', '1', '9000', '2023-07-05 14:09:58', '1');
INSERT INTO `quantity_logs` VALUES ('61', '1', '3', '1', '9849', '2023-07-05 14:10:04', '1');
INSERT INTO `quantity_logs` VALUES ('62', '1', '3', '1', '5591', '2023-07-05 14:10:22', '1');
INSERT INTO `quantity_logs` VALUES ('63', '1', '3', '1', '1091', '2023-07-05 14:10:31', '1');
INSERT INTO `quantity_logs` VALUES ('64', '1', '3', '1', '4300', '2023-07-05 14:10:40', '1');
INSERT INTO `quantity_logs` VALUES ('65', '1', '3', '1', '168', '2023-07-05 16:03:20', '2');
INSERT INTO `quantity_logs` VALUES ('66', '1', '3', '1', '368', '2023-07-05 16:04:02', '2');
INSERT INTO `quantity_logs` VALUES ('67', '1', '3', '1', '99999', '2023-07-05 16:05:28', '2');
INSERT INTO `quantity_logs` VALUES ('68', '1', '3', '1', '10869', '2023-07-05 16:05:37', '2');
INSERT INTO `quantity_logs` VALUES ('69', '1', '2', '1', '99999', '2023-07-05 16:05:50', '2');
INSERT INTO `quantity_logs` VALUES ('70', '1', '3', '1', '10869', '2023-07-05 16:05:59', '2');
INSERT INTO `quantity_logs` VALUES ('71', '1', '3', '1', '5250', '2023-07-05 16:07:48', '2');
INSERT INTO `quantity_logs` VALUES ('72', '1', '4', '1', '32', '2023-07-05 16:09:25', '2');
INSERT INTO `quantity_logs` VALUES ('73', '1', '4', '1', '32', '2023-07-05 16:09:42', '2');
INSERT INTO `quantity_logs` VALUES ('74', '1', '5', '1', '26', '2023-07-05 16:10:54', '2');
INSERT INTO `quantity_logs` VALUES ('75', '1', '5', '1', '26', '2023-07-05 16:10:59', '2');
INSERT INTO `quantity_logs` VALUES ('76', '1', '10', '1', '5000', '2023-07-05 16:26:42', '2');
INSERT INTO `quantity_logs` VALUES ('77', '1', '9', '1', '101', '2023-07-05 16:26:50', '2');
INSERT INTO `quantity_logs` VALUES ('78', '1', '7', '1', '464', '2023-07-05 16:26:57', '2');
INSERT INTO `quantity_logs` VALUES ('79', '1', '8', '1', '73', '2023-07-05 16:27:03', '2');
INSERT INTO `quantity_logs` VALUES ('80', '1', '9', '1', '101', '2023-07-05 16:27:08', '2');
INSERT INTO `quantity_logs` VALUES ('81', '1', '7', '1', '464', '2023-07-05 16:27:22', '2');
INSERT INTO `quantity_logs` VALUES ('82', '1', '8', '1', '73', '2023-07-05 16:27:36', '2');
INSERT INTO `quantity_logs` VALUES ('83', '1', '7', '1', '149', '2023-07-05 16:27:46', '2');
INSERT INTO `quantity_logs` VALUES ('84', '1', '8', '1', '27', '2023-07-05 16:28:13', '2');
INSERT INTO `quantity_logs` VALUES ('85', '1', '3', '1', '10869', '2023-07-05 16:31:01', '2');
INSERT INTO `quantity_logs` VALUES ('86', '1', '1', '1', '99999', '2023-07-05 16:31:15', '2');
INSERT INTO `quantity_logs` VALUES ('87', '1', '3', '1', '10869', '2023-07-05 16:31:21', '2');
INSERT INTO `quantity_logs` VALUES ('88', '1', '4', '1', '32', '2023-07-05 16:32:04', '2');
INSERT INTO `quantity_logs` VALUES ('89', '1', '3', '1', '1415', '2023-07-04 07:34:22', '3');
INSERT INTO `quantity_logs` VALUES ('90', '1', '3', '1', '9909', '2023-07-04 07:35:51', '3');
INSERT INTO `quantity_logs` VALUES ('91', '1', '3', '1', '725', '2023-07-04 07:43:53', '3');
INSERT INTO `quantity_logs` VALUES ('92', '1', '3', '1', '200', '2023-07-04 07:44:06', '3');
INSERT INTO `quantity_logs` VALUES ('93', '1', '3', '1', '257', '2023-07-04 07:44:14', '3');
INSERT INTO `quantity_logs` VALUES ('94', '1', '4', '1', '19', '2023-07-04 07:59:50', '3');
INSERT INTO `quantity_logs` VALUES ('95', '1', '4', '1', '3', '2023-07-04 08:00:30', '3');
INSERT INTO `quantity_logs` VALUES ('96', '1', '5', '1', '25', '2023-07-04 08:05:35', '3');
INSERT INTO `quantity_logs` VALUES ('97', '1', '3', '1', '6', '2023-07-05 06:17:10', '4');
INSERT INTO `quantity_logs` VALUES ('98', '1', '3', '1', '31', '2023-07-05 06:50:33', '4');
INSERT INTO `quantity_logs` VALUES ('99', '1', '3', '1', '8011', '2023-07-05 06:53:03', '4');
INSERT INTO `quantity_logs` VALUES ('100', '1', '4', '1', '383', '2023-07-05 07:00:58', '4');
INSERT INTO `quantity_logs` VALUES ('101', '1', '4', '1', '7', '2023-07-05 07:01:12', '4');
INSERT INTO `quantity_logs` VALUES ('102', '1', '4', '1', '4', '2023-07-05 07:01:30', '4');
INSERT INTO `quantity_logs` VALUES ('103', '1', '4', '1', '423', '2023-07-05 07:02:08', '4');
INSERT INTO `quantity_logs` VALUES ('104', '1', '4', '1', '99999', '2023-07-05 07:02:29', '4');
INSERT INTO `quantity_logs` VALUES ('105', '1', '4', '1', '423', '2023-07-05 07:02:42', '4');
INSERT INTO `quantity_logs` VALUES ('106', '1', '5', '1', '99999', '2023-07-05 07:03:23', '4');
INSERT INTO `quantity_logs` VALUES ('107', '1', '5', '1', '543', '2023-07-05 07:03:46', '4');
INSERT INTO `quantity_logs` VALUES ('108', '1', '3', '1', '731', '2023-07-05 07:09:22', '4');
INSERT INTO `quantity_logs` VALUES ('109', '1', '3', '1', '19', '2023-07-05 07:10:47', '4');
INSERT INTO `quantity_logs` VALUES ('110', '1', '3', '1', '19', '2023-07-05 07:10:55', '4');
INSERT INTO `quantity_logs` VALUES ('111', '1', '3', '1', '796', '2023-07-05 07:12:53', '4');

-- ----------------------------
-- Table structure for `reset_password`
-- ----------------------------
DROP TABLE IF EXISTS `reset_password`;
CREATE TABLE `reset_password` (
  `rst_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_id` int(11) DEFAULT NULL,
  `rst_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`rst_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

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
  PRIMARY KEY (`sls_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sales_reports
-- ----------------------------

-- ----------------------------
-- Table structure for `seal_types`
-- ----------------------------
DROP TABLE IF EXISTS `seal_types`;
CREATE TABLE `seal_types` (
  `seal_id` int(11) NOT NULL AUTO_INCREMENT,
  `seal_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`seal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of seal_types
-- ----------------------------
INSERT INTO `seal_types` VALUES ('1', 'Canister');
INSERT INTO `seal_types` VALUES ('2', 'Tank');

-- ----------------------------
-- Table structure for `status`
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `sts_id` int(11) NOT NULL AUTO_INCREMENT,
  `sts_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sts_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of status
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
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
  PRIMARY KEY (`stk_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of stocks_logs
-- ----------------------------
INSERT INTO `stocks_logs` VALUES ('1', '1', '3', null, '9849', '1', '0', '351929', '0', '0', '1554', '4300');
INSERT INTO `stocks_logs` VALUES ('2', '1', '4', null, '14535', '1', '0', '50045', '368', '0', '380', '408');
INSERT INTO `stocks_logs` VALUES ('3', '1', '5', null, '4629', '1', '0', '3062', '0', '0', '1938', '2010');
INSERT INTO `stocks_logs` VALUES ('4', '1', '7', null, '0', '1', '0', '500', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('5', '1', '8', null, '0', '1', '0', '116', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('6', '1', '9', null, '0', '1', '0', '150', '4', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('7', '1', '3', '9849', '24867', '2', '0', '351929', '10869', '0', '168', '0');
INSERT INTO `stocks_logs` VALUES ('8', '1', '4', '14535', '14567', '2', '0', '50045', '32', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('9', '1', '5', '4629', '4672', '2', '0', '3062', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('10', '1', '7', '0', '464', '2', '0', '0', '149', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('11', '1', '8', '0', '73', '2', '0', '0', '27', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('12', '1', '9', '0', '101', '2', '0', '101', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('13', '1', '3', '24867', '21984', '3', '0', '351929', '0', '0', '257', '200');
INSERT INTO `stocks_logs` VALUES ('14', '1', '4', '14567', '14208', '3', '0', '0', '19', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('15', '1', '5', '4672', '4787', '3', '0', '3062', '25', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('16', '1', '7', '464', '464', '3', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('17', '1', '8', '73', '73', '3', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('18', '1', '9', '101', '101', '3', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('19', '1', '3', '21984', null, '4', '0', '351929', '0', '25', '0', '0');
INSERT INTO `stocks_logs` VALUES ('20', '1', '4', '14208', null, '4', '0', '423', '0', '0', '4', '0');
INSERT INTO `stocks_logs` VALUES ('21', '1', '5', '4787', null, '4', '0', '3605', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('22', '1', '7', '464', null, '4', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('23', '1', '8', '73', null, '4', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('24', '1', '9', '101', null, '4', '0', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `stock_statuses`
-- ----------------------------
DROP TABLE IF EXISTS `stock_statuses`;
CREATE TABLE `stock_statuses` (
  `stk_id` int(11) NOT NULL AUTO_INCREMENT,
  `stk_opening` double DEFAULT NULL,
  `stk_closing` double DEFAULT NULL,
  `pdn_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`stk_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

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
  PRIMARY KEY (`verify_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of stock_verifications
-- ----------------------------
INSERT INTO `stock_verifications` VALUES ('1', '1', '0', null, null, null, null, null, '0', null, null, null, null, null, '0', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('2', '2', '2698000', null, null, null, null, null, '2698000', null, null, null, null, null, '0', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('3', '3', null, null, null, null, null, null, null, null, null, null, null, null, '1', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('4', '4', null, null, null, null, null, null, null, null, null, null, null, null, '1', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('5', '5', null, null, null, null, null, null, null, null, null, null, null, null, '1', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('6', '7', null, null, null, null, null, null, null, null, null, null, null, null, '1', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('7', '8', null, null, null, null, null, null, null, null, null, null, null, null, '1', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('8', '9', null, null, null, null, null, null, null, null, null, null, null, null, '1', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('9', '3', '9849', '4258', '0', '200', '1091', '4300', '24867', '11123', '8521', '32', '891', '4300', '1', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('10', '4', '14535', '1414', '12451', '55', '207', '408', '14567', '1381', '12516', '55', '207', '408', '1', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('11', '5', '4629', '1176', '97', '266', '1080', '2010', '4672', '1176', '140', '266', '1080', '2010', '1', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('12', '7', '0', '0', '0', '0', '0', '0', '464', '149', '315', '0', '0', '0', '1', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('13', '8', '0', '0', '0', '0', '0', '0', '73', '27', '46', '0', '0', '0', '1', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('14', '9', '0', '0', '0', '0', '0', '0', '101', '0', '101', '0', '0', '0', '1', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('15', '1', '1354950', null, null, null, null, null, '1354950', null, null, null, null, null, '0', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('16', '2', '4154000', null, null, null, null, null, '3475000', null, null, null, null, null, '0', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('17', '3', '24867', '11123', '8521', '32', '891', '4300', '21984', '8030', '8006', '300', '1148', '4500', '1', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('18', '4', '14567', '1381', '12516', '55', '207', '408', '14208', '1040', '12501', '55', '204', '408', '1', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('19', '5', '4672', '1176', '140', '266', '1080', '2010', '4787', '1201', '230', '266', '1080', '2010', '1', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('20', '7', '464', '149', '315', '0', '0', '0', '464', '149', '315', '0', '0', '0', '1', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('21', '8', '73', '27', '46', '0', '0', '0', '73', '27', '46', '0', '0', '0', '1', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('22', '9', '101', '0', '101', '0', '0', '0', '101', '0', '101', '0', '0', '0', '1', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('23', '1', '291000', null, null, null, null, null, '291000', null, null, null, null, null, '0', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('24', '2', '3475000', null, null, null, null, null, '3475000', null, null, null, null, null, '0', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('25', '3', '21984', '8030', '8006', '300', '1148', '4500', null, null, null, null, null, null, '1', '4', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('26', '4', '14208', '1040', '12501', '55', '204', '408', null, null, null, null, null, null, '1', '4', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('27', '5', '4787', '1201', '230', '266', '1080', '2010', null, null, null, null, null, null, '1', '4', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('28', '7', '464', '149', '315', '0', '0', '0', null, null, null, null, null, null, '1', '4', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('29', '8', '73', '27', '46', '0', '0', '0', null, null, null, null, null, null, '1', '4', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('30', '9', '101', '0', '101', '0', '0', '0', null, null, null, null, null, null, '1', '4', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('31', '1', '123000', null, null, null, null, null, null, null, null, null, null, null, '0', '4', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('32', '2', '1635000', null, null, null, null, null, null, null, null, null, null, null, '0', '4', '1', '1', '1');

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
  PRIMARY KEY (`sup_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES ('1', 'ef34h1dd1m5iad43z2m0xssh33le076h', '1', 'AGR Industrial Trading & Technical Solutions', 'Cebu City', '09222379398', null, null, '1');
INSERT INTO `suppliers` VALUES ('2', 'lid23cq73oksxaxph7ouah7pv586g0ef', '1', 'PEIDEWorth Marketing', 'Manila', '09171241999', null, null, '1');
INSERT INTO `suppliers` VALUES ('3', '1479g2t08yrky58mhleq6h4ckakhiw5q', '1', 'JOHN VELASCO', 'CEBU CITY', '09176855000', null, null, '1');
INSERT INTO `suppliers` VALUES ('4', 'y5a3rt3l21z0hv09coj6000loakpmrmr', '1', 'FERROTECH', 'MANILA', '0999999999', null, null, '1');

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
  PRIMARY KEY (`tnk_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tanks
-- ----------------------------
INSERT INTO `tanks` VALUES ('1', '1', 'Bullet Tank 1', '4154000', '50450', null, null, '1');
INSERT INTO `tanks` VALUES ('2', '1', 'Bullet Tank 2', '4154000', '228510', null, null, '1');

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
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tank_logs
-- ----------------------------
INSERT INTO `tank_logs` VALUES ('1', '1', '1', '0', '0', '1');
INSERT INTO `tank_logs` VALUES ('2', '1', '2', '2698000', '2698000', '1');
INSERT INTO `tank_logs` VALUES ('3', '1', '1', '1354950', '1354950', '2');
INSERT INTO `tank_logs` VALUES ('4', '1', '2', '4154000', '3475000', '2');
INSERT INTO `tank_logs` VALUES ('5', '1', '1', '291000', '291000', '3');
INSERT INTO `tank_logs` VALUES ('6', '1', '2', '3475000', '3475000', '3');
INSERT INTO `tank_logs` VALUES ('7', '1', '1', '123000', null, '4');
INSERT INTO `tank_logs` VALUES ('8', '1', '2', '1635000', null, '4');

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
  `trx_amount_paid` double(11,2) DEFAULT NULL,
  `trx_balance` double(11,2) DEFAULT NULL,
  `trx_gross` double(11,2) DEFAULT NULL,
  `trx_total` double(11,2) DEFAULT NULL,
  `trx_active` tinyint(2) DEFAULT '1',
  `trx_can_dec` varchar(30) DEFAULT NULL,
  `trx_del_rec` varchar(30) DEFAULT NULL,
  `trx_confirm` tinyint(1) DEFAULT '0',
  `trx_opposition_name` varchar(255) DEFAULT NULL,
  `pdn_id` int(30) DEFAULT NULL,
  PRIMARY KEY (`trx_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES ('1', 'POS-20230703-1', '1', '1', '5', '2023-07-03 15:04:12', '2023-07-03', '15:04:12', '0.00', '4010.00', '4010.00', '4010.00', '1', '7881', '3435', '0', null, '2');
INSERT INTO `transactions` VALUES ('2', 'POS-20230703-2', '1', '1', '25', '2023-07-03 15:06:51', '2023-07-03', '15:06:51', '0.00', '408.00', '408.00', '408.00', '1', '7882', '3436', '0', null, '2');
INSERT INTO `transactions` VALUES ('3', 'POS-20230703-3', '1', '1', '4', '2023-07-03 15:08:24', '2023-07-03', '15:08:24', '0.00', '9504.00', '9504.00', '9504.00', '1', '7883', '3437', '0', null, '2');
INSERT INTO `transactions` VALUES ('4', 'POS-20230703-4', '1', '1', '16', '2023-07-03 15:11:32', '2023-07-03', '15:11:32', '27324.00', '0.00', '27324.00', '27324.00', '1', '7658', '1-1191', '0', null, '2');
INSERT INTO `transactions` VALUES ('5', 'POS-20230703-5', '1', '1', '17', '2023-07-03 15:17:18', '2023-07-03', '15:17:18', '100.00', '0.00', '100.00', '100.00', '1', '7659', '1-1192', '0', null, '2');
INSERT INTO `transactions` VALUES ('6', 'POS-20230703-6', '1', '1', '14', '2023-07-03 15:18:54', '2023-07-03', '15:18:54', '11484.00', '0.00', '11484.00', '11484.00', '1', '7669', '1-1193', '0', null, '2');
INSERT INTO `transactions` VALUES ('7', 'POS-20230703-7', '1', '1', '8', '2023-07-03 15:19:22', '2023-07-03', '15:19:22', '1980.00', '0.00', '1980.00', '1980.00', '1', '7661', '1-1194', '0', null, '2');
INSERT INTO `transactions` VALUES ('8', 'POS-20230703-8', '1', '1', '26', '2023-07-03 15:21:22', '2023-07-03', '15:21:22', '1584.00', '0.00', '1584.00', '1584.00', '1', '7662', '1-1195', '0', null, '2');
INSERT INTO `transactions` VALUES ('9', 'POS-20230703-9', '1', '1', '17', '2023-07-03 15:22:14', '2023-07-03', '15:22:14', '100.00', '0.00', '100.00', '100.00', '1', '7663', '1-1196', '0', null, '2');
INSERT INTO `transactions` VALUES ('10', 'POS-20230703-10', '1', '1', '6', '2023-07-03 15:22:55', '2023-07-03', '15:22:55', '2376.00', '0.00', '2376.00', '2376.00', '1', '7664', '1-1197', '0', null, '2');
INSERT INTO `transactions` VALUES ('11', 'POS-20230703-11', '1', '1', '13', '2023-07-03 15:27:51', '2023-07-03', '15:27:51', '3033.00', '0.00', '2772.00', '3033.00', '1', '7665', '1-1198', '0', null, '2');
INSERT INTO `transactions` VALUES ('12', 'POS-20230703-12', '1', '1', '17', '2023-07-03 15:30:04', '2023-07-03', '15:30:04', '2800.00', '0.00', '1200.00', '2800.00', '1', '7666', '1-1199', '0', null, '2');
INSERT INTO `transactions` VALUES ('13', 'POS-20230703-13', '1', '1', '27', '2023-07-03 15:31:38', '2023-07-03', '15:31:38', '4554.00', '0.00', '4554.00', '4554.00', '1', '7667', '1-1200', '0', null, '2');
INSERT INTO `transactions` VALUES ('14', 'POS-20230704-14', '1', '1', '3', '2023-07-04 06:16:27', '2023-07-04', '06:16:27', '0.00', '48708.00', '48708.00', '48708.00', '1', '7884', '2438', '0', null, '3');
INSERT INTO `transactions` VALUES ('15', 'POS-20230704-15', '1', '1', '10', '2023-07-04 06:18:25', '2023-07-04', '06:18:25', '0.00', '53760.00', '53760.00', '53760.00', '1', '7885', '2439', '0', null, '3');
INSERT INTO `transactions` VALUES ('16', 'POS-20230704-16', '1', '1', '25', '2023-07-04 06:19:10', '2023-07-04', '06:19:10', '408.00', '0.00', '408.00', '408.00', '1', '7886', '2441', '0', null, '3');
INSERT INTO `transactions` VALUES ('17', 'POS-20230704-17', '1', '1', '16', '2023-07-04 06:21:25', '2023-07-04', '06:21:25', '17820.00', '0.00', '17820.00', '17820.00', '1', '5001', '1-1201', '0', null, '3');
INSERT INTO `transactions` VALUES ('18', 'POS-20230704-18', '1', '1', '23', '2023-07-04 06:24:38', '2023-07-04', '06:24:38', '2805.00', '0.00', '2805.00', '2805.00', '1', '5002', '1-1202', '0', null, '3');
INSERT INTO `transactions` VALUES ('19', 'POS-20230704-19', '1', '1', '14', '2023-07-04 06:25:43', '2023-07-04', '06:25:43', '9900.00', '0.00', '9900.00', '9900.00', '1', '5003', '1-1203', '0', null, '3');
INSERT INTO `transactions` VALUES ('20', 'POS-20230704-20', '1', '1', '26', '2023-07-04 06:26:29', '2023-07-04', '06:26:29', '1980.00', '0.00', '1980.00', '1980.00', '1', '5004', '1-1204', '0', null, '3');
INSERT INTO `transactions` VALUES ('21', 'POS-20230704-21', '1', '1', '8', '2023-07-04 06:26:55', '2023-07-04', '06:26:55', '1980.00', '0.00', '1980.00', '1980.00', '1', '5005', '1-1205', '0', null, '3');
INSERT INTO `transactions` VALUES ('22', 'POS-20230704-22', '1', '1', '28', '2023-07-04 06:28:16', '2023-07-04', '06:28:16', '2640.00', '0.00', '2640.00', '2640.00', '1', '5006', '1-1206', '0', null, '3');
INSERT INTO `transactions` VALUES ('23', 'POS-20230704-23', '1', '1', '29', '2023-07-04 06:30:07', '2023-07-04', '06:30:07', '2772.00', '0.00', '2772.00', '2772.00', '1', '5007', '1-1207', '0', null, '3');
INSERT INTO `transactions` VALUES ('24', 'POS-20230704-24', '1', '1', '16', '2023-07-04 06:31:03', '2023-07-04', '06:31:03', '7128.00', '0.00', '7128.00', '7128.00', '1', '5008', '1-1208', '0', null, '3');
INSERT INTO `transactions` VALUES ('25', 'POS-20230704-25', '1', '1', '27', '2023-07-04 06:32:03', '2023-07-04', '06:32:03', '2475.00', '0.00', '2475.00', '2475.00', '1', '5009', '1-1209', '0', null, '3');
INSERT INTO `transactions` VALUES ('26', 'POS-20230704-26', '1', '1', '11', '2023-07-04 06:34:25', '2023-07-04', '06:34:25', '2618.00', '0.00', '2574.00', '2618.00', '1', '5010', '1-1210', '0', null, '3');
INSERT INTO `transactions` VALUES ('27', 'POS-20230704-27', '1', '1', '6', '2023-07-04 06:35:09', '2023-07-04', '06:35:09', '3960.00', '0.00', '3960.00', '3960.00', '1', '5011', '1-1211', '0', null, '3');
INSERT INTO `transactions` VALUES ('28', 'POS-20230704-28', '1', '1', '18', '2023-07-04 07:51:52', '2023-07-04', '07:51:52', '0.00', '79020.00', '63360.00', '79020.00', '1', '7889', '2440', '0', null, '3');
INSERT INTO `transactions` VALUES ('29', 'POS-20230705-29', '1', '1', '17', '2023-07-05 06:10:31', '2023-07-05', '06:10:31', '180.00', '0.00', '180.00', '180.00', '1', '5023', '1-1223', '0', null, '4');
INSERT INTO `transactions` VALUES ('30', 'POS-20230705-30', '1', '1', '27', '2023-07-05 06:12:50', '2023-07-05', '06:12:50', '2376.00', '0.00', '2376.00', '2376.00', '1', '5022', '1-1222', '0', null, '4');
INSERT INTO `transactions` VALUES ('31', 'POS-20230705-31', '1', '1', '6', '2023-07-05 06:14:17', '2023-07-05', '06:14:17', '3564.00', '0.00', '3564.00', '3564.00', '1', '5021', '1-1221', '0', null, '4');
INSERT INTO `transactions` VALUES ('32', 'POS-20230705-32', '1', '1', '16', '2023-07-05 06:15:49', '2023-07-05', '06:15:49', '2376.00', '0.00', '2376.00', '2376.00', '1', '5020', '1-1220', '0', null, '4');
INSERT INTO `transactions` VALUES ('33', 'POS-20230705-33', '1', '1', '26', '2023-07-05 06:19:49', '2023-07-05', '06:19:49', '2376.00', '0.00', '2376.00', '2376.00', '1', '5019', '1-1119', '0', null, '4');
INSERT INTO `transactions` VALUES ('34', 'POS-20230705-34', '1', '1', '8', '2023-07-05 06:21:10', '2023-07-05', '06:21:10', '1980.00', '0.00', '1980.00', '1980.00', '1', '5018', '1-1218', '0', null, '4');
INSERT INTO `transactions` VALUES ('35', 'POS-20230705-35', '1', '1', '14', '2023-07-05 06:22:44', '2023-07-05', '06:22:44', '6336.00', '0.00', '6336.00', '6336.00', '1', '5017', '1-1217', '0', null, '4');
INSERT INTO `transactions` VALUES ('36', 'POS-20230705-36', '1', '1', '17', '2023-07-05 06:31:03', '2023-07-05', '06:31:03', '520.00', '0.00', '480.00', '520.00', '1', '5016', '1-1216', '0', null, '4');
INSERT INTO `transactions` VALUES ('37', 'POS-20230705-37', '1', '1', '16', '2023-07-05 06:33:38', '2023-07-05', '06:33:38', '15840.00', '0.00', '15840.00', '15840.00', '1', '5015', '1-1215', '0', null, '4');
INSERT INTO `transactions` VALUES ('38', 'POS-20230705-38', '1', '1', '23', '2023-07-05 06:34:39', '2023-07-05', '06:34:39', '2640.00', '0.00', '2640.00', '2640.00', '1', '5014', '1-1214', '0', null, '4');
INSERT INTO `transactions` VALUES ('39', 'POS-20230705-39', '1', '1', '17', '2023-07-05 06:35:34', '2023-07-05', '06:35:34', '320.00', '0.00', '320.00', '320.00', '1', '5013', '1-1213', '0', null, '4');
INSERT INTO `transactions` VALUES ('40', 'POS-20230705-40', '1', '1', '17', '2023-07-05 06:36:57', '2023-07-05', '06:36:57', '320.00', '0.00', '200.00', '320.00', '1', '5012', '1-1212', '0', null, '4');
INSERT INTO `transactions` VALUES ('41', 'POS-20230710-41', '1', '1', '1', '2023-07-10 18:55:50', '2023-07-10', '18:55:50', '0.00', '22.00', '22.00', '22.00', '1', '123213', '123123', '0', null, '4');
INSERT INTO `transactions` VALUES ('42', 'POS-20230710-42', '1', '1', '1', '2023-07-10 18:57:29', '2023-07-10', '18:57:29', '12.00', '9.50', '21.50', '21.50', '1', '123213', '123123', '0', null, '4');

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
  PRIMARY KEY (`usr_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', '6f50pqput79g23armdbcz7axftw97r97', 'Super Admin', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'University of Malagos', '1.png', '1', '1');
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
  PRIMARY KEY (`typ_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of user_types
-- ----------------------------
INSERT INTO `user_types` VALUES ('1', 'Administrator');
INSERT INTO `user_types` VALUES ('2', 'Employee');
INSERT INTO `user_types` VALUES ('3', 'Observer');
INSERT INTO `user_types` VALUES ('4', 'Plant Manager');
INSERT INTO `user_types` VALUES ('5', 'Supervisor');
