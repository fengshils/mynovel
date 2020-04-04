/*
Navicat MySQL Data Transfer

Source Server         : phpstudy
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : novel

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-04-04 16:41:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin_users`
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0开启1关闭',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '0', null, '1585415983');
INSERT INTO `admin_users` VALUES ('2', 'admin2', 'e10adc3949ba59abbe56e057f20f883e', '0', null, null);
INSERT INTO `admin_users` VALUES ('3', 'admin3', '32cacb2f994f6b42183a1300d9a3e8d6', '0', null, null);

-- ----------------------------
-- Table structure for `ads`
-- ----------------------------
DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `ad_code` text,
  `status` tinyint(4) DEFAULT '0' COMMENT '0开启1关闭',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='广告位管理';

-- ----------------------------
-- Records of ads
-- ----------------------------

-- ----------------------------
-- Table structure for `bookshelf`
-- ----------------------------
DROP TABLE IF EXISTS `bookshelf`;
CREATE TABLE `bookshelf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_id` int(11) NOT NULL COMMENT '小说id',
  `u_id` int(11) NOT NULL COMMENT '用户',
  `chapter_id` int(11) NOT NULL COMMENT '阅读小说章节id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `un` (`n_id`,`u_id`) USING BTREE,
  KEY `user_id` (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='用户书架';

-- ----------------------------
-- Records of bookshelf
-- ----------------------------
INSERT INTO `bookshelf` VALUES ('9', '2', '4', '1109');
INSERT INTO `bookshelf` VALUES ('4', '1699', '1', '1116177');
INSERT INTO `bookshelf` VALUES ('5', '1833', '1', '1191783');
INSERT INTO `bookshelf` VALUES ('7', '2501', '3', '1554577');

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `f_id` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT '50',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0正常1关闭2删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '男生小说', '0', '0', '0');
INSERT INTO `category` VALUES ('2', '女生小说', '0', '0', '0');
INSERT INTO `category` VALUES ('3', '其他小说', '0', '0', '0');
INSERT INTO `category` VALUES ('4', '玄幻奇幻', '1', '50', '0');
INSERT INTO `category` VALUES ('5', '武侠仙侠', '1', '50', '0');
INSERT INTO `category` VALUES ('6', '都市言情', '1', '50', '0');
INSERT INTO `category` VALUES ('7', '历史军事', '1', '50', '0');
INSERT INTO `category` VALUES ('8', '网游竞技', '1', '50', '0');
INSERT INTO `category` VALUES ('9', '科幻灵异', '1', '50', '0');
INSERT INTO `category` VALUES ('10', '恐怖灵异', '1', '50', '0');
INSERT INTO `category` VALUES ('11', '言情', '0', '50', '2');

-- ----------------------------
-- Table structure for `chapter`
-- ----------------------------
DROP TABLE IF EXISTS `chapter`;
CREATE TABLE `chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `content` text,
  `n_id` int(11) DEFAULT NULL COMMENT '小说id',
  `update_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL COMMENT '字数',
  PRIMARY KEY (`id`),
  KEY `n_id` (`n_id`) USING BTREE,
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPRESSED;

-- ----------------------------
-- Records of chapter
-- ----------------------------

-- ----------------------------
-- Table structure for `friendship_links`
-- ----------------------------
DROP TABLE IF EXISTS `friendship_links`;
CREATE TABLE `friendship_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of friendship_links
-- ----------------------------
INSERT INTO `friendship_links` VALUES ('1', '深空之流浪舰队2', 'http://www.163.com');
INSERT INTO `friendship_links` VALUES ('2', 'baidu', 'https://www.baidu.com');

-- ----------------------------
-- Table structure for `front_users`
-- ----------------------------
DROP TABLE IF EXISTS `front_users`;
CREATE TABLE `front_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `nickname` varchar(64) DEFAULT NULL COMMENT '昵称',
  `password` varchar(32) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL COMMENT '手机号',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `status` tinyint(4) DEFAULT '0' COMMENT '0开启1关闭',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_unique` (`username`),
  UNIQUE KEY `phone_unique` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of front_users
-- ----------------------------
INSERT INTO `front_users` VALUES ('1', 'admin', '123', 'e10adc3949ba59abbe56e057f20f883e', '17638561111', 'qq@qq.com', '0', null, '1585751685');
INSERT INTO `front_users` VALUES ('2', 'admin2', '123', 'e10adc3949ba59abbe56e057f20f883e', null, null, '0', null, null);
INSERT INTO `front_users` VALUES ('3', 'admin3', '123', 'e10adc3949ba59abbe56e057f20f883e', null, null, '0', null, null);
INSERT INTO `front_users` VALUES ('4', 'fengshi2', '123', 'e10adc3949ba59abbe56e057f20f883e', null, null, '0', null, null);

-- ----------------------------
-- Table structure for `novel`
-- ----------------------------
DROP TABLE IF EXISTS `novel`;
CREATE TABLE `novel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `author` varchar(32) DEFAULT NULL,
  `desc` varchar(512) DEFAULT NULL COMMENT '简介',
  `c_id` int(11) DEFAULT NULL COMMENT '小数分类\r\n',
  `d_hits` int(255) DEFAULT '0' COMMENT '日点击',
  `m_hits` int(255) DEFAULT '0' COMMENT '月点击',
  `a_hits` int(255) DEFAULT '0' COMMENT '总点击',
  `status` tinyint(255) DEFAULT '0' COMMENT '0展示1不展示2删除',
  `hash_id` varchar(32) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL COMMENT '字数',
  `cover` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE,
  KEY `hash_id` (`hash_id`) USING BTREE,
  KEY `c_id` (`c_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of novel
-- ----------------------------

-- ----------------------------
-- Table structure for `recommend`
-- ----------------------------
DROP TABLE IF EXISTS `recommend`;
CREATE TABLE `recommend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `n_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `desc` varchar(255) DEFAULT '此处填写小说id并以英文逗号隔离，或者复制此处 , 最多可以设置五本，超过不展示' COMMENT '推荐位说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='小说推荐表';

-- ----------------------------
-- Records of recommend
-- ----------------------------
INSERT INTO `recommend` VALUES ('1', 'wap首页编辑推荐', '1695,1696,1697,1698,1699', '此处填写小说id并以英文分号隔离，或者复制此处 ;   最多可以设置五本，超过不展示');
INSERT INTO `recommend` VALUES ('2', 'wap首页经典推荐', '1695,1696,1697,1698,1699', '此处填写小说id并以英文分号隔离，或者复制此处 ;   最多可以设置五本，超过不展示');
INSERT INTO `recommend` VALUES ('3', 'web首页推荐', '1,2,3,4,5,6,7,8', '此处填写小说id并以英文分号隔离，或者复制此处 ;   最多可以设置五本，超过不展示');
INSERT INTO `recommend` VALUES ('4', 'web首页经典好书', '9,10,1,12,11,13,14,15', '此处填写小说id并以英文分号隔离，或者复制此处 ;   最多可以设置五本，超过不展示');

-- ----------------------------
-- Table structure for `rotation_chart`
-- ----------------------------
DROP TABLE IF EXISTS `rotation_chart`;
CREATE TABLE `rotation_chart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL COMMENT '轮播图名称或主题',
  `link` varchar(255) DEFAULT NULL COMMENT '图片对应的url',
  `img_url` varchar(255) DEFAULT NULL COMMENT '图片url',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rotation_chart
-- ----------------------------
INSERT INTO `rotation_chart` VALUES ('1', 'ceshi1', '/m/novel/575.html', 'http://www.moyuxs.xyz/uploads/slider/20190125/75f2d003c509dc2b9d3019b874b2903d.jpg');
INSERT INTO `rotation_chart` VALUES ('2', 'ceshi2', '/m/novel/1821.html', 'http://www.moyuxs.xyz/uploads/slider/20190125/e3023f455f00de608a89c976e0977e38.png');
INSERT INTO `rotation_chart` VALUES ('3', 'ceshi3', '/m/novel/1695.html', 'http://www.moyuxs.xyz/uploads/slider/20190125/8d1c8e0332273e223adbcf21b770edcf.jpg');

-- ----------------------------
-- Table structure for `system_settings`
-- ----------------------------
DROP TABLE IF EXISTS `system_settings`;
CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_settings
-- ----------------------------
INSERT INTO `system_settings` VALUES ('1', '{\"id\":\"1\",\"site_title\":\"\\u6478\\u9c7c\\u5c0f\\u8bf4_\\u65e0\\u5f39\\u7a97\\u4e66\\u53cb\\u6700\\u503c\\u5f97\\u6536\\u85cf\\u7684\\u7f51\\u7edc\\u5c0f\\u8bf4\\u9605\\u8bfb\\u7f51\",\"site_status\":\"\\u5173\\u95ed\",\"site_des\":\"\\u6478\\u9c7c\\u5c0f\\u8bf4\\u662f\\u5e7f\\u5927\\u4e66\\u53cb\\u6700\\u503c\\u5f97\\u6536\\u85cf\\u7684\\u7f51\\u7edc\\u5c0f\\u8bf4\\u9605\\u8bfb\\u7f51\\uff0c\\u7f51\\u7ad9\\u6536\\u5f55\\u4e86\\u5f53\\u524d\\u6700\\u706b\\u70ed\\u7684\\u7f51\\u7edc\\u5c0f\\u8bf4\\uff0c\\u514d\\u8d39\\u63d0\\u4f9b\\u9ad8\\u8d28\\u91cf\\u7684\\u5c0f\\u8bf4\\u6700\\u65b0\\u7ae0\\u8282\\uff0c\\u662f\\u5e7f\\u5927\\u7f51\\u7edc\\u5c0f\\u8bf4\\u7231\\u597d\\u8005\\u5fc5\\u5907\\u7684\\u5c0f\\u8bf4\\u9605\\u8bfb\\u7f51\\u3002\",\"site_seo\":\"\\u6478\\u9c7c\\u5c0f\\u8bf4,\\u65e0\\u5f39\\u7a97,\\u5c0f\\u8bf4\\u9605\\u8bfb\\u7f51,moyu\",\"site_save_type\":\"txt\",\"site_save_path\":\"G:\\\\phpstudy_pro\\\\WWW\\\\mo.yu\\\\moyunovel\\\\Novel\",\"site_m_templte\":\"default\",\"site_pc_template\":\"default\"}');
