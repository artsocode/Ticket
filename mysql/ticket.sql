/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50537
Source Host           : localhost:3306
Source Database       : ticket

Target Server Type    : MYSQL
Target Server Version : 50537
File Encoding         : 65001

Date: 2014-04-30 12:26:44
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cinema`
-- ----------------------------
DROP TABLE IF EXISTS `cinema`;
CREATE TABLE `cinema` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id кинотеатра',
  `cinema_name` varchar(255) NOT NULL COMMENT 'Название кинотеатра',
  `cinema_address` varchar(255) NOT NULL COMMENT 'Адрес кинотеатра',
  `cinema_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Кинотеатры';

-- ----------------------------
-- Records of cinema
-- ----------------------------
INSERT INTO `cinema` VALUES ('1', 'Кино мост', 'г. Самара, ул. Ново-Садовая 160, ТРК Мегасити', 'В крутом торговом центре, самый крутой кинотеатр города!');
INSERT INTO `cinema` VALUES ('2', 'Volga Plaza', 'г. Самара, ул. Красноармейская 1 \"Б\" - Бизнес Центр \"Volga Plaza\"', 'В самом сердце Самары -  первый и единственный КИНОТЕАТР НА КРЫШЕ  под стеклянным куполом. Мы работаем в любую погоду и время года');
INSERT INTO `cinema` VALUES ('3', 'Ракурс', 'г. Самара, ул. Вилоновская, д. 24', 'Лучшие картины мирового кинематографа демонстрируются в киноклубе «Ракурс», расположенного в помещении Самарского Дома Актера. Именно в «Ракурсе» показывают эксклюзивные, часто недоступные, но по-настоящему любопытные фильмы. Киноклуб Ракурс - отличная находка не только для истинных ценителей кино, но и тех, кто только начинает постигать азы кинематографа или желает расширить свой культурный уровень.');

-- ----------------------------
-- Table structure for `cinema_hall`
-- ----------------------------
DROP TABLE IF EXISTS `cinema_hall`;
CREATE TABLE `cinema_hall` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id зала',
  `cinema_id` int(11) unsigned NOT NULL COMMENT 'Ссылка на id кинотеатра',
  `hall_number` tinyint(3) unsigned NOT NULL COMMENT 'Номер зала',
  PRIMARY KEY (`id`),
  KEY `unique_cinema_id` (`cinema_id`) USING BTREE,
  CONSTRAINT `cinema_hall_id_fk` FOREIGN KEY (`cinema_id`) REFERENCES `cinema` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Залы кинотеатров';

-- ----------------------------
-- Records of cinema_hall
-- ----------------------------
INSERT INTO `cinema_hall` VALUES ('1', '1', '1');
INSERT INTO `cinema_hall` VALUES ('2', '1', '2');
INSERT INTO `cinema_hall` VALUES ('3', '1', '3');
INSERT INTO `cinema_hall` VALUES ('4', '2', '1');
INSERT INTO `cinema_hall` VALUES ('5', '2', '2');
INSERT INTO `cinema_hall` VALUES ('6', '3', '1');

-- ----------------------------
-- Table structure for `film`
-- ----------------------------
DROP TABLE IF EXISTS `film`;
CREATE TABLE `film` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id фильма',
  `film_name` varchar(255) NOT NULL COMMENT 'Название фильма',
  `film_description` text NOT NULL COMMENT 'Описание фильма',
  `film_vertical_poster` varchar(255) NOT NULL COMMENT 'Имя вертикального постера для фильма',
  `film_horizontal_poster` varchar(255) NOT NULL COMMENT 'Имя горизонтального постера для фильма\n',
  `film_rating` float unsigned NOT NULL COMMENT 'Рейтинг фильма',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Фильмы';

