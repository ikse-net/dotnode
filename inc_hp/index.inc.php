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


$user['info'] = array_merge ($user['info'],  $db->getRow('SELECT user_contact.email AS email, user_contact.im AS im, user_contact.im_type AS im_type, user_contact.address AS address, user_contact.zip AS zip, user_contact.city AS city, user_contact.country AS country, user_general.relationship_status AS relationship_status,  user_general.web AS web,  user_general.description AS description, user_interests.passions AS passions, user_interests.sports AS sports, user_professional.6nergies_url AS 6nergies_url  FROM user_general, user_contact, user_interests, user_professional WHERE user_general.id=? AND user_general.id=user_contact.id AND user_general.id=user_interests.id AND user_general.id=user_professional.id LIMIT 1', array($user['info']['id'])) );


// $blog_r = $db->query('SELECT * FROM blog WHERE id=? AND status=? ORDER BY date DESC LIMIT 2', array($user['info']['id'], 'online'));


if($rss_blog = $db->getRow('SELECT id_blog, title, link, rss FROM rss_blog WHERE id=?', array($user['info']['id'])) )
{
        $ticket_r = $db->query('SELECT id_ticket, title, description, link, date FROM rss_blog_ticket WHERE id=? ORDER BY date DESC LIMIT 3', array($user['info']['id']));
        while($ticket = $ticket_r->fetchRow())
                $rss_blog['item'][$ticket['link']] = $ticket;

        $smarty->assign('rss_blog',$rss_blog);
}
else
{
        $blog_r = $db->query('SELECT id_blog, blog.id_cat,title, chapeau, ticket, date, status, blog_categorie.name as categorie, nb_comments  FROM blog LEFT JOIN blog_categorie USING (id,id_cat) WHERE blog.id=? AND status=? ORDER BY date DESC LIMIT 3', array($user['info']['id'], 'online'));
        if(DB::isError($blog_r))
                error_log($_SERVER['HTTP_HOST'].' | '.$blog_r->getUserInfo());
        else
                while($blog = $blog_r->fetchRow())
                {
                        $blogs[$blog['id_blog']] = $blog;
                }

        $smarty->assign('blogs', $blogs);
}



$album_r = $db->query('SELECT * FROM album WHERE id=? ORDER BY RAND() LIMIT 3', array($user['info']['id']));
while($album = $album_r->fetchRow())
{
        $albums[$album['id_image']] = $album;
	$albums[$album['id_image']]['thumb'] = build_album_thumb_url($user['info']['id'], $album['id_image']);
	$albums[$album['id_image']]['photo'] = build_album_url($user['info']['id'], $album['id_image'], $album['format']);
}

$bookmark_r = $db->query('SELECT * FROM bookmarks WHERE id=? ORDER BY RAND() LIMIT 5', array($user['info']['id']));
while($bookmark = $bookmark_r->fetchRow())
{
        $bookmarks[$bookmark['link']] = $bookmark;
}
$idx=0;
foreach($user['info']['friends_id'] as $friend_id)
{
	if($idx>5) continue;
        $friend = get_cache_user_info($friend_id, 'id, login, fname, lname, photo');
	if($friend['photo'] != 'n')
	{
		$friends[$friend_id] = $friend;
		$idx++;

	}
	unset($friend);
}



$smarty->assign('blogs', $blogs);
$smarty->assign('albums', $albums);
$smarty->assign('bookmarks', $bookmarks);
$smarty->assign('friends', $friends);


?>
