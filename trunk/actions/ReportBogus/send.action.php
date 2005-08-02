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

if($_POST['url']!="" && $_POST['subject']!="" && $_POST['message']!="")
{
	$message = 'URL: http://'.$config['domain'].stripslashes($_POST['url'])."\n\n";
	$message.= stripslashes($_POST['message']);
	$result = $db->query('INSERT INTO message SET id=?, id_from=?, from_str=?, type=?, dest=?, subject=?, message=?, date=?', array('354a778bacabffaff3d3fd74f93ac278', $_SESSION['my_id'], stripslashes($_SESSION['my_fname']), 'message', 'one', '[BogusReport] '.stripslashes($_POST['subject']), $message, time() ));
	if(DB::isError($result))
		error_log($result->getUserInfo());
}
header('Location: '.$_POST['url']);
?>
