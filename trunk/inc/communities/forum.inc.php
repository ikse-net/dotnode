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
	$community['info'] = $db->getRow('SELECT  id_comm, id, community.name as name, community.description as description, moderated, country, date, nb_members, community_cat.name as category FROM community LEFT JOIN community_cat USING(id_cat) WHERE id_comm=?', array($token[2]));
	$community['logo'] = build_logo_url($community['info']['id'], $token[2]);


	$topic_r = $db->query('SELECT id_topic, title, id, author, nb_posts, last_post_date FROM community_topic WHERE id_comm=? ORDER BY date DESC LIMIT 100', $token[2]);
        while($topic = $topic_r->fetchRow())
                $community['topics'][$topic['id_topic']] = $topic;

	/************* menu *******************/

	$leftmenu["/communities/view/".$community['info']['id_comm']] = 'Return to community';

	if($_SESSION['my_id'] != $community['info']['id'])
		if(in_array($community['info']['id_comm'], $_SESSION['my_communities_id']) )
			$leftmenu["/communities/unjoin/".$token[2]] = 'Unjoin';
		else
			$leftmenu["/communities/join/".$token[2]] = 'Join';
	else
		$leftmenu["/communities/edit/".$token[2]] = 'Edit';	


	$leftmenu["/communities/events/".$token[2]] = 'View events';
	$leftmenu["/communities/invite/".$token[2]] = 'Invite friends';

	$smarty->assign('leftmenu',$leftmenu);


	/************************************/



	$smarty->assign('Title', 'Community');

	if($_SESSION['my_communities_id'])
	{
		if( in_array($community['info']['id_comm'], $_SESSION['my_communities_id']) )
		{
			$db->query('UPDATE user_comm SET last_visit=? WHERE id=? AND id_comm=?', array(time(), $_SESSION['my_id'], $community['info']['id_comm']));
			$smarty->assign('member', true);
		}
	}


	$smarty->assign('community', $community);
}
else
{
	header('Location: /communities');
	exit();
}
?>
