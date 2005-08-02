{if $my_communities}
<div id='mycomm'>
<h2>{t}My communities{/t}</h2>

<p>{t}Follow your communities activities with RSS:{/t}</p>
<ul>
<li><a href='http://alexx.ikse.org/addpanel.php?rss=http://dotnode.com/xml/{$url_id}/rss/communities'>{t}SideBar builder for Mozilla Firefox{/t}</a></li>
<li><a href='http://dotnode.com/xml/{$url_id}/rss/communities'>{t}Directly the RSS{/t}</a></li>
</ul>

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
