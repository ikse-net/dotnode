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

/**
 * smarty-gettext.php - Gettext support for smarty
 *
 * ------------------------------------------------------------------------- *
 * This library is free software; you can redistribute it and/or             *
 * modify it under the terms of the GNU Lesser General Public                *
 * License as published by the Free Software Foundation; either              *
 * version 2.1 of the License, or (at your option) any later version.        *
 *                                                                           *
 * This library is distributed in the hope that it will be useful,           *
 * but WITHOUT ANY WARRANTY; without even the implied warranty of            *
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU         *
 * Lesser General Public License for more details.                           *
 *                                                                           *
 * You should have received a copy of the GNU Lesser General Public          *
 * License along with this library; if not, write to the Free Software       *
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA *
 * ------------------------------------------------------------------------- *
 *
 * To register as a smarty block function named 't', use:
 *   $smarty->register_block('t', 'smarty_translate');
 *
 * @package	smarty-gettext
 * @version	$Id: smarty-gettext.php,v 1.1 2004/04/30 11:39:32 sagi Exp $
 * @link	http://smarty-gettext.sf.net/
 * @author	Sagi Bashari <sagi@boom.org.il>
 * @copyright 2004 Sagi Bashari
 */
 
/**
 * Replace arguments in a string with their values. Arguments are represented by % followed by their number.
 *
 * @param	string	Source string
 * @param	mixed	Arguments, can be passed in an array or through single variables.
 * @returns	string	Modified string
 */
function strarg($str)
{
	if(trim($str) == '')
		return '';
	$tr = array();
	$p = 0;

	for ($i=1; $i < func_num_args(); $i++) {
		$arg = func_get_arg($i);
		
		if (is_array($arg)) {
			foreach ($arg as $aarg) {
				$tr['%'.++$p] = $aarg;
			}
		} else {
			$tr['%'.++$p] = $arg;
		}
	}
	
	return strtr($str, $tr);
}

/**
 * Smarty block function, provides gettext support for smarty.
 *
 * The block content is the text that should be translated.
 *
 * Any parameter that is sent to the function will be represented as %n in the translation text, 
 * where n is 1 for the first parameter. The following parameters are reserved:
 *   - escape - sets escape mode:
 *       - 'html' for HTML escaping, this is the default.
 *       - 'js' for javascript escaping.
 *       - 'no'/'off'/0 - turns off escaping
 *   - plural - The plural version of the text (2nd parameter of ngettext())
 *   - count - The item count for plural mode (3rd parameter of ngettext())
 */
function smarty_translate($params, $text, &$smarty)
{
	global $_SESSION;
        global $lang;
	$text = stripslashes($text);
	$text_orig = $text;
//	if($text!='') error_log($text);
	// set escape mode
	if (isset($params['escape'])) {
		$escape = $params['escape'];
		unset($params['escape']);
	}
	
	// set plural version
	if (isset($params['plural'])) {
		$plural = $params['plural'];
		unset($params['plural']);
		
		// set count
		if (isset($params['count'])) {
			$count = $params['count'];
		}
	}
	
	// use plural if required parameters are set
	if (isset($count) && isset($plural)) {
		$text = ngettext($text, $plural, $count);
	} else { // use normal
		$text = gettext($text);
	}

        if($_SESSION['my_login'] == 'calimero' && $lang != 'en_US' && strlen($text_orig)>1 && $text_orig == $text)
        {
		global $dsn;
                $dntp_msgid_data = array(
                        'first_see' => $_SERVER['PHP_SELF'],
			'md5' => md5($text_orig),
                        'msgid' => $text_orig,
			'date' => time()
                        );
		if(isset($plural))
			$dntp_msgid_data['msgid_plural'] = $plural;

		error_log(print_r($dntp_msgid_data, true));
		$db =& DB::connect($dsn);
                $db->autoExecute('dntp_msgid', $dntp_msgid_data);
		if($db->affectedRows>0)
			error_log(print_r($dntp_msgid_data, true));
		$db->disconnect();
        }


	// run strarg if there are parameters
	if (count($params)) {
		$text = strarg($text, $params);
	}

	if (!isset($escape) || $escape == 'html') { // html escape, default
	   $text = nl2br(htmlspecialchars($text));
   } elseif (isset($escape) && ($escape == 'javascript' || $escape == 'js')) { // javascript escape
	   $text = str_replace('\'','\\\'',stripslashes($text));
   }
	return $text;
}

?>
