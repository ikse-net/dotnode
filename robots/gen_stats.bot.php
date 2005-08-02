#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$nb_nodians = $db->getOne('SELECT COUNT(id) FROM user');
$db->query('UPDATE global_data SET value=? WHERE name=?', array($nb_nodians, 'nb_nodians'));
if($db->affectedRow != 1)
	$db->query('INSERT INTO global_data SET value=?, name=?', array($nb_nodians, 'nb_nodians'));

$info['nb'] = $nb_nodians;
$info['waiting'] = $db->getOne('SELECT COUNT(id) FROM invitation_email WHERE status=? AND date_begin>!', array('doing',time()-(60*24*60*60)));

$info['communities'] = $db->getOne('SELECT COUNT(id) FROM community');
$info['actually'] = $db->getOne('SELECT COUNT(id) FROM session WHERE timestamp>?', array(time()-600));

if($info['actually'] == 0 )
	$info['actually']=1;

$db->query('UPDATE global_data SET value=? WHERE name=?', array($info['actually'], 'actually'));
if($db->affectedRow != 1)
	$db->query('INSERT INTO global_data SET value=?, name=?',  array($info['actually'], 'actually'));


if(DB::isError($todo_r))
	error_log($todo_r->getUserInfo());

print 'nb:'.$info['nb'].
      ' waiting:'.$info['waiting'].
      ' communities:'.$info['communities'].
      ' actually:'.$info['actually'];

$db->disconnect();
?>
