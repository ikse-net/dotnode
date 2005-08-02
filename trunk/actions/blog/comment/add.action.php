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

if(is_numeric($token[4]) )
{
	$blog = $db->getRow('SELECT id_blog,nb_comments FROM blog WHERE id=? AND id_blog=? LIMIT 1', array($url_id, $token[4]) );

	if(!is_numeric($blog['id_blog']))
	{
		header('Location: /blog/'.$url_id.'/view/'.$token[4]);
		exit();
	}

	$comment_values = array();

	foreach(array_keys($table_fields['blog_comment']) as $key)
	{
		if(array_key_exists($key, $_POST) )
		{
			$_POST[$key] = trim($_POST[$key]);
			$value = "";
			if( $_POST[$key] == "(null)" || $_POST[$key] == "")
				$value = NULL;
			else
				$value = $_POST[$key];

			if($key == 'comment' && is_null($value))
			{
				$_SESSION['error']['title']=_('No comment');
				$_SESSION['error']['msg']=_('You must fill the form to add a comment');
				$_SESSION['error']['post']= array_map('stripslashes', $_POST);
				header('Location: /blog/'.$url_id.'/view/'.$token[4]);
				exit();
			}
			else
				$comment_values[$key] = stripslashes($value);

		}
	}

	$comment_values['id_author'] = $_SESSION['my_id'];
	$comment_values['id_blog'] = $blog['id_blog'];
	$comment_values['date'] = time();
	$comment_values['id'] = $url_id;

	$result = $db->autoExecute('blog_comment', $comment_values, DB_AUTOQUERY_INSERT);
	if (DB::isError($result)) {
	    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getMessage());
	}
	elseif($db->affectedRows() == 1)
	{
		$db->query('UPDATE blog SET nb_comments=nb_comments+1 WHERE id=? AND id_blog=?', array($url_id, $blog['id_blog']));
		if($comment_values['id'] != $_SESSION['my_id'])
		{
		active_message(
			'system',
			$_SESSION['my_fname'].' '.$_SESSION['my_lname'], 
			$comment_values['id'], 
			'New blog comment: '.$comment_values['title'], 
			"The comment is:\n".$comment_values['comment']."\n\nSee it here : http://".$config['domain']."/blog/view/".$comment_values['id_blog'], 
			$comment_values['id_author']
			);
		if(get_setting($comment_values['id'], 'new_blog_comment '))
		auto_mail( MODERATOR_ID,   $comment_values['id'],   'New blog comment: '.$comment_values['title'],   $comment_values['comment']."\n\nSee it here : http://".$config['domain'].'/blog/view/'.$comment_values['id_blog'] );
		}

	}
}

header('Location: /blog/'.$url_id.'/view/'.$token[4])
?>
