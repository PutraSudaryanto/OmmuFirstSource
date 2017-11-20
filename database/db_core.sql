/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.16-MariaDB : Database - ommu_db_core
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ommu_db_core` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `ommu_db_core`;

/*Table structure for table `ommu_core_author_contact_category` */

DROP TABLE IF EXISTS `ommu_core_author_contact_category`;

CREATE TABLE `ommu_core_author_contact_category` (
  `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `name` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creation_id` int(11) unsigned NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_id` int(11) unsigned NOT NULL,
  `slug` varchar(32) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ommu_core_author_contact_category` */

/* Trigger structure for table `ommu_core_menu` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreAfterDeleteMenu` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreAfterDeleteMenu` AFTER DELETE ON `ommu_core_menu` FOR EACH ROW BEGIN
	DELETE FROM `ommu_core_system_phrase` WHERE `phrase_id`=OLD.name;
	/*
	UPDATE `ommu_core_system_phrase` SET `en_us`=CONCAT(en_us,'_DELETED') WHERE `phrase_id`=OLD.name;
	*/
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_menu_category` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreAfterDeleteMenuCategory` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreAfterDeleteMenuCategory` AFTER DELETE ON `ommu_core_menu_category` FOR EACH ROW BEGIN
	DELETE FROM `ommu_core_system_phrase` WHERE `phrase_id`=OLD.name;
	DELETE FROM `ommu_core_system_phrase` WHERE `phrase_id`=OLD.desc;
	/*
	UPDATE `ommu_core_system_phrase` SET `en_us`=CONCAT(en_us,'_DELETED') WHERE `phrase_id`=OLD.name;
	UPDATE `ommu_core_system_phrase` SET `en_us`=CONCAT(en_us,'_DELETED') WHERE `phrase_id`=OLD.desc;
	*/
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_pages` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreAfterDeletePages` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreAfterDeletePages` AFTER DELETE ON `ommu_core_pages` FOR EACH ROW BEGIN
	DELETE FROM `ommu_core_system_phrase` WHERE `phrase_id`=OLD.name;
	DELETE FROM `ommu_core_system_phrase` WHERE `phrase_id`=OLD.desc;
	DELETE FROM `ommu_core_system_phrase` WHERE `phrase_id`=OLD.quote;
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_wall_comment` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreAfterDeleteWallComment` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreAfterDeleteWallComment` AFTER DELETE ON `ommu_core_wall_comment` FOR EACH ROW BEGIN	
	IF (OLD.parent_id = 0) THEN
		UPDATE `ommu_core_walls` SET `comments`=(`comments` - 1) WHERE `wall_id`=OLD.wall_id;
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_wall_likes` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreAfterDeleteWallLikes` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreAfterDeleteWallLikes` AFTER DELETE ON `ommu_core_wall_likes` FOR EACH ROW BEGIN
	UPDATE `ommu_core_walls` SET `likes`=(`likes` - 1) WHERE `wall_id`=OLD.wall_id;
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_plugins` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreAfterInsertPlugins` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreAfterInsertPlugins` AFTER INSERT ON `ommu_core_plugins` FOR EACH ROW BEGIN
	/*
	DECLARE phrase_id_tr INT;
	SELECT `phrase_id` INTO phrase_id_tr FROM `ommu_core_plugin_phrase` WHERE `phrase_id`=NEW.code;
	IF (phrase_id_tr IS NULL) THEN
		INSERT `ommu_core_plugin_phrase` (`phrase_id`, `plugin_id`, `en`)
		VALUE (NEW.code, NEW.plugin_id, NEW.name);
	END IF;
	*/
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_wall_comment` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreAfterInsertWallComment` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreAfterInsertWallComment` AFTER INSERT ON `ommu_core_wall_comment` FOR EACH ROW BEGIN	
	DECLARE user_id_tr INT;
	
	IF (NEW.parent_id = 0) THEN
		UPDATE `ommu_core_walls` SET `comments`=(`comments` + 1) WHERE `wall_id`=NEW.wall_id;
	END IF;
	
	SELECT `user_id` INTO user_id_tr FROM `ommu_core_wall_user` WHERE `wall_id`=NEW.wall_id AND `user_id`=NEW.user_id;
	IF (user_id_tr IS NULL) THEN
		INSERT `ommu_core_wall_user` (`status`, `wall_id`, `user_id`)
		VALUE ('1', NEW.wall_id, NEW.user_id);
	ELSE
		UPDATE `ommu_core_wall_user` SET `status`='1' WHERE `wall_id`=NEW.wall_id AND `user_id`=NEW.user_id;
	END IF;
	UPDATE `ommu_core_wall_user` SET `status`='0' WHERE `wall_id`=NEW.wall_id AND `user_id`<>NEW.user_id;
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_wall_likes` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreAfterInsertWallLikes` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreAfterInsertWallLikes` AFTER INSERT ON `ommu_core_wall_likes` FOR EACH ROW BEGIN
	DECLARE user_id_tr INT;
	
	UPDATE `ommu_core_walls` SET `likes`=(`likes` + 1) WHERE `wall_id`=NEW.wall_id;
	
	SELECT `user_id` INTO user_id_tr FROM `ommu_core_wall_user` WHERE `wall_id`=NEW.wall_id AND `user_id`=NEW.user_id;
	IF (user_id_tr IS NULL) THEN
		INSERT `ommu_core_wall_user` (`status`, `wall_id`, `user_id`)
		VALUE ('1', NEW.wall_id, NEW.user_id);
	ELSE
		UPDATE `ommu_core_wall_user` SET `status`='1' WHERE `wall_id`=NEW.wall_id AND `user_id`=NEW.user_id;
	END IF;	
	UPDATE `ommu_core_wall_user` SET `status`='0' WHERE `wall_id`=NEW.wall_id AND `user_id`<>NEW.user_id;
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_walls` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreAfterInsertWalls` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreAfterInsertWalls` AFTER INSERT ON `ommu_core_walls` FOR EACH ROW BEGIN
	INSERT `ommu_core_wall_user` (`wall_id`, `user_id`)
	VALUE (NEW.wall_id, NEW.user_id);
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_zone_city` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeInsertZoneCity` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeInsertZoneCity` BEFORE INSERT ON `ommu_core_zone_city` FOR EACH ROW BEGIN
	DECLARE province_id_tr SMALLINT;
	
	IF (NEW.province_id IS NULL) THEN
		/*CALL getOmmuZoneProvinceIdWithCityMfdonline(NEW.mfdonline, province_id_tr);*/
		SELECT `province_id` INTO province_id_tr FROM `ommu_core_zone_province` WHERE `mfdonline`=LEFT(NEW.mfdonline,2);
		IF (province_id_tr IS NOT NULL) THEN
			SET NEW.province_id = province_id_tr;
		END IF;	
	END IF;	
	
	SET NEW.city_name = TRIM(NEW.city_name);
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_zone_country` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeInsertZoneCountry` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeInsertZoneCountry` BEFORE INSERT ON `ommu_core_zone_country` FOR EACH ROW BEGIN
	SET NEW.country_name = TRIM(NEW.country_name);
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_zone_districts` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeInsertZoneDistricts` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeInsertZoneDistricts` BEFORE INSERT ON `ommu_core_zone_districts` FOR EACH ROW BEGIN
	DECLARE `city_id_tr` INT;
	
	/*CALL getOmmuZoneCityIdWithDistrictMfdonline(NEW.mfdonline, city_id_tr);*/
	SELECT `city_id` INTO city_id_tr FROM `ommu_core_zone_city` WHERE `mfdonline`=LEFT(NEW.mfdonline,4);
	IF (city_id_tr IS NOT NULL) THEN
		SET NEW.city_id = city_id_tr;
	END IF;	
	
	SET NEW.district_name = TRIM(NEW.district_name);
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_zone_province` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeInsertZoneProvince` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeInsertZoneProvince` BEFORE INSERT ON `ommu_core_zone_province` FOR EACH ROW BEGIN
	SET NEW.province_name = TRIM(NEW.province_name);
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_zone_village` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeInsertZoneVillage` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeInsertZoneVillage` BEFORE INSERT ON `ommu_core_zone_village` FOR EACH ROW BEGIN
	DECLARE `district_id_tr` INT;
	
	IF (NEW.district_id IS NULL) THEN
		SELECT `district_id` INTO district_id_tr FROM `ommu_core_zone_districts` WHERE `mfdonline`=LEFT(NEW.mfdonline,7);
		IF (district_id_tr IS NOT NULL) THEN
			SET NEW.district_id = district_id_tr;
		END IF;
	END IF;
	
	SET NEW.village_name = TRIM(NEW.village_name);
	SET NEW.zipcode = TRIM(NEW.zipcode);
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_author_contacts` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateAuthorContact` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateAuthorContact` BEFORE UPDATE ON `ommu_core_author_contacts` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.publish <> OLD.publish) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
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
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_author_contact_category` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateAuthorContactCategory` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateAuthorContactCategory` BEFORE UPDATE ON `ommu_core_author_contact_category` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.publish <> OLD.publish) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.name <> OLD.name) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.creation_date <> OLD.creation_date) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.creation_id <> OLD.creation_id) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.slug <> OLD.slug) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	
	IF (column_update_count > 0) THEN
		SET NEW.modified_date = NOW();
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_authors` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateAuthors` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateAuthors` BEFORE UPDATE ON `ommu_core_authors` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.publish <> OLD.publish) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
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
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_languages` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateLanguage` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateLanguage` BEFORE UPDATE ON `ommu_core_languages` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.actived <> OLD.actived) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.defaults <> OLD.defaults) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.code <> OLD.code) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
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
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_menu` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateMenu` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateMenu` BEFORE UPDATE ON `ommu_core_menu` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.publish <> OLD.publish) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.cat_id <> OLD.cat_id) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.parent <> OLD.parent) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.orders <> OLD.orders) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.name <> OLD.name) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.url <> OLD.url) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.attr <> OLD.attr) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.sitetype_access <> OLD.sitetype_access) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.userlevel_access <> OLD.userlevel_access) THEN
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
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_menu_category` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateMenuCategory` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateMenuCategory` BEFORE UPDATE ON `ommu_core_menu_category` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.publish <> OLD.publish) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.name <> OLD.name) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.desc <> OLD.desc) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.cat_code <> OLD.cat_code) THEN
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
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_meta` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateMeta` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateMeta` BEFORE UPDATE ON `ommu_core_meta` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;	
	DECLARE province_id_tr SMALLINT;
	DECLARE country_id_tr SMALLINT;
	
	SET column_update_count = 0;	
	
	IF (NEW.office_city <> OLD.office_city) THEN
		CALL getOmmuZoneProvinceId(NEW.office_city, province_id_tr);
		IF (province_id_tr IS NOT NULL) THEN
			SET NEW.office_province = province_id_tr;
		END IF;	
		
		CALL getOmmuZoneCountryId(NEW.office_province, country_id_tr);
		IF (country_id_tr IS NOT NULL) THEN
			SET NEW.office_country = country_id_tr;
		END IF;
	END IF;
	
	IF (NEW.meta_image <> OLD.meta_image) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.meta_image_alt <> OLD.meta_image_alt) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_on <> OLD.office_on) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_name <> OLD.office_name) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_location <> OLD.office_location) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_place <> OLD.office_place) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_country <> OLD.office_country) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_province <> OLD.office_province) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_city <> OLD.office_city) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_district <> OLD.office_district) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_village <> OLD.office_village) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_zipcode <> OLD.office_zipcode) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_hour <> OLD.office_hour) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_phone <> OLD.office_phone) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_fax <> OLD.office_fax) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_email <> OLD.office_email) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_hotline <> OLD.office_hotline) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.office_website <> OLD.office_website) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.map_icons <> OLD.map_icons) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.map_icon_size <> OLD.map_icon_size) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.google_on <> OLD.google_on) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.twitter_on <> OLD.twitter_on) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.twitter_card <> OLD.twitter_card) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.twitter_site <> OLD.twitter_site) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.twitter_creator <> OLD.twitter_creator) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.twitter_photo_size <> OLD.twitter_photo_size) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.twitter_country <> OLD.twitter_country) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.twitter_iphone <> OLD.twitter_iphone) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.twitter_ipad <> OLD.twitter_ipad) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.twitter_googleplay <> OLD.twitter_googleplay) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.facebook_on <> OLD.facebook_on) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.facebook_type <> OLD.facebook_type) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.facebook_profile_firstname <> OLD.facebook_profile_firstname) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.facebook_profile_lastname <> OLD.facebook_profile_lastname) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.facebook_profile_username <> OLD.facebook_profile_username) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.facebook_sitename <> OLD.facebook_sitename) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.facebook_see_also <> OLD.facebook_see_also) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.facebook_admins <> OLD.facebook_admins) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	
	IF (column_update_count > 0) THEN
		SET NEW.modified_date = NOW();
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_options` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateOptions` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateOptions` BEFORE UPDATE ON `ommu_core_options` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.autoload <> OLD.autoload) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.option_type <> OLD.option_type) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.option_name <> OLD.option_name) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.option_value <> OLD.option_value) THEN
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
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_pages` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdatePages` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdatePages` BEFORE UPDATE ON `ommu_core_pages` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.publish <> OLD.publish) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.name <> OLD.name) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.desc <> OLD.desc) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.quote <> OLD.quote) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.media <> OLD.media) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.media_show <> OLD.media_show) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.media_type <> OLD.media_type) THEN
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
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_plugins` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdatePlugins` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdatePlugins` BEFORE UPDATE ON `ommu_core_plugins` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.default <> OLD.default) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.install <> OLD.install) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.actived <> OLD.actived) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.search <> OLD.search) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.orders <> OLD.orders) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.folder <> OLD.folder) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.name <> OLD.name) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.desc <> OLD.desc) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.model <> OLD.model) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.creation_date <> OLD.creation_date) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.creation_id <> OLD.creation_id) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	
	/*
	DECLARE phrase_id_tr INT;
	SELECT `phrase_id` INTO phrase_id_tr FROM `ommu_core_plugin_phrase` WHERE `phrase_id`=NEW.code;
	IF (phrase_id_tr IS NULL) THEN
		INSERT `ommu_core_plugin_phrase` (`phrase_id`, `plugin_id`, `en`)
		VALUE (NEW.code, NEW.plugin_id, NEW.name);
	END IF;
	*/
	
	IF (column_update_count > 0) THEN
		SET NEW.modified_date = NOW();
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_settings` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateSettings` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateSettings` BEFORE UPDATE ON `ommu_core_settings` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;
	
	IF (NEW.online <> OLD.online) THEN
		SET column_update_count = column_update_count + 1;
	END IF;	
	IF (NEW.site_oauth <> OLD.site_oauth) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.site_type <> OLD.site_type) THEN
		IF (NEW.site_type = 0) THEN
			SET NEW.signup_username = 0;
			SET NEW.signup_approve = 1;
			SET NEW.signup_verifyemail = 0;
			SET NEW.signup_photo = 0;
			SET NEW.signup_welcome = 0;
			SET NEW.signup_random = 0;
			SET NEW.signup_terms = 0;
			SET NEW.signup_invitepage = 0;
			SET NEW.signup_inviteonly = 0;
			SET NEW.signup_checkemail = 0;
			SET NEW.spam_signup = 0;
		ELSE
			SET NEW.signup_approve = 0;
			SET NEW.signup_verifyemail = 1;
			SET NEW.signup_random = 1;
			SET NEW.signup_terms = 1;
			SET NEW.signup_adminemail = 1;
		END IF;
		SET column_update_count = column_update_count + 1;
	END IF;	
	
	IF (NEW.site_url <> OLD.site_url) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.site_title <> OLD.site_title) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.site_keywords <> OLD.site_keywords) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.site_description <> OLD.site_description) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.site_creation <> OLD.site_creation) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.site_dateformat <> OLD.site_dateformat) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.site_timeformat <> OLD.site_timeformat) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.construction_date <> OLD.construction_date) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.construction_text <> OLD.construction_text) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.event_startdate <> OLD.event_startdate) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.event_finishdate <> OLD.event_finishdate) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.event_tag <> OLD.event_tag) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	/*
	IF ((NEW.site_type <> OLD.site_type AND NEW.site_type = 1) AND NEW.signup_username <> OLD.signup_username) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF ((NEW.site_type <> OLD.site_type AND NEW.site_type = 1) AND NEW.signup_photo <> OLD.signup_photo) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF ((NEW.site_type <> OLD.site_type AND NEW.site_type = 1) AND NEW.signup_welcome <> OLD.signup_welcome) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF ((NEW.site_type <> OLD.site_type AND NEW.site_type = 1) AND NEW.signup_invitepage <> OLD.signup_invitepage) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF ((NEW.site_type <> OLD.site_type AND NEW.site_type = 1) AND NEW.signup_inviteonly <> OLD.signup_inviteonly) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF ((NEW.site_type <> OLD.site_type AND NEW.site_type = 1) AND NEW.signup_checkemail <> OLD.signup_checkemail) THEN
		SET column_update_count = column_update_count + 1;
	END IF;	
	*/
	IF (NEW.signup_numgiven <> OLD.signup_numgiven) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	/*
	IF ((NEW.site_type <> OLD.site_type AND NEW.site_type = 0) AND NEW.signup_adminemail <> OLD.signup_adminemail) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	*/
	IF (NEW.general_profile <> OLD.general_profile) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.general_invite <> OLD.general_invite) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.general_search <> OLD.general_search) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.general_portal <> OLD.general_portal) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.general_include <> OLD.general_include) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.general_commenthtml <> OLD.general_commenthtml) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.lang_allow <> OLD.lang_allow) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.lang_autodetect <> OLD.lang_autodetect) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.lang_anonymous <> OLD.lang_anonymous) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.banned_ips <> OLD.banned_ips) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.banned_emails <> OLD.banned_emails) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.banned_usernames <> OLD.banned_usernames) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.banned_words <> OLD.banned_words) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.spam_comment <> OLD.spam_comment) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.spam_contact <> OLD.spam_contact) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.spam_invite <> OLD.spam_invite) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.spam_login <> OLD.spam_login) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.spam_failedcount <> OLD.spam_failedcount) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	/*
	IF ((NEW.site_type <> OLD.site_type AND NEW.site_type = 1) AND NEW.spam_signup <> OLD.spam_signup) THEN
		SET column_update_count = column_update_count + 1;
	END IF;	
	*/
	IF (NEW.analytic <> OLD.analytic) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.analytic_id <> OLD.analytic_id) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.license_email <> OLD.license_email) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.license_key <> OLD.license_key) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.ommu_version <> OLD.ommu_version) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	
	IF (column_update_count > 0) THEN
		SET NEW.modified_date = NOW();
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_system_phrase` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateSystemPhrase` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateSystemPhrase` BEFORE UPDATE ON `ommu_core_system_phrase` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.location <> OLD.location) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.en_us <> OLD.en_us) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.id <> OLD.id) THEN
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
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_tags` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateTags` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateTags` BEFORE UPDATE ON `ommu_core_tags` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.publish <> OLD.publish) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.body <> OLD.body) THEN
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
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_template` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateTemplate` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateTemplate` BEFORE UPDATE ON `ommu_core_template` FOR EACH ROW BEGIN
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
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_themes` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateThemes` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateThemes` BEFORE UPDATE ON `ommu_core_themes` FOR EACH ROW BEGIN	
	DECLARE column_update_count INT;
	SET column_update_count = 0;	
	
	IF (NEW.group_page <> OLD.group_page) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.default_theme <> OLD.default_theme) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.folder <> OLD.folder) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.layout <> OLD.layout) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.name <> OLD.name) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.thumbnail <> OLD.thumbnail) THEN
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
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_wall_comment` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateWallComment` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateWallComment` BEFORE UPDATE ON `ommu_core_wall_comment` FOR EACH ROW BEGIN
	IF (NEW.comment <> OLD.comment) THEN
		SET NEW.modified_date = NOW();
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_walls` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateWalls` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateWalls` BEFORE UPDATE ON `ommu_core_walls` FOR EACH ROW BEGIN
	IF ((NEW.comments = OLD.comments) AND (NEW.likes = OLD.likes)) THEN
		SET NEW.modified_date = NOW();
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_zone_city` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateZoneCity` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateZoneCity` BEFORE UPDATE ON `ommu_core_zone_city` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	DECLARE province_id_tr SMALLINT;
	
	SET column_update_count = 0;
	SET NEW.city_name = TRIM(NEW.city_name);
	
	IF (NEW.mfdonline <> OLD.mfdonline) THEN	
		/*CALL getOmmuZoneProvinceIdWithCityMfdonline(NEW.mfdonline, province_id_tr);*/
		SELECT `province_id` INTO province_id_tr FROM `ommu_core_zone_province` WHERE `mfdonline`=LEFT(NEW.mfdonline,2);
		IF (province_id_tr IS NOT NULL) THEN
			SET NEW.province_id = province_id_tr;
		END IF;
		SET column_update_count = column_update_count + 1;
	END IF;
	
	IF (NEW.publish <> OLD.publish) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.province_id <> OLD.province_id) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.city_name <> OLD.city_name) THEN
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
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_zone_country` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateZoneCountry` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateZoneCountry` BEFORE UPDATE ON `ommu_core_zone_country` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	
	SET column_update_count = 0;
	SET NEW.country_name = TRIM(NEW.country_name);
	
	IF (NEW.country_name <> OLD.country_name) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.code <> OLD.code) THEN
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
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_zone_districts` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateZoneDistricts` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateZoneDistricts` BEFORE UPDATE ON `ommu_core_zone_districts` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
	DECLARE `city_id_tr` INT;
	
	SET column_update_count = 0;
	SET NEW.district_name = TRIM(NEW.district_name);
	
	IF (NEW.mfdonline <> OLD.mfdonline) THEN	
		/*CALL getOmmuZoneCityIdWithDistrictMfdonline(NEW.mfdonline, city_id_tr);*/
		SELECT `city_id` INTO city_id_tr FROM `ommu_core_zone_city` WHERE `mfdonline`=LEFT(NEW.mfdonline,4);
		IF (city_id_tr IS NOT NULL) THEN
			SET NEW.city_id = city_id_tr;
		END IF;
		SET column_update_count = column_update_count + 1;
	END IF;
	
	IF (NEW.publish <> OLD.publish) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.city_id <> OLD.city_id) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.district_name <> OLD.district_name) THEN
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
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_zone_province` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateZoneProvince` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateZoneProvince` BEFORE UPDATE ON `ommu_core_zone_province` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;
		
	SET column_update_count = 0;
	SET NEW.province_name = TRIM(NEW.province_name);
	
	IF (NEW.publish <> OLD.publish) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.country_id <> OLD.country_id) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.province_name <> OLD.province_name) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.mfdonline <> OLD.mfdonline) THEN
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
    END */$$


DELIMITER ;

/* Trigger structure for table `ommu_core_zone_village` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `coreBeforeUpdateZoneVillage` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `coreBeforeUpdateZoneVillage` BEFORE UPDATE ON `ommu_core_zone_village` FOR EACH ROW BEGIN
	DECLARE column_update_count INT;    
	DECLARE `district_id_tr` INT;
	
	SET column_update_count = 0;
	SET NEW.village_name = TRIM(NEW.village_name);
	SET NEW.zipcode = TRIM(NEW.zipcode);
	
	IF (NEW.mfdonline <> OLD.mfdonline) THEN
		SELECT `district_id` INTO district_id_tr FROM `ommu_core_zone_districts` WHERE `mfdonline`=LEFT(NEW.mfdonline,7);
		IF (district_id_tr IS NOT NULL) THEN
			SET NEW.district_id = district_id_tr;
		END IF;
		SET column_update_count = column_update_count + 1;
	END IF;
	
	IF (NEW.publish <> OLD.publish) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.district_id <> OLD.district_id) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.village_name <> OLD.village_name) THEN
		SET column_update_count = column_update_count + 1;
	END IF;
	IF (NEW.zipcode <> OLD.zipcode) THEN
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
    END */$$


DELIMITER ;

/* Procedure structure for procedure `getOmmuLanguageDefault` */

/*!50003 DROP PROCEDURE IF EXISTS  `getOmmuLanguageDefault` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getOmmuLanguageDefault`(OUT `language_id_sp` TINYINT)
BEGIN
	SELECT `language_id` INTO language_id_sp FROM `ommu_core_languages` WHERE `actived`=1 AND `defaults`=1;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `getOmmuLocaleDefault` */

