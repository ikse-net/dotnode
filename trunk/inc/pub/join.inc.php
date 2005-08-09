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

$_SMARTY['Title'] =  'Join';

$db_wiki =& DB::connect($dsn_wiki);
if (DB::isError($db_wiki))
        error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db_wiki->getMessage());
$db_wiki->setFetchMode(DB_FETCHMODE_ASSOC);

$page = $db_wiki->getRow('SELECT UNIX_TIMESTAMP(time) as date, body FROM pages WHERE tag=? AND lang=? AND latest=?', array('DotNodePub'.$token[1], $lang, 'Y'));

if(!$page)
	$page = $db_wiki->getRow('SELECT UNIX_TIMESTAMP(time) as date, body FROM pages WHERE tag=? AND lang=? AND latest=?', array('DotNodePub'.$token[1], 'en_US', 'Y'));


$db_wiki->disconnect();


$_SMARTY['page' ] =  $page;

?>
