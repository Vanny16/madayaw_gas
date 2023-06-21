/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50742
 Source Host           : localhost:3306
 Source Schema         : backup_madayaw_gas

 Target Server Type    : MySQL
 Target Server Version : 50742
 File Encoding         : 65001

 Date: 21/06/2023 22:35:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for accounts
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts`  (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_uuid` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `acc_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `acc_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `acc_website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `acc_active` tinyint(4) NULL DEFAULT 1,
  PRIMARY KEY (`acc_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of accounts
-- ----------------------------
INSERT INTO `accounts` VALUES (1, NULL, 'Madayaw Gas', NULL, NULL, 1);

-- ----------------------------
-- Table structure for bad_orders
-- ----------------------------
DROP TABLE IF EXISTS `bad_orders`;
CREATE TABLE `bad_orders`  (
  `bo_id` int(11) NOT NULL AUTO_INCREMENT,
  `bo_ref_id` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `acc_id` int(11) NULL DEFAULT NULL,
  `trx_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `bo_crates` int(11) NULL DEFAULT 0,
  `bo_loose` int(11) NULL DEFAULT 0,
  `bo_date` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bo_time` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bo_datetime` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`bo_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bad_orders
-- ----------------------------
INSERT INTO `bad_orders` VALUES (1, 'BO-20230601-1', 1, 3, 3, NULL, 3, '2023-06-01', '09:41:41', '2023-06-01 09:41:41');

-- ----------------------------
-- Table structure for brands
-- ----------------------------
DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands`  (
  `brd_id` int(11) NOT NULL,
  `brd_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`brd_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of brands
-- ----------------------------

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `cus_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NOT NULL,
  `cus_uuid` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cus_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cus_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cus_contact` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cus_price_change` float NULL DEFAULT 0,
  `cus_accessibles` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cus_accessibles_prices` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cus_notes` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cus_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cus_active` tinyint(4) NULL DEFAULT 1,
  PRIMARY KEY (`cus_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 1, '75z80q62059nbvtkvjc67v5znfz7fuvt', 'ADON', 'TORIL', '09566873302', 5, '3,5,6,', '17.97,17.97,440.00,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (2, 1, '3voy1ywbhwp2nec9162sl9pghs1u3u4p', 'ALONA', 'TAGUM', '09916527682', 0, '5,', '17.36,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (3, 1, '3wgy3d8gytzgvcwuz1nethf848d4v7p1', 'ALFRED SANTOS', 'SAMAL', '09982384646', 0, '3,', '17.97,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (4, 1, 'wreed94l2izxkq2q2m1x1r9xco49xcm7', 'APEIRON', 'TIGATTO, DAVAO CITY', '09279986820', 0, '3,4,', '17.97,17.97,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (5, 1, 'lf1xvkjqqgow8rmahpgpf45ixdyq16je', 'BRGY. SAN ISIDRO', 'BRGY. SAN ISIDRO', '09678252501', 0, '3,4,', '19.70,19.70,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (6, 1, '4q5yustf03fecoquqvn4r26c8aio7e76', 'CHECHE RTW', 'BRGY ILANG', '09307702777', 0, '3,', '18,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (7, 1, 'g4q185nsmlsqc3kx5pvgrmwl1tkkz3wx', 'DENNIS DAGONDON', 'COMMUNAL BUHANGIN', '09171881973', 0, '3,', '17.97,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (8, 1, 'er8bbhagbov9e76mopltlst4tzhxy3f1', 'DUDZ', 'SASA', '09959025762', 0, '3,', '18,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (9, 1, 'u88tb8godfwncx2ypec0gf9rhm513u19', 'FUELSOURCE', 'DIGOS', '09111111111', 0, '3,4,', '16.72,16.72,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (10, 1, '0kupfw5owjebk1u357da19ki9doea7ps', 'DJV LPG CENTER', 'DIGOS CITY', '09066780227', 0, '3,', '15.35,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (11, 1, '09h5jxjsamxmotb23v370txthh3pzuvo', 'JOSIE CUYOS', 'BRGY SAN ISIDRO', '09486617966', 0, '3,', '18,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (12, 1, 't0opbcngljhleibjcaw7kz7txk4cnzwu', 'KENZOVAN', 'BUHANGIN', '09111111111', 0, '3,', '19,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (13, 1, '8xvfpbkg4gtxejrxws2qimzk4xb6aegm', 'REY CANTILLAS', 'PANACAN', '09067656906', 0, '3,', '18,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (14, 1, 'u44xooxs3yppj9ml8l9x6l8u9ye649n2', 'ROBERT MANDANAO', 'SASA', '09813635475', 0, '3,', '18,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (15, 1, 'w8k1k7cb22aef0wklmfvz09nmebj7vj4', 'ROMY FERNANDEZ', 'CATEEL', '09171921402', 0, '3,4,', '17.97,17.97,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (16, 1, 'mfvbtelasbqw2eatpfn20wik9ydrx4kt', 'WILSON', 'PANACAN', '09926956912', 0, '3,', '18.00,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (17, 1, '3i43ayg3o8cufmuh5oc5faxhk847djh4', '(WALK-IN)', 'XXXXXXXX', '11111111111', 0, '3,4,5,', '20,20,20,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (18, 1, '2b7sqnhl95rvi0svrhp054d0cdd5y9da', '(HOUSE)', 'LANANG', '11111111111', 0, '3,4,', '17.97,17.97,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (19, 1, 'i8wmzlus8jpv5148t624iiq1o6nhsi9u', 'ALFREDO ALCE', 'PRK. 13 TIBUNGCO', '09094702448', 0, '3,', '18,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (20, 1, '3gxmpz72gbjnh61sarregkh1g11wwhsl', 'ROLAN REYES', 'MAHAYAG,BUNAWAN', '09093839344', 0, '3,', '18,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (21, 1, '9wej1cucm5riy86owos4syfac346oaiu', 'HLI', 'SASA', '0999999999', 0, '3,', '18,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (22, 1, 'o4ez3wtwvp62rvp9i1prjnn7axzx5e52', 'GEORGE/ROLAN', 'CRYSTAL MEADOWS,SASA', '09292979703', 0, '3,4,', '19.60,19.60,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (23, 1, '21a25heqso3nplynndeac3mb0qm7690r', 'ROMY TARZO', 'SASA STORE/ PANACAN MALAGAMOT DROP', '09467432991', 0, '3,', '18,', NULL, NULL, 1);
INSERT INTO `customers` VALUES (24, 1, 'vp85xzmn3u8cks357wlnti62xhtjzhpt', 'OROGATES', 'KM 10 SASA DAVAO CITY', '09177775909', 0, '7,8,9,', '601.87,601.87,2631.00,', NULL, NULL, 1);

-- ----------------------------
-- Table structure for fuel_prices
-- ----------------------------
DROP TABLE IF EXISTS `fuel_prices`;
CREATE TABLE `fuel_prices`  (
  `prc_id` int(11) NOT NULL AUTO_INCREMENT,
  `prc_date` date NULL DEFAULT NULL,
  `prc_price` decimal(10, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`prc_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fuel_prices
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------

-- ----------------------------
-- Table structure for movement_logs
-- ----------------------------
DROP TABLE IF EXISTS `movement_logs`;
CREATE TABLE `movement_logs`  (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NULL DEFAULT NULL,
  `prd_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `log_filled` decimal(11, 0) NULL DEFAULT 0,
  `log_leakers` decimal(10, 0) NULL DEFAULT 0,
  `log_empty_goods` decimal(10, 0) NULL DEFAULT 0,
  `log_for_revalving` decimal(10, 0) NULL DEFAULT 0,
  `log_scraps` decimal(10, 0) NULL DEFAULT 0,
  `usr_id` int(11) NULL DEFAULT NULL,
  `log_date` date NULL DEFAULT NULL,
  `pdn_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of movement_logs
-- ----------------------------
INSERT INTO `movement_logs` VALUES (1, 1, '3', 0, 0, 9503, 0, 0, 1, '2023-06-02', 1);
INSERT INTO `movement_logs` VALUES (2, 1, '4', 0, 0, 12799, 0, 0, 1, '2023-06-02', 1);
INSERT INTO `movement_logs` VALUES (3, 1, '5', 0, 0, 1145, 0, 0, 1, '2023-06-02', 1);
INSERT INTO `movement_logs` VALUES (4, 1, '3', 0, 0, 864, 0, 0, 1, '2023-06-02', 1);
INSERT INTO `movement_logs` VALUES (5, 1, '4', 0, 0, 209, 0, 0, 1, '2023-06-02', 1);
INSERT INTO `movement_logs` VALUES (6, 1, '5', 0, 0, 995, 0, 0, 1, '2023-06-02', 1);
INSERT INTO `movement_logs` VALUES (7, 1, '3', 7210, 0, 0, 0, 0, 1, '2023-06-02', 1);
INSERT INTO `movement_logs` VALUES (8, 1, '4', 1799, 0, 0, 0, 0, 1, '2023-06-02', 1);
INSERT INTO `movement_logs` VALUES (9, 1, '5', 2131, 0, 0, 0, 0, 1, '2023-06-02', 1);
INSERT INTO `movement_logs` VALUES (10, 1, '3', 0, 864, 0, 0, 0, 1, '2023-06-02', 1);
INSERT INTO `movement_logs` VALUES (11, 1, '4', 0, 209, 0, 0, 0, 1, '2023-06-02', 1);
INSERT INTO `movement_logs` VALUES (12, 1, '5', 0, 995, 0, 0, 0, 1, '2023-06-02', 1);
INSERT INTO `movement_logs` VALUES (13, 1, '3', 0, 0, 0, 463, 0, 1, '2023-06-02', 1);
INSERT INTO `movement_logs` VALUES (14, 1, '4', 0, 0, 0, 173, 0, 1, '2023-06-02', 1);
INSERT INTO `movement_logs` VALUES (15, 1, '5', 0, 0, 0, 858, 0, 1, '2023-06-02', 1);
INSERT INTO `movement_logs` VALUES (16, 1, '3', 0, 3, 0, 0, 0, 1, '2023-06-01', 1);
INSERT INTO `movement_logs` VALUES (17, 1, '8', 0, 0, 116, 0, 0, 1, '2023-06-01', 1);
INSERT INTO `movement_logs` VALUES (18, 1, '7', 0, 0, 500, 0, 0, 1, '2023-06-01', 1);
INSERT INTO `movement_logs` VALUES (19, 1, '9', 0, 0, 150, 0, 0, 1, '2023-06-01', 1);
INSERT INTO `movement_logs` VALUES (20, 1, '9', 4, 0, 0, 0, 0, 1, '2023-06-01', 1);

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `news_content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `news_date` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `news_time` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `news_datetime` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `news_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `news_active` tinyint(4) NULL DEFAULT 1,
  PRIMARY KEY (`news_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of news
-- ----------------------------

-- ----------------------------
-- Table structure for oppositions
-- ----------------------------
DROP TABLE IF EXISTS `oppositions`;
CREATE TABLE `oppositions`  (
  `ops_id` int(11) NOT NULL AUTO_INCREMENT,
  `ops_uuid` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ops_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ops_sku` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ops_description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ops_quantity` int(11) NULL DEFAULT NULL,
  `ops_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ops_notes` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `acc_id` int(11) NULL DEFAULT NULL,
  `ops_active` int(11) NULL DEFAULT 1,
  PRIMARY KEY (`ops_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of oppositions
-- ----------------------------
INSERT INTO `oppositions` VALUES (1, 'ypd1oerm2xfg3jxaq1zz9ejemjjce0sv', 'TRIPLER', 'TRIPLER', 'TRIPLER', 5000, NULL, NULL, 1, 1);
INSERT INTO `oppositions` VALUES (2, 'brvyrfw8t0teazmcspcivzz91sjkzwn5', 'BUDGET GAS', 'BUDGET GAS', 'BUDGET GAS', 45, NULL, NULL, 1, 1);
INSERT INTO `oppositions` VALUES (3, '88o8gnjcvxfafiwm57jmhuohyv4ww0k4', 'RUFRANCE', 'RUFRANCE', 'RUFRANCE', 12000, NULL, NULL, 1, 1);
INSERT INTO `oppositions` VALUES (4, 'qbvqih6liz0rmk5pbbjmizxar5ifzc8n', 'PEPC', 'PEPC', 'PEPC', 1819, NULL, NULL, 1, 1);
INSERT INTO `oppositions` VALUES (5, 'fjk1a403z8xeh16qhniub5cl1fpyj7pe', 'AGILA', 'AGILA', 'AGILA', 610, NULL, NULL, 1, 1);
INSERT INTO `oppositions` VALUES (6, '01debiko2t4ederqbbvm41aq09h9ddtu', 'JEAM GAS', 'JEAM GAS', 'JEAM GAS', 65, NULL, NULL, 1, 1);

-- ----------------------------
-- Table structure for payment_types
-- ----------------------------
DROP TABLE IF EXISTS `payment_types`;
CREATE TABLE `payment_types`  (
  `mode_of_payment` int(11) NOT NULL,
  `payment_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`mode_of_payment`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payment_types
-- ----------------------------
INSERT INTO `payment_types` VALUES (1, 'Cash');
INSERT INTO `payment_types` VALUES (2, 'Credit');
INSERT INTO `payment_types` VALUES (3, 'G-Cash');
INSERT INTO `payment_types` VALUES (4, 'Check');
INSERT INTO `payment_types` VALUES (5, 'Split Payment');

-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments`  (
  `acc_id` int(11) NOT NULL,
  `pmnt_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pmnt_ref_id` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `trx_id` int(10) UNSIGNED NOT NULL,
  `pmnt_amount` double(30, 0) NOT NULL,
  `pmnt_attachment` varchar(70) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `usr_id` int(11) NOT NULL,
  `pmnt_date` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pmnt_time` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `trx_mode_of_payment` int(11) NULL DEFAULT NULL,
  `pmnt_received` double(30, 0) NOT NULL,
  `pmnt_change` double(30, 0) NOT NULL,
  `pmnt_check_no` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pmnt_check_date` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pmnt_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES (1, 1, 'PMT20230601-1', 1, 0, NULL, 1, '2023-06-01', '09:32:04', 2, 0, 0, NULL, NULL);
INSERT INTO `payments` VALUES (1, 2, 'PMT20230601-2', 2, 0, NULL, 1, '2023-06-01', '09:34:38', 2, 0, 0, NULL, NULL);
INSERT INTO `payments` VALUES (1, 3, 'PMT20230601-3', 3, 0, NULL, 1, '2023-06-01', '09:38:36', 2, 0, 0, NULL, NULL);
INSERT INTO `payments` VALUES (1, 4, 'PMT20230601-4', 3, 10000, NULL, 1, '2023-06-01', '10:30:22', 1, 10000, 0, NULL, NULL);
INSERT INTO `payments` VALUES (1, 5, 'PMT20230601-5', 3, 3714, NULL, 1, '2023-06-01', '10:30:55', 1, 3714, 0, NULL, NULL);
INSERT INTO `payments` VALUES (1, 6, 'PMT20230601-6', 4, 0, NULL, 1, '2023-06-01', '10:42:16', 2, 0, 0, NULL, NULL);

-- ----------------------------
-- Table structure for product_types
-- ----------------------------
DROP TABLE IF EXISTS `product_types`;
CREATE TABLE `product_types`  (
  `typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `typ_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`typ_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_types
-- ----------------------------

-- ----------------------------
-- Table structure for product_units
-- ----------------------------
DROP TABLE IF EXISTS `product_units`;
CREATE TABLE `product_units`  (
  `Can` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Case` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_units
-- ----------------------------

-- ----------------------------
-- Table structure for production_logs
-- ----------------------------
DROP TABLE IF EXISTS `production_logs`;
CREATE TABLE `production_logs`  (
  `pdn_id` int(11) NOT NULL AUTO_INCREMENT,
  `pdn_date` date NULL DEFAULT NULL,
  `pdn_start_time` time NULL DEFAULT NULL,
  `pdn_end_time` time NULL DEFAULT NULL,
  PRIMARY KEY (`pdn_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of production_logs
-- ----------------------------
INSERT INTO `production_logs` VALUES (1, '2023-06-01', '09:12:52', NULL);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `prd_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NULL DEFAULT NULL,
  `prd_uuid` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `prd_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `prd_description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `prd_sku` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `prd_barcode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `prd_price` decimal(10, 2) NULL DEFAULT NULL,
  `prd_deposit` decimal(10, 0) NULL DEFAULT 0,
  `prd_quantity` int(10) NULL DEFAULT 0,
  `prd_leakers` int(10) NULL DEFAULT 0,
  `prd_empty_goods` int(10) NULL DEFAULT 0,
  `prd_for_revalving` int(10) NULL DEFAULT 0,
  `prd_scraps` int(11) NULL DEFAULT 0,
  `prd_reorder_point` int(10) NULL DEFAULT NULL,
  `prd_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sup_id` int(11) NULL DEFAULT NULL,
  `prd_active` tinyint(4) NULL DEFAULT 1,
  `prd_is_refillable` tinyint(4) NULL DEFAULT 1,
  `prd_for_production` tinyint(4) NULL DEFAULT 1,
  `prd_for_POS` tinyint(4) NULL DEFAULT NULL,
  `prd_weight` decimal(10, 0) NULL DEFAULT NULL,
  `prd_raw_can_qty` int(11) NULL DEFAULT 0,
  `prd_components` int(11) NULL DEFAULT NULL,
  `prd_seals` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`prd_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 1, '0eqfa2whjhx90s8nrw83q987g9kl1stj', 'Seal', 'seal', 'seal', NULL, NULL, 0, 14371, 0, 0, 0, 0, 360000, NULL, 1, 1, 0, 1, 0, NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (2, 1, '316xf5bh9z85yj265ssfxhlyrhsmxh0n', 'Valve', 'valve', 'valve', NULL, NULL, 0, 9234, 0, 0, 0, 0, 500000, NULL, 2, 1, 0, 1, 0, NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (3, 1, '6f0lokdgcxp3xjp6pi62qnjy7ibugrna', 'Round', 'Madayaw Round Canister', 'MR170', NULL, 38.00, 40, 5459, 404, 4132, 463, 0, 10000, NULL, 1, 1, 1, 1, 1, 170, 0, 2, 1);
INSERT INTO `products` VALUES (4, 1, '03z7lbrja07ypsfva0f91y7i3h9bv73m', 'Square', 'Madayaw Square Canister', 'MS170', NULL, 38.00, 40, 1539, 36, 11262, 173, 0, 10000, NULL, 2, 1, 1, 1, 1, 170, 0, 2, 1);
INSERT INTO `products` VALUES (5, 1, 'lm4p6zbx0dcjc6ixwnk36pea2ax12byi', 'Botin', 'Botin Canister', 'Botin170', NULL, 38.00, 40, 128, 137, 69, 858, 0, 10000, NULL, 2, 1, 1, 1, 1, 170, 0, 2, 1);
INSERT INTO `products` VALUES (6, 1, 'f1g86czlex1cyk4z3k1s0k7uuiwhdfce', 'PORTABLE STOVE', 'PORTABLE STOVE', 'PORTABLE STOVE', NULL, 440.00, 0, 3604, 0, 0, 0, 0, 1500, NULL, 3, 1, 0, 0, 1, NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (7, 1, 'pjq863zmt5nf4fh8ixtihap1jpe79ll0', 'A/S TYPE TANK', '11KG. A/S TYPE', '11KG. A/S TYPE', NULL, 601.87, 0, 0, 0, 500, 0, 0, 500, NULL, 4, 1, 1, 1, 1, 11000, 0, 2, 1);
INSERT INTO `products` VALUES (8, 1, 'ohizg8boensypacr64haelqhrhsmoi8g', 'POL TYPE TANK', '11KG POL TYPE', '11KG POL TYPE', NULL, 601.87, 602, 0, 0, 116, 0, 0, 500, NULL, 4, 1, 1, 1, 1, 11000, 0, 2, 1);
INSERT INTO `products` VALUES (9, 1, '3ny79p9wo9mzoc13wtehuhh66zkysof0', '50KG POL TYPE', '5OKG POL TYPE', '50KG POL TYPE', NULL, 2631.00, 2631, 0, 0, 150, 0, 0, 500, NULL, 4, 1, 1, 1, 1, 50000, 0, 2, 1);

-- ----------------------------
-- Table structure for purchases
-- ----------------------------
DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases`  (
  `pur_id` int(11) NOT NULL AUTO_INCREMENT,
  `trx_id` int(11) NULL DEFAULT NULL,
  `prd_id` int(11) NULL DEFAULT NULL,
  `pur_crate` int(11) NULL DEFAULT NULL,
  `pur_loose` int(11) NULL DEFAULT NULL,
  `pur_discount` double(10, 2) NULL DEFAULT 0.00,
  `pur_deposit` double(10, 2) NULL DEFAULT NULL,
  `pur_total` double(10, 2) NULL DEFAULT NULL,
  `pur_qty` int(11) NULL DEFAULT NULL,
  `prd_price` double(10, 2) NULL DEFAULT NULL,
  `prd_id_in` int(11) NULL DEFAULT NULL,
  `pur_crate_in` int(11) NULL DEFAULT NULL,
  `pur_loose_in` int(11) NULL DEFAULT NULL,
  `can_type_in` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`pur_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of purchases
-- ----------------------------
INSERT INTO `purchases` VALUES (1, 1, 3, 4, 9, 0.00, 0.00, 1122.90, 57, 19.70, 3, 4, 9, 1);
INSERT INTO `purchases` VALUES (2, 1, 4, 0, 3, 0.00, 0.00, 59.10, 3, 19.70, 4, 0, 3, 1);
INSERT INTO `purchases` VALUES (3, 2, 5, 79, 0, 0.00, 0.00, 17035.56, 948, 17.97, 3, 79, 0, 2);
INSERT INTO `purchases` VALUES (4, 2, 5, 5, 0, 0.00, 0.00, 1078.20, 60, 17.97, 5, 5, 0, 1);
INSERT INTO `purchases` VALUES (5, 2, 3, 15, 10, 0.00, 0.00, 3414.30, 190, 17.97, 3, 15, 10, 1);
INSERT INTO `purchases` VALUES (6, 2, 3, 0, 2, 0.00, 0.00, 35.94, 2, 17.97, 4, 0, 2, 1);
INSERT INTO `purchases` VALUES (7, 3, 3, 3, 11, 0.00, 1440.00, 844.59, 47, 17.97, 3, 0, 11, 2);
INSERT INTO `purchases` VALUES (8, 3, 3, 3, 1, 0.00, 0.00, 664.89, 37, 17.97, 1, 3, 1, 2);
INSERT INTO `purchases` VALUES (9, 3, 3, 45, 11, 0.00, 0.00, 9901.47, 551, 17.97, 3, 45, 11, 1);
INSERT INTO `purchases` VALUES (10, 3, 4, 4, 0, 0.00, 0.00, 862.56, 48, 17.97, 4, 4, 0, 1);
INSERT INTO `purchases` VALUES (11, 4, 9, 0, 4, 0.00, 0.00, 10524.00, 4, 2631.00, 9, 0, 4, 1);
INSERT INTO `purchases` VALUES (12, 5, 3, 0, 177, 0.00, 0.00, 0.00, 177, 0.00, 3, 0, 177, 1);

-- ----------------------------
-- Table structure for quantity_logs
-- ----------------------------
DROP TABLE IF EXISTS `quantity_logs`;
CREATE TABLE `quantity_logs`  (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NULL DEFAULT NULL,
  `prd_id` int(11) NULL DEFAULT NULL,
  `usr_id` int(11) NULL DEFAULT NULL,
  `log_quantity` int(11) NULL DEFAULT NULL,
  `log_datetime` datetime NULL DEFAULT NULL,
  `pdn_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of quantity_logs
-- ----------------------------
INSERT INTO `quantity_logs` VALUES (1, 1, 1, 1, 360000, '2023-06-02 17:18:18', 1);
INSERT INTO `quantity_logs` VALUES (2, 1, 2, 1, 500000, '2023-06-02 17:18:23', 1);
INSERT INTO `quantity_logs` VALUES (3, 1, 3, 1, 10367, '2023-06-02 17:19:38', 1);
INSERT INTO `quantity_logs` VALUES (4, 1, 4, 1, 13008, '2023-06-02 17:19:45', 1);
INSERT INTO `quantity_logs` VALUES (5, 1, 5, 1, 2140, '2023-06-02 17:19:50', 1);
INSERT INTO `quantity_logs` VALUES (6, 1, 3, 1, 9503, '2023-06-02 17:20:43', 1);
INSERT INTO `quantity_logs` VALUES (7, 1, 4, 1, 12799, '2023-06-02 17:20:58', 1);
INSERT INTO `quantity_logs` VALUES (8, 1, 5, 1, 1145, '2023-06-02 17:21:13', 1);
INSERT INTO `quantity_logs` VALUES (9, 1, 3, 1, 864, '2023-06-02 17:21:47', 1);
INSERT INTO `quantity_logs` VALUES (10, 1, 4, 1, 209, '2023-06-02 17:21:54', 1);
INSERT INTO `quantity_logs` VALUES (11, 1, 5, 1, 995, '2023-06-02 17:22:01', 1);
INSERT INTO `quantity_logs` VALUES (12, 1, 3, 1, 7210, '2023-06-02 17:23:07', 1);
INSERT INTO `quantity_logs` VALUES (13, 1, 4, 1, 1799, '2023-06-02 17:23:38', 1);
INSERT INTO `quantity_logs` VALUES (14, 1, 5, 1, 2131, '2023-06-02 17:23:55', 1);
INSERT INTO `quantity_logs` VALUES (15, 1, 3, 1, 864, '2023-06-02 17:24:36', 1);
INSERT INTO `quantity_logs` VALUES (16, 1, 4, 1, 209, '2023-06-02 17:24:52', 1);
INSERT INTO `quantity_logs` VALUES (17, 1, 5, 1, 995, '2023-06-02 17:25:35', 1);
INSERT INTO `quantity_logs` VALUES (18, 1, 3, 1, 463, '2023-06-02 17:26:43', 1);
INSERT INTO `quantity_logs` VALUES (19, 1, 4, 1, 173, '2023-06-02 17:26:49', 1);
INSERT INTO `quantity_logs` VALUES (20, 1, 5, 1, 858, '2023-06-02 17:26:54', 1);
INSERT INTO `quantity_logs` VALUES (21, 1, 3, 1, 3, '2023-06-01 09:41:41', 1);
INSERT INTO `quantity_logs` VALUES (22, 1, 6, 1, 3604, '2023-06-01 10:21:03', 1);
INSERT INTO `quantity_logs` VALUES (23, 1, 1, 1, 3154000, '2023-06-01 10:35:39', 1);
INSERT INTO `quantity_logs` VALUES (24, 1, 7, 1, 500, '2023-06-01 10:36:52', 1);
INSERT INTO `quantity_logs` VALUES (25, 1, 8, 1, 116, '2023-06-01 10:37:06', 1);
INSERT INTO `quantity_logs` VALUES (26, 1, 9, 1, 150, '2023-06-01 10:37:15', 1);
INSERT INTO `quantity_logs` VALUES (27, 1, 7, 1, 500, '2023-06-01 10:37:41', 1);
INSERT INTO `quantity_logs` VALUES (28, 1, 8, 1, 116, '2023-06-01 10:37:51', 1);
INSERT INTO `quantity_logs` VALUES (29, 1, 9, 1, 150, '2023-06-01 10:37:58', 1);
INSERT INTO `quantity_logs` VALUES (30, 1, 7, 1, 500, '2023-06-01 10:38:58', 1);
INSERT INTO `quantity_logs` VALUES (31, 1, 2, 1, 10000, '2023-06-01 10:39:08', 1);
INSERT INTO `quantity_logs` VALUES (32, 1, 8, 1, 116, '2023-06-01 10:39:20', 1);
INSERT INTO `quantity_logs` VALUES (33, 1, 7, 1, 500, '2023-06-01 10:39:26', 1);
INSERT INTO `quantity_logs` VALUES (34, 1, 9, 1, 150, '2023-06-01 10:39:30', 1);
INSERT INTO `quantity_logs` VALUES (35, 1, 9, 1, 4, '2023-06-01 10:40:11', 1);
INSERT INTO `quantity_logs` VALUES (36, 1, 9, 1, 4, '2023-06-01 10:40:47', 1);

-- ----------------------------
-- Table structure for reset_password
-- ----------------------------
DROP TABLE IF EXISTS `reset_password`;
CREATE TABLE `reset_password`  (
  `rst_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_id` int(11) NULL DEFAULT NULL,
  `rst_active` tinyint(4) NULL DEFAULT 1,
  PRIMARY KEY (`rst_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reset_password
-- ----------------------------

-- ----------------------------
-- Table structure for sales_reports
-- ----------------------------
DROP TABLE IF EXISTS `sales_reports`;
CREATE TABLE `sales_reports`  (
  `sls_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_id` int(11) NULL DEFAULT NULL,
  `prd_id` int(11) NULL DEFAULT NULL,
  `sls_quantity` float NULL DEFAULT NULL,
  `sls_discount` float NULL DEFAULT NULL,
  `sls_sub_total` float NULL DEFAULT NULL,
  `sls_time` time NULL DEFAULT NULL,
  `pdn_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`sls_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sales_reports
-- ----------------------------

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status`  (
  `sts_id` int(11) NOT NULL AUTO_INCREMENT,
  `sts_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`sts_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of status
-- ----------------------------

-- ----------------------------
-- Table structure for stock_statuses
-- ----------------------------
DROP TABLE IF EXISTS `stock_statuses`;
CREATE TABLE `stock_statuses`  (
  `stk_id` int(11) NOT NULL AUTO_INCREMENT,
  `stk_opening` double NULL DEFAULT NULL,
  `stk_closing` double NULL DEFAULT NULL,
  `pdn_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`stk_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stock_statuses
-- ----------------------------

-- ----------------------------
-- Table structure for stock_verifications
-- ----------------------------
DROP TABLE IF EXISTS `stock_verifications`;
CREATE TABLE `stock_verifications`  (
  `verify_id` int(11) NOT NULL AUTO_INCREMENT,
  `verify_prd_id` int(11) NULL DEFAULT NULL,
  `verify_opening` int(11) NULL DEFAULT NULL,
  `verify_opening_filled` int(11) NULL DEFAULT NULL,
  `verify_opening_empty` int(11) NULL DEFAULT NULL,
  `verify_opening_leakers` int(11) NULL DEFAULT NULL,
  `verify_opening_for_revalving` int(11) NULL DEFAULT NULL,
  `verify_opening_scraps` int(11) NULL DEFAULT NULL,
  `verify_closing` int(11) NULL DEFAULT NULL,
  `verify_closing_filled` int(11) NULL DEFAULT NULL,
  `verify_closing_empty` int(11) NULL DEFAULT NULL,
  `verify_closing_leakers` int(11) NULL DEFAULT NULL,
  `verify_closing_for_revalving` int(11) NULL DEFAULT NULL,
  `verify_closing_scraps` int(11) NULL DEFAULT NULL,
  `verify_is_product` int(11) NULL DEFAULT NULL,
  `verify_pdn_id` int(11) NULL DEFAULT NULL,
  `verify_acc_id` int(11) NULL DEFAULT NULL,
  `verify_user_type` int(11) NULL DEFAULT NULL,
  `verify_user_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`verify_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stock_verifications
-- ----------------------------
INSERT INTO `stock_verifications` VALUES (1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 1, 1);
INSERT INTO `stock_verifications` VALUES (2, 2, 2698000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 1, 1);

-- ----------------------------
-- Table structure for stockin_logs
-- ----------------------------
DROP TABLE IF EXISTS `stockin_logs`;
CREATE TABLE `stockin_logs`  (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NULL DEFAULT NULL,
  `prd_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `log_quantity` int(11) NULL DEFAULT 0,
  `log_leakers` int(10) NULL DEFAULT 0,
  `log_empty_goods` int(10) NULL DEFAULT 0,
  `log_for_revalving` int(10) NULL DEFAULT 0,
  `log_scraps` int(10) NULL DEFAULT 0,
  `log_date` date NULL DEFAULT NULL,
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stockin_logs
-- ----------------------------

-- ----------------------------
-- Table structure for stocks_logs
-- ----------------------------
DROP TABLE IF EXISTS `stocks_logs`;
CREATE TABLE `stocks_logs`  (
  `stk_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NULL DEFAULT NULL,
  `prd_id` int(11) NULL DEFAULT NULL,
  `opening_stocks` int(11) NULL DEFAULT NULL,
  `closing_stocks` int(11) NULL DEFAULT NULL,
  `pdn_id` int(11) NULL DEFAULT NULL,
  `stk_raw_materials` int(11) NULL DEFAULT 0,
  `stk_empty_goods` int(11) NULL DEFAULT 0,
  `stk_filled` int(11) NULL DEFAULT 0,
  `stk_leakers` int(11) NULL DEFAULT 0,
  `stk_for_revalving` int(11) NULL DEFAULT 0,
  `stk_scraps` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`stk_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stocks_logs
-- ----------------------------
INSERT INTO `stocks_logs` VALUES (1, 1, 3, NULL, NULL, 1, 0, 10573, 0, 3, 463, 0);
INSERT INTO `stocks_logs` VALUES (2, 1, 4, NULL, NULL, 1, 0, 33688, 0, 0, 173, 0);
INSERT INTO `stocks_logs` VALUES (3, 1, 5, NULL, NULL, 1, 0, 69, 0, 0, 858, 0);
INSERT INTO `stocks_logs` VALUES (4, 1, 7, NULL, NULL, 1, 0, 500, 0, 0, 0, 0);
INSERT INTO `stocks_logs` VALUES (5, 1, 8, NULL, NULL, 1, 0, 116, 0, 0, 0, 0);
INSERT INTO `stocks_logs` VALUES (6, 1, 9, NULL, NULL, 1, 0, 150, 4, 0, 0, 0);

-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers`  (
  `sup_id` int(11) NOT NULL AUTO_INCREMENT,
  `sup_uuid` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `acc_id` int(11) NULL DEFAULT NULL,
  `sup_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sup_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sup_contact` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sup_notes` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sup_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sup_active` tinyint(4) NULL DEFAULT 1,
  PRIMARY KEY (`sup_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES (1, 'ef34h1dd1m5iad43z2m0xssh33le076h', 1, 'AGR Industrial Trading & Technical Solutions', 'Cebu City', '09222379398', NULL, NULL, 1);
INSERT INTO `suppliers` VALUES (2, 'lid23cq73oksxaxph7ouah7pv586g0ef', 1, 'PEIDEWorth Marketing', 'Manila', '09171241999', NULL, NULL, 1);
INSERT INTO `suppliers` VALUES (3, '1479g2t08yrky58mhleq6h4ckakhiw5q', 1, 'JOHN VELASCO', 'CEBU CITY', '09176855000', NULL, NULL, 1);
INSERT INTO `suppliers` VALUES (4, 'y5a3rt3l21z0hv09coj6000loakpmrmr', 1, 'FERROTECH', 'MANILA', '0999999999', NULL, NULL, 1);

-- ----------------------------
-- Table structure for tank_logs
-- ----------------------------
DROP TABLE IF EXISTS `tank_logs`;
CREATE TABLE `tank_logs`  (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NULL DEFAULT NULL,
  `tnk_id` int(11) NULL DEFAULT NULL,
  `log_tnk_opening` decimal(10, 0) NULL DEFAULT NULL,
  `log_tnk_closing` decimal(10, 0) NULL DEFAULT NULL,
  `pdn_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tank_logs
-- ----------------------------
INSERT INTO `tank_logs` VALUES (1, 1, 1, 0, NULL, 1);
INSERT INTO `tank_logs` VALUES (2, 1, 2, 2698000, NULL, 1);

-- ----------------------------
-- Table structure for tanks
-- ----------------------------
DROP TABLE IF EXISTS `tanks`;
CREATE TABLE `tanks`  (
  `tnk_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NOT NULL,
  `tnk_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tnk_capacity` decimal(11, 0) NULL DEFAULT 0,
  `tnk_remaining` decimal(11, 0) NULL DEFAULT 0,
  `tnk_notes` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tnk_uuid` int(11) NULL DEFAULT NULL,
  `tnk_active` tinyint(4) NULL DEFAULT 1,
  PRIMARY KEY (`tnk_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tanks
-- ----------------------------
INSERT INTO `tanks` VALUES (1, 1, 'Bullet Tank 1', 4154000, 3154000, NULL, NULL, 1);
INSERT INTO `tanks` VALUES (2, 1, 'Bullet Tank 2', 4154000, 604200, NULL, NULL, 1);

-- ----------------------------
-- Table structure for transactions
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions`  (
  `trx_id` int(11) NOT NULL AUTO_INCREMENT,
  `trx_ref_id` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `acc_id` tinyint(4) NULL DEFAULT NULL,
  `usr_id` int(11) NULL DEFAULT NULL,
  `cus_id` int(11) NULL DEFAULT NULL,
  `trx_datetime` datetime NULL DEFAULT NULL,
  `trx_date` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `trx_time` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `trx_amount_paid` decimal(11, 0) NULL DEFAULT NULL,
  `trx_balance` decimal(11, 0) NULL DEFAULT NULL,
  `trx_gross` decimal(11, 0) NULL DEFAULT NULL,
  `trx_total` decimal(11, 0) NULL DEFAULT NULL,
  `trx_active` tinyint(2) NULL DEFAULT 1,
  `trx_can_dec` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `trx_del_rec` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `trx_confirm` tinyint(1) NULL DEFAULT 0,
  `trx_opposition_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pdn_id` int(30) NULL DEFAULT NULL,
  PRIMARY KEY (`trx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES (1, 'POS-20230601-1', 1, 1, 5, '2023-06-01 09:32:04', '2023-06-01', '09:32:04', 0, 1182, 1182, 1182, 1, '7690', '1965', 0, NULL, 1);
INSERT INTO `transactions` VALUES (2, 'POS-20230601-2', 1, 1, 1, '2023-06-01 09:34:38', '2023-06-01', '09:34:38', 0, 21564, 21564, 21564, 1, '7692', '1970', 0, NULL, 1);
INSERT INTO `transactions` VALUES (3, 'POS-20230601-3', 1, 1, 4, '2023-06-01 09:38:36', '2023-06-01', '09:38:36', 13714, 0, 12274, 13714, 1, '7691', '1969', 1, NULL, 1);
INSERT INTO `transactions` VALUES (4, 'POS-20230601-4', 1, 1, 24, '2023-06-01 10:42:16', '2023-06-01', '10:42:16', 0, 10524, 10524, 10524, 1, 'xxxx', 'xxxx', 0, NULL, 1);
INSERT INTO `transactions` VALUES (5, 'OPS-20230601-5', 1, 1, 3, '2023-06-01 10:58:02', '2023-06-01', '10:58:02', 0, 0, 0, 0, 1, 'N/A', '123', 0, 'Rufrance', 1);

-- ----------------------------
-- Table structure for user_types
-- ----------------------------
DROP TABLE IF EXISTS `user_types`;
CREATE TABLE `user_types`  (
  `typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `typ_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`typ_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_types
-- ----------------------------
INSERT INTO `user_types` VALUES (1, 'Administrator');
INSERT INTO `user_types` VALUES (2, 'Employee');
INSERT INTO `user_types` VALUES (3, 'Observer');
INSERT INTO `user_types` VALUES (4, 'Plant Manager');
INSERT INTO `user_types` VALUES (5, 'Supervisor');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NULL DEFAULT NULL,
  `usr_uuid` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usr_full_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usr_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usr_password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usr_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usr_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usr_active` tinyint(4) NULL DEFAULT 1,
  `typ_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`usr_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 1, '6f50pqput79g23armdbcz7axftw97r97', 'Super Admin', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'University of Malagos', '1.png', 1, 1);
INSERT INTO `users` VALUES (2, 1, 'uph89gph7a9787mc08kdwxcszmr70u6x', 'Kim Ji Won', 'kimjiwon', 'c17b6630268dbe52c5cf042327a7e65a', 'Seoul Tan Kudarat', NULL, 1, 4);
INSERT INTO `users` VALUES (3, 1, 'd1zj73150d84yfubm7a6pku3uvy84y6a', 'Mark', 'mark', 'ea82410c7a9991816b5eeeebe195e20a', 'Seoul Tan Kudarat', NULL, 1, 5);
INSERT INTO `users` VALUES (4, 1, 'g967l6nbg57kxjc6m030y3xjfzm5zr6t', 'Ma Dong-seok', 'madongseok', 'df33c062ef7333db904e32f50ce3db66', 'Seoulud Davao', NULL, 1, 2);

SET FOREIGN_KEY_CHECKS = 1;
