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

/***** modif de l'email **************/
$old_email = $db->getOne('SELECT email FROM user_contact WHERE id=?', array($_SESSION['my_id']));

$new_email = $_POST['email'];
unset($_POST['email']);

if(valid_email($new_email) && $old_email != $new_email)
{
        $db->query('DELETE FROM todo WHERE robot=? AND id=?', array('modif_email', $_SESSION['my_id']) );

        $todo_values= array(
                'robot' => 'modif_email',
                'param' => 'email='.$new_email.'|old_email='.$old_email,
                'id' => $_SESSION['my_id'],
                'ip' => $_SERVER['REMOTE_ADDR'],
                'lang' => $lang,
                'date' => time());
        $db->autoExecute('todo', $todo_values);
}
/*****************************************/

$contact_values = array();

foreach(array_keys($table_fields['user_contact']) as $key)
{
	if(array_key_exists($key, $_POST) )
	{
		$value="";
		if( is_array($_POST[$key]) )
			$value = implode(",", $_POST[$key]);
		elseif( $_POST[$key] == "(null)" || $_POST[$key] == "" || $_POST[$key] == "http://")
			$value = NULL;
		else
			$value = $_POST[$key];

		if(is_null($value))
			$contact_values[$key] = NULL;
		else
			$contact_values[$key] = stripslashes($value);

	}
}

$result =& $db->autoExecute('user_contact', $contact_values, DB_AUTOQUERY_UPDATE, "id='".$_SESSION['my_id']."'");
if (DB::isError($result)) {
error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getMessage());
}

/******************* cache DB ********************************/
$cache_data = array(
          'country' => $contact_values['country']);

$result =& $db->autoExecute('cache_user', $cache_data, DB_AUTOQUERY_UPDATE, "id='".$_SESSION['my_id']."'");
if (DB::isError($result)) {
    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getUserInfo());
}
/******************************************************************/

set_acccess_list($_SESSION['my_id'], $_POST['access']);

if(valid_email($new_email) && $old_email != $new_email)
	header('Location: /my/profile/contact/success');
else
	header('Location: /my/profile/contact');

?>
