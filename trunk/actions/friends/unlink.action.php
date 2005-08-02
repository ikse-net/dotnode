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

$user = $db->getRow('SELECT id, id_parent FROM user WHERE id=?', array($url_id));
if($user['id_parent'] != $_SESSION['my_id'] && in_array($user['id'], $_SESSION['my_friends_id']) )
{
	$db->query('DELETE FROM relation WHERE id=? AND id_friend=?', array($url_id, $_SESSION['my_id']));
	$db->query('DELETE FROM relation WHERE id_friend=? AND id=?', array($url_id, $_SESSION['my_id']));
	$my_friends_id = $db->getCol('SELECT id FROM relation WHERE id_friend=? ORDER BY last_visit DESC', 0, $_SESSION['my_id']);
	$friend_friends_id = $db->getCol('SELECT id FROM relation WHERE id_friend=? ORDER BY last_visit DESC', 0, $user['id']);

	$_SESSION['my_friends_id'] = $my_friends_id;

	$db->query('UPDATE cache_user SET friends_id=?, nb_friends=? WHERE id=?', array(implode(',',$friend_friends_id), count($friend_friends_id), $user['id']));
	$db->query('UPDATE cache_user SET friends_id=?, nb_friends=? WHERE id=?', array(implode(',',$my_friends_id), count($my_friends_id), $_SESSION['my_id']));
}
header('Location: /profile/'.$url_id);
?>
