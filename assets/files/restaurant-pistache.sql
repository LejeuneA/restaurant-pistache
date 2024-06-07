-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: restaurant-pistache
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `idCategory` int unsigned NOT NULL,
  `nameOfCategory` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCategory`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'starters'),(2,'mainCourses'),(3,'desserts');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `desserts`
--

DROP TABLE IF EXISTS `desserts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `desserts` (
  `idDessert` int NOT NULL AUTO_INCREMENT,
  `imageUrl` varchar(250) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `idCategory` int DEFAULT '3',
  PRIMARY KEY (`idDessert`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desserts`
--

LOCK TABLES `desserts` WRITE;
/*!40000 ALTER TABLE `desserts` DISABLE KEYS */;
INSERT INTO `desserts` VALUES (1,'dessert-1.jpg','Crêpes suzette',12.00,'Flour, Milk, Granulated sugar, Orange Butter Sauce',1,3),(2,'dessert-2.jpg','Tarte tatin',13.00,'Flour, Apples, Sugar, Whipped cream',1,3),(3,'dessert-3.jpg','Floating islands',12.00,'Egg whites, Granulated sugar, Heavy cream, Dark chocolate',1,3),(4,'dessert-4.jpg','Hazelnut and crème fraîche meringues',15.00,'Raw hazelnuts, Egg whites, Crème fraiche, Granulated sugar',1,3),(5,'dessert-5.jpg','Fresh raspberry tart',13.00,'Fresh raspberries, Raspberry jam, Fresh lemon juice, Vanilla ice cream',1,3),(6,'dessert-6.jpg','Raspberry macarons',12.00,'Raspberry jam, Almond flour, Confectioners\' sugar, Egg whites',1,3),(7,'dessert-7.jpg','Cream puffs with chocolate sauce',15.00,'Bittersweet chocolate, Flour, Heavy cream, Vanilla extract',1,3),(8,'dessert-8.jpg','Crème caramel',12.00,'Heavy cream, Yolks, Milk, Vanilla bean',1,3);
/*!40000 ALTER TABLE `desserts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maincourses`
--

DROP TABLE IF EXISTS `maincourses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `maincourses` (
  `idMainCourse` int NOT NULL AUTO_INCREMENT,
  `imageUrl` varchar(250) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `idCategory` int DEFAULT '2',
  PRIMARY KEY (`idMainCourse`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maincourses`
--

LOCK TABLES `maincourses` WRITE;
/*!40000 ALTER TABLE `maincourses` DISABLE KEYS */;
INSERT INTO `maincourses` VALUES (1,'main-1.jpg','Chicken confit with sauce vierge',24.00,'Chicken marylandst, Pommes puree, Garlic cloves, Sauce',1,2),(2,'main-2.jpg','Salmon steamed in paper parcels',24.00,'Ravolli, Tomato sauce, Dill, Olive oil',1,2),(3,'main-3.jpg','Slow-cooked boeuf bourguignon',25.00,'Chuck steak, Carrot, Garlic cloves, Potato',1,2),(4,'main-4.jpg','Marseille-style shrimp stew',21.00,'Jumbo shrimp, Garlic cloves, Cayenne pepper, Basilic leaves',1,2),(5,'main-5.jpg','Duck à l\'orange',32.00,'Pekin ducks, Oranges, Potatoes, White wine',1,2),(6,'main-6.jpg','Stuffed pork tenderloins with bacon',25.00,'Pork tenderloins, Breakfast sausage, Garlic cloves, Chopped thyme',1,2),(7,'main-7.jpg','Strip steak frites with béarnaise butter',24.00,'Steaks, Potatoes, Béarnaise butter, White vinegar',1,2),(8,'main-8.jpg','Ratatouille',21.00,'Eggplants, Zucchini, Yellow onions, Red bell peppers',1,2);
/*!40000 ALTER TABLE `maincourses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `starters`
--

DROP TABLE IF EXISTS `starters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `starters` (
  `idStarter` int NOT NULL AUTO_INCREMENT,
  `imageUrl` varchar(250) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `idCategory` int DEFAULT '1',
  PRIMARY KEY (`idStarter`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `starters`
--

LOCK TABLES `starters` WRITE;
/*!40000 ALTER TABLE `starters` DISABLE KEYS */;
INSERT INTO `starters` VALUES (1,'starter-1.jpg','Scottish smoked label salmon',15.00,'Salmon filet, Kosher salt, Brown sugar, Olive oil',1,1),(2,'starter-2.jpg','Ravioli with tomato sauce and dill',13.00,'Ravolli, Tomato sauce, Dill, Olive oil',1,1),(3,'starter-3.jpg','Tuna salad with tomatoes',15.00,'Tuna fish, Boiled egg, Tomatoes, Lemon',1,1),(4,'starter-4.jpg','Shrimps in batter with sauce',17.00,'Shrimps, Fresh vegetable salad, Lemon, Sauce',1,1),(5,'starter-5.jpg','Fried squid',17.00,'Calamari, Fresh vegetable salad, Lemon, Sauce',1,1),(6,'starter-6.jpg','Steak tartare',18.00,'Beef fillet, Shallots, Cornichons, Yolk egg',1,1),(7,'starter-7.jpg','Chicken liver pâté',13.00,'Chicken livers, Onion, Double cream, Toast',1,1),(8,'starter-8.jpg','French onion soup',14.00,'Onions, Beef stock, Butter, Parsley',1,1);
/*!40000 ALTER TABLE `starters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `idUser` int NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `passwd` varchar(250) NOT NULL,
  `permission` int DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'lejeune@mail.com','130580',1);
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

-- Dump completed on 2024-06-07 11:26:53
