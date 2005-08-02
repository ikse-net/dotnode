#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$users_r = $db->query('SELECT id FROM cache_user WHERE gender IS NULL OR country IS NULL');
while($user = $users_r->fetchRow())
{

//	print $user['id'].' ('.$user['country'].' / '.$user['gender'].")\n";
	$cache_values= array(
	'status' => 'waiting'
	);


		$result = $db->autoExecute('user', $cache_values, DB_AUTOQUERY_UPDATE, "id='".$user['id']."'");
	if(DB::isError($result))
		print $result->getUserInfo();
	else
		print $i++.'. '.$user['id'].' ('.$user['country'].' / '.$user['gender'].")\n";

}

$db->disconnect();
print "\n";
?>
