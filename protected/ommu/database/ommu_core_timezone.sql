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

/*Table structure for table `ommu_core_timezone` */

DROP TABLE IF EXISTS `ommu_core_timezone`;

CREATE TABLE `ommu_core_timezone` (
  `timezone_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `timezone_name` varchar(64) NOT NULL,
  `title` varchar(64) NOT NULL,
  PRIMARY KEY (`timezone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=310 DEFAULT CHARSET=utf8;

/*Data for the table `ommu_core_timezone` */

insert  into `ommu_core_timezone`(`timezone_id`,`default`,`timezone_name`,`title`) values (1,0,'Pacific/Midway','(GMT-11:00) Midway'),(2,0,'Pacific/Niue','(GMT-11:00) Niue'),(3,0,'Pacific/Pago_Pago','(GMT-11:00) Pago Pago'),(4,0,'Pacific/Fakaofo','(GMT-10:00) Fakaofo'),(5,0,'Pacific/Honolulu','(GMT-10:00) Hawaii Time'),(6,0,'Pacific/Johnston','(GMT-10:00) Johnston'),(7,0,'Pacific/Rarotonga','(GMT-10:00) Rarotonga'),(8,0,'Pacific/Tahiti','(GMT-10:00) Tahiti'),(9,0,'Pacific/Marquesas','(GMT-09:30) Marquesas'),(10,0,'America/Anchorage','(GMT-09:00) Alaska Time'),(11,0,'Pacific/Gambier','(GMT-09:00) Gambier'),(12,0,'\'America/Los_Angeles\" selected=\"','(GMT-08:00) Pacific Time'),(13,0,'America/Tijuana','(GMT-08:00) Pacific Time - Tijuana'),(14,0,'America/Vancouver','(GMT-08:00) Pacific Time - Vancouver'),(15,0,'America/Whitehorse','(GMT-08:00) Pacific Time - Whitehorse'),(16,0,'Pacific/Pitcairn','(GMT-08:00) Pitcairn'),(17,0,'America/Dawson_Creek','(GMT-07:00) Mountain Time - Dawson Creek'),(18,0,'America/Denver','(GMT-07:00) Mountain Time'),(19,0,'America/Edmonton','(GMT-07:00) Mountain Time - Edmonton'),(20,0,'America/Hermosillo','(GMT-07:00) Mountain Time - Hermosillo'),(21,0,'America/Mazatlan','(GMT-07:00) Mountain Time - Chihuahua, Mazatlan'),(22,0,'America/Phoenix','(GMT-07:00) Mountain Time - Arizona'),(23,0,'America/Yellowknife','(GMT-07:00) Mountain Time - Yellowknife'),(24,0,'America/Belize','(GMT-06:00) Belize'),(25,0,'America/Chicago','(GMT-06:00) Central Time'),(26,0,'America/Costa_Rica','(GMT-06:00) Costa Rica'),(27,0,'America/El_Salvador','(GMT-06:00) El Salvador'),(28,0,'America/Guatemala','(GMT-06:00) Guatemala'),(29,0,'America/Managua','(GMT-06:00) Managua'),(30,0,'America/Mexico_City','(GMT-06:00) Central Time - Mexico City'),(31,0,'America/Regina','(GMT-06:00) Central Time - Regina'),(32,0,'America/Tegucigalpa','(GMT-06:00) Central Time - Tegucigalpa'),(33,0,'America/Winnipeg','(GMT-06:00) Central Time - Winnipeg'),(34,0,'Pacific/Easter','(GMT-06:00) Easter Island'),(35,0,'Pacific/Galapagos','(GMT-06:00) Galapagos'),(36,0,'America/Bogota','(GMT-05:00) Bogota'),(37,0,'America/Cayman','(GMT-05:00) Cayman'),(38,0,'America/Grand_Turk','(GMT-05:00) Grand Turk'),(39,0,'America/Guayaquil','(GMT-05:00) Guayaquil'),(40,0,'America/Havana','(GMT-05:00) Havana'),(41,0,'America/Iqaluit','(GMT-05:00) Eastern Time - Iqaluit'),(42,0,'America/Jamaica','(GMT-05:00) Jamaica'),(43,0,'America/Lima','(GMT-05:00) Lima'),(44,0,'America/Montreal','(GMT-05:00) Eastern Time - Montreal'),(45,0,'America/Nassau','(GMT-05:00) Nassau'),(46,0,'America/New_York','(GMT-05:00) Eastern Time'),(47,0,'America/Panama','(GMT-05:00) Panama'),(48,0,'America/Port-au-Prince','(GMT-05:00) Port-au-Prince'),(49,0,'America/Toronto','(GMT-05:00) Eastern Time - Toronto'),(50,0,'America/Caracas','(GMT-04:30) Caracas'),(51,0,'America/Anguilla','(GMT-04:00) Anguilla'),(52,0,'America/Antigua','(GMT-04:00) Antigua'),(53,0,'America/Aruba','(GMT-04:00) Aruba'),(54,0,'America/Asuncion','(GMT-04:00) Asuncion'),(55,0,'America/Barbados','(GMT-04:00) Barbados'),(56,0,'America/Boa_Vista','(GMT-04:00) Boa Vista'),(57,0,'America/Campo_Grande','(GMT-04:00) Campo Grande'),(58,0,'America/Cuiaba','(GMT-04:00) Cuiaba'),(59,0,'America/Curacao','(GMT-04:00) Curacao'),(60,0,'America/Dominica','(GMT-04:00) Dominica'),(61,0,'America/Grenada','(GMT-04:00) Grenada'),(62,0,'America/Guadeloupe','(GMT-04:00) Guadeloupe'),(63,0,'America/Guyana','(GMT-04:00) Guyana'),(64,0,'America/Halifax','(GMT-04:00) Atlantic Time - Halifax'),(65,0,'America/La_Paz','(GMT-04:00) La Paz'),(66,0,'America/Manaus','(GMT-04:00) Manaus'),(67,0,'America/Martinique','(GMT-04:00) Martinique'),(68,0,'America/Montserrat','(GMT-04:00) Montserrat'),(69,0,'America/Port_of_Spain','(GMT-04:00) Port of Spain'),(70,0,'America/Porto_Velho','(GMT-04:00) Porto Velho'),(71,0,'America/Puerto_Rico','(GMT-04:00) Puerto Rico'),(72,0,'America/Rio_Branco','(GMT-04:00) Rio Branco'),(73,0,'America/Santiago','(GMT-04:00) Santiago'),(74,0,'America/Santo_Domingo','(GMT-04:00) Santo Domingo'),(75,0,'America/St_Kitts','(GMT-04:00) St. Kitts'),(76,0,'America/St_Lucia','(GMT-04:00) St. Lucia'),(77,0,'America/St_Thomas','(GMT-04:00) St. Thomas'),(78,0,'America/St_Vincent','(GMT-04:00) St. Vincent'),(79,0,'America/Thule','(GMT-04:00) Thule'),(80,0,'America/Tortola','(GMT-04:00) Tortola'),(81,0,'Antarctica/Palmer','(GMT-04:00) Palmer'),(82,0,'Atlantic/Bermuda','(GMT-04:00) Bermuda'),(83,0,'Atlantic/Stanley','(GMT-04:00) Stanley'),(84,0,'America/St_Johns','(GMT-03:30) Newfoundland Time - St. Johns'),(85,0,'America/Araguaina','(GMT-03:00) Araguaina'),(86,0,'America/Argentina/Buenos_Aires','(GMT-03:00) Buenos Aires'),(87,0,'America/Bahia','(GMT-03:00) Salvador'),(88,0,'America/Belem','(GMT-03:00) Belem'),(89,0,'America/Cayenne','(GMT-03:00) Cayenne'),(90,0,'America/Fortaleza','(GMT-03:00) Fortaleza'),(91,0,'America/Godthab','(GMT-03:00) Godthab'),(92,0,'America/Maceio','(GMT-03:00) Maceio'),(93,0,'America/Miquelon','(GMT-03:00) Miquelon'),(94,0,'America/Montevideo','(GMT-03:00) Montevideo'),(95,0,'America/Paramaribo','(GMT-03:00) Paramaribo'),(96,0,'America/Recife','(GMT-03:00) Recife'),(97,0,'America/Sao_Paulo','(GMT-03:00) Sao Paulo'),(98,0,'Antarctica/Rothera','(GMT-03:00) Rothera'),(99,0,'America/Noronha','(GMT-02:00) Noronha'),(100,0,'Atlantic/South_Georgia','(GMT-02:00) South Georgia'),(101,0,'America/Scoresbysund','(GMT-01:00) Scoresbysund'),(102,0,'Atlantic/Azores','(GMT-01:00) Azores'),(103,0,'Atlantic/Cape_Verde','(GMT-01:00) Cape Verde'),(104,0,'Africa/Abidjan','(GMT+00:00) Abidjan'),(105,0,'Africa/Accra','(GMT+00:00) Accra'),(106,0,'Africa/Bamako','(GMT+00:00) Bamako'),(107,0,'Africa/Banjul','(GMT+00:00) Banjul'),(108,0,'Africa/Bissau','(GMT+00:00) Bissau'),(109,0,'Africa/Casablanca','(GMT+00:00) Casablanca'),(110,0,'Africa/Conakry','(GMT+00:00) Conakry'),(111,0,'Africa/Dakar','(GMT+00:00) Dakar'),(112,0,'Africa/El_Aaiun','(GMT+00:00) El Aaiun'),(113,0,'Africa/Freetown','(GMT+00:00) Freetown'),(114,0,'Africa/Lome','(GMT+00:00) Lome'),(115,0,'Africa/Monrovia','(GMT+00:00) Monrovia'),(116,0,'Africa/Nouakchott','(GMT+00:00) Nouakchott'),(117,0,'Africa/Ouagadougou','(GMT+00:00) Ouagadougou'),(118,0,'Africa/Sao_Tome','(GMT+00:00) Sao Tome'),(119,0,'America/Danmarkshavn','(GMT+00:00) Danmarkshavn'),(120,0,'Atlantic/Canary','(GMT+00:00) Canary Islands'),(121,0,'Atlantic/Faroe','(GMT+00:00) Faeroe'),(122,0,'Atlantic/Reykjavik','(GMT+00:00) Reykjavik'),(123,0,'Atlantic/St_Helena','(GMT+00:00) St Helena'),(124,0,'Etc/GMT','(GMT+00:00) GMT (no daylight saving)'),(125,0,'Europe/Dublin','(GMT+00:00) Dublin'),(126,0,'Europe/Lisbon','(GMT+00:00) Lisbon'),(127,0,'Europe/London','(GMT+00:00) London'),(128,0,'Africa/Algiers','(GMT+01:00) Algiers'),(129,0,'Africa/Bangui','(GMT+01:00) Bangui'),(130,0,'Africa/Brazzaville','(GMT+01:00) Brazzaville'),(131,0,'Africa/Ceuta','(GMT+01:00) Ceuta'),(132,0,'Africa/Douala','(GMT+01:00) Douala'),(133,0,'Africa/Kinshasa','(GMT+01:00) Kinshasa'),(134,0,'Africa/Lagos','(GMT+01:00) Lagos'),(135,0,'Africa/Libreville','(GMT+01:00) Libreville'),(136,0,'Africa/Luanda','(GMT+01:00) Luanda'),(137,0,'Africa/Malabo','(GMT+01:00) Malabo'),(138,0,'Africa/Ndjamena','(GMT+01:00) Ndjamena'),(139,0,'Africa/Niamey','(GMT+01:00) Niamey'),(140,0,'Africa/Porto-Novo','(GMT+01:00) Porto-Novo'),(141,0,'Africa/Tunis','(GMT+01:00) Tunis'),(142,0,'Africa/Windhoek','(GMT+01:00) Windhoek'),(143,0,'Europe/Amsterdam','(GMT+01:00) Amsterdam'),(144,0,'Europe/Andorra','(GMT+01:00) Andorra'),(145,0,'Europe/Belgrade','(GMT+01:00) Central European Time - Belgrade'),(146,0,'Europe/Berlin','(GMT+01:00) Berlin'),(147,0,'Europe/Brussels','(GMT+01:00) Brussels'),(148,0,'Europe/Budapest','(GMT+01:00) Budapest'),(149,0,'Europe/Copenhagen','(GMT+01:00) Copenhagen'),(150,0,'Europe/Gibraltar','(GMT+01:00) Gibraltar'),(151,0,'Europe/Luxembourg','(GMT+01:00) Luxembourg'),(152,0,'Europe/Madrid','(GMT+01:00) Madrid'),(153,0,'Europe/Malta','(GMT+01:00) Malta'),(154,0,'Europe/Monaco','(GMT+01:00) Monaco'),(155,0,'Europe/Oslo','(GMT+01:00) Oslo'),(156,0,'Europe/Paris','(GMT+01:00) Paris'),(157,0,'Europe/Prague','(GMT+01:00) Central European Time - Prague'),(158,0,'Europe/Rome','(GMT+01:00) Rome'),(159,0,'Europe/Stockholm','(GMT+01:00) Stockholm'),(160,0,'Europe/Tirane','(GMT+01:00) Tirane'),(161,0,'Europe/Vaduz','(GMT+01:00) Vaduz'),(162,0,'Europe/Vienna','(GMT+01:00) Vienna'),(163,0,'Europe/Warsaw','(GMT+01:00) Warsaw'),(164,0,'Europe/Zurich','(GMT+01:00) Zurich'),(165,0,'Africa/Blantyre','(GMT+02:00) Blantyre'),(166,0,'Africa/Bujumbura','(GMT+02:00) Bujumbura'),(167,0,'Africa/Cairo','(GMT+02:00) Cairo'),(168,0,'Africa/Gaborone','(GMT+02:00) Gaborone'),(169,0,'Africa/Harare','(GMT+02:00) Harare'),(170,0,'Africa/Johannesburg','(GMT+02:00) Johannesburg'),(171,0,'Africa/Kigali','(GMT+02:00) Kigali'),(172,0,'Africa/Lubumbashi','(GMT+02:00) Lubumbashi'),(173,0,'Africa/Lusaka','(GMT+02:00) Lusaka'),(174,0,'Africa/Maputo','(GMT+02:00) Maputo'),(175,0,'Africa/Maseru','(GMT+02:00) Maseru'),(176,0,'Africa/Mbabane','(GMT+02:00) Mbabane'),(177,0,'Africa/Tripoli','(GMT+02:00) Tripoli'),(178,0,'Asia/Amman','(GMT+02:00) Amman'),(179,0,'Asia/Beirut','(GMT+02:00) Beirut'),(180,0,'Asia/Damascus','(GMT+02:00) Damascus'),(181,0,'Asia/Gaza','(GMT+02:00) Gaza'),(182,0,'Asia/Jerusalem','(GMT+02:00) Jerusalem'),(183,0,'Asia/Nicosia','(GMT+02:00) Nicosia'),(184,0,'Europe/Athens','(GMT+02:00) Athens'),(185,0,'Europe/Bucharest','(GMT+02:00) Bucharest'),(186,0,'Europe/Chisinau','(GMT+02:00) Chisinau'),(187,0,'Europe/Helsinki','(GMT+02:00) Helsinki'),(188,0,'Europe/Istanbul','(GMT+02:00) Istanbul'),(189,0,'Europe/Kiev','(GMT+02:00) Kiev'),(190,0,'Europe/Riga','(GMT+02:00) Riga'),(191,0,'Europe/Sofia','(GMT+02:00) Sofia'),(192,0,'Europe/Tallinn','(GMT+02:00) Tallinn'),(193,0,'Europe/Vilnius','(GMT+02:00) Vilnius'),(194,0,'Africa/Addis_Ababa','(GMT+03:00) Addis Ababa'),(195,0,'Africa/Asmara','(GMT+03:00) Asmera'),(196,0,'Africa/Dar_es_Salaam','(GMT+03:00) Dar es Salaam'),(197,0,'Africa/Djibouti','(GMT+03:00) Djibouti'),(198,0,'Africa/Kampala','(GMT+03:00) Kampala'),(199,0,'Africa/Khartoum','(GMT+03:00) Khartoum'),(200,0,'Africa/Mogadishu','(GMT+03:00) Mogadishu'),(201,0,'Africa/Nairobi','(GMT+03:00) Nairobi'),(202,0,'Antarctica/Syowa','(GMT+03:00) Syowa'),(203,0,'Asia/Aden','(GMT+03:00) Aden'),(204,0,'Asia/Baghdad','(GMT+03:00) Baghdad'),(205,0,'Asia/Bahrain','(GMT+03:00) Bahrain'),(206,0,'Asia/Kuwait','(GMT+03:00) Kuwait'),(207,0,'Asia/Qatar','(GMT+03:00) Qatar'),(208,0,'Asia/Riyadh','(GMT+03:00) Riyadh'),(209,0,'Europe/Kaliningrad','(GMT+03:00) Moscow-01 - Kaliningrad'),(210,0,'Europe/Minsk','(GMT+03:00) Minsk'),(211,0,'Indian/Antananarivo','(GMT+03:00) Antananarivo'),(212,0,'Indian/Comoro','(GMT+03:00) Comoro'),(213,0,'Indian/Mayotte','(GMT+03:00) Mayotte'),(214,0,'Asia/Tehran','(GMT+03:30) Tehran'),(215,0,'Asia/Baku','(GMT+04:00) Baku'),(216,0,'Asia/Dubai','(GMT+04:00) Dubai'),(217,0,'Asia/Muscat','(GMT+04:00) Muscat'),(218,0,'Asia/Tbilisi','(GMT+04:00) Tbilisi'),(219,0,'Asia/Yerevan','(GMT+04:00) Yerevan'),(220,0,'Europe/Moscow','(GMT+04:00) Moscow+00'),(221,0,'Europe/Samara','(GMT+04:00) Moscow+00 - Samara'),(222,0,'Indian/Mahe','(GMT+04:00) Mahe'),(223,0,'Indian/Mauritius','(GMT+04:00) Mauritius'),(224,0,'Indian/Reunion','(GMT+04:00) Reunion'),(225,0,'Asia/Kabul','(GMT+04:30) Kabul'),(226,0,'Antarctica/Mawson','(GMT+05:00) Mawson'),(227,0,'Asia/Aqtau','(GMT+05:00) Aqtau'),(228,0,'Asia/Aqtobe','(GMT+05:00) Aqtobe'),(229,0,'Asia/Ashgabat','(GMT+05:00) Ashgabat'),(230,0,'Asia/Dushanbe','(GMT+05:00) Dushanbe'),(231,0,'Asia/Karachi','(GMT+05:00) Karachi'),(232,0,'Asia/Tashkent','(GMT+05:00) Tashkent'),(233,0,'Indian/Kerguelen','(GMT+05:00) Kerguelen'),(234,0,'Indian/Maldives','(GMT+05:00) Maldives'),(235,0,'Asia/Calcutta','(GMT+05:30) India Standard Time'),(236,0,'Asia/Colombo','(GMT+05:30) Colombo'),(237,0,'Asia/Katmandu','(GMT+05:45) Katmandu'),(238,0,'Antarctica/Vostok','(GMT+06:00) Vostok'),(239,0,'Asia/Almaty','(GMT+06:00) Almaty'),(240,0,'Asia/Bishkek','(GMT+06:00) Bishkek'),(241,0,'Asia/Dhaka','(GMT+06:00) Dhaka'),(242,0,'Asia/Thimphu','(GMT+06:00) Thimphu'),(243,0,'Asia/Yekaterinburg','(GMT+06:00) Moscow+02 - Yekaterinburg'),(244,0,'Indian/Chagos','(GMT+06:00) Chagos'),(245,0,'Asia/Rangoon','(GMT+06:30) Rangoon'),(246,0,'Indian/Cocos','(GMT+06:30) Cocos'),(247,0,'Antarctica/Davis','(GMT+07:00) Davis'),(248,0,'Asia/Bangkok','(GMT+07:00) Bangkok'),(249,0,'Asia/Hovd','(GMT+07:00) Hovd'),(250,1,'Asia/Jakarta','(GMT+07:00) Jakarta'),(251,0,'Asia/Omsk','(GMT+07:00) Moscow+03 - Omsk, Novosibirsk'),(252,0,'Asia/Phnom_Penh','(GMT+07:00) Phnom Penh'),(253,0,'Asia/Saigon','(GMT+07:00) Hanoi'),(254,0,'Asia/Vientiane','(GMT+07:00) Vientiane'),(255,0,'Indian/Christmas','(GMT+07:00) Christmas'),(256,0,'Antarctica/Casey','(GMT+08:00) Casey'),(257,0,'Asia/Brunei','(GMT+08:00) Brunei'),(258,0,'Asia/Choibalsan','(GMT+08:00) Choibalsan'),(259,0,'Asia/Hong_Kong','(GMT+08:00) Hong Kong'),(260,0,'Asia/Krasnoyarsk','(GMT+08:00) Moscow+04 - Krasnoyarsk'),(261,0,'Asia/Kuala_Lumpur','(GMT+08:00) Kuala Lumpur'),(262,0,'Asia/Macau','(GMT+08:00) Macau'),(263,0,'Asia/Makassar','(GMT+08:00) Makassar'),(264,0,'Asia/Manila','(GMT+08:00) Manila'),(265,0,'Asia/Shanghai','(GMT+08:00) China Time - Beijing'),(266,0,'Asia/Singapore','(GMT+08:00) Singapore'),(267,0,'Asia/Taipei','(GMT+08:00) Taipei'),(268,0,'Asia/Ulaanbaatar','(GMT+08:00) Ulaanbaatar'),(269,0,'Australia/Perth','(GMT+08:00) Western Time - Perth'),(270,0,'Asia/Dili','(GMT+09:00) Dili'),(271,0,'Asia/Irkutsk','(GMT+09:00) Moscow+05 - Irkutsk'),(272,0,'Asia/Jayapura','(GMT+09:00) Jayapura'),(273,0,'Asia/Pyongyang','(GMT+09:00) Pyongyang'),(274,0,'Asia/Seoul','(GMT+09:00) Seoul'),(275,0,'Asia/Tokyo','(GMT+09:00) Tokyo'),(276,0,'Pacific/Palau','(GMT+09:00) Palau'),(277,0,'Australia/Adelaide','(GMT+09:30) Central Time - Adelaide'),(278,0,'Australia/Darwin','(GMT+09:30) Central Time - Darwin'),(279,0,'Antarctica/DumontDUrville','(GMT+10:00) Dumont DUrville'),(280,0,'Asia/Yakutsk','(GMT+10:00) Moscow+06 - Yakutsk'),(281,0,'Australia/Brisbane','(GMT+10:00) Eastern Time - Brisbane'),(282,0,'Australia/Hobart','(GMT+10:00) Eastern Time - Hobart'),(283,0,'Australia/Sydney','(GMT+10:00) Eastern Time - Melbourne, Sydney'),(284,0,'Pacific/Guam','(GMT+10:00) Guam'),(285,0,'Pacific/Port_Moresby','(GMT+10:00) Port Moresby'),(286,0,'Pacific/Saipan','(GMT+10:00) Saipan'),(287,0,'Pacific/Truk','(GMT+10:00) Truk'),(288,0,'Asia/Vladivostok','(GMT+11:00) Moscow+07 - Yuzhno-Sakhalinsk'),(289,0,'Pacific/Efate','(GMT+11:00) Efate'),(290,0,'Pacific/Guadalcanal','(GMT+11:00) Guadalcanal'),(291,0,'Pacific/Kosrae','(GMT+11:00) Kosrae'),(292,0,'Pacific/Noumea','(GMT+11:00) Noumea'),(293,0,'Pacific/Ponape','(GMT+11:00) Ponape'),(294,0,'Pacific/Norfolk','(GMT+11:30) Norfolk'),(295,0,'Asia/Kamchatka','(GMT+12:00) Moscow+08 - Petropavlovsk-Kamchatskiy'),(296,0,'Asia/Magadan','(GMT+12:00) Moscow+08 - Magadan'),(297,0,'Pacific/Auckland','(GMT+12:00) Auckland'),(298,0,'Pacific/Fiji','(GMT+12:00) Fiji'),(299,0,'Pacific/Funafuti','(GMT+12:00) Funafuti'),(300,0,'Pacific/Kwajalein','(GMT+12:00) Kwajalein'),(301,0,'Pacific/Majuro','(GMT+12:00) Majuro'),(302,0,'Pacific/Nauru','(GMT+12:00) Nauru'),(303,0,'Pacific/Tarawa','(GMT+12:00) Tarawa'),(304,0,'Pacific/Wake','(GMT+12:00) Wake'),(305,0,'Pacific/Wallis','(GMT+12:00) Wallis'),(306,0,'Pacific/Apia','(GMT+13:00) Apia'),(307,0,'Pacific/Enderbury','(GMT+13:00) Enderbury'),(308,0,'Pacific/Tongatapu','(GMT+13:00) Tongatapu'),(309,0,'Pacific/Kiritimati','(GMT+14:00) Kiritimati');

/*Table structure for table `ommu_users` */

DROP TABLE IF EXISTS `ommu_users`;

CREATE TABLE `ommu_users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `enabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=null, 1=enable, 2=blocked',
  `verified` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=unverified, 1=verified',
  `level_id` tinyint(2) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL COMMENT 'trigger[insert]',
  `timezone_id` smallint(5) unsigned DEFAULT NULL COMMENT 'trigger[insert]',
  `email` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `displayname` text NOT NULL COMMENT 'trigger[insert]',
  `password` varchar(32) NOT NULL,
  `photos` text NOT NULL,
  `salt` varchar(32) NOT NULL,
  `deactivate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=deactivate, 1=active',
  `search` tinyint(1) NOT NULL DEFAULT '1',
  `invisible` tinyint(1) NOT NULL DEFAULT '0',
  `privacy` tinyint(1) NOT NULL DEFAULT '1',
  `comments` tinyint(1) NOT NULL DEFAULT '1',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'trigger',
  `creation_ip` varchar(20) NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_id` int(11) unsigned NOT NULL,
  `lastlogin_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastlogin_ip` varchar(20) NOT NULL,
  `lastlogin_from` varchar(32) NOT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_ip` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `FK_ommu_user_language` (`language_id`),
  KEY `FK_ommu_user_level` (`level_id`),
  CONSTRAINT `FK_ommu_user_language` FOREIGN KEY (`language_id`) REFERENCES `ommu_core_languages` (`language_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_ommu_user_level` FOREIGN KEY (`level_id`) REFERENCES `ommu_user_level` (`level_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/* Trigger structure for table `ommu_users` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `userBeforeInsert` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `userBeforeInsert` BEFORE INSERT ON `ommu_users` FOR EACH ROW BEGIN
	DECLARE language_id_tr TINYINT;
	DECLARE timezone_id_tr SMALLINT;
	
	/* Language */	
	CALL coreGetLanguageDefault(language_id_tr);
	SET NEW.language_id = language_id_tr;
	
	/* Timezone */
	CALL coreGetTimezoneDefault(timezone_id_tr);
	SET NEW.timezone_id = timezone_id_tr;
	
	/* Displayname */
	IF (NEW.displayname = '') THEN
		SET NEW.displayname = CONCAT(NEW.first_name,' ',NEW.last_name);
	END IF;
    END */$$


DELIMITER ;

/* Procedure structure for procedure `coreGetTimezoneDefault` */

/*!50003 DROP PROCEDURE IF EXISTS  `coreGetTimezoneDefault` */;

DELIMITER $$

/*!50003 CREATE PROCEDURE `coreGetTimezoneDefault`(OUT `timezone_id_sp` SMALLINT)
BEGIN
	SELECT `timezone_id` INTO timezone_id_sp FROM `ommu_core_timezone` WHERE `default`=1;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
