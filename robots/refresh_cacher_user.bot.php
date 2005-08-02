#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$db->query('TRUNCATE TABLE cache_user');

$users_r = $db->query('SELECT id, login, fname, lname, photo, join_date  FROM user');
while($user = $users_r->fetchRow())
{
	$user_contact = $db->getRow('SELECT country FROM user_contact WHERE id=?', array($user['id']));
	$user_general = $db->getRow('SELECT gender, relationship_status, here_for, (DATE_FORMAT(CURDATE(), "%Y-%m-%d")-DATE_FORMAT(birthday, "%Y-%m-%d")) as age FROM user_general WHERE id=?', array($user['id']));
	
	$friends_id = $db->getCol('SELECT id_friend FROM relation WHERE id=? ORDER BY last_visit DESC', 0, array($user['id']));
	$communities_id = $db->getCol('SELECT id_comm FROM user_comm WHERE id=?', 0, array($user['id']));

	$karma = $db->getRow('SELECT SUM(fan) as nb_fans, SUM(fun) as fun, SUM(cool) as cool, SUM(sexy) as sexy FROM relation WHERE id_friend=?', array($user['id']));
	
	$nb_bookmarks = $db->getOne('SELECT COUNT(link) FROM bookmarks WHERE id=?', array($user['id']));
	$nb_blogs = $db->getOne('SELECT COUNT(id_blog) FROM blog WHERE id=? AND status=?', array($user['id'], 'online'));
	$nb_photos = $db->getOne('SELECT COUNT(id_image) FROM album WHERE id=?', array($user['id']));

	$cache_values= array(
	'id'=>$user['id'],
	'login'=>$user['login'],
	'fname'=>$user['fname'],
	'lname'=>$user['lname'],
	'age'=>$user_general['age'],
	'photo'=>$user['photo'],
	'country'=>$user_contact['country'],
	'gender'=>$user_general['gender'],
	'relationship_status'=>$user_general['relationship_status'],
	'here_for'=>$user_general['here_for'],
	'nb_friends'=>count($friends_id),
	'friends_id'=>implode(',',$friends_id),
	'nb_communities'=>count($communities_id),
        'communities_id'=>implode(',',$communities_id),
	'nb_fans'=>$karma['nb_fans'],
	'fun'=>$karma['fun'],
	'cool'=>$karma['cool'],
	'sexy'=>$karma['sexy'],
	'nb_bookmarks'=>$nb_bookmarks,
	'nb_blogs'=>$nb_blogs,
	'nb_photos'=>$nb_photos,
	'join_date'=>$user['join_date'],
	'fname_sndex' => $db->getOne('SELECT SOUNDEX(?)', stripslashes($user['fname'])),
        'lname_sndex' => $db->getOne('SELECT SOUNDEX(?)', stripslashes($user['lname'])) 
	);


	$result = $db->autoExecute('cache_user', $cache_values);
	if(DB::isError($result))
		print $result->getUserInfo();

}

$db->disconnect();
?>
