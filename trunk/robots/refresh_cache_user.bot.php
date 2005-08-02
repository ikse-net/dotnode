#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

if(strlen($argv[1]) == 32)
{
	$db->query('DELETE FROM cache_user WHERE id=?', array($argv[1]));
	$where = " WHERE id='".$argv[1]."'";
}
$users_r = $db->query('SELECT id, login, fname, lname, nick, photo, join_date  FROM user'.$where);
while($user = $users_r->fetchRow())
{
	$country = $db->getOne('SELECT country FROM user_contact WHERE id=?', array($user['id']));

	$cache_values= array(
	'fname'=>$user['fname'],
	'lname'=>$user['lname'],
	'nick'=> $user['nick'],
	'fname_sndex' => $db->getOne('SELECT SOUNDEX(?)', stripslashes($user['fname'])),
        'lname_sndex' => $db->getOne('SELECT SOUNDEX(?)', stripslashes($user['lname'])),
	'nick_sndex'  => $db->getOne('SELECT SOUNDEX(?)', stripslashes($user['nick'])),
	'join_date'=>$user['join_date'],
	'country' => $country
	);

	if(strlen($argv[1]) == 32)
		$result = $db->autoExecute('cache_user', $cache_values, DB_AUTOQUERY_INSERT);
	else
		$result = $db->autoExecute('cache_user', $cache_values, DB_AUTOQUERY_UPDATE, "id='".$user['id']."'");

	$i++;

	if(DB::isError($result))
		print $result->getUserInfo();
	else
		print $i.'. '.$user['id'].' ('.$user['fname'].' '.$user['lname'].")\n";

}

$db->disconnect();
print "\n";
?>
