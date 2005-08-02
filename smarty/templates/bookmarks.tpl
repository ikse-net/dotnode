<div id='leftblock' >
<img src='{$user.info.photo_path}' alt='photo' />
{if $leftmenu}
{strip}
<ul class='menu'>
{foreach name=leftmenu from=$leftmenu item=title key=link}
{strip}<li><a href='
{if $link[0] neq '/'}
/{$token[0]}/{$link}
{else}
{$link}
{/if}
'{if $token[1] eq $link} class='active'{/if}>{t}{$title}{/t}</a></li>{/strip}
{/foreach}
</ul>
{/strip}
{/if}
</div>

<div id='home'>
<h2>{t 1=$user.info.fname}%1's Bookmarks{/t}</h2>
{if $token[1]=='category'}
<a href='/bookmarks/{$smarty.session.my_id}'>{t}All{/t}</a> / 
{foreach name=path from=$path item=item}
<a href='/bookmarks/{$smarty.session.my_id}/category/{$item[0]}'>{$item[1]}</a>{if !$smarty.foreach.path.last} / {/if}
{/foreach}
{/if}

{if $token[1]=='category' && $sub_cat}
<br />{t}Sub-category here :{/t}
<ul id='subcat'>
{foreach from=$sub_cat item=name key=id_cat}
<li><a href='/bookmarks/{$smarty.session.my_id}/category/{$id_cat}'>{$name|escape}</a></li>
{/foreach}
</ul>
{/if}

<dl id='bookmarks'>
{foreach name='links' from=$links item=link}
<dt>
<span class='label'>{$link.date|date_format:"%e.%m.%Y"}</span> <a href='{$link.link|escape}'>{$link.link|escape|truncate:'64':'(...)'}</a>{if $url_id == $smarty.session.my_id} <span class='label'>(<a href='/my/bookmarks/edit/{$smarty.foreach.links.iteration}'>{t}edit{/t}</a> - <a onClick="return confirm('{t}Confirm delete ?{/t}')" href='/my/bookmarks/delete/{$smarty.foreach.bookmarks.iteration}'>{t}delete{/t}</a>)</span>{/if}
</dt>
<dd>
{if $token[1] != 'category' && $link.id_cat != 0}
{t}In: {/t}{* path *}
{foreach name=path from=$link.path item=item}
<a href='/bookmarks/{$smarty.session.my_id}/category/{$item[0]}'>{$item[1]}</a>{if !$smarty.foreach.path.last} / {/if}
{/foreach}
<br />
{/if}
{$link.comment|escape|nl2br}
</dd>
{/foreach}
</dl>
<div style="clear:both"></div>

</div>
<div style="clear:both"></div>
