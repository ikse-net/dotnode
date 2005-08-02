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

if(is_numeric($token[2]))
{
	$topic = $db->getRow('SELECT id_topic, id_comm FROM community_post WHERE id_post=?', array($token[2]));
	error_log(print_r($topic, true));
	$id_first_post = $db->getOne('SELECT id_post FROM community_post WHERE id_topic=?', $topic['id_topic']);
	error_log(print_r($id_first_post, true));
	$id_owner = $db->getOne('SELECT id FROM community WHERE id_comm=?', array($topic['id_comm']));
	error_log(print_r($id_owner, true));
	if($id_owner == $_SESSION['my_id'])
		$db->query('DELETE FROM community_post WHERE id_post=? AND id_comm=? AND id_post<>? AND id <> ?', array($token[2], $topic['id_comm'], $id_first_post, MODERATOR_ID));
	else
		$db->query('DELETE FROM community_post WHERE id_post=? AND id=? AND id_post<>?', array($token[2], $_SESSION['my_id'], $id_first_post));

	if($db->affectedRows() == 1)
		$db->query('UPDATE community_topic SET nb_posts=nb_posts-1 WHERE id_topic=?', $topic['id_topic']);

}

header('Location:/communities/viewTopic/'.$topic['id_topic']);
exit();
?>
