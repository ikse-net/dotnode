<?php
if ($pages = $this->LoadWantedPages())
{
	foreach ($pages as $page)
	{
		print($this->Link($page["tag"])." (<a
 ref=\"".$this->href()."&amp;linking_to=".$page["tag"]."\">".$page["count"]."</a>)<br />\n");
	}
}
else
{
	print("<i>Aucune page à créer.</i>");
}
?>
