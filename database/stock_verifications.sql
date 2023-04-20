/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50733
Source Host           : localhost:3306
Source Database       : madayaw_gas_with_data

Target Server Type    : MYSQL
Target Server Version : 50733
File Encoding         : 65001

Date: 2023-04-19 17:15:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `stock_verifications`
-- ----------------------------
DROP TABLE IF EXISTS `stock_verifications`;
CREATE TABLE `stock_verifications` (
  `verify_id` int(11) NOT NULL AUTO_INCREMENT,
  `verify_prd_id` int(11) DEFAULT NULL,
  `verify_opening` int(11) DEFAULT NULL,
  `verify_closing` int(11) DEFAULT NULL,
  `verify_is_product` int(11) DEFAULT NULL,
  `verify_pdn_id` int(11) DEFAULT NULL,
  `verify_acc_id` int(11) DEFAULT NULL,
  `verify_user_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`verify_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stock_verifications
-- ----------------------------
INSERT INTO `stock_verifications` VALUES ('1', '1', '5000000', '4745000', '0', '1', '1', null);
INSERT INTO `stock_verifications` VALUES ('2', '3', null, '328', '1', '1', '1', null);
INSERT INTO `stock_verifications` VALUES ('3', '4', null, '476', '1', '1', '1', null);
INSERT INTO `stock_verifications` VALUES ('4', '5', null, '500', '1', '1', '1', null);
INSERT INTO `stock_verifications` VALUES ('5', '3', '328', '228', '1', '2', '1', null);
INSERT INTO `stock_verifications` VALUES ('6', '4', '476', '476', '1', '2', '1', null);
INSERT INTO `stock_verifications` VALUES ('7', '5', '500', '500', '1', '2', '1', null);
INSERT INTO `stock_verifications` VALUES ('8', '1', '4745000', '4635000', '0', '2', '1', null);
INSERT INTO `stock_verifications` VALUES ('9', '7', null, '10', '1', '2', '1', null);
INSERT INTO `stock_verifications` VALUES ('10', '3', '228', '228', '1', '3', '1', null);
INSERT INTO `stock_verifications` VALUES ('11', '4', '476', '476', '1', '3', '1', null);
INSERT INTO `stock_verifications` VALUES ('12', '5', '500', '500', '1', '3', '1', null);
INSERT INTO `stock_verifications` VALUES ('13', '7', '10', '10', '1', '3', '1', null);
INSERT INTO `stock_verifications` VALUES ('14', '1', '4635000', '4635000', '0', '3', '1', null);
