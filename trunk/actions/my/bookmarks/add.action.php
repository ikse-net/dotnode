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

$link_values = array();

foreach(array_keys($table_fields['bookmarks']) as $key)
{
        if(array_key_exists($key, $_POST) )
        {
		$value = '';
                if( is_array($_POST[$key]) )
                        $value = implode(',', $_POST[$key]);
                elseif( $_POST[$key] == '(null)' || $_POST[$key] == '' || $_POST[$key] == 'http://')
                        $value = NULL;
                else
                        $value = $_POST[$key];

		if(is_null($value))
		{
			$_SESSION['error']['title'] = tr('Bad link');
			$_SESSION['error']['msg'] = tr('You must enter a valid link with a description');
			$_SESSION['error']['post'] = array_map('stripslashes', $_POST);
			header('Location: /my/bookmarks');
			exit();
		}
                else
                        $link_values[$key] = stripslashes($value);

        }
}

if(!ereg("^http[s]?://", $link_values['link']) )
	$link_values['link'] = "http://".$link_values['link'];

if($_POST['id_cat'] == 0);

$link_values['id'] = $_SESSION['my_id'];
$link_values['date'] = time();

if($_POST['id_cat'] == 0 && stripslashes(trim($_POST['cat_name'])) )
{
	// record categorie
	$db->query('INSERT INTO bookmarks_cat SET id=?, id_cat_parent=?, name=?', array($_SESSION['my_id'], $_POST['id_cat_parent'], $_POST['cat_name']));
	$link_values['id_cat'] = $db->getOne('SELECT LAST_INSERT_ID()');
}
elseif($_POST['id_cat'] > 0)
	$link_values['id_cat'] = $_POST['id_cat'];
else
{
	$_SESSION['error']['title'] = tr('Error in category');
	$_SESSION['error']['msg'] = tr('The selected category is not correct');
	$_SESSION['error']['post'] = $_POST;
	header('Location: /my/bookmarks');
	exit();
}

$link_values['cat_name'] = $_POST['cat_name'];

$result =& $db->autoExecute('bookmarks', $link_values, DB_AUTOQUERY_INSERT);
if (DB::isError($result)) {
    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getMessage());
}
elseif($db->affectedRows() == 1)
{
	$nb_links = $db->getOne("SELECT COUNT(id) FROM bookmarks WHERE id='".$_SESSION['my_id']."'", array($_SESSION['my_id']));
	$db->query('UPDATE cache_user SET nb_bookmarks=? WHERE id=?', array($nb_links, $_SESSION['my_id']));
}


header('Location: /my/bookmarks')

?>
