<?php
if ($user = $this->GetUser())
{
	$max = $user["changescount"];
}
else
{
	$max = 50;
}

if ($pages = $this->LoadRecentlyChanged($max))
{
	if (!($link = $this->GetParameter("link"))) $link=$this->config["root_page"];
	$output = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
	$output .= "<!-- RSS v0.91 generated by Wikini -->\n";
	$output .= "<rdf:RDF\n";
	$output .= "xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\"\n";
	$output .= "xmlns=\"http://my.netscape.com/publish/formats/rss-0.91.dtd\">\n";
 
	$output .= "<channel>\n";
	$output .= "<title> Derniers changements sur ". $this->config["wakka_name"]  . "</title>\n";
	$output .= "<link>" . $this->config["base_url"] . $link . "</link>\n";
	$output .= "<description> Derniers changements sur " . $this->config["wakka_name"] . " </description>\n";
	$output .= "<language>fr</language>\n";
	$output .= "</channel>\n";

	foreach ($pages as $i => $page)
	{
		list($day, $time) = explode(" ", $page["time"]);
		$day= preg_replace("/-/", " ", $day);
		list($hh,$mm,$ss) = explode(":", $time);
		$output .= "<item>\n";
		$output .= "<title>" . $page["tag"] . " --- par " .$page["user"] . " le " . $day ." - ". $hh .":". $mm . "</title>\n";
		$output .= "<description> Modification de " . $page["tag"] . " --- par " .$page["user"] . " le " . $day ." - ". $hh .":". $mm . "</description>\n";
		$output .= "<link>" . $this->config["base_url"] . $page["tag"] . "&amp;time=" . rawurlencode($page["time"]) . "</link>\n";
		$output .= "</item>\n";
	}
	$output .= "</rdf:RDF>\n";
	print($output);
}
?>