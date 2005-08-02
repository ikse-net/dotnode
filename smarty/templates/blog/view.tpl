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

<div id='blog'>
<div class='subtitle'>{t}The{/t} {$blog.date|date_format:"%A %e %B %Y"}</div>
<h1>{$blog.title|escape}</h1>
{if $blog.chapeau}
<p class='summary'>{$blog.chapeau|wikise}</p>
{/if}
<p class='summary'>{$blog.ticket|wikise}</p>

<span class='blogCatComm'><a href='/blog/{$url_id}/categorie/{$blog.id_cat}'>{$blog.categorie|default:'Nothing'}</a> :: <a href='#comments'>{t count=$blog.nb_comments plural='%1 comments'}%1 comment{/t}</a></span>
<div style="clear:both"></div>
</div>

{if $blog.comment}
<a name='comments'></a><h2>{t}Comments{/t}</h2>
<div id='blogComments'>
{foreach name='comments' from=$blog.comment key=id_comment item=comment}
<div id='blogComment'>
<div class='subtitle'>{$comment.date|date_format:"%A %e %B %Y %H:%M"}</div>
<a href='/profile/{$comment.author.id}'><img src='{$comment.author.thumb_path}' alt='{$comment.author.fname|escape}' style='float:left' />{$comment.author.fname|escape}</a> &raquo; <b>{$comment.title|escape}</b>
<p>{$comment.comment|escape|linkurl|nl2br}</p>
{if $comment.id_author == $smarty.session.my_id}
<span class='action'><a href='/blog/{$url_id}/edit/{$blog.id_blog}/{$comment.id_comment}'>{t}Edit{/t}</a>&nbsp;::&nbsp;<a onClick="return confirm('{t}Confirm delete ?{/t}')" href='/blog/{$url_id}/delete/{$blog.id_blog}/{$comment.id_comment}'>{t}Delete{/t}</a></span>
{/if}
<div style="clear:both"></div>
</div>
{/foreach}
</div>
{/if}

<form action='/action/{$url_id}/blog/comment/add/{$blog.id_blog}' method='post'>
<fieldset class='blog'>
<legend>{t}Post a comment{/t}</legend>
{t}Title{/t} ({t}optional{/t}): <input type='text' name='title' value='{$smarty.session.error.post.title|escape}' /><br />
{t}Your comment{/t}:<br />
<textarea name='comment' cols='50' rows='6'>{$smarty.session.error.post.comment|escape}</textarea><br />
<input type='submit' value='{t}Send{/t}' />
</fieldset>
</form>

</div>
<div style="clear:both"></div>
