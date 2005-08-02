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
<h2>{$user.info.fname}'s Blog</h2>

<div id='blogComment'>
<div class='subtitle'>{$comment.date|date_format:"%A %e %B %Y %H:%M"}</div>
<img src='{$comment.author.thumb}' alt='{$comment.author.fname}' style='float:left' /><b>{$comment.title|escape}</b>
<p>{$comment.comment|escape|nl2br}</p>
<div style="clear:both"></div>
</div>

<form action='/action/{$url_id}/blog/comment/record/{$token[2]}/{$token[3]}' method='post'>
<fieldset class='blog'>
<legend>{t}Edit a comment{/t}</legend>
{t}Title (optional){/t}: <input type='text' name='title' value='{$smarty.session.error.post.title|default:$comment.title|escape}' /><br />
{t}Your comment{/t}:<br />
<textarea name='comment' cols='50' rows='6'>{$smarty.session.error.post.comment|default:$comment.comment|escape}</textarea><br />
<input type='submit' value='{t}Send{/t}' />
</fieldset>
</form>

</div>
<div style="clear:both"></div>
