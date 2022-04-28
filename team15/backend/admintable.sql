/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : 127.0.0.1:3306
 Source Schema         : system3

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 29/04/2022 02:04:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cc_address_info
-- ----------------------------
DROP TABLE IF EXISTS `cc_address_info`;
CREATE TABLE `cc_address_info`  (
  `address_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `address` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `userid` int(10) NULL DEFAULT NULL,
  `tel_phone` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `receiver_name` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`address_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cc_address_info
-- ----------------------------
INSERT INTO `cc_address_info` VALUES (1, 'GuangDong', 33, '13800138000', 'Programmer');

-- ----------------------------
-- Table structure for cc_admin
-- ----------------------------
DROP TABLE IF EXISTS `cc_admin`;
CREATE TABLE `cc_admin`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `adminuser` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `adminpass` char(52) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `created_at` int(11) NOT NULL DEFAULT 0,
  `login_at` int(11) NOT NULL DEFAULT 0,
  `login_ip` bigint(3) NULL DEFAULT 0,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'Backend Management Form' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cc_admin
-- ----------------------------
INSERT INTO `cc_admin` VALUES (11, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1795162113, 1795162113, 1795162113);

-- ----------------------------
-- Table structure for cc_mess
-- ----------------------------
DROP TABLE IF EXISTS `cc_mess`;
CREATE TABLE `cc_mess`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT 'user id',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 48 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'Message Board List' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cc_mess
-- ----------------------------
INSERT INTO `cc_mess` VALUES (43, 33, '21312', '123123', 1647358457);
INSERT INTO `cc_mess` VALUES (42, 33, '21312', '123123', 1647358422);
INSERT INTO `cc_mess` VALUES (41, 33, '21312', '123123', 1647358411);
INSERT INTO `cc_mess` VALUES (40, 33, '21321', '123123', 1647358384);

-- ----------------------------
-- Table structure for cc_newsletter
-- ----------------------------
DROP TABLE IF EXISTS `cc_newsletter`;
CREATE TABLE `cc_newsletter`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Title',
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cc_newsletter
-- ----------------------------
INSERT INTO `cc_newsletter` VALUES (2, '123', '13123', 1647357246, NULL);

-- ----------------------------
-- Table structure for cc_order
-- ----------------------------
DROP TABLE IF EXISTS `cc_order`;
CREATE TABLE `cc_order`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `Deposit` float(10, 2) NULL DEFAULT 0.00 COMMENT 'Deposit',
  `quantity` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `products` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `uid` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` int(11) NULL DEFAULT 0,
  `address` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `status` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'Not Out Of Stock',
  `address_id` int(10) NULL DEFAULT NULL COMMENT 'User Address ID',
  `order_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Order Number',
  `pay_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Payment Status - 1=Refunded,0=Pending,1=Paid,2=Delivered,3=Completed',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Order Message',
  `delivery_company` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Courier companies',
  `postage` float(10, 2) NULL DEFAULT NULL COMMENT 'Freight charges',
  `paymenttime` datetime NULL DEFAULT NULL COMMENT 'payment time',
  `sendtime` datetime NULL DEFAULT NULL COMMENT 'send time',
  `endtime` datetime NULL DEFAULT NULL COMMENT 'end time',
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 39 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cc_order
-- ----------------------------
INSERT INTO `cc_order` VALUES (37, 123.00, 0.00, 2, '28', 33, 1647362894, 'xxx street', 'Out Of Stock', NULL, 'B202204242318', 1, 'Private delivery', 'UPS', 9.90, '2022-04-25 21:48:30', '2022-04-15 21:55:07', '2022-04-12 21:55:15');
INSERT INTO `cc_order` VALUES (38, 123.00, 0.00, 2, '28', 33, 1647363075, 'xxx street', 'Out Of Stock', NULL, 'B202204242012', -1, 'Private delivery', 'UPS', 9.90, '2022-04-25 21:48:35', '2022-04-20 21:55:11', '2022-04-21 21:55:19');

-- ----------------------------
-- Table structure for cc_products
-- ----------------------------
DROP TABLE IF EXISTS `cc_products`;
CREATE TABLE `cc_products`  (
  `proid` varchar(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'product id',
  `cateid` int(11) NOT NULL COMMENT 'category_id',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `detail` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `stock` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `createtime` datetime NULL DEFAULT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Product Main Image',
  `subtitle` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'subtitle',
  `updatetime` datetime NULL DEFAULT NULL COMMENT 'Update time',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Product Status.1-On Sale 2-Take down 3-Deleted',
  PRIMARY KEY (`proid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cc_products
-- ----------------------------
INSERT INTO `cc_products` VALUES (28, 6, 'ceshi', '11-231', '123123', 1, 123.00, '2022-03-15 23:00:46', 'upload/1651167799微信图片_20210624183100.jpg', NULL, NULL, 1);

-- ----------------------------
-- Table structure for cc_type
-- ----------------------------
DROP TABLE IF EXISTS `cc_type`;
CREATE TABLE `cc_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Name',
  `create_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'Type of product' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cc_type
-- ----------------------------
INSERT INTO `cc_type` VALUES (6, 'Vegetable', 1645693102);
INSERT INTO `cc_type` VALUES (7, '3C', 1645693102);

-- ----------------------------
-- Table structure for cc_user
-- ----------------------------
DROP TABLE IF EXISTS `cc_user`;
CREATE TABLE `cc_user`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `day` int(11) NOT NULL COMMENT 'Date of Birth',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `update_time` int(11) NULL DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'User Form' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cc_user
-- ----------------------------
INSERT INTO `cc_user` VALUES (7, '123', 'e10adc3949ba59abbe56e057f20f883e', 0, '', '', 1610382415, 1610331402);
INSERT INTO `cc_user` VALUES (13, '666', 'fae0b27c451c728867a567e8c1bb4e53', 0, '614141873@qq.com', '13581996629', NULL, 1610436355);
INSERT INTO `cc_user` VALUES (26, '1', 'c4ca4238a0b923820dcc509a6f75849b', 0, '614141873@qq.com', 'phone', NULL, 1610440956);
INSERT INTO `cc_user` VALUES (27, '2', 'c81e728d9d4c2f636f067f89cc14862c', 0, '', '13581996629', 1610441331, 1610441314);
INSERT INTO `cc_user` VALUES (28, '3', '202cb962ac59075b964b07152d234b70', 0, '', '13581996629', 1610442669, 1610442642);
INSERT INTO `cc_user` VALUES (29, '4', 'a87ff679a2f3e71d9181a67b7542122c', 0, '614141873@qq.com', 'phone', NULL, 1610443047);
INSERT INTO `cc_user` VALUES (30, '5', '202cb962ac59075b964b07152d234b70', 0, '614141873@qq.com', '13581996629', 1610443128, 1610443106);
INSERT INTO `cc_user` VALUES (32, '1234', '81dc9bdb52d04dc20036dbd8313ed055', 0, '15992389958@qq.com', 'phone', NULL, 1638887821);
INSERT INTO `cc_user` VALUES (33, '12333', 'a8ae104615cb4e966ddb435f3e575a02', 1647446400, '12345621@qq.com', '13042781123', NULL, 1647271474);

SET FOREIGN_KEY_CHECKS = 1;
