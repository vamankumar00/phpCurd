/*
SQLyog Professional v13.1.1 (32 bit)
MySQL - 10.4.11-MariaDB : Database - inventory
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventory` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `inventory`;

/*Table structure for table `inventory_image_table` */

DROP TABLE IF EXISTS `inventory_image_table`;

CREATE TABLE `inventory_image_table` (
  `imageId` int(11) NOT NULL AUTO_INCREMENT,
  `imagePath` varchar(255) NOT NULL,
  `imageExtension` varchar(255) NOT NULL,
  `imageSize` varchar(255) NOT NULL,
  `inventoryId` int(11) NOT NULL,
  PRIMARY KEY (`imageId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `inventory_image_table` */

insert  into `inventory_image_table`(`imageId`,`imagePath`,`imageExtension`,`imageSize`,`inventoryId`) values 
(1,'1/202308161717510.jpg','jpg','36488',1),
(2,'1/202308161717511.jpg','jpg','185491',1);

/*Table structure for table `inventory_table` */

DROP TABLE IF EXISTS `inventory_table`;

CREATE TABLE `inventory_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `dateIn` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `inventory_table` */

insert  into `inventory_table`(`id`,`name`,`quantity`,`price`,`dateIn`) values 
(1,'Amir',72,68,'1975-05-29');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
