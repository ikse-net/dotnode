<p>{t}Indicate information about you.{/t}
</p>
<table>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Login{/t} : </td>
<td class='value' colspan='2'><b>{$smarty.session.my_login}</b></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label must'>{t}First name{/t} : </td>
<td class='value' colspan='2'><input type='text' name='fname' value='{$smarty.session.my_fname|escape}' /></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label must'>{t}Last name{/t} : </td>
<td class='value' colspan='2'><input type='text' name='lname' value='{$smarty.session.my_lname|escape}' /></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Nickname{/t} : </td>
<td class='value' colspan='2'><input type='text' name='nick' value='{$smarty.session.my_nick|escape}' /></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label must'>{t}Gender{/t} : </td>
<td class='value' colspan='2'>{html_radios name='general[gender]' options=$labels.profile.gender checked=$my.general.gender}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Relationship status{/t} : </td>
<td class='value' colspan='2'>{html_options name='general[relationship_status]' options=$labels.profile.relationship_status selected=$my.general.relationship_status}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Birthday{/t} : </td>
<td class='value'>{html_select_date field_array='general[birthday]' prefix='' time=$my.general.birthday start_year=-120 reverse_years=true field_order=DMY}</td>
<td class='access'>{html_access_options name=access table=user_general field=birthday}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}I'm interested in{/t} : </td>
<td class='value' colspan='2'>{html_checkboxes name='general[here_for]' options=$labels.profile.here_for checked=$my.general.here_for separator='<br />'}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Living{/t} : </td>
<td class='value' colspan='2'>{html_checkboxes name='general[living]' options=$labels.profile.living checked=$my.general.living separator='<br />'}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}My Web{/t} : </td>
<td class='value' colspan='2'><input type='text' name='general[web]' value='{$my.general.web|escape|default:'http://'}' /></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Describe yourself{/t} : </td>
<td class='value' colspan='2'><textarea name='general[description]' rows='5' cols='36'>{$my.general.description|escape}</textarea></td>
</tr>

</table>
