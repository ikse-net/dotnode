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

$smarty->assign('Title', 'Messages');

/** Pagination ***************/
$pagination['nb_elements'] = $db->getOne('SELECT COUNT(id) FROM message WHERE id=? AND box=?', array($_SESSION['my_id'], 'save') );
$pagination['elmt_by_page'] = 20;

if($pagination['nb_elements'] > 0)
        $pagination['nb_pages'] = ceil($pagination['nb_elements']/$pagination['elmt_by_page']);
else
        $pagination['nb_pages'] = 1;

if(is_numeric($token[2]) && 
   $token[2] <= $pagination['nb_pages'] && 
   $token[2] > 0 )
        $pagination['current_page'] = $token[2];
else
{       
        header('Location: /messages/saved/1');
        exit();
}

$pagination['pages'] = array_fill(1,$pagination['nb_pages'], NULL);

$smarty->assign('pagination', $pagination);
/******************************/


$messages_r = $db->query('SELECT id_mess, id_from, from_str, type, dest, subject, message, flag, date FROM message WHERE id=? AND box=? ORDER by date DESC LIMIT ?,?', array($_SESSION['my_id'],'save', ($pagination['current_page']-1)*$pagination['elmt_by_page'],   $pagination['elmt_by_page']) );

if(!DB::isError($messages_r) )
while($message = $messages_r->fetchRow())
	$messages[$message['id_mess']] = $message;
else
	error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | '.$messages_r->getUserInfo());

$smarty->assign('messages', $messages);

?>
