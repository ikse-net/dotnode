{if $avancement}
<table style='width: 200px'>
<caption>Statistics on {$nb_msgid} msgid</caption>
{foreach from=$avancement item=lang_stat key=lang}
<tr class='{cycle values='odd,even'}'>
<td class='right'>{$lang}</td><td>{$lang_stat.score|string_format:"%.2f"} %</td>
</tr>
{/foreach}
</table>
{/if}

{if $waiting_entries}
<table>
<caption>Moderate waiting entries</caption>
{foreach from=$waiting_entries item=message}
<tr class='{cycle values='odd,even'}'>
<td class='right'>{if $message.day}<b>{$message.date|date_format:'%x'}</b>{/if}</td>
<td class='right'><i>{$message.date|date_format:'%X'}</i></td>
<td class='right' style='white-space:pre'>{$message.msgid|escape|truncate:'100':'[...]'}</td>
<td>&nbsp;<a href='/action/msgid/accept/{$message.id}'>Accept</a>&nbsp;</td>
<td>&nbsp;<a href='http://dotnode.com{$message.first_see}' title="(some sentence can't be viewed directly)">View it</a>&nbsp;</td>
</tr>
{/foreach}
</table>
{/if}


{if $new_entries}
<table>
<caption>New entries</caption>
{foreach from=$new_entries item=message}
<tr class='{cycle values='odd,even'}'>
<td class='right'>{if $message.day}<b>{$message.date|date_format:'%x'}</b>{/if}</td>
<td class='right'><i>{$message.date|date_format:'%X'}</i></td>
<td class='right' style='white-space:pre'>{$message.msgid|escape|truncate:'100':'[...]'}</td>
<td>&nbsp;<a href='/translate/{$message.id}'>Translate</a>&nbsp;</td>
<td>&nbsp;<a href='http://dotnode.com{$message.first_see}' title="(some sentence can't be viewed directly)">View it</a>&nbsp;</td>
</tr>
{/foreach}
</table>
{/if}

{if $last_modifs}
<table>
<caption>Last changes</caption>
{foreach from=$last_modifs item=message}
<tr class='{cycle values='odd,even'}'>
<td class='right'>{if $message.day}<b>{$message.date|date_format:'%x'}</b>{/if}</td>
<td class='right'><i>{$message.date|date_format:'%X'}</i> by <a href='/dotprofile/{$message.translator}'>{$message.translator}</a></td>
<td class='right'>{$message.msgid|escape}</td>
<td  class='right'{if $rtf} dir='rtl'{/if}>{$message.msgstr|escape}</td>
<td>&nbsp;<a href='/translate/{$message.id}'>Modify</a>&nbsp;</td>
<td>&nbsp;<a href='/history/{$message.id}'>History</a>&nbsp;</td>
<td>&nbsp;<a href='http://dotnode.com{$message.first_see}'>View it</a>&nbsp;</td>
{if $smarty.session.my_level == 'admin' || $smarty.session.my_level == 'verif'}
<td>&nbsp;<a href='/action/msgstr/valid/{$message.id}'>Valid !</a>&nbsp;</td>
{/if}
</tr>
{/foreach}
</table>
{/if}

