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

include_once(INCLUDESPATH.'/pager.inc.php');

$_SMARTY['Title'] =  'Friends';

$user['info'] = get_cache_user_info($url_id);
$user['photo'] = build_image_url($url_id);

$pager =& Pager_dotnode::factory(null, array('totalItems' => $user['info']['nb_friends'], 'perPage' => 15));

list($first_item, $last_item) = $pager->getOffsetByPageId();
$limit_offset = $first_item-1;
$limit_length = $last_item-$limit_start;

$friends_range = array_slice($user['info']['friends_id'], $limit_offset, $limit_length);
foreach($friends_range as $dummy=>$friend_id)
        $friends[$friend_id] = get_cache_user_info($friend_id);

/********** determination du chemin *****************/
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
}
elseif($intermediaire = array_intersect($_SESSION['my_friends_id'], $user['info']['friends_id']))
{
	sort($intermediaire);
        $user['relation_type'] = 'friends_of_friends';
        $user['path'][$_SESSION['my_id']] = $_SESSION['my_fname'];
        $user['path'][$intermediaire[0]] = $friends[$intermediaire[0]]['fname'];
        $user['path'][$url_id] = $user['info']['fname'];
}
else
        $user['relation_type'] = 'members';

/************** menu ***************************/
$leftmenu["/profile/$url_id"] = 'Profile';

if($user['info']['nb_photos'] > 0)
        $leftmenu["/album/$url_id"] = 'Album';

if($user['info']['nb_blogs'] > 0)
        $leftmenu["/blog/$url_id"] = 'Blog';

if($user['info']['nb_bookmarks'] > 0)
        $leftmenu["/bookmarks/$url_id"] = 'Bookmarks';

$_SMARTY['leftmenu'] = $leftmenu;
/************************************************/

$_SMARTY['tr_attr'] = array("class='odd' style='vertical-align:top'", "class='even' style='vertical-align:top'");
$_SMARTY['user'] =  $user;
$_SMARTY['pager'] = $pager->getLinks();
$_SMARTY['friends'] =  $friends;
?>
