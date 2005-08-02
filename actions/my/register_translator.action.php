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

$passwd = $db->getOne('SELECT passwd FROM user WHERE id=?', array($_SESSION['my_id']));
$data = array(
	'id_dotnode' => $_SESSION['my_id'],
	'login' => $_SESSION['my_login'],
	'passwd' => $passwd,
	'comment' => stripslashes($_POST['comment']),
	'status' => 'waiting',
	'level' => $_POST['level'],
	'lang' => stripslashes($_POST['lang']),
	'date' => time()
);
$db->autoExecute('dntp_translator', $data);
header('Location: /my/become_translator/thanks');
?>
