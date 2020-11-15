-- MySQL dump 10.13  Distrib 8.0.16, for Linux (x86_64)
--
-- Host: localhost    Database: barista_pos_brosoft
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_adisyon_odemeleri`
--

DROP TABLE IF EXISTS `tbl_adisyon_odemeleri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_adisyon_odemeleri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adisyon_odemesi_adisyon_idsi` int(11) NOT NULL,
  `adisyon_odemesi_odeme_metodu_idsi` int(11) NOT NULL,
  `adisyon_odemesi_odeme_miktari` float(10,2) NOT NULL,
  `adisyon_odemesi_odemeyi_alan_kisi_idsi` int(11) NOT NULL,
  `adisyon_odemesi_odeme_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_adisyon_odemeleri`
--

LOCK TABLES `tbl_adisyon_odemeleri` WRITE;
/*!40000 ALTER TABLE `tbl_adisyon_odemeleri` DISABLE KEYS */;
INSERT INTO `tbl_adisyon_odemeleri` VALUES (4,27,1,102.00,8,'2019-04-08 11:47:53'),(5,28,2,6.00,8,'2019-04-08 12:51:30'),(6,33,1,198.00,8,'2019-04-09 12:54:28'),(7,19,1,260.10,8,'2019-04-15 13:24:49'),(8,40,2,9.00,8,'2019-04-15 14:02:12'),(9,41,1,3.00,8,'2019-04-15 14:04:18'),(10,42,2,313.00,8,'2019-04-15 14:34:54'),(12,48,2,3.00,8,'2019-04-22 19:22:50'),(13,49,2,20.00,8,'2019-04-22 19:22:50'),(25,46,1,30.00,8,'2019-04-23 10:36:36'),(26,51,1,300.00,8,'2019-04-23 12:09:28'),(27,52,1,16.00,8,'2019-04-23 13:39:02'),(28,53,1,13.00,8,'2019-04-23 13:41:15'),(29,54,2,13.00,8,'2019-04-23 13:44:02'),(30,56,1,32.00,8,'2019-04-23 13:53:20'),(31,55,2,6.00,16,'2019-04-23 13:53:36'),(32,57,1,15.00,8,'2019-04-23 13:54:22'),(33,58,2,6.00,16,'2019-04-23 13:54:31'),(34,15,1,21.00,8,'2019-04-27 12:13:40'),(35,46,1,5.49,8,'2019-04-29 11:49:17'),(36,47,2,10.00,8,'2019-04-29 11:49:25'),(37,85,1,3.00,8,'2019-04-29 12:26:12'),(38,86,2,7.50,8,'2019-04-29 12:26:50'),(39,86,1,7.50,8,'2019-04-29 12:26:54'),(40,87,2,12.00,8,'2019-04-29 12:27:33'),(41,90,1,300.00,8,'2019-04-29 12:31:35'),(42,91,1,654.00,8,'2019-04-29 12:32:10'),(43,93,1,10.00,8,'2019-04-30 11:04:38'),(44,95,1,10.00,8,'2019-04-30 11:10:57');
/*!40000 ALTER TABLE `tbl_adisyon_odemeleri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_adisyon_urunleri`
--

DROP TABLE IF EXISTS `tbl_adisyon_urunleri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_adisyon_urunleri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adisyon_urunleri_adisyon_idsi` int(11) NOT NULL,
  `adisyon_urunleri_urun_idsi` int(11) NOT NULL,
  `adisyon_urunleri_urun_tablo_adi` varchar(75) NOT NULL,
  `adisyon_urunleri_urun_adedi` int(11) NOT NULL,
  `adisyon_urunleri_urun_grami` float DEFAULT NULL,
  `adisyon_urunleri_urun_odenmis_urun_adedi` int(11) NOT NULL,
  `adisyon_urunleri_urun_birim_fiyati` float(10,2) NOT NULL,
  `adisyon_urunleri_urun_toplam_fiyati` float(10,2) NOT NULL,
  `adisyon_urunleri_urun_vergi_miktari` float(10,2) NOT NULL,
  `adisyon_urunleri_urun_teslim_durumu_idsi` int(11) DEFAULT NULL,
  `adisyon_urunleri_urun_ozel_durumu_idsi` int(11) DEFAULT NULL,
  `adisyon_urunleri_urun_notu` varchar(255) NOT NULL,
  `adisyon_urunleri_urun_calisan_idsi` int(11) NOT NULL,
  `adisyon_urunleri_urun_siparis_saati` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_adisyon_urunleri`
--

