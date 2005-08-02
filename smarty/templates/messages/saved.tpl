{literal}
<style type='text/css'>
#msglist table { width: 70%;}
#message table { width: 70%; border-width: 3px;}
</style>

<script type='text/javascript'>
current_mail = 0;
function mread(id_mess)
{
	if(current_mail != 0)
		current_mail.style.display = 'none';
	mail = document.getElementById('mess'+id_mess);
	mail.style.display = 'block';
	current_mail = mail;
	return true;
}
</script>
{/literal}

<h2>{t}Saved messages{/t}</h2>
<div id='msglist'>
<table>
<tr><th class='profileHeader' colspan='4'>{t}Saved messages{/t}</th></tr>
{strip}
<tr><td class='{cycle values='odd,even'} pagination' colspan='4'>
{t}Page:{/t}
{foreach from=$pagination.pages item=none key=page}
{if $pagination.current_page == $page}
&nbsp;<strong>{$page}</strong>
{else}
&nbsp;<a href='/messages/{$token[1]}/{$page}'>{$page}</a>
{/if}
{/foreach}
</td></tr>
{/strip}
{foreach name=messages from=$messages item=message key=id_mess}
<tr class='{cycle values='odd,even'}'>
<td><img src='/img/{$message.type}_{$message.dest}.png' alt='{$message.dest}' /></td>
<td>{$message.from_str|escape}</td>
<td><a href='#mess{$id_mess}' onClick="return mread({$id_mess});">{$message.subject|escape}</a></td>
<td>{$message.date|date_format:"%c"}</td>
</tr>
{foreachelse}
<tr><td align='center'>{t}No message{/t}</td></tr>
{/foreach}
{strip}
<tr><td class='{cycle values='odd,even'} pagination' colspan='4'>
{t}Page:{/t}
{foreach from=$pagination.pages item=none key=page}
{if $pagination.current_page == $page}
&nbsp;<strong>{$page}</strong>
{else}
&nbsp;<a href='/messages/{$token[1]}/{$page}'>{$page}</a>
{/if}
{/foreach}
</td></tr>
{/strip}
</table>
</div> {* msglist *}
<br />
<div id='message'>
{foreach name=messages from=$messages item=message key=id_mess}
<div id='mess{$id_mess}' style='display:none'>
<a name='mess{$id_mess}'></a>
<table>
<tr><th class='profileHeader' colspan='2'>{t}Message{/t}</th></tr>
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' class='label'>{t}From{/t}:</td><td><a href='/profile/{$message.id_from}'>{$message.from_str|escape}</a></td></tr>
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' class='label'>{t}Subject{/t}:</td><td>{$message.subject|escape}</td></tr>
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' class='label'>{t}Date{/t}:</td><td>{$message.date|date_format:"%c"}</td></tr>
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' class='label'>{t}Message{/t}:</td><td>{$message.message|wikise}</td></tr>
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' colspan='2'>
{strip}
<a href='/messages/write/{$message.id_from}/{$id_mess}' class='button'>{t}Reply{/t}</a>&nbsp;
<a href='/messages/forward/{$id_mess}' class='button'>{t}Forward{/t}</a>&nbsp;
<a href='/messages/delete/{$id_mess}/{$token[1]}' class='button' onClick="return confirm('{t}Confirm delete ?{/t}')">{t}Delete{/t}</a></td></tr>
{/strip}
</table>
</div> {* messageXX *}
{/foreach}
</div> {* message *}
