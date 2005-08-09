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


$_SMARTY['Title'] = 'Blog';

$user['info'] = get_cache_user_info($url_id);

if($rss_blog = $db->getRow('SELECT id_blog, title, link, rss FROM rss_blog WHERE id=?', array($url_id)) )
{
	$ticket_r = $db->query('SELECT id_ticket, title, description, link, date FROM rss_blog_ticket WHERE id=? ORDER BY date DESC LIMIT 10', array($url_id));
	while($ticket = $ticket_r->fetchRow())
		$rss_blog['item'][$ticket['link']] = $ticket;

	$_SMARTY['rss_blog'] = $rss_blog;
}
else
{
	$blogs = $db->query('SELECT blog.id as id, id_blog, blog.id_cat,title, chapeau, ticket, date, status, blog_categorie.name as categorie, nb_comments  FROM blog LEFT JOIN blog_categorie USING (id,id_cat) WHERE blog.id=? AND blog.status=? ORDER BY date DESC LIMIT 0,10', array($url_id, 'online') );
	if (DB::isError($blogs)) {
	    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$blogs->getMessage());
	}

	while($ticket = $blogs->fetchRow())
		$blog[$ticket['id_blog']] = $ticket;

	$_SMARTY['blog'] = $blog;
}


$user['info'] = get_cache_user_info($url_id);


/************* menu *******************/
$leftmenu["/profile/$url_id"] = 'Profile';

if($user['info']['nb_photos'] > 0)
        $leftmenu["/album/$url_id"] = 'Album';

if($user['info']['nb_blogs'] > 0)
        $leftmenu["/blog/$url_id"] = 'Blog';

if($user['info']['nb_bookmarks'] > 0)
        $leftmenu["/bookmarks/$url_id"] = 'Bookmarks';

$_SMARTY['leftmenu'] = $leftmenu;


/************************************/

$_SMARTY['user'] = $user;


?>
