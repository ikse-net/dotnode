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


$user['info'] =& get_cache_user_info($login);

if(!isset($user['info']['id']))
{
	header('Location: http://'.$config['domain']);
	exit();
}

$user['photo'] = build_image_url($user['info']['id']);

if(!is_numeric($token[2]))
{
	header('Location: http://'.$config['domain']);
        exit();
}
	

$blog = $db->getRow('SELECT id_blog, blog.id_cat,title, chapeau, ticket, date, status, blog_categorie.name as categorie, nb_comments  FROM blog LEFT JOIN blog_categorie USING (id,id_cat) WHERE blog.id=? AND blog.id_blog=? AND status=? ORDER BY date DESC LIMIT 10', array($user['info']['id'], $token[2], 'online'));
if(DB::isError($blog))
	error_log($_SERVER['HTTP_HOST'].' | '.$blog_r->getUserInfo());

$comments_r = $db->query('SELECT id_comment, id_author, title, comment, date  FROM blog_comment WHERE id_blog=? AND id=? ORDER BY date', array($blog['id_blog'], $user['info']['id']) );
if(!DB::isError($comments_r))
	while($comment = $comments_r->fetchRow())
	{
		$blog['comment'][$comment['id_comment']] = $comment;
		if(!isset($author[$comment['id_author']])) 
			$author[$comment['id_author']] = get_cache_user_info($comment['id_author']);
		$blog['comment'][$comment['id_comment']]['author'] = $author[$comment['id_author']];
	}
else
	error_log($comments_r->getUserInfo());

$smarty->assign('profile', $user);
$smarty->assign('blog', $blog);

?>
