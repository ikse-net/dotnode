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

$table_fields['user'] = array(
	'fname'=>_('First name'),
	'lname'=>_('Last name'),
	'nick'=>_('Nickname'),
	'lang'=>_('Language'));

$table_fields['user_general'] = array(
	'description'=>_('About me'),
	'relationship_status'=>_('Relationship status'),
	'birthday'=>_('Birthday'),
	'here_for'=>_('I\'m interested in'),
	'children'=>_('Children'),
	'gender'=>_('Gender'),
	'fashion'=>_('Fashion'),
	'smoking'=>_('Smoking'),
	'drinking'=>_('Drinking'),
	'living'=>_('Living'),
	'web'=>_('Web') );

$table_fields['user_professional'] = array(
	'6nergies_url' => _('6nergies_profile_address'),
	'occupation' => _('Occupation'),
	'industry' => _('Industry'),
	'company' => _('Company name'),
	'web' => _('Web'),
	'title' => _('Title'),
	'description' => _('Job description'),
	'email' => _('Work email'),
	'phone' => _('Work phone') );

$table_fields['user_personal'] = array(
	'headline' => _('Headline'),
	'notice' => _('First thing you will notice<br />about me'),
	'size' => _('Size (in cm)'),
	'eye' => _('Eye color'),
	'hair' => _('Hair color'),
	'body_art' => _('Body art'),
	'best_feature' => _('Best feature'),
	'things_i_cant_live_without' => _('Things I can\'t live without'),
	'ideal_match' => _('Describe your ideal match') );

$table_fields['user_interests'] = array(
	'passions' => _('Passions'),
	'sports' => _('Sports'),
	'activities' => _('Activities'),
	'favorite_books' => _('Favorite books'),
	'favorite_music' => _('Favorite music'),
	'favorite_tvshow' => _('Favorite TV shows'),
	'favorite_movies' => _('Favorite movies'),
	'favorite_cuisines' => _('Favorite cuisines') );

$table_fields['user_contact'] = array(
        'email' => _('Email'),
        'email2' => _('Email (2)'),
        'email3' => _('Email (3)'),
        'email4' => _('Email (4)'),
        'im' => _('Main IM'),
        'im_type' => _('IM Type'),
        'im2' => _('Secondary IM'),
        'im2_type' => _('IM(2) Type'),
	'phone' => _('Phone'),
	'cell_phone' => _('Cell phone'),
	'address' => _('Address'),
	'zip' => _('Zip'),
	'city' => _('City'),
	'country' => _('Country') );

$table_fields['user_schools'] = array (
	'year' => _('Year'),
	'name' => _('Name'),
	'city' => _('City'),
	'country' => _('Country') );

$table_fields['album'] = array (
        'caption' => _('Caption') );

$table_fields['bookmarks'] = array (
        'link' => _('Link'),
	'comment' => _('Comment') );


$table_fields['blog'] = array (
        'title' => _('Title'),
        'chapeau' => _('Chapeau'),
	'ticket' => _('Ticket'),
	'id_cat' => _('Categorie'),
	'date' => _('Date'), 
	'status' => _('Status') );

$table_fields['blog_categorie'] = array (
        'name' => _('Name'),
        'comment' => _('Comment') );

$table_fields['blog_comment'] = array (
        'title' => _('Title'),
        'comment' => _('Comment') );

$table_fields['settings'] = array (
	'new_friend_notifications' => _('New friends notifications'),
	'new_friend_approval' => _('New friend approval'),
	'new_blog_comment' => _('New blog comment'),
        'messages_sent_directly_to_me' => _('Messages sent directly to me'),
        'messages_sent_to_friends' => _('Messages send to friends'),
        'messages_sent_to_friends_of_friends' => _('Messages send to friends of friends'),
        'messages_sent_to_communities' => _('Messages send to my communities'),
        'birthday_reminder' => _('Birthday remember'),
	'publish' => _('Publish personal profil'),
	'dotpage_css' => '.page style (CSS)',
        'invitation_message' => _('Invitation message') );

$table_fields['communities'] = array (
	'id_cat' => 'id_cat',
	'name' => 'name',
	'description' => 'description',
	'moderated' => 'moderated',
	'country' => 'country' );
	
?>
