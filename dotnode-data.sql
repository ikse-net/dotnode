-- MySQL dump 10.9
--
-- Host: localhost    Database: dotnode_alexx
-- ------------------------------------------------------
-- Server version	4.1.11-Debian_4sarge1-log
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO,MYSQL40' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `access`
--


/*!40000 ALTER TABLE `access` DISABLE KEYS */;
LOCK TABLES `access` WRITE;
INSERT INTO `access` VALUES ('354a778bacabffaff3d3fd74f93ac278','user_general','birthday','members'),('354a778bacabffaff3d3fd74f93ac278','user_contact','email','myself'),('354a778bacabffaff3d3fd74f93ac278','user_contact','email2','friends_of_friends'),('354a778bacabffaff3d3fd74f93ac278','user_contact','email3','friends'),('354a778bacabffaff3d3fd74f93ac278','user_contact','email4','friends'),('354a778bacabffaff3d3fd74f93ac278','user_contact','im','friends_of_friends'),('354a778bacabffaff3d3fd74f93ac278','user_contact','im2','friends_of_friends'),('354a778bacabffaff3d3fd74f93ac278','user_contact','phone','friends_of_friends'),('354a778bacabffaff3d3fd74f93ac278','user_contact','cell_phone','friends_of_friends'),('354a778bacabffaff3d3fd74f93ac278','user_contact','address','myself'),('354a778bacabffaff3d3fd74f93ac278','user_professional','company','everyone'),('354a778bacabffaff3d3fd74f93ac278','user_professional','email','members'),('354a778bacabffaff3d3fd74f93ac278','user_professional','phone','members'),('00112233445566778899001122334455','user_general','birthday','members'),('00112233445566778899001122334455','user_contact','email','myself'),('00112233445566778899001122334455','user_contact','email2','friends_of_friends'),('00112233445566778899001122334455','user_contact','email3','friends'),('00112233445566778899001122334455','user_contact','email4','friends'),('00112233445566778899001122334455','user_contact','im','friends_of_friends'),('00112233445566778899001122334455','user_contact','im2','friends_of_friends'),('00112233445566778899001122334455','user_contact','phone','friends_of_friends'),('00112233445566778899001122334455','user_contact','cell_phone','friends_of_friends'),('00112233445566778899001122334455','user_contact','address','myself'),('00112233445566778899001122334455','user_professional','company','everyone'),('00112233445566778899001122334455','user_professional','email','members'),('00112233445566778899001122334455','user_professional','phone','members'),('1353c20315c720ad6c88a498ccc1c1ac','user_general','birthday','everyone'),('1353c20315c720ad6c88a498ccc1c1ac','user_contact','email','members'),('1353c20315c720ad6c88a498ccc1c1ac','user_contact','im','friends_of_friends'),('1353c20315c720ad6c88a498ccc1c1ac','user_contact','phone','friends_of_friends'),('1353c20315c720ad6c88a498ccc1c1ac','user_contact','cell_phone','friends_of_friends'),('1353c20315c720ad6c88a498ccc1c1ac','user_contact','address','friends_of_friends'),('1353c20315c720ad6c88a498ccc1c1ac','user_professional','company','everyone'),('7fd5694bc166bbcc91c2ff72ad71dfd4','user_general','birthday','everyone'),('7fd5694bc166bbcc91c2ff72ad71dfd4','user_contact','email','members'),('7fd5694bc166bbcc91c2ff72ad71dfd4','user_contact','im','friends_of_friends'),('7fd5694bc166bbcc91c2ff72ad71dfd4','user_contact','phone','friends_of_friends'),('7fd5694bc166bbcc91c2ff72ad71dfd4','user_contact','cell_phone','friends_of_friends'),('7fd5694bc166bbcc91c2ff72ad71dfd4','user_contact','address','friends_of_friends'),('7fd5694bc166bbcc91c2ff72ad71dfd4','user_professional','company','members'),('28d956398f784ad039d48501c7ff66dd','user_general','birthday','everyone'),('28d956398f784ad039d48501c7ff66dd','user_contact','email','members'),('28d956398f784ad039d48501c7ff66dd','user_contact','im','friends_of_friends'),('28d956398f784ad039d48501c7ff66dd','user_contact','phone','friends_of_friends'),('28d956398f784ad039d48501c7ff66dd','user_contact','cell_phone','friends_of_friends'),('28d956398f784ad039d48501c7ff66dd','user_contact','address','friends_of_friends'),('28d956398f784ad039d48501c7ff66dd','user_professional','company','members');
UNLOCK TABLES;
/*!40000 ALTER TABLE `access` ENABLE KEYS */;

--
-- Dumping data for table `album`
--


/*!40000 ALTER TABLE `album` DISABLE KEYS */;
LOCK TABLES `album` WRITE;
INSERT INTO `album` VALUES ('354a778bacabffaff3d3fd74f93ac278',1,420,480,'jpeg','','2005-08-01 09:09:08'),('1353c20315c720ad6c88a498ccc1c1ac',2,885,708,'jpeg','Chat ou chien ?','2005-08-02 00:30:48'),('1353c20315c720ad6c88a498ccc1c1ac',3,885,708,'jpeg','C\'est de l\'art ca !','2005-08-02 00:31:40'),('1353c20315c720ad6c88a498ccc1c1ac',4,885,708,'jpeg','','2005-08-02 00:31:53'),('1353c20315c720ad6c88a498ccc1c1ac',5,885,708,'jpeg','ninac la mangeuse d\'oiseau','2005-08-02 00:32:02'),('1353c20315c720ad6c88a498ccc1c1ac',6,885,708,'jpeg','catator','2005-08-02 00:32:11');
UNLOCK TABLES;
/*!40000 ALTER TABLE `album` ENABLE KEYS */;

--
-- Dumping data for table `blog`
--


/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
LOCK TABLES `blog` WRITE;
INSERT INTO `blog` VALUES ('354a778bacabffaff3d3fd74f93ac278',1,1,'Un blog de test','Avec un entête optionnel','Et un contenu pour ne rien dire ...\r\n\r\nenfin .... bref ...\r\n\r\nTake courage !',0,1122880352,'online'),('354a778bacabffaff3d3fd74f93ac278',2,1,'truc avec une grand image','blabla','[[http://perso.wanadoo.fr/artgp/theatrearles/galerie/ex01.jpg]]',0,1124875229,'online');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;

--
-- Dumping data for table `blog_categorie`
--


