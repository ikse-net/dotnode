<?php

if (($user = $this->GetUser()) && ($user["name"]==$this->GetConfigValue("admin")) && $this->GetConfigValue("admin"))
{

	if (($_REQUEST["action"] == "resetpass"))
	{
			
		$this->Query("update ".$this->config["table_prefix"]."users set ".
					"password = md5('".mysql_escape_string($_POST["password"])."') ".
					"where name = '".mysql_escape_string($_POST["name"])."' limit 1");				
					
				$this->SetMessage("Mot de passe réinitialisé !");
				$this->Redirect($this->href());
	}
	else
	{
		$error="";
		//$error = "Il est interdit de réinistialiser le mot de pass de cet utilisateur ! Non mais !";
	}
	
	print($this->FormOpen());
	$name=$_GET["name"];
	?>
	<input type="hidden" name="action" value="resetpass">
	<table>
		<tr>
			<td align="right"></td>
			<td><?php echo  $this->Format("Réinitialisation du mot de passe"); ?></td>
		</tr>
		<?php
		if ($error)
		{
			print("<tr><td></td><td><div class=\"error\">".$this->Format($error)."</div></td></tr>\n");
		}
		?>
		<tr>
			<td align="right">Login:</td>
			<td><input name="name" size="40" value="<?php echo  $name ?>"></td>
		</tr>
		<tr>
			<td align="right">Nouveau mot de passe:</td>
			<td><input type="password" name="password" size="40"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Reset password" size="40"></td>
		</tr>
	</table>
	<?php
	print($this->FormClose());
}
else
{
	print("<i>Vous n'avez pas les permissions nécessaires pour l'exécution de cette action.</i>");
}

?>
	
