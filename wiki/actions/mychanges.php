<?php

// actions/mychanges.php
// written by Carlo Zottmann
// http://wakkawikki.com/CarloZottmann

if ($user = $this->GetUser())
{
	$my_edits_count = 0;

	if ($_REQUEST["bydate"] == 1)
	{
		print("<b>Liste des pages que vous avez modifi&eacute;es, tri&eacute;e par date de modification (<a href=\"".$this->href("", $tag)."\">tri alphab&eacute;tique</a>).</b><br /><br />\n");	

		if ($pages = $this->LoadAll("SELECT tag, time FROM ".$this->config["table_prefix"]."pages WHERE user = '".mysql_escape_string($this->UserName())."' AND tag NOT LIKE 'Comment%' ORDER BY time ASC, tag ASC"))
		{
			foreach ($pages as $page)
			{
				$edited_pages[$page["tag"]] = $page["time"];
			}

			$edited_pages = array_reverse($edited_pages);

			foreach ($edited_pages as $page["tag"] => $page["time"])
			{
				// day header
				list($day, $time) = explode(" ", $page["time"]);
				if ($day != $curday)
				{
					if ($curday) print("<br />\n");
					print("<b>$day:</b><br />\n");
					$curday = $day;
				}

				// print entry
				print("&nbsp;&nbsp;&nbsp;($time) (".$this->ComposeLinkToPage($page["tag"], "revisions", "history", 0).") ".$this->ComposeLinkToPage($page["tag"], "", "", 0)."<br />\n");

				$my_edits_count++;
			}
			
			if ($my_edits_count == 0)
			{
				print("<i>Vous n'avez pas modifi&eacute; de page.</i>");
			}
		}
		else
		{
			print("<i>Aucune page trouv&eacute;e.</i>");
		}
	}
	else
	{
		print("<b>Liste des pages que vous avez modifi&eacute;es, tri&eacute;e par date de modification (<a href=\"".$this->href("", $tag)."&amp;bydate=1\">tri par date</a>).</b><br /><br />\n");	

		if ($pages = $this->LoadAll("SELECT tag, time FROM ".$this->config["table_prefix"]."pages WHERE user = '".mysql_escape_string($this->UserName())."' AND tag NOT LIKE 'Comment%' ORDER BY tag ASC, time DESC"))
		{
			foreach ($pages as $page)
			{
				if ($last_tag != $page["tag"]) {
					$last_tag = $page["tag"];
					$firstChar = strtoupper($page["tag"][0]);
					if (!preg_match("/[A-Z,a-z]/", $firstChar)) {
						$firstChar = "#";
					}
		
					if ($firstChar != $curChar) {
						if ($curChar) print("<br />\n");
						print("<b>$firstChar</b><br />\n");
						$curChar = $firstChar;
					}
	
					// print entry
					print("&nbsp;&nbsp;&nbsp;(".$page["time"].") (".$this->ComposeLinkToPage($page["tag"], "revisions", "history", 0).") ".$this->ComposeLinkToPage($page["tag"], "", "", 0)."<br />\n");
	
					$my_edits_count++;
				}
			}
			
			if ($my_edits_count == 0)
			{
				print("<i>Vous n'avez pas modifi&eacute; de page.</i>");
			}
		}
		else
		{
			print("<i>Aucune page trouv&eacute;e.</i>");
		}
	}
}
else
{
	print("<i>Vous n'etes pas identifi&eacute; : impossible d'afficher la liste des pages que vous avez modifi&eacute;es.</i>");
}

?>
