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
	$smarty->assign('Title', 'Community members');

	$community['info'] = $db->getRow('SELECT  id_comm, id, community.name as name, community.description as description, moderated, country, date, nb_members, community_cat.name as category FROM community LEFT JOIN community_cat USING(id_cat) WHERE id_comm=?', array($token[2]));

	$community['logo'] = build_logo_url($community['info']['id'], $token[2]);

	$members = $db->getCol('SELECT id FROM user_comm WHERE id_comm=? AND status=?', 0, array($community['info']['id_comm'], 'ok'));

	foreach($members as $member)
		$community['member'][$member] = get_cache_user_info($member);


        /************* menu *******************/

        $leftmenu["/communities/view/".$community['info']['id_comm']] = 'Return to community';

        if($_SESSION['my_id'] != $community['info']['id'])
                if($_SESSION['my_communities_id'] && in_array($community['info']['id_comm'], $_SESSION['my_communities_id']) )
                        $leftmenu["/communities/unjoin/".$token[2]] = 'Unjoin';
                else
                        $leftmenu["/communities/join/".$token[2]] = 'Join';
        else
                $leftmenu["/communities/edit/".$token[2]] = 'Edit';


        $leftmenu["/communities/events/".$token[2]] = 'View events';
        $leftmenu["/communities/invite/".$token[2]] = 'Invite friends';

        $smarty->assign('leftmenu',$leftmenu);


        /************************************/

	$smarty->assign('community', $community);

}
else
{
	header('Location: /communities');
	exit();
}
?>
