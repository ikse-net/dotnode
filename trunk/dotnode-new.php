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

$smarty = new Smarty_dotnode;
$smarty->compile_id = 'new';

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
        $_SMARTY['help_tpl'] = $help_tpl;



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

$_SMARTY['token'] = $token;
$_SMARTY['menu'] = $menu['main'];
$_SMARTY['smenu'] = $smenu[$token[0]];
$_SMARTY['ssmenu'] = $ssmenu[$token[0]][$token[1]];

$_SMARTY['tpl'] = $tpl;

$_SMARTY['url_id'] = $url_id;
$_SMARTY['nyrk'] = $nyrk;
$_SMARTY['labels'] = $labels;
$_SMARTY['access_fields'] = $access_fields;
$_SMARTY['lang'] = $lang;

if($_SERVER['REMOTE_ADDR'] == $config['admin_ip'])
{
	$debug['session'] = $_SESSION;
	$_SMARTY['debug'] = $debug;
	$_SMARTY['php_mem'] = memory_get_usage()/1024;
	$_SMARTY['inc'] = $inc;
}

$smarty->assign($_SMARTY);

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
