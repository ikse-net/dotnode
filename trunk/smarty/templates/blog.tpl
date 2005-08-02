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
<h2>{t 1=$user.info.fname}%1's Blog{/t}</h2>

{if $blog}
{foreach name='blog' from=$blog key=id_blog item=blog}
<div class='blog'>
<div class='subtitle'>{t}The{/t} {$blog.date|date_format:"%A %e %B %Y"}</div>
<h1>{$blog.title|escape}</h1>

{if $blog.chapeau}
<p class='summary'>{$blog.chapeau|wikise}</p>
{else}
<p class='summary'>{$blog.ticket|wikise}</p>
{/if}

<span class='blogReadmore'><a href='/blog/{$url_id}/view/{$blog.id_blog}'>{t}Read more{/t}
{if $blog.chapeau}
&nbsp;({t count=$blog.ticket|count_words plural='%1 words'}%1 word{/t})
{/if}
</a></span>
<span class='blogCatComm'><a href='/blog/{$url_id}/categorie/{$blog.id_cat}'>{$blog.categorie|default:'Nothing'}</a> :: <a href='/blog/{$url_id}/view/{$blog.id_blog}#comments'>{t count=$blog.nb_comments plural='%1 comments'}%1 comment{/t}</a></span>

<div style="clear:both"></div>


</div>
{/foreach}
{elseif $rss_blog}

<p>{t 1=$rss_blog.title 2=$rss_blog.link escape='no'}RSS from <a href='%2'>%1</a>{/t}.</p>

{foreach from=$rss_blog.item item=item key=link}
<div class='blog'>
{if $item.date}<div class='subtitle'>{t}The{/t} {$item.date|date_format:"%A %e %B %Y"}</div>{/if}
<h1>{$item.title|escape|utf8}</h1>

{if $item.description}
<p class='summary'>{$item.description|@html_entity_decode|strip_tags|utf8|nl2br}</p>
{/if}
<span class='blogReadmore'><a href='{$link|escape}'>{t}Read more{/t}</a></span>
<div style="clear:both"></div>
</div>
{/foreach}

{else}
{t}No blog{/t}.
{/if} {* if blog *}

</div>
<div style="clear:both"></div>
