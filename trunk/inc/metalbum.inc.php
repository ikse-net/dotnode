<?
include(INCLUDESPATH.'/metalbum.class.php');
include(INCLUDESPATH.'/pager.inc.php');

$_SMARTY['Title'] = 'Meta Album';

$_SMARTY['user']['info'] = get_cache_user_info($url_id);
$_SMARTY['user']['photo'] = build_image_url($url_id);

$metalbumSet =& new MetalbumSet($db, $url_id);
$_SMARTY['metalbumSet'] = $metalbumSet->albums;

$_SMARTY['leftmenu']["/profile/$url_id"] = 'Profile';

?>
