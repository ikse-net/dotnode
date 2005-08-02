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

global $_site;

print <<<__FIN__
<!-- SiteSearch Google -->
<form method='get' action='http://www.google.com/search'>
<table style='background: white; border: 1px silver solid;'><tr><td>
<a href='http://www.google.com'>
<img src='http://www.google.com/logos/Logo_40wht.gif' style='border: none' alt='Google' /></a>
</td>
<td>
<input type='text' name='q' size='24' maxlength='255' />
<input type='submit' name='btnG' value='Google Search' style='border: 1px gray outset'/>
<span style='font-size:-1'>
<input type='hidden' name='domains' value='$_site' /><br>
<input type='radio' name='sitesearch' /> WWW <input type='radio' name='sitesearch' value='$_site' checked /> $_site <br>
</span>
</td></tr></table>
</form>
<!-- SiteSearch Google -->
__FIN__;
?>
