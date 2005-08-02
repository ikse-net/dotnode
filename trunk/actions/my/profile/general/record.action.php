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

$general_values = array();

if(trim($_POST['lname']) == "" || trim($_POST['fname']) == "")
{
	header('Location: /error/bad_form');
	exit();
}


foreach(array_keys($table_fields['user_general']) as $key)
{
	if(array_key_exists($key, $_POST) )
	{
		$value = "";
		if(is_array($_POST[$key]) && array_key_exists('Day', $_POST[$key]) && array_key_exists('Month', $_POST[$key]) && array_key_exists('Year', $_POST[$key]) )
			$value = $_POST[$key]['Year'].'-'.$_POST[$key]['Month'].'-'.$_POST[$key]['Day'];
		elseif( is_array($_POST[$key]) )
			$value = implode(",", $_POST[$key]);
		elseif( $_POST[$key] == "(null)" || $_POST[$key] == "" || $_POST[$key] == "http://")
			$value = NULL;
		else
			$value = $_POST[$key];

		if(is_null($value))
			$general_values[$key] = NULL;
		else
			$general_values[$key] = stripslashes($value);
	}
}

$result =& $db->autoExecute('user_general', $general_values, DB_AUTOQUERY_UPDATE, "id='".$_SESSION['my_id']."'");
if (DB::isError($result)) {
    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getMessage());
}

$user_values = array();

foreach(array_keys($table_fields['user']) as $key)
{
        if(array_key_exists($key, $_POST) )
        {
		$value = "";
                if( is_array($_POST[$key]) )
                        $value = implode(",", $_POST[$key]);
                elseif( $_POST[$key] == "(null)" || $_POST[$key] == "" || $_POST[$key] == "http://")
                        $value = NULL;
                else
                        $value = $_POST[$key];

		if(is_null($value))
                        $user_values[$key] = NULL;
                else
                        $user_values[$key] = stripslashes($value);

        }
}

$result =& $db->autoExecute('user', $user_values, DB_AUTOQUERY_UPDATE, "id='".$_SESSION['my_id']."'");
if (DB::isError($result)) {
    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getMessage());
}

/******************* cache DB ********************************/
$cache_data = array(
          'fname' => stripslashes($_POST['fname']),
          'lname' => stripslashes($_POST['lname']),
	  'nick' => stripslashes($_POST['nick']),
          'gender' => $_POST['gender'],
          'relationship_status' => $_POST['relationship_status'],
	  'fname_sndex' => $db->getOne('SELECT SOUNDEX(?)', stripslashes($_POST['fname'])),
	  'lname_sndex' => $db->getOne('SELECT SOUNDEX(?)', stripslashes($_POST['lname'])),
	  'nick_sndex'  => $db->getOne('SELECT SOUNDEX(?)', stripslashes($_POST['nick'])) );

if(is_array($_POST['here_for']))
	$cache_data['here_for'] = implode(',', $_POST['here_for']);

$result =& $db->autoExecute('cache_user', $cache_data, DB_AUTOQUERY_UPDATE, "id='".$_SESSION['my_id']."'");

if (DB::isError($result)) {
    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getUserInfo());
}
/******************************************************************/

$_SESSION['my_fname'] = stripslashes($_POST['fname']);
$_SESSION['my_lname'] = stripslashes($_POST['lname']);
$_SESSION['my_nick'] = stripslashes($_POST['nick']);

set_acccess_list($_SESSION['my_id'], $_POST['access']);

header('Location: /my/profile/general')

?>