/*!50003 DROP PROCEDURE IF EXISTS  `getOmmuLocaleDefault` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getOmmuLocaleDefault`(OUT `locale_id_sp` SMALLINT)
BEGIN
	SELECT `locale_id` INTO locale_id_sp FROM `ommu_core_locale` WHERE `defaults`=1;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `getOmmuSetting` */

/*!50003 DROP PROCEDURE IF EXISTS  `getOmmuSetting` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getOmmuSetting`(OUT `site_type_sp` TINYINT, OUT `signup_numgiven_sp` TINYINT)
BEGIN
	/**
	 * userAfterInsert
	 * supportAfterInsertMails
	 */
	SELECT `site_type`, `signup_numgiven` INTO site_type_sp, signup_numgiven_sp FROM `ommu_core_settings` WHERE `id`=1;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `getOmmuTimezoneDefault` */

/*!50003 DROP PROCEDURE IF EXISTS  `getOmmuTimezoneDefault` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getOmmuTimezoneDefault`(OUT `timezone_id_sp` SMALLINT)
BEGIN
	SELECT `timezone_id` INTO timezone_id_sp FROM `ommu_core_timezone` WHERE `defaults`=1;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `getOmmuZoneCityId` */

/*!50003 DROP PROCEDURE IF EXISTS  `getOmmuZoneCityId` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getOmmuZoneCityId`(IN `district_id_sp` INT, OUT `city_id_sp` INT)
BEGIN
	SELECT `city_id` INTO city_id_sp FROM `ommu_core_zone_districts` WHERE `district_id`=district_id_sp;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `getOmmuZoneCityIdWithDistrictMfdonline` */

