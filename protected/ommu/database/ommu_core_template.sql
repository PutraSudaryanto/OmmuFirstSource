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

/*Table structure for table `ommu_core_template` */

DROP TABLE IF EXISTS `ommu_core_template`;

CREATE TABLE `ommu_core_template` (
  `template_key` varchar(32) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `plugin_id` smallint(5) unsigned NOT NULL,
  `template` text NOT NULL,
  `variable` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'trigger',
  `creation_id` int(11) unsigned NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'trigger',
  `modified_id` int(11) unsigned NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'trigger',
  PRIMARY KEY (`template_key`),
  KEY `plugin_id` (`plugin_id`),
  CONSTRAINT `ommu_core_template_ibfk_1` FOREIGN KEY (`plugin_id`) REFERENCES `ommu_core_plugins` (`plugin_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Trigger structure for table `ommu_core_template` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateTemplate` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `coreBeforeUpdateTemplate` BEFORE UPDATE ON `ommu_core_template` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.template_key <> OLD.template_key) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.plugin_id <> OLD.plugin_id) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.template <> OLD.template) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.variable <> OLD.variable) THEN
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

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
