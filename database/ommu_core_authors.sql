/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.16-MariaDB : Database - _project_db_ommu_opensource
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`_project_db_ommu_opensource` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `_project_db_ommu_opensource`;

/*Table structure for table `ommu_core_author_contact_category` */

DROP TABLE IF EXISTS `ommu_core_author_contact_category`;

CREATE TABLE `ommu_core_author_contact_category` (
  `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `name` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'trigger',
  `creation_id` int(11) unsigned NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'trigger',
  `modified_id` int(11) unsigned NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'trigger',
  `slug` varchar(32) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `ommu_core_author_contacts` */

DROP TABLE IF EXISTS `ommu_core_author_contacts`;

CREATE TABLE `ommu_core_author_contacts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `author_id` int(11) unsigned NOT NULL,
  `cat_id` smallint(5) unsigned NOT NULL,
  `contact_value` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'trigger',
  `creation_id` int(11) unsigned NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'trigger',
  `modified_id` int(11) unsigned NOT NULL,
  `updated_date` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'trigger',
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `cat_id` (`cat_id`),
  CONSTRAINT `ommu_core_author_contacts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `ommu_core_authors` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ommu_core_author_contacts_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `ommu_core_author_contact_category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ommu_core_authors` */

DROP TABLE IF EXISTS `ommu_core_authors`;

CREATE TABLE `ommu_core_authors` (
  `author_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(32) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'trigger',
  `creation_id` int(11) unsigned NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'trigger',
  `modified_id` int(11) unsigned NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'trigger',
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Trigger structure for table `ommu_core_author_contacts` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateAuthorContact` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `coreBeforeUpdateAuthorContact` BEFORE UPDATE ON `ommu_core_author_contacts` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.author_id <> OLD.author_id) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.cat_id <> OLD.cat_id) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.contact_value <> OLD.contact_value) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.creation_date <> OLD.creation_date) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.creation_id <> OLD.creation_id) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	
	IF (column_update_count > 0) THEN
		SET NEW.modified_date = NOW();
	END IF;
	
	IF (NEW.publish <> OLD.publish) THEN
		SET NEW.updated_date = NOW();
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_author_contact_category` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateAuthorContactCategory` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `coreBeforeUpdateAuthorContactCategory` BEFORE UPDATE ON `ommu_core_author_contact_category` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.name <> OLD.name) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.creation_date <> OLD.creation_date) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.creation_id <> OLD.creation_id) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	
	IF (column_update_count > 0) THEN
		SET NEW.modified_date = NOW();
	END IF;
	
	IF (NEW.publish <> OLD.publish) THEN
		SET NEW.updated_date = NOW();
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_authors` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateAuthors` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `coreBeforeUpdateAuthors` BEFORE UPDATE ON `ommu_core_authors` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.name <> OLD.name) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.creation_date <> OLD.creation_date) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.creation_id <> OLD.creation_id) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	
	IF (column_update_count > 0) THEN
		SET NEW.modified_date = NOW();
	END IF;
	
	IF (NEW.publish <> OLD.publish) THEN
		SET NEW.updated_date = NOW();
	END IF;
    END */$$


DELIMITER ;

/*Table structure for table `_view_core_author_contact_category` */

DROP TABLE IF EXISTS `_view_core_author_contact_category`;

/*!50001 DROP VIEW IF EXISTS `_view_core_author_contact_category` */;
/*!50001 DROP TABLE IF EXISTS `_view_core_author_contact_category` */;

/*!50001 CREATE TABLE  `_view_core_author_contact_category`(
 `cat_id` smallint(5) unsigned ,
 `contacts` decimal(23,0) ,
 `contact_all` bigint(21) 
)*/;

/*Table structure for table `_view_core_authors` */

DROP TABLE IF EXISTS `_view_core_authors`;

/*!50001 DROP VIEW IF EXISTS `_view_core_authors` */;
/*!50001 DROP TABLE IF EXISTS `_view_core_authors` */;

/*!50001 CREATE TABLE  `_view_core_authors`(
 `author_id` int(11) unsigned ,
 `contacts` decimal(23,0) ,
 `contact_all` bigint(21) 
)*/;

/*View structure for view _view_core_author_contact_category */

/*!50001 DROP TABLE IF EXISTS `_view_core_author_contact_category` */;
/*!50001 DROP VIEW IF EXISTS `_view_core_author_contact_category` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `_view_core_author_contact_category` AS select `a`.`cat_id` AS `cat_id`,sum((case when (`b`.`publish` = '1') then 1 else 0 end)) AS `contacts`,count(`b`.`id`) AS `contact_all` from (`ommu_core_author_contact_category` `a` left join `ommu_core_author_contacts` `b` on((`a`.`cat_id` = `b`.`cat_id`))) group by `a`.`cat_id` */;

/*View structure for view _view_core_authors */

/*!50001 DROP TABLE IF EXISTS `_view_core_authors` */;
/*!50001 DROP VIEW IF EXISTS `_view_core_authors` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `_view_core_authors` AS select `a`.`author_id` AS `author_id`,sum((case when (`b`.`publish` = '1') then 1 else 0 end)) AS `contacts`,count(`b`.`id`) AS `contact_all` from (`ommu_core_authors` `a` left join `ommu_core_author_contacts` `b` on((`a`.`author_id` = `b`.`author_id`))) group by `a`.`author_id` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
