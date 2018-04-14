/*
SQLyog Community v13.0.0 (32 bit)
MySQL - 10.1.31-MariaDB : Database - db_yukbali
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_yukbali` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_yukbali`;

/*Table structure for table `tb_kursus` */

DROP TABLE IF EXISTS `tb_kursus`;

CREATE TABLE `tb_kursus` (
  `id_kursus` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kursus` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kursus`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_kursus_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kursus` */

insert  into `tb_kursus`(`id_kursus`,`nama_kursus`,`id_user`,`tgl_buat`) values 
(1,'Belajar PHP Dasar',1,'2018-03-28 20:32:17'),
(2,'Belajar HTML',1,'2018-03-29 08:38:12'),
(3,'Membuat Bola dari Karet Bekas',1,'2018-04-04 20:38:34');

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `nama_depan` varchar(32) NOT NULL,
  `nama_belakang` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `password_salt` varchar(128) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id_user`,`username`,`nama_depan`,`nama_belakang`,`password`,`password_salt`) values 
(1,'faizal97','faizal','ardian putra','38f78b6475c69c7b7faf8201eedb648e0727ff85689920985862bb31c284108a6dacb5a82413fc1ba183a362d590c7ec2958177137f73a44ee823bb88e895533','f020830e16505486048945c3c18a3a9f11b0aaffc61c4cbd356c8a162769943008f2f3f8f072fcb750b65f0896c62253317a5a0500f85d5ed922c9c730334bb8');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
