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


$login = trim(label2name($_POST['login']));
$passwd = trim($_POST['passwd']);
$passwd2 = trim($_POST['passwd2']);


if($login && $passwd && valid_login($login) && isset($_POST['accept']))
{

	if($passwd == $passwd2)
	{
		if(strtoupper($_POST['code']).'.jpeg' == $_SESSION['pix_code'])
		{
			$user_values = array(
				'id'		=> $_SESSION['my_id'],
				'login'		=> $login,
				'passwd_md5'	=> md5($_POST['passwd']),
				'fname'		=> $_SESSION['my_fname'],
				'lname'		=> $_SESSION['my_lname'],
				'id_parent'	=> $_SESSION['my_id_invit'],
				'join_date'	=> time(),
				'last_visite'	=> time(),
				'invite_date'	=> $_SESSION['invitation_date'],
				'lang'		=> $lang,
				'status'	=> 'waiting'
				);
			$res = $db->autoExecute('user', $user_values);
			if(DB::isError($res))
			{
				error_log(__FILE__.' '.$res->getUserInfo());

				$header = "From: error@dotnode.net";
				$to = "debug@dotnode.net";
				$body = "SESSION: ".print_r($_SESSION, true)."\n\nPOST: ".print_r($_POST, true)."\n\nGLOBALS: ".print_r($GLOBALS, true);
				mail($to, "ERROR !!!!!!!!!!!!!!!!!!!", $body);

				$_SESSION['error']['title'] = 'Erreur inconnu';
				$_SESSION['error']['msg'] = 'Une erreur inconnu est survenu. Merci de recommencer';
				header('Location: /new');

				exit();
			}

			$db->query('INSERT INTO cache_user SET id=?, login=?, fname=?, lname=?, fname_sndex=SOUNDEX(?), lname_sndex=SOUNDEX(?), nb_friends=?, friends_id=?, join_date=?', array($_SESSION['my_id'], $login, $_SESSION['my_fname'], $_SESSION['my_lname'], $_SESSION['my_fname'], $_SESSION['my_lname'], 1, $_SESSION['my_id_invit'], time()));
			$db->query('INSERT INTO user_contact SET id=?, email=?', array($_SESSION['my_id'], $_SESSION['my_email']));

			$db->query('INSERT INTO user_professional SET id=?', array($_SESSION['my_id']));
			$db->query('INSERT INTO user_personal SET id=?', array($_SESSION['my_id']));
			$db->query('INSERT INTO user_general SET id=?', array($_SESSION['my_id']));
			$db->query('INSERT INTO user_interests SET id=?', array($_SESSION['my_id']));

			$db->query('INSERT INTO relation SET id=?, id_friend=?', array($_SESSION['my_id'], $_SESSION['my_id_invit']));
			$db->query('INSERT INTO relation SET id_friend=?, id=?', array($_SESSION['my_id'], $_SESSION['my_id_invit']));

			$db->query('UPDATE invitation_email SET status=?, response=? WHERE id=?', array('done', 'accepted', $_SESSION['my_id']));

			$friend_friends_id = $db->getCol('SELECT id FROM relation WHERE id_friend=? ORDER BY last_visit DESC',0,$_SESSION['my_id_invit']);
			$db->query('UPDATE cache_user SET friends_id=?, nb_friends=? WHERE id=?', array(implode(',',$friend_friends_id), count($friend_friends_id), $_SESSION['my_id_invit'] ));


			$message_values = array(
				'id' => $_SESSION['my_id_invit'],
				'id_from' => $_SESSION['my_id'],
				'from_str' => $_SESSION['my_fname'],
				'type' => 'friend_invitation_accepted',
				'dest' => 'one',
				'subject' => $_SESSION['my_fname'].' has accepted your invitation',
				'message' => 'Thanks',
				'box' => 'inbox',
				'date' => time());

			$db->autoExecute("message", $message_values);


			$_SESSION['my_login'] = $login;
			$_SESSION['my_status'] = 'waiting';
			$_SESSION['my_ip'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION['my_photo'] = build_image_url($_SESSION['my_id']);

			$nb_nodians = $db->getOne('SELECT COUNT(id) FROM user');
			$db->query('UPDATE global_data SET value=? WHERE name=?', array($nb_nodians, 'nb_nodians'));

			header('Location: /new/profile');
		}
		else
		{
			$_SESSION['error']['msg'] = _('The code in not the same than image');
	                header('Location: /new');
		}
	}
	else
	{
		$_SESSION['error']['msg'] = _('The password and his confirmation are different');
		header('Location: /new');
	}
}
elseif(isset($_POST['refuse']))
{
	session_destroy();
	$db->query('UPDATE invitation_email SET status=?, response=?, failure_notice=? WHERE id=?', array('stop', 'rejected', stripslashes($_POST['refuse_motif']), $_SESSION['my_id']));
	header('Location: /pub');
}
elseif(isset($_POST['blacklist']))
{
	session_destroy();
	$db->query('UPDATE invitation_email SET status=?, response=?, failure_notice=? WHERE id=?', array('stop', 'blacklist', stripslashes($_POST['bl_motif']), $_SESSION['my_id']));
	header('Location: /pub');
}
else
{               
	$_SESSION['error']['msg'] = _('Invalid login (less than 3 characters or login already exist)');
	header('Location: /new');
}

?>
