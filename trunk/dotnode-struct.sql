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
-- Table structure for table `access`
--

DROP TABLE IF EXISTS `access`;
CREATE TABLE `access` (
  `id` varchar(34) NOT NULL default '',
  `table_name` varchar(64) NOT NULL default '',
  `field` varchar(64) NOT NULL default '',
  `access` enum('myself','friends','friends_of_friends','members','everyone') NOT NULL default 'friends',
  PRIMARY KEY  (`id`,`table_name`,`field`)
) TYPE=MyISAM;

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE `album` (
  `id` varchar(34) NOT NULL default '',
  `id_image` int(10) unsigned NOT NULL auto_increment,
  `width` int(10) unsigned NOT NULL default '0',
  `height` int(10) unsigned NOT NULL default '0',
  `format` enum('png','jpeg','gif') NOT NULL default 'png',
  `caption` text,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_image`)
) TYPE=MyISAM COMMENT='Album';

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` varchar(34) NOT NULL default '',
  `id_blog` int(10) unsigned NOT NULL auto_increment,
  `id_cat` int(10) unsigned default NULL,
  `title` varchar(255) NOT NULL default '',
  `chapeau` text,
  `ticket` text NOT NULL,
  `nb_comments` int(10) unsigned NOT NULL default '0',
  `date` int(11) NOT NULL default '0',
  `status` enum('online','offline') NOT NULL default 'offline',
  PRIMARY KEY  (`id_blog`)
) TYPE=MyISAM;

--
-- Table structure for table `blog_categorie`
--

DROP TABLE IF EXISTS `blog_categorie`;
CREATE TABLE `blog_categorie` (
  `id` varchar(34) NOT NULL default '',
  `id_cat` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `comment` text NOT NULL,
  PRIMARY KEY  (`id_cat`),
  UNIQUE KEY `id` (`id`,`name`)
) TYPE=MyISAM;

--
-- Table structure for table `blog_comment`
--

DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE `blog_comment` (
  `id` varchar(34) NOT NULL default '',
  `id_comment` int(10) unsigned NOT NULL auto_increment,
  `id_blog` int(10) unsigned NOT NULL default '0',
  `id_author` varchar(34) NOT NULL default '',
  `title` varchar(255) default NULL,
  `comment` text NOT NULL,
  `date` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_comment`)
) TYPE=MyISAM;

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
CREATE TABLE `bookmarks` (
  `id` varchar(34) NOT NULL default '',
  `id_cat` int(10) unsigned NOT NULL default '0',
  `cat_name` varchar(64) default NULL,
  `link` varchar(255) NOT NULL default '',
  `comment` text,
  `date` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`,`link`),
  KEY `id_cat` (`id_cat`)
) TYPE=MyISAM;

--
-- Table structure for table `bookmarks_cat`
--

DROP TABLE IF EXISTS `bookmarks_cat`;
CREATE TABLE `bookmarks_cat` (
  `id` varchar(32) NOT NULL default '',
  `id_cat` int(10) unsigned NOT NULL auto_increment,
  `id_cat_parent` int(10) unsigned NOT NULL default '0',
  `name` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`id_cat`),
  UNIQUE KEY `id` (`id`,`name`),
  KEY `id_parent` (`id_cat_parent`)
) TYPE=MyISAM;

--
-- Table structure for table `cache_user`
--

