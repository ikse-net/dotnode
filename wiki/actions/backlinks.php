<?php

	if ($pages = $this->LoadPagesLinkingTo($this->getPageTag()))
	{
		print("Pages ayant un lien vers la page courante : <br />\n");
		foreach ($pages as $page)
		{
			print($this->ComposeLinkToPage($page["tag"])."<br />\n");
		}
	}
	else
	{
		print("<i>Aucune page n'a de lien vers ".$this->ComposeLinkToPage($this->getPageTag()).".</i>");
	}
?>
