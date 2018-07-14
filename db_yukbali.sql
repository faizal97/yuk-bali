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
  `id_admin` varchar(5) NOT NULL,
  `nm_depan` varchar(10) NOT NULL,
  `nm_belakang` varchar(30) NOT NULL,
  `username_admin` varchar(20) DEFAULT NULL,
  `password_admin` varchar(128) DEFAULT NULL,
  `salt_admin` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_admin` */

insert  into `tb_admin`(`id_admin`,`nm_depan`,`nm_belakang`,`username_admin`,`password_admin`,`salt_admin`) values 
('ADM01','Anisa','Cahyani','anisa','837e9e7c6a7b5a9d7637549dda4a1b9d382562f816e517aedaea0b6224f2168e339f51c0030208cd63739054cdde28bd67cf2d76f97d9dfa95368167e125c1d1','f84a4275ee96042fe7c16c5e893a88a8'),
('ADM02','Faizal','Ardian Putra','faizal97','52f5271dd6cab67b934f1d762663ed14135797aff1ae9f131bf30b3ba271da068405b4916da66f957554ac9c70fe46c62e1380fdf0cc6cdc2b83ee976c9a8090','d534244075f5151674f6e244aaee7de2');

/*Table structure for table `tb_detail_kursus` */

DROP TABLE IF EXISTS `tb_detail_kursus`;

CREATE TABLE `tb_detail_kursus` (
  `id_detail_kursus` varchar(6) NOT NULL,
  `id_kursus` varchar(6) DEFAULT NULL,
  `id_pelajar` varchar(6) DEFAULT NULL,
  `tgl_daftar` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(7) DEFAULT 'aktif',
  `materi_terakhir` int(3) DEFAULT '1',
  `vote` int(2) DEFAULT '0',
  `ulasan` text,
  PRIMARY KEY (`id_detail_kursus`),
  KEY `id_kursus` (`id_kursus`),
  KEY `tb_detail_kursus_ibfk_2` (`id_pelajar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detail_kursus` */

insert  into `tb_detail_kursus`(`id_detail_kursus`,`id_kursus`,`id_pelajar`,`tgl_daftar`,`status`,`materi_terakhir`,`vote`,`ulasan`) values 
('DKU001','KRS001','PLJ001','2018-07-13 21:52:40','aktif',1,0,NULL),
('DKU002','KRS002','PLJ002','2018-07-13 23:46:49','aktif',11,0,NULL);

/*Table structure for table `tb_detail_soal` */

DROP TABLE IF EXISTS `tb_detail_soal`;

CREATE TABLE `tb_detail_soal` (
  `id_detail_soal` varchar(6) NOT NULL,
  `id_soal` varchar(6) DEFAULT NULL,
  `nama_soal` text,
  `pilihan1` text,
  `pilihan2` text,
  `pilihan3` text,
  `pilihan4` text,
  `jawaban` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detail_soal`)
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
('KTG001','Web Development'),
('KTG002','Mobile Apps'),
('KTG003','Programming Languages'),
('KTG004','Game Development'),
('KTG005','Databases'),
('KTG006','Network And Security'),
('KTG007','Hardware'),
('KTG008','Operating Systems'),
('KTG009','Others');

/*Table structure for table `tb_kursus` */

DROP TABLE IF EXISTS `tb_kursus`;

