DROP TABLE IF EXISTS `sw_users`;

CREATE TABLE `sw_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `profile_fields` text,
  `group` int(11) DEFAULT NULL,
  `last_login` bigint(20) DEFAULT NULL,
  `login_hash` tinytext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `sw_articles`;

CREATE TABLE `sw_articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `published` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_time` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `sw_categories`;

CREATE TABLE `sw_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` tinytext COLLATE utf8_unicode_ci,
  `created_time` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;