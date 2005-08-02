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


function _sess_open ($save_path, $session_name) {
  global $sess_save_path, $sess_session_name;
      
  $sess_save_path = $save_path;
  $sess_session_name = $session_name;
  return(true);
}

function _sess_close() {
  return(true);
}

function _sess_read ($id) {
  global $sess_save_path, $sess_session_name;

  $elmt[0] = substr($id, 0, 2);
  $elmt[1] = substr($id, 2, 2);
  if(!file_exists($sess_save_path.'/'.$elmt[0].'/'.$elmt[1]) )
  {
    @mkdir($sess_save_path.'/'.$elmt[0]);
    @mkdir($sess_save_path.'/'.$elmt[0].'/'.$elmt[1]);
  }
  $sess_file = $sess_save_path.'/'.$elmt[0].'/'.$elmt[1].'/'.$id;


  if (@filesize($sess_file)>0 && $fp = @fopen($sess_file, "r")) {
   $sess_data = fread($fp, filesize($sess_file));
   return($sess_data);
  } else {
   return(""); // Doit retourner "" ici.
  }

}

function _sess_write ($id, $sess_data) {
  global $sess_save_path, $sess_session_name;

  $elmt[0] = substr($id, 0, 2);
  $elmt[1] = substr($id, 2, 2);
  if(!file_exists($sess_save_path.'/'.$elmt[0].'/'.$elmt[1]) )
  {
    @mkdir($sess_save_path.'/'.$elmt[0]);
    @mkdir($sess_save_path.'/'.$elmt[0].'/'.$elmt[1]);
  }
  $sess_file = $sess_save_path.'/'.$elmt[0].'/'.$elmt[1].'/'.$id;

  if ($fp = @fopen($sess_file, "w")) {
   return(fwrite($fp, $sess_data));
  } else {
   return(false);
  }

}

function _sess_destroy ($id) {
  global $sess_save_path, $sess_session_name;

  $elmt[0] = substr($id, 0, 2);
  $elmt[1] = substr($id, 2, 2);
  if(!file_exists($sess_save_path.'/'.$elmt[0].'/'.$elmt[1]) )
  {
    @mkdir($sess_save_path.'/'.$elmt[0]);
    @mkdir($sess_save_path.'/'.$elmt[0].'/'.$elmt[1]);
  }
  $sess_file = $sess_save_path.'/'.$elmt[0].'/'.$elmt[1].'/'.$id;
 
  return(@unlink($sess_file));
}

/*******************************************************
 * ATTENTION - Vous devrez implémenter un      *
 * collecteur de données obosolètes ici. *
 *******************************************************/
function _sess_gc ($maxlifetime) {
  return true;
}
?>
