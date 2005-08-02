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


if($rss_blog = $db->getRow('SELECT id_blog, title, link, rss FROM rss_blog WHERE id=?', array($user['info']['id'])) )
{
        $ticket_r = $db->query('SELECT id_ticket, title, description, link, date FROM rss_blog_ticket WHERE id=? ORDER BY date DESC LIMIT 10', array($user['info']['id']));
        while($ticket = $ticket_r->fetchRow())
                $rss_blog['item'][$ticket['link']] = $ticket;

        $smarty->assign('rss_blog',$rss_blog);
}
else
{
	$blog_r = $db->query('SELECT id_blog, blog.id_cat,title, chapeau, ticket, date, status, blog_categorie.name as categorie, nb_comments  FROM blog LEFT JOIN blog_categorie USING (id,id_cat) WHERE blog.id=? AND status=? ORDER BY date DESC LIMIT 10', array($user['info']['id'], 'online'));
	if(DB::isError($blog_r))
		error_log($_SERVER['HTTP_HOST'].' | '.$blog_r->getUserInfo());
	else
		while($blog = $blog_r->fetchRow())
		{
			$blogs[$blog['id_blog']] = $blog;
		}

	$smarty->assign('blogs', $blogs);
}
?>
