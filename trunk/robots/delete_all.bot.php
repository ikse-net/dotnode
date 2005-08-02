#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$tables = array ('access', 'album','blog','blog_categorie','blog_comment','bookmarks','cache_user','community','community_cat','community_event','community_post','community_topic','invitation','message','relation','session','settings', 'todo','user','user_comm','user_contact','user_general','user_interests','user_personal','user_professional','user_schools', 'rss_blog','rss_blog_ticket');

foreach($tables as $table)
	$db->query('DELETE FROM ! WHERE id=?', array($table, $argv[1]) );
$db->query('DELETE FROM relation WHERE id_friend=?', array($argv[1]) );
$db->query('DELETE FROM message WHERE id_from=?', array($argv[1]) );
$db->query('DELETE FROM invitation_email WHERE id_invit=?', array($argv[1]) );
print $user['id'].' '.$user['fname'].' '.$user['lname']."\n";

$db->disconnect();
?>
