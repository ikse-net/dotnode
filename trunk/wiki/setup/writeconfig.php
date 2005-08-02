<?php

// fetch config
$config = $config2 = unserialize($_POST["config"]);

// merge existing configuration with new one
$config = array_merge($wakkaConfig, $config);

// set version to current version, yay!
$config["wakka_version"] = WAKKA_VERSION;

// convert config array into PHP code
$configCode = "<?php\n// wakka.config.php cr��e ".strftime("%c")."\n// ne changez pas la wakka_version manuellement!\n\n\$wakkaConfig = array(\n";
foreach ($config as $k => $v)
{
	$entries[] = "\t\"".$k."\" => \"".$v."\"";
}
$configCode .= implode(",\n", $entries).");\n?>";

// try to write configuration file
print("<b>Cr�ation du fichier de configuration en cours...</b><br>\n");
test("�criture du fichier de configuration <tt>".$wakkaConfigLocation."</tt>...", $fp = @fopen($wakkaConfigLocation, "w"), "", 0);

if ($fp)
{
	fwrite($fp, $configCode);
	// write
	fclose($fp);
	
	print("<p>Voila c'est termin� ! Vous pouvez <a href=\"".$config["base_url"]."\">retourner sur votre site WikiNi</a>. Il est conseill� de retirer l'acc�s en �criture au fichier <tt>wakka.config.php</tt>. Ceci peut �tre une faille dans la s�curit�.</p>");
}
else
{
	// complain
	print("<p><span class=\"failed\">AVERTISSEMENT:</span> Le
fichier de configuration <tt>".$wakkaConfigLocation."</tt> n'a pu �tre
cr��. Veuillez vous assurez que votre serveur a les droits d'acc�s en �criture pour ce fichier. Si pour une raison quelconque vous ne pouvez pas faire �a vous devez copier les informations suivantes et les uploader sur le serveur dans un fichier <tt>wakka.config.php</tt> directement dans le r�pertoire de WikiNi. Une fois que vous aurez fais cela, votre site WikiNi devrait fonctionner correctement.</p>\n");
	?>
	<form action="<?php echo  myLocation() ?>?installAction=writeconfig" method="POST">
	<input type="hidden" name="config" value="<?php echo  htmlentities(serialize($config2, ENT_COMPAT, 'UTF-8')) ?>">
	<input type="submit" value="Essayer &agrave; nouveau">
	</form>	
	<?php
	print("<div style=\"background-color: #EEEEEE; padding: 10px 10px;\">\n<xmp>".$configCode."</xmp>\n</div>\n");
}

?>
