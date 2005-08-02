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
	$community['info'] = $db->getRow('SELECT  id, community.name as name, community.description as description, moderated, country, date, nb_members, community_cat.name as category FROM community LEFT JOIN community_cat USING(id_cat) WHERE id_comm=?', array($token[2]));
	$community['logo'] = build_logo_url($community['info']['id'], $token[2]);

	/************* menu *******************/

	$leftmenu["/communities/view/".$token[2]] = 'Return to community';
	$leftmenu["/communities/forum/".$token[2]] = 'View forum';
	$leftmenu["/communities/events/".$token[2]] = 'View events';

	$smarty->assign('leftmenu',$leftmenu);


	/************************************/



	$smarty->assign('Title',  $community['info']['name']);
	$smarty->assign('community', $community);
}
else
{
	header('Location: /communities');
	exit();
}
?>
