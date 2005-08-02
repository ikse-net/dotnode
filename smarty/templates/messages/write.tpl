{literal}
<script type='text/javascript'>
function show_friends_list(arg)
{
	friendlist = document.getElementById('friendlist');
	if(arg==true)
		friendlist.style.display = 'inline';
	else
		friendlist.style.display = 'none';
	return true;
}
</script>
{/literal}

{if $to}
<form action='/action/messages/write/send/{$to.id}/{$token[3]}' method='post'>
{else}
<form action='/action/messages/write/send' method='post'>
{/if}
<table>
<tr><th class='profileHeader' colspan='2'>{t}Compose message{/t}</th></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}To{/t}:</td><td>
{if $to}
{$to.fname} {$to.lname}
{else}
<label for='radioone'><img src='/img/message_one.png' alt='one'/><input type='radio' name='dest' id='radioone' value='one' checked='checked' onClick='show_friends_list(true)' />{t}Friend{/t}</label>&nbsp;<span id='friendlist'>{html_options name='to' options=$friends}</span><br />
<label for='radiofriends'><img src='/img/message_friends.png' alt='friends'/><input type='radio' name='dest' id='radiofriends' value='friends' onClick='show_friends_list(false)' />{t}Friends{/t}</label><br />
<label for='radiofoaf'><img src='/img/message_friends_of_friends.png' alt='friends of friends'/><input type='radio' name='dest' id='radiofoaf' value='friends_of_friends' onClick='show_friends_list(false)' />{t}Friends and friends of friends{/t}</label></td></tr>
{/if}
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Subject{/t}:</td><td><input type='text' name='subject' value='{if $message}Re: {$message.subject|escape}{else}{$smarty.session.error.post.subject|escape}{/if}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Message{/t}:</td><td><textarea name='message' cols='84' rows='10'>{if $message}{textformat indent=1 indent_char="\n> " wrap=80 assign=mess wrap_char=''}{$message.message}{/textformat}{$mess|escape}{else}{$smarty.session.error.post.message|escape}{/if}</textarea></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' colspan='2'><input type='submit' value='{t}Send{/t}' /></td></tr>
</table>
</form>
