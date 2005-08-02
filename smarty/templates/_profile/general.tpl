<table>
<tr><th class='profileHeader' colspan='2'>{t}General Profile{/t}</tr>
{foreach from=$user.general item=item key=key}
{if $item}
<tr class='{cycle name='general' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$key} : </td>
<td class='value'>{$item|escape|nl2br|linkurl}
</td></tr>
{/if}
{/foreach}
{if $user.relation_type == 'myself'}
<tr class='{cycle name='general' values='odd,even'}'><td colspan='2' align='right'><a class='button' href='/my/profile/general/edit'>{t}Edit{/t}</a></td></tr>
{/if}
</table>
<br />

{if $user.interests}
<table>
<tr><th class='profileHeader' colspan='2'>{t}Interests{/t}</tr>
{foreach from=$user.interests item=item key=key}
{if $item}
<tr class='{cycle name='interests' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$key} : </td>
<td class='value'>{$item|escape|nl2br|linkurl}
</td></tr>
{/if}
{/foreach}
{if $user.relation_type == 'myself'}
<tr class='{cycle name='interests' values='odd,even'}'><td colspan='2' align='right'><a class='button' href='/my/profile/interests/edit'>{t}Edit{/t}</a></td></tr>
{/if}
</table>
<br />
{/if}

{if $user.contact}
<table>
<tr><th class='profileHeader' colspan='2'>{t}Contact{/t}</tr>
{if $user.contact.email}
<tr class='{cycle name='contact' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$user.contact.email.key} : </td>
<td class='value'>{mailto address=$user.contact.email.value encode="javascript"}</td>
</tr>
{/if}
{if $user.contact.email2}
<tr class='{cycle name='contact' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$user.contact.email2.key} : </td>
<td class='value'>{mailto address=$user.contact.email2.value encode="javascript"}</td>
</tr>
{/if}
{if $user.contact.email3}
<tr class='{cycle name='contact' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$user.contact.email3.key} : </td>
<td class='value'>{mailto address=$user.contact.email3.value encode="javascript"}</td>
</tr>
{/if}
{if $user.contact.email4}
<tr class='{cycle name='contact' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$user.contact.email4.key} : </td>
<td class='value'>{mailto address=$user.contact.email4.value encode="javascript"}</td>
</tr>
{/if}

{if $user.contact.im && $user.contact.im_type}
<tr class='{cycle name='contact' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$user.contact.im.key} : </td>
<td class='value'>{$user.contact.im.value|escape:'hexentity'}, {$user.contact.im_type.value}
</td>
</tr>
{/if}

{if $user.contact.im2 && $user.contact.im2_type}
<tr class='{cycle name='contact' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$user.contact.im2.key} : </td>
<td class='value'>{$user.contact.im2.value|escape:'hexentity'}, {$user.contact.im2_type.value}
</td>
</tr>
{/if}

{if $user.contact.phone}
<tr class='{cycle name='contact' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$user.contact.phone.key} : </td>
<td class='value'>{$user.contact.phone.value|escape}
</td></tr>
{/if}
{if $user.contact.cell_phone}
<tr class='{cycle name='contact' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$user.contact.cell_phone.key} : </td>
<td class='value'>{$user.contact.cell_phone.value|escape}
</td></tr>
{/if}

{if $user.contact.address}
<tr class='{cycle name='contact' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$user.contact.address.key} : </td>
<td class='value'>{$user.contact.address.value|escape}
</td></tr>
{/if}
{if $user.contact.zip}
<tr class='{cycle name='contact' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$user.contact.zip.key} : </td>
<td class='value'>{$user.contact.zip.value|escape}
</td></tr>
{/if}
{if $user.contact.city}
<tr class='{cycle name='contact' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$user.contact.city.key} : </td>
<td class='value'>{$user.contact.city.value|escape}
</td></tr>
{/if}
{if $user.contact.country}
<tr class='{cycle name='contact' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$user.contact.country.key} : </td>
<td class='value'>{$user.contact.country.value|escape|linkurl}
</td></tr>
{/if}
{if $user.relation_type == 'myself'}
<tr class='{cycle name='contact' values='odd,even'}'><td colspan='2' align='right'><a class='button' href='/my/profile/contact/edit'>{t}Edit{/t}</a></td></tr>
{/if}
</table>
{/if}
