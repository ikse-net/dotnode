#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$lang = $argv[1];

putenv("LANG=".$lang);
setlocale (LC_MESSAGES, $lang);

bindtextdomain("dotnode", LOCALEPATH);
textdomain("dotnode");

/************************** Wiki ************************/
$db_wiki =& DB::connect($dsn_wiki);
if (DB::isError($db_wiki))
        error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db_wiki->getMessage());
$db_wiki->setFetchMode(DB_FETCHMODE_ASSOC);

$page =& $db_wiki->getOne('SELECT body FROM pages WHERE tag=? AND lang=? AND latest=?', array('DotNodeMailInvit', $lang, 'Y'));
if(!$page)
	$page =& $db_wiki->getOne('SELECT body FROM pages WHERE tag=? AND lang=? AND latest=?', array('DotNodeMailInvit', 'en_US', 'Y'));

$db_wiki->disconnect();
/********************************************************/

$invitation_r = $db->query('SELECT id, id_invit, fname, lname, email, lang, ip  FROM invitation_email WHERE status=? AND lang=?', array('todo', $argv[1]));

while($invitation = $invitation_r->fetchRow())
{
	$friend = $db->getRow('SELECT user_contact.id, user_contact.email as email, user.fname as fname, user.lname as lname, user.login as login FROM user LEFT JOIN user_contact USING (id) WHERE user.id=?', array($invitation['id_invit']));

	$mail = array(
		'From' => '"'.addslashes($friend['fname'].' '.$friend['lname']).'" <'.$friend['email'].'>',
		'To' => $invitation['email'],
		'ReturnPath' => 'invitation-'.$invitation['id'].'@dotnode.net' );

	unset($message_perso);

	if($message_perso = get_setting($friend['id'], 'invitation_message'))
	{
		$personal_message = "~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~\n";
		$personal_message.= tr('A personal message from your friend')." :\n";
		$personal_message.= $message_perso;
		$personal_message.= "\n~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~\n";
	}
	$search_a = array('#domain#', '#friend_fname#', '#friend_lname#', '#personal_message#', '#friend_login#', '#invitation_id#');
	$replace_a = array($config['domain'], $friend['fname'], $friend['lname'], $personal_message, $friend['login'], $invitation['id']);

	$mail['Subject'] = strarg(tr('%1 %2 invite you on .node'), $friend['fname'], $friend['lname']);
	$mail['body'] = str_replace($search_a, $replace_a, $page);


	if(dotMail($mail))
		$db->query('UPDATE invitation_email SET status=? WHERE id=?',array('doing', $invitation['id']) );

	print $argv[0].' '.$invitation['fname'].' '.$invitation['lname'].' <'.$invitation['email'].'>'." - $lang\n";
}

$db->disconnect();
?>
