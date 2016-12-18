-- MySQL dump 10.13  Distrib 5.6.30, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: quickserve
-- ------------------------------------------------------
-- Server version	5.6.30-1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `sperixla_quickservice`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `sperixla_quickservice` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sperixla_quickservice`;

--
-- Table structure for table `active`
--

DROP TABLE IF EXISTS `active`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `active` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `active`
--

LOCK TABLES `active` WRITE;
/*!40000 ALTER TABLE `active` DISABLE KEYS */;
INSERT INTO `active` VALUES (1,'admin',0),(2,'',0);
/*!40000 ALTER TABLE `active` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appconfig`
--

DROP TABLE IF EXISTS `appconfig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appconfig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` varchar(200) DEFAULT NULL,
  `appkey` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appconfig`
--

LOCK TABLES `appconfig` WRITE;
/*!40000 ALTER TABLE `appconfig` DISABLE KEYS */;
INSERT INTO `appconfig` VALUES (1,'GOHiVHV7NPvX290O5EIG4QEuPxUuV0n9EjeGycUf','kG6fpw9ovXUQhBc23nSqoRwZFYiBeAdavKOWvCSx');
/*!40000 ALTER TABLE `appconfig` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `continental`
--

DROP TABLE IF EXISTS `continental`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `continental` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `continental`
--

LOCK TABLES `continental` WRITE;
/*!40000 ALTER TABLE `continental` DISABLE KEYS */;
INSERT INTO `continental` VALUES (13,'Potato Chips with chicken','15.00','2016-12-18 10:01:29');
/*!40000 ALTER TABLE `continental` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dp`
--

DROP TABLE IF EXISTS `dp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `image` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dp`
--

