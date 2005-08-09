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

$blogs = $db->query('SELECT id_blog, blog.id_cat,title, chapeau, ticket, date, status, blog_categorie.name as categorie, nb_comments  FROM blog LEFT JOIN blog_categorie USING (id,id_cat) WHERE blog.id=?  ORDER BY date DESC', $_SESSION['my_id'] );

if (DB::isError($blogs)) {
    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$blogs->getMessage());
}


$idx=0;

while($blog = $blogs->fetchRow())
{
	$my['blog'][$idx] = $blog;
	$idx++;
}

$my['blog_url'] = $db->getOne('SELECT rss FROM rss_blog WHERE id=?', array($_SESSION['my_id']));

$_SMARTY['my'] = $my;


?>
