#!/usr/bin/php
<?
include ('../includes/includes.inc.php');

$dsn_sonet = array(
    'phptype'  => 'mysql',
    'username' => 'sonet',
    'password' => 's0n3t!p4ss',
    'hostspec' => 'localhost',
    'database' => 'sonet',
);

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$sonet =& DB::connect($dsn_sonet);
if (DB::isError($sonet))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$sonet->getMessage());


$db->setFetchMode(DB_FETCHMODE_ASSOC);
$sonet->setFetchMode(DB_FETCHMODE_ASSOC);

$user_sonet_r = $sonet->query('SELECT * FROM users WHERE etat=?', 'ok');
while($user_sonet = $user_sonet_r->fetchRow())
{
	$user_values = array(
	$user_sonet['md5'],
	$user_sonet['fname'],
	$user_sonet['lname'],
	$user_sonet['id_parent_mp5'],
	$user_sonet['login'],
	$user_sonet['passwd'],
	$user_sonet['date'],
	$user_sonet['date'],
	time(),
	'ok');
	$db->query('INSERT INTO user SET id=?, fname=?, lname=?, id_parent=?, login=?, passwd=?, join_date=?, invite_date=?, last_visite=?, status=?', $user_values);
	$db->query('INSERT INTO relation SET id=?, id_friend=?', array($user_sonet['md5'], $user_sonet['id_parent_mp5']));
	$db->query('INSERT INTO relation SET id_friend=?, id=?', array($user_sonet['md5'], $user_sonet['id_parent_mp5']));
	$db->query('INSERT INTO user_contact SET id=?, email=?, city=?, zip=?', array($user_sonet['md5'], $user_sonet['email'], $user_sonet['ville'],  $user_sonet['cp']));
	$db->query('INSERT INTO user_professional SET id=?, occupation=?', array($user_sonet['md5'], $user_sonet['profession']));
	$db->query('INSERT INTO user_personal SET id=?, headline=?', array($user_sonet['md5'], $user_sonet['comment']));
	$db->query('INSERT INTO user_interests SET id=?' , array($user_sonet['md5']));
	$db->query('INSERT INTO settings SET id=?' , array($user_sonet['md5']));
	$db->query('INSERT INTO user_general SET id=?' , array($user_sonet['md5']));
}


$sonet->disconnect();
$db->disconnect();

?>
