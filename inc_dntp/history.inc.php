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

$msgid = $db->getRow(
'SELECT id, msgid, msgid_plural, first_see, multiline, date 
 FROM dntp_msgid 
 WHERE id=?', 
 array($msgid_id)
);

$history_r = $db->query(
'SELECT id_msgstr, `key`, msgstr, date, last, translator
 FROM dntp_msgstr
 WHERE id=? AND lang=? 
 ORDER BY date DESC', 
 array($msgid_id, $_SESSION['my_lang'])
);

if(DB::isError($history_r))
	error_log($history_r->getUserInfo());
else
	while($history =& $history_r->fetchRow())
	{
		$day = date('Ymd', $history['date']);
		if($last_day != $day)
			$history['day'] = $day;
		$historic[$history['id_msgstr']] = $history; 
		$last_day = $day;
	}
unset($day); unset($last_day);

$smarty->assign('msgid', $msgid);
$smarty->assign('historic', $historic);
?>
