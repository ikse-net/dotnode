<div id='leftside'>
<img src='{$profile.info.photo_path}' alt='{$profile.info.fname|escape} {$profile.info.lname|escape}' /><br />
{include file=_inc/leftmenu.tpl}
</div> {* leftside *}

<div id='middle'>

{if $rss_blog}
<div id='blog'>
<h2>Blog: <a href='{$rss_blog.link|escape}'>{$rss_blog.title|escape|utf8}</a></h2>

{foreach from=$rss_blog.item item=item key=link}
<h3>{$item.title|escape|utf8}</h3>

{if $item.description}
<p class='summary'>{$item.description|@html_entity_decode|strip_tags|utf8|nl2br}</p>
{/if}
<span class='blogReadmore'><a href='{$link|escape}'>{t}Read more{/t}</a></span>
<div style="clear:both"></div>
{/foreach}
</div> {* blog *}

{elseif $blogs}
<div id='blog'>
<h2>{t}My Blog{/t}</h2>
{foreach name=blog from=$blogs item=blog key=id_blog}
<h3><a href='/blog/view/{$id_blog}'>{$blog.title|escape}</a></h3>
<span class='date'>{t}On{/t} {$blog.date|date_format:"%A %e %B %Y"}</span><br />
{if $blog.chapeau}
<p>{$blog.chapeau|wikise}</p>
{else}
<p>{$blog.ticket|wikise}</p>
{/if}
<span class='blogCatComm'><a href='/blog/categorie/{$blog.id_cat}'>{$blog.categorie|default:'Nothing'}</a> :: <a href='/blog/view/{$id_blog}#comments'>{t count=$blog.nb_comments plural='%1 comments'}%1 comment{/t}</a></span>
{*<div style='clear: both'></div>*}
{/foreach}
</div> {* blog *}
{/if}


</div> {* middle *}
