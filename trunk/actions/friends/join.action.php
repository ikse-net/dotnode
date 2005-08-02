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

if($_POST['add'] || $_POST['resend'])
{
	$invitations[0]['fname'] = $_POST['fname'];
	$invitations[0]['lname'] = $_POST['lname'];
	$invitations[0]['email'] = $_POST['email'];
	$invitations[0]['lang'] = $_POST['lang'];
	$invitations[0]['type'] = 'man';
}
elseif($_POST['import'])
{
	$CSV = fopen($_FILES['csv']['tmp_name'], 'r');
	$first_carac = fread($CSV, 1);
	fclose($CSV);
	if($_FILES['csv']['type'] == 'text/comma-separated-values' || $first_carac == '"')
	{
		$lines = file($_FILES['csv']['tmp_name']);
		$idx=0;
		foreach($lines as $line)
		{
			$line = trim($line);
			if(preg_match("/^\"(.*)\",\"(.*)\",\"(.*@.*\..*)\"$/", $line, $matches))
			{
				$invitations[$idx]['fname'] = $matches[1];
				$invitations[$idx]['lname'] = $matches[2];
				$invitations[$idx]['email'] = $matches[3];
				$invitations[$idx]['type'] = 'csv';
				$invitations[$idx]['lang'] = $lang;

			}
			$idx++;
		}
	}
}

foreach($invitations as $invitation)
{
	if($invitation['fname']!='' && $invitation['lname']!='' && valid_email($invitation['email']) && valid_lang($invitation['lang']) )
	{
		$user_w_this_email = $db->getCol('SELECT id FROM user_contact WHERE email=? OR email2=? OR email3=? OR email4=?', 0, array($invitation['email'], $invitation['email'],$invitation['email'],$invitation['email']) );
		if(count($user_w_this_email) == 0)
		{
			$invit = $db->getRow('SELECT id, status, response FROM invitation_email WHERE email=?', array($invitation['email']) );
			if(!is_array($invit) || $_POST['id'] && strlen($_POST['id'])==32)
			{
				$values = array (
						'id_invit' => $_SESSION['my_id'],
						'fname' => $invitation['fname'],
						'lname' => $invitation['lname'],
						'email' => $invitation['email'],
						'lname' => $invitation['lname'],
						'lang'  => $invitation['lang'],
						'type' => $invitation['type'],
						'ip'  => $_SERVER['REMOTE_ADDR'],
						'date_begin' => time());

				if($_POST['id'] && strlen($_POST['id'])==32 )
				{
					$values['response']=NULL;
					$values['failure_notice']=NULL;
					$values['status']='todo';
					$db->autoExecute('invitation_email', $values, DB_AUTOQUERY_UPDATE, "id='".$_POST['id']."'");
				}
				else
				{
					$values['id']= md5($invitation['fname'].$invitation['lname'].$invitation['email']);
					$db->autoExecute('invitation_email', $values);
				}

			}
			else
			{
				$error++;
				$error_msg[] = _('You or another .node member have invited this person:').' '.$invitation['fname'].' '.$invitation['lname'].' ('.$invitation['email'].')';
			}

		}
		elseif(count($user_w_this_email) == 1)
		{
			$error++;
                        $error_msg[] = _('Already member').': <a href="/friends/'.$user_w_this_email[0].'/invitation/already_member">'.$invitation['fname'].' '.$invitation['lname'].' ('.$invitation['email'].')</a>';
		}
		else
		{
			$error++;
			$error_msg[] = $invitation['email'].': '._('More than 1 person on .node have this email');
		}
	}
	else
	{
		$error++;
		$error_msg[] = $invitation['fname'].' '.$invitation['lname'].' ('.$invitation['email'].'): '._('You must enter a first name, last name, and valid email');
	}
}

if($error > 0)
{
	$_SESSION['error']['title'] = $error.' '._('errors');
	$_SESSION['error']['msg'] = '<ul>';
	foreach($error_msg as $msg)
		$_SESSION['error']['msg'] .= '<li>'.$msg.'</li>';
	$_SESSION['error']['msg'] .= '</ul>';
	
}

header('Location: /friends/join');

?>
