<h2>{t}Last blog's tickets{/t}</h2>
<p>{t count=$blogs|@count plural="%1 blogs this week"}%1 blog this week{/t}...</p>
<div id='blogFeed'>
<table>
{foreach from=$blogs item=blog}

{if $blog.day}
<tr>
<td class='title' colspan='2'>
{if $blog.next_day}<div style='float:right'><a href='#{$blog.next_day}'>{t}Previous day{/t}</a></div>{/if}
<a name='{$blog.day}'></a>
<h3>{$blog.date|date_format:'%e %B %Y'}</h3>
</td>
</tr>
{/if}

{if $blog.link}
<tr class='even'>
{else}
<tr class='odd'>
{/if}
<td align='center'><img src='{$blog.author.thumb_path}' /><br ><a class='author' href='/profile/{$blog.id}'>{$blog.author.fname|escape} {$blog.author.lname}</a></td>

{if $blog.link}

<td>
<a class='title' href='{$blog.link}'>{$blog.title|escape|truncate:'40'|utf8}</a>
<div class='subtitle'>{t}At{/t} {$blog.date|date_format:'%k:%M'}</div>
{if $blog.chapeau}
{$blog.chapeau|truncate:'900'|@html_entity_decode|strip_tags|utf8}
{/if}
</td>

{else}

<td>
<a class='title' href='/blog/{$blog.id}/view/{$blog.id_blog}'>{$blog.title|escape|truncate:'40'|utf8}</a>
<div class='subtitle'>{t}At{/t} {$blog.date|date_format:'%k:%M'}{if $blog.cat_name} {t}in{/t} <strong>{$blog.cat_name|escape}</strong>{/if}</div>
{if $blog.chapeau}
{$blog.chapeau|truncate:'900'|wikise|strip_tags}
{else}
{$blog.ticket|truncate:'900'|wikise|strip_tags}
{/if}
</td>

{/if}

</tr>
{/foreach}
</table>
</div>
