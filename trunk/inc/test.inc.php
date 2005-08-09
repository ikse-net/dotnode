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

phpinfo();
exit();
include "/home/".$config['domain']."/includes/calendar.inc.php";

if($token[1] && $token[2] && $token[3])
	$date = mktime(0,0,0,$token[2], $token[3], $token[1]);
elseif($token[1] && $token[2])
	$date = mktime(0,0,0,$token[2], 1, $token[1]);
else
	$date = time();

$cal =& new dotCal($date, "/test/%04u/%02u/%02u");
$cal->add(time());

$_SMARTY['cal'] =  $cal;

?>