/*!50003 DROP PROCEDURE IF EXISTS  `getOmmuZoneCityIdWithDistrictMfdonline` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getOmmuZoneCityIdWithDistrictMfdonline`(IN `mfdonline_sp` CHAR, OUT `city_id_sp` INT)
BEGIN
	SELECT `city_id` INTO city_id_sp FROM `ommu_core_zone_city` WHERE `mfdonline`=LEFT(mfdonline_sp,4);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `getOmmuZoneCountryId` */

/*!50003 DROP PROCEDURE IF EXISTS  `getOmmuZoneCountryId` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getOmmuZoneCountryId`(IN `province_id_sp` SMALLINT, OUT `country_id_sp` SMALLINT)
BEGIN
	SELECT `country_id` INTO country_id_sp FROM `ommu_core_zone_province` WHERE `province_id`=province_id_sp;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `getOmmuZoneDistrictId` */

/*!50003 DROP PROCEDURE IF EXISTS  `getOmmuZoneDistrictId` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getOmmuZoneDistrictId`(IN `village_id_sp` INT, OUT `district_id_sp` INT)
BEGIN
	SELECT `district_id` INTO district_id_sp FROM `ommu_core_zone_village` WHERE `village_id`=village_id_sp;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `getOmmuZoneProvinceId` */