DROP TABLE IF EXISTS `cache_user`;
CREATE TABLE `cache_user` (
  `id` varchar(34) NOT NULL default '',
  `login` varchar(32) NOT NULL default '',
  `fname` varchar(32) default NULL,
  `lname` varchar(32) default NULL,
  `nick` varchar(64) default NULL,
  `fname_sndex` varchar(32) NOT NULL default '',
  `lname_sndex` varchar(32) NOT NULL default '',
  `nick_sndex` varchar(32) default NULL,
  `country` varchar(255) default NULL,
  `gender` enum('male','female') default NULL,
  `age` int(10) unsigned default '0',
  `relationship_status` set('single','married','committed') default NULL,
  `here_for` set('friend','business','dating','partners') default NULL,
  `join_date` int(10) unsigned NOT NULL default '0',
  `photo` enum('y','n') NOT NULL default 'n',
  `nb_friends` int(10) unsigned NOT NULL default '0',
  `friends_id` text,
  `nb_communities` int(10) unsigned NOT NULL default '0',
  `communities_id` text NOT NULL,
  `nb_fans` int(10) unsigned NOT NULL default '0',
  `nb_bookmarks` int(10) unsigned NOT NULL default '0',
  `nb_blogs` int(10) unsigned NOT NULL default '0',
  `nb_photos` int(10) unsigned NOT NULL default '0',
  `fun` float(3,2) unsigned NOT NULL default '0.00',
  `cool` float(3,2) unsigned NOT NULL default '0.00',
  `sexy` float(3,2) unsigned NOT NULL default '0.00',
  PRIMARY KEY  (`id`),
  KEY `photo` (`photo`),
  KEY `fname_sndex` (`fname_sndex`),
  KEY `lname_sndex` (`lname_sndex`),
  KEY `age` (`age`),
  KEY `fname` (`fname`),
  KEY `lname` (`lname`),
  KEY `login` (`login`),
  KEY `nick` (`nick`),
  KEY `nick_sndex` (`nick_sndex`)
) TYPE=MyISAM;

--
-- Table structure for table `community`
--

DROP TABLE IF EXISTS `community`;
CREATE TABLE `community` (
  `id` varchar(34) NOT NULL default '',
  `id_comm` int(10) unsigned NOT NULL auto_increment,
  `id_cat` int(10) unsigned NOT NULL default '0',
  `name` varchar(64) NOT NULL default '',
  `description` text NOT NULL,
  `moderated` enum('no','yes') NOT NULL default 'no',
  `country` varchar(255) default NULL,
  `date` int(10) unsigned NOT NULL default '0',
  `status` enum('ok','pending_delete') NOT NULL default 'ok',
  `status_text` text,
  `status_date` int(10) unsigned default NULL,
  `nb_members` int(10) unsigned NOT NULL default '1',
  `last_post_date` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_comm`),
  UNIQUE KEY `name` (`name`),
  KEY `date` (`date`),
  KEY `last_post_date` (`last_post_date`),
  KEY `id_cat` (`id_cat`),
  KEY `status` (`status`)
) TYPE=MyISAM;

--
-- Table structure for table `community_cat`
--

DROP TABLE IF EXISTS `community_cat`;
CREATE TABLE `community_cat` (
  `id_cat` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `description` text NOT NULL,
  `nb_communities` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_cat`),
  KEY `name` (`name`)
) TYPE=MyISAM;

--
-- Table structure for table `community_event`
--

DROP TABLE IF EXISTS `community_event`;
CREATE TABLE `community_event` (
  `id_event` int(10) unsigned NOT NULL auto_increment,
  `id_comm` int(11) NOT NULL default '0',
  `id` varchar(32) NOT NULL default '',
  `author` varchar(64) NOT NULL default '',
  `title` varchar(64) NOT NULL default '',
  `date_event` int(10) unsigned NOT NULL default '0',
  `location` text,
  `city` varchar(255) default NULL,
  `country` varchar(255) default NULL,
  `details` text NOT NULL,
  `date` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_event`)
) TYPE=MyISAM;

--
-- Table structure for table `community_keyword`
--

DROP TABLE IF EXISTS `community_keyword`;
CREATE TABLE `community_keyword` (
  `key_sndx` varchar(16) NOT NULL default '',
  `id_comm` int(10) unsigned NOT NULL default '0',
  `id_cat` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`key_sndx`,`id_comm`),
  KEY `key_sndx` (`key_sndx`),
  KEY `id_cat` (`id_cat`)
) TYPE=MyISAM;

--
-- Table structure for table `community_post`
--

DROP TABLE IF EXISTS `community_post`;
CREATE TABLE `community_post` (
  `id_post` int(10) unsigned NOT NULL auto_increment,
  `id_topic` int(10) unsigned NOT NULL default '0',
  `id_comm` int(11) unsigned NOT NULL default '0',
  `id` varchar(34) NOT NULL default '',
  `author` varchar(64) NOT NULL default '',
  `title` varchar(64) default NULL,
  `message` text NOT NULL,
  `date` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_post`),
  KEY `id_topic` (`id_topic`)
) TYPE=MyISAM;

