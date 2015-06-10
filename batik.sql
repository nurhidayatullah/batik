/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.16 : Database - batik
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`batik` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `batik`;

/*Table structure for table `batik` */

DROP TABLE IF EXISTS `batik`;

CREATE TABLE `batik` (
  `id_batik` int(11) NOT NULL AUTO_INCREMENT,
  `nama_batik` char(100) DEFAULT NULL,
  `keterangan` text,
  `foto` char(100) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_batik`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `batik` */

insert  into `batik`(`id_batik`,`nama_batik`,`keterangan`,`foto`,`create_at`,`update_at`) values (1,'Pekalongan','<p>tes</p>',NULL,'2015-06-04 08:37:50','2015-06-05 04:21:27'),(3,'tes batik','<p>tes keterangan batik</p>\r\n\r\n<ol>\r\n <li>mdfdkfj,jdfdf</li>\r\n <li>jmdsodms,ds</li>\r\n <li>sdhmsidh,sd</li>\r\n <li>dfhndkfnhdmf md</li>\r\n <li>fmsdkl,jlskd</li>\r\n</ol>','Free-Wallpaper-Nature-Scenes.jpg','2015-06-04 12:43:26','2015-06-04 12:57:30');

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id_cust` int(11) NOT NULL AUTO_INCREMENT,
  `nama_cust` char(100) DEFAULT NULL,
  `alamat` char(150) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `telp` char(20) DEFAULT NULL,
  `foto` char(100) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_cust`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `customers` */

insert  into `customers`(`id_cust`,`nama_cust`,`alamat`,`kota`,`telp`,`foto`,`create_at`,`update_at`) values (3,'M Zainul Ichwan','Sedati','Sidoarjo','78927891271892','iwan_fals.jpg','2015-06-04 06:36:52','2015-06-06 07:06:43'),(4,'Rian Tri','Widang','Tuban','36283682763286872','1504839.jpg','2015-06-06 02:04:48',NULL);

/*Table structure for table `group_user` */

DROP TABLE IF EXISTS `group_user`;

CREATE TABLE `group_user` (
  `kode_group` int(11) NOT NULL AUTO_INCREMENT,
  `nama_group` varchar(50) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_group`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `group_user` */

insert  into `group_user`(`kode_group`,`nama_group`,`create_at`,`update_at`) values (1,'Administrator','2015-04-25 19:05:00','2015-05-03 17:11:03'),(2,'Admin','2015-05-14 17:43:43',NULL);

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `kode_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) DEFAULT NULL,
  `controller` varchar(100) DEFAULT NULL,
  `kode_parent` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert  into `menu`(`kode_menu`,`nama_menu`,`controller`,`kode_parent`,`create_at`,`update_at`) values (17,'Menu Admin','',0,'2015-05-06 02:37:41','2015-05-08 02:37:59'),(18,'Master Menu','admin/menu/index',17,'2015-05-06 02:05:42',NULL),(20,'Master Group','admin/group/index',17,'2015-05-06 02:27:43',NULL),(21,'Master User','admin/user/index',17,'2015-05-06 02:47:43',NULL),(28,'Data Master','',0,'2015-06-04 05:11:26',NULL),(29,'Customers','batik/customers/index',28,'2015-06-04 05:53:26','2015-06-04 05:00:34'),(30,'Batik','batik/batik/index',28,'2015-06-04 05:28:27',NULL),(31,'Transaksi','',0,'2015-06-05 03:11:14',NULL),(32,'Transaksi','batik/transaksi/index',31,'2015-06-05 03:46:14',NULL);

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `kode_role` int(11) NOT NULL AUTO_INCREMENT,
  `kode_group` int(11) DEFAULT NULL,
  `kode_menu` int(11) DEFAULT NULL,
  `view` int(1) DEFAULT '0',
  `itambah` int(1) DEFAULT '0',
  `iupdate` int(1) DEFAULT '0',
  `idelete` int(1) DEFAULT '0',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_role`),
  KEY `FK_role_group` (`kode_group`),
  KEY `FK_role_menu` (`kode_menu`),
  CONSTRAINT `FK_role_group` FOREIGN KEY (`kode_group`) REFERENCES `group_user` (`kode_group`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_role_menu` FOREIGN KEY (`kode_menu`) REFERENCES `menu` (`kode_menu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

/*Data for the table `role` */

insert  into `role`(`kode_role`,`kode_group`,`kode_menu`,`view`,`itambah`,`iupdate`,`idelete`,`create_at`,`update_at`) values (1,1,17,1,0,0,0,'2015-05-06 02:37:41','2015-05-21 05:57:55'),(5,1,18,0,0,0,0,'2015-05-06 02:06:42','2015-06-05 03:14:15'),(13,1,20,1,1,1,1,'2015-05-06 02:27:43','2015-05-07 17:39:45'),(17,1,21,1,1,1,1,'2015-05-06 02:47:43','2015-05-07 17:21:38'),(28,2,17,0,0,0,0,'2015-05-14 17:43:43','2015-05-21 06:32:15'),(29,2,18,0,0,0,0,'2015-05-14 17:43:43',NULL),(31,2,20,0,0,0,0,'2015-05-14 17:43:43',NULL),(32,2,21,0,0,0,0,'2015-05-14 17:43:43',NULL),(53,1,28,1,0,0,0,'2015-06-04 05:11:26','2015-06-04 05:11:28'),(54,2,28,0,0,0,0,'2015-06-04 05:11:26',NULL),(56,1,29,1,1,1,0,'2015-06-04 05:53:26','2015-06-06 08:22:04'),(57,2,29,0,0,0,0,'2015-06-04 05:53:26',NULL),(59,1,30,1,1,1,1,'2015-06-04 05:28:27','2015-06-04 05:20:28'),(60,2,30,0,0,0,0,'2015-06-04 05:28:27',NULL),(61,1,31,1,0,0,0,'2015-06-05 03:11:14','2015-06-05 03:16:15'),(62,2,31,0,0,0,0,'2015-06-05 03:11:14',NULL),(63,1,32,1,1,1,1,'2015-06-05 03:46:14','2015-06-05 03:22:15'),(64,2,32,0,0,0,0,'2015-06-05 03:46:14',NULL);

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_transaksi` date DEFAULT NULL,
  `id_cust` int(11) DEFAULT NULL,
  `id_batik` int(11) DEFAULT NULL,
  `ukuran` char(20) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id_transaksi`,`tgl_transaksi`,`id_cust`,`id_batik`,`ukuran`,`jumlah`,`keterangan`) values (1,'2015-06-05',3,1,'M',10,'mkjmhccss'),(2,'2015-06-06',3,1,'M',1,'<p>tes</p>'),(3,'2015-06-06',3,1,'M',1,'<p>tes keterangan</p>\r\n\r\n<ol>\r\n <li>gjnhfmdfkdfd</li>\r\n <li>fdnfjdbfhmdjf dfd</li>\r\n <li>fdjfndjfmhdjfdfd</li>\r\n <li>fhdjfmhdfjdfd</li>\r\n <li>dfdjfhmdfjd</li>\r\n</ol>\r\n\r\n<p>tes 2</p>\r\n\r\n<ul>\r\n <li>hfkjdshfmmdjjfdfd</li>\r\n <li>dfdhnjfhmdjfdf</li>\r\n <li>dfhdjfmdkfd&#39;dfdjfh</li>\r\n <li>dfdmfdfd</li>\r\n <li>dfmdfdfd</li>\r\n</ul>'),(4,'2015-06-06',4,1,'L',90,'<p>Panjang lengan :20 cm</p>\r\n\r\n<p>Lebar lengan : 10cm</p>\r\n\r\n<p>Tinggi bahu : 20cm</p>\r\n\r\n<p>kera baju 30cm</p>');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `kode_user` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `kode_group` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_user`),
  KEY `FK_user` (`kode_group`),
  CONSTRAINT `FK_user` FOREIGN KEY (`kode_group`) REFERENCES `group_user` (`kode_group`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `user` */

insert  into `user`(`kode_user`,`first_name`,`last_name`,`email`,`password`,`active`,`kode_group`,`create_at`,`update_at`) values (1,'superuser','user','admin@admin.com','-WPA125R908KbtxUtXcP8C-POpyQWn79vHoiO2XBhrY',1,1,'2015-04-26 05:17:29','2015-06-04 05:33:23');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
