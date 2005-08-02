#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$user_r = $db->query('SELECT user.id as id, user.fname as fname, user.lname as lname, user_contact.email as email FROM user LEFT JOIN user_contact USING (id) WHERE user.status=?', array('waiting'));
while($user = $user_r->fetchRow())
{
	print $user['fname'].' '.$user['lname'].' '.$user['email']."\n";
	$todo_values = array(
		'robot' => 'from_sonet',
		'param' => 'email='.$user['email'],
		'etat'  => 'todo',
		'md5'   => $user['id']
	);
	$db->autoExecute('todo', $todo_values);
}

$db->disconnect();
?>
