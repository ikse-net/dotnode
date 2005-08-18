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

$_SMARTY['Title'] = 'Meta Album: '.$album_name;

list($login, $type) = split('@', $album_name);

$album =& Metalbum::factory($type, $login, $config['metalbum'][$type]);
if(is_a($album,'Metalbum'))
{
	$_SMARTY['photos'] = $album->getPhotos($_GET['p'], 18);
	$_SMARTY['metalbum']['name'] = $album_name;
	$_SMARTY['metalbum']['login'] = $login;
	$_SMARTY['metalbum']['type'] = $type;
	$_SMARTY['metalbum']['url'] = $album->getUrlAlbum();

	$pager =& Pager_dotnode::factory (null, array('perPage' => 18, 'totalItems' => $album->getNbItems()) );
	$_SMARTY['pager'] = $pager->getLinks();
}
else
{
	$_SESSION['error']['title'] = _('Error in connection with remote album');
	$_SESSION['error']['msg'] = $type.': '.$album;
}
$metalbumSet =& new MetalbumSet($db, $url_id);

$_SMARTY['leftmenu']["/profile/$url_id"] = 'Profile';
$_SMARTY['leftmenu']['/metalbum/'.$url_id] = 'Meta Album';
foreach($metalbumSet->albums as $albumset)
	$_SMARTY['leftmenu']['/metalbum/'.$url_id.'/album/'.$albumset['login'].'@'.$albumset['type']] = $albumset['login'].'@'.$albumset['type'];


?>
