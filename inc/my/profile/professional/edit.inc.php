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

$smarty->assign('Title', "Edit professional profile");

$t_name = 'user_professional';

$t_name = 'user_professional';
        $t_fields = implode(',', array_keys($table_fields[$t_name]));

        $my['professional'] = $db->getRow('SELECT ! FROM ! WHERE id=?', array($t_fields, $t_name, $_SESSION['my_id']) );

# $my['professional'] =& $db->getRow('SELECT occupation, industry, company, web, title, description, email, phone FROM ! WHERE id=?', array($t_name, $_SESSION['my_id']));

if( DB::isError($my['professional']) )
	error_log($_SERVER['HTTP_HOST'].' | Erreyr SQL dans '.__FILE__.': '.$my['professional']->getMessage());

$access_list[$t_name] = get_access_list($_SESSION['my_id'], $t_name );

$smarty->assign('access_list',$access_list);
$smarty->assign('my', $my);

?>
