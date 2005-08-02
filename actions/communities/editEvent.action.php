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

/*header('Content-type: text/plain');
print_r($_POST)
exit();*/
if(is_numeric($token[3]) )
{
	$title = stripslashes($_POST['title']);
	$details = stripslashes($_POST['details']);
	$country = stripslashes($_POST['country']);
	$city = stripslashes($_POST['city']);
	$location = stripslashes($_POST['location']);
	$date_event = mktime($_POST['date']['Time_Hour'], $_POST['date']['Time_Minute'], 0, $_POST['date']['Date_Month'], $_POST['date']['Date_Day'], $_POST['date']['Date_Year'] );

	if(strlen($_POST['title']) < 1 || strlen($_POST['details']) < 1 || $_POST['country']=='(null)' ) 
	{
		header('Location: /error/event_incorrect');
		exit();
	}

	$event_values = array(
                'author'  => $_SESSION['my_fname'],
                'title'   => $title,
		'details' => $details,
		'location' => $location,
		'city'    => $city,
		'country' => $country,
                'date_event'=> $date_event);
        $result = $db->autoExecute('community_event', $event_values, DB_AUTOQUERY_UPDATE, "id_event='".$token[3]."' AND id='".$_SESSION['my_id']."'");
	if (DB::isError($result))
	        error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getUserInfo());

}

header('Location: /communities/viewEvent/'.$token[3]);
?>
