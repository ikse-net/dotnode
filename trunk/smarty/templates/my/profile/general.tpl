<div id='leftblock' >
<img src='{$smarty.session.my_photo}' alt='photo' />
</div>

<div id='home'>
<h2>{$smarty.session.my_fname|escape} {if $smarty.session.my_nick}"{$smarty.session.my_nick|escape}" {/if}{$smarty.session.my_lname|escape}</h2>
{if $my.profile.general}
<table width='400'>
{foreach from=$my.profile.general item=item key=key}
<tr class='{cycle values='odd,even'}'><td align='right' nowrap='nowrap' class='label'>{$key} : </td>
<td class='value'>{$item|escape|nl2br|linkurl}
</td></tr>
{foreachelse}
{t}No general profile recorded.{/t}<br /><a href='/my/profile/general/edit'>{t}Edit it !{/t}</a>
{/foreach}
<tr class='{cycle values='odd,even'}'><td colspan='2' align='right'><a class='button' href='/my/profile/general/edit'>{t}Edit{/t}</a></td></tr>

</table>
{else}
<a class='button' href='/my/profile/general/edit'>{t}Edit{/t}</a>
{/if}
</div>
<div style="clear:both"></div>

