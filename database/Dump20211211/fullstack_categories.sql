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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (7,'Процессоры','Центральное процессорное устройство описывал','categories/1639197327135988.jpg'),(8,'Материнские платы','Материнская (систе́мная) пла́та','categories/1639197418742763.jpg'),(9,'Видеокарты','Видеока́рта — устройство, преобразующее графический образ, хранящийся как содержимое памяти компьютера','categories/1639197515889249.jpg'),(10,'Оперативная память','Операти́вная па́мять — в большинстве случаев энергозависимая часть системы компьютерной памяти','categories/1639197626530881.jpg'),(11,'Корпуса','Компьютерный корпус (англ. computer case) — физически представляет собой базовую несущую конструкцию (шасси), которая предназначена для последующего наполнения аппаратным обеспечением с целью создания компьютера.','categories/16391977248778.jpg'),(12,'Блоки питания','Встроенный источник электропитания компьютера — устройство, предназначенное для преобразования напряжения переменного тока от сети в напряжение постоянного тока с целью питания компьютера или компьютер-сервера.[1]','categories/1639197783877696.jpg'),(13,'Устройства расширения','Карта (плата) расширения (от англ. expansion card) — вид компьютерных комплектующих: печатная плата, которую устанавливают в слот расширения материнской платы компьютерной системы с целью добавления дополнительных функций[1]. ','categories/163919794887099.jpg'),(14,'Жесткие диски','Накопи́тель на жёстких магни́тных ди́сках, или НЖМД (англ. hard (magnetic) disk drive, HDD, HMDD), жёсткий диск, разг. винчестер — запоминающее устройство','categories/1639198001544061.jpg');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
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
