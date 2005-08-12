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

include_once(INCLUDESPATH.'/pager.inc.php');

$_SMARTY['Title'] =  'Messages';

$nb_messages = $db->getOne('SELECT COUNT(id_mess) FROM message WHERE id_from=? AND box=?', array($_SESSION['my_id'],'send'));

$pager =& Pager_dotnode::factory(null, array('totalItems' => $nb_messages));

list($first_item, $last_item) = $pager->getOffsetByPageId();
$limit_offset = $first_item-1;
$limit_length = $last_item-$limit_offset;

$messages_r = $db->query('SELECT id, id_mess, id_from, from_str, type, dest, subject, message, flag, date FROM message WHERE id_from=? AND box=? ORDER by date DESC LIMIT !,!', array($_SESSION['my_id'],'send', $limit_offset, $limit_length) );

$cache=array();

if(!DB::isError($messages_r) )
while($message = $messages_r->fetchRow())
{
	$messages[$message['id_mess']] = $message;
	if($message['dest'] == 'one')
	{
		if(!isset($cache[$message['id']]))
		{
			$to = $db->getRow('SELECT id, fname, lname FROM user WHERE id=?', array($message['id']));
			$cache[$message['id']] = $to;
		}
		$messages[$message['id_mess']]['dest_str'] = $cache[$message['id']]['fname'].' '.$cache[$message['id']]['lname'];
	}
	else
		$messages[$message['id_mess']]['dest_str'] = $labels['message']['dest'][$message['dest']];
}
else
	error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | '.$messages_r->getUserInfo());

$_SMARTY['pager'] = $pager->getLinks();
$_SMARTY['messages'] = $messages;
?>
