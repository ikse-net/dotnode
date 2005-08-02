#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$users_r = $db->query('SELECT id  FROM user');
while($user = $users_r->fetchRow())
{
	$nb_friends = $db->getOne('SELECT COUNT(id_friend) FROM relation WHERE id=?', array($user['id']) );
	$friends_id = $db->getCol('SELECT id FROM relation WHERE id_friend=? ORDER BY last_visit DESC', 0, array($user['id']));

	$cache_values= array(
	'nb_friends' => $nb_friends,
	'friends_id' => implode(',',$friends_id)
	);


	$result = $db->autoExecute('cache_user', $cache_values, DB_AUTOQUERY_UPDATE, "id='".$user['id']."'");

	$i++;

	if(DB::isError($result))
		print $result->getUserInfo();
	else
		print $i.'. '.$user['id']." ($nb_friends)\n";

}

$db->disconnect();
print "\n";
?>
