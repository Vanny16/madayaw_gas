/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50733
Source Host           : localhost:3306
Source Database       : test_madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 50733
File Encoding         : 65001

Date: 2023-04-12 13:10:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `user_types`
-- ----------------------------
DROP TABLE IF EXISTS `user_types`;
CREATE TABLE `user_types` (
  `typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `typ_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`typ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_types
-- ----------------------------
INSERT INTO `user_types` VALUES ('1', 'Administrator');
INSERT INTO `user_types` VALUES ('2', 'Employee');
INSERT INTO `user_types` VALUES ('3', 'Observer');
INSERT INTO `user_types` VALUES ('4', 'Supervisor');
INSERT INTO `user_types` VALUES ('5', 'Plant Manager');
