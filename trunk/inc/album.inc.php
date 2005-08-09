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

$_SMARTY['Title'] = 'Album';

if($token[1] != 'view' || !is_numeric($token[2]) )
{
	$user['info'] = get_cache_user_info($url_id);

	$user['photo'] = build_image_url($url_id);

	/** Pagination ***************/
	$pagination['nb_elements'] = $db->getOne('SELECT COUNT(id_image) FROM album WHERE id=?', array($url_id) );
	$pagination['elmt_by_page'] = 12;
	if($pagination['nb_elements'] > 0)
		$pagination['nb_pages'] = ceil($pagination['nb_elements']/$pagination['elmt_by_page']);
	else
		$pagination['nb_pages'] = 1;

	if(is_numeric($token[2]) &&
			$token[2] <= $pagination['nb_pages'] &&
			$token[2] > 0 )
	{
		$pagination['current_page'] = $token[2];
		$pagination['last_page'] = $token[2]-1;
	}
	else
	{
		header('Location: /album/'.$url_id.'/page/1');
		exit();
	}

	$pagination['pages'] = @array_fill(1,$pagination['nb_pages'], NULL);

	$_SMARTY['pagination'] =  $pagination;
	/******************************/


	// *********** recuperation des infos generals ******************
	$images = $db->query('SELECT id_image, width, height, format, caption FROM album WHERE id=? ORDER BY date DESC LIMIT !,!', array($url_id, ($pagination['current_page']-1)*$pagination['elmt_by_page'], $pagination['elmt_by_page']) );
	while($image = $images->fetchRow())
	{
		$album['image'][$image['id_image']] = $image;

		$album['image'][$image['id_image']]['path'] = build_album_url($url_id, $image['id_image'], $image['format']);
		$album['image'][$image['id_image']]['thumb_path'] = build_album_thumb_url($url_id, $image['id_image']);

		$wh_ratio = $image['width']/$image['height'];
		if($wh_ratio>(160/160))
		{
			$thumb_width = 160;
			$thumb_height = floor($image['height']*160/$image['width']);
		}
		else
		{
			$thumb_width = floor($image['width']*160/$image['height']);
			$thumb_height = 160;
		}

		$album['image'][$image['id_image']]['thumb_width'] = $thumb_width;
		$album['image'][$image['id_image']]['thumb_height'] = $thumb_height;
	}
}
elseif(is_numeric($token[2]) )
{
	$_SMARTY['Title'] = 'Photo';

        $image = $db->getRow('SELECT id_image, width, height, format, caption FROM album WHERE id=? ORDER BY date DESC LIMIT !,1', array($url_id, $token[2]-1) );
	if(DB::isError($image))
		error_log($image->getUserInfo());
        $album['image'] = $image;
        $album['image']['path'] = build_album_url($url_id, $image['id_image'], $image['format']);
}

/************* menu *******************/
$leftmenu["/profile/$url_id"] = 'Profile';

if($user['info']['nb_photos'] > 0)
        $leftmenu["/album/$url_id"] = 'Album';

if($user['info']['nb_blogs'] > 0)
        $leftmenu["/blog/$url_id"] = 'Blog';

if($user['info']['nb_bookmarks'] > 0)
        $leftmenu["/bookmarks/$url_id"] = 'Bookmarks';

$_SMARTY['leftmenu'] = $leftmenu;


/************************************/

$_SMARTY['user'] = $user;
$_SMARTY['album'] = $album;


?>
