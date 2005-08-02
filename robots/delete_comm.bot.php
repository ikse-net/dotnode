#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$tables = array ('blog_comment','community','community_event','community_post','community_topic','invitation','session','settings', 'todo','user_comm', 'rss_blog','rss_blog_ticket');

foreach($tables as $table)
	$db->query('DELETE FROM ! WHERE id=?', array($table, $argv[1]) );
print $user['id'].' '.$user['fname'].' '.$user['lname']."\n";

$db->disconnect();
?>
