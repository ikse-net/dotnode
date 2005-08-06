<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="generator" content="Vim 6.2" />
<meta name="code_language" content="Mind" />
<meta name="robots" content="noarchive" />
<meta name="keywords" content="social,network,social network,networking,reseau social,dot,node,dotnode,dot node,friend,friends,ami,amis,amies,amie,reseaux,blog,album,photo,profil,profile,dotpage,homepage,france" />
<title>{$profile.info.login|escape|capitalize}'s dotPage</title>
<link rel="meta" type="application/rdf+xml" title="FOAF" href="/xml/foaf" />
<link rel="shortcut icon" type="image/png" href="/img/favicon.png" />
<link rel="stylesheet" type="text/css" href="/styles/{$dotpage_css|default:'default'}/style.css" media="screen" title="My style" id='css' />
{foreach from=$css item=style}
<link rel="alternate stylesheet" type="text/css" href="/styles/{$style}/style.css" media="screen" title="{$style|capitalize}" />
{/foreach}
<script type="text/javascript" src="/javascript/pngfix.js"></script>
</head>

<body{if $lang=='fa_IR'} dir='rtl'{/if}>
<div id='header'>
	<p id='flags'>
	<a class='flag' href='http://dotnode.com/action/select_language/en_US'><img src='/img/flags/en_US.png' alt='english' /></a>&nbsp;
	<a class='flag' href='http://dotnode.com/action/select_language/fr_FR'><img src='/img/flags/fr_FR.png' alt='french' /></a>&nbsp;
	<a class='flag' href='http://dotnode.com/action/select_language/de_DE'><img src='/img/flags/de_DE.png' alt='deutch' /></a>&nbsp;
	<a class='flag' href='http://dotnode.com/action/select_language/es_ES'><img src='/img/flags/es_ES.png' alt='spanish' /></a>&nbsp;
	<a class='flag' href='http://dotnode.com/action/select_language/ca_ES'><img src='/img/flags/ca_ES.png' alt='catalan' /></a>&nbsp;
	<a class='flag' href='http://dotnode.com/action/select_language/pt_BR'><img src='/img/flags/pt_BR.png' alt='brazilian' /></a>&nbsp;
	<a class='flag' href='http://dotnode.com/action/select_language/ja_JP'><img src='/img/flags/ja_JP.png' alt='japanese' /></a>&nbsp;
	<a class='flag' href='http://dotnode.com/action/select_language/fa_IR'><img src='/img/flags/fa_IR.png' alt='farsi' /></a>&nbsp;
	</p>
<h1><a href='/'>{$profile.info.login|escape|capitalize}'s .page</a></h1>
<div class='poweredby'>Powered by <a href='http://dotnode.com/profile/{$profile.info.id}'>.node</a> social network</div>
</div>

<div id='main'>
{include file=$tpl}
</div> {* main *}

<div id='footer'>
{if $token[0] != "index.php"}<a href='/'>{t}Return to home{/t}</a><br />{/if}
{t escape='no' 1="<select onChange=\"document.getElementById('css').href=this.value\">"}Style : %1{/t}
{foreach from=$css item=style}
<option value='/styles/{$style}/style.css'{if $dotpage_css == $style} selected='selected'{/if}>{$style|capitalize}</option>
{/foreach}
</select>

<p>
<a href='http://dotnode.com'><img style="border:0;width:88px;height:31px" src='/img/logo_88x31.png' alt='logo dotnode.com' /></a>
<a href="http://ikse.net" title='Serveur dédié virtuel et conception : Ikse'><img style="border:0;width:88px;height:31px" src="http://ikse.net/images/ikse.net-88x31.png" alt="Serveur dédié virtuel et conception : Ikse" /></a>
<a href="http://validator.w3.org/check?uri=referer"><img style="border:0;width:88px;height:31px" src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0!" /></a>
</p>
</div>

</body>
</html>

