/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50733
Source Host           : localhost:3306
Source Database       : test_db

Target Server Type    : MYSQL
Target Server Version : 50733
File Encoding         : 65001

Date: 2023-03-30 00:11:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `stock_verifications`
-- ----------------------------
DROP TABLE IF EXISTS `stock_verifications`;
CREATE TABLE `stock_verifications` (
  `verify_id` int(11) NOT NULL AUTO_INCREMENT,
  `verify_stock_id` int(11) DEFAULT NULL,
  `verify_opening` int(11) DEFAULT NULL,
  `verify_closing` int(11) DEFAULT NULL,
  `verify_is_product` int(11) DEFAULT NULL,
  `verify_pdn_id` int(11) DEFAULT NULL,
  `verify_acc_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`verify_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stock_verifications
-- ----------------------------
INSERT INTO `stock_verifications` VALUES ('1', '1', '5000000', null, '0', '1', '1');
