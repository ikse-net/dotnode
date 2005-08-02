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

$smarty->assign('Title','General Profile');

if(!$_SESSION['my_photo'])
{
        if( file_exists(build_image_path($_SESSION['my_id'])) )
                $_SESSION['my_photo'] = build_image_url($_SESSION['my_id']);
}


/*if(!$_SESSION['my_profile_general'])
{*/
	$t_name = 'user_general';
	$t_fields = implode(',', array_keys($table_fields[$t_name]));

	$user_general = $db->query('SELECT ! FROM ! WHERE id=?', array($t_fields, $t_name, $_SESSION['my_id']) );
	if(!DB::isError($user_general) )
	{	
		$table_info = $user_general->tableInfo(); 					// Recuperation des infos de la table
		$profile = $user_general->FetchRow(); 						// On recupere le profil
		foreach($table_info as $item)							// Pour chaque colonne de la table
		{
			if($profile[$item['name']] == NULL || $profile[$item['name']] == "") 	// Si la colonne ne contient rien, on arrete la et on passe aus suivant
				continue;
			elseif($item['type'] == 'date')
			{
				list($year, $month, $day) = explode('-', $profile[$item['name']]);
				$date = getdate(mktime (0,0,0,$month,$day,$year));
				$value = $date['mday'].' '._($date['month']).' '.$date['year'];
			}
			elseif(ereg('set', $item['flags']))					// Si c'est un colonne de type 'SET' (liste a choix multiples)
			{
				$translated_thing = array();					// declaration du tableau qui va recevoir les chaines traduites
				$things = explode(',', $profile[$item['name']]);		// on separe ce qu'il y a en base dans un tableau $things
				foreach($things as $thing)					// pour chaque elements du SET
					array_push($translated_thing, _($labels['profile'][$item['name']][$thing])); // on ajoute dans le tableau $translated_thing la traduction du label de la valeur, trouv� dans labels.inc.php
				$value = implode(", ", $translated_thing);			// on reforme un truc affichable et on le mets dans $value
			}
			else
			{
				if(array_key_exists( $profile[$item['name']], (array)$labels['profile'][$item['name']]) )
					$value = _($labels['profile'][$item['name']][$profile[$item['name']]]);
				else
					$value = $profile[$item['name']];
												// par defaut, on prend le champs de $profile correspondant a la colonne courante $item['name']
			}

			$key = $table_fields['user_general'][$item['name']];			// on genere la cle qui sera utilis� dans le tableau export� a Smarty, ca sera le label traduit a partir du nom de la colonne (trouv� dans labels.inc.php)
			$my['profile']['general'][$key] = _($value);				// enfin, on attribue la valeur trouv� traduite...
		}
	}
	else
		error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | '.$user_general->getUserInfo());

$smarty->assign('my',$my);


?>
