<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{$smarty.session.my_fname|escape} {if $smarty.session.my_nick}"{$smarty.session.my_nick|escape}" {/if}{$smarty.session.my_lname|escape}</h2>

{if $token[3] eq 'success'}
<p class='warning'>
{t}Your email will be updated after your confirmation received by email (in 2 min max){/t}.
</p>
{/if}

{if $my.profile.contact}
<table width='400'>
{if $my.profile.contact.email}
<tr class='{cycle name='parity' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$my.profile.contact.email.key} : </td>
<td class='value'>{mailto address=$my.profile.contact.email.value encode="javascript"}</td>
</tr>
{/if}
{if $my.profile.contact.email2}
<tr class='{cycle name='parity' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$my.profile.contact.email2.key} : </td>
<td class='value'>{mailto address=$my.profile.contact.email2.value encode="javascript"}</td>
</tr>
{/if}
{if $my.profile.contact.email3}
<tr class='{cycle name='parity' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$my.profile.contact.email3.key} : </td>
<td class='value'>{mailto address=$my.profile.contact.email3.value encode="javascript"}</td>
</tr>
{/if}
{if $my.profile.contact.email4}
<tr class='{cycle name='parity' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$my.profile.contact.email4.key} : </td>
<td class='value'>{mailto address=$my.profile.contact.email4.value encode="javascript"}</td>
</tr>
{/if}

{if $my.profile.contact.im && $my.profile.contact.im_type}
<tr class='{cycle name='parity' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$my.profile.contact.im.key} : </td>
<td class='value'>{$my.profile.contact.im.value|escape}, {$my.profile.contact.im_type.value}
</td>
</tr>
{/if}

{if $my.profile.contact.im2 && $my.profile.contact.im2_type}
<tr class='{cycle name='parity' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$my.profile.contact.im2.key} : </td>
<td class='value'>{$my.profile.contact.im2.value|escape}, {$my.profile.contact.im2_type.value}
</td>
</tr>
{/if}

{if $my.profile.contact.phone}
<tr class='{cycle name='parity' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$my.profile.contact.phone.key} : </td>
<td class='value'>{$my.profile.contact.phone.value|escape}
</td></tr>
{/if}
{if $my.profile.contact.cell_phone}
<tr class='{cycle name='parity' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$my.profile.contact.cell_phone.key} : </td>
<td class='value'>{$my.profile.contact.cell_phone.value|escape}
</td></tr>
{/if}

{if $my.profile.contact.address}
<tr class='{cycle name='parity' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$my.profile.contact.address.key} : </td>
<td class='value'>{$my.profile.contact.address.value|escape}
</td></tr>
{/if}
{if $my.profile.contact.zip}
<tr class='{cycle name='parity' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$my.profile.contact.zip.key} : </td>
<td class='value'>{$my.profile.contact.zip.value|escape}
</td></tr>
{/if}
{if $my.profile.contact.city}
<tr class='{cycle name='parity' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$my.profile.contact.city.key} : </td>
<td class='value'>{$my.profile.contact.city.value|escape}
</td></tr>
{/if}
{if $my.profile.contact.country}
<tr class='{cycle name='parity' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$my.profile.contact.country.key} : </td>
	<td class='value'>{$my.profile.contact.country.value|escape|linkurl}
</td></tr>
{/if}

<tr class='{cycle name='parity' values='odd,even'}'><td colspan='2' align='right'><a class='button' href='/my/profile/contact/edit'>{t}Edit{/t}</a></td></tr>
</table>
{else}
<a class='button' href='/my/profile/contact/edit'>{t}Edit{/t}</a>
{/if}
</div>
<div style="clear:both"></div>

