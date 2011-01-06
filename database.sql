# Sequel Pro dump
# Version 2492
# http://code.google.com/p/sequel-pro
#
# Host: localhost (MySQL 5.1.54)
# Database: stationwagon
# Generation Time: 2011-01-06 23:26:16 +0200
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table sw_articles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sw_articles`;

CREATE TABLE `sw_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(140) DEFAULT NULL,
  `body` text,
  `created_time` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

LOCK TABLES `sw_articles` WRITE;
/*!40000 ALTER TABLE `sw_articles` DISABLE KEYS */;
INSERT INTO `sw_articles` (`id`,`category_id`,`title`,`body`,`created_time`)
VALUES
	(1,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `sw_articles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sw_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sw_categories`;

CREATE TABLE `sw_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(140) DEFAULT NULL,
  `description` tinytext,
  `created_time` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;






/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
