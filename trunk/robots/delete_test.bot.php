#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');


$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$user_sonet['md5'] = $argv[1];

$db->query('DELETE FROM user WHERE id=?', $user_sonet['md5']);

$db->query('DELETE FROM relation WHERE id=?', $user_sonet['md5']);
$db->query('DELETE FROM relation WHERE id_friend=?', $user_sonet['md5']);
$db->query('DELETE FROM user_contact WHERE id=?', $user_sonet['md5']);
$db->query('DELETE FROM user_professional WHERE id=?', $user_sonet['md5']);
$db->query('DELETE FROM user_personal WHERE id=?', $user_sonet['md5']);
$db->query('DELETE FROM user_interests WHERE id=?', $user_sonet['md5']);
$db->query('DELETE FROM settings WHERE id=?', $user_sonet['md5']);
$db->query('DELETE FROM user_general WHERE id=?', $user_sonet['md5']);
$db->query('DELETE FROM cache_user WHERE id=?', $user_sonet['md5']);
$db->query('DELETE FROM album WHERE id=?', $user_sonet['md5']);

$db->query('UPDATE invitation_email SET status=? WHERE id=?', array('doing', $user_sonet['md5']));

$db->disconnect();

?>
