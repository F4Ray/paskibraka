/*
 Navicat Premium Data Transfer

 Source Server         : laragon-mysql
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : new_paskibraka

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 19/12/2020 12:26:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_users
-- ----------------------------
DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE `tb_users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `akses_level` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_users
-- ----------------------------
INSERT INTO `tb_users` VALUES (1, 'fauzan now', 'f4ray', 'rinnegan91', '1');
INSERT INTO `tb_users` VALUES (2, 'fauzan', 'fauzan', 'rinnegan91', '1');
INSERT INTO `tb_users` VALUES (3, 'Ilone', 'eolin', 'rinnegan91', '1');
INSERT INTO `tb_users` VALUES (4, 'Eolin', 'alka', 'rinnegan91', '1');
INSERT INTO `tb_users` VALUES (5, 'Admin Pertama', 'admin', 'iniadmin', '0');
INSERT INTO `tb_users` VALUES (6, 'Admin 2', 'admin2', 'adminku', '0');
INSERT INTO `tb_users` VALUES (7, 'Admin 3', 'admin3', 'adminmu', '0');
INSERT INTO `tb_users` VALUES (10, 'andi', 'andinegara', 'rinnegan91', '1');

SET FOREIGN_KEY_CHECKS = 1;
