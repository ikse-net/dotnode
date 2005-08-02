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

if(is_numeric($token[3]) )
{
	$id_comm = $db->getOne('SELECT id_comm FROM community_topic WHERE id_topic=?', $token[3]);

	$is_member = $db->getOne('SELECT count(id) as nb FROM user_comm WHERE id=? AND status=? AND id_comm=?', array($_SESSION['my_id'], 'ok', $id_comm));
        if($is_member != 1)
        {
		$_SESSION['error']['title'] = tr('Your are not a member of this community');
                $_SESSION['error']['msg'] = tr('You must subscribe to this community before trying to send topic');
                header('Location: /communities/communities/view/'.$id_comm);
                exit();
        }


	$date = time();
	if($_POST['title'] != "")
		$title = stripslashes($_POST['title']);
	else
		$title = NULL;

	$message = stripslashes($_POST['message']);

	if(strlen($_POST['message']) < 1)
	{
		$_SESSION['error']['title'] = tr('Your reply is not correct');
                $_SESSION['error']['msg'] = tr('You must fill the "Message" field.');
                $_SESSION['error']['post'] = array_map('stripslashes', $_POST);
                header('Location: /communities/replyTopic/'.$token[3]);
                exit();
	}

        $db->query('UPDATE community_topic SET nb_posts=nb_posts+1, last_post_date=? WHERE id_topic=?', array($date, $token[3]));

	$post_values = array(
		'id'      => $_SESSION['my_id'],
		'id_topic'=> $token[3],
		'id_comm' => $id_comm,
		'author'  => $_SESSION['my_fname'],
		'title'   => $title,
		'message' => $message,
		'date'    => $date);
	$db->autoExecute('community_post', $post_values, DB_AUTOQUERY_INSERT);

	$db->query('UPDATE community SET last_post_date=? WHERE id_comm=?', array($date, $id_comm));
}

header('Location: /communities/viewTopic/'.$token[3]);
?>
