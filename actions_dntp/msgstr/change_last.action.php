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


if(is_numeric($token[3]) && is_numeric($_POST['last']) )
{
        $msgid_id = $token[3];
        $id_msgstr = $_POST['last'];
}
else
        die('error');


$db->query('UPDATE dntp_msgstr SET last=? WHERE id=? AND lang=?', array('n', $msgid_id, $_SESSION['my_lang']));

$db->query('UPDATE dntp_msgstr SET last=? WHERE id_msgstr=? AND lang=?', array('y', $id_msgstr, $_SESSION['my_lang']));

header('Location: /history/'.$msgid_id);
?>
