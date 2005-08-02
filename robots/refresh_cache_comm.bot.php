#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$users_r = $db->query('SELECT id FROM user');
while($user = $users_r->fetchRow())
{

	$nb_communities = $db->getOne('SELECT COUNT(id_comm) FROM user_comm WHERE id=? AND status=?', array($user['id'], 'ok'));
	$communities_id = implode(',', $db->getCol('SELECT id_comm FROM user_comm WHERE id=? AND status=?', 0, array($user['id'], 'ok')));


	$cache_values= array(
	'nb_communities' => $nb_communities,
	'communities_id' => $communities_id
	);


	$result = $db->autoExecute('cache_user', $cache_values, DB_AUTOQUERY_UPDATE, "id='".$user['id']."'");

	$i++;

	if(DB::isError($result))
		print $result->getUserInfo();
	else
		print $i.'. '.$user['id'].' ('.$nb_communities.")\n";

}

$db->disconnect();
print "\n";
?>
