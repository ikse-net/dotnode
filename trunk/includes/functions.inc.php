<?php
/****************************************************** Open .node ***
 * Description:   
 * Status:        Stable.
 * Author:        Alexandre Dath <alexandre@dotnode.com>
 * $Id$
 *
 * Copyright (C) 2005 Alexandre Dath <alexandre@dotnode.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software Foundation,
 * Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 ******************** http://opensource.ikse.net/projects/dotnode ***/


function tr($str)
{
//	error_log('TRANSLATE '.$str.' => '._($str));
	if(trim($str) == '')
		return '';
	else
		return _($str);
}

function retreive_url_info($url)
{                       
        $url = ereg_replace("^/", "", $url);
        $token = split('/', $url);
	if(ereg("\.php$", $token[0]))
		$token[0] = substr($token[0], 0, -4);
	return $token;
}

function get_pref_language_array($str_http_languages)
{
  $langs = explode(',',$str_http_languages);
  $qcandidat = 0;
  $nblang = count($langs);

  for ($i=0; $i<$nblang; $i++)
  {
    for ($j=0; $j<count($langs); $j++) {
      $lang = trim($langs[$j]); // Supprime les espaces avant et après $lang
      // Lang est de la forme langue;q=valeur
      
      if (!strstr($lang, ';') && $qcandidat != 1) {
        // Si la chaine ne contient pas de valeur de préférence q
        $candidat = $lang;
        $qcandidat = 1;
        $indicecandidat = $j;
      }
      else {
        // On récupère l'indice q
        $q = ereg_replace('.*;q=(.*)', '\\1', $lang);

        if ($q > $qcandidat) {
          $candidat = ereg_replace('(.*);.*', '\\1', $lang); ;
          $qcandidat = $q;
          $indicecandidat = $j;     
        }
      }
    }
    
    $resultat[$i] = $candidat;

    $qcandidat=0;
    // On supprime la valeur du tableau
    unset($langs[$indicecandidat]);   
    $langs = array_values($langs);
  }
  return $resultat;
}

function build_image_path($id, $makedir=false,$ext='png')
{
        $elmt[0] = substr($id, 0, 2);
        if($makedir) @mkdir(PHOTOPATH.'/'.$elmt[0]);
        $elmt[1] = substr($id, 2, 2);
        if($makedir) @mkdir(PHOTOPATH.'/'.$elmt[0].'/'.$elmt[1]);
        return PHOTOPATH.'/'.$elmt[0].'/'.$elmt[1].'/'.$id.'.'.$ext;
}

function build_thumb_path($id, $makedir=false, $ext='png')
{
        $elmt[0] = substr($id, 0, 2);
        if($makedir) @mkdir(PHOTOPATH.'/thumb/'.$elmt[0]);
        $elmt[1] = substr($id, 2, 2);
        if($makedir) @mkdir(PHOTOPATH.'/thumb/'.$elmt[0].'/'.$elmt[1]);
        return PHOTOPATH.'/thumb/'.$elmt[0].'/'.$elmt[1].'/'.$id.'.'.$ext;
}

function build_image_url($id, $ext='png')
{
        $elmt[0] = substr($id, 0, 2);
        $elmt[1] = substr($id, 2, 2);
        return '/photos/'.$elmt[0].'/'.$elmt[1].'/'.$id.'.'.$ext;
}

function build_thumb_url($id, $ext='png')
{
        $elmt[0] = substr($id, 0, 2);
        $elmt[1] = substr($id, 2, 2);
        return '/photos/thumb/'.$elmt[0].'/'.$elmt[1].'/'.$id.'.'.$ext;
}

function build_album_path($id, $id_image, $makedir=false, $ext='png')
{
        $elmt[0] = substr($id, 0, 2);
        if($makedir) @mkdir(ALBUMPATH.'/'.$elmt[0]);
        $elmt[1] = substr($id, 2, 2);
        if($makedir) @mkdir(ALBUMPATH.'/'.$elmt[0].'/'.$elmt[1]);
        return ALBUMPATH.'/'.$elmt[0].'/'.$elmt[1].'/'.$id_image.'.'.$ext;
}

function build_album_thumb_path($id, $id_image, $makedir=false, $ext='png')
{
        $elmt[0] = substr($id, 0, 2);
        if($makedir) @mkdir(ALBUMPATH.'/thumb/'.$elmt[0]);
        $elmt[1] = substr($id, 2, 2);
        if($makedir) @mkdir(ALBUMPATH.'/thumb/'.$elmt[0].'/'.$elmt[1]);
        return ALBUMPATH.'/thumb/'.$elmt[0].'/'.$elmt[1].'/'.$id_image.'.'.$ext;
}


