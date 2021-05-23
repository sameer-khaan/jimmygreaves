/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.5.5-10.4.11-MariaDB : Database - jimmy
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`jimmy` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `jimmy`;

/*Table structure for table `auction_detail` */

DROP TABLE IF EXISTS `auction_detail`;

CREATE TABLE `auction_detail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `auction_id` int(10) DEFAULT NULL,
  `bid_amount` varchar(255) DEFAULT NULL,
  `bid_time` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `auction_detail` */

insert  into `auction_detail`(`id`,`user_id`,`auction_id`,`bid_amount`,`bid_time`,`status`) values (1,4,1,'125','2021-04-19 03:19:55am','0'),(2,4,1,'126','2021-04-19 03:20:38am','0'),(3,2,3,'33','2021-05-04 09:52:22pm','0');

/*Table structure for table `auctions` */

DROP TABLE IF EXISTS `auctions`;

CREATE TABLE `auctions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `auction_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `delivery` text DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `create_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `init_price` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `auctions` */

insert  into `auctions`(`id`,`auction_name`,`description`,`delivery`,`terms`,`status`,`create_time`,`end_time`,`image`,`init_price`) values (1,'aa','e','asae','asef','0','2021-04-14 07:21:50pm','2021-04-07T01:21','[\"18689-blob\"]',123),(3,'33','2','32','32','0','2021-04-29 11:17:05pm','2021-05-08T05:17','[\"40331-blob\"]',32);

/*Table structure for table `donate` */

DROP TABLE IF EXISTS `donate`;

CREATE TABLE `donate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `create_time` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `donate` */

insert  into `donate`(`id`,`create_time`,`amount`,`user_id`,`status`) values (1,'2021-04-19 02:12:43am',50,4,'0');

/*Table structure for table `raffle` */

DROP TABLE IF EXISTS `raffle`;

CREATE TABLE `raffle` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `raffle_name` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `delivery` text DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `create_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `raffle` */

insert  into `raffle`(`id`,`raffle_name`,`price`,`description`,`delivery`,`terms`,`status`,`create_time`,`end_time`,`image`) values (1,'1','23','2','1','1','0','2021-04-14 07:55:08pm','2021-04-23T01:55','[\"82832-blob\"]'),(2,'te','32','te','et','est','0','2021-04-22 07:57:28pm','2021-04-30T01:57','[\"70018-blob\"]');

/*Table structure for table `raffle_detail` */

DROP TABLE IF EXISTS `raffle_detail`;

CREATE TABLE `raffle_detail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `raffle_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `buy_amount` int(2) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `buy_time` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*Data for the table `raffle_detail` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `fb_flag` varchar(255) DEFAULT '0',
  `admin` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`email`,`fullname`,`password`,`token`,`fb_flag`,`admin`) values (1,'lujin0406@outlook.com','Lujin Zhang','$2y$10$lHl96u19rpWvjmc.P5fIZuMZUivXipoj9x9rvkdsQv131Yn0ctcK.','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmdWxsbmFtZSI6Ikx1amluIFpoYW5nIiwiZW1haWwiOiJsdWppbjA0MDZAb3V0bG9vay5jb20ifQ.cIkB16Em2NCPw92uag8d3p_JaA9c7si3unjoamL7zq8','0','0'),(2,'m.k.cj406@gmail.com','marko marko','$2y$10$62YDn2/wjvnkd9joJJfHouS4mBErjlUUPrP/AHXsfX.mXHA3.WjFy','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmdWxsbmFtZSI6Im1hcmtvIG1hcmtvIiwiZW1haWwiOiJtLmsuY2o0MDZAZ21haWwuY29tIn0._1LuVppTVJmMuLtERGVzo0F8GTWw5OIpflRyVqTk9Hw','0','0'),(3,'m.k.cj4061@gmail.com','marko marko','$2y$10$wr/yvtvp636Yb3LUhH8xy.xlAA2c7spxXmuE4jeLxgRFZAa0EWj.m','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmdWxsbmFtZSI6Im1hcmtvIG1hcmtvIiwiZW1haWwiOiJtLmsuY2o0MDYxQGdtYWlsLmNvbSJ9.Nc4urO10FIw4oM134nQfPnspLUkTZiYrYSUhnAXLcSw','0','0'),(4,'adamwiggins@hotmail.co.uk','Adam Wiggins',NULL,'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmdWxsbmFtZSI6IkFkYW0gV2lnZ2lucyIsImVtYWlsIjoiYWRhbXdpZ2dpbnNAaG90bWFpbC5jby51ayJ9.ZEpa8Fhqgh8Y7V1lYxpM4iASezKZ7z3ZwIfnYjeOk98','1','0'),(5,'admin@admin.com','Adam Wiggins','$2y$10$qDpsJFncHQZ1H8o013WvWe38S7wvLplGq2g/apOp1avIiTFr6URYK',NULL,'0','1'),(6,'test@test5.com','test','$2y$10$qDpsJFncHQZ1H8o013WvWe38S7wvLplGq2g/apOp1avIiTFr6URYK','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmdWxsbmFtZSI6InRlc3QiLCJlbWFpbCI6InRlc3RAdGVzdDUuY29tIn0.T0LV9SpwkMXZ3vOfQKHfnGFbBMEeDFDI1gR03CLTFzc','0','0');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
