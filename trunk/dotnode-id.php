<?php
/****************************************************** Open .node ***
 * Description:   
 * Status:        Stable.
 * Author:        Alexandre Dath <alexandre@dotnode.com>
 * $Id$
 *
 * Copyright (C) 2005 Alexandre Dath <alexandre@dotnode.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software Foundation,
 * Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 ******************** http://opensource.ikse.net/projects/dotnode ***/

include('../includes/includes.inc.php');
include('../includes/config/global.inc.php');

if(ereg('www', $_SERVER['HTTP_HOST']))
{
	header('Location: http://'.$config['domain'].$_SERVER['PHP_SELF']);
	exit();
}

$smarty = new Smarty;

$smarty->template_dir = SMARTYPATH.'/templates/';
$smarty->compile_dir = SMARTYPATH.'/templates_c/';
$smarty->config_dir = SMARTYPATH.'/configs/';
$smarty->cache_dir = SMARTYPATH.'/cache/';

$smarty->compile_id = 'www';

if($_SESSION['my_login'] = 'alexx')
	$smarty->debugging_ctrl = true;

$smarty->register_block('t', 'smarty_translate');
$smarty->register_modifier('wikise', 'Wikise');
$smarty->register_modifier('linkurl', 'smarty_modifier_linkurl');
$smarty->register_modifier('utf8', 'smarty_modifier_utf8');
$smarty->register_function('html_access_options', 'smarty_function_html_access_options');
$smarty->use_sub_dirs = true;
#$smarty->force_compile = true;

$token = retreive_url_info($_SERVER['PHP_SELF']);

$cache_array['/news/blog']['lifetime']		= 7200;
$cache_array['/communities/last']['lifetime']	= 900;
$cache_array['/communities/create']['lifetime']	= 86400;
$cache_array['/communities/category']['lifetime'] = 86400;
$cache_array['/news']['lifetime']		= 3600;
$cache_array['/help/faq']['lifetime']		= 86400;
$cache_array['/help/about']['lifetime']		= 86400;
$cache_array['/help/terms']['lifetime']		= 86400;
$cache_array['/help/privacy']['lifetime']	= 86400;
$cache_array['/news/statistics']['lifetime'] 	= 21600;
$cache_array['/support']['lifetime']	= 86400;
// $cache_array['/search']['lifetime']		= 3600;

if(array_key_exists($_SERVER['PHP_SELF'], $cache_array))
	$smarty->caching = 2;

session_start();

if(strlen($token[1]) == 32)
	list($url_id) = array_splice($token, 1,1);
else
	$url_id = $_SESSION['my_id'];


switch($_SESSION['my_status'])
{
case 'waiting':
	header('Location: /new/profile');
        exit();
	break;
case 'jail':
	header('Location: /pub/join');
	exit();
	break;
}

if(!$_SESSION['my_id'] || $_SESSION['status'] != 'member' || $_SESSION['SecID'] != $_COOKIE['SecID'] )
{
	header('Location: /pub?url='.urlencode($_SERVER['PHP_SELF']));
	error_log('bye');
	exit();
}

// Determination de la template d'aide a afficher

for($idx=(count($token)-1); $idx>=0; $idx--)
{
        $help_tpl = 'help/';
        for($level=0; $level<=$idx; $level++)
                $help_tpl .= $token[$level].'/';
        $help_tpl = substr($help_tpl,0,-1).'.tpl';
        if($smarty->template_exists($help_tpl))
                break;
}

if(!$smarty->template_exists($help_tpl))
        unset($help_tpl);
else
        $smarty->assign('help_tpl', $help_tpl);

for($idx=(count($token)-1); $idx>=0; $idx--)
{
        $tpl = '';
        for($level=0; $level<=$idx; $level++)
                $tpl .= $token[$level].'/';
        $tpl = substr($tpl,0,-1).'.tpl';
        if($smarty->template_exists($tpl))
                break;
}

if(!$smarty->template_exists($tpl))
        $tpl='default.tpl';



