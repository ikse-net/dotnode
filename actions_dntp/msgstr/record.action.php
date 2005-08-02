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


error_log(print_r($_POST, true));

if(is_numeric($token[3]) && strlen($_POST['msgstr'][0])>0 )
{
	$msgid_id = $token[3];
	$msgstr = $_POST['msgstr'];
	$comment = ($_POST['comment'])?stripslashes($_POST['comment']):NULL;
	$multiline = $_POST['multiline'];
	$multiline = 'y';
}
else
	die('error');

foreach($msgstr as $key=>$msg)
{
	$db->query('UPDATE dntp_msgstr SET last=? WHERE id=? AND lang=? AND `key`=?', array('n', $msgid_id, $_SESSION['my_lang'], $key) );
	$data = array(
			'id' => $msgid_id,
			'`key`' => $key,
			'msgstr' => stripslashes($msg),
			'multiline' => $multiline,
			'lang' => $_SESSION['my_lang'],
			'translator' => $_SESSION['my_login'],
			'status' => 'must_be_verified',
			'last' => 'y',
			'comment' => $comment,
			'date' => time()
		     );

	$rval = $db->autoExecute('dntp_msgstr', $data);
	if(DB::isError($rval))
                error_log($rval->getUserInfo());

	$db->query('INSERT INTO dntp_translator_msgstr SET id=?, id_translator=?', array($msgid_id, $_SESSION['my_id']));
}
header('Location: /my');
?>
