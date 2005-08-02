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

function upload_image($form_files, $name, $id, $id_image,$path_prefix, $dest_path, $thumb=false, $dest_thumb_path=NULL, $thumb_bg_color = array(255,255,255))
{
	global $db;
	if($form_files)
	{
		$tmp_file = $form_files[$name]['tmp_name'];
		list($width, $height, $type, $attr) = getimagesize($tmp_file);
		switch($type)
		{
		case 3: // PNG
			$src = imagecreatefrompng($tmp_file);
			$ext = "png";
			break; 
		case 2: // JPEG
			$src = imagecreatefromjpeg($tmp_file);
			$ext = "jpeg";
			break;
		case 1: // GIF 
			$src = imagecreatefromgif($tmp_file);
			$ext = "gif";
			break;
		default:
			return 1;
		}
		if($src)
		{
			$elmt[0] = substr($id, 0, 2);
			$elmt[1] = substr($id, 2, 2);
			if($id_image)
				$image_path = $path_prefix.'/'.$dest_path.'/'.$elmt[0].'/'.$elmt[1].'/'.$id_image.'.png';
			else
				$image_path = $path_prefix.'/'.$dest_path.'/'.$elmt[0].'/'.$elmt[1].'/'.$id.'.png';

			@mkdir($path_prefix.'/'.$dest_path.'/'.$elmt[0]);
			@mkdir($path_prefix.'/'.$dest_path.'/'.$elmt[0].'/'.$elmt[1]);

//			$image_path = build_image_path($id, true);
			if($thumb) 
			{
				if($id_image)
					$thumb_path = $path_prefix.'/'.$dest_thumb_path.'/'.$elmt[0].'/'.$elmt[1].'/'.$id_image.'.png';
				else
					$thumb_path = $path_prefix.'/'.$dest_thumb_path.'/'.$elmt[0].'/'.$elmt[1].'/'.$id.'.png';

				@mkdir($path_prefix.'/'.$dest_thumb_path.'/'.$elmt[0]);
	                        @mkdir($path_prefix.'/'.$dest_thumb_path.'/'.$elmt[0].'/'.$elmt[1]);
			}

			$wh_ratio = $width/$height;
			if($wh_ratio>(128/160))
			{
				$dest_width = 128;
				$dest_height = floor($height*128/$width);
			}
			else
			{
				$dest_width = floor($width*160/$height);
				$dest_height = 160;
			}

			if($thumb) 
			{
				$thumb_width = floor($dest_width/2);
				$thumb_height = floor($dest_height/2);
			}
			error_log("w:$width -> $dest_width   /   h:$height -> $dest_height");

			$img = imagecreatetruecolor ($dest_width, $dest_height);
			if($thumb) $thumb = imagecreatetruecolor ($thumb_width, $thumb_height);
			$color_white = imagecolorallocate ( $img, 255,255,255);
			$color_black_alpha = imagecolorallocatealpha ( $img, 0,0,0, 40);
			$color_white_alpha = imagecolorallocatealpha ( $img, 255,255,255, 40);
			$color_white_alpha2 = imagecolorallocatealpha ( $img, 255,255,255, 96);
			$color_white_alpha3 = imagecolorallocatealpha ( $img, 255,255,255, 112);
			$color_black = imagecolorallocate ( $img, 0,0,0);


			$color_bg = imagecolorallocate ( $img, $thumb_bg_color[0], $thumb_bg_color[1], $thumb_bg_color[2]);
                        $color_bg_alpha = imagecolorallocatealpha ( $img, $thumb_bg_color[0], $thumb_bg_color[1], $thumb_bg_color[2], 40);
                        $color_bg_alpha2 = imagecolorallocatealpha ( $img, $thumb_bg_color[0], $thumb_bg_color[1], $thumb_bg_color[2], 96);
                        $color_bg_alpha3 = imagecolorallocatealpha ( $img, $thumb_bg_color[0], $thumb_bg_color[1], $thumb_bg_color[2], 112);


			imagefilledrectangle($img, 0,0, $dest_width, $dest_height,$color_white);
			if($thumb) imagefilledrectangle($thumb, 0,0, $thumb_width, $thumb_height,$color_bg);

			imagecopyresampled($img, $src, 0,0, 0,0, $dest_width,$dest_height, $width,$height);
			if($thumb) imagecopyresampled($thumb, $src, 0,0, 0,0, $thumb_width, $thumb_height, $width,$height);

			imagerectangle($img, 0,0, $dest_width-1, $dest_height-1,$color_white_alpha);
			imagerectangle($img, 1,1, $dest_width-2, $dest_height-2,$color_white_alpha2);
			imagerectangle($img, 2,2, $dest_width-3, $dest_height-3,$color_white_alpha3);

			if($thumb)
			{
				imagerectangle($thumb, 0,0, $thumb_width-1, $thumb_height-1,$color_white_alpha);
				imagerectangle($thumb, 1,1, $thumb_width-2, $thumb_height-2,$color_white_alpha2);
				imagerectangle($thumb, 2,2, $thumb_width-3, $thumb_height-3,$color_white_alpha3);
			}

			imagepng($img, $image_path);
			if($thumb) imagepng($thumb, $thumb_path);

			$db->query('UPDATE user SET photo=? WHERE id=?', array('y', $id));
			$db->query('UPDATE cache_user SET photo=? WHERE id=?', array('y', $id));

	////////////////// Sending an email after added photo ////////////////////
			$text = 'http://'.$config['domain'].'/profile/'.$id;
			if($thumb)
				$file = $thumb_path;
			else
				$file = $image_path;

			$hdrs = array(
				      'From'    => 'moderator-image@dotnode.net',
				      'Subject' => '[dotnode-bot] New image '.$image_path
				      );

			$mime =& Mail::factory('mime', "\n");

			$mime->setTXTBody($text);
			$mime->addAttachment($file, "image/png");

			$body = $mime->get();
			$hdrs = $mime->headers($hdrs);

			$mail =& Mail::factory('mail');
			$mail->send('moderation-image@dotnode.net', $hdrs, $body);
	/////////////////////////////////////////////////////////////////////////
		}
		else
		{
			return 2;
		}


	}
	else
	{
		return 3;
	}
	return $image_path;
}
?>
