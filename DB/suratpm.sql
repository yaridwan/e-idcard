/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.6.11-MariaDB-0ubuntu0.22.04.1 : Database - kp_suratpm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `agama` */

DROP TABLE IF EXISTS `agama`;

CREATE TABLE `agama` (
  `id_agama` int(11) NOT NULL AUTO_INCREMENT,
  `nm_agama` varchar(50) NOT NULL,
  PRIMARY KEY (`id_agama`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `agama` */

insert  into `agama`(`id_agama`,`nm_agama`) values 
(1,'Islam'),
(2,'Kristen'),
(3,'Katholik'),
(4,'Hindu'),
(5,'Buddha'),
(6,'Konghucu'),
(7,'Kepercayaan');

/*Table structure for table `disposisi` */

DROP TABLE IF EXISTS `disposisi`;

CREATE TABLE `disposisi` (
  `id_disposisi` int(11) NOT NULL AUTO_INCREMENT,
  `nosmasuk` varchar(35) DEFAULT NULL,
  `noskeluar` varchar(35) DEFAULT NULL,
  `sumber` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `id_sifat` int(11) DEFAULT NULL,
  `jenis` enum('smasuk','skeluar') DEFAULT NULL,
  `addedon` timestamp NOT NULL DEFAULT current_timestamp(),
  `useradd` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_disposisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `disposisi` */

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nm_jabatan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jabatan` */

insert  into `jabatan`(`id_jabatan`,`nm_jabatan`) values 
(1,'Dewan Pengawas'),
(3,'Direksi'),
(4,'Kepala Cabang'),
(5,'Kabag. Keuangan'),
(6,'Kabag. SDM dan Umum'),
(7,'Bendahara'),
(8,'Kasi. Adm dan Umum'),
(9,'Pegawai Bag. Keuangan'),
(10,'Pegawai Akuntansi dan Anggaran'),
(11,'Pegawai Adm dan Umum'),
(12,'Supir'),
(13,'Marketing'),
(14,'Kantor PM'),
(15,'Koordinator'),
(16,'Pegawai Penagihan'),
(17,'Security'),
(18,'Pegawai ME'),
(19,'CS'),
(20,'Parkir');

/*Table structure for table `jenissurat` */

DROP TABLE IF EXISTS `jenissurat`;

CREATE TABLE `jenissurat` (
  `id_jenissurat` int(11) NOT NULL AUTO_INCREMENT,
  `nm_jenissurat` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id_jenissurat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jenissurat` */

insert  into `jenissurat`(`id_jenissurat`,`nm_jenissurat`) values 
(1,'Surat Umum'),
(2,'Undangan');

/*Table structure for table `pegawai` */

DROP TABLE IF EXISTS `pegawai`;

CREATE TABLE `pegawai` (
  `no_pegawai` varchar(35) NOT NULL,
  `nm_pegawai` varchar(55) DEFAULT NULL,
  `nik` varchar(35) DEFAULT NULL,
  `tmp_lahir` varchar(35) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `kelamin` enum('L','P') DEFAULT NULL,
  `id_agama` int(11) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `hp` varchar(15) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pegawai` */

insert  into `pegawai`(`no_pegawai`,`nm_pegawai`,`nik`,`tmp_lahir`,`tgl_lahir`,`kelamin`,`id_agama`,`alamat`,`hp`,`id_jabatan`) values 
('2212180001','Sawit Berjaya','798999999','Uning Gelima','2022-12-18','L',1,'Medan','0834938498',13),
('2212180002','Sukran Tamir','44121212121212','Medan','2022-12-18','L',1,'Medan','08151313123',1),
('2212180003','Jasmindi Rahim','545454545','Medan','2022-12-18','L',1,'Medan','0851216111',17),
('2212180004','Tumbul Pacung','1545461321131231231','Pasir Pengaraian','2022-12-18','L',1,'Pekanbaru','0812838934839',20);

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `id_pengguna` int(5) NOT NULL AUTO_INCREMENT,
  `nm_pengguna` varchar(50) DEFAULT NULL,
  `kelamin` enum('L','P') DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `hp` varchar(35) DEFAULT NULL,
  `username` char(18) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `pengguna` */

insert  into `pengguna`(`id_pengguna`,`nm_pengguna`,`kelamin`,`alamat`,`hp`,`username`,`password`,`gambar`) values 
(1,'Nur Sakinah','P','Desa Batang Kumu, Kec. Tambusaix','082287400540','admin','21232f297a57a5a743894a0e4a801fc3','9467e7fa9c53e6adcf2417c7dd10a90c639ec11a702d199955941520221218142826.jpg');

/*Table structure for table `sifat` */

DROP TABLE IF EXISTS `sifat`;

CREATE TABLE `sifat` (
  `id_sifat` int(11) NOT NULL AUTO_INCREMENT,
  `nm_sifat` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id_sifat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `sifat` */

insert  into `sifat`(`id_sifat`,`nm_sifat`) values 
(1,'Urgent'),
(2,'Penting');

/*Table structure for table `suratkeluar` */

DROP TABLE IF EXISTS `suratkeluar`;

CREATE TABLE `suratkeluar` (
  `noskeluar` varchar(35) NOT NULL,
  `no_surat` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `hal` varchar(200) DEFAULT NULL,
  `kepada` varchar(100) DEFAULT NULL,
  `id_jenissurat` int(11) DEFAULT NULL,
  `berkas` text DEFAULT NULL,
  `addedon` timestamp NOT NULL DEFAULT current_timestamp(),
  `useradd` int(11) DEFAULT NULL,
  PRIMARY KEY (`noskeluar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `suratkeluar` */

/*Table structure for table `suratmasuk` */

DROP TABLE IF EXISTS `suratmasuk`;

CREATE TABLE `suratmasuk` (
  `nosmasuk` varchar(35) NOT NULL,
  `no_surat` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `dari` varchar(100) DEFAULT NULL,
  `hal` varchar(100) DEFAULT NULL,
  `id_jenissurat` int(11) DEFAULT NULL,
  `berkas` text DEFAULT NULL,
  `addedon` timestamp NOT NULL DEFAULT current_timestamp(),
  `useradd` int(11) DEFAULT NULL,
  PRIMARY KEY (`nosmasuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `suratmasuk` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
