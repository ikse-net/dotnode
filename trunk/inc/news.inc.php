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

$smarty->assign('Title', 'News');

$db_wiki =& DB::connect($dsn_wiki);
if (DB::isError($db_wiki))
        error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db_wiki->getMessage());
$db_wiki->setFetchMode(DB_FETCHMODE_ASSOC);

$page =& $db_wiki->getOne('SELECT body FROM pages WHERE tag=? AND lang=? AND latest=?', array('DotNodeNews'.$token[1], $lang, 'Y'));
if(!$page)
	$page =& $db_wiki->getOne('SELECT body FROM pages WHERE tag=? AND lang=? AND latest=?', array('DotNodeNews'.$token[1], 'en_US', 'Y'));
$db_wiki->disconnect();

/*
$blog_r = $db->query('
	SELECT 
	   blog.id, 
	   cache_user.fname as fname, 
	   cache_user.lname as lname, 
	   id_blog, 
	   title, 
	   chapeau, 
	   ticket,
	   date
	FROM 
	   blog,cache_user 
	WHERE 
	   blog.id=cache_user.id AND
	   blog.status=?
	ORDER BY date DESC
	LIMIT 20
', array('online'));
while($blog =& $blog_r->fetchRow())
{
	if(strlen($blog['ticket'])>100)
		$blogs[$blog['date'].str_pad($blog['id_blog'],6,0)] =& $blog;
}
$blog_r = $db->query('
        SELECT 
           rss_blog_ticket.id, 
           cache_user.fname as fname, 
           cache_user.lname as lname, 
           id_blog, 
           title, 
           description as chapeau, 
	   link,
           date
        FROM 
           rss_blog_ticket,cache_user 
        WHERE 
           rss_blog_ticket.id=cache_user.id AND
	   rss_blog_ticket.date<?
        ORDER BY date DESC
        LIMIT 20
', array(time()));
while($blog =& $blog_r->fetchRow())
{
	if(strlen($blog['chapeau'])>100)
	        $blogs[$blog['date'].str_pad($blog['id_blog'],6,0)] =& $blog;
}
krsort($blogs);

$smarty->assign('blogs' , array_slice($blogs,0,15));

*/
$smarty->assign('page' , $page);
?>
