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

$labels['yesno'] = array(
	'yes' => tr('Yes'), 
	'no' => tr('No') );

$labels['language'] = array(
	'fr_FR' => tr('French'),
	'en_US' => tr('English'),
	'es_ES' => tr('Spanish'),
	'ja_JP' => tr('Japanese') );

$labels['profile']['gender'] = array(
	'male' => tr('Male'),
	'female' => tr('Female') );

$labels['profile']['relationship_status'] = array(
	'(null)' => tr('No answer'),
        'single' => tr('Single'),
	'committed' => tr('Committed'),
        'married' => tr('Married') );

$labels['profile']['relationship_status_cb'] = array(
        'single' => tr('Single'),
        'committed' => tr('Committed'),
        'married' => tr('Married') );

$labels['profile']['here_for'] = array(
	'friend' => tr('Friends'),
	'business' => tr('Business networking'),
	'dating' => tr('Dating'),
	'partners' => tr('Activity Partners') );

$labels['profile']['children'] = array(
	'(null)' => tr('No answer'),
        'no' => tr('No'),
        'fulltime' => tr('Yes, full time'),
        'halftime' => tr('Yes, half time'),
        'notathome' => tr('Yes, but not at home') );
	

$labels['profile']['fashion'] = array(
        'alternative' => tr('Alternative'),
        'casual' => tr('Casual'),
        'classic' => tr('Classic'),
        'contemporary' => tr('Contemporary'),
	'designer' => tr('Designer'), 
	'minimal' => tr('Minimal'), 
	'natural' => tr('Natural'), 
	'outdoorsy' => tr('Outdoorsy'), 
	'smart' => tr('Smart'), 
	'trendy' => tr('Trendy'), 
	'urban' => tr('Urban') );

$labels['profile']['smoking'] = array(
        '(null)' => tr('No answer'),
        'no' => tr('No'),
        'little' => tr('A little'),
	'socialy' => tr('Socialy'),
        'occasionally' => tr('Occasionally'),
        'regularly' => tr('Regularly') );

$labels['profile']['drinking'] =& $labels['profile']['smoking'];

$labels['profile']['living'] = array(
        'alone' => tr('Alone'),
        'roommate' => tr('With my roommate(s)'),
        'parents' => tr('With my parents'),
        'partner' => tr('With my partner'),
	'kid' => tr('With my kid(s)'),
        'pet' => tr('With my pet(s)') );

$labels['profile']['eye'] = array(
	'(null' => tr('No answer'),
	'blue' => tr('Blue'),
        'green' => tr('Green'),
        'brown' => tr('Brown'),
        'black' => tr('Black'),
        'gray' => tr('Gray'),
        'hazel' => tr('Hazel') );

$labels['profile']['hair'] = array(
        '(null)' => tr('No answer'),
        'blonde' => tr('Blonde'),
        'black' => tr('Black'),
        'auburn' => tr('Auburn'),
        'gray' => tr('Gray'),
        'salt_and_pepper' => tr('Salt and pepper'),
	'red' => tr('Red'),
        'light_brown' => tr('Light brown'),
        'dark_brown' => tr('Dark brown') );

$labels['profile']['body_art'] = array(
        'hidden_tattoo' => tr('Hidden tattoo'),
        'visible_tattoo' => tr('Visible tattoo'),
        'pierced_tongue' => tr('Pierced tongue'),
        'other_piercing' => tr('Other piercing') );

$labels['profile']['best_feature'] = array(
        'eyes' => tr('Eyes'),
        'hair' => tr('Hair'),
        'lips' => tr('Lips'),
        'neck' => tr('Neck'),
        'arms' => tr('Arms'),
        'hands' => tr('Hands'),
        'chest' => tr('Chest'),
        'belly_button' => tr('Belly button'),
        'butt' => tr('Butt'),
        'legs' => tr('Legs'),
        'calves' => tr('Calves'),
        'feet' => tr('Feet'),
        'not_on_the_list' => tr('Not in the list') );

$labels['profile']['industry'] = array(
	'(null)' =>tr('No answer'),
	'agriculture' => tr('Agriculture'),
	'arts' => tr('Arts'),
	'construction' => tr('Construction'),
	'consumer_goods' => tr('Consumer goods'),
	'corporate_services' => tr('Corporate services'),
	'education' => tr('Education'),
	'finance' => tr('Finance'),
	'government' => tr('Government'),
	'hi-tech' => tr('Hi-technology'),
	'legal' => tr('Legal'),
	'manufacturing' => tr('Manufacturing'),
	'media' => tr('Media'),
	'medical' => tr('Medical'),
	'non-profit' => tr('Non-profit'),
	'entertainment' => tr('Entertainment'),
	'scientific' => tr('Scientific'),
	'service_industry' => tr('Service industry'),
	'transportation' => tr('Transportation') );

$labels['profile']['im_type'] = array(
	'(null)' => tr('Nothing'),
	'aim' => 'AIM',
	'icq' => 'ICQ',
	'irc' => 'IRC',
	'msn' => 'MSN',
	'jabber' => 'Jabber',
	'skype' => 'Skype',
	'yahoo' => 'Yahoo!' );

$labels['access'] = array(
	'myself'=> tr('Myself'),
	'friends'=> tr('Friends'),
	'friends_of_friends'=> tr('Friends of friends'),
	'members'=> tr('All members'),
	'everyone'=> tr('Everyone') );

$labels['message']['dest'] = array(
	'one' => tr('One'),
	'friends' => tr('Friends'),
	'friends_of_friends' => tr('Friends of friends') );

$labels['blog']['status'] = array(
	'offline' => tr('Offline'),
	'online' => tr('Online') );

$labels['settings'] = array(
	'email' => tr('Email')/*,
	'message' => tr('Message')*/ );

$labels['friends']['relation'] = array(
	'havent_seen' => tr("Haven't seen"),
	'acquaintance' => tr('Acquaintance'),
	'friend' => tr('Friend'),
	'good_friend' => tr('Good friend'),
	'best_friend' => tr('Best friend') );

$labels['friends']['type'] = array(
	'love' => tr('Love'),
	'club' => tr('Asso/Club'),
	'childhood' => tr('Childhood'),
	'studies' => tr('Studies'),
	'family' => tr('Family'),
	'internet' => tr('Internet'),
	'parties' => tr('Parties'),
	'work' => tr('Work'),
	'holidays' => tr('Holidays'),
	'other' => tr('Other') );

$labels['communities']['moderated'] = array(
	'no' => tr('Public'),
	'yes' => tr('Moderated') );

$labels['communities']['anonymous'] = array(
        'allowed' => tr('Anonymous'),
        'not_allowed' => tr('Non-anonymous') );

$labels['invitation']['todo'] = array(
	'todo' => tr('Ready to send'),
	'doing' => tr('Invitation sent'),
	'done' => tr('Operation finished'),
	'stop' => tr('Operation stopped'),
	'error' => tr('Error') );
	
$labels['metalbum']['type'] = array(
	'interalbum' => 'interAlbum.com',
	'flickr' => 'Flickr.com' );

?>
