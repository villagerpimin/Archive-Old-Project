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

 Date: 30/06/2021 08:51:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for game
-- ----------------------------
DROP TABLE IF EXISTS `game`;
CREATE TABLE `game`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `nametitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `price` double(255, 2) NULL DEFAULT NULL,
  `daze` double(255, 2) NULL DEFAULT NULL,
  `typename` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cover` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pingtai` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `tag` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 210 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of game
-- ----------------------------
INSERT INTO `game` VALUES (1, '凤凰福袋', '凤凰福袋', 1.00, 1.00, '福利', './images/game_img/img (1).jpg', './images/cover_img/img (1).jpg', './images/steam.png', '2011-06-06', NULL);
INSERT INTO `game` VALUES (2, '游戏盲盒', '游戏盲盒', 1.00, 1.00, '福利', './images/game_img/img (2).jpg', './images/cover_img/img (2).jpg', './images/steam.png', '2011-06-06', NULL);
INSERT INTO `game` VALUES (3, '古剑奇谭', 'Gu Jian Qi Tan', 39.00, 4.00, '角色扮演RPG', './images/game_img/img (3).jpg', './images/cover_img/img (3).jpg', './images/steam.png', '2010-07-10', NULL);
INSERT INTO `game` VALUES (4, '古剑奇谭三', 'Gu Jian Qi Tan 3', 99.00, 29.00, '角色扮演RPG', './images/game_img/img (4).jpg', './images/cover_img/img (4).jpg', './images/steam.png', '2018-11-23', NULL);
INSERT INTO `game` VALUES (5, '古剑奇谭2', 'Gu Jian Qi Tan 2', 49.00, 6.00, '角色扮演RPG', './images/game_img/img (5).jpg', './images/cover_img/img (5).jpg', './images/steam.png', '2018-11-23', NULL);
INSERT INTO `game` VALUES (6, '幻想三国志2', 'Fantasia Sanguo 2', 29.00, 1.50, '角色扮演RPG', './images/game_img/img (6).jpg', './images/cover_img/img (6).jpg', './images/steam.png', '2005-07-31', NULL);
INSERT INTO `game` VALUES (7, '凶手不是我', 'Perfect Crime', 68.00, 22.00, '角色扮演RPG', './images/game_img/img (7).jpg', './images/cover_img/img (7).jpg', './images/steam.png', '2020-10-01', NULL);
INSERT INTO `game` VALUES (8, '只狼：影逝二度', 'Sekiro: Shadows Die Twice', 268.00, 134.00, '动作游戏ACT', './images/game_img/img (8).jpg', './images/cover_img/img (8).jpg', './images/steam.png', '2019-03-21', NULL);
INSERT INTO `game` VALUES (9, '死亡搁浅', 'Death Stranding', 298.00, 119.00, '动作游戏ACT', './images/game_img/img (9).jpg', './images/cover_img/img (9).jpg', './images/steam.png', '2020-07-14', NULL);
INSERT INTO `game` VALUES (10, '生化危机8：村庄', 'Resident Evil Village', 396.00, 348.00, '冒险游戏AVG', './images/game_img/img (10).jpg', './images/cover_img/img (10).jpg', './images/steam.png', '2021-05-07', NULL);
INSERT INTO `game` VALUES (11, '幻想三国志1', 'Fantasia Sango 1', 19.00, 1.50, '策略战棋SLG', './images/game_img/img (11).jpg', './images/cover_img/img (11).jpg', './images/steam.png', '2003-07-18', NULL);
INSERT INTO `game` VALUES (12, '绯红结系', 'Scarlet Nexus', 328.00, 285.00, '动作游戏ACT', './images/game_img/img (12).jpg', './images/cover_img/img (12).jpg', './images/steam.png', '2021-06-25', NULL);
INSERT INTO `game` VALUES (13, '我来自江湖', 'From Jianghu', 36.00, 17.00, '策略战棋SLG', './images/game_img/img (13).jpg', './images/cover_img/img (13).jpg', './images/steam.png', '2020-07-25', NULL);
INSERT INTO `game` VALUES (14, '江湖余生：缘起', 'Jiang Hu Yu Sheng', 39.00, 22.00, '模拟经营SIM', './images/game_img/img (14).jpg', './images/cover_img/img (14).jpg', './images/steam.png', '2021-02-28', NULL);
INSERT INTO `game` VALUES (15, '归家异途', 'HomeBehind', 18.00, 6.00, '冒险游戏AVG', './images/game_img/img (15).jpg', './images/cover_img/img (15).jpg', './images/steam.png', '2016-06-03', NULL);
INSERT INTO `game` VALUES (16, '三教', 'The 3rd Building', 40.00, 34.00, '冒险游戏AVG', './images/game_img/img (16).jpg', './images/cover_img/img (16).jpg', './images/steam.png', '2016-06-03', NULL);
INSERT INTO `game` VALUES (17, '三国群英传7', 'Sango Heroes 7', 29.00, 20.30, '策略战棋SLG', './images/game_img/img (17).jpg', './images/cover_img/img (17).jpg', './images/steam.png', '2007-12-19', NULL);
INSERT INTO `game` VALUES (18, '军团', 'LEGIONCRAFT', 36.00, 21.00, '策略战棋SLG', './images/game_img/img (18).jpg', './images/cover_img/img (18).jpg', './images/steam.png', '2019-11-01', NULL);
INSERT INTO `game` VALUES (19, '死亡细胞', 'Dead Cells', 80.00, 48.00, '动作游戏ACT', './images/game_img/img (19).jpg', './images/cover_img/img (19).jpg', './images/steam.png', '2018-08-07', NULL);
INSERT INTO `game` VALUES (20, '武林志', 'Wushu Chronicles', 66.00, 19.00, '角色扮演RPG', './images/game_img/img (20).jpg', './images/cover_img/img (20).jpg', './images/steam.png', '2019-04-10', NULL);
INSERT INTO `game` VALUES (21, '天命奇御', 'Fate seeker', 75.00, 37.00, '角色扮演RPG', './images/game_img/img (21).jpg', './images/cover_img/img (21).jpg', './images/steam.png', '2018-08-08', NULL);
INSERT INTO `game` VALUES (22, '幻想三国志四外传', 'Fantasy Sanguo 4 SP', 49.00, 9.50, '角色扮演RPG', './images/game_img/img (22).jpg', './images/cover_img/img (22).jpg', './images/steam.png', '2008-07-02', NULL);
INSERT INTO `game` VALUES (23, '幻想三国志4', 'Fantasia Sango 4', 49.00, 4.50, '角色扮演RPG', './images/game_img/img (23).jpg', './images/cover_img/img (23).jpg', './images/steam.png', '2007-12-04', NULL);
INSERT INTO `game` VALUES (24, '仁王2', 'NIOH 2', 249.00, 224.00, '动作游戏ACT', './images/game_img/img (24).jpg', './images/cover_img/img (24).jpg', './images/steam.png', '2021-02-05', NULL);
INSERT INTO `game` VALUES (25, '国土防线2：革命', 'Homefront: The Revolution', 70.00, 13.00, '第一人称射击FPS', './images/game_img/img (25).jpg', './images/cover_img/img (25).jpg', './images/steam.png', '2016-05-17', NULL);
INSERT INTO `game` VALUES (26, '侠客风云传前传', 'Tale of Wuxia:The Pre-Sequel', 55.00, 27.00, '角色扮演RPG', './images/game_img/img (26).jpg', './images/cover_img/img (26).jpg', './images/steam.png', '2016-09-28', NULL);
INSERT INTO `game` VALUES (27, '幻想三国志5', 'Fantasia Sango 5', 65.00, 32.00, '角色扮演RPG', './images/game_img/img (27).jpg', './images/cover_img/img (27).jpg', './images/steam.png', '2018-04-25', NULL);
INSERT INTO `game` VALUES (28, '地铁2033', 'METRO 2033', 68.00, 13.00, '第一人称射击FPS', './images/game_img/img (28).jpg', './images/cover_img/img (28).jpg', './images/steam.png', '2010-03-14', NULL);
INSERT INTO `game` VALUES (29, '洛川群侠传', 'Luo Chuan Qun Xia Zhuan', 50.00, 9.00, '角色扮演RPG', './images/game_img/img (29).jpg', './images/cover_img/img (29).jpg', './images/steam.png', '2016-03-25', NULL);
INSERT INTO `game` VALUES (30, '游戏盲盒', '游戏盲盒', 3.00, 3.00, '福利', './images/game_img/img (30).jpg', './images/cover_img/img (30).jpg', './images/steam.png', '2019-09-01', NULL);
INSERT INTO `game` VALUES (31, '神力科莎', 'Assetto Corsa', 70.00, 14.00, '赛车竞速RAC', './images/game_img/img (31).jpg', './images/cover_img/img (31).jpg', './images/steam.png', '2013-12-25', NULL);
INSERT INTO `game` VALUES (32, '杀手已死', 'Killer is Dead', 68.00, 13.00, '动作游戏ACT', './images/game_img/img (32).jpg', './images/cover_img/img (32).jpg', './images/steam.png', '2014-05-23', NULL);
INSERT INTO `game` VALUES (33, '风之幻想曲', 'Fantasia of the Wind', 18.00, 3.00, '角色扮演RPG', './images/game_img/img (33).jpg', './images/cover_img/img (33).jpg', './images/steam.png', '2017-10-26', NULL);
INSERT INTO `game` VALUES (34, '德波尼亚：完整旅程', 'Deponia: The Complete Journey', 119.00, 11.00, '冒险游戏AVG', './images/game_img/img (34).jpg', './images/cover_img/img (34).jpg', './images/steam.png', '2014-07-08', NULL);
INSERT INTO `game` VALUES (35, '敌军前线', 'Enemy Front', 70.00, 11.00, '第一人称射击FPS', './images/game_img/img (35).jpg', './images/cover_img/img (35).jpg', './images/steam.png', '2014-06-11', NULL);
INSERT INTO `game` VALUES (36, '汐', 'Shio', 38.00, 14.00, '动作游戏ACT', './images/game_img/img (36).jpg', './images/cover_img/img (36).jpg', './images/steam.png', '2017-05-05', NULL);
INSERT INTO `game` VALUES (37, '侠之道', 'PathOfWuxia', 68.00, 57.00, '角色扮演RPG', './images/game_img/img (37).jpg', './images/cover_img/img (37).jpg', './images/steam.png', '2020-05-01', NULL);
INSERT INTO `game` VALUES (38, '魔法对抗', 'Magicka', 36.00, 29.00, '角色扮演RPG', './images/game_img/img (38).jpg', './images/cover_img/img (38).jpg', './images/steam.png', '2011-01-25', NULL);
INSERT INTO `game` VALUES (39, '刺客信条：导演剪辑版', 'Assassin\'s Creed - Director\'s Cut', 48.00, 14.00, '动作游戏ACT', './images/game_img/img (39).jpg', './images/cover_img/img (39).jpg', './images/steam.png', '2008-04-10', NULL);
INSERT INTO `game` VALUES (40, '失落城堡', 'Lost Castle', 33.00, 13.00, '动作游戏ACT', './images/game_img/img (40).jpg', './images/cover_img/img (40).jpg', './images/steam.png', '2016-09-01', NULL);
INSERT INTO `game` VALUES (41, '堕落之王', 'Lords of the Fallen', 88.00, 13.00, '角色扮演RPG', './images/game_img/img (41).jpg', './images/cover_img/img (41).jpg', './images/steam.png', '2014-10-28', NULL);
INSERT INTO `game` VALUES (42, '邪恶天才', 'Evil Genius', 36.00, 29.00, '策略战棋SLG', './images/game_img/img (42).jpg', './images/cover_img/img (42).jpg', './images/steam.png', '2007-10-31', NULL);
INSERT INTO `game` VALUES (43, '刺客信条：大革命', 'Assassin\'s Creed: Unity', 148.00, 22.00, '动作游戏ACT', './images/game_img/img (43).jpg', './images/cover_img/img (43).jpg', './images/steam.png', '2014-11-11', NULL);
INSERT INTO `game` VALUES (44, '地下世界：崛起', 'Underworld Ascendant', 88.00, 13.00, '角色扮演RPG', './images/game_img/img (44).jpg', './images/cover_img/img (44).jpg', './images/steam.png', '2018-11-16', NULL);
INSERT INTO `game` VALUES (45, '骑马与砍杀2', 'Mount and Blade II: Bannerlord', 248.00, 178.00, '角色扮演RPG', './images/game_img/img (45).jpg', './images/cover_img/img (45).jpg', './images/steam.png', '2020-03-30', NULL);
INSERT INTO `game` VALUES (46, '武器店物语', 'Weapon Shop Fantasy', 36.00, 6.00, '模拟经营SIM', './images/game_img/img (46).jpg', './images/cover_img/img (46).jpg', './images/steam.png', '2017-03-28', NULL);
INSERT INTO `game` VALUES (47, '直面黑暗', 'Face Noir', 36.00, 31.00, '冒险游戏AVG', './images/game_img/img (47).jpg', './images/cover_img/img (47).jpg', './images/steam.png', '2013-10-18', NULL);
INSERT INTO `game` VALUES (48, '加菲猫卡丁车:激情竞速', 'Garfield Kart - Furious Racing', 50.00, 15.00, '赛车竞速RAC', './images/game_img/img (48).jpg', './images/cover_img/img (48).jpg', './images/steam.png', '2019-11-07', NULL);
INSERT INTO `game` VALUES (49, '纸片限界', 'Paperbound', 36.00, 29.00, '动作游戏ACT', './images/game_img/img (49).jpg', './images/cover_img/img (49).jpg', './images/steam.png', '2015-04-01', NULL);
INSERT INTO `game` VALUES (50, '孤岛惊魂2：命运扩展版', 'Far Cry 2', 48.00, 14.00, '第一人称射击FPS', './images/game_img/img (50).jpg', './images/cover_img/img (50).jpg', './images/steam.png', '2008-10-23', NULL);
INSERT INTO `game` VALUES (51, '末日之战', 'Tom Clancy\'s EndWar', 48.00, 14.00, '动作游戏ACT', './images/game_img/img (51).jpg', './images/cover_img/img (51).jpg', './images/steam.png', '2009-02-26', NULL);
INSERT INTO `game` VALUES (52, '至高爱国者联盟全季：第2章', 'Supreme League of Patriots Issue 2: Patriot Frames', 25.00, 21.00, '冒险游戏AVG', './images/game_img/img (52).jpg', './images/cover_img/img (52).jpg', './images/steam.png', '2015-01-30', NULL);
INSERT INTO `game` VALUES (53, '汤姆克兰西：幽灵行动', 'Tom Clancys Ghost Recon', 48.00, 14.00, '第一人称射击FPS', './images/game_img/img (53).jpg', './images/cover_img/img (53).jpg', './images/steam.png', '2008-07-15', NULL);
INSERT INTO `game` VALUES (54, '雷曼：起源', 'Rayman Origins', 48.00, 14.00, '动作游戏ACT', './images/game_img/img (54).jpg', './images/cover_img/img (54).jpg', './images/steam.png', '2012-03-30', NULL);
INSERT INTO `game` VALUES (55, '空中破坏', 'Aerial Destruction', 22.00, 9.00, '动作射击STG', './images/game_img/img (55).jpg', './images/cover_img/img (55).jpg', './images/steam.png', '2017-05-19', NULL);
INSERT INTO `game` VALUES (56, '按钮向上', 'Button Button Up', 35.00, 35.00, '休闲益智PUZ', './images/game_img/img (56).jpg', './images/cover_img/img (56).jpg', './images/steam.png', '2019-08-09', NULL);
INSERT INTO `game` VALUES (57, '德军总部2：新巨人', 'Wolfenstein II: The New Colossus', 199.00, 64.00, '第一人称射击FPS', './images/game_img/img (57).jpg', './images/cover_img/img (57).jpg', './images/steam.png', '2017-10-27', NULL);
INSERT INTO `game` VALUES (58, '幻象杀手：重制版', 'Fahrenheit: Indigo Prophecy Remastered', 36.00, 31.00, '冒险游戏AVG', './images/game_img/img (58).jpg', './images/cover_img/img (58).jpg', './images/steam.png', '2015-01-29', NULL);
INSERT INTO `game` VALUES (59, '刺客信条编年史：俄罗斯', 'Assassin\'s Creed Chronicles - Russia', 48.00, 14.00, '动作游戏ACT', './images/game_img/img (59).jpg', './images/cover_img/img (59).jpg', './images/steam.png', '2016-02-09', NULL);
INSERT INTO `game` VALUES (60, '孤岛惊魂3：血龙', 'Far Cry 3 - Blood Dragon', 75.00, 11.00, '第一人称射击FPS', './images/game_img/img (60).jpg', './images/cover_img/img (60).jpg', './images/steam.png', '2013-05-02', NULL);
INSERT INTO `game` VALUES (61, '三国群英传5', 'Sango Heroes 5', 19.00, 13.30, '策略战棋SLG', './images/game_img/img (61).jpg', './images/cover_img/img (61).jpg', './images/steam.png', '2005-02-02', NULL);
INSERT INTO `game` VALUES (62, '托奇', 'Toki', 70.00, 14.00, '动作游戏ACT', './images/game_img/img (62).jpg', './images/cover_img/img (62).jpg', './images/steam.png', '2019-06-07', NULL);
INSERT INTO `game` VALUES (63, '超级云路', 'Super Cloudbuilt', 68.00, 19.00, '动作游戏ACT', './images/game_img/img (63).jpg', './images/cover_img/img (63).jpg', './images/steam.png', '2017-07-25', NULL);
INSERT INTO `game` VALUES (64, '残酷乐队生涯', 'Cruel Bands Career', 22.00, 15.00, '冒险游戏AVG', './images/game_img/img (64).jpg', './images/cover_img/img (64).jpg', './images/steam.png', '2020-08-06', NULL);
INSERT INTO `game` VALUES (65, '英雄传说：科乐征服者', 'Heroes & Legends: Conquerors of Kolhar', 36.00, 31.00, '角色扮演RPG', './images/game_img/img (65).jpg', './images/cover_img/img (65).jpg', './images/steam.png', '2014-08-21', NULL);
INSERT INTO `game` VALUES (66, '刺客信条编年史：中国', 'Assassin\'s Creed Chronicles - China', 48.00, 14.00, '动作游戏ACT', './images/game_img/img (66).jpg', './images/cover_img/img (66).jpg', './images/steam.png', '2015-04-22', NULL);
INSERT INTO `game` VALUES (67, '孤岛惊魂', 'Far Cry', 48.00, 14.00, '第一人称射击FPS', './images/game_img/img (67).jpg', './images/cover_img/img (67).jpg', './images/steam.png', '2008-04-02', NULL);
INSERT INTO `game` VALUES (68, '摩托英豪4', 'Moto Racer 4', 90.00, 13.00, '赛车竞速RAC', './images/game_img/img (68).jpg', './images/cover_img/img (68).jpg', './images/steam.png', '2016-11-03', NULL);
INSERT INTO `game` VALUES (69, '狙击手：幽灵战士契约', 'Sniper Ghost Warrior Contracts', 98.00, 29.00, '第一人称射击FPS', './images/game_img/img (69).jpg', './images/cover_img/img (69).jpg', './images/steam.png', '2019-11-23', NULL);
INSERT INTO `game` VALUES (70, '汤姆克兰西：全境封锁2 PC版 纽约军阀DLC', 'Tom Clancy\'s The Division 2 - Warlords of New York Expansion', 148.00, 44.00, '第三人称射击TPS', './images/game_img/img (70).jpg', './images/cover_img/img (70).jpg', './images/steam.png', '2019-03-15', NULL);
INSERT INTO `game` VALUES (71, '拯救大魔王重生', 'Falsemen: Demon Rebirth', 5.40, 3.00, '角色扮演RPG', './images/game_img/img (71).jpg', './images/cover_img/img (71).jpg', './images/steam.png', '2019-03-22', NULL);
INSERT INTO `game` VALUES (72, '隔离', 'Quarantine', 36.00, 29.00, '策略战棋SLG', './images/game_img/img (72).jpg', './images/cover_img/img (72).jpg', './images/steam.png', '2017-05-24', NULL);
INSERT INTO `game` VALUES (73, '刺客信条编年史：印度', 'Assassin’s Creed Chronicles: India', 48.00, 14.00, '动作游戏ACT', './images/game_img/img (73).jpg', './images/cover_img/img (73).jpg', './images/steam.png', '2016-01-12', NULL);
INSERT INTO `game` VALUES (74, '英雄之地', 'A Land Fit For Heroes', 36.00, 29.00, '角色扮演RPG', './images/game_img/img (74).jpg', './images/cover_img/img (74).jpg', './images/steam.png', '2016-05-04', NULL);
INSERT INTO `game` VALUES (75, '视觉之上', 'Beyond Eyes', 48.00, 41.00, '冒险游戏AVG', './images/game_img/img (75).jpg', './images/cover_img/img (75).jpg', './images/steam.png', '2015-08-12', NULL);
INSERT INTO `game` VALUES (76, '永恒:最后的独角兽', 'Eternity: The Last Unicorn', 70.00, 14.00, '角色扮演RPG', './images/game_img/img (76).jpg', './images/cover_img/img (76).jpg', './images/steam.png', '2019-03-06', NULL);
INSERT INTO `game` VALUES (77, '刺客信条：英灵殿', 'Assassin’s Creed Valhalla', 498.00, 374.00, '动作游戏ACT', './images/game_img/img (77).jpg', './images/cover_img/img (77).jpg', './images/steam.png', '2020-11-09', NULL);
INSERT INTO `game` VALUES (78, '凤凰福袋', '凤凰福袋', 3.00, 3.00, '福利', './images/game_img/img (78).jpg', './images/cover_img/img (78).jpg', './images/steam.png', '2011-06-06', NULL);
INSERT INTO `game` VALUES (79, '兄弟：双子传说', 'Brother: A Tale of Two Sons', 48.00, 9.00, '动作游戏ACT', './images/game_img/img (79).jpg', './images/cover_img/img (79).jpg', './images/steam.png', '2013-09-04', NULL);
INSERT INTO `game` VALUES (80, '刺客信条2', 'Assassins Creed 2', 48.00, 14.00, '冒险游戏AVG', './images/game_img/img (80).jpg', './images/cover_img/img (80).jpg', './images/steam.png', '2010-03-04', NULL);
INSERT INTO `game` VALUES (81, '绝地求生大逃杀', 'PlayerUnknown’s Battlegrounds', 98.00, 89.00, '动作游戏ACT', './images/game_img/img (81).jpg', './images/cover_img/img (81).jpg', './images/steam.png', '2017-03-24', NULL);
INSERT INTO `game` VALUES (82, '闪回重制版', 'Flashback Remastered', 37.00, 3.00, '动作游戏ACT', './images/game_img/img (82).jpg', './images/cover_img/img (82).jpg', './images/steam.png', '2019-02-28', NULL);
INSERT INTO `game` VALUES (83, '变形僵尸', 'Three Dead Zed', 25.00, 9.00, '动作游戏ACT', './images/game_img/img (83).jpg', './images/cover_img/img (83).jpg', './images/steam.png', '2014-07-08', NULL);
INSERT INTO `game` VALUES (84, '黑道圣徒4', 'Saints Row 4', 34.00, 9.90, '第三人称射击TPS', './images/game_img/img (84).jpg', './images/cover_img/img (84).jpg', './images/steam.png', '2013-08-23', NULL);
INSERT INTO `game` VALUES (85, '三国群英传8', 'Heroes of the Three Kingdoms 8', 128.00, 115.00, '策略战棋SLG', './images/game_img/img (85).jpg', './images/cover_img/img (85).jpg', './images/steam.png', '2021-01-12', NULL);
INSERT INTO `game` VALUES (86, '死亡岛', 'Dead Island', 58.00, 14.00, '第一人称射击FPS', './images/game_img/img (86).jpg', './images/cover_img/img (86).jpg', './images/steam.png', '2016-05-31', NULL);
INSERT INTO `game` VALUES (87, '凤凰福袋', '凤凰福袋', 5.00, 5.00, '福利', './images/game_img/img (87).jpg', './images/cover_img/img (87).jpg', './images/steam.png', '2011-06-06', NULL);
INSERT INTO `game` VALUES (88, '天命奇御', 'Fate seeker', 58.00, 29.00, '角色扮演RPG', './images/game_img/img (88).jpg', './images/cover_img/img (88).jpg', './images/steam.png', '2018-08-08', NULL);
INSERT INTO `game` VALUES (89, '地铁：最后的曙光', 'Metro: Last Light', 68.00, 13.00, '第一人称射击FPS', './images/game_img/img (89).jpg', './images/cover_img/img (89).jpg', './images/steam.png', '2013-05-14', NULL);
INSERT INTO `game` VALUES (90, '三国群英传6', 'Sango Heroes 6', 19.00, 13.30, '策略战棋SLG', './images/game_img/img (90).jpg', './images/cover_img/img (90).jpg', './images/steam.png', '2006-01-23', NULL);
INSERT INTO `game` VALUES (91, '塞伯利亚之谜3', 'Syberia 3', 90.00, 9.00, '冒险游戏AVG', './images/game_img/img (91).jpg', './images/cover_img/img (91).jpg', './images/steam.png', '2017-11-14', NULL);
INSERT INTO `game` VALUES (92, '彩虹六号：围攻', 'Rainbow Six:Siege', 118.00, 39.00, '第一人称射击FPS', './images/game_img/img (92).jpg', './images/cover_img/img (92).jpg', './images/steam.png', '2015-11-28', NULL);
INSERT INTO `game` VALUES (93, '泠：落日孤行', 'Ling: A Road Alone', 24.00, 9.00, '动作游戏ACT', './images/game_img/img (93).jpg', './images/cover_img/img (93).jpg', './images/steam.png', '2019-09-17', NULL);
INSERT INTO `game` VALUES (94, '胜利法典', 'Codex of Victory', 48.00, 9.60, '策略战棋SLG', './images/game_img/img (94).jpg', './images/cover_img/img (94).jpg', './images/steam.png', '2017-03-17', NULL);
INSERT INTO `game` VALUES (95, '国王的恩赐：北方勇士', 'King\'s Bounty: Warriors of the North', 36.00, 9.00, '策略战棋SLG', './images/game_img/img (95).jpg', './images/cover_img/img (95).jpg', './images/steam.png', '2012-10-26', NULL);
INSERT INTO `game` VALUES (96, '敌后奇兵', 'SHOCK TROOPERS', 31.00, 15.00, '动作游戏ACT', './images/game_img/img (96).jpg', './images/cover_img/img (96).jpg', './images/steam.png', '2016-05-18', NULL);
INSERT INTO `game` VALUES (97, '永劫回廊', 'Neverinth', 38.00, 11.00, '动作游戏ACT', './images/game_img/img (97).jpg', './images/cover_img/img (97).jpg', './images/steam.png', '2020-06-17', NULL);
INSERT INTO `game` VALUES (98, '枪猴', 'Gun Monkeys', 25.00, 9.00, '动作游戏ACT', './images/game_img/img (98).jpg', './images/cover_img/img (98).jpg', './images/steam.png', '2013-07-02', NULL);
INSERT INTO `game` VALUES (99, '足球经理2021', 'Football Manager 2021', 249.00, 186.00, '模拟经营SIM', './images/game_img/img (99).jpg', './images/cover_img/img (99).jpg', './images/steam.png', '2020-11-24', NULL);
INSERT INTO `game` VALUES (100, '三国群英传8', 'Heroes of the Three Kingdoms 8', 128.00, 115.00, '策略战棋SLG', './images/game_img/img (100).jpg', './images/cover_img/img (100).jpg', './images/steam.png', '2021-01-12', NULL);
INSERT INTO `game` VALUES (101, '科林麦克雷拉力赛之尘埃3', 'Colin McRae DiRT 3', 48.00, 9.00, '赛车竞速RAC', './images/game_img/img (101).jpg', './images/cover_img/img (101).jpg', './images/steam.png', '2011-05-24', NULL);
INSERT INTO `game` VALUES (102, '七人杀阵', 'Seven Sacrifices', 28.00, 12.00, '冒险游戏AVG', './images/game_img/img (102).jpg', './images/cover_img/img (102).jpg', './images/steam.png', '2018-09-14', NULL);
INSERT INTO `game` VALUES (103, '死亡岛：激流', 'Dead Island：Riptide', 58.00, 14.00, '第一人称射击FPS', './images/game_img/img (103).jpg', './images/cover_img/img (103).jpg', './images/steam.png', '2016-05-31', NULL);
INSERT INTO `game` VALUES (104, '死亡岛：原始复仇', 'Dead Island Retro Revenge', 21.00, 9.90, '动作游戏ACT', './images/game_img/img (104).jpg', './images/cover_img/img (104).jpg', './images/steam.png', '2016-06-01', NULL);
INSERT INTO `game` VALUES (105, '国王的恩赐：戎装公主', 'Kings Bounty: Armored Princess', 36.00, 9.00, '策略战棋SLG', './images/game_img/img (105).jpg', './images/cover_img/img (105).jpg', './images/steam.png', '2009-11-20', NULL);
INSERT INTO `game` VALUES (106, '黎明杀机 PC版 寂静岭', 'Dead By Daylight - Silent Hill Chapter', 28.00, 16.00, '冒险,动作', './images/img_box/img/img (1).jpg', './images/img_box/cover/img (1).jpg', './images/steam.png', '2016-06-15', '黎明杀机 系列');
INSERT INTO `game` VALUES (107, '黎明杀机 PC版 魂灵之面', 'Dead by Daylight: Ghost Face®', 22.00, 13.00, '冒险,动作', './images/img_box/img/img (2).jpg', './images/img_box/cover/img (2).jpg', './images/steam.png', '2016-06-15', '黎明杀机 系列');
INSERT INTO `game` VALUES (108, '黎明杀机 PC版 万圣节', 'Dead by Daylight - The Halloween® Chapte', 28.00, 16.00, '冒险,动作', './images/img_box/img/img (3).jpg', './images/img_box/cover/img (3).jpg', './images/steam.png', '2016-06-15', '黎明杀机 系列');
INSERT INTO `game` VALUES (109, '黎明杀机 PC版 仇恨之链', 'Dead by Daylight - Chains of Hate Chapter', 28.00, 16.00, '冒险,动作', './images/img_box/img/img (4).jpg', './images/img_box/cover/img (4).jpg', './images/steam.png', '2016-06-15', '黎明杀机 系列');
INSERT INTO `game` VALUES (110, '黎明杀机', 'Dead by Daylight ', 82.00, 49.00, '冒险,动作', './images/img_box/img/img (5).jpg', './images/img_box/cover/img (5).jpg', './images/steam.png', '2016-06-15', '黎明杀机 系列');
INSERT INTO `game` VALUES (111, '告死天使的审判', 'Death Angel Trial', 20.00, 12.00, '冒险游戏AVG', './images/img_box/img/img (6).jpg', './images/img_box/cover/img (6).jpg', './images/steam.png', '2020-08-03', '冷笑黑妖 2折起');
INSERT INTO `game` VALUES (112, '趣拼拼：拼图工坊', 'Pleasure Puzzle:Workshop', 6.00, 3.00, '休闲益智', './images/img_box/img/img (7).jpg', './images/img_box/cover/img (7).jpg', './images/steam.png', '2018-11-01', '冷笑黑妖 2折起');
INSERT INTO `game` VALUES (113, '亚利利亚的精灵们', 'ALILIA', 6.00, 3.00, '角色扮演RPG', './images/img_box/img/img (8).jpg', './images/img_box/cover/img (8).jpg', './images/steam.png', '2019-04-05', '冷笑黑妖 2折起');
INSERT INTO `game` VALUES (114, '告死天使之言', 'Death angel', 6.00, 3.00, '冒险游戏AVG', './images/img_box/img/img (9).jpg', './images/img_box/cover/img (9).jpg', './images/steam.png', '2019-08-10', '冷笑黑妖 2折起');
INSERT INTO `game` VALUES (115, '\r\n寇莎梅特：困世迷情', 'Consummate:Missing World', 6.00, 3.00, '角色扮演RPG', './images/img_box/img/img (10).jpg', './images/img_box/cover/img (10).jpg', './images/steam.png', '2017-07-22', '冷笑黑妖 2折起');
INSERT INTO `game` VALUES (116, '最终幻想7：重制过渡版', 'FINAL FANTASY VII REMAKE INTERGRADE', 749.00, 568.00, '角色扮演RPG', './images/img_box/img/img (11).jpg', './images/img_box/cover/img (11).jpg', './images/steam.png', '2021-06-10', '即将上市 精选游戏');
INSERT INTO `game` VALUES (117, '永劫无间', 'Naraka: Bladepoint', 98.00, 97.00, '动作游戏ACT', './images/img_box/img/img (12).jpg', './images/img_box/cover/img (12).jpg', './images/steam.png', '2021-07-08', '即将上市 精选游戏');
INSERT INTO `game` VALUES (118, '孤岛惊魂6', 'Far Cry 6', 298.00, 298.00, '第一人称射击FPS', './images/img_box/img/img (13).jpg', './images/img_box/cover/img (13).jpg', './images/steam.png', '2021-10-07', '即将上市 精选游戏');
INSERT INTO `game` VALUES (119, '彩虹六号：异种', 'Rainbow Six:Quarantine', 298.00, 298.00, '第一人称射击FPS', './images/img_box/img/img (14).jpg', './images/img_box/cover/img (14).jpg', './images/steam.png', '2021-09-30', '即将上市 精选游戏');
INSERT INTO `game` VALUES (120, '战国无双5', 'Samurai Warriors 5', 527.00, 447.00, '动作游戏ACT', './images/img_box/img/img (15).jpg', './images/img_box/cover/img (15).jpg', './images/steam.png', '2021-07-27', '即将上市 精选游戏');
INSERT INTO `game` VALUES (121, '战国无双5', 'Samurai Warriors 5', 527.00, 447.00, '动作游戏ACT', './images/img_box/img/img (16).jpg', './images/img_box/cover/img (16).jpg', './images/box.png', '2021-07-27', '主机也疯狂');
INSERT INTO `game` VALUES (122, '微软游戏会员卡', 'Xbox Game Pass', 119.00, 99.00, '角色扮演RPG', './images/img_box/img/img (17).jpg', './images/img_box/cover/img (17).jpg', './images/box.png', '2019-08-10', '主机也疯狂');
INSERT INTO `game` VALUES (123, '任天堂 港区点卡', 'eshop', 100.00, 85.00, '角色扮演RPG', './images/img_box/img/img (18).jpg', './images/img_box/cover/img (18).jpg', './images/box.png', '2019-08-10', '主机也疯狂');
INSERT INTO `game` VALUES (124, '消逝的光芒2', 'Dying Light 2', 468.00, 397.00, '动作游戏ACT', './images/img_box/img/img (19).jpg', './images/img_box/cover/img (19).jpg', './images/box.png', '2021-12-07', '主机也疯狂');
INSERT INTO `game` VALUES (125, '索尼PSN点卡', 'PlayStation Network', 80.00, 66.00, '角色扮演RPG', './images/img_box/img/img (20).jpg', './images/img_box/cover/img (20).jpg', './images/box.png', '2019-08-10', '主机也疯狂');
INSERT INTO `game` VALUES (126, '凶手不是我', 'Perfect Crime', 68.00, 22.00, '角色扮演RPG', './images/img_box/img/img (21).jpg', './images/img_box/cover/img (21).jpg', './images/steam.png', '2020-10-01', '热销');
INSERT INTO `game` VALUES (127, '只狼：影逝二度', 'Sekiro: Shadows Die Twice', 268.00, 134.00, '动作游戏ACT', './images/img_box/img/img (22).jpg', './images/img_box/cover/img (22).jpg', './images/steam.png', '2019-03-21', '热销');
INSERT INTO `game` VALUES (128, '绯红结系', 'Scarlet Nexus', 328.00, 285.00, '动作游戏ACT', './images/img_box/img/img (23).jpg', './images/img_box/cover/img (23).jpg', './images/steam.png', '2021-06-25', '热销');
INSERT INTO `game` VALUES (129, '我来自江湖', 'From Jianghu', 36.00, 17.00, '策略战棋SLG', './images/img_box/img/img (24).jpg', './images/img_box/cover/img (24).jpg', './images/steam.png', '2020-07-25', '热销');
INSERT INTO `game` VALUES (130, '江湖余生：缘起', 'Jiang Hu Yu Sheng', 39.00, 22.00, '模拟经营', './images/img_box/img/img (25).jpg', './images/img_box/cover/img (25).jpg', './images/steam.png', '2021-02-28', '热销');
INSERT INTO `game` VALUES (131, '三教', 'The 3rd Building', 40.00, 34.00, '冒险游戏AVG', './images/img_box/img/img (26).jpg', './images/img_box/cover/img (26).jpg', './images/steam.png', '2019-08-10', '热销');
INSERT INTO `game` VALUES (132, '三国群英传7', 'Sango Heroes 7', 29.00, 20.00, '策略战棋SLG', './images/img_box/img/img (27).jpg', './images/img_box/cover/img (27).jpg', './images/steam.png', '2007-12-19', '热销');
INSERT INTO `game` VALUES (133, '军团', 'LEGIONCRAFT', 36.00, 21.00, '策略战棋SLG', './images/img_box/img/img (28).jpg', './images/img_box/cover/img (28).jpg', './images/steam.png', '2019-11-01', '热销');
INSERT INTO `game` VALUES (134, '仁王2', 'NIOH 2', 249.00, 224.00, '动作游戏ACT', './images/img_box/img/img (29).jpg', './images/img_box/cover/img (29).jpg', './images/steam.png', '2021-02-05', '热销');
INSERT INTO `game` VALUES (135, '侠客风云传前传', 'Tale of Wuxia:The Pre-Sequel', 55.00, 27.00, '角色扮演RPG', './images/img_box/img/img (30).jpg', './images/img_box/cover/img (30).jpg', './images/steam.png', '2016-09-28', '热销');
INSERT INTO `game` VALUES (136, '高等动物', 'Higher Critters', 52.00, 46.00, '动作游戏ACT', './images/img_box/img/img (31).jpg', './images/img_box/cover/img (31).jpg', './images/steam.png', '2021-06-25', '热销');
INSERT INTO `game` VALUES (137, '圣剑传说：玛纳传奇', 'Legend of Mana', 198.00, 190.00, '角色扮演RPG', './images/img_box/img/img (32).jpg', './images/img_box/cover/img (32).jpg', './images/steam.png', '2021-06-25', '热销');
INSERT INTO `game` VALUES (138, '绯红结系', 'Scarlet Nexus', 328.00, 287.00, '动作游戏ACT', './images/img_box/img/img (33).jpg', './images/img_box/cover/img (33).jpg', './images/steam.png', '2021-06-25', '热销');
INSERT INTO `game` VALUES (139, '马里奥高尔夫：超级冲刺', 'Mario Golf Super Rush', 360.00, 360.00, '体育竞技', './images/img_box/img/img (34).jpg', './images/img_box/cover/img (34).jpg', './images/steam.png', '2021-06-25', '热销');
INSERT INTO `game` VALUES (140, '绯红结系 PS4版', 'Scarlet Nexus', 479.00, 403.00, '动作游戏ACT', './images/img_box/img/img (35).jpg', './images/img_box/cover/img (35).jpg', './images/steam.png', '2021-06-25', '热销');
INSERT INTO `game` VALUES (141, '绯红结系', 'Scarlet Nexus', 479.00, 398.00, '动作游戏ACT', './images/img_box/img/img (36).jpg', './images/img_box/cover/img (36).jpg', './images/steam.png', '2021-06-25', '热销');
INSERT INTO `game` VALUES (142, '边界之外', 'Out of Line', 45.60, 38.00, '冒险游戏AVG', './images/img_box/img/img (37).jpg', './images/img_box/cover/img (37).jpg', './images/steam.png', '2021-06-23', '热销');
INSERT INTO `game` VALUES (143, '龙与地下城：黑暗联盟', 'Dungeons & Dragons: Dark Alliance - Standard Edition', 284.00, 272.00, '角色扮演RPG', './images/img_box/img/img (38).jpg', './images/img_box/cover/img (38).jpg', './images/steam.png', '2021-06-23', '热销');
INSERT INTO `game` VALUES (144, '迷宫大侦探', 'Labyrinth City', 41.00, 33.00, '冒险游戏AVG', './images/img_box/img/img (39).jpg', './images/img_box/cover/img (39).jpg', './images/steam.png', '2021-06-22', '热销');
INSERT INTO `game` VALUES (145, '红至日2：幸存者', 'Red Solstice 2: Survivors', 98.00, 88.00, '策略战棋SLG', './images/img_box/img/img (40).jpg', './images/img_box/cover/img (40).jpg', './images/steam.png', '2021-06-17', '热销');
INSERT INTO `game` VALUES (146, '永劫无间', 'Naraka: Bladepoint', 98.00, 97.00, '动作游戏ACT', './images/img_box/img/img (41).jpg', './images/img_box/cover/img (41).jpg', './images/steam.png', '2021-07-08', '热销');
INSERT INTO `game` VALUES (147, '怪物猎人物语2：破灭之翼', 'Monster Hunter Stories 2: Wings of Ruin', 396.00, 380.00, '动作游戏ACT', './images/img_box/img/img (42).jpg', './images/img_box/cover/img (42).jpg', './images/steam.png', '2021-07-09', '热销');
INSERT INTO `game` VALUES (148, 'F1 2021', 'F1 2021', 248.00, 248.00, '赛车竞速RAC', './images/img_box/img/img (43).jpg', './images/img_box/cover/img (43).jpg', './images/steam.png', '2021-07-17', '热销');
INSERT INTO `game` VALUES (149, '战国无双5', 'Samurai Warriors 5', 527.00, 447.00, '动作游戏ACT', './images/img_box/img/img (44).jpg', './images/img_box/cover/img (44).jpg', './images/steam.png', '2021-07-26', '热销');
INSERT INTO `game` VALUES (150, '上行战场', 'The Ascent', 148.00, 133.00, '角色扮演RPG', './images/img_box/img/img (45).jpg', './images/img_box/cover/img (45).jpg', './images/steam.png', '2021-07-30', '热销');
INSERT INTO `game` VALUES (151, '雷能思之门', 'Lemnis Gate', 70.00, 53.00, '第一人称射击FPS', './images/img_box/img/img (46).jpg', './images/img_box/cover/img (46).jpg', './images/steam.png', '2021-08-03', '热销');
INSERT INTO `game` VALUES (152, '人类', 'HUMANKIND', 279.00, 221.00, '策略战棋SLG', './images/img_box/img/img (47).jpg', './images/img_box/cover/img (47).jpg', './images/steam.png', '2021-08-18', '热销');
INSERT INTO `game` VALUES (153, '意航员2', 'Psychonauts 2', 169.00, 162.00, '动作游戏ACT', './images/img_box/img/img (48).jpg', './images/img_box/cover/img (48).jpg', './images/steam.png', '2021-08-25', '热销');
INSERT INTO `game` VALUES (154, '破晓传奇', 'Tales of Arise', 328.00, 314.00, '角色扮演RPG', './images/img_box/img/img (49).jpg', './images/img_box/cover/img (49).jpg', './images/steam.png', '2021-09-10', '热销');
INSERT INTO `game` VALUES (155, '死亡循环', 'Deathloop', 199.00, 199.00, '冒险游戏AVG', './images/img_box/img/img (50).jpg', './images/img_box/cover/img (50).jpg', './images/steam.png', '2021-08-25', '热销');
INSERT INTO `game` VALUES (156, '幻想三国志2', 'Fantasia Sanguo 2', 29.00, 1.50, '角色扮演RPG', './images/img_box/img/img (51).jpg', './images/img_box/cover/img (51).jpg', './images/steam.png', '2005-07-31', '热销');
INSERT INTO `game` VALUES (157, '幻想三国志3', 'Fantasia Sango 3', 39.00, 1.50, '角色扮演RPG', './images/img_box/img/img (52).jpg', './images/img_box/cover/img (52).jpg', './images/steam.png', '2007-01-23', '热销');
INSERT INTO `game` VALUES (158, '收获日2', 'Payday 2', 37.00, 2.00, '第一人称射击FPS', './images/img_box/img/img (53).jpg', './images/img_box/cover/img (53).jpg', './images/steam.png', '2013-08-13', '热销');
INSERT INTO `game` VALUES (159, '逃离涂鸦之地', 'Escape Doodland', 37.00, 2.00, '动作游戏ACT', './images/img_box/img/img (54).jpg', './images/img_box/cover/img (54).jpg', './images/steam.png', '2018-11-30', '热销');
INSERT INTO `game` VALUES (160, '库尔斯克', 'kursk', 70.00, 2.00, '动作游戏ACT', './images/img_box/img/img (55).jpg', './images/img_box/cover/img (55).jpg', './images/steam.png', '2018-11-08', '热销');
INSERT INTO `game` VALUES (161, '黑色艉流', 'Blackwake', 37.00, 2.00, '第一人称射击FPS', './images/img_box/img/img (56).jpg', './images/img_box/cover/img (56).jpg', './images/steam.png', '2020-02-20', '热销');
INSERT INTO `game` VALUES (162, '无法逃脱的城堡2', 'Castle of no Escape 2', 60.00, 2.00, '动作游戏ACT', './images/img_box/img/img (57).jpg', './images/img_box/cover/img (57).jpg', './images/steam.png', '2016-12-22', '热销');
INSERT INTO `game` VALUES (163, '银河战队', 'Galaxy Squad', 37.00, 2.00, '策略战棋SLG', './images/img_box/img/img (58).jpg', './images/img_box/cover/img (58).jpg', './images/steam.png', '2019-05-25', '热销');
INSERT INTO `game` VALUES (164, '1943致命沙漠', '1943 Deadly Desert', 37.00, 2.00, '策略战棋SLG', './images/img_box/img/img (59).jpg', './images/img_box/cover/img (59).jpg', './images/steam.png', '2018-05-15', '热销');
INSERT INTO `game` VALUES (165, '绝地求生大逃杀 ', '狂鸡队吉祥物玩偶服 头套', 235.00, 7.05, '动作游戏ACT', './images/img_box/img/img (60).jpg', './images/img_box/cover/img (60).jpg', './images/steam.png', '2017-03-24', '热销');

SET FOREIGN_KEY_CHECKS = 1;
