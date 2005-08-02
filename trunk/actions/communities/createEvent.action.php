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

if(is_numeric($token[3]) )
{
	$is_membre = $db->getOne('SELECT count(id) as nb FROM user_comm WHERE id=? AND status=? AND id_comm=?', array($_SESSION['my_id'], 'ok', $token[3]));
        if($is_membre != 1)
	{
		$_SESSION['error']['title'] = tr('Your are not a member of this community');
                $_SESSION['error']['msg'] = tr('You must subscribe to this community before trying to add event');
		header('Location: /communities/view/'.$token[3]);
		exit();
	}

	$date = time();
	$title = stripslashes($_POST['title']);
	$details = stripslashes($_POST['details']);
	$country = stripslashes($_POST['country']);
	$city = stripslashes($_POST['city']);
	$location = stripslashes($_POST['location']);
	$date_event = mktime($_POST['date']['Time_Hour'], $_POST['date']['Time_Minute'], 0, $_POST['date']['Date_Month'], $_POST['date']['Date_Day'], $_POST['date']['Date_Year'] );
	$date = time();

	if(strlen($_POST['title']) < 1 || strlen($_POST['details']) < 1 || $_POST['country']=='(null)' ) 
	{
		$_POST['date'] = $date_event;
		$_SESSION['error']['title']= tr('Incorrect event');
                $_SESSION['error']['msg']= tr('You must fill the form with: title, date (in the future), and a country.');
		$_SESSION['error']['post'] = array_map('stripslashes', $_POST);
                header('Location: /communities/createEvent/'.$token[3]);
                exit();
	}


	$event_values = array(
                'id' => $_SESSION['my_id'],
                'id_comm' => $token[3],
                'author'  => $_SESSION['my_fname'],
                'title'   => $title,
		'details' => $details,
		'location' => $location,
		'city'    => $city,
		'country' => $country,
                'date_event'=> $date_event,
                'date' => $date);
        $result = $db->autoExecute('community_event', $event_values, DB_AUTOQUERY_INSERT);
	if (DB::isError($result))
	        error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getUserInfo());

}

header('Location: /communities/view/'.$token[3]);
?>
