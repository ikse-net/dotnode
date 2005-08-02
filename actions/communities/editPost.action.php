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

if(is_numeric($token[3]) && is_numeric($token[4]) )
{
	$date = time();
	if($_POST['title'] != "")
		$title = stripslashes($_POST['title']);
	else
		$title = NULL;

	$message = stripslashes($_POST['message']);
	$message.= "\n".'[Modified on '.date("d.m.Y G:i").']';

	if(strlen($_POST['message']) < 1)
	{
		$_SESSION['error']['title'] = tr('Your modification is not correct');
		$_SESSION['error']['msg'] = tr('You must fill the "Message" field.');
		$_SESSION['error']['post'] = array_map('stripslashes', $_POST);
		header('Location: /communities/editPost/'.$token[4]);
		exit();
	}

        $db->query('UPDATE community_post SET title=?, message=? WHERE id_post=? AND id=?', array($title, $message, $token[4], $_SESSION['my_id']));
}

header('Location: /communities/viewTopic/'.$token[3]);
?>
