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


if(valid_lang($token[2]))
	$lang = $token[2];
else
	$lang = 'en_US';

setcookie('lang', $lang, time()+31536000, '/', $config['domain']);
setcookie('lang', $lang, time()+31536000, '/');

if(isset($_SESSION['my_id']))
	$db->query('UPDATE user SET lang=? WHERE id=?', array($lang, $_SESSION['my_id']));


if(array_key_exists('HTTP_REFERER', $_SERVER) )
	header('Location: '.$_SERVER['HTTP_REFERER']);
else
	header('Location: /');
?>
