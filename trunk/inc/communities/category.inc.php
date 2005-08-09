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


if(is_numeric($token[2]) && ($token[3] != 'newer' && $token[3] != 'popular'))
{
	header('Location: /communities/category/'.$token[2].'/newer');
	exit();
}

if(is_numeric($token[2]))
{
	$_SMARTY['Title'] =  'By category';

	if($token[3] == 'newer')
		$order = "ORDER BY date DESC";
	if($token[3] == 'popular')
		$order = "ORDER BY nb_members DESC";

	$category =& $db->getRow('SELECT name, description, nb_communities  FROM community_cat WHERE id_cat=?', array($token[2]));

	$nb_page = ceil($category['nb_communities']/20);
	$pages = @array_fill(1,$nb_page, NULL);

	if($category['nb_communities']>20 && is_numeric($token[4]) && $token[4]<= $nb_page )
		$limit_start = ($token[4]-1)*20;
	else
		$limit_start = 0;

	$community_r = $db->query('SELECT id, id_comm, name, description, nb_members FROM community WHERE id_cat=? ! LIMIT !,20', array($token[2], $order, $limit_start));
	while($community =& $community_r->fetchRow())
	{
		$communities[$community['id_comm']] = $community;
		$communities[$community['id_comm']]['logo'] = build_logo_thumb_url($community['id'], $community['id_comm']);
	}

	$_SMARTY['cat'] =  $category;
	$_SMARTY['pages'] =  $pages;
	$_SMARTY['communities'] =  $communities;
}
else
{
	$categories_r = $db->query('SELECT id_cat, name, nb_communities FROM community_cat');
while($category = $categories_r->fetchRow())
{
        $id_cat = $category['id_cat'];
        settype($id_cat, 'string');
        $categories_list[$id_cat] = _($category['name']).' ('.$category['nb_communities'].')';
        $categories[$category['name']] = $category;
        if($category['nb_communities']>0)
        {
                $communities_r = $db->query('SELECT id_comm, name, nb_members FROM community WHERE id_cat=? ORDER BY nb_members DESC LIMIT 6', array($category['id_cat']));
                while($communities = $communities_r->fetchRow())
                        $categories[$category['name']]['list'][$communities['id_comm']] = $communities;
        }
}

$_SMARTY['categories'] =  $categories;

array_unshift($categories_list, _('Everywhere'));
$_SMARTY['categories_list'] =  $categories_list;

}

?>
