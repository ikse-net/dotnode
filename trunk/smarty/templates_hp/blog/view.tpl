<div id='leftside'>
<img src='{$profile.photo}' alt='{$profile.info.fname|escape} {$profile.info.lname|escape}' /><br />
{include file=_inc/leftmenu.tpl}
</div> {* leftside *}

<div id='middle'>

{if $blog}
<div id='blog'>
<h2>{$blog.title|escape}</h2>
<span class='date'>{t}On{/t} {$blog.date|date_format:"%A %e %B %Y"}</span><br />
{if $blog.chapeau}
<p>{$blog.chapeau|wikise}</p>
{/if}
<p>{$blog.ticket|wikise}</p>
<span class='blogCatComm'><a href='/blog/categorie/{$blog.id_cat}'>{$blog.categorie|default:'Nothing'}</a> :: <a href='#comments'>{t count=$blog.nb_comments plural='%1 comments'}%1 comment{/t}</a></span>
<br />
{t}Some comments{/t}...
<table>
{foreach name=comments from=$blog.comment item=comment key=id_comment}
<tr>
<td valign='top'><img src='{$comment.author.thumb_path}' alt='thumb' /></td>
<td>
<h3><a href='http://{$comment.author.login}.dotnode.com'>{$comment.author.fname|escape}</a> {if $comment.title}&raquo; {$comment.title|escape}{/if}</h3>
<span class='date'>{t}On{/t} {$comment.date|date_format:"%A %e %B %Y"}</span><br />
<p>{$comment.comment|wikise}</p>
</td>
</tr>
{/foreach}
</table>
</div> {* blog *}
{/if}
</div> {* middle *}
