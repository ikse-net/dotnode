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
$smarty->assign('Title','Bookmarks');

$links = $db->query('SELECT link, comment, id_cat FROM bookmarks WHERE id=?', array($_SESSION['my_id']) );
$idx=0;
while($link = $links->fetchRow())
{
	$my['bookmarks'][$idx] = $link;
	if($link['id_cat']!=0)
	{
		$my['bookmarks'][$idx]['path'] = get_cat_path($link['id_cat']);
	}
	$idx++;
}


// print_r(get_sub_cat());
$cats = get_sub_cat();

$bookmarks_cat = array('0'=>' - Create new... - ');
$bookmarks_cat += $cats;

$bookmarks_cat_parent = array('0'=>' - Root - ');
$bookmarks_cat_parent += $cats;
$smarty->assign('my',$my);
$smarty->assign_by_ref('bookmarks_cat',$bookmarks_cat);
$smarty->assign_by_ref('bookmarks_cat_parent',$bookmarks_cat_parent);



?>
