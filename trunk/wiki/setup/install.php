<?php

// fetch configuration
$config = $_POST["config"];

// test configuration
print("<b>Test de la configuration</b><br>\n");
test("Test connexion MySQL ...", $dblink = @mysql_connect($config["mysql_host"], $config["mysql_user"], $config["mysql_password"]));
test("Recherche base de données ...", @mysql_select_db($config["mysql_database"], $dblink), "La base de données que vous avez choisie n'existe pas, vous devez la créer avant d'installer WikiNi !");
print("<br>\n");

// do installation stuff
if (!$version = trim($wakkaConfig["wakka_version"])) $version = "0";
switch ($version)
{
// new installation
case "0":
	print("<b>Installation</b><br>\n");
	test("Creation table page...",
		@mysql_query(
			"CREATE TABLE ".$config["table_prefix"]."pages (".
  			"id int(10) unsigned NOT NULL auto_increment,".
  			"tag varchar(50) NOT NULL default '',".
  			"time datetime NOT NULL default '0000-00-00 00:00:00',".
  			"body text NOT NULL,".
  			"body_r text NOT NULL,".
  			"owner varchar(50) NOT NULL default '',".
  			"user varchar(50) NOT NULL default '',".
  			"latest enum('Y','N') NOT NULL default 'N',".
  			"handler varchar(30) NOT NULL default 'page',".
  			"comment_on varchar(50) NOT NULL default '',".
  			"PRIMARY KEY  (id),".
  			"FULLTEXT KEY tag (tag,body),".
  			"KEY idx_tag (tag),".
  			"KEY idx_time (time),".
  			"KEY idx_latest (latest),".
  			"KEY idx_comment_on (comment_on)".
			") TYPE=MyISAM;", $dblink), "Already exists?", 0);
	test("Creation table ACL ...",
		@mysql_query(
			"CREATE TABLE ".$config["table_prefix"]."acls (".
  			"page_tag varchar(50) NOT NULL default '',".
			"privilege varchar(20) NOT NULL default '',".
  			"list text NOT NULL,".
 			"PRIMARY KEY  (page_tag,privilege)".
			") TYPE=MyISAM", $dblink), "Already exists?", 0);
	test("Creation table link ...",
		@mysql_query(
			"CREATE TABLE ".$config["table_prefix"]."links (".
			"from_tag char(50) NOT NULL default '',".
  			"to_tag char(50) NOT NULL default '',".
  			"UNIQUE KEY from_tag (from_tag,to_tag),".
  			"KEY idx_from (from_tag),".
  			"KEY idx_to (to_tag)".
			") TYPE=MyISAM", $dblink), "Already exists?", 0);
	test("Creation table referrer ...",
		@mysql_query(
			"CREATE TABLE ".$config["table_prefix"]."referrers (".
  			"page_tag char(50) NOT NULL default '',".
  			"referrer char(150) NOT NULL default '',".
  			"time datetime NOT NULL default '0000-00-00 00:00:00',".
  			"KEY idx_page_tag (page_tag),".
  			"KEY idx_time (time)".
			") TYPE=MyISAM", $dblink), "Already exists?", 0);
	test("Creation table user ...",
		@mysql_query(
			"CREATE TABLE ".$config["table_prefix"]."users (".
  			"name varchar(80) NOT NULL default '',".
  			"password varchar(32) NOT NULL default '',".
  			"email varchar(50) NOT NULL default '',".
  			"motto text NOT NULL,".
  			"revisioncount int(10) unsigned NOT NULL default '20',".
  			"changescount int(10) unsigned NOT NULL default '50',".
  			"doubleclickedit enum('Y','N') NOT NULL default 'Y',".
  			"signuptime datetime NOT NULL default '0000-00-00 00:00:00',".
  			"show_comments enum('Y','N') NOT NULL default 'N',".
  			"PRIMARY KEY  (name),".
  			"KEY idx_name (name),".
  			"KEY idx_signuptime (signuptime)".
			") TYPE=MyISAM", $dblink), "Already exists?", 0);
	mysql_query("insert into ".$config["table_prefix"]."pages set tag = '".$config["root_page"]."', body = '".mysql_escape_string("Bienvenue ! Cliquez sur le lien \"Editer cette page\" au bas de la page pour démarrer.\n\nPage utiles: PagesOrphelines, PagesACreer, RechercheTexte, ReglesDeFormatage.")."', user = 'WikiNiInstaller', time = now(), latest = 'Y'", $dblink);
	mysql_query("insert into ".$config["table_prefix"]."pages set tag = 'DerniersChangements', body = '{{RecentChanges}}', user = 'WikiNiInstaller', time = now(), latest = 'Y'", $dblink);
	mysql_query("insert into ".$config["table_prefix"]."pages set tag = 'DerniersCommentaires', body = '{{RecentlyCommented}}', user = 'WikiNiInstaller', time = now(), latest = 'Y'", $dblink);
	mysql_query("insert into ".$config["table_prefix"]."pages set tag = 'ParametresUtilisateur', body = '{{UserSettings}}', user = 'WikiNiInstaller', time = now(), latest = 'Y'", $dblink);
	mysql_query("insert into ".$config["table_prefix"]."pages set tag = 'PagesACreer', body = '{{WantedPages}}', user = 'WikiNiInstaller', time = now(), latest = 'Y'", $dblink);
	mysql_query("insert into ".$config["table_prefix"]."pages set tag = 'PagesOrphelines', body = '{{OrphanedPages}}', user = 'WikiNiInstaller', time = now(), latest = 'Y'", $dblink);
	mysql_query("insert into ".$config["table_prefix"]."pages set tag = 'RechercheTexte', body = '{{TextSearch}}', user = 'WikiNiInstaller', time = now(), latest = 'Y'", $dblink);
	mysql_query("insert into ".$config["table_prefix"]."pages set tag = 'ReglesDeFormatage', body = '==== Guide des règles de formatage ====\n\nLes règles de formatage avec Wakka diffèrent légèrement des autres Wikis. (Voir par exemple [[http://c2.com/cgi/wiki?TextFormattingRules les règles de formatage de WikiWikiWeb]], le premier Wiki connu.)\nTout texte placé entre deux guillemets doubles - \" - est présenté tel que.\n\nVous pouvez effectuer vos propres test dans le BacASable : c\'est un endroit fait pour ça.\n\nRègles de base :\n	\"\"**Texte en gras !** -----\"\"> **Texte en gras !**\n	\"\"//Texte en italique.// -----\"\"> //Texte en italique.//\n	\"\"Texte __souligné__ ! -----\"\"> Texte __souligné__ !\n	\"\"##texte à espacement fixe## -----\"\"> ##texte à espacement fixe##\n	\"\"%%code%%\"\"\n	\"\"%%(php) PHP code%%\"\"\n\nLiens forcés :\n	\"\"[[http://www.mon-site.org]]\"\"\n	\"\"[[http://www.mon-site.org Mon-site]]\"\"\n	\"\"[[P2P]]\"\"\n	\"\"[[P2P Page sur le P2P]]\"\"\n\nEn-têtes :\n	\"\"====== En-tête énorme ======\"\" ====== En-tête énorme ======\n	\"\"===== En-tête très gros =====\"\" ===== En-tête très gros =====\n	\"\"==== En-tête gros ====\"\" ==== En-tête gros ====\n	\"\"=== En-tête normal ===\"\" === En-tête normal ===\n	\"\"== Petit en-tête ==\"\" == Petit en-tête ==\n\nSéparateur horizontal :\n	\"\"-----\"\"\n\nRetour de ligne forcé :\n	\"\"---\"\"\n\nL\'indentation de textes se fait avec la touche \"TAB\". Vous pouvez aussi créer des listes à puces ou numérotées :\n	\"\"- liste à puce\"\"\n	\"\"1) liste numérotée (chiffres arabes)\"\"\n	\"\"A) liste numérotée (capitales alphabétiques)\"\"\n	\"\"a) liste numérotée (minuscules alphabétiques)\"\"\n	\"\"i) liste numérotée (chiffres romains)\"\"\n\nNote : à cause d\'un [[http://bugzilla.mozilla.org/show_bug.cgi?id=10547 bogue dans son moteur de rendu]], les listes, utilisant la touche TAB, ne fonctionnent pas (encore) sous Mozilla.\n---', user = 'WikiNiInstaller', time = now(), latest = 'Y'", $dblink);
	test("Ajout de pages...", 1);
	break;
	
	// The funny upgrading stuff. Make sure these are in order! //
case "0.1":
	print("<b>En cours de mise à jour de WikiNi 0.1</b><br>\n");
	test("Just very slightly altering the pages table...", 
		@mysql_query("alter table ".$config["table_prefix"]."pages add body_r text not null default '' after body", $dblink), "Already done? Hmm!", 0);
	test("Claiming all your base...", 1);
}

?>

<p>
A l'étape suivante, le programme d'installation va essayer
d'écrire le fichier de configuration <tt><?php echo  $wakkaConfigLocation ?></tt>.
Assurez vous que le serveur web a bien le droit d'écrire dans ce fichier, sinon vous devrez le modifier manuellement.  </p>

<form action="<?php echo  myLocation(); ?>?installAction=writeconfig" method="POST">
<input type="hidden" name="config" value="<?php echo  htmlentities(serialize($config, ENT_COMPAT, 'UTF-8')) ?>">
<input type="submit" value="Continuer">
</form>
