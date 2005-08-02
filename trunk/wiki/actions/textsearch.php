<?php echo  $this->FormOpen("", "", "get") ?>
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>Ce que vous souhaitez chercher :&nbsp;</td>
		<td><input name="phrase" size="40" value="<?php echo  htmlentities($_REQUEST["phrase"], ENT_COMPAT, 'UTF-8') ?>" /> <input type="submit" value="Chercher" /></td>
	</tr>
</table>
<?php echo  $this->FormClose(); ?>

<?php
if ($phrase = $_REQUEST["phrase"])
{
	print("<br />");
	if ($results = $this->FullTextSearch($phrase))
	{
		print("<b>Résultat(s) de la recherche de \"$phrase\":</b><br /><br />\n");
		foreach ($results as $i => $page)
		{
			print(($i+1).". ".$this->ComposeLinkToPage($page["tag"])."<br />\n");
		}
	}
	else
	{
		print("Aucun résultat pour \"$phrase\". :-(");
	}
}

?>
