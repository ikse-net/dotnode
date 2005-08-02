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

if(is_numeric($token[3]))
{
	$comm =& $db->getRow('SELECT id, id_comm, name FROM community WHERE id_comm=? AND id=?', array($token[3], $_SESSION['my_id']));
	if($comm)
	{
		foreach($_POST['moderation'] as $id=>$moderation)
		{
			$communities_id = $db->getOne('SELECT communities_id FROM cache_user WHERE id=?', array($id));
			if($communities_id)
				$new_communities_id = $communities_id.','.$comm['id_comm'];
			else
				$new_communities_id = $comm['id_comm'];

			error_log($comm['id_comm'].' | '.$id.' '.$moderation);

			switch($moderation)
			{
			case 'ok':
				$db->query('UPDATE user_comm SET status=? WHERE id=? AND id_comm=?', array('ok', $id, $comm['id_comm']));
				$db->query('UPDATE community SET nb_members=nb_members+1 WHERE id_comm=?', array($comm['id_comm']) );
				$db->query('UPDATE cache_user SET communities_id=?, nb_communities=nb_communities+1 WHERE id=?', array($new_communities_id, $id));
				active_message('community_moderation_accept', $comm['name'].' Community moderator', $id, 'You are accepted to join the moderated community: '.$comm['name'], 'Go to this community: http://'.$config['domain'].'/communities/view/'.$comm['id_comm']);
				break;

			case 'refuse':
				$db->query('DELETE FROM user_comm WHERE id=? AND id_comm=? AND status=?', array($id, $comm['id_comm'], 'waiting'));
				active_message('community_moderation_refuse',  $comm['name'].' Community moderator', $id, 'You have been refused to join the community '.$comm['name'], 'Contact moderator if you want more informations: http://'.$config['domain'].'/profile/'.$comm['id']);
				break;
			default:
			case 'waiting':
				break;

			}
		}
	}
}
header('Location: /communities/view/'.$token[3]);

?>
