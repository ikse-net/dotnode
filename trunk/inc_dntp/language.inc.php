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

$admin_login = $db->getOne('SELECT login FROM dntp_translator WHERE level=? AND status=? AND lang=?', array('admin', 'ok', $_SESSION['my_lang']));

$translators = $db->getCol('SELECT login FROM dntp_translator WHERE status=? AND lang=? AND level=?',0, array('ok',  $_SESSION['my_lang'], 'translator'));
$verificators = $db->getCol('SELECT login FROM dntp_translator WHERE status=? AND lang=? AND level=?',0, array('ok',  $_SESSION['my_lang'], 'verif'));


$stats['nb_msgid'] = $db->getOne('SELECT COUNT(id) FROM dntp_msgid WHERE status=?', array('ok'));
$stats['nb_msgstr'] = $db->getOne('SELECT COUNT(id) FROM dntp_msgstr WHERE last=? AND lang=? AND `key`=?', array('y',  $_SESSION['my_lang'], 0));

$stats['to_complet'] = $stats['nb_msgstr']*100/$stats['nb_msgid'];

$smarty->assign('admin_login', $admin_login);
$smarty->assign('translators', $translators);
$smarty->assign('verificators', $verificators);
$smarty->assign('stats', $stats);


?>
