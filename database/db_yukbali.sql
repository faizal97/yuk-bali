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
  KEY `id_pelajar` (`id_pelajar`),
  CONSTRAINT `tb_detail_kursus_ibfk_1` FOREIGN KEY (`id_kursus`) REFERENCES `tb_kursus` (`id_kursus`),
  CONSTRAINT `tb_detail_kursus_ibfk_2` FOREIGN KEY (`id_pelajar`) REFERENCES `tb_pelajar` (`id_pelajar`) ON DELETE CASCADE ON UPDATE CASCADE
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
  `id_pelajar` int(9) NOT NULL COMMENT 'id pengguna',
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pelajar` */

insert  into `tb_pelajar`(`id_pelajar`,`username`,`nama_depan`,`nama_belakang`,`password`,`password_salt`,`foto_profil`,`email`,`jenis_kelamin`,`tgl_lahir`,`alamat`) values 
(180500001,'faizal97','Faizal','Ardian Putra','f757251fab86cb35c01eff3adcfbbbf359605fbc29805d90e34b6eceeee2bc5aa6a97159dbadda872a1e2619f64e71556f6da0925568d54bdb497825733afb27','5e716bd731043a5c1b8b321332a462d4aaed045512f86ae064dc568441aa26e15650270772ed2bfb54c25c57a8b7303421091a0f700c283e4dcd6f5fdf70794d','img/user/nopic.jpg','faizalardianputra@yahoo.co.id',NULL,NULL,NULL),
(180500002,'anisa123','Anisa','Cahyani','f45d0af60205d4ce0c63ccbf8c2d09a97a7590a9cf4dff0556c43743470877ad1a9e29994ca05ef25ab1c5849ee4a2482cb25b80af2135cc603778d7a76b4eaf','daf26d496d050ae8cce28e80dd1a2a1d1c50186f9fb517acb1b66d97b5c1eeb17abc4e690de07a971c0b9cb6c7c7d959f7f28387c034d023c9043f81a15d93d9','img/user/nopic.jpg','aniscyn@gmail.com',NULL,NULL,NULL),
(180500003,'aldhan123','Aldhan','Ernest','b4da580bec633d0155efdac530d5b0678f335e585bb1df0472a56cc7d01bcea3884f9f8a1c9a1b0e7e2102b7e69402ded4dfb0d1f90fb43d2c9fb6275a35e889','251c609df67287a2d88db739a43d62789c748ece2d76207cbd0aeee3f77df6cc89e75acbed3a5a1298950f2b74456269ca47f586fe7bf5b050191f27acd5ee19','img/user/nopic.jpg','aldhan@gmail.com',NULL,NULL,NULL),
(180500004,'olis123','Nurcholis','','eb87e1d5bf83c4b174060a268a45e9e6c9f4cfeeac6376dc6787d1dc169b19aff3195940f854568223b4b9b9a14353e628422b91ba39c786819bb6b513b97119','750aebc9fe686c8e12e1597cbd81748105c6b99e40ca03a38eadd5d7aaeac0c63f7f2596482fae3b46b3b4dfd30b3b5b43349b9c214bb0b0cfa7658358ba8081','img/user/nopic.jpg','olis.nayla@gmail.com',NULL,NULL,NULL),
(180500005,'ilham','Ilham','','ce7b7e8817d88f9b7342eb4bf705a0f5a5c2f144e26e63cf004bfccbf0562a7edbab3d78b0c6cec3064752300d8cdc9a6200acf71f4d00139e7ad6df79071d62','cd887ff41db02bc5b49078159bfe6cdadb7e89809ce66e1f33c4e2ca25a8841409c6c3537677aefe4452a96c62a5a88b99ab181703e7f94884a859bd0018b449','img/user/nopic.jpg','ilham@yahoo.co.id',NULL,NULL,NULL);

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