function build_album_url($id, $id_image, $ext='png')
{
        $elmt[0] = substr($id, 0, 2);
        $elmt[1] = substr($id, 2, 2);
        return '/albums/'.$elmt[0].'/'.$elmt[1].'/'.$id_image.'.'.$ext;
}

function build_album_thumb_url($id, $id_image, $ext='png')
{
        $elmt[0] = substr($id, 0, 2);
        $elmt[1] = substr($id, 2, 2);
        return '/albums/thumb/'.$elmt[0].'/'.$elmt[1].'/'.$id_image.'.'.$ext;
}

function build_logo_url($id, $id_image, $ext='png')
{
        $elmt[0] = substr($id, 0, 2);
        $elmt[1] = substr($id, 2, 2);
        return '/comm_logos/'.$elmt[0].'/'.$elmt[1].'/'.$id_image.'.'.$ext;
}

function build_logo_thumb_url($id, $id_image, $ext='png')
{
        $elmt[0] = substr($id, 0, 2);
        $elmt[1] = substr($id, 2, 2);
        return '/comm_logos/thumb/'.$elmt[0].'/'.$elmt[1].'/'.$id_image.'.'.$ext;
}


function insert_image_album($id, $width, $height, $format, $caption)
{
	global $db;
//	$caption = $db->quoteSmart($caption);
	$db->query('INSERT INTO album SET id=?, width=?, height=?, format=?, caption=?, date=NOW()', array($id, $width, $height, $format, $caption));
	$insert_id = $db->getOne('SELECT LAST_INSERT_ID()');

	$nb_photos = $db->getOne('SELECT COUNT(id) FROM album WHERE id=?', $id);
        $db->query('UPDATE cache_user SET nb_photos=? WHERE id=?', array($nb_photos, $id));

	return $insert_id;
}

function count_image_album($id)
{
	global $db;
	$result = $db->query('SELECT id_image FROM album WHERE id=?', $id);
	return $result->numRows();
}

function set_acccess_list($id, $post_access)
{
	global $db;
	foreach($post_access as $table_name=>$values)
	{
		foreach($values as $field_name=>$field_access)
		{
			switch($field_access)
			{
			case 'myself':
			case 'friends':
			case 'friends_of_friends':
			case 'members':
			case 'everyone':
				$db->query('DELETE FROM access WHERE id=? AND table_name=? AND field=?', array($id, $table_name, $field_name));
				$db->query('INSERT INTO access SET id=?, table_name=?, field=?, access=?', array($id, $table_name, $field_name, $field_access));
			}
		}
	}

}

function get_access_list($id, $table)
{
	global $db;
	global $access_fields;
	$accesses = $db->query('SELECT field, access FROM access WHERE id=? AND table_name=?', array($id, $table));
	$rval = array();
	if(!DB::isError($accesses ) )
		while($access = $accesses->fetchRow())
		{
			$rval[$access['field']] = $access['access'];
		}
	else
		error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | '.$accesses->getUserInfo());

	if(array_key_exists($table, $access_fields) )
	foreach($access_fields[$table] as $item=>$value)
	{
		if(!array_key_exists($item,$rval) )
			$rval[$item] = $value;
	}
	return $rval;
}

function access_weight($access_str)
{
	switch($access_str)
	{
	case 'myself': 		return 1;   break;
	case 'friends': 		return 2;   break;
	case 'friends_of_friends': 	return 4;   break;
	case 'everyone': 		return 16;  break;
	case 'members':
	default:               		return 8;   break;
	}
}

function get_relation_type($my_id, $my_friends_id, $user_id, $user_friends_id)
{
	if($user_id == $my_id)
	{
		return 'myself';
	}
	elseif(in_array($user_id, $my_friends_id) )
	{
		return 'friends';
	}
	elseif($intermediaire = array_intersect($session['my_friends_id'], $user['friends_id']))
	{
		return  'friends_of_friends';
	}
	else
		return 'members';
}

