#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');
include ('../includes/rss/rss_fetch.inc.php');
include ('../includes/rss/rss_utils.inc.php');

$_SERVER['SERVER_ADDR'] = '213.186.54.179';

$db =& DB::connect($dsn);
if (DB::isError($db))
	error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$blog_r = $db->query('SELECT id, id_blog, rss FROM rss_blog WHERE rss LIKE "http%"');

$debug = false;

while($blog = $blog_r->fetchRow())
{
$debug and $blog['rss'] = 'http:masafr.exblog.jp/';
	print '> '.$blog['rss'];

	preg_match("/^(http:\/\/)?([^\/]+)/i", $blog['rss'], $matches);
	$host = $matches[2];
	
	list($host_ip) = gethostbynamel($matches[2]);

	if($host_ip /* && $host_ip != $_SERVER['SERVER_ADDR'] */)
	{
		print " ... $host_ip ok\n";
		$rss = @fetch_rss($blog['rss']);
		if($rss)
		{
			$debug and print_r($rss);
			$debug and exit();
			$blog_values = array(
				'title' => $rss->channel['title'],
				'link' => $rss->channel['link'],
				'rss' => $blog['rss'],
				'id' => $blog['id']
				);
			$debug and print_r($blog_values);
			$debug or $db->autoExecute('rss_blog', $blog_values, DB_AUTOQUERY_UPDATE, "id='".$blog['id']."'");
			$idx=0;
			foreach ( $rss->items as $item ) 
			{
				$db_values = array(
						'id' => $blog['id'],
						'id_blog' => $blog['id_blog'],
						'id_ticket' => md5($blog['id'].$item['link']),
						'title' => $item['title'],
						'link' => $item['link']
						);
				if($item['dc']['date'])
					$db_values['date'] = date("U",parse_w3cdtf($item['dc']['date']));
				elseif($item['pubdate'])
					$db_values['date'] = strtotime($item['pubdate']);
				if($item['description'])
					$db_values['description'] = $item['description'];
				if($item['content']['encoded'])
					$db_values['content'] = $item['content']['encoded'];

				$res = $db->autoExecute('rss_blog_ticket', $db_values);
				if(DB::isError($res))
					print '_';
				else
					print '.';
				unset($res);
				$idx++;
			}
			$debug or $db->query('UPDATE cache_user SET nb_blogs=? WHERE id=?', array($idx, $blog['id']));
			
		}
		else
		{
			//$user_values = array('rss'=>'Error: Unable to parse your RSS ('.$blog['rss'].')');
			//$debug or $db->autoExecute('rss_blog', $user_values, DB_AUTOQUERY_UPDATE, "id='".$blog['id']."'");

			error_log('fetch_rss | error ^^^^^^^^^^^^^^^^^^ | '.$blog['rss']);
			print " * Error";
		}
		print "\n";
	}
	else
		print " -> BAD\n";
}

$db->disconnect();
?>
