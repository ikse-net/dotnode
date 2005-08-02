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

include(INCLUDESPATH.'/countries_list.inc.php');

unset($labels['profile']['country']['(null)']);


if(!$_SESSION['my_login'])
{
	header('Location: /new');
	exit();
}

if($_SESSION['my_login'] && $_SESSION['my_status']=='ok')
{
        header('Location: /my/profile/general');
        exit();
}


$smarty->assign('Title', 'Profile creation');

$step = array(
	_('You'),
	_('Contact'),
	_('Job'),
	_('Interests'),
	_('Personal'),
	_('Photo'),
	_('Finish'));

$t_name = 'user_general';
$my['general'] =& $db->getRow('SELECT relationship_status ,birthday ,here_for ,children ,gender ,fashion ,smoking ,drinking ,living ,web ,description FROM ! WHERE id=?', array($t_name, $_SESSION['my_id']));
$my['general']['here_for'] = split(',', $my['general']['here_for']);
$my['general']['fashion'] = split(',', $my['general']['fashion']);
$my['general']['living'] = split(',', $my['general']['living']);

if( DB::isError( $my['general'] ) )
        error_log($_SERVER['HTTP_HOST'].' | Erreyr SQL dans '.__FILE__.': '.$my['general']->getMessage());
$access_list[$t_name] = get_access_list($_SESSION['my_id'], $t_name );



$t_name = 'user_contact';
$t_fields = implode(',', array_keys($table_fields[$t_name]));
$my['contact'] =& $db->getRow('SELECT ! FROM ! WHERE id=?', array($t_fields, $t_name, $_SESSION['my_id']));

if( DB::isError($user_contact) )
        error_log($_SERVER['HTTP_HOST'].' | Erreyr SQL dans '.__FILE__.': '.$user_contact->getMessage());
$access_list[$t_name] = get_access_list($_SESSION['my_id'], $t_name );


$t_name = 'user_professional';
$my['professional'] =& $db->getRow('SELECT occupation, industry, company, web, title, description, email, phone FROM ! WHERE id=?', array($t_name, $_SESSION['my_id']));
if( DB::isError($my['professional']) )
        error_log($_SERVER['HTTP_HOST'].' | Erreyr SQL dans '.__FILE__.': '.$my['professional']->getMessage());
$access_list[$t_name] = get_access_list($_SESSION['my_id'], $t_name );


$t_name = 'user_interests';
$t_fields = implode(',', array_keys($table_fields[$t_name]));
$my['interests'] =& $db->getRow('SELECT ! FROM ! WHERE id=?', array($t_fields, $t_name, $_SESSION['my_id']));
if( DB::isError($user_interests) )
        error_log($_SERVER['HTTP_HOST'].' | Erreyr SQL dans '.__FILE__.': '.$user_interests->getMessage());


$my['personal'] =& $db->getRow('SELECT headline ,notice ,size , eye ,hair ,body_art ,best_feature ,things_i_cant_live_without ,ideal_match FROM user_personal WHERE id=?', array($_SESSION['my_id']));
$my['personal']['body_art'] = split(',', $my['personal']['body_art']);
if( DB::isError($user_personal) )
        error_log($_SERVER['HTTP_HOST'].' | Erreyr SQL dans '.__FILE__.': '.$user_personal->getMessage());


$smarty->assign('access_list',$access_list);
$smarty->assign('my', $my);

$smarty->assign('step', $step);

?>
