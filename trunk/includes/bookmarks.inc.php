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

function get_sub_cat($id_cat = 0, $array = array(), $level = 0)
{
        global $db;
        global $_SESSION;
        $cats = $db->query('SELECT id_cat, id_cat_parent, name FROM bookmarks_cat WHERE id=? AND id_cat_parent=?', array($_SESSION['my_id'], $id_cat) );
        while($cat = $cats->fetchRow())
        {
                $array[$cat['id_cat']] = str_repeat('+', $level).' '.$cat['name'];
                $array = get_sub_cat($cat['id_cat'], $array, $level+1);
        }
        return $array;
}

function get_cat_path($id_cat, $array = array())
{
        global $db;
        global $_SESSION;
        $cat = $db->getRow('SELECT id_cat, id_cat_parent, name FROM bookmarks_cat WHERE id=? AND id_cat=?',  array($_SESSION['my_id'], $id_cat) );
        array_unshift($array, array($cat['id_cat'], $cat['name']));
        if($cat['id_cat_parent'] != 0)
                return get_cat_path($cat['id_cat_parent'], $array);
        else
                return $array;

}
?>
