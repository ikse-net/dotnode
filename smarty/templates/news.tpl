{*
<div id='rightblock'>
<div id='blogFeed'>
<h2><a href='/news/blog'>{t}Last blog's tickets{/t}</a></h2>
{foreach from=$blogs item=blog key=key}

<h3>
{if $blog.link}
<a class='title' href='{$blog.link}'>
{else}
<a class='title' href='/blog/{$blog.id}/view/{$blog.id_blog}'>
{/if}

{$blog.title|escape|truncate:'40'|utf8}</a> (<a class='author' href='/profile/{$blog.id}'>{$blog.fname|escape} {$blog.lname}</a>)
</h3>

<p>{if $blog.link}<span class='external'>({t}External blog{/t})</span>{/if}
{if $blog.chapeau}
{$blog.chapeau|truncate:'300'|wikise|@html_entity_decode|strip_tags|utf8}
{else}
{$blog.ticket|truncate:'300'|wikise|strip_tags}
</p>
{/if}
{/foreach}
</div>
</div>
*}
<div id='bigblock' style='width: 98%'>
<div id='newspage'>
{$page|wikise:'wikka'}
</div>
</div>
