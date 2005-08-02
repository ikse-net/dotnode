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

$album_r = $db->query('SELECT * FROM album WHERE id=?', array($user['info']['id']));
while($album = $album_r->fetchRow())
{
        $albums[$album['id_image']] = $album;
	$albums[$album['id_image']]['thumb'] = build_album_thumb_url($user['info']['id'], $album['id_image']);
	$albums[$album['id_image']]['photo'] = build_album_url($user['info']['id'], $album['id_image'], $album['format']);
}

$smarty->assign('albums', $albums);
?>
