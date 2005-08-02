<a href='/my/album' class='button'>Back</a><br />
<div style='text-align:center'>
{if $my.album.image}
<img src='{$my.album.image.path}' alt='{$my.album.image.caption|escape}' width='{$my.album.image.width}' height='{$my.album.image.height}' /><br />
{$my.album.image.caption|escape|linkurl}
{else}
{t}Nothing here{/t}
{/if}
</div>
<div style='text-align: right'><a href='/my/album' class='button'>Back</a></div>
<div style="clear:both"></div>
