/*
SQLyog Ultimate v11.33 (32 bit)
MySQL - 10.1.44-MariaDB-0ubuntu0.18.04.1 : Database - cpm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cpm` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `cpm`;

/*Table structure for table `block` */

DROP TABLE IF EXISTS `block`;

CREATE TABLE `block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tot_slots` int(11) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `block` */

insert  into `block`(`id`,`name`,`tot_slots`,`address`) values (1,'DLF Square',2070,'DLF Square, Jacaranda Marg, DLF Phase 2, Sector 25, Gurugram, Haryana 122002'),(2,'Technocity',267,'606 A Wing, Technocity, Mahape, Navi Mumbai, Maharashtra 400710'),(3,'Jasu Tower',10,'Mombasa Rd'),(4,'Panari',50,'Msa rd'),(5,'Repen Center',50,'Syokimau, Off Mombasa Rd');

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `bldg_code` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `noslots` int(11) NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `fk_building_code` (`bldg_code`),
  CONSTRAINT `fk_building_code` FOREIGN KEY (`bldg_code`) REFERENCES `block` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer` */

insert  into `customer`(`cid`,`bldg_code`,`name`,`noslots`) values (1,1,'124SQFT',6),(2,2,'Paladion Networks',25),(3,5,'ILMN',1);

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values ('m000000_000000_base',1499668338),('m130524_201442_init',1499674521),('m140209_132017_init',1499668393),('m140403_174025_create_account_table',1499668394),('m140504_113157_update_tables',1499668398),('m140504_130429_create_token_table',1499668399),('m140506_102106_rbac_init',1499668634),('m140830_171933_fix_ip_field',1499668400),('m140830_172703_change_account_table_name',1499668400),('m141222_110026_update_ip_field',1499668401),('m141222_135246_alter_username_length',1499668401),('m150614_103145_update_social_account_table',1499668404),('m150623_212711_fix_username_notnull',1499668404),('m151218_234654_add_timezone_to_profile',1499668404),('m160929_103127_add_last_login_at_to_user_table',1499668405),('m170710_081000_add_companyid_column_to_user_table',1499677601),('m170710_090159_add_phone_number_column_to_user_table',1499677640),('m170710_103445_add_firstName_andlastName_columns_to_user_table',1499696403),('m170717_072426_change_building_name_and_city_name_column_language',1500278641),('m170717_090716_drop_name_and_company_columns_from_tag_master_table',1500312230);

/*Table structure for table `outry` */

DROP TABLE IF EXISTS `outry`;

CREATE TABLE `outry` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `out` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tagid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `outry` */

/*Table structure for table `parking_lot` */

DROP TABLE IF EXISTS `parking_lot`;

CREATE TABLE `parking_lot` (
  `tagid` int(11) NOT NULL,
  `employee_code` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `car_model` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `car_regno` varchar(12) COLLATE utf8_bin DEFAULT NULL,
  `tagstatus` int(1) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `doissue` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tagid`),
  KEY `fk_user` (`employee_code`),
  KEY `fk_company` (`customer_id`),
  CONSTRAINT `fk_company` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`cid`),
  CONSTRAINT `fk_user` FOREIGN KEY (`employee_code`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `parking_lot` */

insert  into `parking_lot`(`tagid`,`employee_code`,`customer_id`,`car_model`,`car_regno`,`tagstatus`,`created_on`,`doissue`) values (5112767,1,3,'Hyundai Creta','HR26CS8091',1,NULL,'2017-07-05 21:29:38'),(5478925,1,3,'Toyota Prius','KAX456Y',1,'2017-07-19 12:31:56','2017-07-19 12:31:56');

/*Table structure for table `parking_slip` */

DROP TABLE IF EXISTS `parking_slip`;

CREATE TABLE `parking_slip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tagid` int(11) NOT NULL,
  `intime` datetime DEFAULT NULL,
  `outtime` datetime DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1 is in 0 is out',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `fk_tag_id` (`tagid`),
  CONSTRAINT `fk_tag_id` FOREIGN KEY (`tagid`) REFERENCES `parking_lot` (`tagid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `parking_slip` */

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `Payment_id` int(11) NOT NULL,
  `Payment_mode` varchar(100) NOT NULL,
  `Payment_reference` varchar(100) NOT NULL,
  `Payment_Parking slip id` int(11) DEFAULT NULL,
  `Payment_amount` int(100) NOT NULL,
  PRIMARY KEY (`Payment_id`),
  KEY `fk_parking_slip` (`Payment_Parking slip id`),
  CONSTRAINT `fk_parking_slip` FOREIGN KEY (`Payment_Parking slip id`) REFERENCES `parking_slip` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `payments` */

/*Table structure for table `profile` */

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `profile` */

insert  into `profile`(`user_id`,`name`,`public_email`,`gravatar_email`,`gravatar_id`,`department`,`gender`,`location`,`website`,`bio`,`timezone`) values (1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,NULL,NULL,NULL,NULL,'Human Resource','Male',NULL,NULL,NULL,NULL);

/*Table structure for table `social_account` */

DROP TABLE IF EXISTS `social_account`;

CREATE TABLE `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`),
  CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `social_account` */

/*Table structure for table `token` */

DROP TABLE IF EXISTS `token`;

CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`),
  CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `token` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstName` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `phone_number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `last_login_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`firstName`,`lastName`,`email`,`password_hash`,`auth_key`,`customer_id`,`phone_number`,`password_reset_token`,`confirmed_at`,`role`,`status`,`blocked_at`,`registration_ip`,`created_at`,`updated_at`,`last_login_at`) values (1,'admin','Steve','Mungai','admin@mnemonicssystems.co.ke','$2y$13$njgKEXO/6BpUqf6VXXJuuOyxMUY.2EkhszEOCswF.M6.wkOKZgtR.','wdfdffd',1,'0722294673',NULL,1500280845,'SUPER_ADMIN',10,NULL,NULL,1499677919,1500493272,NULL),(15,'mtu','Mtu','Fulani','mtu@fulani.com','mtu','NgoY00n-8Etija9XmkFGdjCFRN1hUAqX',2,'0763296673',NULL,NULL,'',10,NULL,'127.0.0.1',1500536904,1500537696,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
