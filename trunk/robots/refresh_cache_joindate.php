#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$users_r = $db->query('SELECT id, login, fname, lname, photo, join_date  FROM user');
while($user = $users_r->fetchRow())
{

	$cache_values= array(
	'join_date' => $user['join_date']
	);


	$result = $db->autoExecute('cache_user', $cache_values, DB_AUTOQUERY_UPDATE, "id='".$user['id']."'");
	if(DB::isError($result))
		print $result->getUserInfo();

}

$db->disconnect();
?>
