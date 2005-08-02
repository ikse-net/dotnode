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
	$link =& $db->getRow('SELECT link, comment FROM bookmarks WHERE id=? LIMIT !,1', array($_SESSION['my_id'], ($token[3]-1)) );
	$db->query('DELETE FROM bookmarks WHERE id=? AND link=?', array($_SESSION['my_id'], $link['link']));
	if($db->affectedRows() == 1)
	{
		$nb_links = $db->getOne('SELECT COUNT(id) FROM bookmarks WHERE id=?',$_SESSION['my_id']);
	        $db->query('UPDATE cache_user SET nb_bookmarks=? WHERE id=?', array($nb_links, $_SESSION['my_id']));
	}

	header('Location: /my/bookmarks');
	exit();
}
else
{
	header('Location: /my/bookmarks');
	exit();
}

?>