/*!50003 DROP PROCEDURE IF EXISTS  `getOmmuZoneProvinceId` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getOmmuZoneProvinceId`(in `city_id_sp` INT, OUT `province_id_sp` SMALLINT)
BEGIN
	SELECT `province_id` INTO province_id_sp FROM `ommu_core_zone_city` WHERE `city_id`=city_id_sp;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `getOmmuZoneProvinceIdWithCityMfdonline` */

/*!50003 DROP PROCEDURE IF EXISTS  `getOmmuZoneProvinceIdWithCityMfdonline` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getOmmuZoneProvinceIdWithCityMfdonline`(IN `mfdonline_sp` CHAR, OUT `province_id_sp` SMALLINT)
BEGIN
	SELECT `province_id` INTO province_id_sp FROM `ommu_core_zone_province` WHERE `mfdonline`=LEFT(mfdonline_sp,2);
	/*
	CALL getOmmuZoneProvinceIdWithCityMfdonline(NEW.mfdonline, province_id_tr);
	SELECT `province_id` INTO province_id_tr FROM `ommu_core_zone_province` WHERE `mfdonline`=LEFT(NEW.mfdonline,2);*/
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

/*Table structure for table `_view_core_menu` */

DROP TABLE IF EXISTS `_view_core_menu`;

