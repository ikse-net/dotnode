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
	$post['info'] = $db->getRow('SELECT id_post, id_comm, id_topic, id , title, message FROM community_post WHERE id=? AND id_post=?', array($_SESSION['my_id'], $token[2]));
	if(!$post['info'])
	{
		header('Location: /communities');
		exit();
	}
	else
	{
		$community['info'] = $db->getRow('SELECT id_comm, id, name, nb_members FROM community WHERE id_comm=?',array($post['info']['id_comm']));
		$community['logo'] = build_logo_url($community['info']['id'], $post['info']['id_comm']);

		/************* menu *******************/
		$leftmenu["/communities/view/".$community['info']['id_comm']] = 'Return to community';
		$leftmenu["/communities/forum/".$community['info']['id_comm']] = 'View forum';
		$leftmenu["/communities/events/".$community['info']['id_comm']] = 'View events';

		$_SMARTY['leftmenu'] = $leftmenu;
		/************************************/


		$_SMARTY['community'] = $community;
		$_SMARTY['post'] =  $post;
	}
}
else
{
	header('Location: /communities');
	exit();
}
?>
