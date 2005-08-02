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

$nb = $db->getOne('SELECT COUNT(id) FROM user WHERE id=? AND passwd=PASSWORD(?)', array($_SESSION['my_id'], $_POST['oldpasswd']));
//print_r($nb);
if($nb == 1 || isset($_SESSION['old_password']))
{
	if($_POST['passwd1'] == $_POST['passwd2'] && strlen($_POST['passwd1']) >3)
	{
		$db->query('UPDATE user SET passwd=PASSWORD(?) WHERE id=?', array($_POST['passwd1'], $_SESSION['my_id']) );
		header('Location: /my');
	}
	else
		header('Location: /error/bad_new_password');
}
else
	header('Location: /error/bad_old_password');
?>
