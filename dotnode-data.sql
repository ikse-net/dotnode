-- MySQL dump 9.11
--
-- Host: localhost    Database: dotnode_alexx
-- ------------------------------------------------------
-- Server version	4.0.24_Debian-10-log

--
-- Dumping data for table `access`
--

INSERT INTO `access` VALUES ('354a778bacabffaff3d3fd74f93ac278','user_general','birthday','members');
INSERT INTO `access` VALUES ('354a778bacabffaff3d3fd74f93ac278','user_contact','email','myself');
INSERT INTO `access` VALUES ('354a778bacabffaff3d3fd74f93ac278','user_contact','email2','friends_of_friends');
INSERT INTO `access` VALUES ('354a778bacabffaff3d3fd74f93ac278','user_contact','email3','friends');
INSERT INTO `access` VALUES ('354a778bacabffaff3d3fd74f93ac278','user_contact','email4','friends');
INSERT INTO `access` VALUES ('354a778bacabffaff3d3fd74f93ac278','user_contact','im','friends_of_friends');
INSERT INTO `access` VALUES ('354a778bacabffaff3d3fd74f93ac278','user_contact','im2','friends_of_friends');
INSERT INTO `access` VALUES ('354a778bacabffaff3d3fd74f93ac278','user_contact','phone','friends_of_friends');
INSERT INTO `access` VALUES ('354a778bacabffaff3d3fd74f93ac278','user_contact','cell_phone','friends_of_friends');
INSERT INTO `access` VALUES ('354a778bacabffaff3d3fd74f93ac278','user_contact','address','myself');
INSERT INTO `access` VALUES ('354a778bacabffaff3d3fd74f93ac278','user_professional','company','everyone');
INSERT INTO `access` VALUES ('354a778bacabffaff3d3fd74f93ac278','user_professional','email','members');
INSERT INTO `access` VALUES ('354a778bacabffaff3d3fd74f93ac278','user_professional','phone','members');
INSERT INTO `access` VALUES ('00112233445566778899001122334455','user_general','birthday','members');
INSERT INTO `access` VALUES ('00112233445566778899001122334455','user_contact','email','myself');
INSERT INTO `access` VALUES ('00112233445566778899001122334455','user_contact','email2','friends_of_friends');
INSERT INTO `access` VALUES ('00112233445566778899001122334455','user_contact','email3','friends');
INSERT INTO `access` VALUES ('00112233445566778899001122334455','user_contact','email4','friends');
INSERT INTO `access` VALUES ('00112233445566778899001122334455','user_contact','im','friends_of_friends');
INSERT INTO `access` VALUES ('00112233445566778899001122334455','user_contact','im2','friends_of_friends');
INSERT INTO `access` VALUES ('00112233445566778899001122334455','user_contact','phone','friends_of_friends');
INSERT INTO `access` VALUES ('00112233445566778899001122334455','user_contact','cell_phone','friends_of_friends');
INSERT INTO `access` VALUES ('00112233445566778899001122334455','user_contact','address','myself');
INSERT INTO `access` VALUES ('00112233445566778899001122334455','user_professional','company','everyone');
INSERT INTO `access` VALUES ('00112233445566778899001122334455','user_professional','email','members');
INSERT INTO `access` VALUES ('00112233445566778899001122334455','user_professional','phone','members');
INSERT INTO `access` VALUES ('1353c20315c720ad6c88a498ccc1c1ac','user_general','birthday','everyone');
INSERT INTO `access` VALUES ('1353c20315c720ad6c88a498ccc1c1ac','user_contact','email','members');
INSERT INTO `access` VALUES ('1353c20315c720ad6c88a498ccc1c1ac','user_contact','im','friends_of_friends');
INSERT INTO `access` VALUES ('1353c20315c720ad6c88a498ccc1c1ac','user_contact','phone','friends_of_friends');
INSERT INTO `access` VALUES ('1353c20315c720ad6c88a498ccc1c1ac','user_contact','cell_phone','friends_of_friends');
INSERT INTO `access` VALUES ('1353c20315c720ad6c88a498ccc1c1ac','user_contact','address','friends_of_friends');
INSERT INTO `access` VALUES ('1353c20315c720ad6c88a498ccc1c1ac','user_professional','company','everyone');

