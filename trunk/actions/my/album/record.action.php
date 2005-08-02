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

$albums_values = array();

if(is_numeric($token[4]))
{
	$sql = 'SELECT id_image FROM album WHERE id=? ORDER BY date DESC LIMIT !,1';
	$album =& $db->getRow($sql, array($_SESSION['my_id'], ($token[4]-1)));

	foreach(array_keys($table_fields['album']) as $key)
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
				$albums_values[$key] = NULL;
			else
				$albums_values[$key] = stripslashes($value);

		}
	}

	$where = "id='".$_SESSION['my_id']."' AND id_image='".$album['id_image']."' LIMIT 1";
	$result =& $db->autoExecute('album', $albums_values, DB_AUTOQUERY_UPDATE, $where);
	if (DB::isError($result)) {
	    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getMessage());
	}
}
header('Location: /my/album');

?>