function translate_list($list, $labels_tab, $separator=',', $separator_out=', ')
{
	$translated_thing = array();                                    // declaration du tableau qui va recevoir les chaines traduites
	$things = explode($separator, $list);                // on separe ce qu'il y a en base dans un tableau $things
	foreach($things as $thing)                                      // pour chaque elements du SET
		array_push($translated_thing, _($labels_tab[$thing])); // on ajoute dans le tableau $translated_thing la traduction du label de la valeur, trouvé dans labels.inc.php
	return implode($separator_out, $translated_thing);                      // on reforme un truc affichable et on le mets dans $value
}

function get_cache_user_info($id, $fields="", $update_friends_order=false)
{
	global $db;
	global $labels;

	global $url_id;

	if(!$fields)
		$fields = 'id, login, fname, lname, nick, country, gender, relationship_status, here_for, nb_friends, friends_id, nb_communities, communities_id, nb_fans, nb_bookmarks, nb_blogs, nb_photos, fun, cool, sexy, photo, join_date';

	$info = $db->getRow('SELECT ! FROM cache_user WHERE id=? OR login=? LIMIT 1', array($fields, $id, $id));
	if(is_array($info))
	{
		$info['photo_path'] = build_image_url($info['id']);
		$info['thumb_path'] = build_thumb_url($info['id']);

		if(array_key_exists('gender', $info) && $info['gender'] != NULL )
			$info['gender_t'] = translate_list($info['gender'], $labels['profile']['gender']);

		if(array_key_exists('relationship_status', $info) && $info['relationship_status'] != NULL )
                        $info['relationship_status_t'] = translate_list($info['relationship_status'], $labels['profile']['relationship_status']);

		if(array_key_exists('here_for', $info) && $info['here_for'] != NULL )
			$info['here_for_t'] = translate_list($info['here_for'], $labels['profile']['here_for']);

		if(array_key_exists('friends_id', $info) && $info['friends_id'] != NULL)
		{
			if(strpos($info['friends_id'],','))
				$info['friends_id'] = explode(',', $info['friends_id']);
			else
				$info['friends_id'] = array($info['friends_id']);

			if($update_friends_order && in_array($_SESSION['my_id'], array_values($info['friends_id'])))
			{
				$my_offset = array_search($_SESSION['my_id'], $info['friends_id']);
				array_splice($info['friends_id'], $my_offset, 1);
				array_unshift($info['friends_id'], $_SESSION['my_id']);
				$db->query('UPDATE cache_user SET friends_id=? WHERE id=?', array(implode(',',$info['friends_id']), $url_id));
			}

		}
		else
			$info['friends_id'] = array();

		if(array_key_exists('communities_id', $info) && $info['communities_id'] != NULL)
			if(strpos($info['communities_id'],','))
					$info['communities_id'] = explode(',', $info['communities_id']);
				else
					$info['communities_id'] = array($info['communities_id']);
		else
			$info['communities_id'] = array();
		return $info;
	}
	else
		return array('fname'=> _('In jail or deleted'), 'lname'=>'', 'thumb_path' => '/photos/thumb/jail.png', 'photo_path' => '/photos/jail.png' , 'nb_friends' => 0);
}

function array_key_flip($array)
{
	foreach($array as $key=>$value1)
		foreach($value1 as $key2=> $value)
			$rval[$key2][$key] = $value;
	return $rval;
}

function valid_email($email)
{
//        return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@([0-9a-z](-?[0-9a-z])*\.)+[a-z]{2}([zmuvtg]|fo|me)?$",$email);
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@([0-9a-z](-?[0-9a-z])*\.)+[a-z]{2,5}$",$email);
}

function valid_lang($lang)
{
	switch($lang)
	{
		case 'en_US':
		case 'en_L33T':
		case 'fr_FR':
		case 'es_ES':
		case 'ja_JP':
		case 'pt_BR':
		case 'fa_IR':
		case 'de_DE':
		case 'ca_ES':
			return true;
		default:
			return false;
	}
}