--
-- Dumping data for table `album`
--

INSERT INTO `album` VALUES ('354a778bacabffaff3d3fd74f93ac278',1,420,480,'jpeg','','2005-08-01 09:09:08');
INSERT INTO `album` VALUES ('1353c20315c720ad6c88a498ccc1c1ac',2,885,708,'jpeg','Chat ou chien ?','2005-08-02 00:30:48');
INSERT INTO `album` VALUES ('1353c20315c720ad6c88a498ccc1c1ac',3,885,708,'jpeg','C\'est de l\'art ca !','2005-08-02 00:31:40');
INSERT INTO `album` VALUES ('1353c20315c720ad6c88a498ccc1c1ac',4,885,708,'jpeg','','2005-08-02 00:31:53');
INSERT INTO `album` VALUES ('1353c20315c720ad6c88a498ccc1c1ac',5,885,708,'jpeg','ninac la mangeuse d\'oiseau','2005-08-02 00:32:02');
INSERT INTO `album` VALUES ('1353c20315c720ad6c88a498ccc1c1ac',6,885,708,'jpeg','catator','2005-08-02 00:32:11');

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` VALUES ('354a778bacabffaff3d3fd74f93ac278',1,1,'Un blog de test','Avec un entête optionnel','Et un contenu pour ne rien dire ...\r\n\r\nenfin .... bref ...\r\n\r\nTake courage !',0,1122880352,'online');

--
-- Dumping data for table `blog_categorie`
--

INSERT INTO `blog_categorie` VALUES ('354a778bacabffaff3d3fd74f93ac278',1,'Catégorie blog','');

--
-- Dumping data for table `blog_comment`
--


--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` VALUES ('354a778bacabffaff3d3fd74f93ac278',1,'humour','http://tc.apinc.org','Totalement Crétin',1122880217);
INSERT INTO `bookmarks` VALUES ('354a778bacabffaff3d3fd74f93ac278',2,'Dev','http://dev.dotnode.net','Dotnode Developpement platform',1122880246);

--
-- Dumping data for table `bookmarks_cat`
--

INSERT INTO `bookmarks_cat` VALUES ('354a778bacabffaff3d3fd74f93ac278',1,0,'humour');
INSERT INTO `bookmarks_cat` VALUES ('354a778bacabffaff3d3fd74f93ac278',2,0,'Dev');

--
-- Dumping data for table `cache_user`
--

INSERT INTO `cache_user` VALUES ('354a778bacabffaff3d3fd74f93ac278','alexx','Alexandre','DATH','','A42536','D000','','France','male',25,'committed','friend,business,partners',1084260676,'y',2,'1353c20315c720ad6c88a498ccc1c1ac,00112233445566778899001122334455',0,'',0,0,0,0,0.00,0.00,0.00);
INSERT INTO `cache_user` VALUES ('00112233445566778899001122334455','moderator','Moderator','Moderator','','','','','France','male',25,'','',1084260676,'y',1,'354a778bacabffaff3d3fd74f93ac278',0,'',0,0,0,0,0.00,0.00,0.00);
INSERT INTO `cache_user` VALUES ('1353c20315c720ad6c88a498ccc1c1ac','mdoe','John','Doe',NULL,'J500','D000',NULL,'France','male',0,'single','business,partners',1122934961,'y',1,'354a778bacabffaff3d3fd74f93ac278',0,'',1,0,1,5,0.00,0.00,0.00);

--
-- Dumping data for table `community`
--

INSERT INTO `community` VALUES ('354a778bacabffaff3d3fd74f93ac278',1,28,'.node lovers','Test community for dev purpose','no','France',1122843877,'ok',NULL,NULL,1,1122844134);

--
-- Dumping data for table `community_cat`
--

