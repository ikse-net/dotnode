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


if( is_numeric($token[3]) )
{
	$image =& $db->getRow('SELECT id_image, width, height, format, caption FROM album WHERE id=? ORDER BY date DESC LIMIT !,1', array($_SESSION['my_id'], ($token[3]-1)) );
	$db->query('DELETE FROM album WHERE id_image=?', $image['id_image']);

	$nb_photos = $db->getOne('SELECT COUNT(id) FROM album WHERE id=?',$_SESSION['my_id']);
        $db->query('UPDATE cache_user SET nb_photos=? WHERE id=?', array($nb_photos, $_SESSION['my_id']));

	$image_path = build_album_path($_SESSION['my_id'], $image['id_image'], false, $image['format']);
	$thumb_path = build_album_thumb_path($_SESSION['my_id'], $image['id_image']);
	
	unlink($image_path);
	unlink($thumb_path);
	header('Location: /my/album');
	exit();
}
else
{
	header('Location: /my/album');
	exit();
}

?>
