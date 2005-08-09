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

include(INCLUDESPATH.'/countries_list.inc.php');

if(is_numeric($token[2]) )
{
	$community['info'] = $db->getRow('SELECT id_comm, id, name, description, moderated, country, date, nb_members, id_cat, status FROM community WHERE id_comm=? AND id=?', array($token[2], $_SESSION['my_id']));
	$community['logo'] = build_logo_url($community['info']['id'], $token[2]);

	$categories_r = $db->query('SELECT id_cat,name,nb_communities FROM community_cat');

	while($categorie = $categories_r->fetchRow())
		$categories[$categorie['id_cat']] = _($categorie['name']).' ('.$categorie['nb_communities'].')';


	/************* menu *******************/
	$leftmenu["/communities/view/".$community['info']['id_comm']] = 'Return to community';

	$leftmenu["/communities/forum/".$community['info']['id_comm']] = 'View forum';
	$leftmenu["/communities/events/".$community['info']['id_comm']] = 'View events';

	$_SMARTY['leftmenu'] = $leftmenu;


	/************************************/


	$_SMARTY['categories'] =  $categories;


	$_SMARTY['Title'] =  'Community';
	$_SMARTY['community'] =  $community;
}
else
{
	header('Location: /communities');
	exit();
}
?>
