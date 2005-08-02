<div class="page">
<?php
if ($HasAccessRead=$this->HasAccess("read"))
{
	if (!$this->page)
	{
		print("Cette page n'existe pas encore, voulez vous la <a href=\"".$this->href("edit")."\">créer</a> ?");
	}
	else
	{
		// comment header?
		if ($this->page["comment_on"])
		{
			print("<div class=\"commentinfo\">Ceci est un commentaire sur ".$this->ComposeLinkToPage($this->page["comment_on"], "", "", 0).", posté par ".$this->Format($this->page["user"])." à ".$this->page["time"]."</div>");
		}

		if ($this->page["latest"] == "N")
		{
			print("<div class=\"revisioninfo\">Ceci est une version archivée de <a href=\"".$this->href()."\">".$this->GetPageTag()."</a> à ".$this->page["time"].".</div>");
		}


		// display page
		print($this->Format($this->page["body"], "wakka"));

		// if this is an old revision, display some buttons
		if (($this->page["latest"] == "N") && $this->HasAccess("write"))
		{
			$latest = $this->LoadPage($this->tag);
			?>
			<br />
			<?php echo  $this->FormOpen("edit") ?>
			<input type="hidden" name="previous" value="<?php echo  $latest["id"] ?>">
			<input type="hidden" name="body" value="<?php echo  htmlentities($this->page["body"], ENT_COMPAT, 'UTF-8') ?>">
			<input type="submit" value="Re-éditer cette version archivée">
			<?php echo  $this->FormClose(); ?>
			<?php
		}
	}
}
else
{
	print("<i>Vous n'êtes pas autorisé à lire cette page</i>");
}
?>
</div>


<?php
if ($HasAccessRead)
{
	// load comments for this page
	$comments = $this->LoadComments($this->tag);
	
	// store comments display in session
	$tag = $this->GetPageTag();
	if (!isset($_SESSION["show_comments"][$tag]))
		$_SESSION["show_comments"][$tag] = ($this->UserWantsComments() ? "1" : "0");
	if (isset($_REQUEST["show_comments"])){	
	switch($_REQUEST["show_comments"])
	{
	case "0":
		$_SESSION["show_comments"][$tag] = 0;
		break;
	case "1":
		$_SESSION["show_comments"][$tag] = 1;
		break;
	}
	}
	// display comments!
	if ($this->page && $_SESSION["show_comments"][$tag])
	{
		// display comments header
		?>
		<div class="commentsheader">
			Commentaires [<a href="<?php echo  $this->href("", "", "show_comments=0") ?>">Cacher commentaires/formulaire</a>]
		</div>
		<?php
		
		// display comments themselves
		if ($comments)
		{
			foreach ($comments as $comment)
			{
				print("<a name=\"".$comment["tag"]."\"></a>\n");
				print("<div class=\"comment\">\n");
				print($this->Format($comment["body"])."\n");
				print("<div class=\"commentinfo\">\n-- ".$this->Format($comment["user"])." (".$comment["time"].")\n</div>\n");
				print("</div>\n");
			}
		}
		
		// display comment form
		print("<div class=\"commentform\">\n");
		if ($this->HasAccess("comment"))
		{
			?>
				Ajouter un commentaire à cette page:<br />
				<?php echo  $this->FormOpen("addcomment"); ?>
					<textarea name="body" rows="6" style="width: 100%"></textarea><br />
					<input type="submit" value="Ajouter Commentaire" accesskey="s">
				<?php echo  $this->FormClose(); ?>
			<?php
		}
		print("</div>\n");
	}
	else
	{
		?>
		<div class="commentsheader">
		<?php
			switch (count($comments))
			{
			case 0:
				print("Il n'y a pas de commentaire sur cette page.");
				break;
			case 1:
				print("Il y a un commentaire sur cette page.");
				break;
			default:
				print("Il y a ".count($comments)." commentaires sur cette page.");
			}
		?>
		
		[<a href="<?php echo  $this->href("", "", "show_comments=1") ?>">Afficher commentaires/formulaire</a>]

		</div>
		<?php
	}
}
?>
