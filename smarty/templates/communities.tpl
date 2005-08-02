<div id='commsearch'>
<h2>{t}Search a community{/t}</h2>
<form action='/communities/search'>
<input type='text' name='q' />&nbsp;<input type='submit' value='{t}Search{/t}' /><br />
{html_options name='cat' options=$categories_list}
</form>
</div>

{if $my_communities}
<div id='mycomm'>
<h2>{t}Your communities{/t}</h2>
<table>
{foreach name='comm' from=$my_communities item=community}
 {if $community.day && $community.last_post_date}
<tr class='odd'>
<td><strong>{$community.last_post_date|date_format:'%e %B %Y'}</strong></td>
 {elseif $community.last_post_date}
<tr class='even'>
<td></td>
  {else}
<tr>
<td></td>
 {/if}
 
<td><a {if $community.id == $smarty.session.my_id}style='text-decoration: underline;' {/if}href='/communities/view/{$community.id_comm}'>{$community.name|escape}</a> <span class='comment'>({t count=$community.nb_members plural="%1 members"}%1 member{/t})</span></td>
<td>{if $community.last_post_date>0}<span class='commLastpost'>{t 1=$community.last_post_date|date_format:"%k:%M"}last post at %1{/t}</span>{/if}</td>
</tr>
{/foreach}
</table>

</div>
<br />
{/if}


<h2>{t}Communities by categorie{/t}</h2>
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
