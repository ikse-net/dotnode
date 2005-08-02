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

$smarty->assign('Title', "Edit my settings");

$t_name = 'settings';
$t_fields = implode(',', array_keys($table_fields[$t_name]));

$settings = $db->query('SELECT ! FROM !  WHERE id=?', array($t_fields, $t_name, $_SESSION['my_id']) );

if(!DB::isError($settings) )
{
	$table_info = $settings->tableInfo();                                      // Recuperation des infos de la table
	$my['settings'] = $settings->FetchRow();                                          // On recupere le profil
	foreach($table_info as $item)                                                   // Pour chaque colonne de la table
		if($item['flags'] == 'set')                                         // Si c'est un colonne de type 'SET' (liste a choix multiples)
		{
			$my['settings'][$item['name']] = explode(',', $my['settings'][$item['name']]);                // on separe ce qu'il y a en base dans un tableau $things
		}
}
else
	error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | '.$settings->getUserInfo());

$dir = glob('/home/'.$config['domain'].'/hp/styles/*', GLOB_ONLYDIR);

$css['default'] = 'default';

foreach($dir as $style)
{
	if(basename($style) == 'default')
		continue;
	$css[basename($style)] = basename($style);
}

$smarty->assign('my', $my);
$smarty->assign('css', $css);

?>
