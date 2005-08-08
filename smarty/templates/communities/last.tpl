<h2>{t}New communities{/t}</h2>

<p>{t}Follow the creation of the communities with RSS:{/t}</p>
<ul>
<li><a href='http://alexx.ikse.org/addpanel.php?rss=http://{$config.domain}/xml/rss/communities/last'>{t}SideBar builder for Mozilla Firefox{/t}</a></li>
<li><a href='http://{$config.domain}/xml/rss/communities/last'>{t}Directly the RSS{/t}</a></li>
</ul>


<table>
{foreach from=$last_communities item=comm}

{if $comm.day}
<tr>
<td class='title' colspan='2'>
{if $comm.next_day}<div style='float:right'><a href='#{$comm.next_day}'>{t}Previous day{/t}</a></div>{/if}
<a name='{$comm.day}'></a>
<h3>{$comm.date|date_format:'%e %B %Y'}</h3>
</td>
</tr>
{/if}

<tr class='{cycle values='odd,even'}'>
<td><img src='{$comm.logo}' alt='' /></td>
<td><a href='/communities/view/{$comm.id_comm}'>{$comm.name|escape}</a> ({t count=$comm.nb_members plural="%1 members"}%1 member{/t}, <strong>{t}{$comm.cat_name}{/t}</strong>)<br />{$comm.description|escape|truncate:120|nl2br}</td>
</tr>
{/foreach}
</table>
