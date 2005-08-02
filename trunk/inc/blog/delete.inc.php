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


if( is_numeric($token[2]) && is_numeric($token[3]))
{
	$db->query('DELETE FROM blog_comment WHERE id=? AND id_author=? AND id_comment=?', array($url_id, $_SESSION['my_id'], $token[3]));
	if($db->affectedRows() == 1)
		$db->query('UPDATE blog SET nb_comments=nb_comments-1 WHERE id=? AND id_blog=?', array($url_id, $token[2]));
}

header("Location: /blog/$url_id/view/".$token[2]);
exit();

?>