-- ----------------------------
-- Records of film
-- ----------------------------
INSERT INTO `film` VALUES ('1', 'Человек-паук: Высокое напряжение', 'Питер Паркер под маской Человека-паука по-прежнему спасает мир от злодеев и преступников, а свободное время проводит со своей возлюбленной Гвен, но школьная пора близится к концу, и впереди героев ждет взрослая жизнь. Питер помнит о том, что дал отцу Гвен слово навсегда уйти из жизни девушки, тем самым больше не подвергая ее опасности. Однако сдержать это обещание не так просто. Судьба готовит Питеру сюрпризы: на его пути появится новый противник — Электро, а также ему будет суждено вновь встретиться с давним приятелем Гарри Озборном и узнать много нового о прошлом своей семьи.', '602409.jpg', '1.jpg', '8');
INSERT INTO `film` VALUES ('2', 'Побудь в моей шкуре', 'Действие развивается в Шотландии, где каждый день по трассе Эдинбург-Глазго ездит задрипанная машина с роскошным водителем. За рулем пышногрудая брюнетка с огромными зелеными глазами. Она подбирает автостопщиков, в основном здоровых и мощных мужчин, и парализует их. Девица на поверку оказывается представительницей иной цивилизации, чьи сородичи развели бурную деятельность в Шотландии…', '467241.jpg', '2.jpg', '8');
INSERT INTO `film` VALUES ('3', 'Газгольдер: Фильм', 'У Басты и его друзей произошел серьезный конфликт с могущественным кланом силовиков. Ребятам предстоит найти выход из сложившейся ситуации, включив всю мощь творческой энергии.', '809032.jpg', '3.jpg', '6');
INSERT INTO `film` VALUES ('4', 'Оторвы', 'Они настоящие блондинки, даже несмотря на то, что одна из них брюнетка.', '477906.jpg', '4.jpg', '7');

-- ----------------------------
-- Table structure for `film_moment`
-- ----------------------------
DROP TABLE IF EXISTS `film_moment`;
CREATE TABLE `film_moment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id записи',
  `moment_image` varchar(255) NOT NULL COMMENT 'Имя момента',
  `film_id` int(11) unsigned NOT NULL COMMENT 'Id фильма',
  PRIMARY KEY (`id`),
  KEY `unique_film_id` (`film_id`) USING BTREE,
  CONSTRAINT `moment_film_id_fk` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='Кадры из фильма';

-- ----------------------------
-- Records of film_moment
-- ----------------------------
INSERT INTO `film_moment` VALUES ('2', '1.jpg', '1');
INSERT INTO `film_moment` VALUES ('6', '2.jpg', '1');
INSERT INTO `film_moment` VALUES ('7', '3.jpg', '1');
INSERT INTO `film_moment` VALUES ('8', '4.jpg', '1');
INSERT INTO `film_moment` VALUES ('9', '5.jpg', '1');
INSERT INTO `film_moment` VALUES ('10', '6.jpg', '2');
INSERT INTO `film_moment` VALUES ('11', '7.jpg', '2');
INSERT INTO `film_moment` VALUES ('12', '8.jpg', '2');
INSERT INTO `film_moment` VALUES ('13', '9.jpg', '3');
INSERT INTO `film_moment` VALUES ('14', '10.jpg', '3');
INSERT INTO `film_moment` VALUES ('15', '11.jpg', '3');
INSERT INTO `film_moment` VALUES ('16', '12.jpg', '4');
INSERT INTO `film_moment` VALUES ('17', '13.jpg', '4');
INSERT INTO `film_moment` VALUES ('18', '14.jpg', '4');
INSERT INTO `film_moment` VALUES ('19', '15.jpg', '4');

-- ----------------------------
-- Table structure for `schedule`
-- ----------------------------
DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id расписания',
  `schedule_date` int(11) unsigned NOT NULL COMMENT 'Метка даты и времени сеанса',
  `film_id` int(11) unsigned NOT NULL COMMENT 'Id фильма для данного времени',
  `cinema_hall_id` int(11) NOT NULL,
  `temp_date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unique_film_id` (`film_id`) USING BTREE,
  CONSTRAINT `schedule_film_id_fk` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='Расписание кино';

-- ----------------------------
-- Records of schedule
-- ----------------------------
INSERT INTO `schedule` VALUES ('31', '1398402600', '1', '2', '9:10');
INSERT INTO `schedule` VALUES ('32', '1398406800', '3', '1', '10:20');
INSERT INTO `schedule` VALUES ('33', '1398411000', '2', '2', '11:30');
INSERT INTO `schedule` VALUES ('34', '1398414600', '2', '1', '12:30');
INSERT INTO `schedule` VALUES ('35', '1398417300', '3', '2', '13:15');
INSERT INTO `schedule` VALUES ('36', '1398418200', '4', '3', '13:30');
INSERT INTO `schedule` VALUES ('37', '1398420600', '4', '1', '14:10');
INSERT INTO `schedule` VALUES ('38', '1398426000', '4', '2', '15:40');
INSERT INTO `schedule` VALUES ('39', '1398429600', '3', '3', '16:40');
INSERT INTO `schedule` VALUES ('40', '1398432600', '1', '1', '17:30');
INSERT INTO `schedule` VALUES ('41', '1398435600', '1', '3', '18:20');
INSERT INTO `schedule` VALUES ('42', '1398447000', '2', '3', '21:30');
INSERT INTO `schedule` VALUES ('43', '1398406800', '4', '4', '10:20');
INSERT INTO `schedule` VALUES ('44', '1398414600', '2', '4', '12:30');
INSERT INTO `schedule` VALUES ('45', '1398420600', '4', '4', '14:10');
INSERT INTO `schedule` VALUES ('46', '1398432600', '1', '4', '17:30');
INSERT INTO `schedule` VALUES ('47', '1398418200', '4', '5', '13:30');
INSERT INTO `schedule` VALUES ('48', '1398429600', '3', '5', '16:40');
INSERT INTO `schedule` VALUES ('49', '1398435600', '1', '5', '18:20');
INSERT INTO `schedule` VALUES ('50', '1398447000', '2', '5', '21:30');
INSERT INTO `schedule` VALUES ('51', '1398402600', '1', '6', '9:10');
INSERT INTO `schedule` VALUES ('52', '1398411000', '2', '6', '11:30');
INSERT INTO `schedule` VALUES ('53', '1398417300', '3', '6', '13:15');
INSERT INTO `schedule` VALUES ('54', '1398426000', '4', '6', '15:40');

-- ----------------------------
-- Table structure for `seat`
-- ----------------------------
DROP TABLE IF EXISTS `seat`;
CREATE TABLE `seat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id места',
  `cinema_hall_id` int(11) unsigned NOT NULL COMMENT 'Id зала',
  `row` int(11) unsigned NOT NULL COMMENT 'Ряд',
  `place` int(11) unsigned NOT NULL COMMENT 'Место',
  PRIMARY KEY (`id`),
  KEY `seat_cinema_hall_id_fk` (`cinema_hall_id`) USING BTREE,
  CONSTRAINT `seat_cinema_hall_id_fk` FOREIGN KEY (`cinema_hall_id`) REFERENCES `cinema_hall` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8 COMMENT='Места';

