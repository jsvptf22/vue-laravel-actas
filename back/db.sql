-- MySQL dump 10.13  Distrib 8.0.17, for Linux (x86_64)
--
-- Host: localhost    Database: actas
-- ------------------------------------------------------
-- Server version	5.7.27

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_06_01_000001_create_oauth_auth_codes_table',2),(4,'2016_06_01_000002_create_oauth_access_tokens_table',2),(5,'2016_06_01_000003_create_oauth_refresh_tokens_table',2),(6,'2016_06_01_000004_create_oauth_clients_table',2),(7,'2016_06_01_000005_create_oauth_personal_access_clients_table',2);
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
INSERT INTO `oauth_access_tokens` VALUES ('000b100026fb0adc6cb6566add804c5337a4f1e6a5abfb20bab1c90018c56706643505347a152390',2,1,'Personal Access Token','[]',0,'2019-08-08 05:21:39','2019-08-08 05:21:39','2020-08-08 00:21:39'),('032876d977f055da8e1b0927c0a6f9f778bde636866544b9bdeb7a7352cff47348e1c0adcb63de95',NULL,3,NULL,'[]',0,'2019-08-12 01:34:39','2019-08-12 01:34:39','2020-08-11 20:34:39'),('0ca9b5133f7feee92d3686f73c691a4278ec1c8d39b0fff9de28ae1248c8c2d466dbc38d167c8016',2,1,'Personal Access Token','[]',0,'2019-08-08 05:27:01','2019-08-08 05:27:01','2020-08-08 00:27:01'),('2579cb5df2e20895f5a3c83bfca917c4c2c3df5eca0aa29112717d3ecf1a506f35adf49f1fca9c5f',2,1,'Personal Access Token','[]',0,'2019-08-08 06:55:45','2019-08-08 06:55:45','2020-08-08 01:55:45'),('38c89dbc03442d1ad4e0236b9cd0de9f84e5bda9f76dfc2ae77c765c5193328cf467ebce8761f2a9',2,1,'Personal Access Token','[]',0,'2019-08-06 08:09:04','2019-08-06 08:09:04','2020-08-06 03:09:04'),('4dbc009c3d63e1c3c97af92706f71c6bb522d9d92b09296ae44a9d7f071b035ad22a1e2e4f182eb8',2,1,'Personal Access Token','[]',0,'2019-08-13 05:57:29','2019-08-13 05:57:29','2020-08-13 00:57:29'),('547e1a29745eda208689c7a3b9af20a8b1287364ada6be79e73186448c5c8f43b592599e6fce04f1',2,1,'Personal Access Token','[]',1,'2019-08-06 07:11:35','2019-08-06 07:11:35','2020-08-06 02:11:35'),('569f3588cc96517e9509b2c03983068faef0ace2e2811b8ee04e889664a65d6cb5e71afb05826ceb',2,1,'Personal Access Token','[]',0,'2019-08-06 08:25:27','2019-08-06 08:25:27','2020-08-06 03:25:27'),('6ac597acbffe9cda28bbf8598f6dc4dbcad3aba2389fbf1a3f775b7d033bfab89c041b2d0da96627',2,1,'Personal Access Token','[]',0,'2019-08-06 08:24:01','2019-08-06 08:24:01','2020-08-06 03:24:01'),('72d2396b4681f2cd40dc19c014bdf379d15f35385e93f919c17fd8906259f668bbe7a5f7f64d7da7',2,1,'Personal Access Token','[]',0,'2019-08-12 01:02:11','2019-08-12 01:02:11','2020-08-11 20:02:11'),('77f92cf626a2714477b1e96bb55f72db1fec5395e871ccd381e26fe6f5ada4cead8964d43dbeef53',2,1,'Personal Access Token','[]',0,'2019-08-06 08:26:40','2019-08-06 08:26:40','2020-08-06 03:26:40'),('accd4e35f93e613b9b9c6c4a8b40f55f4a55528f78e193f67878f72fdff3006bf95b81617682fee5',2,1,'Personal Access Token','[]',0,'2019-08-08 06:56:13','2019-08-08 06:56:13','2020-08-08 01:56:13'),('b2214622b3f187c89f0f2c977203405ff2826631747d551884be0781c40f5d474db2b4f673ef4b7a',2,1,'Personal Access Token','[]',0,'2019-08-08 07:29:06','2019-08-08 07:29:06','2020-08-08 02:29:06'),('b8e87c8793042472a202c282d55278e18a0dd28301d6e8b78631e8121b61630a34cf0af53c954c86',2,1,'Personal Access Token','[]',0,'2019-08-08 06:56:57','2019-08-08 06:56:57','2020-08-08 01:56:57'),('bee266c2dcec2c1c44d5decd85d96d62c4b24653531e9cc6c08b1a50f356b1c8828ee130461cdcc2',2,1,'Personal Access Token','[]',0,'2019-08-08 07:10:08','2019-08-08 07:10:08','2020-08-08 02:10:08'),('c0bdf06657d376159efcd337486eecea5121d7befdb47ab2d5f01995eeeb9625444d91db6273aee5',2,1,'Personal Access Token','[]',0,'2019-08-08 06:51:00','2019-08-08 06:51:00','2020-08-08 01:51:00'),('c1d256f36898094a3ebcd910a59edc43c53fdb3e3552aa9f910b09b85028ed321e4b00ab55685ffc',2,1,'Personal Access Token','[]',0,'2019-08-06 08:08:49','2019-08-06 08:08:49','2020-08-06 03:08:49'),('dee21f4804a35ffb4f2f5262b5b75f3a50db76653eb524a27e1fd261d95f6cd7d44f50cd149a7080',2,1,'Personal Access Token','[]',0,'2019-08-06 08:24:47','2019-08-06 08:24:47','2020-08-06 03:24:47'),('e1e9982aa299e594f7ca00d1b82a23557188a60e3209c318d8747aa5d93273e081c2c6d13b4136b0',2,1,'Personal Access Token','[]',0,'2019-08-12 00:55:18','2019-08-12 00:55:18','2020-08-11 19:55:18'),('e6fe686c6fbd8454229cc0b6e7af9334713c1daf6b451e3294485165e8887862c085beb38d7a6915',2,1,'Personal Access Token','[]',0,'2019-08-08 06:54:28','2019-08-08 06:54:28','2020-08-08 01:54:28');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Laravel Personal Access Client','MGWKgrJJ2uBviEPsiwfwxUvKuexj3ZD1bROSDV4b','http://localhost',1,0,0,'2019-08-03 23:52:55','2019-08-03 23:52:55'),(2,NULL,'Laravel Password Grant Client','ToYI4xcWBePi7xPSeIkSE2S8XdCe9PPoCHpu6iCn','http://localhost',0,1,0,'2019-08-03 23:52:55','2019-08-03 23:52:55'),(3,NULL,'actas_front','2Xc99M18ff7uIAoTMd62NTErPJwEWXlSkKjuYLej','http://localhost',0,1,0,'2019-08-04 00:00:12','2019-08-04 00:00:12');
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
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2019-08-03 23:52:55','2019-08-03 23:52:55');
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
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'jhon sebastian valencia','sebasjsv97@gmail.com',NULL,'$2y$10$1wcpjx2Z2542uDFQgWWXFeyyyCioj2tDPxfOFm.xkjHvHM6qT2t8C',NULL,'2019-08-03 23:50:23','2019-08-03 23:50:23'),(2,'jhon valencia','sebasjsv22@gmail.com',NULL,'$2y$10$4F/wBMrAG4hCXD/hbgIC4eaTHjzNM38gRh5ULaxW9gdTvRApfU9py',NULL,'2019-08-06 07:09:34','2019-08-06 07:09:34');
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

-- Dump completed on 2019-08-19 11:19:27
