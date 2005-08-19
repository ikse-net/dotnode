<?
do {
	if($_REQUEST['username'])
		$username = label2name($_REQUEST['username']);
	else
	{
		$error = array(2, 'Argument username required');
		break;
	}

	$user = $db->getRow('SELECT id,login FROM user WHERE login=?', array($username));

	if(DB::isError($user)) {
		$error = array(300, 'DB Error');
		break;
	} elseif(sizeof($user) == 0) {
		$error = array(3, 'Unknow username');
		break;
	}
	else {
		$user_node =& $rst_node->addChild('user', null, array('nsid' => $user['id'], 'id' => $user['id']));
		$user_node->addChild('username', $user['login']);
	}

} while(0);
?>
