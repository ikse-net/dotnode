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


$id = $user['info']['id'];

$user['general'] = $db->getRow('SELECT birthday,description,web FROM user_general WHERE id=?', array($id));
$user['professionel'] = $db->getRow('SELECT web FROM user_professional WHERE id=?', array($id));
$user['contact'] = $db->getRow('SELECT email, phone FROM user_contact WHERE id=?', array($id));

$user['contact']['email_sha1'] = sha1($user['contact']['email']);

$friends_r = $db->query('SELECT user_contact.email AS email, user.fname AS fname, user.lname AS lname, user.login AS login, user.id AS id FROM user_contact LEFT JOIN user_general USING(id) LEFT JOIN user USING(id) LEFT JOIN  relation USING(id) WHERE relation.id_friend=?', array($id));
if(DB::isError($friends_r))
{
	error_log(__FILE__.' | '.$friends_r->getUserInfo());
	exit();
}

while($friend = $friends_r->fetchRow())
{
	$user['friends'][$friend['id']] = $friend;
	$user['friends'][$friend['id']]['email_sha1'] = sha1($friend['email']);
}

?>
