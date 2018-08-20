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
  KEY `tb_detail_kursus_ibfk_2` (`id_pelajar`),
  CONSTRAINT `tb_detail_kursus_kursus` FOREIGN KEY (`id_kursus`) REFERENCES `tb_kursus` (`id_kursus`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_detail_kursus_pelajar` FOREIGN KEY (`id_pelajar`) REFERENCES `tb_pelajar` (`id_pelajar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detail_kursus` */

insert  into `tb_detail_kursus`(`id_detail_kursus`,`id_kursus`,`id_pelajar`,`tgl_daftar`,`status`,`materi_terakhir`,`vote`,`ulasan`) values 
('DKU001','KRS002','PLJ002','2018-08-10 02:47:01','aktif',1,1,'<p>Kursusnya Bagus, Detail, Dan Bermanfaat.<br></p>'),
('DKU002','KRS003','PLJ002','2018-08-20 14:54:12','aktif',2,0,NULL);

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
  PRIMARY KEY (`id_detail_soal`),
  KEY `tb_detail_soal_soal` (`id_soal`),
  CONSTRAINT `tb_detail_soal_soal` FOREIGN KEY (`id_soal`) REFERENCES `tb_soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_detail_soal` */

insert  into `tb_detail_soal`(`id_detail_soal`,`id_soal`,`nama_soal`,`pilihan1`,`pilihan2`,`pilihan3`,`pilihan4`,`jawaban`) values 
('DSO001','SOL001','asd','a','s','d','e',1),
('DSO002','SOL002','Database Adalah .... ?','Kumpulan informasi yang disimpan di dalam komputer secara sistematik sehingga dapat diperiksa menggunakan suatu program komputer untuk memperoleh informasi dari basis data tersebut.','Aplikasi pengembang game','Sistem Operasi pada suatu komputer','Aplikasi Penunjang Kebutuhan',1),
('DSO003','SOL002','Contoh Database?','MySQL','Mozilla Firefox','PHP','Google',1);

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
  KEY `id_kategori` (`id_kategori`),
  CONSTRAINT `tb_kursus_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_kursus_pengajar` FOREIGN KEY (`id_pengajar`) REFERENCES `tb_pengajar` (`id_pengajar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_kursus` */

insert  into `tb_kursus`(`id_kursus`,`nama_kursus`,`id_pengajar`,`tgl_buat`,`gambar_kursus`,`id_kategori`,`deskripsi_kursus`) values 
('KRS001','abc','PGJ001','2018-07-27 00:28:37','img/course/KRS001.jpg','KTG005',NULL),
('KRS002','PHP Untuk Pemula','PGJ003','2018-07-13 20:52:51','img/course/KRS002.jpg','KTG001',NULL),
('KRS003','Belajar MySQL','PGJ004','2018-08-20 14:48:04','img/course/KRS003.jpg','KTG005',NULL),
('KRS004','Game Programming','PGJ003','2018-08-20 15:10:06','img/course/KRS004.jpg','KTG004',NULL),
('KRS005','Computer Hardware','PGJ003','2018-08-20 15:13:20','img/course/KRS005.jpg','KTG007',NULL),
('KRS006','Lear UI UX For Mobile Apps','PGJ003','2018-08-20 15:17:09','img/course/KRS006.jpg','KTG002',NULL),
('KRS007','Computer System Security','PGJ003','2018-08-20 15:21:03','img/course/KRS007.jpg','KTG006',NULL);

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
  KEY `id_kursus` (`id_kursus`),
  CONSTRAINT `tb_materi_kursus` FOREIGN KEY (`id_kursus`) REFERENCES `tb_kursus` (`id_kursus`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_materi` */

insert  into `tb_materi`(`id_materi`,`nama_materi`,`id_kursus`,`isi_materi`,`url_video`,`tgl_dibuat`,`urut`) values 
('MTR001','abc','KRS001',NULL,NULL,'2018-07-27 00:54:50',1),
('MTR002','Pengenalan Database','KRS003','<p><br></p><p>Pengenalan Database</p><p>kumpulan <a href=\"https://id.wikipedia.org/wiki/Informasi\" title=\"Informasi\">informasi</a> yang disimpan di dalam <a href=\"https://id.wikipedia.org/wiki/Komputer\" title=\"Komputer\">komputer</a> secara sistematik sehingga dapat diperiksa menggunakan suatu <a href=\"https://id.wikipedia.org/wiki/Program_komputer\" title=\"Program komputer\">program komputer</a> untuk memperoleh informasi dari basis data tersebut. <a href=\"https://id.wikipedia.org/wiki/Perangkat_lunak\" title=\"Perangkat lunak\">Perangkat lunak</a> yang digunakan untuk mengelola dan memanggil <a href=\"https://id.wikipedia.org/wiki/Kueri\" class=\"mw-redirect\" title=\"Kueri\">kueri</a> (<i>query</i>) basis data disebut <a href=\"https://id.wikipedia.org/wiki/Sistem_manajemen_basis_data\" title=\"Sistem manajemen basis data\">sistem manajemen basis data</a> (<i>database management system</i>, DBMS). Sistem basis data dipelajari dalam <a href=\"https://id.wikipedia.org/wiki/Ilmu_informasi\" title=\"Ilmu informasi\">ilmu informasi</a>.\r\n</p><p>Istilah \"basis data\" berawal dari ilmu komputer. Meskipun \r\nkemudian artinya semakin luas, memasukkan hal-hal di luar bidang \r\nelektronika, artikel ini mengenai basis data komputer. Catatan yang \r\nmirip dengan basis data sebenarnya sudah ada sebelum revolusi industri \r\nyaitu dalam bentuk buku besar, kuitansi dan kumpulan data yang \r\nberhubungan dengan bisnis.\r\n</p>','https://www.youtube.com/watch?v=BfwEPIOKTsg','2018-08-20 14:48:42',1),
('MTR003','Resolutions','KRS004',NULL,'https://www.youtube.com/watch?v=GFYT7Lqt1h8','2018-08-20 15:10:36',1),
('MTR004','Threads','KRS004',NULL,'https://www.youtube.com/watch?v=V8q55FGysz4','2018-08-20 15:11:15',2),
('MTR005','Game Loop','KRS004',NULL,'https://www.youtube.com/watch?v=u-YyCiy50n4','2018-08-20 15:11:42',3),
('MTR006','Choosing Your Own Components','KRS005',NULL,'https://www.youtube.com/watch?v=lPIXAtNGGCw','2018-08-20 15:13:49',1),
('MTR007','The Builds','KRS005',NULL,'https://www.youtube.com/watch?v=d_56kyib-Ls','2018-08-20 15:14:18',2),
('MTR008','Installing Windows','KRS005',NULL,'https://www.youtube.com/watch?v=RxaVBsXEiok','2018-08-20 15:14:53',3),
('MTR009','Onboarding Screens','KRS006',NULL,'https://www.youtube.com/watch?v=FhfcACGqjQU','2018-08-20 15:17:40',1),
('MTR010','How Design App Log Form','KRS006',NULL,'https://www.youtube.com/watch?v=ZOLr9t5PfRQ','2018-08-20 15:18:10',2),
('MTR011','Design Option Menu','KRS006',NULL,'https://www.youtube.com/watch?v=sLFj_OIYAdo','2018-08-20 15:18:45',3),
('MTR012','Threat Models','KRS007',NULL,'https://www.youtube.com/watch?v=GqmQg-cszw4','2018-08-20 15:21:23',1),
('MTR013','Control Hijacking Attacks','KRS007',NULL,'https://www.youtube.com/watch?v=r4KjHEgg9Wg','2018-08-20 15:21:51',2),
('MTR014','Buffer Overflow','KRS007',NULL,'https://www.youtube.com/watch?v=xSQxaie_h1o','2018-08-20 15:22:24',3),
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
  PRIMARY KEY (`id_nilai`),
  KEY `tb_nilai_pelajar` (`id_pelajar`),
  KEY `tb_nilai_soal` (`id_soal`),
  CONSTRAINT `tb_nilai_pelajar` FOREIGN KEY (`id_pelajar`) REFERENCES `tb_pelajar` (`id_pelajar`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_nilai_soal` FOREIGN KEY (`id_soal`) REFERENCES `tb_soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_nilai` */

insert  into `tb_nilai`(`id_nilai`,`id_pelajar`,`id_soal`,`benar`,`salah`,`nilai`) values 
('NIL001','PLJ002','SOL002',2,0,100);

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
('PLJ002','Faizal','Ardian Putra','73fe94f7ace26f8ed8236bef45206e0913797234b85ec12b25bc382561bba33be9fb1ea3ba909b6c4b477b55c18186bf10941c3e87d68b417d0f7063e9b31c3e','602241e89dc5f6a120d60481e0126ca0d7ee41ec9e7ef9d56e8cea7c79bdb4b17c12563a12c42bea6581210f169fa0300d5f85ea0602c6d751e9cdc3f9a572fe','img/user/PLJ002.jpg','faizalardianputra@yahoo.co.id','Laki-Laki','1997-08-28','Bumi Mutiara JG 2 / 12'),
('PLJ003','Anisa','Cahyani','0671098bf2f56b0d6ca4c8b93cb2605b2c72f0bff3cd7fcb8a126071c4e1b11c10552eb3688651ea3c39d57d745f50d6044a22cb1470100620ae90ca8d975d63','d44544642f74b5a08bd1d2a4ea51dd947532fa9df406d449a684c71278ffb6130ebfc6b60aefdf215ce254533da6dab0ccaf303c3a66ad30e14bd038999d7b05','img/user/nopic.jpg','aniscyn@gmail.com',NULL,NULL,NULL),
('PLJ004','Faizal','Ardian Putra','dd3990fea81825fe9ce27f0a7d29b79aef217cafc1e1b92e16366f8e26955cef2ef7df31fa57dac2d2dc6226b0de95b5893a82670bca51dc84acf07256f4e3b7','f93f7b8cb3d915f5e32df019a6295ba7612bbf3c19b1dcab405378434e1002a6ebf2e67d6c400a59fd874586c75925204457b2ee69a829bf09b1c97d36402629','img/user/nopic.jpg','faizal@gmail.com',NULL,NULL,NULL);

/*Table structure for table `tb_pengajar` */

DROP TABLE IF EXISTS `tb_pengajar`;

CREATE TABLE `tb_pengajar` (
  `id_pengajar` varchar(6) NOT NULL COMMENT 'id pengguna',
  `upvote` int(11) DEFAULT '0',
  `downvote` int(11) DEFAULT '0',
  `id_pelajar` varchar(6) DEFAULT NULL,
  `deskripsi_pengajar` text,
  PRIMARY KEY (`id_pengajar`),
  KEY `id_pelajar` (`id_pelajar`),
  CONSTRAINT `tb_pengajar_pelajar` FOREIGN KEY (`id_pelajar`) REFERENCES `tb_pelajar` (`id_pelajar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pengajar` */

insert  into `tb_pengajar`(`id_pengajar`,`upvote`,`downvote`,`id_pelajar`,`deskripsi_pengajar`) values 
('PGJ001',0,0,'PLJ002',NULL),
('PGJ002',0,0,'PLJ003',NULL),
('PGJ003',1,0,'PLJ001',NULL),
('PGJ004',0,0,'PLJ004',NULL);

/*Table structure for table `tb_soal` */

DROP TABLE IF EXISTS `tb_soal`;

CREATE TABLE `tb_soal` (
  `id_soal` varchar(6) NOT NULL,
  `id_materi` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id_soal`),
  KEY `tb_soal_materi` (`id_materi`),
  CONSTRAINT `tb_soal_materi` FOREIGN KEY (`id_materi`) REFERENCES `tb_materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_soal` */

insert  into `tb_soal`(`id_soal`,`id_materi`) values 
('SOL001','MTR001'),
('SOL002','MTR002');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
