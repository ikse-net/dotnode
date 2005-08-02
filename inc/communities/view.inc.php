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
	$smarty->assign('Title', 'Community');

	$community['info'] = $db->getRow('SELECT id_comm, id, community_cat.id_cat as id_cat, community.name as name, community.description as description, moderated, country, date, nb_members, community_cat.name as category FROM community LEFT JOIN community_cat USING(id_cat) WHERE id_comm=?', array($token[2]));

	$community['info']['moderated_t'] = _($labels['yesno'][$community['info']['moderated']]);

	$community['logo'] = build_logo_url($community['info']['id'], $token[2]);
	$members_r = $db->query('SELECT cache_user.id as id, fname, lname, nick, nb_friends, gender, country, nb_fans, nb_bookmarks, nb_photos, nb_blogs FROM cache_user LEFT JOIN user_comm USING (id) WHERE id_comm=? AND status=? ORDER BY last_visit DESC LIMIT 10', array($community['info']['id_comm'], 'ok')); 

	while($member = $members_r->fetchRow())
	{
		$community['members'][$member['id']] = $member;
		$community['members'][$member['id']]['thumb_path'] = build_thumb_url($member['id']);
	}

	if($community['info']['id'] == $_SESSION['my_id'])
	{
		$moderation_r = $db->query('SELECT cache_user.id as id, fname, lname, nb_friends FROM cache_user LEFT JOIN user_comm USING (id) WHERE id_comm=? AND status=?', array($community['info']['id_comm'], 'waiting'));
		while($moderation = $moderation_r->fetchRow())
		{
			$community['moderations'][$moderation['id']] = $moderation;
			$community['moderations'][$moderation['id']]['photo'] = build_thumb_url($moderation['id']);
		}
	}

	if($community['members'][$community['info']['id']]['id'] == $community['info']['id'])
		$community['owner'] = $community['members'][$community['info']['id']];
	else
		$community['owner'] = get_cache_user_info($community['info']['id'], 'id, fname, lname');


	$sticky_r = $db->query('SELECT id_topic, title, id, author, nb_posts, last_post_date FROM community_topic WHERE id_comm=? AND sticky=? ORDER BY date DESC', array($token[2], 'true'));
	while($sticky_topic = $sticky_r->fetchRow())
		$community['sticky_topics'][$sticky_topic['id_topic']] = $sticky_topic;


	$topic_r = $db->query('SELECT id_topic, title, id, author, nb_posts, last_post_date FROM community_topic WHERE id_comm=? AND sticky=? ORDER BY date DESC LIMIT 5', array($token[2], 'false') );
        while($topic = $topic_r->fetchRow())
                $community['topics'][$topic['id_topic']] = $topic;

        $event_r = $db->query('SELECT id_event, title, date_event, city, country FROM community_event WHERE id_comm=? AND date_event>? ORDER BY date_event LIMIT 5', array($token[2], time()));
        while($event = $event_r->fetchRow())
		$community['events'][$event['id_event']] = $event;


	/*********************************************/
	/******* compute related communities *********/

	$all_communities_id = $db->getCol('SELECT communities_id FROM cache_user AS u LEFT JOIN user_comm AS c USING (id) WHERE c.id_comm=? AND c.status=?', 0, array($token[2], 'ok'));

	foreach($all_communities_id as $communities_id)
	{
		$array_comm = split(',', $communities_id);
		foreach($array_comm as $array_comm_id)
		{
			$related_comm_temp[$array_comm_id]++;
		}
	}
	arsort($related_comm_temp);

	foreach($related_comm_temp as $key=>$level)
	{
		if($key == $token[2])
			continue;

		if($idx > 10 || $level < 3)
			break;
		else
		{
			$rel_comm_info = $db->getRow('SELECT id, id_comm, name, nb_members, moderated, last_post_date FROM community WHERE id_comm=?', array($key));
			$rel_comm_info['logo'] = build_logo_thumb_url($rel_comm_info['id'], $key);
			$rel_comm_info['score'] = $level * 100 / $community['info']['nb_members'];
			$related_comm[$key] = $rel_comm_info;
		}
		$idx++;
	}


	/**************************************/
	/************* menu *******************/

	if($_SESSION['my_id'] != $community['info']['id'])
		if($_SESSION['my_communities_id'] && in_array($community['info']['id_comm'], $_SESSION['my_communities_id']) )
		{
			$smarty->assign('is_member', 1);
			$leftmenu['/communities/unjoin/'.$token[2]] = 'Unjoin';
		}
		else
		{
			$smarty->assign('is_member', 0);
			if($community['info']['moderated'] == 'yes')
				$leftmenu['/communities/join/'.$token[2].'/moderated'] = 'Join';
			else
				$leftmenu['/communities/join/'.$token[2]] = 'Join';
		}
	else
		$leftmenu["/communities/edit/".$token[2]] = 'Edit';	


	$leftmenu['/communities/forum/'.$token[2]] = 'View forum';
	$leftmenu['/communities/events/'.$token[2]] = 'View events';
	$leftmenu['/communities/invite/'.$token[2]] = 'Invite friends';

	$smarty->assign('leftmenu',$leftmenu);


	/************************************/

	$smarty->assign('related_communities', $related_comm);
	$smarty->assign('community', $community);
}
else
{
	header('Location: /communities');
	exit();
}
?>
