<?
$login = $_POST['login'];
$type = $_POST['type'];

$db->query('INSERT INTO metalbum SET id=?,login=?, type=?', array($_SESSION['my_id'], $login, $type));
header('Location: /metalbum');
?>
