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

$_SMARTY['Title'] =  'My communities';

$my_communities_r = $db->query('SELECT name, community.id_comm as id_comm, description, nb_members, last_post_date, community.id as id FROM community LEFT JOIN user_comm USING (id_comm) WHERE user_comm.id=? AND user_comm.status=? ORDER BY last_post_date DESC', array($_SESSION['my_id'], 'ok') );

if(DB::isError($my_communities_r))
	error_log($my_communities_r->getUserInfo());

while($my_community = $my_communities_r->fetchRow())
{
	$day = date('Ymd', $my_community['last_post_date']);
	$key = $my_community['id_comm'];
	if($day != $last_day)
	{
		$my_community['day'] = $day;
		$last_day = $day;
		if($last_comm_day_key) $my_communities[$last_comm_day_key]['next_day'] = $day;
		$last_comm_day_key = $key;
	}

	$my_communities[$key] = $my_community;
}

$_SMARTY['my_communities'] =  $my_communities;

?>
