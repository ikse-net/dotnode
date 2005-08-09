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

$_SMARTY['Title'] =  'Friend finder';

$user['info'] = get_cache_user_info($url_id);
$user['photo'] = build_image_url($url_id);

if($_POST['fname'] || $_POST['lname'] || $_POST['nick'] )
{
	$t_fields = 'id, fname, lname, here_for, gender, country, relationship_status';

	if($_POST['fname']!='' && $_POST['lname']!='')
        {
                $r0 = $db->query('SELECT ! FROM cache_user WHERE fname=? AND lname=? LIMIT 20', array($t_fields, $_POST['fname'], $_POST['lname']));
                while($item = $r0->fetchRow())
                {
                        $item_id = $item['id'];
                        unset($item['id']);

                        $result[$item_id] = $item;
                        $result[$item_id]['gender_t'] = translate_list($item['gender'], $labels['profile']['gender']);
                        $result[$item_id]['here_for_t'] = translate_list($item['here_for'], $labels['profile']['here_for']);
                        $result[$item_id]['relationship_status_t'] = translate_list($item['relationship_status'], $labels['profile']['relationship_status']);

                        $result[$item_id]['photo'] = build_thumb_url($item_id);
                        $result[$item_id]['pertinence'] = 4;
                }
                $r0_nb = $r0->numRows();
        }

	if($_POST['fname']!='' && $_POST['lname']!='' && $r0_nb <20)
	{
		$r1 = $db->query('SELECT ! FROM cache_user WHERE fname_sndex=SOUNDEX(?) AND lname_sndex=SOUNDEX(?) LIMIT !', array($t_fields, $_POST['fname'], $_POST['lname'], 20-$r0_nb));
		while($item = $r1->fetchRow())
		{
			if(!isset($result[$item['id']]))
			{
				$item_id = $item['id'];
				unset($item['id']);

				$result[$item_id] = $item;
				$result[$item_id]['gender_t'] = translate_list($item['gender'], $labels['profile']['gender']);
				$result[$item_id]['here_for_t'] = translate_list($item['here_for'], $labels['profile']['here_for']);
				$result[$item_id]['relationship_status_t'] = translate_list($item['relationship_status'], $labels['profile']['relationship_status']);

				$result[$item_id]['photo'] = build_thumb_url($item_id);
				$result[$item_id]['pertinence'] = 3;
			}
		}
		$r1_nb = $r1->numRows();
	}

	if($_POST['lname']!='' && ($r0_nb+$r1_nb) <20)
	{
		$r2 = $db->query('SELECT ! FROM cache_user WHERE lname_sndex=SOUNDEX(?) LIMIT !', array($t_fields, $_POST['lname'], 20-$r0_nb-$r1_nb));
		while($item = $r2->fetchRow())
		{
			if(!isset($result[$item['id']]))
			{
				$item_id = $item['id'];
				unset($item['id']);

				$result[$item_id] = $item;
				$result[$item_id]['gender_t'] = translate_list($item['gender'], $labels['profile']['gender']);
				$result[$item_id]['here_for_t'] = translate_list($item['here_for'], $labels['profile']['here_for']);
				$result[$item_id]['relationship_status_t'] = translate_list($item['relationship_status'], $labels['profile']['relationship_status']);

				$result[$item_id]['photo'] = build_thumb_url($item_id);
				$result[$item_id]['pertinence'] = 2;
			}
		}
		$r2_nb = $r2->numRows();
	}

	if($_POST['fname']!='' && ($r0_nb+$r1_nb+$r2_nb )<20 )
	{
		$r3 = $db->query('SELECT ! FROM cache_user WHERE fname_sndex=SOUNDEX(?) LIMIT !', array($t_fields, $_POST['fname'], 20-$r0_nb-$r1_nb-$r2_nb));
		while($item = $r3->fetchRow())
		{
			if(!isset($result[$item['id']]))
			{
				$item_id = $item['id'];
				unset($item['id']);

				$result[$item_id] = $item;
				$result[$item_id]['gender_t'] = translate_list($item['gender'], $labels['profile']['gender']);
				$result[$item_id]['here_for_t'] = translate_list($item['here_for'], $labels['profile']['here_for']);
				$result[$item_id]['relationship_status_t'] = translate_list($item['relationship_status'], $labels['profile']['relationship_status']);

				$result[$item_id]['photo'] = build_thumb_url($item_id);
				$result[$item_id]['pertinence'] = 1;
			}
		}
		$r3_nb = $r3->numRows();
	}

	if($_POST['nick']!='' && ($r0_nb+$r1_nb+$r2_nb+$r3_nb )<20 )
        {
                $r4 = $db->query('SELECT ! FROM cache_user WHERE nick_sndex=SOUNDEX(?) LIMIT !', array($t_fields, $_POST['nick'], 20-$r0_nb-$r1_nb-$r2_nb+$r3_nb));
                while($item = $r4->fetchRow())
                {
                        if(!isset($result[$item['id']]))
                        {
                                $item_id = $item['id'];
                                unset($item['id']);

                                $result[$item_id] = $item;
                                $result[$item_id]['gender_t'] = translate_list($item['gender'], $labels['profile']['gender']);
                                $result[$item_id]['here_for_t'] = translate_list($item['here_for'], $labels['profile']['here_for']);
                                $result[$item_id]['relationship_status_t'] = translate_list($item['relationship_status'], $labels['profile']['relationship_status']);

                                $result[$item_id]['photo'] = build_thumb_url($item_id);
                                $result[$item_id]['pertinence'] = 1;
                        }
                }
        }

}


/************** menu ***************************/
$leftmenu["/profile/$url_id"] = 'Profile';

if($user['info']['nb_photos'] > 0)
        $leftmenu["/album/$url_id"] = 'Album';

if($user['info']['nb_blogs'] > 0)
        $leftmenu["/blog/$url_id"] = 'Blog';

if($user['info']['nb_bookmarks'] > 0)
        $leftmenu["/bookmarks/$url_id"] = 'Bookmarks';

$_SMARTY['leftmenu'] = $leftmenu;

/************************************************/
$_SMARTY['user'] =  $user;
if($result) $_SMARTY['result'] = $result;
?>