function normalize_lang($lang)
{
	switch($lang)
	{
	case 'fr':
	case 'fr_FR':
	case 'fr_BE':
	case 'fr_CA':
	case 'fr_CH':
	case 'fr-fr':
	case 'fr-be':
        case 'fr-ca':
        case 'fr-ch':
	case 'be':
	case 'ca':
		$rval = 'fr_FR';
		break;
	case 'en':
	case 'en_GB':
	case 'en-gb':
	case 'en_US':
	case 'en-us':
	case 'us':
		$rval = 'en_US';
		break;
	case 'br':
	case 'pt_BR':
	case 'pt-br':
		$rval = 'pt_BR';
		break;
	case 'pt':
	case 'pt_PT':
	case 'pt-pt':
		$rval = 'pt_PT';
		break;
	case 'ja':
	case 'jp':
	case 'ja_JP':
	case 'ja-jp':
		$rval = 'ja_JP';
		break;

	case 'fa':
	case 'fa-ir':
	case 'fa_IR':
		$rval = 'fa_IR';
		break;
	case 'es':
	case 'es_ES':
	case 'es-es':
		$rval = 'es_ES';
		break;
	case 'de':
	case 'de_DE':
	case 'de-de':
	case 'de_CH':
	case 'de-ch':
		$rval = 'de_DE';
		break;

	case 'ca_es':
	case 'ca-es':
	case 'ca_AD':
	case 'ca-ad':
	case 'ca_ad':
	case 'ca_ES':
		$rval = 'ca_ES';
		break;

	case 'en_L33T':
		$rval = 'en_L33T';
		break;
	default:
		$rval = null;
	}
	
	return $rval;
}

include('removeaccents.inc.php');

function label2name($label)
{
        $name = strtolower(removeaccents($label));
        $name = preg_replace("/[^a-z0-9\.]/","-", $name);
        $name = preg_replace("/^[\-|\.]*/","", $name);
        $name = preg_replace("/[\-|\.]*$/","", $name);
        $name = stripslashes($name);
        $name = preg_replace("/[\-]{2,}/", "-", $name);

        return trim($name);
}

function valid_login($login)
{
	global $db;

        if(strlen($login)<3)
                return false;

	$bad_login = array (
'www', 'mail', 'smtp', 'imap', 'pop', 'pop3', 'mysql', 'home','irc','ircd', 'todo',
'pede',
'udf', 'ump', 'cgt', 'cfdt',
'club', 'nyrk','asso','all-hp','login','foaf','blog','blogs',
'jabber', 'icq', 'msn', 'yahoo', 'hotmail', 'wanadoo','free',
'bug','bugs','debug','dev','wish','xml',
'wiki','wikini','wikiwiki','dntp',
'nathalie','nath59','alex','alexx','alexx'
	);

	$bad_word = array (
'sql', 'stat',
'ns[0-9]{1,}', 'dns', 'admin', 'moderat', 'ikse', 'microsoft', 'linux', 'php[1-9]{1,}', 'bsd', 'apple', 'atari', 'amiga', 'beos', 'macos',
'bite', 'bitte', 'couille', 'sex', 'anal', 'fist', 'condom', 'capote', 'vagin', 'chatte', 'clito', 'cum', 'sperm', 'breast', 'blow', 'sodo', 'sado', 'zoophi', 'cock', 'pussy',
'connar', 'conar', 'encul', 'homoph', 'lesb', 'gay', 'pute', 'puta', 'fuck', 'pedo', 'pedal', 'batar', 'enfoir', 'salo', 'salau', 'con',
'facho', 'racist', 'racism', 'arab', 'magreb', 'juif', 'juiv', 'youpin', 'polak', 'bougnoul', 'negr', 'riton',
'orkut', 'sonet', 'dotnode', 'orcut',
'mozilla','firefox','firebird','thunderbird'
	);

        foreach($bad_login as $bad)
        {       
                if($login == $bad)
                        return false;
        }

	foreach($bad_word as $word)
	{
		if(eregi($word, $login))
			return false;
	}

	$already_exist = $db->getOne('SELECT COUNT(id) FROM user WHERE login=?', array($login));
	if($already_exist==1)
		return false;

        return true;
}

function login_exist($login)
{
	global $db;
	$id_exist = $db->getOne('SELECT id FROM user WHERE login=?', array($login));
        if(isset($id_exist))
                return $id_exist;
	else
		return false;
}

function get_settings($id, $field)
{
	return $db->getOne('SELECT  new_friend_approval FROM settings WHERE id=?', array($id));
}

function active_message($type, $from_str, $id_to, $subject, $message,$id_from=NULL )
{
        global $db;
        $time = time();
        if($from_str == '')
                $from_str = $db->getOne('SELECT fname FROM user WHERE id=?', array($id_from));

        $message_values = array(
                'id' => $id_to,
		'id_from' => $id_from,
                'from_str' => $from_str,
                'type' => $type,
                'dest' => 'one',
                'subject' => $subject,
                'message' => $message,
                'box' => 'inbox',
                'date' => $time);


        $res = $db->autoExecute('message', $message_values);
        if(DB::isError($res))
	{
		return false;
                error_log(__FUNCTION__.' | '.$res->getUserInfo());
	}
	else
		return true;
}

