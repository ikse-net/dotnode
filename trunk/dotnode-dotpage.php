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


if(isset($_GET['rush']))
{
	error_log('HACK FROM: '.$_SERVER['REMOTE_ADDR']);
	exit();
}
include('../includes/includes.inc.php');
include('../includes/config/hp.inc.php');

$_SERVER['HTTP_HOST'] = ereg_replace(":80$", '', $_SERVER["HTTP_HOST"]);
$requested_site = ereg_replace("^www\.", '', $_SERVER["HTTP_HOST"]);
ereg("(.*)\.dotnode\.com$", $requested_site, $regs);
$login = $regs[1];

$smarty = new Smarty;

$smarty->template_dir = SMARTYPATH.'/templates_hp/';
$smarty->compile_dir = SMARTYPATH.'/templates_c/';
$smarty->config_dir = SMARTYPATH.'/configs/';
$smarty->cache_dir = SMARTYPATH.'/cache/';
$smarty->debugging_ctrl = false;
$smarty->register_block('t', 'smarty_translate');
$smarty->register_modifier('wikise', 'Wikise');
$smarty->register_modifier('utf8', 'smarty_modifier_utf8');

$smarty->compile_id = 'hp';
$smarty->caching = false;
$smarty->cache_lifetime = 600;
$smarty->cache_modified_check = 1;
$smarty->use_sub_dirs = 1;
if(!$smarty->is_cached('index.tpl', $login.'.'.$lang.'.'.$_SERVER['PHP_SELF'] ))
{
	$token = retreive_url_info($_SERVER["PHP_SELF"]);

	for($idx=(count($token)-1); $idx>=0; $idx--)
	{
		$inc = '';
		for($level=0; $level<=$idx; $level++)
			$inc .= $token[$level].'/';
		$inc = substr($inc,0,-1).'.inc.php';
		error_log($_SERVER['HTTP_HOST'].' | Include:'.$inc);
		if(file_exists(INCLUDEPATH.'/'.$inc))
			break;
	}

	if(!file_exists(INCLUDEPATH.'/'.$inc))
		$inc = 'index.inc.php';

	$db =& DB::connect($dsn);
	if (DB::isError($db))
		die($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());
	$db->setFetchMode(DB_FETCHMODE_ASSOC);


	$user['info'] =& get_cache_user_info($login);
	$user['info']['6nergies_url'] = $db->getOne('SELECT 6nergies_url FROM user_professional WHERE id=?', array($user['info']['id']));


	if(!$user['info']['gender'])
	{
		header('Location: http://'.$config['domain'].'/pub/no-hp');
		exit();
	}

	if(get_setting($user['info']['id'], 'publish') == 'no')
	{
		if (!isset($_SERVER['PHP_AUTH_USER']) ||
		    $_SERVER['PHP_AUTH_USER'] != $user['info']['login'] ||
		    !$db->getRow('SELECT login, status FROM user WHERE login=? AND passwd=PASSWORD(?)',array($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) )
		)
		{
			header('WWW-Authenticate: Basic realm=".Page not published"');
                        header('HTTP/1.0 401 Unauthorized');
                        echo "<h1>Unauthorized</h1>";
                        echo "Your are not authorized to view this .page ... <a href='http://".$config['domain']."'>Go to <b>.node</b></a>";
                        exit;
		}
	}

	include (INCLUDEPATH.'/'.$inc);
	$dotpage_css =  get_setting($user['info']['id'], 'dotpage_css');
	$db->disconnect();

	// Determination de la template a afficher

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

	$_SMARTY['tpl'] = $tpl;
	$_SMARTY['token'] = $token;

	$_SMARTY['profile'] = $user;
	$_SMARTY['dotpage_css'] = $dotpage_css;
}

$dir = glob(ROOTDIR.'/hp/styles/*', GLOB_ONLYDIR);

$css['default'] = 'default';

foreach($dir as $style)
{
        if(basename($style) == 'default')
                continue;
        $css[basename($style)] = basename($style);
}

$_SMARTY['css'] = $css;
$_SMARTY['lang'] = $lang;

$smarty->assign($_SMARTY);

header('Content-type: text/html; charset=UTF-8');
// ob_start('ob_gzhandler');
$smarty->display('index.tpl', $login.'.'.$lang.'.'.$_SERVER['PHP_SELF']);

?>

