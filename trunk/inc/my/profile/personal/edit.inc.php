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

$smarty->assign('Title', "Edit personal profile");

$my['personal'] =& $db->getRow('SELECT headline ,notice ,size , eye ,hair ,body_art ,best_feature ,things_i_cant_live_without ,ideal_match FROM user_personal WHERE id=?', array($_SESSION['my_id']));
$my['personal']['body_art'] = split(',', $my['personal']['body_art']);

if( DB::isError($user_personal) )
	error_log($_SERVER['HTTP_HOST'].' | Erreyr SQL dans '.__FILE__.': '.$user_personal->getMessage());

$smarty->assign('my', $my);

?>
