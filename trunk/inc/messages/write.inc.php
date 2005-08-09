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

if(strlen($token[2]) == 32)
{
	$to = $db->getRow('SELECT id,fname,lname FROM user WHERE id=?', array($token[2]));

	if(is_numeric($token[3]))
	{
		$message = $db->getRow('SELECT id_mess, id_from, from_str, type, dest, subject, message, flag, date FROM message WHERE id=? AND id_mess=?', array($_SESSION['my_id'],$token[3]));
		$_SMARTY['message'] =  $message;
	}

	$_SMARTY['to'] =  $to;
}
else
{
	foreach($_SESSION['my_friends_id'] as $str)
		$friends_list[] = "'".$str."'";

	$friends_r = $db->query('SELECT id, lname, fname FROM user WHERE id IN (!)', implode(',', $friends_list));
	while($friend = $friends_r->fetchRow())
		$friends[$friend['id']] = $friend['fname'].' '.$friend['lname'];
	$_SMARTY['friends'] = $friends;
}
?>
