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

// Recuperation du profil general *******************
$t_name = 'user_general';
$user_access['general'] = get_access_list($url_id, $t_name); // Access List *****************************

$t_fields = implode(',', array_keys($table_fields[$t_name]));
$user_general = $db->query('SELECT !  FROM ! WHERE id=?', array($t_fields, $t_name, $url_id) );

if(!DB::isError($user_general) )
{
	$table_info = $user_general->tableInfo();                                       // Recuperation des infos de la table
	$profile = $user_general->FetchRow();                                           // On recupere le profil
	foreach($table_info as $item)                                                   // Pour chaque colonne de la table
	{
		if(  array_key_exists($item['name'], $user_access['general']) && (access_weight($user_access['general'][$item['name']]) <= access_weight($user['relation_type'])  )  )
			continue;
		elseif($profile[$item['name']] == NULL || $profile[$item['name']] == "")    // Si la colonne ne contient rien, on arrete la et on passe aus suivant
			continue;
		elseif($item['type'] == 'date')
		{
			list($year, $month, $day) = explode('-', $profile[$item['name']]);
			$date = getdate(mktime (0,0,0,$month,$day,$year));
			$value = $date['mday'].' '._($date['month']).' '.$date['year'];
		}
		elseif(ereg('set', $item['flags']))                                     // Si c'est un colonne de type 'SET' (liste a choix multiples)
		{
			$translated_thing = array();                                    // declaration du tableau qui va recevoir les chaines traduites
			$things = explode(',', $profile[$item['name']]);                // on separe ce qu'il y a en base dans un tableau $things
			foreach($things as $thing)                                      // pour chaque elements du SET
				array_push($translated_thing, _($labels['profile'][$item['name']][$thing])); // on ajoute dans le tableau $translated_thing la traduction du label de la valeur, trouvé dans labels.inc.php
			$value = implode(", ", $translated_thing);                      // on reforme un truc affichable et on le mets dans $value
		}
		else
		{
			if(array_key_exists( $profile[$item['name']], (array)$labels['profile'][$item['name']]) )
				$value = _($labels['profile'][$item['name']][$profile[$item['name']]]);
			else
				$value = $profile[$item['name']];
											// par defaut, on prend le champs de $profile correspondant a la colonne courante $item['name']
		}

		$key = $table_fields['user_general'][$item['name']];                    // on genere la cle qui sera utilisé dans le tableau exporté a Smarty, ca sera le label traduit a partir du nom de la colonne (trouvé dans labels.inc.php)
		$user['general'][$key] = _($value);                            // enfin, on attribue la valeur trouvé traduite...
	}
}
else
	error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | '.$user_general->getUserInfo());

// Recuperation du profile 'interets'
$t_name = 'user_interests';
$user_access['interests'] = get_access_list($url_id, $t_name); // Access List *****************************

$t_fields = implode(',', array_keys($table_fields[$t_name]));
$user_interests = $db->query('SELECT ! FROM ! WHERE id=?', array($t_fields, $t_name, $url_id) );

