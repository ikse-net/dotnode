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

$smarty = new Smarty;

$smarty->template_dir = SMARTYPATH.'/templates/';
$smarty->compile_dir = SMARTYPATH.'/templates_c/';
$smarty->config_dir = SMARTYPATH.'/configs/';
$smarty->cache_dir = SMARTYPATH.'/cache/';

$smarty->compile_id = 'new';

$smarty->debugging_ctrl = true;

$smarty->register_block('t', 'smarty_translate');
$smarty->register_modifier('wikise', 'Wikise');
$smarty->register_function('html_access_options', 'smarty_function_html_access_options');
$smarty->use_sub_dirs = true;

#$smarty->force_compile = true;

$token = retreive_url_info($_SERVER['PHP_SELF']);

session_start();

if(strlen($token[1]) == 32)
	list($url_id) = array_splice($token, 1,1);
else
	$url_id = $_SESSION['my_id'];

if(!$_SESSION['my_id'] && $_SESSION['status'] != 'guest')
{
	header('Location: /pub');
	exit();
}

// Determination de la template d'aide a afficher

for($idx=(count($token)-1); $idx>=0; $idx--)
{
        $help_tpl = "help/";
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



// Determination de l'include PHP a inclure

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

if(!file_exists(INCLUDEPATH.'/'.$inc))
	$inc = 'index.inc.php';


$db =& DB::connect($dsn);
if (DB::isError($db))
        error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());
$db->setFetchMode(DB_FETCHMODE_ASSOC);

include (INCLUDEPATH.'/'.$inc);

$db->disconnect();

// Determination de la template a afficher

for($idx=(count($token)-1); $idx>=0; $idx--)
{
	$tpl = "";
	for($level=0; $level<=$idx; $level++)
		$tpl .= $token[$level].'/';
	$tpl = substr($tpl,0,-1).'.tpl';
//	error_log($_SERVER['HTTP_HOST'].' | Template:'.$tpl);
	if($smarty->template_exists($tpl))
		break;
}

if(!$smarty->template_exists($tpl))
	$tpl='default.tpl';
	

// Exportation des donnees pour Smarty

$smarty->assign('token',$token);
$smarty->assign('menu',$menu['main']);
$smarty->assign('smenu',$smenu[$token[0]]);
$smarty->assign('ssmenu',$ssmenu[$token[0]][$token[1]]);

$smarty->assign('tpl',$tpl);

$smarty->assign('url_id', $url_id);
$smarty->assign('nyrk',$nyrk);
$smarty->assign('labels', $labels);
$smarty->assign('access_fields', $access_fields);
$smarty->assign('lang',$lang);

if($_SERVER['REMOTE_ADDR'] == "82.226.113.191" || $_SERVER['REMOTE_ADDR'] == "81.56.215.231")
{
	$debug['session'] = $_SESSION;
	$smarty->assign('debug', $debug);
	$smarty->assign('php_mem',memory_get_usage()/1024);
	$smarty->assign('inc',$inc);
}

// Affiche du template

error_log($_SERVER['HTTP_HOST'].' | '.$_SERVER['PHP_SELF'].' | '.$_SESSION['my_login']);
header('Content-type: text/html; charset=UTF-8');

// ob_start('ob_gzhandler');

$smarty->display('index_head.tpl', $lang2.'.'.$_SERVER['PHP_SELF']);
$smarty->display($tpl, $lang2.'.'.$_SERVER['PHP_SELF']);
$smarty->display('index_foot.tpl', $lang2.'.'.$_SERVER['PHP_SELF']);

unset($_SESSION['error']);
unset($_SESSION['temp']);
?>
