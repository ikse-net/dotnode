<?
do {
	if(is_valid('photo_id', $_REQUEST['photo_id']))
		$photo_id = $_REQUEST['photo_id'];
	else
	{
		$error = array(4, 'Incorrect photo_id');
		break;
	}

	$photo = $db->getRow('SELECT id_image, album.id AS id, album.caption AS caption, user.login AS login, format FROM album LEFT JOIN user USING (id) WHERE id_image=?', array($photo_id));
	$user_id = $photo['id'];
	$path_photo = substr($user_id, 0,2).'/'.substr($user_id, 2,2);
	$photo['path'] = $path_photo.'/'.$photo['id_image'];

	if(DB::isError($photo)) {
		$error = array(300, 'DB Error');
		break;
	}
	else {
		$photo_node =& $rst_node->addChild('photo', null, array('id' => $photo['id_image'], 'path' => $photo['path'], 'format' => $photo['format']));
		$photo_node->addChild('owner', null, array('nsid'=>$photo['id'], 'username' => $photo['login']));
		$photo_node->addChild('title', htmlspecialchars($photo['caption']));
		$photo_node->addChild('description', htmlspecialchars($photo['caption']));
	}

} while(0);
?>
