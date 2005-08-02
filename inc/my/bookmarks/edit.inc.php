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

if( is_numeric($token[3]) )
{
	$smarty->assign('Title','Bookmarks');

	$link =& $db->getRow('SELECT link, comment, id_cat FROM bookmarks WHERE id=? LIMIT !,1', array($_SESSION['my_id'], ($token[3]-1)) );

	$my['bookmarks']['link'] = $link;

	$cats = get_sub_cat();

	$bookmarks_cat = array(
			'0'=>' - Create new... - ');

	$bookmarks_cat = array_merge($bookmarks_cat, $cats);

	$bookmarks_cat_parent = array(
			'0'=>' - Root - ');

	$bookmarks_cat_parent = array_merge($bookmarks_cat_parent, $cats);


	$smarty->assign_by_ref('bookmarks_cat',$bookmarks_cat);
	$smarty->assign_by_ref('bookmarks_cat_parent',$bookmarks_cat_parent);


	$smarty->assign('my',$my);
}
else
{
	header('Location: /my/album');
	exit();
}

?>