CREATE TABLE `tb_kursus` (
  `id_kursus` varchar(6) NOT NULL COMMENT 'id kursus',
  `nama_kursus` varchar(100) NOT NULL COMMENT 'judul kursus',
  `id_pengajar` varchar(6) NOT NULL COMMENT 'user yang membuat kursus',
  `tgl_buat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'tanggal dibuatnya kursus',
  `gambar_kursus` varchar(32) DEFAULT NULL COMMENT 'gambar thumbnail kursus',
  `id_kategori` varchar(6) DEFAULT NULL COMMENT 'kategori dari kursus',
  `deskripsi_kursus` text COMMENT 'deskripsi kursus',
  PRIMARY KEY (`id_kursus`),
  KEY `id_user` (`id_pengajar`),
  KEY `id_kategori` (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_kursus` */

insert  into `tb_kursus`(`id_kursus`,`nama_kursus`,`id_pengajar`,`tgl_buat`,`gambar_kursus`,`id_kategori`,`deskripsi_kursus`) values 
('KRS001','Vue JS 101','PGJ001','2018-07-13 20:11:28','img/course/KRS001.jpg','KTG001','abcd'),
('KRS002','PHP Untuk Pemula','PGJ003','2018-07-13 20:52:51','img/course/KRS002.jpg','KTG001',NULL);

/*Table structure for table `tb_materi` */

DROP TABLE IF EXISTS `tb_materi`;

CREATE TABLE `tb_materi` (
  `id_materi` varchar(6) NOT NULL,
  `nama_materi` varchar(50) DEFAULT NULL,
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
('MTR001','Vue 101 Intro','KRS001',NULL,'https://www.youtube.com/watch?v=EmCBOtkXxdg','2018-07-13 20:12:42',1),
('MTR002','Vue Instance And Property','KRS001',NULL,'https://www.youtube.com/watch?v=hPKYHIQQBMk','2018-07-13 20:14:25',2),
('MTR003','Data Binding','KRS001',NULL,'https://www.youtube.com/watch?v=u0R2qtCyvyc','2018-07-13 20:15:14',4),
('MTR004','Computed Properties','KRS001',NULL,'https://www.youtube.com/watch?v=gfo45kZa_5Y','2018-07-13 20:15:52',3),
('MTR005','Loop Lists','KRS001',NULL,'https://www.youtube.com/watch?v=E8d87l1gOOE','2018-07-13 20:16:33',5),
('MTR006','List Methods','KRS001',NULL,'https://www.youtube.com/watch?v=JDNFhLuounA','2018-07-13 20:17:15',6),
('MTR007','Menggunakan Filter','KRS001',NULL,'https://www.youtube.com/watch?v=FUwMlDhIaos','2018-07-13 20:18:18',7),
('MTR008','Metode Dan V On','KRS001',NULL,'https://www.youtube.com/watch?v=rhOitPVApAQ','2018-07-13 20:19:02',8),
('MTR009','V On Dan V Bind','KRS001',NULL,'https://www.youtube.com/watch?v=iPSTb-pwpkQ','2018-07-13 20:19:48',9),
('MTR010','Input Binding','KRS001',NULL,'https://www.youtube.com/watch?v=4PQEogmzR4k','2018-07-13 20:20:19',11),
('MTR011','Components','KRS001',NULL,'https://www.youtube.com/watch?v=d3-RYc5-YgE','2018-07-13 20:20:57',12),
('MTR012','Components 2 And Closing','KRS001',NULL,'https://www.youtube.com/watch?v=YV_C4JT3gYA','2018-07-13 20:21:29',13),
('MTR013','Dynamic Components','KRS001',NULL,'https://www.youtube.com/watch?v=M92Fi8zZ1Ck','2018-07-13 20:22:41',14),
('MTR014','Transition VueJS','KRS001',NULL,'https://www.youtube.com/watch?v=dHZcZSndX-M','2018-07-13 20:23:29',15),
('MTR015','More On V on And V Bind','KRS001',NULL,'https://www.youtube.com/watch?v=iPSTb-pwpkQ','2018-07-13 20:24:45',10),
('MTR016','INTRO','KRS002',NULL,'https://www.youtube.com/watch?v=l1W2OwV5rgY','2018-07-13 20:53:06',1),
('MTR017','Sejarah','KRS002',NULL,'https://www.youtube.com/watch?v=q3NVC5JxgVI','2018-07-13 20:56:52',2),
('MTR018','Persiapan Lingkungan Pengembangan','KRS002',NULL,'https://www.youtube.com/watch?v=o8oLQVYlpqw','2018-07-13 20:58:32',3),
('MTR019','Sintaks PHP','KRS002',NULL,'https://www.youtube.com/watch?v=XTrU0GzMfCk','2018-07-13 20:58:56',9),
('MTR020','Struktur Kendali','KRS002',NULL,'https://www.youtube.com/watch?v=9gpAJPWD-xI','2018-07-13 21:00:10',10),
('MTR021','Functions','KRS002',NULL,'https://www.youtube.com/watch?v=R5C70w2MOkE','2018-07-13 21:00:38',8),
('MTR022','Array','KRS002',NULL,'https://www.youtube.com/watch?v=qp1l7A4xDIc','2018-07-13 21:01:06',7),
('MTR023','Asosiatif Array','KRS002',NULL,'https://www.youtube.com/watch?v=mNgOuUUp1I0','2018-07-13 21:02:07',6),
('MTR024','Get And Post','KRS002',NULL,'https://www.youtube.com/watch?v=6vG4oO39ivY','2018-07-13 21:03:06',5),
('MTR025','Database And MySQL','KRS002',NULL,'https://www.youtube.com/watch?v=fxe6qev-bno','2018-07-13 21:03:37',4);

/*Table structure for table `tb_nilai` */

DROP TABLE IF EXISTS `tb_nilai`;

CREATE TABLE `tb_nilai` (
  `id_nilai` varchar(6) NOT NULL,
  `id_pelajar` varchar(6) DEFAULT NULL,
  `id_soal` varchar(6) DEFAULT NULL,
  `benar` int(11) DEFAULT NULL,
  `salah` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_nilai` */

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
('PLJ001','Kepala','Sekolah','8bfd0302da67e8f791acdfe2f4b6ae6bacf95af7647768126a2b3fdca8aecac3a1c9cd719ac8e00436bb2c4401a1374f0079ff76cfaa363be318275949d39750','ce5fbcc7d504e8a6b734a12630e5dc12ab36ebd1f3c1ad5646bd83976dc044f7ec0e80a4b0c3eada50411db2bd0a2de19bf6eba15dac8eadffe16e1f270e8be7','img/user/PLJ001.jpg','kepsek@yahoo.co.id','Laki-Laki','1997-08-28','Bumi Mutiara'),
('PLJ002','Faizal','Ardian Putra','73fe94f7ace26f8ed8236bef45206e0913797234b85ec12b25bc382561bba33be9fb1ea3ba909b6c4b477b55c18186bf10941c3e87d68b417d0f7063e9b31c3e','602241e89dc5f6a120d60481e0126ca0d7ee41ec9e7ef9d56e8cea7c79bdb4b17c12563a12c42bea6581210f169fa0300d5f85ea0602c6d751e9cdc3f9a572fe','img/user/PLJ002.jpeg','faizalardianputra@yahoo.co.id','Laki-Laki','1997-08-28','Bumi Mutiara'),
('PLJ003','Anisa','Cahyani','0671098bf2f56b0d6ca4c8b93cb2605b2c72f0bff3cd7fcb8a126071c4e1b11c10552eb3688651ea3c39d57d745f50d6044a22cb1470100620ae90ca8d975d63','d44544642f74b5a08bd1d2a4ea51dd947532fa9df406d449a684c71278ffb6130ebfc6b60aefdf215ce254533da6dab0ccaf303c3a66ad30e14bd038999d7b05','img/user/nopic.jpg','aniscyn@gmail.com',NULL,NULL,NULL);

/*Table structure for table `tb_pengajar` */

DROP TABLE IF EXISTS `tb_pengajar`;

CREATE TABLE `tb_pengajar` (
  `id_pengajar` varchar(6) NOT NULL COMMENT 'id pengguna',
  `upvote` int(11) DEFAULT '0',
  `downvote` int(11) DEFAULT '0',
  `id_pelajar` varchar(6) DEFAULT NULL,
  `deskripsi_pengajar` text,
  PRIMARY KEY (`id_pengajar`),
  KEY `id_pelajar` (`id_pelajar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pengajar` */

insert  into `tb_pengajar`(`id_pengajar`,`upvote`,`downvote`,`id_pelajar`,`deskripsi_pengajar`) values 
('PGJ001',0,0,'PLJ002',NULL),
('PGJ002',0,0,'PLJ003',NULL),
('PGJ003',0,0,'PLJ001',NULL);

/*Table structure for table `tb_soal` */

DROP TABLE IF EXISTS `tb_soal`;

CREATE TABLE `tb_soal` (
  `id_soal` varchar(6) NOT NULL,
  `id_materi` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id_soal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_soal` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