// Determination de l'include PHP a inclure
if(!$smarty->is_cached($tpl, $lang.'.'.$_SERVER['PHP_SELF']) || isset($_SESSION['error']) || $_POST )
{	
	for($idx=(count($token)-1); $idx>=0; $idx--)
	{
		$inc = '';
		for($level=0; $level<=$idx; $level++)
			$inc .= $token[$level].'/';
		$inc = substr($inc,0,-1).'.inc.php';
		//	error_log($_SERVER['HTTP_HOST'].' | Include:'.$inc);
		if(file_exists(INCLUDEPATH.'/'.$inc))
			break;
	}

	if(!file_exists(INCLUDEPATH.'/'.$inc))
		$inc = 'index.inc.php';


	$db =& DB::connect($dsn);
	if (DB::isError($db))
		error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());
	$db->setFetchMode(DB_FETCHMODE_ASSOC);

	// regeneration de la session toutes les 30 min
	if($_SESSION['sessionid_timestamp'] < time()-1800 )
	{
		session_regenerate_id();
		$_SESSION['sessionid_timestamp'] = time();
	}

	// Mise a jour de la table session
	if($_SESSION['lastaction_timestamp']<time()-300)
	{
		$_SESSION['lastaction_timestamp'] = time();
		$tmp_result = $db->query('UPDATE session SET timestamp=?, SecID=? WHERE id=?', array($_SESSION['lastaction_timestamp'], $_COOKIE['SecID'], $_SESSION['my_id']) );
		if($db->affectedRows() != 1)
			$db->query('INSERT INTO session SET id=?, SecID=?, timestamp=?', array($_SESSION['my_id'], $_COOKIE['SecID'], $_SESSION['lastaction_timestamp']) );
	}

	if($_SESSION['nb_new_messages_timestamp']+300 < time())
	{
		$_SESSION['nb_new_messages'] = $db->getOne('SELECT COUNT(id_mess) FROM message WHERE id=? AND box=? AND flag=?', array($_SESSION['my_id'], 'inbox', 'new'));
		$_SESSION['nb_new_messages_timestamp'] = time();
		error_log($_SESSION['my_login'].' pop: '.$_SESSION['nb_new_messages'].' ;)');
	}
	include (INCLUDEPATH.'/'.$inc);

	$db->disconnect();
}
else
	error_log('CACHE_DEBUG: '.$_SERVER['PHP_SELF'].', lifetime: '.$cache_array[$_SERVER['PHP_SELF']]['lifetime'].' CACHED !!!');

// Exportation des donnees pour Smarty
$smarty->assign('token',$token);
$smarty->assign('full_smenu',$smenu);
$smarty->assign('full_ssmenu',$ssmenu);

$smarty->assign('menu',$menu['main']);
$smarty->assign('smenu',$smenu[$token[0]]);
$smarty->assign('ssmenu',$ssmenu[$token[0]][$token[1]]);

$smarty->assign('tpl',$tpl);

$smarty->assign('url_id', $url_id);
$smarty->assign('nyrk',$nyrk);
$smarty->assign('labels', $labels);
$smarty->assign('access_fields', $access_fields);

if($_SESSION['my_login'] == 'alexx')
{
	$debug['session'] = $_SESSION;
	$smarty->assign('debug', $debug);
	$smarty->assign('lang',$lang);
	$smarty->assign('php_mem',memory_get_usage()/1024);
	$smarty->assign('inc',$inc);
}

// Affiche du template

error_log($_SERVER['HTTP_HOST'].' | '.$_SERVER['PHP_SELF'].' | '.$_SESSION['my_login']);

header('Content-type: text/html; charset=UTF-8');
// ob_start('ob_gzhandler');

$smarty->caching = false;
$smarty->display('index_head.tpl', $lang.'.'.$_SERVER['PHP_SELF']);

if(array_key_exists($_SERVER['PHP_SELF'], $cache_array) && !isset($_SESSION['error']) && !$_POST )
{
	$smarty->caching=2;
	$smarty->cache_lifetime = $cache_array[$_SERVER['PHP_SELF']]['lifetime'];
	$smarty->display($tpl, $lang.'.'.$_SERVER['PHP_SELF']);
	error_log('CACHE_DEBUG: '.$_SERVER['PHP_SELF'].', lifetime: '.$cache_array[$_SERVER['PHP_SELF']]['lifetime'].' CACHED !!!');
}
else
	$smarty->display($tpl);

$smarty->caching = false;
$smarty->display('index_foot.tpl', $lang.'.'.$_SERVER['PHP_SELF']);

unset($_SESSION['error']);
session_unregister('error');

unset($_SESSION['temp']);
session_unregister('temp');

?>
