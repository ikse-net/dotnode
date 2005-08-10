<?php
/****************************************************** Open .node ***
 * Description:   
 * Status:        Stable.
 * Author:        Mathieu Pillard <mat@apinc.org>
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

include('Smarty/Smarty.class.php');
include_once('wiki.inc.php');
include('smarty_plugins/block.gettext.php');
include('smarty_plugins/modifier.linkalize.php');
include('smarty_plugins/modifier.linkurl.php');
include('smarty_plugins/function.html_access_options.php');
include('smarty_plugins/modifier.utf8.php');

class Smarty_dotnode extends Smarty
{
	function Smarty_dotnode()
	{
		$this->Smarty();
		
		$this->use_sub_dirs = true;
		$this->debugging_ctrl = false;
		# $smarty->force_compile = true;
		# $smarty->cache_modified_check = true;
		
		$this->template_dir = SMARTYPATH . '/templates/';
		$this->compile_dir  = SMARTYPATH . '/templates_c/';
		$this->config_dir   = SMARTYPATH . '/configs/';
		$this->cache_dir    = SMARTYPATH . '/cache/';
		$this->compile_id   = 'general';
		$this->cache_lifetime = 3600;
		$this->cache        = false;
		
		$this->register_block('t', 'smarty_translate');
		
		$this->register_modifier('wikise', 'Wikise');
		$this->register_modifier('linkurl', 'smarty_modifier_linkurl');
		$this->register_modifier('utf8', 'smarty_modifier_utf8');
		$this->register_function('html_access_options', 'smarty_function_html_access_options');

	}
}

?>
