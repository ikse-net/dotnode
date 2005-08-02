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


foreach($_POST['karma'] as $id_friend=>$karma_value)
{
	$relation_values = array( $karma_value[0], $karma_value[1], $karma_value[2], $karma_value[3], $_POST['level'][$id_friend], $_POST['type'][$id_friend], $_SESSION['my_id'], $id_friend);
	if($karma_value[0]<2 && $karma_value[1]<4 && $karma_value[2]<4 && $karma_value[3]<4)
		$db->query('UPDATE relation SET fan=?, fun=?, cool=?, sexy=?, `level`=?, `type`=? WHERE id=? AND id_friend=?', $relation_values);
}

foreach($_POST['karma'] as $id_friend=>$karma_value)
{
	if(strlen($id_friend) == 32)
	{
		$karma =& $db->getRow('SELECT SUM(fan) as fan FROM relation WHERE id_friend=?', array($id_friend));
		$karma['fun'] = get_karma($id_friend, 'fun');
	        $karma['cool'] = get_karma($id_friend, 'cool');
        	$karma['sexy'] = get_karma($id_friend, 'sexy');

		$karma['id'] = $id_friend;
		$db->query('UPDATE cache_user SET nb_fans=?, fun=?, cool=?, sexy=? WHERE id=?', array_values($karma));
	}
}


header('Location: /friends/karma/success');

?>
