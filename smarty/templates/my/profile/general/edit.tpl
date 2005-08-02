<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{$smarty.session.my_fname} {$smarty.session.my_lname}</h2>
<form action='/action/my/profile/general/record' method='post'>
<table width=500>
<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}First name{/t} : </td>
<td class='value' colspan='2'><input type='text' name='fname' value='{$smarty.session.my_fname|escape}' /></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Last name{/t} : </td>
<td class='value' colspan='2'><input type='text' name='lname' value='{$smarty.session.my_lname|escape}' /></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Nickname{/t} : </td>
<td class='value' colspan='2'><input type='text' name='nick' value='{$smarty.session.my_nick|escape}' /></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Gender{/t} : </td>
<td class='value' colspan='2'>{html_radios name='gender' options=$labels.profile.gender checked=$my.general.gender}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Relationship status{/t} : </td>
<td class='value' colspan='2'>{html_options name='relationship_status' options=$labels.profile.relationship_status selected=$my.general.relationship_status}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Birthday{/t} : </td>
<td class='value'>{html_select_date field_array='birthday' prefix='' time=$my.general.birthday start_year=-80 reverse_years=true field_order=DMY}</td>
<td class='access'>{html_access_options name=access table=user_general field=birthday}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}I'm interested in{/t} : </td>
<td class='value' colspan='2'>{html_checkboxes name='here_for' options=$labels.profile.here_for checked=$my.general.here_for separator='<br />'}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Children{/t} : </td>
<td class='value' colspan='2'>{html_options name='children' options=$labels.profile.children selected=$my.general.children}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Fashion{/t} : </td>
<td class='value' colspan='2'>{html_checkboxes name='fashion' options=$labels.profile.fashion checked=$my.general.fashion separator='<br />'}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Smoking{/t} : </td>
<td class='value' colspan='2'>{html_options name='smoking' options=$labels.profile.smoking selected=$my.general.smoking}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Drinking{/t} : </td>
<td class='value' colspan='2'>{html_options name='drinking' options=$labels.profile.drinking selected=$my.general.drinking}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Living{/t} : </td>
<td class='value' colspan='2'>{html_checkboxes name='living' options=$labels.profile.living checked=$my.general.living separator='<br />'}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}My Web{/t} : </td>
<td class='value' colspan='2'><input type='text' name='web' value='{$my.general.web|escape|default:'http://'}' /></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Describe yourself{/t} : </td>
<td class='value' colspan='2'><textarea name='description' rows='5' cols='36'>{$my.general.description|escape}</textarea></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td colspan='3' align='center'><input type='submit' value='{t}Record{/t}'><td>
</tr>

</table>
</form>
</div>
<div style="clear:both"></div>
