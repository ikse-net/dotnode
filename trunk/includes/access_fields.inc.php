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

$access_fields['user_general'] = array(
	'birthday'=>'everyone' );

$access_fields['user_contact'] = array(
        'email'=>'members',
	'email2'=>'friends_of_friends', 
	'email3'=>'friends', 
	'email4'=>'friends', 
	'im'=>'friends_of_friends', 
	'im2'=>'friends_of_friends', 
        'phone'=>'friends_of_friends',  
        'cell_phone'=>'friends_of_friends',
	'address'=>'friends_of_friends' );

$access_fields['user_professional'] = array(
        'company'=>'members',
        'email'=>'friends_of_friends',
        'phone'=>'friends' );

?>
