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


error_log($_POST['type']);
error_log($_POST['param']);

switch($_POST['type'])
{
case 'email':
	if(valid_email($_POST['param']))
		$where = 'user_contact.email=?';
	else
	{
		header('Location: /error/bad_form');
		exit();
	}
	break;
case 'login':
	if(login_exist($_POST['param']))
                $where = 'user.login=?';
	else
	{
		header('Location: /error/unknown_user');
		exit();
	}
	break;

default:
	header('Location: /error/bad_form');
}

$user =& $db->getRow('SELECT user.id as id, user.login as login, user_contact.email as email FROM user LEFT JOIN user_contact USING (id) WHERE '.$where.' LIMIT 1', array($_POST['param']));

$db->query('DELETE FROM todo WHERE robot=? AND id=?', array('send_password', $user['id']));

$todo_values= array(
	'robot' => 'send_password',
	'param' => 'email='.$user['email'],
	'id' => $user['id'],
	'ip' => $_SERVER['REMOTE_ADDR'],
	'lang' => $lang,
	'date' => time());

$db->autoExecute('todo', $todo_values);

header('Location: /error/forgot_password/success');


?>
