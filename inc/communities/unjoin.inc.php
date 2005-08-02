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

if(is_numeric($token[2]) )
{
	$id = $db->getOne('SELECT id FROM community WHERE id_comm=?', $token[2]);
	if($id != $_SESSION['my_id'])
	{
		$db->query('DELETE FROM user_comm WHERE id=? AND id_comm=? LIMIT 1', array($_SESSION['my_id'], $token[2]) );
		$nb_members = $db->getOne('SELECT COUNT(id) FROM user_comm WHERE id_comm=?', $token[2]);
		$db->query("UPDATE community SET nb_members=? WHERE id_comm=?", array($nb_members, $token[2]));
		$my_communities = $db->getCol('SELECT id_comm FROM user_comm WHERE id=?', 0, $_SESSION['my_id']);
		$db->query('UPDATE cache_user SET nb_communities=?, communities_id=? WHERE id=?', array(count($my_communities), implode(',', $my_communities), $_SESSION['my_id']) );
		$_SESSION['my_communities_id'] = $my_communities;
	}
        header('Location:/communities/view/'.$token[2]);
}
else
        header('Location:/communities/');
?>
