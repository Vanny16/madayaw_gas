/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50733
Source Host           : localhost:3306
Source Database       : madayaw_gas_with_data

Target Server Type    : MYSQL
Target Server Version : 50733
File Encoding         : 65001

Date: 2023-04-25 20:26:48
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
  PRIMARY KEY (`verify_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stock_verifications
-- ----------------------------
INSERT INTO `stock_verifications` VALUES ('1', '3', null, null, null, null, null, null, '1243', '50', '1130', '13', '0', '50', '1', '5', '1', '3', '2');
INSERT INTO `stock_verifications` VALUES ('2', '4', null, null, null, null, null, null, '573', '0', '573', '0', '0', '0', '1', '5', '1', '3', '2');
INSERT INTO `stock_verifications` VALUES ('3', '5', null, null, null, null, null, null, '500', '0', '500', '0', '0', '0', '1', '5', '1', '3', '2');
INSERT INTO `stock_verifications` VALUES ('4', '9', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '1', '5', '1', '3', '2');
INSERT INTO `stock_verifications` VALUES ('5', '10', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '1', '5', '1', '3', '2');
INSERT INTO `stock_verifications` VALUES ('6', '11', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '1', '5', '1', '3', '2');
INSERT INTO `stock_verifications` VALUES ('7', '12', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '1', '5', '1', '3', '2');
INSERT INTO `stock_verifications` VALUES ('8', '1', null, null, null, null, null, null, '0', null, null, null, null, null, '0', '5', '1', '3', '2');
INSERT INTO `stock_verifications` VALUES ('9', '2', null, null, null, null, null, null, '0', null, null, null, null, null, '0', '5', '1', '3', '2');
INSERT INTO `stock_verifications` VALUES ('10', '3', null, null, null, null, null, null, '1243', '50', '1130', '13', '0', '50', '1', '5', '1', '4', '4');
INSERT INTO `stock_verifications` VALUES ('11', '4', null, null, null, null, null, null, '573', '0', '573', '0', '0', '0', '1', '5', '1', '4', '4');
INSERT INTO `stock_verifications` VALUES ('12', '5', null, null, null, null, null, null, '500', '0', '500', '0', '0', '0', '1', '5', '1', '4', '4');
INSERT INTO `stock_verifications` VALUES ('13', '9', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '1', '5', '1', '4', '4');
INSERT INTO `stock_verifications` VALUES ('14', '10', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '1', '5', '1', '4', '4');
INSERT INTO `stock_verifications` VALUES ('15', '11', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '1', '5', '1', '4', '4');
INSERT INTO `stock_verifications` VALUES ('16', '12', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '1', '5', '1', '4', '4');
INSERT INTO `stock_verifications` VALUES ('17', '1', null, null, null, null, null, null, '0', null, null, null, null, null, '0', '5', '1', '4', '4');
INSERT INTO `stock_verifications` VALUES ('18', '2', null, null, null, null, null, null, '0', null, null, null, null, null, '0', '5', '1', '4', '4');