/*!50001 DROP VIEW IF EXISTS `_view_core_menu` */;
/*!50001 DROP TABLE IF EXISTS `_view_core_menu` */;

/*!50001 CREATE TABLE  `_view_core_menu`(
 `menu_id` int(11) unsigned 
)*/;

/*Table structure for table `_view_core_menu_category` */

DROP TABLE IF EXISTS `_view_core_menu_category`;

/*!50001 DROP VIEW IF EXISTS `_view_core_menu_category` */;
/*!50001 DROP TABLE IF EXISTS `_view_core_menu_category` */;

/*!50001 CREATE TABLE  `_view_core_menu_category`(
 `cat_id` smallint(5) unsigned ,
 `menus` decimal(23,0) ,
 `menu_all` bigint(21) 
)*/;

/*Table structure for table `_view_core_meta` */

DROP TABLE IF EXISTS `_view_core_meta`;

/*!50001 DROP VIEW IF EXISTS `_view_core_meta` */;
/*!50001 DROP TABLE IF EXISTS `_view_core_meta` */;

/*!50001 CREATE TABLE  `_view_core_meta`(
 `id` tinyint(1) unsigned ,
 `city_name` varchar(64) ,
 `province_name` varchar(64) ,
 `country_name` varchar(64) 
)*/;

