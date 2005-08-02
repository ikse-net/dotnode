<h2>{t}Search a community{/t}</h2>

<form action='/communities/search'>
<input type='text' name='q' value='{$smarty.get.q|escape}' />
&nbsp;{t}in{/t}&nbsp;
{html_options name='cat' options=$categories_list selected=$smarty.get.cat}
<input type='submit' value='{t}Search{/t}' />
</form>
<br />

<table style='width: 98%'>
{foreach from=$comm item=comm}
<tr class='{cycle values='odd,even'}'>
<td style='width: 64px'><img src='{$comm.logo}' alt='' /></td>
<td>
<a href='/communities/view/{$comm.id_comm}'>{$comm.name|escape}</a> ({t count=$comm.nb_members plural="%1 members"}%1 member{/t})<br />
<i>{t}{$comm.cat_name}{/t}</i><br />
{$comm.description|escape|truncate:120|nl2br}
</td>
</tr>
{foreachelse}
{if $smarty.get.q}
{t}No community found{/t}. {t}Try again{/t}.
{/if}
{/foreach}
</table>
