#!/usr/bin/php
<?
include('../includes/includes.inc.php');
include('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$lang = $argv[1];

putenv('LANG='.$lang);
setlocale (LC_MESSAGES, $lang);

bindtextdomain("dotnode", LOCALEPATH);
textdomain("dotnode");

/************************** Wiki ************************/
$db_wiki =& DB::connect($dsn_wiki);
if (DB::isError($db_wiki))
        error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db_wiki->getMessage());
$db_wiki->setFetchMode(DB_FETCHMODE_ASSOC);
$page =& $db_wiki->getOne('SELECT body FROM pages WHERE tag=? AND lang=? AND latest=?', array('DotNodeMailPassword', $lang, 'Y'));
if(!$page)
	$page =& $db_wiki->getOne('SELECT body FROM pages WHERE tag=? AND lang=? AND latest=?', array('DotNodeMailPassword', 'en_US', 'Y'));

$db_wiki->disconnect();
/********************************************************/

$todo_r = $db->query('SELECT id_todo, param, id, date, ip FROM todo WHERE robot=? AND status=? AND lang=?', array('send_password', 'todo', $argv[1]));
if(DB::isError($todo_r))
	error_log($todo_r->getUserInfo());

while($todo = $todo_r->fetchRow())
{
        /*********** recup des param de la todo ******************/
        if(strstr($todo['param'],'|') != false)
                $param_array = split("\|", $todo['param']);
        else
                $param_array = array($todo['param']);

        foreach($param_array as $item)
        {
                list($parameter, $value) = split('=', $item);
                $param[$parameter] = $value;
        }
        /*********************************************************/

	$user = $db->getRow('SELECT id, lname, fname, login FROM cache_user WHERE id=?', array($todo['id']) );

	$search_a = array('#domain#', '#fname#', '#lname#', '#id#', '#login#');
	$replace_a = array($config['domain'], $user['fname'], $user['lname'], $user['id'], $user['login']);

	$mail['Subject'] = '[.node] '.strarg(_('Change your password'), $user['fname'], $user['lname']);
	$mail['body'] = str_replace($search_a, $replace_a, $page);

	$mail['ReturnPath'] = 'password-'.$todo['id'].'@dotnode.net';
	$mail['From'] = "password-sender@dotnode.com";
	$mail['To'] = $param['email'];


	if(dotMail($mail))
		$db->query('UPDATE todo SET status=? WHERE id=? AND robot=?',array('doing', $user['id'], 'send_password') );
	print $param['email']." - $lang\n";
}

$db->disconnect();
?>
