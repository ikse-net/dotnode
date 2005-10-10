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
include('../includes/config/global.inc.php');

if(ereg('www', $_SERVER['HTTP_HOST']))
{
        header('Location: http://'.$config['domain'].$_SERVER['PHP_SELF']);
	exit();
}

session_start();

if( array_key_exists('my_id', $_SESSION) && array_key_exists('status', $_SESSION) && $_SESSION['status'] == 'member')
        header('Location: /my');
elseif ( array_key_exists('my_id', $_SESSION) && array_key_exists('status', $_SESSION) && $_SESSION['status'] == 'guest')
	header('Location: /new');
else
        header('Location: /pub');

?>
