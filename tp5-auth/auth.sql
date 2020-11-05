
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for think_group
-- ----------------------------
DROP TABLE IF EXISTS `think_group`;
CREATE TABLE `think_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` enum('1','-1') NOT NULL DEFAULT '1',
  `rules` varchar(255) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_group
-- ----------------------------
INSERT INTO `think_group` VALUES ('1', '超级管理员', '1', '1,2,4,5,6,7,8,9,10,11,12,13,14,15,16', '2017-09-22 16:48:34', '2017-09-29 10:39:45');
INSERT INTO `think_group` VALUES ('2', '普通管理员', '1', '1,2,3,4,5,6,7,9,10,11,12,13', '2017-09-22 17:12:57', '2017-09-23 13:12:38');
INSERT INTO `think_group` VALUES ('3', '游客', '1', '3,13', '2017-09-23 09:30:37', '2017-09-23 11:04:37');

-- ----------------------------
-- Table structure for think_group_access
-- ----------------------------
DROP TABLE IF EXISTS `think_group_access`;
CREATE TABLE `think_group_access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_group_access
-- ----------------------------
INSERT INTO `think_group_access` VALUES ('29', '1', '1');
INSERT INTO `think_group_access` VALUES ('30', '2', '1');
INSERT INTO `think_group_access` VALUES ('31', '2', '2');
INSERT INTO `think_group_access` VALUES ('32', '2', '3');
INSERT INTO `think_group_access` VALUES ('33', '4', '1');
INSERT INTO `think_group_access` VALUES ('34', '4', '2');

-- ----------------------------
-- Table structure for think_rule
-- ----------------------------
DROP TABLE IF EXISTS `think_rule`;
CREATE TABLE `think_rule` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `rules` varchar(80) NOT NULL DEFAULT '',
  `title` varchar(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `condition` char(100) NOT NULL DEFAULT '',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_rule
-- ----------------------------
INSERT INTO `think_rule` VALUES ('1', 'admin/auth/authlist', '查看权限', '1', '1', '', '2017-09-22 17:03:41', '2017-09-22 17:26:23');
INSERT INTO `think_rule` VALUES ('2', 'admin/user/adduser', '添加用户', '1', '1', '', '2017-09-22 17:04:52', '2017-09-23 13:39:41');
INSERT INTO `think_rule` VALUES ('3', 'admin/user/index', '查看用户', '1', '1', '', '2017-09-22 17:06:15', '2017-09-23 11:19:41');
INSERT INTO `think_rule` VALUES ('4', 'admin/user/grouplist', '查看用户组', '1', '1', '', '2017-09-22 17:06:54', '2017-09-23 11:04:27');
INSERT INTO `think_rule` VALUES ('5', 'admin/user/addgroup', '添加用户组', '1', '1', '', '2017-09-22 17:07:32', '2017-09-23 11:04:23');
INSERT INTO `think_rule` VALUES ('6', 'admin/user/deluser', '删除用户', '1', '1', '', '2017-09-22 17:20:26', '2017-09-23 11:09:41');
INSERT INTO `think_rule` VALUES ('7', 'admin/user/delgroup', '删除用户组', '1', '1', '', '2017-09-22 17:21:42', '2017-09-23 11:21:41');
INSERT INTO `think_rule` VALUES ('8', 'admin/user/edituser', '修改用户', '1', '1', '', '2017-09-22 17:22:52', '2017-09-23 11:22:41');
INSERT INTO `think_rule` VALUES ('9', 'admin/user/editgroup', '修改用户组', '1', '1', '', '2017-09-22 17:23:13', '2017-09-23 11:23:21');
INSERT INTO `think_rule` VALUES ('10', 'admin/auth/addauth', '添加权限', '1', '1', '', '2017-09-22 17:25:17', '2017-09-23 11:25:41');
INSERT INTO `think_rule` VALUES ('11', 'admin/auth/delauth', '删除权限', '1', '1', '', '2017-09-22 17:27:11', '2017-09-23 11:31:21');
INSERT INTO `think_rule` VALUES ('12', 'admin/auth/editauth', '修改权限', '1', '1', '', '2017-09-22 17:27:51', '2017-09-23 11:35:11');
INSERT INTO `think_rule` VALUES ('13', 'admin/index/index', '系统首页', '1', '1', '', '2017-09-22 18:06:06', '2017-09-23 11:41:01');
INSERT INTO `think_rule` VALUES ('14', 'admin/user/lockgroup', '锁定组', '1', '1', '', '2017-09-23 11:12:11', '2017-09-23 11:01:21');
INSERT INTO `think_rule` VALUES ('15', 'admin/user/lockuser', '锁定用户', '1', '-1', '', '2017-09-23 11:12:33', '2017-09-29 16:42:32');
INSERT INTO `think_rule` VALUES ('16', 'admin/auth/lockauth', '锁定权限', '1', '1', '', '2017-09-23 16:20:18', '2017-09-23 11:51:21');

-- ----------------------------
-- Table structure for think_user
-- ----------------------------
DROP TABLE IF EXISTS `think_user`;
CREATE TABLE `think_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `login_ip` varchar(255) DEFAULT NULL,
  `login_location` varchar(255) DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `last_login_location` varchar(255) DEFAULT NULL,
  `status` enum('1','-1') NOT NULL DEFAULT '1',
  `create_time` datetime NOT NULL,
  `login_num` int(11) NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_user
-- ----------------------------
INSERT INTO `think_user` VALUES ('1', 'SuperAdmin', 'admin@qq.com', '17c4520f6cfd1ab53d8745e84681eb49', '2017-09-23 09:14:11', '127.0.0.1', '本机地址', '127.0.0.1', '2017-09-22 18:09:51', '本机地址', '1', '2017-09-22 16:38:47', '11', '2017-09-29 10:41:50');
INSERT INTO `think_user` VALUES ('2', 'user', 'user@qq.com', '0192023a7bbd73250516f069df18b500', '2017-09-23 09:53:36', '127.0.0.1', '本机地址', '127.0.0.1', '2017-09-23 09:53:29', '本机地址', '-1', '2017-09-22 17:10:10', '17', '2017-09-29 16:48:45');
INSERT INTO `think_user` VALUES ('4', 'test', 'test@qq.com', '0192023a7bbd73250516f069df18b500', null, null, null, null, null, null, '1', '2017-09-28 15:03:29', '0', '2017-09-29 10:42:38');
