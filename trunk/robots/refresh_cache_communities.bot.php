#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$comm_r = $db->query('SELECT id, id_comm FROM community');
while($comm = $comm_r->fetchRow())
{
	$nb_members = $db->getOne('SELECT COUNT(id) FROM user_comm WHERE id_comm=? AND status=?', array($comm['id_comm'], 'ok'));

	$result = $db->query('UPDATE community SET nb_members=? WHERE id_comm=?', array($nb_members, $comm['id_comm']));

	if(DB::isError($result))
		print $result->getUserInfo();
}

$db->disconnect();
?>