--
-- Table structure for table `community_topic`
--

DROP TABLE IF EXISTS `community_topic`;
CREATE TABLE `community_topic` (
  `id_topic` int(10) unsigned NOT NULL auto_increment,
  `id_comm` int(10) unsigned NOT NULL default '0',
  `id` varchar(34) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `date` int(10) unsigned NOT NULL default '0',
  `sticky` enum('false','true') NOT NULL default 'false',
  `author` varchar(64) NOT NULL default '',
  `nb_posts` int(10) unsigned NOT NULL default '0',
  `last_post_date` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_topic`),
  KEY `date` (`date`),
  KEY `sticky` (`sticky`)
) TYPE=MyISAM;

--
-- Table structure for table `dntp_msgid`
--

DROP TABLE IF EXISTS `dntp_msgid`;
CREATE TABLE `dntp_msgid` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `md5` varchar(32) NOT NULL default '',
  `msgid` text NOT NULL,
  `msgid_plural` text,
  `multiline` enum('n','y') NOT NULL default 'n',
  `first_see` varchar(255) default NULL,
  `status` enum('new','ok') NOT NULL default 'new',
  `date` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `md5` (`md5`),
  KEY `status` (`status`)
) TYPE=MyISAM;

--
-- Table structure for table `dntp_msgstr`
--

DROP TABLE IF EXISTS `dntp_msgstr`;
CREATE TABLE `dntp_msgstr` (
  `id_msgstr` int(10) unsigned NOT NULL auto_increment,
  `id` int(10) unsigned NOT NULL default '0',
  `key` tinyint(3) unsigned NOT NULL default '0',
  `msgstr` text NOT NULL,
  `multiline` enum('n','y') NOT NULL default 'n',
  `lang` varchar(16) NOT NULL default '',
  `translator` varchar(64) NOT NULL default '',
  `status` enum('new','must_be_verified','ok') NOT NULL default 'new',
  `last` enum('y','n') NOT NULL default 'y',
  `comment` text,
  `date` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_msgstr`),
  KEY `id` (`id`,`key`,`lang`,`last`)
) TYPE=MyISAM;

--
-- Table structure for table `dntp_translator`
--

DROP TABLE IF EXISTS `dntp_translator`;
CREATE TABLE `dntp_translator` (
  `id_translator` int(10) unsigned NOT NULL auto_increment,
  `id_dotnode` varchar(34) NOT NULL default '',
  `login` varchar(64) NOT NULL default '',
  `passwd` varchar(42) default NULL,
  `passwd_md5` varchar(32) NOT NULL default '',
  `comment` text NOT NULL,
  `status` enum('waiting','ok','ko') NOT NULL default 'waiting',
  `level` set('verif','translator','admin','sadmin') NOT NULL default '',
  `lang` varchar(16) NOT NULL default '',
  `date` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_translator`,`id_dotnode`),
  UNIQUE KEY `name` (`login`),
  KEY `lang` (`lang`)
) TYPE=MyISAM COMMENT='2';

--
-- Table structure for table `dntp_translator_msgstr`
--

DROP TABLE IF EXISTS `dntp_translator_msgstr`;
CREATE TABLE `dntp_translator_msgstr` (
  `id` int(10) unsigned NOT NULL default '0',
  `id_translator` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`,`id_translator`)
) TYPE=MyISAM;

--
-- Table structure for table `global_data`
--

DROP TABLE IF EXISTS `global_data`;
CREATE TABLE `global_data` (
  `name` varchar(32) NOT NULL default '',
  `value` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`name`)
) TYPE=HEAP;

--
-- Table structure for table `invitation`
--

DROP TABLE IF EXISTS `invitation`;
CREATE TABLE `invitation` (
  `id` varchar(34) NOT NULL default '',
  `id_invit` varchar(34) NOT NULL default '',
  `level` enum('havent_seen','acquaintance','friend','good_friend','best_friend') NOT NULL default 'friend',
  PRIMARY KEY  (`id`,`id_invit`)
) TYPE=MyISAM;

