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


if(is_numeric($token[3]))
{
	$id_cat = $db->getOne('SELECT id_cat FROM community WHERE id=? AND id_comm=?', array($_SESSION['my_id'], $token[3]));

	$community_values = array();

	foreach(array_keys($table_fields['communities']) as $key)
	{
		if(array_key_exists($key, $_POST) )
		{
			$_POST[$key] = trim($_POST[$key]);
			$value="";
			if( is_array($_POST[$key]) )
				$value = implode(",", $_POST[$key]);
			elseif( $_POST[$key] == "(null)" || $_POST[$key] == "" || $_POST[$key] == "http://")
				$value = NULL;
			else
				$value = $_POST[$key];

			if(($key == 'name' || 
			    $key == 'categorie' || 
			    $key == 'moderated' || 
			    $key == 'description' ) &&
			   is_null($value))
			{
				header('Location: /error/record_comm');
				exit();
			}

			if(is_null($value))
				$community_values[$key] = NULL;
			else
				$community_values[$key] = stripslashes($value);

		}
	}

	$result =& $db->autoExecute('community', $community_values, DB_AUTOQUERY_UPDATE, "id='".$_SESSION['my_id']."' AND id_comm='".$token[3]."'");
	if (DB::isError($result))
		error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getMessage());
	elseif($db->affectedRows() == 1)
	{
		$db->query('DELETE FROM community_keyword WHERE id_comm=?', array($token[3]));

		$array_description = explode(' ', $community_values['description']);
		$array_name = explode(' ', $community_values['name']);

		$array = array_merge($array_description, $array_name);

		foreach($array as $elemt)
		{
			$elemt = ereg_replace("(.*)s$", "\\1", $elemt);

			if(strlen($elemt)>2)
			{
				$sndx = get_mysql_soundex($elemt);
				$db->query('INSERT INTO community_keyword SET key_sndx=?, id_comm=?, id_cat=?', array($sndx, $token[3], $id_cat));
			}
		}
		if($id_cat != $community_values['id_cat'])
		{
			$db->query('UPDATE community_cat SET nb_communities=nb_communities-1 WHERE id_cat=?', $id_cat);
			$db->query('UPDATE community_cat SET nb_communities=nb_communities+1 WHERE id_cat=?', $community_values['id_cat']);
		}
	}
	

	upload_image($_FILES, 'logo', $_SESSION['my_id'], $token[3], BASEPATH, "/comm_logos", true,  "/comm_logos/thumb", array(231,255,189));
}

header('Location: /communities/view/'.$token[3]);

?>
