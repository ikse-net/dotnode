<div class="page">
<?php
if ($global = $_REQUEST["global"])
{
	$title = "Domaines faisant r&eacute;f&eacute;rence &agrave; ce wiki (<a href=\"".$this->href("referrers", "", "global=1")."\">voir la liste des pages externes</a>):";
	$referrers = $this->LoadReferrers();
}
else
{
	$title = "Domaines faisant r&eacute;f&eacute;rence &agrave; ".$this->Link($this->GetPageTag()).
		($this->GetConfigValue("referrers_purge_time") ? " (depuis ".($this->GetConfigValue("referrers_purge_time") == 1 ? "24 heures" : $this->GetConfigValue("referrers_purge_time")." jours").")" : "")." (<a href=\"".$this->href("referrers")."\">voir la liste des pages externes</a>):";
	$referrers = $this->LoadReferrers($this->GetPageTag());
}

print("<b>$title</b><br /><br />\n");
if ($referrers)
{
	for ($a = 0; $a < count($referrers); $a++)
	{
		$temp_parse_url = parse_url($referrers[$a]["referrer"]);
		$temp_parse_url = ($temp_parse_url["host"] != "") ? strtolower(preg_replace("/^www\./Ui", "", $temp_parse_url["host"])) : "inconnu";

		if (isset($referrer_sites["$temp_parse_url"]))
		{
			$referrer_sites["$temp_parse_url"] += $referrers[$a]["num"];
		}
		else
		{
			$referrer_sites["$temp_parse_url"] = $referrers[$a]["num"];
		}
	}

	array_multisort($referrer_sites, SORT_DESC, SORT_NUMERIC);
	reset($referrer_sites);

	print("<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n");
	foreach ($referrer_sites as $site => $site_count)
	{
		print("<tr>");
		print("<td width=\"30\" align=\"right\" valign=\"top\" style=\"padding-right: 10px\">$site_count</td>");
		print("<td valign=\"top\">" . (($site != "unknown") ? "<a href=\"http://$site\">$site</a>" : $site) . "</td>");
		print("</tr>\n");
	}
	print("</table>\n");
}
else
{
	print("<i>None</i><br />\n");
}

if ($global)
{
	print("<br />[<a href=\"".$this->href("referrers_sites")."\">Voir les domaines faisant r&eacute;f&eacute;rence &agrave; ".$this->GetPageTag()." seulement</a> | <a href=\"".$this->href("referrers")."\">Voir les r&eacute;f&eacute;rences ".$this->GetPageTag()." seulement</a>]");
}
else
{
	print("<br />[<a href=\"".$this->href("referrers_sites", "", "global=1")."\">Voir tous les domaines faisant r&eacute;f&eacute;rence </a> | <a href=\"".$this->href("referrers", "", "global=1")."\">Voir toutes les r&eacute;f&eacute;rences </a>]");
}


?>
</div>
