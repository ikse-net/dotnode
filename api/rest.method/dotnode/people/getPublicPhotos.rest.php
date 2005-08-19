<?
do {
	if(is_valid('user_id', $_REQUEST['user_id']))
		$user_id = $_REQUEST['user_id'];
	else
	{
		$error = array(1, 'Incorrect user_id');
		break;
	}

	$perpage = ($_REQUEST['per_page']>0)?$_REQUEST['per_page']:15;
	$perpage = ($_REQUEST['per_page']<100)?$perpage:100;
	$current_page = ($_REQUEST['page']>0)?$_REQUEST['page']:1;

	$nb_items = $db->getOne('SELECT COUNT(id_image) FROM album WHERE id=?', array($user_id));

	$nb_pages = ceil($nb_items/$perpage);
	$current_page = ($_REQUEST['page']<$nb_pages)?$current_page:$nb_pages;

	$photos_r = $db->query('SELECT id_image, id, caption, format FROM album WHERE id=? ORDER BY date DESC LIMIT !,!', array($user_id, ($current_page-1)*$perpage, $perpage));

	$photos_node =& $rst_node->addChild('photos', null, array('page' => $current_page, 'pages' => $nb_pages, 'perpage' => $perpage, 'total' => $nb_items));

	$path_photo = substr($user_id, 0,2).'/'.substr($user_id, 2,2);

	if(DB::isError($photos_r)) {
		$error = array(300, 'DB Error');
		break;
	}
	else
		while($photo = $photos_r->fetchRow()) 
			$photos_node->addChild('photo', null, array('id' => $photo['id_image'], 'owner' => $photo['id'], 'title' => htmlspecialchars($photo['caption']), 'path' => $path_photo.'/'.$photo['id_image'], 'format' =>$photo['format']));

} while(0);
?>
