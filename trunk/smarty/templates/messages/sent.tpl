{literal}
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

<h2>{t}Sent messages{/t}</h2>
<div id='msglist'>
<table>
<tr><th class='profileHeader' colspan='4'>{t}Sent messages{/t}</th></tr>
<tr><td class='{cycle values='odd,even'} pagination' colspan='4'>{$pager.all}</td></tr>
{foreach name=messages from=$messages item=message key=id_mess}
<tr class='{cycle values='odd,even'}'>
<td><img src='/img/{$message.type}_{$message.dest}.png' alt='{$message.dest}' /></td>
<td>{$message.dest_str}</td>
<td><a href='#mess{$id_mess}' onClick="return mread({$id_mess});">{$message.subject|escape}</a></td>
<td>{$message.date|date_format:"%c"}</td>
</tr>
{foreachelse}
<tr><td align='center'>{t}No message{/t}</td></tr>
{/foreach}
<tr><td class='{cycle values='odd,even'} pagination' colspan='4'>{$pager.all}</td></tr>
</table>
</div>

<br />

<div id='message'>
{foreach name=messages from=$messages item=message key=id_mess}
<div id='mess{$id_mess}' style='display:none'>
<a name='mess{$id_mess}'></a>
<table>
<tr><th class='profileHeader' colspan='2'>Message</th></tr>
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' class='label'>{t}To{/t}:</td><td>{$message.dest_str}</td></tr>
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' class='label'>{t}Subject{/t}:</td><td>{$message.subject|escape}</td></tr>
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' class='label'>{t}Date{/t}:</td><td>{$message.date|date_format:"%c"}</td></tr>
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' class='label'>{t}Message{/t}:</td><td>{$message.message|wikise}</td></tr>
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' colspan='2'><a href='/messages/delete/{$id_mess}/{$token[1]}' class='button' onClick="return confirm('{t}Confirm delete ?{/t}')">{t}Delete{/t}</a></td></tr>
</table>
</div>
{/foreach}
</div>
