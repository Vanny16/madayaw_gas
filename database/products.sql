/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50733
Source Host           : localhost:3306
Source Database       : test_db

Target Server Type    : MYSQL
Target Server Version : 50733
File Encoding         : 65001

Date: 2023-03-31 11:07:27
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '1', '6yu8x39d3a8zr3s54o2x8zmk69y8j8q2', 'MR Valve', 'MR Valve', 'MRV', null, null, '0', '7898', '0', '0', '0', '0', '1000', null, '1', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('2', '1', 'm6hanwc9u1ik3y8inh2o1l7vwj8mc4o6', 'MS Valve', 'MS Valve', 'MSV', null, null, '0', '9000', '0', '0', '0', '0', '1000', null, '1', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('3', '1', 'ayrjsmj0z0hlhouabj6k9jksp47sv41z', 'Madayaw Round', 'MR LPG', 'MR170', null, '20.00', '35', '228', '0', '832', '0', '50', '1000', null, '2', '1', '1', '1', '1', '170', '8900', '1', '8');
INSERT INTO `products` VALUES ('4', '1', 'reg89nc0wyi98jzr9hd7aiozsc6ba7tj', 'Madayaw Square', 'MS LPG', 'MS170', null, '20.00', '35', '476', '0', '500', '0', '0', '1000', null, '2', '1', '1', '1', '1', '170', '9000', '2', null);
INSERT INTO `products` VALUES ('5', '1', 'ydg5a6fi8dit015u5wr6ehi02la4jgfa', 'Botin', 'BOTIN170', 'BOTIN170', null, '20.00', '35', '500', '0', '500', '0', '0', '1000', null, '2', '1', '1', '1', '1', '170', '9000', '1', null);
INSERT INTO `products` VALUES ('6', '1', '851bmkfdi98c2gk2vom508y4m8q8gb58', 'Gas Stove', 'Gas Stove 1 Burner', 'GS1B', null, '700.00', '0', '999', '0', '0', '0', '0', '1000', null, '1', '1', '0', '0', '1', null, '0', null, null);
INSERT INTO `products` VALUES ('8', '1', 'qqh27g0i5x1t35vuhv3c40um2bla1ger', 'Seal', 'Seal', 'Seal', null, null, '0', '0', '0', '0', '0', '0', '12323', null, '1', '1', '0', '1', '0', null, '0', null, null);
INSERT INTO `products` VALUES ('9', '1', 'cfbgf3pnxws9svdsytvbou1n6d1fvzwk', 'Botin 2.0', 'BOTIN 2nd Version', 'Botin 2.0 170g', null, '20.00', '35', '0', '0', '0', '0', '0', '2000', null, '1', '1', '1', '1', '1', '170', '0', '1', '8');
