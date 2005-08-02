<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{$smarty.session.my_fname} {$smarty.session.my_lname}</h2>
<form action='/action/my/profile/professional/record' method='post'>
<table width='500'>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'><a href='http://www.6nergies.net'><img src='/img/6nergies-favicon.png' alt='6nergies.net' /></a>&nbsp;{t escape='no'}<a href='http://www.6nergies.net'>6nergies.net</a> profile address{/t} : </td><td class='value' colspan='2' nowrap='true'>http://www.6nergies.net/people/<input type='text' name='6nergies_url' value='{$my.professional.6nergies_url|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Occupation{/t} : </td><td class='value' colspan='2'><input type='text' name='occupation' value='{$my.professional.occupation|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Industry{/t} : </td><td class='value' colspan='2'>{html_options name='industry' options=$labels.profile.industry selected=$my.professional.industry}</td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Company name{/t} : </td><td class='value'><input type='text' name='company' value='{$my.professional.company|escape}' /></td>
<td class='access'>{html_access_options name=access table=user_professional field=company}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Web{/t} : </td><td class='value' colspan='2'><input type='text' name='web' value='{$my.professional.web|escape|default:'http://'}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Title{/t} : </td><td class='value' colspan='2'><input type='text' name='title' value='{$my.professional.title|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Work email{/t} : </td><td class='value'><input type='text' name='email' value='{$my.professional.email|escape}' /></td>
<td class='access'>{html_access_options name=access table=user_professional field=email}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Work phone{/t} : </td><td class='value'><input type='text' name='phone' value='{$my.professional.phone|escape}' /></td>
<td class='access'>{html_access_options name=access table=user_professional field=phone}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Job description{/t} : </td><td class='value' colspan='2'><textarea name='description' rows='5' cols='36'>{$my.professional.description|escape}</textarea></td></tr>
<tr class='{cycle values='odd,even'}'><td colspan='3' align='center'><input type='submit' value='{t}Record{/t}'><td></tr>
</table>
</form>
</div>
<div style="clear:both"></div>