--
-- Table structure for table `invitation_email`
--

DROP TABLE IF EXISTS `invitation_email`;
CREATE TABLE `invitation_email` (
  `id` varchar(34) NOT NULL default '',
  `id_invit` varchar(34) NOT NULL default '',
  `fname` varchar(64) NOT NULL default '',
  `lname` varchar(64) NOT NULL default '',
  `email` varchar(64) NOT NULL default '',
  `lang` varchar(7) NOT NULL default 'en_US',
  `type` enum('man','csv','6nergies') NOT NULL default 'man',
  `status` enum('todo','doing','done','stop') NOT NULL default 'todo',
  `response` enum('accepted','rejected','blacklist','mailproblem') default NULL,
  `date_begin` int(10) unsigned NOT NULL default '0',
  `date_finish` int(10) unsigned NOT NULL default '0',
  `failure_notice` text,
  `ip` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `status` (`status`)
) TYPE=MyISAM;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` varchar(34) default NULL,
  `id_mess` int(10) unsigned NOT NULL auto_increment,
  `id_from` varchar(34) default NULL,
  `from_str` varchar(64) NOT NULL default '',
  `type` varchar(32) NOT NULL default 'message',
  `dest` enum('one','friends','friends_of_friends') NOT NULL default 'one',
  `subject` varchar(255) NOT NULL default '',
  `message` text NOT NULL,
  `box` enum('inbox','save','send','outbox') NOT NULL default 'inbox',
  `flag` enum('new','read') NOT NULL default 'new',
  `date` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_mess`),
  KEY `box` (`box`),
  KEY `id` (`id`),
  KEY `type` (`type`),
  KEY `dest` (`dest`),
  KEY `new_message` (`id`,`box`,`flag`)
) TYPE=MyISAM;

--
-- Table structure for table `metalbum`
--

DROP TABLE IF EXISTS `metalbum`;
CREATE TABLE `metalbum` (
  `id` varchar(32) NOT NULL default '',
  `type` varchar(16) NOT NULL default '',
  `login` varchar(64) NOT NULL default '',
  `nb_items` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`,`type`,`login`)
) TYPE=MyISAM;

--
-- Table structure for table `relation`
--

DROP TABLE IF EXISTS `relation`;
CREATE TABLE `relation` (
  `id` varchar(34) NOT NULL default '',
  `id_friend` varchar(34) NOT NULL default '',
  `cool` tinyint(2) NOT NULL default '0',
  `fun` tinyint(2) NOT NULL default '0',
  `sexy` tinyint(2) NOT NULL default '0',
  `fan` tinyint(1) unsigned NOT NULL default '0',
  `level` enum('havent_seen','acquaintance','friend','good_friend','best_friend') NOT NULL default 'friend',
  `type` enum('love','club','childhood','studies','family','internet','parties','work','holidays','other') NOT NULL default 'internet',
  `last_visit` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`,`id_friend`),
  KEY `last_visit` (`last_visit`),
  KEY `id_friend` (`id_friend`)
) TYPE=MyISAM COMMENT='Relation + karma';

--
-- Table structure for table `rss_blog`
--

DROP TABLE IF EXISTS `rss_blog`;
CREATE TABLE `rss_blog` (
  `id` varchar(34) NOT NULL default '',
  `id_blog` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `link` text NOT NULL,
  `rss` text NOT NULL,
  PRIMARY KEY  (`id_blog`),
  UNIQUE KEY `id` (`id`)
) TYPE=MyISAM;

--
-- Table structure for table `rss_blog_ticket`
--

