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

switch($_SESSION['my_level'])
{
case 'sadmin':
	$waiting_entry_r = $db->query(
'SELECT id, msgid, first_see, date 
 FROM dntp_msgid 
 WHERE status=? 
 ORDER BY date DESC', 
 array('new') 
);

	if(DB::isError($waiting_entry_r))
                error_log($waiting_entry_r->getUserInfo());
        else
                while($waiting_entry =& $waiting_entry_r->fetchRow())
                {
                        $day = date('Ymd', $waiting_entry['date']);
                        if($last_day != $day)
                                $waiting_entry['day'] = $day;
                        $waiting_entries[] = $waiting_entry;
                        $last_day = $day;
                }
	unset($day); unset($last_day);
	$_SMARTY['waiting_entries'] =  $waiting_entries;

	$nb_msgid = $db->getOne('SELECT COUNT(id) FROM dntp_msgid WHERE status=?', array('ok'));
	$list_lang = $db->getCol('SELECT DISTINCT(lang) FROM dntp_translator WHERE status=?', 0, array('ok'));

	foreach($list_lang as $c_lang)
	{
		$nb_msgstr = $db->getOne('SELECT COUNT(id) FROM dntp_msgstr WHERE `key`=? AND last=? AND lang=?', array(0, 'y', $c_lang));
		$avancement[$c_lang] = array('msgid' => $nb_msgid, 'msgstr' => $nb_msgstr, 'score' => $nb_msgstr*100/$nb_msgid);
	}
	$_SMARTY['nb_msgid'] =  $nb_msgid;
	$_SMARTY['avancement'] =  $avancement;
	break;

case 'admin':

	$c_lang = $_SESSION['my_lang'];
	$nb_msgid = $db->getOne('SELECT COUNT(id) FROM dntp_msgid WHERE status=?', array('ok'));
	$nb_msgstr = $db->getOne('SELECT COUNT(id) FROM dntp_msgstr WHERE `key`=? AND last=? AND lang=?', array(0, 'y', $c_lang));
	$avancement[$c_lang] = array('msgid' => $nb_msgid, 'msgstr' => $nb_msgstr, 'score' => $nb_msgstr*100/$nb_msgid);

	$_SMARTY['nb_msgid'] =  $nb_msgid;
	$_SMARTY['avancement'] =  $avancement;


case 'translator':
	$new_entry_r = $db->query(
'SELECT i.id AS id, msgid, first_see, i.date AS date 
 FROM dntp_msgid AS i 
 LEFT JOIN dntp_msgstr AS s 
 USING (id)
 WHERE i.status=? AND (lang<>? OR lang IS NULL) 
 ORDER BY i.date DESC, first_see', 
 array('ok', $_SESSION['my_lang'])
);

	if(DB::isError($new_entry_r))
		error_log($new_entry_r->getUserInfo());
	else
		while($new_entry =& $new_entry_r->fetchRow())
		{
			$day = date('Ymd', $new_entry['date']);
			if($last_day != $day)
				$new_entry['day'] = $day;
			$new_entries[$new_entry['id']] = $new_entry; 
			$last_day = $day;
		}
	unset($day); unset($last_day);

case 'verif':
	$last_modif_r = $db->query(
'SELECT s.id AS id, `key`, msgstr, msgid, comment, first_see, s.date AS date, translator
 FROM dntp_msgstr AS s
 LEFT JOIN dntp_msgid AS i
 USING (id)
 WHERE lang=? AND last=? AND s.status<>?
 ORDER BY date DESC',
 array($_SESSION['my_lang'], 'y', 'ok')
);


	if(DB::isError($last_modif_r))
		error_log($last_modif_r->getUserInfo());
	else
		while($last_modif =& $last_modif_r->fetchRow())
		{
			$day = date('Ymd', $last_modif['date']);
			if($last_day != $day)
				$last_modif['day'] = $day;
			$last_modifs[] = $last_modif;
			$last_day = $day;
			if(isset($new_entries[$last_modif['id']]))
				unset($new_entries[$last_modif['id']]);
		}

	$new_entry_to_delete = $db->getCol(
'SELECT s.id AS id
 FROM dntp_msgstr AS s
 LEFT JOIN dntp_msgid AS i
 USING (id)
 WHERE lang=? AND last=?', 0, 
 array($_SESSION['my_lang'], 'y')
);


        if(DB::isError($new_entry_to_delete))
                error_log($new_entry_to_delete_r->getUserInfo());
        else
                foreach($new_entry_to_delete as $id_to_delete)
                {
                        if(isset($new_entries[$id_to_delete]))
                                unset($new_entries[$id_to_delete]);
                }

	unset($day); unset($last_day);
	$_SMARTY['last_modifs'] =  $last_modifs;
	$_SMARTY['new_entries'] =  $new_entries;
	break;
}
?>
