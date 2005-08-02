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
include('../includes/config/xml.inc.php');

$_SERVER['HTTP_HOST'] = ereg_replace(":80$", "", $_SERVER["HTTP_HOST"]);
$requested_site = ereg_replace("^www\.", "", $_SERVER["HTTP_HOST"]);
ereg("(.*)\.dotnode\.com$", $requested_site, $regs);
$login = $regs[1];

$smarty = new Smarty;

$smarty->template_dir = SMARTYPATH.'/templates_xml/';
$smarty->compile_dir = SMARTYPATH.'/templates_c/';
$smarty->config_dir = SMARTYPATH.'/configs/';
$smarty->cache_dir = SMARTYPATH.'/cache/';
$smarty->debugging_ctrl = true;
$smarty->register_modifier('wikise', 'Wikise');
$smarty->compile_id = 'xml';
$smarty->caching = false;
$smarty->cache_lifetime = 3600;
$smarty->use_sub_dirs = true;

ini_set('session.name','dotnodeSessID');
ini_set('session.save_path',BASEPATH.'/../sessions');

include(INCLUDESPATH.'/session_save_handler.inc.php');
session_set_save_handler ("_sess_open", "_sess_close", "_sess_read", "_sess_write", "_sess_destroy", "_sess_gc");

session_start();


if(!$smarty->is_cached('index.tpl', $login.'.'.$_SERVER['PHP_SELF'] ))
{
	$token = retreive_url_info($_SERVER["PHP_SELF"]);
	array_splice($token, 0, 1);

	if(strlen($token[0]) == 32)
		list($url_id) = array_splice($token, 0, 1);

	for($idx=(count($token)-1); $idx>=0; $idx--)
	{
		$inc = "";
		for($level=0; $level<=$idx; $level++)
			$inc .= $token[$level].'/';
		$inc = substr($inc,0,-1).'.inc.php';
		error_log($_SERVER['HTTP_HOST'].' | Include:'.$inc);
		if(file_exists(INCLUDEPATH.'/'.$inc))
			break;
	}

	if(!file_exists(INCLUDEPATH.'/'.$inc) || !ereg("\.inc\.php$", $inc))
		$inc = 'index.inc.php';

	$db =& DB::connect($dsn);
	if (DB::isError($db))
		error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());
	$db->setFetchMode(DB_FETCHMODE_ASSOC);


	$user['info'] =& get_cache_user_info($login);

	if(!$user['info'])
	{
		header('Location: http://'.$config['domain'].'/pub/no-hp');
		exit();
	}

	if(get_setting($user['info']['id'], 'publish') == 'no')
		exit;

	include (INCLUDEPATH.'/'.$inc);

	$db->disconnect();

	// Determination de la template a afficher
	for($idx=(count($token)-1); $idx>=0; $idx--)
	{       
		$tpl = "";
		for($level=0; $level<=$idx; $level++)
			$tpl .= $token[$level].'/';
		$tpl = substr($tpl,0,-1).'.tpl';
		if($smarty->template_exists($tpl))
			break;
	}

	if(!$smarty->template_exists($tpl))
		$tpl='default.tpl';

	$smarty->assign($_SMARTY);
	$smarty->assign('tpl', $tpl);
	$smarty->assign('token', $token);
	$smarty->assign('url_id', $url_id);
	$smarty->assign('profile', $user);
}

if(ereg('\.xul$', $_SERVER['PHP_SELF']))
	header('Content-type: application/vnd.mozilla.xul+xml; charset=UTF-8'); 
elseif(ereg('\.rdf$', $_SERVER['PHP_SELF']))
	header('Content-type: text/rdf; charset=UTF-8'); 
else
	header('Content-type: application/rdf+xml; charset=UTF-8'); 
$smarty->display('index.tpl', $login.'.'.$_SERVER['PHP_SELF']);

?>

