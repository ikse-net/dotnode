<table style='width: 200px'>
<caption>Statistics on {$stats.nb_msgid} msgid</caption>
<tr class='{cycle values='odd,even'}'>
<td class='right'>Translated terms : </td><td>{$stats.nb_msgstr}</td>
<tr class='{cycle values='odd,even'}'>
<td class='right'>Percentage : </td><td>{$stats.to_complet|string_format:"%.2f"} %</td>
</tr>
</table>

<dl>
<dt>Administrator for {$smarty.session.my_lang}</dt>
<dd>{$admin_login|default:'No admin at this time'}</dd>

{if $translators}
<dt>Translators</dt>
<dd>
<ul>
{foreach from=$translators item=translator}
<li><a href='/dotprofile/{$translator}'>{$translator}</a></li>
{foreachelse}
<li>No translator :/</li>
{/foreach}
</ul>
</dd>
{/if}

{if $verificators}
<dt>Verificators</dt>
<dd>
<ul>
{foreach from=$verificators item=verificator}
<li><a href='/dotprofile/{$verificator}'>{$verificator}</a></li>
{foreachelse}
<li>No verificator :/</li>
{/foreach}
</ul>
</dd>
{/if}


</dl>
