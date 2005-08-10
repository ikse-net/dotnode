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

include('config.inc.php');

include('Mail.php'); // PEAR

include('DB.php'); // PEAR

include('smarty.inc.php');
include('functions.inc.php');

// To handle difference in PHP_SELF under Apache1 and Apache2
if( ereg("\?", $_SERVER['REQUEST_URI']) )
	list($_SERVER['PHP_SELF']) = split("\?", $_SERVER['REQUEST_URI']);
else
	$_SERVER['PHP_SELF'] = $_SERVER['REQUEST_URI'];

if(valid_lang(normalize_lang($_COOKIE['lang'])))
{
	$lang = normalize_lang($_COOKIE['lang']);
}
elseif($_SERVER['HTTP_ACCEPT_LANGUAGE'])
{
	$accepted_language = get_pref_language_array($_SERVER['HTTP_ACCEPT_LANGUAGE']);
	foreach($accepted_language as $language)
	{
		list($lang) =  split('-',$language);
		if(valid_lang(normalize_lang($lang)))
		{
			$lang = normalize_lang($lang);
			break;
		}
	}
}

if(!isset($lang))
{
	$lang = 'en_US';
}

$nyrk['lang'] = $lang;
$_SMARTY['lang'] = $lang;
putenv("LANG=$lang.UTF-8");

setlocale (LC_TIME, $lang.'.UTF-8');
setlocale (LC_MESSAGES, $lang.'.UTF-8');

# setlocale (LC_TIME, $lang.'.UTF-8');

bindtextdomain('dotnode', LOCALEPATH);
textdomain('dotnode');
bind_textdomain_codeset('dotnode', 'UTF-8');

include('labels.inc.php');
include('menus.inc.php');
include('table_fields.inc.php');
include('access_fields.inc.php');

?>