DROP TABLE IF EXISTS `rss_blog_ticket`;
CREATE TABLE `rss_blog_ticket` (
  `id` varchar(34) NOT NULL default '',
  `id_blog` int(10) unsigned NOT NULL default '0',
  `id_ticket` varchar(34) NOT NULL default '',
  `title` text NOT NULL,
  `description` text,
  `content` text,
  `link` text NOT NULL,
  `date` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`,`id_ticket`),
  KEY `id` (`id`),
  KEY `id_blog` (`id_blog`)
) TYPE=MyISAM;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` varchar(32) binary NOT NULL default '',
  `SecID` varchar(32) NOT NULL default '',
  `timestamp` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `timestamp` (`timestamp`)
) TYPE=HEAP;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` varchar(34) NOT NULL default '',
  `new_friend_notifications` set('email') default NULL,
  `new_friend_approval` set('email') default NULL,
  `new_blog_comment` set('email') default NULL,
  `messages_sent_directly_to_me` set('email') default NULL,
  `messages_sent_to_friends` set('email') default NULL,
  `messages_sent_to_friends_of_friends` set('email') default NULL,
  `messages_sent_to_communities` set('email') default NULL,
  `birthday_reminder` set('email') default NULL,
  `publish` enum('yes','no') NOT NULL default 'yes',
  `dotpage_css` varchar(32) NOT NULL default 'default',
  `invitation_message` text,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

--
-- Table structure for table `todo`
--

DROP TABLE IF EXISTS `todo`;
CREATE TABLE `todo` (
  `id_todo` int(10) unsigned NOT NULL auto_increment,
  `robot` varchar(128) NOT NULL default '',
  `param` varchar(255) default NULL,
  `status` enum('todo','doing','done','stop') NOT NULL default 'todo',
  `date` int(10) unsigned NOT NULL default '0',
  `id` varchar(34) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  `lang` varchar(7) NOT NULL default 'en_US',
  PRIMARY KEY  (`id_todo`),
  UNIQUE KEY `robot_2` (`robot`,`id`),
  KEY `robot` (`robot`),
  KEY `etat` (`status`)
) TYPE=MyISAM;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` varchar(34) NOT NULL default '',
  `login` varchar(24) NOT NULL default '',
  `passwd` varchar(42) binary default NULL,
  `passwd_md5` varchar(32) binary NOT NULL default '',
  `fname` varchar(32) NOT NULL default '',
  `lname` varchar(32) NOT NULL default '',
  `nick` varchar(64) default NULL,
  `photo` enum('y','n') NOT NULL default 'n',
  `blog_url` varchar(255) default NULL,
  `join_date` int(11) NOT NULL default '0',
  `invite_date` int(11) NOT NULL default '0',
  `last_visite` int(11) NOT NULL default '0',
  `lang` varchar(7) NOT NULL default 'en_US',
  `id_parent` varchar(34) NOT NULL default '',
  `status` set('ok','waiting','jail') NOT NULL default '',
  `ip` varchar(16) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `id_parent` (`id_parent`),
  KEY `status` (`status`),
  KEY `photo` (`photo`),
  KEY `nick` (`nick`)
) TYPE=MyISAM COMMENT='2';

--
-- Table structure for table `user_comm`
--

