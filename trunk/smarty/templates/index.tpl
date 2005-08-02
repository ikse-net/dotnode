{config_load file="dotnode.config"}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="generator" content="Vim 6.2" />
<meta name="code_language" content="Mind" />
<meta name="Keywords" content="social,network,social network,networking, reseau social,dot,node,dotnode,dot node,friend,friends,ami,amis,amies,amie,reseaux,blog,album,photo,profil,profile,dotpage,homepage,france" />
<link rel="shortcut icon" type="image/png" href="/img/favicon.png" />
<title>{t}{$Title|default:'Social Network'}{/t} - {#SiteName#}</title>
<link rel="stylesheet" type="text/css" href="/default.css" media="all" title="Default" />
</head>
<body>
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

<p>{t}Select your language{/t}:&nbsp;
<a class='flag' href='/action/select_language/en_US'><img src='/img/flag_en.png' alt='english' /></a>&nbsp;
<a class='flag' href='/action/select_language/fr_FR'><img src='/img/flag_fr.png' alt='french' /></a>&nbsp;
<a class='flag' href='/action/select_language/es_ES'><img src='/img/flag_es.png' alt='spanish' /></a>&nbsp;
<a class='flag' href='/action/select_language/pt_BR'><img src='/img/flag_br.png' alt='brazilian' /></a>&nbsp;
<a class='flag' href='/action/select_language/ja_JP'><img src='/img/flag_ja.png' alt='japanese' /></a>&nbsp;
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

{if $menu}
{strip}
<ul id='menu'>
{foreach name=menu from=$menu item=title key=link}
{strip}<li><a href='
{if $link[0] neq '/'}
        /{$link}
{else}
        {$link}
{/if}
'{if $token[0] eq $link|@basename} class='active'{/if}>{t}{$title}{/t}</a></li>{/strip}
{/foreach}
</ul>
{/strip}
{/if}

{if $smenu}
{strip}
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
{/strip}
{/if}
</div>

{if $ssmenu}
{strip}
<ul id='ssmenu'>
{foreach name=ssmenu from=$ssmenu item=title key=link}
<li><a href='/{$token[0]}/{$token[1]}/{$link}'{if $token[2] eq $link|@basename} class='active'{/if}>{t}{$title}{/t}</a></li>
{/foreach}
</ul>
{/strip}
{/if}

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
<p>{$smarty.session.error.msg|escape|nl2br}</p>
<div style='text-align:center'><a class='button' href="javascript:close_error()">{t}Close{/t}</a></div>
<br />
</div>
{/if}

{include file=$tpl}
</div>
<div id='footer'>
{if $token[0] != 'pub'}
<p>{t}A problem with this page ? bad translation ? review this page for moderation ?{/t} <a href='/ReportBogus?url={$smarty.server.PHP_SELF|escape:'url'}'>{t}Report a problem{/t}</a><br />
{t}Display problem with this site ?{/t} <a href='/help/about#standard'>{t}See this page about Web standard{/t}</a></p>
{/if}
 <form style="display: inline;" method='post' id='cnil' action='http://www.cnil.fr/index.php?id=29'><p>{t}CNIL registration number{/t}: <input type='hidden' name='txtCritere' value='1011429' /><a href='http://www.cnil.fr/index.php?id=29' onClick="document.forms['cnil'].submit(); return false;">1011429</a> - {t}To contact me{/t} : {mailto address="nyrk&#64;dotnode.com" encode="javascript"}</p></form>
<p>
<a href="http://www.ikse.net" ><img style="width:88px;height:31px" src="http://ikse.net/images/ikse.net-88x31.png" alt="Hosted by Ikse.net" /></a>
{if $token[0] == 'pub'}
<a href="http://validator.w3.org/check/referer"><img style="width:88px;height:31px" src="/img/xhtml-1.png" alt="Valid XHTML 1.0!" height="31" width="88" /></a>
<a href="http://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fdotnode.com%2Fdefault.css&amp;warning=2&amp;profile=css2&amp;usermedium=all"><img style="width:88px;height:31px" src="/img/css.png" alt="Valid CSS!" /></a>
{/if}
</p>
{if $smarty.server.REMOTE_ADDR eq "82.226.113.191"}
Template utilisé : {$tpl}<br />
Help template utilisé : {$help_tpl}<br />
Include utilisé: {$inc}<br />
dotnodeSessID: <a href='?SMARTY_DEBUG' >{$smarty.cookies.dotnodeSessID}</a><br />
Accept-language: {$smarty.server.HTTP_ACCEPT_LANGUAGE}<br />
Langue:  {$lang}<br />
Mémoire utilisée: {$php_mem} KiB
{/if}
</div>

</body>
</html>
