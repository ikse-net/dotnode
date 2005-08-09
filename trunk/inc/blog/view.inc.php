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

if(is_numeric($token[2]) )
{
	$sql = 'SELECT blog.id AS id, id_blog, blog.id_cat,title, chapeau, ticket, date, status, blog_categorie.name as categorie, nb_comments  FROM blog LEFT JOIN blog_categorie USING (id,id_cat) WHERE id_blog=?';
	if($url_id != $_SESSION['my_id'])
		$sql .= " AND status='online'";
	$blog = $db->getRow($sql, array($token[2]) );

	if($blog['id'] != $url_id)
	{
		header('Location: /blog/'.$blog['id'].'/'.$blog['id_blog']);
		exit();
	}



	if (DB::isError($blog)) {
	    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$blog->getMessage());
	}

	$query_values = array($url_id, $blog['id_blog']);
	$comments = $db->query('SELECT id_comment, id_author, title, comment, date  FROM blog_comment WHERE id=? AND id_blog=? ORDER BY date',$query_values );
	while($comment = $comments->fetchRow())
	{
		$blog['comment'][$comment['id_comment']] = $comment;
		$blog['comment'][$comment['id_comment']]['author'] = get_cache_user_info($comment['id_author']);
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
	$_SMARTY['blog'] = $blog;
}
else
	header('Location: /blog/'.$url_id);

?>
