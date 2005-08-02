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


$_SMARTY['rss'] = array(
	'title' => '.node | My communities',
	'description' => 'Last activities on your communities',
	'link' => 'http://'.$config['domain'].'/communities/mine'
);

$items = $db->getAssoc('SELECT c.id_comm AS id_comm, c.id AS id, c.name AS name, c.nb_members AS nb_members, c.moderated AS moderated, c.last_post_date AS last_post_date FROM community AS c LEFT JOIN user_comm AS u USING (id_comm) WHERE u.id=? ORDER BY c.last_post_date DESC LIMIT 0,20', true, array($url_id));

if(DB::isError($items))
	error_log($items->getUserInfo());
else
foreach($items as $id_comm=>$item)
{
	$_SMARTY['rss']['item']['http://'.$config['domain'].'/communities/forum/'.$id_comm.'/'.$item['last_post_date']] = array(
		'title' => $item['name'],
		'author' => '.node communities activity survey',
		'pubDate' => date('r', $item['last_post_date']),
		'link' => 'http://'.$config['domain'].'/communities/forum/'.$id_comm.'/'.$item['last_post_date'],
		'description' => 'Last change on '.date('r', $item['last_post_date'])
	);
}

?>
