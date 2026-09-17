-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: garage_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2026_09_02_201333_create_vehicules_table',2),(6,'2026_09_02_201349_create_reparations_table',2),(7,'2026_09_02_201357_create_techniciens_table',2),(8,'2026_09_02_201408_create_reparation_technicien_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
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
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reparation_technicien`
--

DROP TABLE IF EXISTS `reparation_technicien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reparation_technicien` (
  `reparation_id` bigint(20) unsigned NOT NULL,
  `technicien_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`reparation_id`,`technicien_id`),
  KEY `reparation_technicien_technicien_id_foreign` (`technicien_id`),
  CONSTRAINT `reparation_technicien_reparation_id_foreign` FOREIGN KEY (`reparation_id`) REFERENCES `reparations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reparation_technicien_technicien_id_foreign` FOREIGN KEY (`technicien_id`) REFERENCES `techniciens` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reparation_technicien`
--

LOCK TABLES `reparation_technicien` WRITE;
/*!40000 ALTER TABLE `reparation_technicien` DISABLE KEYS */;
INSERT INTO `reparation_technicien` VALUES (1,2),(1,4),(1,5),(2,3),(3,1),(4,5),(5,4),(6,2),(6,3),(6,4),(7,2),(7,4),(8,1),(8,4),(8,5),(9,1),(9,3),(9,5),(10,1),(10,5),(12,2),(12,4),(12,5);
/*!40000 ALTER TABLE `reparation_technicien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reparations`
--

DROP TABLE IF EXISTS `reparations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reparations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vehicule_id` bigint(20) unsigned NOT NULL,
  `date` date NOT NULL,
  `duree_main_oeuvre` decimal(5,2) NOT NULL,
  `objet_reparation` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reparations_vehicule_id_foreign` (`vehicule_id`),
  CONSTRAINT `reparations_vehicule_id_foreign` FOREIGN KEY (`vehicule_id`) REFERENCES `vehicules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reparations`
--