INSERT INTO `community_cat` VALUES (1,'Activities','Things to do with 2 or more',0);
INSERT INTO `community_cat` VALUES (2,'Alumni & Schools','reconnect with friends from old school',0);
INSERT INTO `community_cat` VALUES (3,'Arts & Entertainment','About Movies, Opéra, Theather',0);
INSERT INTO `community_cat` VALUES (4,'Automotive','For automobile lovers',0);
INSERT INTO `community_cat` VALUES (5,'Business','Talk business, finance, and economy',0);
INSERT INTO `community_cat` VALUES (6,'Cities & Neighborhoods','For local discution and news',0);
INSERT INTO `community_cat` VALUES (7,'Company','Company discussing other company',0);
INSERT INTO `community_cat` VALUES (8,'Computers & Internet','',0);
INSERT INTO `community_cat` VALUES (9,'Countries & Regional','',0);
INSERT INTO `community_cat` VALUES (10,'Cultures & Community','',0);
INSERT INTO `community_cat` VALUES (11,'Family & Home','',0);
INSERT INTO `community_cat` VALUES (12,'Fashion & Beauty','',0);
INSERT INTO `community_cat` VALUES (13,'Food, Drink & Wine','',0);
INSERT INTO `community_cat` VALUES (14,'Games','',0);
INSERT INTO `community_cat` VALUES (15,'Government & Politics','',0);
INSERT INTO `community_cat` VALUES (16,'Health, Wellness & Fitness','',0);
INSERT INTO `community_cat` VALUES (17,'Hobbies & Crafts','',0);
INSERT INTO `community_cat` VALUES (18,'Individuals','',0);
INSERT INTO `community_cat` VALUES (19,'Music','',0);
INSERT INTO `community_cat` VALUES (20,'Pets & Animals','',0);
INSERT INTO `community_cat` VALUES (21,'Recreation & Sports','',0);
INSERT INTO `community_cat` VALUES (22,'Religion & Beliefs','',0);
INSERT INTO `community_cat` VALUES (23,'Romance & Relationships','',0);
INSERT INTO `community_cat` VALUES (24,'Education','',0);
INSERT INTO `community_cat` VALUES (25,'Science & History','',0);
INSERT INTO `community_cat` VALUES (26,'Travel','',0);
INSERT INTO `community_cat` VALUES (27,'Other','',0);
INSERT INTO `community_cat` VALUES (28,'.node','',0);

--
-- Dumping data for table `community_event`
--

INSERT INTO `community_event` VALUES (1,1,'354a778bacabffaff3d3fd74f93ac278','Alexandre','First event',1122984000,'dev.dotnode.net','Internet','France','Lancement de l\'ouverture du code de .node !\r\nHoura ! ;)',1122844267);

--
-- Dumping data for table `community_keyword`
--

INSERT INTO `community_keyword` VALUES ('T230',1,28);
INSERT INTO `community_keyword` VALUES ('C530',1,28);
INSERT INTO `community_keyword` VALUES ('F600',1,28);
INSERT INTO `community_keyword` VALUES ('D100',1,28);
INSERT INTO `community_keyword` VALUES ('P612',1,28);
INSERT INTO `community_keyword` VALUES ('N300',1,28);
INSERT INTO `community_keyword` VALUES ('L160',1,28);

--
-- Dumping data for table `community_post`
--

INSERT INTO `community_post` VALUES (1,1,1,'354a778bacabffaff3d3fd74f93ac278','Alexandre','First topic','For test only',1122844117);
INSERT INTO `community_post` VALUES (2,1,1,'354a778bacabffaff3d3fd74f93ac278','Alexandre',NULL,'A simple response to the test topic',1122844134);

--
-- Dumping data for table `community_topic`
--

INSERT INTO `community_topic` VALUES (1,1,'354a778bacabffaff3d3fd74f93ac278','First topic',1122844117,'false','Alexandre',2,1122844134);

--
-- Dumping data for table `dntp_msgid`
--


--
-- Dumping data for table `dntp_msgstr`
--


--
-- Dumping data for table `dntp_translator`
--


--
-- Dumping data for table `dntp_translator_msgstr`
--


--
-- Dumping data for table `global_data`
--

INSERT INTO `global_data` VALUES ('nb_nodians','3');
INSERT INTO `global_data` VALUES ('actually','1');

--
-- Dumping data for table `invitation`
--


--
-- Dumping data for table `invitation_email`
--

INSERT INTO `invitation_email` VALUES ('1353c20315c720ad6c88a498ccc1c1ac','354a778bacabffaff3d3fd74f93ac278','Test','Debug','test-debug@dotnode.com','fr_FR','man','done','accepted',1122928681,0,NULL,'82.225.136.176');

