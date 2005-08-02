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

$menu['pub'] = array(
  'pub'		=> 'Public Section');

$smenu['pub'] = array(
  'join'        => 'Join',
  'help'        => 'Help' );

$menu['error'] = array(
  'pub'        => 'Home',
  'pub/help'   => 'Help' );


$menu['main'] = array(
  'my'          => 'Home',
  'friends'     => 'Friends',
  'communities' => 'Communities',
  'search'      => 'Search',
  'news'        => 'News',
  'help'        => 'Help',
  'support'	=> 'Support',
  'logout'      => 'Logout' );

$smenu['my'] = array(
  'profile' => 'Edit my profile',
  'album' => 'Manage my album',
  'bookmarks' => 'Add bookmarks',
  'blog' => 'Write blog',
  'settings' => 'Settings',
  'password' => 'Change my password' );

$ssmenu['my']['profile'] = array(
  'general' => 'General',
  'interests' => 'Interests',
  'professional' => 'Professional',
  'personal' => 'Personal',
  'schools' => 'Schools',
  'contact' => 'Contact',
  'photo' => 'Photo');

$ssmenu['my']['blog'] = array(
  'add' => 'Write a ticket',
  'categorie' => 'Manage categories' );

$smenu['friends'] = array(
  'join' => 'Invitation',
  'karma' => 'Karma',
  'search' => 'Search');

$smenu['messages'] = array(
  'inbox' => 'Inbox',
  'saved' => 'Saved',
  'sent' => 'Sent',
  'write' => 'Write');

$smenu['communities'] = array(
  'mine' => 'My communities',
  'category' => 'Directory',
  'search' => 'Search',
  'last'   => 'New communities',
  'create' => 'Create your community');

$smenu['news'] = array(
  'blog' => 'Last blog\'s tickets',
  'statistics' => 'Statistics' );

$ssmenu['news']['blog'] = array(
  'friends' => 'View friends\' blogs only');

$smenu['help'] = array(
  'about' => 'About',
  'faq' => 'FAQ',
  'terms' => 'Terms',
  'privacy' => 'Privacy');



?>