LOCK TABLES `dp` WRITE;
/*!40000 ALTER TABLE `dp` DISABLE KEYS */;
INSERT INTO `dp` VALUES (1,'admin','20161113045242.png');
/*!40000 ALTER TABLE `dp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `externalorders`
--

DROP TABLE IF EXISTS `externalorders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `externalorders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `persons` varchar(100) DEFAULT NULL,
  `location` text,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `externalorders`
--

LOCK TABLES `externalorders` WRITE;
/*!40000 ALTER TABLE `externalorders` DISABLE KEYS */;
/*!40000 ALTER TABLE `externalorders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lastlogin`
--

DROP TABLE IF EXISTS `lastlogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lastlogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lastlogin`
--

LOCK TABLES `lastlogin` WRITE;
/*!40000 ALTER TABLE `lastlogin` DISABLE KEYS */;
INSERT INTO `lastlogin` VALUES (1,'admin','127.0.0.1','2016-10-08 09:29:18'),(2,'admin','127.0.0.1','2016-10-08 09:29:43'),(3,'admin','127.0.0.1','2016-10-08 09:31:20'),(4,'admin','127.0.0.1','2016-10-08 09:32:57'),(5,'admin','127.0.0.1','2016-10-08 09:35:24'),(6,'admin','127.0.0.1','2016-10-09 06:47:32'),(7,'admin','127.0.0.1','2016-10-09 08:23:48'),(8,'admin','127.0.0.1','2016-10-09 09:12:32'),(9,'admin','127.0.0.1','2016-10-09 09:12:49'),(10,'admin','127.0.0.1','2016-10-09 09:26:07'),(11,'admin','127.0.0.1','2016-10-09 10:29:46'),(12,'admin','127.0.0.1','2016-10-09 01:02:37'),(13,'admin','127.0.0.1','2016-10-09 08:02:40'),(14,'admin','10.42.0.36','2016-10-09 08:32:50'),(15,'admin','127.0.0.1','2016-10-09 08:53:49'),(16,'admin','127.0.0.1','2016-10-09 08:57:45'),(17,'admin','127.0.0.1','2016-10-09 08:59:24'),(18,'admin','10.42.0.36','2016-10-09 09:24:42'),(19,'admin','10.42.0.36','2016-10-09 09:32:39'),(20,'admin','10.42.0.36','2016-10-09 09:56:44'),(21,'admin','127.0.0.1','2016-10-09 09:57:16'),(22,'admin','127.0.0.1','2016-10-10 10:14:01'),(23,'admin','127.0.0.1','2016-10-10 02:38:53'),(24,'admin','127.0.0.1','2016-10-10 05:12:50'),(25,'admin','127.0.0.1','2016-10-11 07:03:48'),(26,'admin','127.0.0.1','2016-10-11 07:06:00'),(27,'admin','10.42.0.36','2016-10-11 07:15:45'),(28,'admin','127.0.0.1','2016-10-11 07:42:32'),(29,'admin','127.0.0.1','2016-10-13 07:01:00'),(30,'admin','127.0.0.1','2016-10-13 07:11:51'),(31,'admin','127.0.0.1','2016-10-13 07:42:59'),(32,'admin','127.0.0.1','2016-10-14 08:53:18'),(33,'admin','127.0.0.1','2016-11-13 04:50:01'),(34,'admin','127.0.0.1','2016-11-13 04:53:54'),(35,'admin','127.0.0.1','2016-11-13 04:58:57'),(36,'admin','127.0.0.1','2016-11-13 05:01:37'),(37,'admin','127.0.0.1','2016-11-13 05:14:45'),(38,'admin','127.0.0.1','2016-11-13 05:19:57'),(39,'admin','127.0.0.1','2016-11-13 05:39:25'),(40,'admin','127.0.0.1','2016-11-13 06:04:36'),(41,'admin','127.0.0.1','2016-11-13 06:06:17'),(42,'admin','127.0.0.1','2016-11-13 08:55:53'),(43,'admin','127.0.0.1','2016-11-17 02:33:33'),(44,'admin','127.0.0.1','2016-11-17 07:23:18'),(45,'admin','127.0.0.1','2016-11-20 09:29:55'),(46,'admin','127.0.0.1','2016-11-20 09:30:28'),(47,'admin','127.0.0.1','2016-11-20 09:33:07'),(48,'admin','127.0.0.1','2016-11-20 12:30:51'),(49,'admin','127.0.0.1','2016-11-22 07:05:56'),(50,'admin','127.0.0.1','2016-11-23 06:48:46'),(51,'admin','127.0.0.1','2016-11-23 06:50:10'),(52,'admin','127.0.0.1','2016-11-23 08:58:56'),(53,'admin','127.0.0.1','2016-11-23 12:29:54'),(54,'admin','127.0.0.1','2016-12-18 09:37:31'),(55,'admin','127.0.0.1','2016-12-18 01:53:37'),(56,'admin','127.0.0.1','2016-12-18 03:24:02'),(57,'admin','127.0.0.1','2016-12-18 05:14:09'),(58,'admin','127.0.0.1','2016-12-18 05:53:05'),(59,'admin','127.0.0.1','2016-12-18 05:55:34');
/*!40000 ALTER TABLE `lastlogin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lastpasschng`
--

DROP TABLE IF EXISTS `lastpasschng`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lastpasschng` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lastpasschng`
--

LOCK TABLES `lastpasschng` WRITE;
/*!40000 ALTER TABLE `lastpasschng` DISABLE KEYS */;
INSERT INTO `lastpasschng` VALUES (1,'admin','2016-10-09 10:29:42'),(2,'admin','2016-10-13 07:11:43'),(3,'admin','2016-11-13 04:53:43');
/*!40000 ALTER TABLE `lastpasschng` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `local`
--

DROP TABLE IF EXISTS `local`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `local` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `local`
--

LOCK TABLES `local` WRITE;
/*!40000 ALTER TABLE `local` DISABLE KEYS */;
INSERT INTO `local` VALUES (1,'Bank with Okro Stew(fish)','15.00','2016-12-18 10:02:31');
/*!40000 ALTER TABLE `local` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'admin','MnRLNWFIS0daeVBWR1dORytDMnZmUT09');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logindetails`
--

DROP TABLE IF EXISTS `logindetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logindetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `mobileNo1` varchar(20) DEFAULT NULL,
  `mobileNo2` varchar(20) DEFAULT NULL,
  `datereg` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logindetails`
--

LOCK TABLES `logindetails` WRITE;
/*!40000 ALTER TABLE `logindetails` DISABLE KEYS */;
INSERT INTO `logindetails` VALUES (1,'admin','Quick Service','Quick Service Restaurant','justiceowusuagyemang@gmail.com','0205737153','0501371810','2016-10-07 10:54:49');
/*!40000 ALTER TABLE `logindetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(100) DEFAULT NULL,
  `message` text,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mlogin`
--

DROP TABLE IF EXISTS `mlogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mlogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mlogin`
--

LOCK TABLES `mlogin` WRITE;
/*!40000 ALTER TABLE `mlogin` DISABLE KEYS */;
INSERT INTO `mlogin` VALUES (3,'table1','aS9VTU5lYUhJTUhIWVF5bVBhNGd6Zz09');
/*!40000 ALTER TABLE `mlogin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mlogindetails`
--

DROP TABLE IF EXISTS `mlogindetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mlogindetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `mobileNo1` varchar(20) DEFAULT NULL,
  `mobileNo2` varchar(20) DEFAULT NULL,
  `datereg` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mlogindetails`
--

LOCK TABLES `mlogindetails` WRITE;
/*!40000 ALTER TABLE `mlogindetails` DISABLE KEYS */;
INSERT INTO `mlogindetails` VALUES (3,'table1','Table 1','Table tb1 ','jay@gmail.com','0205737153','0545283614',NULL);
/*!40000 ALTER TABLE `mlogindetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `persons` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suggestions`
--

DROP TABLE IF EXISTS `suggestions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suggestions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `message` text,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suggestions`
--

LOCK TABLES `suggestions` WRITE;
/*!40000 ALTER TABLE `suggestions` DISABLE KEYS */;
/*!40000 ALTER TABLE `suggestions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task` varchar(100) DEFAULT NULL,
  `progress` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-18 23:01:18