-- ----------------------------
-- Records of seat
-- ----------------------------
INSERT INTO `seat` VALUES ('1', '1', '1', '1');
INSERT INTO `seat` VALUES ('2', '1', '1', '2');
INSERT INTO `seat` VALUES ('3', '1', '1', '3');
INSERT INTO `seat` VALUES ('4', '1', '1', '4');
INSERT INTO `seat` VALUES ('5', '1', '1', '5');
INSERT INTO `seat` VALUES ('6', '1', '1', '6');
INSERT INTO `seat` VALUES ('7', '1', '1', '7');
INSERT INTO `seat` VALUES ('8', '1', '1', '8');
INSERT INTO `seat` VALUES ('9', '1', '1', '9');
INSERT INTO `seat` VALUES ('10', '1', '1', '10');
INSERT INTO `seat` VALUES ('11', '1', '2', '1');
INSERT INTO `seat` VALUES ('12', '1', '2', '2');
INSERT INTO `seat` VALUES ('13', '1', '2', '3');
INSERT INTO `seat` VALUES ('14', '1', '2', '4');
INSERT INTO `seat` VALUES ('15', '1', '2', '5');
INSERT INTO `seat` VALUES ('16', '1', '2', '6');
INSERT INTO `seat` VALUES ('17', '1', '2', '7');
INSERT INTO `seat` VALUES ('18', '1', '2', '8');
INSERT INTO `seat` VALUES ('19', '1', '2', '9');
INSERT INTO `seat` VALUES ('20', '1', '2', '10');
INSERT INTO `seat` VALUES ('21', '2', '1', '1');
INSERT INTO `seat` VALUES ('22', '2', '1', '2');
INSERT INTO `seat` VALUES ('23', '2', '1', '3');
INSERT INTO `seat` VALUES ('24', '2', '1', '4');
INSERT INTO `seat` VALUES ('25', '2', '1', '5');
INSERT INTO `seat` VALUES ('26', '2', '1', '6');
INSERT INTO `seat` VALUES ('27', '2', '1', '7');
INSERT INTO `seat` VALUES ('28', '2', '1', '8');
INSERT INTO `seat` VALUES ('29', '2', '1', '9');
INSERT INTO `seat` VALUES ('30', '2', '1', '10');
INSERT INTO `seat` VALUES ('31', '2', '2', '1');
INSERT INTO `seat` VALUES ('32', '2', '2', '2');
INSERT INTO `seat` VALUES ('33', '2', '2', '3');
INSERT INTO `seat` VALUES ('34', '2', '2', '4');
INSERT INTO `seat` VALUES ('35', '2', '2', '5');
INSERT INTO `seat` VALUES ('36', '2', '2', '6');
INSERT INTO `seat` VALUES ('37', '2', '2', '7');
INSERT INTO `seat` VALUES ('38', '2', '2', '8');
INSERT INTO `seat` VALUES ('39', '2', '2', '9');
INSERT INTO `seat` VALUES ('40', '2', '2', '10');
INSERT INTO `seat` VALUES ('41', '3', '1', '1');
INSERT INTO `seat` VALUES ('42', '3', '1', '2');
INSERT INTO `seat` VALUES ('43', '3', '1', '3');
INSERT INTO `seat` VALUES ('44', '3', '1', '4');
INSERT INTO `seat` VALUES ('45', '3', '1', '5');
INSERT INTO `seat` VALUES ('46', '3', '1', '6');
INSERT INTO `seat` VALUES ('47', '3', '1', '7');
INSERT INTO `seat` VALUES ('48', '3', '1', '8');
INSERT INTO `seat` VALUES ('49', '3', '1', '9');
INSERT INTO `seat` VALUES ('50', '3', '1', '10');
INSERT INTO `seat` VALUES ('51', '3', '2', '1');
INSERT INTO `seat` VALUES ('52', '3', '2', '2');
INSERT INTO `seat` VALUES ('53', '3', '2', '3');
INSERT INTO `seat` VALUES ('54', '3', '2', '4');
INSERT INTO `seat` VALUES ('55', '3', '2', '5');
INSERT INTO `seat` VALUES ('56', '3', '2', '6');
INSERT INTO `seat` VALUES ('57', '3', '2', '7');
INSERT INTO `seat` VALUES ('58', '3', '2', '8');
INSERT INTO `seat` VALUES ('59', '3', '2', '9');
INSERT INTO `seat` VALUES ('60', '3', '2', '10');
INSERT INTO `seat` VALUES ('61', '4', '1', '1');
INSERT INTO `seat` VALUES ('62', '4', '1', '2');
INSERT INTO `seat` VALUES ('63', '4', '1', '3');
INSERT INTO `seat` VALUES ('65', '4', '1', '4');
INSERT INTO `seat` VALUES ('66', '4', '1', '5');
INSERT INTO `seat` VALUES ('67', '4', '1', '6');
INSERT INTO `seat` VALUES ('68', '4', '1', '7');
INSERT INTO `seat` VALUES ('69', '4', '1', '8');
INSERT INTO `seat` VALUES ('70', '4', '1', '9');
INSERT INTO `seat` VALUES ('71', '4', '1', '10');
INSERT INTO `seat` VALUES ('72', '4', '2', '1');
INSERT INTO `seat` VALUES ('73', '4', '2', '2');
INSERT INTO `seat` VALUES ('74', '4', '2', '3');
INSERT INTO `seat` VALUES ('75', '4', '2', '4');
INSERT INTO `seat` VALUES ('76', '4', '2', '5');
INSERT INTO `seat` VALUES ('77', '4', '2', '6');
INSERT INTO `seat` VALUES ('78', '4', '2', '7');
INSERT INTO `seat` VALUES ('79', '4', '2', '8');
INSERT INTO `seat` VALUES ('80', '4', '2', '9');
INSERT INTO `seat` VALUES ('81', '4', '2', '10');
INSERT INTO `seat` VALUES ('82', '5', '1', '1');
INSERT INTO `seat` VALUES ('83', '5', '1', '2');
INSERT INTO `seat` VALUES ('84', '5', '1', '3');
INSERT INTO `seat` VALUES ('85', '5', '1', '4');
INSERT INTO `seat` VALUES ('86', '5', '1', '5');
INSERT INTO `seat` VALUES ('87', '5', '1', '6');
INSERT INTO `seat` VALUES ('88', '5', '1', '7');
INSERT INTO `seat` VALUES ('89', '5', '1', '8');
INSERT INTO `seat` VALUES ('90', '5', '1', '9');
INSERT INTO `seat` VALUES ('91', '5', '1', '10');
INSERT INTO `seat` VALUES ('92', '5', '2', '1');
INSERT INTO `seat` VALUES ('93', '5', '2', '2');
INSERT INTO `seat` VALUES ('94', '5', '2', '3');
INSERT INTO `seat` VALUES ('95', '5', '2', '4');
INSERT INTO `seat` VALUES ('96', '5', '2', '5');
INSERT INTO `seat` VALUES ('97', '5', '2', '6');
INSERT INTO `seat` VALUES ('98', '5', '2', '7');
INSERT INTO `seat` VALUES ('99', '5', '2', '8');
INSERT INTO `seat` VALUES ('100', '5', '2', '9');
INSERT INTO `seat` VALUES ('101', '5', '2', '10');
INSERT INTO `seat` VALUES ('102', '6', '1', '1');
INSERT INTO `seat` VALUES ('103', '6', '1', '2');
INSERT INTO `seat` VALUES ('104', '6', '1', '3');
INSERT INTO `seat` VALUES ('105', '6', '1', '4');
INSERT INTO `seat` VALUES ('106', '6', '1', '5');
INSERT INTO `seat` VALUES ('107', '6', '1', '6');
INSERT INTO `seat` VALUES ('108', '6', '1', '7');
INSERT INTO `seat` VALUES ('109', '6', '1', '8');
INSERT INTO `seat` VALUES ('110', '6', '1', '9');
INSERT INTO `seat` VALUES ('111', '6', '1', '10');
INSERT INTO `seat` VALUES ('112', '6', '2', '1');
INSERT INTO `seat` VALUES ('113', '6', '2', '2');
INSERT INTO `seat` VALUES ('114', '6', '2', '3');
INSERT INTO `seat` VALUES ('115', '6', '2', '4');
INSERT INTO `seat` VALUES ('116', '6', '2', '5');
INSERT INTO `seat` VALUES ('117', '6', '2', '6');
INSERT INTO `seat` VALUES ('118', '6', '2', '7');
INSERT INTO `seat` VALUES ('119', '6', '2', '8');
INSERT INTO `seat` VALUES ('120', '6', '2', '9');
INSERT INTO `seat` VALUES ('122', '6', '2', '10');

