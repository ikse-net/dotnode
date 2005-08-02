<?php

if ($pages = $this->LoadAllPages())
{
	foreach ($pages as $page)
	{
		if (!preg_match("/^Comment/", $page["tag"])) {
			$firstChar = strtoupper($page["tag"][0]);
			if (!preg_match("/[A-Z,a-z]/", $firstChar)) {
				$firstChar = "#";
			}

			if ($firstChar != $curChar) {
				if ($curChar) print("<br />\n");
				print("<b>$firstChar</b><br />\n");
				$curChar = $firstChar;
			}

			print($this->ComposeLinkToPage($page["tag"])."<br />\n");
		}
	}
}
else
{
	print("<i>Aucune page trouv&eacute;e.</i>");
}

?>