if(!DB::isError($user_interests) )
{
	$table_info = $user_interests->tableInfo();                                       // Recuperation des infos de la table
	$profile = $user_interests->FetchRow();                                           // On recupere le profil
	foreach($table_info as $item)                                                   // Pour chaque colonne de la table
	{
		if( isset($user_access['interests']) && array_key_exists($item['name'], $user_access['interests']) && (access_weight($user_access['interests'][$item['name']]) <= access_weight($user['relation_type'])  )  )
			continue;
		elseif($profile[$item['name']] == NULL || $profile[$item['name']] == "")    // Si la colonne ne contient rien, on arrete la et on passe aus suivant
			continue;
		elseif($item['type'] == 'date')
		{
			list($year, $month, $day) = explode('-', $profile[$item['name']]);
			$date = getdate(mktime (0,0,0,$month,$day,$year));
			$value = $date['mday'].' '._($date['month']).' '.$date['year'];
		}
		elseif(ereg('set', $item['flags']))                                     // Si c'est un colonne de type 'SET' (liste a choix multiples)
		{
			$translated_thing = array();                                    // declaration du tableau qui va recevoir les chaines traduites
			$things = explode(',', $profile[$item['name']]);                // on separe ce qu'il y a en base dans un tableau $things
			foreach($things as $thing)                                      // pour chaque elements du SET
				array_push($translated_thing, _($labels['profile'][$item['name']][$thing])); // on ajoute dans le tableau $translated_thing la traduction du label de la valeur, trouvé dans labels.inc.php
			$value = implode(", ", $translated_thing);                      // on reforme un truc affichable et on le mets dans $value
		}
		else
		{
			if(array_key_exists( $profile[$item['name']], (array)$labels['profile'][$item['name']]) )
				$value = _($labels['profile'][$item['name']][$profile[$item['name']]]);
			else
				$value = $profile[$item['name']];
											// par defaut, on prend le champs de $profile correspondant a la colonne courante $item['name']
		}

		$key = $table_fields['user_interests'][$item['name']];                    // on genere la cle qui sera utilisé dans le tableau exporté a Smarty, ca sera le label traduit a partir du nom de la colonne (trouvé dans labels.inc.php)
		$user['interests'][$key] = _($value);                            // enfin, on attribue la valeur trouvé traduite...
	}
}
else
	error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | '.$user_interests->getUserInfo());

// Recuperation du profile contact
$t_name = 'user_contact';
$user_access['contact'] = get_access_list($url_id, $t_name); // Access List *****************************

$t_fields = implode(',', array_keys($table_fields[$t_name]));
$user_contact = $db->query('SELECT ! FROM ! WHERE id=?', array($t_fields, $t_name, $url_id) );

if(!DB::isError($user_contact) )
{
	$table_info = $user_contact->tableInfo();                                       // Recuperation des infos de la table
	$profile = $user_contact->FetchRow();                                           // On recupere le profil
	foreach($table_info as $item)                                                   // Pour chaque colonne de la table
	{
		if(  isset($user_access['contact']) && array_key_exists($item['name'], $user_access['contact']) && (access_weight($user_access['contact'][$item['name']]) <= access_weight($user['relation_type'])  )  )
			continue;
		elseif($profile[$item['name']] == NULL || $profile[$item['name']] == "")    // Si la colonne ne contient rien, on arrete la et on passe aus suivant
			continue;
		elseif($item['type'] == 'date')
		{
			list($year, $month, $day) = explode('-', $profile[$item['name']]);
			$date = getdate(mktime (0,0,0,$month,$day,$year));
			$value = $date['mday'].' '._($date['month']).' '.$date['year'];
		}
		elseif(ereg('set', $item['flags']))                                     // Si c'est un colonne de type 'SET' (liste a choix multiples)
		{
			$translated_thing = array();                                    // declaration du tableau qui va recevoir les chaines traduites
			$things = explode(',', $profile[$item['name']]);                // on separe ce qu'il y a en base dans un tableau $things
			foreach($things as $thing)                                      // pour chaque elements du SET
				array_push($translated_thing, _($labels['profile'][$item['name']][$thing])); // on ajoute dans le tableau $translated_thing la traduction du label de la valeur, trouvé dans labels.inc.php
			$value = implode(", ", $translated_thing);                      // on reforme un truc affichable et on le mets dans $value
		}
		else
		{
			if(array_key_exists( $profile[$item['name']], (array)$labels['profile'][$item['name']]) )
				$value = _($labels['profile'][$item['name']][$profile[$item['name']]]);
			else
				$value = $profile[$item['name']];
											// par defaut, on prend le champs de $profile correspondant a la colonne courante $item['name']
		}

		$user['contact'][$item['name']]['key'] = $table_fields['user_contact'][$item['name']];
		$user['contact'][$item['name']]['value'] = $value;                          // enfin, on attribue la valeur trouvé traduite...

	}
}
else
	error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | '.$user_contact->getUserInfo());
?>
