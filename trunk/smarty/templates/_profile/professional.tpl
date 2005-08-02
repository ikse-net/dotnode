{if $user.professional}
<table>
<tr><th class='profileHeader' colspan='2'>{t}Professional{/t}</tr>
{foreach from=$user.professional item=item key=key}

{if $key=='6nergies.net profil address'}

<tr class='{cycle name='parity' values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'><a href='http://www.6nergies.net'><img src='/img/6nergies-favicon.png' alt='6nergies.net' /></a>&nbsp;{t escape='no'}<a href='http://www.6nergies.net'>6nergies.net</a> profil address{/t} : </td>
<td class='value'><a href='http://www.6nergies.net/people/{$item|escape}'>http://www.6nergies.net/people/{$item|escape}</a></td>
</tr>

{else}


<tr class='{cycle values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$key} : </td>
<td class='value'>{$item|escape|linkurl|nl2br}
</td></tr>
{/if}

{/foreach}
{if $user.relation_type == 'myself'}
<tr class='{cycle values='odd,even'}'><td colspan='2' align='right' ><a class='button' href='/my/profile/professional/edit'>{t}Edit{/t}</a></td></tr>
{/if}
</table>
{else}
{if $user.relation_type == 'myself'}
<a class='button' href='/my/profile/professional/edit'>{t}Edit{/t}</a>
{/if}
{/if}
</div>
