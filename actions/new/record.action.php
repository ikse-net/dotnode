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


error_log('NEW: '.print_r($_POST, true));

$_POST['fname']=trim(stripslashes($_POST['fname']));
$_POST['lname']=trim(stripslashes($_POST['lname']));
$_POST['nick']=trim(stripslashes($_POST['nick']));


if(strlen($_POST['fname'])>0 && 
   strlen($_POST['lname'])>0 &&
   $_POST['contact']['country'] != '(null)' &&
   strlen($_POST['general']['gender'])>0 &&
   valid_email($_POST['contact']['email']) )
{
	$values['user']['fname'] = $_POST['fname'];
	$values['user']['lname'] = $_POST['lname'];
	$values['user']['nick'] = $_POST['nick'];
	$values['user']['status'] = 'ok';
	if($_SESSION['6nergies_url'])
		$_POST['professional']['6nergies_url'] = $_SESSION['6nergies_url'];
	$access = $_POST['access'];

	unset($_POST['fname']);
	unset($_POST['lname']);
	unset($_POST['nick']);
	unset($_POST['access']);
	unset($_POST['photo']);
	

	foreach($_POST as $key=>$value)
		$values['user_'.$key] = $value;


	foreach($values as $t_name=>$t_values)
	{
		foreach(array_keys($table_fields[$t_name]) as $key)
		{
			if(array_key_exists($key, $t_values) )
			{
				$value = "";
				if(is_array($t_values[$key]) && array_key_exists('Day', $t_values[$key]) && array_key_exists('Month', $t_values[$key]) && array_key_exists('Year', $t_values[$key]) )
					$value = $t_values[$key]['Year'].'-'.$t_values[$key]['Month'].'-'.$t_values[$key]['Day'];
				elseif( is_array($t_values[$key]) )
					$value = implode(",", $t_values[$key]);
				elseif( $t_values[$key] == "(null)" || $t_values[$key] == "" || $t_values[$key] == "http://")
					$value = NULL;
				else
					$value = $t_values[$key];

				if(is_null($value))
					$update_values[$key] = NULL;
				else
					$update_values[$key] = stripslashes($value);
			}
		}

		$result =& $db->autoExecute($t_name, $update_values, DB_AUTOQUERY_UPDATE, "id='".$_SESSION['my_id']."'");
		if (DB::isError($result)) {
		    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getMessage());
		}
		unset($update_values);
	}

	/******************* cache DB ********************************/
	$cache_data = array(
		  'fname' => stripslashes($values['user']['fname']),
		  'lname' => stripslashes($values['user']['lname']),
		  'gender' => $values['user_general']['gender'],
		  'country' => $values['user_contact']['country'],
		  'relationship_status' => $values['user_general']['relationship_status'],
                  'fname_sndex' => $db->getOne('SELECT SOUNDEX(?)', stripslashes($values['user']['fname'])),
          	  'lname_sndex' => $db->getOne('SELECT SOUNDEX(?)', stripslashes($values['user']['lname'])) 
		  );

	if($values['user_general']['here_for'])
		$cache_data['here_for'] = implode(',', $values['user_general']['here_for']);
	

	$result =& $db->autoExecute('cache_user', $cache_data, DB_AUTOQUERY_UPDATE, "id='".$_SESSION['my_id']."'");

	if (DB::isError($result)) {
	    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getUserInfo());
	}
	/******************************************************************/

	$_SESSION['my_fname'] = stripslashes($values['user']['fname']);
	$_SESSION['my_lname'] = stripslashes($values['user']['lname']);
	$_SESSION['status'] = 'member';
	$_SESSION['my_status'] = 'ok';
	
	$cache_user = get_cache_user_info($_SESSION['my_id'], 'country, friends_id, communities_id');
	$_SESSION['my_country'] = $cache_user['country'];
	$_SESSION['my_friends_id'] = $cache_user['friends_id'];
	$_SESSION['my_communities_id'] = $cache_user['communities_id'];

	$_SESSION['nb_new_messages'] = $db->getOne('SELECT COUNT(id_mess) FROM message WHERE id=? AND flag=? AND box=?', array($_SESSION['my_id'], 'new', 'inbox'));
	$_SESSION['nb_new_messages_timestamp'] = time();
	$db->query('UPDATE user SET last_visite=?, status=? WHERE id=?', array(time(), 'ok', $_SESSION['my_id'] ));


	set_acccess_list($_SESSION['my_id'], $access);

	upload_image($_FILES, 'photo', $_SESSION['my_id'], NULL, BASEPATH, "/photos", true,  "/photos/thumb", array(246,255,241));

	header('Location: /my');
}
else
{
	$_SESSION['error']['title'] = _('Form problem');
	$_SESSION['error']['msg'] = _('The submited form is incorrect').".\n"._('You must enter a valid first name, last name, gender and country to validate your registration');
	header('Location: /new/profile');
}

?>