LOCK TABLES `reparations` WRITE;
/*!40000 ALTER TABLE `reparations` DISABLE KEYS */;
INSERT INTO `reparations` VALUES (1,11,'2012-02-23',6.00,'Changement des pneus','2026-09-02 20:40:10','2026-09-02 20:40:10'),(2,12,'2020-04-22',2.00,'Vidange et entretien général','2026-09-02 20:40:10','2026-09-02 20:40:10'),(3,13,'2016-12-14',10.00,'Remplacement de la batterie','2026-09-02 20:40:10','2026-09-02 20:40:10'),(4,14,'2020-08-25',11.00,'Remplacement de la batterie','2026-09-02 20:40:10','2026-09-02 20:40:10'),(5,15,'1979-10-17',12.00,'Changement des pneus','2026-09-02 20:40:10','2026-09-02 20:40:10'),(6,16,'1974-09-04',11.00,'Réparation de la climatisation','2026-09-02 20:40:10','2026-09-02 20:40:10'),(7,17,'2012-02-11',9.00,'Vidange et entretien général','2026-09-02 20:40:10','2026-09-02 20:40:10'),(8,18,'1976-11-19',4.00,'Réparation de la climatisation','2026-09-02 20:40:10','2026-09-02 20:40:10'),(9,19,'1989-05-12',2.00,'Réparation du moteur','2026-09-02 20:40:10','2026-09-02 20:40:10'),(10,20,'1974-05-30',7.00,'Changement des pneus','2026-09-02 20:40:10','2026-09-02 20:40:10'),(12,12,'2026-09-02',6.00,'Révision complète et entretien du véhicule','2026-09-02 22:13:19','2026-09-02 22:13:19');
/*!40000 ALTER TABLE `reparations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `techniciens`
--

DROP TABLE IF EXISTS `techniciens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `techniciens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `specialite` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `techniciens`
--

LOCK TABLES `techniciens` WRITE;
/*!40000 ALTER TABLE `techniciens` DISABLE KEYS */;
INSERT INTO `techniciens` VALUES (1,'Schinner','Haylie','Électricité automobile','2026-09-02 20:40:02','2026-09-02 20:40:02'),(2,'Rau','Yasmeen','Climatisation automobile','2026-09-02 20:40:02','2026-09-02 20:40:02'),(3,'Boyer','Amaya','Carrosserie','2026-09-02 20:40:02','2026-09-02 20:40:02'),(4,'Reilly','Suzanne','Mécanique générale','2026-09-02 20:40:02','2026-09-02 20:40:02'),(5,'Streich','Roxanne','Carrosserie','2026-09-02 20:40:02','2026-09-02 20:40:02');
/*!40000 ALTER TABLE `techniciens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicules`
--

DROP TABLE IF EXISTS `vehicules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `immatriculation` varchar(255) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `modele` varchar(255) NOT NULL,
  `couleur` varchar(255) NOT NULL,
  `annee` year(4) NOT NULL,
  `kilometrage` int(10) unsigned NOT NULL,
  `carrosserie` varchar(255) NOT NULL,
  `energie` varchar(255) NOT NULL,
  `boite` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vehicules_immatriculation_unique` (`immatriculation`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicules`
--

LOCK TABLES `vehicules` WRITE;
/*!40000 ALTER TABLE `vehicules` DISABLE KEYS */;
INSERT INTO `vehicules` VALUES (1,'df-624-tx','Peugeot','Golf','Gris',2023,85487,'Coupé','Essence','Manuelle','2026-09-02 20:39:51','2026-09-02 20:39:51'),(2,'oy-810-iq','Renault','Golf','Rouge',2022,176324,'Citadine','Essence','Automatique','2026-09-02 20:39:51','2026-09-02 20:39:51'),(3,'zf-366-cl','Mercedes','Civic','Gris',2019,109331,'Berline','Hybride','Manuelle','2026-09-02 20:39:51','2026-09-02 20:39:51'),(4,'qs-545-pl','Ford','Focus','Rouge',2015,184631,'Berline','Diesel','Manuelle','2026-09-02 20:39:51','2026-09-02 20:39:51'),(5,'nn-190-kw','Ford','Corolla','Gris',2018,189513,'Break','Électrique','Manuelle','2026-09-02 20:39:51','2026-09-02 20:39:51'),(6,'oi-147-ey','Peugeot','Civic','Noir',2015,168937,'Coupé','Diesel','Automatique','2026-09-02 20:39:51','2026-09-02 20:39:51'),(7,'vl-204-ym','Hyundai','Clio','Rouge',2020,225575,'SUV','Électrique','Manuelle','2026-09-02 20:39:51','2026-09-02 20:39:51'),(8,'ll-047-lq','Ford','Clio','Noir',2016,80839,'Berline','Électrique','Manuelle','2026-09-02 20:39:51','2026-09-02 20:39:51'),(9,'pz-287-df','Peugeot','308','Gris',2016,214699,'Berline','Essence','Automatique','2026-09-02 20:39:51','2026-09-02 20:39:51'),(10,'am-716-uo','Ford','Corolla','Rouge',2023,224101,'Coupé','Électrique','Automatique','2026-09-02 20:39:51','2026-09-02 20:39:51'),(11,'xr-602-vp','Toyota','Corolla','Gris',2021,120927,'Citadine','Hybride','Manuelle','2026-09-02 20:40:10','2026-09-02 20:40:10'),(12,'di-012-an','Renault','Focus','Rouge',2025,117088,'Coupé','Diesel','Automatique','2026-09-02 20:40:10','2026-09-02 20:40:10'),(13,'bb-418-rw','Peugeot','Clio','Blanc',2025,241053,'Break','Hybride','Manuelle','2026-09-02 20:40:10','2026-09-02 20:40:10'),(14,'wo-441-pl','Renault','308','Noir',2021,202448,'Break','Essence','Automatique','2026-09-02 20:40:10','2026-09-02 20:40:10'),(15,'gt-176-ow','Mercedes','308','Gris',2022,148924,'Coupé','Hybride','Automatique','2026-09-02 20:40:10','2026-09-02 20:40:10'),(16,'xe-491-rc','Hyundai','Focus','Gris',2015,215240,'Coupé','Hybride','Manuelle','2026-09-02 20:40:10','2026-09-02 20:40:10'),(17,'qt-091-tp','Renault','Civic','Blanc',2025,43290,'Coupé','Essence','Automatique','2026-09-02 20:40:10','2026-09-02 20:40:10'),(18,'bj-807-ci','Mercedes','Golf','Noir',2017,220040,'Break','Essence','Automatique','2026-09-02 20:40:10','2026-09-02 20:40:10'),(19,'zl-643-fx','Mercedes','Corolla','Rouge',2019,105633,'Coupé','Essence','Automatique','2026-09-02 20:40:10','2026-09-02 20:40:10'),(20,'bc-724-jz','Renault','Focus','Bleu',2022,90000,'Citadine','Essence','Manuelle','2026-09-02 20:40:10','2026-09-02 21:30:42');
/*!40000 ALTER TABLE `vehicules` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-03 18:59:58
