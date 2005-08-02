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

set_time_limit(0);
header('Content-type: text/plain');
$res = $db->query('SELECT id, login, friends_id FROM cache_user');

print "strict graph G {\n";
print "node [color=lightblue2, style=filled];\n";
$level=0;
while($user = $res->fetchRow())
{
	if($level>3)
		break;
	print '"'.$user['login'].'" -- { ';
	$friends = get_cache_user_info($user['id'], 'login');
	foreach(explode(',', $user['friends_id']) as $friend_id)
	{
		$friend = get_cache_user_info( $friend_id, 'login');
		print '"'.$friend['login'].'" ';
	}
	print "};\n";
	$level++;
}

print "}";
?>
