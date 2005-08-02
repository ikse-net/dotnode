<div id='leftblock' >
<img src='{$smarty.session.my_photo}' alt='photo' />
</div>

<div id='home'>
<h2>{$smarty.session.my_fname} {if $smarty.session.my_nick}"{$smarty.session.my_nick|escape}" {/if}{$smarty.session.my_lname}</h2>
{if $my.profile.schools}
<table width='600'>
<tr class='{cycle values='odd,even'}'>
<th nowrap='nowrap' style='text-align: center; border-right: 1px solid green'>{t}Year{/t}</th>
<th class='value'>{t}Name{/t}</th>
<th class='value'>{t}City{/t}</th>
<th class='value'>{t}Country{/t}</th>
<th class='value'>{t}Actions{/t}</th>
</tr>

{foreach name=school from=$my.profile.schools key=key item=item}
<tr class='{cycle values='odd,even'}'>
<td class='label' nowrap='nowrap' style='text-align: center; border-right: 1px solid green'>{$item.year}</td>
<td class='value'>{$item.name|escape}</td>
<td class='value'>{$item.city|escape}</td>
<td class='value'>{$item.country|escape}</td>
<td class='value'><a href='/my/profile/schools/edit/{$smarty.foreach.school.iteration}'>{t}Edit{/t}</a>&nbsp;-&nbsp;<a href='/my/profile/schools/delete/{$smarty.foreach.school.iteration}'>{t}Delete{/t}</a>&nbsp;-&nbsp;<a href='/my/profile/schools/addnext/{$smarty.foreach.school.iteration}'>{t}Add next year{/t}</a></td>
</tr>
{/foreach}
<tr class='{cycle values='odd,even'}'><td colspan='5' align='right'><a class='button' href='/my/profile/schools/add'>{t}Add{/t}</a></td></tr>
</table>
{else}
<a class='button' href='/my/profile/schools/add'>{t}Add{/t}</a>
{/if}
</div>
<div style="clear:both"></div>

