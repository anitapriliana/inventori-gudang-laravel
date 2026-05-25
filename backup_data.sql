-- MySQL dump 10.13  Distrib 8.4.11, for Linux (x86_64)
--
-- Host: localhost    Database: ideaform
-- ------------------------------------------------------
-- Server version	8.4.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barang` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori_id` bigint unsigned DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang`
--

LOCK TABLES `barang` WRITE;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` VALUES (1,'SLS-001',1,'ISOLASI','LAKBAN KERTAS KECIL','NASHUA','-',8,'pcs',NULL,'2026-10-07 09:42:56','2026-10-09 07:55:12'),(3,'CAT-002',2,'FINISHING','TOP COLOR WHITE','DANAPAINT','-',3,'kaleng',NULL,'2026-10-07 09:44:26','2026-10-08 08:10:27'),(4,'AKS-001',9,'AKSESORIS','KUNCI SILINDER','-','-',1,'pcs',NULL,'2026-10-08 08:07:33','2026-10-08 08:10:44'),(5,'AKS-002',9,'AKSESORIS','PIVOT','-','-',1,'pcs',NULL,'2026-10-08 08:07:49','2026-10-08 08:11:07'),(6,'AKS-003',9,'AKSESORIS','DELUXE MORTISE LOCK SUS 304','-','-',1,'pcs',NULL,'2026-10-08 08:08:28','2026-10-08 08:11:32'),(7,'LEM-001',3,'LEM','ALTEKO','EPOTEC','-',21,'pcs',NULL,'2026-10-08 08:13:25','2026-10-09 07:46:30'),(8,'ALT-001',4,'ALAT PENDUKUNG','ISI CUTTER','KENKO','-',40,'pcs',NULL,'2026-10-08 08:13:59','2026-10-08 08:39:02'),(9,'LTK-001',8,'KELISTRIKAN','KABEL 2 WARNA','-','-',3,'pcs',NULL,'2026-10-08 08:14:23','2026-10-08 08:39:56'),(10,'SLS-002',1,'ISOLASI','LAKBAN BENING','DAIMARU','-',28,'pcs',NULL,'2026-10-08 08:15:14','2026-10-08 09:02:42'),(11,'CAT-003',2,'FINISHING','WRAPPING','-','-',45,'pcs',NULL,'2026-10-08 08:15:44','2026-10-08 09:03:58'),(12,'REL-001',5,'REL','REL 50 CM','BLUM','-',10,'set',NULL,'2026-10-08 08:16:40','2026-10-08 09:07:28'),(13,'REL-002',5,'REL','REL 40 CM','BLUM','-',11,'set',NULL,'2026-10-08 08:17:05','2026-10-08 09:07:52'),(15,'LEM-002',3,'LEM','LEM KUNING','FOX','RONADAMAR',26,'pcs',NULL,'2026-10-08 08:19:38','2026-10-08 09:15:52'),(16,'SKP-002',6,'SEKRUP + PAKU','PAKU TEMBAK F20','STRONGMAN','-',9,'pcs',NULL,'2026-10-08 08:20:50','2026-10-08 09:23:46'),(17,'SKP-003',6,'SEKRUP + PAKU','PAKU TEMBAK F25','STRONGMAN','-',9,'pcs',NULL,'2026-10-08 08:21:16','2026-10-08 09:24:11'),(18,'SKP-004',6,'SEKRUP + PAKU','PAKU TEMBAK F10','STRONGMAN','-',12,'pcs',NULL,'2026-10-08 08:21:41','2026-10-08 08:21:41'),(19,'SKP-005',6,'SEKRUP + PAKU','PAKU TEMBAK F15','STRONGMAN','-',11,'pcs',NULL,'2026-10-08 08:22:04','2026-10-08 08:22:04'),(20,'SKP-006',6,'SEKRUP + PAKU','PAKU TEMBAK F30','STRONGMAN','-',10,'pcs',NULL,'2026-10-08 08:22:23','2026-10-08 09:24:58'),(21,'CAT-004',2,'FINISHING','TOP COLOR BLACK','DANAPAINT','-',4,'pcs',NULL,'2026-10-08 08:23:58','2026-10-08 08:23:58'),(22,'CAT-005',2,'FINISHING','TOP COLOR SIGNAL RED','DANAPAINT','-',3,'kaleng',NULL,'2026-10-08 08:25:27','2026-10-08 08:25:27'),(23,'CAT-006',2,'FINISHING','TOP COLOR CHROME ORANGE','DANAPAINT','-',2,'kaleng',NULL,'2026-10-08 08:25:58','2026-10-08 08:25:58'),(24,'CAT-007',2,'FINISHING','TOP COLOR MADORAS BROWN','DANAPAINT','-',2,'kaleng',NULL,'2026-10-08 08:26:40','2026-10-08 08:26:40'),(25,'CAT-008',2,'FINISHING','TOP COLOR LIGHT CHROME YELLOW','DANAPAINT','-',2,'pcs',NULL,'2026-10-08 08:27:07','2026-10-08 08:27:07'),(26,'CAT-009',2,'FINISHING','TOP COLOR METROPOLITAN BLUE','DANAPAINT','-',2,'kaleng',NULL,'2026-10-08 08:27:49','2026-10-08 08:27:49'),(27,'CAT-010',2,'FINISHING','TOP COLOR HAVANA BROWN','DANAPAINT','-',2,'kaleng',NULL,'2026-10-08 08:28:27','2026-10-08 08:28:27'),(28,'CAT-011',2,'FINISHING','TOP COLOR PERIWINCLE','DANAPAINT','-',1,'kaleng',NULL,'2026-10-08 08:29:31','2026-10-08 08:29:31'),(29,'CAT-012',2,'FINISHING','TOP COLOR COKLAT SUSU','DANAPAINT','-',2,'kaleng',NULL,'2026-10-08 08:30:08','2026-10-08 08:30:08'),(30,'CAT-013',2,'FINISHING','TOP COLOR PUTIH PASIR','DANAPAINT','-',1,'kaleng',NULL,'2026-10-08 08:30:33','2026-10-08 08:30:33'),(31,'CAT-014',2,'FINISHING','TOP COLOR PANAMA GREEN','DANAPAINT','-',1,'pcs',NULL,'2026-10-08 08:31:07','2026-10-08 08:31:07'),(32,'CAT-015',2,'FINISHING','TOP COLOR WHITE NEW EXCLUSIVE GREY','DANAPAINT','-',1,'pcs',NULL,'2026-10-08 08:31:47','2026-10-08 08:31:47'),(33,'CAT-016',2,'FINISHING','IMPRA CANDY BROWN CB','PROPAN','-',3,'kaleng',NULL,'2026-10-08 08:32:31','2026-10-08 08:32:31'),(34,'CAT-017',2,'FINISHING','IMPRA COFFEE BROWN','PROPAN','-',2,'kaleng',NULL,'2026-10-08 08:33:05','2026-10-08 08:33:05'),(35,'CAT-018',2,'FINISHING','TOP COLOR BEIGE','DANAPAINT','-',2,'kaleng',NULL,'2026-10-08 08:33:30','2026-10-08 08:33:30'),(36,'CAT-019',2,'FINISHING','HARDENER 668','KANSAI','-',5,'kaleng',NULL,'2026-10-08 08:34:04','2026-10-08 08:34:04'),(37,'CAT-020',2,'FINISHING','HARDENER 002','KANSAI','-',5,'pcs',NULL,'2026-10-08 08:34:38','2026-10-08 08:34:38'),(38,'CAT-021',2,'FINISHING','IMPRA DARK BROWN','PROPAN','-',3,'pcs',NULL,'2026-10-08 08:35:23','2026-10-08 08:35:23'),(39,'CAT-022',2,'FINISHING','IMPRA WALNUT BROWN','PROPAN','-',1,'pcs',NULL,'2026-10-08 08:35:52','2026-10-08 09:25:37'),(40,'CAT-023',2,'FINISHING','IMPRA COCOA BROWN','PROPAN','-',1,'pcs',NULL,'2026-10-08 08:36:11','2026-10-08 09:25:56'),(41,'LEM-003',3,'LEM','LEM PRESTO','DN','-',4,'pcs',NULL,'2026-10-08 08:36:30','2026-10-08 09:26:16'),(42,'LEM-004',3,'LEM','LEM PUTIH','FOX','RONADAMAR',13,'pcs',NULL,'2026-10-08 08:36:57','2026-10-08 09:26:33'),(44,'CAT-024',2,'FINISHING','THINNER ND','XENON','-',12,'kaleng',NULL,'2026-10-08 09:28:10','2026-10-08 09:28:10'),(45,'SKP-008',6,'SEKRUP + PAKU','SEKRUP HOSPA 3 CM','-','-',500,'pcs',NULL,'2026-10-08 09:28:34','2026-10-08 09:28:34'),(46,'ALS-001',7,'AMPLAS','AMPLAS P120','SAB','-',100,'pcs',NULL,'2026-10-08 09:29:15','2026-10-08 09:29:15'),(47,'ALT-002',4,'ALAT PENDUKUNG','MATA ROUTER 10 MM','WIPRO','-',5,'pcs',NULL,'2026-10-08 09:30:50','2026-10-08 09:30:50'),(48,'ALS-002',7,'AMPLAS','AMPLAS P80','SAB','-',32,'pcs',NULL,'2026-10-08 09:31:09','2026-10-08 09:31:09'),(49,'SKP-009',6,'SEKRUP + PAKU','SEKRUP BIRU 6x1\"','-','-',1000,'pcs',NULL,'2026-10-08 09:31:46','2026-10-08 09:31:46'),(50,'SKP-010',6,'SEKRUP + PAKU','SEKRUP ENGSEL SILVER','-','-',1400,'pcs',NULL,'2026-10-09 04:19:02','2026-10-09 07:54:01'),(51,'CAT-025',2,'FINISHING','PLASTIK COR','-','-',6,'pcs',NULL,'2026-10-09 07:44:27','2026-10-09 07:44:53');
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barang_keluar`
--

DROP TABLE IF EXISTS `barang_keluar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barang_keluar` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `barang_id` bigint unsigned NOT NULL,
  `proyek_id` bigint unsigned DEFAULT NULL,
  `jumlah` int NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'keluar',
  `alasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `barang_keluar_barang_id_foreign` (`barang_id`),
  KEY `barang_keluar_proyek_id_foreign` (`proyek_id`),
  CONSTRAINT `barang_keluar_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE,
  CONSTRAINT `barang_keluar_proyek_id_foreign` FOREIGN KEY (`proyek_id`) REFERENCES `proyeks` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang_keluar`
