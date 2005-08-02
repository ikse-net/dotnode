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

$blog =& $db->getRow('SELECT id_blog FROM blog WHERE id=? ORDER BY date DESC LIMIT !,1', array($_SESSION['my_id'], ($token[4]-1)));

$ticket_values = array();

foreach(array_keys($table_fields['blog']) as $key)
{
        if(array_key_exists($key, $_POST) )
        {
		$value = "";
                if( is_array($_POST[$key]) )
                        $value = implode(",", $_POST[$key]);
                elseif( $_POST[$key] == "(null)" || $_POST[$key] == "" || $_POST[$key] == "http://")
                        $value = NULL;
                else
                        $value = $_POST[$key];

		if(($key == 'title' || $key=='ticket') && is_null($value))
                {
                        header('Location: /error/11');
                        exit();
                }
                else
                        $ticket_values[$key] = stripslashes($value);

        }
}

$result =& $db->autoExecute('blog', $ticket_values, DB_AUTOQUERY_UPDATE, "id='".$_SESSION['my_id']."' AND id_blog='".$blog['id_blog']."'");
if (DB::isError($result)) {
    error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' '.$result->getMessage());
}

$nb_blog = $db->getOne('SELECT COUNT(id_blog) FROM blog WHERE id=? AND status=?', array($_SESSION['my_id'], 'online'));
$nb_rss_blog = $db->getOne('SELECT COUNT(id_ticket) FROM rss_blog_ticket WHERE id=?', array($_SESSION['my_id']));
$db->query('UPDATE cache_user SET nb_blogs=? WHERE id=?', array($nb_blog+$nb_rss_blog, $_SESSION['my_id']));


header('Location: /my/blog')

?>
