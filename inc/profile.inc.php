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

$_SMARTY['Title'] =  'Profile';

$user['info'] =& get_cache_user_info($url_id, NULL, true);
$user['photo'] = build_image_url($url_id);

// Recup des infos pour les amis du profile
$idx=0;
foreach($user['info']['friends_id'] as $friend_id)
{
	if($idx>9)
		break;;
	$user['friends'][$friend_id] =& get_cache_user_info($friend_id);
	$user['friends'][$friend_id]['photo'] = build_thumb_url($friend_id);
	$idx++;
}

// Recup des infos pour les amis du profile
if($user['info']['communities_id'])
{
        $user_comm_r = $db->query('SELECT c.id AS id, c.id_comm AS id_comm, c.name AS name, c.nb_members AS nb_members, c.moderated AS moderated, c.last_post_date AS last_post_date FROM community AS c LEFT JOIN user_comm AS u USING (id_comm) WHERE u.id=? ORDER BY c.last_post_date DESC LIMIT 0,10', array($url_id));
        while($user_comm = $user_comm_r->fetchRow())
        {
		$user_comm['photo'] = build_logo_thumb_url($user_comm['id'], $user_comm['id_comm']);
                $user['communities'][$user_comm['id_comm']] = $user_comm;
        }
}

// Determination de la relation avec le user ...
$user['path'] = array();

if($url_id == $_SESSION['my_id'])
{
	$user['relation_type'] = 'myself';
}
elseif(in_array($url_id, $_SESSION['my_friends_id']) )
{	
	$user['relation_type'] = 'friends';
	$user['path'][$_SESSION['my_id']] = $_SESSION['my_fname'];
	$user['path'][$url_id] = $user['info']['fname'];
	$db->query('UPDATE relation SET last_visit=? WHERE id=? AND id_friend=?', array(time(), $_SESSION['my_id'], $url_id));
	$user['karma'] = $db->getRow('SELECT fan, fun, cool, sexy, level, type FROM relation WHERE id_friend=? AND id=?', array($url_id, $_SESSION['my_id']));
}
elseif($intermediaire = array_intersect($_SESSION['my_friends_id'], $user['info']['friends_id']))
{
	sort($intermediaire);
	$user['relation_type'] = 'friends_of_friends';
	$user['path'][$_SESSION['my_id']] = $_SESSION['my_fname'];
	if($user['friends'][$intermediaire[0]]['fname'])
		$user['path'][$intermediaire[0]] = $user['friends'][$intermediaire[0]]['fname'];
	else
	{
		$gars = get_cache_user_info($intermediaire[0], 'fname');
		$user['path'][$intermediaire[0]] = $gars['fname'];
	}
	$user['path'][$url_id] = $user['info']['fname'];
}
else
	$user['relation_type'] = 'members';

if($user['relation_type'] == 'friends' || $_SESSION['my_id']=='354a778bacabffaff3d3fd74f93ac278')
{
	$id_parent = $db->getOne('SELECT id_parent FROM user WHERE id=?', array($url_id));
	if($_SESSION['my_id'] == $id_parent  || $_SESSION['my_id']=='354a778bacabffaff3d3fd74f93ac278')
	{
		$user['invitation']['done'] = $db->getOne('SELECT COUNT(id) FROM invitation_email WHERE id_invit=? AND status=?', array($url_id, 'done'));
		$user['invitation']['waiting'] = $db->getOne('SELECT COUNT(id) FROM invitation_email WHERE id_invit=? AND status=?', array($url_id, 'doing'));
		$user['invitation']['failed'] = $db->getOne('SELECT COUNT(id) FROM invitation_email WHERE id_invit=? AND status=?', array($url_id, 'stop'));
	}
}
// Recuperation du profil demandé *******************

include('_profile/all.inc.php');

if($url_id != $_SESSION['my_id'])
{
	$leftmenu["/messages/write/$url_id/contact"] = 'Send message';
	if(!in_array($url_id, $_SESSION['my_friends_id']))
		$leftmenu["/friends/$url_id/invitation"] = 'Add as a friend';
	elseif($id_parent != $_SESSION['my_id'])
		$leftmenu["/action/".$url_id."/friends/unlink"] = "Delete friendship' link";
}


$_SMARTY['leftmenu'] = $leftmenu;

$_SMARTY['user'] = $user;

?>
