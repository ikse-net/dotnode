<div id='leftblock' >
<img src='{$smarty.session.my_photo}' alt='photo' />
</div>

<div id='home'>
<h2>{$smarty.session.my_fname|escape} {if $smarty.session.my_nick}"{$smarty.session.my_nick|escape}" {/if}{$smarty.session.my_lname|escape}</h2>
{if $my.profile.professional}
<table width='400'>
{foreach from=$my.profile.professional item=item key=key}

{if $key=='6nergies_profile_address'}

<tr class='{cycle name='parity' values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'><a href='http://www.6nergies.net'><img src='/img/6nergies-favicon.png' alt='6nergies.net' /></a>&nbsp;{t escape='no'}<a href='http://www.6nergies.net'>6nergies.net</a> profile address{/t} : </td>
<td class='value'><a href='http://www.6nergies.net/people/{$item|escape}'>http://www.6nergies.net/people/{$item|escape}</a></td>
</tr>

{else}

<tr class='{cycle name='parity' values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$key} : </td>
<td class='value'>{$item|escape|linkurl|nl2br}
</td></tr>

{/if}

{/foreach}

<tr class='{cycle name='parity' values='odd,even'}'><td colspan='2' align='right' ><a class='button' href='/my/profile/professional/edit'>{t}Edit{/t}</a></td></tr>
</table>
{else}
<a class='button' href='/my/profile/professional/edit'>{t}Edit{/t}</a>
{/if}
</div>
<div style="clear:both"></div>

