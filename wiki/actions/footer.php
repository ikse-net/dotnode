

<div class="footer">
<?php
echo  $this->FormOpen("", "RechercheTexte", "get");
echo  $this->HasAccess("write") ? "<a href=\"".$this->href("edit")."\" title=\"Cliquez pour &eacute;diter cette page.\">&Eacute;diter cette page</a> ::\n" : "";
echo  $this->GetPageTime() ? "<a href=\"".$this->href("revisions")."\" title=\"Cliquez pour voir les derni&egrave;res modifications sur cette page.\">".$this->GetPageTime()."</a> ::\n" : "";
	// if this page exists
	if ($this->page)
	{
		// if owner is current user
		if ($this->UserIsOwner())
		{
			print
			"Propri&eacute;taire&nbsp;: vous :: \n".
			"<a href=\"".$this->href("acls")."\" title=\"Cliquez pour &eacute;diter les permissions de cette page.\">&Eacute;diter permissions</a> :: \n".
			"<a href=\"".$this->href("deletepage")."\">Supprimer</a> :: \n";
		}
		else
		{
			if ($owner = $this->GetPageOwner())
			{
				print "Propri&eacute;taire : ".$this->Format($owner);
			}
			else
			{
				print "Pas de propri&eacute;taire ".($this->GetUser() ? "(<a href=\"".$this->href("claim")."\">Appropriation</a>)" : "");
			}
			print " :: \n";
		}
	}
?>
<a href="<?php echo $this->href("translate") ?>" title="Cliquez pour transmettre cette page en traduction.">
Traduire</a> ::
Recherche : <input name="phrase" size="15" class="searchbox" />
<?php echo  $this->FormClose(); ?>
</div>


<div class="copyright">
<a href="http://validator.w3.org/check/referer">Valid XHTML 1.0</a> ::
<a href="http://jigsaw.w3.org/css-validator/check/referer">Valid CSS</a> ::
-- powered by <?php echo $this->Link("http://wikini.ikse.net", "", "MultiWikiNi ".$this->GetWikiNiVersion()) . "\n"; ?>
</div>


<?php
	if ($this->GetConfigValue("debug")=="yes")
	{
		print "<span class=\"debug\"><b>Query log :</b><br />\n";
		$t_SQL=0;
        foreach ($this->queryLog as $query)
		{
			print $query["query"]." (".round($query["time"],4).")<br />\n";
			$t_SQL = $t_SQL + $query["time"];
		}
		print "</span>\n";

		print "<span class=\"debug\">".round($t_SQL, 4)." s (total SQL time)</span><br />\n";
		
		list($g2_usec, $g2_sec) = explode(" ",microtime());
		define ("t_end", (float)$g2_usec + (float)$g2_sec);
		print "<span class=\"debug\"><b>".round(t_end-t_start, 4)." s (total time)</b></span><br />\n";

		print "<span class=\"debug\">SQL time represent : ".round((($t_SQL/(t_end-t_start))*100),2)."% of total time</span>\n";
	}
?> 


</body>
</html>
