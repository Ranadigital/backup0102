-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: sindbad
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.22.04.1

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
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `first_heading` varchar(127) NOT NULL COMMENT 'first heading of banner',
  `second_heading` varchar(127) NOT NULL COMMENT 'second heading of banner',
  `button_link` varchar(127) DEFAULT NULL COMMENT 'button link',
  `baneer_image_name` varchar(127) NOT NULL COMMENT 'image name',
  `location` varchar(127) DEFAULT NULL COMMENT 'location',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 for active and 0 for inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'test','testing','','banner.jpg',NULL,0,'2022-10-31 02:55:35','2022-11-09 11:11:52'),(2,'Sindbad Gold and Silver Membership Just Got','Easier !','','1 (1).jpg',NULL,1,'2022-11-01 00:11:18','2022-11-11 10:43:55'),(3,'Extension of Sindbad Miles','Tier Status and Upgrade Vouchers','','2 (1).jpg',NULL,1,'2022-11-09 11:21:47','2022-11-11 10:44:00'),(4,'Pick a seat used your sindbad miles to pay for your','economy class seat of your choice','','3 (1).jpg',NULL,1,'2022-11-09 11:26:19','2022-11-11 10:44:04'),(5,'c','c jj','','Experiences_digital_banner.png',NULL,0,'2022-11-10 05:37:15','2022-11-10 05:37:48');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(127) NOT NULL COMMENT 'brand name',
  `brands_category_id` int NOT NULL COMMENT 'category_id ',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 for active and 0 for inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `brand_name` (`brand_name`),
  KEY `status` (`status`),
  KEY `brands_category_id` (`brands_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Brand',1,0,'2022-10-31 02:55:12','2022-11-11 06:27:38'),(2,'Chanel',2,0,'2022-11-01 00:16:39','2022-11-10 05:51:18'),(3,'JBL',3,0,'2022-11-01 00:51:02','2022-11-10 05:51:18'),(4,'testbrand',7,0,'2022-11-09 11:58:14','2022-11-10 05:51:19'),(5,'Acqua Di Parma',8,0,'2022-11-10 05:51:12','2022-11-11 06:27:38'),(6,'Denim',9,1,'2022-11-11 06:29:32','2022-11-11 06:29:32'),(7,'Rabbit',9,1,'2022-11-11 06:39:34','2022-11-11 06:40:01'),(8,'Aurelia',9,1,'2022-11-11 06:48:36','2022-11-11 06:48:36'),(9,'Levis',9,1,'2022-11-11 06:58:39','2022-11-11 07:08:14'),(10,'One Plus',10,1,'2022-11-11 07:28:42','2022-11-11 07:28:42'),(11,'Boat',10,1,'2022-11-11 07:28:50','2022-11-11 07:28:50'),(12,'Phillips',10,1,'2022-11-11 07:29:01','2022-11-11 07:29:01');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(127) NOT NULL COMMENT 'category name',
  `category_image_name` varchar(127) NOT NULL COMMENT 'category_image_name is category image',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 for active and 0 for inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_name` (`category_name`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Clothes','ICON4.png',0,'2022-10-31 02:54:24','2022-11-10 06:08:20'),(2,'Men & Women Fashion','Sindbad_Banner.png',0,'2022-11-01 00:13:24','2022-11-10 04:49:45'),(3,'Electronics','Sindbad_Banner.png',0,'2022-11-01 00:48:54','2022-11-10 04:49:45'),(4,'vbcbg','Group 19721.png',0,'2022-11-08 06:25:20','2022-11-08 06:46:10'),(5,'Sb Reward','Group 19729.png',0,'2022-11-08 06:46:39','2022-11-10 04:49:45'),(6,'llll','d9696-aaa.png',0,'2022-11-09 11:07:12','2022-11-09 11:32:47'),(7,'testcategory','Group 19860.png',0,'2022-11-09 11:56:24','2022-11-10 04:49:48'),(8,'Cosmetics / Make-up','makeup_composition_overhead-1200x628-facebook-1200x628.jpg',0,'2022-11-10 05:48:00','2022-11-11 06:37:21'),(9,'Mens & Women Fashion','18tmag-mixedshows-superJumbo.jpg',1,'2022-11-11 06:25:00','2022-11-11 06:25:00'),(10,'Electronics','19.jpg',1,'2022-11-11 07:26:22','2022-11-11 07:26:22'),(11,'lldgff','94168-Hero-banner--13---1-.png',1,'2022-11-11 11:32:16','2022-11-11 11:32:16');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_options`
--

DROP TABLE IF EXISTS `delivery_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `delivery_options` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `heading` varchar(127) NOT NULL COMMENT ' heading of delivery_options',
  `delivery_options_description` text COMMENT 'delivery_options_description',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 for active and 0 for inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_options`
--

LOCK TABLES `delivery_options` WRITE;
/*!40000 ALTER TABLE `delivery_options` DISABLE KEYS */;
INSERT INTO `delivery_options` VALUES (1,'delivery option','<p>sdfsffd</p>',0,'2022-10-31 02:55:53','2022-11-01 00:06:47'),(2,'twerwerw','<p>rewrewrwr</p>',0,'2022-11-01 00:19:19','2022-11-11 09:33:47'),(3,'Dubai, India','<p>.</p>',1,'2022-11-11 09:33:21','2022-11-11 09:34:20');
/*!40000 ALTER TABLE `delivery_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_details` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `arrival_or_departure_date` date DEFAULT NULL COMMENT 'arrival_or_departure_date',
  `estimated_time_departure_or_arrival` varchar(15) DEFAULT NULL COMMENT 'estimated_time_departure_or_arrival',
  `flight_no` varchar(127) NOT NULL COMMENT 'flight_no',
  `is_transict_customer` varchar(127) DEFAULT NULL COMMENT 'is_transict_customer',
  `point_of_collection` varchar(127) DEFAULT NULL COMMENT 'point_of_collection',
  `pickup_person` varchar(127) DEFAULT NULL COMMENT 'pickup_personn',
  `nominee_name` varchar(127) DEFAULT NULL COMMENT 'nominee_name',
  `order_comments` text COMMENT 'order_comments',
  `order_cost` varchar(63) DEFAULT NULL COMMENT 'order_cost',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 for active and 0 for inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `arrival_or_departure_date` (`arrival_or_departure_date`),
  KEY `estimated_time_departure_or_arrival` (`estimated_time_departure_or_arrival`),
  KEY `flight_no` (`flight_no`),
  KEY `is_transict_customer` (`is_transict_customer`),
  KEY `order_cost` (`order_cost`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES (1,'2023-08-09','00:00','gh5454','0','Arrivals Duty Free Shop','I will pick up the items','fgfgf','fgfdgfdgf','2000',0,'2022-10-31 03:14:00','2022-11-08 06:40:35'),(2,'2022-11-15','14:00','asdsads1232343','0','Arrivals Duty Free Shop','I will pick up the items','testing',NULL,'30268',0,'2022-11-08 06:37:09','2022-11-09 12:45:47'),(3,'2022-11-10','Please Select','sadas','Please Select','Arrivals Duty Free Shop','I will pick up the items','dadasd',NULL,'3450',0,'2022-11-09 11:11:24','2022-11-09 12:45:59'),(4,'2022-11-11','18:00','100102369','0','Arrivals Duty Free Shop','My nominee will pick up the items','Varun Mishra','On Time','48000',1,'2022-11-11 11:11:50','2022-11-11 11:11:50');
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_product_mappings`
--

DROP TABLE IF EXISTS `order_product_mappings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_product_mappings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL COMMENT 'order_id mapped with id table in orders table',
  `product_id` int NOT NULL COMMENT 'product_id mapped with id table in products table',
  `product_cost` varchar(15) NOT NULL COMMENT 'product_cost at the time of order',
  `product_count` varchar(15) NOT NULL COMMENT 'product_cost at the time of order',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 for active and 0 for inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_product_mappings`
--

LOCK TABLES `order_product_mappings` WRITE;
/*!40000 ALTER TABLE `order_product_mappings` DISABLE KEYS */;
INSERT INTO `order_product_mappings` VALUES (1,1,1,'2000','1',1,'2022-10-31 03:14:00','2022-10-31 03:14:00'),(2,2,3,'7567','4',1,'2022-11-08 06:37:09','2022-11-08 06:37:09'),(3,3,5,'3450','1',1,'2022-11-09 11:11:24','2022-11-09 11:11:24'),(4,4,14,'6000','8',1,'2022-11-11 11:11:50','2022-11-11 11:11:50');
/*!40000 ALTER TABLE `order_product_mappings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL COMMENT 'product_id mapped with id in products table',
  `image_name` varchar(127) NOT NULL COMMENT 'image_name',
  `is_prime` tinyint NOT NULL DEFAULT '1' COMMENT '1 for prime and 0 for non_prime',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 for active and 0 for inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (1,1,'return.png',1,1,'2022-10-31 02:56:59','2022-11-01 00:01:30'),(2,2,'shop.png',0,1,'2022-10-31 02:59:43','2022-10-31 03:02:17'),(3,2,'brand1.png',1,1,'2022-10-31 02:59:43','2022-10-31 03:02:17'),(4,3,'Sindbad_Banner.png',1,1,'2022-11-01 00:17:46','2022-11-01 00:22:49'),(5,3,'Sindbad_Banner.png',0,1,'2022-11-01 00:17:46','2022-11-01 00:22:49'),(6,3,'Sindbad_Banner.png',0,1,'2022-11-01 00:17:46','2022-11-01 00:22:49'),(7,4,'download.jpg',1,1,'2022-11-01 00:40:25','2022-11-01 01:01:26'),(8,4,'images.jpg',0,1,'2022-11-01 00:40:25','2022-11-01 01:01:27'),(9,5,'images (1).jpg',1,1,'2022-11-01 00:53:45','2022-11-01 00:53:55'),(10,5,'images (2).jpg',0,1,'2022-11-01 00:53:45','2022-11-01 00:53:55'),(11,6,'ssrco,lightweight_hoodie,womens,101010_01c5ca27c6,front,square_product,x600-bg,f8f8f8.1.jpg',0,1,'2022-11-09 11:43:24','2022-11-09 11:43:24'),(12,7,'ssrco,lightweight_hoodie,womens,101010_01c5ca27c6,front,square_product,x600-bg,f8f8f8.1.jpg',1,1,'2022-11-09 11:51:36','2022-11-09 11:53:25'),(13,8,'Image 619.png',1,1,'2022-11-09 11:59:08','2022-11-09 12:02:06'),(14,9,'ssrco,lightweight_hoodie,womens,101010_01c5ca27c6,front,square_product,x600-bg,f8f8f8.1.jpg',0,1,'2022-11-09 12:04:46','2022-11-09 12:04:46'),(15,10,'ssrco,lightweight_hoodie,womens,101010_01c5ca27c6,front,square_product,x600-bg,f8f8f8.1.jpg',0,1,'2022-11-09 12:04:46','2022-11-09 12:04:46'),(16,11,'d9696-aaa.png',0,1,'2022-11-09 12:12:35','2022-11-09 12:12:35'),(17,12,'fashion-designers-measuring-sewing-pattern-558270643-57bb7de45f9b58cdfd6043ae.jpg',0,1,'2022-11-09 12:23:20','2022-11-09 12:23:20'),(18,13,'41hE1qyp7jL.jpg',0,1,'2022-11-10 06:00:34','2022-11-11 06:37:04'),(19,14,'71goH4bDjAL._UY550_.jpg',1,1,'2022-11-11 06:33:20','2022-11-11 06:33:27'),(20,15,'IMG_0019_4_b8117d1c-0212-4ebd-809b-7f7903934fd9_765x.jpg',1,1,'2022-11-11 06:47:04','2022-11-11 06:47:15'),(21,16,'61IpGtpI5CL._UX679_.jpg',1,1,'2022-11-11 06:52:18','2022-11-11 06:52:41'),(22,17,'81OGu2HOTEL._UX569_.jpg',1,1,'2022-11-11 07:02:23','2022-11-11 07:02:41'),(23,17,'81IFFOxGt5L._UX569_.jpg',0,1,'2022-11-11 07:02:23','2022-11-11 07:02:41'),(24,18,'71iD6EzDt5L._UX569_ (1).jpg',1,1,'2022-11-11 07:07:30','2022-11-11 07:21:30'),(25,19,'61ahn9N38zL._SX679_.jpg',0,1,'2022-11-11 07:33:42','2022-11-11 07:33:49'),(26,19,'51-rpg9llBL._SX679_.jpg',0,1,'2022-11-11 07:33:42','2022-11-11 07:33:49'),(27,19,'51YgjWO013L._SX679_.jpg',0,1,'2022-11-11 07:33:42','2022-11-11 07:33:49'),(28,19,'51pGMKMvJbL._SX679_.jpg',1,1,'2022-11-11 07:33:42','2022-11-11 07:33:49'),(29,20,'61mD5YyWSrL._SX522_.jpg',0,1,'2022-11-11 09:07:35','2022-11-11 09:15:14'),(30,20,'71Vylj+MjOL._SX522_.jpg',0,1,'2022-11-11 09:07:35','2022-11-11 09:15:14'),(31,20,'71GH+h6BxyL._SX522_.jpg',0,1,'2022-11-11 09:07:35','2022-11-11 09:15:14'),(32,20,'li.jpg',0,1,'2022-11-11 09:12:39','2022-11-11 09:15:14'),(33,20,'li2.jpg',1,1,'2022-11-11 09:12:39','2022-11-11 09:15:14'),(34,20,'li3.jpg',0,1,'2022-11-11 09:12:39','2022-11-11 09:15:14'),(35,21,'ee.jpg',0,1,'2022-11-11 09:25:18','2022-11-11 09:25:45'),(36,21,'dsrf1.jpg',1,1,'2022-11-11 09:25:18','2022-11-11 09:25:45'),(37,21,'ee.jpg',0,1,'2022-11-11 09:25:18','2022-11-11 09:25:45'),(38,22,'11.jpg',1,1,'2022-11-11 11:01:28','2022-11-11 11:03:17'),(39,23,'22.jpg',0,1,'2022-11-11 11:08:36','2022-11-11 11:08:36');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL COMMENT 'produt_name mapped with id in category table ',
  `product_category_id` int NOT NULL COMMENT 'produt_category_id mapped with id in category table ',
  `product_subcategory_id` varchar(127) NOT NULL COMMENT 'product_subcategory_id mapped with id in sub_categories table',
  `product_brand_id` int NOT NULL COMMENT 'product_brand_id is mapped with id in brand table',
  `product_description` text NOT NULL COMMENT 'product description',
  `product_cost` varchar(127) NOT NULL COMMENT 'product_cost in miles',
  `product_color` varchar(31) DEFAULT NULL COMMENT 'product_color is color code of product',
  `product_size` varchar(31) DEFAULT NULL COMMENT 'product_size is size of the product',
  `parent_product_id` int NOT NULL DEFAULT '0' COMMENT 'parent_product_id mapped with id in same table ',
  `is_prime` tinyint NOT NULL DEFAULT '1' COMMENT '1 for prime and 0 for non_prime',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 for active and 0 for inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `product_category_id` (`product_category_id`),
  KEY `product_subcategory_id` (`product_subcategory_id`),
  KEY `product_brand_id` (`product_brand_id`),
  KEY `product_cost` (`product_cost`),
  KEY `product_color` (`product_color`),
  KEY `product_size` (`product_size`),
  KEY `parent_product_id` (`parent_product_id`),
  KEY `is_prime` (`is_prime`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Pent',1,'1',1,'<p>fdsfdsfdsfdsfdsfdsfdsfdsf</p>','2000','#f4f4f4','8 \'',0,1,0,'2022-10-31 02:56:59','2022-11-01 00:04:08'),(2,'eqwqw',1,'1',1,'<p>sadadfadasdasd</p>','33243','#fdfdfd','6',0,1,0,'2022-10-31 02:59:43','2022-11-01 00:04:07'),(3,'Men T-shirt',2,'2',2,'<p>miles</p>','7567','000000','42\'',0,1,0,'2022-11-01 00:17:46','2022-11-10 05:55:46'),(4,'Man shirt',2,'2',2,'<p>Miles&nbsp;</p>','3450','000000','520',0,1,0,'2022-11-01 00:40:25','2022-11-09 11:49:51'),(5,'Mobile',3,'3',3,'<p>MILES</p>','3450','000000','420',0,1,0,'2022-11-01 00:53:45','2022-11-10 05:55:46'),(6,'Women Dress',2,'5',2,'<p>Slim fit, so size up if you prefer a regular fit, or go two sizes up for a baggy fit</p>','500 Rial','Black','XL',0,1,0,'2022-11-09 11:43:24','2022-11-10 05:55:47'),(7,'Dress hoody',2,'5',2,'<p>Slim fit, so size up if you prefer a regular fit, or go two sizes up for a baggy fit</p>','500 miles','Black','XL',6,1,0,'2022-11-09 11:51:36','2022-11-10 05:55:48'),(8,'testproduct',7,'6',4,'<p>hgfwjefghjwegfjkhwegfhjwgfhkjwe</p>','6464','000000','35\"',0,1,0,'2022-11-09 11:59:08','2022-11-10 05:55:48'),(9,'loli',7,'6',4,'<p>dfsdf</p>','500','000000','XL',8,1,0,'2022-11-09 12:04:46','2022-11-10 05:55:49'),(10,'loli',7,'6',4,'<p>dfsdf</p>','500','000000','XL',8,1,0,'2022-11-09 12:04:46','2022-11-10 05:55:50'),(11,'mukesh',7,'6',4,'<p>DSFDF</p>','4000','00000','XL',8,1,0,'2022-11-09 12:12:35','2022-11-10 05:55:52'),(12,'Super Computer',7,'7',4,'<p>Hi</p>','50000','000000','300miles',11,1,0,'2022-11-09 12:23:20','2022-11-10 05:55:52'),(13,'Acqua-D-pharma',8,'8',5,'<p><strong>Acqua Di Parma Colonia Intensa Edc Spray 100 ml</strong></p>','5000','000000','100ML',0,0,0,'2022-11-10 06:00:34','2022-11-11 06:52:29'),(14,'Man T-Shirt',9,'9',6,'<p>T-shirts are the much-loved choice in any guy&#39;s wardrobe. Go casual the modish way with our exhaustive fleet of T-shirts for men, that encompasses ...</p>','6000','6F8FAF','XL',0,1,1,'2022-11-11 06:33:20','2022-11-11 06:33:20'),(15,'Rabbit Man Long-Sleev',9,'9',7,'<p>Designed for everyday wear, from the office to date night.</p>','6500','000000','XL',0,1,0,'2022-11-11 06:47:04','2022-11-11 11:08:32'),(16,'BIBA Printed Round Neck Straig',9,'8',8,'<p>BIBA Printed Round Neck Straight Fit Kurta for Womens</p>','7500','FFC0CB','XL',0,1,0,'2022-11-11 06:52:18','2022-11-11 11:03:15'),(17,'Levis Women',9,'8',9,'<p>TKL Knits India Private Limited, TKL Knits India Private Limited, CRPF Road, Rakkipalayam Pirivu, Thoppampatti (po), Sf No.577 &amp; 585, 641017 Coimbatore, India</p>','780000','800000','S',0,1,1,'2022-11-11 07:02:23','2022-11-11 07:21:07'),(18,'Levis  Black T-shirt',9,'8',9,'<p>TKL KNITS INDIA PRIVATE LIMITED, TKL KNITS INDIA PRIVATE LIMITED CRPF ROAD, RAKKIPALAYAM PIRIVU THOPPAMPATTI (PO) SF NO.577 &amp; 585 641017 COIMBATORE INDIA</p>','690000','000000','XL',0,1,1,'2022-11-11 07:07:30','2022-11-11 07:21:14'),(19,'OnePlus Nord 2T 5G',10,'10',10,'<p>Camera: 50MP Main Camera with Sony IMX766 and OIS, 8MP Ultrawide Camera with 120 degree FOV and 2MP mono lens with&nbsp;Dual LED Flash; 32MP Front (Selfie) Camera with Sony IMX615</p>','950000','00a86b','8GB RAM',0,1,1,'2022-11-11 07:33:42','2022-11-11 07:33:42'),(20,'boAt Rockerz 450',10,'11',11,'<p>boAt Rockerz 450 is an on-ear wireless headset that has been ergonomically designed to meet the needs of music lovers. The headphones come equipped with Bluetooth for instant wireless connectivity. Its powerful 300mAh battery provides a playtime of up to 8 hours for an extended audio bliss. Its 40mm dynamic drivers help supply immersive musical experience to the user with immersive sound. The user can utilize the headset via dual connectivity in the form of Bluetooth and AUX. The ergonomically styled on-ear headphone is equipped with adjustable comfortable earcups to provide that ultimate comfortable listening time.</p>','589600','FF0000','17 x 8.2 x 18.2 cm',0,1,1,'2022-11-11 09:07:35','2022-11-11 09:13:45'),(21,'Electronic Appliances',10,'12',12,'<p>5 Directional Pivot and Flex Heads Follow Curves for a Comfortable Shave<br />\r\n27 Self-sharpening Powercut Blades for Long Lasting Performance<br />\r\nSkin Protection System Gives You a Clean Wet Shave That doesn&#39;t Damage Your Skin<br />\r\nIn-built Pop up Trimmer for Maintaining Mustache and Trimming Sideburns<br />\r\nUp to 55 Mins Shaving With 1 Hour Charging<br />\r\n1-level Battery Indicator to Get the Best from the Shaver<br />\r\n5 Min Fast Charge for 1 Full Shave</p>','75600','000000','7.2 x 16 x 23.4 cm',0,1,1,'2022-11-11 09:25:18','2022-11-11 09:25:18'),(22,'BIBA Printed Round Neck Strai',9,'8',8,'<p>BIBA Printed Round Neck Straight Fit Kurta for Womens</p>','7500','FFC0CB','XL',0,1,1,'2022-11-11 11:01:28','2022-11-11 11:03:01'),(23,'Rabbit Man Long-Sleev',9,'9',7,'<p>Designed for everyday wear, from the office to date night.</p>','6500','000000','XL',0,1,1,'2022-11-11 11:08:36','2022-11-11 11:08:36');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `sub_category_name` varchar(127) NOT NULL COMMENT 'category name',
  `category_id` int NOT NULL COMMENT 'category_id mapped with id in category table',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 for active and 0 for inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `sub_category_name` (`sub_category_name`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_categories`
--

LOCK TABLES `sub_categories` WRITE;
/*!40000 ALTER TABLE `sub_categories` DISABLE KEYS */;
INSERT INTO `sub_categories` VALUES (1,'Men',8,0,'2022-10-31 02:54:56','2022-11-10 05:49:09'),(2,'Men',2,0,'2022-11-01 00:14:15','2022-11-10 05:48:18'),(3,'Mobile',3,0,'2022-11-01 00:49:42','2022-11-10 05:48:18'),(4,'Shoes',5,0,'2022-11-08 06:47:45','2022-11-10 05:48:19'),(5,'Women\'s dress',2,0,'2022-11-09 11:33:55','2022-11-10 05:48:19'),(6,'testsub',7,0,'2022-11-09 11:56:43','2022-11-10 05:48:20'),(7,'CPU',7,0,'2022-11-09 12:21:51','2022-11-10 05:48:21'),(8,'Womens',9,1,'2022-11-10 05:48:50','2022-11-11 06:26:58'),(9,'Mens',9,1,'2022-11-11 06:26:43','2022-11-11 06:26:43'),(10,'Mobiles',10,1,'2022-11-11 07:26:45','2022-11-11 07:26:45'),(11,'Headphones',10,1,'2022-11-11 07:27:01','2022-11-11 07:27:01'),(12,'Electronic Appliances',10,1,'2022-11-11 07:27:45','2022-11-11 07:27:45');
/*!40000 ALTER TABLE `sub_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@sbreward.com',NULL,'$2y$10$FWLw.avMmcbmI8GfuD/s/OjDx6gxm/ByVT/3cLB5hQn6tpkS3EPC6',NULL,'2022-10-13 07:00:50','2022-10-13 07:00:50'),(2,'Rana','mukesh@experiences.digital',NULL,'Rana626@@#',NULL,NULL,NULL);
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

-- Dump completed on 2022-11-11 18:54:57
