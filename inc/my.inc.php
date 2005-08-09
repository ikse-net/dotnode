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

/*
header('content-type: text/plain');
print_r($menu);
print_r($smenu);
print_r($ssmenu);
exit();
*/
$_SMARTY['Title'] =  'Home';

$idx = 0;

$nyrk['total'] = $db->getOne('SELECT value FROM global_data WHERE name=?', array('nb_nodians'));
$nyrk['actually'] = $db->getOne('SELECT value FROM global_data WHERE name=?', array('actually'));

$my['info'] = get_cache_user_info($_SESSION['my_id']);
$my['info']['nb_unread_messages'] = $db->getOne('SELECT COUNT(id) FROM message WHERE id=? AND flag=? AND box=?', array($_SESSION['my_id'], 'new', 'inbox'));


if($_SESSION['nb_foaf_timestamp'] < time() - 86400)
{
	$foaf_id = $db->getCol('SELECT DISTINCT ( id_friend ) FROM relation WHERE id IN (\'!\') GROUP BY id_friend', 0, array(implode("','", $my['info']['friends_id'])));

	foreach($foaf_id as $ids)
                $foaf[$ids]=1;

	foreach($_SESSION['my_friends_id'] as $ids)
                $foaf[$ids]=1;
	
	$my['info']['nb_friends_of_friends'] = count($foaf)-1;

	$_SESSION['nb_foaf'] = $my['info']['nb_friends_of_friends'];
	$_SESSION['nb_foaf_timestamp']=time();
}
else
	$my['info']['nb_friends_of_friends'] = $_SESSION['nb_foaf'];

error_log($config['domain'].' | '.$_SESSION['my_login'].' | network size ==> '.$_SESSION['nb_foaf']);

$idx=0;
foreach($my['info']['friends_id'] as $friend_id)
{
	if($idx>9)
		break;
        $my['friends'][$friend_id] =& get_cache_user_info($friend_id);
        $my['friends'][$friend_id]['photo'] = build_thumb_url($friend_id);
	$idx++;
}

// Recup des infos pour les amis du profile
if($my['info']['communities_id'])
{
	$my_comm_r = $db->query('SELECT c.id AS id, c.id_comm AS id_comm, c.name AS name, c.nb_members AS nb_members, c.moderated AS moderated, c.last_post_date AS last_post_date FROM community AS c LEFT JOIN user_comm AS u USING (id_comm) WHERE u.id=? ORDER BY c.last_post_date DESC LIMIT 0,10', array($_SESSION['my_id']));
	while($my_comm = $my_comm_r->fetchRow())
	{
		$my['communities'][$my_comm['id_comm']] = $my_comm;
		$my['communities'][$my_comm['id_comm']]['photo'] = build_logo_thumb_url($my_comm['id'], $my_comm['id_comm']);
	}
}

/************* menu *******************/
$leftmenu["/profile/$url_id"] = 'View my own profile';

if($my['info']['nb_photos'] > 0)
        $leftmenu["/album/$url_id"] = 'Album';

if($my['info']['nb_blogs'] > 0)
        $leftmenu["/blog/$url_id"] = 'Blog';

if($my['info']['nb_bookmarks'] > 0)
        $leftmenu["/bookmarks/$url_id"] = 'Bookmarks';

$_SMARTY['leftmenu'] = $leftmenu;


/************************************/

$_SMARTY['my'] = $my;

?>
