<?php
	$message = $this->GetMessage();
	$user = $this->GetUser();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>


<head>
<title><?php echo $this->GetWakkaName().".".$this->lang.": ".$this->GetPageTag(); ?></title>
<?php if ($this->GetMethod() != 'show')
    echo "<meta name=\"robots\" content=\"noindex, nofollow\"/>\n";?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="keywords" content="<?php echo $this->GetConfigValue("meta_keywords") ?>" />
<meta name="description" content="<?php echo  $this->GetConfigValue("meta_description") ?>" />
<link rel="stylesheet" type="text/css" media="screen" href="/wakka.basic.css" />
<link rel="shortcut icon" type="image/png" href="/img/favicon-wiki.png" />
<style type="text/css" media="all"> @import "/wakka.css";</style>
<script type="text/javascript">
	function fKeyDown()	{ if (event.keyCode == 9) {
					event.returnValue= false;
					document.selection.createRange().text = String.fromCharCode(9) } }
</script>
</head>


<body <?php echo (!$user || ($user["doubleclickedit"] == 'Y')) && ($this->GetMethod() == "show") ? "ondblclick=\"document.location='".$this->href("edit")."';\" " : "" ?>
	<?php echo $message ? "onLoad=\"alert('".$message."');\" " : "" ?>
>


<h1 class="wiki_name"><?php echo $this->config["wakka_name"] ?>::<?php echo $this->lang ?></h1>


<h1 class="page_name">
	<a href="<?php echo $this->config["base_url"] ?>RechercheTexte?phrase=<?php echo urlencode($this->GetPageTag()); ?>">
	<?php echo $this->GetPageTag(); ?></a>
	<img src='/img/flags/<?php echo $this->lang ?>.png' alt='<?php echo $this->lang ?>' />
</h1>

<div class="header">
	<?php if($this->lang!='en_US') { ?> <a href='/en_US/<?php echo urlencode($this->GetPageTag()); ?>'><img src='/img/flags/en.png' alt='en_US' /></a> <?php } ?>
        <?php if($this->lang!='fr_FR') { ?> <a href='/fr_FR/<?php echo urlencode($this->GetPageTag()); ?>'><img src='/img/flags/fr.png' alt='fr_FR' /></a> <?php } ?>
        <?php if($this->lang!='es_ES') { ?> <a href='/es_ES/<?php echo urlencode($this->GetPageTag()); ?>'><img src='/img/flags/es.png' alt='es_ES' /></a> <?php } ?>
        <?php if($this->lang!='de_DE') { ?> <a href='/de_DE/<?php echo urlencode($this->GetPageTag()); ?>'><img src='/img/flags/de.png' alt='de_DE' /></a> <?php } ?>
        <?php if($this->lang!='ja_JP') { ?> <a href='/ja_JP/<?php echo urlencode($this->GetPageTag()); ?>'><img src='/img/flags/ja.png' alt='ja_JP' /></a> <?php } ?>
        <?php if($this->lang!='pt_BR') { ?> <a href='/pt_BR/<?php echo urlencode($this->GetPageTag()); ?>'><img src='/img/flags/br.png' alt='pt_BR' /></a> <?php } ?>
        <?php if($this->lang!='fa_IR') { ?> <a href='/fa_IR/<?php echo urlencode($this->GetPageTag()); ?>'><img src='/img/flags/fa.png' alt='fa_IR' /></a> <?php } ?>
        | <?php echo $this->ComposeLinkToPage($this->config["root_page"]); ?> ::
	<?php echo  $this->config["navigation_links"] ? $this->Format($this->config["navigation_links"])." :: \n" : "" ?>
	Vous êtes <?php echo $this->Format($this->GetUserName()); if ($user = $this->GetUser()) echo " (<a href=\"".$this->config["base_url"] ."ParametresUtilisateur?action=logout\">Déconnexion</a>)\n"; ?>
</div>
