<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{t 1=$smarty.session.my_fname}%1's Blog{/t}</h2>

<form action='/action/my/blog/rss' method='post'>
<label for='url_rss'>{t}URL of your RSS blog if you have one{/t} :<br />
</label><input type='text' size='50' name='blog_url' value='{$my.blog_url|escape|default:'http://'}' /><input type='submit' value='{t}Record{/t}' />
</form>

<br />

{if $my.blog}
<table width='500'>
{foreach name='blogs' from=$my.blog item=blog}
<tr class='{cycle values='odd,even'}'>
<td class='label'>
<a class='blogTitle' href='/blog/view/{$blog.id_blog}'>{$blog.title}</a> - <span class='{$blog.status}'>{if $blog.status=='offline'}{t}Offline{/t}{else}{t}Online{/t}{/if}</span></td>
<td nowrap='nowrap' class='label' align='right'>{$blog.date|date_format:"%A %e %B %Y"}
</tr>
<tr class='{cycle values='odd,even'}'>
<td class='value' colspan='2'>
{if $blog.categorie}
<em>{t}Category{/t} :</em> {$blog.categorie}<br/>
{/if}
{$blog.chapeau|default:$blog.ticket|escape|truncate:500}
<br />
<a href='/blog/view/{$blog.id_blog}'>{t}See{/t}</a>&nbsp;-&nbsp;
<a href='/my/blog/edit/{$smarty.foreach.blogs.iteration}'>{t}Edit{/t}</a>&nbsp;-&nbsp;
<a onClick="return confirm('{t}Confirm delete ?{/t}')" href='/my/blog/delete/{$smarty.foreach.blogs.iteration}'>{t}Delete{/t}</a><br />
{if $blog.status=='offline'}
<a href='/my/blog/change_status/{$smarty.foreach.blogs.iteration}/online'>{t}Publish it{/t}</a>
{else}
<a href='/my/blog/change_status/{$smarty.foreach.blogs.iteration}/offline'>{t}Hide it{/t}</a>
{/if}

{if $blog.nb_comments>0}
&nbsp;-&nbsp;{t count=$blog.nb_comments plural='%1 comments'}%1 comment{/t}
{/if}

</tr>
{/foreach}
</table>
{else}
{t}No blog{/t}... <a class='button' href='/my/blog/add'>{t}edit one now{/t}</a> !
{/if}

</div>
<div style="clear:both"></div>
