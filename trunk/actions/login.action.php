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


if( $_POST['login'] && $_POST['passwd'])
{
	$values = array( $_POST['login'], $_POST['passwd'] );

	$user =& $db->getRow('SELECT id, login, fname, lname, nick, status FROM user WHERE login=? AND passwd=PASSWORD(?)', $values);
	if( $user )
	{
		session_destroy();
		session_set_save_handler ('_sess_open', '_sess_close', '_sess_read', '_sess_write', '_sess_destroy', '_sess_gc');
		session_start();

		$_SESSION['my_ip'] = $_SERVER['REMOTE_ADDR'];
		srand(time());
		$SecID = md5(rand(1,10000000));
		setcookie('SecID', $SecID, time()+31536000, '/');
		$_SESSION['SecID'] = $SecID;
		$_SESSION['status'] = 'member';
		$_SESSION['my_id'] = $user['id'];
		$_SESSION['my_login'] = $user['login'];
		$_SESSION['my_fname'] = $user['fname'];
		$_SESSION['my_lname'] = $user['lname'];
		$_SESSION['my_nick'] = $user['nick'];
		if($user['status']=='jail')
		{
			session_unset();
			session_destroy();
			header('Location: /pub/join');
			exit();
		}
		$_SESSION['my_status'] = $user['status'];
		$_SESSION['my_photo'] = build_image_url($user['id']);

		$cache_user = get_cache_user_info($user['id'], 'country, friends_id, communities_id');
		$_SESSION['my_country'] = $cache_user['country'];
		$_SESSION['my_friends_id'] = $cache_user['friends_id'];
		$_SESSION['my_communities_id'] = $cache_user['communities_id'];

		$_SESSION['nb_new_messages'] = $db->getOne('SELECT COUNT(id_mess) FROM message WHERE id=? AND flag=? AND box=?', array($_SESSION['my_id'], 'new', 'inbox'));
		$_SESSION['nb_new_messages_timestamp'] = time();

		$_SESSION['lastaction_timestamp'] = 1;

		$db->query('UPDATE user SET last_visite=?, ip=? WHERE id=?', array(time(), $_SERVER['REMOTE_ADDR'], $_SESSION['my_id'] )) ;

		if($_POST['url'])
			header('Location: '.urldecode($_POST['url']));
		else
			header('Location: /my');
	}
	else
		header('Location: /error/wrong_login'); // Wrong login / pass
}
else
	header('Location: /error/no_login'); // no login/pass

?>
