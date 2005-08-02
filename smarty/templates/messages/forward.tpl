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
<form action='/action/messages/write/send/{$to.id}' method='post'>
{else}
<form action='/action/messages/write/send' method='post'>
{/if}
<table>
<tr><th class='profileHeader' colspan='2'>{t}Compose message{/t}</th></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}To{/t}:</td><td>
{if $to}
{$to.fname} {$to.lname}
{else}
<input type='radio' name='dest' id='radioone' value='one' checked='checked' onClick='show_friends_list(true)' /><label for='radioone'>{t}Friend{/t}</label>&nbsp;<span id='friendlist'>{html_options name='to' options=$friends}</span><br />
<input type='radio' name='dest' id='radiofriends' value='friends' onClick='show_friends_list(false)' /><label for='radiofriends'>{t}Friends{/t}</label><br />
<input type='radio' name='dest' id='radiofoaf' value='friends_of_friends' onClick='show_friends_list(false)' /><label for='radiofoaf'>{t}Friends and friends of friends{/t}</label></td></tr>
{/if}
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Subject{/t}:</td><td><input type='text' name='subject' value='{if $message}Fwd: {$message.subject|escape}{/if}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Message{/t}:</td><td><textarea name='message' cols='84' rows='10'>
{if $message}
{t}__ Forwarded message: ______________{/t}

{t}From{/t}: {$message.from_str|escape}
{t}Subject{/t}: {$message.subject|escape}

{$message.message|escape}
{/if}
</textarea></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' colspan='2'><input type='submit' value='{t}Send{/t}' /></td></tr>
</table>
</form>