/*Table structure for table `_view_core_pages` */

DROP TABLE IF EXISTS `_view_core_pages`;

/*!50001 DROP VIEW IF EXISTS `_view_core_pages` */;
/*!50001 DROP TABLE IF EXISTS `_view_core_pages` */;

/*!50001 CREATE TABLE  `_view_core_pages`(
 `page_id` smallint(5) unsigned 
)*/;

/*Table structure for table `_view_core_zone_city` */

DROP TABLE IF EXISTS `_view_core_zone_city`;

/*!50001 DROP VIEW IF EXISTS `_view_core_zone_city` */;
/*!50001 DROP TABLE IF EXISTS `_view_core_zone_city` */;

/*!50001 CREATE TABLE  `_view_core_zone_city`(
 `city_id` int(11) unsigned ,
 `city_name` varchar(64) ,
 `province_name` varchar(64) 
)*/;

/*Table structure for table `_view_core_zone_districts` */

DROP TABLE IF EXISTS `_view_core_zone_districts`;

/*!50001 DROP VIEW IF EXISTS `_view_core_zone_districts` */;
/*!50001 DROP TABLE IF EXISTS `_view_core_zone_districts` */;

/*!50001 CREATE TABLE  `_view_core_zone_districts`(
 `district_id` int(11) unsigned ,
 `district_name` varchar(64) ,
 `city_name` varchar(64) ,
 `province_name` varchar(64) 
)*/;

