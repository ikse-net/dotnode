#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$comm_r = $db->query('SELECT DISTINCT(id_comm) as id_comm FROM user_comm GROUP BY id_comm');
while($comm = $comm_r->fetchRow())
{
	$i++;
	$name = $db->getOne('SELECT name FROM community WHERE id_comm=?', array($comm['id_comm']) );

	if(DB::isError($result))
		print $result->getUserInfo();
	elseif(strlen($name)<1)
	{
		print "$i. ".$comm['id_comm']." $name\n";
		$db->query('DELETE FROM user_comm WHERE id_comm=?', array($comm['id_comm']));
	}

}

$db->disconnect();
print "\n";
?>
