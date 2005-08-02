#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$db->query('TRUNCATE TABLE community_keyword');

$comm_r = $db->query('SELECT id_comm, name, description, id_cat FROM community');
while($comm = $comm_r->fetchRow())
{
	$idx++;
	print $idx.'. "'.$comm['name'].'" ';
	$array_description = explode(' ', $comm['description']);
	$array_name = explode(' ', $comm['name']);

	$array = array_merge($array_description, $array_name);

	foreach($array as $elemt)
	{
		$elemt = ereg_replace("(.*)s$", "\\1", $elemt);

		if( strlen($elemt)>2 && !ereg("^http", $elemt) )
		{
			$sndx = get_mysql_soundex($elemt);
			$db->query('INSERT INTO community_keyword SET key_sndx=?, id_comm=?, id_cat=?', array($sndx, $comm['id_comm'], $comm['id_cat']));
			print '.';
		}
	}
	print "\n";

}

$db->disconnect();
?>
