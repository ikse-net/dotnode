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

$schools_values = array();

$school =& $db->getRow('SELECT year,name FROM user_schools WHERE id=? ORDER BY `year` LIMIT !,1', array($_SESSION['my_id'], ($token[5]-1)));

foreach(array_keys($table_fields['user_schools']) as $key)
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
                        $schools_values[$key] = NULL;
                else
                        $schools_values[$key] = stripslashes($value);

	}
}

$result =& $db->autoExecute('user_schools', $schools_values, DB_AUTOQUERY_UPDATE, "id='".$_SESSION['my_id']."' AND year='".$school['year']."' AND name=".$db->quote($school['name'])." LIMIT 1");
if (DB::isError($result)) {
    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getUserInfo());
}

header('Location: /my/profile/schools')

?>
