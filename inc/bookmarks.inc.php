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

include(INCLUDESPATH.'/bookmarks.inc.php');
$_SMARTY['Title'] = 'Bookmarks';

if($token[1]=='category' && is_numeric($token[2]))
	$is_category=true;
else
	$is_category=false;

if($is_category)
	$bookmarks = $db->query('SELECT link, comment, date, id_cat FROM bookmarks WHERE id=? and id_cat=?', array($url_id, $token[2]) );
else
	$bookmarks = $db->query('SELECT link, comment, date, id_cat FROM bookmarks WHERE id=?', array($url_id) );

if (DB::isError($bookmarks)) {
    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$bookmarks->getMessage());
}

$idx=0;
while($link = $bookmarks->fetchRow())
{
        $links[$idx] = $link;
	if(!$is_category)
		$links[$idx]['path'] = get_cat_path($link['id_cat']);
	$idx++;
}

if($is_category)
{
	$sub_cat_r = $db->query('SELECT id_cat, name FROM bookmarks_cat WHERE id=? AND id_cat_parent=?', array($url_id, $token[2]) );
	while($cat = $sub_cat_r->fetchRow())
		$sub_cat[$cat['id_cat']] = $cat['name'];
	
	$smarty->assign_by_ref('sub_cat',$sub_cat);

	$path = get_cat_path($token[2]);
        $_SMARTY['path'] = $path;
}
$user['info'] = get_cache_user_info($url_id);



/************* menu *******************/
$leftmenu["/profile/$url_id"] = 'Profile';

if($user['info']['nb_photos'] > 0)
        $leftmenu["/album/$url_id"] = 'Album';

if($user['info']['nb_blogs'] > 0)
        $leftmenu["/blog/$url_id"] = 'Blog';

if($user['info']['nb_bookmarks'] > 0)
        $leftmenu["/bookmarks/$url_id"] = 'Bookmarks';

$_SMARTY['leftmenu'] = $leftmenu;
/*****************************************/

$_SMARTY['leftmenu'] = $leftmenu;
$_SMARTY['links'] = $links;
$_SMARTY['user'] = $user;


?>