function auto_message($id_from, $id_to, $subject, $message, $dest='one', $from_str='')
{
	global $db;
	$time = time();
	if($from_str == '')
		$from_str = $db->getOne('SELECT fname FROM user WHERE id=?', array($id_from));

	switch($dest)
	{
	case 'one':
	case 'friends':
	case 'friends_of_friends':
		break;
	default:
		$dest = 'one';
	}

	$message_values = array(
                'id' => $id_to,
                'id_from' => $id_from,
                'from_str' => $from_str,
                'type' => 'message',
                'dest' => $dest,
                'subject' => $subject,
                'message' => $message,
                'box' => 'outbox',
                'date' => $time);

        $res = $db->autoExecute('message', $message_values);
	if(DB::isError($res))
	{
		error_log(__FUNCTION__.' | '.$res->getUserInfo());
		return false;
	}
	else
		return true;
}

/* dotMail
 * params : associative array like this ...
 *      $params['ReturnPath']
 *      $params['From']
 *      $params['To']
 *      $params['Subject']
 *      $params['body']
 *
 */
function dotMail($params)
{
#	global $_SERVER;
#	global $_SESSION;
	extract($params);

	$mime =& Mail::factory('mime', "\n");
	if($ReturnPath)
		$param = '-f'.$ReturnPath;
        $mail =& Mail::factory('mail', $param);

	$mime->setFrom($From);
	$mime->setSubject($Subject);
	$mime->setTXTBody($body);

	$hdrs['X-Abuse'] = 'abuse@dotnode.net';
        $hdrs['X-Mailer'] = 'Ikse.net Robot';
#         $hdrs['X-Sender-IP'] = $_SERVER['REMOTE_ADDR'];
#	$hdrs['X-Dotnode-profile'] = "http://'.$config['domain'].'/profile/".$_SESSION['my_id'];
	$mail_params = array(
                'head_charset'  => 'UTF-8',
                'text_charset'  => 'UTF-8',
                'text_encoding' => '8bit');

	$body = $mime->get($mail_params);
        $hdrs = $mime->headers($hdrs);

	$rval = $mail->send($To, $hdrs, $body);

        if(!$rval)
	{
                error_log(__FUNCTION__.' from: '.$From);
                error_log(__FUNCTION__.' subject: '.$Subject);
                error_log(__FUNCTION__." body:\n".$body);
                error_log(__FUNCTION__.' return_path: '.$ReturnPath);
		return false;
        }
	else
		return true;

}

function auto_mail($id_from, $id_to, $subject, $body)
{
	global $db;

	$from = $db->getRow('SELECT user_contact.email as email, user.fname as fname, user.lname as lname, user.login as login FROM user LEFT JOIN user_contact USING (id) WHERE user.id=?', array($id_from));
	$to = $db->getRow('SELECT user_contact.email as email, user.fname as fname, user.lname as lname, user.login as login FROM user LEFT JOIN user_contact USING (id) WHERE user.id=?', array($id_to));

	$f_name = addslashes($from['fname'].' '.$from['lname']);

	$mail['From'] = '"'.$f_name.'" <'.$from['email'].'>';
	$mail['To'] = $to['email'];
	$mail['Subject'] = '[.node] '.stripslashes($subject);
	$mail['ReturnPath'] = $from['email'];
	$mail['body'] = stripslashes($body);

	return dotMail($mail);
}

function get_setting($id, $field)
{
	global $db;
	return $db->getOne('SELECT ! FROM settings WHERE id=?', array($field, $id));
}

function get_mysql_soundex($str)
{
	global $db;
	return $db->getOne('SELECT SOUNDEX(?)', stripslashes($str));
}

function get_karma($id, $karma)
{
        global $db;
        $kres = $db->getRow('SELECT sum( ! ) as total, count( ! ) as nb FROM relation WHERE id_friend=?', array($karma, $karma, $id));
        if($kres['nb'] > 3)
	{
		error_log("$id: $karma=".$kres['total']/$kres['nb']);
                return $kres['total']/$kres['nb'];
	}
        else
	{
                return -99;
	}
}

function get_status($id)
{
	global $db;
	return $db->getOne('SELECT status FROM user WHERE id=?', array($id));
}

include('upload_image.inc.php');

?>
