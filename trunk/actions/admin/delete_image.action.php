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

if($_SESSION['my_login'] == $config['admin_login'])
{
	list($id_image, $ext) = split("\.", basename($_POST['image_path']));
	$image_path = build_album_path($url_id, $id_image, false, $ext); 
	$thumb_path = build_album_thumb_path($url_id, $id_image, false, 'png');;


	$db->query('DELETE FROM album WHERE id=? AND id_image=?', array($url_id, $id_image));
	unlink($image_path);
	unlink($thumb_path);

	auto_mail(MODERATOR_ID, $url_id, 'Album modification', "One photo deleted from your album / Une photo supprimé de votre album\n\nReason/Raison: ____________________________\n\n".stripslashes($_POST['reason'])."\n\n===========================================\n\n.node Team / L'équipe .node");

	$nb_photos = $db->getOne('SELECT COUNT(id_image) FROM album WHERE id=?', array($url_id));

        $cache_values= array(
        	'nb_photos'=>$nb_photos
        );

        $result = $db->autoExecute('cache_user', $cache_values, DB_AUTOQUERY_UPDATE, "id='$url_id'");
        if(DB::isError($result))
                print $result->getUserInfo();

	header('Location: /album/'.$url_id);
}
else
	header('Location: /');
?>