--

LOCK TABLES `barang_keluar` WRITE;
/*!40000 ALTER TABLE `barang_keluar` DISABLE KEYS */;
INSERT INTO `barang_keluar` VALUES (1,1,1,3,'2026-05-28','keluar',NULL,NULL,'2026-10-08 08:09:02','2026-10-08 08:09:02'),(3,3,3,1,'2026-05-28','keluar',NULL,'+ Y HOUSE','2026-10-08 08:10:27','2026-10-08 08:10:27'),(4,4,3,1,'2026-05-28','keluar',NULL,NULL,'2026-10-08 08:10:44','2026-10-08 08:10:44'),(5,5,3,1,'2026-05-28','keluar',NULL,NULL,'2026-10-08 08:11:07','2026-10-08 08:11:07'),(6,6,3,1,'2026-05-28','keluar',NULL,NULL,'2026-10-08 08:11:32','2026-10-08 08:11:32'),(7,7,2,5,'2026-05-29','keluar',NULL,NULL,'2026-10-08 08:37:41','2026-10-08 08:37:41'),(8,7,6,5,'2026-05-29','keluar',NULL,NULL,'2026-10-08 08:37:57','2026-10-08 08:37:57'),(9,8,2,1,'2026-05-29','keluar',NULL,NULL,'2026-10-08 08:39:02','2026-10-08 08:39:02'),(10,9,2,2,'2026-05-29','keluar',NULL,NULL,'2026-10-08 08:39:56','2026-10-08 08:39:56'),(11,10,4,3,'2026-05-29','keluar',NULL,NULL,'2026-10-08 09:02:42','2026-10-08 09:02:42'),(12,11,4,1,'2026-05-29','keluar',NULL,NULL,'2026-10-08 09:03:58','2026-10-08 09:03:58'),(13,12,5,3,'2026-07-29','keluar',NULL,NULL,'2026-10-08 09:07:28','2026-10-08 09:07:28'),(14,13,5,3,'2026-05-29','keluar',NULL,NULL,'2026-10-08 09:07:52','2026-10-08 09:07:52'),(15,1,4,2,'2026-05-29','keluar',NULL,NULL,'2026-10-08 09:15:11','2026-10-08 09:15:11'),(16,15,4,6,'2026-05-29','keluar',NULL,NULL,'2026-10-08 09:15:34','2026-10-08 09:15:34'),(17,15,3,2,'2026-05-29','keluar',NULL,NULL,'2026-10-08 09:15:52','2026-10-08 09:15:52'),(18,16,5,1,'2026-05-29','keluar',NULL,NULL,'2026-10-08 09:23:46','2026-10-08 09:23:46'),(19,17,5,1,'2026-05-29','keluar',NULL,NULL,'2026-10-08 09:24:11','2026-10-08 09:24:11'),(20,20,5,1,'2026-05-29','keluar',NULL,NULL,'2026-10-08 09:24:58','2026-10-08 09:24:58'),(21,39,NULL,1,'2026-05-29','keluar',NULL,'SAMPEL','2026-10-08 09:25:37','2026-10-08 09:25:37'),(22,40,NULL,1,'2026-05-29','keluar',NULL,'SAMPEL','2026-10-08 09:25:56','2026-10-08 09:25:56'),(23,41,6,2,'2026-05-29','keluar',NULL,NULL,'2026-10-08 09:26:16','2026-10-08 09:26:16'),(24,42,7,2,'2026-05-29','keluar',NULL,NULL,'2026-10-08 09:26:33','2026-10-08 09:26:33'),(25,1,8,7,'2026-05-30','keluar',NULL,NULL,'2026-10-08 09:32:17','2026-10-08 09:32:17'),(26,1,9,2,'2026-05-30','keluar',NULL,NULL,'2026-10-08 09:33:07','2026-10-08 09:33:07'),(27,1,1,1,'2026-05-30','keluar',NULL,NULL,'2026-10-08 09:33:30','2026-10-08 09:33:30'),(29,51,1,1,'2026-05-28','keluar',NULL,NULL,'2026-10-09 07:44:53','2026-10-09 07:44:53'),(30,7,2,2,'2026-05-29','keluar',NULL,NULL,'2026-10-09 07:46:09','2026-10-09 07:46:09'),(31,7,6,5,'2026-05-28','keluar',NULL,NULL,'2026-10-09 07:46:30','2026-10-09 07:46:30'),(32,50,5,100,'2026-05-29','keluar',NULL,NULL,'2026-10-09 07:54:01','2026-10-09 07:54:01'),(33,1,8,7,'2026-05-30','keluar',NULL,NULL,'2026-10-09 07:55:12','2026-10-09 07:55:12');
/*!40000 ALTER TABLE `barang_keluar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barang_masuk`
--

DROP TABLE IF EXISTS `barang_masuk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barang_masuk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `barang_id` bigint unsigned NOT NULL,
  `jumlah` int NOT NULL,
  `sisa_jumlah` int NOT NULL DEFAULT '0',
  `tanggal_kadaluwarsa` date DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `barang_masuk_barang_id_foreign` (`barang_id`),
  CONSTRAINT `barang_masuk_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang_masuk`
--

LOCK TABLES `barang_masuk` WRITE;
/*!40000 ALTER TABLE `barang_masuk` DISABLE KEYS */;
/*!40000 ALTER TABLE `barang_masuk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel-cache-kepalagudang|140.213.35.96','i:2;',1791366389),('laravel-cache-kepalagudang|140.213.35.96:timer','i:1791366389;',1791366389);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategoris`
--

DROP TABLE IF EXISTS `kategoris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategoris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_kategori` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategoris`
--

LOCK TABLES `kategoris` WRITE;
/*!40000 ALTER TABLE `kategoris` DISABLE KEYS */;
INSERT INTO `kategoris` VALUES (1,'SLS','ISOLASI',NULL,'2026-10-07 09:38:19','2026-10-07 09:38:19'),(2,'CAT','FINISHING',NULL,'2026-10-07 09:39:16','2026-10-07 09:39:16'),(3,'LEM','LEM',NULL,'2026-10-07 09:39:44','2026-10-07 09:39:44'),(4,'ALT','ALAT PENDUKUNG',NULL,'2026-10-07 09:39:57','2026-10-07 09:39:57'),(5,'REL','REL',NULL,'2026-10-07 09:40:21','2026-10-07 09:40:21'),(6,'SKP','SEKRUP + PAKU',NULL,'2026-10-07 09:40:34','2026-10-07 09:41:03'),(7,'ALS','AMPLAS',NULL,'2026-10-07 09:41:33','2026-10-07 09:41:33'),(8,'LTK','KELISTRIKAN',NULL,'2026-10-07 09:41:44','2026-10-07 09:41:44'),(9,'AKS','AKSESORIS',NULL,'2026-10-08 08:07:00','2026-10-08 08:07:00');
/*!40000 ALTER TABLE `kategoris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_01_10_025439_create_kategoris_table',1),(5,'2026_01_14_160733_create_barangs_table',1),(6,'2026_01_14_160750_create_barang_masuks_table',1),(7,'2026_01_14_160807_create_barang_keluars_table',1),(8,'2026_01_15_072903_create_proyeks_table',1),(9,'2026_01_22_041120_add_fefo_fifo_columns_to_barang_masuk_table',1),(10,'2026_01_25_000000_add_kategori_id_to_barangs_table',1),(11,'2026_01_25_000001_add_keterangan_to_barang_keluar_table',1),(12,'2026_01_25_000001_add_kode_kategori_and_deskripsi_to_kategoris_table',1),(13,'2026_01_25_000002_sync_barang_kategori_ids',1),(14,'2026_01_25_043858_add_role_to_users_table',1),(15,'2026_01_25_062352_add_gambar_to_barang_table',1),(16,'2026_01_25_065326_add_status_to_barang_keluar_table',1),(17,'2026_01_25_073732_add_supplier_to_barang_table',1),(18,'2026_01_25_073940_add_proyek_id_to_barang_keluar_table',1),(19,'2026_01_25_095804_remove_kategori_column_from_barangs_table',1),(20,'2026_01_25_162640_add_kode_barang_to_barangs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyeks`
--

DROP TABLE IF EXISTS `proyeks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proyeks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_proyek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyeks`
--

LOCK TABLES `proyeks` WRITE;
/*!40000 ALTER TABLE `proyeks` DISABLE KEYS */;
INSERT INTO `proyeks` VALUES (1,'PAK UNTUNG',NULL,NULL,NULL,'2026-10-08 08:04:15','2026-10-08 08:04:39'),(2,'Y HOUSE',NULL,NULL,NULL,'2026-10-08 08:04:28','2026-10-08 08:04:28'),(3,'LAKSANA',NULL,NULL,NULL,'2026-10-08 08:04:48','2026-10-08 08:04:48'),(4,'BU HANI',NULL,NULL,NULL,'2026-10-08 08:04:59','2026-10-08 08:04:59'),(5,'PAK RUDI',NULL,NULL,NULL,'2026-10-08 08:05:07','2026-10-08 08:05:07'),(6,'PAK CHARLES',NULL,NULL,NULL,'2026-10-08 08:05:16','2026-10-08 08:05:16'),(7,'PAK WILLIAM',NULL,NULL,NULL,'2026-10-08 08:05:23','2026-10-08 08:05:23'),(8,'PAK ANDRE',NULL,NULL,NULL,'2026-10-08 08:05:33','2026-10-08 08:05:33'),(9,'PAK JUNIAS',NULL,NULL,NULL,'2026-10-08 08:05:40','2026-10-08 08:05:40');
/*!40000 ALTER TABLE `proyeks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('1pqJ5wkP76rGLCiuXEeukZ5ixQ8xm8j06DWv2hbe',NULL,'194.195.210.47','Mozilla/5.0 zgrab/0.x','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVhDa0Y2MTZUcEFOWXB5VW84Ym9SWk03NmJtRTNiRjBmQTBrYW1DUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791851631),('3aJ9OFPbQAsPLMlnSXVNwOEERoeNyXWmQ1yglOXH',NULL,'185.231.102.30','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidzRVUGNmT0Zwd05ad21ZMkxmV2N2S1ZHb3VIUVp0SkQ0OGd2OFV2cyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9pZGVhZm9ybS1pbnZlbnRvcmkubXkuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791845637),('5nT29OCsjCNeZ0dnr7y9zRQ73d8GD4PGpo9DFag4',NULL,'34.62.173.117','Mozilla/5.0 (compatible)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNzZyc1lweHdNS094ZU1XRnhzaHVyRzF2Yk12c2tCb3hWVkk2TFlVcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791863967),('7GEsenEWwcVfcGIUbBaCACVUKBKIt7SeyO1Ynby9',NULL,'45.79.181.223','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicFZUMzNTRnhJSFNMbTh3OE02Q085TG5pYW1HczRvSkVyeDl3YmR6VSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791840966),('89sNEVBIq35ovzp9hFw15XUhWNqjQF9CXpTRU4tf',NULL,'45.198.224.125','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:71.0) Gecko/20100101 Firefox/71.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoidUFIb29vOWpKMGhrTUhCMTNnbW1IOUFyMGZDbWQ1SmY3TTJqT1VIRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791862208),('8fWYVsORZNYYTY7od7GpaHFxv2O3VEKzXedfYR4k',NULL,'64.62.156.205','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoieWwxQVY3MUxBSjhaaDE4bjc2U21NS1cxaFBydFhrU3BJRnJlY1ltNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791858936),('8lVQQvaSF4ef1Ek8PuPnNNmkadh15Ipt87yIqXRe',NULL,'45.198.224.125','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:71.0) Gecko/20100101 Firefox/71.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiU0M2ZTZrRFM5UklOZm11R1N6a2JjY2hqRW9qejJHeFRpM1BZYTZHZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791849884),('aNIQNVgVeV5dIk46n39RMDLWg8RGQsfqVK51BRf2',NULL,'64.62.156.206','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1lETXM4MWFyVXhBUFdpWUZ1Q1ZLYmVMZU43bnh1bHFPdTY5NkV4YSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791858938),('B3VKQxnOK8VLtMqXwwzcbOm5iT31RiiFVZ9GvfNG',NULL,'172.239.64.155','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiakVjN2JvOGxOTHUyalo4Q09rbWFlbEdiaWZQQnN5NFF0eGlBVG9aciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791855947),('CSNDB2sfYM6isnXFx1ldiVwRYIQiNjDoWGiFTQZd',NULL,'64.62.156.202','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36 OPR/86.0.4363.59','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVjFjZGVTUnp4M05URldUTTN1VWZjU2c3MXFZVXM0ZDI1UjE2SGc5NSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791858998),('dfJ5TyAzGXAZfY5ZEu9Z3xyejP2KkW9p0FJhqFRY',NULL,'45.79.181.251','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiV1BMSmU0N2R0VE5rOHpWTGtOdFZ0NWdGZHc0SVNWRURyYWlCUThwNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791859981),('DMgr5cNYOqQ8BT3ixImPbQibgCRnURAAKK41Gmek',NULL,'172.104.210.105','Mozilla/5.0 zgrab/0.x','YTozOntzOjY6Il90b2tlbiI7czo0MDoia3M3QWZhTDBnSUtNMzNVclpPT1Noa2U1N1JFdVFuWW9LbUE1M29SZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791833792),('EXIkTY0jzgnmwIVjAMfuti1zQGUjdp084igxkNUq',NULL,'172.239.64.155','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiemZ1QWhOUUFoMldwU2dQdjllTDB3UmlvTG9vV3dwTmhFWEJGUmlhUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791855946),('f5nZi9SToBcVOymRhmSA9CuGMOXtaf001VsiKK5m',NULL,'205.169.39.54','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.5938.132 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEFmNnRyMDA2a2FVc05aU1hjVUZVOEc1QXZZejlXYXpGQVd0VHFFMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791840408),('FsDelD1dlHrlkKQz5RBknHC3liBzVlGe8f3SwHlf',NULL,'45.198.224.124','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46','YToyOntzOjY6Il90b2tlbiI7czo0MDoiRTRNUk91ZnFXY0UxQlA5SGEycVdHYkpIdE5HSHZ3QnNOSmhpMDltQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1791848327),('fYKmJWk7TUbFZEWKSBaZ3OYZnBzaq0MnlZNoZE3Q',NULL,'13.140.177.20','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUDNhY2pwUWFFRm5iTk83UkNYT2htM2hCV2I0VUY3eWNnOWMxc29GUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly93d3cuaWRlYWZvcm0taW52ZW50b3JpLm15LmlkIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791833917),('GdwCYAg4JfJzuMugpSQd6ak3r3sTB2Tuvt5Qykhy',NULL,'45.33.80.243','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0Q0anJCUjRRaDhETUlBbW5XZGdPOXpmdVJLclg5OFBxY0VPOE52NCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791848019),('h2Oglaa3TDN9CXlwe93SHReEBrJkL3mfhEuE6rdA',NULL,'172.236.228.202','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiU05FWU1uQm5TVk5Id1NVUUtxSzV5YWJobElSZkNpY2psUXRzS0pvbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791851885),('HZ5IwCmkjVJTISTauFWklVJ6xRJoWlVAn6PeGGIi',NULL,'172.105.128.12','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaVFsNTFWWEFUWTZrNEFsQWp6TXpjVFVER2pFMmdpVm9XRDhrNTBYWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791837412),('IOoxg97uEV7ZcFj6niFZk8WTsR5RqB0AJw9Vbcsw',NULL,'45.79.181.251','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoianR2RGdBdWxFblhEUEZITmdRMXd1dEZDRnl5VnFlUFo1cmNhYlhYTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791859980),('J12fzH7h4KJS1p2BwtgS0efPS1G0wYsnr7K89TDz',NULL,'152.53.46.2','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:131.0) Gecko/20100101 Firefox/131.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYjdJZnYxbU9yRDRjd2Y0ZklPdUdFaWFRemJVMGwyVTF1Rm8yWkpnTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9pZGVhZm9ybS1pbnZlbnRvcmkubXkuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791842596),('Jerg17ChCGj27uqksZOs9iHiCi7fI0TRF5Z0HdkQ',NULL,'204.76.203.219','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46','YToyOntzOjY6Il90b2tlbiI7czo0MDoiZHJGYTRMQnZQRVlSNlBHWlNMYzIxb3k1T3VMNjJ0S2NZV1M1RGR6SSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1791857966),('JgXWuIkkS4y6ZrrpNAe3Xf6H8Fjeu7gRrRljCTPx',NULL,'150.107.36.82','Mozilla/5.0 (X11; U; Linux x86_64; en-US) AppleWebKit/534.15 (KHTML, like Gecko) Chrome/10.0.613.0 Safari/534.15','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWFNoQ2VNa25iOVZzeUdjUzc0S3lKR01sZ2RzNUpOTURsNW9zU1JkciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791835459),('KkR6jJXCz1gn5JTbY7dkUqi18dXgSE1DSenuGsUo',NULL,'152.53.46.2','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:131.0) Gecko/20100101 Firefox/131.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoicWM2R05WOGpIQXI0eTVONzdxNmdESzFVUXNUdVpkN1o1NHVPT3AyWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9pZGVhZm9ybS1pbnZlbnRvcmkubXkuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791842597),('l5h4dG4p7h8kuz9S2hpPM18JRW4Iggrrbvgx7Hgv',NULL,'172.234.124.171','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.3','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVlkRlh1aE8zR1FtWnhHYU1kaGZ2VXlwZ1dPSjBoYVFuaG9Ya0l1dSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791851420),('LouqmtNJWJZJLdzTna8gU5L3FW1RuMkSMCDeKXjH',NULL,'185.231.102.30','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicTlrU2N2SGE0Ym1FU2hqU0NDWUpJYTJ2b1Fwb0QyMzcyWmF5S29jRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9pZGVhZm9ybS1pbnZlbnRvcmkubXkuaWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791845637),('LURvJQ5RUPnyXQwCDKHZNb8JXSVC9i5KXcGOFNoI',NULL,'45.198.224.124','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46','YToyOntzOjY6Il90b2tlbiI7czo0MDoiNmlzRXh4NUFrdkFXbGk5Y2x4azM2WG96OGwxQWk3SGxNV1NwVVlPWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1791857734),('lwgj05CFPwQUaRjvvPaYetSxtYw4T1gOBfg6l5DA',NULL,'45.79.207.110','Mozilla/5.0 zgrab/0.x','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRFdwYnoyZ3l4Qm9jeHZVclpodTZXWFk1djNkSTdUWHo4NW9vTkt0ciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791837223),('lXUikHoMAmgqC8N5UgMUwN3eoC1c81bedp0Mvt0m',NULL,'45.79.181.223','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3h3dnFxNTkyTTY2UVM0S1NCakNsR29QMFRkZVBIaVNuWXZZWkFLVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791833821),('MhM1VGXNmYQ32hKmEmL8QnAd0aWAvz8m3iwNlI6N',NULL,'45.33.80.243','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2w0RXJKZ2hHRWJOUndlUG1yZDhUeG5VekZSYWF1Mlg2REJsWWdKMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791848020),('mivXoe9ePCaD60gPQx3rV1niFt0Gic9pzKh37jTt',NULL,'45.198.224.125','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:71.0) Gecko/20100101 Firefox/71.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNFJlbk9Sb1E2TDJyWFcxZmdKczR4WURJY2dWcHdveWpPc3l3SlJEayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791842060),('MRpQMJoyWKCTLjjfzNEGQQf9ZBTnryO352toSLmL',NULL,'45.33.14.5','Mozilla/5.0 zgrab/0.x','YTozOntzOjY6Il90b2tlbiI7czo0MDoicXlPTjY1aHlyc3c5dEhNWkNrRTd3M00xYVlQYnFhUXI5TExyZ1BRWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791844501),('mUVGWZO3h5LvJnLdL9cll5YIlOhozTU40IJa2ePx',NULL,'192.155.90.118','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiU3I0dDV5QlcyemRLYTNGOHFaVEdWYlJ5emJDTk5YZDNlWWw4SGtSaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791844540),('MX8HZw1mzUAsUbtLWnKDx5SBIjRerNPaWBW0Kk4M',NULL,'45.198.224.124','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46','YToyOntzOjY6Il90b2tlbiI7czo0MDoiWGk0TkpGQ0J6Z0ZreWtxNTNoMnd3d1FLQmJmNTNWVHFpVFBpOWxBcCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1791834048),('NbPJoM2XASB59vdr3s533FqepRq1HJ8se1oqy1Wl',NULL,'150.107.36.82','Mozilla/5.0 (X11; U; Linux x86_64; en-US) AppleWebKit/534.15 (KHTML, like Gecko) Chrome/10.0.613.0 Safari/534.15','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXJQTUdpN0VsSjZoWmh6UDVCeXliT1dPZGkzWE1NVllGd1QzdWFjTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791835458),('o8VLwOMQeQG995bzjKuSGU7WQioiHyYY58jPueTL',NULL,'34.62.173.117','Mozilla/5.0 (compatible)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWFVDTlNMczM1cjZTd2N0dlJkd044ckNzb2tLTWhnazMxMlNNVmExSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791863967),('oW4j91GFXbzFjRy7xcVlDSSr4mIG2ofl0cYPA2Pb',NULL,'79.127.129.199','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXVzeXJwb21mZjJpNG5hdk14R0RQM0Y5RmhpUlhiV1FaMXZPN1p3VyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9pZGVhZm9ybS1pbnZlbnRvcmkubXkuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791839360),('p4c9odVhTiXjfLW0EGOYAXpJ2qCHMl6FpPfLvCI6',NULL,'31.14.72.134','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoieG9BYklSeW50aElMU3QwRFFNZjhHazg4cVhzN2ZEMjFIa2J5RFl5ZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9pZGVhZm9ybS1pbnZlbnRvcmkubXkuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791854949),('PhzILwQPXfNu5KBBEDzpNmzrEzs4OcnB0Sbb3cLK',NULL,'205.169.39.57','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.5938.132 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVE5GbWZ0a3Jkb3hCRDZiV2xMT3RISTZvMHZqWE9VUlVxc3NOam90TiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791840556),('PNQSPL96iF8sW8JNwqPbxbWvFilQTfE52jLzwoxZ',NULL,'45.91.64.7','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Safari/602.1.50','YTozOntzOjY6Il90b2tlbiI7czo0MDoidkdVejZoRDBkYVlKbzVOMEI0UFNCZGJ1TUo3Q1V2VjBXakNUOU9CQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTQ6Imh0dHA6Ly8wLjAuMC4wIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791863948),('QA23gDL2UkDb3cBU1CSEqL5D46mPZACTujbQJBvb',NULL,'216.180.246.38','Mozilla/5.0 (compatible; GenomeCrawlerd/1.0; +https://www.nokia.com/genomecrawler)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiU3B6VjhwQ28wczVSRllrdW1aSGlqMVR2T2RUR1BqOE05cnpFWEhRbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTQ6Imh0dHA6Ly8wLjAuMC4wIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791865201),('qpdtXnMzXlD2WHm3D4ZIVvLpmOhashMd3fHkYOta',NULL,'35.94.87.181','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1FPZExRMzc4RnRqd01TOFJjdmVlTTI2U3dkN2lnUUhwN1EzZlI4SCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791858508),('qZclDz457HPUSaBWxifnBN56Luwoe1b2lJ0wMw4S',NULL,'45.33.14.5','Mozilla/5.0 zgrab/0.x','YTozOntzOjY6Il90b2tlbiI7czo0MDoiclpEQnBVWmdPWmFyUkRZakdISzE5RVZveldJOXRJbjBhOFM2RENrUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791847990),('SckktFPrtL9qWVbveyKCcPCRTxohgKiDdLm7iIeX',NULL,'134.209.112.176','Go Web Pentest Tool','YTozOntzOjY6Il90b2tlbiI7czo0MDoieVZra0NoTGJ3eFFaVWExVGNlWTlQRlFQaXhrR1ZKb3BEQ1p4cWdQYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly80My4xNzMuMjguODMvaW5kZXgucGhwP2xhbmc9ZW4iO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791861871),('sudcwNf6nHBgzn19U6KQPQqsMvIyN2yQkRiqfzAq',NULL,'164.90.200.32','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 ForestEngine/1.0 (+https://forestengine.net/#opt-out)','YTozOntzOjY6Il90b2tlbiI7czo0MDoieURzb09oWW85dDRyZnZvYW8yRzJ0VGw2SzZGVDY4NG5lOU16UGJObSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791866477),('SXhGpvaQiyPdb2aS0zyLpmN9u6lvodgbGGjfmXsH',NULL,'134.33.67.95','Mozilla/5.0 zgrab/0.x','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTWpUN2YyV0pIbmI2QUtXU3l1b3JVd2RLZGRFUnVUMk1hM3dRTkhCcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791854568),('T9CgcPhOGn2qikko36CclmFQ3rPhdQYsWsMug6qF',NULL,'192.155.90.118','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFRZWUZyblhOWnB2dzluVXg1YXZTcTlTc0lFNGFKSE1rRENPTUh5TyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791844539),('taabmhSDItqUbnwWyxbRwljwKOeWYJUkj3Om5b5h',NULL,'52.10.95.238','Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/126 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ1l2WEVMZm51UExnamVFU2VGQ0ZyMzFweFpSRWgwUEQzcE5ZTFNnUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9pZGVhZm9ybS1pbnZlbnRvcmkubXkuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791858004),('TE9WZPn8drEDejVnqXr57Ly8eCy7jmedkHArWfZv',NULL,'64.62.156.202','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUDg2NGVsRjNBNDNxeFVlQnJwcDlmdjlVb2xEU01rcnhrMjVOajVLNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791858776),('tzEXj01xp9z4TWohyqvWGJFngQ0n2SjkA82DlrOO',NULL,'79.127.129.199','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHNJUXRNUHBJYlhEUjdjdFhSMVE1UHBIOG83ano5aWNpbXFqNkxSMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9pZGVhZm9ybS1pbnZlbnRvcmkubXkuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791842397),('ualvwOmAAt1uScCevcweTuFKeldxQREVYgdjn136',NULL,'45.79.181.223','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaG9RdmZUejRMcnF4M0RBWG1wTlpSS2oyRFdwdWdLRUl6YVRXMThaZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791840966),('vhiEbjVLTEMtF22v5RcrhaDuIbHslAJTb7yd6XUX',NULL,'45.198.224.124','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46','YToyOntzOjY6Il90b2tlbiI7czo0MDoib2ZueFBlMGdZdm51NElrY0lwczZsWGk2aDZvWkZteE5lV0pMcVBwQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1791839400),('vHnH5zF4a45C1iarzPXGv8s1xc1awzZAQdLNp2Pt',NULL,'216.180.246.38','Mozilla/5.0 (compatible; GenomeCrawlerd/1.0; +https://www.nokia.com/genomecrawler)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2ZLWVVzWHFGY3M0M210THZMREFHWjBRcmROVlIwOFpDR25ON1Z5UiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791865379),('VQg6QuvH7TtiYit8ezp0nZRtb8FCxO1cGX6RiExU',NULL,'35.187.97.195','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTXZwQVl5Q2xGdXdhZ0N6MXdtTElkQUVXTFZqZDlZN2xpOVFsajlPeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791863965),('WRAqbOhrnJutEU13UsNUoVpm5HVMn7an7GB7chNE',NULL,'103.126.10.226','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGhaQzJkd3MxemwydGg0c0Zrd3ZaSzVhWTBGWEViaVRBZktUb2ZUdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTQ6Imh0dHA6Ly8wLjAuMC4wIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791842831),('WWbMgTo6E4IEJAZIcVi5NJdOrbBLtPhnNr4uzCtp',NULL,'138.68.153.47','Mozilla/5.0 zgrab/0.x','YTozOntzOjY6Il90b2tlbiI7czo0MDoieUNaVE9BdWlhOUxDVktQMDdzYUVyOWZ4UFNKYlhucklxeFJZUlE4QSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791849016),('Xl04ghNBlaB49aP8aZ0jphNPy3hWVNk41reyKqhw',NULL,'31.14.72.134','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoia2xnSXNpNlNkQzcyVlVoU2RwZ0RDb1k4N1c0VlduVWM0U3JOQjMxYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9pZGVhZm9ybS1pbnZlbnRvcmkubXkuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791855684),('xt8FOlF9KvixREgCMAeeDEVn9c1nhCByB8Z66e4B',NULL,'185.242.226.102','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMFNBeWdCaEVnRDlpQXVwa2EzWm1GdFdjeVJjNEhRWGNnRjl0SDRDWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791836938),('xZ8qjleM6ufXlO59E0fLhWY4HDD0NbURRllTSISh',NULL,'185.242.226.102','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGtWc2tMM3dSaVdiR3phcmpnaWdkbUFaQmVXbEl1OUZyVDRlMDJiTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791836936),('YECjXK7GgBN7rowbpalTQULui9yLftOuwVAIeVnr',NULL,'216.180.246.38','Mozilla/5.0 (compatible; GenomeCrawlerd/1.0; +https://www.nokia.com/genomecrawler)','YTozOntzOjY6Il90b2tlbiI7czo0MDoieVh0WElJMTFtYXI0NXpEdzhYOVVPVjNyVkY4YWRpcDEwQkY2Y3VwTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791865372),('yXfxjbGAkkfILiWfZCcKTGimhMYJdhOIPaqvkObm',NULL,'45.79.181.223','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRWRqWkhGMDFvdkI4SmZsMDNNMTRocUhlNXNKMnROWEJWOGIyblZxTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791833821),('ZIoV4NzMNjWDLGZfSUyduv5tb0wIfSThse4f6QHA',NULL,'172.236.228.202','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGhDNHVXNzZHWUJmVHZ1R0R4YXJxcENNaERndllwZVJ0ZFJybFVOMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly80My4xNzMuMjguODMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1791851886),('ZRZinMIzxoaHhmQY1WWYibeh3gdRBtbe6c569bwn',NULL,'172.105.128.12','Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoia2NjMVlYSFFmTFVPbWtnemdydnVjYmkwdk05b1pSN2NmbnpaOThxNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly80My4xNzMuMjguODMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1791837412);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('owner','kepala_gudang','admin_gudang') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin_gudang',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Staff Gudang','staffgudang','$2y$12$USv.XgZDqHhc1hrgmCCQ4uQYANA0k8fpQ7I2hpyTYIVABp4vXsrzW',NULL,'2026-10-07 04:04:04','2026-10-07 04:04:04','admin_gudang'),(2,'Owner','owner','$2y$12$legr0.jrjBQB0iT0nrUTqeoF/u.LjsS40n0XiRLGLh2TzQvP.alfq',NULL,'2026-10-07 04:04:04','2026-10-07 04:04:04','owner'),(3,'Kepala Gudang','kepalagudang','$2y$12$WmRSON7TMNgqdJ41qVaoo.SKAmeKfQl59TkdETCkggavspSJtlKgy',NULL,'2026-10-07 04:04:04','2026-10-07 04:04:04','kepala_gudang');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-13  4:47:37
