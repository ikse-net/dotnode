<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{t}Edit{/t}</h2>
{if $my.album}
<form action='/action/my/album/record/{$token[3]}' method='post'>
<table>
<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Image{/t} :</td>
<td class='value'><img src='{$my.album.thumb.path}' alt='{$my.album.image.caption|escape}' width='{$my.album.thumb.width}' height='{$my.album.thumb.height}' /></td>
</tr>
<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Caption{/t} :</td>
<td align='right' nowrap='nowrap' class='value'><input type='text' name='caption' value='{$my.album.image.caption|escape}' /></td>
</tr>
<tr class='{cycle values='odd,even'}'><td colspan='2' align='center'><input type='submit' value='{t}Update{/t}'><td></tr>
</table>
</form>
{else}
{t}Nothing here{/t}
{/if}

</div>
<div style="clear:both"></div>
