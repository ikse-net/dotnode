#!/usr/bin/php
<?
include ('../includes/includes.inc.php');

$exlude=array();

function apostrofize(&$array)
{
	foreach($array as $item)
        	$array = "'".$item."'";

}

function get_friends($id)
{
	global $db;
	global $exclude;
	$sql = 'SELECT id1, id2 FROM path WHERE id1=? OR id2=?';
	print $sql;
	$result = $db->query($sql, array($id,$id));
	if(DB::isError($result))
		$result->getUserInfo();
	while($line = $result->fetchRow())
	{
		print $line['id1'].','.$line['id2']."\n";
		if($line['id1'] == $id)
			if(!in_array($line['id2'], $exclude))
				$rval[] = $line['id2'];
		else
			if(!in_array($line['id1'], $exclude))
				$rval[] = $line['id1'];
	}

	foreach($rval as $val)
		$exclude[$val] = $val;

	return $rval;
}

function test_link($ids1, $ids2)
{
	$common = array_intersect($ids1, $ids2);
	if(count($common) == 0)
	{
                foreach($ids1 as $id1)
                        $rval[] = get_friends($id1);
                return $rval;
        }
	else
		$common[0];
}

function test_link_r($ids1, $ids2)
{
        $common = array_intersect($ids1, $ids2);
        if(count($common) == 0)
	{
		foreach($ids2 as $id2)
			$rval[] = get_friends($id2);
                return $rval;
	}
        else
                $common[0];
}


function findpath($id1, $id2, $friends=null)
{
	global $exclude;
	$exclude[] = $id1;
	$exclude[] = $id2;

	if(!is_array($id1))
		$id1 = array($id1);
	if(!is_array($id2))
                $id2 = array($id2);

	$rval1 = test_link($id1, $id2);
	if(!is_array($rval1))
		return 'find';	
	else
	{
		$rval2 = test_link_r($id1, $id2);
	}
}

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$path = array();

print_r(get_friends(2));
print_r($exclude);
//print_r(findpath(4,11));

$db->disconnect();
?>
