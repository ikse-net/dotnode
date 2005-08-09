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

include(INCLUDESPATH.'/countries_list.inc.php');
$labels['profile']['country'] = $db->getAssoc('SELECT DISTINCT country, country  FROM user_contact');
$_SMARTY['Title'] =  'Find your soul mate';

$pagination['elmt_by_page'] = 20;

if(is_numeric($token[1]) &&
   $token[1] > 0 )
        $pagination['current_page'] = $token[1];
else
        $pagination['current_page'] = 1;

error_log($token[1]);

$search = array(
	'photo' => array ('y'=> _('only member with photo') ),
);

$idx=0;
foreach($labels['profile']['here_for'] as $key=>$value)
{
	$search['here_for'][pow(2, $idx++)] = $value;
}

	$idx++;
if(!is_numeric($_GET['search']['agemin']) && $_GET['search']['agemin'] < 1 && $_GET['search']['agemin'] > 99)
	unset($_GET['search']['agemin']);
elseif(is_numeric($_GET['search']['agemin']) )
{
	$where[] = 'age>=?';
	$where_array[] = $_GET['search']['agemin'];
}

if(!is_numeric($_GET['search']['agemax']) && $_GET['search']['agemax'] < 1 && $_GET['search']['agemax'] > 99)
        unset($_GET['search']['agemax']);
elseif(is_numeric($_GET['search']['agemax']) )
{
        $where[] = 'age<=?';
        $where_array[] = $_GET['search']['agemax'];
}

if($_GET['search']['country'] != "(null)" && $_GET['search']['country'] != "" && isset($_GET['search']['country']))
{
	$where[] = "country=?";
	$where_array[] = $_GET['search']['country'];
}

if($_GET['search']['photo'][0] == 'y')
{
        $where[] = "photo=?";
        $where_array[] = 'y';
}


if(count($_GET['search']['gender']) == 2)
	unset($_GET['search']['gender']);
if(count($_GET['search']['here_for']) == 4)
        unset($_GET['search']['here_for']);
if(count($_GET['search']['relationship_status']) == 3)
        unset($_GET['search']['relationship_status']);

$list_item = array('gender', 'relationship_status');

foreach($list_item as $field)
	if(is_array($_GET['search'][$field]))
	{
		$idx=0;
		foreach($_GET['search'][$field] as $item)
		{
			$where_array[] = $_GET['search'][$field][$idx];
			$idx++;
		}
		$where[] = $field.' IN ('.implode(',', @array_fill(0,count($_GET['search'][$field]), '?')).')';
		unset($temp);
	}

if(is_array($_GET['search']['here_for']))
{
	$where[] = 'here_for=here_for|?';
	$where_array[] = array_sum($_GET['search']['here_for']);
}               



if(is_array($where))
{
	$where_str = implode(' AND ', $where);

	$pagination['nb_elements'] = $db->getOne('SELECT COUNT(id) FROM cache_user WHERE '.$where_str.'', $where_array);
	$where_array[] = ($pagination['elmt_by_page'] - 1)  * $pagination['current_page'];
	$where_array[] = $pagination['elmt_by_page'];
	$r0 = $db->query('SELECT id, fname, lname, here_for, gender, country, relationship_status FROM cache_user WHERE '.$where_str.' ORDER BY join_date DESC LIMIT !,!', $where_array);
}
else
	$r0 = $db->query('SELECT id, fname, lname, here_for, gender, country, relationship_status FROM cache_user WHERE photo=? ORDER BY join_date DESC LIMIT 20', 'y');

while($item = $r0->fetchRow())
{
	$item_id = $item['id'];
	unset($item['id']);

	$result[$item_id] = $item;
	$result[$item_id]['gender_t'] = translate_list($item['gender'], $labels['profile']['gender']);
	$result[$item_id]['here_for_t'] = translate_list($item['here_for'], $labels['profile']['here_for']);
	$result[$item_id]['relationship_status_t'] = translate_list($item['relationship_status'], $labels['profile']['relationship_status']);

	$result[$item_id]['photo'] = build_thumb_url($item_id);
}

if($pagination['nb_elements'] > 0)
        $pagination['nb_pages'] = ceil($pagination['nb_elements']/$pagination['elmt_by_page']);
else
        $pagination['nb_pages'] = 1;

$pagination['pages'] = @array_fill(1,$pagination['nb_pages'], NULL);

$_SMARTY['pagination'] =  $pagination;
$_SMARTY['search'] =  $search;
$_SMARTY['result'] =  $result;

if(!$_GET['do'])
	 $_GET['search']['photo'] = 'y';


 ?>
