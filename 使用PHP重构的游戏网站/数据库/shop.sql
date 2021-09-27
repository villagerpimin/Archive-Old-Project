/*
 Navicat Premium Data Transfer

 Source Server         : wampMysql
 Source Server Type    : MySQL
 Source Server Version : 50731
 Source Host           : localhost:3306
 Source Schema         : fhyx

 Target Server Type    : MySQL
 Target Server Version : 50731
 File Encoding         : 65001

 Date: 01/07/2021 19:55:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for shop
-- ----------------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `userid` int(255) NOT NULL COMMENT '用户id',
  `gamenum` int(11) NOT NULL DEFAULT 1 COMMENT '加购数量',
  `gameid` int(11) NOT NULL COMMENT '游戏id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop
-- ----------------------------
INSERT INTO `shop` VALUES (3, '1930634', 2, 1, 3);
INSERT INTO `shop` VALUES (5, '1930634', 2, 7, 7);
INSERT INTO `shop` VALUES (7, '1930634', 2, 3, 8);
INSERT INTO `shop` VALUES (8, '1930634', 2, 2, 9);
INSERT INTO `shop` VALUES (9, '1930634', 2, 1, 1);

SET FOREIGN_KEY_CHECKS = 1;
