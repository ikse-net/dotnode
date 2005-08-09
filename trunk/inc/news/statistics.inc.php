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


$total = $db->getOne('SELECT value FROM global_data WHERE name=?', array('nb_nodians'));

$country_r = $db->query('SELECT DISTINCT(country) AS name, COUNT(id) AS nb FROM user_contact WHERE country IS NOT NULL GROUP BY country ORDER BY nb DESC LIMIT 10');

while($country = $country_r->fetchRow())
{
	$country['male'] = $db->getOne('SELECT COUNT(id) FROM cache_user WHERE country=? AND gender=?', array($country['name'], 'male'));
	$country['female'] = $db->getOne('SELECT COUNT(id) FROM cache_user WHERE country=? AND gender=?', array($country['name'], 'female'));
	$stats['country'][$country['name']]['nb'] = $country['nb'];
	$stats['country'][$country['name']]['percent'] = $country['nb']/$total*100;
	$stats['country'][$country['name']]['male'] = $country['male']/$country['nb']*100;
	$stats['country'][$country['name']]['female'] = $country['female']/$country['nb']*100;
}

$stats['interest'][tr($labels['profile']['here_for']['friend'])] = $db->getOne('SELECT COUNT(id) as nb FROM cache_user WHERE here_for=here_for|1')/$total*100;
$stats['interest'][tr($labels['profile']['here_for']['business'])] = $db->getOne('SELECT COUNT(id) as nb FROM cache_user WHERE here_for=here_for|2')/$total*100;
$stats['interest'][tr($labels['profile']['here_for']['dating'])] = $db->getOne('SELECT COUNT(id) as nb FROM cache_user WHERE here_for=here_for|4')/$total*100;
$stats['interest'][tr($labels['profile']['here_for']['partners'])] = $db->getOne('SELECT COUNT(id) as nb FROM cache_user WHERE here_for=here_for|8')/$total*100;

$relationship_r = $db->query('SELECT DISTINCT(relationship_status) AS name, COUNT(id) AS nb FROM cache_user GROUP BY relationship_status ORDER BY nb DESC LIMIT 10');


$relationship_r = $db->query('SELECT DISTINCT(relationship_status) AS name, COUNT(id) AS nb FROM cache_user WHERE relationship_status IS NOT NULL GROUP BY relationship_status ORDER BY nb DESC');

while($relationship = $relationship_r->fetchRow())
{
	if(!$relationship['name'])
		continue;
//                $relationship['name'] = 'no_anwser';

        $relationship['male'] = $db->getOne('SELECT COUNT(id) FROM cache_user WHERE relationship_status=? AND gender=?', array($relationship['name'], 'male'));
        $relationship['female'] = $db->getOne('SELECT COUNT(id) FROM cache_user WHERE relationship_status=? AND gender=?', array($relationship['name'], 'female'));
        $stats['relationship'][$relationship['name']]['nb'] = $relationship['nb'];
        $stats['relationship'][$relationship['name']]['percent'] = $relationship['nb']/$total*100;
	$stats['relationship'][$relationship['name']]['male'] = ( $relationship['male'] / $relationship['nb'] ) * 100 ;

        $stats['relationship'][$relationship['name']]['female'] = ($relationship['female']/$relationship['nb'])*100;
	$stats['relationship'][$relationship['name']]['label'] = $labels['profile']['relationship_status_cb'][$relationship['name']];
}

$_SMARTY['stats'] =  $stats;
?>
