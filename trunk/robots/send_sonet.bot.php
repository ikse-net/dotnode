#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

/************************** Wiki ************************/
$db_wiki =& DB::connect($dsn_wiki);
if (DB::isError($db_wiki))
        error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db_wiki->getMessage());
$db_wiki->setFetchMode(DB_FETCHMODE_ASSOC);

$page = $db_wiki->getOne('SELECT body FROM pages WHERE tag=? AND lang=? AND latest=?', array('DotNodeSonet', 'fr' , 'Y'));

$db_wiki->disconnect();
/********************************************************/

$invitation_r = $db->query('SELECT user.id as id, id_parent, fname, lname,  user_contact.email as email FROM user LEFT JOIN user_contact USING (id) WHERE status=?', array('waiting') );
if (DB::isError($invitation_r))
        error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Erreur SQL: '.$invitation_r->getMessage());

while($invitation = $invitation_r->fetchRow())
{
	print_r($invitation);
	$friend = $db->getRow('SELECT user_contact.email as email, user.fname as fname, user.lname as lname, user.login as login FROM user LEFT JOIN user_contact USING (id) WHERE user.id=?', array($invitation['id_parent']));

	$header = 'From: '.$friend['email']."\n";
	$header.= 'Content-Type: text/plain; charset="utf-8"'."\n";
	$header.= "X-Sender-IP: 213.186.37.110\n";
	$header.= 'X-Abuse: abuse@sonet.ikse.org'."\n";

	$header.= "X-Mailer: Ikse.net Robot\n";
	$body   = sprintf($page, $invitation['fname'], $invitation['lname'], $friend['fname'], $friend['lname'], $friend['login']);
	$subject = strarg( _('%1 %2 invite you on .node').' (ex-SoNet)' , $friend['fname'], $friend['lname']);
	if(mail($invitation['email'], $subject, $body , $header, '-fsonet-'.$invitation['id'].'@dotnode.net'))
		print $invitation['email']."\n";
}

$db->disconnect();
?>