--
-- Dumping data for table `message`
--


--
-- Dumping data for table `relation`
--

INSERT INTO `relation` VALUES ('354a778bacabffaff3d3fd74f93ac278','00112233445566778899001122334455',0,0,0,0,'havent_seen','other',1119595944);
INSERT INTO `relation` VALUES ('00112233445566778899001122334455','354a778bacabffaff3d3fd74f93ac278',0,0,0,0,'havent_seen','other',1116620277);
INSERT INTO `relation` VALUES ('1353c20315c720ad6c88a498ccc1c1ac','354a778bacabffaff3d3fd74f93ac278',2,3,1,0,'havent_seen','internet',1122935145);
INSERT INTO `relation` VALUES ('354a778bacabffaff3d3fd74f93ac278','1353c20315c720ad6c88a498ccc1c1ac',0,3,0,1,'havent_seen','work',1122935182);

--
-- Dumping data for table `rss_blog`
--

INSERT INTO `rss_blog` VALUES ('1353c20315c720ad6c88a498ccc1c1ac',1,'Open .node: {1} Active Tickets','http://opensource.ikse.net/projects/dotnode/report/1','http://opensource.ikse.net/projects/dotnode/report/1?format=rss');

--
-- Dumping data for table `rss_blog_ticket`
--

INSERT INTO `rss_blog_ticket` VALUES ('1353c20315c720ad6c88a498ccc1c1ac',1,'d786c560e72e04f4312c4ce3242276f7','#1: .node ne détecte pas si les cookies ne sont pas activés ...','Dotnode devrait prevenir qu\'il a detecté que les cookies ne sont pas activé et indiquer a l\'utilisateur que c\'est indispensable...',NULL,'http://opensource.ikse.net/projects/dotnode/ticket/1',1122803681);

--
-- Dumping data for table `session`
--

INSERT INTO `session` VALUES ('1353c20315c720ad6c88a498ccc1c1ac','8bfd5e78d4e0daffc59316730b35cf5b',1122935568);

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` VALUES ('354a778bacabffaff3d3fd74f93ac278','','email','','email','','','','','yes','mauzilla','Message d\'invitation de test de dev...');

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` VALUES (1,'send_password','email=alex@ikse.net','doing',1122915296,'354a778bacabffaff3d3fd74f93ac278','82.225.136.176','fr_FR');
INSERT INTO `todo` VALUES (2,'modif_email','email=alexx@dotnode.net|old_email=alex@ikse.net','doing',1122915403,'354a778bacabffaff3d3fd74f93ac278','82.225.136.176','fr_FR');

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES ('354a778bacabffaff3d3fd74f93ac278','alexx','1723ce1b6a6c6bd4','Alexandre','DATH',NULL,'y','Error: Unable to parse your RSS',1084260676,1083016054,1122935229,'fr_FR','0','ok','82.225.136.176');
INSERT INTO `user` VALUES ('00112233445566778899001122334455','moderator','1723ce1b6a6c6bd4','Moderator','Moderator',NULL,'y','',1084260676,1083016054,1122712133,'fr_FR','0','ok','82.225.136.176');
INSERT INTO `user` VALUES ('1353c20315c720ad6c88a498ccc1c1ac','mdoe','38fda18a4b89a2b7','John','Doe',NULL,'y',NULL,1122934961,1122928681,1122935261,'fr_FR','354a778bacabffaff3d3fd74f93ac278','ok','82.225.136.176');

--
-- Dumping data for table `user_comm`
--

INSERT INTO `user_comm` VALUES ('354a778bacabffaff3d3fd74f93ac278',1,'ok',1122844214);

--
-- Dumping data for table `user_contact`
--

