<?php

if ($pages = $this->LoadRecentlyCommented())
{
	foreach ($pages as $page)
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
		print("&nbsp;&nbsp;&nbsp;(".$page["comment_time"].") <a href=\"".$this->href("", $page["tag"], "show_comments=1")."#".$page["comment_tag"]."\">".$page["tag"]."</a> . . . . dernier commentaire par ".$this->Format($page["comment_user"])."<br />\n");
	}
}
else
{
	print("<i>Aucune page n'a été commentée récemment.</i>");
}

?>
