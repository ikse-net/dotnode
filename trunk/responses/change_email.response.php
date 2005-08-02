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

$_robot_name = 'modif_email';
$todo =& $db->getRow('SELECT id_todo, param, id, date FROM todo WHERE id=? AND robot=? AND status=?', array($url_id, 'modif_email', 'doing'));

if(isset($todo['id']))
{
        /*********** recup des param de la todo ******************/
        if(strstr($todo['param'],'|') != false)
                $param_array = split("\|", $todo['param']);
        else
                $param_array = array($todo['param']);

        foreach($param_array as $item)
        {
                list($parameter, $value) = split('=', $item);
                $param[$parameter] = $value;
        }
        /*********************************************************/

	if($todo['date']>time()-86400)
		if( $user =& $db->getRow('SELECT id, login, fname, lname, status FROM user WHERE id=?', array($todo['id'])) )
		{
			$db->query('UPDATE user_contact SET email=? WHERE id=? and email=?', array($param['email'], $todo['id'], $param['old_email']) );
			$db->query('UPDATE todo SET status=? WHERE robot=? AND id=? AND status=?', array('done', $_robot_name, $todo['id'], 'doing'));

			header('Location: /my/profile/contact');
		}
		else
		{
			$db->query('DELETE FROM todo WHERE  robot=? AND id=?', array($_robot_name, $todo['id']));
			header('Location: /error/bad_link/nouser');
		}
	else
	{
		$db->query('DELETE FROM todo WHERE  robot=? AND id=?', array($_robot_name, $todo['id']));
		header('Location: /error/bad_link/date_expire');
	}
}
else
{
	header('Location: /error/bad_link/not_found');
}
?>

