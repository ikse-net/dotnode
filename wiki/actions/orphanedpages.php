<?php

if ($pages = $this->LoadOrphanedPages())
{
	foreach ($pages as $page)
	{
		print($this->ComposeLinkToPage($page["tag"], "", "", 0)."<br />\n");
	}
}
else
{
	print("<i>Pas de pages orphelines</i>");
}

?>
