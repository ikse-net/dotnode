<div class="page">
<?php

if ($this->UserIsOwner())
{
	if ($_POST)
	{
		// store lists
		$this->SaveAcl($this->GetPageTag(), "read", $_POST["read_acl"]);
		$this->SaveAcl($this->GetPageTag(), "write", $_POST["write_acl"]);
		$this->SaveAcl($this->GetPageTag(), "comment", $_POST["comment_acl"]);
		$message = "Mise à jour des droits d\'acc&eacute;s";//$message = "Access control lists updated";
		
		// change owner?
		if ($newowner = $_POST["newowner"])
		{
			$this->SetPageOwner($this->GetPageTag(), $newowner);
			$message .= " et changement du propri&eacute;taire. Nouveau propri&eacute;taire : ".$newowner;//$message .= " and gave ownership to ".$newowner;
		}

		// redirect back to page
		$this->SetMessage($message."!");
		$this->Redirect($this->Href());
	}
	else
	{
		// load acls
		$readACL = $this->LoadAcl($this->GetPageTag(), "read");
		$writeACL = $this->LoadAcl($this->GetPageTag(), "write");
		$commentACL = $this->LoadAcl($this->GetPageTag(), "comment");

		// show form
		?>
		<h3>Liste des droits d'accés de la page  <?php echo  $this->ComposeLinkToPage($this->GetPageTag()) ?></h3><!-- Access Control Lists for-->
		<br />
		
		<?php echo  $this->FormOpen("acls") ?>
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top" style="padding-right: 20px">
					<b>Droits de lecture :</b><br /><!-- Read ACL:-->
					<textarea name="read_acl" rows="4" cols="20"><?php echo  $readACL["list"] ?></textarea>
				<td>
				<td valign="top" style="padding-right: 20px">
					<b>Droits d'écriture :</b><br /><!-- Write ACL:-->
					<textarea name="write_acl" rows="4" cols="20"><?php echo  $writeACL["list"] ?></textarea>
				<td>
				<td valign="top" style="padding-right: 20px">
					<b>Droits des commentaires :</b><br /><!-- Comments ACL:-->
					<textarea name="comment_acl" rows="4" cols="20"><?php echo  $commentACL["list"] ?></textarea>
				<td>
			</tr>
			<tr>
				<td colspan="3">
					<b>Changer le propriétaire :</b><br /><!-- Set Owner:-->
					<select name="newowner">
						<option value="">Ne rien modifier</option><!-- Don't change-->
						<option value=""></option>
						<?php
						if ($users = $this->LoadUsers())
						{
							foreach($users as $user)
							{
								print("<option value=\"".htmlentities($user["name"], ENT_COMPAT, 'UTF-8')."\">".$user["name"]."</option>\n");
							}
						}
						?>
					</select>
				<td>
			</tr>
			<tr>
				<td colspan="3">
					<br />
					<input type="submit" value="Enregistrer" style="width: 120px" accesskey="s"><!-- Store ACLs-->
					<input type="button" value="Annuler" onClick="history.back();" style="width: 120px"><!-- Cancel -->
				</td>
			</tr>
		</table>
		<?php
		print($this->FormClose());
	}
}
else
{
	print("<i>Vous n'&ecirc;tes pas le propri&eacute;taire de cette page.</i>");
	//print("<i>You're not the owner of this page.</i>");
}

?>
</div>
