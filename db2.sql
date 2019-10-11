-- MySQL dump 10.13  Distrib 8.0.17, for Linux (x86_64)
--
-- Host: localhost    Database: actas
-- ------------------------------------------------------
-- Server version	8.0.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `act_document`
--

DROP TABLE IF EXISTS `act_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `act_document` (
  `idact_document` int(11) NOT NULL AUTO_INCREMENT,
  `identificator` varchar(45) DEFAULT '0',
  `subject` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idact_document`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `act_document`
--

LOCK TABLES `act_document` WRITE;
/*!40000 ALTER TABLE `act_document` DISABLE KEYS */;
INSERT INTO `act_document` VALUES (1,'0','un asunto','2019-09-08 19:34:40','2019-09-08 19:34:40'),(2,'0','asd','2019-09-24 05:33:22','2019-09-24 05:33:22'),(3,'0','lllllllllllllllllll','2019-09-24 05:40:59','2019-09-24 05:40:59'),(4,'0','AASAsaS','2019-09-24 05:45:30','2019-09-24 05:45:30'),(5,'0','hjklñ','2019-09-24 05:51:51','2019-09-24 05:51:51'),(6,'0','wwwwwww','2019-09-24 05:52:13','2019-09-24 05:52:13'),(7,'0','asd','2019-09-24 06:09:53','2019-09-24 06:09:53'),(8,'0','asunto de pruebas','2019-09-24 06:15:44','2019-09-24 06:15:44'),(9,'0',NULL,'2019-09-24 06:58:26','2019-09-24 06:58:26'),(10,'0','asunto','2019-09-25 04:28:16','2019-09-25 04:28:16'),(11,'0','qwe','2019-10-02 06:55:45','2019-10-02 06:55:45'),(12,'0','OTRA PRUEBA','2019-10-02 06:57:40','2019-10-02 07:38:36'),(13,'0','asunto de pruebas 2','2019-10-05 04:12:47','2019-10-05 04:12:47'),(14,'0','aunasdjkahsdaks ashdkasjk dhka','2019-10-05 04:22:25','2019-10-05 04:22:25');
/*!40000 ALTER TABLE `act_document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `act_document_topic`
--

DROP TABLE IF EXISTS `act_document_topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `act_document_topic` (
  `idact_document_topic` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text,
  `fk_act_document` int(11) NOT NULL,
  `state` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idact_document_topic`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `act_document_topic`
--

LOCK TABLES `act_document_topic` WRITE;
/*!40000 ALTER TABLE `act_document_topic` DISABLE KEYS */;
INSERT INTO `act_document_topic` VALUES (1,'tema1','1111111111',1,1,'2019-09-08 19:34:41','2019-09-08 19:35:30'),(2,'tema2','2',1,1,'2019-09-08 19:34:41','2019-09-08 19:35:29'),(3,'tema3','3',1,1,'2019-09-08 19:34:41','2019-09-08 19:35:30'),(4,'a','aaaaaaaaaaa',8,1,'2019-09-24 06:15:45','2019-09-24 06:53:49'),(5,'b','bbbbbbbbbbbbbb',8,1,'2019-09-24 06:15:45','2019-09-24 06:53:49'),(6,'c','cc',8,1,'2019-09-24 06:15:45','2019-09-24 06:53:50'),(7,'asdasd','bbbbbbbbbbbbbbbbbb',14,1,'2019-10-05 04:22:25','2019-10-05 04:22:25'),(8,'asdasd','sdfsdfsd',14,1,'2019-10-05 04:22:25','2019-10-05 04:22:26'),(9,'asdadds',NULL,14,1,'2019-10-05 04:22:25','2019-10-05 04:22:25');
/*!40000 ALTER TABLE `act_document_topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `act_document_user`
--

DROP TABLE IF EXISTS `act_document_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `act_document_user` (
  `idact_document_user` int(11) NOT NULL AUTO_INCREMENT,
  `relation_type` int(11) NOT NULL,
  `state` int(11) DEFAULT '1',
  `user_identification` varchar(45) NOT NULL,
  `fk_act_document` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idact_document_user`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `act_document_user`
--

LOCK TABLES `act_document_user` WRITE;
/*!40000 ALTER TABLE `act_document_user` DISABLE KEYS */;
INSERT INTO `act_document_user` VALUES (1,1,1,'1-0',1,'2019-09-08 19:34:40','2019-09-08 19:34:40'),(2,2,1,'1-0',1,'2019-09-08 19:34:41','2019-09-08 19:35:29'),(3,2,1,'1-1',1,'2019-09-08 19:34:41','2019-09-08 19:35:29'),(4,2,1,'2-1',1,'2019-09-08 19:34:41','2019-09-08 19:35:29'),(5,1,1,'1-0',2,'2019-09-24 05:33:22','2019-09-24 05:33:22'),(6,1,1,'1-0',3,'2019-09-24 05:40:59','2019-09-24 05:40:59'),(7,1,1,'1-0',4,'2019-09-24 05:45:30','2019-09-24 05:45:30'),(8,1,1,'1-0',5,'2019-09-24 05:51:51','2019-09-24 05:51:51'),(9,1,1,'1-0',6,'2019-09-24 05:52:14','2019-09-24 05:52:14'),(10,1,1,'1-0',7,'2019-09-24 06:09:53','2019-09-24 06:09:53'),(11,1,1,'1-0',8,'2019-09-24 06:15:44','2019-09-24 06:15:44'),(12,2,1,'1-0',8,'2019-09-24 06:15:44','2019-09-24 06:53:49'),(13,2,1,'2-1',8,'2019-09-24 06:15:44','2019-09-24 06:53:49'),(14,1,1,'1-0',9,'2019-09-24 06:58:26','2019-09-24 06:58:26'),(15,1,1,'1-0',10,'2019-09-25 04:28:16','2019-09-25 04:28:16'),(16,1,1,'1-0',11,'2019-10-02 06:55:45','2019-10-02 06:55:45'),(17,1,1,'1-0',12,'2019-10-02 06:57:40','2019-10-02 06:57:40'),(18,1,1,'1-0',13,'2019-10-05 04:12:47','2019-10-05 04:12:47'),(19,1,1,'1-0',14,'2019-10-05 04:22:25','2019-10-05 04:22:25');
/*!40000 ALTER TABLE `act_document_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `act_external_user`
--

DROP TABLE IF EXISTS `act_external_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `act_external_user` (
  `idact_external_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `secondname` varchar(100) DEFAULT NULL,
  `firstlastname` varchar(100) DEFAULT NULL,
  `secondlastname` varchar(100) DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idact_external_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `act_external_user`
--

LOCK TABLES `act_external_user` WRITE;
/*!40000 ALTER TABLE `act_external_user` DISABLE KEYS */;
INSERT INTO `act_external_user` VALUES (1,'sebasjsv97@gmail.com','jhon valencia',NULL,'',NULL,1,'2019-09-08 19:33:44','2019-09-08 19:33:44'),(2,'','katerine e',NULL,'',NULL,1,'2019-09-08 19:34:05','2019-09-08 19:34:05');
/*!40000 ALTER TABLE `act_external_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2016_06_01_000001_create_oauth_auth_codes_table',1),(2,'2016_06_01_000002_create_oauth_access_tokens_table',1),(3,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(4,'2016_06_01_000004_create_oauth_clients_table',1),(5,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(6,'2019_08_29_023422_create_users_view',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('44caaf737832722c0c4f4f8a520acb159f94e9f042acb034f09f424872edc3828a8d6269bc5892b6',1,1,'Personal Access Token','[]',0,'2019-09-24 05:31:08','2019-09-24 05:31:08','2020-09-24 00:31:08'),('8bf1066c039e181d05f4bcc8c7fd18f116ce6384f267498991b5aca017cd3a1a9e5d7e1d5dc2e948',1,1,'Personal Access Token','[]',0,'2019-10-05 04:20:38','2019-10-05 04:20:38','2020-10-04 23:20:38'),('8c2099a8baaeaa0cd33ab1fd2196d5c04cc4db23c09a3202e3ea02847617da95f7f229c15c319e44',1,1,'Personal Access Token','[]',0,'2019-09-25 04:28:05','2019-09-25 04:28:05','2020-09-24 23:28:05'),('9dea20b8251f423d6a4197db414dcbd6515e618c93e51db0389d2417dd4344c4820d9fa5cb888b5a',1,1,'Personal Access Token','[]',0,'2019-10-02 06:52:11','2019-10-02 06:52:11','2020-10-02 01:52:11'),('ba94677b2b7ce32a10492d5616596050f79babae31a4a2cded0f13b86e2de8eaf325760fae0a4f0d',1,1,'Personal Access Token','[]',0,'2019-10-11 06:19:55','2019-10-11 06:19:55','2020-10-11 01:19:55'),('c22c964be6e33c407c6d543e04d96f3d7901cde5be8c8cdc6794849144ff43a8beecb73cd43fca4f',1,1,'Personal Access Token','[]',0,'2019-10-05 04:35:57','2019-10-05 04:35:57','2020-10-04 23:35:57'),('cc1615304cc18beb46ee020fc3ad911392c16725a0f8b9feff793debb09d33c029a48e63d44223ff',1,1,'Personal Access Token','[]',0,'2019-09-08 19:33:15','2019-09-08 19:33:15','2020-09-08 14:33:15'),('e5910c4be6664baf8078fdfb3b1432f906a78d8f791abebe6b10eefcb6e1e1b32f4570f7b453fdc4',1,1,'Personal Access Token','[]',0,'2019-10-05 04:11:02','2019-10-05 04:11:02','2020-10-04 23:11:02'),('ef2b8fd1e6ef1221cd5720a932c1fbb9820c0b86be5f48205efac580f3106c1f25f3724191308210',1,1,'Personal Access Token','[]',0,'2019-09-25 04:28:04','2019-09-25 04:28:04','2020-09-24 23:28:04');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'ACTAS Personal Access Client','y6F8LvJsNyi7d9uwZwTpMEdCUewlZf4rmoSqJmHW','http://localhost',1,0,0,'2019-09-08 19:00:43','2019-09-08 19:00:43'),(2,NULL,'ACTAS Password Grant Client','ewNFZS0HXRLNZjMXJYnnba7nhn17K5wJYc59au76','http://localhost',0,1,0,'2019-09-08 19:00:43','2019-09-08 19:00:43');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2019-09-08 19:00:43','2019-09-08 19:00:43');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `s_user`
--

DROP TABLE IF EXISTS `s_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `s_user` (
  `ids_user` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `secondname` varchar(100) DEFAULT NULL,
  `firstlastname` varchar(100) DEFAULT NULL,
  `secondlastname` varchar(100) DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ids_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `s_user`
--

LOCK TABLES `s_user` WRITE;
/*!40000 ALTER TABLE `s_user` DISABLE KEYS */;
INSERT INTO `s_user` VALUES (1,'sebasjsv22@gmail.com','$2y$10$RUE6Dir6T2AEGlVYf.q67OYDui.3gmrUhjej2IJ3kemyWxfmNwfUq','sebasjsv22@gmail.com','jhon','sebastian','valencia','perez',1,'2019-09-08 14:31:16',NULL);
/*!40000 ALTER TABLE `s_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `v_act_user`
--

DROP TABLE IF EXISTS `v_act_user`;
/*!50001 DROP VIEW IF EXISTS `v_act_user`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_act_user` AS SELECT 
 1 AS `id`,
 1 AS `login`,
 1 AS `email`,
 1 AS `password`,
 1 AS `complete_name`,
 1 AS `firstname`,
 1 AS `secondname`,
 1 AS `firstlastname`,
 1 AS `secondlastname`,
 1 AS `state`,
 1 AS `created_at`,
 1 AS `updated_at`,
 1 AS `external`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `v_act_user`
--

/*!50001 DROP VIEW IF EXISTS `v_act_user`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_act_user` AS (select concat(`s_user`.`ids_user`,'-',0) AS `id`,`s_user`.`login` AS `login`,`s_user`.`email` AS `email`,`s_user`.`password` AS `password`,concat_ws(' ',`s_user`.`firstname`,`s_user`.`secondname`,`s_user`.`firstlastname`,`s_user`.`secondlastname`) AS `complete_name`,`s_user`.`firstname` AS `firstname`,`s_user`.`secondname` AS `secondname`,`s_user`.`firstlastname` AS `firstlastname`,`s_user`.`secondlastname` AS `secondlastname`,`s_user`.`state` AS `state`,`s_user`.`created_at` AS `created_at`,`s_user`.`updated_at` AS `updated_at`,0 AS `external` from `s_user`) union (select concat(`act_external_user`.`idact_external_user`,'-',1) AS `id`,'' AS `login`,`act_external_user`.`email` AS `email`,'' AS `password`,concat_ws(' ',`act_external_user`.`firstname`,`act_external_user`.`secondname`,`act_external_user`.`firstlastname`,`act_external_user`.`secondlastname`) AS `complete_name`,`act_external_user`.`firstname` AS `firstname`,`act_external_user`.`secondname` AS `secondname`,`act_external_user`.`firstlastname` AS `firstlastname`,`act_external_user`.`secondlastname` AS `secondlastname`,`act_external_user`.`state` AS `state`,`act_external_user`.`created_at` AS `created_at`,`act_external_user`.`updated_at` AS `updated_at`,1 AS `external` from `act_external_user`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-11  7:19:50
