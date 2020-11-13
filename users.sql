/*
Navicat MySQL Data Transfer

Source Server         : z-linux
Source Server Version : 80022
Source Host           : localhost:3306
Source Database       : hyperf_base

Target Server Type    : MYSQL
Target Server Version : 80022
File Encoding         : 65001

Date: 2020-11-14 04:08:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '密码',
  `created_time` int DEFAULT '0' COMMENT '鍒涘缓鏃堕棿',
  `updated_time` int DEFAULT '0' COMMENT '鏇存柊鏃堕棿',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'test', '$2y$10$K4WeNo/nXi9Vmxkh9QBP.u9nVHpfQ6ESSp7VjSYhr2NacyGZn/zG.', '1605295070', '1605295070');
INSERT INTO `users` VALUES ('2', 'test0', '$2y$10$U3p4bP8rUQ.or05pxwEQg.E3mLuJnloiwwO.Rsmv9yL7wplYsU11G', '1605295120', '1605295120');
INSERT INTO `users` VALUES ('3', 'test1', '$2y$10$lOpW7zHmnhLQMv7aL6L6dOtrzKOmmb3D/EnUEJNxJ52lza6S3GnnS', '1605295120', '1605295120');
INSERT INTO `users` VALUES ('4', 'test2', '$2y$10$OskEUECK7ATy7.PkNz6QGOMe4LnaFCx6Pszpu6ayiI2dl3oP.0DTi', '1605295120', '1605295120');
INSERT INTO `users` VALUES ('5', 'test3', '$2y$10$riPRrgKTr1wvdcfA9hvAv./Es28s.VVQFpVbbPZTDnFri4.jc1ZX6', '1605295120', '1605295120');
INSERT INTO `users` VALUES ('6', 'test4', '$2y$10$b12T7QNp54SUPhAy.1.YDuQt7Aq0Esnf0xpMcrwBnHceW5meaL/Li', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('7', 'test5', '$2y$10$toNm0dS7MbdZWnIJpf6NKuc19iDCEM7WDGyORd46l//5cQJkdVJ0K', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('8', 'test6', '$2y$10$PIM.R46nuNCEQiAkuM72Quvkjd7HvJCEkhdmjrsl42hEClIZU0DUq', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('9', 'test7', '$2y$10$dWPma5ZU6dLOaPP4FKbwEuv1Whyb0IXsxwFSNYcJzBbcBsP2G/4EG', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('10', 'test8', '$2y$10$WhAynARLxmOwMMLoxlcllu3wVcnOvX1Ltmga3Y9IXhyWpDS5MY5/6', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('11', 'test9', '$2y$10$IB8QbHFD8g9C299uCXf6qeCz1O8QnIII4f5l6ReIfIfEezh8V2lEW', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('12', 'test10', '$2y$10$b9J2Kq0OqNJhv/fAWwiRz.1BBsuWC7cln6WmYSvpvOjL1DN5TCic6', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('13', 'test11', '$2y$10$apHYDNfHUfnvw74bldMmH.ZQQ5R.TEl/2UY3fBdJd5AeF6a/NGVqC', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('14', 'test12', '$2y$10$W1h26h6eF4UVDD3XPBrd.O4zLVveA8ooT8YGeKDwYcpf9FNJCiHSG', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('15', 'test13', '$2y$10$k2QqOE.SltSGtHt75WY7NesPK3O5O4ibyYxIYuVuXKH7eTb.mGYX2', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('16', 'test14', '$2y$10$Yj/TQNXnR9eRBKz4Bm4DMuYa0MSFDPwTVFm.uHrLSa7jeVwbXFzau', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('17', 'test15', '$2y$10$9MktaufTAljwF3cjR7AAg.HOS6QEXesQ4izC.aHGH7C4SgbESKg3q', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('18', 'test16', '$2y$10$I70hi2xqXJNCTNhj7cMJaOnc16I7gvo8EpGe4KpFZE5cidzCG2TQy', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('19', 'test17', '$2y$10$sxAjcpwLvAdqoSSU.dOy7ufqtNN3cqNdbP7yIH7L9B05P2VL/tDMW', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('20', 'test18', '$2y$10$F0MYkDYg9i.kCjtrMk/tRe2DSjyRymLelUeIlwV/YNjByIe4Epu8.', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('21', 'test19', '$2y$10$QX/Ijdxlq5OBKrGVjfi26uzRnBUAl0S1QdomL6XQFFmSOKoFBKwU2', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('22', 'test20', '$2y$10$q4/8DZ5m/b9g/H0WTL9RGOAr3OtzmmX0aSVWN6gtSvw6Iu9Ya5dom', '1605295121', '1605295121');
INSERT INTO `users` VALUES ('23', 'test21', '$2y$10$Q.QxTwIjn2b63m6H1i7MEela5ish1XAR9bb6O6aCy4lcEV.UePweq', '1605297436', '1605297483');
