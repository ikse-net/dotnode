<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{$smarty.session.my_fname} {$smarty.session.my_lname}</h2>
<form action='/action/my/profile/schools/edit/{$token[4]}' method='post'>
<table>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Year{/t} : </td><td class='value'>{html_select_date field_array=year time=$my.schools.year start_year='1911' display_days=false display_months=false reverse_years=true}</td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Name{/t} : </td><td class='value'><input type='text' name='name' value='{$my.schools.name|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}City{/t} : </td><td class='value'><input type='text' name='city' value='{$my.schools.city|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Country{/t} : </td><td class='value'>{html_options name='country' options=$labels.profile.country selected=$my.schools.country}</td></tr>
<tr class='{cycle values='odd,even'}'><td colspan='2' align='center'><input type='submit' value='{t}Save{/t}'><td></tr>
</table>
</form>
</div>
<div style="clear:both"></div>

