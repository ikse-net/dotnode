<b>msgid</b>:<pre>{$msgid.msgid|escape}</pre>
{if $msgid.msgid_plural}<b>msgid</b>:<pre>{$msgid.msgid_plural|escape}</pre>{/if}
<hr />

{if $historic}
<form action='/action/msgstr/change_last/{$token[1]}' method='post'>
<table>
<caption>Historic of #{$msgid.id}</caption>
{foreach from=$historic item=message}
<tr class='{cycle values='odd,even'}'>
<td class='right'>{if $message.day}<b>{$message.date|date_format:'%x'}</b>{/if}</td>
<td class='right'><i>{$message.date|date_format:'%X'}</i> by <a href='/dotprofile/{$message.translator|escape}'>{$message.translator|escape}</a></td>
<td><input  type='radio' name='last' value='{$message.id_msgstr|escape}'{if $message.last == 'y'} checked='checked'{/if}/></td>
<td class='right'{if $message.last == 'y'} style='font-weight: bold'{/if}{if $rtf} dir='rtl'{/if}>{$message.msgstr|escape}</td>
</tr>
{/foreach}
<tr><td colspan='4'><input type='submit' value='Change' /></td></tr>
</table>
</form>
{/if}

