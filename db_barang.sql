/*
 Navicat Premium Data Transfer

 Source Server         : laragon-mysql
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : db_barang

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 12/07/2020 20:38:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `qty` int(11) NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of barang
-- ----------------------------
INSERT INTO `barang` VALUES (3, 'Galaxy S20', 20, NULL, 10000000);
INSERT INTO `barang` VALUES (6, 'Redmi Note 7', 55, '', 3000000);
INSERT INTO `barang` VALUES (7, 'Redmi Note 9 Pro', 60, NULL, 4300000);
INSERT INTO `barang` VALUES (8, 'Huawei P30 Pro', 50, NULL, 14000000);

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_barang` int(11) NULL DEFAULT NULL,
  `waktu` datetime(6) NULL DEFAULT NULL,
  `id_user` int(11) NULL DEFAULT NULL,
  `banyak_barang` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES (5, 'MASUK-juauo', 'Masuk', 4, '2020-07-12 19:17:06.000000', 2, 40);
INSERT INTO `transaksi` VALUES (6, 'MASUK-jub6F', 'Masuk', 5, '2020-07-12 19:28:55.000000', 2, 100);
INSERT INTO `transaksi` VALUES (7, 'KELUAR-jubBL', 'Keluar', 3, '2020-07-12 19:34:11.000000', 2, 10);
INSERT INTO `transaksi` VALUES (8, 'KELUAR-jubkk', 'Return', 3, '2020-07-12 20:10:46.000000', 2, 10);
INSERT INTO `transaksi` VALUES (9, 'MASUK-jubzx', 'Masuk', 6, '2020-07-12 20:26:29.000000', 2, 55);
INSERT INTO `transaksi` VALUES (10, 'MASUK-juc0I', 'Masuk', 7, '2020-07-12 20:26:50.000000', 2, 60);
INSERT INTO `transaksi` VALUES (11, 'KELUAR-juc0c', 'Keluar', 7, '2020-07-12 20:27:10.000000', 2, 50);
INSERT INTO `transaksi` VALUES (12, 'KELUAR-juc0l', 'Return', 7, '2020-07-12 20:27:19.000000', 2, 50);
INSERT INTO `transaksi` VALUES (13, 'MASUK-juc5L', 'Masuk', 8, '2020-07-12 20:32:03.000000', 3, 50);
INSERT INTO `transaksi` VALUES (14, 'KELUAR-juc5U', 'Keluar', 8, '2020-07-12 20:32:12.000000', 3, 43);
INSERT INTO `transaksi` VALUES (15, 'KELUAR-juc5j', 'Return', 8, '2020-07-12 20:32:27.000000', 2, 43);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `last_login` datetime(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (2, 'fauzan', 'fauzan', 'admin', NULL);
INSERT INTO `user` VALUES (3, 'fadhil', 'fadhil', 'admin', NULL);

SET FOREIGN_KEY_CHECKS = 1;
