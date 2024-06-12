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
INSERT INTO `category` VALUES (1,'Starters'),(2,'MainCourses'),(3,'Desserts');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(150) DEFAULT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'Açelya','LEJEUNE','acelyalejeune@gmail.com','0493387729','svdsdsd');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `desserts`
--

DROP TABLE IF EXISTS `desserts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `desserts` (
  `idDessert` int NOT NULL AUTO_INCREMENT,
  `image_url` varchar(250) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `content` longtext,
  `active` tinyint(1) DEFAULT '1',
  `idCategory` int DEFAULT '3',
  PRIMARY KEY (`idDessert`)
) ENGINE=InnoDB AUTO_INCREMENT=8011 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desserts`
--

LOCK TABLES `desserts` WRITE;
/*!40000 ALTER TABLE `desserts` DISABLE KEYS */;
INSERT INTO `desserts` VALUES (3001,'uploads/dessert-1.jpg','Crêpes suzette',12.00,'Flour, Milk, Granulated sugar, Orange Butter Sauce','&lt;div class=&quot;flex flex-grow flex-col max-w-full&quot;&gt;&lt;br /&gt;\r\n&lt;div class=&quot;min-h-[20px] text-message flex flex-col items-start whitespace-pre-wrap break-words [.text-message+&amp;amp;]:mt-5 juice:w-full juice:items-end overflow-x-auto gap-2&quot; dir=&quot;auto&quot; data-message-author-role=&quot;assistant&quot; data-message-id=&quot;d3a88159-245f-43d3-bc56-90a4b5a50cb3&quot;&gt;&lt;br /&gt;\r\n&lt;div class=&quot;flex w-full flex-col gap-1 juice:empty:hidden juice:first:pt-[3px]&quot;&gt;&lt;br /&gt;\r\n&lt;div class=&quot;markdown prose w-full break-words dark:prose-invert dark&quot;&gt;&lt;br /&gt;\r\n&lt;p&gt;Cr&amp;ecirc;pes Suzette is a decadent and flamboyant French dessert that combines thin pancakes with a luxurious orange-infused sauce. The cr&amp;ecirc;pes are made from a simple batter of flour, eggs, milk, and butter, cooked until golden and delicate. The sauce, known as the Suzette sauce, is made by caramelizing sugar with butter, then adding freshly squeezed orange juice, zest, and a splash of Grand Marnier or Cognac for a burst of flavor. Once the sauce is thickened and fragrant, the cr&amp;ecirc;pes are folded into quarters and briefly simmered in the sauce to soak up the orange-infused goodness. The dish is often flambeed tableside for added drama, with the flames caramelizing the sauce further and adding a touch of excitement to the presentation. Cr&amp;ecirc;pes Suzette are a timeless indulgence, perfect for impressing guests or treating yourself to a taste of French elegance.&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;',1,3),(3002,'uploads/dessert-2.jpg','Tarte tatin',13.00,'Flour, Apples, Sugar, Whipped cream','&lt;p&gt;Tarte Tatin is a classic French dessert celebrated for its simplicity and indulgent flavors. This upside-down caramelized apple tart features tender, caramel-coated apples nestled atop a buttery pastry crust. To make Tarte Tatin, apples are caramelized in butter and sugar until they turn golden and luscious, then arranged in a single layer in a skillet or baking dish. A layer of pastry dough is placed on top of the caramelized apples, and the tart is baked until the pastry is golden and crisp. Once baked, the tart is inverted onto a serving platter, revealing the beautiful caramelized apples glistening atop the flaky pastry. Tarte Tatin is best served warm with a dollop of whipped cream or a scoop of vanilla ice cream, making it a comforting and irresistible dessert that is perfect for any occasion.&lt;/p&gt;',1,3),(3003,'uploads/dessert-3.jpg','Floating islands',12.00,'Egg whites, Granulated sugar, Heavy cream, Dark chocolate','&lt;p&gt;Floating islands, or &amp;icirc;les flottantes in French, are a classic dessert known for their light and ethereal texture. This dessert consists of delicate clouds of meringue floating on a pool of creamy custard sauce. The meringues are made by whipping egg whites with sugar until stiff peaks form, then poaching them in simmering milk until they are light and fluffy. Once cooked, the meringues are gently lifted from the milk and placed atop a pool of chilled vanilla custard sauce. The contrast between the airy meringue and the creamy custard creates a delightful combination of textures, while the subtle sweetness of the meringue balances the richness of the custard. Floating islands are a timeless treat that is both elegant and comforting, perfect for rounding off a special meal or indulging in as a light and satisfying dessert.&lt;/p&gt;',1,3),(3004,'uploads/dessert-4.jpg','Hazelnut and crème fraîche meringues',15.00,'Raw hazelnuts, Egg whites, Crème fraiche, Granulated sugar','&lt;p&gt;Hazelnut and cr&amp;egrave;me fra&amp;icirc;che meringues are a delightful confection that combines the lightness of meringue with the rich flavors of hazelnuts and creamy cr&amp;egrave;me fra&amp;icirc;che. These delicate meringues are made by whipping egg whites with sugar until stiff peaks form, then folding in finely ground hazelnuts to add a nutty flavor and texture. The addition of cr&amp;egrave;me fra&amp;icirc;che to the meringue mixture adds a subtle tanginess and richness, balancing out the sweetness of the meringue. Once piped onto baking sheets and baked until crisp and golden, these hazelnut and cr&amp;egrave;me fra&amp;icirc;che meringues are a delightful treat that melts in the mouth, offering a harmonious blend of flavors and textures. They are perfect for serving as a light and elegant dessert or for indulging in with a cup of tea or coffee.&lt;/p&gt;',1,3),(3005,'uploads/dessert-5.jpg','Fresh raspberry tart',13.00,'Fresh raspberries, Raspberry jam, Fresh lemon juice, Vanilla ice cream','&lt;p&gt;A fresh raspberry tart is a delightful dessert that showcases the natural sweetness and vibrant color of ripe raspberries. This tart typically features a buttery and flaky pastry crust, baked until golden brown and crisp. The crust is then filled with a luscious pastry cream or almond frangipane filling, which provides a rich and creamy base for the raspberries. The fresh raspberries are arranged on top of the filling in a visually appealing pattern, creating a beautiful contrast against the creamy backdrop. Finally, the tart is often brushed with a glaze made from melted apricot jam or jelly to add shine and preserve the freshness of the raspberries. With its combination of buttery crust, creamy filling, and juicy raspberries, a fresh raspberry tart is a delightful dessert that is perfect for showcasing the bright flavors of summer.&lt;/p&gt;',1,3),(3006,'uploads/dessert-6.jpg','Raspberry macarons',12.00,'Raspberry jam, Almond flour, Confectioners\' sugar, Egg whites','&lt;p&gt;Raspberry macarons are a delightful French pastry known for their delicate almond meringue shells and flavorful raspberry filling. These bite-sized treats consist of two almond-based meringue cookies sandwiched together with a luscious raspberry filling. The meringue shells are crisp on the outside and chewy on the inside, with a subtle almond flavor that pairs perfectly with the tartness of the raspberry filling. The filling is typically made from fresh raspberries, sugar, and sometimes a splash of lemon juice, cooked down into a thick and flavorful jam-like consistency. The vibrant pink color of the raspberry filling adds a beautiful contrast to the pale meringue shells, making raspberry macarons not only delicious but also visually stunning. These elegant pastries are perfect for special occasions or as a sweet treat to enjoy with a cup of tea or coffee.&lt;/p&gt;',1,3),(3007,'uploads/dessert-7.jpg','Cream puffs with chocolate sauce',15.00,'Bittersweet chocolate, Flour, Heavy cream, Vanilla extract','&lt;p&gt;Cream puffs with chocolate sauce are a delightful dessert that combines light and airy pastry with decadent chocolate. The cream puffs, made from choux pastry, are baked until golden and crispy on the outside while remaining soft and hollow on the inside. They are then filled with a luscious vanilla pastry cream or whipped cream, adding a creamy and luxurious texture to each bite. To elevate the flavor even further, they are drizzled with a rich and velvety chocolate sauce made from melted chocolate, cream, and sometimes a splash of butter or liqueur for added richness. The combination of crisp pastry, creamy filling, and indulgent chocolate sauce creates a dessert that is both elegant and irresistible, perfect for satisfying any sweet craving.&lt;/p&gt;',1,3),(3008,'uploads/dessert-8.jpg','Crème caramel',12.00,'Heavy cream, Yolks, Milk, Vanilla bean','&lt;p&gt;Cr&amp;egrave;me caramel, also known as flan or caramel custard, is a classic French dessert loved for its silky-smooth texture and rich caramel flavor. To make cr&amp;egrave;me caramel, a creamy custard base is prepared with eggs, sugar, vanilla, and milk or cream, then poured into molds lined with caramelized sugar. The molds are then baked in a water bath until the custard sets and becomes firm. After chilling and firming in the refrigerator, the cr&amp;egrave;me caramels are inverted onto serving plates, revealing a beautiful layer of golden caramel sauce that coats the luscious custard. This elegant dessert is both luxurious and comforting, perfect for indulging in after a meal or for celebrating special occasions. Its delicate balance of sweetness and creaminess makes it a timeless favorite among dessert lovers worldwide.&lt;/p&gt;',1,3);
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
  `image_url` varchar(250) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `content` longtext,
  `active` tinyint(1) DEFAULT '1',
  `idCategory` int DEFAULT '2',
  PRIMARY KEY (`idMainCourse`)
) ENGINE=InnoDB AUTO_INCREMENT=8003 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maincourses`
--

LOCK TABLES `maincourses` WRITE;
/*!40000 ALTER TABLE `maincourses` DISABLE KEYS */;
INSERT INTO `maincourses` VALUES (2001,'uploads/main-1.jpg','Chicken confit with sauce vierge',24.00,'Chicken marylandst, Pommes puree, Garlic cloves, Sauce','&lt;p&gt;Chicken confit with sauce vierge is a delightful dish that combines the succulence of tender, slow-cooked chicken with the vibrant flavors of a classic French sauce. To prepare the chicken confit, chicken pieces are seasoned with salt, pepper, and herbs, then slowly cooked in rendered chicken fat until they are meltingly tender and infused with rich flavor. Meanwhile, the sauce vierge, which translates to &quot;green sauce,&quot; is made by combining diced tomatoes, fresh herbs such as basil and parsley, minced shallots, garlic, lemon juice, and olive oil. This bright and zesty sauce provides a refreshing contrast to the rich, savory chicken confit, adding a burst of freshness and acidity to each bite. The combination of tender chicken and vibrant sauce vierge creates a harmonious balance of flavors and textures, making this dish a true delight for the senses.&lt;/p&gt;',1,2),(2002,'uploads/main-2.jpg','Salmon steamed in paper parcels',24.00,'Ravolli, Tomato sauce, Dill, Olive oil','&lt;p&gt;Salmon steamed in paper parcels, also known as salmon en papillote, is a delicate and flavorful dish that highlights the natural taste of the fish while infusing it with aromatic herbs and spices. To prepare this dish, fresh salmon fillets are seasoned with salt, pepper, and a squeeze of lemon juice, then placed on a bed of thinly sliced vegetables such as onions, carrots, and zucchini. The fillets are sealed in parchment paper or aluminum foil parcels along with herbs like dill, parsley, or thyme, and a splash of white wine or broth to keep the fish moist during cooking. As the parcels are steamed in the oven, the salmon gently cooks to perfection, locking in its moisture and absorbing the fragrant flavors of the herbs and vegetables. The result is tender, flaky salmon with a subtle hint of citrus and herbs, making it a light and elegant meal that is as impressive as it is delicious.&lt;/p&gt;',1,2),(2003,'uploads/main-3.jpg','Slow-cooked boeuf bourguignon',25.00,'Chuck steak, Carrot, Garlic cloves, Potato','&lt;p&gt;Slow-cooked boeuf bourguignon is a quintessential French dish renowned for its rich, hearty flavors and tender, melt-in-your-mouth beef. This traditional recipe begins with succulent chunks of beef, typically from the shoulder or chuck, which are seared until golden brown to enhance their flavor. The beef is then slowly braised in a robust red wine sauce infused with aromatic vegetables such as onions, carrots, and garlic, along with fragrant herbs like thyme and bay leaves. The long, slow cooking process allows the flavors to meld together, resulting in a luscious, velvety sauce and meat that is incredibly tender. Boeuf bourguignon is a labor of love, requiring patience and attention to detail, but the end result is a sumptuous and satisfying dish that is perfect for a cozy evening meal or special occasion.&lt;/p&gt;',1,2),(2004,'uploads/main-4.jpg','Marseille-style shrimp stew',21.00,'Jumbo shrimp, Garlic cloves, Cayenne pepper, Basilic leaves','&lt;p&gt;Marseille-style shrimp stew is a tantalizing seafood dish inspired by the flavors of the Mediterranean coast. This hearty stew begins with a base of aromatic vegetables such as onions, garlic, and tomatoes, saut&amp;eacute;ed until tender and fragrant. To this, a medley of fresh seafood is added, including succulent shrimp, mussels, and sometimes fish fillets, simmered gently until cooked through and infused with the essence of the broth. The stew is elevated with a splash of white wine, a bouquet garni of herbs such as thyme and bay leaves, and a touch of saffron, which imparts a golden hue and subtle depth of flavor. Marseille-style shrimp stew is a celebration of the bountiful treasures of the sea, showcasing the vibrant colors and rich tastes of the Mediterranean culinary tradition. It&#039;s perfect for cozy gatherings or special occasions, served with crusty bread to soak up every last bit of the flavorful broth.&lt;/p&gt;',1,2),(2005,'uploads/main-5.jpg','Duck à l\'orange',32.00,'Pekin ducks, Oranges, Potatoes, White wine','&lt;p&gt;Duck &amp;agrave; l&#039;orange is a classic French dish renowned for its elegant blend of sweet and savory flavors. This dish features tender duck breast cooked to perfection and served with a luxurious orange sauce. The duck breast is typically seared until golden and crispy on the outside while remaining succulent and juicy on the inside. The orange sauce is made from a reduction of fresh orange juice, zest, sugar, vinegar, and often fortified with cognac or Grand Marnier for depth of flavor. The sauce is then poured over the sliced duck breast, imparting a delightful citrusy tang that perfectly complements the richness of the meat. Duck &amp;agrave; l&#039;orange is a timeless culinary masterpiece, sure to impress even the most discerning palates with its harmonious balance of flavors and exquisite presentation.&lt;/p&gt;',1,2),(2006,'uploads/main-6.jpg','Stuffed pork tenderloins with bacon',25.00,'Pork tenderloins, Breakfast sausage, Garlic cloves, Chopped thyme','&lt;p&gt;Stuffed pork tenderloins wrapped in bacon are a delectable combination of savory flavors and tender textures. This dish begins with succulent pork tenderloins, carefully sliced and filled with a flavorful stuffing mixture. Common fillings include a blend of herbs, breadcrumbs, garlic, and cheese, creating a burst of taste with every bite. To add an extra layer of richness and smokiness, the tenderloins are then wrapped in strips of bacon before being roasted to perfection. As the bacon cooks, it imparts its smoky essence into the pork, resulting in juicy, tender meat enveloped in a crispy, golden exterior. This dish is a true crowd-pleaser, perfect for special occasions or a comforting family meal.&lt;/p&gt;',1,2),(2007,'uploads/main-7.jpg','Strip steak frites with béarnaise butter',24.00,'Steaks, Potatoes, Béarnaise butter, White vinegar','&lt;p&gt;Strip steak frites with b&amp;eacute;arnaise butter is a luxurious and indulgent dish that combines the succulent flavor of strip steak with the crispiness of golden fries, topped with a decadent b&amp;eacute;arnaise butter sauce. The strip steak, known for its tender texture and robust beefy flavor, is typically seasoned with salt and pepper, then grilled or pan-seared to your desired level of doneness. The fries, often cut into thin strips and double-fried for extra crunchiness, provide the perfect accompaniment to the steak, adding a satisfying contrast in texture.&lt;/p&gt;',1,2),(2008,'uploads/main-8.jpg','Ratatouille',21.00,'Eggplants, Zucchini, Yellow onions, Red bell peppers','&lt;p&gt;Ratatouille is a classic French dish originating from the Provence region, renowned for its vibrant colors and rich flavors. Traditionally, it is a stewed vegetable medley consisting of eggplant, zucchini, bell peppers, tomatoes, onions, and garlic, all simmered together in olive oil until tender. The vegetables are often seasoned with a blend of aromatic herbs like thyme, basil, and oregano, adding depth and fragrance to the dish. Ratatouille can be served hot or cold and is versatile enough to be enjoyed as a main course, a side dish, or even as a topping for pasta or crusty bread. Its rustic charm and hearty taste make it a beloved dish both in France and around the world, perfect for showcasing the bounty of summer produce.&lt;/p&gt;',1,2);
/*!40000 ALTER TABLE `maincourses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `idReservation` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `book_date` date NOT NULL,
  `book_time` time NOT NULL,
  `person` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idReservation`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (13,'John Doe','john@example.com','1234567890','2024-06-12','18:00:00',4,'2024-06-12 10:57:31',1),(14,'Jane Smith','jane@example.com','9876543210','2024-06-13','19:00:00',2,'2024-06-12 10:57:31',1),(15,'Michael Brown','michael@example.com','5556667777','2024-06-14','20:00:00',3,'2024-06-12 10:57:31',0),(16,'Emily Johnson','emily@example.com','4443332222','2024-06-15','21:00:00',5,'2024-06-12 10:57:31',1),(17,'Alex Turner','alex@example.com','9998887777','2024-06-16','22:00:00',2,'2024-06-12 10:57:31',1),(18,'Sophia Garcia','sophia@example.com','1112223333','2024-06-17','18:30:00',3,'2024-06-12 10:57:31',0),(19,'William Wilson','william@example.com','4445556666','2024-06-18','19:30:00',4,'2024-06-12 10:57:31',1),(20,'Olivia Brown','olivia@example.com','7778889999','2024-06-19','20:30:00',2,'2024-06-12 10:57:31',1),(21,'James Martinez','james@example.com','2223334444','2024-06-20','21:30:00',3,'2024-06-12 10:57:31',0),(22,'Amelia Johnson','amelia@example.com','5554443333','2024-06-21','22:30:00',5,'2024-06-12 10:57:31',1),(23,'Michael Harris','michael@example.com','9991112222','2024-06-22','18:45:00',2,'2024-06-12 10:57:31',1),(24,'Emma Wilson','emma@example.com','6665554444','2024-06-23','19:45:00',3,'2024-06-12 10:57:31',0),(25,'Ethan Thomas','ethan@example.com','1112223333','2024-06-24','20:45:00',4,'2024-06-12 10:57:31',1),(26,'Isabella Anderson','isabella@example.com','3334445555','2024-06-25','21:45:00',2,'2024-06-12 10:57:31',1),(27,'Ava Jackson','ava@example.com','8889990000','2024-06-26','22:45:00',3,'2024-06-12 10:57:31',0),(28,'Noah White','noah@example.com','4445556666','2024-06-27','18:15:00',5,'2024-06-12 10:57:31',1),(29,'Sophia Brown','sophia@example.com','5556667777','2024-06-28','19:15:00',2,'2024-06-12 10:57:31',1),(30,'Benjamin Lee','benjamin@example.com','1112223333','2024-06-29','20:15:00',3,'2024-06-12 10:57:31',0),(31,'Mia Taylor','mia@example.com','4445556666','2024-06-30','21:15:00',4,'2024-06-12 10:57:31',1),(32,'Alexander Johnson','alexander@example.com','1112223333','2024-07-01','22:15:00',2,'2024-06-12 10:57:31',1);
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `starters`
--

DROP TABLE IF EXISTS `starters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `starters` (
  `idStarter` int NOT NULL AUTO_INCREMENT,
  `image_url` varchar(250) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `content` longtext,
  `active` tinyint(1) DEFAULT '1',
  `idCategory` int DEFAULT '1',
  PRIMARY KEY (`idStarter`)
) ENGINE=InnoDB AUTO_INCREMENT=8002 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `starters`
--

