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
        'title' => '.node | Last communities',
        'description' => 'The 15 last .node communities',
        'link' => 'http://'.$config['domain'].'/communities/last'
);


$items = $db->getAssoc('SELECT community.id_comm as id_comm, community.id as id, community.country as country, community.name as name, community.description as description, community.nb_members, community_cat.name as cat_name, community.date as date FROM community LEFT JOIN community_cat USING (id_cat) ORDER BY community.date DESC LIMIT 15', true );

if(DB::isError($items))
        error_log($items->getUserInfo());
else
foreach($items as $id_comm=>$item)
{
	if(strlen($item['country']) == 0)
		$title = $item['name'];
	else
		$title = $item['name'].' ('.$item['country'].')';

        $_SMARTY['rss']['item']['http://'.$config['domain'].'/communities/view/'.$id_comm] = array(
                'title' => $title,
                'author' => 'Category: '.$item['cat_name'],
                'pubDate' => date('r', $item['date']),
                'link' => 'http://'.$config['domain'].'/communities/view/'.$id_comm,
                'description' => 'Created on '.date('r', $item['date']).': '.$item['description']
        );
}

?>
