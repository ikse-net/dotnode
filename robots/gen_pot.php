#!/usr/bin/php
<?
include('../includes/includes.inc.php');
include('../includes/config/dntp.inc.php');

$lang = $argv[1];
$messages = array();

function addslashes2($str)
{
	return str_replace('"', '\"', $str);
}

$db=&DB::connect($dsn);
if (DB::isError($db))
	error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());
	$db->setFetchMode(DB_FETCHMODE_ASSOC);

	$msgid_r = $db->query('SELECT id, msgid, msgid_plural, multiline, first_see FROM dntp_msgid WHERE status=? ORDER BY first_see', array('ok'));

if(DB::isError($msg_r))
	error_log($msg_r->getUserInfo());
	else
while($message = $msgid_r->fetchRow())
{
	$msgstr = $db->getAssoc('SELECT `key`, msgstr, multiline FROM dntp_msgstr WHERE lang=? AND id=? AND last=? ORDER BY `key`', false, array($lang, $message['id'], 'y'));
	$message['msgstr'] = $msgstr;
	if($message['first_see'] != $first_see)
	{
		$first_see = $message['first_see'];
		$messages[$message['id']] = $message;
	}
	else
	{
		$first_see = $message['first_see'];
		unset($message['first_see']);
		$messages[$message['id']] = $message;
	}
}

$db->disconnect();

foreach($messages as $msg)
{
	if($msg['first_see'])
		print "\n\n# ".$msg['first_see']."\n";
	if($msg['msgstr'])
	{
		print '# id: '.$msg['id']."\n";
		if($msg['multiline'] == 'n')
			print 'msgid "'.addslashes2($msg['msgid']).'"'."\n";
		elseif($msg['multiline'] == 'y')
		{
			print 'msgid ""'."\n";
			$msgid_ex = explode("\n", $msg['msgid']);
			foreach($msgid_ex as $msgid_line)
				if(strlen($msgid_line)>0)
					print '"'.addslashes2($msgid_line).'"'."\n";

		}
		if($msg['msgid_plural'])
			print 'msgid_plural "'.addslashes2($msg['msgid_plural']).'"'."\n";

		if($msg['msgid_plural'])
		{
			foreach($msg['msgstr'] as $key=>$msgstr)
				print 'msgstr['.$key.'] "'.addslashes2($msgstr['msgstr']).'"'."\n";
		}
		else
			if($msg['msgstr'][0]['multiline'] == 'y')
			{
				print 'msgstr ""'."\n";
				$msgstr_ex = explode("\n", $msg['msgstr'][0]['msgstr']);
				foreach($msgstr_ex as $msgstr_line)
					if(strlen($msgstr_line)>0)
						print '"'.addslashes2($msgstr_line).'"'."\n";
			}
			else
				print 'msgstr "'.addslashes2($msg['msgstr'][0]['msgstr']).'"'."\n";
		print "\n";
	}
}

print "# lang: $lang\n";

?>
