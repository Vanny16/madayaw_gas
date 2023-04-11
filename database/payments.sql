/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50741
Source Host           : localhost:3306
Source Database       : madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 50741
File Encoding         : 65001

Date: 2023-04-05 23:12:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `payments`
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `acc_id` int(11) NOT NULL,
  `pmnt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pmnt_ref_id` varchar(30) DEFAULT NULL,
  `trx_id` int(10) unsigned NOT NULL,
  `pmnt_amount` double(30,0) NOT NULL,
  `pmnt_attachment` varchar(70) DEFAULT NULL,
  `usr_id` int(11) NOT NULL,
  `pmnt_date` varchar(20) DEFAULT NULL,
  `pmnt_time` varchar(20) DEFAULT NULL,
  `trx_mode_of_payment` int(11) DEFAULT NULL,
  `pmnt_received` double(30,0) NOT NULL,
  `pmnt_change` double(30,0) NOT NULL,
  `pmnt_check_no` varchar(30) DEFAULT NULL,
  `pmnt_check_date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`pmnt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES ('1', '1', 'PMT20230330-1', '1', '1060', null, '1', '2023-03-30', '12:31:33', '1', '1060', '0', null, null);
INSERT INTO `payments` VALUES ('1', '2', 'PMT20230330-2', '2', '480', null, '1', '2023-03-30', '12:34:31', '2', '480', '0', null, null);
INSERT INTO `payments` VALUES ('1', '3', 'PMT20230330-3', '3', '1200', '3.jpg', '1', '2023-03-30', '12:36:27', '3', '1200', '0', null, null);
INSERT INTO `payments` VALUES ('1', '4', 'PMT20230331-4', '4', '0', null, '1', '2023-03-31', '11:51:55', '2', '0', '0', null, null);
INSERT INTO `payments` VALUES ('1', '5', 'PMT20230331-5', '5', '30', null, '1', '2023-03-31', '11:59:20', '1', '50', '20', null, null);
INSERT INTO `payments` VALUES ('1', '6', 'PMT20230405-6', '6', '0', null, '1', '2023-04-05', '07:44:29', '2', '0', '0', null, null);
INSERT INTO `payments` VALUES ('1', '7', 'PMT20230405-7', '7', '0', null, '1', '2023-04-05', '07:46:47', '2', '0', '0', null, null);
INSERT INTO `payments` VALUES ('1', '8', 'PMT20230405-8', '8', '700', '8.jpg', '1', '2023-04-05', '08:56:57', '3', '2000', '1300', '23488764', '2023');
INSERT INTO `payments` VALUES ('1', '9', 'PMT20230405-9', '9', '701', null, '1', '2023-04-05', '08:59:53', '4', '1212', '510', '12', '2023');
INSERT INTO `payments` VALUES ('1', '10', 'PMT20230405-10', '10', '12', '10.jpg', '1', '2023-04-05', '09:13:53', '4', '12', '0', '454', '2023-04-06');