/*!40000 ALTER TABLE `blog_categorie` DISABLE KEYS */;
LOCK TABLES `blog_categorie` WRITE;
INSERT INTO `blog_categorie` VALUES ('354a778bacabffaff3d3fd74f93ac278',1,'Catégorie blog','');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blog_categorie` ENABLE KEYS */;

--
-- Dumping data for table `blog_comment`
--


/*!40000 ALTER TABLE `blog_comment` DISABLE KEYS */;
LOCK TABLES `blog_comment` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `blog_comment` ENABLE KEYS */;

--
-- Dumping data for table `bookmarks`
--


/*!40000 ALTER TABLE `bookmarks` DISABLE KEYS */;
LOCK TABLES `bookmarks` WRITE;
INSERT INTO `bookmarks` VALUES ('354a778bacabffaff3d3fd74f93ac278',1,'humour','http://tc.apinc.org','Totalement Crétin',1122880217),('354a778bacabffaff3d3fd74f93ac278',2,'Dev','http://dev.dotnode.net','Dotnode Developpement platform',1122880246);
UNLOCK TABLES;
/*!40000 ALTER TABLE `bookmarks` ENABLE KEYS */;

--
-- Dumping data for table `bookmarks_cat`
--


/*!40000 ALTER TABLE `bookmarks_cat` DISABLE KEYS */;
LOCK TABLES `bookmarks_cat` WRITE;
INSERT INTO `bookmarks_cat` VALUES ('354a778bacabffaff3d3fd74f93ac278',1,0,'humour'),('354a778bacabffaff3d3fd74f93ac278',2,0,'Dev');
UNLOCK TABLES;
/*!40000 ALTER TABLE `bookmarks_cat` ENABLE KEYS */;

--
-- Dumping data for table `cache_user`
--


/*!40000 ALTER TABLE `cache_user` DISABLE KEYS */;
LOCK TABLES `cache_user` WRITE;
INSERT INTO `cache_user` VALUES ('354a778bacabffaff3d3fd74f93ac278','alexx','Alexandre','DATH',NULL,'A42536','D000',NULL,'France','male',25,'committed','friend,business,partners',1084260676,'y',3,'1353c20315c720ad6c88a498ccc1c1ac,7fd5694bc166bbcc91c2ff72ad71dfd4,00112233445566778899001122334455',1,'1',0,2,2,1,3.00,2.00,1.00),('00112233445566778899001122334455','moderator','Moderator','Moderator',NULL,'M3636','M3636',NULL,'France','male',1,'','',1084260676,'y',1,'354a778bacabffaff3d3fd74f93ac278',0,'',0,0,0,0,0.00,0.00,0.00),('1353c20315c720ad6c88a498ccc1c1ac','mdoe','John','Doe',NULL,'J500','D000',NULL,'France','male',0,'single','business,partners',1122934961,'y',1,'354a778bacabffaff3d3fd74f93ac278',0,'',1,0,29,5,3.00,0.00,0.00),('7fd5694bc166bbcc91c2ff72ad71dfd4','test','Test','toto',NULL,'T230','T000',NULL,'France','male',0,'single',NULL,1123530303,'n',2,'354a778bacabffaff3d3fd74f93ac278,28d956398f784ad039d48501c7ff66dd',0,'',0,0,0,0,0.00,0.00,0.00),('28d956398f784ad039d48501c7ff66dd','zetrezre','testes','tesezezfez',NULL,'T232','T212',NULL,'France','male',0,NULL,NULL,1123530566,'n',1,'7fd5694bc166bbcc91c2ff72ad71dfd4',0,'',0,0,0,0,0.00,0.00,0.00);
UNLOCK TABLES;
/*!40000 ALTER TABLE `cache_user` ENABLE KEYS */;

--
-- Dumping data for table `community`
--


/*!40000 ALTER TABLE `community` DISABLE KEYS */;
LOCK TABLES `community` WRITE;
INSERT INTO `community` VALUES ('354a778bacabffaff3d3fd74f93ac278',1,28,'.node lovers','Test community for dev purpose','no','France',1122843877,'ok',NULL,NULL,1,1122844134);
UNLOCK TABLES;
/*!40000 ALTER TABLE `community` ENABLE KEYS */;

--
-- Dumping data for table `community_cat`
--


/*!40000 ALTER TABLE `community_cat` DISABLE KEYS */;
LOCK TABLES `community_cat` WRITE;
INSERT INTO `community_cat` VALUES (1,'Activities','Things to do with 2 or more',0),(2,'Alumni & Schools','reconnect with friends from old school',0),(3,'Arts & Entertainment','About Movies, Opéra, Theather',0),(4,'Automotive','For automobile lovers',0),(5,'Business','Talk business, finance, and economy',0),(6,'Cities & Neighborhoods','For local discution and news',0),(7,'Company','Company discussing other company',0),(8,'Computers & Internet','',0),(9,'Countries & Regional','',0),(10,'Cultures & Community','',0),(11,'Family & Home','',0),(12,'Fashion & Beauty','',0),(13,'Food, Drink & Wine','',0),(14,'Games','',0),(15,'Government & Politics','',0),(16,'Health, Wellness & Fitness','',0),(17,'Hobbies & Crafts','',0),(18,'Individuals','',0),(19,'Music','',0),(20,'Pets & Animals','',0),(21,'Recreation & Sports','',0),(22,'Religion & Beliefs','',0),(23,'Romance & Relationships','',0),(24,'Education','',0),(25,'Science & History','',0),(26,'Travel','',0),(27,'Other','',0),(28,'.node','',0);
UNLOCK TABLES;
/*!40000 ALTER TABLE `community_cat` ENABLE KEYS */;

--
-- Dumping data for table `community_event`
--


/*!40000 ALTER TABLE `community_event` DISABLE KEYS */;
LOCK TABLES `community_event` WRITE;
INSERT INTO `community_event` VALUES (1,1,'354a778bacabffaff3d3fd74f93ac278','Alexandre','First event',1122984000,'dev.dotnode.net','Internet','France','Lancement de l\'ouverture du code de .node !\r\nHoura ! ;)',1122844267),(2,1,'354a778bacabffaff3d3fd74f93ac278','Alexandre','testesets',1124566680,'estsetse','testsetse','Antigua & Barbuda','test et zrez ',1123616309);
UNLOCK TABLES;
/*!40000 ALTER TABLE `community_event` ENABLE KEYS */;

--
-- Dumping data for table `community_keyword`
--


/*!40000 ALTER TABLE `community_keyword` DISABLE KEYS */;
LOCK TABLES `community_keyword` WRITE;
INSERT INTO `community_keyword` VALUES ('T230',1,28),('C530',1,28),('F600',1,28),('D100',1,28),('P612',1,28),('N300',1,28),('L160',1,28);
UNLOCK TABLES;
/*!40000 ALTER TABLE `community_keyword` ENABLE KEYS */;

--
-- Dumping data for table `community_post`
--


/*!40000 ALTER TABLE `community_post` DISABLE KEYS */;
LOCK TABLES `community_post` WRITE;
INSERT INTO `community_post` VALUES (1,1,1,'354a778bacabffaff3d3fd74f93ac278','Alexandre','First topic','For test only',1122844117),(2,1,1,'354a778bacabffaff3d3fd74f93ac278','Alexandre',NULL,'A ===simple=== response to the test //topic//\n[Modified on 10.08.2005 20:55]',1122844134);
UNLOCK TABLES;
/*!40000 ALTER TABLE `community_post` ENABLE KEYS */;

--
-- Dumping data for table `community_topic`
--


/*!40000 ALTER TABLE `community_topic` DISABLE KEYS */;
LOCK TABLES `community_topic` WRITE;
INSERT INTO `community_topic` VALUES (1,1,'354a778bacabffaff3d3fd74f93ac278','First topic',1122844117,'false','Alexandre',2,1122844134);
UNLOCK TABLES;
/*!40000 ALTER TABLE `community_topic` ENABLE KEYS */;

--
-- Dumping data for table `dntp_msgid`
--


/*!40000 ALTER TABLE `dntp_msgid` DISABLE KEYS */;
LOCK TABLES `dntp_msgid` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `dntp_msgid` ENABLE KEYS */;

--
-- Dumping data for table `dntp_msgstr`
--


/*!40000 ALTER TABLE `dntp_msgstr` DISABLE KEYS */;
LOCK TABLES `dntp_msgstr` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `dntp_msgstr` ENABLE KEYS */;

--
-- Dumping data for table `dntp_translator`
--


/*!40000 ALTER TABLE `dntp_translator` DISABLE KEYS */;
LOCK TABLES `dntp_translator` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `dntp_translator` ENABLE KEYS */;

--
-- Dumping data for table `dntp_translator_msgstr`
--


/*!40000 ALTER TABLE `dntp_translator_msgstr` DISABLE KEYS */;
LOCK TABLES `dntp_translator_msgstr` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `dntp_translator_msgstr` ENABLE KEYS */;

--
-- Dumping data for table `global_data`
--


/*!40000 ALTER TABLE `global_data` DISABLE KEYS */;
LOCK TABLES `global_data` WRITE;
INSERT INTO `global_data` VALUES ('nb_nodians','5'),('actually','1');
UNLOCK TABLES;
/*!40000 ALTER TABLE `global_data` ENABLE KEYS */;

--
-- Dumping data for table `invitation`
--


/*!40000 ALTER TABLE `invitation` DISABLE KEYS */;
LOCK TABLES `invitation` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `invitation` ENABLE KEYS */;

--
-- Dumping data for table `invitation_email`
--


/*!40000 ALTER TABLE `invitation_email` DISABLE KEYS */;
LOCK TABLES `invitation_email` WRITE;
INSERT INTO `invitation_email` VALUES ('1353c20315c720ad6c88a498ccc1c1ac','354a778bacabffaff3d3fd74f93ac278','Test','Debug','test-debug@dotnode.com','fr_FR','man','done','accepted',1122928681,0,NULL,'82.225.136.176'),('7fd5694bc166bbcc91c2ff72ad71dfd4','354a778bacabffaff3d3fd74f93ac278','Test','toto','test-arezarez@ikse.org','en_US','man','done','accepted',1123529926,0,NULL,'82.225.136.176'),('28d956398f784ad039d48501c7ff66dd','7fd5694bc166bbcc91c2ff72ad71dfd4','testes','tesezezfez','test-tsetez@ikse.org','es_ES','man','done','accepted',1123530490,0,NULL,'82.225.136.176'),('6721d31e857f92630c8dab94464525cb','354a778bacabffaff3d3fd74f93ac278','test','testsetsetes','tsets@ikse.org','fr_FR','man','doing',NULL,1124270971,0,NULL,'82.225.136.176');
UNLOCK TABLES;
/*!40000 ALTER TABLE `invitation_email` ENABLE KEYS */;

--
-- Dumping data for table `message`
--


/*!40000 ALTER TABLE `message` DISABLE KEYS */;
LOCK TABLES `message` WRITE;
INSERT INTO `message` VALUES ('354a778bacabffaff3d3fd74f93ac278',37,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','rezrezrez','rzerezrez','inbox','read',1123792949),('7fd5694bc166bbcc91c2ff72ad71dfd4',2,'28d956398f784ad039d48501c7ff66dd','testes','friend_invitation_accepted','one','testes has accepted your invitation','Thanks','inbox','new',1123530566),('354a778bacabffaff3d3fd74f93ac278',39,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','rezrezrzerzer','zrezrze zer ezr','inbox','new',1123792954),('354a778bacabffaff3d3fd74f93ac278',41,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' ez rezr ez rez','ez rez rezrez rez','inbox','new',1123792960),('354a778bacabffaff3d3fd74f93ac278',43,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' rez r','ezr ezrezr zerezrez rze','inbox','new',1123792965),('354a778bacabffaff3d3fd74f93ac278',45,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' ez rezr ezrezr ezr','ezrez rezrez rez rez rez','inbox','new',1123792970),('354a778bacabffaff3d3fd74f93ac278',47,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','r ezr ezrezr ezrez','rez rezr zerez rez','inbox','new',1123792975),('354a778bacabffaff3d3fd74f93ac278',49,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' rez rzerezrezezr ezr ezr','r ez rezr ezr ezrezrez ','inbox','new',1123792981),('354a778bacabffaff3d3fd74f93ac278',51,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' ez rezr ezrez rezr ezrez','r ezr ezzer ezrezr ez','inbox','new',1123792987),('354a778bacabffaff3d3fd74f93ac278',53,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','r ezr ezrezrezrzrez e rez',' rezr ezrezr ezrez','inbox','new',1123792993),('354a778bacabffaff3d3fd74f93ac278',55,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','ezr ezrezre','zr ezr zerezrez rezrez','inbox','new',1123792999),('354a778bacabffaff3d3fd74f93ac278',57,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','rez reza rezarez arezarza rez','arez rezare razer zar','save','read',1123793005),('354a778bacabffaff3d3fd74f93ac278',59,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','rtret retrezterz t','rezt ertreztreztez','inbox','new',1123793010),('354a778bacabffaff3d3fd74f93ac278',61,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','tre tzete ztrezt rez','treztrez trezt rezt rez','inbox','new',1123793015),('354a778bacabffaff3d3fd74f93ac278',103,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','fdsvfdsvfvfds','vfdsvfds vfds vfdsvfdv','inbox','read',1123793108),('354a778bacabffaff3d3fd74f93ac278',66,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','tr ezt reztrez tre','zt reztreztr ez','inbox','new',1123793023),('354a778bacabffaff3d3fd74f93ac278',68,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' trez treztreztreztre z','tre terzt reztrez','inbox','new',1123793027),('354a778bacabffaff3d3fd74f93ac278',70,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' trez erzt reztrezter trez','t rezt ezrt er','inbox','new',1123793032),('354a778bacabffaff3d3fd74f93ac278',72,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' rte treztre ztrezt ezrt',' tret erzt retreztrez','inbox','new',1123793039),('354a778bacabffaff3d3fd74f93ac278',74,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','tre trezt rezt reztrez','t rezt rezt e trez','inbox','new',1123793043),('354a778bacabffaff3d3fd74f93ac278',76,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','t retr eztret','ertez tez trze','save','read',1123793051),('354a778bacabffaff3d3fd74f93ac278',78,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','t rezt reztrez trez','t rezt reztreztez','inbox','read',1123793055),('354a778bacabffaff3d3fd74f93ac278',80,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','trezatrz','treazt etre ','inbox','read',1123793059),('354a778bacabffaff3d3fd74f93ac278',82,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','trez trezt erz','t reztrezt rezt rezt rez','inbox','read',1123793064),('354a778bacabffaff3d3fd74f93ac278',84,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','eztreztez','tre ztrez tr','inbox','new',1123793067),('354a778bacabffaff3d3fd74f93ac278',86,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','zetret ez','trez trez terztr','inbox','new',1123793070),('354a778bacabffaff3d3fd74f93ac278',88,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','trez terz etez','t rez trezt ezt','inbox','new',1123793074),('354a778bacabffaff3d3fd74f93ac278',90,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','t rezt rez','t rez treztrezt ezt ','save','read',1123793079),('354a778bacabffaff3d3fd74f93ac278',92,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','cxwvdsqvdfsq','tre ebcwvcxwvcxwvcxwvcxw','inbox','new',1123793083),('354a778bacabffaff3d3fd74f93ac278',94,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','vfdvdfqvfdq','vfdsqvfdqvfdqvfdq','save','read',1123793088),('354a778bacabffaff3d3fd74f93ac278',96,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','vfdsvfdsvf','vfdqvfdqvfdsvfdsvsdfv','inbox','new',1123793093),('354a778bacabffaff3d3fd74f93ac278',98,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','vfd fdsv fdsvfds vfds','vfdsvfdsvfds vdqzervf\r\n','inbox','read',1123793099),('354a778bacabffaff3d3fd74f93ac278',35,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','test','test','inbox','new',1123792943),('354a778bacabffaff3d3fd74f93ac278',36,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','test','test','send','read',1123792943),('354a778bacabffaff3d3fd74f93ac278',38,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','rezrezrez','rzerezrez','send','read',1123792949),('354a778bacabffaff3d3fd74f93ac278',40,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','rezrezrzerzer','zrezrze zer ezr','send','read',1123792954),('354a778bacabffaff3d3fd74f93ac278',42,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' ez rezr ez rez','ez rez rezrez rez','send','read',1123792960),('354a778bacabffaff3d3fd74f93ac278',44,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' rez r','ezr ezrezr zerezrez rze','send','read',1123792965),('354a778bacabffaff3d3fd74f93ac278',46,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' ez rezr ezrezr ezr','ezrez rezrez rez rez rez','send','read',1123792970),('354a778bacabffaff3d3fd74f93ac278',48,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','r ezr ezrezr ezrez','rez rezr zerez rez','send','read',1123792975),('354a778bacabffaff3d3fd74f93ac278',50,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' rez rzerezrezezr ezr ezr','r ez rezr ezr ezrezrez ','send','read',1123792981),('354a778bacabffaff3d3fd74f93ac278',52,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' ez rezr ezrez rezr ezrez','r ezr ezzer ezrezr ez','send','read',1123792987),('354a778bacabffaff3d3fd74f93ac278',54,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','r ezr ezrezrezrzrez e rez',' rezr ezrezr ezrez','send','read',1123792993),('354a778bacabffaff3d3fd74f93ac278',56,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','ezr ezrezre','zr ezr zerezrez rezrez','send','read',1123792999),('354a778bacabffaff3d3fd74f93ac278',58,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','rez reza rezarez arezarza rez','arez rezare razer zar','send','read',1123793005),('354a778bacabffaff3d3fd74f93ac278',60,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','rtret retrezterz t','rezt ertreztreztez','send','read',1123793010),('354a778bacabffaff3d3fd74f93ac278',62,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','tre tzete ztrezt rez','treztrez trezt rezt rez','send','read',1123793015),('354a778bacabffaff3d3fd74f93ac278',64,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','tre treztr ezt','rezt reztez','inbox','new',1123793019),('354a778bacabffaff3d3fd74f93ac278',65,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','tre treztr ezt','rezt reztez','send','read',1123793019),('354a778bacabffaff3d3fd74f93ac278',67,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','tr ezt reztrez tre','zt reztreztr ez','send','read',1123793023),('354a778bacabffaff3d3fd74f93ac278',69,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' trez treztreztreztre z','tre terzt reztrez','send','read',1123793027),('354a778bacabffaff3d3fd74f93ac278',71,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' trez erzt reztrezter trez','t rezt ezrt er','send','read',1123793032),('354a778bacabffaff3d3fd74f93ac278',73,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one',' rte treztre ztrezt ezrt',' tret erzt retreztrez','send','read',1123793039),('354a778bacabffaff3d3fd74f93ac278',75,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','tre trezt rezt reztrez','t rezt rezt e trez','send','read',1123793043),('354a778bacabffaff3d3fd74f93ac278',77,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','t retr eztret','ertez tez trze','send','read',1123793051),('354a778bacabffaff3d3fd74f93ac278',79,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','t rezt reztrez trez','t rezt reztreztez','send','read',1123793055),('354a778bacabffaff3d3fd74f93ac278',81,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','trezatrz','treazt etre ','send','read',1123793059),('354a778bacabffaff3d3fd74f93ac278',83,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','trez trezt erz','t reztrezt rezt rezt rez','send','read',1123793064),('354a778bacabffaff3d3fd74f93ac278',85,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','eztreztez','tre ztrez tr','send','read',1123793067),('354a778bacabffaff3d3fd74f93ac278',87,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','zetret ez','trez trez terztr','send','read',1123793070),('354a778bacabffaff3d3fd74f93ac278',89,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','trez terz etez','t rez trezt ezt','send','read',1123793074),('354a778bacabffaff3d3fd74f93ac278',91,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','t rezt rez','t rez treztrezt ezt ','send','read',1123793079),('354a778bacabffaff3d3fd74f93ac278',93,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','cxwvdsqvdfsq','tre ebcwvcxwvcxwvcxwvcxw','send','read',1123793083),('354a778bacabffaff3d3fd74f93ac278',95,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','vfdvdfqvfdq','vfdsqvfdqvfdqvfdq','send','read',1123793088),('354a778bacabffaff3d3fd74f93ac278',97,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','vfdsvfdsvf','vfdqvfdqvfdsvfdsvsdfv','send','read',1123793093),('354a778bacabffaff3d3fd74f93ac278',99,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','vfd fdsv fdsvfds vfds','vfdsvfdsvfds vdqzervf\r\n','send','read',1123793099),('354a778bacabffaff3d3fd74f93ac278',101,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','vfdsvfdsvf','vfdxvfdvfdsqvfdsgvfdsvds','save','read',1123793104),('354a778bacabffaff3d3fd74f93ac278',102,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','vfdsvfdsvf','vfdxvfdvfdsqvfdsgvfdsvds','send','read',1123793104),('354a778bacabffaff3d3fd74f93ac278',104,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','fdsvfdsvfvfds','vfdsvfds vfds vfdsvfdv','send','read',1123793108),('354a778bacabffaff3d3fd74f93ac278',107,'354a778bacabffaff3d3fd74f93ac278','Alexandre','message','one','Diff entre pagination à l\'ancienne et avec Pager_dotnode :)','Index: inbox.inc.php\r\n===================================================================\r\n--- inbox.inc.php       (revision 15)\r\n+++ inbox.inc.php       (working copy)\r\n@@ -22,33 +22,12 @@\r\n  * Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.\r\n  ******************** http://opensource.ikse.net/projects/dotnode ***/\r\n \r\n+include(INCLUDESPATH.\'/pager.inc.php\');\r\n+\r\n $_SMARTY[\'Title\'] =  \'Messages\';\r\n \r\n-/** Pagination ***************/\r\n-$pagination[\'nb_elements\'] = $db->getOne(\'SELECT COUNT(id) FROM message WHERE id=? AND box=?\', array($_SESSION[\'my_id\'], \'inbox\') );\r\n-$pagination[\'elmt_by_page\'] = 20;\r\n-if($pagination[\'nb_elements\'] > 0)\r\n-       $pagination[\'nb_pages\'] = ceil($pagination[\'nb_elements\']/$pagination[\'elmt_by_page\']);\r\n-else\r\n-       $pagination[\'nb_pages\'] = 1;\r\n+$messages_r = $db->query(\'SELECT id_mess, id_from, from_str, type, dest, subject, message, flag, date FROM message WHERE id=? AND box=? ORDER by date DESC\', array($_SESSION[\'my_id\'],\'inbox\'));\r\n \r\n-if(is_numeric($token[2]) && \r\n-   $token[2] <= $pagination[\'nb_pages\'] && \r\n-   $token[2] > 0 )\r\n-       $pagination[\'current_page\'] = $token[2];\r\n-else\r\n-{\r\n-       header(\'Location: /messages/inbox/1\');\r\n-       exit();\r\n-}\r\n-\r\n-$pagination[\'pages\'] = @array_fill(1,$pagination[\'nb_pages\'], NULL);\r\n-\r\n-$_SMARTY[\'pagination\'] =  $pagination;\r\n-/******************************/\r\n-\r\n-$messages_r = $db->query(\'SELECT id_mess, id_from, from_str, type, dest, subject, message, flag, date FROM message WHERE id=? AND box=? ORDER by date DESC LIMIT ?,?\', array($_SESSION[\'my_id\'],\'inbox\',  ($pagination[\'current_page\']-1)*$pagination[\'elmt_by_page\'], $pagination[\'elmt_by_page\']));\r\n-\r\n if(!DB::isError($messages_r) )\r\n while($message = $messages_r->fetchRow())\r\n        $messages[$message[\'id_mess\']] = $message;\r\n@@ -58,6 +37,10 @@\r\n $_SESSION[\'nb_new_messages\'] = $db->getOne(\'SELECT COUNT(id_mess) FROM message WHERE id=? AND box=? AND flag=?\', array($_SESSION[\'my_id\'], \'inbox\', \'new\'));\r\n $_SESSION[\'nb_new_messages_timestamp\'] = 1;\r\n \r\n+$pager =& Pager_dotnode::factory($messages);\r\n+$links = $pager->getPageData();\r\n \r\n-$_SMARTY[\'messages\'] =  $messages;\r\n+$_SMARTY[\'pager\'] = $pager->getLinks();\r\n+$_SMARTY[\'messages\'] = $pager->getPageData();\r\n+\r\n ?>\r\n','send','read',1123808836);
UNLOCK TABLES;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;

--
-- Dumping data for table `metalbum`
--


/*!40000 ALTER TABLE `metalbum` DISABLE KEYS */;
LOCK TABLES `metalbum` WRITE;
INSERT INTO `metalbum` VALUES ('354a778bacabffaff3d3fd74f93ac278','flickr','alex-ikse',NULL),('354a778bacabffaff3d3fd74f93ac278','dotnode','alexx',NULL),('354a778bacabffaff3d3fd74f93ac278','interalbum','alexx',NULL);
UNLOCK TABLES;
/*!40000 ALTER TABLE `metalbum` ENABLE KEYS */;

--
-- Dumping data for table `relation`
--


/*!40000 ALTER TABLE `relation` DISABLE KEYS */;
LOCK TABLES `relation` WRITE;
INSERT INTO `relation` VALUES ('354a778bacabffaff3d3fd74f93ac278','00112233445566778899001122334455',0,0,0,0,'havent_seen','other',1124147539),('00112233445566778899001122334455','354a778bacabffaff3d3fd74f93ac278',0,0,0,0,'havent_seen','other',1116620277),('1353c20315c720ad6c88a498ccc1c1ac','354a778bacabffaff3d3fd74f93ac278',2,3,1,0,'havent_seen','internet',1124460803),('354a778bacabffaff3d3fd74f93ac278','1353c20315c720ad6c88a498ccc1c1ac',0,3,0,1,'havent_seen','work',1124403156),('7fd5694bc166bbcc91c2ff72ad71dfd4','354a778bacabffaff3d3fd74f93ac278',0,0,0,0,'friend','internet',1123530409),('354a778bacabffaff3d3fd74f93ac278','7fd5694bc166bbcc91c2ff72ad71dfd4',0,0,0,0,'friend','internet',1124147557),('28d956398f784ad039d48501c7ff66dd','7fd5694bc166bbcc91c2ff72ad71dfd4',0,0,0,0,'friend','internet',1123530582),('7fd5694bc166bbcc91c2ff72ad71dfd4','28d956398f784ad039d48501c7ff66dd',0,0,0,0,'friend','internet',0);
UNLOCK TABLES;
/*!40000 ALTER TABLE `relation` ENABLE KEYS */;

--
-- Dumping data for table `rss_blog`
--


/*!40000 ALTER TABLE `rss_blog` DISABLE KEYS */;
LOCK TABLES `rss_blog` WRITE;
INSERT INTO `rss_blog` VALUES ('1353c20315c720ad6c88a498ccc1c1ac',1,'Open .node: {1} Active Tickets','http://opensource.ikse.net/projects/dotnode/report/1','http://opensource.ikse.net/projects/dotnode/report/1?format=rss');
UNLOCK TABLES;
/*!40000 ALTER TABLE `rss_blog` ENABLE KEYS */;

--
-- Dumping data for table `rss_blog_ticket`
--


/*!40000 ALTER TABLE `rss_blog_ticket` DISABLE KEYS */;
LOCK TABLES `rss_blog_ticket` WRITE;
INSERT INTO `rss_blog_ticket` VALUES ('1353c20315c720ad6c88a498ccc1c1ac',1,'d786c560e72e04f4312c4ce3242276f7','#1: .node ne détecte pas si les cookies ne sont pas activés ...','Dotnode devrait prevenir qu\'il a detecté que les cookies ne sont pas activé et indiquer a l\'utilisateur que c\'est indispensable...',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/1',1122803681),('1353c20315c720ad6c88a498ccc1c1ac',1,'b68aae197bfc4830bf8748f4da9a639e','#7: installation','Il faudrait un manuel pour montrer comment l\'installer. Ou un petit ou d\'installation.\nJusqu\'a maintenant je n\'ai reussi qu\'avoir la page d\'accueil en anglais, en bidouillant. Aucune autre page...',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/7',1123247174),('1353c20315c720ad6c88a498ccc1c1ac',1,'94cd13e6df338a0222c79c5daba695a7','#3: bug sur la page d\'affichage des communautés','voila pour que ce soit plus clair j\'ai fait un screen :\n[http://home.geekdrop.org/~ucode/screen.dotnode.png screen]\n\nceertaines lignes ds le rappel des derniers messages de la communauté apparaissent grises, et la date du dernier post n\'apparait pas, est-ce normal ou non ?',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/3',1123179234),('1353c20315c720ad6c88a498ccc1c1ac',1,'03a16c3297daa97fd4249bac938830cf','#5: Impossibilité d\'invité une personne, qui a déja été invité, mais qui ne s\'est pas encore inscrite','En voulant invité une personne, le système m\'a prévenu qu\'une autre personne l\'a déja faite, si cette personne n\'a pas reçu le mail, ou ne sais pas inscrite antérieurement, il est impossible d\'aller plus loin.\n\nLe mieux c\'est que le système renvoi un mail d\'inscription, avec le nom de la première personne qui l\'a inscrite.',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/5',1123229011),('1353c20315c720ad6c88a498ccc1c1ac',1,'88d4e15e7714314cd78626d69047816e','#4: Problème d\'index sur la page Rechercher','Quand on va sur la page Rechercher et que l\'on fait une recherche quelquonque dont le résultat s\'étale sur plusieurs pages, on remarque la chose suivante:\n\nLe monsieur (ou la madame) qui se retrouve le(la) dernièr(e) en bas de la page N, est le(la) premièr(e) de la page N+1.\n\nJe suppute que c\'est un petit problème d\'index.\n\nSi c\'était voulu, désolé d\'avoir ouvert un ticket pour rien :)\n\nR ',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/4',1123188615),('1353c20315c720ad6c88a498ccc1c1ac',1,'1e44aa695e397834b56b9a8be5003b20','#9: Ajouter son propre fichier FOAF','Avoir la possibilité d\'ajouter son propre fichier FOAF.\n\nDeux possibilité : \n- Utiliser son fichier qu\'on envoi sur le serveur.\n- Donner un lien vers son fichier FOAF déjà en ligne.',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/9',1123320769),('1353c20315c720ad6c88a498ccc1c1ac',1,'183e0bc7ff140c8fb39788c8f1e7cdf0','#10: Ajouter la langue &#34;Catalan&#34;','Le traducteur en charge du catalan a terminé sa traduction.\nJe l\'ajoute à l\'arrache dans dotnode.com, il faut maintenant que je l\'ajoute proprement dans \"Open .node\".',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/10',1123345279),('1353c20315c720ad6c88a498ccc1c1ac',1,'3a5211871b71750f4563c0112f42e8a1','#11: Jabber On DotNode','Ajout d\'un support jabber compte client <--> compte jabber\nhttp://freshmeat.net/projects/classjabberphp/\nhttp://cjphp.netflint.net/\n\n- création ou reception d\'un compte\n- import des contacts existants (+ invitation dans dotnode)\n- ajout des contacts dotnode dans les contacts jabber\n- messagerie instantannées en ligne',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/11',1123487077),('1353c20315c720ad6c88a498ccc1c1ac',1,'fcd70799866f711b85da4b5052f2c833','#14: conf smarty/cache dupliquée dans divers fichiers php','La conf de base de smarty (tous les _dir), la création de l\'objet smarty lui meme, et tout ce qui s\'ensuit (tous les $smarty->register_*), sont dupliquées dans tous les fichiers php qui ont besoin de ce dernier. Si ya une raison, je veux bien l\'entendre, sinon ca serait pratique d\'avoir tout ca dans un fichier a part, appellé a chaque fois. A la limite, faudra réfléchir a un truc pour ne pas appeller les register_* et leurs amis lorsque cela n\'est pas nécessaire, mais c\'est amha pas tellement important.\n\nNote: ne pas confondre avec smarty/configs/, que personellement je n\'ai jamais utilisé, et qui permet si j\'en crois la doc smarty d\'avoir des variables pré-assignées a utiliser ensuite dans les templates.',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/14',1123545899),('1353c20315c720ad6c88a498ccc1c1ac',1,'997b6573bb06f490a997761a889bb72d','#15: Error 11/12/13','Dans les fichiers php dans /actions/my/blog/ un peu partout, il est fait référence a diverses erreurs en numérique, telles que /error/11/, /error/12/, etc.\n\nJe ne trouve nulle part ailleurs cette syntaxe pour les erreurs, et pas dans le fichier dotnode-error.php en tout cas, donc ca balance un \'Unknown Error\'.\n\nVieux truc jamais corrigé ? J\'ai un vague souvenir que les premieres versions de dotnode au moins utilisaient des urls de ce type pour les erreurs.',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/15',1123550413),('1353c20315c720ad6c88a498ccc1c1ac',1,'32ff7c28664639f1551cddd2e53e633b','#16: Evenements: champ pays','Le champ pays lors de la création d\'un événement d\'une communauté est enregistrée.\n\nLorsqu\'on édite l\'événement, le champ pays est vide.\nLa liste des pays n\'est pas disponible.\n\nLorsqu\'on enregistre l\'événement après l\'avoir éditer, on perd donc le champ pays.\n',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/16',1123608278),('1353c20315c720ad6c88a498ccc1c1ac',1,'be9a322b1560422da8bd19f4d5e55e98','#17: Plusieurs images qui tournent pour la meme communauté','Idée honteusement piquée de http://dotnode.com/communities/viewTopic/5284 :\n\nUn truc qui serait pas mal, ca serait d\'avoir la possibilité d\'avoir plusieurs images qui tournent aleatoirement pour chaque communauté (voire meme chaque profil, mais on verra ca apres :). \n\nJ\'ai fait un rapide passage dans le code d\'affichage d\'une communauté et ca ne semble pas tres sorcier, faudrait genre garder dans un coin de la base le nombre total de logos, les stocker soit dans un repertoire a part (ok, ya deja un hash sur 2 niveaux, c\'est ptet trop), soit avec un nom de fichier genre idcomm_idimage.png, et faire un random dessus.',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/17',1123713142),('1353c20315c720ad6c88a498ccc1c1ac',1,'5bc48aacfa9a2cf9b63fdb95b95dadce','#20: Pagination difficile a utiliser ?','Je trouve la pagination (dans les albums des gens, dans les messages) assez difficile a remarquer et a utiliser. Comme il n\'y a que des liens vers les chiffres, la zone de clic est assez petite. Par ailleurs, pour aller a la page suivante ou précédente il faut en plus discerner la page actuelle (pas difficile, mais ca prend 1/2 seconde supplémentaire ^^).\n\nJ\'ai pas nécessairement beaucoup d\'idées sur le sujet, mais au moins des fleches pour faire suivant / precedent (« et » par exemple, mais en utf8 ya plein de caracteres sympa pour genre ← et →, chercher arrow dans gucharmap :), avec un accesskey dessus (je propose &lt; et &gt;, utilisés au moins sur linuxfr et skyblog :), ca serait pas mal.',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/20',1123713943),('1353c20315c720ad6c88a498ccc1c1ac',1,'bb569e9d3d6bd054757955f917772fc5','#18: Album pour une communauté','Idée sympa : un album partagé entre les membres d\'une meme communautée, modérée par le créateur de la communauté (qui activerait ou non l\'option). Ca serait pratique pour pouvoir mettre des photos d\'une rencontre, par exemple.',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/18',1123713237),('1353c20315c720ad6c88a498ccc1c1ac',1,'e2f0631129dd725db652d63d2062c50d','#19: Commentaires (optionels) pour les images des albums','Ca serait ptet pas mal de pouvoir commenter en option les images de albums des gens (Et si on fait #18 , des communautés, donc attention a faire du code réutilisable). Par contre, pour voir les commentaires et en déposer il faudrait etre identifié je pense.',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/19',1123713409),('1353c20315c720ad6c88a498ccc1c1ac',1,'b64af0bea382ce9862df7bc72de90dff','#21: impossible de gerer les categories des signets','Ou est la gestion des categories des signets ?',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/21',1123753866),('1353c20315c720ad6c88a498ccc1c1ac',1,'070098a277a3692ff00247ef47b3e991','#22: Orthographe ?','Sur la page d\'affichage du blog, il est ecrit \"0 commentaire\".\n\nUn \'s\' suplementaire a \'commentaire\' me semble plus juste dans ce cas precis.\n\nA vous de faire la correction si cela vous semble necessaire...',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/22',1123770199),('1353c20315c720ad6c88a498ccc1c1ac',1,'5e584a6d614064569b84f2c1fbcc5bee','#24: Création d\'objet de base pour manipuler les données de .node','Creer des objets simples et cohérents pour manipuler les différents types d\'ensemble de données que contient .node.\n\nPar exemple:\n * une class User pour manipuler les données d\'un membre, voir meme de sois meme (on peut imaginer que dans le cas ou le User est soi-meme, cela soit une class qui hérite de User et ajoute qq méthode spécifique (pour la configuration par exemple)).\n * une classe Community, Forum, Event, Topic, Post ...\n * une classe Album, Image, ...\n * une classe Message \n * une classe Bookmark\n * une classe Blog, Ticket',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/24',1123809723),('1353c20315c720ad6c88a498ccc1c1ac',1,'885ba5c1889566efb6513c30cd7671be','#25: Et les geeks ?','Dans la partie : \"Vit avec\", il manque l\'option :\n\n\"Avec ses ordinateurs...\"\n\nCa pourrait etre marrant a rajouter ^_^.',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/25',1123817375),('1353c20315c720ad6c88a498ccc1c1ac',1,'ad6407b8db62dc741e1ddbb416ac8897','#26: Bloquer les nouveaux messages d\'une communauté, autoriser pour certains','Si une communauté devient obsolète, ou bien subit un \"flood\" de messages,\nil doit être possible pour le modérateur de bloquer les nouveaux messages...\n\naccessoirement il devrait être possible pour le modérateur lui-même, de poster des messages malgré l\'interdiction, et peut-etre de pouvoir sélectionner des personnes ayant le droit de poster des messages... (équivalent au mode +m des chans IRC)\n\n',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/26',1123970863),('1353c20315c720ad6c88a498ccc1c1ac',1,'1529713852c1812c1e34138a94c8a665','#27: &lt;tags html&gt;On peu pas ?&lt;/tags html&gt;','J\'aimerai bien pouvoir agréementer les forums et mes blog d\'images. On pourait fait que un tag permette de récuperer des images dans l\'abum ou sur des url distante.\nDes tags pour mettre \'\'\'en gras\'\'\', en \'\'italique\'\' en <h3> et ces petits trucs qui facilitent la lisibilité, ca serait sympa je trouve.',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/27',1123975552),('1353c20315c720ad6c88a498ccc1c1ac',1,'ec4214ac1547fe7905f3a7f8788759a8','#28: Ajouter des liens dans la barre à gauche sous la photo','Ce serait bien de pouvoir ajouter des liens sous la photo dans la barre à gauche, des liens que l\'on voudrait toujours présents : Mon CV, par exemple, ou Mon site perso, etc...\n\nDonc à la limite, quand on ajoute un lien, faire une case a cocher pour faire apparaitre le lien dans la barre de gauche...',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/28',1124109274),('1353c20315c720ad6c88a498ccc1c1ac',1,'ee7954996b64496148295769c3e0bebf','#29: suppression d\'une invitation en attente','impossible de supprimer une invitation en attente dans la rubrique Amis > Invitation. J\'utilise FireFox sur MacOSX.',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/29',1124267448),('1353c20315c720ad6c88a498ccc1c1ac',1,'a124f0ad3cc755a392e87c64c1bf1460','#30: Birthday reminder','Je viens de louper d\'une journée l\'anniversaire de babayou, ca serait bien d\'activer/de faire marcher la notification d\'anniversaire qui arrive pour éviter ca a l\'avenir :)',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/30',1124305299),('1353c20315c720ad6c88a498ccc1c1ac',1,'5179c982a301775881383c72592d90ec','#31: Message d\'erreur au login','Le message d\'erreur qui apparais lors d\'un mauvais mot de passe ou d\'un mauvais login et est anglais. Ceci même si la langue par défaut et le français.\n\n',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/31',1124368245),('1353c20315c720ad6c88a498ccc1c1ac',1,'4d9f6be2e48fa26a69fda58323fb9bef','#33: Orthographic corrector','It would be find to have an orthographic corrector on message boxes, just like GMail have.\n',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/33',1124369003),('1353c20315c720ad6c88a498ccc1c1ac',1,'12b7aeb3c65055619d75c9488b1f88c9','#32: Un feminin a .nodien ?','Quand on va sur la page d\'une personne en haut s\'affiche .nodien depuis XX XX et cela pour les filles comme pour les garçons. Peut être que pour les filles un petit .nodienne ?\n\nBon ce n’est pas super important.\n',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/32',1124368949),('1353c20315c720ad6c88a498ccc1c1ac',1,'78a0ff2ee5c2d7b4c81c2912d0d847be','#35: secure mode','Would be great if the password was not travelling uncrypted through the web. We should perhaps use a HTTPS login, no ?',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/35',1124376138),('1353c20315c720ad6c88a498ccc1c1ac',1,'6161dc82ecff84b06b9e673f735e9c9f','#36: Rajouter des petites icones un peu partout','Ca serait plus agreable .node avec des icones un peu partout. Ya des icones libres qui trainent (notamment celles de gnome, genre [http://jimmac.musichall.cz/icons.php chez jimmac]), donc qu\'est ce qu\'on attend :)\n\nCa devrait etre desactivable... ou pas. Ptet utiliser la CSS uniquement pour, a voir.\nFaudrait compiler une grosse liste des actions possibles dans .node, en commencant par les trucs de base, [DesIconesPourDotnode ca se passe par la].',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/36',1124405564),('1353c20315c720ad6c88a498ccc1c1ac',1,'455fd8a87326c84311b65bca66bfa9cd','#37: redimensionnement automatique des images sur les blogs','Peut-être qu\'il faudrait mettre en place un système de redimensionnement automatique des images sur les blogs afin d\'éviter les débordement inesthétiques genre http://dotnode.com/blog/11bbcdcb2d5d248eb76658d5cdf72aeb/view/3529',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/37',1124871173),('1353c20315c720ad6c88a498ccc1c1ac',1,'f3b718624c9679c5620d7328a168c476','#38: petite erreur de traduction','Bonjour\n\nje viens juste vous signaler que \"allemand\" (la langue) se dit Deutsch et non pas Deutch\n\nCordialement, \n\nS.Dumont',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/38',1125485279),('1353c20315c720ad6c88a498ccc1c1ac',1,'7c070d0a38f379669eee02cb01e675fc','#39: Mise en avant des nouveautés et nouveaux contenus ou réponses','Il pourait être agréable d\'ajouter :\n\n - des flux RSS dédiés par communautés...\n\n - affichage de réponse ou de nouveau message dans les forums\n   (je pense aux forums type phpBB)\n\n - des notifications et avertissements sur la page d\'accueil avec la liste des nouveaux\n   membres, nouvelles communautés, réponses à un post sur le forum d\'une communauté ou\n   nouvelle réponse à un sujet auquel on a répondu.\n',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/39',1125507609);
UNLOCK TABLES;
/*!40000 ALTER TABLE `rss_blog_ticket` ENABLE KEYS */;

--
-- Dumping data for table `session`
--


/*!40000 ALTER TABLE `session` DISABLE KEYS */;
LOCK TABLES `session` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `session` ENABLE KEYS */;

--
-- Dumping data for table `settings`
--


/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
LOCK TABLES `settings` WRITE;
INSERT INTO `settings` VALUES ('354a778bacabffaff3d3fd74f93ac278','','email','','email','','','','','yes','mauzilla','Message d\'invitation de test de dev...');
UNLOCK TABLES;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

--
-- Dumping data for table `todo`
--


/*!40000 ALTER TABLE `todo` DISABLE KEYS */;
LOCK TABLES `todo` WRITE;
INSERT INTO `todo` VALUES (1,'send_password','email=alex@ikse.net','doing',1122915296,'354a778bacabffaff3d3fd74f93ac278','82.225.136.176','fr_FR'),(2,'modif_email','email=alexx@dotnode.net|old_email=alex@ikse.net','doing',1122915403,'354a778bacabffaff3d3fd74f93ac278','82.225.136.176','fr_FR');
UNLOCK TABLES;
/*!40000 ALTER TABLE `todo` ENABLE KEYS */;

--
-- Dumping data for table `user`
--


/*!40000 ALTER TABLE `user` DISABLE KEYS */;
LOCK TABLES `user` WRITE;
INSERT INTO `user` VALUES ('354a778bacabffaff3d3fd74f93ac278','alexx',NULL,'e67e5d2e8742f09dbb441e6bca977f7f','Alexandre','DATH',NULL,'y','Error: Unable to parse your RSS',1084260676,1083016054,1125776784,'fr_FR','0','ok','82.225.136.176'),('00112233445566778899001122334455','moderator','xxxxxxxxxxxxx','dc62cb28a2ae948f97df17fe92ebc515','Moderator','Moderator',NULL,'y','',1084260676,1083016054,1122712133,'fr_FR','0','ok','82.225.136.176'),('1353c20315c720ad6c88a498ccc1c1ac','mdoe','xxxxxxxxxxxxx','12e5634fef60569aacc56f35f3f9a9db','John','Doe',NULL,'y',NULL,1122934961,1122928681,1124460801,'fr_FR','354a778bacabffaff3d3fd74f93ac278','ok','82.225.136.176'),('7fd5694bc166bbcc91c2ff72ad71dfd4','test','xxxxxxxxxxxxx','32f92443a728c2df306943c021e60b0e','Test','toto','surnom','n',NULL,1123530303,1123529926,1123530330,'fr_FR','354a778bacabffaff3d3fd74f93ac278','ok',''),('28d956398f784ad039d48501c7ff66dd','zetrezre','xxxxxxxxxxxxx','a90c124de0084b4a5e56eaf7133cf112','testes','tesezezfez','surnom correct !','n',NULL,1123530566,1123530490,1123530579,'fr_FR','7fd5694bc166bbcc91c2ff72ad71dfd4','ok','');
UNLOCK TABLES;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

--
-- Dumping data for table `user_comm`
--


/*!40000 ALTER TABLE `user_comm` DISABLE KEYS */;
LOCK TABLES `user_comm` WRITE;
INSERT INTO `user_comm` VALUES ('354a778bacabffaff3d3fd74f93ac278',1,'ok',1124876625);
UNLOCK TABLES;
/*!40000 ALTER TABLE `user_comm` ENABLE KEYS */;

--
-- Dumping data for table `user_contact`
--


/*!40000 ALTER TABLE `user_contact` DISABLE KEYS */;
LOCK TABLES `user_contact` WRITE;
INSERT INTO `user_contact` VALUES ('354a778bacabffaff3d3fd74f93ac278','alex@ikse.net','alexxxxx@ikse.net',NULL,NULL,'alexx@jabber.ikse.net','jabber','9021115','icq','+33 (0) 3 20 81 15 40','+33 (0) 6 61 83 84 61','19, allée du Donjon','59700','Marcq-en-Baroeul','France'),('00112233445566778899001122334455','moderator@dotnode.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'France'),('1353c20315c720ad6c88a498ccc1c1ac','test-debug@dotnode.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'France'),('7fd5694bc166bbcc91c2ff72ad71dfd4','test-arezarez@ikse.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'France'),('28d956398f784ad039d48501c7ff66dd','test-tsetez@ikse.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'France');
UNLOCK TABLES;
/*!40000 ALTER TABLE `user_contact` ENABLE KEYS */;

--
-- Dumping data for table `user_general`
--


/*!40000 ALTER TABLE `user_general` DISABLE KEYS */;
LOCK TABLES `user_general` WRITE;
INSERT INTO `user_general` VALUES ('354a778bacabffaff3d3fd74f93ac278','committed','1980-03-14','friend,business,partners','no','male','casual,smart,trendy','no','no','partner,pet','http://alexx.ikse.org','Passionné, intégre, presque droit (pas trop tordu quoi ...).\r\nJ\'aime concrétiser ce qui me passe par la tête ... dommage que ca ne soit pas que des bonnes idées :/\r\nCourageux n\'est peut-etre pas le mot, mais fénéant, certainement pas !'),('00112233445566778899001122334455','','2004-06-16','','no','male','','no','no','','http://dotnode.com',NULL),('1353c20315c720ad6c88a498ccc1c1ac','single','2005-08-02','business,partners',NULL,'male',NULL,NULL,NULL,'alone,pet','http://opensource.ikse.net/projects/dotnode','Je suis plutôt ... virtuel'),('7fd5694bc166bbcc91c2ff72ad71dfd4','single','2005-08-08',NULL,NULL,'male',NULL,NULL,NULL,NULL,NULL,NULL),('28d956398f784ad039d48501c7ff66dd',NULL,'2005-08-08',NULL,NULL,'male',NULL,NULL,NULL,NULL,NULL,NULL);
UNLOCK TABLES;
/*!40000 ALTER TABLE `user_general` ENABLE KEYS */;

--
-- Dumping data for table `user_interests`
--


/*!40000 ALTER TABLE `user_interests` DISABLE KEYS */;
LOCK TABLES `user_interests` WRITE;
INSERT INTO `user_interests` VALUES ('354a778bacabffaff3d3fd74f93ac278','Informatique, Linux, Logiciel Libre, la programmation, les sciences, ...','Squash',NULL,'Perl Cookbook, Sherlock Holmes, .. and book from John Gray (:D)','The Doors, else Ambient, Smooth Jazz, Down Tempo ...','Don\'t watch TV','Tarantino, Kubric, and Oliver Stone Movies','Thaï'),('00112233445566778899001122334455',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('1353c20315c720ad6c88a498ccc1c1ac',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('7fd5694bc166bbcc91c2ff72ad71dfd4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('28d956398f784ad039d48501c7ff66dd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
UNLOCK TABLES;
/*!40000 ALTER TABLE `user_interests` ENABLE KEYS */;

--
-- Dumping data for table `user_personal`
--


/*!40000 ALTER TABLE `user_personal` DISABLE KEYS */;
LOCK TABLES `user_personal` WRITE;
INSERT INTO `user_personal` VALUES ('354a778bacabffaff3d3fd74f93ac278','Liberez votre esprit !!!','Je ne pense pas forcement comme la majorité',183,'blue','blonde','other_piercing','not_on_the_list',NULL,NULL),('00112233445566778899001122334455',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('1353c20315c720ad6c88a498ccc1c1ac',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('7fd5694bc166bbcc91c2ff72ad71dfd4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('28d956398f784ad039d48501c7ff66dd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
UNLOCK TABLES;
/*!40000 ALTER TABLE `user_personal` ENABLE KEYS */;

--
-- Dumping data for table `user_professional`
--


/*!40000 ALTER TABLE `user_professional` DISABLE KEYS */;
LOCK TABLES `user_professional` WRITE;
INSERT INTO `user_professional` VALUES ('354a778bacabffaff3d3fd74f93ac278','3843-alexandre-dath','Développeur / Admin. Sys.','hi-tech','Ikse','http://ikse.net','co-Manager','Développement d\'application web (en mode Application Service Provider).\r\nAdministration des serveurs de Ikse\r\nGestion de .node, interAlbum, Odeel.com, ...','alex.d@ikse.net','+33 (0) 3 20 89 87 12'),('00112233445566778899001122334455',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('1353c20315c720ad6c88a498ccc1c1ac',NULL,'beta-testeur','entertainment','.node','http://dotnode.com','Junior',NULL,NULL,NULL),('7fd5694bc166bbcc91c2ff72ad71dfd4','test-6nergies',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('28d956398f784ad039d48501c7ff66dd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
UNLOCK TABLES;
/*!40000 ALTER TABLE `user_professional` ENABLE KEYS */;

--
-- Dumping data for table `user_schools`
--


/*!40000 ALTER TABLE `user_schools` DISABLE KEYS */;
LOCK TABLES `user_schools` WRITE;
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1986,'Jules Ferry','Thumeries','France'),('354a778bacabffaff3d3fd74f93ac278',1987,'Jules Ferry','Thumeries','France'),('354a778bacabffaff3d3fd74f93ac278',1991,'Albert Camus','Thumeries','France'),('354a778bacabffaff3d3fd74f93ac278',1989,'Jules Ferry','Thumeries','France'),('354a778bacabffaff3d3fd74f93ac278',1988,'Jules Ferry','Thumeries','France'),('354a778bacabffaff3d3fd74f93ac278',1990,'Jules Ferry','Thumeries','France'),('354a778bacabffaff3d3fd74f93ac278',1992,'Albert Camus','Thumeries','France'),('354a778bacabffaff3d3fd74f93ac278',1993,'St Winoc','Bergues','France'),('354a778bacabffaff3d3fd74f93ac278',1994,'St Winoc','Bergues','France'),('354a778bacabffaff3d3fd74f93ac278',1995,'EPID','Dunkerque','France'),('354a778bacabffaff3d3fd74f93ac278',1996,'EPID','Dunkerque','France'),('354a778bacabffaff3d3fd74f93ac278',1997,'EPID','Dunkerque','France'),('354a778bacabffaff3d3fd74f93ac278',1998,'EPID','Dunkerque','France'),('354a778bacabffaff3d3fd74f93ac278',1983,'La Fontaine','Thumeries','France'),('354a778bacabffaff3d3fd74f93ac278',1984,'La Fontaine','Thumeries','France'),('354a778bacabffaff3d3fd74f93ac278',1985,'La Fontaine','Thumeries','France');
UNLOCK TABLES;
/*!40000 ALTER TABLE `user_schools` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

