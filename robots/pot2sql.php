#!/usr/bin/php
<?
include('../includes/includes.inc.php');
include('../includes/config/dntp.inc.php');


$pot_a = file('../locales/locale/fr_FR/LC_MESSAGES/dotnode.po');

$db=&DB::connect($dsn);
if (DB::isError($db))
	error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());
	
$db->setFetchMode(DB_FETCHMODE_ASSOC);

$db->query('TRUNCATE TABLE dntp_msgid');
$db->query('TRUNCATE TABLE dntp_msgstr');

function stripslashes2($str)
{
        return str_replace('\"', '"', $str);
}


foreach($pot_a as $line)
{
	$line = trim($line);
	$context['line']++;
	$context['source'] = $line;

	if(preg_match("/^msgid/", $line) && isset($m_msgid) && isset($m_msgstr))
	{
		$rval = $db->query('INSERT INTO dntp_msgid SET md5=?, msgid=?, first_see=?, multiline=?, status=?, date=?', array(md5(stripslashes2($m_msgid)),  stripslashes2($m_msgid), $comment, 'y', 'ok', time()));
		if(DB::isError($rval))
		{
			print_r($context);
			print('m_msgid: '.$rval->getUserInfo()."\n");
		}
		$msgid_id = $db->getOne('SELECT LAST_INSERT_ID()');

		$context['msgid_id']=$msgid_id;

		$rval = $db->query('INSERT INTO dntp_msgstr SET id=?, msgstr=?, `key`=?, lang=?, translator=?, multiline=?, status=?, date=?', array($msgid_id, stripslashes2($m_msgstr), 0, 'fr_FR', 'importation', 'y', 'ok', time()));
		if(DB::isError($rval))
		{
			print_r($context);
			print('m_msgstr: '.$rval->getUserInfo()."\n");
		}

		unset($where);
		unset($m_msgid);
		unset($m_msgstr);
	}

	if(preg_match("/^#(.*)$/", $line, $reg))
	{
		$comment = '/'.trim($reg[1]);
		$context['comment'] = $comment;
	}
	elseif(preg_match("/^msgstr \"\"$/", $line, $reg))
        {
                $where = 'm_msgstr';
                $m_msgstr = '';
                $context['where'] = $where;
        }
        elseif(preg_match("/^msgid \"\"$/", $line, $reg))
        {
                $where = 'm_msgid';
                $m_msgid = '';
                $context['where'] = $where;
        }
        elseif(preg_match("/^\"(.*)\"$/", $line, $reg))
        {
                $$where .= $reg[1]."\n";
                $context[$where] = $reg[1];
        }

	elseif(preg_match("/^msgid \"(.*)\"$/", $line, $reg))
	{
		if(strlen($reg[1])>1) 
		{
			$msgid = $reg[1];
			$rval = $db->query('INSERT INTO dntp_msgid SET md5=?, msgid=?, first_see=?, status=?, date=?', array(md5(stripslashes2($msgid)), stripslashes2($msgid), $comment, 'ok', time()));
			if(DB::isError($rval))
			{
				print_r($context);
				print('msgid: '.$rval->getUserInfo()."\n");
			}
			$msgid_id = $db->getOne('SELECT LAST_INSERT_ID()');
			$context['msgid_id']=$msgid_id;
		}

	}
	elseif(preg_match("/^msgid_plural \"(.*)\"$/", $line, $reg))
	{
		if(strlen($reg[1])>1) 
		{
			$msgid_plural = $reg[1];
			$rval = $db->query('UPDATE dntp_msgid SET msgid_plural=? WHERE id=?', array(stripslashes2($msgid_plural), $msgid_id));
			if(DB::isError($rval))
			{
				print_r($context);
				print('msgid_plural: '.$rval->getUserInfo()."\n");
			}
		}
	}
	elseif(preg_match("/^msgstr \"(.*)\"$/", $line, $reg))
	{
		if(strlen($reg[1])>1) 
		{
			$msgstr = $reg[1];
			$rval = $db->query('INSERT INTO dntp_msgstr SET id=?, msgstr=?, `key`=?, lang=?, translator=?, status=?, date=?', array($msgid_id, stripslashes2($msgstr), 0, 'fr_FR', 'importation','ok', time()));
			if(DB::isError($rval))
			{
				print_r($context);
				print('msgstr: '.$rval->getUserInfo()."\n");
			}
		}
	}
	elseif(preg_match("/^msgstr\[(.)\] \"(.*)\"$/", $line, $reg))
	{
		if(strlen($reg[2])>1)
		{
			$msgstr = $reg[2];
			$rval = $db->query('INSERT INTO dntp_msgstr SET id=?,msgstr=?,`key`=?, lang=?, translator=?, status=?, date=?', array($msgid_id, stripslashes2($msgstr), $reg[1], 'fr_FR', 'importation', 'ok', time()));
			if(DB::isError($rval))
			{
				print_r($context);
				print('msgstr plural: '.$rval->getUserInfo()."\n");
			}
		}
	}
	else
	{
		unset($msgid_id);
		unset($msgid);
		unset($msgstr);
		unset($msgstr);
	}
}

$db->disconnect();
