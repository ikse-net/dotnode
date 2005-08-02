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

$smarty->assign('Title', 'Community');

$array = explode(' ', $_GET['q']);
error_log('comm_search: '.$_GET['q']);
$result = array();
$comm = array();
$idx=0;

$nb_elemt = 0;

foreach($array as $elemt)
{
	$elemt = ereg_replace("(.*)s$", "\\1", $elemt);
	
	if(strlen($elemt)>2)
	{
		if(is_numeric($_GET['cat']) && $_GET['cat']>0)
			$s_r = $db->query('SELECT id_comm, id_cat FROM community_keyword WHERE key_sndx=SOUNDEX(?) AND id_cat=?', array($elemt, $_GET['cat']));
		else
			$s_r = $db->query('SELECT id_comm, id_cat FROM community_keyword WHERE key_sndx=SOUNDEX(?)', array($elemt));
		while($s = $s_r->fetchRow())
			$result[$s['id_comm']]++;
		$nb_elemt++;
	}
}
asort($result);

foreach($result as $key=>$value)
{
	if($value==$nb_elemt)
	{
		$comm[$key] = $db->getRow('SELECT community.id AS id, community.id_comm AS id_comm, community.name AS name, community.description AS description, nb_members, community_cat.name AS cat_name FROM community LEFT JOIN community_cat USING (id_cat) WHERE community.id_comm=?', array($key));
		$comm[$key]['logo'] = build_logo_thumb_url($comm[$key]['id'], $comm[$key]['id_comm']);
		$comm[$key]['weight'] = $value;
	}
}

$categories_r = $db->query('SELECT id_cat, name, nb_communities FROM community_cat');
while($category = $categories_r->fetchRow())
{
        $id_cat = $category['id_cat'];
        $categories_list[$id_cat] = tr($category['name']).' ('.$category['nb_communities'].')';
}

array_unshift($categories_list, _('Everywhere'));
$smarty->assign('categories_list', $categories_list);
$smarty->assign('comm', $comm);


?>
