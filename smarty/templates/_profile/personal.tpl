{if $user.personal}
<table>
<tr><th class='profileHeader' colspan='2'>{t}Personal{/t}</tr>
{foreach from=$user.personal item=item key=key}
<tr class='{cycle values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$key} : </td>
<td class='value'>{$item|escape|nl2br|linkurl}
</td></tr>
{/foreach}
{if $user.relation_type == 'myself'}
<tr class='{cycle values='odd,even'}'><td colspan='2' align='right'><a class='button' href='/my/profile/personal/edit'>{t}Edit{/t}</a></td></tr>
{/if}
</table>
{else}
{if $user.relation_type == 'myself'}
<a class='button' href='/my/profile/personal/edit'>{t}Edit{/t}</a>
{/if}
{/if}
