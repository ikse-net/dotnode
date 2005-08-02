<?php
/****************************************************** Open .node ***
 * Description:   Called by the mail server to manage mailer-daemon 
 *                error
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

include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

if($argv[1])
	$id_to_hidde = $argv[1];
elseif($_ENV['DEFAULT'])
	$id_to_hidde = $_ENV['DEFAULT'];
else
	die("no args\n");

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$failure_notice = file_get_contents('php://stdin');

$values = array(
	'status' => 'stop',
	'response' => 'mailproblem',
	'failure_notice' => $failure_notice,
	'date_finish' => time() );

$db->autoExecute('invitation_email', $values, DB_AUTOQUERY_UPDATE, "id='".$id_to_hidde."'");

$db->disconnect();
?>
