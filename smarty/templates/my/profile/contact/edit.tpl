<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{$smarty.session.my_fname} {$smarty.session.my_lname}</h2>
<form action='/action/my/profile/contact/record' method='post'>
<table>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Email{/t} : </td><td class='value'><input type='text' name='email' value='{$my.contact.email|escape}' /></td>
<td class='access'>{html_access_options name=access table=user_contact field=email}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Email{/t} (2) : </td><td class='value'><input type='text' name='email2' value='{$my.contact.email2|escape}' /></td>
<td class='access'>{html_access_options name=access table=user_contact field=email2}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Email{/t} (3) : </td><td class='value'><input type='text' name='email3' value='{$my.contact.email3|escape}' /></td>
<td class='access'>{html_access_options name=access table=user_contact field=email3}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Email{/t} (4) : </td><td class='value'><input type='text' name='email4' value='{$my.contact.email4|escape}' /></td>
<td class='access'>{html_access_options name=access table=user_contact field=email4}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Main IM{/t} : </td><td class='value'><input type='text' name='im' value='{$my.contact.im|escape}' />&nbsp;{html_options name='im_type' options=$labels.profile.im_type selected=$my.contact.im_type}</td>
<td class='access'>{html_access_options name=access table=user_contact field=im}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Secondary IM{/t} : </td><td class='value'><input type='text' name='im2' value='{$my.contact.im2|escape}' />&nbsp;{html_options name='im2_type' options=$labels.profile.im_type selected=$my.contact.im2_type}</td>
<td class='access'>{html_access_options name=access table=user_contact field=im2}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Phone{/t} : </td><td class='value'><input type='text' name='phone' value='{$my.contact.phone|escape}' /></td>
<td class='access'>{html_access_options name=access table=user_contact field=phone}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Cell phone{/t} : </td><td class='value'><input type='text' name='cell_phone' value='{$my.contact.cell_phone|escape}' /></td>
<td class='access'>{html_access_options name=access table=user_contact field=cell_phone}</td>
</tr>

<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Address{/t} : </td><td class='value'><textarea name='address' rows='5' cols='36'>{$my.contact.address|escape}</textarea></td>
<td class='access'>{html_access_options name=access table=user_contact field=address}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}ZIP{/t} : </td><td class='value' colspan='2'><input type='text' name='zip' value='{$my.contact.zip|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}City{/t} : </td><td class='value' colspan='2'><input type='text' name='city' value='{$my.contact.city|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Country{/t} : </td><td class='value' colspan='2'>{html_options name='country' options=$labels.profile.country selected=$my.contact.country}</td></tr>

<tr class='{cycle values='odd,even'}'><td colspan='3' align='center'><input type='submit' value='{t}Record{/t}'><td></tr>
</table>
</form>
</div>
<div style="clear:both"></div>

