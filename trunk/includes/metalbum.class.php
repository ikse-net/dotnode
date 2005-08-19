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

class Metalbum {
	var $code;
	var $message;
	var $status;

	function factory($type, $username, $params) {
		$class = 'Metalbum_'.$type;
		include_once('Metalbum/'.$type.'.class.php');
		$album =& new $class($username, $params);
		if($album->status == 'error')
			return $album->message;
		else
			return $album;
	}
	function _setError($function, $code, $message) {
		$this->code = $code;
		$this->message = $message;
		error_log(__CLASS__.'.'.$function.' | '.$code.': '.$message);
	}

}

class MetalbumSet {
	var $user_id;
	var $db;
	var $albums;
	function MetalbumSet(&$db, $user_id) {
		$this->db = $db;
		$albums_r =& $db->query('SELECT login, type FROM metalbum WHERE id=?', $user_id);
		while($album =& $albums_r->fetchRow()) {
			$this->albums[] = $album;
		}
	}

	function add($login, $type) {
		$res =& $this->db->query('INSET INTO metalbum SET id=?, login=?, type=?', array($this->user_id, $login, $type));
		if(DB::isError($res))
			error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | '.$messages_r->getUserInfo());
	}
}

?>
