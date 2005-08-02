<p>{t}Describe your job.{/t}</p>
<table>

<tr class='{cycle name='parity' values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'><a href='http://www.6nergies.net'><img src='/img/6nergies-favicon.png' alt='6nergies.net' /></a>&nbsp;{t escape='no'}<a href='http://www.6nergies.net'>6nergies.net</a> profile address{/t} : </td>
<td class='value' nowrap='true' colspan='2'>http://www.6nergies.net/people/<input type='text' name='professional[6nergies_url]' {if $smarty.session.6nergies_url}value="{$smarty.session.6nergies_url|escape}" disabled='true'{/if} /></td>
</tr>

<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Occupation{/t} : </td><td class='value' colspan='2'><input type='text' name='professional[occupation]' value='{$my.professional.occupation|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Industry{/t} : </td><td class='value' colspan='2'>{html_options name='professional[industry]' options=$labels.profile.industry selected=$my.professional.industry}</td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Company name{/t} : </td><td class='value'><input type='text' name='professional[company]' value='{$my.professional.company|escape}' /></td>
<td class='access'>{html_access_options name=access table=user_professional field=company}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Web{/t} : </td><td class='value' colspan='2'><input type='text' name='professional[web]' value='{$my.professional.web|escape|default:'http://'}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Title{/t} : </td><td class='value' colspan='2'><input type='text' name='professional[title]' value='{$my.professional.title|escape}' /></td></tr>
</table>

