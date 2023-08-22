/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.11.2-MariaDB-1 : Database - idcard
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`idcard` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `idcard`;

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

/*Table structure for table `jenis` */

DROP TABLE IF EXISTS `jenis`;

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nm_jenis` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jenis` */

insert  into `jenis`(`id_jenis`,`nm_jenis`) values 
(4,'Honor'),
(5,'ASN');

/*Table structure for table `jenissurat` */

DROP TABLE IF EXISTS `jenissurat`;

CREATE TABLE `jenissurat` (
  `id_jenissurat` int(11) NOT NULL AUTO_INCREMENT,
  `nm_jenissurat` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id_jenissurat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jenissurat` */

insert  into `jenissurat`(`id_jenissurat`,`nm_jenissurat`) values 
(1,'Honor'),
(2,'ASN');

/*Table structure for table `jk` */

DROP TABLE IF EXISTS `jk`;

CREATE TABLE `jk` (
  `id_jk` int(11) NOT NULL AUTO_INCREMENT,
  `nm_jk` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id_jk`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jk` */

insert  into `jk`(`id_jk`,`nm_jk`) values 
(1,'Laki-laki'),
(2,'Perempuan');

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
(1,'Ridwan','L','Desa Batang Kumu, Kec. Tambusaix','082385334445','admin','21232f297a57a5a743894a0e4a801fc3','9467e7fa9c53e6adcf2417c7dd10a90c639ec11a702d199955941520221218142826.jpg');

/*Table structure for table `suratmasuk` */

DROP TABLE IF EXISTS `suratmasuk`;

CREATE TABLE `suratmasuk` (
  `nosmasuk` varchar(35) NOT NULL,
  `nm_anggota` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `nip` varchar(100) DEFAULT NULL,
  `id_jenissurat` int(11) DEFAULT NULL,
  `berkas` text DEFAULT NULL,
  `addedon` timestamp NOT NULL DEFAULT current_timestamp(),
  `useradd` int(11) DEFAULT NULL,
  `id_jk` int(11) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `gol_darah` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nosmasuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `suratmasuk` */

insert  into `suratmasuk`(`nosmasuk`,`nm_anggota`,`tanggal`,`alamat`,`nip`,`id_jenissurat`,`berkas`,`addedon`,`useradd`,`id_jk`,`jabatan`,`gol_darah`) values 
('230820.SM.0002','Sahlan Sulaiman Hasibuan, M.Kom','2023-08-20','sfds','6565756',2,'598168332230820SM0002.jpg','2023-08-20 21:44:31',NULL,2,'5676','O'),
('230820.SM.0003','Salsa','2023-08-21','adasasdjahdjajsdaj','32424',1,'1286778001230820SM0003.png','2023-08-20 21:57:19',NULL,1,'adsad','A+');

/*Table structure for table `ttd` */

DROP TABLE IF EXISTS `ttd`;

CREATE TABLE `ttd` (
  `id_ttd` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_ttd`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `ttd` */

insert  into `ttd`(`id_ttd`,`nama`,`jabatan`) values 
(1,'Muhammmad Zaki, S.STP, M.SI','Sekretaris Daerah Rokan Hulu');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
