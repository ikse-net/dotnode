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


$id_friend = $url_id;

switch($token[3])
{
case 'fun':
case 'cool':
case 'sexy':
	if($token[4] >= -1 && $token[4]<=3)
		$karma_value = $token[4];
case 'fan':
	if($token[4] == 0 || $token[4] == 1)
                $karma_value = $token[4];
case 'level':
case 'type':
	$karma_type = $token[3];
	break;
default:
	error_log("Erreur de token[3]");
	exit();
}

if($karma_type == 'level' || $karma_type == 'type')
	$karma_value = $token[4];

if(in_array($id_friend, $_SESSION['my_friends_id']))
{
	error_log("$karma_type, $karma_value, $id_friend");
	$res = $db->query('UPDATE relation SET !=? WHERE id_friend=? AND id=?', array($karma_type, $karma_value, $id_friend, $_SESSION['my_id']));
	if(DB::isError($res))
		error_log($res->getUserInfo());
	else
	{
		switch($karma_type)
		{
		case 'fan':
			$karma['nb_fans'] = $db->getOne('SELECT SUM(fan) FROM relation WHERE id_friend=?', array($id_friend));
			break;
		case 'fun':
		case 'cool':
		case 'sexy':
			$karma[$karma_type] = get_karma($id_friend, $karma_type);
			break;
		}
		if($karma)
		{
			$kres = $db->autoExecute('cache_user', $karma, DB_AUTOQUERY_UPDATE, "id='$id_friend'");
			if(DB::isError($kres))
				error_log($kres->getUserInfo());
		}

	}


}

?>
