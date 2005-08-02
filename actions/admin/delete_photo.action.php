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

if($_SESSION['my_login'] == 'alexx' || $_SESSION['my_login'] == 'mathieu')
{
	$image_path = build_image_path($url_id, false); 
	$thumb_path = build_thumb_path($url_id, false);;


	$db->query('UPDATE user SET photo=? WHERE id=?', array('n', $url_id));
	$db->query('UPDATE cache_user SET photo=? WHERE id=?', array('n', $url_id));

	unlink($image_path);
	unlink($thumb_path);

	auto_mail(MODERATOR_ID, $url_id, 'Photo deleted', "Your profile's photo has been deleted/ La photo de votre profil a été supprimé\n\nReason/Raison: ____________________________\n\n".stripslashes($_POST['reason'])."\n\n===========================================\n\n.node Team / L'équipe .node");

	header('Location: /profile/'.$url_id);
}
else
	header('Location: /');
?>
