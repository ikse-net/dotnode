<?php

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
