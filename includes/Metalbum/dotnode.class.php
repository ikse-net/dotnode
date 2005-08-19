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

require_once 'Flickr/API.php';

# create a new api object

class Metalbum_Dotnode extends Metalbum {
	var $api;
	var $username;
	var $nsid;
	var $nb_items;
	
	function Metalbum_Dotnode($username, $params) {
		$params = array_merge(array('endpoint' => 'http://dotnode.com/api/rest'), $params);
		$this->api =& new Flickr_API($params);
		if(!$this->_setUsername($username)) 
			$this->status = 'error';
		else
			$this->status = 'ok';
	}

	function _setUsername($username) {
		$response = $this->api->callMethod('dotnode.people.findByUsername', array('username' => $username));
		if ($response) {
			$this->username = $username;
			$user_node =  $response->getNodeAt('user');
			$this->nsid = $user_node->getAttribute('nsid');
			return $this->nsid;
		} else {
			$this->_setError(__FUNCTION__, $this->api->getErrorCode(), $this->api->getErrorMessage());
			return false;
		}
	}

	function _buildUrl($type, $path, $format) {
		switch($type) {
			case 'thumb':
				return "http://dotnode.com/dpics/100x100/{$path}.{$format}";
				break;
			case 'full':
			default:	; 
				return "http://dotnode.com/dpics/500x500/{$path}.{$format}";
				break;
		}
	}

	function getNbItems() {
		if($this->nb_items) {
			return $this->nb_items;
		} else {
			$response = $this->api->callMethod('dotnode.people.getNbPublicPhotos', array('user_id' => $this->nsid));
			if ($response) {
				$photos_node = $response->getNodeAt('photos');
				$this->nb_items = $photos_node->getAttribute('total');
				return $this->nb_items;
			} else {
				$this->_setError(__FUNCTION__, $this->api->getErrorCode(), $this->api->getErrorMessage());
				return false;
			}
		}
	}

	function getPhotos($page=1, $per_page=15) {
		$response = $this->api->callMethod('dotnode.people.getPublicPhotos', array(
					'user_id' => $this->nsid,
					'per_page' => $per_page,
					'page' => $page
					));
		if ($response) {
			$photos_node = $response->getNodeAt('photos');
			$this->nb_items = $photos_node->getAttribute('total');
			$idx = 0;
			// Must set the step to 2, because XML_Tree create node for line return in the XML (empty element)
			for($idx=0; $idx < $per_page*2; $idx+=2) {
				$photo_node = $photos_node->getElement(array($idx+1));
				if(PEAR::isError($photo_node))
					break;
				else {
					unset($photo);
					$path = $photo_node->getAttribute('path');
					$format = $photo_node->getAttribute('format');
					$photo['id'] = $photo_node->getAttribute('id');
					$photo['title'] = $photo_node->getAttribute('title');
					$photo['url_thumb'] = $this->_buildUrl('thumb', $path, $format);
					$photo['url_full'] = $this->_buildUrl('full', $path, $format);
					$rval[] = $photo;
				}
			}
			return $rval;
		} else {
			$this->_setError(__FUNCTION__, $this->api->getErrorCode(), $this->api->getErrorMessage());
			return false;
		}
	}


	function getPhotoInfo($id_photo) {
		$response = $this->api->callMethod('dotnode.photos.getInfo', array(
					'photo_id' => $id_photo
					));
		if ($response) {
			$photo_node = $response->getNodeAt('photo');
			$path = $photo_node->getAttribute('path');
			$format = $photo_node->getAttribute('format');

			$title_node = $photo_node->getNodeAt('title');
			$info['title'] = $title_node->decodeXmlEntities($title_node->content);
			$description_node = $photo_node->getNodeAt('description');
			$info['description'] = $description_node->decodeXmlEntities($description_node->content);
			$info['url_thumb'] = $this->_buildUrl('thumb', $path, $format);
			$info['url_full'] = $this->_buildUrl('full', $path, $format);
			return $info;
		} else {
			$this->_setError(__FUNCTION__, $this->api->getErrorCode(), $this->api->getErrorMessage());
			return false;
		}
	}

	function getUrlAlbum() {
		return 'http://'.$this->username.'.dotnode.com/album';
	}
	
}

?>
