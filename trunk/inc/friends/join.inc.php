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

$_SMARTY['Title'] =  'Invite your friends';
$user['info'] = get_cache_user_info($url_id);

$invitation_r = $db->query('SELECT id, fname, lname, email, status, response, date_begin, date_finish, failure_notice FROM invitation_email WHERE id_invit=? ORDER BY status,response,date_begin', array($_SESSION['my_id']) );
while($invitation = $invitation_r->fetchRow())
{
	$invitations[$invitation['id']] = $invitation;
	$invitations[$invitation['id']]['status_str'] = $labels['invitation']['todo'][$invitation['status']];
}

$_SMARTY['user'] =  $user;
$_SMARTY['invitations'] =  $invitations;


?>
