{literal}
<script type='text/javascript'>
current_mail = 0;
function mread(link, id_mess, flag)
{
	if(current_mail != 0)
		current_mail.style.display = 'none';
	mail = document.getElementById('mess'+id_mess);
	mail.style.display = 'block';


	current_mail = mail;
	if(link.style.fontWeight != 'normal' && flag=='new')
	{
		link.style.fontWeight = 'normal';
		action = document.getElementById('readaction');	
		action.src ='/action/messages/flag/read/'+id_mess;
	}


	return true;
}
</script>
{/literal}

<h2>{t}Inbox{/t}</h2>
<form action='/action/messages/group_delete' method='post' onSubmit="return confirm('{t}Confirm delete ?{/t}')">
<div id='msglist'>
<table>
<tr><th class='profileHeader' colspan='4'>{t}Inbox messages{/t}</th></tr>
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
<td><input type='checkbox' name='mess[{$id_mess}]' value='selected' {if $message.type!='message'}disabled='disabled'{/if} /><img src='/img/{$message.type}_{$message.dest}.png' alt='{$message.dest}' /></td>
<td>{$message.from_str|escape}</td>
<td class='{$message.flag}'><a class='subject' href='#mess{$id_mess}' onClick="return mread(this, {$id_mess}, '{$message.flag}');">{$message.subject|escape}</a></td>
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
</div>
{if $pagination.nb_elements > 1}
<input type='submit' value='{t}Delete selection{/t}' />
{/if}
</form>
<br />
<div id='message'>
{foreach name=messages from=$messages item=message key=id_mess}
<div id='mess{$id_mess}' style='display:none'>
<a name='mess{$id_mess}'></a>
<table>
<tr><th class='profileHeader' colspan='2'>{t}Message{/t}</th></tr>
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' class='label'>{t}From{/t}:</td><td>
{if $message.type == 'message'}
<a href='/profile/{$message.id_from}'>{$message.from_str|escape}</a>
{else}
{$message.from_str|escape}
{/if}
</td></tr>
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' class='label'>{t}Subject{/t}:</td><td>{$message.subject|escape}</td></tr>
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' class='label'>{t}Date{/t}:</td><td>{$message.date|date_format:"%c"}</td></tr>
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' class='label'>{t}Message{/t}:</td><td>{$message.message|wikise}</td></tr>
{if $message.type == 'message'}
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'>
<td align='right' colspan='2'>
{strip}
<a href='/messages/write/{$message.id_from}/{$id_mess}' class='button'>{t}Reply{/t}</a>&nbsp;
<a href='/messages/forward/{$id_mess}' class='button'>{t}Forward{/t}</a>&nbsp;
<a href='/messages/save/{$id_mess}' class='button'>{t}Save{/t}</a>&nbsp;
<a href='/messages/delete/{$id_mess}' class='button' onClick="return confirm('{t}Confirm delete ?{/t}')">{t}Delete{/t}</a>
{/strip}
</td></tr>

{elseif $message.type == 'system'}
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'>
<td align='right' colspan='2'>
{strip}
<a href='/messages/delete/{$id_mess}' class='button' onClick="return confirm('{t}Confirm delete ?{/t}')">{t}Delete{/t}</a>
{/strip}
</td></tr>


{elseif $message.type == 'friend_invitation'}
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' colspan='2'><a href='/action/{$message.id_from}/friends/invitation/accept/yes' class='button'>{t}Yes{/t}</a>&nbsp;<a href='/action/{$message.id_from}/friends/invitation/accept/no' class='button'>{t}No{/t}</a></td></tr>

{elseif $message.type == 'friend_invitation_accepted'}
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' colspan='2'><a href='/action/{$message.id_from}/friends/invitation/accepted' class='button'>{t}Ok{/t}</a></td></tr>

{elseif $message.type == 'friend_invitation_refused'}
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' colspan='2'><a href='/action/{$message.id_from}/friends/invitation/refused' class='button'>{t}Ok{/t}</a></td></tr>

{elseif $message.type == 'community_moderation_accept'}
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' colspan='2'><a href='/action/communities/moderation/accepted/{$message.id_mess}' class='button'>{t}Ok{/t}</a></td></tr>

{elseif $message.type == 'community_moderation_refuse'}
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' colspan='2'><a href='/action/communities/moderation/refused/{$message.id_mess}' class='button'>{t}Ok{/t}</a></td></tr>

{elseif $message.type == 'community_moderation_waiting'}
<tr class='{cycle name=mess`$id_mess` values='odd,even'}'><td align='right' colspan='2'><a href='/action/communities/moderation/waiting/{$message.id_mess}' class='button'>{t}Ok{/t}</a></td></tr>
{/if}



</table>
</div>
{/foreach}
</div>

<div style="display: none">
<img id='readaction' src='' alt='' />
</div>

