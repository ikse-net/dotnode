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

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.linkurl.php
 * Purpose:  links URLs und shortens it to $length
 *
 * Author:   Christoph Erdmann <smarty@cerdmann.com>
 * Internet: http://www.cerdmann.com
 *
 * Changelog:
 * 2004-11-24 New parameter allows truncation without linking the URL
 * 2004-11-20 In braces enclosed URLs are now better recognized
 * -------------------------------------------------------------
 */

function smarty_modifier_linkurl($string, $length=35, $link=true)
	{
	if (!function_exists(kuerzen)) {
	function kuerzen($string,$length)
		{
		$returner = $string;
		if (strlen($returner) > $length)
			{
			$url = preg_match("=[^/]/[^/]=",$returner,$treffer,PREG_OFFSET_CAPTURE);
			$cutpos = $treffer[0][1]+2;
			$part[0] = substr($returner,0,$cutpos);
			$part[1] = substr($returner,$cutpos);

			$strlen1 = $cutpos;
			if ($strlen1 > $length) return substr($returner,0,$length-3).'...';
			$strlen2 = strlen($part[1]);
			$cutpos = $strlen2-($length-3-$strlen1);
			$returner = $part[0].'...'.substr($part[1],$cutpos);
			}
		return $returner;
		}
	}

	if ($link == true)
		{
		$pattern = '#(^|[^\"=]{1})(http://|ftp://|mailto:|news:)([^\s<>\)]+)([\s\n<>\)]|$)#sme';
		$string = preg_replace($pattern,"'$1<a href=\"$2$3\" title=\"$2$3\" target=\"_blank\">'.kuerzen('$2$3',$length).'</a>$4'",$string);
		}
	elseif ($link == false)
		{
		$pattern = '#(^|[^\"=]{1})(http://|ftp://|mailto:|news:)([^\s<>\)]+)([\s\n<>\)]|$)#sme';
		$string = preg_replace($pattern,"kuerzen('$2$3',$length)",$string);
		}

	return $string;
	}

?>
