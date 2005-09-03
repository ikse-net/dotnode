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

	$user =& $db->getRow('SELECT id_translator, login, status, lang, level FROM dntp_translator WHERE login=? AND (passwd_md5=? OR passwd=OLD_PASSWORD(?))', array( $_POST['login'], md5($_POST['passwd'], $_POST['passwd'])));
	
	if( $user['id'] )
	{
		if(!is_null($user['passwd']))
			$db->query('UPDATE dntp_translator SET passwd_md5=?, passwd=NULL WHERE id=?', array(md5($_POST['passwd']), $user['id']));
					
		@session_destroy();
	
		session_set_save_handler ('_sess_open', '_sess_close', '_sess_read', '_sess_write', '_sess_destroy', '_sess_gc');
		session_start();

		$_SESSION['my_ip'] = $_SERVER['REMOTE_ADDR'];
		srand(time());
		$SecID = md5(rand(1,10000000));
		setcookie('SecID', $SecID, time()+31536000, '/');
		$_SESSION['SecID'] = $SecID;
		$_SESSION['my_id'] = $user['id_translator'];
		$_SESSION['my_login'] = $user['login'];
		if($user['status'] == 'waiting')
		{
			session_unset();
			session_destroy();
			header('Location: /pub');
			exit();
		}
		$_SESSION['my_status'] = $user['status'];
		$_SESSION['my_level'] = $user['level'];
		$_SESSION['my_lang'] = $user['lang'];

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
