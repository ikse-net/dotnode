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

	if(DB::isError($photos_r)) {
		$error = array(300, 'DB Error');
		break;
	}
	else
		$photos_node =& $rst_node->addChild('photos', null, array('total' => $nb_items));

} while(0);
?>
