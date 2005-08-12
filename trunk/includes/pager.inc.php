<?php
/****************************************************** Open .node ***
 * Description:   
 * Status:        Stable.
 * Author:        Alexandre DATH <alexandre@dotnode.com>
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

include('Pager/Pager.php');

class Pager_dotnode extends Pager
{
	function factory($data=null, $params=null)
	{
		$default_params = array(
			'mode'       => 'Sliding',
			'perPage'    => 10,
			'delta'      => 2,
			'urlVar'     => 'p',
			'prevImg'    => '&laquo;',
			'nextImg'    => '&raquo;',
			'curPageLinkClassName' => '',
			'separator' => '',
			'spacesBeforeSeparator' => 1,
			'spacesAfterSeparator' => 1,
			'firstPagePre' => '',
			'firstPagePost' => ' ...',
			'lastPagePre' => '... ',
			'lastPagePost' => '',
			);
		if(!is_null($data))
			$params['itemData'] = $data;
		return parent::factory($default_params + $params);
	}
}

?>
