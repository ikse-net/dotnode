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

$settings_values = array();

foreach(array_keys($table_fields['settings']) as $key)
{
	if(array_key_exists($key, $_POST) )
	{
		$value="";
		if( is_array($_POST[$key]) )
			$value = implode(",", $_POST[$key]);
		else
			$value = $_POST[$key];

                $settings_values[$key] = stripslashes($value);

	}
	else
		$settings_values[$key] = "";
}

$result =& $db->autoExecute('settings', $settings_values, DB_AUTOQUERY_UPDATE, "id='".$_SESSION['my_id']."'");
if (DB::isError($result)) {
    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getMessage());
}
if($db->affectedRows() != 1)
{
	$settings_values['id'] = $_SESSION['my_id'];
	$result =& $db->autoExecute('settings', $settings_values);
	if (DB::isError($result)) {
	    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getMessage());
	}

}

header('Location: /my/settings/success')

?>
