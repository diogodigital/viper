/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50736 (5.7.36)
 Source Host           : localhost:3306
 Source Schema         : viper

 Target Server Type    : MySQL
 Target Server Version : 50736 (5.7.36)
 File Encoding         : 65001

 Date: 02/02/2024 13:58:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for affiliate_histories
-- ----------------------------
DROP TABLE IF EXISTS `affiliate_histories`;
CREATE TABLE `affiliate_histories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `inviter` int(10) UNSIGNED NOT NULL,
  `commission` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `commission_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deposited` tinyint(4) NULL DEFAULT 0,
  `deposited_amount` decimal(10, 2) NULL DEFAULT 0.00,
  `losses` bigint(20) NULL DEFAULT 0,
  `losses_amount` decimal(10, 2) NULL DEFAULT 0.00,
  `commission_paid` decimal(10, 2) NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `affiliate_histories_user_id_index`(`user_id`) USING BTREE,
  INDEX `affiliate_histories_inviter_index`(`inviter`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of affiliate_histories
-- ----------------------------

-- ----------------------------
-- Table structure for banners
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'home',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of banners
-- ----------------------------
INSERT INTO `banners` VALUES (8, '#', '01HKZCGDG7CHX190CEG5D2AYTX.png', 'carousel', '...', '2024-01-12 14:46:23', '2024-01-12 14:46:23');
INSERT INTO `banners` VALUES (9, '#', '01HKZCJ3GTDYYBE4V4QN0AKW9F.png', 'carousel', '...', '2024-01-12 14:47:18', '2024-01-12 14:47:18');
INSERT INTO `banners` VALUES (6, '#', '01HKZCD0HTKCXM9FHT62QVY3R6.png', 'carousel', '...', '2024-01-12 14:44:31', '2024-01-12 14:45:10');
INSERT INTO `banners` VALUES (7, '#', '01HKZCFRC1KTYZ150YC4FPMNK7.png', 'carousel', '...\n', '2024-01-12 14:46:01', '2024-01-12 14:46:01');

-- ----------------------------
-- Table structure for casino_games_salsas
-- ----------------------------
DROP TABLE IF EXISTS `casino_games_salsas`;
CREATE TABLE `casino_games_salsas`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_type` enum('FREE','CHARGED') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'FREE',
  `game_pn` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_label` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_service` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `views` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `casino_games_salsas_slug_unique`(`slug`) USING BTREE,
  INDEX `casino_games_salsas_category_id_foreign`(`category_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of casino_games_salsas
-- ----------------------------

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(249) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(249) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `slug`(`slug`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Recomendados', 'Todos os jogos recomendados', 'uploads/WVLcCZ4gGDgP1OPcv3M9y1BAnmOqU6-metadGVzb3VyZS5wbmc=-.png', 'recomendados', '2023-12-29 15:57:17', '2023-12-29 15:57:17');
INSERT INTO `categories` VALUES (2, 'Jogos da Fortuna', 'Lista de Jogos da fortuna', 'uploads/TXQREUiwee0dFOlYYUul0luttRMvWb-metadGlnZXItMi5wbmc=-.png', 'jogos-da-fortuna', '2023-12-29 15:58:34', '2023-12-29 15:58:34');

-- ----------------------------
-- Table structure for debug
-- ----------------------------
DROP TABLE IF EXISTS `debug`;
CREATE TABLE `debug`  (
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of debug
-- ----------------------------

-- ----------------------------
-- Table structure for deposits
-- ----------------------------
DROP TABLE IF EXISTS `deposits`;
CREATE TABLE `deposits`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `proof` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `deposits_user_id_foreign`(`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of deposits
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for fivers_games
-- ----------------------------
DROP TABLE IF EXISTS `fivers_games`;
CREATE TABLE `fivers_games`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fivers_provider_id` int(11) NOT NULL,
  `casino_category_id` int(11) NOT NULL,
  `game_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `game_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `banner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `views` bigint(20) NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 880 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fivers_games
-- ----------------------------
INSERT INTO `fivers_games` VALUES (1, 1, 1, 'vs243mwarrior', 'Monkey Warrior', 'fivers/vs243mwarrior.png', 0, 1, '2023-12-23 23:23:31', '2024-01-12 17:23:54');
INSERT INTO `fivers_games` VALUES (2, 1, 1, 'vs20doghouse', 'The Dog House', 'fivers/vs20doghouse.png', 0, 1, '2023-12-23 23:23:32', '2023-12-23 23:23:32');
INSERT INTO `fivers_games` VALUES (3, 1, 1, 'vs40pirate', 'Pirate Gold', 'fivers/vs40pirate.png', 0, 1, '2023-12-23 23:23:33', '2023-12-23 23:23:33');
INSERT INTO `fivers_games` VALUES (4, 1, 1, 'vs20rhino', 'Great Rhino', 'fivers/vs20rhino.png', 0, 1, '2023-12-23 23:23:35', '2023-12-23 23:23:35');
INSERT INTO `fivers_games` VALUES (5, 1, 1, 'vs25pandagold', 'Panda Fortune', 'fivers/vs25pandagold.png', 0, 1, '2023-12-23 23:23:37', '2023-12-23 23:23:37');
INSERT INTO `fivers_games` VALUES (6, 1, 1, 'vs4096bufking', 'Buffalo King', 'fivers/vs4096bufking.png', 0, 1, '2023-12-23 23:23:39', '2023-12-23 23:23:39');
INSERT INTO `fivers_games` VALUES (7, 1, 1, 'vs25pyramid', 'Pyramid King', 'fivers/vs25pyramid.png', 0, 1, '2023-12-23 23:23:40', '2023-12-23 23:23:40');
INSERT INTO `fivers_games` VALUES (8, 1, 1, 'vs5ultrab', 'Ultra Burn', 'fivers/vs5ultrab.png', 0, 1, '2023-12-23 23:23:42', '2023-12-23 23:23:42');
INSERT INTO `fivers_games` VALUES (9, 1, 1, 'vs5ultra', 'Ultra Hold and Spin', 'fivers/vs5ultra.png', 0, 1, '2023-12-23 23:23:43', '2023-12-23 23:23:43');
INSERT INTO `fivers_games` VALUES (10, 1, 1, 'vs25jokerking', 'Joker King', 'fivers/vs25jokerking.png', 0, 1, '2023-12-23 23:23:45', '2023-12-23 23:23:45');
INSERT INTO `fivers_games` VALUES (11, 1, 1, 'vs10returndead', 'Return of the Dead', 'fivers/vs10returndead.png', 0, 1, '2023-12-23 23:23:47', '2023-12-23 23:23:47');
INSERT INTO `fivers_games` VALUES (12, 1, 1, 'vs10madame', 'Madame Destiny', 'fivers/vs10madame.png', 0, 1, '2023-12-23 23:23:48', '2023-12-23 23:23:48');
INSERT INTO `fivers_games` VALUES (13, 1, 1, 'vs15diamond', 'Diamond Strike', 'fivers/vs15diamond.png', 0, 1, '2023-12-23 23:23:50', '2023-12-23 23:23:50');
INSERT INTO `fivers_games` VALUES (14, 1, 1, 'vs25aztecking', 'Aztec King', 'fivers/vs25aztecking.png', 0, 1, '2023-12-23 23:23:52', '2023-12-23 23:23:52');
INSERT INTO `fivers_games` VALUES (15, 1, 1, 'vs25wildspells', 'Wild Spells', 'fivers/vs25wildspells.png', 0, 1, '2023-12-23 23:23:53', '2023-12-23 23:23:53');
INSERT INTO `fivers_games` VALUES (16, 1, 1, 'vs10bbbonanza', 'Big Bass Bonanza', '01HKZNP91DDN21VS4Q90PZX520.jpg', 1, 1, '2023-12-23 23:23:55', '2024-01-12 17:27:07');
INSERT INTO `fivers_games` VALUES (17, 1, 1, 'vs10cowgold', 'Cowboys Gold', 'fivers/vs10cowgold.png', 0, 1, '2023-12-23 23:23:56', '2023-12-23 23:23:56');
INSERT INTO `fivers_games` VALUES (18, 1, 1, 'vs25tigerwar', 'The Tiger Warrior', 'fivers/vs25tigerwar.png', 0, 1, '2023-12-23 23:23:58', '2023-12-23 23:23:58');
INSERT INTO `fivers_games` VALUES (19, 1, 1, 'vs25mustang', 'Mustang Gold', 'fivers/vs25mustang.png', 0, 1, '2023-12-23 23:24:00', '2023-12-23 23:24:00');
INSERT INTO `fivers_games` VALUES (20, 1, 1, 'vs25hotfiesta', 'Hotfiesta', 'fivers/vs25hotfiesta.png', 0, 1, '2023-12-23 23:24:00', '2023-12-23 23:24:00');
INSERT INTO `fivers_games` VALUES (21, 1, 1, 'vs243dancingpar', 'Dance Party', '01HKZPEVY3HMD7PKJAJ33B7X55.jpg', 1, 1, '2023-12-23 23:24:04', '2024-01-12 17:40:18');
INSERT INTO `fivers_games` VALUES (22, 1, 1, 'vs576treasures', 'Wild Wild Riches', 'fivers/vs576treasures.png', 0, 1, '2023-12-23 23:24:06', '2023-12-23 23:24:06');
INSERT INTO `fivers_games` VALUES (23, 1, 1, 'vs20hburnhs', 'Hot to Burn Hold and Spin', 'fivers/vs20hburnhs.png', 0, 1, '2023-12-23 23:24:08', '2023-12-23 23:24:08');
INSERT INTO `fivers_games` VALUES (24, 1, 1, 'vs20emptybank', 'Empty the Bank', 'fivers/vs20emptybank.png', 0, 1, '2023-12-23 23:24:09', '2023-12-23 23:24:09');
INSERT INTO `fivers_games` VALUES (25, 1, 1, 'vs20midas', 'The Hand of Midas', 'fivers/vs20midas.png', 0, 1, '2023-12-23 23:24:11', '2023-12-23 23:24:11');
INSERT INTO `fivers_games` VALUES (26, 1, 1, 'vs20olympgate', 'Gates of Olympus', '01HKZNJNZG6QDZ30DS2BGHD2HZ.jpg', 1, 1, '2023-12-23 23:24:13', '2024-01-12 17:24:54');
INSERT INTO `fivers_games` VALUES (27, 1, 1, 'vswayslight', 'Lucky Lightning', 'fivers/vswayslight.png', 0, 1, '2023-12-23 23:24:14', '2023-12-23 23:24:14');
INSERT INTO `fivers_games` VALUES (28, 1, 1, 'vs20vegasmagic', 'Vegas Magic', 'fivers/vs20vegasmagic.png', 0, 1, '2023-12-23 23:24:16', '2023-12-23 23:24:16');
INSERT INTO `fivers_games` VALUES (29, 1, 1, 'vs20fruitparty', 'Fruit Party', 'fivers/vs20fruitparty.png', 0, 1, '2023-12-23 23:24:17', '2023-12-23 23:24:17');
INSERT INTO `fivers_games` VALUES (30, 1, 1, 'vs20fparty2', 'Fruit Party 2', 'fivers/vs20fparty2.png', 0, 1, '2023-12-23 23:24:19', '2023-12-23 23:24:19');
INSERT INTO `fivers_games` VALUES (31, 1, 1, 'vswaysdogs', 'The Dog House Megaways', 'fivers/vswaysdogs.png', 0, 1, '2023-12-23 23:24:20', '2023-12-23 23:24:20');
INSERT INTO `fivers_games` VALUES (32, 1, 1, 'vs50juicyfr', 'Juicy Fruits', '01HKZNR71H3HE2WSV1DZWA53WH.png', 1, 1, '2023-12-23 23:24:22', '2024-01-12 17:27:55');
INSERT INTO `fivers_games` VALUES (33, 1, 1, 'vs25pandatemple', 'Panda Fortune 2', 'fivers/vs25pandatemple.png', 0, 1, '2023-12-23 23:24:23', '2023-12-23 23:24:23');
INSERT INTO `fivers_games` VALUES (34, 1, 1, 'vswaysbufking', 'Buffalo King Megaways', 'fivers/vswaysbufking.png', 0, 1, '2023-12-23 23:24:25', '2023-12-23 23:24:25');
INSERT INTO `fivers_games` VALUES (35, 1, 1, 'vs40wildwest', 'Wild West Gold', 'fivers/vs40wildwest.png', 0, 1, '2023-12-23 23:24:27', '2023-12-23 23:24:27');
INSERT INTO `fivers_games` VALUES (36, 1, 1, 'vs20chickdrop', 'Chicken Drop', 'fivers/vs20chickdrop.png', 0, 1, '2023-12-23 23:24:28', '2023-12-23 23:24:28');
INSERT INTO `fivers_games` VALUES (37, 1, 1, 'vs40spartaking', 'Spartan King', 'fivers/vs40spartaking.png', 0, 1, '2023-12-23 23:24:30', '2023-12-23 23:24:30');
INSERT INTO `fivers_games` VALUES (38, 1, 1, 'vswaysrhino', 'Great Rhino Megaways', 'fivers/vswaysrhino.png', 0, 1, '2023-12-23 23:24:32', '2023-12-23 23:24:32');
INSERT INTO `fivers_games` VALUES (39, 1, 1, 'vs20sbxmas', 'Sweet Bonanza Xmas', 'fivers/vs20sbxmas.png', 0, 1, '2023-12-23 23:24:33', '2023-12-23 23:24:33');
INSERT INTO `fivers_games` VALUES (40, 1, 1, 'vs10fruity2', 'Extra Juicy', 'fivers/vs10fruity2.png', 0, 1, '2023-12-23 23:24:35', '2023-12-23 23:24:35');
INSERT INTO `fivers_games` VALUES (41, 1, 1, 'vs10egypt', 'Ancient Egypt', 'fivers/vs10egypt.png', 0, 1, '2023-12-23 23:24:36', '2023-12-23 23:24:36');
INSERT INTO `fivers_games` VALUES (42, 1, 1, 'vs5drhs', 'Dragon Hot Hold and Spin', 'fivers/vs5drhs.png', 0, 1, '2023-12-23 23:24:37', '2023-12-23 23:24:37');
INSERT INTO `fivers_games` VALUES (43, 1, 1, 'vs12bbb', 'Bigger Bass Bonanza', 'fivers/vs12bbb.png', 0, 1, '2023-12-23 23:24:39', '2023-12-23 23:24:39');
INSERT INTO `fivers_games` VALUES (44, 1, 1, 'vs20tweethouse', 'The Tweety House', 'fivers/vs20tweethouse.png', 0, 1, '2023-12-23 23:24:40', '2023-12-23 23:24:40');
INSERT INTO `fivers_games` VALUES (45, 1, 1, 'vswayslions', '5 Lions Megaways', 'fivers/vswayslions.png', 0, 1, '2023-12-23 23:24:42', '2023-12-23 23:24:42');
INSERT INTO `fivers_games` VALUES (46, 1, 1, 'vswayssamurai', 'Rise of Samurai Megaways', 'fivers/vswayssamurai.png', 0, 1, '2023-12-23 23:24:44', '2023-12-23 23:24:44');
INSERT INTO `fivers_games` VALUES (47, 1, 1, 'vs50pixie', 'Pixie Wings', 'fivers/vs50pixie.png', 0, 1, '2023-12-23 23:24:45', '2023-12-23 23:24:45');
INSERT INTO `fivers_games` VALUES (48, 1, 1, 'vs10floatdrg', 'Floating Dragon', '01HKZPACRGESYAXH98P93YWP1G.jpg', 1, 1, '2023-12-23 23:24:47', '2024-01-12 17:37:51');
INSERT INTO `fivers_games` VALUES (49, 1, 1, 'vs20fruitsw', 'Sweet Bonanza', 'fivers/vs20fruitsw.png', 0, 1, '2023-12-23 23:24:48', '2023-12-23 23:24:48');
INSERT INTO `fivers_games` VALUES (50, 1, 1, 'vs20rhinoluxe', 'Great Rhino Deluxe', 'fivers/vs20rhinoluxe.png', 0, 1, '2023-12-23 23:24:50', '2023-12-23 23:24:50');
INSERT INTO `fivers_games` VALUES (51, 1, 1, 'vswaysmadame', 'Madame Destiny Megaways', 'fivers/vswaysmadame.png', 0, 1, '2023-12-23 23:24:51', '2023-12-23 23:24:51');
INSERT INTO `fivers_games` VALUES (52, 1, 1, 'vs1024temuj', 'Temujin Treasures', 'fivers/vs1024temuj.png', 0, 1, '2023-12-23 23:24:52', '2023-12-23 23:24:52');
INSERT INTO `fivers_games` VALUES (53, 1, 1, 'vs40pirgold', 'Pirate Gold Deluxe', 'fivers/vs40pirgold.png', 0, 1, '2023-12-23 23:24:54', '2023-12-23 23:24:54');
INSERT INTO `fivers_games` VALUES (54, 1, 1, 'vs25mmouse', 'Money Mouse', '01HKZQ0054Y8KD36QXMVQHZKWH.jpg', 1, 1, '2023-12-23 23:24:55', '2024-01-12 17:49:39');
INSERT INTO `fivers_games` VALUES (55, 1, 1, 'vs10threestar', 'Three Star Fortune', 'fivers/vs10threestar.png', 0, 1, '2023-12-23 23:24:57', '2023-12-23 23:24:57');
INSERT INTO `fivers_games` VALUES (56, 1, 1, 'vs1ball', 'Lucky Dragon Ball', 'fivers/vs1ball.png', 0, 1, '2023-12-23 23:24:58', '2023-12-23 23:24:58');
INSERT INTO `fivers_games` VALUES (57, 1, 1, 'vs243lionsgold', '5 Lions', 'fivers/vs243lionsgold.png', 0, 1, '2023-12-23 23:25:00', '2023-12-23 23:25:00');
INSERT INTO `fivers_games` VALUES (58, 1, 1, 'vs10egyptcls', 'Ancient Egypt Classic', 'fivers/vs10egyptcls.png', 0, 1, '2023-12-23 23:25:01', '2023-12-23 23:25:01');
INSERT INTO `fivers_games` VALUES (59, 1, 1, 'vs25davinci', 'Da Vinci Treasure', 'fivers/vs25davinci.png', 0, 1, '2023-12-23 23:25:03', '2023-12-23 23:25:03');
INSERT INTO `fivers_games` VALUES (60, 1, 1, 'vs7776secrets', 'Aztec Treasure', 'fivers/vs7776secrets.png', 0, 1, '2023-12-23 23:25:04', '2023-12-23 23:25:04');
INSERT INTO `fivers_games` VALUES (61, 1, 1, 'vs25wolfgold', 'Wolf Gold', 'fivers/vs25wolfgold.png', 0, 1, '2023-12-23 23:25:06', '2023-12-23 23:25:06');
INSERT INTO `fivers_games` VALUES (62, 1, 1, 'vs50safariking', 'Safari King', 'fivers/vs50safariking.png', 0, 1, '2023-12-23 23:25:07', '2023-12-23 23:25:07');
INSERT INTO `fivers_games` VALUES (63, 1, 1, 'vs25peking', 'Peking Luck', 'fivers/vs25peking.png', 0, 1, '2023-12-23 23:25:09', '2023-12-23 23:25:09');
INSERT INTO `fivers_games` VALUES (64, 1, 1, 'vs25asgard', 'Asgard', 'fivers/vs25asgard.png', 0, 1, '2023-12-23 23:25:10', '2023-12-23 23:25:10');
INSERT INTO `fivers_games` VALUES (65, 1, 1, 'vs25vegas', 'Vegas Nights', 'fivers/vs25vegas.png', 0, 1, '2023-12-23 23:25:12', '2023-12-23 23:25:12');
INSERT INTO `fivers_games` VALUES (66, 1, 1, 'vs25scarabqueen', 'John Hunter and the Tomb of the Scarab Queen', 'fivers/vs25scarabqueen.png', 0, 1, '2023-12-23 23:25:13', '2023-12-23 23:25:13');
INSERT INTO `fivers_games` VALUES (67, 1, 1, 'vs20starlight', 'Starlight Princess', 'fivers/vs20starlight.png', 0, 1, '2023-12-23 23:25:15', '2023-12-23 23:25:15');
INSERT INTO `fivers_games` VALUES (68, 1, 1, 'vs10bookoftut', 'John Hunter and the Book of Tut', 'fivers/vs10bookoftut.png', 0, 1, '2023-12-23 23:25:17', '2023-12-23 23:25:17');
INSERT INTO `fivers_games` VALUES (69, 1, 1, 'vs9piggybank', 'Piggy Bank Bills', 'fivers/vs9piggybank.png', 0, 1, '2023-12-23 23:25:18', '2023-12-23 23:25:18');
INSERT INTO `fivers_games` VALUES (70, 1, 1, 'vs5drmystery', 'Dragon Kingdom Mystery', 'fivers/vs5drmystery.png', 0, 1, '2023-12-23 23:25:20', '2023-12-23 23:25:20');
INSERT INTO `fivers_games` VALUES (71, 1, 1, 'vs20eightdragons', 'Eight Dragons', 'fivers/vs20eightdragons.png', 0, 1, '2023-12-23 23:25:22', '2023-12-23 23:25:22');
INSERT INTO `fivers_games` VALUES (72, 1, 1, 'vs1024lionsd', '5 Lions Dance', 'fivers/vs1024lionsd.png', 0, 1, '2023-12-23 23:25:23', '2023-12-23 23:25:23');
INSERT INTO `fivers_games` VALUES (73, 1, 1, 'vs25rio', 'Heart of Rio', 'fivers/vs25rio.png', 0, 1, '2023-12-23 23:25:25', '2023-12-23 23:25:25');
INSERT INTO `fivers_games` VALUES (74, 1, 1, 'vs10nudgeit', 'Rise of Giza PowerNudge', 'fivers/vs10nudgeit.png', 0, 1, '2023-12-23 23:25:26', '2023-12-23 23:25:26');
INSERT INTO `fivers_games` VALUES (75, 1, 1, 'vs10bxmasbnza', 'Christmas Big Bass Bonanza', 'fivers/vs10bxmasbnza.png', 0, 1, '2023-12-23 23:25:28', '2023-12-23 23:25:28');
INSERT INTO `fivers_games` VALUES (76, 1, 1, 'vs20santawonder', 'Santa\'s Wonderland', 'fivers/vs20santawonder.png', 0, 1, '2023-12-23 23:25:30', '2023-12-23 23:25:30');
INSERT INTO `fivers_games` VALUES (77, 1, 1, 'vs10bblpop', 'Bubble Pop', 'fivers/vs10bblpop.png', 0, 1, '2023-12-23 23:25:31', '2023-12-23 23:25:31');
INSERT INTO `fivers_games` VALUES (78, 1, 1, 'vs25btygold', 'Bounty Gold', 'fivers/vs25btygold.png', 0, 1, '2023-12-23 23:25:32', '2023-12-23 23:25:32');
INSERT INTO `fivers_games` VALUES (79, 1, 1, 'vs88hockattack', 'Hockey Attack™', 'fivers/vs88hockattack.png', 0, 1, '2023-12-23 23:25:36', '2023-12-23 23:25:36');
INSERT INTO `fivers_games` VALUES (80, 1, 1, 'vswaysbbb', 'Big Bass Bonanza Megaways™', 'fivers/vswaysbbb.png', 0, 1, '2023-12-23 23:25:38', '2023-12-23 23:25:38');
INSERT INTO `fivers_games` VALUES (81, 1, 1, 'vs10bookfallen', 'Book of the Fallen', 'fivers/vs10bookfallen.png', 0, 1, '2023-12-23 23:25:39', '2023-12-23 23:25:39');
INSERT INTO `fivers_games` VALUES (82, 1, 1, 'vs40bigjuan', 'Big Juan', 'fivers/vs40bigjuan.png', 0, 1, '2023-12-23 23:25:41', '2023-12-23 23:25:41');
INSERT INTO `fivers_games` VALUES (83, 1, 1, 'vs20bermuda', 'John Hunter and the Quest for Bermuda Riches', 'fivers/vs20bermuda.png', 0, 1, '2023-12-23 23:25:43', '2023-12-23 23:25:43');
INSERT INTO `fivers_games` VALUES (84, 1, 1, 'vs10starpirate', 'Star Pirates Code', 'fivers/vs10starpirate.png', 0, 1, '2023-12-23 23:25:44', '2023-12-23 23:25:44');
INSERT INTO `fivers_games` VALUES (85, 1, 1, 'vswayswest', 'Mystic Chief', 'fivers/vswayswest.png', 0, 1, '2023-12-23 23:25:46', '2023-12-23 23:25:46');
INSERT INTO `fivers_games` VALUES (86, 1, 1, 'vs20daydead', 'Day of Dead', 'fivers/vs20daydead.png', 0, 1, '2023-12-23 23:25:48', '2023-12-23 23:25:48');
INSERT INTO `fivers_games` VALUES (87, 1, 1, 'vs20candvil', 'Candy Village', 'fivers/vs20candvil.png', 0, 1, '2023-12-23 23:25:49', '2023-12-23 23:25:49');
INSERT INTO `fivers_games` VALUES (88, 1, 1, 'vs20wildboost', 'Wild Booster', 'fivers/vs20wildboost.png', 0, 1, '2023-12-23 23:25:50', '2023-12-23 23:25:50');
INSERT INTO `fivers_games` VALUES (89, 1, 1, 'vswayshammthor', 'Power of Thor Megaways', 'fivers/vswayshammthor.png', 0, 1, '2023-12-23 23:25:52', '2023-12-23 23:25:52');
INSERT INTO `fivers_games` VALUES (90, 1, 1, 'vs243lions', '5 Lions', 'fivers/vs243lions.png', 0, 1, '2023-12-23 23:25:53', '2023-12-23 23:25:53');
INSERT INTO `fivers_games` VALUES (91, 1, 1, 'vs5super7', 'Super 7s', 'fivers/vs5super7.png', 0, 1, '2023-12-23 23:25:55', '2023-12-23 23:25:55');
INSERT INTO `fivers_games` VALUES (92, 1, 1, 'vs1masterjoker', 'Master Joker', 'fivers/vs1masterjoker.png', 0, 1, '2023-12-23 23:25:57', '2023-12-23 23:25:57');
INSERT INTO `fivers_games` VALUES (93, 1, 1, 'vs20kraken', 'Release the Kraken', 'fivers/vs20kraken.png', 0, 1, '2023-12-23 23:25:58', '2023-12-23 23:25:58');
INSERT INTO `fivers_games` VALUES (94, 1, 1, 'vs10firestrike', 'Fire Strike', 'fivers/vs10firestrike.png', 0, 1, '2023-12-23 23:26:00', '2023-12-23 23:26:00');
INSERT INTO `fivers_games` VALUES (95, 1, 1, 'vs243fortune', 'Caishen\'s Gold', 'fivers/vs243fortune.png', 0, 1, '2023-12-23 23:26:01', '2023-12-23 23:26:01');
INSERT INTO `fivers_games` VALUES (96, 1, 1, 'vs20aladdinsorc', 'Aladdin and the Sorcerrer', 'fivers/vs20aladdinsorc.png', 0, 1, '2023-12-23 23:26:03', '2023-12-23 23:26:03');
INSERT INTO `fivers_games` VALUES (97, 1, 1, 'vs243fortseren', 'Greek Gods', 'fivers/vs243fortseren.png', 0, 1, '2023-12-23 23:26:05', '2023-12-23 23:26:05');
INSERT INTO `fivers_games` VALUES (98, 1, 1, 'vs25chilli', 'Chilli Heat', 'fivers/vs25chilli.png', 0, 1, '2023-12-23 23:26:06', '2023-12-23 23:26:06');
INSERT INTO `fivers_games` VALUES (99, 1, 1, 'vs8magicjourn', 'Magic Journey', 'fivers/vs8magicjourn.png', 0, 1, '2023-12-23 23:26:08', '2023-12-23 23:26:08');
INSERT INTO `fivers_games` VALUES (100, 1, 1, 'vs20leprexmas', 'Leprechaun Carol', 'fivers/vs20leprexmas.png', 0, 1, '2023-12-23 23:26:09', '2023-12-23 23:26:09');
INSERT INTO `fivers_games` VALUES (101, 1, 1, 'vs7pigs', '7 Piggies', 'fivers/vs7pigs.png', 0, 1, '2023-12-23 23:26:11', '2023-12-23 23:26:11');
INSERT INTO `fivers_games` VALUES (102, 1, 1, 'vs243caishien', 'Caishen\'s Cash', 'fivers/vs243caishien.png', 0, 1, '2023-12-23 23:26:12', '2023-12-23 23:26:12');
INSERT INTO `fivers_games` VALUES (103, 1, 1, 'vs5joker', 'Joker\'s Jewels', 'fivers/vs5joker.png', 0, 1, '2023-12-23 23:26:13', '2023-12-23 23:26:13');
INSERT INTO `fivers_games` VALUES (104, 1, 1, 'vs25gladiator', 'Wild Gladiator', 'fivers/vs25gladiator.png', 0, 1, '2023-12-23 23:26:15', '2023-12-23 23:26:15');
INSERT INTO `fivers_games` VALUES (105, 1, 1, 'vs25goldpig', 'Golden Pig', 'fivers/vs25goldpig.png', 0, 1, '2023-12-23 23:26:16', '2023-12-23 23:26:16');
INSERT INTO `fivers_games` VALUES (106, 1, 1, 'vs25goldrush', 'Gold Rush', 'fivers/vs25goldrush.png', 0, 1, '2023-12-23 23:26:18', '2023-12-23 23:26:18');
INSERT INTO `fivers_games` VALUES (107, 1, 1, 'vs25dragonkingdom', 'Dragon Kingdom', 'fivers/vs25dragonkingdom.png', 0, 1, '2023-12-23 23:26:20', '2023-12-23 23:26:20');
INSERT INTO `fivers_games` VALUES (108, 1, 1, 'vs1dragon8', '888 Dragons', 'fivers/vs1dragon8.png', 0, 1, '2023-12-23 23:26:22', '2023-12-23 23:26:22');
INSERT INTO `fivers_games` VALUES (109, 1, 1, 'vs5aztecgems', 'Aztec Gems', 'fivers/vs5aztecgems.png', 0, 1, '2023-12-23 23:26:23', '2023-12-23 23:26:23');
INSERT INTO `fivers_games` VALUES (110, 1, 1, 'vs20hercpeg', 'Hercules and Pegasus', 'fivers/vs20hercpeg.png', 0, 1, '2023-12-23 23:26:25', '2023-12-23 23:26:25');
INSERT INTO `fivers_games` VALUES (111, 1, 1, 'vs7fire88', 'Fire 88', 'fivers/vs7fire88.png', 0, 1, '2023-12-23 23:26:26', '2023-12-23 23:26:26');
INSERT INTO `fivers_games` VALUES (112, 1, 1, 'vs20honey', 'Honey Honey Honey', 'fivers/vs20honey.png', 0, 1, '2023-12-23 23:26:28', '2023-12-23 23:26:28');
INSERT INTO `fivers_games` VALUES (113, 1, 1, 'vs25safari', 'Hot Safari', 'fivers/vs25safari.png', 0, 1, '2023-12-23 23:26:29', '2023-12-23 23:26:29');
INSERT INTO `fivers_games` VALUES (114, 1, 1, 'vs25journey', 'Journey to the West', 'fivers/vs25journey.png', 0, 1, '2023-12-23 23:26:31', '2023-12-23 23:26:31');
INSERT INTO `fivers_games` VALUES (115, 1, 1, 'vs20chicken', 'The Great Chicken Escape', 'fivers/vs20chicken.png', 0, 1, '2023-12-23 23:26:33', '2023-12-23 23:26:33');
INSERT INTO `fivers_games` VALUES (116, 1, 1, 'vs1fortunetree', 'Tree of Riches', 'fivers/vs1fortunetree.png', 0, 1, '2023-12-23 23:26:34', '2023-12-23 23:26:34');
INSERT INTO `fivers_games` VALUES (117, 1, 1, 'vs20wildpix', 'Wild Pixies', 'fivers/vs20wildpix.png', 0, 1, '2023-12-23 23:26:36', '2023-12-23 23:26:36');
INSERT INTO `fivers_games` VALUES (118, 1, 1, 'vs15fairytale', 'Fairytale Fortune', 'fivers/vs15fairytale.png', 0, 1, '2023-12-23 23:26:38', '2023-12-23 23:26:38');
INSERT INTO `fivers_games` VALUES (119, 1, 1, 'vs20santa', 'Santa', 'fivers/vs20santa.png', 0, 1, '2023-12-23 23:26:39', '2023-12-23 23:26:39');
INSERT INTO `fivers_games` VALUES (120, 1, 1, 'vs10vampwolf', 'Vampires vs Wolves', '01HKZPWNGBHNH524AQ2VW9DWS6.jpg', 1, 1, '2023-12-23 23:26:41', '2024-01-12 17:47:50');
INSERT INTO `fivers_games` VALUES (121, 1, 1, 'vs50aladdin', '3 Genie Wishes', 'fivers/vs50aladdin.png', 0, 1, '2023-12-23 23:26:42', '2023-12-23 23:26:42');
INSERT INTO `fivers_games` VALUES (122, 1, 1, 'vs50hercules', 'Hercules Son of Zeus', 'fivers/vs50hercules.png', 0, 1, '2023-12-23 23:26:43', '2023-12-23 23:26:43');
INSERT INTO `fivers_games` VALUES (123, 1, 1, 'vs7776aztec', 'Aztec Bonanza', 'fivers/vs7776aztec.png', 0, 1, '2023-12-23 23:26:44', '2023-12-23 23:26:44');
INSERT INTO `fivers_games` VALUES (124, 1, 1, 'vs5trdragons', 'Triple Dragons', 'fivers/vs5trdragons.png', 0, 1, '2023-12-23 23:26:46', '2023-12-23 23:26:46');
INSERT INTO `fivers_games` VALUES (125, 1, 1, 'vs40madwheel', 'The Wild Machine', 'fivers/vs40madwheel.png', 0, 1, '2023-12-23 23:26:47', '2023-12-23 23:26:47');
INSERT INTO `fivers_games` VALUES (126, 1, 1, 'vs25newyear', 'Lucky New Year', 'fivers/vs25newyear.png', 0, 1, '2023-12-23 23:26:49', '2023-12-23 23:26:49');
INSERT INTO `fivers_games` VALUES (127, 1, 1, 'vs40frrainbow', 'Fruit Rainbow', 'fivers/vs40frrainbow.png', 0, 1, '2023-12-23 23:26:51', '2023-12-23 23:26:51');
INSERT INTO `fivers_games` VALUES (128, 1, 1, 'vs50kingkong', 'Mighty Kong', 'fivers/vs50kingkong.png', 0, 1, '2023-12-23 23:26:52', '2023-12-23 23:26:52');
INSERT INTO `fivers_games` VALUES (129, 1, 1, 'vs20godiva', 'Lady Godiva', 'fivers/vs20godiva.png', 0, 1, '2023-12-23 23:26:54', '2023-12-23 23:26:54');
INSERT INTO `fivers_games` VALUES (130, 1, 1, 'vs9madmonkey', 'Monkey Madness', 'fivers/vs9madmonkey.png', 0, 1, '2023-12-23 23:26:55', '2023-12-23 23:26:55');
INSERT INTO `fivers_games` VALUES (131, 1, 1, 'vs1tigers', 'Triple Tigers', 'fivers/vs1tigers.png', 0, 1, '2023-12-23 23:26:56', '2023-12-23 23:26:56');
INSERT INTO `fivers_games` VALUES (132, 1, 1, 'vs9chen', 'Master Chen\'s Fortune', 'fivers/vs9chen.png', 0, 1, '2023-12-23 23:26:58', '2023-12-23 23:26:58');
INSERT INTO `fivers_games` VALUES (133, 1, 1, 'vs5hotburn', 'Hot to burn', 'fivers/vs5hotburn.png', 0, 1, '2023-12-23 23:27:00', '2023-12-23 23:27:00');
INSERT INTO `fivers_games` VALUES (134, 1, 1, 'vs25dwarves_new', 'Dwarven Gold Deluxe', 'fivers/vs25dwarves_new.png', 0, 1, '2023-12-23 23:27:01', '2023-12-23 23:27:01');
INSERT INTO `fivers_games` VALUES (135, 1, 1, 'vs25sea', 'Great Reef', 'fivers/vs25sea.png', 0, 1, '2023-12-23 23:27:02', '2023-12-23 23:27:02');
INSERT INTO `fivers_games` VALUES (136, 1, 1, 'vs20leprechaun', 'Leprechaun Song', 'fivers/vs20leprechaun.png', 0, 1, '2023-12-23 23:27:03', '2023-12-23 23:27:03');
INSERT INTO `fivers_games` VALUES (137, 1, 1, 'vs7monkeys', '7 Monkeys', 'fivers/vs7monkeys.png', 0, 1, '2023-12-23 23:27:05', '2023-12-23 23:27:05');
INSERT INTO `fivers_games` VALUES (138, 1, 1, 'vs50chinesecharms', 'Lucky Dragons', 'fivers/vs50chinesecharms.png', 0, 1, '2023-12-23 23:27:07', '2023-12-23 23:27:07');
INSERT INTO `fivers_games` VALUES (139, 1, 1, 'vs18mashang', 'Treasure Horse', 'fivers/vs18mashang.png', 0, 1, '2023-12-23 23:27:08', '2023-12-23 23:27:08');
INSERT INTO `fivers_games` VALUES (140, 1, 1, 'vs5spjoker', 'Super Joker', 'fivers/vs5spjoker.png', 0, 1, '2023-12-23 23:27:10', '2023-12-23 23:27:10');
INSERT INTO `fivers_games` VALUES (141, 1, 1, 'vs20egypttrs', 'Egyptian Fortunes', 'fivers/vs20egypttrs.png', 0, 1, '2023-12-23 23:27:12', '2023-12-23 23:27:12');
INSERT INTO `fivers_games` VALUES (142, 1, 1, 'vs25queenofgold', 'Queen of Gold', '01HKZPXSG0P4W39JJA9B0N940Y.jpg', 1, 1, '2023-12-23 23:27:14', '2024-01-12 17:48:27');
INSERT INTO `fivers_games` VALUES (143, 1, 1, 'vs9hotroll', 'Hot Chilli', 'fivers/vs9hotroll.png', 0, 1, '2023-12-23 23:27:15', '2023-12-23 23:27:15');
INSERT INTO `fivers_games` VALUES (144, 1, 1, 'vs4096jurassic', 'Jurassic Giants', 'fivers/vs4096jurassic.png', 0, 1, '2023-12-23 23:27:16', '2023-12-23 23:27:16');
INSERT INTO `fivers_games` VALUES (145, 1, 1, 'vs3train', 'Gold Train', 'fivers/vs3train.png', 0, 1, '2023-12-23 23:27:18', '2023-12-23 23:27:18');
INSERT INTO `fivers_games` VALUES (146, 1, 1, 'vs40beowulf', 'Beowulf', 'fivers/vs40beowulf.png', 0, 1, '2023-12-23 23:27:19', '2023-12-23 23:27:19');
INSERT INTO `fivers_games` VALUES (147, 1, 1, 'vs20bl', 'Busy Bees', 'fivers/vs20bl.png', 0, 1, '2023-12-23 23:27:21', '2023-12-23 23:27:21');
INSERT INTO `fivers_games` VALUES (148, 1, 1, 'vs1money', 'Money Money Money', 'fivers/vs1money.png', 0, 1, '2023-12-23 23:27:22', '2023-12-23 23:27:22');
INSERT INTO `fivers_games` VALUES (149, 1, 1, 'vs1600drago', 'Drago - Jewels of Fortune', 'fivers/vs1600drago.png', 0, 1, '2023-12-23 23:27:24', '2023-12-23 23:27:24');
INSERT INTO `fivers_games` VALUES (150, 1, 1, 'vs1fufufu', 'Fu Fu Fu', 'fivers/vs1fufufu.png', 0, 1, '2023-12-23 23:27:26', '2023-12-23 23:27:26');
INSERT INTO `fivers_games` VALUES (151, 1, 1, 'vs40streetracer', 'Street Racer', 'fivers/vs40streetracer.png', 0, 1, '2023-12-23 23:27:26', '2023-12-23 23:27:26');
INSERT INTO `fivers_games` VALUES (152, 1, 1, 'vs9aztecgemsdx', 'Aztec Gems Deluxe', 'fivers/vs9aztecgemsdx.png', 0, 1, '2023-12-23 23:27:28', '2023-12-23 23:27:28');
INSERT INTO `fivers_games` VALUES (153, 1, 1, 'vs20gorilla', 'Jungle Gorilla', 'fivers/vs20gorilla.png', 0, 1, '2023-12-23 23:27:29', '2023-12-23 23:27:29');
INSERT INTO `fivers_games` VALUES (154, 1, 1, 'vswayswerewolf', 'Curse of the Werewolf Megaways', 'fivers/vswayswerewolf.png', 0, 1, '2023-12-23 23:27:30', '2023-12-23 23:27:30');
INSERT INTO `fivers_games` VALUES (155, 1, 1, 'vswayshive', 'Star Bounty', 'fivers/vswayshive.png', 0, 1, '2023-12-23 23:27:32', '2023-12-23 23:27:32');
INSERT INTO `fivers_games` VALUES (156, 1, 1, 'vs25samurai', 'Rise of Samurai', 'fivers/vs25samurai.png', 0, 1, '2023-12-23 23:27:34', '2023-12-23 23:27:34');
INSERT INTO `fivers_games` VALUES (157, 1, 1, 'vs25walker', 'Wild Walker', 'fivers/vs25walker.png', 0, 1, '2023-12-23 23:27:35', '2023-12-23 23:27:35');
INSERT INTO `fivers_games` VALUES (158, 1, 1, 'vs20goldfever', 'Gems Bonanza', 'fivers/vs20goldfever.png', 0, 1, '2023-12-23 23:27:36', '2023-12-23 23:27:36');
INSERT INTO `fivers_games` VALUES (159, 1, 1, 'vs25bkofkngdm', 'Book of Kingdoms', 'fivers/vs25bkofkngdm.png', 0, 1, '2023-12-23 23:27:38', '2023-12-23 23:27:38');
INSERT INTO `fivers_games` VALUES (160, 1, 1, 'vs10goldfish', 'Fishin Reels', 'fivers/vs10goldfish.png', 0, 1, '2023-12-23 23:27:39', '2023-12-23 23:27:39');
INSERT INTO `fivers_games` VALUES (161, 1, 1, 'vs1024dtiger', 'The Dragon Tiger', 'fivers/vs1024dtiger.png', 0, 1, '2023-12-23 23:27:40', '2023-12-23 23:27:40');
INSERT INTO `fivers_games` VALUES (162, 1, 1, 'vs20xmascarol', 'Christmas Carol Megaways', 'fivers/vs20xmascarol.png', 0, 1, '2023-12-23 23:27:42', '2023-12-23 23:27:42');
INSERT INTO `fivers_games` VALUES (163, 1, 1, 'vs10mayangods', 'John Hunter and the Mayan Gods', 'fivers/vs10mayangods.png', 0, 1, '2023-12-23 23:27:44', '2023-12-23 23:27:44');
INSERT INTO `fivers_games` VALUES (164, 1, 1, 'vs20bonzgold', 'Bonanza Gold', 'fivers/vs20bonzgold.png', 0, 1, '2023-12-23 23:27:45', '2023-12-23 23:27:45');
INSERT INTO `fivers_games` VALUES (165, 1, 1, 'vs40voodoo', 'Voodoo Magic', 'fivers/vs40voodoo.png', 0, 1, '2023-12-23 23:27:46', '2023-12-23 23:27:46');
INSERT INTO `fivers_games` VALUES (166, 1, 1, 'vs25gldox', 'Golden Ox', 'fivers/vs25gldox.png', 0, 1, '2023-12-23 23:27:48', '2023-12-23 23:27:48');
INSERT INTO `fivers_games` VALUES (167, 1, 1, 'vs10wildtut', 'Mysterious Egypt', 'fivers/vs10wildtut.png', 0, 1, '2023-12-23 23:27:49', '2023-12-23 23:27:49');
INSERT INTO `fivers_games` VALUES (168, 1, 1, 'vs10eyestorm', 'Eye of the Storm', 'fivers/vs10eyestorm.png', 0, 1, '2023-12-23 23:27:51', '2023-12-23 23:27:51');
INSERT INTO `fivers_games` VALUES (169, 1, 1, 'vs117649starz', 'Starz Megaways', 'fivers/vs117649starz.png', 0, 1, '2023-12-23 23:27:52', '2023-12-23 23:27:52');
INSERT INTO `fivers_games` VALUES (170, 1, 1, 'vs10amm', 'The Amazing Money Machine', 'fivers/vs10amm.png', 0, 1, '2023-12-23 23:27:54', '2023-12-23 23:27:54');
INSERT INTO `fivers_games` VALUES (171, 1, 1, 'vs20magicpot', 'The Magic Cauldron - Enchanted Brew', 'fivers/vs20magicpot.png', 0, 1, '2023-12-23 23:27:56', '2023-12-23 23:27:56');
INSERT INTO `fivers_games` VALUES (172, 1, 1, 'vswayselements', 'Elemental Gems Megaways', 'fivers/vswayselements.png', 0, 1, '2023-12-23 23:27:57', '2023-12-23 23:27:57');
INSERT INTO `fivers_games` VALUES (173, 1, 1, 'vswayschilheat', 'Chilli Heat Megaways', 'fivers/vswayschilheat.png', 0, 1, '2023-12-23 23:27:59', '2023-12-23 23:27:59');
INSERT INTO `fivers_games` VALUES (174, 1, 1, 'vs10luckcharm', 'Lucky Grace And Charm', 'fivers/vs10luckcharm.png', 0, 1, '2023-12-23 23:28:01', '2023-12-23 23:28:01');
INSERT INTO `fivers_games` VALUES (175, 1, 1, 'vswaysaztecking', 'Aztec King Megaways', 'fivers/vswaysaztecking.png', 0, 1, '2023-12-23 23:28:03', '2023-12-23 23:28:03');
INSERT INTO `fivers_games` VALUES (176, 1, 1, 'vs20phoenixf', 'Phoenix Forge', '01HKZPQQY9RB1XZZRJVA9QVKNN.jpg', 1, 1, '2023-12-23 23:28:04', '2024-01-12 17:45:08');
INSERT INTO `fivers_games` VALUES (177, 1, 1, 'vs576hokkwolf', 'Hokkaido Wolf', 'fivers/vs576hokkwolf.png', 0, 1, '2023-12-23 23:28:06', '2023-12-23 23:28:06');
INSERT INTO `fivers_games` VALUES (178, 1, 1, 'vs20trsbox', 'Treasure Wild', 'fivers/vs20trsbox.png', 0, 1, '2023-12-23 23:28:08', '2023-12-23 23:28:08');
INSERT INTO `fivers_games` VALUES (179, 1, 1, 'vs243chargebull', 'Raging Bull', 'fivers/vs243chargebull.png', 0, 1, '2023-12-23 23:28:09', '2023-12-23 23:28:09');
INSERT INTO `fivers_games` VALUES (180, 1, 1, 'vswaysbankbonz', 'Cash Bonanza', 'fivers/vswaysbankbonz.png', 0, 1, '2023-12-23 23:28:10', '2023-12-23 23:28:10');
INSERT INTO `fivers_games` VALUES (181, 1, 1, 'vs20pbonanza', 'Pyramid Bonanza', 'fivers/vs20pbonanza.png', 0, 1, '2023-12-23 23:28:12', '2023-12-23 23:28:12');
INSERT INTO `fivers_games` VALUES (182, 1, 1, 'vs243empcaishen', 'Emperor Caishen', 'fivers/vs243empcaishen.png', 0, 1, '2023-12-23 23:28:13', '2023-12-23 23:28:13');
INSERT INTO `fivers_games` VALUES (183, 1, 1, 'vs25tigeryear', 'New Year Tiger Treasures ™', 'fivers/vs25tigeryear.png', 0, 1, '2023-12-23 23:28:15', '2023-12-23 23:28:15');
INSERT INTO `fivers_games` VALUES (184, 1, 1, 'vs20amuleteg', 'Fortune of Giza™', 'fivers/vs20amuleteg.png', 0, 1, '2023-12-23 23:28:16', '2023-12-23 23:28:16');
INSERT INTO `fivers_games` VALUES (185, 1, 1, 'vs10runes', 'Gates of Valhalla™', 'fivers/vs10runes.png', 0, 1, '2023-12-23 23:28:19', '2023-12-23 23:28:19');
INSERT INTO `fivers_games` VALUES (186, 1, 1, 'vs25goldparty', 'Gold Party®', 'fivers/vs25goldparty.png', 0, 1, '2023-12-23 23:28:20', '2023-12-23 23:28:20');
INSERT INTO `fivers_games` VALUES (187, 1, 1, 'vswaysxjuicy', 'Extra Juicy Megaways™', 'fivers/vswaysxjuicy.png', 0, 1, '2023-12-23 23:28:22', '2023-12-23 23:28:22');
INSERT INTO `fivers_games` VALUES (188, 1, 1, 'vs40wanderw', 'Wild Depths™', 'fivers/vs40wanderw.png', 0, 1, '2023-12-23 23:28:24', '2023-12-23 23:28:24');
INSERT INTO `fivers_games` VALUES (189, 1, 1, 'vs4096magician', 'Magician\'s Secrets™', 'fivers/vs4096magician.png', 0, 1, '2023-12-23 23:28:25', '2023-12-23 23:28:25');
INSERT INTO `fivers_games` VALUES (190, 1, 1, 'vs20smugcove', 'Smugglers Cove™', 'fivers/vs20smugcove.png', 0, 1, '2023-12-23 23:28:27', '2023-12-23 23:28:27');
INSERT INTO `fivers_games` VALUES (191, 1, 1, 'vswayscryscav', 'Crystal Caverns Megaways™', 'fivers/vswayscryscav.png', 0, 1, '2023-12-23 23:28:29', '2023-12-23 23:28:29');
INSERT INTO `fivers_games` VALUES (192, 1, 1, 'vs20superx', 'Super X™', 'fivers/vs20superx.png', 0, 1, '2023-12-23 23:28:30', '2023-12-23 23:28:30');
INSERT INTO `fivers_games` VALUES (193, 1, 1, 'vs20rockvegas', 'Rock Vegas Mega Hold & Spin', 'fivers/vs20rockvegas.png', 0, 1, '2023-12-23 23:28:32', '2023-12-23 23:28:32');
INSERT INTO `fivers_games` VALUES (194, 1, 1, 'vs25copsrobbers', 'Cash Patrol', 'fivers/vs25copsrobbers.png', 0, 1, '2023-12-23 23:28:35', '2023-12-23 23:28:35');
INSERT INTO `fivers_games` VALUES (195, 1, 1, 'vs20colcashzone', 'Colossal Cash Zone', 'fivers/vs20colcashzone.png', 0, 1, '2023-12-23 23:28:36', '2023-12-23 23:28:36');
INSERT INTO `fivers_games` VALUES (196, 1, 1, 'vs20ultim5', 'The Ultimate 5', 'fivers/vs20ultim5.png', 0, 1, '2023-12-23 23:28:38', '2023-12-23 23:28:38');
INSERT INTO `fivers_games` VALUES (197, 1, 1, 'vs20bchprty', 'Wild Beach Party', 'fivers/vs20bchprty.png', 0, 1, '2023-12-23 23:28:39', '2023-12-23 23:28:39');
INSERT INTO `fivers_games` VALUES (198, 1, 1, 'vs10bookazteck', 'Book of Aztec King', 'fivers/vs10bookazteck.png', 0, 1, '2023-12-23 23:28:40', '2023-12-23 23:28:40');
INSERT INTO `fivers_games` VALUES (199, 1, 1, 'vs50mightra', 'Might of Ra', 'fivers/vs50mightra.png', 0, 1, '2023-12-23 23:28:41', '2023-12-23 23:28:41');
INSERT INTO `fivers_games` VALUES (200, 1, 1, 'vs25bullfiesta', 'Bull Fiesta', 'fivers/vs25bullfiesta.png', 0, 1, '2023-12-23 23:28:42', '2023-12-23 23:28:42');
INSERT INTO `fivers_games` VALUES (201, 1, 1, 'vs20rainbowg', 'Rainbow Gold', 'fivers/vs20rainbowg.png', 0, 1, '2023-12-23 23:28:44', '2023-12-23 23:28:44');
INSERT INTO `fivers_games` VALUES (202, 1, 1, 'vs10tictac', 'Tic Tac Take', 'fivers/vs10tictac.png', 0, 1, '2023-12-23 23:28:45', '2023-12-23 23:28:45');
INSERT INTO `fivers_games` VALUES (203, 1, 1, 'vs243discolady', 'Disco Lady', 'fivers/vs243discolady.png', 0, 1, '2023-12-23 23:28:47', '2023-12-23 23:28:47');
INSERT INTO `fivers_games` VALUES (204, 1, 1, 'vs243queenie', 'Queenie', 'fivers/vs243queenie.png', 0, 1, '2023-12-23 23:28:49', '2023-12-23 23:28:49');
INSERT INTO `fivers_games` VALUES (205, 1, 1, 'vs20farmfest', 'Barn Festival', 'fivers/vs20farmfest.png', 0, 1, '2023-12-23 23:28:50', '2023-12-23 23:28:50');
INSERT INTO `fivers_games` VALUES (206, 1, 1, 'vs10chkchase', 'Chicken Chase', 'fivers/vs10chkchase.png', 0, 1, '2023-12-23 23:28:51', '2023-12-23 23:28:51');
INSERT INTO `fivers_games` VALUES (207, 1, 1, 'vswayswildwest', 'Wild West Gold Megaways', 'fivers/vswayswildwest.png', 0, 1, '2023-12-23 23:28:52', '2023-12-23 23:28:52');
INSERT INTO `fivers_games` VALUES (208, 1, 1, 'vs20mustanggld2', 'Clover Gold', 'fivers/vs20mustanggld2.png', 0, 1, '2023-12-23 23:28:54', '2023-12-23 23:28:54');
INSERT INTO `fivers_games` VALUES (209, 1, 1, 'vs20drtgold', 'Drill That Gold', 'fivers/vs20drtgold.png', 0, 1, '2023-12-23 23:28:55', '2023-12-23 23:28:55');
INSERT INTO `fivers_games` VALUES (210, 1, 1, 'vs10spiritadv', 'Spirit of Adventure', 'fivers/vs10spiritadv.png', 0, 1, '2023-12-23 23:28:57', '2023-12-23 23:28:57');
INSERT INTO `fivers_games` VALUES (211, 1, 1, 'vs10firestrike2', 'Fire Strike 2', 'fivers/vs10firestrike2.png', 0, 1, '2023-12-23 23:28:58', '2023-12-23 23:28:58');
INSERT INTO `fivers_games` VALUES (212, 1, 1, 'vs40cleoeye', 'Eye of Cleopatra', 'fivers/vs40cleoeye.png', 0, 1, '2023-12-23 23:29:00', '2023-12-23 23:29:00');
INSERT INTO `fivers_games` VALUES (213, 1, 1, 'vs20gobnudge', 'Goblin Heist Powernudge', 'fivers/vs20gobnudge.png', 0, 1, '2023-12-23 23:29:01', '2023-12-23 23:29:01');
INSERT INTO `fivers_games` VALUES (214, 1, 1, 'vs20stickysymbol', 'The Great Stick-up', 'fivers/vs20stickysymbol.png', 0, 1, '2023-12-23 23:29:02', '2023-12-23 23:29:02');
INSERT INTO `fivers_games` VALUES (215, 1, 1, 'vswayszombcarn', 'Zombie Carnival', 'fivers/vswayszombcarn.png', 0, 1, '2023-12-23 23:29:03', '2023-12-23 23:29:03');
INSERT INTO `fivers_games` VALUES (216, 1, 1, 'vs50northgard', 'North Guardians', 'fivers/vs50northgard.png', 0, 1, '2023-12-23 23:29:05', '2023-12-23 23:29:05');
INSERT INTO `fivers_games` VALUES (217, 1, 1, 'vs20sugarrush', 'Sugar Rush', '01HKZNV142EZ9W0R92J0MJGRH2.png', 1, 1, '2023-12-23 23:29:08', '2024-01-12 17:29:28');
INSERT INTO `fivers_games` VALUES (218, 1, 1, 'vs20cleocatra', 'Cleocatra', 'fivers/vs20cleocatra.png', 0, 1, '2023-12-23 23:29:09', '2023-12-23 23:29:09');
INSERT INTO `fivers_games` VALUES (219, 1, 1, 'vs5littlegem', 'Little Gem Hold and Spin', 'fivers/vs5littlegem.png', 0, 1, '2023-12-23 23:29:11', '2023-12-23 23:29:11');
INSERT INTO `fivers_games` VALUES (220, 1, 1, 'vs10egrich', 'Queen of Gods', 'fivers/vs10egrich.png', 0, 1, '2023-12-23 23:29:13', '2023-12-23 23:29:13');
INSERT INTO `fivers_games` VALUES (221, 1, 1, 'vs243koipond', 'Koi Pond', 'fivers/vs243koipond.png', 0, 1, '2023-12-23 23:29:15', '2023-12-23 23:29:15');
INSERT INTO `fivers_games` VALUES (222, 1, 1, 'vs40samurai3', 'Rise of Samurai 3', 'fivers/vs40samurai3.png', 0, 1, '2023-12-23 23:29:16', '2023-12-23 23:29:16');
INSERT INTO `fivers_games` VALUES (223, 1, 1, 'vs40cosmiccash', 'Cosmic Cash', 'fivers/vs40cosmiccash.png', 0, 1, '2023-12-23 23:29:18', '2023-12-23 23:29:18');
INSERT INTO `fivers_games` VALUES (224, 1, 1, 'vs25bomb', 'Bomb Bonanza', 'fivers/vs25bomb.png', 0, 1, '2023-12-23 23:29:19', '2023-12-23 23:29:19');
INSERT INTO `fivers_games` VALUES (225, 1, 1, 'vs1024mahjpanda', 'Mahjong Panda', 'fivers/vs1024mahjpanda.png', 0, 1, '2023-12-23 23:29:21', '2023-12-23 23:29:21');
INSERT INTO `fivers_games` VALUES (226, 1, 1, 'vs10coffee', 'Coffee Wild', 'fivers/vs10coffee.png', 0, 1, '2023-12-23 23:29:22', '2023-12-23 23:29:22');
INSERT INTO `fivers_games` VALUES (227, 1, 1, 'vs100sh', 'Shining Hot 100', 'fivers/vs100sh.png', 0, 1, '2023-12-23 23:29:24', '2023-12-23 23:29:24');
INSERT INTO `fivers_games` VALUES (228, 1, 1, 'vs20sh', 'Shining Hot 20', 'fivers/vs20sh.png', 0, 1, '2023-12-23 23:29:25', '2023-12-23 23:29:25');
INSERT INTO `fivers_games` VALUES (229, 1, 1, 'vs40sh', 'Shining Hot 40', 'fivers/vs40sh.png', 0, 1, '2023-12-23 23:29:27', '2023-12-23 23:29:27');
INSERT INTO `fivers_games` VALUES (230, 1, 1, 'vs5sh', 'Shining Hot 5', 'fivers/vs5sh.png', 0, 1, '2023-12-23 23:29:28', '2023-12-23 23:29:28');
INSERT INTO `fivers_games` VALUES (231, 1, 1, 'vswaysjkrdrop', 'Tropical Tiki', 'fivers/vswaysjkrdrop.png', 0, 1, '2023-12-23 23:29:30', '2023-12-23 23:29:30');
INSERT INTO `fivers_games` VALUES (232, 1, 1, 'vs243ckemp', 'Cheeky Emperor', 'fivers/vs243ckemp.png', 0, 1, '2023-12-23 23:29:32', '2023-12-23 23:29:32');
INSERT INTO `fivers_games` VALUES (233, 1, 1, 'vs40hotburnx', 'Hot To Burn Extreme', 'fivers/vs40hotburnx.png', 0, 1, '2023-12-23 23:29:33', '2023-12-23 23:29:33');
INSERT INTO `fivers_games` VALUES (234, 1, 1, 'vs1024gmayhem', 'Gorilla Mayhem', 'fivers/vs1024gmayhem.png', 0, 1, '2023-12-23 23:29:34', '2023-12-23 23:29:34');
INSERT INTO `fivers_games` VALUES (235, 1, 1, 'vs20octobeer', 'Octobeer Fortunes', 'fivers/vs20octobeer.png', 0, 1, '2023-12-23 23:29:36', '2023-12-23 23:29:36');
INSERT INTO `fivers_games` VALUES (236, 1, 1, 'vs10txbigbass', 'Big Bass Splash', 'fivers/vs10txbigbass.png', 0, 1, '2023-12-23 23:29:38', '2023-12-23 23:29:38');
INSERT INTO `fivers_games` VALUES (237, 1, 1, 'vs100firehot', 'Fire Hot 100', 'fivers/vs100firehot.png', 0, 1, '2023-12-23 23:29:39', '2023-12-23 23:29:39');
INSERT INTO `fivers_games` VALUES (238, 1, 1, 'vs20fh', 'Fire Hot 20', 'fivers/vs20fh.png', 0, 1, '2023-12-23 23:29:40', '2023-12-23 23:29:40');
INSERT INTO `fivers_games` VALUES (239, 1, 1, 'vs40firehot', 'Fire Hot 40', 'fivers/vs40firehot.png', 0, 1, '2023-12-23 23:29:41', '2023-12-23 23:29:41');
INSERT INTO `fivers_games` VALUES (240, 1, 1, 'vs5firehot', 'Fire Hot 5', 'fivers/vs5firehot.png', 0, 1, '2023-12-23 23:29:43', '2023-12-23 23:29:43');
INSERT INTO `fivers_games` VALUES (241, 1, 1, 'vs20wolfie', 'Greedy Wolf', 'fivers/vs20wolfie.png', 0, 1, '2023-12-23 23:29:44', '2023-12-23 23:29:44');
INSERT INTO `fivers_games` VALUES (242, 1, 1, 'vs20underground', 'Down the Rails', 'fivers/vs20underground.png', 0, 1, '2023-12-23 23:29:45', '2023-12-23 23:29:45');
INSERT INTO `fivers_games` VALUES (243, 1, 1, 'vs10mmm', 'Magic Money Maze', 'fivers/vs10mmm.png', 0, 1, '2023-12-23 23:29:47', '2023-12-23 23:29:47');
INSERT INTO `fivers_games` VALUES (244, 1, 1, 'vswaysfltdrg', 'Floating Dragon Hold & Spin Megaways', 'fivers/vswaysfltdrg.png', 0, 1, '2023-12-23 23:29:49', '2023-12-23 23:29:49');
INSERT INTO `fivers_games` VALUES (245, 1, 1, 'vs20trswild2', 'Black Bull', 'fivers/vs20trswild2.png', 0, 1, '2023-12-23 23:29:51', '2023-12-23 23:29:51');
INSERT INTO `fivers_games` VALUES (246, 1, 1, 'vswaysstrwild', 'Candy Stars', 'fivers/vswaysstrwild.png', 0, 1, '2023-12-23 23:29:52', '2023-12-23 23:29:52');
INSERT INTO `fivers_games` VALUES (247, 1, 1, 'vs10crownfire', 'Crown of Fire', 'fivers/vs10crownfire.png', 0, 1, '2023-12-23 23:29:54', '2023-12-23 23:29:54');
INSERT INTO `fivers_games` VALUES (248, 1, 1, 'vs20muertos', 'Muertos Multiplier Megaways', 'fivers/vs20muertos.png', 0, 1, '2023-12-23 23:29:55', '2023-12-23 23:29:55');
INSERT INTO `fivers_games` VALUES (249, 1, 1, 'vswayslofhero', 'Legend of Heroes', 'fivers/vswayslofhero.png', 0, 1, '2023-12-23 23:29:57', '2023-12-23 23:29:57');
INSERT INTO `fivers_games` VALUES (250, 1, 1, 'vs5strh', 'Striking Hot 5', 'fivers/vs5strh.png', 0, 1, '2023-12-23 23:29:58', '2023-12-23 23:29:58');
INSERT INTO `fivers_games` VALUES (251, 1, 1, 'vs10snakeeyes', 'Snakes & Ladders - Snake Eyes', 'fivers/vs10snakeeyes.png', 0, 1, '2023-12-23 23:30:00', '2023-12-23 23:30:00');
INSERT INTO `fivers_games` VALUES (252, 1, 1, 'vswaysbook', 'Book of Golden Sands', 'fivers/vswaysbook.png', 0, 1, '2023-12-23 23:30:02', '2023-12-23 23:30:02');
INSERT INTO `fivers_games` VALUES (253, 1, 1, 'vs20mparty', 'Wild Hop and Drop', 'fivers/vs20mparty.png', 0, 1, '2023-12-23 23:30:03', '2023-12-23 23:30:03');
INSERT INTO `fivers_games` VALUES (254, 1, 1, 'vs20swordofares', 'Sword of Ares', 'fivers/vs20swordofares.png', 0, 1, '2023-12-23 23:30:05', '2023-12-23 23:30:05');
INSERT INTO `fivers_games` VALUES (255, 1, 1, 'vswaysfrywld', 'Spin & Score Megaways', '01HKZPJ1XNHFZ3QC19435PCC8M.jpg', 1, 1, '2023-12-23 23:30:05', '2024-01-12 17:45:31');
INSERT INTO `fivers_games` VALUES (256, 1, 1, 'vswaysconcoll', 'Sweet PowerNudge™', 'fivers/vswaysconcoll.jpg', 0, 1, '2023-12-23 23:30:06', '2023-12-23 23:30:06');
INSERT INTO `fivers_games` VALUES (257, 1, 1, 'vs20lcount', 'Gems of Serengeti™', 'fivers/vs20lcount.jpg', 0, 1, '2023-12-23 23:30:06', '2023-12-23 23:30:06');
INSERT INTO `fivers_games` VALUES (258, 1, 1, 'vs20sparta', 'Shield of Sparta', 'fivers/vs20sparta.jpg', 0, 1, '2023-12-23 23:30:07', '2023-12-23 23:30:07');
INSERT INTO `fivers_games` VALUES (259, 1, 1, 'vs10bbkir', 'Big Bass Bonanza Keeping it Reel', 'fivers/vs10bbkir.jpg', 0, 1, '2023-12-23 23:30:07', '2023-12-23 23:30:07');
INSERT INTO `fivers_games` VALUES (260, 1, 1, 'vswayspizza', 'Pizza Pizza Pizza', 'fivers/vswayspizza.jpg', 0, 1, '2023-12-23 23:30:07', '2023-12-23 23:30:07');
INSERT INTO `fivers_games` VALUES (261, 1, 1, 'vs20dugems', 'Hot Pepper™', 'fivers/vs20dugems.jpg', 0, 1, '2023-12-23 23:30:08', '2023-12-23 23:30:08');
INSERT INTO `fivers_games` VALUES (262, 1, 1, 'vs20clspwrndg', 'Sweet PowerNudge', 'fivers/vs20clspwrndg.jpg', 0, 1, '2023-12-23 23:30:08', '2023-12-23 23:30:08');
INSERT INTO `fivers_games` VALUES (263, 1, 1, 'vswaysfuryodin', 'Fury of Odin Megaways™', 'fivers/vswaysfuryodin.jpg', 0, 1, '2023-12-23 23:30:09', '2023-12-23 23:30:09');
INSERT INTO `fivers_games` VALUES (264, 1, 1, 'vs20sugarcoins', 'Viking Forge', 'fivers/vs20sugarcoins.png', 0, 1, '2023-12-23 23:30:10', '2023-12-23 23:30:10');
INSERT INTO `fivers_games` VALUES (265, 1, 1, 'vs20olympgrace', 'Grace of Ebisu', 'fivers/vs20olympgrace.png', 0, 1, '2023-12-23 23:30:12', '2023-12-23 23:30:12');
INSERT INTO `fivers_games` VALUES (266, 1, 1, 'vs20starlightx', 'Starlight Princess 1000', 'fivers/vs20starlightx.png', 0, 1, '2023-12-23 23:30:14', '2023-12-23 23:30:14');
INSERT INTO `fivers_games` VALUES (267, 1, 1, 'vswaysmoneyman', 'The Money Men Megaways', 'fivers/vswaysmoneyman.png', 0, 1, '2023-12-23 23:30:15', '2023-12-23 23:30:15');
INSERT INTO `fivers_games` VALUES (268, 1, 1, 'vs40demonpots', 'Demon Pots', 'fivers/vs40demonpots.png', 0, 1, '2023-12-23 23:30:17', '2023-12-23 23:30:17');
INSERT INTO `fivers_games` VALUES (269, 1, 1, 'vswaystut', 'John Hunter and the Book of Tut Megaways', 'fivers/vswaystut.png', 0, 1, '2023-12-23 23:30:18', '2023-12-23 23:30:18');
INSERT INTO `fivers_games` VALUES (270, 1, 1, 'vs10gdchalleng', '8 Golden Dragon Challenge', 'fivers/vs10gdchalleng.png', 0, 1, '2023-12-23 23:30:20', '2023-12-23 23:30:20');
INSERT INTO `fivers_games` VALUES (271, 1, 1, 'vs20yisunshin', 'Yi Sun Shin', 'fivers/vs20yisunshin.png', 0, 1, '2023-12-23 23:30:21', '2023-12-23 23:30:21');
INSERT INTO `fivers_games` VALUES (272, 1, 1, 'vs20candyblitz', 'Candy Blitz', 'fivers/vs20candyblitz.png', 0, 1, '2023-12-23 23:30:23', '2023-12-23 23:30:23');
INSERT INTO `fivers_games` VALUES (273, 1, 1, 'vswaysstrlght', 'Fortunes of Aztec', 'fivers/vswaysstrlght.png', 0, 1, '2023-12-23 23:30:24', '2023-12-23 23:30:24');
INSERT INTO `fivers_games` VALUES (274, 1, 1, 'vs40infwild', 'Infective Wild', 'fivers/vs40infwild.png', 0, 1, '2023-12-23 23:30:26', '2023-12-23 23:30:26');
INSERT INTO `fivers_games` VALUES (275, 1, 1, 'vs20gravity', 'Gravity Bonanza', 'fivers/vs20gravity.png', 0, 1, '2023-12-23 23:30:27', '2023-12-23 23:30:27');
INSERT INTO `fivers_games` VALUES (276, 1, 1, 'vs40rainbowr', 'Rainbow Reels', 'fivers/vs40rainbowr.png', 0, 1, '2023-12-23 23:30:28', '2023-12-23 23:30:28');
INSERT INTO `fivers_games` VALUES (277, 1, 1, 'vs20bnnzdice', 'Sweet Bonanza Dice', 'fivers/vs20bnnzdice.png', 0, 1, '2023-12-23 23:30:30', '2023-12-23 23:30:30');
INSERT INTO `fivers_games` VALUES (278, 1, 1, 'vs10bhallbnza', 'Big Bass Halloween', 'fivers/vs10bhallbnza.png', 0, 1, '2023-12-23 23:30:31', '2023-12-23 23:30:31');
INSERT INTO `fivers_games` VALUES (279, 1, 1, 'vswaysraghex', 'Tundra\'s Fortune', 'fivers/vswaysraghex.png', 0, 1, '2023-12-23 23:30:33', '2023-12-23 23:30:33');
INSERT INTO `fivers_games` VALUES (280, 1, 1, 'vs20maskgame', 'Cash Chips', 'fivers/vs20maskgame.png', 0, 1, '2023-12-23 23:30:34', '2023-12-23 23:30:34');
INSERT INTO `fivers_games` VALUES (281, 1, 1, 'vs5gemstone', 'Gemstone', 'fivers/vs5gemstone.png', 0, 1, '2023-12-23 23:30:36', '2023-12-23 23:30:36');
INSERT INTO `fivers_games` VALUES (282, 1, 1, 'vs1024mahjwins', 'Mahjong Wins', 'fivers/vs1024mahjwins.png', 0, 1, '2023-12-23 23:30:37', '2023-12-23 23:30:37');
INSERT INTO `fivers_games` VALUES (283, 1, 1, 'vs20procount', 'Wisdom of Athena', 'fivers/vs20procount.png', 0, 1, '2023-12-23 23:30:39', '2023-12-23 23:30:39');
INSERT INTO `fivers_games` VALUES (284, 1, 1, 'vs20forge', 'Forge of Olympus', 'fivers/vs20forge.png', 0, 1, '2023-12-23 23:30:40', '2023-12-23 23:30:40');
INSERT INTO `fivers_games` VALUES (285, 1, 1, 'vswaysbbhas', 'Big Bass Hold & Spinner Megaways', 'fivers/vswaysbbhas.png', 0, 1, '2023-12-23 23:30:42', '2023-12-23 23:30:42');
INSERT INTO `fivers_games` VALUES (286, 1, 1, 'vs20earthquake', 'Cyclops Smash', 'fivers/vs20earthquake.png', 0, 1, '2023-12-23 23:30:43', '2023-12-23 23:30:43');
INSERT INTO `fivers_games` VALUES (287, 1, 1, 'vs20saiman', 'Saiyan Mania', 'fivers/vs20saiman.png', 0, 1, '2023-12-23 23:30:44', '2023-12-23 23:30:44');
INSERT INTO `fivers_games` VALUES (288, 1, 1, 'vs20piggybank', 'Piggy Bankers', 'fivers/vs20piggybank.png', 0, 1, '2023-12-23 23:30:45', '2023-12-23 23:30:45');
INSERT INTO `fivers_games` VALUES (289, 1, 1, 'vs20lvlup', 'Pub Kings', 'fivers/vs20lvlup.png', 0, 1, '2023-12-23 23:30:47', '2023-12-23 23:30:47');
INSERT INTO `fivers_games` VALUES (290, 1, 1, 'vs10trail', 'Mustang Trail', 'fivers/vs10trail.png', 0, 1, '2023-12-23 23:30:48', '2023-12-23 23:30:48');
INSERT INTO `fivers_games` VALUES (291, 1, 1, 'vs20supermania', 'Supermania', 'fivers/vs20supermania.png', 0, 1, '2023-12-23 23:30:50', '2023-12-23 23:30:50');
INSERT INTO `fivers_games` VALUES (292, 1, 1, 'vs50dmdcascade', 'Diamond Cascade', 'fivers/vs50dmdcascade.png', 0, 1, '2023-12-23 23:30:51', '2023-12-23 23:30:51');
INSERT INTO `fivers_games` VALUES (293, 1, 1, 'vs20lobcrab', 'Lobster Bob\'s Crazy Crab Shack', 'fivers/vs20lobcrab.png', 0, 1, '2023-12-23 23:30:53', '2023-12-23 23:30:53');
INSERT INTO `fivers_games` VALUES (294, 1, 1, 'vs20wildparty', '3 Buzzing Wilds', 'fivers/vs20wildparty.png', 0, 1, '2023-12-23 23:30:54', '2023-12-23 23:30:54');
INSERT INTO `fivers_games` VALUES (295, 1, 1, 'vs20doghousemh', 'The Dog House Multihold', 'fivers/vs20doghousemh.png', 0, 1, '2023-12-23 23:30:56', '2023-12-23 23:30:56');
INSERT INTO `fivers_games` VALUES (296, 1, 1, 'vs20splmystery', 'Spellbinding Mystery', 'fivers/vs20splmystery.png', 0, 1, '2023-12-23 23:30:57', '2023-12-23 23:30:57');
INSERT INTO `fivers_games` VALUES (297, 1, 1, 'vs20cashmachine', 'Cash Box', 'fivers/vs20cashmachine.png', 0, 1, '2023-12-23 23:30:59', '2023-12-23 23:30:59');
INSERT INTO `fivers_games` VALUES (298, 1, 1, 'vs50jucier', 'Sky Bounty', 'fivers/vs50jucier.png', 0, 1, '2023-12-23 23:31:00', '2023-12-23 23:31:00');
INSERT INTO `fivers_games` VALUES (299, 1, 1, 'vs243nudge4gold', 'Hellvis Wild', 'fivers/vs243nudge4gold.png', 0, 1, '2023-12-23 23:31:02', '2023-12-23 23:31:02');
INSERT INTO `fivers_games` VALUES (300, 1, 1, 'vs25jokrace', 'Joker Race', 'fivers/vs25jokrace.png', 0, 1, '2023-12-23 23:31:04', '2023-12-23 23:31:04');
INSERT INTO `fivers_games` VALUES (301, 1, 1, 'vs20hstgldngt', 'Heist for the Golden Nuggets', 'fivers/vs20hstgldngt.png', 0, 1, '2023-12-23 23:31:05', '2023-12-23 23:31:05');
INSERT INTO `fivers_games` VALUES (302, 1, 1, 'vs20beefed', 'Fat Panda', 'fivers/vs20beefed.png', 0, 1, '2023-12-23 23:31:07', '2023-12-23 23:31:07');
INSERT INTO `fivers_games` VALUES (303, 1, 1, 'vs20jewelparty', 'Jewel Rush', 'fivers/vs20jewelparty.png', 0, 1, '2023-12-23 23:31:08', '2023-12-23 23:31:08');
INSERT INTO `fivers_games` VALUES (304, 1, 1, 'vs9outlaw', 'Pirates Pub', 'fivers/vs9outlaw.png', 0, 1, '2023-12-23 23:31:10', '2023-12-23 23:31:10');
INSERT INTO `fivers_games` VALUES (305, 1, 1, 'vswaysfrbugs', 'Frogs & Bugs', 'fivers/vswaysfrbugs.png', 0, 1, '2023-12-23 23:31:11', '2023-12-23 23:31:11');
INSERT INTO `fivers_games` VALUES (306, 1, 1, 'vs20lampinf', 'Lamp Of Infinity', '01HKZPNM9X8VRSZTKF9G1EA2A7.jpg', 1, 1, '2023-12-23 23:31:13', '2024-01-12 17:43:59');
INSERT INTO `fivers_games` VALUES (307, 1, 1, 'vs4096robber', 'Robber Strike', 'fivers/vs4096robber.png', 0, 1, '2023-12-23 23:31:14', '2023-12-23 23:31:14');
INSERT INTO `fivers_games` VALUES (308, 1, 1, 'vs10fdrasbf', 'Floating Dragon - Dragon Boat Festival', 'fivers/vs10fdrasbf.png', 0, 1, '2023-12-23 23:31:16', '2023-12-23 23:31:16');
INSERT INTO `fivers_games` VALUES (309, 1, 1, 'vs20clustwild', 'Sticky Bees', 'fivers/vs20clustwild.png', 0, 1, '2023-12-23 23:31:17', '2023-12-23 23:31:17');
INSERT INTO `fivers_games` VALUES (310, 1, 1, 'vs25spotz', 'Knight Hot Spotz', 'fivers/vs25spotz.png', 0, 1, '2023-12-23 23:31:19', '2023-12-23 23:31:19');
INSERT INTO `fivers_games` VALUES (311, 1, 1, 'vs20excalibur', 'Excalibur Unleashed', 'fivers/vs20excalibur.png', 0, 1, '2023-12-23 23:31:20', '2023-12-23 23:31:20');
INSERT INTO `fivers_games` VALUES (312, 1, 1, 'vs20stickywild', 'Wild Bison Charge', 'fivers/vs20stickywild.png', 0, 1, '2023-12-23 23:31:22', '2023-12-23 23:31:22');
INSERT INTO `fivers_games` VALUES (313, 1, 1, 'vs25holiday', 'Holiday Ride', 'fivers/vs25holiday.png', 0, 1, '2023-12-23 23:31:23', '2023-12-23 23:31:23');
INSERT INTO `fivers_games` VALUES (314, 1, 1, 'vs20mvwild', 'Jasmine Dreams', 'fivers/vs20mvwild.png', 0, 1, '2023-12-23 23:31:25', '2023-12-23 23:31:25');
INSERT INTO `fivers_games` VALUES (315, 1, 1, 'vs10kingofdth', 'Kingdom of the Dead', 'fivers/vs10kingofdth.png', 0, 1, '2023-12-23 23:31:26', '2023-12-23 23:31:26');
INSERT INTO `fivers_games` VALUES (316, 1, 1, 'vswaysultrcoin', 'Cowboy Coins', 'fivers/vswaysultrcoin.png', 0, 1, '2023-12-23 23:31:28', '2023-12-23 23:31:28');
INSERT INTO `fivers_games` VALUES (317, 1, 1, 'vs10gizagods', 'Gods of Giza', 'fivers/vs10gizagods.png', 0, 1, '2023-12-23 23:31:29', '2023-12-23 23:31:29');
INSERT INTO `fivers_games` VALUES (318, 1, 1, 'vswaysrsm', 'Wild Celebrity Bus Megaways', 'fivers/vswaysrsm.png', 0, 1, '2023-12-23 23:31:31', '2023-12-23 23:31:31');
INSERT INTO `fivers_games` VALUES (319, 1, 1, 'vswaysmonkey', '3 Dancing Monkeys', 'fivers/vswaysmonkey.png', 0, 1, '2023-12-23 23:31:33', '2023-12-23 23:31:33');
INSERT INTO `fivers_games` VALUES (320, 1, 1, 'vs20hotzone', 'African Elephant', 'fivers/vs20hotzone.png', 0, 1, '2023-12-23 23:31:35', '2023-12-23 23:31:35');
INSERT INTO `fivers_games` VALUES (321, 1, 1, 'vs10bbhas', 'Big Bass - Hold & Spinner', 'fivers/vs10bbhas.png', 0, 1, '2023-12-23 23:31:36', '2023-12-23 23:31:36');
INSERT INTO `fivers_games` VALUES (322, 1, 1, 'vs1024moonsh', 'Moonshot', 'fivers/vs1024moonsh.png', 0, 1, '2023-12-23 23:31:37', '2023-12-23 23:31:37');
INSERT INTO `fivers_games` VALUES (323, 1, 1, 'vswaysredqueen', 'The Red Queen', 'fivers/vswaysredqueen.png', 0, 1, '2023-12-23 23:31:38', '2023-12-23 23:31:38');
INSERT INTO `fivers_games` VALUES (324, 1, 1, 'vs20framazon', 'Fruits of the Amazon', 'fivers/vs20framazon.png', 0, 1, '2023-12-23 23:31:39', '2023-12-23 23:31:39');
INSERT INTO `fivers_games` VALUES (325, 1, 1, 'vs20sknights', 'The Knight King', 'fivers/vs20sknights.png', 0, 1, '2023-12-23 23:31:41', '2023-12-23 23:31:41');
INSERT INTO `fivers_games` VALUES (326, 1, 1, 'vs20goldclust', 'Rabbit Garden', 'fivers/vs20goldclust.png', 0, 1, '2023-12-23 23:31:42', '2023-12-23 23:31:42');
INSERT INTO `fivers_games` VALUES (327, 1, 1, 'vswaysmorient', 'Mystery of the Orient', 'fivers/vswaysmorient.png', 0, 1, '2023-12-23 23:31:44', '2023-12-23 23:31:44');
INSERT INTO `fivers_games` VALUES (328, 1, 1, 'vs10powerlines', 'Peak Power', 'fivers/vs10powerlines.png', 0, 1, '2023-12-23 23:31:45', '2023-12-23 23:31:45');
INSERT INTO `fivers_games` VALUES (329, 1, 1, 'vs12tropicana', 'Club Tropicana', 'fivers/vs12tropicana.png', 0, 1, '2023-12-23 23:31:47', '2023-12-23 23:31:47');
INSERT INTO `fivers_games` VALUES (330, 1, 1, 'vs25archer', 'Fire Archer', 'fivers/vs25archer.png', 0, 1, '2023-12-23 23:31:48', '2023-12-23 23:31:48');
INSERT INTO `fivers_games` VALUES (331, 1, 1, 'vs20gatotfury', 'Gatot Kaca\'s Fury', 'fivers/vs20gatotfury.png', 0, 1, '2023-12-23 23:31:50', '2023-12-23 23:31:50');
INSERT INTO `fivers_games` VALUES (332, 1, 1, 'vs20mochimon', 'Mochimon', 'fivers/vs20mochimon.png', 0, 1, '2023-12-23 23:31:51', '2023-12-23 23:31:51');
INSERT INTO `fivers_games` VALUES (333, 1, 1, 'vs10fisheye', 'Fish Eye', 'fivers/vs10fisheye.png', 0, 1, '2023-12-23 23:31:53', '2023-12-23 23:31:53');
INSERT INTO `fivers_games` VALUES (334, 1, 1, 'vs20superlanche', 'Monster Superlanche', 'fivers/vs20superlanche.png', 0, 1, '2023-12-23 23:31:54', '2023-12-23 23:31:54');
INSERT INTO `fivers_games` VALUES (335, 1, 1, 'vswaysftropics', 'Frozen Tropics', 'fivers/vswaysftropics.png', 0, 1, '2023-12-23 23:31:56', '2023-12-23 23:31:56');
INSERT INTO `fivers_games` VALUES (336, 1, 1, 'vswaysincwnd', 'Gold Oasis', 'fivers/vswaysincwnd.png', 0, 1, '2023-12-23 23:31:57', '2023-12-23 23:31:57');
INSERT INTO `fivers_games` VALUES (337, 1, 1, 'vs25spgldways', 'Secret City Gold', 'fivers/vs25spgldways.png', 0, 1, '2023-12-23 23:31:59', '2023-12-23 23:31:59');
INSERT INTO `fivers_games` VALUES (338, 1, 1, 'vswayswwhex', 'Wild Wild Bananas', 'fivers/vswayswwhex.png', 0, 1, '2023-12-23 23:32:00', '2023-12-23 23:32:00');
INSERT INTO `fivers_games` VALUES (339, 2, 1, 'SGReturnToTheFeature', 'Return to the Future', 'fivers/SGReturnToTheFeature.png', 0, 1, '2023-12-23 23:32:03', '2023-12-23 23:32:03');
INSERT INTO `fivers_games` VALUES (340, 2, 1, 'SGTabernaDeLosMuertosUltra', 'Tevena de los Muirtos Ultra', 'fivers/SGTabernaDeLosMuertosUltra.png', 0, 1, '2023-12-23 23:32:03', '2023-12-23 23:32:03');
INSERT INTO `fivers_games` VALUES (341, 2, 1, 'SGTotemTowers', 'Totem towers', 'fivers/SGTotemTowers.png', 0, 1, '2023-12-23 23:32:03', '2023-12-23 23:32:03');
INSERT INTO `fivers_games` VALUES (342, 2, 1, 'SGChristmasGiftRush', 'Christmas Kipoot Rush', 'fivers/SGChristmasGiftRush.png', 0, 1, '2023-12-23 23:32:04', '2023-12-23 23:32:04');
INSERT INTO `fivers_games` VALUES (343, 2, 1, 'SGOrbsOfAtlantis', 'Overs of Atlantis', 'fivers/SGOrbsOfAtlantis.png', 0, 1, '2023-12-23 23:32:04', '2023-12-23 23:32:04');
INSERT INTO `fivers_games` VALUES (344, 2, 1, 'SGBeforeTimeRunsOut', 'Before Time Runner Out', 'fivers/SGBeforeTimeRunsOut.png', 0, 1, '2023-12-23 23:32:05', '2023-12-23 23:32:05');
INSERT INTO `fivers_games` VALUES (345, 2, 1, 'SGTechnoTumble', 'Techno tumble', 'fivers/SGTechnoTumble.png', 0, 1, '2023-12-23 23:32:05', '2023-12-23 23:32:05');
INSERT INTO `fivers_games` VALUES (346, 2, 1, 'SGWealthInn', 'Wells Inn', 'fivers/SGWealthInn.png', 0, 1, '2023-12-23 23:32:06', '2023-12-23 23:32:06');
INSERT INTO `fivers_games` VALUES (347, 2, 1, 'SGHappyApe', 'Happy ape', 'fivers/SGHappyApe.png', 0, 1, '2023-12-23 23:32:06', '2023-12-23 23:32:06');
INSERT INTO `fivers_games` VALUES (348, 2, 1, 'SGTabernaDeLosMuertos', 'Tevena di los Muertos', 'fivers/SGTabernaDeLosMuertos.png', 0, 1, '2023-12-23 23:32:07', '2023-12-23 23:32:07');
INSERT INTO `fivers_games` VALUES (349, 2, 1, 'SGNaughtySanta', 'Notty Santa', 'fivers/SGNaughtySanta.png', 0, 1, '2023-12-23 23:32:07', '2023-12-23 23:32:07');
INSERT INTO `fivers_games` VALUES (350, 2, 1, 'SGFaCaiShenDeluxe', 'Pakai Sen Deluxe', 'fivers/SGFaCaiShenDeluxe.png', 0, 1, '2023-12-23 23:32:08', '2023-12-23 23:32:08');
INSERT INTO `fivers_games` VALUES (351, 2, 1, 'SGHeySushi', 'Hey sushi', 'fivers/SGHeySushi.png', 0, 1, '2023-12-23 23:32:08', '2023-12-23 23:32:08');
INSERT INTO `fivers_games` VALUES (352, 2, 1, 'SGKnockoutFootballRush', 'Knockout football rush', 'fivers/SGKnockoutFootballRush.png', 0, 1, '2023-12-23 23:32:09', '2023-12-23 23:32:09');
INSERT INTO `fivers_games` VALUES (353, 2, 1, 'SGColossalGems', 'Closal Gems', 'fivers/SGColossalGems.png', 0, 1, '2023-12-23 23:32:09', '2023-12-23 23:32:09');
INSERT INTO `fivers_games` VALUES (354, 2, 1, 'SGHotHotHalloween', 'hot hot halloween', 'fivers/SGHotHotHalloween.png', 0, 1, '2023-12-23 23:32:10', '2023-12-23 23:32:10');
INSERT INTO `fivers_games` VALUES (355, 2, 1, 'SGLuckyFortuneCat', 'Lucky fortune cat', 'fivers/SGLuckyFortuneCat.png', 0, 1, '2023-12-23 23:32:10', '2023-12-23 23:32:10');
INSERT INTO `fivers_games` VALUES (356, 2, 1, 'SGHotHotFruit', 'hot hot fruit', 'fivers/SGHotHotFruit.png', 0, 1, '2023-12-23 23:32:11', '2023-12-23 23:32:11');
INSERT INTO `fivers_games` VALUES (357, 2, 1, 'SGMountMazuma', 'Mount Majuma', 'fivers/SGMountMazuma.png', 0, 1, '2023-12-23 23:32:11', '2023-12-23 23:32:11');
INSERT INTO `fivers_games` VALUES (358, 2, 1, 'SGWildTrucks', 'Wild Trucks', 'fivers/SGWildTrucks.png', 0, 1, '2023-12-23 23:32:11', '2023-12-23 23:32:11');
INSERT INTO `fivers_games` VALUES (359, 2, 1, 'SGLuckyLucky', 'Lucky Lucky', 'fivers/SGLuckyLucky.png', 0, 1, '2023-12-23 23:32:12', '2023-12-23 23:32:12');
INSERT INTO `fivers_games` VALUES (360, 2, 1, 'SGKnockoutFootball', 'Knockout football', 'fivers/SGKnockoutFootball.png', 0, 1, '2023-12-23 23:32:12', '2023-12-23 23:32:12');
INSERT INTO `fivers_games` VALUES (361, 2, 1, 'SGJump', 'Jump!', 'fivers/SGJump.png', 0, 1, '2023-12-23 23:32:13', '2023-12-23 23:32:13');
INSERT INTO `fivers_games` VALUES (362, 2, 1, 'SGPumpkinPatch', 'Pumpkin patch', 'fivers/SGPumpkinPatch.png', 0, 1, '2023-12-23 23:32:14', '2023-12-23 23:32:14');
INSERT INTO `fivers_games` VALUES (363, 2, 1, 'SGWaysOfFortune', 'Way of Fortune', 'fivers/SGWaysOfFortune.png', 0, 1, '2023-12-23 23:32:14', '2023-12-23 23:32:14');
INSERT INTO `fivers_games` VALUES (364, 2, 1, 'SGFourDivineBeasts', 'For Devine Beasts', 'fivers/SGFourDivineBeasts.png', 0, 1, '2023-12-23 23:32:14', '2023-12-23 23:32:14');
INSERT INTO `fivers_games` VALUES (365, 2, 1, 'SGPandaPanda', 'Panda panda', 'fivers/SGPandaPanda.png', 0, 1, '2023-12-23 23:32:15', '2023-12-23 23:32:15');
INSERT INTO `fivers_games` VALUES (366, 2, 1, 'SGOceansCall', 'Ocean\'s Call', 'fivers/SGOceansCall.png', 0, 1, '2023-12-23 23:32:15', '2023-12-23 23:32:15');
INSERT INTO `fivers_games` VALUES (367, 2, 1, 'SGScruffyScallywags', 'Scruffy Skellywex', 'fivers/SGScruffyScallywags.png', 0, 1, '2023-12-23 23:32:16', '2023-12-23 23:32:16');
INSERT INTO `fivers_games` VALUES (368, 2, 1, 'SGNuwa', 'Nuwa', 'fivers/SGNuwa.png', 0, 1, '2023-12-23 23:32:16', '2023-12-23 23:32:16');
INSERT INTO `fivers_games` VALUES (369, 2, 1, 'SGTheKoiGate', 'Koi gate', 'fivers/SGTheKoiGate.png', 0, 1, '2023-12-23 23:32:17', '2023-12-23 23:32:17');
INSERT INTO `fivers_games` VALUES (370, 2, 1, 'SGFaCaiShen', 'Pacaishen', 'fivers/SGFaCaiShen.png', 0, 1, '2023-12-23 23:32:17', '2023-12-23 23:32:17');
INSERT INTO `fivers_games` VALUES (371, 2, 1, 'SG12Zodiacs', '12 zodiacs', 'fivers/SG12Zodiacs.png', 0, 1, '2023-12-23 23:32:18', '2023-12-23 23:32:18');
INSERT INTO `fivers_games` VALUES (372, 2, 1, 'SGFireRooster', 'Fire rooster', 'fivers/SGFireRooster.png', 0, 1, '2023-12-23 23:32:18', '2023-12-23 23:32:18');
INSERT INTO `fivers_games` VALUES (373, 2, 1, 'SGFenghuang', 'Phoenix', 'fivers/SGFenghuang.png', 0, 1, '2023-12-23 23:32:19', '2023-12-23 23:32:19');
INSERT INTO `fivers_games` VALUES (374, 2, 1, 'SGBirdOfThunder', 'Bird of Thunder', 'fivers/SGBirdOfThunder.png', 0, 1, '2023-12-23 23:32:19', '2023-12-23 23:32:19');
INSERT INTO `fivers_games` VALUES (375, 2, 1, 'SGTheDeadEscape', 'The Dead Escape', 'fivers/SGTheDeadEscape.png', 0, 1, '2023-12-23 23:32:20', '2023-12-23 23:32:20');
INSERT INTO `fivers_games` VALUES (376, 2, 1, 'SGBombsAway', 'Bombs Away', 'fivers/SGBombsAway.png', 0, 1, '2023-12-23 23:32:20', '2023-12-23 23:32:20');
INSERT INTO `fivers_games` VALUES (377, 2, 1, 'SGGoldRush', 'Gold rush', 'fivers/SGGoldRush.png', 0, 1, '2023-12-23 23:32:21', '2023-12-23 23:32:21');
INSERT INTO `fivers_games` VALUES (378, 2, 1, 'SGRuffledUp', 'Ruffled up', 'fivers/SGRuffledUp.png', 0, 1, '2023-12-23 23:32:21', '2023-12-23 23:32:21');
INSERT INTO `fivers_games` VALUES (379, 2, 1, 'SGRomanEmpire', 'Roman empire', 'fivers/SGRomanEmpire.png', 0, 1, '2023-12-23 23:32:22', '2023-12-23 23:32:22');
INSERT INTO `fivers_games` VALUES (380, 2, 1, 'SGCoyoteCrash', 'Coyote crash', 'fivers/SGCoyoteCrash.png', 0, 1, '2023-12-23 23:32:22', '2023-12-23 23:32:22');
INSERT INTO `fivers_games` VALUES (381, 2, 1, 'SGWickedWitch', 'Wickt Location', 'fivers/SGWickedWitch.png', 0, 1, '2023-12-23 23:32:23', '2023-12-23 23:32:23');
INSERT INTO `fivers_games` VALUES (382, 2, 1, 'SGDragonsThrone', 'Dragon\'s Throne', 'fivers/SGDragonsThrone.png', 0, 1, '2023-12-23 23:32:23', '2023-12-23 23:32:23');
INSERT INTO `fivers_games` VALUES (383, 2, 1, 'SGBuggyBonus', 'Buggy bonus', 'fivers/SGBuggyBonus.png', 0, 1, '2023-12-23 23:32:23', '2023-12-23 23:32:23');
INSERT INTO `fivers_games` VALUES (384, 2, 1, 'SGGlamRock', 'Glam rock', 'fivers/SGGlamRock.png', 0, 1, '2023-12-23 23:32:24', '2023-12-23 23:32:24');
INSERT INTO `fivers_games` VALUES (385, 2, 1, 'SGSuperTwister', 'Super twister', 'fivers/SGSuperTwister.png', 0, 1, '2023-12-23 23:32:24', '2023-12-23 23:32:24');
INSERT INTO `fivers_games` VALUES (386, 2, 1, 'SGKanesInferno', 'Keynes Inferno', 'fivers/SGKanesInferno.png', 0, 1, '2023-12-23 23:32:25', '2023-12-23 23:32:25');
INSERT INTO `fivers_games` VALUES (387, 2, 1, 'SGTreasureTomb', 'Treasure Tomb', 'fivers/SGTreasureTomb.png', 0, 1, '2023-12-23 23:32:25', '2023-12-23 23:32:25');
INSERT INTO `fivers_games` VALUES (388, 2, 1, 'SGJugglenaut', 'Jugglenut', 'fivers/SGJugglenaut.png', 0, 1, '2023-12-23 23:32:26', '2023-12-23 23:32:26');
INSERT INTO `fivers_games` VALUES (389, 2, 1, 'SGGalacticCash', 'Glactic Cash', 'fivers/SGGalacticCash.png', 0, 1, '2023-12-23 23:32:26', '2023-12-23 23:32:26');
INSERT INTO `fivers_games` VALUES (390, 2, 1, 'SGZeus2', 'Zeus 2', 'fivers/SGZeus2.png', 0, 1, '2023-12-23 23:32:27', '2023-12-23 23:32:27');
INSERT INTO `fivers_games` VALUES (391, 2, 1, 'SGTheDragonCastle', 'Dragon castle', 'fivers/SGTheDragonCastle.png', 0, 1, '2023-12-23 23:32:27', '2023-12-23 23:32:27');
INSERT INTO `fivers_games` VALUES (392, 2, 1, 'SGKingTutsTomb', 'King Teeth Tomb', 'fivers/SGKingTutsTomb.png', 0, 1, '2023-12-23 23:32:27', '2023-12-23 23:32:27');
INSERT INTO `fivers_games` VALUES (393, 2, 1, 'SGCarnivalCash', 'Carnival cash', 'fivers/SGCarnivalCash.png', 0, 1, '2023-12-23 23:32:28', '2023-12-23 23:32:28');
INSERT INTO `fivers_games` VALUES (394, 2, 1, 'SGTreasureDiver', 'Treasure diver', 'fivers/SGTreasureDiver.png', 0, 1, '2023-12-23 23:32:28', '2023-12-23 23:32:28');
INSERT INTO `fivers_games` VALUES (395, 2, 1, 'SGLittleGreenMoney', 'Little Green Money', 'fivers/SGLittleGreenMoney.png', 0, 1, '2023-12-23 23:32:29', '2023-12-23 23:32:29');
INSERT INTO `fivers_games` VALUES (396, 2, 1, 'SGMonsterMashCash', 'Monster Mash Cash', 'fivers/SGMonsterMashCash.png', 0, 1, '2023-12-23 23:32:29', '2023-12-23 23:32:29');
INSERT INTO `fivers_games` VALUES (397, 2, 1, 'SGShaolinFortunes100', 'Xiaolin Fortune 100', 'fivers/SGShaolinFortunes100.png', 0, 1, '2023-12-23 23:32:30', '2023-12-23 23:32:30');
INSERT INTO `fivers_games` VALUES (398, 2, 1, 'SGShaolinFortunes243', 'Xiaolin Fortune', 'fivers/SGShaolinFortunes243.png', 0, 1, '2023-12-23 23:32:30', '2023-12-23 23:32:30');
INSERT INTO `fivers_games` VALUES (399, 2, 1, 'SGWeirdScience', 'Weird Science', 'fivers/SGWeirdScience.png', 0, 1, '2023-12-23 23:32:31', '2023-12-23 23:32:31');
INSERT INTO `fivers_games` VALUES (400, 2, 1, 'SGBlackbeardsBounty', 'Blackbeards Bounty', 'fivers/SGBlackbeardsBounty.png', 0, 1, '2023-12-23 23:32:31', '2023-12-23 23:32:31');
INSERT INTO `fivers_games` VALUES (401, 2, 1, 'SGDrFeelgood', 'Dr. Feelgood', 'fivers/SGDrFeelgood.png', 0, 1, '2023-12-23 23:32:31', '2023-12-23 23:32:31');
INSERT INTO `fivers_games` VALUES (402, 2, 1, 'SGVikingsPlunder', 'Vikings plunder', NULL, 0, 1, '2023-12-23 23:32:36', '2023-12-23 23:32:36');
INSERT INTO `fivers_games` VALUES (403, 2, 1, 'SGDoubleODollars', 'Double O Dollars', 'fivers/SGDoubleODollars.png', 0, 1, '2023-12-23 23:32:36', '2023-12-23 23:32:36');
INSERT INTO `fivers_games` VALUES (404, 2, 1, 'SGSpaceFortune', 'Space fortune', 'fivers/SGSpaceFortune.png', 0, 1, '2023-12-23 23:32:37', '2023-12-23 23:32:37');
INSERT INTO `fivers_games` VALUES (405, 2, 1, 'SGPamperMe', 'Pamper me', 'fivers/SGPamperMe.png', 0, 1, '2023-12-23 23:32:37', '2023-12-23 23:32:37');
INSERT INTO `fivers_games` VALUES (406, 2, 1, 'SGZeus', 'Zeus', 'fivers/SGZeus.png', 0, 1, '2023-12-23 23:32:38', '2023-12-23 23:32:38');
INSERT INTO `fivers_games` VALUES (407, 2, 1, 'SGSOS', 'S.O.S.!', 'fivers/SGSOS.png', 0, 1, '2023-12-23 23:32:38', '2023-12-23 23:32:38');
INSERT INTO `fivers_games` VALUES (408, 2, 1, 'SGPoolShark', 'Full shark', 'fivers/SGPoolShark.png', 0, 1, '2023-12-23 23:32:39', '2023-12-23 23:32:39');
INSERT INTO `fivers_games` VALUES (409, 2, 1, 'SGEgyptianDreams', 'Egyptian Dreams', 'fivers/SGEgyptianDreams.png', 0, 1, '2023-12-23 23:32:39', '2023-12-23 23:32:39');
INSERT INTO `fivers_games` VALUES (410, 2, 1, 'SGBarnstormerBucks', 'Barnstormer Bucks', 'fivers/SGBarnstormerBucks.png', 0, 1, '2023-12-23 23:32:40', '2023-12-23 23:32:40');
INSERT INTO `fivers_games` VALUES (411, 2, 1, 'SGSuperStrike', 'Super strike', 'fivers/SGSuperStrike.png', 0, 1, '2023-12-23 23:32:40', '2023-12-23 23:32:40');
INSERT INTO `fivers_games` VALUES (412, 2, 1, 'SGJungleRumble', 'Jungle rumble', 'fivers/SGJungleRumble.png', 0, 1, '2023-12-23 23:32:41', '2023-12-23 23:32:41');
INSERT INTO `fivers_games` VALUES (413, 2, 1, 'SGArcticWonders', 'Arctic Wonders', 'fivers/SGArcticWonders.png', 0, 1, '2023-12-23 23:32:41', '2023-12-23 23:32:41');
INSERT INTO `fivers_games` VALUES (414, 2, 1, 'SGTowerOfPizza', 'Tower of Pizza', 'fivers/SGTowerOfPizza.png', 0, 1, '2023-12-23 23:32:42', '2023-12-23 23:32:42');
INSERT INTO `fivers_games` VALUES (415, 2, 1, 'SGMummyMoney', 'Mummy money', 'fivers/SGMummyMoney.png', 0, 1, '2023-12-23 23:32:42', '2023-12-23 23:32:42');
INSERT INTO `fivers_games` VALUES (416, 2, 1, 'SGBikiniIsland', 'bikini island', 'fivers/SGBikiniIsland.png', 0, 1, '2023-12-23 23:32:43', '2023-12-23 23:32:43');
INSERT INTO `fivers_games` VALUES (417, 2, 1, 'SGQueenOfQueens1024', 'Queen of Queens II', 'fivers/SGQueenOfQueens1024.png', 0, 1, '2023-12-23 23:32:43', '2023-12-23 23:32:43');
INSERT INTO `fivers_games` VALUES (418, 2, 1, 'SGDragonsRealm', 'Dragon\'s Realm', 'fivers/SGDragonsRealm.png', 0, 1, '2023-12-23 23:32:44', '2023-12-23 23:32:44');
INSERT INTO `fivers_games` VALUES (419, 2, 1, 'SGAllForOne', 'All for one', 'fivers/SGAllForOne.png', 0, 1, '2023-12-23 23:32:44', '2023-12-23 23:32:44');
INSERT INTO `fivers_games` VALUES (420, 2, 1, 'SGFlyingHigh', 'Flying high', 'fivers/SGFlyingHigh.png', 0, 1, '2023-12-23 23:32:44', '2023-12-23 23:32:44');
INSERT INTO `fivers_games` VALUES (421, 2, 1, 'SGMrBling', 'Mr. Bling', 'fivers/SGMrBling.png', 0, 1, '2023-12-23 23:32:45', '2023-12-23 23:32:45');
INSERT INTO `fivers_games` VALUES (422, 2, 1, 'SGMysticFortune', 'Mystic Fortune', 'fivers/SGMysticFortune.png', 0, 1, '2023-12-23 23:32:45', '2023-12-23 23:32:45');
INSERT INTO `fivers_games` VALUES (423, 2, 1, 'SGPuckerUpPrince', 'Funker up prince', 'fivers/SGPuckerUpPrince.png', 0, 1, '2023-12-23 23:32:46', '2023-12-23 23:32:46');
INSERT INTO `fivers_games` VALUES (424, 2, 1, 'SGSirBlingalot', 'Bring it all', 'fivers/SGSirBlingalot.png', 0, 1, '2023-12-23 23:32:46', '2023-12-23 23:32:46');
INSERT INTO `fivers_games` VALUES (425, 2, 1, 'SGCashReef', 'Cash leaf', 'fivers/SGCashReef.png', 0, 1, '2023-12-23 23:32:47', '2023-12-23 23:32:47');
INSERT INTO `fivers_games` VALUES (426, 2, 1, 'SGQueenOfQueens243', 'Queen of queens', 'fivers/SGQueenOfQueens243.png', 0, 1, '2023-12-23 23:32:47', '2023-12-23 23:32:47');
INSERT INTO `fivers_games` VALUES (427, 2, 1, 'SGRideEmCowboy', 'Lytham Cowboy (Pick Game)', 'fivers/SGRideEmCowboy.png', 0, 1, '2023-12-23 23:32:48', '2023-12-23 23:32:48');
INSERT INTO `fivers_games` VALUES (428, 2, 1, 'SGGrapeEscape', 'The Graph Escape', 'fivers/SGGrapeEscape.png', 0, 1, '2023-12-23 23:32:48', '2023-12-23 23:32:48');
INSERT INTO `fivers_games` VALUES (429, 2, 1, 'SGGoldenUnicorn', 'Golden unicorn', 'fivers/SGGoldenUnicorn.png', 0, 1, '2023-12-23 23:32:48', '2023-12-23 23:32:48');
INSERT INTO `fivers_games` VALUES (430, 2, 1, 'SGFrontierFortunes', 'Frontier Fortune', 'fivers/SGFrontierFortunes.png', 0, 1, '2023-12-23 23:32:49', '2023-12-23 23:32:49');
INSERT INTO `fivers_games` VALUES (431, 2, 1, 'SGIndianCashCatcher', 'Indian Cash Catcher', 'fivers/SGIndianCashCatcher.png', 0, 1, '2023-12-23 23:32:49', '2023-12-23 23:32:49');
INSERT INTO `fivers_games` VALUES (432, 2, 1, 'SGSkysTheLimit', 'Sky\'s the Limit', 'fivers/SGSkysTheLimit.png', 0, 1, '2023-12-23 23:32:50', '2023-12-23 23:32:50');
INSERT INTO `fivers_games` VALUES (433, 2, 1, 'SGTheBigDeal', 'The Big Deal', 'fivers/SGTheBigDeal.png', 0, 1, '2023-12-23 23:32:50', '2023-12-23 23:32:50');
INSERT INTO `fivers_games` VALUES (434, 2, 1, 'SGCashosaurus', 'Cashosaurus', 'fivers/SGCashosaurus.png', 0, 1, '2023-12-23 23:32:51', '2023-12-23 23:32:51');
INSERT INTO `fivers_games` VALUES (435, 2, 1, 'SGDiscoFunk', 'Disco funk', 'fivers/SGDiscoFunk.png', 0, 1, '2023-12-23 23:32:51', '2023-12-23 23:32:51');
INSERT INTO `fivers_games` VALUES (436, 2, 1, 'SGCalaverasExplosivas', 'Calaveras Explociba', 'fivers/SGCalaverasExplosivas.png', 0, 1, '2023-12-23 23:32:52', '2023-12-23 23:32:52');
INSERT INTO `fivers_games` VALUES (437, 2, 1, 'SGNewYearsBash', 'New Year Bessie', 'fivers/SGNewYearsBash.png', 0, 1, '2023-12-23 23:32:52', '2023-12-23 23:32:52');
INSERT INTO `fivers_games` VALUES (438, 2, 1, 'SGNineTails', 'Nine Tales', 'fivers/SGNineTails.png', 0, 1, '2023-12-23 23:32:53', '2023-12-23 23:32:53');
INSERT INTO `fivers_games` VALUES (439, 2, 1, 'SGMysticFortuneDeluxe', 'Mystic Fortune Deluxe', 'fivers/SGMysticFortuneDeluxe.png', 0, 1, '2023-12-23 23:32:53', '2023-12-23 23:32:53');
INSERT INTO `fivers_games` VALUES (440, 2, 1, 'SGLuckyDurian', 'Lucky durian', 'fivers/SGLuckyDurian.png', 0, 1, '2023-12-23 23:32:54', '2023-12-23 23:32:54');
INSERT INTO `fivers_games` VALUES (441, 2, 1, 'SGDiscoBeats', 'Disco beat', 'fivers/SGDiscoBeats.png', 0, 1, '2023-12-23 23:32:54', '2023-12-23 23:32:54');
INSERT INTO `fivers_games` VALUES (442, 2, 1, 'SGLanternLuck', 'Lantern lucky', 'fivers/SGLanternLuck.png', 0, 1, '2023-12-23 23:32:55', '2023-12-23 23:32:55');
INSERT INTO `fivers_games` VALUES (443, 2, 1, 'SGBombRunner', 'Boom runner', 'fivers/SGBombRunner.png', 0, 1, '2023-12-23 23:32:55', '2023-12-23 23:32:55');
INSERT INTO `fivers_games` VALUES (444, 3, 1, 'sun_of_egypt', 'SUN OF EGYPT', 'fivers/sun_of_egypt.jpe', 0, 1, '2023-12-23 23:32:57', '2023-12-23 23:32:57');
INSERT INTO `fivers_games` VALUES (445, 3, 1, 'sun_of_egypt_2', 'SUN OF EGYPT 2', 'fivers/sun_of_egypt_2.jpg', 0, 1, '2023-12-23 23:32:58', '2023-12-23 23:32:58');
INSERT INTO `fivers_games` VALUES (446, 3, 1, 'happy_fish', 'HAPPY FISH', 'fivers/happy_fish.jpg', 0, 1, '2023-12-23 23:32:58', '2023-12-23 23:32:58');
INSERT INTO `fivers_games` VALUES (447, 3, 1, 'queen_of_the_sun', 'QUEEN OF THE SUN', 'fivers/queen_of_the_sun.jpg', 0, 1, '2023-12-23 23:32:59', '2023-12-23 23:32:59');
INSERT INTO `fivers_games` VALUES (448, 3, 1, 'tiger_jungle', 'TIGER JUNGLE', 'fivers/tiger_jungle.jpg', 0, 1, '2023-12-23 23:32:59', '2023-12-23 23:32:59');
INSERT INTO `fivers_games` VALUES (449, 3, 1, 'black_wolf', 'BLACK WOLF', 'fivers/black_wolf.jpg', 0, 1, '2023-12-23 23:33:00', '2023-12-23 23:33:00');
INSERT INTO `fivers_games` VALUES (450, 3, 1, 'hit_the_gold', 'HIT THE GOLD', 'fivers/hit_the_gold.jpg', 0, 1, '2023-12-23 23:33:00', '2023-12-23 23:33:00');
INSERT INTO `fivers_games` VALUES (451, 3, 1, 'candy_boom', 'CANDY BOOM', 'fivers/candy_boom.jpg', 0, 1, '2023-12-23 23:33:01', '2023-12-23 23:33:01');
INSERT INTO `fivers_games` VALUES (452, 3, 1, 'scarab_riches', 'SCARAB RICHES', 'fivers/scarab_riches.jpe', 0, 1, '2023-12-23 23:33:01', '2023-12-23 23:33:01');
INSERT INTO `fivers_games` VALUES (453, 3, 1, 'golden_dancing_lion', 'GOLDEN DANCING LION', 'fivers/golden_dancing_lion.jpg', 0, 1, '2023-12-23 23:33:02', '2023-12-23 23:33:02');
INSERT INTO `fivers_games` VALUES (454, 3, 1, 'dragon_pearls', 'DRAGON PEARLS', 'fivers/dragon_pearls.jpeg', 0, 1, '2023-12-23 23:33:02', '2023-12-23 23:33:02');
INSERT INTO `fivers_games` VALUES (455, 3, 1, '3_coins', '3 COINS', 'fivers/3_coins.jpg', 0, 1, '2023-12-23 23:33:03', '2023-12-23 23:33:03');
INSERT INTO `fivers_games` VALUES (456, 3, 1, 'super_rich_god', 'SUPER RICH GOD', 'fivers/super_rich_god.jpg', 0, 1, '2023-12-23 23:33:03', '2023-12-23 23:33:03');
INSERT INTO `fivers_games` VALUES (457, 3, 1, '15_dragon_pearls', '15 DRAGON PEARLS', 'fivers/15_dragon_pearls.jpeg', 0, 1, '2023-12-23 23:33:03', '2023-12-23 23:33:03');
INSERT INTO `fivers_games` VALUES (458, 3, 1, 'aztec_sun', 'AZTEC SUN', 'fivers/aztec_sun.jpe', 0, 1, '2023-12-23 23:33:04', '2023-12-23 23:33:04');
INSERT INTO `fivers_games` VALUES (459, 3, 1, 'scarab_temple', 'SCARAB TEMPLE', 'fivers/scarab_temple.jpeg', 0, 1, '2023-12-23 23:33:04', '2023-12-23 23:33:04');
INSERT INTO `fivers_games` VALUES (460, 3, 1, 'gods_temple_deluxe', 'GODS TEMPLE DELUXE', 'fivers/gods_temple_deluxe.png', 0, 1, '2023-12-23 23:33:08', '2023-12-23 23:33:08');
INSERT INTO `fivers_games` VALUES (461, 3, 1, 'book_of_sun', 'BOOK OF SUN', 'fivers/book_of_sun.jpg', 0, 1, '2023-12-23 23:33:08', '2023-12-23 23:33:08');
INSERT INTO `fivers_games` VALUES (462, 3, 1, '777_gems', '777 GEMS', 'fivers/777_gems.jpeg', 0, 1, '2023-12-23 23:33:09', '2023-12-23 23:33:09');
INSERT INTO `fivers_games` VALUES (463, 3, 1, 'book_of_sun_multichance', 'BOOK OF SUN MULTICHANCE', 'fivers/book_of_sun_multichance.jpg', 0, 1, '2023-12-23 23:33:09', '2023-12-23 23:33:09');
INSERT INTO `fivers_games` VALUES (464, 3, 1, 'olympian_gods', 'OLYMPIAN GODS', 'fivers/olympian_gods.jpeg', 0, 1, '2023-12-23 23:33:10', '2023-12-23 23:33:10');
INSERT INTO `fivers_games` VALUES (465, 3, 1, '777_gems_respin', '777 GEMS RESPIN', 'fivers/777_gems_respin.jpg', 0, 1, '2023-12-23 23:33:10', '2023-12-23 23:33:10');
INSERT INTO `fivers_games` VALUES (466, 3, 1, 'tigers_gold', 'TIGERS GOLD', 'fivers/tigers_gold.jpe', 0, 1, '2023-12-23 23:33:11', '2023-12-23 23:33:11');
INSERT INTO `fivers_games` VALUES (467, 3, 1, 'moon_sisters', 'MOON SISTERS', NULL, 0, 1, '2023-12-23 23:33:15', '2023-12-23 23:33:15');
INSERT INTO `fivers_games` VALUES (468, 3, 1, 'book_of_sun_choice', 'BOOK OF SUN CHOICE', 'fivers/book_of_sun_choice.jpg', 0, 1, '2023-12-23 23:33:15', '2023-12-23 23:33:15');
INSERT INTO `fivers_games` VALUES (469, 3, 1, 'super_marble', 'SUPER MARBLE', 'fivers/super_marble.jpg', 0, 1, '2023-12-23 23:33:16', '2023-12-23 23:33:16');
INSERT INTO `fivers_games` VALUES (470, 3, 1, 'buddha_fortune', 'BUDDHA FORTUNE', 'fivers/buddha_fortune.jpg', 0, 1, '2023-12-23 23:33:16', '2023-12-23 23:33:16');
INSERT INTO `fivers_games` VALUES (471, 3, 1, 'great_panda', 'GREAT PANDA', 'fivers/great_panda.jpg', 0, 1, '2023-12-23 23:33:17', '2023-12-23 23:33:17');
INSERT INTO `fivers_games` VALUES (472, 3, 1, '15_golden_eggs', '15 GOLDEN EGGS', 'fivers/15_golden_eggs.png', 0, 1, '2023-12-23 23:33:17', '2023-12-23 23:33:17');
INSERT INTO `fivers_games` VALUES (473, 3, 1, 'thunder_of_olympus', 'THUNDER OF OLYMPUS', 'fivers/thunder_of_olympus.jpe', 0, 1, '2023-12-23 23:33:18', '2023-12-23 23:33:18');
INSERT INTO `fivers_games` VALUES (474, 3, 1, 'eye_of_gold', 'EYE OF GOLD', 'fivers/eye_of_gold.jpg', 0, 1, '2023-12-23 23:33:18', '2023-12-23 23:33:18');
INSERT INTO `fivers_games` VALUES (475, 3, 1, 'tiger_stone', 'TIGER STONE', 'fivers/tiger_stone.jpg', 0, 1, '2023-12-23 23:33:19', '2023-12-23 23:33:19');
INSERT INTO `fivers_games` VALUES (476, 3, 1, 'magic_apple', 'MAGIC APPLE', 'fivers/magic_apple.jpg', 0, 1, '2023-12-23 23:33:19', '2023-12-23 23:33:19');
INSERT INTO `fivers_games` VALUES (477, 3, 1, 'wolf_saga', 'WOLF SAGA', 'fivers/wolf_saga.png', 0, 1, '2023-12-23 23:33:20', '2023-12-23 23:33:20');
INSERT INTO `fivers_games` VALUES (478, 3, 1, 'magic_ball', 'MAGIC BALL', 'fivers/magic_ball.jpg', 0, 1, '2023-12-23 23:33:20', '2023-12-23 23:33:20');
INSERT INTO `fivers_games` VALUES (479, 3, 1, 'scarab_boost', 'SCARAB BOOST', 'fivers/scarab_boost.jpg', 0, 1, '2023-12-23 23:33:20', '2023-12-23 23:33:20');
INSERT INTO `fivers_games` VALUES (480, 3, 1, 'wukong', 'WUKONG', 'fivers/wukong.jpg', 0, 1, '2023-12-23 23:33:21', '2023-12-23 23:33:21');
INSERT INTO `fivers_games` VALUES (481, 3, 1, 'pearl_diver', 'PEARL DIVER', 'fivers/pearl_diver.jpg', 0, 1, '2023-12-23 23:33:21', '2023-12-23 23:33:21');
INSERT INTO `fivers_games` VALUES (482, 3, 1, '3_coins_egypt', '3 COINS EGYPT', 'fivers/3_coins_egypt.jpg', 0, 1, '2023-12-23 23:33:22', '2023-12-23 23:33:22');
INSERT INTO `fivers_games` VALUES (483, 3, 1, 'ganesha_boost', 'GANESHA BOOST', 'fivers/ganesha_boost.jpg', 0, 1, '2023-12-23 23:33:22', '2023-12-23 23:33:22');
INSERT INTO `fivers_games` VALUES (484, 3, 1, 'wolf_night', 'WOLF NIGHT', 'fivers/wolf_night.jpg', 0, 1, '2023-12-23 23:33:23', '2023-12-23 23:33:23');
INSERT INTO `fivers_games` VALUES (485, 3, 1, 'book_of_wizard', 'BOOK OF WIZARD', 'fivers/book_of_wizard.jpg', 0, 1, '2023-12-23 23:33:23', '2023-12-23 23:33:23');
INSERT INTO `fivers_games` VALUES (486, 3, 1, 'lord_fortune_2', 'LORD FORTUNE 2', 'fivers/lord_fortune_2.jpg', 0, 1, '2023-12-23 23:33:24', '2023-12-23 23:33:24');
INSERT INTO `fivers_games` VALUES (487, 3, 1, 'gold_express', 'GOLD EXPRESS', 'fivers/gold_express.jpg', 0, 1, '2023-12-23 23:33:24', '2023-12-23 23:33:24');
INSERT INTO `fivers_games` VALUES (488, 3, 1, 'book_of_wizard_crystal', 'BOOK OF WIZARD CRYSTAL', 'fivers/book_of_wizard_crystal.jpg', 0, 1, '2023-12-23 23:33:25', '2023-12-23 23:33:25');
INSERT INTO `fivers_games` VALUES (489, 3, 1, 'pearl_diver_2', 'PEARL DIVER 2', 'fivers/pearl_diver_2.jpg', 0, 1, '2023-12-23 23:33:25', '2023-12-23 23:33:25');
INSERT INTO `fivers_games` VALUES (490, 3, 1, 'sun_of_egypt_3', 'SUN OF EGYPT 3', 'fivers/sun_of_egypt_3.jpg', 0, 1, '2023-12-23 23:33:26', '2023-12-23 23:33:26');
INSERT INTO `fivers_games` VALUES (491, 3, 1, 'caishen_wealth', 'CAISHEN WEALTH', 'fivers/caishen_wealth.jpg', 0, 1, '2023-12-23 23:33:26', '2023-12-23 23:33:26');
INSERT INTO `fivers_games` VALUES (492, 3, 1, 'aztec_fire', 'AZTEC FIRE', 'fivers/aztec_fire.jpg', 0, 1, '2023-12-23 23:33:27', '2023-12-23 23:33:27');
INSERT INTO `fivers_games` VALUES (493, 4, 1, 'hand_of_gold', 'HAND OF GOLD', 'fivers/hand_of_gold.png', 0, 1, '2023-12-23 23:33:29', '2023-12-23 23:33:29');
INSERT INTO `fivers_games` VALUES (494, 4, 1, 'legend_of_cleopatra', 'LEGEND OF CLEOPATRA', 'fivers/legend_of_cleopatra.jpg', 0, 1, '2023-12-23 23:33:29', '2023-12-23 23:33:29');
INSERT INTO `fivers_games` VALUES (495, 4, 1, '40_joker_staxx', '40 JOKER STAXX', 'fivers/40_joker_staxx.png', 0, 1, '2023-12-23 23:33:30', '2023-12-23 23:33:30');
INSERT INTO `fivers_games` VALUES (496, 4, 1, 'burning_wins', 'BURNING WINS', 'fivers/burning_wins.png', 0, 1, '2023-12-23 23:33:30', '2023-12-23 23:33:30');
INSERT INTO `fivers_games` VALUES (497, 4, 1, 'book_of_gold', 'BOOK OF GOLD', 'fivers/book_of_gold.png', 0, 1, '2023-12-23 23:33:31', '2023-12-23 23:33:31');
INSERT INTO `fivers_games` VALUES (498, 4, 1, '100_joker_staxx', '100 JOKER STAXX', 'fivers/100_joker_staxx.png', 0, 1, '2023-12-23 23:33:31', '2023-12-23 23:33:31');
INSERT INTO `fivers_games` VALUES (499, 4, 1, 'book_of_gold_classic', 'BOOK OF GOLD CLASSIC', 'fivers/book_of_gold_classic.png', 0, 1, '2023-12-23 23:33:32', '2023-12-23 23:33:32');
INSERT INTO `fivers_games` VALUES (500, 4, 1, 'book_of_gold_multichance', 'BOOK OF GOLD MULTICHANCE', 'fivers/book_of_gold_multichance.png', 0, 1, '2023-12-23 23:33:32', '2023-12-23 23:33:32');
INSERT INTO `fivers_games` VALUES (501, 4, 1, 'buffalo_xmas', 'BUFFALO XMAS', 'fivers/buffalo_xmas.png', 0, 1, '2023-12-23 23:33:33', '2023-12-23 23:33:33');
INSERT INTO `fivers_games` VALUES (502, 5, 1, '67', 'Golden eggs', 'fivers/67.png', 0, 1, '2023-12-23 23:33:35', '2023-12-23 23:33:35');
INSERT INTO `fivers_games` VALUES (503, 5, 1, '161', 'Hercules', 'fivers/161.png', 0, 1, '2023-12-23 23:33:35', '2023-12-23 23:33:35');
INSERT INTO `fivers_games` VALUES (504, 5, 1, '16', 'Super 5', 'fivers/16.png', 0, 1, '2023-12-23 23:33:36', '2023-12-23 23:33:36');
INSERT INTO `fivers_games` VALUES (505, 5, 1, '72', 'Happy Rich Year', 'fivers/72.png', 0, 1, '2023-12-23 23:33:36', '2023-12-23 23:33:36');
INSERT INTO `fivers_games` VALUES (506, 5, 1, '1', 'Fruit King', 'fivers/1.png', 0, 1, '2023-12-23 23:33:37', '2023-12-23 23:33:37');
INSERT INTO `fivers_games` VALUES (507, 5, 1, '163', 'Neja Advent', 'fivers/163.png', 0, 1, '2023-12-23 23:33:37', '2023-12-23 23:33:37');
INSERT INTO `fivers_games` VALUES (508, 5, 1, '26', '777', 'fivers/26.png', 0, 1, '2023-12-23 23:33:38', '2023-12-23 23:33:38');
INSERT INTO `fivers_games` VALUES (509, 5, 1, '50', 'Good fortune', 'fivers/50.png', 0, 1, '2023-12-23 23:33:38', '2023-12-23 23:33:38');
INSERT INTO `fivers_games` VALUES (510, 5, 1, '31', 'God of war', 'fivers/31.png', 0, 1, '2023-12-23 23:33:39', '2023-12-23 23:33:39');
INSERT INTO `fivers_games` VALUES (511, 5, 1, '64', 'Zeus', 'fivers/64.png', 0, 1, '2023-12-23 23:33:39', '2023-12-23 23:33:39');
INSERT INTO `fivers_games` VALUES (512, 5, 1, '69', 'Pasaycen', 'fivers/69.png', 0, 1, '2023-12-23 23:33:39', '2023-12-23 23:33:39');
INSERT INTO `fivers_games` VALUES (513, 5, 1, '89', 'Thor', 'fivers/89.png', 0, 1, '2023-12-23 23:33:40', '2023-12-23 23:33:40');
INSERT INTO `fivers_games` VALUES (514, 5, 1, '46', 'Wolf moon', 'fivers/46.png', 0, 1, '2023-12-23 23:33:40', '2023-12-23 23:33:40');
INSERT INTO `fivers_games` VALUES (515, 5, 1, '139', 'Fire chibi', 'fivers/139.png', 0, 1, '2023-12-23 23:33:41', '2023-12-23 23:33:41');
INSERT INTO `fivers_games` VALUES (516, 5, 1, '15', 'Gu Gu Gu', 'fivers/15.png', 0, 1, '2023-12-23 23:33:41', '2023-12-23 23:33:41');
INSERT INTO `fivers_games` VALUES (517, 5, 1, '140', 'Fire Chibi 2', 'fivers/140.png', 0, 1, '2023-12-23 23:33:42', '2023-12-23 23:33:42');
INSERT INTO `fivers_games` VALUES (518, 5, 1, '8', 'So Sweet', 'fivers/8.png', 0, 1, '2023-12-23 23:33:42', '2023-12-23 23:33:42');
INSERT INTO `fivers_games` VALUES (519, 5, 1, '147', 'Flower fortune', 'fivers/147.png', 0, 1, '2023-12-23 23:33:43', '2023-12-23 23:33:43');
INSERT INTO `fivers_games` VALUES (520, 5, 1, '113', 'Flying Kai Shen', 'fivers/113.png', 0, 1, '2023-12-23 23:33:44', '2023-12-23 23:33:44');
INSERT INTO `fivers_games` VALUES (521, 5, 1, '58', 'Gu Gu Gu 2', 'fivers/58.png', 0, 1, '2023-12-23 23:33:45', '2023-12-23 23:33:45');
INSERT INTO `fivers_games` VALUES (522, 5, 1, '128', 'Wheel money', 'fivers/128.png', 0, 1, '2023-12-23 23:33:45', '2023-12-23 23:33:45');
INSERT INTO `fivers_games` VALUES (523, 5, 1, '5', 'Mr Rich', 'fivers/5.png', 0, 1, '2023-12-23 23:33:46', '2023-12-23 23:33:46');
INSERT INTO `fivers_games` VALUES (524, 5, 1, '180', 'Gu Gu Gu 3', 'fivers/180.png', 0, 1, '2023-12-23 23:33:46', '2023-12-23 23:33:46');
INSERT INTO `fivers_games` VALUES (525, 5, 1, '118', 'SkullSkull', 'fivers/118.png', 0, 1, '2023-12-23 23:33:47', '2023-12-23 23:33:47');
INSERT INTO `fivers_games` VALUES (526, 5, 1, '148', 'Fortune totem', 'fivers/148.png', 0, 1, '2023-12-23 23:33:47', '2023-12-23 23:33:47');
INSERT INTO `fivers_games` VALUES (527, 5, 1, '144', 'Diamond treasure', 'fivers/144.png', 0, 1, '2023-12-23 23:33:48', '2023-12-23 23:33:48');
INSERT INTO `fivers_games` VALUES (528, 5, 1, '19', 'Hot spin', 'fivers/19.png', 0, 1, '2023-12-23 23:33:48', '2023-12-23 23:33:48');
INSERT INTO `fivers_games` VALUES (529, 5, 1, '112', 'Pyramid radar', 'fivers/112.png', 0, 1, '2023-12-23 23:33:48', '2023-12-23 23:33:48');
INSERT INTO `fivers_games` VALUES (530, 5, 1, '160', 'Pa Kai Shen2', 'fivers/160.png', 0, 1, '2023-12-23 23:33:49', '2023-12-23 23:33:49');
INSERT INTO `fivers_games` VALUES (531, 5, 1, '132', 'Miou', 'fivers/132.png', 0, 1, '2023-12-23 23:33:49', '2023-12-23 23:33:49');
INSERT INTO `fivers_games` VALUES (532, 5, 1, '47', 'Pharaoh gold', 'fivers/47.png', 0, 1, '2023-12-23 23:33:50', '2023-12-23 23:33:50');
INSERT INTO `fivers_games` VALUES (533, 5, 1, '13', 'Sakura legend', 'fivers/13.png', 0, 1, '2023-12-23 23:33:50', '2023-12-23 23:33:50');
INSERT INTO `fivers_games` VALUES (534, 5, 1, '34', 'Gopher\'s War', 'fivers/34.png', 0, 1, '2023-12-23 23:33:51', '2023-12-23 23:33:51');
INSERT INTO `fivers_games` VALUES (535, 5, 1, '59', 'Summer mood', 'fivers/59.png', 0, 1, '2023-12-23 23:33:51', '2023-12-23 23:33:51');
INSERT INTO `fivers_games` VALUES (536, 5, 1, '76', 'Won won won', 'fivers/76.png', 0, 1, '2023-12-23 23:33:52', '2023-12-23 23:33:52');
INSERT INTO `fivers_games` VALUES (537, 5, 1, '95', 'Football boots', 'fivers/95.png', 0, 1, '2023-12-23 23:33:52', '2023-12-23 23:33:52');
INSERT INTO `fivers_games` VALUES (538, 5, 1, '57', 'The Beast War', 'fivers/57.png', 0, 1, '2023-12-23 23:33:53', '2023-12-23 23:33:53');
INSERT INTO `fivers_games` VALUES (539, 5, 1, '17', 'Great lion', 'fivers/17.png', 0, 1, '2023-12-23 23:33:53', '2023-12-23 23:33:53');
INSERT INTO `fivers_games` VALUES (540, 5, 1, '20', '888', 'fivers/20.png', 0, 1, '2023-12-23 23:33:54', '2023-12-23 23:33:54');
INSERT INTO `fivers_games` VALUES (541, 5, 1, '182', 'Thor 2', 'fivers/182.png', 0, 1, '2023-12-23 23:33:54', '2023-12-23 23:33:54');
INSERT INTO `fivers_games` VALUES (542, 5, 1, '66', 'Fire 777', 'fivers/66.png', 0, 1, '2023-12-23 23:33:55', '2023-12-23 23:33:55');
INSERT INTO `fivers_games` VALUES (543, 5, 1, '2', 'God of Chess', 'fivers/2.png', 0, 1, '2023-12-23 23:33:55', '2023-12-23 23:33:55');
INSERT INTO `fivers_games` VALUES (544, 5, 1, '21', 'Big wolf', 'fivers/21.png', 0, 1, '2023-12-23 23:33:56', '2023-12-23 23:33:56');
INSERT INTO `fivers_games` VALUES (545, 5, 1, '197', 'Dragon\'s Treasure', 'fivers/197.png', 0, 1, '2023-12-23 23:33:56', '2023-12-23 23:33:56');
INSERT INTO `fivers_games` VALUES (546, 5, 1, '208', 'Money tree', 'fivers/208.png', 0, 1, '2023-12-23 23:33:57', '2023-12-23 23:33:57');
INSERT INTO `fivers_games` VALUES (547, 5, 1, '212', 'Burning Si-Yow', 'fivers/212.png', 0, 1, '2023-12-23 23:33:58', '2023-12-23 23:33:58');
INSERT INTO `fivers_games` VALUES (548, 5, 1, '214', 'Ninja raccoon', 'fivers/214.png', 0, 1, '2023-12-23 23:33:58', '2023-12-23 23:33:58');
INSERT INTO `fivers_games` VALUES (549, 5, 1, '218', 'Dollar night', 'fivers/218.png', 0, 1, '2023-12-23 23:33:58', '2023-12-23 23:33:58');
INSERT INTO `fivers_games` VALUES (550, 6, 1, 'greatwall', 'The Great Wall Treasure', 'fivers/greatwall.png', 0, 1, '2023-12-23 23:34:00', '2023-12-23 23:34:00');
INSERT INTO `fivers_games` VALUES (551, 6, 1, 'chinesenewyear', 'Chinese New Year', 'fivers/chinesenewyear.png', 0, 1, '2023-12-23 23:34:01', '2023-12-23 23:34:01');
INSERT INTO `fivers_games` VALUES (552, 6, 1, 'jewellerystore', 'Jewelry store', 'fivers/jewellerystore.png', 0, 1, '2023-12-23 23:34:01', '2023-12-23 23:34:01');
INSERT INTO `fivers_games` VALUES (553, 6, 1, 'redcliff', 'Red cliff', 'fivers/redcliff.png', 0, 1, '2023-12-23 23:34:02', '2023-12-23 23:34:02');
INSERT INTO `fivers_games` VALUES (554, 6, 1, 'ElvenPrincesses', 'Elven Princess', 'fivers/ElvenPrincesses.png', 0, 1, '2023-12-23 23:34:02', '2023-12-23 23:34:02');
INSERT INTO `fivers_games` VALUES (555, 6, 1, 'robinzon', 'Robinson', 'fivers/robinzon.png', 0, 1, '2023-12-23 23:34:03', '2023-12-23 23:34:03');
INSERT INTO `fivers_games` VALUES (556, 6, 1, 'aeronauts', 'Aeronauts', 'fivers/aeronauts.png', 0, 1, '2023-12-23 23:34:03', '2023-12-23 23:34:03');
INSERT INTO `fivers_games` VALUES (557, 6, 1, 'monsterlab', 'Monster rap', 'fivers/monsterlab.png', 0, 1, '2023-12-23 23:34:04', '2023-12-23 23:34:04');
INSERT INTO `fivers_games` VALUES (558, 6, 1, 'TriptotheFuture', 'Trip to the Future', 'fivers/TriptotheFuture.jpg', 0, 1, '2023-12-23 23:34:04', '2023-12-23 23:34:04');
INSERT INTO `fivers_games` VALUES (559, 6, 1, 'NukeWorld', 'Nook World', 'fivers/NukeWorld.jpg', 0, 1, '2023-12-23 23:34:05', '2023-12-23 23:34:05');
INSERT INTO `fivers_games` VALUES (560, 6, 1, 'legendofkaan', 'Legend of Khan', 'fivers/legendofkaan.png', 0, 1, '2023-12-23 23:34:05', '2023-12-23 23:34:05');
INSERT INTO `fivers_games` VALUES (561, 6, 1, 'LivingTales', 'Night of the Living Tales', 'fivers/LivingTales.jpg', 0, 1, '2023-12-23 23:34:06', '2023-12-23 23:34:06');
INSERT INTO `fivers_games` VALUES (562, 6, 1, 'IceMania', 'Ice mania', 'fivers/IceMania.jpg', 0, 1, '2023-12-23 23:34:06', '2023-12-23 23:34:06');
INSERT INTO `fivers_games` VALUES (563, 6, 1, 'ValleyOfDreams', 'Valley of Dreams', 'fivers/ValleyOfDreams.png', 0, 1, '2023-12-23 23:34:06', '2023-12-23 23:34:06');
INSERT INTO `fivers_games` VALUES (564, 6, 1, 'FruitNova', 'Fruit Nova', 'fivers/FruitNova.jpg', 0, 1, '2023-12-23 23:34:07', '2023-12-23 23:34:07');
INSERT INTO `fivers_games` VALUES (565, 6, 1, 'TreeOfLight', 'Tree of light', 'fivers/TreeOfLight.png', 0, 1, '2023-12-23 23:34:07', '2023-12-23 23:34:07');
INSERT INTO `fivers_games` VALUES (566, 6, 1, 'TempleOfDead', 'Temple of the dead', 'fivers/TempleOfDead.png', 0, 1, '2023-12-23 23:34:08', '2023-12-23 23:34:08');
INSERT INTO `fivers_games` VALUES (567, 6, 1, 'RunesOfDestiny', 'Runes of Destiny', 'fivers/RunesOfDestiny.png', 0, 1, '2023-12-23 23:34:08', '2023-12-23 23:34:08');
INSERT INTO `fivers_games` VALUES (568, 6, 1, 'EllensFortune', 'Ellen Fortune', 'fivers/EllensFortune.jpg', 0, 1, '2023-12-23 23:34:09', '2023-12-23 23:34:09');
INSERT INTO `fivers_games` VALUES (569, 6, 1, 'UnlimitedWishes', 'Unlimited Wishes', 'fivers/UnlimitedWishes.jpg', 0, 1, '2023-12-23 23:34:09', '2023-12-23 23:34:09');
INSERT INTO `fivers_games` VALUES (570, 6, 1, 'FoodFeast', 'Food fist', 'fivers/FoodFeast.jpg', 0, 1, '2023-12-23 23:34:10', '2023-12-23 23:34:10');
INSERT INTO `fivers_games` VALUES (571, 6, 1, 'EpicLegends', 'Epic legends', 'fivers/EpicLegends.jpg', 0, 1, '2023-12-23 23:34:10', '2023-12-23 23:34:10');
INSERT INTO `fivers_games` VALUES (572, 6, 1, 'SweetSugar', 'Sweet sugar', 'fivers/SweetSugar.png', 0, 1, '2023-12-23 23:34:11', '2023-12-23 23:34:11');
INSERT INTO `fivers_games` VALUES (573, 6, 1, 'CycleofLuck', 'Cycle of Luck', 'fivers/CycleofLuck.jpg', 0, 1, '2023-12-23 23:34:11', '2023-12-23 23:34:11');
INSERT INTO `fivers_games` VALUES (574, 6, 1, 'GangsterNight', 'Gangster night', 'fivers/GangsterNight.jpg', 0, 1, '2023-12-23 23:34:12', '2023-12-23 23:34:12');
INSERT INTO `fivers_games` VALUES (575, 6, 1, 'GoldOfSirens', 'Gold of sirens', 'fivers/GoldOfSirens.jpg', 0, 1, '2023-12-23 23:34:12', '2023-12-23 23:34:12');
INSERT INTO `fivers_games` VALUES (576, 6, 1, 'BloodyBrilliant', 'Bloody brilliant', 'fivers/BloodyBrilliant.jpg', 0, 1, '2023-12-23 23:34:13', '2023-12-23 23:34:13');
INSERT INTO `fivers_games` VALUES (577, 6, 1, 'TempleOfDeadBonusBuy', 'Temple of the Dead BB', 'fivers/TempleOfDeadBonusBuy.jpg', 0, 1, '2023-12-23 23:34:13', '2023-12-23 23:34:13');
INSERT INTO `fivers_games` VALUES (578, 6, 1, 'ShadowOfLuxor', 'Shadow of Luxor', 'fivers/ShadowOfLuxor.jpg', 0, 1, '2023-12-23 23:34:14', '2023-12-23 23:34:14');
INSERT INTO `fivers_games` VALUES (579, 6, 1, 'CycleofLuckBonusBuy', 'Cycle of Luck BB', 'fivers/CycleofLuckBonusBuy.jpg', 0, 1, '2023-12-23 23:34:14', '2023-12-23 23:34:14');
INSERT INTO `fivers_games` VALUES (580, 6, 1, 'AnubisMoon', 'Anubis moon', 'fivers/AnubisMoon.jpg', 0, 1, '2023-12-23 23:34:14', '2023-12-23 23:34:14');
INSERT INTO `fivers_games` VALUES (581, 6, 1, 'FruitDisco', 'Fruit disco', 'fivers/FruitDisco.jpg', 0, 1, '2023-12-23 23:34:15', '2023-12-23 23:34:15');
INSERT INTO `fivers_games` VALUES (582, 6, 1, 'FruitSuperNova30', 'Fruit Super Nova 30', 'fivers/FruitSuperNova30.jpg', 0, 1, '2023-12-23 23:34:15', '2023-12-23 23:34:15');
INSERT INTO `fivers_games` VALUES (583, 6, 1, 'CurseOfThePharaoh', 'Curse of the Pharaoh', 'fivers/CurseOfThePharaoh.jpg', 0, 1, '2023-12-23 23:34:16', '2023-12-23 23:34:16');
INSERT INTO `fivers_games` VALUES (584, 6, 1, 'GoldOfSirensBonusBuy', 'Gold of Sirens BB', 'fivers/GoldOfSirensBonusBuy.jpg', 0, 1, '2023-12-23 23:34:16', '2023-12-23 23:34:16');
INSERT INTO `fivers_games` VALUES (585, 6, 1, 'FruitSuperNova60', 'Fruit Super Nova 60', 'fivers/FruitSuperNova60.jpg', 0, 1, '2023-12-23 23:34:17', '2023-12-23 23:34:17');
INSERT INTO `fivers_games` VALUES (586, 6, 1, 'CurseofthePharaohBonusBuy', 'Curse of the Pharaoh BB', 'fivers/CurseofthePharaohBonusBuy.jpg', 0, 1, '2023-12-23 23:34:17', '2023-12-23 23:34:17');
INSERT INTO `fivers_games` VALUES (587, 6, 1, 'FruitSuperNova100', 'Fruit Super Nova 100', 'fivers/FruitSuperNova100.jpg', 0, 1, '2023-12-23 23:34:18', '2023-12-23 23:34:18');
INSERT INTO `fivers_games` VALUES (588, 6, 1, 'ChristmasReach', 'Christmas lychee', 'fivers/ChristmasReach.jpg', 0, 1, '2023-12-23 23:34:18', '2023-12-23 23:34:18');
INSERT INTO `fivers_games` VALUES (589, 6, 1, 'FruitSuperNova80', 'Whoft Super Nova 80', 'fivers/FruitSuperNova80.jpg', 0, 1, '2023-12-23 23:34:19', '2023-12-23 23:34:19');
INSERT INTO `fivers_games` VALUES (590, 6, 1, 'DragonsTavern', 'Dragon\'s Tavern', 'fivers/DragonsTavern.jpg', 0, 1, '2023-12-23 23:34:19', '2023-12-23 23:34:19');
INSERT INTO `fivers_games` VALUES (591, 6, 1, 'ChristmasReachBonusBuy', 'Christmas Riti BB', 'fivers/ChristmasReachBonusBuy.jpg', 0, 1, '2023-12-23 23:34:20', '2023-12-23 23:34:20');
INSERT INTO `fivers_games` VALUES (592, 6, 1, 'WildOverlords', 'Wild overlord', 'fivers/WildOverlords.jpg', 0, 1, '2023-12-23 23:34:20', '2023-12-23 23:34:20');
INSERT INTO `fivers_games` VALUES (593, 6, 1, 'DragonsTavernBonusBuy', 'Dragon\'s Tavern BB', 'fivers/DragonsTavernBonusBuy.jpg', 0, 1, '2023-12-23 23:34:21', '2023-12-23 23:34:21');
INSERT INTO `fivers_games` VALUES (594, 6, 1, 'BudaiReels', 'Budai reels', 'fivers/BudaiReels.jpg', 0, 1, '2023-12-23 23:34:21', '2023-12-23 23:34:21');
INSERT INTO `fivers_games` VALUES (595, 6, 1, 'BudaiReelsBonusBuy', 'Budai Lil\'s BB', 'fivers/BudaiReelsBonusBuy.jpeg', 0, 1, '2023-12-23 23:34:22', '2023-12-23 23:34:22');
INSERT INTO `fivers_games` VALUES (596, 6, 1, 'MoneyMinter', 'Money minter', 'fivers/MoneyMinter.jpeg', 0, 1, '2023-12-23 23:34:22', '2023-12-23 23:34:22');
INSERT INTO `fivers_games` VALUES (597, 6, 1, 'JuicyGems', 'Watch gem', 'fivers/JuicyGems.jpg', 0, 1, '2023-12-23 23:34:23', '2023-12-23 23:34:23');
INSERT INTO `fivers_games` VALUES (598, 6, 1, 'JuicyGemsBB', 'Watch Gem BB', 'fivers/JuicyGemsBB.jpg', 0, 1, '2023-12-23 23:34:23', '2023-12-23 23:34:23');
INSERT INTO `fivers_games` VALUES (599, 6, 1, 'TheGreatestCatch', 'The Greatest Catch', 'fivers/TheGreatestCatch.jpg', 0, 1, '2023-12-23 23:34:23', '2023-12-23 23:34:23');
INSERT INTO `fivers_games` VALUES (600, 6, 1, 'TheGreatestCatchBonusBuy', 'The Greatest Catch BB', 'fivers/TheGreatestCatchBonusBuy.jpg', 0, 1, '2023-12-23 23:34:24', '2023-12-23 23:34:24');
INSERT INTO `fivers_games` VALUES (601, 6, 1, 'TreeOfLightBB', 'Tree of Light BB', 'fivers/TreeOfLightBB.jpg', 0, 1, '2023-12-23 23:34:24', '2023-12-23 23:34:24');
INSERT INTO `fivers_games` VALUES (602, 6, 1, 'WolfHiding', 'Wolf Hiding', 'fivers/WolfHiding.jpg', 0, 1, '2023-12-23 23:34:25', '2023-12-23 23:34:25');
INSERT INTO `fivers_games` VALUES (603, 6, 1, 'CaminoDeChili', 'Camino de Chili', 'fivers/CaminoDeChili.jpg', 0, 1, '2023-12-23 23:34:25', '2023-12-23 23:34:25');
INSERT INTO `fivers_games` VALUES (604, 6, 1, 'CandyDreamsSweetPlanet', 'candy dreams', 'fivers/CandyDreamsSweetPlanet.jpg', 0, 1, '2023-12-23 23:34:26', '2023-12-23 23:34:26');
INSERT INTO `fivers_games` VALUES (605, 6, 1, 'WildOverlordsBonusBuy', 'Wild Overlord BB', 'fivers/WildOverlordsBonusBuy.jpg', 0, 1, '2023-12-23 23:34:26', '2023-12-23 23:34:26');
INSERT INTO `fivers_games` VALUES (606, 6, 1, 'TempleOfThunder', 'Temple of Thunder', 'fivers/TempleOfThunder.jpg', 0, 1, '2023-12-23 23:34:27', '2023-12-23 23:34:27');
INSERT INTO `fivers_games` VALUES (607, 7, 1, 'WildTriads', 'WildTriads', 'fivers/WildTriads.png', 0, 1, '2023-12-23 23:34:29', '2023-12-23 23:34:29');
INSERT INTO `fivers_games` VALUES (608, 7, 1, 'GoldenDragon', 'Golden Dragon', 'fivers/GoldenDragon.png', 0, 1, '2023-12-23 23:34:29', '2023-12-23 23:34:29');
INSERT INTO `fivers_games` VALUES (609, 7, 1, 'ReelsOfFortune', 'Reels Of Fortune', 'fivers/ReelsOfFortune.png', 0, 1, '2023-12-23 23:34:30', '2023-12-23 23:34:30');
INSERT INTO `fivers_games` VALUES (610, 7, 1, 'GoldenAmazon', 'Golden Amazon', 'fivers/GoldenAmazon.png', 0, 1, '2023-12-23 23:34:30', '2023-12-23 23:34:30');
INSERT INTO `fivers_games` VALUES (611, 7, 1, 'MonkeyLuck', 'MonkeyLuck', 'fivers/MonkeyLuck.png', 0, 1, '2023-12-23 23:34:31', '2023-12-23 23:34:31');
INSERT INTO `fivers_games` VALUES (612, 7, 1, 'LeagueOfChampions', 'League Of Champions', 'fivers/LeagueOfChampions.png', 0, 1, '2023-12-23 23:34:31', '2023-12-23 23:34:31');
INSERT INTO `fivers_games` VALUES (613, 7, 1, 'MadMonkeyH5', 'MadMonkey', 'fivers/MadMonkeyH5.png', 0, 1, '2023-12-23 23:34:32', '2023-12-23 23:34:32');
INSERT INTO `fivers_games` VALUES (614, 7, 1, 'DynastyEmpire', 'Dynasty Empire', 'fivers/DynastyEmpire.png', 0, 1, '2023-12-23 23:34:32', '2023-12-23 23:34:32');
INSERT INTO `fivers_games` VALUES (615, 7, 1, 'SuperKids', 'SuperKids', 'fivers/SuperKids.png', 0, 1, '2023-12-23 23:34:33', '2023-12-23 23:34:33');
INSERT INTO `fivers_games` VALUES (616, 7, 1, 'HotVolcanoH5', 'HotVolcano', 'fivers/HotVolcanoH5.png', 0, 1, '2023-12-23 23:34:33', '2023-12-23 23:34:33');
INSERT INTO `fivers_games` VALUES (617, 7, 1, 'Huluwa', 'Huluwa', 'fivers/Huluwa.png', 0, 1, '2023-12-23 23:34:34', '2023-12-23 23:34:34');
INSERT INTO `fivers_games` VALUES (618, 7, 1, 'LegendOfLinkH5', 'LegendOfLink', 'fivers/LegendOfLinkH5.png', 0, 1, '2023-12-23 23:34:34', '2023-12-23 23:34:34');
INSERT INTO `fivers_games` VALUES (619, 7, 1, 'DetectiveBlackCat', 'DetectiveBlackCat', 'fivers/DetectiveBlackCat.png', 0, 1, '2023-12-23 23:34:35', '2023-12-23 23:34:35');
INSERT INTO `fivers_games` VALUES (620, 7, 1, 'ChilliGoldH5', 'Chilli Gold', 'fivers/ChilliGoldH5.png', 0, 1, '2023-12-23 23:34:35', '2023-12-23 23:34:35');
INSERT INTO `fivers_games` VALUES (621, 7, 1, 'SilverLionH5', 'Silver Lion', 'fivers/SilverLionH5.png', 0, 1, '2023-12-23 23:34:36', '2023-12-23 23:34:36');
INSERT INTO `fivers_games` VALUES (622, 7, 1, 'ThunderingZeus', 'ThunderingZeus', 'fivers/ThunderingZeus.png', 0, 1, '2023-12-23 23:34:36', '2023-12-23 23:34:36');
INSERT INTO `fivers_games` VALUES (623, 7, 1, 'DragonPalaceH5', 'Dragon Palace', 'fivers/DragonPalaceH5.png', 0, 1, '2023-12-23 23:34:36', '2023-12-23 23:34:36');
INSERT INTO `fivers_games` VALUES (624, 7, 1, 'MadMonkey2', 'MadMonkey', 'fivers/MadMonkey2.png', 0, 1, '2023-12-23 23:34:37', '2023-12-23 23:34:37');
INSERT INTO `fivers_games` VALUES (625, 7, 1, 'MedusaCurse', 'Medusa Curse', 'fivers/MedusaCurse.png', 0, 1, '2023-12-23 23:34:37', '2023-12-23 23:34:37');
INSERT INTO `fivers_games` VALUES (626, 7, 1, 'BattleHeroes', 'Battle Heroes', 'fivers/BattleHeroes.png', 0, 1, '2023-12-23 23:34:38', '2023-12-23 23:34:38');
INSERT INTO `fivers_games` VALUES (627, 7, 1, 'NeptunesGoldH5', 'Neptunes Gold', 'fivers/NeptunesGoldH5.png', 0, 1, '2023-12-23 23:34:38', '2023-12-23 23:34:38');
INSERT INTO `fivers_games` VALUES (628, 7, 1, 'HeroesNeverDie', 'Heroes Never Die', 'fivers/HeroesNeverDie.png', 0, 1, '2023-12-23 23:34:39', '2023-12-23 23:34:39');
INSERT INTO `fivers_games` VALUES (629, 7, 1, 'WildWildWitch', 'Wild Wild Witch', 'fivers/WildWildWitch.png', 0, 1, '2023-12-23 23:34:39', '2023-12-23 23:34:39');
INSERT INTO `fivers_games` VALUES (630, 7, 1, 'WildKartRacers', 'Wild Kart Racers', 'fivers/WildKartRacers.png', 0, 1, '2023-12-23 23:34:40', '2023-12-23 23:34:40');
INSERT INTO `fivers_games` VALUES (631, 7, 1, 'KingDinosaur', 'KingDinosaur', 'fivers/KingDinosaur.png', 0, 1, '2023-12-23 23:34:40', '2023-12-23 23:34:40');
INSERT INTO `fivers_games` VALUES (632, 7, 1, 'GoldenGenie', 'GoldenGenie', 'fivers/GoldenGenie.png', 0, 1, '2023-12-23 23:34:41', '2023-12-23 23:34:41');
INSERT INTO `fivers_games` VALUES (633, 7, 1, 'UltimateFighter', 'UltimateFighter', 'fivers/UltimateFighter.png', 0, 1, '2023-12-23 23:34:41', '2023-12-23 23:34:41');
INSERT INTO `fivers_games` VALUES (634, 7, 1, 'EverlastingSpins', 'EverlastingSpins', 'fivers/EverlastingSpins.png', 0, 1, '2023-12-23 23:34:42', '2023-12-23 23:34:42');
INSERT INTO `fivers_games` VALUES (635, 7, 1, 'Zoomania', 'Zoomania', 'fivers/Zoomania.png', 0, 1, '2023-12-23 23:34:42', '2023-12-23 23:34:42');
INSERT INTO `fivers_games` VALUES (636, 7, 1, 'LaserCats', 'Laser Cats', 'fivers/LaserCats.png', 0, 1, '2023-12-23 23:34:43', '2023-12-23 23:34:43');
INSERT INTO `fivers_games` VALUES (637, 7, 1, 'DiamondFortune', 'DiamondFortune', 'fivers/DiamondFortune.png', 0, 1, '2023-12-23 23:34:43', '2023-12-23 23:34:43');
INSERT INTO `fivers_games` VALUES (638, 7, 1, 'GoldenClaw', 'GoldenClaw', 'fivers/GoldenClaw.png', 0, 1, '2023-12-23 23:34:44', '2023-12-23 23:34:44');
INSERT INTO `fivers_games` VALUES (639, 7, 1, 'PandaWarrior', 'PandaWarrior', 'fivers/PandaWarrior.png', 0, 1, '2023-12-23 23:34:44', '2023-12-23 23:34:44');
INSERT INTO `fivers_games` VALUES (640, 7, 1, 'RoyalGoldenDragon', 'RoyalGoldenDragon', 'fivers/RoyalGoldenDragon.png', 0, 1, '2023-12-23 23:34:44', '2023-12-23 23:34:44');
INSERT INTO `fivers_games` VALUES (641, 7, 1, 'MegaMaya', 'MegaMaya', 'fivers/MegaMaya.png', 0, 1, '2023-12-23 23:34:45', '2023-12-23 23:34:45');
INSERT INTO `fivers_games` VALUES (642, 7, 1, 'MegaPhoenix', 'MegaPhoenix', 'fivers/MegaPhoenix.png', 0, 1, '2023-12-23 23:34:45', '2023-12-23 23:34:45');
INSERT INTO `fivers_games` VALUES (643, 7, 1, 'DolphinGoldH5', 'DolphinGold', 'fivers/DolphinGoldH5.png', 0, 1, '2023-12-23 23:34:48', '2023-12-23 23:34:48');
INSERT INTO `fivers_games` VALUES (644, 7, 1, 'DragonKingH5', 'DragonKing', 'fivers/DragonKingH5.png', 0, 1, '2023-12-23 23:34:48', '2023-12-23 23:34:48');
INSERT INTO `fivers_games` VALUES (645, 7, 1, 'LuckyPandaH5', 'LuckyPanda', 'fivers/LuckyPandaH5.png', 0, 1, '2023-12-23 23:34:49', '2023-12-23 23:34:49');
INSERT INTO `fivers_games` VALUES (646, 8, 1, 'btball5x20', 'Crazy Basketball', 'fivers/btball5x20.png', 0, 1, '2023-12-23 23:34:51', '2023-12-23 23:34:51');
INSERT INTO `fivers_games` VALUES (647, 8, 1, 'dnp', 'DragonPhoenix Prosper', 'fivers/dnp.png', 0, 1, '2023-12-23 23:34:52', '2023-12-23 23:34:52');
INSERT INTO `fivers_games` VALUES (648, 8, 1, 'crystal', 'Glory of Heroes', 'fivers/crystal.png', 0, 1, '2023-12-23 23:34:53', '2023-12-23 23:34:53');
INSERT INTO `fivers_games` VALUES (649, 8, 1, 'fls', 'FULUSHOU', 'fivers/fls.png', 0, 1, '2023-12-23 23:34:53', '2023-12-23 23:34:53');
INSERT INTO `fivers_games` VALUES (650, 8, 1, 'fourss', 'Four Holy Beasts', 'fivers/fourss.png', 0, 1, '2023-12-23 23:34:54', '2023-12-23 23:34:54');
INSERT INTO `fivers_games` VALUES (651, 8, 1, 'casino', '3D Slot', 'fivers/casino.png', 0, 1, '2023-12-23 23:34:54', '2023-12-23 23:34:54');
INSERT INTO `fivers_games` VALUES (652, 8, 1, 'crazy5x243', 'Crazy GO GO GO', 'fivers/crazy5x243.png', 0, 1, '2023-12-23 23:34:55', '2023-12-23 23:34:55');
INSERT INTO `fivers_games` VALUES (653, 8, 1, 'rocknight', 'RocknRoll Night', 'fivers/rocknight.png', 0, 1, '2023-12-23 23:34:55', '2023-12-23 23:34:55');
INSERT INTO `fivers_games` VALUES (654, 8, 1, 'bluesea', 'Blue Sea', 'fivers/bluesea.png', 0, 1, '2023-12-23 23:34:56', '2023-12-23 23:34:56');
INSERT INTO `fivers_games` VALUES (655, 8, 1, 'circus', 'Crazy Circus', 'fivers/circus.png', 0, 1, '2023-12-23 23:34:56', '2023-12-23 23:34:56');
INSERT INTO `fivers_games` VALUES (656, 8, 1, 'bikini', 'Bikini Party', 'fivers/bikini.png', 0, 1, '2023-12-23 23:34:57', '2023-12-23 23:34:57');
INSERT INTO `fivers_games` VALUES (657, 8, 1, 'foryouth5x25', 'SO YOUNG', 'fivers/foryouth5x25.png', 0, 1, '2023-12-23 23:34:57', '2023-12-23 23:34:57');
INSERT INTO `fivers_games` VALUES (658, 8, 1, 'fourbeauty', 'Four Beauties', 'fivers/fourbeauty.png', 0, 1, '2023-12-23 23:34:58', '2023-12-23 23:34:58');
INSERT INTO `fivers_games` VALUES (659, 8, 1, 'sweethouse', 'Candy House', 'fivers/sweethouse.png', 0, 1, '2023-12-23 23:34:58', '2023-12-23 23:34:58');
INSERT INTO `fivers_games` VALUES (660, 8, 1, 'legend5x25', 'Legend of the King', 'fivers/legend5x25.png', 0, 1, '2023-12-23 23:34:58', '2023-12-23 23:34:58');
INSERT INTO `fivers_games` VALUES (661, 8, 1, 'opera', 'Beijing opera', 'fivers/opera.jpeg', 0, 1, '2023-12-23 23:34:59', '2023-12-23 23:34:59');
INSERT INTO `fivers_games` VALUES (662, 8, 1, 'bigred', 'Big Red', 'fivers/bigred.jpeg', 0, 1, '2023-12-23 23:34:59', '2023-12-23 23:34:59');
INSERT INTO `fivers_games` VALUES (663, 8, 1, 'wrathofthor', 'Wrath of Thor', 'fivers/wrathofthor.png', 0, 1, '2023-12-23 23:35:00', '2023-12-23 23:35:00');
INSERT INTO `fivers_games` VALUES (664, 8, 1, 'boxingarena', 'Boxing Arena', 'fivers/boxingarena.jpeg', 0, 1, '2023-12-23 23:35:00', '2023-12-23 23:35:00');
INSERT INTO `fivers_games` VALUES (665, 8, 1, 'fantasyforest', 'Elf Kingdom', 'fivers/fantasyforest.png', 0, 1, '2023-12-23 23:35:01', '2023-12-23 23:35:01');
INSERT INTO `fivers_games` VALUES (666, 8, 1, 'egyptian', 'Egyptian Empire', 'fivers/egyptian.png', 0, 1, '2023-12-23 23:35:01', '2023-12-23 23:35:01');
INSERT INTO `fivers_games` VALUES (667, 8, 1, 'hotpotfeast', 'Hotpot Feast', 'fivers/hotpotfeast.png', 0, 1, '2023-12-23 23:35:02', '2023-12-23 23:35:02');
INSERT INTO `fivers_games` VALUES (668, 8, 1, 'magician', 'Magician', 'fivers/magician.png', 0, 1, '2023-12-23 23:35:02', '2023-12-23 23:35:02');
INSERT INTO `fivers_games` VALUES (669, 8, 1, 'galaxywars', 'Galaxy Wars', 'fivers/galaxywars.png', 0, 1, '2023-12-23 23:35:03', '2023-12-23 23:35:03');
INSERT INTO `fivers_games` VALUES (670, 8, 1, 'easyrider', 'Easy Rider', 'fivers/easyrider.png', 0, 1, '2023-12-23 23:35:03', '2023-12-23 23:35:03');
INSERT INTO `fivers_games` VALUES (671, 8, 1, 'goldjade5x50', 'Jin Yu Man Tang', 'fivers/goldjade5x50.png', 0, 1, '2023-12-23 23:35:04', '2023-12-23 23:35:04');
INSERT INTO `fivers_games` VALUES (672, 8, 1, 'shokudo', 'shokudo', 'fivers/shokudo.jpeg', 0, 1, '2023-12-23 23:35:04', '2023-12-23 23:35:04');
INSERT INTO `fivers_games` VALUES (673, 8, 1, 'train', 'Treasure Hunt Trip', 'fivers/train.png', 0, 1, '2023-12-23 23:35:05', '2023-12-23 23:35:05');
INSERT INTO `fivers_games` VALUES (674, 8, 1, 'lovefighters', 'Love Fighters', 'fivers/lovefighters.png', 0, 1, '2023-12-23 23:35:05', '2023-12-23 23:35:05');
INSERT INTO `fivers_games` VALUES (675, 8, 1, 'genie', 'Aladdin\'s Wish', 'fivers/genie.png', 0, 1, '2023-12-23 23:35:06', '2023-12-23 23:35:06');
INSERT INTO `fivers_games` VALUES (676, 8, 1, 'garden', 'Little Big Garden', 'fivers/garden.png', 0, 1, '2023-12-23 23:35:06', '2023-12-23 23:35:06');
INSERT INTO `fivers_games` VALUES (677, 8, 1, 'alchemist', 'Crazy Alchemist', 'fivers/alchemist.png', 0, 1, '2023-12-23 23:35:07', '2023-12-23 23:35:07');
INSERT INTO `fivers_games` VALUES (678, 8, 1, 'dinosaur5x25', 'Dinosaur World', 'fivers/dinosaur5x25.png', 0, 1, '2023-12-23 23:35:07', '2023-12-23 23:35:07');
INSERT INTO `fivers_games` VALUES (679, 8, 1, 'tombshadow', 'Tomb Shadow', 'fivers/tombshadow.png', 0, 1, '2023-12-23 23:35:08', '2023-12-23 23:35:08');
INSERT INTO `fivers_games` VALUES (680, 8, 1, 'clash', 'Clash of Three kingdoms', 'fivers/clash.png', 0, 1, '2023-12-23 23:35:08', '2023-12-23 23:35:08');
INSERT INTO `fivers_games` VALUES (681, 8, 1, 'magicbean', 'Magic Bean Legend', 'fivers/magicbean.png', 0, 1, '2023-12-23 23:35:09', '2023-12-23 23:35:09');
INSERT INTO `fivers_games` VALUES (682, 8, 1, 'secretdate', 'Secret Date', 'fivers/secretdate.png', 0, 1, '2023-12-23 23:35:09', '2023-12-23 23:35:09');
INSERT INTO `fivers_games` VALUES (683, 8, 1, 'bacteria', 'Germ Lab', 'fivers/bacteria.png', 0, 1, '2023-12-23 23:35:10', '2023-12-23 23:35:10');
INSERT INTO `fivers_games` VALUES (684, 8, 1, 'baseball', 'Baseball Frenzy', 'fivers/baseball.png', 0, 1, '2023-12-23 23:35:10', '2023-12-23 23:35:10');
INSERT INTO `fivers_games` VALUES (685, 8, 1, 'museum', 'Wondrous Museum', 'fivers/museum.png', 0, 1, '2023-12-23 23:35:10', '2023-12-23 23:35:10');
INSERT INTO `fivers_games` VALUES (686, 8, 1, 'mysticalstones', 'Mystical Stones', 'fivers/mysticalstones.png', 0, 1, '2023-12-23 23:35:11', '2023-12-23 23:35:11');
INSERT INTO `fivers_games` VALUES (687, 8, 1, 'sincity', 'Sin City', 'fivers/sincity.png', 0, 1, '2023-12-23 23:35:12', '2023-12-23 23:35:12');
INSERT INTO `fivers_games` VALUES (688, 8, 1, 'wheel', 'Secrets of The Pentagram', 'fivers/wheel.png', 0, 1, '2023-12-23 23:35:12', '2023-12-23 23:35:12');
INSERT INTO `fivers_games` VALUES (689, 8, 1, 'westwild', 'West Wild', 'fivers/westwild.png', 0, 1, '2023-12-23 23:35:13', '2023-12-23 23:35:13');
INSERT INTO `fivers_games` VALUES (690, 8, 1, 'halloween', 'Witch Winnings', 'fivers/halloween.png', 0, 1, '2023-12-23 23:35:13', '2023-12-23 23:35:13');
INSERT INTO `fivers_games` VALUES (691, 8, 1, 'bloodmoon', 'Blood Wolf legend', 'fivers/bloodmoon.png', 0, 1, '2023-12-23 23:35:14', '2023-12-23 23:35:14');
INSERT INTO `fivers_games` VALUES (692, 8, 1, 'dragonball2', 'Heroes of the East', 'fivers/dragonball2.png', 0, 1, '2023-12-23 23:35:14', '2023-12-23 23:35:14');
INSERT INTO `fivers_games` VALUES (693, 8, 1, 'muaythai', 'Muaythai', 'fivers/muaythai.png', 0, 1, '2023-12-23 23:35:15', '2023-12-23 23:35:15');
INSERT INTO `fivers_games` VALUES (694, 8, 1, 'sailor', 'Sailor Princess', 'fivers/sailor.png', 0, 1, '2023-12-23 23:35:15', '2023-12-23 23:35:15');
INSERT INTO `fivers_games` VALUES (695, 8, 1, 'nightclub', 'Infinity Club', 'fivers/nightclub.png', 0, 1, '2023-12-23 23:35:16', '2023-12-23 23:35:16');
INSERT INTO `fivers_games` VALUES (696, 8, 1, 'nezha', 'Nezha Legend', 'fivers/nezha.png', 0, 1, '2023-12-23 23:35:16', '2023-12-23 23:35:16');
INSERT INTO `fivers_games` VALUES (697, 8, 1, 'bird', 'Bird Island', 'fivers/bird.png', 0, 1, '2023-12-23 23:35:17', '2023-12-23 23:35:17');
INSERT INTO `fivers_games` VALUES (698, 8, 1, 'honor', 'Field Of Honor', 'fivers/honor.png', 0, 1, '2023-12-23 23:35:17', '2023-12-23 23:35:17');
INSERT INTO `fivers_games` VALUES (699, 8, 1, 'train2', 'Treasure Hunt Trip 2', 'fivers/train2.png', 0, 1, '2023-12-23 23:35:18', '2023-12-23 23:35:18');
INSERT INTO `fivers_games` VALUES (700, 8, 1, 'shiningstars', 'ShiningStars', 'fivers/shiningstars.png', 0, 1, '2023-12-23 23:35:18', '2023-12-23 23:35:18');
INSERT INTO `fivers_games` VALUES (701, 8, 1, 'tgow2plus', 'Cai Shen Dao Plus', 'fivers/tgow2plus.png', 0, 1, '2023-12-23 23:35:19', '2023-12-23 23:35:19');
INSERT INTO `fivers_games` VALUES (702, 8, 1, 'peeping', 'Peeping', 'fivers/peeping.png', 0, 1, '2023-12-23 23:35:19', '2023-12-23 23:35:19');
INSERT INTO `fivers_games` VALUES (703, 9, 2, 'piggy-gold', 'Piggy Gold', 'fivers/piggy-gold.png', 0, 1, '2023-12-23 23:35:21', '2024-01-12 17:54:32');
INSERT INTO `fivers_games` VALUES (704, 9, 1, 'ganesha-gold', 'Ganesha Gold', '01HKZR2Y1ENW1AQKVVE218K6DF.jpg', 1, 1, '2023-12-23 23:35:21', '2024-01-12 18:08:44');
INSERT INTO `fivers_games` VALUES (705, 9, 1, 'jungle-delight', 'Jungle Delight', '01HKZQQ8J0DC6NTQA6A57JJQ8N.jpg', 1, 1, '2023-12-23 23:35:22', '2024-01-12 18:02:21');
INSERT INTO `fivers_games` VALUES (706, 9, 1, 'double-fortune', 'Double Fortune', 'fivers/double-fortune.png', 0, 1, '2023-12-23 23:35:23', '2023-12-23 23:35:23');
INSERT INTO `fivers_games` VALUES (707, 9, 1, 'the-great-icescape', 'The Great Icescape', 'fivers/the-great-icescape.png', 0, 1, '2023-12-23 23:35:23', '2023-12-23 23:35:23');
INSERT INTO `fivers_games` VALUES (708, 9, 1, 'captains-bounty', 'Captain\'s Bounty', '01HKZQC05QDGNBRNY1MH24BHGR.jpg', 1, 1, '2023-12-23 23:35:24', '2024-01-12 17:56:12');
INSERT INTO `fivers_games` VALUES (709, 9, 2, 'leprechaun-riches', 'Leprechaun Riches', 'fivers/leprechaun-riches.png', 0, 1, '2023-12-23 23:35:24', '2024-01-12 17:58:28');
INSERT INTO `fivers_games` VALUES (710, 9, 1, 'mahjong-ways', 'Mahjong Ways', 'fivers/mahjong-ways.png', 0, 1, '2023-12-23 23:35:25', '2023-12-23 23:35:25');
INSERT INTO `fivers_games` VALUES (711, 9, 1, 'fortune-mouse', 'Fortune Mouse', '01HKZQHQ232Z1KC1W7YGR9TG8Z.png', 1, 1, '2023-12-23 23:35:25', '2024-01-12 18:00:24');
INSERT INTO `fivers_games` VALUES (712, 9, 1, 'gem-saviour-conquest', 'Gem Saviour Conquest', 'fivers/gem-saviour-conquest.png', 0, 1, '2023-12-23 23:35:26', '2023-12-23 23:35:26');
INSERT INTO `fivers_games` VALUES (713, 9, 1, 'candy-burst', 'Candy Burst', 'fivers/candy-burst.png', 0, 1, '2023-12-23 23:35:26', '2023-12-23 23:35:26');
INSERT INTO `fivers_games` VALUES (714, 9, 1, 'bikini-paradise', 'Bikini Paradise', 'fivers/bikini-paradise.png', 0, 1, '2023-12-23 23:35:27', '2023-12-23 23:35:27');
INSERT INTO `fivers_games` VALUES (715, 9, 1, 'mahjong-ways2', 'Mahjong Ways 2', 'fivers/mahjong-ways2.png', 0, 1, '2023-12-23 23:35:27', '2023-12-23 23:35:27');
INSERT INTO `fivers_games` VALUES (716, 9, 1, 'ganesha-fortune', 'Ganesha Fortune', '01HKZQJBCZMKF7MH9DF2F5F6EW.jpg', 1, 1, '2023-12-23 23:35:28', '2024-01-12 17:59:40');
INSERT INTO `fivers_games` VALUES (717, 9, 1, 'phoenix-rises', 'Phoenix Rises', '01HKZR009S8AVDEK8DAPXT1RGS.png', 1, 1, '2023-12-23 23:35:28', '2024-01-12 18:07:08');
INSERT INTO `fivers_games` VALUES (718, 9, 1, 'wild-fireworks', 'Wild Fireworks', 'fivers/wild-fireworks.png', 0, 1, '2023-12-23 23:35:29', '2023-12-23 23:35:29');
INSERT INTO `fivers_games` VALUES (719, 9, 1, 'treasures-aztec', 'Treasures of Aztec', '01HKZR025VD9DE907SD9K8C5WE.png', 0, 1, '2023-12-23 23:35:29', '2024-01-12 18:09:12');
INSERT INTO `fivers_games` VALUES (720, 9, 1, 'queen-bounty', 'Queen of Bounty', '01HKZR04Q00A4H2HYTP0BEHN0A.png', 1, 1, '2023-12-23 23:35:30', '2024-01-12 18:07:12');
INSERT INTO `fivers_games` VALUES (721, 9, 1, 'jewels-prosper', 'Jewels of Prosperity', 'fivers/jewels-prosper.jpg', 0, 1, '2023-12-23 23:35:30', '2023-12-23 23:35:30');
INSERT INTO `fivers_games` VALUES (722, 9, 1, 'galactic-gems', 'Galactic Gems', 'fivers/galactic-gems.png', 0, 1, '2023-12-23 23:35:31', '2023-12-23 23:35:31');
INSERT INTO `fivers_games` VALUES (723, 9, 1, 'gdn-ice-fire', 'Guardians of Ice and Fire', 'fivers/gdn-ice-fire.png', 0, 1, '2023-12-23 23:35:31', '2023-12-23 23:35:31');
INSERT INTO `fivers_games` VALUES (724, 9, 1, 'fortune-ox', 'Fortune Ox', '01HKZQK0YXR79PJNSKWZX6FZPQ.png', 1, 1, '2023-12-23 23:35:32', '2024-01-12 18:00:17');
INSERT INTO `fivers_games` VALUES (725, 9, 1, 'wild-bandito', 'Wild Bandito', 'fivers/wild-bandito.jpg', 0, 1, '2023-12-23 23:35:32', '2023-12-23 23:35:32');
INSERT INTO `fivers_games` VALUES (726, 9, 1, 'candy-bonanza', 'Candy Bonanza', 'fivers/candy-bonanza.jpg', 0, 1, '2023-12-23 23:35:32', '2023-12-23 23:35:32');
INSERT INTO `fivers_games` VALUES (727, 9, 1, 'majestic-ts', 'Majestic Treasures', 'fivers/majestic-ts.jpg', 0, 1, '2023-12-23 23:35:33', '2023-12-23 23:35:33');
INSERT INTO `fivers_games` VALUES (728, 9, 1, 'crypt-fortune', 'Raider Jane\'s Crypt of Fortune', 'fivers/crypt-fortune.png', 0, 1, '2023-12-23 23:35:33', '2023-12-23 23:35:33');
INSERT INTO `fivers_games` VALUES (729, 9, 1, 'sprmkt-spree', 'Supermarket Spree', '01HKZQQ6EM7MTSR8ZW1AXVA25J.jpg', 1, 1, '2023-12-23 23:35:34', '2024-01-12 18:02:19');
INSERT INTO `fivers_games` VALUES (730, 9, 1, 'lgd-monkey-kg', 'Legendary Monkey King', 'fivers/lgd-monkey-kg.png', 0, 1, '2023-12-23 23:35:34', '2023-12-23 23:35:34');
INSERT INTO `fivers_games` VALUES (731, 9, 1, 'spirit-wonder', 'Spirited Wonders', 'fivers/spirit-wonder.jpg', 0, 1, '2023-12-23 23:35:35', '2023-12-23 23:35:35');
INSERT INTO `fivers_games` VALUES (732, 9, 1, 'emoji-riches', 'Emoji Riches', 'fivers/emoji-riches.png', 0, 1, '2023-12-23 23:35:35', '2023-12-23 23:35:35');
INSERT INTO `fivers_games` VALUES (733, 9, 1, 'fortune-tiger', 'Fortune Tiger', '01HKZQME3M0JYDW3D93Q6BHJRP.png', 1, 1, '2023-12-23 23:35:36', '2024-01-12 18:00:49');
INSERT INTO `fivers_games` VALUES (734, 9, 1, 'garuda-gems', 'Garuda Gems', 'fivers/garuda-gems.png', 0, 1, '2023-12-23 23:35:36', '2023-12-23 23:35:36');
INSERT INTO `fivers_games` VALUES (735, 9, 1, 'dest-sun-moon', 'Destiny of Sun & Moon', 'fivers/dest-sun-moon.png', 0, 1, '2023-12-23 23:35:37', '2023-12-23 23:35:37');
INSERT INTO `fivers_games` VALUES (736, 9, 1, 'btrfly-blossom', 'Butterfly Blossom', 'fivers/btrfly-blossom.jpeg', 0, 1, '2023-12-23 23:35:37', '2023-12-23 23:35:37');
INSERT INTO `fivers_games` VALUES (737, 9, 1, 'rooster-rbl', 'Rooster Rumble', 'fivers/rooster-rbl.jpg', 0, 1, '2023-12-23 23:35:38', '2023-12-23 23:35:38');
INSERT INTO `fivers_games` VALUES (738, 9, 1, 'battleground', 'Battleground Royale', '01HKZQE0WPTEF0255CJVV5CWFV.jpg', 1, 1, '2023-12-23 23:35:38', '2024-01-12 17:57:19');
INSERT INTO `fivers_games` VALUES (739, 9, 1, 'prosper-ftree', 'Prosperity Fortune Tree', 'fivers/prosper-ftree.png', 0, 1, '2023-12-23 23:35:39', '2023-12-23 23:35:39');
INSERT INTO `fivers_games` VALUES (740, 9, 1, 'fortune-rabbit', 'Fortune Rabbit', '01HKZQMG62FYEEP47MP5JH4QGT.png', 1, 1, '2023-12-23 23:35:40', '2024-01-12 18:00:51');
INSERT INTO `fivers_games` VALUES (741, 10, 1, 'vs5ultrab', 'Ultra Burn', 'fivers/vs5ultrab.png', 0, 1, '2023-12-23 23:35:43', '2023-12-23 23:35:43');
INSERT INTO `fivers_games` VALUES (742, 10, 1, 'vs5ultra', 'Ultra Hold and Spin', 'fivers/vs5ultra.png', 0, 1, '2023-12-23 23:35:44', '2023-12-23 23:35:44');
INSERT INTO `fivers_games` VALUES (743, 10, 1, 'vs10returndead', 'Return of the Dead', 'fivers/vs10returndead.png', 0, 1, '2023-12-23 23:35:45', '2023-12-23 23:35:45');
INSERT INTO `fivers_games` VALUES (744, 10, 1, 'vs10bbbonanza', 'Big Bass Bonanza', 'fivers/vs10bbbonanza.png', 0, 1, '2023-12-23 23:35:46', '2023-12-23 23:35:46');
INSERT INTO `fivers_games` VALUES (745, 10, 1, 'vs20hburnhs', 'Hot to Burn Hold and Spin', 'fivers/vs20hburnhs.png', 0, 1, '2023-12-23 23:35:47', '2023-12-23 23:35:47');
INSERT INTO `fivers_games` VALUES (746, 10, 1, 'vswayslight', 'Lucky Lightning', 'fivers/vswayslight.png', 0, 1, '2023-12-23 23:35:48', '2023-12-23 23:35:48');
INSERT INTO `fivers_games` VALUES (747, 10, 1, 'vs12bbb', 'Bigger Bass Bonanza', 'fivers/vs12bbb.png', 0, 1, '2023-12-23 23:35:49', '2023-12-23 23:35:49');
INSERT INTO `fivers_games` VALUES (748, 10, 1, 'vs10floatdrg', 'Floating Dragon', 'fivers/vs10floatdrg.png', 0, 1, '2023-12-23 23:35:50', '2023-12-23 23:35:50');
INSERT INTO `fivers_games` VALUES (749, 10, 1, 'vs1024temuj', 'Temujin Treasures', 'fivers/vs1024temuj.png', 0, 1, '2023-12-23 23:35:52', '2023-12-23 23:35:52');
INSERT INTO `fivers_games` VALUES (750, 10, 1, 'vs10bxmasbnza', 'Christmas Big Bass Bonanza', 'fivers/vs10bxmasbnza.png', 0, 1, '2023-12-23 23:35:53', '2023-12-23 23:35:53');
INSERT INTO `fivers_games` VALUES (751, 10, 1, 'vswaysbbb', 'Big Bass Bonanza Megaways™', 'fivers/vswaysbbb.png', 0, 1, '2023-12-23 23:35:54', '2023-12-23 23:35:54');
INSERT INTO `fivers_games` VALUES (752, 10, 1, 'vs40bigjuan', 'Big Juan', 'fivers/vs40bigjuan.png', 0, 1, '2023-12-23 23:35:55', '2023-12-23 23:35:55');
INSERT INTO `fivers_games` VALUES (753, 10, 1, 'vs10starpirate', 'Star Pirates Code', 'fivers/vs10starpirate.png', 0, 1, '2023-12-23 23:35:57', '2023-12-23 23:35:57');
INSERT INTO `fivers_games` VALUES (754, 10, 1, 'vs5hotburn', 'Hot to burn', 'fivers/vs5hotburn.png', 0, 1, '2023-12-23 23:35:57', '2023-12-23 23:35:57');
INSERT INTO `fivers_games` VALUES (755, 10, 1, 'vs25bkofkngdm', 'Book of Kingdoms', 'fivers/vs25bkofkngdm.png', 0, 1, '2023-12-23 23:35:58', '2023-12-23 23:35:58');
INSERT INTO `fivers_games` VALUES (756, 10, 1, 'vs10eyestorm', 'Eye of the Storm', 'fivers/vs10eyestorm.png', 0, 1, '2023-12-23 23:35:58', '2023-12-23 23:35:58');
INSERT INTO `fivers_games` VALUES (757, 10, 1, 'vs10amm', 'The Amazing Money Machine', 'fivers/vs10amm.png', 0, 1, '2023-12-23 23:35:59', '2023-12-23 23:35:59');
INSERT INTO `fivers_games` VALUES (758, 10, 1, 'vs10luckcharm', 'Lucky Grace And Charm', 'fivers/vs10luckcharm.png', 0, 1, '2023-12-23 23:35:59', '2023-12-23 23:35:59');
INSERT INTO `fivers_games` VALUES (759, 10, 1, 'vs25goldparty', 'Gold Party®', 'fivers/vs25goldparty.png', 0, 1, '2023-12-23 23:36:00', '2023-12-23 23:36:00');
INSERT INTO `fivers_games` VALUES (760, 10, 1, 'vs20rockvegas', 'Rock Vegas Mega Hold & Spin', 'fivers/vs20rockvegas.png', 0, 1, '2023-12-23 23:36:00', '2023-12-23 23:36:00');
INSERT INTO `fivers_games` VALUES (761, 10, 1, 'vs10tictac', 'Tic Tac Take', 'fivers/vs10tictac.png', 0, 1, '2023-12-23 23:36:01', '2023-12-23 23:36:01');
INSERT INTO `fivers_games` VALUES (762, 10, 1, 'vs243queenie', 'Queenie', 'fivers/vs243queenie.png', 0, 1, '2023-12-23 23:36:01', '2023-12-23 23:36:01');
INSERT INTO `fivers_games` VALUES (763, 10, 1, 'vs10spiritadv', 'Spirit of Adventure', 'fivers/vs10spiritadv.png', 0, 1, '2023-12-23 23:36:02', '2023-12-23 23:36:02');
INSERT INTO `fivers_games` VALUES (764, 10, 1, 'vs5littlegem', 'Little Gem Hold and Spin', 'fivers/vs5littlegem.png', 0, 1, '2023-12-23 23:36:02', '2023-12-23 23:36:02');
INSERT INTO `fivers_games` VALUES (765, 11, 1, '100', 'Baccarat', 'fivers/100.webp', 0, 1, '2023-12-23 23:36:06', '2023-12-23 23:36:06');
INSERT INTO `fivers_games` VALUES (766, 11, 1, '102', 'Fortune Baccarat', 'fivers/102.webp', 0, 1, '2023-12-23 23:36:07', '2023-12-23 23:36:07');
INSERT INTO `fivers_games` VALUES (767, 11, 1, '105', 'Speed Fortune Baccarat', 'fivers/105.webp', 0, 1, '2023-12-23 23:36:10', '2023-12-23 23:36:10');
INSERT INTO `fivers_games` VALUES (768, 11, 1, '106', 'VIP Fortune Baccarat', 'fivers/106.webp', 0, 1, '2023-12-23 23:36:11', '2023-12-23 23:36:11');
INSERT INTO `fivers_games` VALUES (769, 11, 1, '107', 'Italian Baccarat', 'fivers/107.webp', 0, 1, '2023-12-23 23:36:13', '2023-12-23 23:36:13');
INSERT INTO `fivers_games` VALUES (770, 11, 1, '120', 'Knockout Baccarat', 'fivers/120.webp', 0, 1, '2023-12-23 23:36:14', '2023-12-23 23:36:14');
INSERT INTO `fivers_games` VALUES (771, 11, 1, '130', 'Super 6 Baccarat', 'fivers/130.webp', 0, 1, '2023-12-23 23:36:15', '2023-12-23 23:36:15');
INSERT INTO `fivers_games` VALUES (772, 11, 1, '150', 'Dragon Tiger', 'fivers/150.webp', 0, 1, '2023-12-23 23:36:17', '2023-12-23 23:36:17');
INSERT INTO `fivers_games` VALUES (773, 11, 1, '170', 'No Commission Baccarat', 'fivers/170.webp', 0, 1, '2023-12-23 23:36:19', '2023-12-23 23:36:19');
INSERT INTO `fivers_games` VALUES (774, 11, 1, '171', 'VIP No Commission Speed Cricket Baccarat', 'fivers/171.webp', 0, 1, '2023-12-23 23:36:21', '2023-12-23 23:36:21');
INSERT INTO `fivers_games` VALUES (775, 11, 1, '1000', 'Italian Roulette', 'fivers/1000.webp', 0, 1, '2023-12-23 23:36:23', '2023-12-23 23:36:23');
INSERT INTO `fivers_games` VALUES (776, 11, 1, '5001', 'Auto Roulette', 'fivers/5001.webp', 0, 1, '2023-12-23 23:36:25', '2023-12-23 23:36:25');
INSERT INTO `fivers_games` VALUES (777, 11, 1, '32100', 'Casino Marina Baccarat 1', 'fivers/32100.webp', 0, 1, '2023-12-23 23:36:26', '2023-12-23 23:36:26');
INSERT INTO `fivers_games` VALUES (778, 11, 1, '32101', 'Casino Marina Baccarat 2', 'fivers/32101.webp', 0, 1, '2023-12-23 23:36:28', '2023-12-23 23:36:28');
INSERT INTO `fivers_games` VALUES (779, 11, 1, '32102', 'Casino Marina Baccarat 3', 'fivers/32102.webp', 0, 1, '2023-12-23 23:36:30', '2023-12-23 23:36:30');
INSERT INTO `fivers_games` VALUES (780, 11, 1, '32103', 'Casino Marina Baccarat 4', 'fivers/32103.webp', 0, 1, '2023-12-23 23:36:32', '2023-12-23 23:36:32');
INSERT INTO `fivers_games` VALUES (781, 11, 1, '221000', 'Speed Roulette', 'fivers/221000.webp', 0, 1, '2023-12-23 23:36:32', '2023-12-23 23:36:32');
INSERT INTO `fivers_games` VALUES (782, 11, 1, '221002', 'Speed Auto Roulette', 'fivers/221002.webp', 0, 1, '2023-12-23 23:36:33', '2023-12-23 23:36:33');
INSERT INTO `fivers_games` VALUES (783, 11, 1, '221003', 'Diamond Roulette', 'fivers/221003.webp', 0, 1, '2023-12-23 23:36:35', '2023-12-23 23:36:35');
INSERT INTO `fivers_games` VALUES (784, 11, 1, '221004', 'Prestige Auto Roulette', 'fivers/221004.webp', 0, 1, '2023-12-23 23:36:36', '2023-12-23 23:36:36');
INSERT INTO `fivers_games` VALUES (785, 11, 1, '221005', 'Namaste Roulette', 'fivers/221005.webp', 0, 1, '2023-12-23 23:36:38', '2023-12-23 23:36:38');
INSERT INTO `fivers_games` VALUES (786, 11, 1, '224100', 'Ultimate Sic Bo', 'fivers/224100.webp', 0, 1, '2023-12-23 23:36:39', '2023-12-23 23:36:39');
INSERT INTO `fivers_games` VALUES (787, 11, 1, '228000', 'Andar Bahar', 'fivers/228000.webp', 0, 1, '2023-12-23 23:36:41', '2023-12-23 23:36:41');
INSERT INTO `fivers_games` VALUES (788, 11, 1, '228001', 'Lucky 7', 'fivers/228001.webp', 0, 1, '2023-12-23 23:36:43', '2023-12-23 23:36:43');
INSERT INTO `fivers_games` VALUES (789, 11, 1, '228100', 'Ultimate Andar Bahar', 'fivers/228100.webp', 0, 1, '2023-12-23 23:36:44', '2023-12-23 23:36:44');
INSERT INTO `fivers_games` VALUES (790, 11, 1, '321000', 'Casino Marina Roulette 1', 'fivers/321000.webp', 0, 1, '2023-12-23 23:36:46', '2023-12-23 23:36:46');
INSERT INTO `fivers_games` VALUES (791, 11, 1, '321001', 'Casino Marina Roulette 2', 'fivers/321001.webp', 0, 1, '2023-12-23 23:36:48', '2023-12-23 23:36:48');
INSERT INTO `fivers_games` VALUES (792, 11, 1, '411000', 'Spanish Roulette', 'fivers/411000.webp', 0, 1, '2023-12-23 23:36:50', '2023-12-23 23:36:50');
INSERT INTO `fivers_games` VALUES (793, 11, 1, '431000', 'Ruleta del Sol', 'fivers/431000.webp', 0, 1, '2023-12-23 23:36:52', '2023-12-23 23:36:52');
INSERT INTO `fivers_games` VALUES (794, 11, 1, '481002', 'EZ Dealer Roulette Japanese', 'fivers/481002.webp', 0, 1, '2023-12-23 23:36:52', '2023-12-23 23:36:52');
INSERT INTO `fivers_games` VALUES (795, 11, 1, '481003', 'EZ Dealer Roulette Mandarin', 'fivers/481003.webp', 0, 1, '2023-12-23 23:36:54', '2023-12-23 23:36:54');
INSERT INTO `fivers_games` VALUES (796, 11, 1, '501000', 'Turkish Roulette', 'fivers/501000.webp', 0, 1, '2023-12-23 23:36:55', '2023-12-23 23:36:55');
INSERT INTO `fivers_games` VALUES (797, 11, 1, '541000', 'Ultimate Roulette', 'fivers/541000.webp', 0, 1, '2023-12-23 23:36:57', '2023-12-23 23:36:57');
INSERT INTO `fivers_games` VALUES (798, 11, 1, '601000', 'Russian Roulette', 'fivers/601000.webp', 0, 1, '2023-12-23 23:36:58', '2023-12-23 23:36:58');
INSERT INTO `fivers_games` VALUES (799, 11, 1, '611000', 'Portomaso Roulette 2', 'fivers/611000.webp', 0, 1, '2023-12-23 23:36:59', '2023-12-23 23:36:59');
INSERT INTO `fivers_games` VALUES (800, 11, 1, '611001', 'Oracle Real Roulette', 'fivers/611001.webp', 0, 1, '2023-12-23 23:37:00', '2023-12-23 23:37:00');
INSERT INTO `fivers_games` VALUES (801, 11, 1, '611003', 'Oracle 360 Roulette', 'fivers/611003.webp', 0, 1, '2023-12-23 23:37:01', '2023-12-23 23:37:01');
INSERT INTO `fivers_games` VALUES (802, 12, 1, 'DoubleBallRou001', 'Double Ball Roulette', '01HKZRSMBM1Y1PS8TS6RPXBGNT.jpg', 1, 1, '2023-12-23 23:37:03', '2024-01-12 18:21:07');
INSERT INTO `fivers_games` VALUES (803, 12, 1, 'AndarBahar000001', 'Super Andar Bahar', 'fivers/AndarBahar000001.webp', 0, 1, '2023-12-23 23:37:04', '2023-12-23 23:37:04');
INSERT INTO `fivers_games` VALUES (804, 12, 1, 'HoldemTable00001', 'Casino Hold\'em', 'fivers/HoldemTable00001.webp', 0, 1, '2023-12-23 23:37:05', '2023-12-23 23:37:05');
INSERT INTO `fivers_games` VALUES (805, 12, 1, 'BacBo00000000001', 'Bac Bo', '01HKZRPXZ2BHR9CGFDKWQ22V23.jpg', 1, 1, '2023-12-23 23:37:06', '2024-01-12 18:19:39');
INSERT INTO `fivers_games` VALUES (806, 12, 1, 'PTBaccarat000001', 'Prosperity Tree Baccarat', 'fivers/PTBaccarat000001.webp', 0, 1, '2023-12-23 23:37:08', '2023-12-23 23:37:08');
INSERT INTO `fivers_games` VALUES (807, 12, 1, 'lr6t4k3lcd4qgyrk', 'Grand Casino Roulette', 'fivers/lr6t4k3lcd4qgyrk.webp', 0, 1, '2023-12-23 23:37:10', '2023-12-23 23:37:10');
INSERT INTO `fivers_games` VALUES (808, 12, 1, 'TopDice000000001', 'Football Studio Dice', 'fivers/TopDice000000001.webp', 0, 1, '2023-12-23 23:37:11', '2023-12-23 23:37:11');
INSERT INTO `fivers_games` VALUES (809, 12, 1, 'Monopoly00000001', 'MONOPOLY Live', 'fivers/Monopoly00000001.webp', 0, 1, '2023-12-23 23:37:13', '2023-12-23 23:37:13');
INSERT INTO `fivers_games` VALUES (810, 12, 1, 'ovu5cwp54ccmymck', 'Speed Baccarat L', 'fivers/ovu5cwp54ccmymck.webp', 0, 1, '2023-12-23 23:37:14', '2023-12-23 23:37:14');
INSERT INTO `fivers_games` VALUES (811, 12, 1, 'ovu5h6b3ujb4y53w', 'No Commission Speed Baccarat C', 'fivers/ovu5h6b3ujb4y53w.webp', 0, 1, '2023-12-23 23:37:16', '2023-12-23 23:37:16');
INSERT INTO `fivers_games` VALUES (812, 12, 1, 'ndgv45bghfuaaebf', 'Speed Baccarat E', 'fivers/ndgv45bghfuaaebf.webp', 0, 1, '2023-12-23 23:37:17', '2023-12-23 23:37:17');
INSERT INTO `fivers_games` VALUES (813, 12, 1, 'lv2kzclunt2qnxo5', 'Speed Baccarat B', 'fivers/lv2kzclunt2qnxo5.webp', 0, 1, '2023-12-23 23:37:18', '2023-12-23 23:37:18');
INSERT INTO `fivers_games` VALUES (814, 12, 1, 'qsf63ownyvbqnz33', 'Speed Baccarat Z', 'fivers/qsf63ownyvbqnz33.webp', 0, 1, '2023-12-23 23:37:18', '2023-12-23 23:37:18');
INSERT INTO `fivers_games` VALUES (815, 12, 1, 'leqhceumaq6qfoug', 'Speed Baccarat A', 'fivers/leqhceumaq6qfoug.webp', 0, 1, '2023-12-23 23:37:20', '2023-12-23 23:37:20');
INSERT INTO `fivers_games` VALUES (816, 12, 1, 'DragonTiger00001', 'Dragon Tiger', '01HKZRGDPBG8B8Q0G2XR7KZN3N.jpg', 1, 1, '2023-12-23 23:37:22', '2024-01-12 18:16:06');
INSERT INTO `fivers_games` VALUES (817, 12, 1, 'nmwde3fd7hvqhq43', 'Speed Baccarat F', 'fivers/nmwde3fd7hvqhq43.webp', 0, 1, '2023-12-23 23:37:24', '2023-12-23 23:37:24');
INSERT INTO `fivers_games` VALUES (818, 12, 1, 'qgqrrnuqvltnvejx', 'Speed Baccarat V', 'fivers/qgqrrnuqvltnvejx.webp', 0, 1, '2023-12-23 23:37:25', '2023-12-23 23:37:25');
INSERT INTO `fivers_games` VALUES (819, 12, 1, 'nmwdzhbg7hvqh6a7', 'Speed Baccarat G', 'fivers/nmwdzhbg7hvqh6a7.webp', 0, 1, '2023-12-23 23:37:27', '2023-12-23 23:37:27');
INSERT INTO `fivers_games` VALUES (820, 12, 1, '48z5pjps3ntvqc1b', 'Auto-Roulette', 'fivers/48z5pjps3ntvqc1b.webp', 0, 1, '2023-12-23 23:37:28', '2023-12-23 23:37:28');
INSERT INTO `fivers_games` VALUES (821, 12, 1, 'SpeedAutoRo00001', 'Speed Auto Roulette', 'fivers/SpeedAutoRo00001.webp', 0, 1, '2023-12-23 23:37:30', '2023-12-23 23:37:30');
INSERT INTO `fivers_games` VALUES (822, 12, 1, 'GoldVaultRo00001', 'Gold Vault Roulette', 'fivers/GoldVaultRo00001.webp', 0, 1, '2023-12-23 23:37:31', '2023-12-23 23:37:31');
INSERT INTO `fivers_games` VALUES (823, 12, 1, 'o4kyj7tgpwqqy4m4', 'Speed Baccarat Q', 'fivers/o4kyj7tgpwqqy4m4.webp', 0, 1, '2023-12-23 23:37:33', '2023-12-23 23:37:33');
INSERT INTO `fivers_games` VALUES (824, 12, 1, 'TRPTable00000001', 'Triple Card Poker', 'fivers/TRPTable00000001.webp', 0, 1, '2023-12-23 23:37:34', '2023-12-23 23:37:34');
INSERT INTO `fivers_games` VALUES (825, 12, 1, 'peekbaccarat0001', 'Peek Baccarat', 'fivers/peekbaccarat0001.webp', 0, 1, '2023-12-23 23:37:35', '2023-12-23 23:37:35');
INSERT INTO `fivers_games` VALUES (826, 12, 1, 'qgonc7t4ucdiel4o', 'Speed Baccarat T', 'fivers/qgonc7t4ucdiel4o.webp', 0, 1, '2023-12-23 23:37:36', '2023-12-23 23:37:36');
INSERT INTO `fivers_games` VALUES (827, 12, 1, 'k2oswnib7jjaaznw', 'Baccarat Control Squeeze', 'fivers/k2oswnib7jjaaznw.webp', 0, 1, '2023-12-23 23:37:36', '2023-12-23 23:37:36');
INSERT INTO `fivers_games` VALUES (828, 12, 1, 'ovu5fzje4ccmyqnr', 'Speed Baccarat P', 'fivers/ovu5fzje4ccmyqnr.webp', 0, 1, '2023-12-23 23:37:38', '2023-12-23 23:37:38');
INSERT INTO `fivers_games` VALUES (829, 12, 1, 'BonsaiBacc000003', 'Bonsai Speed Baccarat C', 'fivers/BonsaiBacc000003.webp', 0, 1, '2023-12-23 23:37:40', '2023-12-23 23:37:40');
INSERT INTO `fivers_games` VALUES (830, 12, 1, 'LightningTable01', 'Lightning Roulette', '01HKZR8VCBRS6DQJYBZJTJP2JK.jpg', 1, 1, '2023-12-23 23:37:42', '2024-01-12 18:11:58');
INSERT INTO `fivers_games` VALUES (831, 12, 1, 'CrazyTime0000002', 'Crazy Time A', 'fivers/CrazyTime0000002.webp', 0, 1, '2023-12-23 23:37:43', '2023-12-23 23:37:43');
INSERT INTO `fivers_games` VALUES (832, 12, 1, 'NoCommBac0000001', 'No Commission Baccarat', 'fivers/NoCommBac0000001.webp', 0, 1, '2023-12-23 23:37:44', '2023-12-23 23:37:44');
INSERT INTO `fivers_games` VALUES (833, 12, 1, 'XxxtremeLigh0001', 'XXXtreme Lightning Roulette', 'fivers/XxxtremeLigh0001.webp', 0, 1, '2023-12-23 23:37:46', '2023-12-23 23:37:46');
INSERT INTO `fivers_games` VALUES (834, 12, 1, 'teenpattitable01', 'Teen Patti', 'fivers/teenpattitable01.webp', 0, 1, '2023-12-23 23:37:48', '2023-12-23 23:37:48');
INSERT INTO `fivers_games` VALUES (835, 12, 1, 'ndgvwvgthfuaad3q', 'Speed Baccarat C', 'fivers/ndgvwvgthfuaad3q.webp', 0, 1, '2023-12-23 23:37:48', '2023-12-23 23:37:48');
INSERT INTO `fivers_games` VALUES (836, 12, 1, 'nxpkul2hgclallno', 'Speed Baccarat I', 'fivers/nxpkul2hgclallno.webp', 0, 1, '2023-12-23 23:37:50', '2023-12-23 23:37:50');
INSERT INTO `fivers_games` VALUES (837, 12, 1, 'SBCTable00000001', 'Side Bet City', 'fivers/SBCTable00000001.webp', 0, 1, '2023-12-23 23:37:51', '2023-12-23 23:37:51');
INSERT INTO `fivers_games` VALUES (838, 12, 1, 'ndgvs3tqhfuaadyg', 'Baccarat C', '01HKZRK215YW5N1DAR9W82Q550.jpg', 1, 1, '2023-12-23 23:37:52', '2024-01-12 18:17:32');
INSERT INTO `fivers_games` VALUES (839, 12, 1, 'obj64qcnqfunjelj', 'Speed Baccarat J', 'fivers/obj64qcnqfunjelj.webp', 0, 1, '2023-12-23 23:37:53', '2023-12-23 23:37:53');
INSERT INTO `fivers_games` VALUES (840, 12, 1, 'rep5aor7nyjl7qli', 'Speed Baccarat 6', 'fivers/rep5aor7nyjl7qli.webp', 0, 1, '2023-12-23 23:37:55', '2023-12-23 23:37:55');
INSERT INTO `fivers_games` VALUES (841, 12, 1, '7nyiaws9tgqrzaz3', 'Football Studio Roulette', 'fivers/7nyiaws9tgqrzaz3.webp', 0, 1, '2023-12-23 23:37:57', '2023-12-23 23:37:57');
INSERT INTO `fivers_games` VALUES (842, 12, 1, 'ndgvz5mlhfuaad6e', 'Speed Baccarat D', 'fivers/ndgvz5mlhfuaad6e.webp', 0, 1, '2023-12-23 23:37:58', '2023-12-23 23:37:58');
INSERT INTO `fivers_games` VALUES (843, 12, 1, 'ovu5dsly4ccmynil', 'Speed Baccarat M', 'fivers/ovu5dsly4ccmynil.webp', 0, 1, '2023-12-23 23:38:00', '2023-12-23 23:38:00');
INSERT INTO `fivers_games` VALUES (844, 12, 1, 'rep5ca4ynyjl7wdw', 'Speed Baccarat 7', 'fivers/rep5ca4ynyjl7wdw.webp', 0, 1, '2023-12-23 23:38:02', '2023-12-23 23:38:02');
INSERT INTO `fivers_games` VALUES (845, 12, 1, 'TopCard000000001', 'Football Studio', 'fivers/TopCard000000001.webp', 0, 1, '2023-12-23 23:38:02', '2023-12-23 23:38:02');
INSERT INTO `fivers_games` VALUES (846, 12, 1, '7x0b1tgh7agmf6hv', 'Immersive Roulette', 'fivers/7x0b1tgh7agmf6hv.webp', 0, 1, '2023-12-23 23:38:03', '2023-12-23 23:38:03');
INSERT INTO `fivers_games` VALUES (847, 12, 1, 'qgqrucipvltnvnvq', 'Speed Baccarat W', 'fivers/qgqrucipvltnvnvq.webp', 0, 1, '2023-12-23 23:38:04', '2023-12-23 23:38:04');
INSERT INTO `fivers_games` VALUES (848, 12, 1, 'ovu5fbxm4ccmypmb', 'Speed Baccarat O', 'fivers/ovu5fbxm4ccmypmb.webp', 0, 1, '2023-12-23 23:38:06', '2023-12-23 23:38:06');
INSERT INTO `fivers_games` VALUES (849, 12, 1, 'vctlz20yfnmp1ylr', 'Roulette', '01HKZRADPJX1YRPRARZMMVS1RF.jpg', 1, 1, '2023-12-23 23:38:07', '2024-01-12 18:13:34');
INSERT INTO `fivers_games` VALUES (850, 12, 1, 'ocye5hmxbsoyrcii', 'No Commission Speed Baccarat B', 'fivers/ocye5hmxbsoyrcii.webp', 0, 1, '2023-12-23 23:38:09', '2023-12-23 23:38:09');
INSERT INTO `fivers_games` VALUES (851, 12, 1, '60i0lcfx5wkkv3sy', 'Baccarat B', 'fivers/60i0lcfx5wkkv3sy.webp', 0, 1, '2023-12-23 23:38:09', '2023-12-23 23:38:09');
INSERT INTO `fivers_games` VALUES (852, 12, 1, 'BonsaiBacc000001', 'Bonsai Speed Baccarat A', 'fivers/BonsaiBacc000001.webp', 0, 1, '2023-12-23 23:38:10', '2023-12-23 23:38:10');
INSERT INTO `fivers_games` VALUES (853, 12, 1, '01rb77cq1gtenhmo', 'Auto-Roulette VIP', 'fivers/01rb77cq1gtenhmo.webp', 0, 1, '2023-12-23 23:38:12', '2023-12-23 23:38:12');
INSERT INTO `fivers_games` VALUES (854, 12, 1, 'CrazyTime0000001', 'Crazy Time', 'fivers/CrazyTime0000001.webp', 0, 1, '2023-12-23 23:38:13', '2023-12-23 23:38:13');
INSERT INTO `fivers_games` VALUES (855, 12, 1, 'lkcbrbdckjxajdol', 'Speed Roulette', 'fivers/lkcbrbdckjxajdol.webp', 0, 1, '2023-12-23 23:38:15', '2023-12-23 23:38:15');
INSERT INTO `fivers_games` VALUES (856, 12, 1, 'AmericanTable001', 'American Roulette', 'fivers/AmericanTable001.webp', 0, 1, '2023-12-23 23:38:16', '2023-12-23 23:38:16');
INSERT INTO `fivers_games` VALUES (857, 12, 1, 'qsf7bpfvyvbqolwp', 'Speed Baccarat 3', 'fivers/qsf7bpfvyvbqolwp.webp', 0, 1, '2023-12-23 23:38:18', '2023-12-23 23:38:18');
INSERT INTO `fivers_games` VALUES (858, 12, 1, 'qsf7alptyvbqohva', 'Speed Baccarat 2', 'fivers/qsf7alptyvbqohva.webp', 0, 1, '2023-12-23 23:38:20', '2023-12-23 23:38:20');
INSERT INTO `fivers_games` VALUES (859, 12, 1, 'nxpj4wumgclak2lx', 'Speed Baccarat H', 'fivers/nxpj4wumgclak2lx.webp', 0, 1, '2023-12-23 23:38:22', '2023-12-23 23:38:22');
INSERT INTO `fivers_games` VALUES (860, 12, 1, 'ndgv76kehfuaaeec', 'No Commission Speed Baccarat A', 'fivers/ndgv76kehfuaaeec.webp', 0, 1, '2023-12-23 23:38:22', '2023-12-23 23:38:22');
INSERT INTO `fivers_games` VALUES (861, 12, 1, 'BonsaiBacc000002', 'Bonsai Speed Baccarat B', 'fivers/BonsaiBacc000002.webp', 0, 1, '2023-12-23 23:38:23', '2023-12-23 23:38:23');
INSERT INTO `fivers_games` VALUES (862, 12, 1, 'qsf65xtoyvbqoaop', 'Speed Baccarat 1', 'fivers/qsf65xtoyvbqoaop.webp', 0, 1, '2023-12-23 23:38:25', '2023-12-23 23:38:25');
INSERT INTO `fivers_games` VALUES (863, 12, 1, 'oytmvb9m1zysmc44', 'Baccarat A', 'fivers/oytmvb9m1zysmc44.webp', 0, 1, '2023-12-23 23:38:27', '2023-12-23 23:38:27');
INSERT INTO `fivers_games` VALUES (864, 12, 1, 'zixzea8nrf1675oh', 'Baccarat Squeeze', 'fivers/zixzea8nrf1675oh.webp', 0, 1, '2023-12-23 23:38:28', '2023-12-23 23:38:28');
INSERT INTO `fivers_games` VALUES (865, 12, 1, 'LightningBac0001', 'Lightning Baccarat', NULL, 0, 1, '2023-12-23 23:38:30', '2023-12-23 23:38:30');
INSERT INTO `fivers_games` VALUES (866, 12, 1, 'ocye2ju2bsoyq6vv', 'Speed Baccarat K', 'fivers/ocye2ju2bsoyq6vv.webp', 0, 1, '2023-12-23 23:38:31', '2023-12-23 23:38:31');
INSERT INTO `fivers_games` VALUES (867, 12, 1, 'FanTan0000000001', 'Fan Tan', 'fivers/FanTan0000000001.webp', 0, 1, '2023-12-23 23:38:33', '2023-12-23 23:38:33');
INSERT INTO `fivers_games` VALUES (868, 12, 1, 'CSPTable00000001', 'Caribbean Stud Poker', 'fivers/CSPTable00000001.webp', 0, 1, '2023-12-23 23:38:34', '2023-12-23 23:38:34');
INSERT INTO `fivers_games` VALUES (869, 12, 1, 'SuperSicBo000001', 'Super Sic Bo', 'fivers/SuperSicBo000001.webp', 0, 1, '2023-12-23 23:38:36', '2023-12-23 23:38:36');
INSERT INTO `fivers_games` VALUES (870, 12, 1, 'o4kymodby2fa2c7g', 'Speed Baccarat S', 'fivers/o4kymodby2fa2c7g.webp', 0, 1, '2023-12-23 23:38:38', '2023-12-23 23:38:38');
INSERT INTO `fivers_games` VALUES (871, 12, 1, 'MOWDream00000001', 'Dream Catcher', 'fivers/MOWDream00000001.webp', 0, 1, '2023-12-23 23:38:40', '2023-12-23 23:38:40');
INSERT INTO `fivers_games` VALUES (872, 12, 1, 'qgqrhfvsvltnueqf', 'Speed Baccarat U', 'fivers/qgqrhfvsvltnueqf.webp', 0, 1, '2023-12-23 23:38:40', '2023-12-23 23:38:40');
INSERT INTO `fivers_games` VALUES (873, 12, 1, 'LightningDice001', 'Lightning Dice', NULL, 0, 1, '2023-12-23 23:38:42', '2023-12-23 23:38:42');
INSERT INTO `fivers_games` VALUES (874, 12, 1, 'MonBigBaller0001', 'MONOPOLY Big Baller', NULL, 0, 1, '2023-12-23 23:38:43', '2023-12-23 23:38:43');
INSERT INTO `fivers_games` VALUES (875, 12, 1, 'o4kylkahpwqqy57w', 'Speed Baccarat R', 'fivers/o4kylkahpwqqy57w.webp', 0, 1, '2023-12-23 23:38:45', '2023-12-23 23:38:45');
INSERT INTO `fivers_games` VALUES (876, 12, 1, 'f1f4rm9xgh4j3u2z', 'Auto-Roulette La Partage', 'fivers/f1f4rm9xgh4j3u2z.webp', 0, 1, '2023-12-23 23:38:46', '2023-12-23 23:38:46');
INSERT INTO `fivers_games` VALUES (877, 12, 1, 'ETHTable00000001', 'Extreme Texas Hold\'em', 'fivers/ETHTable00000001.webp', 0, 1, '2023-12-23 23:38:47', '2023-12-23 23:38:47');
INSERT INTO `fivers_games` VALUES (878, 12, 1, 'qgqrv4asvltnvuty', 'Speed Baccarat X', 'fivers/qgqrv4asvltnvuty.webp', 0, 1, '2023-12-23 23:38:49', '2023-12-23 23:38:49');
INSERT INTO `fivers_games` VALUES (879, 12, 1, 'ovu5eja74ccmyoiq', 'Speed Baccarat N', 'fivers/ovu5eja74ccmyoiq.webp', 0, 1, '2023-12-23 23:38:52', '2023-12-23 23:38:52');

-- ----------------------------
-- Table structure for fivers_providers
-- ----------------------------
DROP TABLE IF EXISTS `fivers_providers`;
CREATE TABLE `fivers_providers`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `views` bigint(20) NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fivers_providers
-- ----------------------------
INSERT INTO `fivers_providers` VALUES (1, 'PRAGMATIC', 'Pragmatic Play', 1, 1, '2023-12-23 23:11:21', '2023-12-23 23:11:21');
INSERT INTO `fivers_providers` VALUES (2, 'HABANERO', 'Habanero', 1, 1, '2023-12-23 23:11:21', '2023-12-23 23:11:21');
INSERT INTO `fivers_providers` VALUES (3, 'BOOONGO', 'Booongo', 1, 1, '2023-12-23 23:11:21', '2023-12-23 23:11:21');
INSERT INTO `fivers_providers` VALUES (4, 'PLAYSON', 'Playson', 1, 1, '2023-12-23 23:11:21', '2023-12-23 23:11:21');
INSERT INTO `fivers_providers` VALUES (5, 'CQ9', 'CQ9', 1, 1, '2023-12-23 23:11:21', '2023-12-23 23:11:21');
INSERT INTO `fivers_providers` VALUES (6, 'EVOPLAY', 'Evoplay', 1, 1, '2023-12-23 23:11:21', '2023-12-23 23:11:21');
INSERT INTO `fivers_providers` VALUES (7, 'TOPTREND', 'TopTrend Gaming', 1, 1, '2023-12-23 23:11:21', '2023-12-23 23:11:21');
INSERT INTO `fivers_providers` VALUES (8, 'DREAMTECH', 'DreamTech', 1, 1, '2023-12-23 23:11:21', '2023-12-23 23:11:21');
INSERT INTO `fivers_providers` VALUES (9, 'PGSOFT', 'PG Soft', 1, 1, '2023-12-23 23:11:21', '2023-12-23 23:11:21');
INSERT INTO `fivers_providers` VALUES (10, 'REELKINGDOM', 'Reel Kingdom', 1, 1, '2023-12-23 23:11:21', '2023-12-23 23:11:21');
INSERT INTO `fivers_providers` VALUES (11, 'EZUGI', 'Ezugi', 1, 1, '2023-12-23 23:11:21', '2023-12-23 23:11:21');
INSERT INTO `fivers_providers` VALUES (12, 'EVOLUTION', 'Evolution', 1, 1, '2023-12-23 23:11:21', '2023-12-23 23:11:21');

-- ----------------------------
-- Table structure for game_exclusives
-- ----------------------------
DROP TABLE IF EXISTS `game_exclusives`;
CREATE TABLE `game_exclusives`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `winLength` bigint(20) NOT NULL DEFAULT 3,
  `loseLength` bigint(20) NOT NULL DEFAULT 20,
  `influencer_winLength` bigint(20) NOT NULL DEFAULT 20,
  `influencer_loseLength` bigint(20) NOT NULL DEFAULT 1,
  `iconsJson` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NULL DEFAULT 1,
  `views` bigint(20) NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `game_exclusives_category_id_foreign`(`category_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of game_exclusives
-- ----------------------------
INSERT INTO `game_exclusives` VALUES (1, 1, 'fortunetiger', 'Fortune Tiger', '<p>&nbsp;Diz a lenda que existe um imperador de mil anos que governa um império chamado Imortal. O segredo de sua imortalidade é seu raro tigre dourado que sempre fica ao seu lado como guardião. Possui lindo pelo listrado que brilha como a luz do sol e um par de olhos dourados que podem arrebatar a alma de quem olha para eles. Não só este tigre mantém a paz em Immortal, mas também concedeu ao imperador uma vida imortal. O tigre só dá à luz uma vez a cada doze anos, e este ano é um desses anos! O imperador está muito animado em convidar o povo para testemunhar o milagre. Diz-se que uma chuva dourada cairá do céu quando o filhote de tigre nascer. A chuva tem o poder de fertilizar o solo e curar todo tipo de doenças. Jogue “Fortune Tiger” agora para testemunhar o nascimento do tigre dourado e ser abençoado com uma vida inteira de sorte!\\n\\nFortune Tiger é um vídeo slot de 3 cilindros e 3 linhas com respins e multiplicador x10. O recurso Fortune Tiger pode ser acionado aleatoriamente durante qualquer giro! Se houver 1 ou mais símbolos adicionais (seja um símbolo escolhido aleatoriamente ou um símbolo Wild) aparecendo nas bobinas, todas as bobinas girarão novamente! Além disso, quando todos os símbolos nos rolos estiverem envolvidos numa vitória, a vitória será multiplicada por x10.&nbsp;</p>', '01HKZETNNTS3KNQ5W6VPX52420.png', 'Lq6sofAr3rU4AvAbUaw2dazLpOhoFD-metadGlnZXItMi5wbmc=-.png', 1, 20, 30, 1, '{\n\"success\": true,\n\"data\": [\n{\n\"icon_name\": \"Symbol_0\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_1\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_2\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 50,\n\"win_4\": 250,\n\"win_5\": 2500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_3\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 20,\n\"win_4\": 100,\n\"win_5\": 1000,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_4\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 15,\n\"win_4\": 50,\n\"win_5\": 500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_5\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 10,\n\"win_4\": 25,\n\"win_5\": 200,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_6\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 5,\n\"win_4\": 20,\n\"win_5\": 100,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_7\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 4,\n\"win_4\": 15,\n\"win_5\": 75,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_8\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 3,\n\"win_4\": 10,\n\"win_5\": 50,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n}\n],\n\"message\": \"List icons success\"\n}', 1, 1878, '2023-10-07 16:18:46', '2024-01-28 14:44:57');
INSERT INTO `game_exclusives` VALUES (2, 1, 'fortuneox', 'Fortune OX', '<p>&nbsp;Ox is the second of the 12-year periodic sequence of animals in the Chinese zodiac. It plays an important role throughout China agriculture history and acts as the symbol of “productivity” due to its diligence and tenacity. The ancient Chinese always said: “Farming is best done in the year of the Ox”. This is because there is always fair weather in every year of the Ox, making all the work go smoothly! The Ox also represents an auspicious animal. Legend has it, there is an immortal person who rides his mighty Ox in Mount Taibai. It is said that whoever has the chance to touch the horns of the Ox will be blessed with happiness for their whole life! However, this immortal person and his ox are hard to track, and only the destined few can meet them and be blessed with good luck! Play “Fortune Ox” now, let the Ox bless you with good fortune and prosperity! Fortune Ox is a 3-reel, 3-row (for reel 1 and 3) and 4-row (for reel 2) video slot featuring respins until win and x10 multiplier. Fortune Ox Feature may be randomly triggered during any spin! During the Fortune Ox Feature, when the first and third reel share the same symbols, all reels will respin until there is a win! Not only that, full reels win will reward x10 wins too!&nbsp;</p>', '01HKZFFTCB8FNAPXP7MVTSY3Q1.png', 'eSwugWYqXBDiRKo4V3a93fivawpzqc-metab3gucG5n-.png', 1, 30, 20, 1, '{\n\"success\": true,\n\"data\": [\n{\n\"icon_name\": \"Symbol_0\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_1\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_2\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 50,\n\"win_4\": 250,\n\"win_5\": 2500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_3\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 20,\n\"win_4\": 100,\n\"win_5\": 1000,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_4\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 15,\n\"win_4\": 50,\n\"win_5\": 500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_5\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 10,\n\"win_4\": 25,\n\"win_5\": 200,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_6\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 5,\n\"win_4\": 20,\n\"win_5\": 100,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_7\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 4,\n\"win_4\": 15,\n\"win_5\": 75,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_8\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 3,\n\"win_4\": 10,\n\"win_5\": 50,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n}\n],\n\"message\": \"List icons success\"\n}', 1, 474, '2023-10-07 16:58:11', '2024-01-12 15:38:29');
INSERT INTO `game_exclusives` VALUES (3, 1, 'fortunemouse', 'Fortune Mouse', '<p>&nbsp;Legend has it that the Jade Emperor organized a river crossing competition to select twelve animals to be the twelve zodiac signs. Many animals enthusiastically entered after hearing about this news. On the day of the competition, the cow was ahead of the race. But unbeknownst to the cow, the clever mouse had been hiding on the cow’s back. When the cow was about to cross the finish line, the mouse jumped off the cow’s back and thus became the first of the zodiac signs.<br>Mice are not only clever; they were also regarded as a symbol of wealth during ancient times. It was said that if your home had mice stealing food, it meant your family was rich and prosperous enough to have a surplus of food at home for the mice to steal! So let “Fortune Mouse” bring you unlimited luck and endless wealth in the year of the Mouse!<br>Fortune Mouse is a 3-reel, 3-row video slot featuring respins until win. 3 Wild symbols may be added to the middle reel during any spin in the Fortune Mouse Feature. The first and third reel will respin until there is a win. Be awarded with 1000x of the total bet in Maximum Win when Wild symbols occupy all the reels!&nbsp;</p>', '01HKZFNW17EVQ6S8CWG1QFGH3P.png', 'BsJCiMUt4sLYcvRUaw4zqAjsUW4oqk-metabW91c2UucG5n-.png', 1, 30, 20, 1, '{\n\"success\": true,\n\"data\": [\n{\n\"icon_name\": \"Symbol_0\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_1\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_2\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 50,\n\"win_4\": 250,\n\"win_5\": 2500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_3\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 20,\n\"win_4\": 100,\n\"win_5\": 1000,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_4\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 15,\n\"win_4\": 50,\n\"win_5\": 500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_5\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 10,\n\"win_4\": 25,\n\"win_5\": 200,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_6\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 5,\n\"win_4\": 20,\n\"win_5\": 100,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_7\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 4,\n\"win_4\": 15,\n\"win_5\": 75,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_8\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 3,\n\"win_4\": 10,\n\"win_5\": 50,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n}\n],\n\"message\": \"List icons success\"\n}', 1, 516, '2023-10-07 17:06:52', '2024-01-12 15:41:47');
INSERT INTO `game_exclusives` VALUES (4, 1, 'fortunepanda', 'Fortune Panda', '<p>\"Uma emocionante jornada que promete trazer grandes ganhos financeiros! Bem-vindo ao Panda, a nova adição à Família Fortune.\"</p>', '01HKZFNYZJ6EAYAQZ7SWWPX2VE.png', 'x9jw5Eu29n3UIJzr6ud8zhdqiO8u4d-metacGFuZGEucG5n-.png', 1, 20, 20, 1, '{\n\"success\": true,\n\"data\": [\n{\n\"icon_name\": \"Symbol_0\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_1\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_2\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 50,\n\"win_4\": 250,\n\"win_5\": 2500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_3\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 20,\n\"win_4\": 100,\n\"win_5\": 1000,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_4\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 15,\n\"win_4\": 50,\n\"win_5\": 500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_5\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 10,\n\"win_4\": 25,\n\"win_5\": 200,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_6\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 5,\n\"win_4\": 20,\n\"win_5\": 100,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_7\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 4,\n\"win_4\": 15,\n\"win_5\": 75,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_8\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 3,\n\"win_4\": 10,\n\"win_5\": 50,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n}\n],\n\"message\": \"List icons success\"\n}', 1, 513, '2023-10-07 20:18:52', '2024-01-12 15:41:50');
INSERT INTO `game_exclusives` VALUES (5, 1, 'phoenixrises', 'Phoenix Rises', '<p>&nbsp;Ressurge das cinzas para trazer sorte até você. Venha se divertir com nossa nova atração!&nbsp;</p>', '01HKZFP24MYHYE57G9VKE7WJCF.png', 'x7iN6vEcayfBZIQoy7XC7zbe2UVgns-metaZmVuaXgucG5n-.png', 1, 20, 20, 1, '{\n    \"success\": true,\n    \"data\": [\n        {\n            \"icon_name\": \"Symbol_0\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 0,\n            \"win_4\": 0,\n            \"win_5\": 0,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_1\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 0,\n            \"win_4\": 0,\n            \"win_5\": 0,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_2\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 20,\n            \"win_4\": 50,\n            \"win_5\": 120,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_3\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 15,\n            \"win_4\": 45,\n            \"win_5\": 100,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_4\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 10,\n            \"win_4\": 45,\n            \"win_5\": 80,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_5\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 6,\n            \"win_4\": 15,\n            \"win_5\": 50,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_6\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 30,\n            \"win_4\": 60,\n            \"win_5\": 150,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_7\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 5,\n            \"win_4\": 10,\n            \"win_5\": 40,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_8\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 5,\n            \"win_4\": 10,\n            \"win_5\": 40,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_9\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 10,\n            \"win_4\": 45,\n            \"win_5\": 80,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        }\n    ],\n    \"message\": \"List icons success\"\n}', 1, 373, '2023-10-07 20:58:18', '2024-01-12 15:41:53');
INSERT INTO `game_exclusives` VALUES (6, 1, 'queenofbounty', 'Queen of Bounty', '<p>Queen of Bounty</p>', '01HKZFP4B13D8K3V9SY9SX4ZWH.png', 'D4KfDqMiKGkeNYXnnTNdofzXAuohRj-metadGVzb3VyZS5wbmc=-.png', 1, 20, 20, 1, '{\n\"success\": true,\n\"data\": [\n{\n\"icon_name\": \"Symbol_0\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_1\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_2\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 50,\n\"win_4\": 250,\n\"win_5\": 2500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_3\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 20,\n\"win_4\": 100,\n\"win_5\": 1000,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_4\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 15,\n\"win_4\": 50,\n\"win_5\": 500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_5\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 10,\n\"win_4\": 25,\n\"win_5\": 200,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_6\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 5,\n\"win_4\": 20,\n\"win_5\": 100,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_7\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 4,\n\"win_4\": 15,\n\"win_5\": 75,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_8\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 3,\n\"win_4\": 10,\n\"win_5\": 50,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n}\n],\n\"message\": \"List icons success\"\n}', 1, 4, '2023-10-07 21:43:26', '2024-01-12 15:41:56');
INSERT INTO `game_exclusives` VALUES (7, 1, 'treasuresofaztec', 'Treasures of Aztec', '<p>Treasures of Aztec</p>', '01HKZFP6QGV1TCVDY68SXXSFTY.png', 'SvaQYvS346lt4Qt4UTdAJ5k34Iv6Ew-metaMTM1NzUzOS5wbmc=-.png', 1, 20, 20, 1, '{\n\"success\": true,\n\"data\": [\n{\n\"icon_name\": \"Symbol_0\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_1\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_2\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 50,\n\"win_4\": 250,\n\"win_5\": 2500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_3\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 20,\n\"win_4\": 100,\n\"win_5\": 1000,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_4\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 15,\n\"win_4\": 50,\n\"win_5\": 500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_5\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 10,\n\"win_4\": 25,\n\"win_5\": 200,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_6\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 5,\n\"win_4\": 20,\n\"win_5\": 100,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_7\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 4,\n\"win_4\": 15,\n\"win_5\": 75,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_8\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 3,\n\"win_4\": 10,\n\"win_5\": 50,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n}\n],\n\"message\": \"List icons success\"\n}', 1, 263, '2023-10-07 22:22:00', '2024-01-12 15:41:58');
INSERT INTO `game_exclusives` VALUES (8, 1, 'bikiniparadise', 'Bikini Paradise', '<p>Bikini Paradise</p>', '01HKZFP9PV8CZWAWVZ0WSBJGA4.jpg', 'zSBdC8WTBkhpKWeL1qBv4ZU5NR3bdY-metaMjc5MzkzMy5wbmc=-.png', 1, 20, 20, 1, '{\n\"success\": true,\n\"data\": [\n{\n\"icon_name\": \"Symbol_0\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_1\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_2\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 50,\n\"win_4\": 250,\n\"win_5\": 2500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_3\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 20,\n\"win_4\": 100,\n\"win_5\": 1000,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_4\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 15,\n\"win_4\": 50,\n\"win_5\": 500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_5\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 10,\n\"win_4\": 25,\n\"win_5\": 200,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_6\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 5,\n\"win_4\": 20,\n\"win_5\": 100,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_7\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 4,\n\"win_4\": 15,\n\"win_5\": 75,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_8\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 3,\n\"win_4\": 10,\n\"win_5\": 50,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n}\n],\n\"message\": \"List icons success\"\n}', 1, 28, '2023-10-08 22:57:29', '2024-01-12 15:42:01');
INSERT INTO `game_exclusives` VALUES (9, 1, 'hoodvswoolf', 'Hood VS Wolf', '<p>Hood VS Wolf</p>', '01HKZFPCM5X4QJ72E51HTZGG20.png', 'llnN2dNJTN2FAyFYDvoW4pGhX6mQkQ-metadHJhbnNmZXJpci5wbmc=-.png', 1, 20, 20, 1, '{\n\"success\": true,\n\"data\": [\n{\n\"icon_name\": \"Symbol_0\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_1\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_2\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 50,\n\"win_4\": 250,\n\"win_5\": 2500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_3\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 20,\n\"win_4\": 100,\n\"win_5\": 1000,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_4\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 15,\n\"win_4\": 50,\n\"win_5\": 500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_5\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 10,\n\"win_4\": 25,\n\"win_5\": 200,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_6\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 5,\n\"win_4\": 20,\n\"win_5\": 100,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_7\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 4,\n\"win_4\": 15,\n\"win_5\": 75,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_8\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 3,\n\"win_4\": 10,\n\"win_5\": 50,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n}\n],\n\"message\": \"List icons success\"\n}', 1, 18, '2023-10-08 23:07:30', '2024-01-12 15:42:04');
INSERT INTO `game_exclusives` VALUES (10, 1, 'jackfrost', 'Jack Frost´s', '<p>Jack Frost´s</p>', '01HKZFPF0ZEM7QG9B1MWV3567Q.png', 'ciJKswrHRTZocwtMtDfIjerQp7y8od-metaMjQ5MjAyNi5wbmc=-.png', 1, 20, 20, 1, '{\n\"success\": true,\n\"data\": [\n{\n\"icon_name\": \"Symbol_0\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_1\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 0,\n\"win_4\": 0,\n\"win_5\": 0,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_2\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 50,\n\"win_4\": 250,\n\"win_5\": 2500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_3\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 20,\n\"win_4\": 100,\n\"win_5\": 1000,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_4\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 15,\n\"win_4\": 50,\n\"win_5\": 500,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_5\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 10,\n\"win_4\": 25,\n\"win_5\": 200,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_6\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 5,\n\"win_4\": 20,\n\"win_5\": 100,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_7\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 4,\n\"win_4\": 15,\n\"win_5\": 75,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n},\n{\n\"icon_name\": \"Symbol_8\",\n\"win_1\": 0,\n\"win_2\": 0,\n\"win_3\": 3,\n\"win_4\": 10,\n\"win_5\": 50,\n\"win_6\": 0,\n\"wild_card\": null,\n\"free_spin\": null,\n\"free_num\": 0,\n\"scaler_spin\": null\n}\n],\n\"message\": \"List icons success\"\n}', 1, 10, '2023-10-09 20:23:13', '2024-01-12 15:42:07');
INSERT INTO `game_exclusives` VALUES (11, 1, 'songkranparty', 'Song Kran Party', '<p>Song Kran Party</p>', '01HKZFQVH73942P58EGST41K41.jpg', '6li5RylQgxWOwFaKx5ijUbfG8GJ2x7-metaMTQ3MTQzNS0yMDAucG5n-.png', 1, 20, 20, 1, '{\n    \"success\": true,\n    \"data\": [\n        {\n            \"icon_name\": \"Symbol_0\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 0,\n            \"win_4\": 0,\n            \"win_5\": 0,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_1\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 0,\n            \"win_4\": 0,\n            \"win_5\": 0,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_2\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 20,\n            \"win_4\": 50,\n            \"win_5\": 120,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_3\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 15,\n            \"win_4\": 45,\n            \"win_5\": 100,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_4\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 10,\n            \"win_4\": 45,\n            \"win_5\": 80,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_5\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 6,\n            \"win_4\": 15,\n            \"win_5\": 50,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_6\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 30,\n            \"win_4\": 60,\n            \"win_5\": 150,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_7\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 5,\n            \"win_4\": 10,\n            \"win_5\": 40,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_8\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 5,\n            \"win_4\": 10,\n            \"win_5\": 40,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        },\n        {\n            \"icon_name\": \"Symbol_9\",\n            \"win_1\": 0,\n            \"win_2\": 0,\n            \"win_3\": 10,\n            \"win_4\": 45,\n            \"win_5\": 80,\n            \"win_6\": 0,\n            \"wild_card\": null,\n            \"free_spin\": null,\n            \"free_num\": 0,\n            \"scaler_spin\": null\n        }\n    ],\n    \"message\": \"List icons success\"\n}', 1, 19, '2023-10-09 20:25:21', '2024-01-12 15:42:52');
INSERT INTO `game_exclusives` VALUES (12, 1, 'fortunerabbit', 'Fortune Rabbit', '<p>Fortune Rabbit</p>', '01HKZFPHAT5Q5EMWVZJMV9D3YC.png', 'G6c2v0xJxlqTdY3nPMhk4MsyF0cuem-metacmFiaWl0aWNvbi5wbmc=-.png', 1, 20, 20, 1, '[]', 1, 970, '2023-10-10 20:45:45', '2024-01-12 15:42:09');

-- ----------------------------
-- Table structure for games
-- ----------------------------
DROP TABLE IF EXISTS `games`;
CREATE TABLE `games`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_service` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `technology` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `has_lobby` tinyint(4) NOT NULL DEFAULT 0,
  `is_mobile` tinyint(4) NOT NULL DEFAULT 0,
  `has_freespins` tinyint(4) NOT NULL DEFAULT 0,
  `has_tables` tinyint(4) NOT NULL DEFAULT 0,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `views` bigint(20) NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `category_id`(`category_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of games
-- ----------------------------
INSERT INTO `games` VALUES (2, 7, 'Fortune Tiger', 'd2eca6ec0cee46189bcc99620e08f844', '45PcOZKe8thultp9Z1IFpO7UE9dbOx-metadGh1bWItbWFnbmF0YS1mb3J0dW5lLnBuZw==-.png', 'slots', 'PGSoft', 'slotegrator', 'HTML5', 0, 1, 0, 0, 'pgsoft-fortune-tiger', 0, 72, '2023-09-24 22:19:54', '2023-10-07 00:27:07');
INSERT INTO `games` VALUES (3, 8, 'Mines', '7c34301b8c194a99a80bf1082f353bdd', 'PDv47vjk9evn1ynVZS7oXjzRIcxJFd-metabWluZXNwcm8tdGh1bWIucG5n-.png', 'mini games', 'Spribe', 'slotegrator', 'HTML5', 0, 0, 0, 0, 'spribe-mines', 0, 28, '2023-09-29 20:31:04', '2023-10-02 21:20:32');
INSERT INTO `games` VALUES (4, 7, 'Fortune Ox', 'a05e42412e1b4ea2aa385d46cab73815', 'OmGtj5H94ZHXIMIdOdQJBMxbidDUwq-metadGh1bWItZm9ydHVuZW94LnBuZw==-.png', 'slots', 'PGSoft', 'slotegrator', 'HTML5', 0, 1, 0, 0, 'pgsoft-fortune-ox', 0, 5, '2023-09-29 20:39:25', '2023-09-30 06:52:06');
INSERT INTO `games` VALUES (5, 7, 'Fortune Rabbit', 'c3befcf4f6e24010a5bc41da10054f23', 'HvVGCyDvICECXlM3KQClrJNl75ReF1-metadGh1bWItZm9ydHVuZXJhYmJpdC5wbmc=-.png', 'slots', 'PGSoft', 'slotegrator', 'HTML5', 0, 1, 0, 0, 'pgsoft-fortune-rabbit', 0, 12, '2023-09-29 20:42:38', '2023-10-02 12:31:56');
INSERT INTO `games` VALUES (6, 3, 'Aviator', '5b1b299bf4f04b9f84643730a882e682', '8WhyWMX9WocMSTzisdYpTQ2Wv2bHD3-metadGh1bWItYXZpYXRvci1tYWduYXRhLnBuZw==-.png', 'crash', 'PragmaticPlayLive', 'slotegrator', 'HTML5', 0, 0, 0, 0, 'pragmaticplaylive-aviator', 0, 8, '2023-09-29 22:51:21', '2023-10-02 19:50:15');
INSERT INTO `games` VALUES (7, 3, 'Spaceman', 'db196682b2fca3650b42526b642fac3a16a374b5', 'UuvpLelMvtK7LGFTl55ZMq0dM4Jzik-metac3BhY2VtYW4tdGh1bWIucG5n-.png', 'crash', 'PragmaticPlayLive', 'slotegrator', 'HTML5', 0, 0, 0, 0, 'pragmaticplaylive-spaceman', 0, 5, '2023-09-29 23:04:09', '2023-09-30 13:30:31');
INSERT INTO `games` VALUES (8, 7, 'Fortune Mouse', 'b50151fecdcc409b82d2e1542d9c7531', 'oE9xGt81IrgaOoviohAYAahIyVyvfd-metaQnlsTHpkV28xRy1iOTg0NGUwOWFhNjNkYWMwNWI4MjY5NDg0MWEwZjNlNC5wbmc=-.png', 'slots', 'PGSoft', 'slotegrator', 'HTML5', 0, 0, 0, 0, 'pgsoft-fortune-mouse', 0, 16, '2023-09-30 03:11:56', '2023-10-04 09:39:27');
INSERT INTO `games` VALUES (9, 3, 'JetX', 'cfcd1ed15cf62e9cde42482e2dcc0699f2f30d6f', '3xsmvSHyyJCAaJ15Jodn8T01wzAtug-metadGh1bWJqZXR4LnBuZw==-.png', 'slots', 'SmartSoft', 'slotegrator', 'HTML5', 0, 0, 0, 0, 'smartsoft-jetx', 0, 7, '2023-09-30 03:21:43', '2023-10-02 21:03:46');
INSERT INTO `games` VALUES (10, 1, 'Plinko X', 'f6573dfe5225f0d3eb56fc99a4e0eca894268f1e', 'NPAHmHXFnyAESnzOF8sp51YVZ7y59u-metadGh1bWItcGxpbmtveC5wbmc=-.png', 'slots', 'SmartSoft', NULL, 'HTML5', 0, 0, 0, 0, 'smartsoft-plinko-x', 0, 0, '2023-09-30 03:24:06', '2023-09-30 07:26:41');
INSERT INTO `games` VALUES (11, 7, 'Piggy Gold', 'fe21a6cfa2e94e6087a0fdc86dae2f3b', 'wYIGgatRNObHuWwE4ucXnKAWqVHkMv-metacGdzX3BpZ2d5Z29sZC1lbi1VUy5wbmcuZTUyMzY3MTAyYzA0YWM0OGE2ZDRjN2Y1ODFiNDA3NTYucG5n-.png', 'slots', 'PGSoft', 'slotegrator', 'HTML5', 0, 0, 0, 0, 'pgsoft-piggy-gold', 0, 3, '2023-09-30 03:37:33', '2023-09-30 19:11:12');
INSERT INTO `games` VALUES (12, 3, 'Balloon', '9d102c4944c742acbb3ac49dad3bda1e', '2AJCX333BJFDNqHiUtCg5y7n1tFIBO-metadGh1bWItYmFsbG9vbi5wbmc=-.png', 'slots', 'SmartSoft', 'slotegrator', 'HTML5', 0, 0, 0, 0, 'smartsoft-balloon', 0, 9, '2023-09-30 11:03:43', '2023-10-02 20:58:20');
INSERT INTO `games` VALUES (16, 4, 'Plinko', 'd3ea2911ae7c4a1c8230117db0295318', 'ChVHzBeeTgGgxfnzKEJhAhhSAzLrk1-metaaW1hZ2VtXzIwMjMtMDktMzBfMTUxNzA5OTg0LnBuZw==-.png', 'mini games', 'Spribe', 'slotegrator', 'HTML5', 0, 0, 0, 0, 'spribe-plinko', 0, 5, '2023-09-30 12:17:37', '2023-09-30 19:53:28');
INSERT INTO `games` VALUES (14, 7, 'Gates of Olympus Mobile', '260d4a6e9f99c91940517ac650330683f6f42408', 'EUuXwKqZfTUJ433ha5FicmDifZjweG-metadGh1bWItZ2F0ZXMtb2Ytb2x5bXB1cy5wbmc=-.png', 'slots', 'PragmaticPlay', 'slotegrator', 'HTML5', 0, 1, 0, 0, 'pragmaticplay-gates-of-olympus-mobile', 0, 3, '2023-09-30 11:47:52', '2023-10-01 15:59:54');
INSERT INTO `games` VALUES (15, 3, 'Cappadocia', '40f1aaa03a5c403ea3148b17e1894ece', 'WqZ6M9oli8VmY4USb6TUrU3p52kWnT-metadGh1bWItY2FwcGFkb2NpYS5wbmc=-.png', 'slots', 'SmartSoft', 'slotegrator', 'HTML5', 0, 0, 0, 0, 'smartsoft-cappadocia', 0, 11, '2023-09-30 12:02:05', '2023-10-02 20:27:12');
INSERT INTO `games` VALUES (17, 3, 'Football x', 'eb2fbec7b7095e687125e86536e22bf661867bec', 'XZvLSNPGhEcFGMNxfoiJwoSqVY1N0c-metaaW1hZ2VtXzIwMjMtMTAtMDJfMTQ0ODAwMjAwLnBuZw==-.png', 'Crash', 'SmartSoft', 'slotegrator', 'HTML5', 0, 0, 0, 0, 'smartsoft-football-x', 0, 2, '2023-10-02 11:48:04', '2023-10-02 20:03:42');

-- ----------------------------
-- Table structure for games_hashes
-- ----------------------------
DROP TABLE IF EXISTS `games_hashes`;
CREATE TABLE `games_hashes`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `hash` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `games_hashes_user_id_foreign`(`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of games_hashes
-- ----------------------------

-- ----------------------------
-- Table structure for games_keys
-- ----------------------------
DROP TABLE IF EXISTS `games_keys`;
CREATE TABLE `games_keys`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `merchant_url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `merchant_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `merchant_key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `agent_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `agent_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `agent_secret_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `api_endpoint` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `salsa_base_uri` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `salsa_pn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `salsa_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `vibra_site_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `vibra_game_mode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of games_keys
-- ----------------------------
INSERT INTO `games_keys` VALUES (1, 'https://gis.slotegrator.com/api/index.php/v1', NULL, NULL, NULL, NULL, NULL, 'https://api.fiverscool.com', 'https://api-test.salsagator.com/game', NULL, NULL, NULL, 'REAL', '2023-11-30 18:03:08', '2024-01-12 00:06:14');

-- ----------------------------
-- Table structure for gateways
-- ----------------------------
DROP TABLE IF EXISTS `gateways`;
CREATE TABLE `gateways`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `suitpay_uri` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `suitpay_cliente_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `suitpay_cliente_secret` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `stripe_production` tinyint(4) NULL DEFAULT 0,
  `stripe_public_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `stripe_secret_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `stripe_webhook_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bspay_uri` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bspay_cliente_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bspay_cliente_secret` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sqala_app_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sqala_app_secret` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sqala_access_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of gateways
-- ----------------------------
INSERT INTO `gateways` VALUES (1, 'https://ws.suitpay.app/api/v1/', NULL, NULL, 0, NULL, NULL, NULL, '2023-11-30 18:05:51', '2024-01-14 21:52:08', 'https://api.bspay.co/v1/', NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for ggr_games_fivers
-- ----------------------------
DROP TABLE IF EXISTS `ggr_games_fivers`;
CREATE TABLE `ggr_games_fivers`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `provider` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `game` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance_bet` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `balance_win` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `currency` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BRL',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ggr_games_fivers_user_id_index`(`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ggr_games_fivers
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 56 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2023_09_24_214554_add_field_to_users_table', 2);
INSERT INTO `migrations` VALUES (6, '2023_09_24_215008_create_wallets_table', 2);
INSERT INTO `migrations` VALUES (7, '2023_09_24_215356_create_games_table', 2);
INSERT INTO `migrations` VALUES (8, '2023_09_24_215619_create_games_hashes_table', 2);
INSERT INTO `migrations` VALUES (9, '2023_09_24_215903_create_orders_table', 2);
INSERT INTO `migrations` VALUES (10, '2023_09_24_233733_create_settings_table', 3);
INSERT INTO `migrations` VALUES (11, '2023_09_24_211517_create_teams_table', 4);
INSERT INTO `migrations` VALUES (12, '2023_09_24_214013_add_team_id_to_users_table', 5);
INSERT INTO `migrations` VALUES (13, '2023_09_25_113635_create_withdrawals_table', 6);
INSERT INTO `migrations` VALUES (14, '2023_09_25_113654_create_deposits_table', 6);
INSERT INTO `migrations` VALUES (15, '2023_09_25_204419_add_fields_to_settings_table', 7);
INSERT INTO `migrations` VALUES (16, '2023_09_24_214008_create_categories_table', 8);
INSERT INTO `migrations` VALUES (17, '2023_09_27_214903_create_wallet_changes_table', 9);
INSERT INTO `migrations` VALUES (18, '2023_09_30_230009_create_transactions_table', 10);
INSERT INTO `migrations` VALUES (19, '2023_10_01_171432_add_smtp_to_settings_table', 11);
INSERT INTO `migrations` VALUES (20, '2023_10_02_213820_create_affiliate_histories_table', 12);
INSERT INTO `migrations` VALUES (22, '2023_10_07_183921_create_game_exclusives_table', 13);
INSERT INTO `migrations` VALUES (23, '2023_10_08_111755_add_fields_to_game_exclusives_table', 14);
INSERT INTO `migrations` VALUES (24, '2023_10_10_010619_create_soccer_categories_table', 15);
INSERT INTO `migrations` VALUES (25, '2023_10_10_010632_create_soccer_matches_table', 15);
INSERT INTO `migrations` VALUES (26, '2023_10_10_010641_create_soccer_bets_table', 15);
INSERT INTO `migrations` VALUES (27, '2023_10_11_144956_create_system_wallets_table', 16);
INSERT INTO `migrations` VALUES (31, '2023_10_12_185145_create_permission_tables', 18);
INSERT INTO `migrations` VALUES (30, '2023_10_12_183005_create_teams_table', 17);
INSERT INTO `migrations` VALUES (32, '2023_10_13_005036_add_is_admin_to_users_table', 19);
INSERT INTO `migrations` VALUES (33, '2023_10_16_103614_create_permission_tables', 20);
INSERT INTO `migrations` VALUES (34, '2023_10_17_105300_create_suit_pay_payments_table', 21);
INSERT INTO `migrations` VALUES (35, '2023_10_17_212504_create_notifications_table', 22);
INSERT INTO `migrations` VALUES (36, '2023_10_21_112530_create_bet_sections_table', 23);
INSERT INTO `migrations` VALUES (37, '2023_10_21_112532_create_bet_categories_table', 24);
INSERT INTO `migrations` VALUES (38, '2023_10_21_112826_create_bet_events_table', 25);
INSERT INTO `migrations` VALUES (39, '2023_10_21_112906_create_bet_users_table', 26);
INSERT INTO `migrations` VALUES (40, '2023_10_23_115759_add_auth_to_users_table', 27);
INSERT INTO `migrations` VALUES (41, '2023_10_25_132459_create_game_pragmatics_table', 28);
INSERT INTO `migrations` VALUES (42, '2023_10_25_140317_create_game_logs_table', 28);
INSERT INTO `migrations` VALUES (43, '2023_10_25_150440_create_jpg_table', 29);
INSERT INTO `migrations` VALUES (44, '2023_10_25_152044_create_sessions_table', 29);
INSERT INTO `migrations` VALUES (45, '2023_11_30_195548_create_gateways_table', 30);
INSERT INTO `migrations` VALUES (46, '2023_11_30_195557_create_games_keys_table', 31);
INSERT INTO `migrations` VALUES (47, '2023_11_30_195609_create_setting_mails_table', 32);
INSERT INTO `migrations` VALUES (48, '2023_12_18_172721_create_banners_table', 33);
INSERT INTO `migrations` VALUES (49, '2023_12_19_121013_add_customization_to_settings_table', 34);
INSERT INTO `migrations` VALUES (50, '2023_12_19_123142_add_bspay_to_gateways_table', 34);
INSERT INTO `migrations` VALUES (51, '2023_12_23_224032_create_fivers_providers_table', 35);
INSERT INTO `migrations` VALUES (52, '2023_12_23_224105_create_fivers_games_table', 35);
INSERT INTO `migrations` VALUES (53, '2023_12_20_135908_create_casino_games_salsas_table', 36);
INSERT INTO `migrations` VALUES (54, '2024_01_11_231932_create_vibra_casino_games_table', 36);
INSERT INTO `migrations` VALUES (55, '2024_01_01_193712_create_g_g_r_games_fivers_table', 37);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 1);
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 134);

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `notifications_notifiable_type_notifiable_id_index`(`notifiable_type`, `notifiable_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of notifications
-- ----------------------------

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `transaction_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `game` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_money` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `providers` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `refunded` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `round_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `orders_user_id_foreign`(`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'games-exclusive-edit', 'web', '2023-10-12 16:23:45', '2023-10-12 18:12:28');
INSERT INTO `permissions` VALUES (2, 'games-exclusive-view', 'web', '2023-10-12 16:23:56', '2023-10-12 18:11:25');
INSERT INTO `permissions` VALUES (3, 'games-exclusive-create', 'web', '2023-10-12 16:25:06', '2023-10-12 18:11:10');
INSERT INTO `permissions` VALUES (4, 'admin-view', 'web', '2023-10-12 17:56:35', '2023-10-12 17:56:35');
INSERT INTO `permissions` VALUES (5, 'admin-create', 'web', '2023-10-12 18:56:02', '2023-10-12 18:56:02');
INSERT INTO `permissions` VALUES (6, 'admin-edit', 'web', '2023-10-12 18:56:27', '2023-10-12 18:56:27');
INSERT INTO `permissions` VALUES (7, 'admin-delete', 'web', '2023-10-12 18:56:55', '2023-10-12 18:56:55');
INSERT INTO `permissions` VALUES (8, 'category-view', 'web', '2023-10-12 19:01:31', '2023-10-12 19:01:31');
INSERT INTO `permissions` VALUES (9, 'category-create', 'web', '2023-10-12 19:01:46', '2023-10-12 19:01:46');
INSERT INTO `permissions` VALUES (10, 'category-edit', 'web', '2023-10-12 19:01:59', '2023-10-12 19:01:59');
INSERT INTO `permissions` VALUES (11, 'category-delete', 'web', '2023-10-12 19:02:09', '2023-10-12 19:02:09');
INSERT INTO `permissions` VALUES (12, 'game-view', 'web', '2023-10-12 19:02:27', '2023-10-12 19:02:27');
INSERT INTO `permissions` VALUES (13, 'game-create', 'web', '2023-10-12 19:02:36', '2023-10-12 19:02:36');
INSERT INTO `permissions` VALUES (14, 'game-edit', 'web', '2023-10-12 19:02:44', '2023-10-12 19:02:44');
INSERT INTO `permissions` VALUES (15, 'game-delete', 'web', '2023-10-12 19:02:54', '2023-10-12 19:02:54');
INSERT INTO `permissions` VALUES (16, 'wallet-view', 'web', '2023-10-12 19:05:49', '2023-10-12 19:05:49');
INSERT INTO `permissions` VALUES (17, 'wallet-create', 'web', '2023-10-12 19:06:01', '2023-10-12 19:06:01');
INSERT INTO `permissions` VALUES (18, 'wallet-edit', 'web', '2023-10-12 19:06:11', '2023-10-12 19:06:11');
INSERT INTO `permissions` VALUES (19, 'wallet-delete', 'web', '2023-10-12 19:06:18', '2023-10-12 19:06:18');
INSERT INTO `permissions` VALUES (20, 'deposit-view', 'web', '2023-10-12 19:06:44', '2023-10-12 19:06:44');
INSERT INTO `permissions` VALUES (21, 'deposit-create', 'web', '2023-10-12 19:06:56', '2023-10-12 19:06:56');
INSERT INTO `permissions` VALUES (22, 'deposit-edit', 'web', '2023-10-12 19:07:05', '2023-10-12 19:07:05');
INSERT INTO `permissions` VALUES (23, 'deposit-update', 'web', '2023-10-12 19:08:00', '2023-10-12 19:08:00');
INSERT INTO `permissions` VALUES (24, 'deposit-delete', 'web', '2023-10-12 19:08:11', '2023-10-12 19:08:11');
INSERT INTO `permissions` VALUES (25, 'withdrawal-view', 'web', '2023-10-12 19:09:31', '2023-10-12 19:09:31');
INSERT INTO `permissions` VALUES (26, 'withdrawal-create', 'web', '2023-10-12 19:09:40', '2023-10-12 19:09:40');
INSERT INTO `permissions` VALUES (27, 'withdrawal-edit', 'web', '2023-10-12 19:09:51', '2023-10-12 19:09:51');
INSERT INTO `permissions` VALUES (28, 'withdrawal-update', 'web', '2023-10-12 19:10:00', '2023-10-12 19:10:00');
INSERT INTO `permissions` VALUES (29, 'withdrawal-delete', 'web', '2023-10-12 19:10:09', '2023-10-12 19:10:09');
INSERT INTO `permissions` VALUES (30, 'order-view', 'web', '2023-10-12 19:12:36', '2023-10-12 19:12:36');
INSERT INTO `permissions` VALUES (31, 'order-create', 'web', '2023-10-12 19:12:47', '2023-10-12 19:12:47');
INSERT INTO `permissions` VALUES (32, 'order-edit', 'web', '2023-10-12 19:12:56', '2023-10-12 19:12:56');
INSERT INTO `permissions` VALUES (33, 'order-update', 'web', '2023-10-12 19:13:06', '2023-10-12 19:13:06');
INSERT INTO `permissions` VALUES (34, 'order-delete', 'web', '2023-10-12 19:13:19', '2023-10-12 19:13:19');
INSERT INTO `permissions` VALUES (35, 'admin-menu-view', 'web', '2023-10-12 20:26:06', '2023-10-12 20:26:06');
INSERT INTO `permissions` VALUES (36, 'setting-view', 'web', '2023-10-12 21:25:46', '2023-10-12 21:25:46');
INSERT INTO `permissions` VALUES (37, 'setting-create', 'web', '2023-10-12 21:25:57', '2023-10-12 21:25:57');
INSERT INTO `permissions` VALUES (38, 'setting-edit', 'web', '2023-10-12 21:26:06', '2023-10-12 21:26:06');
INSERT INTO `permissions` VALUES (39, 'setting-update', 'web', '2023-10-12 21:26:19', '2023-10-12 21:26:19');
INSERT INTO `permissions` VALUES (40, 'setting-delete', 'web', '2023-10-12 21:26:33', '2023-10-12 21:26:33');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin', 'web', '2023-10-12 16:20:41', '2023-10-12 16:20:41');
INSERT INTO `roles` VALUES (2, 'afiliado', 'web', '2023-10-12 16:21:08', '2023-10-12 16:21:08');

-- ----------------------------
-- Table structure for setting_mails
-- ----------------------------
DROP TABLE IF EXISTS `setting_mails`;
CREATE TABLE `setting_mails`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `software_smtp_type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `software_smtp_mail_host` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `software_smtp_mail_port` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `software_smtp_mail_username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `software_smtp_mail_password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `software_smtp_mail_encryption` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `software_smtp_mail_from_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `software_smtp_mail_from_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of setting_mails
-- ----------------------------

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `software_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `software_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `software_favicon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `software_logo_white` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `software_logo_black` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `currency_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BRL',
  `decimal_format` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dot',
  `currency_position` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'left',
  `revshare_percentage` bigint(20) NULL DEFAULT 20,
  `ngr_percent` bigint(20) NULL DEFAULT 20,
  `soccer_percentage` bigint(20) NULL DEFAULT 30,
  `prefix` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'R$',
  `storage` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'local',
  `initial_bonus` bigint(20) NULL DEFAULT 0,
  `min_deposit` decimal(10, 2) NULL DEFAULT 20.00,
  `max_deposit` decimal(10, 2) NULL DEFAULT 0.00,
  `min_withdrawal` decimal(10, 2) NULL DEFAULT 20.00,
  `max_withdrawal` decimal(10, 2) NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `maintenance_mode` tinyint(4) NULL DEFAULT 0,
  `rollover` bigint(20) NULL DEFAULT 1,
  `rollover_deposit` bigint(20) NULL DEFAULT 1,
  `instagram` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `discord` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `telegram` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `twitter` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tiktok` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `whatsapp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `active_gateway` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'bspay',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES (1, 'Viper', 'Viiper plataforma de Cassino', 'uploads/V83e4sf9QFOrhuMEa2jn8JjIsfFKkHBdIBeCl8s7.png', 'uploads/77HurxHeGIwbNfvJYzR4BTuQiNVEBlVIPdNGKYij.png', 'uploads/fEm7xUQjyUPJmhotqVQrnsSHfZoDD7o6pwrJUqcB.png', 'BRL', 'dot', 'left', 20, 20, 30, 'R$', 'local', 100, 20.00, 50000.00, 20.00, 50000.00, '2023-09-24 17:40:05', '2024-01-13 22:44:53', 0, 10, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'sqala');

-- ----------------------------
-- Table structure for suit_pay_payments
-- ----------------------------
DROP TABLE IF EXISTS `suit_pay_payments`;
CREATE TABLE `suit_pay_payments`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `withdrawal_id` bigint(20) NULL DEFAULT NULL,
  `pix_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pix_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `amount` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `observation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` tinyint(4) NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `suit_pay_payments_user_id_foreign`(`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of suit_pay_payments
-- ----------------------------

-- ----------------------------
-- Table structure for system_wallets
-- ----------------------------
DROP TABLE IF EXISTS `system_wallets`;
CREATE TABLE `system_wallets`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(27, 12) NOT NULL DEFAULT 0.000000000000,
  `balance_min` decimal(27, 12) NOT NULL DEFAULT 10000.100000000000,
  `pay_upto_percentage` decimal(4, 2) NOT NULL DEFAULT 45.00,
  `mode` enum('balance_min','percentage') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of system_wallets
-- ----------------------------
INSERT INTO `system_wallets` VALUES (1, 'system', 261.800000000000, 10000.100000000000, 45.00, 'percentage', '2023-10-11 16:11:15', '2023-10-16 18:42:00');

-- ----------------------------
-- Table structure for team_user
-- ----------------------------
DROP TABLE IF EXISTS `team_user`;
CREATE TABLE `team_user`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `team_user_team_id_index`(`team_id`) USING BTREE,
  INDEX `team_user_user_id_index`(`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of team_user
-- ----------------------------

-- ----------------------------
-- Table structure for teams
-- ----------------------------
DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of teams
-- ----------------------------

-- ----------------------------
-- Table structure for transactions
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `payment_method` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `price` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `currency` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'usd',
  `status` tinyint(4) NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `transactions_user_id_index`(`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transactions
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` tinyint(4) NULL DEFAULT 3,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cpf` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `token_time` bigint(20) NULL DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `logged_in` tinyint(4) NULL DEFAULT 0,
  `banned` tinyint(4) NULL DEFAULT 0,
  `inviter` int(10) UNSIGNED NULL DEFAULT NULL,
  `affiliate_revenue_share` decimal(20, 2) NULL DEFAULT 0.00,
  `affiliate_cpa` decimal(20, 2) NULL DEFAULT 0.00,
  `affiliate_baseline` decimal(20, 2) NULL DEFAULT 0.00,
  `is_demo_agent` tinyint(4) NULL DEFAULT 0,
  `oauth_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `oauth_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kscinus` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 136 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 0, 'Admin', 1, NULL, NULL, NULL, 'admin@demo.com', NULL, '$2y$10$8IViREJTQIAXRY7n9D3UDuhes4bNjBTSaz0E/in5uNb1LX6ZWgNQq', '25F1JeK1ZziZ1KWnoYU1iCLFT6rgXJYZj5a8SiKLEE5A5uC5ZrFksg5qUgxE', 1696659991, 'ff8e95055e285d0e5d0cbd733a6ffb20b042c539d61ab8b2b28358a152cdc09e', 0, 0, 10, 40.00, 20.00, 0.00, 1, NULL, NULL, 'active', '2023-09-24 18:13:49', '2024-01-03 12:21:20', 1);

-- ----------------------------
-- Table structure for vibra_casino_games
-- ----------------------------
DROP TABLE IF EXISTS `vibra_casino_games`;
CREATE TABLE `vibra_casino_games`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `game_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_cover` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vibra_casino_games
-- ----------------------------
INSERT INTO `vibra_casino_games` VALUES (1, 'Popeye', 'POPEYE6M4', '01HKYWVGZEMQRQYK2PM2GNGN5B.jpg', 1, '2024-01-12 10:12:49', '2024-01-12 10:12:49');
INSERT INTO `vibra_casino_games` VALUES (2, 'Backjack x3', 'BLACKJACK1X3', '01HKYX9SY3ZEWBZFHSWCMJ09J3.png', 1, '2024-01-12 10:20:37', '2024-01-12 10:20:37');

-- ----------------------------
-- Table structure for wallet_changes
-- ----------------------------
DROP TABLE IF EXISTS `wallet_changes`;
CREATE TABLE `wallet_changes`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reason` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `change` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `value_bonus` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `value_total` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `value_roi` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `value_entry` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `game` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of wallet_changes
-- ----------------------------

-- ----------------------------
-- Table structure for wallets
-- ----------------------------
DROP TABLE IF EXISTS `wallets`;
CREATE TABLE `wallets`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `balance` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `balance_bonus` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `balance_bonus_rollover` decimal(20, 2) NULL DEFAULT 0.00,
  `anti_bot` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `total_bet` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `total_won` decimal(20, 2) NULL DEFAULT 0.00,
  `total_lose` decimal(20, 2) NULL DEFAULT 0.00,
  `last_won` decimal(20, 2) NULL DEFAULT 0.00,
  `last_lose` decimal(20, 2) NULL DEFAULT 0.00,
  `hide_balance` tinyint(4) NULL DEFAULT 0,
  `refer_rewards` decimal(20, 2) NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `wallets_user_id_foreign`(`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 130 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of wallets
-- ----------------------------
INSERT INTO `wallets` VALUES (1, 1, 1000.00, 1000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, '2023-09-24 17:31:42', '2024-01-14 22:27:36');

-- ----------------------------
-- Table structure for withdrawals
-- ----------------------------
DROP TABLE IF EXISTS `withdrawals`;
CREATE TABLE `withdrawals`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `proof` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `chave_pix` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tipo_chave` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `withdrawals_user_id_foreign`(`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of withdrawals
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
