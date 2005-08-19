<?
include_once('../../includes/includes.inc.php');
include_once('XML/Tree.php');

$method_filename = API_REST_METHODPATH.'/'.str_replace('.', '/', $_REQUEST['method']).'.rest.php';

if(file_exists($method_filename)) {
	include_once('DB.php');
	$db =& DB::connect($dsn);
	if (DB::isError($db))
		$error = array(3, 'DB connection error');
	else
	{
		$db->setFetchMode(DB_FETCHMODE_ASSOC);

		if($db->getOne('SELECT COUNT(id) FROM user WHERE id=?', array($_REQUEST['api_key'])) == 1) {
			$xml =& new XML_Tree();
			$rst_node =& $xml->addRoot('rsp', null, array('stat'=>'ok'));

			include $method_filename;
		} else {
			$error = array(69, 'Bad API Key');
		}
		
		$db->disconnect();
	}
} else {
	$error = array(99, 'method '.$_REQUEST['method'].' not found');
}

if(is_array($error)) {
	$xml =& new XML_Tree();
	$rst_node =& $xml->addRoot('rst', null, array('stat'=>'fail'));
	$rst_node->addChild('err', null, array('code'=>$error[0], 'msg'=>$error[1]));
}

header('Content-type: text/xml; charset=UTF-8');

$xml->dump();

?>
