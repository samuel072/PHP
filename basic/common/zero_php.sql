/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50710
 Source Host           : localhost
 Source Database       : zero_php

 Target Server Type    : MySQL
 Target Server Version : 50710
 File Encoding         : utf-8

 Date: 02/02/2016 11:13:24 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `zp_user`
-- ----------------------------
DROP TABLE IF EXISTS `zp_user`;
CREATE TABLE `zp_user` (
  `uuid` varchar(40) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `sex` int(2) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `avatar` varchar(225) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `last_time` datetime DEFAULT NULL,
  `login_ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `zp_user`
-- ----------------------------
BEGIN;
INSERT INTO `zp_user` VALUES ('3A075C8B-2E5A-A110-0702-5BD5CDB60318', 'zero', '96e79218965eb72c92a549dd5a330112', '1', '25', 'http://pics.sc.chinaz.com/files/pic/pic9/201511/apic16807.jpg', '2016-01-17 09:46:32', null, '127.0.0.1'), ('F2CAE7AA-227D-48FF-0A8D-00B7D606A383', 'zero', '96e79218965eb72c92a549dd5a330112', '1', '25', 'http://pics.sc.chinaz.com/files/pic/pic9/201511/apic16807.jpg', '2016-01-17 09:54:18', null, '127.0.0.1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
