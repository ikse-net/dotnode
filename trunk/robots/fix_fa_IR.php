#!/usr/bin/php
<?
include('../includes/includes.inc.php');
include('../includes/config/dntp.inc.php');

$lang = $argv[1];
$messages = array();

$db=&DB::connect($dsn);
if (DB::isError($db))
	error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());
	$db->setFetchMode(DB_FETCHMODE_ASSOC);

	$msgstr_r = $db->query('SELECT * FROM `dntp_msgstr` WHERE `key` = 1 AND `msgstr` = "" AND `lang` LIKE "fa_IR" AND `last` = "y"');

if(DB::isError($msgstr_r))
	error_log($msgstr_r->getUserInfo());
	else
while($message = $msgstr_r->fetchRow())
{
	$msgstr = $db->getOne('SELECT msgstr FROM dntp_msgstr WHERE lang="fa_IR" AND id=? AND last="y" AND `key`=0', array($message['id']));
	$db->query('UPDATE dntp_msgstr SET msgstr=? WHERE id_msgstr=?', array($msgstr, $message['id_msgstr']) );
	echo "UPDATE dntp_msgstr SET msgstr='$msgstr' WHERE id_msgstr='{$message['id_msgstr']}'\n";
}

$db->disconnect();

?>