INSERT INTO `user_contact` VALUES ('354a778bacabffaff3d3fd74f93ac278','alex@ikse.net','alexxxxx@ikse.net',NULL,NULL,'alexx@jabber.ikse.net','jabber','9021115','icq','+33 (0) 3 20 81 15 40','+33 (0) 6 61 83 84 61','19, allée du Donjon','59700','Marcq-en-Baroeul','France');
INSERT INTO `user_contact` VALUES ('00112233445566778899001122334455','moderator@dotnode.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'France');
INSERT INTO `user_contact` VALUES ('1353c20315c720ad6c88a498ccc1c1ac','test-debug@dotnode.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'France');

--
-- Dumping data for table `user_general`
--

INSERT INTO `user_general` VALUES ('354a778bacabffaff3d3fd74f93ac278','committed','1980-03-14','friend,business,partners','no','male','casual,smart,trendy','no','no','partner,pet','http://alexx.ikse.org','Passionné, intégre, presque droit (pas trop tordu quoi ...).\r\nJ\'aime concrétiser ce qui me passe par la tête ... dommage que ca ne soit pas que des bonnes idées :/\r\nCourageux n\'est peut-etre pas le mot, mais fénéant, certainement pas !');
INSERT INTO `user_general` VALUES ('00112233445566778899001122334455','','2004-06-16','','no','male','','no','no','','http://dotnode.com',NULL);
INSERT INTO `user_general` VALUES ('1353c20315c720ad6c88a498ccc1c1ac','single','2005-08-02','business,partners',NULL,'male',NULL,NULL,NULL,'alone,pet','http://opensource.ikse.net/projects/dotnode','Je suis plutôt ... virtuel');

--
-- Dumping data for table `user_interests`
--

INSERT INTO `user_interests` VALUES ('354a778bacabffaff3d3fd74f93ac278','Informatique, Linux, Logiciel Libre, la programmation, les sciences, ...','Squash',NULL,'Perl Cookbook, Sherlock Holmes, .. and book from John Gray (:D)','The Doors, else Ambient, Smooth Jazz, Down Tempo ...','Don\'t watch TV','Tarantino, Kubric, and Oliver Stone Movies','Thaï');
INSERT INTO `user_interests` VALUES ('00112233445566778899001122334455',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `user_interests` VALUES ('1353c20315c720ad6c88a498ccc1c1ac',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

--
-- Dumping data for table `user_personal`
--

INSERT INTO `user_personal` VALUES ('354a778bacabffaff3d3fd74f93ac278','Liberez votre esprit !!!','Je ne pense pas forcement comme la majorité',183,'blue','blonde','other_piercing','not_on_the_list',NULL,NULL);
INSERT INTO `user_personal` VALUES ('00112233445566778899001122334455',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `user_personal` VALUES ('1353c20315c720ad6c88a498ccc1c1ac',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

--
-- Dumping data for table `user_professional`
--

INSERT INTO `user_professional` VALUES ('354a778bacabffaff3d3fd74f93ac278','3843-alexandre-dath','Développeur / Admin. Sys.','hi-tech','Ikse','http://ikse.net','co-Manager','Développement d\'application web (en mode Application Service Provider).\r\nAdministration des serveurs de Ikse\r\nGestion de .node, interAlbum, Odeel.com, ...','alex.d@ikse.net','+33 (0) 3 20 89 87 12');
INSERT INTO `user_professional` VALUES ('00112233445566778899001122334455',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `user_professional` VALUES ('1353c20315c720ad6c88a498ccc1c1ac',NULL,'beta-testeur','entertainment','.node','http://dotnode.com','Junior',NULL,NULL,NULL);

--
-- Dumping data for table `user_schools`
--

INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1986,'Jules Ferry','Thumeries','France');
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1987,'Jules Ferry','Thumeries','France');
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1991,'Albert Camus','Thumeries','France');
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1989,'Jules Ferry','Thumeries','France');
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1988,'Jules Ferry','Thumeries','France');
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1990,'Jules Ferry','Thumeries','France');
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1992,'Albert Camus','Thumeries','France');
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1993,'St Winoc','Bergues','France');
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1994,'St Winoc','Bergues','France');
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1995,'EPID','Dunkerque','France');
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1996,'EPID','Dunkerque','France');
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1997,'EPID','Dunkerque','France');
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1998,'EPID','Dunkerque','France');
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1983,'La Fontaine','Thumeries','France');
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1984,'La Fontaine','Thumeries','France');
INSERT INTO `user_schools` VALUES ('354a778bacabffaff3d3fd74f93ac278',1985,'La Fontaine','Thumeries','France');

