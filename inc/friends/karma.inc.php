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

$_SMARTY['Title'] =  'Friends\'Karma';
$relation_r = $db->query('SELECT id_friend , cool , fun , sexy , fan , `level`, `type` FROM relation WHERE id=?', array($_SESSION['my_id']));

while($relation = $relation_r->fetchRow() )
{
	$friends[$relation['id_friend']] = get_cache_user_info($relation['id_friend'], 'id, fname, lname');
	$friends[$relation['id_friend']]['karma'] = $relation;
}

$smarty->assign('options', 
	array(
	'0'=>'0',
	'1'=>'1', 
	'2'=>'2', 
	'3'=>'3' ));

$smarty->assign('options_fan',     
	array(
	'0'=>'0', 
	'1'=>'1'));


$_SMARTY['friends'] =  $friends;
?>
