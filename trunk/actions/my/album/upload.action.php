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


if($_FILES && $_POST['MAX_FILE_SIZE'] == 500000)
{
	switch($_FILES['image']['error'])
        {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
                $_SESSION['error']['title'] = tr("File size exceeded");
                $_SESSION['error']['msg'] = tr("The file size must be under 500 Kb");

                header('Location: /my/album');
                exit();
                break;
        case UPLOAD_ERR_PARTIAL:
                $_SESSION['error']['title'] = tr("Partial file");
                $_SESSION['error']['msg'] = tr("Upload has been stopped before finish.");

                header('Location: /my/album');
                exit();
                break;

        case UPLOAD_ERR_NO_FILE:
                $_SESSION['error']['title'] = tr("No photo send");
                $_SESSION['error']['msg'] = tr("You must fill the form to upload a photo.");

                header('Location: /my/album');
                exit();
                break;
        }

	$tmp_file = $_FILES['image']['tmp_name'];
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
		$_SESSION['error']['title'] = tr("Bad format");
                $_SESSION['error']['msg'] = tr("The photo format is not supported by .node.");

                header('Location: /my/album');
		exit();
	}
	if($src)
	{
		$wh_ratio = $width/$height;

		$thumb_width = $width;
		$thumb_height = $height;

		$image_width = $width;
		$image_height = $height;

		if($width > ALBUM_THUMB_W || $height > ALBUM_THUMB_H)
			if($wh_ratio > ALBUM_THUMB_W/ALBUM_THUMB_H)
			{
				$thumb_width = ALBUM_THUMB_W;
				$thumb_height = floor($height*ALBUM_THUMB_W/$width);
			}
			else
			{
				$thumb_width = floor($width*ALBUM_THUMB_H/$height);
				$thumb_height = ALBUM_THUMB_H;
			}

		if($width > ALBUM_IMAGE_W || $height > ALBUM_IMAGE_H)
			if($wh_ratio > ALBUM_IMAGE_W/ALBUM_IMAGE_H)
			{
				$image_width = ALBUM_IMAGE_W;
				$image_height = floor($height*ALBUM_IMAGE_W/$width);
			}
			else
			{
				$image_width = floor($width*ALBUM_IMAGE_H/$height);
				$image_height = ALBUM_IMAGE_H;
			}


		error_log("tw:$width -> $thumb_width   /   th:$height -> $thumb_height tp: $thumb_path");
		error_log(" w:$width -> $image_width   /    h:$height -> $image_height ip: $image_path");

		$id_image = insert_image_album($_SESSION['my_id'], $image_width, $image_height, $ext, stripslashes($caption));
		$image_path = build_album_path($_SESSION['my_id'], $id_image, true, $ext);
		$thumb_path = build_album_thumb_path($_SESSION['my_id'], $id_image, true);


		$thumb = imagecreatetruecolor ($thumb_width, $thumb_height);
		$image = imagecreatetruecolor ($image_width, $image_height);

		$color_white = imagecolorallocate ( $thumb, 255,255,255);
		$color_white_alpha = imagecolorallocatealpha ( $thumb, 255,255,255, 40);
		$color_white_alpha2 = imagecolorallocatealpha ( $thumb, 255,255,255, 96);
		$color_white_alpha3 = imagecolorallocatealpha ( $thumb, 255,255,255, 112);

		imagefilledrectangle($thumb, 0,0, $thumb_width, $thumb_height,$color_white);
		imagecopyresampled($thumb, $src, 0,0, 0,0, $thumb_width, $thumb_height, $width,$height);

		imagerectangle($thumb, 0,0, $thumb_width-1, $thumb_height-1,$color_white_alpha);
                imagerectangle($thumb, 1,1, $thumb_width-2, $thumb_height-2,$color_white_alpha2);
                imagerectangle($thumb, 2,2, $thumb_width-3, $thumb_height-3,$color_white_alpha3);

		imagefilledrectangle($image, 0,0, $image_width, $image_height, $color_white);
		imagecopyresampled($image, $src, 0,0, 0,0, $image_width, $image_height, $width, $height);

		imagepng($thumb, $thumb_path);
		switch($ext)
		{
		case 'jpeg':
			imagejpeg($image, $image_path);
			break;
		case 'png':
		case 'gif':
			imagejpeg($image, $image_path);
                        break;
		}
				

////////////////// Sending an email after added photo ////////////////////
		$text = 'URL: http://'.$config['domain'].'/album/'.$_SESSION['my_id'].'/page/1';
		$text.="\ncomment :\n".stripslashes($caption);
		$file = $thumb_path;
		$hdrs = array(
			      'From'    => 'moderator-album@dotnode.net',
			      'Subject' => '[dotnode-bot] New album image from '.$_SESSION['my_login']
			      );

		$mime =& Mail::factory('mime', "\n");

		$mime->setTXTBody($text);
		$mime->addAttachment($file, "image/png");

		$body = $mime->get();
		$hdrs = $mime->headers($hdrs);

		$mail =& Mail::factory('mail');
		$mail->send('moderation-album@dotnode.net', $hdrs, $body);
/////////////////////////////////////////////////////////////////////////

		header("Location: /my/album");
	}
	else
	{
		header("Location: /error/image/notfound");
		exit();
	}


}
else
	header("Location: /error/image/nothing");


?>
