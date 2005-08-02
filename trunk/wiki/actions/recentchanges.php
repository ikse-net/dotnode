<?php

// Which is the max number of pages to be shown ?
if ($max = $this->GetParameter("max"))
{
    if ($max=="last") $max=50; else $last = (int) $max;
    $lang='%';
}
elseif ($lang = $this->GetParameter("lang"))
{
    $max = 20;
}
elseif ($user = $this->GetUser())
{
    $max = $user["changescount"];
    $lang='%';
}
else
{
    $lang = '%';
    $max = 50;
}

// Show recently changed pages
if ($pages = $this->LoadRecentlyChanged($max, $lang))
{
	if ($this->GetParameter("max"))
	{
		foreach ($pages as $i => $page)
		{
			// print entry
			print("(".$page["time"].") (".$this->ComposeLinkToPage($page["tag"], "revisions", "historique", 0, $lang).") ".$this->ComposeLinkToPage($page["tag"], "", "", 0, $lang)." <img src='/img/flags/".$page['lang'].".png' alt='(".$page['lang'].")'/> . . . . ".$this->Format($page["user"])."<br />\n");
		}
	}
	else
	{
		$curday='';
        foreach ($pages as $i => $page)
		{
			// day header
			list($day, $time) = explode(" ", $page["time"]);
			if ($day != $curday)
			{
				if ($curday) print("<br />\n");
				print("<b>$day&nbsp;:</b><br />\n");
				$curday = $day;
			}
			// print entry
			print("&nbsp;&nbsp;&nbsp;(".$time.") (".$this->ComposeLinkToPage($page["tag"], "revisions", "historique", 0, $page['lang']).") ".$this->ComposeLinkToPage($page["tag"], "", "", 0, $page['lang'])." <img src='/img/flags/".$page['lang'].".png' alt='(".$page['lang'].")'/> . . . . ".$this->Format($page["user"])."<br />\n");
		}
	}
}
?>
