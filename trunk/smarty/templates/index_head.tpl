<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
{config_load file="dotnode.config"}
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noarchive,noindex" />
	<meta name="generator" content="Vim 6.2" />
	<meta name="code_language" content="Mind" />
	<meta name="keywords" content="social,network,social network,networking,reseau social,dot,node,dotnode,dot node,friend,friends,ami,amis,amies,amie,reseaux,blog,album,photo,profil,profile,dotpage,homepage,france" />
	<link rel="shortcut icon" type="image/png" href="/img/favicon.png" />
	<title>{t}{$Title|default:'Social Network'}{/t} - {#SiteName#}</title>
	<link rel="stylesheet" type="text/css" href="/default.css" media="all" title="Default" />
{if $pager}
	{$pager.linktags}
{/if}
	<script type="text/javascript" src="/js/xmlhttp.js"></script>
</head>
<body{if $lang=='fa_IR'} dir='rtl'{/if}>
{if $help_tpl}
{literal}
<script type='text/javascript'>
function help()
{
	popupbox = document.getElementById('helpbox');
	if(popupbox.style.display == 'block')
		popupbox.style.display = 'none';
	else
		popupbox.style.display = 'block';	
}
</script>
{/literal}
{/if}
<span style="position:absolute; left:1px; top:1px; font-size: 8px">Beta::.</span>
<div id='title'>
{if $help_tpl}<p><a href="javascript:help()"><img class='icon' src='/img/help.png' alt='help' /></a></p>{/if}
<p>
<a class='flag' href='/action/select_language/en_US'><img src='/img/flags/en_US.png' alt='english' /></a>&nbsp;
<a class='flag' href='/action/select_language/fr_FR'><img src='/img/flags/fr_FR.png' alt='french' /></a>&nbsp;
<a class='flag' href='/action/select_language/de_DE'><img src='/img/flags/de_DE.png' alt='deutch' /></a>&nbsp;
<a class='flag' href='/action/select_language/es_ES'><img src='/img/flags/es_ES.png' alt='spanish' /></a>&nbsp;
<a class='flag' href='/action/select_language/ca_ES'><img src='/img/flags/ca_ES.png' alt='catalan' /></a>&nbsp;
<a class='flag' href='/action/select_language/pt_BR'><img src='/img/flags/pt_BR.png' alt='brazilian' /></a>&nbsp;
<a class='flag' href='/action/select_language/ja_JP'><img src='/img/flags/ja_JP.png' alt='japanese' /></a>&nbsp;
<a class='flag' href='/action/select_language/fa_IR'><img src='/img/flags/fa_IR.png' alt='farsi' /></a>&nbsp;
<a href='/communities/view/807'>{t}More ?{/t}</a>
{if $smarty.session.nb_new_messages}
<br /><img src='/img/message_new.png' alt='' align='middle' />&nbsp;<a class='newmessages' href='/messages/inbox'>{t escape='no' count=$smarty.session.nb_new_messages plural="You have <b>%1</b> new messages"}You have <b>%1</b> new message{/t}</a>
{elseif $smarty.session.my_login}
<br /><a class='messages' href='/messages/inbox'><img src='/img/message_no.png' alt='' align='middle' />&nbsp;{t}Go to my messagebox{/t}</a>
{/if}
{if $smarty.session.status=='guest' && !$smarty.session.my_login && $token[0] != 'new'}
<br /><a class='newmessages' href='/new'><b>{t}Return to the registration process{/t}</b></a>
{/if}
{if $smarty.session.status=='guest' && $token[0] != 'new' && $smarty.session.my_status=='waiting'}
<br /><a class='newmessages' href='/new'><b>{t}Return to the registration process{/t}</b></a>
{/if}

</p>
<a href='/' style='float: left'><img style='float: left' src='/img/script_logo.png' alt='Logo .node' /></a><h1>{t}{$Title|default:'Social Network'}{/t}</h1>
</div>

<ul id='menu'>
{foreach name=menu from=$menu item=title key=link}
{strip}<li><a href='
{if $link[0] neq '/'}
        /{$link}
{else}
        {$link}
{/if}
'{if $token[0] eq $link|@basename} class='active'{/if}{if $link == 'support'} style='font-weight: bold; color: darkorange'{/if}>{t}{$title}{/t}</a></li>{/strip}
{/foreach}
</ul>

<ul id='smenu'>
{foreach name=smenu from=$smenu item=title key=link}
{strip}<li><a href='
{if $link[0] neq '/'}
	/{$token[0]}/{$link}
{else}
	{$link}
{/if}
'{if $token[1] eq $link|@basename} class='active'{/if}>{t}{$title}{/t}</a></li>{/strip}
{/foreach}
</ul>

<ul id='ssmenu'>
{foreach name=ssmenu from=$ssmenu item=title key=link}
<li><a href='/{$token[0]}/{$token[1]}/{$link}'{if $token[2] eq $link|@basename} class='active'{/if}>{t}{$title}{/t}</a></li>
{/foreach}
</ul>

<div id='main'>

{if $help_tpl}
<div id='helpbox'>
<h1>{t}Help{/t}&nbsp;</h1>
<img class='icon' src='/img/help32.png' alt='help' />
<div class='help'>
{include file=$help_tpl}
</div>
<div class='close'><a class='button' href="javascript:help()" >{t}Close{/t}</a></div>
</div>
{/if}

{if $smarty.session.error}

<script type='text/javascript'>
{literal}
function close_error()
{
	errorbox = document.getElementById('error');
	errorbox.style.display = 'none';
}
{/literal}
</script>

<div id='error'>
<h1>{t}Error{/t}</h1>
<img src='/img/error-32.png' alt='Error' />
<h2>{$smarty.session.error.title|escape}</h2>
<p>{$smarty.session.error.msg|nl2br}</p>
<div style='text-align:center'><a class='button' href="javascript:close_error()">{t}Close{/t}</a></div>
<br />
</div>
{/if}
