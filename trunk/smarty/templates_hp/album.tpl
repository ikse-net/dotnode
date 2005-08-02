<div id='leftside'>
<img src='{$profile.info.photo_path}' alt='{$profile.info.fname|escape} {$profile.info.lname|escape}' /><br />
{include file=_inc/leftmenu.tpl}
</div> {* leftside *}

<div id='middle'>

{if $albums}
<div id='album'>
<h2>{t}My album{/t}</h2>
<table>
{foreach name=album from=$albums item=photo key=id_image}
{if ($smarty.foreach.album.iteration-1)%3 == 0}
<tr>
{/if}
<td><a href='{$photo.photo|escape}'><img src='{$photo.thumb|escape}' alt='photo' /></a><br />{$photo.caption|escape}</td>
{if ($smarty.foreach.album.iteration-1)%3 == 2}
</tr>
{/if}
{/foreach}
</table>
</div> {* album *}
{/if}
</div> {* middle *}
