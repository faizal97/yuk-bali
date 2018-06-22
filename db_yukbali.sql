/*
SQLyog Community v13.0.1 (64 bit)
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
  KEY `tb_detail_kursus_ibfk_2` (`id_pelajar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detail_kursus` */

/*Table structure for table `tb_detail_soal` */

DROP TABLE IF EXISTS `tb_detail_soal`;

CREATE TABLE `tb_detail_soal` (
  `id_soal` varchar(6) DEFAULT NULL,
  `nama_soal` text,
  `pilihan1` text,
  `pilihan2` text,
  `pilihan3` text,
  `pilihan4` text,
  `jawaban` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detail_soal` */

/*Table structure for table `tb_kategori` */

DROP TABLE IF EXISTS `tb_kategori`;

CREATE TABLE `tb_kategori` (
  `id_kategori` varchar(6) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_kategori` */

insert  into `tb_kategori`(`id_kategori`,`nama_kategori`) values 
('KTG001','Pemograman'),
('KTG002','Komputer'),
('KTG003','Ga Jelas');

/*Table structure for table `tb_kursus` */

DROP TABLE IF EXISTS `tb_kursus`;

CREATE TABLE `tb_kursus` (
  `id_kursus` varchar(6) NOT NULL COMMENT 'id kursus',
  `nama_kursus` varchar(100) NOT NULL COMMENT 'judul kursus',
  `id_pengajar` varchar(6) NOT NULL COMMENT 'user yang membuat kursus',
  `tgl_buat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'tanggal dibuatnya kursus',
  `gambar_kursus` varchar(32) DEFAULT NULL COMMENT 'gambar thumbnail kursus',
  `id_kategori` varchar(6) DEFAULT NULL COMMENT 'kategori dari kursus',
  `deskripsi` text COMMENT 'deskripsi kursus',
  PRIMARY KEY (`id_kursus`),
  KEY `id_user` (`id_pengajar`),
  KEY `id_kategori` (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_kursus` */

insert  into `tb_kursus`(`id_kursus`,`nama_kursus`,`id_pengajar`,`tgl_buat`,`gambar_kursus`,`id_kategori`,`deskripsi`) values 
('KRS001','Belajar PHP','PGJ001','2018-06-20 16:15:30','img/course/KRS001.jpeg','KTG001',NULL);

/*Table structure for table `tb_materi` */

DROP TABLE IF EXISTS `tb_materi`;

CREATE TABLE `tb_materi` (
  `id_materi` varchar(6) NOT NULL,
  `nama_materi` varchar(30) DEFAULT NULL,
  `id_kursus` varchar(6) DEFAULT NULL,
  `isi_materi` text,
  `url_video` varchar(50) DEFAULT NULL,
  `tgl_dibuat` datetime DEFAULT CURRENT_TIMESTAMP,
  `urut` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_materi`),
  KEY `id_kursus` (`id_kursus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_materi` */

insert  into `tb_materi`(`id_materi`,`nama_materi`,`id_kursus`,`isi_materi`,`url_video`,`tgl_dibuat`,`urut`) values 
('MTR001','Bab 1','KRS001',NULL,'https://www.youtube.com/watch?v=diGjw5tghYU','2018-06-20 16:53:20',1),
('MTR002','Bab 2','KRS001',NULL,NULL,'2018-06-20 21:49:48',2);

/*Table structure for table `tb_pelajar` */

DROP TABLE IF EXISTS `tb_pelajar`;

CREATE TABLE `tb_pelajar` (
  `id_pelajar` varchar(6) NOT NULL COMMENT 'id pengguna',
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

insert  into `tb_pelajar`(`id_pelajar`,`nama_depan`,`nama_belakang`,`password`,`password_salt`,`foto_profil`,`email`,`jenis_kelamin`,`tgl_lahir`,`alamat`) values 
('PLJ001','Kepala','Sekolah','8bfd0302da67e8f791acdfe2f4b6ae6bacf95af7647768126a2b3fdca8aecac3a1c9cd719ac8e00436bb2c4401a1374f0079ff76cfaa363be318275949d39750','ce5fbcc7d504e8a6b734a12630e5dc12ab36ebd1f3c1ad5646bd83976dc044f7ec0e80a4b0c3eada50411db2bd0a2de19bf6eba15dac8eadffe16e1f270e8be7','img/user/nopic.jpg','kepsek@yahoo.co.id',NULL,NULL,NULL),
('PLJ002','Faizal','Ardian Putra','73fe94f7ace26f8ed8236bef45206e0913797234b85ec12b25bc382561bba33be9fb1ea3ba909b6c4b477b55c18186bf10941c3e87d68b417d0f7063e9b31c3e','602241e89dc5f6a120d60481e0126ca0d7ee41ec9e7ef9d56e8cea7c79bdb4b17c12563a12c42bea6581210f169fa0300d5f85ea0602c6d751e9cdc3f9a572fe','img/user/nopic.jpg','faizalardianputra@yahoo.co.id',NULL,NULL,NULL);

/*Table structure for table `tb_pengajar` */

DROP TABLE IF EXISTS `tb_pengajar`;

CREATE TABLE `tb_pengajar` (
  `id_pengajar` varchar(6) NOT NULL COMMENT 'id pengguna',
  `upvote` int(11) DEFAULT '0',
  `downvote` int(11) DEFAULT '0',
  `id_pelajar` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id_pengajar`),
  KEY `id_pelajar` (`id_pelajar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pengajar` */

insert  into `tb_pengajar`(`id_pengajar`,`upvote`,`downvote`,`id_pelajar`) values 
('PGJ001',0,0,'PLJ002');

/*Table structure for table `tb_soal` */

DROP TABLE IF EXISTS `tb_soal`;

CREATE TABLE `tb_soal` (
  `id_soal` varchar(6) NOT NULL,
  `id_materi` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id_soal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_soal` */

insert  into `tb_soal`(`id_soal`,`id_materi`) values 
('SOL001','MTR001'),
('SOL002','final'),
('SOL003','MTR002');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
