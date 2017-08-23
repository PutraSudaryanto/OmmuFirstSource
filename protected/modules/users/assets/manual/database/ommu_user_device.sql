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

/*Table structure for table `ommu_user_device` */

DROP TABLE IF EXISTS `ommu_user_device`;

CREATE TABLE `ommu_user_device` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `android_id` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'trigger',
  `generate_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'trigger',
  `unpublish_date` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'trigger',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'trigger',
  `modified_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/* Trigger structure for table `ommu_user_device` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `userBeforeUpdateDevice` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `userBeforeUpdateDevice` BEFORE UPDATE ON `ommu_user_device` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;
	
	IF (NEW.publish <> OLD.publish) THEN
		IF (NEW.publish = 0) THEN
			SET NEW.unpublish_date = NOW();
		ELSE
			SET column_update_count = column_update_count + 1;
		END IF;
	END IF;
	IF (NEW.user_id <> OLD.user_id) THEN
		IF (OLD.user_id = 0) THEN
			SET NEW.generate_date = NOW();
		ELSE
			SET column_update_count = column_update_count + 1;
		END IF;
	END IF;
	IF (NEW.android_id <> OLD.android_id) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.creation_date <> OLD.creation_date) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	
	IF (column_update_count > 0) THEN
		SET NEW.modified_date = NOW();
	END IF;	
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
