/*
Navicat MySQL Data Transfer

Source Server         : server
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : madayaw_gas

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2023-03-21 11:29:06
*/

SET FOREIGN_KEY_CHECKS=0;

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
  `cus_price_change` float DEFAULT '0',
  `cus_accessibles` varchar(255) DEFAULT NULL,
  `cus_accessibles_prices` varchar(255) DEFAULT NULL,
  `cus_notes` varchar(255) DEFAULT NULL,
  `cus_image` varchar(255) DEFAULT NULL,
  `cus_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', '1', 'lp9908qz4nbhd67tu69bo4axdfcjzqm7', 'Im Nayeon', 'Seoul Tan Kudarat', '09324234234', '0', '', '', null, '1.jpg', '1');
INSERT INTO `customers` VALUES ('2', '1', 'fw04igzm3c0kau4c2ryq2qqfprvzkmpi', 'Yoo Jeongyeon', 'Seoul Tan Kudarat', '08235434534', '0', '', '', null, '2.jpg', '1');
INSERT INTO `customers` VALUES ('3', '1', 'l9ctr0g90z1gxx3ii4c2o4z9wt259mpc', 'Hirai Momo', 'Shibuyas Bombei, Japen', '06787578232', '0', '', '', null, '3.jpg', '1');
INSERT INTO `customers` VALUES ('4', '1', 'vdvl03yj395h3av0fetyzt2cunw5epir', 'Minatozaki Sana', 'Shibu Shiti', null, '0', '', '', null, '4.jpg', '1');
INSERT INTO `customers` VALUES ('5', '1', '2w44i28onaqn4evui2svgbqv6d481o03', 'Park Jihyo', 'Seoul Tan Kudarat, South Kortabato', '09567568687', '0', '', '', null, '5.jpg', '1');
INSERT INTO `customers` VALUES ('6', '1', 't7gou40ztu0uctuzo6d28o1chxlv97vc', 'Myoui Mina', 'Nagoya Shardines, Japanacan', null, '0', '', '', null, '6.jpg', '1');
INSERT INTO `customers` VALUES ('7', '1', '9cww8cd4sluz6j95rch7d8o0fo7flv5x', 'Kim Dahyun', 'Seoulup', '08656523223', '0', '', '', null, '7.jpg', '1');
INSERT INTO `customers` VALUES ('8', '1', '947zwcnsfnl6pos6cjyerek0cc53sg5o', 'Son Chaeyoung', 'Gonjiam City', null, '0', '', '', null, '8.jpg', '1');
INSERT INTO `customers` VALUES ('9', '1', 'gul4ltv29a4xr77q4s482vpcezgprr37', 'Chou Tzuyu', 'Ajinomoto, Taiwan', null, '0', '', '', null, '9.jpg', '1');