-- ----------------------------
-- Table structure for `ticket`
-- ----------------------------
DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id билета',
  `buyer_email` varchar(255) NOT NULL DEFAULT 'не указан' COMMENT 'Email заказавшего билет',
  `buyer_name` varchar(255) NOT NULL DEFAULT 'не указан' COMMENT 'ФИО заказавшего билет',
  `buyer_phone` varchar(255) NOT NULL DEFAULT 'не указан' COMMENT 'Номер телефона заказавшего билет',
  `cinema_hall_id` int(11) unsigned NOT NULL COMMENT 'Id зала',
  `order_date` varchar(255) NOT NULL COMMENT 'Дата заказа билета',
  `schedule_id` int(11) unsigned NOT NULL COMMENT 'Id расписания',
  `ticket_control_number` int(11) unsigned NOT NULL COMMENT 'Проверочные цыфры',
  `ticket_hash_sum` varchar(255) NOT NULL COMMENT 'Хэш билета',
  `seat_id` int(11) unsigned NOT NULL COMMENT 'Id места в зале',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Оплачен ли билет',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_dublicate_index` (`cinema_hall_id`,`schedule_id`,`seat_id`),
  KEY `unique_cinema_hall_id` (`cinema_hall_id`) USING BTREE,
  KEY `unique_schedule_id` (`schedule_id`) USING BTREE,
  KEY `unique_seat_id` (`seat_id`) USING BTREE,
  CONSTRAINT `ticket_chinema_hall_id_fk` FOREIGN KEY (`cinema_hall_id`) REFERENCES `cinema_hall` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_schedule_id_fk` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_seat_id_fk` FOREIGN KEY (`seat_id`) REFERENCES `seat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=356 DEFAULT CHARSET=utf8 COMMENT='Билеты';

-- ----------------------------
-- Records of ticket
-- ----------------------------
INSERT INTO `ticket` VALUES ('353', 'socode@mail.ru', 'Станислав', '8(927)788-55-04', '1', '1398840550', '34', '709011501', 'a34ee0d22649a490513155fe0f0cea71', '10', '1');
INSERT INTO `ticket` VALUES ('354', 'socode@mail.ru', 'Станислав', '8(927)788-55-04', '1', '1398840550', '34', '709011501', 'a34ee0d22649a490513155fe0f0cea71', '11', '1');
INSERT INTO `ticket` VALUES ('355', 'socode@mail.ru', 'Станислав', '8(927)788-55-04', '1', '1398840550', '34', '709011501', 'a34ee0d22649a490513155fe0f0cea71', '12', '1');
