/*
Navicat MySQL Data Transfer

Source Server         : MADAYAW GAS LIVE
Source Server Version : 50742
Source Host           : 184.168.116.167:3306
Source Database       : madayaw

Target Server Type    : MYSQL
Target Server Version : 50742
File Encoding         : 65001

Date: 2023-07-15 18:49:51
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of bad_orders
-- ----------------------------
INSERT INTO `bad_orders` VALUES ('1', 'BO-20230601-1', '1', '3', '3', null, '3', '2023-06-01', '09:41:41', '2023-06-01 09:41:41');
INSERT INTO `bad_orders` VALUES ('2', 'BO-20230705-2', '1', '32', '3', null, '6', '2023-07-05', '06:17:10', '2023-07-05 06:17:10');
INSERT INTO `bad_orders` VALUES ('3', 'BO-20230711-3', '1', '13', '3', null, '1', '2023-07-11', '18:48:21', '2023-07-11 18:48:21');

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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

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
INSERT INTO `customers` VALUES ('19', '1', 'i8wmzlus8jpv5148t624iiq1o6nhsi9u', 'ALFREDO ALCE', 'PRK. 13 TIBUNGCO', '09094702448', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('20', '1', '3gxmpz72gbjnh61sarregkh1g11wwhsl', 'ROLAN REYES', 'MAHAYAG,BUNAWAN', '09093839344', '0', '3,', '18,', null, null, '1');
INSERT INTO `customers` VALUES ('21', '1', '9wej1cucm5riy86owos4syfac346oaiu', 'HLI', 'SASA', '0999999999', '0', '3,', '18,', null, null, '1');
INSERT INTO `customers` VALUES ('22', '1', 'o4ez3wtwvp62rvp9i1prjnn7axzx5e52', 'GEORGE/ROLAN', 'CRYSTAL MEADOWS,SASA', '09292979703', '0', '3,4,', '19.60,19.60,', null, null, '1');
INSERT INTO `customers` VALUES ('23', '1', '21a25heqso3nplynndeac3mb0qm7690r', 'ROMY TARZO', 'SASA STORE/ PANACAN MALAGAMOT DROP', '09467432991', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('24', '1', 'vp85xzmn3u8cks357wlnti62xhtjzhpt', 'OROGATES', 'KM 10 SASA DAVAO CITY', '09177775909', '0', '7,8,9,', '561.22,561.22,2446,', null, null, '1');
INSERT INTO `customers` VALUES ('25', '1', 'e39sb1lfeo6cnrshejrwm5eghc4vbm9t', 'JUNE COSTILLAS', 'DAVAO', '09111111111', '0', '3,4,', '17,17,', null, null, '1');
INSERT INTO `customers` VALUES ('26', '1', 'emuirv7xqpn1lx4zi2cvnrlent1xcauf', 'HENRY ANG', 'DAVAO', '09111111111', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('27', '1', '2frf15i9uogksbgih2qkvjvt35juv87b', 'FREDDIE ALCE', 'DAVAO', '09111111111', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('28', '1', 'jwujgcqfmk4zfyxjbi45gkvnm7dm8fie', 'RONALD BANOG', 'DAVAO', '09111111111', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('29', '1', '5wsscz00klkfzeasw2tc9udv7di8srnb', 'ORLIE BANQUIL', 'DAVAO', '09111111111', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('30', '1', 'uyd3pznjmqi092hofs74bw1d2jgb7uft', 'MARIO YEE', 'DAVAO CITY', '09111111111', '0', '3,4,', '16.5,16.5,', null, null, '1');
INSERT INTO `customers` VALUES ('31', '1', 'fu3jw1l1as9j4tdjnl44lh08oy8usqe0', 'AGRIPINO OBUS', 'DAVAO CITY', '09876543444', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('32', '1', 'vcbjz6uhff5665loahjhi2kzwvudd5bw', 'NOEL BALAGOT', 'Davao City', '09866547322', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('33', '1', '1xdp2z6u5cmxwkq5gnt26sejlasm942b', 'ROMEO OGTIP', 'Davao City', '09876543212', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('34', '1', 'srxku70rf7p1swylhgioci2c3kwq7gvr', 'JOAN PADILLA', 'Davao City', '09866345762', '0', '3,', '16.50,', null, null, '1');
INSERT INTO `customers` VALUES ('35', '1', '1pb3mo8rlf79oo6e5a8fpl2et6sjc6ip', 'MacMac Abude', 'davao city', '091909976', '0', '3,6,11,', '16.50,440.00,250.00,', null, null, '1');
INSERT INTO `customers` VALUES ('36', '1', 'j1thcac3jz05yxq1sorxmx6q1ldtg4eh', 'Darken Vulcanizing', 'davao city', '0919000000', '0', '3,4,6,', '18,18,440.00,', null, null, '1');
INSERT INTO `customers` VALUES ('37', '1', 'katwmc0xn08j516cn2n52xzx2xpuii58', 'Marlon mession', 'davao city', null, '0', '3,', '16.50,', null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of movement_logs
-- ----------------------------
INSERT INTO `movement_logs` VALUES ('1', '1', '3', '8536', '0', '0', '0', '0', '1', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('2', '1', '3', '0', '1', '0', '0', '0', '6', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('3', '1', '3', '0', '0', '516', '0', '0', '1', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('4', '1', '3', '516', '0', '0', '0', '0', '1', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('5', '1', '3', '0', '396', '0', '0', '0', '1', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('6', '1', '3', '0', '24', '0', '0', '0', '1', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('7', '1', '3', '0', '0', '7753', '0', '0', '1', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('8', '1', '4', '0', '0', '156', '0', '0', '1', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('9', '1', '4', '2', '0', '0', '0', '0', '1', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('10', '1', '4', '0', '0', '4', '0', '0', '1', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('11', '1', '4', '4', '0', '0', '0', '0', '1', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('12', '1', '4', '0', '4', '0', '0', '0', '1', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('13', '1', '4', '0', '0', '0', '0', '4', '1', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('14', '1', '5', '0', '0', '10', '0', '0', '1', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('15', '1', '5', '34', '0', '0', '0', '0', '1', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('16', '1', '5', '0', '3', '0', '0', '0', '1', '2023-07-11', '2');
INSERT INTO `movement_logs` VALUES ('17', '1', '3', '6190', '0', '0', '0', '0', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('18', '1', '3', '0', '0', '146', '0', '0', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('19', '1', '3', '3604', '0', '0', '0', '0', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('20', '1', '3', '0', '24', '0', '0', '0', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('21', '1', '3', '0', '0', '181', '0', '0', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('22', '1', '3', '0', '0', '0', '0', '80', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('23', '1', '3', '0', '0', '0', '3', '0', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('24', '1', '3', '0', '0', '3', '0', '0', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('25', '1', '4', '0', '0', '0', '0', '4', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('26', '1', '4', '4', '0', '0', '0', '0', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('27', '1', '4', '0', '4', '0', '0', '0', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('28', '1', '4', '0', '0', '269', '0', '0', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('29', '1', '5', '0', '0', '0', '0', '22', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('30', '1', '5', '0', '0', '22', '0', '0', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('31', '1', '5', '0', '22', '0', '0', '0', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('32', '1', '5', '25', '0', '0', '0', '0', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('33', '1', '5', '0', '0', '216', '0', '0', '1', '2023-07-13', '3');
INSERT INTO `movement_logs` VALUES ('34', '1', '3', '8739', '0', '0', '0', '0', '1', '2023-07-13', '4');
INSERT INTO `movement_logs` VALUES ('35', '1', '4', '477', '0', '0', '0', '0', '1', '2023-07-13', '4');
INSERT INTO `movement_logs` VALUES ('36', '1', '5', '275', '0', '0', '0', '0', '1', '2023-07-13', '4');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of oppositions
-- ----------------------------
INSERT INTO `oppositions` VALUES ('1', 'ypd1oerm2xfg3jxaq1zz9ejemjjce0sv', 'TRIPLER', 'TRIPLER', 'TRIPLER', '2291', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('2', 'brvyrfw8t0teazmcspcivzz91sjkzwn5', 'BUDGET GAS', 'BUDGET GAS', 'BUDGET GAS', '25', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('3', '88o8gnjcvxfafiwm57jmhuohyv4ww0k4', 'RUFRANCE', 'RUFRANCE', 'RUFRANCE', '16677', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('4', 'qbvqih6liz0rmk5pbbjmizxar5ifzc8n', 'PEPC', 'PEPC', 'PEPC', '1733', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('5', 'fjk1a403z8xeh16qhniub5cl1fpyj7pe', 'AGILA', 'AGILA', 'AGILA', '905', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('6', '01debiko2t4ederqbbvm41aq09h9ddtu', 'JEAM GAS', 'JEAM GAS', 'JEAM GAS', '90', null, null, '1', '1');
INSERT INTO `oppositions` VALUES ('7', null, 'EMPTY', 'EMPTY', 'EMPTY', '264', null, 'EMPTY FROM MADAYAW', '1', '1');
INSERT INTO `oppositions` VALUES ('8', null, 'SILYO', 'SILYO', 'OPPOSITION', null, null, null, '1', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
INSERT INTO `payments` VALUES ('1', '55', 'PMT-20230711-55', '1', '7144.50', null, '6', '2023-07-11', '17:34:49', '1', '7144.50', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '56', 'PMT-20230711-56', '2', '60.00', null, '6', '2023-07-11', '17:36:51', '1', '60.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '57', 'PMT-20230711-57', '3', '4752.00', null, '6', '2023-07-11', '17:38:40', '1', '4752.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '58', 'PMT-20230711-58', '4', '140.00', null, '6', '2023-07-11', '17:51:24', '1', '140.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '59', 'PMT-20230711-59', '5', '1980.00', null, '6', '2023-07-11', '17:52:26', '1', '1980.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '60', 'PMT-20230711-60', '6', '1798.50', null, '6', '2023-07-11', '17:53:44', '1', '1798.50', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '61', 'PMT-20230711-61', '7', '1980.00', null, '6', '2023-07-11', '17:55:32', '1', '1980.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '62', 'PMT-20230711-62', '8', '11088.00', null, '6', '2023-07-11', '18:32:26', '1', '11088.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '63', 'PMT-20230711-63', '9', '20592.00', null, '6', '2023-07-11', '18:34:29', '1', '20592.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '64', 'PMT-20230711-64', '10', '0.00', null, '6', '2023-07-11', '18:36:49', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '65', 'PMT20230711-65', '10', '2970.00', null, '6', '2023-07-11', '18:38:33', '1', '2970.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '66', 'PMT-20230711-66', '11', '784.00', null, '6', '2023-07-11', '18:43:08', '1', '784.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '67', 'PMT-20230711-67', '12', '1386.00', null, '6', '2023-07-11', '18:44:57', '1', '1386.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '68', 'PMT-20230711-68', '13', '0.00', null, '6', '2023-07-11', '18:47:17', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '69', 'PMT-20230711-69', '14', '1386.00', null, '6', '2023-07-11', '19:01:18', '1', '1386.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '70', 'PMT-20230711-70', '15', '0.00', null, '6', '2023-07-11', '19:11:53', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '71', 'PMT-20230711-71', '16', '1980.00', null, '1', '2023-07-11', '19:38:45', '1', '1980.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '72', 'PMT-20230713-72', '18', '3168.00', null, '1', '2023-07-13', '11:26:17', '1', '3168.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '73', 'PMT-20230713-73', '19', '18216.00', null, '1', '2023-07-13', '11:28:15', '1', '18216.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '74', 'PMT-20230713-74', '20', '1980.00', null, '1', '2023-07-13', '11:31:00', '1', '1980.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '75', 'PMT-20230713-75', '21', '2607.00', null, '1', '2023-07-13', '11:33:58', '1', '2607.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '76', 'PMT-20230713-76', '22', '5148.00', null, '1', '2023-07-13', '11:36:04', '1', '5148.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '77', 'PMT-20230713-77', '23', '2376.00', null, '1', '2023-07-13', '11:37:55', '1', '2376.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '78', 'PMT-20230713-78', '24', '1980.00', null, '1', '2023-07-13', '11:39:45', '1', '1980.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '79', 'PMT-20230713-79', '25', '1584.00', null, '1', '2023-07-13', '11:40:57', '1', '1584.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '80', 'PMT-20230713-80', '26', '1320.00', null, '1', '2023-07-13', '11:42:03', '1', '1320.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '81', 'PMT-20230713-81', '27', '2376.00', null, '1', '2023-07-13', '11:42:46', '1', '2376.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '82', 'PMT-20230713-82', '28', '2062.50', null, '1', '2023-07-13', '11:46:48', '1', '2062.50', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '83', 'PMT-20230713-83', '29', '3366.00', null, '1', '2023-07-13', '11:48:46', '1', '3366.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '84', 'PMT-20230713-84', '30', '2178.00', null, '1', '2023-07-13', '11:51:34', '1', '2178.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '85', 'PMT-20230713-85', '31', '0.00', null, '1', '2023-07-13', '12:54:00', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '86', 'PMT-20230713-86', '32', '63426.00', null, '1', '2023-07-13', '21:49:15', '1', '63426.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '87', 'PMT-20230713-87', '33', '5676.00', null, '1', '2023-07-13', '23:24:16', '1', '5676.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '88', 'PMT-20230713-88', '34', '17820.00', null, '1', '2023-07-13', '23:26:59', '1', '17820.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '89', 'PMT-20230713-89', '35', '2772.00', null, '1', '2023-07-13', '23:28:03', '1', '2772.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '90', 'PMT-20230713-90', '36', '8514.00', null, '1', '2023-07-13', '23:37:10', '1', '8514.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '91', 'PMT-20230713-91', '37', '2376.00', null, '1', '2023-07-13', '23:40:23', '1', '2376.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '92', 'PMT-20230713-92', '38', '1188.00', null, '1', '2023-07-13', '23:42:30', '1', '1188.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '93', 'PMT-20230713-93', '39', '2376.00', null, '1', '2023-07-13', '23:45:26', '1', '2376.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '94', 'PMT-20230713-94', '40', '3168.00', null, '1', '2023-07-13', '23:46:31', '1', '3168.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '95', 'PMT-20230713-95', '41', '2376.00', null, '1', '2023-07-13', '23:47:44', '1', '2376.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '96', 'PMT-20230713-96', '42', '1980.00', null, '1', '2023-07-13', '23:48:56', '1', '1980.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '97', 'PMT-20230713-97', '43', '180.00', null, '1', '2023-07-13', '23:49:56', '1', '180.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '98', 'PMT-20230713-98', '44', '120.00', null, '1', '2023-07-13', '23:51:20', '1', '120.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '99', 'PMT-20230713-99', '45', '10296.00', null, '1', '2023-07-13', '23:54:01', '1', '10296.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '100', 'PMT-20230714-100', '46', '2550.00', null, '1', '2023-07-13', '00:00:24', '1', '2550.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '101', 'PMT-20230714-101', '47', '0.00', null, '1', '2023-07-14', '00:05:28', '2', '0.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '102', 'PMT-20230714-102', '48', '2593.50', null, '6', '2023-07-14', '18:47:39', '1', '2593.50', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '103', 'PMT-20230714-103', '49', '260.00', null, '6', '2023-07-14', '18:50:30', '1', '260.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '104', 'PMT-20230714-104', '50', '280.00', null, '6', '2023-07-14', '18:52:36', '1', '280.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '105', 'PMT-20230714-105', '51', '100.00', null, '6', '2023-07-14', '18:54:42', '1', '100.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '106', 'PMT-20230714-106', '52', '1650.00', null, '6', '2023-07-14', '19:19:43', '1', '1650.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '107', 'PMT-20230714-107', '53', '1980.00', null, '6', '2023-07-14', '19:22:55', '1', '1980.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '108', 'PMT-20230714-108', '54', '5346.00', null, '6', '2023-07-14', '19:25:31', '1', '5346.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '109', 'PMT-20230714-109', '55', '1584.00', null, '6', '2023-07-14', '19:27:53', '1', '1584.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '110', 'PMT-20230714-110', '56', '16236.00', null, '6', '2023-07-14', '19:31:10', '1', '16236.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '111', 'PMT-20230714-111', '57', '2772.00', null, '6', '2023-07-14', '19:33:37', '1', '2772.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '112', 'PMT-20230714-112', '58', '3168.00', null, '6', '2023-07-14', '19:36:20', '1', '3168.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '113', 'PMT-20230714-113', '59', '3960.00', null, '6', '2023-07-14', '19:39:11', '1', '3960.00', '0.00', null, null);
INSERT INTO `payments` VALUES ('1', '114', 'PMT-20230714-114', '60', '2392.50', null, '6', '2023-07-14', '19:41:09', '1', '2392.50', '0.00', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of production_logs
-- ----------------------------
INSERT INTO `production_logs` VALUES ('1', '2023-07-11', '02:12:18', '10:06:03');
INSERT INTO `production_logs` VALUES ('2', '2023-07-11', '02:15:18', '10:06:03');
INSERT INTO `production_logs` VALUES ('3', '2023-07-13', '11:22:11', '10:06:03');
INSERT INTO `production_logs` VALUES ('4', '2023-07-13', '08:21:21', '10:06:03');
INSERT INTO `production_logs` VALUES ('5', '2023-07-13', '17:32:59', '10:06:03');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '1', '0eqfa2whjhx90s8nrw83q987g9kl1stj', 'Seal', 'seal', 'seal', null, null, '0.00', '47086', '0', '0', '0', '0', '360000', null, '1', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('2', '1', '316xf5bh9z85yj265ssfxhlyrhsmxh0n', 'Valve', 'valve', 'valve', null, null, '0.00', '72561', '0', '0', '0', '0', '500000', null, '2', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('3', '1', '6f0lokdgcxp3xjp6pi62qnjy7ibugrna', 'Round', 'Madayaw Round Canister', 'MR170', null, '0.00', '60.00', '6345', '455', '12333', '84', '4695', '10000', null, '1', '1', '1', '1', '1', '170.00', '84512', '2', '1');
INSERT INTO `products` VALUES ('4', '1', '03z7lbrja07ypsfva0f91y7i3h9bv73m', 'Square', 'Madayaw Square Canister', 'MS170', null, '0.00', '60.00', '794', '13', '13016', '238', '3074', '10000', null, '2', '1', '1', '1', '1', '170.00', '99147', '2', '1');
INSERT INTO `products` VALUES ('5', '1', 'lm4p6zbx0dcjc6ixwnk36pea2ax12byi', 'Botin', 'Botin Canister', 'Botin170', null, '0.00', '70.00', '1381', '253', '93', '1258', '2023', '10000', null, '2', '1', '1', '1', '1', '170.00', '99230', '2', '1');
INSERT INTO `products` VALUES ('6', '1', 'f1g86czlex1cyk4z3k1s0k7uuiwhdfce', 'PORTABLE STOVE', 'PORTABLE STOVE', 'PORTABLE STOVE', null, '440.00', '0.00', '0', '0', '0', '0', '0', '1500', null, '3', '1', '0', '0', '1', null, '0', null, null);
INSERT INTO `products` VALUES ('7', '1', 'pjq863zmt5nf4fh8ixtihap1jpe79ll0', 'A/S TYPE TANK', '11KG. A/S TYPE', '11KG. A/S TYPE', null, '601.87', '0.00', '149', '0', '315', '0', '0', '500', null, '4', '1', '1', '1', '1', '11000.00', '0', '2', '10');
INSERT INTO `products` VALUES ('8', '1', 'ohizg8boensypacr64haelqhrhsmoi8g', 'POL TYPE TANK', '11KG POL TYPE', '11KG POL TYPE', null, '601.87', '602.00', '0', '0', '50', '0', '0', '500', null, '4', '1', '1', '1', '1', '11000.00', '0', '2', '10');
INSERT INTO `products` VALUES ('9', '1', '3ny79p9wo9mzoc13wtehuhh66zkysof0', '50KG POL TYPE', '5OKG POL TYPE', '50KG POL TYPE', null, '0.00', '2631.00', '63', '0', '41', '0', '0', '500', null, '4', '1', '1', '1', '1', '50000.00', '0', '2', '10');
INSERT INTO `products` VALUES ('10', '1', 'xthe4184cjs15zaoqfcanahn4bzpekpe', 'Tank Seal', 'tank seal', 'TANKSEAL', null, null, '0.00', '4824', '0', '0', '0', '0', '10000', null, '1', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('11', '1', 'uao3gwrp5vrysp0kgd14a7pjz4jmd5k3', 'CRATE', 'CRATE', 'CRATE', null, '250.00', '0.00', '0', '0', '0', '0', '0', '2000', null, '2', '1', '0', '0', '1', null, '0', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of purchases
-- ----------------------------
INSERT INTO `purchases` VALUES ('1', '1', '3', '0', '1', '0.00', '0.00', '16.50', '1', '16.50', '5', '0', '1', '1');
INSERT INTO `purchases` VALUES ('2', '1', '3', '3', '6', '0.00', '0.00', '693.00', '42', '16.50', '3', '3', '6', '2');
INSERT INTO `purchases` VALUES ('3', '1', '3', '32', '6', '0.00', '0.00', '6435.00', '390', '16.50', '3', '32', '6', '1');
INSERT INTO `purchases` VALUES ('4', '2', '3', '0', '1', '0.00', '0.00', '20.00', '1', '20.00', '1', '0', '1', '2');
INSERT INTO `purchases` VALUES ('5', '2', '3', '0', '2', '0.00', '0.00', '40.00', '2', '20.00', '3', '0', '2', '1');
INSERT INTO `purchases` VALUES ('6', '3', '3', '5', '4', '0.00', '0.00', '1056.00', '64', '16.50', '3', '5', '4', '2');
INSERT INTO `purchases` VALUES ('7', '3', '3', '5', '0', '0.00', '0.00', '990.00', '60', '16.50', '1', '5', '0', '2');
INSERT INTO `purchases` VALUES ('8', '3', '3', '0', '2', '0.00', '0.00', '33.00', '2', '16.50', '5', '0', '2', '1');
INSERT INTO `purchases` VALUES ('9', '3', '3', '13', '6', '0.00', '0.00', '2673.00', '162', '16.50', '3', '13', '6', '1');
INSERT INTO `purchases` VALUES ('10', '4', '3', '0', '7', '0.00', '0.00', '140.00', '7', '20.00', '3', '0', '7', '1');
INSERT INTO `purchases` VALUES ('11', '5', '3', '10', '0', '0.00', '0.00', '1980.00', '120', '16.50', '3', '10', '0', '1');
INSERT INTO `purchases` VALUES ('12', '6', '3', '9', '1', '0.00', '0.00', '1798.50', '109', '16.50', '3', '9', '1', '1');
INSERT INTO `purchases` VALUES ('13', '7', '3', '0', '6', '0.00', '0.00', '99.00', '6', '16.50', '3', '0', '6', '2');
INSERT INTO `purchases` VALUES ('14', '7', '3', '1', '10', '0.00', '0.00', '363.00', '22', '16.50', '1', '1', '10', '2');
INSERT INTO `purchases` VALUES ('15', '7', '3', '7', '8', '0.00', '0.00', '1518.00', '92', '16.50', '3', '7', '8', '1');
INSERT INTO `purchases` VALUES ('16', '8', '3', '5', '0', '0.00', '0.00', '990.00', '60', '16.50', '3', '5', '0', '2');
INSERT INTO `purchases` VALUES ('17', '8', '3', '14', '1', '0.00', '0.00', '2788.50', '169', '16.50', '1', '14', '1', '2');
INSERT INTO `purchases` VALUES ('18', '8', '3', '36', '11', '0.00', '0.00', '7309.50', '443', '16.50', '3', '36', '11', '1');
INSERT INTO `purchases` VALUES ('19', '9', '3', '10', '0', '0.00', '0.00', '1980.00', '120', '16.50', '3', '10', '0', '2');
INSERT INTO `purchases` VALUES ('20', '9', '3', '14', '0', '0.00', '0.00', '2772.00', '168', '16.50', '1', '14', '0', '2');
INSERT INTO `purchases` VALUES ('21', '9', '3', '80', '0', '0.00', '0.00', '15840.00', '960', '16.50', '3', '80', '0', '1');
INSERT INTO `purchases` VALUES ('22', '10', '3', '0', '9', '0.00', '0.00', '148.50', '9', '16.50', '1', '0', '9', '2');
INSERT INTO `purchases` VALUES ('23', '10', '3', '14', '3', '0.00', '0.00', '2821.50', '171', '16.50', '3', '14', '3', '1');
INSERT INTO `purchases` VALUES ('24', '11', '3', '0', '7', '0.00', '240.00', '291.00', '7', '17.00', '1', '0', '3', '2');
INSERT INTO `purchases` VALUES ('25', '11', '3', '0', '1', '0.00', '0.00', '17.00', '1', '17.00', '5', '0', '1', '1');
INSERT INTO `purchases` VALUES ('26', '11', '3', '2', '4', '0.00', '0.00', '476.00', '28', '17.00', '3', '2', '4', '1');
INSERT INTO `purchases` VALUES ('27', '12', '3', '1', '4', '0.00', '0.00', '264.00', '16', '16.50', '3', '1', '4', '2');
INSERT INTO `purchases` VALUES ('28', '12', '3', '0', '4', '0.00', '0.00', '66.00', '4', '16.50', '1', '0', '4', '2');
INSERT INTO `purchases` VALUES ('29', '12', '3', '5', '4', '0.00', '0.00', '1056.00', '64', '16.50', '3', '5', '4', '1');
INSERT INTO `purchases` VALUES ('30', '13', '3', '0', '4', '0.00', '0.00', '66.00', '4', '16.50', '3', '0', '4', '2');
INSERT INTO `purchases` VALUES ('31', '13', '3', '4', '10', '0.00', '0.00', '957.00', '58', '16.50', '1', '4', '10', '2');
INSERT INTO `purchases` VALUES ('32', '13', '3', '0', '2', '0.00', '0.00', '33.00', '2', '16.50', '5', '0', '2', '1');
INSERT INTO `purchases` VALUES ('33', '13', '3', '55', '2', '0.00', '0.00', '10923.00', '662', '16.50', '3', '55', '2', '1');
INSERT INTO `purchases` VALUES ('34', '13', '4', '1', '6', '0.00', '0.00', '297.00', '18', '16.50', '4', '1', '6', '1');
INSERT INTO `purchases` VALUES ('35', '14', '3', '0', '9', '0.00', '0.00', '148.50', '9', '16.50', '1', '0', '9', '2');
INSERT INTO `purchases` VALUES ('36', '14', '3', '6', '3', '0.00', '0.00', '1237.50', '75', '16.50', '3', '6', '3', '1');
INSERT INTO `purchases` VALUES ('37', '15', '9', '0', '7', '0.00', '0.00', '17122.00', '7', '2446.00', '9', '0', '7', '1');
INSERT INTO `purchases` VALUES ('38', '16', '3', '0', '3', '0.00', '0.00', '49.50', '3', '16.50', '3', '0', '3', '2');
INSERT INTO `purchases` VALUES ('39', '16', '3', '2', '9', '0.00', '0.00', '544.50', '33', '16.50', '1', '2', '9', '2');
INSERT INTO `purchases` VALUES ('40', '16', '3', '7', '0', '0.00', '0.00', '1386.00', '84', '16.50', '3', '7', '0', '1');
INSERT INTO `purchases` VALUES ('41', '17', '3', '150', '0', '0.00', '0.00', '0.00', '1800', '0.00', '1', '0', '0', '1');
INSERT INTO `purchases` VALUES ('42', '18', '3', '6', '2', '0.00', '0.00', '1221.00', '74', '16.50', '1', '6', '2', '2');
INSERT INTO `purchases` VALUES ('43', '18', '3', '9', '10', '0.00', '0.00', '1947.00', '118', '16.50', '3', '9', '10', '1');
INSERT INTO `purchases` VALUES ('44', '19', '3', '4', '0', '0.00', '0.00', '792.00', '48', '16.50', '3', '4', '0', '2');
INSERT INTO `purchases` VALUES ('45', '19', '3', '14', '0', '0.00', '0.00', '2772.00', '168', '16.50', '1', '14', '0', '2');
INSERT INTO `purchases` VALUES ('46', '19', '3', '2', '0', '0.00', '0.00', '396.00', '24', '16.50', '5', '2', '0', '1');
INSERT INTO `purchases` VALUES ('47', '19', '3', '72', '0', '0.00', '0.00', '14256.00', '864', '16.50', '3', '72', '0', '1');
INSERT INTO `purchases` VALUES ('48', '20', '3', '2', '0', '0.00', '0.00', '396.00', '24', '16.50', '1', '2', '0', '2');
INSERT INTO `purchases` VALUES ('49', '20', '3', '8', '0', '0.00', '0.00', '1584.00', '96', '16.50', '3', '8', '0', '1');
INSERT INTO `purchases` VALUES ('50', '21', '3', '4', '10', '0.00', '0.00', '957.00', '58', '16.50', '3', '4', '10', '2');
INSERT INTO `purchases` VALUES ('51', '21', '3', '0', '10', '0.00', '0.00', '165.00', '10', '16.50', '1', '0', '10', '2');
INSERT INTO `purchases` VALUES ('52', '21', '3', '7', '6', '0.00', '0.00', '1485.00', '90', '16.50', '3', '7', '6', '1');
INSERT INTO `purchases` VALUES ('53', '22', '3', '1', '1', '0.00', '0.00', '214.50', '13', '16.50', '3', '1', '1', '2');
INSERT INTO `purchases` VALUES ('54', '22', '3', '5', '7', '0.00', '0.00', '1105.50', '67', '16.50', '1', '5', '7', '2');
INSERT INTO `purchases` VALUES ('55', '22', '3', '0', '8', '0.00', '0.00', '132.00', '8', '16.50', '5', '0', '8', '1');
INSERT INTO `purchases` VALUES ('56', '22', '3', '18', '8', '0.00', '0.00', '3696.00', '224', '16.50', '3', '18', '8', '1');
INSERT INTO `purchases` VALUES ('57', '23', '3', '0', '9', '0.00', '0.00', '148.50', '9', '16.50', '3', '0', '9', '2');
INSERT INTO `purchases` VALUES ('58', '23', '3', '1', '2', '0.00', '0.00', '231.00', '14', '16.50', '1', '1', '2', '2');
INSERT INTO `purchases` VALUES ('59', '23', '3', '10', '1', '0.00', '0.00', '1996.50', '121', '16.50', '3', '10', '1', '1');
INSERT INTO `purchases` VALUES ('60', '24', '3', '0', '6', '0.00', '0.00', '99.00', '6', '16.50', '3', '0', '6', '2');
INSERT INTO `purchases` VALUES ('61', '24', '3', '0', '7', '0.00', '0.00', '115.50', '7', '16.50', '1', '0', '7', '2');
INSERT INTO `purchases` VALUES ('62', '24', '3', '0', '1', '0.00', '0.00', '16.50', '1', '16.50', '5', '0', '1', '1');
INSERT INTO `purchases` VALUES ('63', '24', '3', '8', '10', '0.00', '0.00', '1749.00', '106', '16.50', '3', '8', '10', '1');
INSERT INTO `purchases` VALUES ('64', '25', '3', '0', '4', '0.00', '0.00', '66.00', '4', '16.50', '3', '0', '4', '2');
INSERT INTO `purchases` VALUES ('65', '25', '3', '1', '0', '0.00', '0.00', '198.00', '12', '16.50', '1', '1', '0', '2');
INSERT INTO `purchases` VALUES ('66', '25', '3', '0', '2', '0.00', '0.00', '33.00', '2', '16.50', '5', '0', '2', '1');
INSERT INTO `purchases` VALUES ('67', '25', '3', '6', '6', '0.00', '0.00', '1287.00', '78', '16.50', '3', '6', '6', '1');
INSERT INTO `purchases` VALUES ('68', '26', '3', '6', '8', '0.00', '0.00', '1320.00', '80', '16.50', '3', '6', '8', '1');
INSERT INTO `purchases` VALUES ('69', '27', '3', '12', '0', '0.00', '0.00', '2376.00', '144', '16.50', '3', '12', '0', '1');
INSERT INTO `purchases` VALUES ('70', '28', '3', '0', '2', '0.00', '0.00', '33.00', '2', '16.50', '5', '0', '2', '1');
INSERT INTO `purchases` VALUES ('71', '28', '3', '0', '6', '0.00', '0.00', '99.00', '6', '16.50', '3', '0', '6', '2');
INSERT INTO `purchases` VALUES ('72', '28', '3', '5', '0', '0.00', '0.00', '990.00', '60', '16.50', '1', '5', '0', '2');
INSERT INTO `purchases` VALUES ('73', '28', '3', '4', '7', '0.00', '0.00', '907.50', '55', '16.50', '3', '4', '7', '1');
INSERT INTO `purchases` VALUES ('74', '28', '3', '0', '2', '0.00', '0.00', '33.00', '2', '16.50', '4', '0', '2', '1');
INSERT INTO `purchases` VALUES ('75', '29', '3', '0', '4', '0.00', '0.00', '66.00', '4', '16.50', '3', '0', '4', '2');
INSERT INTO `purchases` VALUES ('76', '29', '3', '5', '10', '0.00', '0.00', '1155.00', '70', '16.50', '1', '5', '10', '2');
INSERT INTO `purchases` VALUES ('77', '29', '3', '10', '10', '0.00', '0.00', '2145.00', '130', '16.50', '3', '10', '10', '1');
INSERT INTO `purchases` VALUES ('78', '30', '3', '0', '2', '0.00', '0.00', '33.00', '2', '16.50', '3', '0', '2', '2');
INSERT INTO `purchases` VALUES ('79', '30', '3', '1', '5', '0.00', '0.00', '280.50', '17', '16.50', '1', '1', '5', '2');
INSERT INTO `purchases` VALUES ('80', '30', '3', '9', '5', '0.00', '0.00', '1864.50', '113', '16.50', '3', '9', '5', '1');
INSERT INTO `purchases` VALUES ('81', '31', '4', '2', '0', '0.00', '1440.00', '1440.00', '24', '20.00', '4', '0', '0', '1');
INSERT INTO `purchases` VALUES ('82', '31', '3', '4', '0', '0.00', '2880.00', '2880.00', '48', '20.00', '3', '0', '0', '1');
INSERT INTO `purchases` VALUES ('83', '32', '3', '300', '4', '0.00', '0.00', '59466.00', '3604', '16.50', '3', '300', '4', '1');
INSERT INTO `purchases` VALUES ('84', '32', '4', '17', '0', '0.00', '0.00', '3366.00', '204', '16.50', '4', '17', '0', '1');
INSERT INTO `purchases` VALUES ('85', '32', '4', '3', '0', '0.00', '0.00', '594.00', '36', '16.50', '1', '3', '0', '2');
INSERT INTO `purchases` VALUES ('86', '33', '3', '2', '4', '0.00', '0.00', '462.00', '28', '16.50', '3', '2', '4', '2');
INSERT INTO `purchases` VALUES ('87', '33', '3', '26', '4', '0.00', '0.00', '5214.00', '316', '16.50', '3', '26', '4', '1');
INSERT INTO `purchases` VALUES ('88', '34', '3', '6', '4', '0.00', '0.00', '1254.00', '76', '16.50', '3', '6', '4', '2');
INSERT INTO `purchases` VALUES ('89', '34', '3', '17', '0', '0.00', '0.00', '3366.00', '204', '16.50', '1', '17', '0', '2');
INSERT INTO `purchases` VALUES ('90', '34', '3', '0', '8', '0.00', '0.00', '132.00', '8', '16.50', '5', '0', '8', '1');
INSERT INTO `purchases` VALUES ('91', '34', '3', '66', '0', '0.00', '0.00', '13068.00', '792', '16.50', '3', '66', '0', '1');
INSERT INTO `purchases` VALUES ('92', '35', '3', '3', '0', '0.00', '0.00', '594.00', '36', '16.50', '3', '3', '0', '2');
INSERT INTO `purchases` VALUES ('93', '35', '3', '11', '0', '0.00', '0.00', '2178.00', '132', '16.50', '3', '11', '0', '1');
INSERT INTO `purchases` VALUES ('94', '36', '3', '6', '0', '0.00', '0.00', '1188.00', '72', '16.50', '1', '6', '0', '2');
INSERT INTO `purchases` VALUES ('95', '36', '3', '3', '0', '0.00', '0.00', '594.00', '36', '16.50', '5', '3', '0', '1');
INSERT INTO `purchases` VALUES ('96', '36', '3', '34', '0', '0.00', '0.00', '6732.00', '408', '16.50', '3', '34', '0', '1');
INSERT INTO `purchases` VALUES ('97', '37', '3', '11', '0', '0.00', '0.00', '2376.00', '132', '18.00', '3', '11', '0', '1');
INSERT INTO `purchases` VALUES ('98', '38', '3', '0', '7', '0.00', '0.00', '115.50', '7', '16.50', '3', '0', '7', '2');
INSERT INTO `purchases` VALUES ('99', '38', '3', '1', '2', '0.00', '0.00', '231.00', '14', '16.50', '1', '1', '2', '2');
INSERT INTO `purchases` VALUES ('100', '38', '3', '0', '1', '0.00', '0.00', '16.50', '1', '16.50', '5', '0', '1', '1');
INSERT INTO `purchases` VALUES ('101', '38', '3', '4', '2', '0.00', '0.00', '825.00', '50', '16.50', '3', '4', '2', '1');
INSERT INTO `purchases` VALUES ('102', '39', '3', '1', '0', '0.00', '0.00', '198.00', '12', '16.50', '3', '1', '0', '2');
INSERT INTO `purchases` VALUES ('103', '39', '3', '0', '5', '0.00', '0.00', '82.50', '5', '16.50', '5', '0', '5', '1');
INSERT INTO `purchases` VALUES ('104', '39', '3', '10', '7', '0.00', '0.00', '2095.50', '127', '16.50', '3', '10', '7', '1');
INSERT INTO `purchases` VALUES ('105', '40', '3', '0', '4', '0.00', '0.00', '66.00', '4', '16.50', '3', '0', '4', '2');
INSERT INTO `purchases` VALUES ('106', '40', '3', '2', '3', '0.00', '0.00', '445.50', '27', '16.50', '1', '2', '3', '2');
INSERT INTO `purchases` VALUES ('107', '40', '3', '13', '5', '0.00', '0.00', '2656.50', '161', '16.50', '3', '13', '5', '1');
INSERT INTO `purchases` VALUES ('108', '41', '3', '2', '1', '0.00', '0.00', '412.50', '25', '16.50', '3', '2', '1', '2');
INSERT INTO `purchases` VALUES ('109', '41', '3', '0', '11', '0.00', '0.00', '181.50', '11', '16.50', '1', '0', '11', '2');
INSERT INTO `purchases` VALUES ('110', '41', '3', '9', '0', '0.00', '0.00', '1782.00', '108', '16.50', '3', '9', '0', '1');
INSERT INTO `purchases` VALUES ('111', '42', '3', '0', '6', '0.00', '0.00', '99.00', '6', '16.50', '3', '0', '6', '2');
INSERT INTO `purchases` VALUES ('112', '42', '3', '1', '6', '0.00', '0.00', '297.00', '18', '16.50', '1', '1', '6', '2');
INSERT INTO `purchases` VALUES ('113', '42', '3', '8', '0', '0.00', '0.00', '1584.00', '96', '16.50', '3', '8', '0', '1');
INSERT INTO `purchases` VALUES ('114', '43', '3', '0', '5', '0.00', '0.00', '100.00', '5', '20.00', '1', '0', '5', '2');
INSERT INTO `purchases` VALUES ('115', '43', '3', '0', '4', '0.00', '0.00', '80.00', '4', '20.00', '3', '0', '4', '1');
INSERT INTO `purchases` VALUES ('116', '44', '3', '0', '2', '0.00', '0.00', '40.00', '2', '20.00', '1', '0', '2', '2');
INSERT INTO `purchases` VALUES ('117', '44', '3', '0', '3', '0.00', '0.00', '60.00', '3', '20.00', '3', '0', '3', '1');
INSERT INTO `purchases` VALUES ('118', '44', '3', '0', '1', '0.00', '0.00', '20.00', '1', '20.00', '4', '0', '1', '1');
INSERT INTO `purchases` VALUES ('119', '45', '3', '11', '11', '0.00', '0.00', '2359.50', '143', '16.50', '3', '11', '11', '1');
INSERT INTO `purchases` VALUES ('120', '45', '3', '31', '6', '0.00', '0.00', '6237.00', '378', '16.50', '3', '31', '6', '2');
INSERT INTO `purchases` VALUES ('121', '45', '3', '8', '6', '0.00', '0.00', '1683.00', '102', '16.50', '1', '8', '6', '2');
INSERT INTO `purchases` VALUES ('122', '45', '3', '0', '1', '0.00', '0.00', '16.50', '1', '16.50', '5', '0', '1', '1');
INSERT INTO `purchases` VALUES ('123', '46', '3', '0', '13', '0.00', '240.00', '388.50', '13', '16.50', '3', '0', '9', '2');
INSERT INTO `purchases` VALUES ('124', '46', '3', '2', '11', '0.00', '0.00', '577.50', '35', '16.50', '1', '2', '11', '2');
INSERT INTO `purchases` VALUES ('125', '46', '3', '0', '1', '0.00', '0.00', '16.50', '1', '16.50', '5', '0', '1', '1');
INSERT INTO `purchases` VALUES ('126', '46', '3', '6', '9', '0.00', '0.00', '1336.50', '81', '16.50', '3', '6', '9', '1');
INSERT INTO `purchases` VALUES ('127', '46', '3', '1', '2', '0.00', '0.00', '231.00', '14', '16.50', '4', '1', '2', '1');
INSERT INTO `purchases` VALUES ('128', '47', '3', '2', '11', '0.00', '0.00', '490.00', '35', '14.00', '3', '2', '11', '2');
INSERT INTO `purchases` VALUES ('129', '47', '3', '27', '3', '0.00', '0.00', '4578.00', '327', '14.00', '1', '27', '3', '2');
INSERT INTO `purchases` VALUES ('130', '47', '3', '2', '10', '0.00', '0.00', '476.00', '34', '14.00', '5', '2', '10', '1');
INSERT INTO `purchases` VALUES ('131', '47', '3', '386', '7', '0.00', '0.00', '64946.00', '4639', '14.00', '3', '386', '7', '1');
INSERT INTO `purchases` VALUES ('132', '47', '3', '0', '5', '0.00', '0.00', '70.00', '5', '14.00', '4', '0', '5', '1');
INSERT INTO `purchases` VALUES ('133', '48', '3', '2', '7', '0.00', '300.00', '729.00', '31', '16.50', '3', '2', '2', '2');
INSERT INTO `purchases` VALUES ('134', '48', '3', '2', '9', '0.00', '0.00', '544.50', '33', '16.50', '1', '2', '9', '2');
INSERT INTO `purchases` VALUES ('135', '48', '3', '0', '1', '0.00', '0.00', '16.50', '1', '16.50', '5', '0', '1', '1');
INSERT INTO `purchases` VALUES ('136', '48', '3', '6', '7', '0.00', '0.00', '1303.50', '79', '16.50', '3', '6', '7', '1');
INSERT INTO `purchases` VALUES ('137', '49', '3', '0', '11', '0.00', '0.00', '220.00', '11', '20.00', '3', '0', '11', '1');
INSERT INTO `purchases` VALUES ('138', '49', '3', '0', '2', '0.00', '0.00', '40.00', '2', '20.00', '4', '0', '2', '1');
INSERT INTO `purchases` VALUES ('139', '50', '3', '1', '2', '0.00', '0.00', '280.00', '14', '20.00', '3', '1', '2', '1');
INSERT INTO `purchases` VALUES ('140', '51', '3', '0', '1', '0.00', '0.00', '20.00', '1', '20.00', '1', '0', '1', '2');
INSERT INTO `purchases` VALUES ('141', '51', '3', '0', '4', '0.00', '0.00', '80.00', '4', '20.00', '3', '0', '4', '1');
INSERT INTO `purchases` VALUES ('142', '52', '3', '0', '6', '0.00', '0.00', '99.00', '6', '16.50', '3', '0', '6', '2');
INSERT INTO `purchases` VALUES ('143', '52', '3', '0', '7', '0.00', '0.00', '115.50', '7', '16.50', '1', '0', '7', '2');
INSERT INTO `purchases` VALUES ('144', '52', '3', '7', '3', '0.00', '0.00', '1435.50', '87', '16.50', '3', '7', '3', '1');
INSERT INTO `purchases` VALUES ('145', '53', '3', '2', '9', '0.00', '1980.00', '1980.00', '33', '20.00', '3', '0', '0', '1');
INSERT INTO `purchases` VALUES ('146', '54', '3', '1', '0', '0.00', '0.00', '198.00', '12', '16.50', '3', '1', '0', '2');
INSERT INTO `purchases` VALUES ('147', '54', '3', '3', '0', '0.00', '0.00', '594.00', '36', '16.50', '1', '3', '0', '2');
INSERT INTO `purchases` VALUES ('148', '54', '3', '23', '0', '0.00', '0.00', '4554.00', '276', '16.50', '3', '23', '0', '1');
INSERT INTO `purchases` VALUES ('149', '55', '3', '0', '4', '0.00', '0.00', '66.00', '4', '16.50', '3', '0', '4', '2');
INSERT INTO `purchases` VALUES ('150', '55', '3', '1', '7', '0.00', '0.00', '313.50', '19', '16.50', '1', '1', '7', '2');
INSERT INTO `purchases` VALUES ('151', '55', '3', '6', '1', '0.00', '0.00', '1204.50', '73', '16.50', '3', '6', '1', '1');
INSERT INTO `purchases` VALUES ('152', '56', '3', '5', '11', '0.00', '0.00', '1171.50', '71', '16.50', '3', '5', '11', '2');
INSERT INTO `purchases` VALUES ('153', '56', '3', '10', '2', '0.00', '0.00', '2013.00', '122', '16.50', '1', '10', '2', '2');
INSERT INTO `purchases` VALUES ('154', '56', '3', '0', '10', '0.00', '0.00', '165.00', '10', '16.50', '5', '0', '10', '1');
INSERT INTO `purchases` VALUES ('155', '56', '3', '65', '1', '0.00', '0.00', '12886.50', '781', '16.50', '3', '65', '1', '1');
INSERT INTO `purchases` VALUES ('156', '57', '3', '3', '2', '0.00', '0.00', '627.00', '38', '16.50', '3', '3', '2', '2');
INSERT INTO `purchases` VALUES ('157', '57', '3', '3', '5', '0.00', '0.00', '676.50', '41', '16.50', '1', '3', '5', '2');
INSERT INTO `purchases` VALUES ('158', '57', '3', '0', '5', '0.00', '0.00', '82.50', '5', '16.50', '5', '0', '5', '1');
INSERT INTO `purchases` VALUES ('159', '57', '3', '7', '0', '0.00', '0.00', '1386.00', '84', '16.50', '3', '7', '0', '1');
INSERT INTO `purchases` VALUES ('160', '58', '3', '2', '0', '0.00', '0.00', '396.00', '24', '16.50', '1', '2', '0', '2');
INSERT INTO `purchases` VALUES ('161', '58', '3', '14', '0', '0.00', '0.00', '2772.00', '168', '16.50', '3', '14', '0', '1');
INSERT INTO `purchases` VALUES ('162', '59', '3', '0', '4', '0.00', '0.00', '66.00', '4', '16.50', '3', '0', '4', '2');
INSERT INTO `purchases` VALUES ('163', '59', '3', '3', '1', '0.00', '0.00', '610.50', '37', '16.50', '1', '3', '1', '2');
INSERT INTO `purchases` VALUES ('164', '59', '3', '0', '3', '0.00', '0.00', '49.50', '3', '16.50', '5', '0', '3', '1');
INSERT INTO `purchases` VALUES ('165', '59', '3', '16', '4', '0.00', '0.00', '3234.00', '196', '16.50', '3', '16', '4', '1');
INSERT INTO `purchases` VALUES ('166', '60', '3', '1', '7', '0.00', '0.00', '313.50', '19', '16.50', '1', '1', '7', '2');
INSERT INTO `purchases` VALUES ('167', '60', '3', '10', '6', '0.00', '0.00', '2079.00', '126', '16.50', '3', '10', '6', '1');
INSERT INTO `purchases` VALUES ('168', '61', '3', '250', '0', '0.00', '0.00', '0.00', '3000', '0.00', '1', '0', '0', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of quantity_logs
-- ----------------------------
INSERT INTO `quantity_logs` VALUES ('1', '1', '3', '1', '8536', '2023-07-11 03:25:44', '2');
INSERT INTO `quantity_logs` VALUES ('2', '1', '3', '1', '8536', '2023-07-11 03:26:06', '2');
INSERT INTO `quantity_logs` VALUES ('3', '1', '3', '6', '1', '2023-07-11 03:48:21', '2');
INSERT INTO `quantity_logs` VALUES ('4', '1', '3', '1', '516', '2023-07-11 20:53:10', '2');
INSERT INTO `quantity_logs` VALUES ('5', '1', '3', '1', '516', '2023-07-11 20:53:18', '2');
INSERT INTO `quantity_logs` VALUES ('6', '1', '3', '1', '396', '2023-07-11 20:53:30', '2');
INSERT INTO `quantity_logs` VALUES ('7', '1', '3', '1', '24', '2023-07-11 20:53:58', '2');
INSERT INTO `quantity_logs` VALUES ('8', '1', '3', '1', '7753', '2023-07-11 20:54:49', '2');
INSERT INTO `quantity_logs` VALUES ('9', '1', '4', '1', '156', '2023-07-11 20:58:29', '2');
INSERT INTO `quantity_logs` VALUES ('10', '1', '4', '1', '2', '2023-07-11 20:58:45', '2');
INSERT INTO `quantity_logs` VALUES ('11', '1', '4', '1', '4', '2023-07-11 20:59:30', '2');
INSERT INTO `quantity_logs` VALUES ('12', '1', '4', '1', '4', '2023-07-11 20:59:39', '2');
INSERT INTO `quantity_logs` VALUES ('13', '1', '4', '1', '4', '2023-07-11 20:59:46', '2');
INSERT INTO `quantity_logs` VALUES ('14', '1', '4', '1', '4', '2023-07-11 21:00:04', '2');
INSERT INTO `quantity_logs` VALUES ('15', '1', '5', '1', '10', '2023-07-11 21:03:50', '2');
INSERT INTO `quantity_logs` VALUES ('16', '1', '5', '1', '34', '2023-07-11 21:04:25', '2');
INSERT INTO `quantity_logs` VALUES ('17', '1', '5', '1', '3', '2023-07-11 21:04:37', '2');
INSERT INTO `quantity_logs` VALUES ('18', '1', '1', '8', '3475000', '2023-07-12 06:06:18', '2');
INSERT INTO `quantity_logs` VALUES ('19', '1', '2', '8', '2821000', '2023-07-12 06:46:32', '2');
INSERT INTO `quantity_logs` VALUES ('20', '1', '2', '8', '123000', '2023-07-12 06:56:59', '2');
INSERT INTO `quantity_logs` VALUES ('21', '1', '3', '1', '6190', '2023-07-13 21:42:47', '3');
INSERT INTO `quantity_logs` VALUES ('22', '1', '3', '1', '146', '2023-07-13 21:50:43', '3');
INSERT INTO `quantity_logs` VALUES ('23', '1', '3', '1', '3604', '2023-07-13 21:51:03', '3');
INSERT INTO `quantity_logs` VALUES ('24', '1', '3', '1', '24', '2023-07-13 21:59:29', '3');
INSERT INTO `quantity_logs` VALUES ('25', '1', '3', '1', '181', '2023-07-13 22:02:25', '3');
INSERT INTO `quantity_logs` VALUES ('26', '1', '3', '1', '80', '2023-07-13 22:03:18', '3');
INSERT INTO `quantity_logs` VALUES ('27', '1', '3', '1', '3', '2023-07-13 22:03:22', '3');
INSERT INTO `quantity_logs` VALUES ('28', '1', '3', '1', '3', '2023-07-13 22:03:25', '3');
INSERT INTO `quantity_logs` VALUES ('29', '1', '4', '1', '4', '2023-07-13 22:05:41', '3');
INSERT INTO `quantity_logs` VALUES ('30', '1', '4', '1', '4', '2023-07-13 22:05:54', '3');
INSERT INTO `quantity_logs` VALUES ('31', '1', '4', '1', '4', '2023-07-13 22:05:59', '3');
INSERT INTO `quantity_logs` VALUES ('32', '1', '4', '1', '269', '2023-07-13 22:06:33', '3');
INSERT INTO `quantity_logs` VALUES ('33', '1', '5', '1', '22', '2023-07-13 22:07:52', '3');
INSERT INTO `quantity_logs` VALUES ('34', '1', '5', '1', '22', '2023-07-13 22:09:00', '3');
INSERT INTO `quantity_logs` VALUES ('35', '1', '5', '1', '22', '2023-07-13 22:09:35', '3');
INSERT INTO `quantity_logs` VALUES ('36', '1', '5', '1', '25', '2023-07-13 22:09:53', '3');
INSERT INTO `quantity_logs` VALUES ('37', '1', '5', '1', '216', '2023-07-13 22:10:09', '3');
INSERT INTO `quantity_logs` VALUES ('38', '1', '1', '1', '680', '2023-07-13 22:36:00', '3');
INSERT INTO `quantity_logs` VALUES ('39', '1', '1', '1', '1725230', '2023-07-13 22:54:47', '3');
INSERT INTO `quantity_logs` VALUES ('40', '1', '2', '1', '56000', '2023-07-13 22:54:58', '3');
INSERT INTO `quantity_logs` VALUES ('41', '1', '3', '1', '8739', '2023-07-13 09:17:17', '4');
INSERT INTO `quantity_logs` VALUES ('42', '1', '4', '1', '477', '2023-07-13 09:17:42', '4');
INSERT INTO `quantity_logs` VALUES ('43', '1', '5', '1', '275', '2023-07-13 09:17:51', '4');

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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of stock_verifications
-- ----------------------------
INSERT INTO `stock_verifications` VALUES ('1', '3', '19220', '1211', '13036', '93', '265', '4615', '19220', '1211', '13036', '93', '265', '4615', '1', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('2', '4', '16742', '597', '12828', '13', '238', '3066', '16742', '597', '12828', '13', '238', '3066', '1', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('3', '5', '4634', '1072', '31', '250', '1280', '2001', '4634', '1072', '31', '250', '1280', '2001', '1', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('4', '7', '464', '149', '315', '0', '0', '0', '464', '149', '315', '0', '0', '0', '1', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('5', '8', '50', '0', '50', '0', '0', '0', '50', '0', '50', '0', '0', '0', '1', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('6', '9', '104', '70', '34', '0', '0', '0', '104', '70', '34', '0', '0', '0', '1', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('7', '1', '1063000', null, null, null, null, null, '1063000', null, null, null, null, null, '0', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('8', '2', '3475000', null, null, null, null, null, '3475000', null, null, null, null, null, '0', '1', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('9', '3', '19220', '1211', '13036', '93', '265', '4615', '26628', '5612', '15622', '514', '265', '4615', '1', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('10', '4', '16742', '597', '12828', '13', '238', '3066', '16902', '581', '13000', '13', '238', '3070', '1', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('11', '5', '4634', '1072', '31', '250', '1280', '2001', '4650', '1103', '13', '253', '1280', '2001', '1', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('12', '7', '464', '149', '315', '0', '0', '0', '464', '149', '315', '0', '0', '0', '1', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('13', '8', '50', '0', '50', '0', '0', '0', '50', '0', '50', '0', '0', '0', '1', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('14', '9', '104', '70', '34', '0', '0', '0', '104', '63', '41', '0', '0', '0', '1', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('15', '1', '1063000', null, null, null, null, null, '123000', null, null, null, null, null, '0', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('16', '2', '3475000', null, null, null, null, null, '2821000', null, null, null, null, null, '0', '2', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('17', '3', '26628', '5612', '15622', '514', '265', '4615', null, null, null, null, null, null, '1', '3', '1', '4', '8');
INSERT INTO `stock_verifications` VALUES ('18', '4', '16902', '581', '13000', '13', '238', '3070', null, null, null, null, null, null, '1', '3', '1', '4', '8');
INSERT INTO `stock_verifications` VALUES ('19', '5', '4650', '1103', '13', '253', '1280', '2001', null, null, null, null, null, null, '1', '3', '1', '4', '8');
INSERT INTO `stock_verifications` VALUES ('20', '7', '464', '149', '315', '0', '0', '0', null, null, null, null, null, null, '1', '3', '1', '4', '8');
INSERT INTO `stock_verifications` VALUES ('21', '8', '50', '0', '50', '0', '0', '0', null, null, null, null, null, null, '1', '3', '1', '4', '8');
INSERT INTO `stock_verifications` VALUES ('22', '9', '104', '63', '41', '0', '0', '0', null, null, null, null, null, null, '1', '3', '1', '4', '8');
INSERT INTO `stock_verifications` VALUES ('23', '1', '123000', null, null, null, null, null, '3531000', null, null, null, null, null, '0', '3', '1', '4', '1');
INSERT INTO `stock_verifications` VALUES ('24', '2', '2821000', null, null, null, null, null, '3531000', null, null, null, null, null, '0', '3', '1', '4', '1');
INSERT INTO `stock_verifications` VALUES ('25', '3', '26628', '5612', '15622', '514', '265', '4615', '26014', '8799', '11981', '455', '84', '4695', '1', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('26', '4', '16902', '581', '13000', '13', '238', '3070', '17113', '317', '13471', '13', '238', '3074', '1', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('27', '5', '4650', '1103', '13', '253', '1280', '2001', '4903', '1106', '263', '253', '1258', '2023', '1', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('28', '7', '464', '149', '315', '0', '0', '0', '464', '149', '315', '0', '0', '0', '1', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('29', '8', '50', '0', '50', '0', '0', '0', '50', '0', '50', '0', '0', '0', '1', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('30', '9', '104', '63', '41', '0', '0', '0', '104', '63', '41', '0', '0', '0', '1', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('31', '1', '3598000', null, null, null, null, null, '3531000', null, null, null, null, null, '0', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('32', '2', '3598000', null, null, null, null, null, '3531000', null, null, null, null, null, '0', '3', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('33', '3', '26014', '8799', '11981', '455', '84', '4695', '24471', '8803', '10434', '455', '84', '4695', '1', '4', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('34', '4', '17113', '317', '13471', '13', '238', '3074', '17133', '794', '13014', '13', '238', '3074', '1', '4', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('35', '5', '4903', '1106', '263', '253', '1258', '2023', '4989', '1381', '74', '253', '1258', '2023', '1', '4', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('36', '7', '464', '149', '315', '0', '0', '0', '464', '149', '315', '0', '0', '0', '1', '4', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('37', '8', '50', '0', '50', '0', '0', '0', '50', '0', '50', '0', '0', '0', '1', '4', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('38', '9', '104', '63', '41', '0', '0', '0', '104', '63', '41', '0', '0', '0', '1', '4', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('39', '1', '3531000', null, null, null, null, null, '1917530', null, null, null, null, null, '0', '4', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('40', '2', '3531000', null, null, null, null, null, '3531000', null, null, null, null, null, '0', '4', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('41', '3', '24471', '8803', '10434', '455', '84', '4695', '23912', '6345', '12333', '455', '84', '4695', '1', '5', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('42', '4', '17133', '794', '13014', '13', '238', '3074', '17135', '794', '13016', '13', '238', '3074', '1', '5', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('43', '5', '4989', '1381', '74', '253', '1258', '2023', '5008', '1381', '93', '253', '1258', '2023', '1', '5', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('44', '7', '464', '149', '315', '0', '0', '0', '464', '149', '315', '0', '0', '0', '1', '5', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('45', '8', '50', '0', '50', '0', '0', '0', '50', '0', '50', '0', '0', '0', '1', '5', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('46', '9', '104', '63', '41', '0', '0', '0', '104', '63', '41', '0', '0', '0', '1', '5', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('47', '1', '1917530', null, null, null, null, null, '0', null, null, null, null, null, '0', '5', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('48', '2', '3531000', null, null, null, null, null, '0', null, null, null, null, null, '0', '5', '1', '1', '1');
INSERT INTO `stock_verifications` VALUES ('49', '3', null, null, null, null, null, null, '23912', '6345', '12333', '455', '84', '4695', '1', '5', '1', '4', '8');
INSERT INTO `stock_verifications` VALUES ('50', '4', null, null, null, null, null, null, '17135', '794', '13016', '13', '238', '3074', '1', '5', '1', '4', '8');
INSERT INTO `stock_verifications` VALUES ('51', '5', null, null, null, null, null, null, '5008', '1381', '93', '253', '1258', '2023', '1', '5', '1', '4', '8');
INSERT INTO `stock_verifications` VALUES ('52', '7', null, null, null, null, null, null, '464', '149', '315', '0', '0', '0', '1', '5', '1', '4', '8');
INSERT INTO `stock_verifications` VALUES ('53', '8', null, null, null, null, null, null, '50', '0', '50', '0', '0', '0', '1', '5', '1', '4', '8');
INSERT INTO `stock_verifications` VALUES ('54', '9', null, null, null, null, null, null, '104', '63', '41', '0', '0', '0', '1', '5', '1', '4', '8');
INSERT INTO `stock_verifications` VALUES ('55', '1', null, null, null, null, null, null, '0', null, null, null, null, null, '0', '5', '1', '4', '1');
INSERT INTO `stock_verifications` VALUES ('56', '2', null, null, null, null, null, null, '0', null, null, null, null, null, '0', '5', '1', '4', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of stocks_logs
-- ----------------------------
INSERT INTO `stocks_logs` VALUES ('1', '1', '3', '19220', '19220', '1', '0', '766755', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('2', '1', '4', '16742', '16742', '1', '0', '105521', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('3', '1', '5', '4634', '4634', '1', '0', '2884', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('4', '1', '7', '464', '464', '1', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('5', '1', '8', '50', '50', '1', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('6', '1', '9', '104', '104', '1', '0', '41', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('7', '1', '3', '19220', '26628', '2', '0', '766755', '0', '421', '0', '0');
INSERT INTO `stocks_logs` VALUES ('8', '1', '4', '16742', '16902', '2', '0', '105521', '0', '0', '0', '4');
INSERT INTO `stocks_logs` VALUES ('9', '1', '5', '4634', '4650', '2', '0', '2884', '0', '3', '0', '0');
INSERT INTO `stocks_logs` VALUES ('10', '1', '7', '464', '464', '2', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('11', '1', '8', '50', '50', '2', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('12', '1', '9', '104', '104', '2', '0', '41', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('13', '1', '3', '26628', '26014', '3', '0', '766755', '0', '0', '3', '80');
INSERT INTO `stocks_logs` VALUES ('14', '1', '4', '16902', '17113', '3', '0', '105521', '0', '4', '0', '4');
INSERT INTO `stocks_logs` VALUES ('15', '1', '5', '4650', '4903', '3', '0', '2884', '25', '22', '0', '22');
INSERT INTO `stocks_logs` VALUES ('16', '1', '7', '464', '464', '3', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('17', '1', '8', '50', '50', '3', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('18', '1', '9', '104', '104', '3', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('19', '1', '3', '26014', '24471', '4', '0', '766755', '8739', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('20', '1', '4', '17113', '17133', '4', '0', '105521', '477', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('21', '1', '5', '4903', '4989', '4', '0', '2884', '275', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('22', '1', '7', '464', '464', '4', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('23', '1', '8', '50', '50', '4', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('24', '1', '9', '104', '104', '4', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('25', '1', '3', '24471', '23912', '5', '0', '766755', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('26', '1', '4', '17133', '17135', '5', '0', '105521', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('27', '1', '5', '4989', '5008', '5', '0', '2884', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('28', '1', '7', '464', '464', '5', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('29', '1', '8', '50', '50', '5', '0', '0', '0', '0', '0', '0');
INSERT INTO `stocks_logs` VALUES ('30', '1', '9', '104', '104', '5', '0', '0', '0', '0', '0', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tank_logs
-- ----------------------------
INSERT INTO `tank_logs` VALUES ('1', '1', '1', '1063000', '1063000', '1');
INSERT INTO `tank_logs` VALUES ('2', '1', '2', '3475000', '3475000', '1');
INSERT INTO `tank_logs` VALUES ('3', '1', '1', '1063000', '123000', '2');
INSERT INTO `tank_logs` VALUES ('4', '1', '2', '3475000', '2821000', '2');
INSERT INTO `tank_logs` VALUES ('5', '1', '1', '3598000', '3531000', '3');
INSERT INTO `tank_logs` VALUES ('6', '1', '2', '3598000', '3531000', '3');
INSERT INTO `tank_logs` VALUES ('7', '1', '1', '3531000', '1917530', '4');
INSERT INTO `tank_logs` VALUES ('8', '1', '2', '3531000', '3531000', '4');
INSERT INTO `tank_logs` VALUES ('9', '1', '1', '1917530', '0', '5');
INSERT INTO `tank_logs` VALUES ('10', '1', '2', '3531000', '0', '5');

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
INSERT INTO `tanks` VALUES ('1', '1', 'Bullet Tank 1', '4088000', '3475000', null, null, '1');
INSERT INTO `tanks` VALUES ('2', '1', 'Bullet Tank 2', '4088000', '3475000', null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES ('1', 'POS-20230711-1', '1', '6', '23', '2023-07-11 17:34:49', '2023-07-11', '17:34:49', '7144.50', '0.00', '7144.50', '7144.50', '1', '5075', '1-1275', '0', null, '2');
INSERT INTO `transactions` VALUES ('2', 'POS-20230711-2', '1', '6', '17', '2023-07-11 17:36:51', '2023-07-11', '17:36:51', '60.00', '0.00', '60.00', '60.00', '1', '5076', '1-1276', '0', null, '2');
INSERT INTO `transactions` VALUES ('3', 'POS-20230711-3', '1', '6', '6', '2023-07-11 17:38:40', '2023-07-11', '17:38:40', '4752.00', '0.00', '4752.00', '4752.00', '1', '5077', '1-1277', '0', null, '2');
INSERT INTO `transactions` VALUES ('4', 'POS-20230711-4', '1', '6', '17', '2023-07-11 17:51:24', '2023-07-11', '17:51:24', '140.00', '0.00', '140.00', '140.00', '1', '5079', '1-1279', '0', null, '2');
INSERT INTO `transactions` VALUES ('5', 'POS-20230711-5', '1', '6', '8', '2023-07-11 17:52:26', '2023-07-11', '17:52:26', '1980.00', '0.00', '1980.00', '1980.00', '1', '5080', '1-1280', '0', null, '2');
INSERT INTO `transactions` VALUES ('6', 'POS-20230711-6', '1', '6', '28', '2023-07-11 17:53:44', '2023-07-11', '17:53:44', '1798.50', '0.00', '1798.50', '1798.50', '1', '5083', '1-1283', '0', null, '2');
INSERT INTO `transactions` VALUES ('7', 'POS-20230711-7', '1', '6', '26', '2023-07-11 17:55:32', '2023-07-11', '17:55:32', '1980.00', '0.00', '1980.00', '1980.00', '1', '5081', '1-1281', '0', null, '2');
INSERT INTO `transactions` VALUES ('8', 'POS-20230711-8', '1', '6', '14', '2023-07-11 18:32:26', '2023-07-11', '18:32:26', '11088.00', '0.00', '11088.00', '11088.00', '1', '5082', '1-1282', '0', null, '2');
INSERT INTO `transactions` VALUES ('9', 'POS-20230711-9', '1', '6', '16', '2023-07-11 18:34:29', '2023-07-11', '18:34:29', '20592.00', '0.00', '20592.00', '20592.00', '1', '5078', '1-1278', '0', null, '2');
INSERT INTO `transactions` VALUES ('10', 'POS-20230711-10', '1', '6', '5', '2023-07-11 18:36:49', '2023-07-11', '18:36:49', '2970.00', '0.00', '2970.00', '2970.00', '1', '7905', '2511', '0', null, '2');
INSERT INTO `transactions` VALUES ('11', 'POS-20230711-11', '1', '6', '25', '2023-07-11 18:43:08', '2023-07-11', '18:43:08', '784.00', '0.00', '612.00', '784.00', '1', '7907', '2518', '0', null, '2');
INSERT INTO `transactions` VALUES ('12', 'POS-20230711-12', '1', '6', '30', '2023-07-11 18:44:57', '2023-07-11', '18:44:57', '1386.00', '0.00', '1386.00', '1386.00', '1', '7906', '2512', '0', null, '2');
INSERT INTO `transactions` VALUES ('13', 'POS-20230711-13', '1', '6', '4', '2023-07-11 18:47:17', '2023-07-11', '18:47:17', '0.00', '12276.00', '12276.00', '12276.00', '1', '7908', '2514', '0', null, '2');
INSERT INTO `transactions` VALUES ('14', 'POS-20230711-14', '1', '6', '30', '2023-07-11 19:01:18', '2023-07-11', '19:01:18', '1386.00', '0.00', '1386.00', '1386.00', '1', '7909', '2516', '0', null, '2');
INSERT INTO `transactions` VALUES ('15', 'POS-20230711-15', '1', '6', '24', '2023-07-11 19:11:53', '2023-07-11', '19:11:53', '0.00', '17122.00', '17122.00', '17122.00', '1', '7910', '2515', '0', null, '2');
INSERT INTO `transactions` VALUES ('16', 'POS-20230711-16', '1', '1', '19', '2023-07-11 19:38:45', '2023-07-11', '19:38:45', '1980.00', '0.00', '1980.00', '1980.00', '1', '5084', '1-1280', '0', null, '2');
INSERT INTO `transactions` VALUES ('17', 'OPS-20230712-17', '1', '8', '1', '2023-07-12 17:29:02', '2023-07-12', '17:29:02', '0.00', '0.00', '0.00', '0.00', '1', 'N/A', '2517', '0', 'PANABO GAS', '2');
INSERT INTO `transactions` VALUES ('18', 'POS-20230713-18', '1', '1', '31', '2023-07-13 11:26:17', '2023-07-13', '11:26:17', '3168.00', '0.00', '3168.00', '3168.00', '1', '5036', '1-1285', '0', null, '3');
INSERT INTO `transactions` VALUES ('19', 'POS-20230713-19', '1', '1', '16', '2023-07-13 11:28:15', '2023-07-13', '11:28:15', '18216.00', '0.00', '18216.00', '18216.00', '1', '5086', '1-1286', '0', null, '3');
INSERT INTO `transactions` VALUES ('20', 'POS-20230713-20', '1', '1', '32', '2023-07-13 11:31:00', '2023-07-13', '11:31:00', '1980.00', '0.00', '1980.00', '1980.00', '1', '5087', '1-1287', '0', null, '3');
INSERT INTO `transactions` VALUES ('21', 'POS-20230713-21', '1', '1', '33', '2023-07-13 11:33:58', '2023-07-13', '11:33:58', '2607.00', '0.00', '2607.00', '2607.00', '1', '5088', '1-1288', '0', null, '3');
INSERT INTO `transactions` VALUES ('22', 'POS-20230713-22', '1', '1', '16', '2023-07-13 11:36:04', '2023-07-13', '11:36:04', '5148.00', '0.00', '5148.00', '5148.00', '1', '5089', '1-1289', '0', null, '3');
INSERT INTO `transactions` VALUES ('23', 'POS-20230713-23', '1', '1', '8', '2023-07-13 11:37:55', '2023-07-13', '11:37:55', '2376.00', '0.00', '2376.00', '2376.00', '1', '5090', '1-1290', '0', null, '3');
INSERT INTO `transactions` VALUES ('24', 'POS-20230713-24', '1', '1', '14', '2023-07-13 11:39:45', '2023-07-13', '11:39:45', '1980.00', '0.00', '1980.00', '1980.00', '1', '5091', '1-1291', '0', null, '3');
INSERT INTO `transactions` VALUES ('25', 'POS-20230713-25', '1', '1', '26', '2023-07-13 11:40:57', '2023-07-13', '11:40:57', '1584.00', '0.00', '1584.00', '1584.00', '1', '5092', '1-1292', '0', null, '3');
INSERT INTO `transactions` VALUES ('26', 'POS-20230713-26', '1', '1', '28', '2023-07-13 11:42:03', '2023-07-13', '11:42:03', '1320.00', '0.00', '1320.00', '1320.00', '1', '5093', '1-1293', '0', null, '3');
INSERT INTO `transactions` VALUES ('27', 'POS-20230713-27', '1', '1', '6', '2023-07-13 11:42:46', '2023-07-13', '11:42:46', '2376.00', '0.00', '2376.00', '2376.00', '1', '5094', '1-1294', '0', null, '3');
INSERT INTO `transactions` VALUES ('28', 'POS-20230713-28', '1', '1', '34', '2023-07-13 11:46:48', '2023-07-13', '11:46:48', '2062.50', '0.00', '2062.50', '2062.50', '1', '5095', '1-1295', '0', null, '3');
INSERT INTO `transactions` VALUES ('29', 'POS-20230713-29', '1', '1', '27', '2023-07-13 11:48:46', '2023-07-13', '11:48:46', '3366.00', '0.00', '3366.00', '3366.00', '1', '5096', '1-1296', '0', null, '3');
INSERT INTO `transactions` VALUES ('30', 'POS-20230713-30', '1', '1', '11', '2023-07-13 11:51:34', '2023-07-13', '11:51:34', '2178.00', '0.00', '2178.00', '2178.00', '1', '5097', '1-1297', '0', null, '3');
INSERT INTO `transactions` VALUES ('31', 'POS-20230713-31', '1', '1', '17', '2023-07-13 12:54:00', '2023-07-13', '12:54:00', '0.00', '4320.00', '1440.00', '4320.00', '1', '7911', '2518', '0', null, '3');
INSERT INTO `transactions` VALUES ('32', 'POS-20230713-32', '1', '1', '18', '2023-07-13 21:49:15', '2023-07-13', '21:49:15', '63426.00', '0.00', '63426.00', '63426.00', '1', '5777', '2519', '0', null, '3');
INSERT INTO `transactions` VALUES ('33', 'POS-20230713-33', '1', '1', '23', '2023-07-13 23:24:16', '2023-07-13', '23:24:16', '5676.00', '0.00', '5676.00', '5676.00', '1', '5098', '1-1298', '0', null, '4');
INSERT INTO `transactions` VALUES ('34', 'POS-20230713-34', '1', '1', '16', '2023-07-13 23:26:59', '2023-07-13', '23:26:59', '17820.00', '0.00', '17820.00', '17820.00', '1', '5099', '1-1299', '0', null, '4');
INSERT INTO `transactions` VALUES ('35', 'POS-20230713-35', '1', '1', '29', '2023-07-13 23:28:03', '2023-07-13', '23:28:03', '2772.00', '0.00', '2772.00', '2772.00', '1', '5100', '1-1300', '0', null, '4');
INSERT INTO `transactions` VALUES ('36', 'POS-20230713-36', '1', '1', '35', '2023-07-13 23:37:10', '2023-07-13', '23:37:10', '8514.00', '0.00', '8514.00', '8514.00', '1', '5101', '1-1301', '0', null, '4');
INSERT INTO `transactions` VALUES ('37', 'POS-20230713-37', '1', '1', '36', '2023-07-13 23:40:23', '2023-07-13', '23:40:23', '2376.00', '0.00', '2376.00', '2376.00', '1', '5102', '1-1302', '0', null, '4');
INSERT INTO `transactions` VALUES ('38', 'POS-20230713-38', '1', '1', '26', '2023-07-13 23:42:30', '2023-07-13', '23:42:30', '1188.00', '0.00', '1188.00', '1188.00', '1', '5103', '1-1303', '0', null, '4');
INSERT INTO `transactions` VALUES ('39', 'POS-20230713-39', '1', '1', '8', '2023-07-13 23:45:26', '2023-07-13', '23:45:26', '2376.00', '0.00', '2376.00', '2376.00', '1', '5104', '1-1304', '0', null, '4');
INSERT INTO `transactions` VALUES ('40', 'POS-20230713-40', '1', '1', '14', '2023-07-13 23:46:31', '2023-07-13', '23:46:31', '3168.00', '0.00', '3168.00', '3168.00', '1', '5105', '1-1305', '0', null, '4');
INSERT INTO `transactions` VALUES ('41', 'POS-20230713-41', '1', '1', '6', '2023-07-13 23:47:44', '2023-07-13', '23:47:44', '2376.00', '0.00', '2376.00', '2376.00', '1', '5106', '1-1306', '0', null, '4');
INSERT INTO `transactions` VALUES ('42', 'POS-20230713-42', '1', '1', '19', '2023-07-13 23:48:56', '2023-07-13', '23:48:56', '1980.00', '0.00', '1980.00', '1980.00', '1', '5107', '1-1307', '0', null, '4');
INSERT INTO `transactions` VALUES ('43', 'POS-20230713-43', '1', '1', '17', '2023-07-13 23:49:56', '2023-07-13', '23:49:56', '180.00', '0.00', '180.00', '180.00', '1', '5108', '1-1308', '0', null, '4');
INSERT INTO `transactions` VALUES ('44', 'POS-20230713-44', '1', '1', '17', '2023-07-13 23:51:20', '2023-07-13', '23:51:20', '120.00', '0.00', '120.00', '120.00', '1', '5109', '1-1309', '0', null, '4');
INSERT INTO `transactions` VALUES ('45', 'POS-20230713-45', '1', '1', '13', '2023-07-13 23:54:01', '2023-07-13', '23:54:01', '10296.00', '0.00', '10296.00', '10296.00', '1', '5110', '1-1310', '0', null, '4');
INSERT INTO `transactions` VALUES ('46', 'POS-20230714-46', '1', '1', '30', '2023-07-13 00:00:24', '2023-07-13', '00:00:24', '2550.00', '0.00', '2376.00', '2550.00', '1', '7913', '2520', '0', null, '4');
INSERT INTO `transactions` VALUES ('47', 'POS-20230714-47', '1', '1', '10', '2023-07-14 00:05:28', '2023-07-14', '00:05:28', '0.00', '70560.00', '70560.00', '70560.00', '1', '7914', '2521', '0', null, '4');
INSERT INTO `transactions` VALUES ('48', 'POS-20230714-48', '1', '6', '30', '2023-07-14 18:47:39', '2023-07-14', '18:47:39', '2593.50', '0.00', '2376.00', '2593.50', '1', '7919', '2523', '0', null, '5');
INSERT INTO `transactions` VALUES ('49', 'POS-20230714-49', '1', '6', '17', '2023-07-14 18:50:30', '2023-07-14', '18:50:30', '260.00', '0.00', '260.00', '260.00', '1', '5111', '1-1311', '0', null, '5');
INSERT INTO `transactions` VALUES ('50', 'POS-20230714-50', '1', '6', '17', '2023-07-14 18:52:36', '2023-07-14', '18:52:36', '280.00', '0.00', '280.00', '280.00', '1', '5112', '1-1312', '0', null, '5');
INSERT INTO `transactions` VALUES ('51', 'POS-20230714-51', '1', '6', '17', '2023-07-14 18:54:42', '2023-07-14', '18:54:42', '100.00', '0.00', '100.00', '100.00', '1', '5113', '1-1313', '0', null, '5');
INSERT INTO `transactions` VALUES ('52', 'POS-20230714-52', '1', '6', '37', '2023-07-14 19:19:43', '2023-07-14', '19:19:43', '1650.00', '0.00', '1650.00', '1650.00', '1', '5114', '1-1314', '0', null, '5');
INSERT INTO `transactions` VALUES ('53', 'POS-20230714-53', '1', '6', '17', '2023-07-14 19:22:55', '2023-07-14', '19:22:55', '1980.00', '0.00', '660.00', '1980.00', '1', '5115', '1-1315', '0', null, '5');
INSERT INTO `transactions` VALUES ('54', 'POS-20230714-54', '1', '6', '14', '2023-07-14 19:25:31', '2023-07-14', '19:25:31', '5346.00', '0.00', '5346.00', '5346.00', '1', '5116', '1-1316', '0', null, '5');
INSERT INTO `transactions` VALUES ('55', 'POS-20230714-55', '1', '6', '26', '2023-07-14 19:27:53', '2023-07-14', '19:27:53', '1584.00', '0.00', '1584.00', '1584.00', '1', '5117', '1-1317', '0', null, '5');
INSERT INTO `transactions` VALUES ('56', 'POS-20230714-56', '1', '6', '16', '2023-07-14 19:31:10', '2023-07-14', '19:31:10', '16236.00', '0.00', '16236.00', '16236.00', '1', '5118', '1-1318', '0', null, '5');
INSERT INTO `transactions` VALUES ('57', 'POS-20230714-57', '1', '6', '6', '2023-07-14 19:33:37', '2023-07-14', '19:33:37', '2772.00', '0.00', '2772.00', '2772.00', '1', '5119', '1-1319', '0', null, '5');
INSERT INTO `transactions` VALUES ('58', 'POS-20230714-58', '1', '6', '27', '2023-07-14 19:36:20', '2023-07-14', '19:36:20', '3168.00', '0.00', '3168.00', '3168.00', '1', '5120', '1-1320', '0', null, '5');
INSERT INTO `transactions` VALUES ('59', 'POS-20230714-59', '1', '6', '8', '2023-07-14 19:39:11', '2023-07-14', '19:39:11', '3960.00', '0.00', '3960.00', '3960.00', '1', '5121', '1-1321', '0', null, '5');
INSERT INTO `transactions` VALUES ('60', 'POS-20230714-60', '1', '6', '11', '2023-07-14 19:41:09', '2023-07-14', '19:41:09', '2392.50', '0.00', '2392.50', '2392.50', '1', '5122', '1-1322', '0', null, '5');
INSERT INTO `transactions` VALUES ('61', 'OPS-20230714-61', '1', '6', '1', '2023-07-14 21:04:07', '2023-07-14', '21:04:07', '0.00', '0.00', '0.00', '0.00', '1', 'N/A', '2524', '0', 'ADRIAN KWAN', '5');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', '6f50pqput79g23armdbcz7axftw97r97', 'Super Admin', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'University of Malagos', '1.png', '1', '1');
INSERT INTO `users` VALUES ('2', '1', 'uph89gph7a9787mc08kdwxcszmr70u6x', 'Kim Ji Won', 'kimjiwon', 'c17b6630268dbe52c5cf042327a7e65a', 'Seoul Tan Kudarat', null, '1', '4');
INSERT INTO `users` VALUES ('3', '1', 'd1zj73150d84yfubm7a6pku3uvy84y6a', 'Mark', 'mark', 'ea82410c7a9991816b5eeeebe195e20a', 'Seoul Tan Kudarat', null, '1', '5');
INSERT INTO `users` VALUES ('4', '1', 'g967l6nbg57kxjc6m030y3xjfzm5zr6t', 'Ma Dong-seok', 'madongseok', 'df33c062ef7333db904e32f50ce3db66', 'Seoulud Davao', null, '1', '2');
INSERT INTO `users` VALUES ('5', '1', 'pq7n9vknokhn1fihp1nnyi76lz3jm9nm', 'Julie Celi', 'julieceli', '72602a78ccf12d799e11229a48d3261f', 'Lanang', null, '1', '1');
INSERT INTO `users` VALUES ('6', '1', '2qytyulad6k0xlikkc1cvt14kjckmanp', 'Jason Maynabay', 'jmaynabay', '6477245009f5ab8bd6be4836aa4f98c9', 'xxx', '6.jpg', '1', '2');
INSERT INTO `users` VALUES ('7', '1', 'tnbirzs6bcw5igksqzpkfdignoon8qy7', 'Jun Costillas', 'jcostillas', '2ad2386fca3c622cf64d142e9fd24a68', 'xxx', null, '1', '4');
INSERT INTO `users` VALUES ('8', '1', 'zhn1dvl6s5o8e99yf9a6opzaf62yeydw', 'Glenn Bonacker', 'gbonacker', '0da643fea5b7e90159fd09f21ef84063', 'Davao City', null, '1', '4');
INSERT INTO `users` VALUES ('9', '1', 'bdzdtrmunk2n5o0r9yncbdra3358u4tq', 'palacio', 'palacio', '1f9c75dcfc2fbbf839b961435ea950b3', 'palacio', null, '1', '2');
