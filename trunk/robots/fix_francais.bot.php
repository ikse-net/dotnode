#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$users_r = $db->query("select user_contact.id AS id from user_contact, user WHERE user.id=user_contact.id AND user.lang='fr_FR' AND user_contact.country is null");
while($user = $users_r->fetchRow())
{

//	print $user['id'].' ('.$user['country'].' / '.$user['gender'].")\n";
	$cache_values= array(
	'country' => 'France'
	);

	$result = $db->autoExecute('user_contact', $cache_values, DB_AUTOQUERY_UPDATE, "id='".$user['id']."'");
	if(DB::isError($result))
		print $result->getUserInfo();
	else
		print $i++.'. '.$user['id']."\n";

}

$db->disconnect();
print "\n";
?>
