<?
include(INCLUDESPATH.'/metalbum.class.php');
include(INCLUDESPATH.'/pager.inc.php');


$_SMARTY['user']['info'] = get_cache_user_info($url_id);
$_SMARTY['user']['photo'] = build_image_url($url_id);


if(is_valid('metalbum_name', $token[2]))
	$album_name = $token[2];
else
{
	header('Location: /metalbum/'.$url_id);
	exit();
}

$photo_id = $token[3];

$_SMARTY['Title'] = 'Meta Album: '.$album_name;

list($login, $type) = split('@', $album_name);

$album =& Metalbum::factory($type, $login, $config['metalbum'][$type]);
$_SMARTY['photo'] = $album->getPhotoInfo($photo_id);

$_SMARTY['metalbum']['name'] = $album_name;
$_SMARTY['metalbum']['login'] = $login;
$_SMARTY['metalbum']['type'] = $type;

$_SMARTY['leftmenu']["/profile/$url_id"] = 'Profile';
$_SMARTY['leftmenu']['/metalbum/'.$url_id] = 'Meta Album';
$_SMARTY['leftmenu']['/metalbum/'.$url_id.'/album/'.$album_name] = $album_name;


?>