DROP TABLE IF EXISTS `user_comm`;
CREATE TABLE `user_comm` (
  `id` varchar(34) NOT NULL default '',
  `id_comm` int(10) unsigned NOT NULL default '0',
  `status` enum('ok','waiting') NOT NULL default 'ok',
  `last_visit` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`,`id_comm`),
  KEY `id_comm` (`id_comm`),
  KEY `last_visit` (`last_visit`)
) TYPE=MyISAM;

--
-- Table structure for table `user_contact`
--

DROP TABLE IF EXISTS `user_contact`;
CREATE TABLE `user_contact` (
  `id` varchar(34) NOT NULL default '',
  `email` varchar(128) NOT NULL default '',
  `email2` varchar(128) default NULL,
  `email3` varchar(128) default NULL,
  `email4` varchar(128) default NULL,
  `im` varchar(128) default NULL,
  `im_type` enum('aim','icq','irc','msn','jabber','yahoo','skype') default NULL,
  `im2` varchar(128) default NULL,
  `im2_type` enum('aim','icq','irc','msn','jabber','yahoo','skype') default NULL,
  `phone` varchar(32) default NULL,
  `cell_phone` varchar(32) default NULL,
  `address` text,
  `zip` varchar(10) default NULL,
  `city` varchar(128) default NULL,
  `country` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `city` (`city`),
  KEY `country` (`country`),
  KEY `zip` (`zip`)
) TYPE=MyISAM;

--
-- Table structure for table `user_general`
--

DROP TABLE IF EXISTS `user_general`;
CREATE TABLE `user_general` (
  `id` varchar(34) NOT NULL default '',
  `relationship_status` enum('single','married','committed') default NULL,
  `birthday` date default NULL,
  `here_for` set('friend','business','dating','partners') default NULL,
  `children` enum('no','fulltime','halftime','notathome') default NULL,
  `gender` enum('male','female') default NULL,
  `fashion` set('alternative','casual','classic','contemporary','designer','minimal','natural','outdoorsy','smart','trendy','urban') default NULL,
  `smoking` enum('no','little','socialy','occasionally','regularly') default NULL,
  `drinking` enum('no','little','socialy','occasionally','regularly') default NULL,
  `living` set('alone','roommate','parents','partner','pet','kid') default NULL,
  `web` varchar(255) default NULL,
  `description` text,
  PRIMARY KEY  (`id`),
  KEY `smoking` (`smoking`),
  KEY `drinking` (`drinking`),
  KEY `living` (`living`),
  KEY `children` (`children`),
  KEY `gender` (`gender`),
  KEY `fashion` (`fashion`),
  KEY `here_for` (`here_for`),
  KEY `relationship_status` (`relationship_status`)
) TYPE=MyISAM;

--
-- Table structure for table `user_interests`
--

DROP TABLE IF EXISTS `user_interests`;
CREATE TABLE `user_interests` (
  `id` varchar(34) NOT NULL default '',
  `passions` text,
  `sports` text,
  `activities` text,
  `favorite_books` text,
  `favorite_music` text,
  `favorite_tvshow` text,
  `favorite_movies` text,
  `favorite_cuisines` text,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

--
-- Table structure for table `user_personal`
--

DROP TABLE IF EXISTS `user_personal`;
CREATE TABLE `user_personal` (
  `id` varchar(34) NOT NULL default '',
  `headline` text,
  `notice` text,
  `size` int(3) default NULL,
  `eye` enum('blue','green','brown','black','gray','hazel') default NULL,
  `hair` enum('blonde','black','auburn','gray','salt_and_pepper','light_brown','dark_brown','red') default NULL,
  `body_art` set('hidden_tattoo','visible_tattoo','pierced_tongue','other_piercing') default NULL,
  `best_feature` enum('eyes','hair','lips','neck','arms','hands','chest','belly_button','butt','legs','calves','feet','not_on_the_list') default NULL,
  `things_i_cant_live_without` text,
  `ideal_match` text,
  PRIMARY KEY  (`id`),
  KEY `eye` (`eye`),
  KEY `hair` (`hair`),
  KEY `body_art` (`body_art`),
  KEY `best_feature` (`best_feature`)
) TYPE=MyISAM;

--
-- Table structure for table `user_professional`
--

DROP TABLE IF EXISTS `user_professional`;
CREATE TABLE `user_professional` (
  `id` varchar(34) NOT NULL default '',
  `6nergies_url` varchar(255) default NULL,
  `occupation` varchar(128) default NULL,
  `industry` set('agriculture','arts','construction','consumer_goods','corporate_services','education','finance','government','hi-tech','legal','manufacturing','media','medical','non-profit','entertainment','scientific','service_industry','transportation') default NULL,
  `company` varchar(128) default NULL,
  `web` varchar(255) default NULL,
  `title` varchar(128) default NULL,
  `description` text,
  `email` varchar(128) default NULL,
  `phone` varchar(64) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

--
-- Table structure for table `user_schools`
--

DROP TABLE IF EXISTS `user_schools`;
CREATE TABLE `user_schools` (
  `id` varchar(34) NOT NULL default '',
  `year` int(4) NOT NULL default '0',
  `name` varchar(64) NOT NULL default '',
  `city` varchar(64) NOT NULL default '',
  `country` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`id`,`year`,`name`),
  KEY `name` (`name`),
  KEY `city` (`city`),
  KEY `country` (`country`),
  KEY `year` (`year`)
) TYPE=MyISAM;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

