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

	$topic['info'] = $db->getRow('SELECT id_comm,  id , title FROM community_topic WHERE id_topic=?', array($token[2]));

	$community['info'] = $db->getRow('SELECT  id_comm, id, community.name as name, community.description as description, moderated, country, date, nb_members, community_cat.name as category FROM community LEFT JOIN community_cat USING(id_cat) WHERE id_comm=?', array($topic['info']['id_comm']));
	$community['logo'] = build_logo_url($community['info']['id'], $topic['info']['id_comm']);

	$posts_r = $db->query('SELECT id_post, id, author, title, message, date FROM community_post WHERE id_topic=?', $token[2]);
	while($post = $posts_r->fetchRow())
	{
		$topic['posts'][$post['id_post']] = $post;
		$topic['posts'][$post['id_post']]['author_photo'] = build_thumb_url($post['id']);
	}

	$_SMARTY['community'] = $community;
	$_SMARTY['topic'] =  $topic;
}
?>
