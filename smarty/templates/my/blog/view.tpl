<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{$smarty.session.my_fname}'s Blog</h2>

<div id='blog'>
<div class='subtitle'>{t}The{/t} {$my.blog.ticket.date|date_format:"%A %e %B %Y"}</div>
<h1>{$my.blog.ticket.title|escape}</h1>
{if $my.blog.ticket.chapeau}
<p class='chapeau'>{$my.blog.ticket.chapeau|wikise}</p>
{/if}
<p class='ticket'>{$my.blog.ticket.ticket|wikise}</p>
</div>

</div>
<div style="clear:both"></div>
