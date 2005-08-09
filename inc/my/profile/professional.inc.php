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

$_SMARTY['Title'] = 'Professional Profile';

/*if(!$_SESSION['my_profile_general'])
{*/

	$t_name = 'user_professional';
        $t_fields = implode(',', array_keys($table_fields[$t_name]));

        $user_professional = $db->query('SELECT ! FROM ! WHERE id=?', array($t_fields, $t_name, $_SESSION['my_id']) );

	if(!DB::isError($user_professional) )
	{
		$table_info = $user_professional->tableInfo(); 					// Recuperation des infos de la table
		$profile = $user_professional->FetchRow(); 						// On recupere le profil
		foreach($table_info as $item)							// Pour chaque colonne de la table
		{
			if($profile[$item['name']] == NULL || $profile[$item['name']] == "") 	// Si la colonne ne contient rien, on arrete la et on passe aus suivant
				continue;
			elseif($item['flags'] == 'set')						// Si c'est un colonne de type 'SET' (liste a choix multiples)
			{
				$translated_thing = array();					// declaration du tableau qui va recevoir les chaines traduites
				$things = explode(',', $profile[$item['name']]);		// on separe ce qu'il y a en base dans un tableau $things
				foreach($things as $thing)					// pour chaque elements du SET
					array_push($translated_thing, _($labels['profile'][$item['name']][$thing])); // on ajoute dans le tableau $translated_thing la traduction du label de la valeur, trouvé dans labels.inc.php
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

			$key = $table_fields['user_professional'][$item['name']];			// on genere la cle qui sera utilisé dans le tableau exporté a Smarty, ca sera le label traduit a partir du nom de la colonne (trouvé dans labels.inc.php)
			$my['profile']['professional'][$key] = _($value);				// enfin, on attribue la valeur trouvé traduite...
		}
	}
	else
		error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | '.$user_professional->getUserInfo());

$_SMARTY['my'] = $my;


?>
