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
include('../includes/config/dntp.inc.php');

session_start();

$token = retreive_url_info($_SERVER["PHP_SELF"]);

error_log($_SERVER['HTTP_HOST'].' | '.$_SERVER['PHP_SELF'].' | '.$_SESSION['my_login']);

        $db =& DB::connect($dsn);
        if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());
        $db->setFetchMode(DB_FETCHMODE_ASSOC);

        for($idx=(count($token)-1); $idx>=0; $idx--)
        {
                $action = "";
                for($level=1; $level<=$idx; $level++)
                        $action .= $token[$level].'/';
                $action = substr($action,0,-1).'.action.php';
                error_log($_SERVER['HTTP_HOST'].' | Include action : '.ACTIONSPATH.'/'.$action);
                if(file_exists(ACTIONSPATH.'/'.$action))
                        break;
        }

        if(file_exists(ACTIONSPATH.'/'.$action) )
                include(ACTIONSPATH.'/'.$action);
        else
        {
                header("HTTP/1.1 403 Forbidden");
                print $_SERVER["PHP_SELF"].": Action forbidden<br />\n";
                if($_SERVER['REMOTE_ADDR'] == $config['admin_ip'])
                        print ACTIONSPATH.'/'.$action;
        }

        $db->disconnect();
?>
