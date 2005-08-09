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

$_SMARTY['Title'] =  'Communities';

$last_comm_r = $db->query('SELECT community.id as id, community.id_comm as id_comm, community.name as name, community.description as description, community.nb_members, community_cat.name as cat_name, community.date as date FROM community LEFT JOIN community_cat USING (id_cat) WHERE community.date > ? ORDER BY community.date DESC', array(time()-604800));

while($last_comm = $last_comm_r->fetchRow())
{
        $last_communities[$last_comm['id_comm']] = $last_comm;
	$last_communities[$last_comm['id_comm']]['logo'] = build_logo_thumb_url($last_comm['id'], $last_comm['id_comm']);

	$day = date('Ymd', $last_comm['date']);	

	if($day != $last_day)
	{
		$last_communities[$last_comm['id_comm']]['day'] = $day;
		$last_day=$day;
		if($last_comm_day) $last_communities[$last_comm_day]['next_day']=$day;
		$last_comm_day = $last_comm['id_comm'];
	}
}


$_SMARTY['last_communities'] =  $last_communities;
?>
