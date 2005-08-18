<?
if(is_valid('metalbum_name', $token[3])) {
	list($login, $type) = split('@', $token[3]);
	$db->query('DELETE FROM metalbum WHERE id=? AND login=? AND type=?', array($_SESSION['my_id'], $login, $type));
}
header('Location: /metalbum');
?>
