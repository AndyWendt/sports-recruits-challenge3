# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.29)
# Database: dynamic_events
# Generation Time: 2015-01-23 16:29:19 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` enum('player','coach') DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `ranking` tinyint(1) unsigned DEFAULT '3',
  `can_play_goalie` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `user_type`, `first_name`, `last_name`, `ranking`, `can_play_goalie`)
VALUES
	(1,'player','Scott','Marrtins',5,0),
	(2,'player','Joe','Alberici',4,1),
	(3,'player','Lars','Tiffany',3,0),
	(4,'player','Frank','Fed',5,0),
	(5,'player','Randy','Mearns',3,0),
	(6,'player','Ben','DeLuca',3,0),
	(7,'player','Bob','Shilling',3,0),
	(8,'player','Greg','Carroline',1,0),
	(9,'player','John','Danowski',3,0),
	(10,'player','Ron','Caputo',3,0),
	(11,'player','Greg','Raymond',3,0),
	(12,'player','Terry','Muffley',3,0),
	(13,'player','Seth','Tierney',3,0),
	(14,'player','Jim','Morrissey',3,0),
	(15,'player','Dave','Pietra',3,0),
	(16,'player','Jim','Rogals',4,1),
	(17,'player','Charley','Toomey',3,0),
	(18,'player','Matt','Dan',3,0),
	(19,'player','Tom','Gravant',3,0),
	(20,'player','Kevin','Corrigan',3,0),
	(21,'player','Gerry','Byrne',3,0),
	(22,'player','Chris','Gabrielli',4,1),
	(23,'player','Eric','Fete',2,1),
	(24,'player','Bruce','Frady',2,1),
	(25,'player','Andrew','McMinn',2,1),
	(26,'player','Brian','Brecht',3,0),
	(27,'player','Tom','Mariano',3,0),
	(28,'player','John','Desko',3,0),
	(29,'player','Lelan','Rogers',3,0),
	(30,'player','Shawn','Nadelen',3,0),
	(31,'player','Greg','Cannella',3,0),
	(32,'player','Don','Barrett',3,0),
	(33,'player','Dom','Starsia',3,0),
	(34,'player','Marc','Arsdale',3,0),
	(35,'player','Andy','Shay',3,0),
	(36,'player','Gordon','Purdie',3,0),
	(37,'player','Shannon','Sligo',3,0),
	(38,'player','Chris','Zimmerman',3,0),
	(39,'player','Jim','Murphy',3,0),
	(40,'player','Mike','Pressler',3,0),
	(41,'player','John','Jes',3,0),
	(42,'player','Tim','Boyle',3,0),
	(43,'player','Mike','Taylor',3,0),
	(44,'player','Greg','Skillton',3,0),
	(45,'player','Dan','Sheehan',3,0),
	(46,'player','Sean','Woods',5,0),
	(47,'player','Chris','Ryan',3,0),
	(48,'player','Dave','Carty',3,0),
	(49,'player','James','Fritz',3,0),
	(50,'player','Larry','Calkins',2,0),
	(51,'player','Brad','Jorgen',3,0),
	(52,'player','Sonny','Ziegler',3,0),
	(53,'player','Brian','Novo',3,0),
	(54,'player','Jason','Lockner',3,0),
	(55,'player','Nick','Yando',5,0),
	(56,'player','Peter','Lasagna',4,0),
	(57,'player','Steve','Colfer',3,0),
	(58,'player','Brian','Felice',3,0),
	(59,'player','Brooks','Singer',3,0),
	(60,'coach','Daniel','Ambrose',0,0),
	(61,'player','Matt','Klank',4,0),
	(62,'player','Jeff','Cohen',3,0),
	(63,'player','Bill','Bergan',3,0),
	(64,'player','Dave','Cornell',3,0),
	(65,'player','Steve','Beville',3,0),
	(66,'player','David','Webster',3,0),
	(67,'player','Tom','Leanos',3,0),
	(68,'player','Justin','Axel',1,0),
	(69,'player','Terry','Corcoran',3,0),
	(70,'coach','Preston','Chapman',0,0),
	(71,'player','Sean','Quirk',3,0),
	(72,'player','Patrick','Scarpello',1,0),
	(73,'player','Tim','Tuttle',3,0),
	(74,'player','Todd','Cavallario',3,0),
	(75,'player','Jim','Lyons',3,0),
	(76,'player','Scott','Barnard',3,0),
	(77,'player','Ray','Rostan',3,0),
	(78,'player','Jason','Rostan',3,0),
	(79,'player','Bill','Bjorn',3,0),
	(80,'player','Jeffrey','Long',4,0),
	(81,'player','John','Wallace',3,0),
	(82,'player','Shelley','Sheiner',3,0),
	(83,'coach','Mark','Theriault',0,0),
	(84,'player','Doug','Misar',3,0),
	(85,'player','Andrew','Orlo',3,0),
	(86,'player','Steve','Matus',5,0),
	(87,'coach','Timothy','Duntonelle',1,0),
	(88,'player','Steve','Koud',3,0),
	(89,'player','Kurt','Glaeser',3,0),
	(90,'coach','Jon','Reynolds',0,0);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
