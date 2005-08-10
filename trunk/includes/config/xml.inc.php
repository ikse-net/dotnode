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

define('INCLUDEPATH',BASEPATH.'/../inc_xml');
ini_set('zlib.output_compression', 'off');
ini_set('session.name','dotnodeSessID');
ini_set('session.save_path',BASEPATH.'/../sessions');
include(INCLUDESPATH.'/session_save_handler.inc.php');
session_set_save_handler ("_sess_open", "_sess_close", "_sess_read", "_sess_write", "_sess_destroy", "_sess_gc");
?>
