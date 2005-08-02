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

$smarty->assign('Title', "Edit a school");

if( is_numeric($token[4]) )
{
	$t_name = 'user_schools';
	$t_fields = implode(',', array_keys($table_fields[$t_name]));

	$my['schools'] =& $db->getRow("SELECT ! FROM ! WHERE id=? ORDER BY year LIMIT !,1", array($t_fields, $t_name, $_SESSION['my_id'], ($token[4]-1)));

	if( DB::isError($user_schools) )
		error_log($_SERVER['HTTP_HOST'].' | Erreyr SQL dans '.__FILE__.': '.$user_schools->getMessage());

	$my['schools']['year'] = $my['schools']['year']."-01-01";
	$smarty->assign('my', $my);
}
else
{
	header('Location: /my/profile/schools');
	exit();
}
?>
