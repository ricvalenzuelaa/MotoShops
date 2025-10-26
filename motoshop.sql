-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 26, 2025 at 08:41 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `motoshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `adminID` int NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `password`) VALUES
(100, 'ricastig');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `Email` varchar(50) DEFAULT NULL,
  `loginDate` date DEFAULT NULL,
  `loginTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Email`, `loginDate`, `loginTime`) VALUES
('ricvalenzuela17@gmail.com', '2025-10-26', '15:58:14'),
('ricvalenzuela17@gmail.com', '2025-10-26', '15:59:47'),
('ricvalenzuela17@gmail.com', '2025-10-26', '16:09:10'),
('ricvalenzuela17@gmail.com', '2025-10-26', '16:30:43'),
('ricvalenzuela17@gmail.com', '2025-10-26', '16:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `OrderID` int NOT NULL AUTO_INCREMENT,
  `userID` int DEFAULT NULL,
  `productID` int DEFAULT NULL,
  `OrderQuantity` int DEFAULT NULL,
  `OrderDate` date DEFAULT NULL,
  `PaymentMethod` varchar(50) NOT NULL,
  `OrderStatus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `userID` (`userID`),
  KEY `productID` (`productID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `userID`, `productID`, `OrderQuantity`, `OrderDate`, `PaymentMethod`, `OrderStatus`) VALUES
(1, 1, 1, 3, '2025-10-26', '', 'On Delivery'),
(2, 1, 2, 2, '2025-10-26', '', 'Pending'),
(3, 1, 4, 1, '2025-10-26', '', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `productID` int NOT NULL AUTO_INCREMENT,
  `productimage` varchar(100) DEFAULT NULL,
  `productModel` varchar(50) DEFAULT NULL,
  `BrandName` varchar(50) DEFAULT NULL,
  `Price` double NOT NULL,
  `productDescription` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productimage`, `productModel`, `BrandName`, `Price`, `productDescription`) VALUES
(1, 'Kz1000r.webp', 'z1000r', 'Kawasaki', 710000, 'Aggressive \"Sugomi\" styled supernaked with a powerful 1043cc engine, Brembo brakes, and Öhlins suspension.'),
(2, 'Dsuperleggerav4.webp', 'Super Leggera v4', 'Ducati', 7500000, 'Ultra-exclusive superbike with a carbon fiber chassis, 998cc V4 engine, and track-ready power-to-weight ratio.'),
(3, 'Kzx14r.webp', 'zx14r', 'Kawasaki', 750000, 'Hyper-sport motorcycle with an ultra-powerful 1441cc engine, advanced KTRC traction control, and an aluminum monocoque frame.'),
(4, 'Dmultistradav4.webp', 'Multi Strada v4', 'Ducati', 1650000, 'Adventure tourer powered by the smooth 1158cc V4 Granturismo engine, featuring front and rear radar for Adaptive Cruise Control and Blind Spot Detection.'),
(5, 'Dstreetfighterv2.webp', 'Street Fighter v2', 'Ducati', 1150000, 'Panigale V2-derived naked sport bike with a 955cc Superquadro engine (153hp) and a full suite of cutting-edge rider electronics.'),
(6, 'Hadv160.webp', 'adv-160', 'Honda', 116900, 'Rugged adventure scooter with a powerful 157cc eSP+ engine, ABS, Honda Selectable Torque Control (HSTC), and adjustable windscreen.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `FirstName`, `LastName`, `Address`, `Email`, `Password`) VALUES
(1, 'niggawat', 'nigga', 'nigga street', 'ricvalenzuela17@gmail.com', '123');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
