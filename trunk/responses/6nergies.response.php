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

error_log($_SERVER['REMOTE_ADDR']);
$id = md5($_POST['email']);

if($db->getOne('SELECT COUNT(id) FROM user WHERE id=?', array($id)) == 0)
{
	$id_6nergies = '46dfafc70eb46e3bdd5a15279e2b5bcd';
	$data = array (
		'id' => $id,
		'id_invit' => $id_6nergies,
		'lname' => $_POST['lname'],
		'fname' => $_POST['fname'],
		'email' => $_POST['email'],
		'lang' => 'fr_FR',
		'type' => '6nergies',
		'status' => 'doing',
		'date_begin' => time(),
		'ip' => $_SERVER['REMOTE_ADDR']
	);
	$db->autoExecute('invitation_email', $data);



	$invitation = $db->getRow('SELECT id, id_invit, lname, fname, email, date_begin FROM invitation_email WHERE id=? AND status=?', array($id, 'doing'));
	if(isset($invitation['id']))
	{
		session_destroy();

		session_set_save_handler ('_sess_open', '_sess_close', '_sess_read', '_sess_write', '_sess_destroy', '_sess_gc');
		session_start();

		$_SESSION['my_id'] = $invitation['id'];
		$_SESSION['my_id_invit'] = $invitation['id_invit'];
		$_SESSION['invitation_date'] = $invitation['date_begin'];
		
		$_SESSION['my_fname'] = stripslashes($_POST['fname']);
		$_SESSION['my_lname'] = stripslashes($_POST['lname']);
		$_SESSION['my_email'] = $_POST['email'];
		$_SESSION['status'] = 'guest';
		$_SESSION['my_ip'] = $_SERVER['REMOTE_ADDR'];
		srand(time());
		$SecID = md5(rand(1,10000000));
		setcookie('SecID', $SecID, time()+31536000, '/');
		$_SESSION['SecID'] = $SecID;
		$_SESSION['6nergies_url'] = $_POST['6nergies_url'];
		list($_SESSION['6nergies_login']) = split('@', $_POST['login']);
	 
		error_log(print_r($invitation, true));
	 
		header('Location: /new');
	}
	else
		header('Location: /error/bad_link');
}
else
	header('Location: /error/bad_link');

?>
