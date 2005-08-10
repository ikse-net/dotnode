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

$token = retreive_url_info($_SERVER['PHP_SELF']);

session_start();

switch($token[1])
{
case 'insert_user':
	$title = "Probleme d'insertion en base :/";
	$error_msg = "J'ai été prévenu par email et je vais essayer de corriger ca le plus vite possible.<br />Au cas ou, contactez moi sur nyrk&#64;dotnode.com";
	break;
case 'image':
	switch($token[2])
	{
	case 'nothing':
		$title = _('No image sent');
		$error_msg = _('No image found in your request');
		break;
	case 'notfound':
		$title = _('Impossible to create image');
		$error_msg = _('Impossible to manipulate image to create thumbnail');
		break;
	case 'bad_format':
		$title = _('Bad image format');
                $error_msg = _('The format of sent image is not suppoted by .node, only JPEG, PNG and GIF please');
		break;
	}
	break;

case 'no_login':
 	$title = _("Login/password invalid");
	$error_msg = _("Please verify your Login/password.<br />\nIf you have forgot your password, you can retrieve it <a href='/error/forgot_password'>here</a>");
	break;

case 'forgot_password': 	
case 'wrong_login':
	$title = _("Password retrieval");
	
	$send_str = _('Send');
	$enter_your_str = _('Enter your');
	$error_msg = '<h2>'._('Password forgotten').' ?</h2>';
	$error_msg.= _('Fill this form to retrieve your password or your login to .node').'.';
	$error_msg.= <<<___END___
<form action='/action/sendpassword' method='post'>
<label for='param'>$enter_your_str </label><select name='type'><option value='email'>email</option><option value='login'>login</option></select>: <input type='text' name='param' id='param' />
<input type='submit' value='$send_str' />
</form>
___END___;
	if($token[2] == 'success')
		$error_msg.= '<span class="label">'._('You will receive an email in 2 minutes max.').'</span>';
	break;

case 'bad_id':	
	$title = _("Bad ID");
	$error_msg = _("Incorrect ID");
	break;
case 'bad_form':
	$title = _('Bad Form');
	$error_msg = _('You have en arror in the filled form');
	break;

case 'bad_invitation':
	$title = _('Bad invitation');
	$error_msg = _('That invitation link is not valid');
	break;
case 'bad_link':
case 'bad_link1':
case 'bad_link2':
case 'bad_link3':
	$title = _('Bad link');
	$error_msg = _('The link you have used is not valid');
	break;

case 'bad_message':
	$title = _('Bad message');
	$error_msg = _('Your message is not correct');
	break;

case 'bad_new_password':
	$title = _('Bad new password');
	$error_msg = _('Your new password is not valid');
	break;

case 'not_in_community':
	$title = _('Not in community');
	$error_msg = _('You must be in this community to do that');
	break;
case 'unknown_user':
	$title = _('Unknown user');
	$error_msg = _('Unknown user, or user invalid');
	break;

case 'bad_pix_code':
	$title = _('Verification code failed');
	$error_msg = _("The sent code don't match the image");
	break;

default:
	$title = _("Unknown error");
	error_log('ERROR: '.$_SERVER['PHP_SELF']);
	$error_msg = _("An unknown error arose ... contact me to debug this.<br />\nThanks.");
}

if($_SESSION['my_id'])
	$_SMARTY['menu'] = $menu['main'];
else
	$_SMARTY['menu'] = $menu['pub'];

$_SMARTY['token'] = $token;
$_SMARTY['Title'] = $title;
$_SMARTY['errorMsg'] = $error_msg;
$_SMARTY['tpl'] = 'error.tpl';

if($_SERVER['REMOTE_ADDR'] == $config['admin_ip'])
{
        $debug['session'] = $_SESSION;
	$_SMARTY['debug'] = $debug;
	$_SMARTY['lang'] = $lang;
	$_SMARTY['php_mem'] = memory_get_usage()/1024;
	$_SMARTY['inc'] = $inc;
}

$smarty->assign($_SMARTY);

header('Content-type: text/html; charset=UTF-8');

$smarty->display('index.tpl');

?>
