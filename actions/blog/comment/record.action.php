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

if(is_numeric($token[4]) && is_numeric($token[5]))
{
	$blog = $db->getRow('SELECT id_blog FROM blog WHERE id=? AND id_blog=? LIMIT 1', array($url_id, $token[4]) );

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
			$value = '';
			if( $_POST[$key] == '(null)' || $_POST[$key] == '')
				$value = NULL;
			else
				$value = $_POST[$key];

			if($key == 'comment' && is_null($value))
			{
				$_SESSION['error']['title']=_('No comment');
                                $_SESSION['error']['msg']=_('You must fill the form to modify your comment');
				$_SESSION['error']['post'] = array_map('stripslashes', $_POST);
                                header('Location: /blog/'.$url_id.'/edit/'.$token[4].'/'.$token[5]);
                                exit();

			}
			else
				$comment_values[$key] = stripslashes($value);

		}
	}

	$result = $db->autoExecute('blog_comment', $comment_values, DB_AUTOQUERY_UPDATE, "id_author='".$_SESSION['my_id']."' AND id_comment='".$token[5]."' AND id_blog='".$blog['id_blog']."'");
	if (DB::isError($result)) {
	    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getMessage());
	}
}

header('Location: /blog/'.$url_id.'/view/'.$token[4]);
?>
