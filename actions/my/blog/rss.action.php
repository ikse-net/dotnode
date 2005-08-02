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

if($_POST['blog_url'] == 'http://' || $_POST['blog_url'] == '')
{
	$db->query('DELETE FROM rss_blog WHERE id=?', array($_SESSION['my_id']) );
	$db->query('DELETE FROM rss_blog_ticket WHERE id=?', array($_SESSION['my_id']) );
}
else
{
	$exist = $db->getOne('SELECT id FROM rss_blog WHERE id=?', array($_SESSION['my_id']) );
	if($exist)
		$res = $db->query('UPDATE rss_blog SET rss=? WHERE id=?', array($_POST['blog_url'], $_SESSION['my_id']) );
	else
		$res = $db->query('INSERT INTO rss_blog SET rss=?, id=?', array($_POST['blog_url'], $_SESSION['my_id']) );
	if(DB::isError($res))
		error_log($res->getUserInfo());
}
header('Location: /my/blog');
?>
