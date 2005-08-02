{if $token[2]}
<h2>{t}Communities{/t}: {t}{$cat.name}{/t}</h2>
<table style='width: 98%'>
<tr class='{cycle values='odd,even'}'>
<td colspan='2' class='label'>
{strip}
{if $token[3] == 'newer'}
{t}Newer{/t}
{else}
<a href='/communities/category/{$token[2]}/newer'>{t}Newer{/t}</a>
{/if}
&nbsp;|&nbsp;
{if $token[3] == 'popular'}
{t}Popular{/t}
{else}
<a href='/communities/category/{$token[2]}/popular'>{t}Popular{/t}</a>
{/if}
{/strip}
</td>
</tr>
<tr class='{cycle values='odd,even'}'>
{strip}
<td colspan='2' align='right'>{t}Page{/t}:&nbsp;
{foreach from=$pages item=nothing key=number}
{if $token[4] == $number || (!$token[4] && $number==1)}
<span style='font-weight: bold'>{$number}</span>&nbsp;
{else}
<a href='/communities/category/{$token[2]}/{$token[3]}/{$number}'>{$number}</a>&nbsp;
{/if}
{/foreach}
{/strip}
</td>
</tr>
{foreach from=$communities item=comm}
<tr class='{cycle values='odd,even'}'>
<td style='width: 64px'><img src='{$comm.logo}' alt='' /></td>
<td><a href='/communities/view/{$comm.id_comm}'>{$comm.name|escape}</a> ({t count=$comm.nb_members plural="%1 members"}%1 member{/t})<br />{$comm.description|escape|truncate:120|nl2br}</td>
</tr>
{/foreach}
<tr class='{cycle values='odd,even'}'>
{strip}
<td colspan='2' align='right'>{t}Page{/t}:&nbsp;
{foreach from=$pages item=nothing key=number}
{if $token[4] == $number || (!$token[4] && $number==1)}
<span style='font-weight: bold'>{$number}</span>&nbsp;
{else}
<a href='/communities/category/{$token[2]}/{$token[3]}/{$number}'>{$number}</a>&nbsp;
{/if}
{/foreach}
{/strip}
</td>

</table>
{else}
<h2>{t}Communities by category{/t}</h2>
<table style='border: none'><tr><td>
<ul class='listcomm'>
{foreach name='cat' from=$categories item=cat}
{if $cat.nb_communities>0}
<li><a class='catname' href='/communities/category/{$cat.id_cat}'>{t}{$cat.name}{/t}</a> <span class='comment'>({t count=$cat.nb_communities plural="%1 communities"}%1 community{/t})</span><br />
<span class='comment'>
{foreach name=list_pop from=$cat.list item=comm key=id_comm}
<a href='/communities/view/{$id_comm}'>{$comm.name|truncate:22:'[...]'}</a> ({$comm.nb_members}){if !$smarty.foreach.list_pop.last}, {else}, <a href='/communities/category/{$cat.id_cat}'>...</a>{/if}
{/foreach}
</span>
</li>
{/if}

{if $smarty.foreach.cat.iteration == (int)($smarty.foreach.cat.total/2)+1}
</ul></td>
<td><ul class='listcomm'>
{/if}

{/foreach}
</ul>
</td></tr></table>

<a class='button' href='/communities/create'>{t}Create your community{/t}</a>
{/if}
