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

// Recuperation du summary *******************

if($rss_blog = $db->getRow('SELECT id_blog, title, link, rss FROM rss_blog WHERE id=?', array($url_id)) )
{
        $ticket = $db->getRow('SELECT id_ticket, title, description, link, date, description, content FROM rss_blog_ticket WHERE id=? ORDER BY date DESC LIMIT 1', array($url_id));
        $_SMARTY['blog_rss'] = $ticket;
}
else
{
        $blog = $db->getRow('SELECT blog.id as id, id_blog, blog.id_cat,title, chapeau, ticket, date, status, blog_categorie.name as categorie, nb_comments  FROM blog LEFT JOIN blog_categorie USING (id,id_cat) WHERE blog.id=? AND blog.status=? ORDER BY date DESC LIMIT 1', array($url_id, 'online') );
        $_SMARTY['blog'] = $blog;
}

#$blog = $db->getRow('SELECT id_blog, title, chapeau, ticket, nb_comments FROM blog WHERE id=? AND status=? ORDER BY date DESC LIMIT 0,1', array($url_id, 'online'));
#$_SMARTY['blog'] =  $blog;

$bookmarks_r = $db->query('SELECT link, comment FROM bookmarks WHERE id=? ORDER BY date DESC LIMIT 0,4', array($url_id));
while($bookmark = $bookmarks_r->fetchRow())
	$bookmarks[] = $bookmark;
$_SMARTY['bookmarks'] = $bookmarks;

$albums_r = $db->query('SELECT caption,id_image, width, height FROM album WHERE id=? ORDER BY date DESC LIMIT 0,3', array($url_id));
while($photo = $albums_r->fetchRow())
{
	$photo['thumb_path'] = build_album_thumb_url($url_id, $photo['id_image']);
        $albums[] = $photo;
}
$_SMARTY['albums'] = $albums;


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


// Recuperation du profil general *******************
$t_name = 'user_professional';
$user_access['professional'] = get_access_list($url_id, $t_name); // Access List *****************************

$t_fields = implode(',', array_keys($table_fields[$t_name]));
$user_professional = $db->query('SELECT ! FROM ! WHERE id=?', array($t_fields, $t_name, $url_id) );

if(!DB::isError($user_professional) )
{
	$table_info = $user_professional->tableInfo();                                       // Recuperation des infos de la table
	$profile = $user_professional->FetchRow();                                           // On recupere le profil
	foreach($table_info as $item)                                                   // Pour chaque colonne de la table
	{
		if(  array_key_exists($item['name'], $user_access['professional']) && (access_weight($user_access['professional'][$item['name']]) > access_weight($user['relation_type'])  )  )
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

		$key = $table_fields['user_professional'][$item['name']];                    // on genere la cle qui sera utilisé dans le tableau exporté a Smarty, ca sera le label traduit a partir du nom de la colonne (trouvé dans labels.inc.php)
		$user['professional'][$key] = _($value);                            // enfin, on attribue la valeur trouvé traduite...
	}
}
else
	error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | '.$user_professional->getUserInfo());

// Recuperation du profil general *******************
$t_name = 'user_personal';
$user_access['personal'] = get_access_list($url_id, $t_name); // Access List *****************************

$t_fields = implode(',', array_keys($table_fields[$t_name]));
$user_personal = $db->query('SELECT ! FROM ! WHERE id=?', array($t_fields, $t_name, $url_id) );

if(!DB::isError($user_personal) )
{
	$table_info = $user_personal->tableInfo();                                       // Recuperation des infos de la table
	$profile = $user_personal->FetchRow();                                           // On recupere le profil
	foreach($table_info as $item)                                                   // Pour chaque colonne de la table
	{
		if(  array_key_exists($item['name'], $user_access['personal']) && (access_weight($user_access['personal'][$item['name']]) > access_weight($user['relation_type'])  )  )
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

		$key = $table_fields['user_personal'][$item['name']];                    // on genere la cle qui sera utilisé dans le tableau exporté a Smarty, ca sera le label traduit a partir du nom de la colonne (trouvé dans labels.inc.php)
		$user['personal'][$key] = _($value);                            // enfin, on attribue la valeur trouvé traduite...
	}
}
else
	error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | '.$user_personal->getUserInfo());

?>
