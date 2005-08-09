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

if(is_numeric($token[1]))
	$msgid_id = $token[1];

$msgid = $db->getRow('SELECT id, msgid, msgid_plural, first_see, multiline, date FROM dntp_msgid WHERE id=?', array($msgid_id));

if(DB::isError($msgid))
	error_log($msg_r->getUserInfo());

$msgstr = $db->getAssoc('SELECT `key`, msgstr, status FROM dntp_msgstr WHERE id=? AND last=? AND lang=?', false, array($msgid_id, 'y', $_SESSION['my_lang']));

if(DB::isError($msgid))
        error_log($msg_r->getUserInfo());


$_SMARTY['msgid'] =  $msgid;
$_SMARTY['msgstr'] =  $msgstr;
?>
