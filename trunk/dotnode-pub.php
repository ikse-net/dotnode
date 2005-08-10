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
$smarty->compile_id = 'pub';

$token = retreive_url_info($_SERVER["PHP_SELF"]);

if( array_key_exists('dotnodeSessID', $_COOKIE) )
	session_start();

// Determination de l'include PHP a inclure

for($idx=(count($token)-1); $idx>=0; $idx--)
{
        $inc = "";
        for($level=0; $level<=$idx; $level++)
                $inc .= $token[$level].'/';
        $inc = substr($inc,0,-1).'.inc.php';
        if(file_exists(INCLUDEPATH.'/'.$inc))
                break;
}

if(!file_exists(INCLUDEPATH.'/'.$inc))
	$inc = 'index.inc.php';

include (INCLUDEPATH.'/'.$inc);

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
	

// Exportation des donnees pour Smarty

$_SMARTY['token'] = $token;
$_SMARTY['menu'] = $menu['pub'];
$_SMARTY['smenu'] = $smenu['pub'];

$_SMARTY['tpl'] = $tpl;
$_SMARTY['lang'] = $lang;
// Affiche du template

if($_SERVER['REMOTE_ADDR'] == $config['admin_ip'])
{
        $debug['session'] = $_SESSION;
	$_SMARTY['debug'] = $debug;
	$_SMARTY['php_mem'] = memory_get_usage()/1024;
	$_SMARTY['inc'] = $inc;
}

$smarty->assign($_SMARTY);

header('Content-type: text/html; charset=UTF-8');
// ob_start('ob_gzhandler');

$smarty->display('index_head.tpl');
$smarty->display($tpl);
$smarty->display('index_foot.tpl');

unset($_SESSION['error']);
unset($_SESSION['temp']);

?>
