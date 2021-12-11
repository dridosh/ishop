-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: fullstack
-- ------------------------------------------------------
-- Server version	5.7.33

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
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `vendor_code` varchar(64) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` float unsigned DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_categories1_idx` (`category_id`),
  CONSTRAINT `fk_product_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (4,'sWRX8, 64 x 2700 МГц, L2 - 32 МБ, L3 - 256 МБ, 8хDDR4-3200 МГц, TDP 280 Вт','1','Процессор AMD Ryzen Threadripper PRO 3995WX BOX',480999,'products/16391987483804327.jpg',7),(5,'AM4, 16 x 3400 МГц, L2 - 8 МБ, L3 - 64 МБ, 2хDDR4-3200 МГц, TDP 105 Вт ','2','Процессор AMD Ryzen 9 5950X BOX',70999,'products/16391988218041882.jpg',7),(6,'LGA 1151-v2, 8 x 3600 МГц, L2 - 2 МБ, L3 - 12 МБ, 2хDDR4-2666 МГц, Intel UHD Graphics 630, TDP 95 Вт','3','Процессор Intel Core i7-9700K OEM',24999,'products/16391989169429590.webp',7),(7,'LGA 1200, 6 x 2900 МГц, L2 - 1.5 МБ, L3 - 12 МБ, 2хDDR4-2666 МГц, Intel UHD Graphics 630, TDP 65 Вт','5','Процессор Intel Core i5-10400 OEM',14299,'products/16391989913224092.webp',7),(8,'AM4, 2 x 3800 МГц, L2 - 1 МБ, 2хDDR4-2400 МГц, Radeon R5, TDP 65 Вт','1','Процессор AMD PRO A6-8580 OEM',3450,'products/16391990554495213.webp',7),(9,'AM3+, 4 x 3800 МГц, L2 - 4 МБ, L3 - 4 МБ, 2хDDR3-1866 МГц, TDP 95 Вт','2','Процессор AMD FX-4300 OEM',2499,'products/16391991314352882.webp',7),(10,'sTRX4, AMD TRX40, 8xDDR4-4733 МГц, 4xPCI-Ex16, аудио 7.1, E-ATX ','1','Материнская плата ASUS ROG ZENITH II EXTREME ALPHA',84999,'products/16391992352106015.webp',8),(11,'PCI-E 4.0, 24 ГБ GDDR6X, 384 бит, 1400 МГц - 1860 МГц, DisplayPort x3, HDMI','3','Видеокарта MSI GeForce RTX 3090 SUPRIM X [RTX 3090 SUPRIM X 24G]',329999,'products/16391994343681564.webp',9),(12,'DDR4, 32 ГБx2 шт, 3200 МГц, PC25600, тайминги: 20-22-22','3','Оперативная память SODIMM Kingston FURY Impact [KF432S20IBK2/64] 64 ГБ',24999,'products/163921412261203.webp',10);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-11 14:36:16
