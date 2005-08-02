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

require "config_server.inc.php";

if(array_key_exists('DOCUMENT_ROOT', $_SERVER) && strlen($_SERVER['DOCUMENT_ROOT']) > 0)
	define('BASEPATH',$_SERVER['DOCUMENT_ROOT']);
elseif(array_key_exists('BASEPATH', $_ENV))
	define('BASEPATH', $_ENV['BASEPATH']);

define('INCLUDESPATH', BASEPATH.'/../includes');

define('ROOTDIR', BASEPATH.'/..');
define('SMARTYPATH',BASEPATH.'/../smarty');

define('PHOTOPATH',BASEPATH.'/photos');
define('THUMBPATH',BASEPATH.'/photos/thumb');
define('COMMLOGOSPATH',BASEPATH.'/comm_logos');

define('LOCALEPATH',BASEPATH.'/../locale');
define('ALBUMPATH',BASEPATH.'/albums');
define('ALBUMTHUMBPATH',BASEPATH.'/albums/thumb');

define('MODERATOR_ID', '00112233445566778899001122334455');

define('ALBUM_THUMB_W', 160);
define('ALBUM_THUMB_H', 160);
define('ALBUM_IMAGE_W', 944);
define('ALBUM_IMAGE_H', 708);

ini_set('register_globals', 'off');
ini_set('error_log', BASEPATH.'/../log/php.log');
?>
