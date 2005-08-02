<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="generator" content="Vim 6.2" />
<meta name="code_language" content="Mind" />
<meta name="robots" content="noarchive" />
<title>dotNode Translation Project :: {$smarty.session.my_lang}</title>
<link rel="stylesheet" type="text/css" href="/default.css" media="screen" title="My style" />
</head>

<body>
<div id='title'>
<a href='/' style='float: left'><img style='float: left' src='/img/script_logo.png' alt='Logo .node' /></a><h1>Translation Project :: {$smarty.session.my_lang} / {$smarty.session.my_level}</h1>
</div>
{if $smarty.session.my_id}
<ul id='menu'>
<li><a href='/my'>New entries</a></li>
<li><a href='/language'>Language informations</a></li>
<li><a href='/action/logout'>Logout</a></li>
</ul>
{else}
<p>
<ul id='menu'>
<li>You must be a translator to access here.</li>
</ul>
{/if}
<div id='main'>
