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

$sonet =& DB::connect($dsn_sonet);
if (DB::isError($sonet))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$sonet->getMessage());


$sonet->setFetchMode(DB_FETCHMODE_ASSOC);

$user_sonet_r = $sonet->query('SELECT * FROM users WHERE etat=?', 'ok');
while($user_sonet = $user_sonet_r->fetchRow())
{
	print $user_sonet['id'] .' '.$user_sonet['md5'] .' '.$user_sonet['id_parent'] ."\n";
	$id_parent = $sonet->getOne('SELECT md5 FROM users WHERE id=?', array($user_sonet['id_parent']));
	print $id_parent."\n--\n";
	$sonet->query('UPDATE users SET id_parent_mp5=? WHERE id=?', array($id_parent, $user_sonet['id']));
}

$sonet->disconnect();

?>
