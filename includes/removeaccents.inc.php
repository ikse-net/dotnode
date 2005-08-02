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


function removeaccents($string){
   $Caracs = array("¥" => "Y", "µ" => "u", "À" => "A", "Á" => "A",
                   "Â" => "A", "Ã" => "A", "Ä" => "A", "Å" => "A",
                   "Æ" => "A", "Ç" => "C", "È" => "E", "É" => "E",
                   "Ê" => "E", "Ë" => "E", "Ì" => "I", "Í" => "I",
                   "Î" => "I", "Ï" => "I", "Ð" => "D", "Ñ" => "N",
                   "Ò" => "O", "Ó" => "O", "Ô" => "O", "Õ" => "O",
                   "Ö" => "O", "Ø" => "O", "Ù" => "U", "Ú" => "U",
                   "Û" => "U", "Ü" => "U", "Ý" => "Y", "ß" => "s",
                   "à" => "a", "á" => "a", "â" => "a", "ã" => "a",
                   "ä" => "a", "å" => "a", "æ" => "a", "ç" => "c",
                   "è" => "e", "é" => "e", "ê" => "e", "ë" => "e",
                   "ì" => "i", "í" => "i", "î" => "i", "ï" => "i",
                   "ð" => "o", "ñ" => "n", "ò" => "o", "ó" => "o",
                   "ô" => "o", "õ" => "o", "ö" => "o", "ø" => "o",
                   "ù" => "u", "ú" => "u", "û" => "u", "ü" => "u",
                   "ý" => "y", "ÿ" => "y");

   $string  = strtr("$string", $Caracs);
   return $string;
}


?>
