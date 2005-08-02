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


$comm = $db->getRow('SELECT id_comm, name FROM community WHERE id_comm=?', array($token[3]) );

if(is_array($_POST['invitation']) && $comm)
{
	foreach($_POST['invitation'] as $id)
	{
		auto_message(
			$_SESSION['my_id'], 
			$id, 
			'Invitation to join '.$comm['name'].' community',
			'I invite you to join '.$comm['name'].' community'."\n".
				'Go to this community: http://'.$config['domain'].'/communities/view/'.$comm['id_comm'],
			'one',
			$_SESSION['my_fname'] );
	}
}

header('Location: /communities/view/'.$token[3]);
?>
