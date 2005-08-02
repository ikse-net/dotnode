<p>{t}Indicate how to contact you.{/t}
</p><table>
<tr class='{cycle values='odd,even'}'><td align='right' class='label must'>{t}Email{/t}<br />({t escape='no'}You could change your<br />email after registration{/t}): </td><td class='value'><input type='text' name='contact[email]' value='{$my.contact.email|escape}' disabled='disabled' />
<input type='hidden' name='contact[email]' value='{$my.contact.email|escape}' /></td>
<td class='access'>{html_access_options name=access table=user_contact field=email}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Main IM{/t} : </td><td class='value'><input type='text' name='contact[im]' value='{$my.contact.im|escape}' />&nbsp;{html_options name='contact[im_type]' options=$labels.profile.im_type selected=$my.contact.im_type}</td>
<td class='access'>{html_access_options name=access table=user_contact field=im}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Phone{/t} : </td><td class='value'><input type='text' name='contact[phone]' value='{$my.contact.phone|escape}' /></td>
<td class='access'>{html_access_options name=access table=user_contact field=phone}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Cell phone{/t} : </td><td class='value'><input type='text' name='contact[cell_phone]' value='{$my.contact.cell_phone|escape}' /></td>
<td class='access'>{html_access_options name=access table=user_contact field=cell_phone}</td>
</tr>

<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Address{/t} : </td><td class='value'><textarea name='contact[address]' rows='5' cols='36'>{$my.contact.address|escape}</textarea></td>
<td class='access'>{html_access_options name=access table=user_contact field=address}</td>
</tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}ZIP{/t} : </td><td class='value' colspan='2'><input type='text' name='contact[zip]' value='{$my.contact.zip|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}City{/t} : </td><td class='value' colspan='2'><input type='text' name='contact[city]' value='{$my.contact.city|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label must'>{t}Country{/t} : </td><td class='value' colspan='2'>{html_options name='contact[country]' options=$labels.profile.country selected=$my.contact.country}</td></tr>
</table>

