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
	$is_membre = $db->getOne('SELECT count(id) as nb FROM user_comm WHERE id=? AND status=? AND id_comm=?', array($_SESSION['my_id'], 'ok', $token[3]));
	if($is_membre != 1)
	{
		header('Location: /error/not_in_community');
                exit();
	}

	$date = time();
	$title = stripslashes($_POST['title']);
	$message = stripslashes($_POST['message']);

	if(strlen(trim($_POST['title'])) < 1 || strlen(trim($_POST['message'])) < 1)
	{
		header('Location: /error/incorrect_topic');
		exit();
	}


	$topic_values = array(
                'id' => $_SESSION['my_id'],
                'id_comm' => $token[3],
                'author'  => $_SESSION['my_fname'],
                'title'   => $title,
                'nb_posts'=> 1,
                'date' => $date,
                'last_post_date' => $date);
        $db->autoExecute('community_topic', $topic_values, DB_AUTOQUERY_INSERT);

	$id_topic = $db->getOne('SELECT LAST_INSERT_ID()');

	$post_values = array(
		'id'      => $_SESSION['my_id'],
		'id_topic'=> $id_topic,
		'id_comm' => $token[3],
		'author'  => $_SESSION['my_fname'],
		'title'   => $title,
		'message' => $message,
		'date'    => $date);
	$db->autoExecute('community_post', $post_values, DB_AUTOQUERY_INSERT);

	$db->query('UPDATE community SET last_post_date=? WHERE id_comm=?', array($date, $token[3]));

}

header('Location: /communities/view/'.$token[3]);
?>
