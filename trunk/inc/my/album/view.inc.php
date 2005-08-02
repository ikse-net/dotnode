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
	$smarty->assign('Title','Album');

	$image = $db->getRow('SELECT id_image, width, height, format, caption FROM album WHERE id=? ORDER BY date DESC LIMIT !,1', array($_SESSION['my_id'], ($token[3]-1)) );

	$my['album']['image'] = $image;
	$my['album']['image']['path'] = build_album_url($_SESSION['my_id'], $image['id_image'], $image['format']);

	$smarty->assign('my',$my);
}
else
{
	header('Location: /my/album');
	exit();
}

?>
