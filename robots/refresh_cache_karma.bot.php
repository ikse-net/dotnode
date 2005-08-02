#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$users_r = $db->query('SELECT id FROM user');
while($user = $users_r->fetchRow())
{
	$karma = $db->getRow('SELECT SUM(fan) as nb_fans FROM relation WHERE id_friend=?', array($user['id']));

	$karma['fun'] = get_karma($user['id'], 'fun');
	$karma['cool'] = get_karma($user['id'], 'cool');
	$karma['sexy'] = get_karma($user['id'], 'sexy');
	
	$nb_bookmarks = $db->getOne('SELECT COUNT(link) FROM bookmarks WHERE id=?', array($user['id']) );
	$nb_blogs = $db->getOne('SELECT COUNT(id_blog) FROM blog WHERE id=? AND status=?', array($user['id'], 'online') );
	$nb_blog_rss = $db->getOne('SELECT COUNT(id_ticket) FROM rss_blog_ticket WHERE id=?', array($user['id']) );
	$nb_photos = $db->getOne('SELECT COUNT(id_image) FROM album WHERE id=?', array($user['id']) );


	$cache_values= array(
	'nb_fans'=>$karma['nb_fans'],
	'fun'=> $karma['fun'],
	'cool'=> $karma['cool'],
	'sexy'=> $karma['sexy'],
	'nb_bookmarks'=>$nb_bookmarks,
	'nb_blogs'=>$nb_blogs + $nb_blog_rss,
	'nb_photos'=>$nb_photos
	);


	$result = $db->autoExecute('cache_user', $cache_values, DB_AUTOQUERY_UPDATE, "id='".$user['id']."'");

	$i++;

	if(DB::isError($result))
		print $result->getUserInfo();
	else
		print $i.'. '.$user['id'].' ('.$karma['fun'].'/'.$karma['cool'].'/'.$karma['sexy'].")\n";

}

$db->disconnect();
print "\n";
?>