LOCK TABLES `tbl_adisyon_urunleri` WRITE;
/*!40000 ALTER TABLE `tbl_adisyon_urunleri` DISABLE KEYS */;
INSERT INTO `tbl_adisyon_urunleri` VALUES (37,15,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,1,0,'',0,'2019-04-01 14:18:27'),(66,19,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,2,0,'',11,'2019-04-03 14:13:18'),(67,15,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,2,0,'',10,'2019-04-03 14:23:49'),(68,15,31,'tbl_urunler',3,NULL,0,3.00,9.00,1.62,NULL,0,'',0,'2019-04-03 14:24:38'),(73,19,8,'tbl_menuler',1,NULL,0,300.00,300.00,58.86,1,0,'deneme',0,'2019-04-04 13:18:00'),(74,19,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,2,0,'',0,'2019-04-04 13:53:31'),(76,19,8,'tbl_menuler',1,NULL,0,300.00,300.00,58.86,1,2,'',0,'2019-04-04 15:38:27'),(77,19,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,4,2,'',0,'2019-04-05 13:55:55'),(80,15,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,4,0,'',0,'2019-04-08 10:57:25'),(88,27,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,NULL,0,'',0,'2019-04-08 11:47:03'),(89,27,36,'tbl_urunler',1,NULL,0,99.00,99.00,17.82,NULL,1,'',10,'2019-04-08 11:47:48'),(90,28,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,NULL,0,'',0,'2019-04-08 12:51:08'),(91,28,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,2,0,'',11,'2019-04-08 12:51:13'),(95,31,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,2,0,'cahnge',0,'2019-04-08 15:44:30'),(96,32,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,2,0,'bir',0,'2019-04-08 15:46:00'),(97,32,18,'tbl_alt_urunler',1,NULL,0,10.00,10.00,1.80,NULL,0,'',0,'2019-04-08 15:48:10'),(98,33,36,'tbl_urunler',2,NULL,0,99.00,198.00,35.64,1,0,'',0,'2019-04-08 15:52:30'),(102,37,8,'tbl_menuler',1,NULL,0,300.00,300.00,58.86,NULL,0,'',12,'2019-04-08 16:15:53'),(103,39,19,'tbl_alt_urunler',1,NULL,0,10.00,10.00,1.80,NULL,0,'',11,'2019-04-08 16:28:17'),(114,33,36,'tbl_urunler',2,NULL,0,99.00,198.00,35.64,2,0,'notlu pilav',10,'2019-04-08 15:52:30'),(115,15,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,2,0,'gell',0,'2019-04-11 14:06:05'),(116,40,31,'tbl_urunler',2,NULL,0,3.00,6.00,1.08,2,0,'',8,'2019-04-15 14:01:12'),(117,40,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,4,0,'',8,'2019-04-15 14:02:01'),(118,41,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,2,0,'',8,'2019-04-15 14:04:09'),(119,42,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,1,0,'',8,'2019-04-15 14:32:11'),(120,42,22,'tbl_alt_urunler',1,NULL,0,10.00,10.00,1.80,0,0,'',8,'2019-04-15 14:34:40'),(121,42,8,'tbl_menuler',1,NULL,0,300.00,300.00,58.86,0,0,'',8,'2019-04-15 14:34:43'),(122,43,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,4,0,'',8,'2019-04-15 14:41:24'),(124,43,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,1,0,'',8,'2019-04-15 15:39:03'),(129,43,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,1,0,'',8,'2019-04-17 19:49:19'),(131,46,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-22 17:25:05'),(132,47,22,'tbl_alt_urunler',1,NULL,0,10.00,10.00,1.80,0,0,'',8,'2019-04-22 17:25:08'),(134,32,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-22 19:17:35'),(135,48,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,2,0,'',8,'2019-04-22 19:20:22'),(136,49,22,'tbl_alt_urunler',1,NULL,0,10.00,10.00,1.80,0,0,'',8,'2019-04-22 19:21:31'),(137,49,21,'tbl_alt_urunler',1,NULL,0,10.00,10.00,1.80,0,0,'',8,'2019-04-22 19:22:15'),(139,46,21,'tbl_alt_urunler',3,NULL,3,10.00,30.00,5.40,0,0,'',8,'2019-04-23 10:29:03'),(140,46,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-23 10:41:44'),(141,51,8,'tbl_menuler',1,NULL,0,300.00,300.00,58.86,0,0,'',8,'2019-04-23 12:09:17'),(145,43,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,2,0,'',8,'2019-04-23 12:30:24'),(146,43,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,2,0,'',8,'2019-04-23 12:31:02'),(147,43,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,2,0,'',8,'2019-04-23 12:31:21'),(148,52,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-23 13:22:19'),(149,52,22,'tbl_alt_urunler',1,NULL,0,10.00,10.00,1.80,0,0,'',16,'2019-04-23 13:29:33'),(150,52,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',16,'2019-04-23 13:30:35'),(151,53,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-23 13:39:51'),(152,53,22,'tbl_alt_urunler',1,NULL,0,10.00,10.00,1.80,0,0,'',16,'2019-04-23 13:40:30'),(153,54,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-23 13:42:29'),(154,54,23,'tbl_alt_urunler',1,NULL,0,10.00,10.00,1.80,0,0,'',16,'2019-04-23 13:43:00'),(155,55,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',16,'2019-04-23 13:44:20'),(156,55,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-23 13:44:37'),(157,56,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-23 13:46:02'),(158,56,21,'tbl_alt_urunler',1,NULL,0,10.00,10.00,1.80,0,0,'',8,'2019-04-23 13:47:40'),(159,56,31,'tbl_urunler',3,NULL,0,3.00,9.00,1.62,0,0,'',8,'2019-04-23 13:52:31'),(160,56,23,'tbl_alt_urunler',1,NULL,0,10.00,10.00,1.80,0,0,'',8,'2019-04-23 13:53:10'),(161,57,31,'tbl_urunler',5,NULL,0,3.00,15.00,2.70,0,0,'',8,'2019-04-23 13:53:49'),(162,58,31,'tbl_urunler',2,NULL,0,3.00,6.00,1.08,0,0,'',16,'2019-04-23 13:54:10'),(172,46,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,2,0,'',8,'2019-04-23 15:23:09'),(174,70,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-25 20:53:09'),(175,71,22,'tbl_alt_urunler',1,NULL,0,10.00,10.00,1.80,0,0,'',8,'2019-04-25 21:05:32'),(184,72,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-27 13:30:23'),(185,32,30,'tbl_alt_urunler',1,NULL,0,15.00,15.00,2.25,0,0,'',8,'2019-04-29 09:40:13'),(186,73,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-29 11:14:50'),(187,73,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-29 11:30:04'),(188,74,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-29 11:36:44'),(189,74,31,'tbl_urunler',3,NULL,0,3.00,9.00,1.62,0,0,'',8,'2019-04-29 11:38:07'),(196,81,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-29 11:48:12'),(197,81,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-29 11:48:36'),(198,81,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,1,0,'',8,'2019-04-29 11:48:38'),(199,81,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-29 11:48:39'),(200,81,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-29 11:48:40'),(202,43,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-29 11:48:59'),(203,82,30,'tbl_alt_urunler',1,NULL,0,15.00,15.00,2.25,0,0,'',8,'2019-04-29 11:49:45'),(204,82,31,'tbl_alt_urunler',1,NULL,0,654.00,654.00,117.72,0,0,'',8,'2019-04-29 11:50:00'),(207,83,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-29 11:52:05'),(208,83,8,'tbl_menuler',1,NULL,0,300.00,300.00,58.86,0,0,'',8,'2019-04-29 12:00:13'),(209,81,8,'tbl_menuler',1,NULL,0,300.00,300.00,58.86,0,0,'',8,'2019-04-29 12:00:23'),(210,84,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-29 12:16:36'),(211,85,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-29 12:17:46'),(212,86,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,0,0,'',8,'2019-04-29 12:26:27'),(213,87,31,'tbl_urunler',4,NULL,0,3.00,12.00,2.16,0,0,'',8,'2019-04-29 12:26:31'),(214,86,31,'tbl_urunler',4,NULL,0,3.00,12.00,2.16,0,0,'',8,'2019-04-29 12:26:36'),(217,90,8,'tbl_menuler',1,NULL,0,300.00,300.00,58.86,0,0,'',8,'2019-04-29 12:31:23'),(218,91,31,'tbl_alt_urunler',1,NULL,0,654.00,654.00,117.72,0,0,'',8,'2019-04-29 12:31:58'),(219,92,31,'tbl_urunler',10,NULL,0,3.00,30.00,5.40,0,0,'',8,'2019-04-30 09:36:54'),(220,93,21,'tbl_alt_urunler',1,NULL,1,10.00,10.00,1.80,0,0,'',8,'2019-04-30 11:04:28'),(222,95,21,'tbl_alt_urunler',1,NULL,0,10.00,10.00,1.80,0,0,'',8,'2019-04-30 11:10:53'),(227,84,9,'tbl_menuler',1,NULL,0,70.00,70.00,18.36,0,0,'',8,'2019-04-30 12:16:24'),(228,84,31,'tbl_urunler',1,NULL,0,3.00,3.00,0.54,4,0,'',8,'2019-04-30 12:32:02'),(229,70,36,'tbl_urunler',1,NULL,0,99.00,99.00,17.82,0,0,'',8,'2019-04-30 12:47:49');
/*!40000 ALTER TABLE `tbl_adisyon_urunleri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_adisyonlar`
--

DROP TABLE IF EXISTS `tbl_adisyonlar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_adisyonlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adisyon_qr_kodu` varchar(120) DEFAULT NULL,
  `adisyon_masa_idsi` varchar(50) NOT NULL,
  `adisyon_acilis_saati` time NOT NULL,
  `adisyon_odeme_durumu` tinyint(4) NOT NULL,
  `adisyon_notu` varchar(500) NOT NULL,
  `adisyon_tutari` float(10,2) NOT NULL,
  `adisyon_musteri_idsi` int(11) DEFAULT NULL,
  `adisyon_calisan_idsi` int(11) DEFAULT NULL,
  `adisyon_odenmis_tutar` float(10,2) NOT NULL,
  `adisyon_indirim_turu` tinyint(4) NOT NULL,
  `adisyon_indirim_miktari` tinyint(4) NOT NULL,
  `adisyon_indirim_yapan_kisi_idsi` int(11) NOT NULL,
  `adisyon_garson_idsi` int(11) NOT NULL,
  `adisyon_yola_cikti_mi` tinyint(4) NOT NULL DEFAULT '0',
  `adisyon_kurye_idsi` int(11) NOT NULL DEFAULT '0',
  `adisyon_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_adisyonlar`
--

LOCK TABLES `tbl_adisyonlar` WRITE;
/*!40000 ALTER TABLE `tbl_adisyonlar` DISABLE KEYS */;
INSERT INTO `tbl_adisyonlar` VALUES (15,NULL,'108','09:32:00',1,'',21.00,NULL,NULL,21.00,0,0,0,8,0,0,'2019-04-17 10:41:10'),(19,NULL,'111','09:13:18',1,'',306.00,5,NULL,260.10,0,15,0,10,0,0,'2019-04-17 10:41:10'),(27,NULL,'HS','14:47:03',0,'',3.00,NULL,8,102.00,0,0,0,11,0,0,'2019-04-17 10:41:10'),(28,NULL,'HS','15:51:08',1,'',6.00,NULL,NULL,6.00,0,0,0,8,0,0,'2019-04-17 10:41:10'),(32,NULL,'PS','18:46:00',0,'',31.00,5,NULL,0.00,0,0,0,10,1,10,'2019-04-17 10:41:10'),(33,NULL,'PS','18:52:30',1,'',198.00,7,NULL,198.00,0,0,0,11,1,10,'2019-04-17 10:41:10'),(37,NULL,'PS','19:15:53',1,'',300.00,3,NULL,0.00,0,0,0,11,0,0,'2019-04-17 10:41:10'),(39,NULL,'PS','19:28:17',0,'',10.00,2,NULL,0.00,0,0,0,12,0,0,'2019-04-17 10:41:10'),(40,NULL,'111','17:01:12',1,'',9.00,NULL,NULL,9.00,0,0,0,10,0,0,'2019-04-17 10:41:10'),(41,NULL,'111','17:04:09',1,'',3.00,NULL,NULL,3.00,0,0,0,10,0,0,'2019-04-17 10:41:10'),(42,NULL,'111','17:32:11',1,'',313.00,NULL,NULL,313.00,0,0,0,8,0,0,'2019-04-17 10:41:10'),(43,NULL,'111','17:32:12',0,'',21.00,NULL,NULL,0.00,0,0,0,12,0,0,'2019-04-17 10:41:10'),(46,NULL,'120','20:25:05',1,'',39.00,NULL,17,35.49,0,9,0,12,0,0,'2019-04-22 17:25:05'),(47,'123456789','120','20:25:08',1,'',10.00,NULL,NULL,10.00,0,0,0,0,0,0,'2019-04-22 17:25:08'),(48,NULL,'PS','22:20:22',1,'',3.00,5,NULL,3.00,0,0,0,0,1,8,'2019-04-22 19:20:22'),(49,NULL,'PS','22:21:31',1,'',20.00,3,NULL,20.00,0,0,0,0,1,8,'2019-04-22 19:21:31'),(51,NULL,'HS','15:09:17',1,'',300.00,NULL,NULL,300.00,0,0,0,8,0,0,'2019-04-23 12:09:17'),(52,NULL,'HS','16:22:19',1,'',16.00,NULL,NULL,16.00,0,0,0,8,0,0,'2019-04-23 13:22:19'),(53,NULL,'HS','16:39:51',1,'',13.00,NULL,NULL,13.00,0,0,0,8,0,0,'2019-04-23 13:39:51'),(54,NULL,'HS','16:42:29',1,'',13.00,NULL,NULL,13.00,0,0,0,8,0,0,'2019-04-23 13:42:29'),(55,NULL,'HS','16:44:20',1,'',6.00,NULL,NULL,6.00,0,0,0,16,0,0,'2019-04-23 13:44:20'),(56,NULL,'HS','16:44:37',1,'',32.00,NULL,NULL,32.00,0,0,0,8,0,0,'2019-04-23 13:44:37'),(57,NULL,'HS','16:53:49',1,'',15.00,NULL,NULL,15.00,0,0,0,8,0,0,'2019-04-23 13:53:49'),(58,NULL,'HS','16:54:10',1,'',6.00,NULL,NULL,6.00,0,0,0,16,0,0,'2019-04-23 13:54:10'),(70,NULL,'PS','23:53:09',0,'',102.00,3,NULL,0.00,0,0,0,8,1,10,'2019-04-25 20:53:09'),(71,NULL,'PS','00:05:32',0,'',10.00,14,NULL,0.00,0,0,0,8,0,0,'2019-04-25 21:05:32'),(72,NULL,'PS','16:30:23',0,'',3.00,2,NULL,0.00,0,0,0,8,0,0,'2019-04-27 13:30:23'),(73,'564654','QR','14:14:50',0,'',6.00,NULL,NULL,0.00,0,0,0,8,0,0,'2019-04-29 11:14:50'),(74,'55555','QR','14:36:44',0,'',12.00,NULL,NULL,0.00,0,0,0,8,0,0,'2019-04-29 11:36:44'),(81,NULL,'121','14:48:12',0,'',315.00,NULL,NULL,0.00,0,0,0,8,0,0,'2019-04-29 11:48:12'),(82,NULL,'113','14:49:45',0,'',669.00,NULL,NULL,0.00,0,0,0,8,0,0,'2019-04-29 11:49:45'),(83,NULL,'119','14:52:05',0,'',303.00,NULL,NULL,0.00,0,0,0,8,0,0,'2019-04-29 11:52:05'),(84,NULL,'114','15:16:36',0,'',76.00,NULL,NULL,0.00,0,0,0,8,0,0,'2019-04-29 12:16:36'),(85,'666','QR','15:17:46',1,'',3.00,NULL,NULL,3.00,0,0,0,8,0,0,'2019-04-29 12:17:46'),(86,'666','QR','15:26:27',1,'',15.00,NULL,NULL,15.00,0,0,0,8,0,0,'2019-04-29 12:26:27'),(87,'666','QR','15:26:31',1,'',12.00,NULL,NULL,12.00,0,0,0,8,0,0,'2019-04-29 12:26:31'),(90,'999','QR','15:31:23',1,'',300.00,NULL,NULL,300.00,0,0,0,8,0,0,'2019-04-29 12:31:23'),(91,'8888','QR','15:31:58',1,'',654.00,NULL,NULL,654.00,0,0,0,8,0,0,'2019-04-29 12:31:58'),(92,'255','QR','12:36:54',0,'',30.00,NULL,NULL,0.00,0,0,0,8,0,0,'2019-04-30 09:36:54'),(93,NULL,'108','14:04:28',1,'',10.00,NULL,NULL,10.00,0,0,0,8,0,0,'2019-04-30 11:04:28'),(95,NULL,'108','14:10:53',1,'',10.00,NULL,NULL,10.00,0,0,0,8,0,0,'2019-04-30 11:10:53');
/*!40000 ALTER TABLE `tbl_adisyonlar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_alacaklar`
--

DROP TABLE IF EXISTS `tbl_alacaklar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_alacaklar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alacak_kodu` varchar(120) NOT NULL,
  `alacak_cari_idsi` int(11) NOT NULL,
  `alacak_tutari` float(10,2) NOT NULL,
  `alacak_kasa_idsi` int(11) NOT NULL,
  `alacak_aciklamasi` varchar(500) DEFAULT NULL,
  `alacak_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_alacaklar`
--

LOCK TABLES `tbl_alacaklar` WRITE;
/*!40000 ALTER TABLE `tbl_alacaklar` DISABLE KEYS */;
INSERT INTO `tbl_alacaklar` VALUES (1,'ALACAK-100',10,150.00,1,'DEneme\r\n','2019-04-17 11:48:04');
/*!40000 ALTER TABLE `tbl_alacaklar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_alis_faturalari`
--

DROP TABLE IF EXISTS `tbl_alis_faturalari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_alis_faturalari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alis_faturasi_kodu` varchar(120) NOT NULL,
  `alis_faturasi_seri_numarasi` varchar(255) DEFAULT NULL,
  `alis_faturasi_vade_tarihi` varchar(255) NOT NULL,
  `alis_faturasi_cari_idsi` int(11) NOT NULL,
  `alis_faturasi_ara_toplami` float(10,2) NOT NULL,
  `alis_faturasi_iskonto` float(10,2) NOT NULL,
  `alis_faturasi_vergi_miktari` float(10,2) NOT NULL,
  `alis_faturasi_tutari` float(10,2) NOT NULL,
  `alis_faturasi_kasa_idsi` int(11) NOT NULL DEFAULT '0',
  `alis_faturasi_odenmis_miktar` float(10,2) NOT NULL,
  `alis_faturasi_aciklamasi` varchar(500) NOT NULL,
  `alis_faturasi_kesen_kullanici_idsi` int(11) NOT NULL,
  `alis_faturasi_kur_idsi` int(11) NOT NULL,
  `alis_faturasi_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_alis_faturalari`
--

LOCK TABLES `tbl_alis_faturalari` WRITE;
/*!40000 ALTER TABLE `tbl_alis_faturalari` DISABLE KEYS */;
INSERT INTO `tbl_alis_faturalari` VALUES (18,'fat-002','','2019-03-20',3,90.00,0.00,10.20,90.00,0,0.00,'İlk Fatura',8,1,'2019-03-20 12:30:07'),(19,'fat-003','','2019-03-21',2,45.00,0.00,4.05,45.00,0,0.00,'Dolar bazlı',8,2,'2019-03-21 10:53:31'),(20,'Fat-004','','2019-04-19',3,80.00,10.00,6.40,72.00,0,0.00,'En güzeli',8,1,'2019-04-17 12:27:30'),(21,'fat-005','','2019-03-30',3,30.00,10.00,0.30,27.00,0,0.00,'',8,2,'2019-04-19 14:22:51'),(22,'fat-005','','2019-03-30',3,30.00,10.00,5.40,27.00,0,0.00,'',8,2,'2019-03-21 14:24:51'),(23,'fat-005','','2019-03-30',3,30.00,10.00,5.40,27.00,0,0.00,'',8,2,'2019-03-21 14:26:32'),(24,'fat-006','','2019-03-21',4,30.00,10.00,5.40,27.00,0,0.00,'',8,3,'2019-03-21 14:38:47'),(25,'fat-006','','2019-03-21',4,50.00,10.00,9.00,45.00,0,0.00,'',8,3,'2019-03-21 14:40:24'),(26,'fat-007','','2019-03-19',2,50.00,10.00,7.00,45.00,0,0.00,'2 vergi gruplu',8,1,'2019-03-21 14:41:50'),(27,'fat-008','XCVF84812741','2019-03-21',3,25.00,10.00,3.50,22.50,3,22.50,'',8,2,'2019-03-21 14:50:50'),(29,'fat-009','u192041897','2019-03-22',2,20.00,0.00,3.60,20.00,1,20.00,'Deneme',8,1,'2019-03-22 10:33:59'),(33,'FAT-010','serii','2019-03-25',2,12.00,10.00,1.96,10.80,1,0.00,'açıklama',8,1,'2019-03-25 15:20:09'),(36,'FAT-012','SERİİ','2019-03-25',2,20.00,10.00,2.60,18.00,1,17.00,'asd',8,1,'2019-03-25 15:22:24'),(37,'fat-013','','2019-03-26',3,10.00,0.00,1.80,10.00,1,10.00,'',8,1,'2019-03-26 10:12:18'),(38,'fat-014','89379852398759283','2019-05-24',2,1000.00,10.00,180.00,900.00,0,0.00,'Ustadan et alındı',8,1,'2019-04-30 12:00:46');
/*!40000 ALTER TABLE `tbl_alis_faturalari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_alis_faturasi_urunleri`
--

DROP TABLE IF EXISTS `tbl_alis_faturasi_urunleri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_alis_faturasi_urunleri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alis_faturasi_idsi` int(11) NOT NULL,
  `alis_faturasi_urun_adi` varchar(255) NOT NULL,
  `alis_faturasi_urun_adedi` int(11) NOT NULL,
  `alis_faturasi_urun_birimi` varchar(120) NOT NULL,
  `alis_faturasi_urun_alis_fiyati` float(10,2) NOT NULL,
  `alis_faturasi_urun_vergi_idsi` int(11) NOT NULL,
  `alis_faturasi_urun_vergi_miktari` float(10,2) NOT NULL,
  `alis_faturasi_urun_tutari` float(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_alis_faturasi_urunleri`
--

LOCK TABLES `tbl_alis_faturasi_urunleri` WRITE;
/*!40000 ALTER TABLE `tbl_alis_faturasi_urunleri` DISABLE KEYS */;
INSERT INTO `tbl_alis_faturasi_urunleri` VALUES (9,18,'Brosoft Barista Pos',12,'Adet',5.00,8,0.00,0.00),(10,18,'Latte',10,'Adet',3.00,18,0.00,0.00),(11,19,'Brosoft Barista Pos',15,'Kg',3.00,9,0.00,0.00),(12,20,'Latte',20,'Adet',4.00,8,0.00,80.00),(13,21,'Brosoft Barista Pos',10,'Adet',3.00,1,0.00,30.00),(14,22,'Brosoft Barista Pos',10,'Adet',3.00,1,0.00,30.00),(15,23,'Brosoft Barista Pos',10,'Adet',3.00,18,0.00,30.00),(16,24,'Brosoft Barista Pos',10,'Adet',3.00,1,0.00,30.00),(17,25,'Brosoft Barista Pos',10,'Adet',3.00,1,0.00,30.00),(18,25,'Latte',10,'Adet',2.00,1,0.00,20.00),(19,26,'Latte',10,'Adet',2.00,2,0.00,20.00),(20,26,'Brosoft Barista Pos',10,'Adet',3.00,1,0.00,30.00),(21,27,'Brosoft Barista Pos',5,'Adet',3.00,1,1.80,15.00),(22,27,'Latte',5,'Adet',2.00,2,0.80,10.00),(25,29,'Brosoft Barista Pos',10,'Adet',2.00,1,3.60,20.00),(26,33,'1',1,'Adet',10.00,1,1.80,10.00),(27,33,'1',1,'Adet',2.00,2,0.16,2.00),(42,36,'Brosoft Barista Pos',1,'Adet',10.00,1,1.80,10.00),(43,36,'Latte',5,'Adet',2.00,2,0.80,10.00),(44,37,'Brosoft Barista Pos',1,'Adet',10.00,1,1.80,10.00),(45,37,'',1,'Adet',0.00,1,0.00,0.00),(46,38,'Kırmızı Et',50,'Kilogram',20.00,1,180.00,1000.00);
/*!40000 ALTER TABLE `tbl_alis_faturasi_urunleri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_alt_urunler`
--

DROP TABLE IF EXISTS `tbl_alt_urunler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_alt_urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ust_urun_id` int(11) NOT NULL,
  `alt_urun_kodu` varchar(255) DEFAULT NULL,
  `alt_urun_barkodu` varchar(255) DEFAULT NULL,
  `alt_urun_adi` varchar(255) NOT NULL,
  `alt_urun_birim_idsi` int(11) NOT NULL,
  `alt_urun_adedi` int(100) NOT NULL,
  `alt_urun_rengi` varchar(255) DEFAULT NULL,
  `alt_urun_kategori_idsi` int(11) NOT NULL,
  `alt_urun_gorseli` varchar(255) DEFAULT NULL,
  `alt_urun_alt_uyari_degeri` varchar(255) NOT NULL,
  `alt_urun_kur_idsi` int(11) NOT NULL,
  `alt_urun_kg_fiyati` float(10,2) NOT NULL,
  `alt_urun_alis_fiyati` float(10,2) NOT NULL,
  `alt_urun_satis_fiyati` float(10,2) NOT NULL,
  `alt_urun_alis_vergi_idsi` int(11) NOT NULL,
  `alt_urun_satis_vergi_idsi` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_alt_urunler`
--

LOCK TABLES `tbl_alt_urunler` WRITE;
/*!40000 ALTER TABLE `tbl_alt_urunler` DISABLE KEYS */;
INSERT INTO `tbl_alt_urunler` VALUES (2,27,'urun-108-1','41276417264871','Brosoft Cari - Premium',1,100000,'',46,'[\"brosoftCari_faturaListesi.jpg\",\"brosoftCari_gelirAnalizleri.jpg\",\"brosoftCari_Giris.jpg\"]','10',0,0.00,0.00,2500.00,0,18),(12,49,'gd','46363','döiziad',1,8,'8',41,'[]','8',1,8.00,88.00,8.00,2,2),(15,54,'','','alttt',1,8,'8',41,'[]','8',1,8.00,12.00,19.00,1,1),(21,35,'URUN-110-1','53276578263','Pumpkin Spice Latte',1,100000,'',52,'[\"latte.jpg\"]','100',1,15.00,2.00,10.00,1,1),(22,35,'URUN-110-1','53276578263','Chocolate Latte',1,100000,'',52,'[\"latte.jpg\"]','100',1,15.00,2.00,10.00,1,1),(23,35,'URUN-110-1','53276578263','Vanilla Latte',1,100000,'',52,'[\"latte.jpg\"]','100',1,15.00,2.00,10.00,1,1),(24,57,'URUN-112-1','765756756','Özel Baklava',2,20,'',47,'[\"baklava.jpg\"]','5',1,80.00,30.00,80.00,1,1),(30,63,'urun-144-1','532523523','Sucuklu Menemen',1,29999,'',41,'[\"menemen.jpg\"]','99',1,150.00,5.00,15.00,3,3),(31,63,'URUN-114-2','389589753289','Kaşarlı Menemen',1,1531,'',41,'[\"menemen.jpg\"]','2025',1,5465.00,54.00,654.00,1,1);
/*!40000 ALTER TABLE `tbl_alt_urunler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_birimler`
--

DROP TABLE IF EXISTS `tbl_birimler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_birimler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `birim_adi` varchar(120) NOT NULL,
  `birim_kisaltmasi` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_birimler`
--

LOCK TABLES `tbl_birimler` WRITE;
/*!40000 ALTER TABLE `tbl_birimler` DISABLE KEYS */;
INSERT INTO `tbl_birimler` VALUES (1,'Adet','Adet'),(2,'Kilogram','Kg'),(3,'Gram','G'),(4,'Palet','Pl\r\n'),(5,'Torba','Trba');
/*!40000 ALTER TABLE `tbl_birimler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_calisanlar`
--

DROP TABLE IF EXISTS `tbl_calisanlar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_calisanlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calisan_adi_soyadi` varchar(255) NOT NULL,
  `calisan_adresi` varchar(500) DEFAULT NULL,
  `calisan_dogum_tarihi` varchar(255) DEFAULT NULL,
  `calisan_telefon_numarasi` varchar(255) DEFAULT NULL,
  `calisan_eposta_adresi` varchar(255) DEFAULT NULL,
  `calisan_profil_fotosu` varchar(255) DEFAULT NULL,
  `calisan_statu_idsi` int(11) NOT NULL DEFAULT '0',
  `calisan_kullanici_adi` varchar(255) NOT NULL,
  `calisan_parolasi` varchar(255) NOT NULL,
  `calisan_pini` varchar(255) NOT NULL,
  `calisan_hizli_notlari` varchar(255) NOT NULL,
  `calisan_indirim_turu` tinyint(4) NOT NULL DEFAULT '0',
  `calisan_indirim_miktari` float(10,2) NOT NULL DEFAULT '0.00',
  `calisan_gunluk_harcama_siniri` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_calisanlar`
--

LOCK TABLES `tbl_calisanlar` WRITE;
/*!40000 ALTER TABLE `tbl_calisanlar` DISABLE KEYS */;
INSERT INTO `tbl_calisanlar` VALUES (8,'Burhan Özkan','Aydoğan Mah.','2019-03-16','90532695596','burhan.ozkan@live.com','anim.jpg',5,'broozkan__','1c19469d688bac4a495f35dce03d3782','81dc9bdb52d04dc20036dbd8313ed055','[\"bro\",\"deneme\"]',0,10.00,0.00),(10,'Burak Özkan','Aydoğan','2019-03-13','+90 (532) 131-57-79','burakozkan58@gmail.com','profile.png',3,'arquitecto','broozkan58.','1234','[]',0,0.00,0.00),(11,'Hamdi Tanpınar','','2019-03-29','','','Array',3,'hamdi58','hamdi58','1234','null',0,10.00,0.00),(12,'Alperen Gülsoy','Ankara','2019-03-29','+90 (534) 339-48-60','burhan.ozkan@live.com','profile.png',2,'alpgulsoy','adc85cebe039376235b99b84eda89866','81dc9bdb52d04dc20036dbd8313ed055','[]',1,20.00,0.00),(15,'Burhan Özkan',NULL,NULL,NULL,NULL,NULL,0,'broozkan__','ac576d11f8dc4b3fc11b7abc78e608be','','',0,0.00,0.00),(16,'Hamiyet Özkan','Sivas','2019-04-23','+90 (532) 695-59-68','iletisim@brosoft.com.tr','profile.png',2,'hami58','1c19469d688bac4a495f35dce03d3782','8336041a6899d0bce657dcd29409cf7e','[]',0,0.00,0.00),(17,'Erdem Şimşek','Kastamonu','2019-04-27','05651561651','iletisim@borasf.com','profile.png',1,'yet_34','1c19469d688bac4a495f35dce03d3782','fa246d0262c3925617b0c72bb20eeb1d','[]',0,9.00,NULL);
/*!40000 ALTER TABLE `tbl_calisanlar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_depolar`
--

DROP TABLE IF EXISTS `tbl_depolar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_depolar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `depo_adi` varchar(255) NOT NULL,
  `depo_adresi` varchar(255) NOT NULL,
  `depo_telefon_numarasi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_depolar`
--

LOCK TABLES `tbl_depolar` WRITE;
/*!40000 ALTER TABLE `tbl_depolar` DISABLE KEYS */;
INSERT INTO `tbl_depolar` VALUES (1,'Toptancılar Depo','Toptancılar Sit.','+90 (346) 225-45-45'),(2,'Yerel Depo','Dükkan',''),(4,'Deneme Depo','',''),(5,'Son Depo','','');
/*!40000 ALTER TABLE `tbl_depolar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kasalar`
--

DROP TABLE IF EXISTS `tbl_kasalar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_kasalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kasa_adi` varchar(255) NOT NULL,
  `kasa_acilis_bakiyesi` float(10,2) NOT NULL,
  `kasa_birincil_kasa_mi` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kasalar`
--

LOCK TABLES `tbl_kasalar` WRITE;
/*!40000 ALTER TABLE `tbl_kasalar` DISABLE KEYS */;
INSERT INTO `tbl_kasalar` VALUES (1,'Varsayılan Kasa',0.00,1),(2,'İkincil Kasa',0.00,0),(3,'Üçüncü Kasa',0.00,0),(4,'Dördüncü Kasa',0.00,0),(5,'Beşinci Kasa',0.00,0),(6,'Altıncı Kasa',10.00,0);
/*!40000 ALTER TABLE `tbl_kasalar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kategoriler`
--

DROP TABLE IF EXISTS `tbl_kategoriler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_kategoriler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_adi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kategoriler`
--

LOCK TABLES `tbl_kategoriler` WRITE;
/*!40000 ALTER TABLE `tbl_kategoriler` DISABLE KEYS */;
INSERT INTO `tbl_kategoriler` VALUES (41,'Satış'),(42,'Yönetimsel'),(43,'Hukuk'),(44,'Üretim'),(45,'Boş'),(46,'Hammadde'),(47,'Tatlılar'),(48,'Yardımcı Materyal'),(49,'Kahveler'),(50,'Espresso Kahveler'),(51,'Soğuk İçecekler'),(52,'Sıcak İçecekler'),(53,'Ana Yemek');
/*!40000 ALTER TABLE `tbl_kategoriler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kurlar`
--

DROP TABLE IF EXISTS `tbl_kurlar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_kurlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kur_adi` varchar(255) NOT NULL,
  `kur_isareti` varchar(10) DEFAULT NULL,
  `kur_kisaltmasi` varchar(50) NOT NULL,
  `kur_aktif_mi` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kurlar`
--

LOCK TABLES `tbl_kurlar` WRITE;
/*!40000 ALTER TABLE `tbl_kurlar` DISABLE KEYS */;
INSERT INTO `tbl_kurlar` VALUES (1,'Türk Lirası','₺','TRY',1),(3,'Euro','€','EURO',0),(4,'Arap Riyali','R','RYL',0);
/*!40000 ALTER TABLE `tbl_kurlar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_lokasyonlar`
--

DROP TABLE IF EXISTS `tbl_lokasyonlar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_lokasyonlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lokasyon_adi` varchar(255) NOT NULL,
  `lokasyon_kati` int(11) NOT NULL,
  `lokasyon_krokisi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lokasyonlar`
--

LOCK TABLES `tbl_lokasyonlar` WRITE;
/*!40000 ALTER TABLE `tbl_lokasyonlar` DISABLE KEYS */;
INSERT INTO `tbl_lokasyonlar` VALUES (6,'GİRİŞ',1,'img (1).png'),(7,'ALT KAT',-1,'zemin.jpg'),(8,'BAHÇE',3,'Array'),(9,'TERAS',2,'Array'),(10,'BODRUM',-2,'\"\"'),(11,'DIŞARI',0,'\"PackageIcons.Android.splash_480_320.png\"');
/*!40000 ALTER TABLE `tbl_lokasyonlar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_masalar`
--

DROP TABLE IF EXISTS `tbl_masalar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_masalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `masa_adi` varchar(255) NOT NULL,
  `masa_durumu` tinyint(4) NOT NULL,
  `masa_lokasyon_idsi` int(11) NOT NULL,
  `masa_gorselleri` varchar(255) NOT NULL,
  `masa_rezerve_eden_kisi_idsi` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_masalar`
--

LOCK TABLES `tbl_masalar` WRITE;
/*!40000 ALTER TABLE `tbl_masalar` DISABLE KEYS */;
INSERT INTO `tbl_masalar` VALUES (107,'G01',0,6,'[]',0),(108,'G02',0,6,'[]',0),(109,'A01',0,7,'[]',0),(110,'A02',2,7,'[]',0),(111,'A03',1,7,'[]',0),(112,'A04',3,7,'[]',NULL),(113,'g03',1,7,'[]',NULL),(114,'G04',1,6,'[]',NULL),(115,'G05',0,6,'[]',NULL),(116,'G06',0,6,'[]',NULL),(117,'G07',0,6,'[]',NULL),(118,'G08',0,6,'[]',NULL),(119,'G09',1,6,'[]',NULL),(120,'G10',0,6,'[]',NULL),(121,'G11',1,6,'[]',NULL),(122,'G12',0,6,'[]',NULL),(123,'G13',0,6,'[]',NULL),(124,'G14',3,6,'[]',NULL),(125,'G15',0,6,'[]',NULL),(126,'G16',0,6,'[]',NULL),(127,'G17',0,6,'[]',NULL),(128,'G18',0,6,'[]',NULL),(129,'19',0,6,'[]',NULL),(130,'G29',0,6,'[]',NULL);
/*!40000 ALTER TABLE `tbl_masalar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_menu_urunleri`
--

DROP TABLE IF EXISTS `tbl_menu_urunleri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_menu_urunleri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_urunleri_menu_idsi` int(11) NOT NULL,
  `menu_urunleri_urun_idsi` int(11) NOT NULL,
  `menu_urunleri_urun_adedi` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_menu_urunleri`
--

LOCK TABLES `tbl_menu_urunleri` WRITE;
/*!40000 ALTER TABLE `tbl_menu_urunleri` DISABLE KEYS */;
INSERT INTO `tbl_menu_urunleri` VALUES (12,8,35,3),(13,8,36,2),(14,8,36,1),(19,9,36,1),(20,9,31,1);
/*!40000 ALTER TABLE `tbl_menu_urunleri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_menuler`
--

DROP TABLE IF EXISTS `tbl_menuler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_menuler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_adi` varchar(255) NOT NULL,
  `menu_gorselleri` varchar(255) DEFAULT NULL,
  `menu_toplam_fiyati` float(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_menuler`
--

LOCK TABLES `tbl_menuler` WRITE;
/*!40000 ALTER TABLE `tbl_menuler` DISABLE KEYS */;
INSERT INTO `tbl_menuler` VALUES (8,'Ramazan Menüsü','[\"3.jpg\"]',300.00),(9,'İftar Menüsü','[\"PackageIcons.Android.ic_launcher_96_96.png\"]',65.00);
/*!40000 ALTER TABLE `tbl_menuler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_musteriler`
--

DROP TABLE IF EXISTS `tbl_musteriler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_musteriler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `musteri_adi_soyadi` varchar(255) NOT NULL,
  `musteri_adresi` varchar(255) DEFAULT NULL,
  `musteri_telefon_numarasi` varchar(255) DEFAULT NULL,
  `musteri_eposta_adresi` varchar(255) DEFAULT NULL,
  `musteri_notlari` varchar(500) DEFAULT NULL,
  `musteri_indirim_turu` tinyint(4) NOT NULL,
  `musteri_indirim_miktari` float(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_musteriler`
--

LOCK TABLES `tbl_musteriler` WRITE;
/*!40000 ALTER TABLE `tbl_musteriler` DISABLE KEYS */;
INSERT INTO `tbl_musteriler` VALUES (2,'Sedat Özkan','Sivas','05323450321','burhan.ozkan@live.com','Çayı demli içer\nSinirlidir',0,0.00),(3,'Burhan Özkan','Aydoğan Mah. Şehit Metin Cad. ','05326955968','burhan.ozkan@live.com','İyidir\n',0,0.00),(5,'Osmen','Mehmet Akif Ersoy Mah.','05546655487','','',0,15.00),(6,'Batuhan Temel','Bursa','0532695596','burhan.ozkan@live.com','',1,20.00),(7,'Nursel Arısoy','Yenimahalle','0532695596','','',0,0.00),(8,'Şükrü Yılmaz','ADres','05326955966','iletisim@brosoft.com.tr','',0,0.00),(9,'Jale Öz','Address','05326955966','','',0,0.00),(10,'Ahmet Acar','asfas','05326955966','','',0,0.00),(11,'Korhan Yaman','Sivas','466653525','','',0,0.00),(12,'İsim isim','adres','321864651','','',0,0.00),(13,'Serkan Özkan','Sivassss','312321651','','',0,0.00),(14,'Bahar Özkan','Ankara','323516165','','',0,0.00),(15,'Ben Fero','Şırnak','326955968','','',0,0.00),(16,'Ezhel','Angara','05321561651','','',0,0.00),(17,'Müşşteri','sivas','05466653525','','',0,0.00),(18,'Burak ddöner','Sivas','05321315779','','',0,0.00);
/*!40000 ALTER TABLE `tbl_musteriler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mutfaklar`
--

DROP TABLE IF EXISTS `tbl_mutfaklar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_mutfaklar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mutfak_adi` varchar(255) NOT NULL,
  `mutfak_yazici_idsi` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mutfaklar`
--

LOCK TABLES `tbl_mutfaklar` WRITE;
/*!40000 ALTER TABLE `tbl_mutfaklar` DISABLE KEYS */;
INSERT INTO `tbl_mutfaklar` VALUES (1,'Yemek Mutfağı',2),(2,'İçecek Mutfağı',1),(6,'Tatlı Mutfağı',3);
/*!40000 ALTER TABLE `tbl_mutfaklar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_odeme_metodlari`
--

DROP TABLE IF EXISTS `tbl_odeme_metodlari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_odeme_metodlari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `odeme_metod_adi` varchar(255) NOT NULL,
  `odeme_metod_siralamasi` int(11) NOT NULL,
  `odeme_metod_aktif_mi` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_odeme_metodlari`
--

LOCK TABLES `tbl_odeme_metodlari` WRITE;
/*!40000 ALTER TABLE `tbl_odeme_metodlari` DISABLE KEYS */;
INSERT INTO `tbl_odeme_metodlari` VALUES (1,'Nakit',0,1),(2,'Kredi Kartı',1,1);
/*!40000 ALTER TABLE `tbl_odeme_metodlari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_odemeler`
--

DROP TABLE IF EXISTS `tbl_odemeler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_odemeler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `odeme_kodu` varchar(120) NOT NULL,
  `odeme_cari_idsi` int(11) NOT NULL,
  `odeme_tutari` float(10,2) NOT NULL,
  `odeme_kasa_idsi` int(11) NOT NULL,
  `odeme_aciklamasi` varchar(500) DEFAULT NULL,
  `odeme_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_odemeler`
--

LOCK TABLES `tbl_odemeler` WRITE;
/*!40000 ALTER TABLE `tbl_odemeler` DISABLE KEYS */;
INSERT INTO `tbl_odemeler` VALUES (1,'ODEMe-100',2,36.00,1,'Ödeme Açıklaması','2019-03-20 13:39:12'),(2,'odeme-101',4,50.00,1,'','2019-03-20 14:36:57'),(3,'ODEME-102',3,140.00,1,'Deneme','2019-03-22 14:36:59'),(4,'ODEME-103',4,12.00,1,'','2019-04-17 14:54:10'),(5,'odeme-104',2,10.00,1,'','2019-03-22 14:54:46'),(6,'VERECEK-ODEME-105',4,75.00,1,'','2019-03-25 10:56:11'),(7,'VERECEK-ODEME-105-2',4,75.00,1,'','2019-03-25 10:56:35'),(8,'ODEME-106',5,100.00,2,'Cepten verdim','2019-04-30 12:08:02');
/*!40000 ALTER TABLE `tbl_odemeler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_paket_siparis_urunleri`
--

DROP TABLE IF EXISTS `tbl_paket_siparis_urunleri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_paket_siparis_urunleri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paket_siparis_urunleri_paket_siparis_idsi` int(11) NOT NULL,
  `paket_siparis_urunleri_urun_idsi` int(11) NOT NULL,
  `paket_siparis_urunleri_urun_tablo_adi` varchar(75) NOT NULL,
  `paket_siparis_urunleri_urun_adedi` int(11) NOT NULL,
  `paket_siparis_urunleri_urun_birim_fiyati` float(10,2) NOT NULL,
  `paket_siparis_urunleri_urun_toplam_fiyati` float(10,2) NOT NULL,
  `paket_siparis_urunleri_urun_vergi_miktari` float(10,2) NOT NULL,
  `paket_siparis_urunleri_urun_ozel_durumu_idsi` int(11) DEFAULT NULL,
  `paket_siparis_urunleri_urun_notu` varchar(255) NOT NULL,
  `paket_siparis_urunleri_urun_siparis_saati` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_paket_siparis_urunleri`
--

LOCK TABLES `tbl_paket_siparis_urunleri` WRITE;
/*!40000 ALTER TABLE `tbl_paket_siparis_urunleri` DISABLE KEYS */;
INSERT INTO `tbl_paket_siparis_urunleri` VALUES (37,15,31,'tbl_urunler',1,3.00,3.00,0.54,0,'','2019-04-01 14:18:27'),(66,19,31,'tbl_urunler',1,3.00,3.00,0.54,0,'','2019-04-03 14:13:18'),(67,15,31,'tbl_urunler',1,3.00,3.00,0.54,0,'','2019-04-03 14:23:49'),(68,15,31,'tbl_urunler',3,3.00,9.00,1.62,0,'','2019-04-03 14:24:38'),(73,19,8,'tbl_menuler',1,300.00,300.00,58.86,0,'deneme','2019-04-04 13:18:00'),(74,19,31,'tbl_urunler',1,3.00,3.00,0.54,0,'','2019-04-04 13:53:31'),(76,19,8,'tbl_menuler',1,300.00,300.00,58.86,0,'','2019-04-04 15:38:27'),(77,19,31,'tbl_urunler',1,3.00,3.00,0.54,0,'','2019-04-05 13:55:55'),(80,15,31,'tbl_urunler',1,3.00,3.00,0.54,0,'','2019-04-08 10:57:25'),(88,27,31,'tbl_urunler',1,3.00,3.00,0.54,0,'','2019-04-08 11:47:03'),(89,27,36,'tbl_urunler',1,99.00,99.00,17.82,0,'','2019-04-08 11:47:48'),(90,28,31,'tbl_urunler',1,3.00,3.00,0.54,0,'','2019-04-08 12:51:08'),(91,28,31,'tbl_urunler',1,3.00,3.00,0.54,0,'','2019-04-08 12:51:13');
/*!40000 ALTER TABLE `tbl_paket_siparis_urunleri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_paket_siparisler`
--

DROP TABLE IF EXISTS `tbl_paket_siparisler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_paket_siparisler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paket_siparis_acilis_saati` time NOT NULL,
  `paket_siparis_notu` varchar(500) NOT NULL,
  `paket_siparis_tutari` float(10,2) NOT NULL,
  `paket_siparis_musteri_idsi` int(11) DEFAULT NULL,
  `paket_siparis_indirim_turu` tinyint(4) NOT NULL,
  `paket_siparis_indirim_miktari` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_paket_siparisler`
--

LOCK TABLES `tbl_paket_siparisler` WRITE;
/*!40000 ALTER TABLE `tbl_paket_siparisler` DISABLE KEYS */;
INSERT INTO `tbl_paket_siparisler` VALUES (15,'09:32:00','',18.00,NULL,0,0),(19,'09:13:18','',609.00,5,0,15),(27,'14:47:03','',102.00,NULL,0,0),(28,'15:51:08','',6.00,NULL,0,0);
/*!40000 ALTER TABLE `tbl_paket_siparisler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_program_ayarlari`
--

DROP TABLE IF EXISTS `tbl_program_ayarlari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_program_ayarlari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caller_id_aktif_mi` tinyint(4) NOT NULL,
  `yazarkasa_aktif_mi` tinyint(4) NOT NULL,
  `yemeksepeti_aktif_mi` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_program_ayarlari`
--

LOCK TABLES `tbl_program_ayarlari` WRITE;
/*!40000 ALTER TABLE `tbl_program_ayarlari` DISABLE KEYS */;
INSERT INTO `tbl_program_ayarlari` VALUES (3,1,1,0);
/*!40000 ALTER TABLE `tbl_program_ayarlari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_satis_faturalari`
--

DROP TABLE IF EXISTS `tbl_satis_faturalari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_satis_faturalari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `satis_faturasi_kodu` varchar(120) NOT NULL,
  `satis_faturasi_seri_numarasi` varchar(255) DEFAULT NULL,
  `satis_faturasi_vade_tarihi` varchar(255) NOT NULL,
  `satis_faturasi_cari_idsi` int(11) NOT NULL,
  `satis_faturasi_ara_toplami` float(10,2) NOT NULL,
  `satis_faturasi_iskonto` float(10,2) NOT NULL,
  `satis_faturasi_vergi_miktari` float(10,2) NOT NULL,
  `satis_faturasi_tutari` float(10,2) NOT NULL,
  `satis_faturasi_kasa_idsi` int(11) NOT NULL DEFAULT '0',
  `satis_faturasi_odenmis_miktar` float(10,2) NOT NULL,
  `satis_faturasi_aciklamasi` varchar(500) NOT NULL,
  `satis_faturasi_kesen_kullanici_idsi` int(11) NOT NULL,
  `satis_faturasi_kur_idsi` int(11) NOT NULL,
  `satis_faturasi_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_satis_faturalari`
--

LOCK TABLES `tbl_satis_faturalari` WRITE;
/*!40000 ALTER TABLE `tbl_satis_faturalari` DISABLE KEYS */;
INSERT INTO `tbl_satis_faturalari` VALUES (42,'FAT-100','','2019-04-19',3,2500.00,0.00,450.80,2510.00,1,0.00,'Satış faturası',8,2,'2019-04-17 10:39:55');
/*!40000 ALTER TABLE `tbl_satis_faturalari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_satis_faturasi_urunleri`
--

DROP TABLE IF EXISTS `tbl_satis_faturasi_urunleri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_satis_faturasi_urunleri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `satis_faturasi_idsi` int(11) NOT NULL,
  `satis_faturasi_urun_adi` varchar(255) NOT NULL,
  `satis_faturasi_urun_adedi` int(11) NOT NULL,
  `satis_faturasi_urun_birimi` varchar(120) NOT NULL,
  `satis_faturasi_urun_satis_fiyati` float(10,2) NOT NULL,
  `satis_faturasi_urun_vergi_idsi` int(11) NOT NULL,
  `satis_faturasi_urun_vergi_miktari` float(10,2) NOT NULL,
  `satis_faturasi_urun_tutari` float(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_satis_faturasi_urunleri`
--

LOCK TABLES `tbl_satis_faturasi_urunleri` WRITE;
/*!40000 ALTER TABLE `tbl_satis_faturasi_urunleri` DISABLE KEYS */;
INSERT INTO `tbl_satis_faturasi_urunleri` VALUES (54,42,'Brosoft Barista Pos',1,'Adet',2500.00,1,450.00,2500.00),(55,42,'Latte',1,'Adet',10.00,2,0.00,10.00);
/*!40000 ALTER TABLE `tbl_satis_faturasi_urunleri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sirket`
--

DROP TABLE IF EXISTS `tbl_sirket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_sirket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sirket_adi` varchar(255) NOT NULL,
  `sirket_adresi` varchar(255) NOT NULL,
  `sirket_eposta_adresi` varchar(255) NOT NULL,
  `sirket_telefonu` varchar(255) NOT NULL,
  `sirket_vergi_numarasi` varchar(255) NOT NULL,
  `sirket_logosu` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sirket`
--

LOCK TABLES `tbl_sirket` WRITE;
/*!40000 ALTER TABLE `tbl_sirket` DISABLE KEYS */;
INSERT INTO `tbl_sirket` VALUES (1,'Brosoft Yazılım','Yenişehir Mah. Kardeşler Cad. No:5 Cumhuriyet Teknokent','iletisim@brosoft.com.tr','+90 (532) 695-59-68','28381849766','img.png'),(2,'Brosoft Yazılım','Yenişehir Mah. Kardeşler Cad. No:5 Cumhuriyet Teknokent','iletisim@brosoft.com.tr','90532695596','28381849766','anim.jpg');
/*!40000 ALTER TABLE `tbl_sirket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sirket_carileri`
--

DROP TABLE IF EXISTS `tbl_sirket_carileri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_sirket_carileri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cari_adi` varchar(255) NOT NULL,
  `cari_eposta_adresi` varchar(255) NOT NULL,
  `cari_telefon_numarasi` varchar(255) NOT NULL,
  `cari_adresi` varchar(255) NOT NULL,
  `cari_kategorisi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sirket_carileri`
--

LOCK TABLES `tbl_sirket_carileri` WRITE;
/*!40000 ALTER TABLE `tbl_sirket_carileri` DISABLE KEYS */;
INSERT INTO `tbl_sirket_carileri` VALUES (1,'Semtes Isı ve Mekanik Tesisat','burhan.ozkan@live.com','05326955968','Ankara','Dış Ticaret'),(3,'Köşe Grup','iletisim@brosof.tcom','+56 (116) 516-51-16','Sivas','Kategori'),(4,'Brosoft Yazılım','iletisim@brosoft.com.tr','','','Kategori'),(5,'Burhan Özkan','','','','Kategori'),(6,'Sedat Özkan','','','','Kategori'),(7,'Hamiyet Özkan','','','','Kategori'),(8,'Doğan Birlik Perde','','','Bankalar Caddesi','Kategori'),(9,'Bakalım olacak mı','rnetk@saf.cpm','+16 (515) 165-16-51','','Kategori'),(10,'Bu son','burhan.ozkan@live.com','+51 (616) 216-21-51','Sivas','Kategori'),(11,'hadi inş','','','','28'),(12,'Burak Özkan','burakozkan58@gmail.com','+90 (532) 695-59-68','Sivas','31'),(13,'Osman Arslan','burhan.ozkan@live.com','+90 (532) 695-59-68','Sivas','33'),(14,'Zekiye Hasbek','burhan.ozkan@live.com','+90 (532) 695-59-68','Sivas','34'),(15,'broozkan','burhan.ozkan@live.com','+12 (412) 891-75-19','','38'),(16,'Kürşat Ünal','burhan.ozkan@live.com','+90 (532) 695-59-68','','45');
/*!40000 ALTER TABLE `tbl_sirket_carileri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_statuler`
--

DROP TABLE IF EXISTS `tbl_statuler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_statuler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statu_adi` varchar(255) NOT NULL,
  `statu_yetkileri` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_statuler`
--

LOCK TABLES `tbl_statuler` WRITE;
/*!40000 ALTER TABLE `tbl_statuler` DISABLE KEYS */;
INSERT INTO `tbl_statuler` VALUES (1,'Barista','[{\"cboxTumYetkiler\":false},{\"txtSiparisAlabilir\":true},{\"txtOdemeAlabilir\":true},{\"txtUrunEkleyebilir\":true},{\"txtCalisanEkleyebilir\":false},{\"txtYaziciEkleyebilir\":true},{\"txtMutfakEkleyebilir\":true},{\"txtMasaEkleyebilir\":true},{\"txtKategoriEkleyebilir\":true},{\"txtLokasyonEkleyebilir\":true},{\"txtAyarlaraGirebilir\":false},{\"txtMutfakGoruntuleyebilir\":true},{\"txtRaporGoruntuleyebilir\":false},{\"txtStokDuzenleyebilir\":true},{\"txtMuhasebeKullanabilir\":false},{\"txtPaketServisKullanabilir\":false}]'),(2,'Yönetici','[{\"cboxTumYetkiler\":true},{\"txtSiparisAlabilir\":true},{\"txtOdemeAlabilir\":true},{\"txtUrunEkleyebilir\":true},{\"txtCalisanEkleyebilir\":true},{\"txtYaziciEkleyebilir\":true},{\"txtMutfakEkleyebilir\":true},{\"txtMasaEkleyebilir\":true},{\"txtKategoriEkleyebilir\":true},{\"txtLokasyonEkleyebilir\":true},{\"txtAyarlaraGirebilir\":true},{\"txtMutfakGoruntuleyebilir\":true},{\"txtRaporGoruntuleyebilir\":true},{\"txtStokDuzenleyebilir\":true},{\"txtMuhasebeKullanabilir\":true},{\"txtPaketServisKullanabilir\":true}]'),(3,'Garson','[{\"cboxTumYetkiler\":false},{\"txtSiparisAlabilir\":true},{\"txtOdemeAlabilir\":true},{\"txtUrunEkleyebilir\":true},{\"txtCalisanEkleyebilir\":false},{\"txtYaziciEkleyebilir\":true},{\"txtMutfakEkleyebilir\":true},{\"txtMasaEkleyebilir\":true},{\"txtKategoriEkleyebilir\":true},{\"txtLokasyonEkleyebilir\":true},{\"txtAyarlaraGirebilir\":false},{\"txtMutfakGoruntuleyebilir\":true},{\"txtRaporGoruntuleyebilir\":false},{\"txtStokDuzenleyebilir\":true},{\"txtMuhasebeKullanabilir\":false},{\"txtPaketServisKullanabilir\":false}]'),(4,'Aşçı','[{\"cboxTumYetkiler\":false},{\"txtSiparisAlabilir\":false},{\"txtOdemeAlabilir\":false},{\"txtUrunEkleyebilir\":true},{\"txtCalisanEkleyebilir\":false},{\"txtYaziciEkleyebilir\":true},{\"txtMutfakEkleyebilir\":true},{\"txtMasaEkleyebilir\":true},{\"txtKategoriEkleyebilir\":true},{\"txtLokasyonEkleyebilir\":true},{\"txtAyarlaraGirebilir\":false},{\"txtMutfakGoruntuleyebilir\":true},{\"txtRaporGoruntuleyebilir\":false},{\"txtStokDuzenleyebilir\":true},{\"txtMuhasebeKullanabilir\":false},{\"txtPaketServisKullanabilir\":true}]'),(5,'Müdür','[{\"cboxTumYetkiler\":true},{\"cboxYonetimTumYetkiler\":true},{\"txtSiparisAlabilir\":true},{\"txtOdemeAlabilir\":true},{\"txtHizliSatisYapabilir\":true},{\"txtPaketServisYonetebilir\":true},{\"txtMutfakEkranlarinaGirebilir\":true},{\"cboxMerkezTumYetkiler\":true},{\"txtStokMerkezineGirebilir\":true},{\"txtMuhasebeMerkezineGirebilir\":true},{\"txtRaporMerkezineGirebilir\":true},{\"cboxBirimTumYetkiler\":true},{\"txtKasaEkleyebilir\":true},{\"txtYaziciEkleyebilir\":true},{\"txtMutfakEkleyebilir\":true},{\"txtLokasyonEkleyebilir\":true},{\"txtMasaEkleyebilir\":true},{\"txtTeslimDurumuEkleyebilir\":true},{\"txtStatuEkleyebilir\":true},{\"txtCalisanEkleyebilir\":true},{\"txtDepoEkleyebilir\":true},{\"txtVergiEkleyebilir\":true},{\"txtKategoriEkleyebilir\":true},{\"txtBirimEkleyebilir\":true},{\"txtUrunEkleyebilir\":true},{\"txtMenuEkleyebilir\":true},{\"txtMusteriEkleyebilir\":true},{\"txtKurEkleyebilir\":true},{\"txtOdemeMetoduEkleyebilir\":true}]');
/*!40000 ALTER TABLE `tbl_statuler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_stok_dusme_bilgileri`
--

DROP TABLE IF EXISTS `tbl_stok_dusme_bilgileri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_stok_dusme_bilgileri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ait_urun_idsi` int(11) NOT NULL,
  `ait_urun_tablo_adi` varchar(75) NOT NULL,
  `stoktan_dusulecek_urun_idsi` int(11) NOT NULL,
  `stoktan_dusum_miktari` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_stok_dusme_bilgileri`
--

LOCK TABLES `tbl_stok_dusme_bilgileri` WRITE;
/*!40000 ALTER TABLE `tbl_stok_dusme_bilgileri` DISABLE KEYS */;
INSERT INTO `tbl_stok_dusme_bilgileri` VALUES (1,36,'',39,'0.100'),(2,36,'',37,'0.50'),(5,59,'',39,'10'),(6,59,'',38,'12'),(7,26,'',37,'222'),(8,27,'',12,'333'),(9,27,'',27,'444'),(13,60,'',10,'111'),(57,58,'',39,'10'),(58,58,'',37,'11'),(99,63,'tbl_urunler',37,'200'),(100,63,'tbl_urunler',38,'12'),(101,30,'tbl_alt_urunler',39,'100'),(102,31,'tbl_alt_urunler',38,'125'),(103,31,'tbl_alt_urunler',39,'360'),(108,31,'tbl_urunler',38,'0.100'),(109,36,'tbl_urunler',39,'0.50');
/*!40000 ALTER TABLE `tbl_stok_dusme_bilgileri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tahsilatlar`
--

DROP TABLE IF EXISTS `tbl_tahsilatlar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_tahsilatlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahsilat_kodu` varchar(120) NOT NULL,
  `tahsilat_cari_idsi` int(11) NOT NULL,
  `tahsilat_tutari` float(10,2) NOT NULL,
  `tahsilat_kasa_idsi` int(11) NOT NULL,
  `tahsilat_aciklamasi` varchar(500) DEFAULT NULL,
  `tahsilat_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tahsilatlar`
--

LOCK TABLES `tbl_tahsilatlar` WRITE;
/*!40000 ALTER TABLE `tbl_tahsilatlar` DISABLE KEYS */;
INSERT INTO `tbl_tahsilatlar` VALUES (8,'ALACAK-TAHSİLAT-100',3,25.00,2,'Yarısını alabildik','2019-03-25 10:22:08'),(9,'ALACAK-TAHSİLAT-100-2',3,25.00,2,'Borç kalmadı','2019-04-17 10:26:20'),(13,'ALACAK-TAHSİLAT-101',3,150.00,1,'','2019-03-25 10:40:43');
/*!40000 ALTER TABLE `tbl_tahsilatlar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_teslim_durumlari`
--

DROP TABLE IF EXISTS `tbl_teslim_durumlari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_teslim_durumlari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teslim_durumu_adi` varchar(255) NOT NULL,
  `teslim_durumu_rengi` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_teslim_durumlari`
--

LOCK TABLES `tbl_teslim_durumlari` WRITE;
/*!40000 ALTER TABLE `tbl_teslim_durumlari` DISABLE KEYS */;
INSERT INTO `tbl_teslim_durumlari` VALUES (1,'Hazırlanıyor','#ffff00'),(2,'Hazır','#00ff00'),(4,'Teslim Edildi','#408080');
/*!40000 ALTER TABLE `tbl_teslim_durumlari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_urunler`
--

DROP TABLE IF EXISTS `tbl_urunler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urun_kodu` varchar(255) DEFAULT NULL,
  `urun_barkodu` varchar(255) DEFAULT NULL,
  `urun_adi` varchar(255) NOT NULL,
  `urun_birim_idsi` int(11) NOT NULL,
  `urun_adedi` float(10,2) NOT NULL,
  `urun_rengi` varchar(255) DEFAULT NULL,
  `urun_kategori_idsi` int(11) NOT NULL,
  `urun_mutfak_idleri` varchar(255) NOT NULL,
  `urun_gorseli` varchar(255) DEFAULT NULL,
  `urun_alt_uyari_degeri` varchar(255) NOT NULL,
  `urun_kur_idsi` int(11) NOT NULL,
  `urun_kg_fiyati` float(10,2) NOT NULL,
  `urun_alis_fiyati` float(10,2) NOT NULL,
  `urun_satis_fiyati` float(10,2) NOT NULL,
  `urun_alis_vergi_idsi` int(11) NOT NULL,
  `urun_satis_vergi_idsi` int(11) NOT NULL,
  `urun_stok_urunu_mu` tinyint(4) NOT NULL DEFAULT '0',
  `urun_depo_idsi` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_urunler`
--

LOCK TABLES `tbl_urunler` WRITE;
/*!40000 ALTER TABLE `tbl_urunler` DISABLE KEYS */;
INSERT INTO `tbl_urunler` VALUES (12,'URUN-106','123456789','Brosoft Barista Pos',1,739.00,'',46,'0','[\"brosoftCari_ayarlar.jpg\",\"brosoftCari_faturaGoruntule.jpg\"]','1',0,0.00,10.00,2500.00,1,18,0,0),(15,'URUN-107','1489172498172','Brosoft Smart Process',1,1000000.00,'',46,'0','[\"brosoftCari_alacakVerecek.jpg\",\"brosoftCari_faturaListesi.jpg\"]','10',0,0.00,20.00,20000.00,0,18,0,0),(27,'URUN-108','1422141','Brosoft Cari',1,100000.00,'',46,'0','[\"brosoftCari_faturaListesi.jpg\",\"brosoftCari_gelirAnalizleri.jpg\",\"brosoftCari_Giris.jpg\"]','10',0,0.00,30.00,1500.00,0,1,0,0),(31,'urun-109','381765','Çay',1,1000000.00,'',52,'[\"1\",\"2\"]','[\"cay.jpg\"]','9',1,0.00,0.00,3.00,1,1,0,0),(32,'','','safasf',1,9.00,'9',41,'[\"1\",\"2\",\"6\"]','[]','9',0,0.00,9.00,9.00,9,9,0,0),(35,'urun-110','8325982','Latte',1,100090.00,'',52,'[\"2\"]','[\"latte.jpg\"]','100',1,10.00,2.00,10.00,1,1,0,0),(36,'urun-111','','Döner',1,9999.00,'',41,'[\"1\"]','[]','9',1,9.00,9.00,99.00,1,1,0,0),(37,'STOK-100','0000000000000','Tereyağ',2,350.00,'',46,'[]','[]','10',0,0.00,25.00,0.00,2,0,1,5),(38,'STOK-101','','Toz Çay',2,99.90,'9',41,'[]','[]','9',1,0.00,9.00,0.00,1,0,1,1),(39,'STOK-102','','Kırmızı Et',2,99.50,'',46,'[]','[]','10',1,0.00,10.00,0.00,1,0,1,1),(41,'denem','898','burhan',5,7.00,'7',41,'[]','[]','7',0,0.00,7.00,0.00,7,0,1,1),(49,'döviz','','dövizliiiii',1,9.00,'9',41,'[\"6\"]','[]','3',3,5.00,6.00,0.00,8,9,0,0),(52,'','','asdsadasd',1,7.00,'7',41,'[\"2\"]','[]','7',1,7.00,7.00,7.00,1,1,0,0),(53,'','','asdsadasd',1,7.00,'7',41,'[\"2\"]','[]','7',1,7.00,7.00,7.00,1,1,0,0),(54,'','','asdsadasd',1,7.00,'7',41,'[\"2\"]','[]','7',1,7.00,7.00,7.00,1,1,0,0),(55,'','','kurlu',1,8.00,'',41,'[]','[]','29',1,0.00,42.00,0.00,1,0,1,1),(57,'URUN-112','352875982359823','Baklava',2,20.00,'',47,'[\"6\"]','[\"baklava.jpg\"]','5',1,60.00,20.00,60.00,1,1,0,0),(58,'URUN-113555','873958273985789','Tost',1,10000.00,'',53,'[\"1\"]','[\"tost.jpg\"]','50',1,20.00,3.00,10.00,1,1,0,0),(63,'URUN-114','53209859237','Menemen',1,9999.00,'',41,'[\"1\",\"6\"]','[\"menemen.jpg\"]','200',1,100.00,2.00,10.00,1,1,0,0);
/*!40000 ALTER TABLE `tbl_urunler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_verecekler`
--

DROP TABLE IF EXISTS `tbl_verecekler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_verecekler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `verecek_kodu` varchar(120) NOT NULL,
  `verecek_cari_idsi` int(11) NOT NULL,
  `verecek_tutari` float(10,2) NOT NULL,
  `verecek_kasa_idsi` int(11) NOT NULL,
  `verecek_aciklamasi` varchar(500) DEFAULT NULL,
  `verecek_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_verecekler`
--

LOCK TABLES `tbl_verecekler` WRITE;
/*!40000 ALTER TABLE `tbl_verecekler` DISABLE KEYS */;
INSERT INTO `tbl_verecekler` VALUES (1,'VERECEK-100',10,100.00,1,'DEAs','2019-04-17 11:48:23');
/*!40000 ALTER TABLE `tbl_verecekler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_vergiler`
--

DROP TABLE IF EXISTS `tbl_vergiler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_vergiler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vergi_adi` varchar(255) NOT NULL,
  `vergi_yuzdesi` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_vergiler`
--

LOCK TABLES `tbl_vergiler` WRITE;
/*!40000 ALTER TABLE `tbl_vergiler` DISABLE KEYS */;
INSERT INTO `tbl_vergiler` VALUES (1,'KDV18',18),(2,'KDV8',8),(3,'KDV15',15);
/*!40000 ALTER TABLE `tbl_vergiler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_yazicilar`
--

DROP TABLE IF EXISTS `tbl_yazicilar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_yazicilar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yazici_adi` varchar(255) NOT NULL,
  `yazici_ip_adresi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_yazicilar`
--

LOCK TABLES `tbl_yazicilar` WRITE;
/*!40000 ALTER TABLE `tbl_yazicilar` DISABLE KEYS */;
INSERT INTO `tbl_yazicilar` VALUES (1,'denemeYazicisi','192.168.1.20\r\n'),(2,'İçecek Yazıcısı','192.168.1.21'),(3,'Adisyon Yazıcısı','192.168.1.22'),(4,'a4Yazicisi','192.168.1.45');
/*!40000 ALTER TABLE `tbl_yazicilar` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-30 15:57:30
