<?php
/****************************************************** Open .node ***
 * Description:   Configuration template
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


$config['domain'] = 'xxx.dotnode.net';
$config['email'] = 'email_of_a_resp';
$config['admin_login'] = 'admin_login';
$config['admin_ip'] = 'admin_ip';

$dsn = array(
    'phptype'  => 'mysql',
    'username' => '__login__',
    'password' => '__password__',
    'hostspec' => 'localhost',
    'database' => '__db_name__'
);

$dsn_wiki  = array(
    'phptype'  => 'mysql',
    'username' => 'wiki',
    'password' => 'read-only',
    'hostspec' => 'localhost',
    'database' => 'dotnode_wiki'
);

// Get it on http://www.flickr.com/services/api/key.gne
$config['metalbum']['flickr']['api_key'] = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

?>
