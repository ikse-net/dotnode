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

include('../includes/includes.inc.php');

$token = retreive_url_info($_SERVER['PHP_SELF']);

$nb_arg = count($token);

if($nb_arg == 5)
	$img = array(
		'size' => $token[1],
		'subdir1'=> $token[2],
		'subdir2'=> $token[3],
		'filename' => $token[4],
		'path' => $token[2].'/'.$token[3].'/'.$token[4]
		);

elseif($nb_arg == 4)
	$img = array(
                'size' => null,
		'subdir1' => $token[1],
		'subdir2' => $token[2],
		'filename' => $token[3],
                'path' => $token[1].'/'.$token[2].'/'.$token[3]
		);

if(ereg('x', $img['size']))
{
	list($s1, $s2) = split('x', $img['size']);
	if(is_numeric($s1) && $s1>1)
		$width = $s1;
	else
		$width = 1500;
	if(is_numeric($s2) && $s1>1)
		$height = $s2;
	else
		$height = 1125;
}
elseif(is_numeric($img['size']))
{
	$width = $img['size'];
	$height = 1125;
}
else
{
	unset($img['size']);
}

if(file_exists(ALBUMPATH.'/'.$img['path']))
{
	$real_file = ALBUMPATH.'/'.$img['path'];
}

if(is_null($img['size']) || $img['size']=='0x0' || $img['size']=='0')
{
	header('location: /albums/'.$img['path']);
	exit();
}
elseif(is_numeric($width) && is_numeric($height))
{
	$sized_file = ALBUMSIZEDPATH.'/'.$img['size'].'/'.$img['subdir1'].'_'.$img['subdir2'].'_'.$img['filename'];
}
else
{
	header('Location: /files/pics/nopics.png');
	exit();
}

if($img['path'] && file_exists($real_file))
{
	if(!file_exists($sized_file))
	{
		error_log("$_DOMAIN | Creation du cache pour {$img['path']} en $width x $height");
		if(!is_dir(ALBUMSIZEDPATH.'/'.$img['size']))
			mkdir(ALBUMSIZEDPATH.'/'.$img['size']);
		list($w, $h, $type, $attr) = getimagesize($real_file);
		
		switch($type)
		{
		case 3:
			$src = imagecreatefrompng($real_file);
			$ext = 'png';
			break;
		case 2:
			$src = imagecreatefromjpeg($real_file);
			$ext = 'jpeg';
			break;
		case 1:
			$src = imagecreatefromgif($real_file);
                        $ext = 'gif';
                        break;
		default:
			header('Location: /files/pics/nopics.png');
			exit();
		}
		if($src)
		{
			$wh_ratio = $w/$h;

			if($w > $width || $h > $height)
				if($wh_ratio > $width/$height)
				{
					$image_width = $width;
					$image_height = floor($h*$width/$w);
				}
				else
				{
					$image_width = floor($w*$height/$h);
					$image_height = $height;
				}
			else
			{
				header('location: /photos/'.$real_dest.'/'.$img['path']);
				exit();
			}

			error_log("$_DOMAIN | $real_file - w:$w -> $image_width   /    h:$h -> $image_height path: $sized_file");

			$image = imagecreatetruecolor ($image_width, $image_height);
			$color_white = imagecolorallocate ( $image, 255,255,255);
			imagefilledrectangle($image, 0,0, $image_width, $image_height, $color_white);
			imagecopyresampled($image, $src, 0,0, 0,0, $image_width, $image_height, $w, $h);


			switch($ext)
			{
			case 'jpeg':
				imagejpeg($image, $sized_file);
				break;
			case 'png':
			default:
				imagepng($image, $sized_file);
				break;
			}
		}
	}
	header('Location: /albums/sized/'.$img['size'].'/'.$img['subdir1'].'_'.$img['subdir2'].'_'.$img['filename']);
	exit();
}
else
{
	header('Location: /files/pics/nopics.png');
	exit();
}

?>
