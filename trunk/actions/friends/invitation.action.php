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

if(isset($_POST['yes']) && $url_id != $_SESSION['my_id'] )
{	
	$invitation_values = array(
		'id' => $_SESSION['my_id'],
		'id_invit' => $url_id,
		'level' => $_POST['level'] );

	$db->autoExecute("invitation", $invitation_values);

	active_message(	'friend_invitation', 
			$_SESSION['my_fname'], 
			$url_id, 
			strarg( _('Invitation from %1 %2'), $_SESSION['my_fname'], $_SESSION['my_lname']),
			strarg( _('Can I be your friend ? (see my profile here : %1 )'), 'http://'.$config['domain'].'/profile/'.$_SESSION['my_id']),
			$_SESSION['my_id'] 
			);

	if(get_setting($url_id, 'new_friend_notifications') == 'email')
		auto_mail( $_SESSION['my_id'], 
			   $url_id,  
			   strarg( _('Invitation from %1 %2'), $_SESSION['my_fname'], $_SESSION['my_lname']),
			   strarg( _('Can I be your friend ? (see my profile here : %1 )'), 'http://'.$config['domain'].'/profile/'.$_SESSION['my_id'])
			 );
	
}

header('Location: /profile/'.$url_id);

?>
