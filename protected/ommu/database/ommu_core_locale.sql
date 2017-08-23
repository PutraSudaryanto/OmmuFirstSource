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

/*Table structure for table `ommu_core_locale` */

DROP TABLE IF EXISTS `ommu_core_locale`;

CREATE TABLE `ommu_core_locale` (
  `locale_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `locale` varchar(16) NOT NULL,
  `title` varchar(32) NOT NULL,
  PRIMARY KEY (`locale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=398 DEFAULT CHARSET=utf8;

/*Data for the table `ommu_core_locale` */

insert  into `ommu_core_locale`(`locale_id`,`default`,`locale`,`title`) values (1,0,'auto','[Automatic]'),(2,0,'aa_DJ','Afar (Djibouti)'),(3,0,'aa_ER','Afar (Eritrea)'),(4,0,'aa_ET','Afar (Ethiopia)'),(5,0,'aa','Afar'),(6,0,'af_NA','Afrikaans (Namibia)'),(7,0,'af_ZA','Afrikaans (South Africa)'),(8,0,'af','Afrikaans'),(9,0,'ak_GH','Akan (Ghana)'),(10,0,'ak','Akan'),(11,0,'sq_AL','Albanian (Albania)'),(12,0,'sq','Albanian'),(13,0,'am_ET','Amharic (Ethiopia)'),(14,0,'am','Amharic'),(15,0,'ar_DZ','Arabic (Algeria)'),(16,0,'ar_BH','Arabic (Bahrain)'),(17,0,'ar_EG','Arabic (Egypt)'),(18,0,'ar_IQ','Arabic (Iraq)'),(19,0,'ar_JO','Arabic (Jordan)'),(20,0,'ar_KW','Arabic (Kuwait)'),(21,0,'ar_LB','Arabic (Lebanon)'),(22,0,'ar_LY','Arabic (Libya)'),(23,0,'ar_MA','Arabic (Morocco)'),(24,0,'ar_OM','Arabic (Oman)'),(25,0,'ar_QA','Arabic (Qatar)'),(26,0,'ar_SA','Arabic (Saudi Arabia)'),(27,0,'ar_SD','Arabic (Sudan)'),(28,0,'ar_SY','Arabic (Syria)'),(29,0,'ar_TN','Arabic (Tunisia)'),(30,0,'ar_AE','Arabic (United Arab Emirates)'),(31,0,'ar_YE','Arabic (Yemen)'),(32,0,'ar','Arabic'),(33,0,'hy_AM','Armenian (Armenia)'),(34,0,'hy','Armenian'),(35,0,'as_IN','Assamese (India)'),(36,0,'as','Assamese'),(37,0,'cch_NG','Atsam (Nigeria)'),(38,0,'cch','Atsam'),(39,0,'en_AU','Australian English'),(40,0,'de_AT','Austrian German'),(41,0,'az_AZ','Azerbaijani (Azerbaijan)'),(42,0,'az','Azerbaijani'),(43,0,'eu_ES','Basque (Spain)'),(44,0,'eu','Basque'),(45,0,'be_BY','Belarusian (Belarus)'),(46,0,'be','Belarusian'),(47,0,'bn_BD','Bengali (Bangladesh)'),(48,0,'bn_IN','Bengali (India)'),(49,0,'bn','Bengali'),(50,0,'byn_ER','Blin (Eritrea)'),(51,0,'byn','Blin'),(52,0,'bs_BA','Bosnian (Bosnia and Herzegovina)'),(53,0,'bs','Bosnian'),(54,0,'pt_BR','Brazilian Portuguese'),(55,0,'en_GB','British English'),(56,0,'bg_BG','Bulgarian (Bulgaria)'),(57,0,'bg','Bulgarian'),(58,0,'my_MM','Burmese (Myanmar'),(59,0,'my','Burmese'),(60,0,'en_CA','Canadian English'),(61,0,'fr_CA','Canadian French'),(62,0,'ca_ES','Catalan (Spain)'),(63,0,'ca','Catalan'),(64,0,'zh_CN','Chinese (China)'),(65,0,'zh_HK','Chinese (Hong Kong SAR China)'),(66,0,'zh_MO','Chinese (Macau SAR China)'),(67,0,'zh_SG','Chinese (Singapore)'),(68,0,'zh_TW','Chinese (Taiwan)'),(69,0,'zh','Chinese'),(70,0,'cop','Coptic'),(71,0,'kw_GB','Cornish (United Kingdom)'),(72,0,'kw','Cornish'),(73,0,'hr_HR','Croatian (Croatia)'),(74,0,'hr','Croatian'),(75,0,'cs_CZ','Czech (Czech Republic)'),(76,0,'cs','Czech'),(77,0,'da_DK','Danish (Denmark)'),(78,0,'da','Danish'),(79,0,'dv_MV','Divehi (Maldives)'),(80,0,'dv','Divehi'),(81,0,'nl_NL','Dutch (Netherlands)'),(82,0,'nl','Dutch'),(83,0,'dz_BT','Dzongkha (Bhutan)'),(84,0,'dz','Dzongkha'),(85,0,'en_AS','English (American Samoa)'),(86,0,'en_BE','English (Belgium)'),(87,0,'en_BZ','English (Belize)'),(88,0,'en_BW','English (Botswana)'),(89,0,'en_GU','English (Guam)'),(90,0,'en_HK','English (Hong Kong SAR China)'),(91,0,'en_IN','English (India)'),(92,0,'en_IE','English (Ireland)'),(93,0,'en_JM','English (Jamaica)'),(94,0,'en_MT','English (Malta)'),(95,0,'en_MH','English (Marshall Islands)'),(96,0,'en_NA','English (Namibia)'),(97,0,'en_NZ','English (New Zealand)'),(98,0,'en_MP','English (Northern Mariana Island'),(99,0,'en_PK','English (Pakistan)'),(100,0,'en_PH','English (Philippines)'),(101,0,'en_SG','English (Singapore)'),(102,0,'en_ZA','English (South Africa)'),(103,0,'en_TT','English (Trinidad and Tobago)'),(104,0,'en_UM','English (U.S. Minor Outlying Isl'),(105,0,'en_VI','English (U.S. Virgin Islands)'),(106,0,'en_ZW','English (Zimbabwe)'),(107,0,'en','English'),(108,0,'eo','Esperanto'),(109,0,'et_EE','Estonian (Estonia)'),(110,0,'et','Estonian'),(111,0,'ee_GH','Ewe (Ghana)'),(112,0,'ee_TG','Ewe (Togo)'),(113,0,'ee','Ewe'),(114,0,'fo_FO','Faroese (Faroe Islands)'),(115,0,'fo','Faroese'),(116,0,'fil_PH','Filipino (Philippines)'),(117,0,'fil','Filipino'),(118,0,'fi_FI','Finnish (Finland)'),(119,0,'fi','Finnish'),(120,0,'nl_BE','Flemish'),(121,0,'fr_BE','French (Belgium)'),(122,0,'fr_FR','French (France)'),(123,0,'fr_LU','French (Luxembourg)'),(124,0,'fr_MC','French (Monaco)'),(125,0,'fr_SN','French (Senegal)'),(126,0,'fr','French'),(127,0,'fur_IT','Friulian (Italy)'),(128,0,'fur','Friulian'),(129,0,'gaa_GH','Ga (Ghana)'),(130,0,'gaa','Ga'),(131,0,'gl_ES','Galician (Spain)'),(132,0,'gl','Galician'),(133,0,'gez_ER','Geez (Eritrea)'),(134,0,'gez_ET','Geez (Ethiopia)'),(135,0,'gez','Geez'),(136,0,'ka_GE','Georgian (Georgia)'),(137,0,'ka','Georgian'),(138,0,'de_BE','German (Belgium)'),(139,0,'de_DE','German (Germany)'),(140,0,'de_LI','German (Liechtenstein)'),(141,0,'de_LU','German (Luxembourg)'),(142,0,'de','German'),(143,0,'el_CY','Greek (Cyprus)'),(144,0,'el_GR','Greek (Greece)'),(145,0,'el','Greek'),(146,0,'gu_IN','Gujarati (India)'),(147,0,'gu','Gujarati'),(148,0,'ha_GH','Hausa (Ghana)'),(149,0,'ha_NE','Hausa (Niger)'),(150,0,'ha_NG','Hausa (Nigeria)'),(151,0,'ha_SD','Hausa (Sudan)'),(152,0,'ha','Hausa'),(153,0,'haw_US','Hawaiian (United States)'),(154,0,'haw','Hawaiian'),(155,0,'he_IL','Hebrew (Israel)'),(156,0,'he','Hebrew'),(157,0,'hi_IN','Hindi (India)'),(158,0,'hi','Hindi'),(159,0,'hu_HU','Hungarian (Hungary)'),(160,0,'hu','Hungarian'),(161,0,'pt_PT','Iberian Portuguese'),(162,0,'es_ES','Iberian Spanish'),(163,0,'is_IS','Icelandic (Iceland)'),(164,0,'is','Icelandic'),(165,0,'ig_NG','Igbo (Nigeria)'),(166,0,'ig','Igbo'),(167,1,'id_ID','Indonesian (Indonesia)'),(168,0,'id','Indonesian'),(169,0,'ia','Interlingua'),(170,0,'iu','Inuktitut'),(171,0,'ga_IE','Irish (Ireland)'),(172,0,'ga','Irish'),(173,0,'it_IT','Italian (Italy)'),(174,0,'it_CH','Italian (Switzerland)'),(175,0,'it','Italian'),(176,0,'ja_JP','Japanese (Japan)'),(177,0,'ja','Japanese'),(178,0,'kaj_NG','Jju (Nigeria)'),(179,0,'kaj','Jju'),(180,0,'kl_GL','Kalaallisut (Greenland)'),(181,0,'kl','Kalaallisut'),(182,0,'kam_KE','Kamba (Kenya)'),(183,0,'kam','Kamba'),(184,0,'kn_IN','Kannada (India)'),(185,0,'kn','Kannada'),(186,0,'kk_KZ','Kazakh (Kazakhstan)'),(187,0,'kk','Kazakh'),(188,0,'km_KH','Khmer (Cambodia)'),(189,0,'km','Khmer'),(190,0,'rw_RW','Kinyarwanda (Rwanda)'),(191,0,'rw','Kinyarwanda'),(192,0,'ky_KG','Kirghiz (Kyrgyzstan)'),(193,0,'ky','Kirghiz'),(194,0,'kok_IN','Konkani (India)'),(195,0,'kok','Konkani'),(196,0,'ko_KR','Korean (South Korea)'),(197,0,'ko','Korean'),(198,0,'kfo_CI','Koro (Côte d’Ivoire)'),(199,0,'kfo','Koro'),(200,0,'kpe_GN','Kpelle (Guinea)'),(201,0,'kpe_LR','Kpelle (Liberia)'),(202,0,'kpe','Kpelle'),(203,0,'ku_IR','Kurdish (Iran)'),(204,0,'ku_IQ','Kurdish (Iraq)'),(205,0,'ku_SY','Kurdish (Syria)'),(206,0,'ku_TR','Kurdish (Turkey)'),(207,0,'ku','Kurdish'),(208,0,'lo_LA','Lao (Laos)'),(209,0,'lo','Lao'),(210,0,'lv_LV','Latvian (Latvia)'),(211,0,'lv','Latvian'),(212,0,'ln_CG','Lingala (Congo - Brazzaville)'),(213,0,'ln_CD','Lingala (Congo - Kinshasa)'),(214,0,'ln','Lingala'),(215,0,'lt_LT','Lithuanian (Lithuania)'),(216,0,'lt','Lithuanian'),(217,0,'nds_DE','Low German (Germany)'),(218,0,'nds','Low German'),(219,0,'mk_MK','Macedonian (Macedonia)'),(220,0,'mk','Macedonian'),(221,0,'ms_BN','Malay (Brunei)'),(222,0,'ms_MY','Malay (Malaysia)'),(223,0,'ms','Malay'),(224,0,'ml_IN','Malayalam (India)'),(225,0,'ml','Malayalam'),(226,0,'mt_MT','Maltese (Malta)'),(227,0,'mt','Maltese'),(228,0,'gv_GB','Manx (United Kingdom)'),(229,0,'gv','Manx'),(230,0,'mr_IN','Marathi (India)'),(231,0,'mr','Marathi'),(232,0,'mo','Moldavian'),(233,0,'mn_CN','Mongolian (China)'),(234,0,'mn_MN','Mongolian (Mongolia)'),(235,0,'mn','Mongolian'),(236,0,'ne_IN','Nepali (India)'),(237,0,'ne_NP','Nepali (Nepal)'),(238,0,'ne','Nepali'),(239,0,'se_FI','Northern Sami (Finland)'),(240,0,'se_NO','Northern Sami (Norway)'),(241,0,'se','Northern Sami'),(242,0,'nso_ZA','Northern Sotho (South Africa)'),(243,0,'nso','Northern Sotho'),(244,0,'nb_NO','Norwegian Bokmål (Norway)'),(245,0,'nb','Norwegian Bokmål'),(246,0,'nn_NO','Norwegian Nynorsk (Norway)'),(247,0,'nn','Norwegian Nynorsk'),(248,0,'no','Norwegian'),(249,0,'ny_MW','Nyanja (Malawi)'),(250,0,'ny','Nyanja'),(251,0,'oc_FR','Occitan (France)'),(252,0,'oc','Occitan'),(253,0,'or_IN','Oriya (India)'),(254,0,'or','Oriya'),(255,0,'om_ET','Oromo (Ethiopia)'),(256,0,'om_KE','Oromo (Kenya)'),(257,0,'om','Oromo'),(258,0,'ps_AF','Pashto (Afghanistan)'),(259,0,'ps','Pashto'),(260,0,'fa_AF','Persian (Afghanistan)'),(261,0,'fa_IR','Persian (Iran)'),(262,0,'fa','Persian'),(263,0,'pl_PL','Polish (Poland)'),(264,0,'pl','Polish'),(265,0,'pt','Portuguese'),(266,0,'pa_IN','Punjabi (India)'),(267,0,'pa_PK','Punjabi (Pakistan)'),(268,0,'pa','Punjabi'),(269,0,'ro_MD','Romanian (Moldova)'),(270,0,'ro_RO','Romanian (Romania)'),(271,0,'ro','Romanian'),(272,0,'ru_RU','Russian (Russia)'),(273,0,'ru_UA','Russian (Ukraine)'),(274,0,'ru','Russian'),(275,0,'sa_IN','Sanskrit (India)'),(276,0,'sa','Sanskrit'),(277,0,'sr_BA','Serbian (Bosnia and Herzegovina)'),(278,0,'sr_ME','Serbian (Montenegro)'),(279,0,'sr_CS','Serbian (Serbia and Montenegro)'),(280,0,'sr_RS','Serbian (Serbia)'),(281,0,'sr','Serbian'),(282,0,'sh_BA','Serbo-Croatian (Bosnia and Herze'),(283,0,'sh_CS','Serbo-Croatian (Serbia and Monte'),(284,0,'sh','Serbo-Croatian'),(285,0,'ii_CN','Sichuan Yi (China)'),(286,0,'ii','Sichuan Yi'),(287,0,'sid_ET','Sidamo (Ethiopia)'),(288,0,'sid','Sidamo'),(289,0,'si_LK','Sinhala (Sri Lanka)'),(290,0,'si','Sinhala'),(291,0,'sk_SK','Slovak (Slovakia)'),(292,0,'sk','Slovak'),(293,0,'sl_SI','Slovenian (Slovenia)'),(294,0,'sl','Slovenian'),(295,0,'so_DJ','Somali (Djibouti)'),(296,0,'so_ET','Somali (Ethiopia)'),(297,0,'so_KE','Somali (Kenya)'),(298,0,'so_SO','Somali (Somalia)'),(299,0,'so','Somali'),(300,0,'nr_ZA','South Ndebele (South Africa)'),(301,0,'nr','South Ndebele'),(302,0,'st_LS','Southern Sotho (Lesotho)'),(303,0,'st_ZA','Southern Sotho (South Africa)'),(304,0,'st','Southern Sotho'),(305,0,'es_AR','Spanish (Argentina)'),(306,0,'es_BO','Spanish (Bolivia)'),(307,0,'es_CL','Spanish (Chile)'),(308,0,'es_CO','Spanish (Colombia)'),(309,0,'es_CR','Spanish (Costa Rica)'),(310,0,'es_DO','Spanish (Dominican Republic)'),(311,0,'es_EC','Spanish (Ecuador)'),(312,0,'es_SV','Spanish (El Salvador)'),(313,0,'es_GT','Spanish (Guatemala)'),(314,0,'es_HN','Spanish (Honduras)'),(315,0,'es_MX','Spanish (Mexico)'),(316,0,'es_NI','Spanish (Nicaragua)'),(317,0,'es_PA','Spanish (Panama)'),(318,0,'es_PY','Spanish (Paraguay)'),(319,0,'es_PE','Spanish (Peru)'),(320,0,'es_PR','Spanish (Puerto Rico)'),(321,0,'es_US','Spanish (United States)'),(322,0,'es_UY','Spanish (Uruguay)'),(323,0,'es_VE','Spanish (Venezuela)'),(324,0,'es','Spanish'),(325,0,'sw_KE','Swahili (Kenya)'),(326,0,'sw_TZ','Swahili (Tanzania)'),(327,0,'sw','Swahili'),(328,0,'ss_ZA','Swati (South Africa)'),(329,0,'ss_SZ','Swati (Swaziland)'),(330,0,'ss','Swati'),(331,0,'sv_FI','Swedish (Finland)'),(332,0,'sv_SE','Swedish (Sweden)'),(333,0,'sv','Swedish'),(334,0,'fr_CH','Swiss French'),(335,0,'gsw_CH','Swiss German (Switzerland)'),(336,0,'gsw','Swiss German'),(337,0,'de_CH','Swiss High German'),(338,0,'syr_SY','Syriac (Syria)'),(339,0,'syr','Syriac'),(340,0,'tl','Tagalog'),(341,0,'tg_TJ','Tajik (Tajikistan)'),(342,0,'tg','Tajik'),(343,0,'ta_IN','Tamil (India)'),(344,0,'ta','Tamil'),(345,0,'trv_TW','Taroko (Taiwan)'),(346,0,'trv','Taroko'),(347,0,'tt_RU','Tatar (Russia)'),(348,0,'tt','Tatar'),(349,0,'te_IN','Telugu (India)'),(350,0,'te','Telugu'),(351,0,'th_TH','Thai (Thailand)'),(352,0,'th','Thai'),(353,0,'bo_CN','Tibetan (China)'),(354,0,'bo_IN','Tibetan (India)'),(355,0,'bo','Tibetan'),(356,0,'tig_ER','Tigre (Eritrea)'),(357,0,'tig','Tigre'),(358,0,'ti_ER','Tigrinya (Eritrea)'),(359,0,'ti_ET','Tigrinya (Ethiopia)'),(360,0,'ti','Tigrinya'),(361,0,'to_TO','Tonga (Tonga)'),(362,0,'to','Tonga'),(363,0,'ts_ZA','Tsonga (South Africa)'),(364,0,'ts','Tsonga'),(365,0,'tn_ZA','Tswana (South Africa)'),(366,0,'tn','Tswana'),(367,0,'tr_TR','Turkish (Turkey)'),(368,0,'tr','Turkish'),(369,0,'kcg_NG','Tyap (Nigeria)'),(370,0,'kcg','Tyap'),(371,0,'en_US','U.S. English'),(372,0,'ug_CN','Uighur (China)'),(373,0,'ug','Uighur'),(374,0,'uk_UA','Ukrainian (Ukraine)'),(375,0,'uk','Ukrainian'),(376,0,'ur_IN','Urdu (India)'),(377,0,'ur_PK','Urdu (Pakistan)'),(378,0,'ur','Urdu'),(379,0,'uz_AF','Uzbek (Afghanistan)'),(380,0,'uz_UZ','Uzbek (Uzbekistan)'),(381,0,'uz','Uzbek'),(382,0,'ve_ZA','Venda (South Africa)'),(383,0,'ve','Venda'),(384,0,'vi_VN','Vietnamese (Vietnam)'),(385,0,'vi','Vietnamese'),(386,0,'wal_ET','Walamo (Ethiopia)'),(387,0,'wal','Walamo'),(388,0,'cy_GB','Welsh (United Kingdom)'),(389,0,'cy','Welsh'),(390,0,'wo_SN','Wolof (Senegal)'),(391,0,'wo','Wolof'),(392,0,'xh_ZA','Xhosa (South Africa)'),(393,0,'xh','Xhosa'),(394,0,'yo_NG','Yoruba (Nigeria)'),(395,0,'yo','Yoruba'),(396,0,'zu_ZA','Zulu (South Africa)'),(397,0,'zu','Zulu');

/*Table structure for table `ommu_users` */

DROP TABLE IF EXISTS `ommu_users`;

CREATE TABLE `ommu_users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `enabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=null, 1=enable, 2=blocked',
  `verified` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=unverified, 1=verified',
  `level_id` tinyint(2) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL COMMENT 'trigger[insert]',
  `locale_id` smallint(5) unsigned DEFAULT NULL COMMENT 'trigger[insert]',
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
	DECLARE locale_id_tr SMALLINT;
	DECLARE timezone_id_tr SMALLINT;
	
	/* Language */	
	CALL coreGetLanguageDefault(language_id_tr);
	SET NEW.language_id = language_id_tr;
	
	/* Locale */
	CALL coreGetLocaleDefault(locale_id_tr);
	SET NEW.locale_id = locale_id_tr;
	
	/* Timezone */
	CALL coreGetTimezoneDefault(timezone_id_tr);
	SET NEW.timezone_id = timezone_id_tr;
	
	/* Displayname */
	IF (NEW.displayname = '') THEN
		SET NEW.displayname = CONCAT(NEW.first_name,' ',NEW.last_name);
	END IF;
    END */$$


DELIMITER ;

/* Procedure structure for procedure `coreGetLocaleDefault` */

/*!50003 DROP PROCEDURE IF EXISTS  `coreGetLocaleDefault` */;

DELIMITER $$

/*!50003 CREATE PROCEDURE `coreGetLocaleDefault`(OUT `locale_id_sp` SMALLINT)
BEGIN
	SELECT `locale_id` INTO locale_id_sp FROM `ommu_core_locale` WHERE `default`=1;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
