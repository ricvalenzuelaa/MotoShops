-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: motoshop
-- ------------------------------------------------------
-- Server version	9.1.0

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `adminID` int NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (100,'ricastig');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `Email` varchar(50) DEFAULT NULL,
  `loginDate` date DEFAULT NULL,
  `loginTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES ('ricvalenzuela17@gmail.com','2025-10-26','15:58:14'),('ricvalenzuela17@gmail.com','2025-10-26','15:59:47'),('ricvalenzuela17@gmail.com','2025-10-26','16:09:10'),('ricvalenzuela17@gmail.com','2025-10-26','16:30:43'),('ricvalenzuela17@gmail.com','2025-10-26','16:34:15'),('ricvalenzuela17@gmail.com','2025-10-28','13:49:46');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `OrderID` int NOT NULL AUTO_INCREMENT,
  `userID` int DEFAULT NULL,
  `productID` int DEFAULT NULL,
  `OrderQuantity` int DEFAULT NULL,
  `OrderDate` date DEFAULT NULL,
  `PaymentMethod` varchar(50) NOT NULL,
  `OrderStatus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `userID` (`userID`),
  KEY `productID` (`productID`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `productID` int NOT NULL AUTO_INCREMENT,
  `productimage` varchar(100) DEFAULT NULL,
  `productModel` varchar(50) DEFAULT NULL,
  `BrandName` varchar(50) DEFAULT NULL,
  `Price` double NOT NULL,
  `productDescription` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (8,'CF150nk.webp','150nk','Cfmoto',1,''),(9,'CF230dual.webp','230 dual','Cfmoto',1,''),(10,'CF250sr.webp','250sr','Cfmoto',1,''),(11,'CF450nk.webp','450nk','Cfmoto',1,''),(12,'CF450sr.webp','450sr','Cfmoto',1,''),(13,'CF500sr.webp','500sr','Cfmoto',1,''),(14,'CFcx-2e.webp','cx-2e','Cfmoto',1,''),(15,'CFstpapio125.webp','stpapio125','Cfmoto',1,''),(16,'Dmultistrada v4.webp','Multistrada v4','Ducati',1650000,'Adventure tourer powered by the smooth 1158cc V4 Granturismo engine, featuring front and rear radar for Adaptive Cruise Control and Blind Spot Detection.'),(17,'Dpanigalev2.webp','Panigale v2','Ducati',1,''),(18,'Dpanigalev4.webp','Panigale v4','Ducati',1,''),(19,'Dscramblericon.webp','Scrambler icon','Ducati',1,''),(20,'Dscramblernightshift.webp','Scrambler nightshift','Ducati',1,''),(21,'Dstreetfighterv2.webp','Street Fighter v2  ','Ducati',1150000,'Panigale V2-derived naked sport bike with a 955cc Superquadro engine (153hp) and a full suite of cutting-edge rider electronics.'),(22,'Dsuperleggerav4.webp','Super Leggera v4','Ducati',7500000,'Ultra-exclusive superbike with a carbon fiber chassis, 998cc V4 engine, and track-ready power-to-weight ratio.'),(23,'Dsupersport.webp','Supersport','Ducati',1,''),(24,'Hadv160.webp','adv 160 ','Honda',116900,' Rugged adventure scooter with a powerful 157cc eSP+ engine, ABS, Honda Selectable Torque Control (HSTC), and adjustable windscreen.'),(25,'Hcb1000R.webp','Cb1000R','Honda',1,''),(26,'Hcbr150r.webp','CBR150r','Honda',183000,''),(27,'Hcbr500r.webp','CBR500r','Honda',1,''),(28,'Hcbr650r.webp','CBR650r','Honda',1,''),(29,'HCBR1000RR.webp','CBR1000RR','Honda',1,''),(30,'Hgiorno.webp','Giorno','Honda',1,''),(31,'Hwinnerx.webp','Winner X','Honda',1,''),(32,'Kbarako.webp','Barako','Kawasaki',1,''),(33,'Kninja500.webp','Ninja 500','Kawasaki',1,''),(34,'Kninjae1.webp','Ninja  E-1','Kawasaki',1,''),(35,'Kninjazx25r.webp','Ninja zx-25r','Kawasaki',1,''),(36,'Kvulcan900.webp','Vulcan 900','Kawasaki',1,''),(37,'Kvulcan1700.webp','Vulcan 1700','Kawasaki',1,''),(38,'Kz1000r.webp ','z1000r','Kawasaki',710000,'Aggressive \"Sugomi\" styled supernaked with a powerful 1043cc engine, Brembo brakes, and Öhlins suspension.'),(39,'Kzx14r.webp ','Zx-14r','Kawasaki',750000,'Hyper-sport motorcycle with an ultra-powerful 1441cc engine, advanced KTRC traction control, and an aluminum monocoque frame.\r\n'),(40,'Ymioaerox.webp','Mio Aerox','Yamaha',1,''),(41,'Ymiogravis.webp','Mio gravis','Yamaha',1,''),(42,'Yyzfr15.webp','YZF R15','Yamaha',1,''),(43,'Ysniper155.webp','Sniper 155','Yamaha',1,''),(44,'Yytx125.webp','YTX 125','Yamaha',1,''),(45,'Yyzfr15m.webp','YZF R15m','Yamaha',203000,''),(46,'Yyzfr3.webp','YZF R3','Yamaha',399000,''),(47,'Yyzfr1m.webp','YZF R1m','Yamaha',1,'');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'niggawat','nigga','nigga street','ricvalenzuela17@gmail.com','123'),(2,'ric','valenzuela','buray','ricvalenzuela17@gmail.com','1234');
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

-- Dump completed on 2025-10-28 14:05:33
