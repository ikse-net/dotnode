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
	$comm =& $db->getRow('SELECT id, id_comm, name, moderated FROM community WHERE id_comm=?', array($token[3]) );
	if($comm['moderated'] == 'yes')
	{
		$db->query('INSERT INTO user_comm SET id=?, id_comm=?, status=?', array($_SESSION['my_id'], $comm['id_comm'], 'waiting') );
		active_message(
			'community_moderation_waiting', 
			$comm['name'].' community', 
			$comm['id'], 
			'Someone want to join "'.$comm['name'].'" community', 
			'Go to : http://'.$config['domain'].'/communities/view/'.$comm['id_comm'].' to accept or refuse' );
	}
	else
	{
		$db->query('INSERT INTO user_comm SET id=?, id_comm=?, status=?', array($_SESSION['my_id'], $comm['id_comm'], 'ok') );
		$nb_members = $db->getOne('SELECT COUNT(id) FROM user_comm WHERE id_comm=? AND status=?', array($comm['id_comm'], 'ok'));
		$db->query('UPDATE community SET nb_members=? WHERE id_comm=?', array($nb_members, $comm['id_comm']));
		$my_communities = $db->getCol('SELECT id_comm FROM user_comm WHERE id=? AND status=?', 0,array($_SESSION['my_id'], 'ok'));
		$db->query('UPDATE cache_user SET nb_communities=?, communities_id=? WHERE id=?', array(count($my_communities), implode(',', $my_communities), $_SESSION['my_id']) );
		$_SESSION['my_communities_id'] = $my_communities;
	}

	header('Location:/communities/view/'.$comm['id_comm']);
}
else
	header('Location:/communities/');

?>