/*Table structure for table `_view_core_zone_village` */

DROP TABLE IF EXISTS `_view_core_zone_village`;

/*!50001 DROP VIEW IF EXISTS `_view_core_zone_village` */;
/*!50001 DROP TABLE IF EXISTS `_view_core_zone_village` */;

/*!50001 CREATE TABLE  `_view_core_zone_village`(
 `village_id` int(11) unsigned ,
 `village_name` varchar(64) ,
 `district_name` varchar(64) ,
 `city_name` varchar(64) ,
 `province_name` varchar(64) 
)*/;

/*View structure for view _view_core_author_contact_category */

/*!50001 DROP TABLE IF EXISTS `_view_core_author_contact_category` */;
/*!50001 DROP VIEW IF EXISTS `_view_core_author_contact_category` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_view_core_author_contact_category` AS select `a`.`cat_id` AS `cat_id`,sum((case when (`b`.`publish` = '1') then 1 else 0 end)) AS `contacts`,count(`b`.`id`) AS `contact_all` from (`ommu_core_author_contact_category` `a` left join `ommu_core_author_contacts` `b` on((`a`.`cat_id` = `b`.`cat_id`))) group by `a`.`cat_id` */;

/*View structure for view _view_core_authors */

/*!50001 DROP TABLE IF EXISTS `_view_core_authors` */;
/*!50001 DROP VIEW IF EXISTS `_view_core_authors` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_view_core_authors` AS select `a`.`author_id` AS `author_id`,sum((case when (`b`.`publish` = '1') then 1 else 0 end)) AS `contacts`,count(`b`.`id`) AS `contact_all` from (`ommu_core_authors` `a` left join `ommu_core_author_contacts` `b` on((`a`.`author_id` = `b`.`author_id`))) group by `a`.`author_id` */;