LOCK TABLES `starters` WRITE;
/*!40000 ALTER TABLE `starters` DISABLE KEYS */;
INSERT INTO `starters` VALUES (1001,'uploads/starter-1.jpg','Scottish smoked label salmon',15.00,'Salmon filet, Kosher salt, Brown sugar, Olive oil','&lt;p&gt;Scottish smoked salmon is a premium delicacy known for its rich, smooth texture and distinctive, smoky flavor. Produced using traditional methods, the salmon is typically sourced from the cold, clean waters of Scotland, ensuring high quality and freshness. The fish is cured with a mixture of salt and sometimes sugar, then cold-smoked over oak wood, which imparts a delicate, smoky aroma without cooking the fish, preserving its tender texture. Scottish smoked salmon is often enjoyed thinly sliced on its own, or as part of dishes such as bagels with cream cheese, salads, or canap&amp;eacute;s. Its refined taste and luxurious texture make it a favorite choice for special occasions and gourmet dining.&lt;/p&gt;',1,1),(1002,'uploads/starter-2.jpg','Ravioli with tomato sauce and dill',13.00,'Ravolli, Tomato sauce, Dill, Olive oil','&lt;p&gt;Ravioli with tomato sauce and dill is a delightful dish that marries the comforting flavors of Italian cuisine with a fresh herbal twist. The ravioli, typically filled with ingredients like ricotta cheese, spinach, or meat, are cooked until tender and then smothered in a rich, savory tomato sauce. The tomato sauce is usually made from ripe tomatoes, garlic, onions, olive oil, and a blend of herbs and spices, simmered to perfection. Adding a sprinkle of fresh dill to the dish introduces a unique, aromatic flavor that complements the acidity of the tomatoes and the creamy filling of the ravioli. This dish can be garnished with grated Parmesan cheese and a drizzle of olive oil, making it a delicious and sophisticated meal for any occasion.&lt;/p&gt;',1,1),(1003,'uploads/starter-3.jpg','Tuna salad with tomatoes',15.00,'Tuna fish, Boiled egg, Tomatoes, Lemon','&lt;p&gt;Tuna salad with tomatoes is a refreshing and nutritious dish that combines the savory flavors of tuna with the bright, juicy taste of fresh tomatoes. Typically made with flaked canned or seared tuna, the salad often includes chopped tomatoes, crisp lettuce or mixed greens, and other vegetables like cucumbers, red onions, and bell peppers. It is usually dressed with a light vinaigrette made from olive oil, lemon juice, salt, and pepper, although variations can include herbs, capers, or a touch of mustard for added flavor. This versatile salad can be enjoyed on its own, as a filling for sandwiches, or as a topping for toasted bread, making it a perfect option for a healthy, satisfying meal any time of the day.&lt;/p&gt;',1,1),(1004,'uploads/starter-4.jpg','Shrimps in batter with sauce',17.00,'Shrimps, Fresh vegetable salad, Lemon, Sauce','&lt;p&gt;Shrimps in batter with sauce, often known as shrimp tempura or battered shrimp, is a delectable seafood dish that combines the delicate flavor of shrimp with a crispy, golden exterior. The shrimp are typically peeled and deveined before being dipped in a light, airy batter made from flour, eggs, and cold water or soda water. They are then deep-fried to perfection, resulting in a crunchy coating that encases the tender, juicy shrimp inside. This dish is often accompanied by a dipping sauce, such as a tangy cocktail sauce, sweet chili sauce, or a savory soy-based tempura sauce, which complements the rich flavor of the shrimp. Popular as an appetizer or main course, shrimps in batter are a crowd-pleaser and a staple in various cuisines around the world.&lt;/p&gt;',1,1),(1005,'uploads/starter-5.jpg','Fried squid',17.00,'Calamari, Fresh vegetable salad, Lemon, Sauce','&lt;p&gt;Fried squid, often referred to as calamari, is a popular dish enjoyed in many culinary traditions around the world. The squid is typically cleaned and cut into rings or strips, then lightly coated in a seasoned batter or flour mixture. It is quickly fried until golden and crispy, resulting in a tender and flavorful seafood delicacy. Frequently served with a variety of dipping sauces such as marinara, aioli, or tartar sauce, fried squid is a favorite appetizer or snack. Its crunchy texture and savory taste make it a delightful dish, perfect for sharing at gatherings or enjoying as a light meal.&lt;/p&gt;',1,1),(1006,'uploads/starter-6.jpg','Steak tartare',18.00,'Beef fillet, Shallots, Cornichons, Yolk egg','&lt;p&gt;Steak tartare is a dish of raw ground beef or finely chopped high-quality steak, traditionally seasoned with various ingredients to enhance its flavor. The dish often includes finely chopped onions, capers, pickles, and fresh herbs, mixed with seasonings such as Worcestershire sauce, mustard, and hot sauce. It is typically served with a raw egg yolk on top, adding richness and depth to the dish. Steak tartare is usually accompanied by toasted bread or fries and is prized for its fresh, bold taste and delicate texture. This classic dish, often found in French cuisine, highlights the quality and flavor of the beef, making it a favorite among meat enthusiasts.&lt;/p&gt;',1,1),(1007,'uploads/starter-7.jpg','Chicken liver pâté',13.00,'Chicken livers, Onion, Double cream, Toast','&lt;p&gt;Chicken liver p&amp;acirc;t&amp;eacute; is a luxurious and flavorful spread that is a staple in many culinary traditions, particularly French cuisine. Made from finely chopped or pureed chicken livers, this p&amp;acirc;t&amp;eacute; is typically combined with ingredients such as butter, cream, onions, garlic, and a splash of brandy or cognac for added richness. The mixture is then seasoned with herbs and spices, creating a smooth, creamy texture and a savory taste. Often served chilled, chicken liver p&amp;acirc;t&amp;eacute; is commonly enjoyed as an appetizer or hors d&#039;oeuvre, spread on toasted bread or crackers. Its delicate yet robust flavor makes it a sophisticated addition to any gourmet spread.&lt;/p&gt;',1,1),(1008,'uploads/starter-8.jpg','French onion soup',14.00,'Onions, Beef stock, Butter, Parsley','&lt;p&gt;French onion soup is a classic dish originating from France, celebrated for its rich and savory flavor. Traditionally, it is made with caramelized onions simmered in a beef or chicken broth, often infused with wine or brandy, which adds depth to its taste. The soup is typically topped with a slice of toasted baguette and a generous layer of melted Gruy&amp;egrave;re cheese, then broiled until bubbly and golden. This comforting, aromatic soup is a favorite in French cuisine and is enjoyed worldwide, especially as a warm and hearty meal during the colder months.&lt;/p&gt;',1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'lejeune@mail.com','130580',1),(2,'guest@mail.com','1234',2),(3,'adrien@mail.com','password',1);
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

-- Dump completed on 2024-06-12 13:05:41
