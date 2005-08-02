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

$community_values = array();

if(strtoupper($_POST['code']).'.jpeg' == $_SESSION['pix_code'])
{
	foreach(array_keys($table_fields['communities']) as $key)
	{
		if(array_key_exists($key, $_POST) )
		{
			$value='';
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
				$_SESSION['error']['title'] = _('Impossible to create your community');
				$_SESSION['error']['msg'] = _('You must enter a valid name, category and description to create your community');
				$_SESSION['error']['post'] = array_map('stripslashes', $_POST);
				header('Location: /communities/create');
				exit();
			}

			if(is_null($value))
				$community_values[$key] = NULL;
			else
				$community_values[$key] = stripslashes($value);

		}
	}

	$community_values['id'] = $_SESSION['my_id'];
	$community_values['date'] = time();

	$result =& $db->autoExecute('community', $community_values, DB_AUTOQUERY_INSERT);
	if (DB::isError($result)) 
	{
		$id_comm = $db->getOne('SELECT id_comm FROM community WHERE name LIKE ?', array($community_values['name']));
                if($id_comm)
                {
                        $_SESSION['error']['title'] = _('Community already exist');
                        $_SESSION['error']['msg'] = _('A community with the same same already exist.');
                }
                else
                {
                        $_SESSION['error']['title'] = _('Unknow error');
                        $_SESSION['error']['msg'] = _('An unknow error arose. <a href="/ReportBogus?url=%2Fcommunities%2Fcreate">Report the problem.</a>');
		error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getMessage());
                }

	}
	elseif($db->affectedRows())
	{
		$db->query('UPDATE community_cat SET nb_communities=nb_communities+1 WHERE id_cat=?', $_POST['id_cat']);

		$id_comm = $db->getOne('SELECT LAST_INSERT_ID()');
		$query_val = array($_SESSION['my_id'], $id_comm);
		$db->query('INSERT INTO user_comm SET id=?, id_comm=?', $query_val);

		$my_comm_id = $db->getCol('SELECT id_comm FROM user_comm WHERE id=?', 0, $_SESSION['my_id']);

		$query_val = array(
			'communities_id' => implode(',', $my_comm_id),
			'nb_communities' => count($my_comm_id) );
		$result =& $db->autoExecute('cache_user', $query_val, DB_AUTOQUERY_UPDATE, "id='".$_SESSION['my_id']."'");
		if (DB::isError($result)) {
			error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getMessage());
		}


		$_SESSION['my_communities_id'] = $my_comm_id;

	// Generating keyword data for search
	
		$array_description = explode(' ', $community_values['description']);
                $array_name = explode(' ', $community_values['name']);

                $array = array_merge($array_description, $array_name);

		foreach($array as $elemt)
		{
			$elemt = ereg_replace("(.*)s$", "\\1", $elemt);
			if(strlen($elemt)>2)
			{
				$sndx = get_mysql_soundex($elemt);
				$db->query('INSERT INTO community_keyword SET key_sndx=?, id_comm=?, id_cat=?', array($sndx, $id_comm, $_POST['id_cat']));
			}
		}


		upload_image($_FILES, 'logo', $_SESSION['my_id'], $id_comm, BASEPATH, '/comm_logos', true,  '/comm_logos/thumb');
	}

	header('Location: /communities/view/'.$id_comm);
}
else
{
	$_SESSION['error']['title'] = _('Verification code failed');
	$_SESSION['error']['msg'] = _('The sent code don\'t match the image');
	$_SESSION['error']['post'] = array_map('stripslashes', $_POST);
	header('Location: /communities/create');
}
?>
