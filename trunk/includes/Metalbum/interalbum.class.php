<?
require_once 'Flickr/API.php';

# create a new api object

class Metalbum_Interalbum extends Metalbum {
	var $api;
	var $username;
	var $nsid;
	var $nb_items;
	
	function Metalbum_Interalbum($username, $params) {
		$params = array_merge(array('endpoint' => 'http://interalbum.com/api/rest'), $params);
		$this->api =& new Flickr_API($params);
		if(!$this->_setUsername($username)) 
			$this->status = 'error';
		else
			$this->status = 'ok';
	}

	function _setUsername($username) {
		$response = $this->api->callMethod('interalbum.people.findByUsername', array('username' => $username));
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

	function _buildUrl($type, $path) {
		switch($type) {
			case 'thumb':	$format='100x100'; break;
			case 'full':
			default:	$format='500x500'; break;
		}
		return "http://interalbum.com/dpics/{$format}/{$path}";
	}

	function getNbItems() {
		if($this->nb_items) {
			return $this->nb_items;
		} else {
			$response = $this->api->callMethod('interalbum.people.getNbPublicPhotos', array('user_id' => $this->nsid));
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
		$response = $this->api->callMethod('interalbum.people.getPublicPhotos', array(
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
					$photo['id'] = $photo_node->getAttribute('id');
					$photo['title'] = $photo_node->getAttribute('title');
					$photo['url_thumb'] = $this->_buildUrl('thumb', $path);
					$photo['url_full'] = $this->_buildUrl('full', $path);
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
		$response = $this->api->callMethod('interalbum.photos.getInfo', array(
					'photo_id' => $id_photo
					));
		if ($response) {
			$photo_node = $response->getNodeAt('photo');
			$path = $photo_node->getAttribute('path');

			$title_node = $photo_node->getNodeAt('title');
			$info['title'] = $title_node->decodeXmlEntities($title_node->content);
			$description_node = $photo_node->getNodeAt('description');
			$info['description'] = $description_node->decodeXmlEntities($description_node->content);
			$info['url_thumb'] = $this->_buildUrl('thumb', $path);
			$info['url_full'] = $this->_buildUrl('full', $path);
			return $info;
		} else {
			$this->_setError(__FUNCTION__, $this->api->getErrorCode(), $this->api->getErrorMessage());
			return false;
		}
	}

	function getUrlAlbum() {
		return 'http://'.$this->username.'.interalbum.com/';
	}
	
}

?>
