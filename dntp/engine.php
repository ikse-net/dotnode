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

include ('../includes/includes.inc.php');
include('../includes/config/dntp.inc.php');


$smarty = new Smarty;

$smarty->template_dir = SMARTYPATH.'/templates_dntp/';
$smarty->compile_dir = SMARTYPATH.'/templates_c/';
$smarty->config_dir = SMARTYPATH.'/configs/';
$smarty->debugging_ctrl = true;
$smarty->register_block('t', 'smarty_translate');

$smarty->compile_id = 'dntp';
$smarty->caching = false;
$smarty->use_sub_dirs = 1;

session_start();

if($_SESSION['my_lang'] == 'fa_IR')
	$_SMARTY['rtl'] = true;

$token = retreive_url_info($_SERVER['PHP_SELF']);

if(!$_SESSION['my_id'] && $token[0] != 'pub')
{
	header('Location: /pub');
	exit();
}

switch($_SESSION['my_status'])
{
	case 'waiting':
		header('Location: /pub');
		exit();
		break;
}

if($token[0] != 'pub' && (!$_SESSION['my_id'] || $_SESSION['SecID'] != $_COOKIE['SecID']  ))
{
	header('Location: /pub?url='.urlencode($_SERVER['PHP_SELF']));
	exit();
}

// Determination de la template d'aide a afficher
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

for($idx=(count($token)-1); $idx>=0; $idx--)
{
	$inc = '';
	for($level=0; $level<=$idx; $level++)
		$inc .= $token[$level].'/';
	$inc = substr($inc,0,-1).'.inc.php';
	//      error_log($_SERVER['HTTP_HOST'].' | Include:'.$inc);
	if(file_exists(INCLUDEPATH.'/'.$inc))
		break;
}

if(!file_exists(INCLUDEPATH.'/'.$inc))
	$inc = 'index.inc.php';

$db=&DB::connect($dsn);
if (DB::isError($db))
	die($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

include (INCLUDEPATH.'/'.$inc);
$db->disconnect();

$_SMARTY['status'] = array('ok', 'new', 'must_be_verified');
$_SMARTY['token'] = $token;

$smarty->assign($_SMARTY);


header('Content-type: text/html; charset=UTF-8');
$smarty->display('index_head.tpl');
$smarty->display($tpl);
$smarty->display('index_foot.tpl');

?>
