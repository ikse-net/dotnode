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

$album_r = $db->query('SELECT id_image, width, height, format, caption FROM album WHERE id=? ORDER BY date DESC', $_SESSION['my_id'] );
while($image = $album_r->fetchRow())
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

$_SMARTY['my'] = $my;
$_SMARTY['album'] =  $album;

?>
