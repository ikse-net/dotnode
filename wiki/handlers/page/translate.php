<div class="page">
<?php
if ($this->HasAccess("write") && $this->HasAccess("read"))
{
	if ($_POST)
	{
		// only if saving:
		if ($_POST["submit"] == "Sauver")
		{
			// check for overwriting
			if ($this->page)
			{
				if ($this->page["id"] != $_POST["previous"])
				{
					$error = "ALERTE : ".
					"Cette page a été modifiée par quelqu'un d'autre pendant que vous l'éditiez.<br />\n".
					"Veuillez copier vos changements et re-editer cette page.\n";
				}
			}


			// store
			if (!$error)
			{
				$body = str_replace("\r", "", $_POST["body"]);

				// add page (revisions)
				$this->SavePage($this->tag, $body, "", $_POST["lang"]);

				// now we render it internally so we can write the updated link table.
				$this->ClearLinkTable();
				$this->StartLinkTracking();
				$dummy = $this->Header();
				$dummy .= $this->Format($body);
				$dummy .= $this->Footer();
				$this->StopLinkTracking();
				$this->WriteLinkTable();
				$this->ClearLinkTable();

				// forward
				$this->Redirect('/'.$_POST['lang'].'/'.$this->tag);
			}
		}
	}

	// fetch fields
	if (!$previous = $_POST["previous"]) $previous = $this->page["id"];
	if (!$body = $_POST["body"]) $body = $this->page["body"];

	// preview?
	if ($_POST["submit"] == "Aperçu")
	{
		$previewButtons =
			"<input name=\"submit\" type=\"submit\" value=\"Sauver\" accesskey=\"s\" />\n".
			"<input name=\"submit\" type=\"submit\" value=\"Re-Editer\" accesskey=\"p\" />\n".
			"<input type=\"button\" value=\"Annulation\" onClick=\"document.location='".$this->href("")."';\" />\n";
		
		$output .= "<div class=\"prev_alert\"><strong>Aperçu</strong></div>\n";

		$output .=
			$this->FormOpen("translate")."\n".
			"<input type=\"hidden\" name=\"previous\" value=\"".$previous."\" />\n".
			"<input type=\"hidden\" name=\"lang\" value=\"".$_POST["lang"]."\" />\n".
			"<input type=\"hidden\" name=\"body\" value=\"".htmlentities($body, ENT_COMPAT, 'UTF-8')."\" />\n";
		
		$output .= $this->Format($body);

		$output .=
			"<br />\n".
			$previewButtons.
			$this->FormClose()."\n";
	}
	else
	{
		// display form
		if ($error)
		{
			$output .= "<div class=\"error\">$error</div>\n";
		}

		// append a comment?
		if ($_REQUEST["appendcomment"])
		{
			$body = trim($body)."\n\n----\n\n--".$this->UserName()." (".strftime("%c").")";
		}

		$output .=
			$this->FormOpen("translate").
			"<input type=\"hidden\" name=\"previous\" value=\"".$previous."\" />\n".
			"<textarea onKeyDown=\"fKeyDown()\" name=\"body\" cols=\"60\" rows=\"40\" wrap=\"soft\" class=\"edit\">\n".
			htmlspecialchars($body, ENT_COMPAT, 'UTF-8').
			"\n</textarea><br />\n".
			($this->config["preview_before_save"] ? "" : "<input name=\"submit\" type=\"submit\" value=\"Sauver\" accesskey=\"s\" />\n").
			"<input name=\"submit\" type=\"submit\" value=\"Aperçu\" accesskey=\"p\" />\n".
			"<select name='lang'>\n".
			 "<option value='fr_FR'>fr_FR</option>\n".
			 "<option value='en_US'>en_US</option>\n".
			 "<option value='de_DE'>de_DE</option>\n".
			 "<option value='es_ES'>es_ES</option>\n".
			 "<option value='ja_JP'>ja_JP</option>\n".
			 "<option value='pt_BR'>pt_BR</option>\n".
			 "<option value='fa_IR'>fa_IR</option>\n".
			"</select>\n".
			"<input type=\"button\" value=\"Annulation\" onClick=\"document.location='".$this->href("")."';\" />\n".
			$this->FormClose();
	}


	echo $output;
}
else
{
	echo "<i>Vous n'avez pas accès en écriture à cette page !</i>\n";
}
?>
</div>
