/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : category

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-11-10 10:47:34
*/
CREATE DATABASE category;
USE category;
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动增长id',
  `pid` int(11) NOT NULL COMMENT '父id',
  `category` varchar(255) NOT NULL COMMENT '分类名称',
  `orderid` int(11) NOT NULL DEFAULT '0' COMMENT '排序id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
