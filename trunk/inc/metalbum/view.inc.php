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

include(INCLUDESPATH.'/metalbum.class.php');
include(INCLUDESPATH.'/pager.inc.php');


$_SMARTY['user']['info'] = get_cache_user_info($url_id);
$_SMARTY['user']['photo'] = build_image_url($url_id);


if(is_valid('metalbum_name', $token[2]))
	$album_name = $token[2];
else
{
	header('Location: /metalbum/'.$url_id);
	exit();
}

$photo_id = $token[3];

$_SMARTY['Title'] = 'Meta Album: '.$album_name;

list($login, $type) = split('@', $album_name);

$album =& Metalbum::factory($type, $login, $config['metalbum'][$type]);
if(is_a($album, 'Metalbum'))
$_SMARTY['photo'] = $album->getPhotoInfo($photo_id);

$_SMARTY['metalbum']['name'] = $album_name;
$_SMARTY['metalbum']['login'] = $login;
$_SMARTY['metalbum']['type'] = $type;

$_SMARTY['leftmenu']["/profile/$url_id"] = 'Profile';
$_SMARTY['leftmenu']['/metalbum/'.$url_id] = 'Meta Album';
$_SMARTY['leftmenu']['/metalbum/'.$url_id.'/album/'.$album_name] = $album_name;


?>
