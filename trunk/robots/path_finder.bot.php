#!/usr/bin/php
<?
include ('../includes/includes.inc.php');

function apostrofize(&$array)
{
	foreach($array as $item)
        	$array = "'".$item."'";

}

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$path = array();

$all_id = $db->getCol('SELECT id FROM user WHERE status=?',0, 'ok');

foreach($all_id as $id)
{
	unset($delete_array);
	unset($friend_l3);
	$delete_list = "'".$id."'";
	print 'level 0: '.$id."\n";
	$all_id_friends = explode(',', $db->getOne('SELECT friends_id FROM cache_user WHERE id=?',$id));

	foreach($all_id_friends as $id_friend)
		$delete_array[] = "'".$id_friend."'";
	$delete_array[] = "'".$id."'";
	$delete_array = array_unique($delete_array);
	$delete_list = implode(',', $delete_array);

	foreach($all_id_friends as $id_friend)
	{
		print "\tlevel 1: ".$id_friend."\n";
		$all_id_foaf = $db->getCol('SELECT id_friend FROM relation WHERE id=? AND id_friend NOT IN ('.$delete_list.')',0, $id_friend);
		$path[$id][] = $id_friend;
	}

	

        foreach($all_id_foaf as $id_foaf)
                $delete_array[] = "'".$id_foaf."'";
        $delete_array[] = "'".$id."'";
        $delete_array = array_unique($delete_array);
        $delete_list = implode(',', $delete_array);

	foreach($all_id_foaf as $id_foaf)
        {
                print "\t\tlevel 2: ".$id_foaf."\n";
                $all_id_l3 = $db->getCol('SELECT id_friend FROM relation WHERE id=? AND id_friend NOT IN ('.$delete_list.')',0, $id_foaf);
                $friend_l3 = array_merge($friend_l3, $all_id_l3);
		
        }
	if(is_array($friend_l3))
	foreach($friend_l3 as $id3)
		print "\t\t\tl3: $id3\n";

	print "\n";


}

$db->disconnect();
?>
