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

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(20) DEFAULT NULL,
  `password_admin` varchar(128) DEFAULT NULL,
  `salt_admin` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_admin` */

/*Table structure for table `tb_detail_kursus` */

DROP TABLE IF EXISTS `tb_detail_kursus`;

CREATE TABLE `tb_detail_kursus` (
  `id_kursus` int(11) DEFAULT NULL,
  `id_pelajar` int(11) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  KEY `id_kursus` (`id_kursus`),
  KEY `tb_detail_kursus_ibfk_2` (`id_pelajar`),
  CONSTRAINT `tb_detail_kursus_ibfk_1` FOREIGN KEY (`id_kursus`) REFERENCES `tb_kursus` (`id_kursus`),
  CONSTRAINT `tb_detail_kursus_ibfk_2` FOREIGN KEY (`id_pelajar`) REFERENCES `tb_pelajar` (`id_pelajar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detail_kursus` */

/*Table structure for table `tb_kategori` */

DROP TABLE IF EXISTS `tb_kategori`;

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kategori` */

insert  into `tb_kategori`(`id_kategori`,`nama_kategori`) values 
(1,'Pemograman'),
(2,'Komputer'),
(3,'Ga Jelas');

/*Table structure for table `tb_kursus` */

DROP TABLE IF EXISTS `tb_kursus`;

CREATE TABLE `tb_kursus` (
  `id_kursus` int(11) NOT NULL COMMENT 'id kursus',
  `nama_kursus` varchar(100) NOT NULL COMMENT 'judul kursus',
  `id_pengajar` int(15) NOT NULL COMMENT 'user yang membuat kursus',
  `tgl_buat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'tanggal dibuatnya kursus',
  `gambar_kursus` varchar(32) DEFAULT NULL COMMENT 'gambar thumbnail kursus',
  `id_kategori` int(11) DEFAULT NULL COMMENT 'kategori dari kursus',
  `deskripsi` text COMMENT 'deskripsi kursus',
  PRIMARY KEY (`id_kursus`),
  KEY `id_user` (`id_pengajar`),
  KEY `id_kategori` (`id_kategori`),
  CONSTRAINT `tb_kursus_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_kursus_ibfk_2` FOREIGN KEY (`id_pengajar`) REFERENCES `tb_pengajar` (`id_pengajar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_kursus` */

/*Table structure for table `tb_materi` */

DROP TABLE IF EXISTS `tb_materi`;

CREATE TABLE `tb_materi` (
  `id_materi` int(11) NOT NULL,
  `nama_materi` varchar(30) DEFAULT NULL,
  `id_kursus` int(11) DEFAULT NULL,
  `isi_materi` text,
  `url_video` varchar(50) DEFAULT NULL,
  `tgl_dibuat` date DEFAULT NULL,
  PRIMARY KEY (`id_materi`),
  KEY `id_kursus` (`id_kursus`),
  CONSTRAINT `tb_materi_ibfk_1` FOREIGN KEY (`id_kursus`) REFERENCES `tb_kursus` (`id_kursus`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_materi` */

/*Table structure for table `tb_pelajar` */

DROP TABLE IF EXISTS `tb_pelajar`;

CREATE TABLE `tb_pelajar` (
  `id_pelajar` int(15) NOT NULL AUTO_INCREMENT COMMENT 'id pengguna',
  `username` varchar(32) NOT NULL COMMENT 'username pengguna',
  `nama_depan` varchar(32) NOT NULL COMMENT 'nama depan pengguna',
  `nama_belakang` varchar(64) DEFAULT NULL COMMENT 'nama belakang pengguna',
  `password` varchar(128) NOT NULL COMMENT 'password pengguna',
  `password_salt` varchar(128) NOT NULL COMMENT 'salt pengguna',
  `foto_profil` varchar(30) DEFAULT 'img/user/nopic.jpg',
  `email` varchar(30) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id_pelajar`)
) ENGINE=InnoDB AUTO_INCREMENT=1805000003 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pelajar` */

insert  into `tb_pelajar`(`id_pelajar`,`username`,`nama_depan`,`nama_belakang`,`password`,`password_salt`,`foto_profil`,`email`,`jenis_kelamin`,`tgl_lahir`,`alamat`) values 
(1805000001,'kepsek','Kepala','Sekolah','f1fa967a140e185d18b256b8a446ba51ad4583efa0ccb8989dacb94371fd249e0427fcc65a2f5dec75e882866827f23250f0de644baccb479fce5e41e3d9fb36','0b3e5630eaf489f5c536f6ee832ab22b7e4afa7a68f2f9694c9f6395548207dca10d848d9bf0966f16ce78652cf42af4ead720a7b9465148d2cdbc07dece1351','img/user/nopic.jpg',NULL,NULL,NULL,NULL),
(1805000002,'faizal97','Faizal','Ardian Putra','bea575c4d2c950619c802f1eea61d937461797356ff6befb7b2390af98b171e93160931b43d8da28bd29d566d39159efce1af06bb5b14623a5548a59f47a26d0','18f8a8979846e18327dceedeb8056f3f9e578416f47036acd09eecccc9f7d213aeb33913bde935b8088a8285da8d08b5ff94d2e5e4bf4f04bcb9841a0bfc1583','img/user/nopic.jpg',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_pengajar` */

DROP TABLE IF EXISTS `tb_pengajar`;

CREATE TABLE `tb_pengajar` (
  `id_pengajar` int(15) NOT NULL COMMENT 'id pengguna',
  `upvote` int(11) DEFAULT '0',
  `downvote` int(11) DEFAULT '0',
  `id_pelajar` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pengajar`),
  KEY `id_pelajar` (`id_pelajar`),
  CONSTRAINT `tb_pengajar_ibfk_1` FOREIGN KEY (`id_pelajar`) REFERENCES `tb_pelajar` (`id_pelajar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pengajar` */

/*Table structure for table `tb_soal` */

DROP TABLE IF EXISTS `tb_soal`;

CREATE TABLE `tb_soal` (
  `id_soal` int(11) NOT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `nama_soal` text,
  `pilihan` text,
  `jawaban` text,
  PRIMARY KEY (`id_soal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_soal` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
