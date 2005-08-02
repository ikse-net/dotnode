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

if(strlen($_POST['subject'])<1 || strlen($_POST['message'])<1)
{
	$_SESSION['error']['title'] = _('Incorrect message');
	$_SESSION['error']['msg'] = _('You must enter a subject and a body to send your .message');
	$_SESSION['error']['post'] = array_map('stripslashes', $_POST);

	if(strlen($token[4]) == 32 && $token[5] == 'contact')
                header('Location: /messages/write/'.$token[4].'/contact');
        else
                header('Location: /messages/write');

	exit();
}
else
{
	if(strlen($token[4]) == 32)
	{
		$dest = 'one';
		$to = $token[4];
	}
	else
	{
		$dest = $_POST['dest'];
		if($dest == 'one') 
			$to = $_POST['to'];
		else
			$to = NULL;
	}

	auto_message(
		$_SESSION['my_id'],
		$to, 
		stripslashes($_POST['subject']), 
		stripslashes($_POST['message']),
		$dest,
		stripslashes($_SESSION['my_fname']) );
		
	if(strlen($token[4]) == 32 && $token[5] == 'contact')
		header('Location: /profile/'.$token[4]);
	else
		header('Location: /messages/inbox');

}
?>
