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

if(is_numeric($token[2]) && ($token[3]=='true' || $token[3]=='false'))
{
	$topic = $db->getRow('SELECT id_topic, id_comm FROM community_topic WHERE id_topic=?', array($token[2]));
	$id_owner = $db->getOne('SELECT id FROM community WHERE id_comm=?', array($topic['id_comm']));
	if($id_owner == $_SESSION['my_id'])
		$db->query('UPDATE community_topic SET sticky=? WHERE id_topic=? AND id_comm=?', array($token[3], $topic['id_topic'], $topic['id_comm']));
}

header('Location:/communities/viewTopic/'.$topic['id_topic']);
exit();
?>
