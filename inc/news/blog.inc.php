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

$smarty->assign('Title', 'Last blog\'s tickets');

if($token[2] == 'friends')
{
	$where_blog = "blog.id IN ('".implode("','", $_SESSION['my_friends_id'])."') AND";
	$where_rss_blog_ticket = "id IN ('".implode("','", $_SESSION['my_friends_id'])."') AND";
	error_log($where);
}
$blog_r = $db->query('
        SELECT 
           blog.id AS id, 
           id_blog, 
           title, 
           chapeau, 
           ticket,
           date,
	   blog_categorie.name AS cat_name
        FROM 
           blog
	LEFT JOIN
	   blog_categorie
	USING (id_cat)
        WHERE
           blog.status=? AND
	   !
	   blog.date > ?
        ORDER BY date DESC
', array('online', $where_blog, time()-604800));
while($blog =& $blog_r->fetchRow())
{
        if(strlen($blog['ticket'])>100)
	{
		$key = $blog['date'].str_pad($blog['id_blog'],6,0);
                $blogs[$key] = $blog;
		if(!$author[$blog['id']])
                {
			$author[$blog['id']] =& get_cache_user_info($blog['id'], 'id,fname,lname');
                }
	}
}
$blog_r = $db->query('
        SELECT 
           id, 
           id_blog, 
           title, 
           description as chapeau, 
           link,
           date
        FROM 
           rss_blog_ticket 
        WHERE 
	   !
	   rss_blog_ticket.date > ? AND 
	   rss_blog_ticket.date < ?
        ORDER BY date DESC
',array($where_rss_blog_ticket, time()-604800, time()) );
while($blog =& $blog_r->fetchRow())
{
        if(strlen($blog['chapeau'])>100)
	{
		$key = $blog['date'].str_pad($blog['id_blog'],6,0);
                $blogs[$key] =& $blog;
		if(!$author[$blog['id']])
		{
			$author[$blog['id']] =& get_cache_user_info($blog['id'], 'id,fname,lname');
		}
	}
	
}
krsort($blogs);

foreach($blogs as $key=>$blog)
{
	$day = date('Ymd', $blog['date']);

	if($day != $last_day)
	{
		$blogs[$key]['day'] = $day;
		$last_day = $day;
		if($last_blog_day_key) $blogs[$last_blog_day_key]['next_day']=$day;
		$last_blog_day_key = $key;
	}
	$blogs[$key]['author'] = $author[$blog['id']];
}

$smarty->assign('blogs' , $blogs);

?>