/*View structure for view _view_core_menu */

/*!50001 DROP TABLE IF EXISTS `_view_core_menu` */;
/*!50001 DROP VIEW IF EXISTS `_view_core_menu` */;

/*!50001 CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_view_core_menu` AS select `a`.`id` AS `menu_id` from `ommu_core_menu` `a` */;

/*View structure for view _view_core_menu_category */

/*!50001 DROP TABLE IF EXISTS `_view_core_menu_category` */;
/*!50001 DROP VIEW IF EXISTS `_view_core_menu_category` */;

/*!50001 CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_view_core_menu_category` AS select `a`.`cat_id` AS `cat_id`,sum((case when (`b`.`publish` = '1') then 1 else 0 end)) AS `menus`,count(`b`.`cat_id`) AS `menu_all` from (`ommu_core_menu_category` `a` left join `ommu_core_menu` `b` on((`a`.`cat_id` = `b`.`cat_id`))) group by `a`.`cat_id` */;

/*View structure for view _view_core_meta */

/*!50001 DROP TABLE IF EXISTS `_view_core_meta` */;
/*!50001 DROP VIEW IF EXISTS `_view_core_meta` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_view_core_meta` AS select `a`.`id` AS `id`,`b`.`city_name` AS `city_name`,`c`.`province_name` AS `province_name`,`d`.`country_name` AS `country_name` from (((`ommu_core_meta` `a` left join `ommu_core_zone_city` `b` on((`a`.`office_city` = `b`.`city_id`))) left join `ommu_core_zone_province` `c` on((`a`.`office_province` = `c`.`province_id`))) left join `ommu_core_zone_country` `d` on((`a`.`office_country` = `d`.`country_id`))) group by `a`.`id` */;

/*View structure for view _view_core_pages */

/*!50001 DROP TABLE IF EXISTS `_view_core_pages` */;
/*!50001 DROP VIEW IF EXISTS `_view_core_pages` */;

/*!50001 CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_view_core_pages` AS select `a`.`page_id` AS `page_id` from `ommu_core_pages` `a` */;

/*View structure for view _view_core_zone_city */

/*!50001 DROP TABLE IF EXISTS `_view_core_zone_city` */;
/*!50001 DROP VIEW IF EXISTS `_view_core_zone_city` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_view_core_zone_city` AS select `a`.`city_id` AS `city_id`,`a`.`city_name` AS `city_name`,`b`.`province_name` AS `province_name` from (`ommu_core_zone_city` `a` left join `ommu_core_zone_province` `b` on((`a`.`province_id` = `b`.`province_id`))) group by `a`.`city_id` */;

/*View structure for view _view_core_zone_districts */

/*!50001 DROP TABLE IF EXISTS `_view_core_zone_districts` */;
/*!50001 DROP VIEW IF EXISTS `_view_core_zone_districts` */;

/*!50001 CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_view_core_zone_districts` AS select `a`.`district_id` AS `district_id`,`a`.`district_name` AS `district_name`,`b`.`city_name` AS `city_name`,`b`.`province_name` AS `province_name` from (`ommu_core_zone_districts` `a` left join `_view_core_zone_city` `b` on((`a`.`city_id` = `b`.`city_id`))) group by `a`.`district_id` */;

/*View structure for view _view_core_zone_village */

/*!50001 DROP TABLE IF EXISTS `_view_core_zone_village` */;
/*!50001 DROP VIEW IF EXISTS `_view_core_zone_village` */;

/*!50001 CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_view_core_zone_village` AS select `a`.`village_id` AS `village_id`,`a`.`village_name` AS `village_name`,`b`.`district_name` AS `district_name`,`b`.`city_name` AS `city_name`,`b`.`province_name` AS `province_name` from (`ommu_core_zone_village` `a` left join `_view_core_zone_districts` `b` on((`a`.`district_id` = `b`.`district_id`))) group by `a`.`village_id` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
