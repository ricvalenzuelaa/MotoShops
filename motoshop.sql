-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
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
INSERT INTO `login` VALUES ('ricvalenzuela17@gmail.com','2025-10-26','15:58:14'),('ricvalenzuela17@gmail.com','2025-10-26','15:59:47'),('ricvalenzuela17@gmail.com','2025-10-26','16:09:10'),('ricvalenzuela17@gmail.com','2025-10-26','16:30:43'),('ricvalenzuela17@gmail.com','2025-10-26','16:34:15'),('ricvalenzuela17@gmail.com','2025-10-26','16:45:35'),('coffefitoy@gmail.com','2025-10-26','16:58:05'),('ricvalenzuela17@gmail.com','2025-10-26','17:03:20'),('ricvalenzuela17@gmail.com','2025-10-26','17:06:18'),('ricvalenzuela17@gmail.com','2025-10-26','17:28:27'),('ricvalenzuela17@gmail.com','2025-10-26','17:29:23'),('ric','2025-10-26','19:02:25'),('wmam@gmail.com','2025-10-26','19:03:59'),('ric','2025-10-26','19:10:45'),('ric','2025-10-26','19:13:29'),('ric','2025-10-26','19:20:50'),('ricvalenzuela17@gmail.com','2025-10-26','19:24:52'),('ricvalenzuela17@gmail.com','2025-10-26','19:26:59'),('ricvalenzuela17@gmail.com','2025-10-26','19:27:53'),('1000@gmail.com','2025-10-27','23:10:31');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,1,3,'2025-10-26','','On Delivery'),(2,1,2,2,'2025-10-26','','Pending'),(3,1,4,1,'2025-10-26','','Pending'),(4,1,1,1,'2025-10-26','Cash on Delivery','Processing'),(5,2,2,1,'2025-10-26','Cash on Delivery','Pending'),(6,6,5,5,'2025-10-26','Cash on Delivery','Pending'),(7,5,2,4,'2025-10-26','Cash on Delivery','Pending'),(8,5,2,1,'2025-10-26','G-Cash','Pending'),(9,5,2,1,'2025-10-26','G-Cash','Pending');
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'CF150nk.webp','150nk','Cfmoto',100900,''),(2,'CF230dual.webp','230 dual','Cfmoto',99900,''),(3,'CF250sr.webp','250sr','Cfmoto',135000,''),(4,'CF450nk.webp','450nk','Cfmoto',272800,''),(5,'CF450sr.webp','450sr','Cfmoto',299900,''),(6,'CF500sr.webp','500sr','Cfmoto',383900,''),(7,'CFcx-2e.webp','cx-2e','Cfmoto',88800,''),(8,'CFstpapio125.webp','stpapio125','Cfmoto',118900,'Displacement: ~ 124.5 cc (also listed as 126 cc in some regions) \r\n\r\n\r\nEngine type: Single-cylinder, 4-stroke, air-cooled \r\n\r\nBore × Stroke: 57 mm × 49.4 mm (or 48.8 mm in some listings) \r\n\r\ncfmotomalaysia.com.my\r\n\r\nCompression Ratio: 9.0 : 1 \r\n\r\n\r\nMax Po'),(9,'Dmultistrada v4.webp','Multistrada v4','Ducati',1650000,'Adventure tourer powered by the smooth 1158cc V4 Granturismo engine, featuring front and rear radar for Adaptive Cruise Control and Blind Spot Detection.'),(10,'Dpanigalev2.webp','Panigale v2','Ducati',1365000,''),(11,'Dpanigalev4.webp','Panigale v4','Ducati',1990000,''),(12,'Dscramblericon.webp','Scrambler icon','Ducati',670000,''),(13,'Dscramblernightshift.webp','Scrambler nightshift','Ducati',785000,''),(14,'Dstreetfighterv2.webp','Street Fighter v2  ','Ducati',1150000,'Panigale V2-derived naked sport bike with a 955cc Superquadro engine (153hp) and a full suite of cutting-edge rider electronics.'),(15,'Dsuperleggerav4.webp','Super Leggera v4','Ducati',7500000,'Ultra-exclusive superbike with a carbon fiber chassis, 998cc V4 engine, and track-ready power-to-weight ratio.'),(16,'Dsupersport.webp','Supersport','Ducati',1225000,''),(17,'Hadv160.webp','adv 160 ','Honda',116900,' Rugged adventure scooter with a powerful 157cc eSP+ engine, ABS, Honda Selectable Torque Control (HSTC), and adjustable windscreen.'),(18,'Hcb1000R.webp','Cb1000R','Honda',865000,''),(19,'Hcbr150r.webp','CBR150r','Honda',183000,''),(20,'Hcbr500r.webp','CBR500r','Honda',389000,''),(21,'Hcbr650r.webp','CBR650r','Honda',554000,''),(22,'HCBR1000RR.webp','CBR1000RR','Honda',1699000,''),(23,'Hgiorno.webp','Giorno','Honda',110000,''),(24,'Hwinnerx.webp','Winner X','Honda',165000,''),(25,'Kbarako.webp','Barako','Kawasaki',80000,''),(26,'Kninja500.webp','Ninja 500','Kawasaki',865000,''),(27,'Kninjae1.webp','Ninja  E-1','Kawasaki',624000,''),(28,'Kninjazx25r.webp','Ninja zx-25r','Kawasaki',406000,''),(29,'Kvulcan900.webp','Vulcan 900','Kawasaki',600000,''),(30,'Kvulcan1700.webp','Vulcan 1700','Kawasaki',856000,''),(31,'Kz1000r.webp ','z1000r','Kawasaki',710000,'Aggressive \"Sugomi\" styled supernaked with a powerful 1043cc engine, Brembo brakes, and Öhlins suspension.'),(32,'Kzx14r.webp ','Zx-14r','Kawasaki',750000,'Hyper-sport motorcycle with an ultra-powerful 1441cc engine, advanced KTRC traction control, and an aluminum monocoque frame.\r\n'),(33,'Ymioaerox.webp','Mio Aerox','Yamaha',123000,''),(34,'Ymiogravis.webp','Mio gravis','Yamaha',75000,''),(35,'Yyzfr15.webp','YZF R15','Yamaha',164000,''),(36,'Ysniper155.webp','Sniper 155','Yamaha',125900,''),(37,'Yytx125.webp','YTX 125','Yamaha',95000,''),(38,'Yyzfr15m.webp','YZF R15m','Yamaha',203000,''),(39,'Yyzfr3.webp','YZF R3','Yamaha',399000,''),(40,'Yyzfr1m.webp','YZF R1m','Yamaha',1739000,'');
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
  `phoneNo` int NOT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'niggawat','nigga',0,'nigga street','ricvalenzuela17@gmail.com','123'),(2,'coffee','fitoy',0,'oton','coffefitoy@gmail.com','12345'),(3,'fff','sdkfsk',90099090,'wekerlwejrkwe','hh@g.ail','alskdjakds'),(4,'asdasd','asdasddsd',303492394,'askldlaskdakls','sasdasd','asdasdasd'),(5,'ric','ric',123,'ric','ric','ric'),(6,'naethan','james',3424,'ewkrjwekrj','wmam@gmail.com','12345'),(7,'ric','valenzuela',0,'buray','1000@gmail.com','1234');
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

-- Dump completed on 2025-10-29 15:22:43
