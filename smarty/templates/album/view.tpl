<a href='/album/{$url_id}' class='button'>{t}Back{/t}</a><br />
<div style='text-align:center'>
{if $album.image}
<img {* style='max-width:100%; height: auto'*} src='{$album.image.path}' alt='{$album.image.caption|escape}' width='{$album.image.width}' height='{$album.image.height}' /><br />
{$album.image.caption|escape|linkurl}
{else}
{t}Nothing here{/t}
{/if}
</div>
<div style='text-align: right'><a href='/album/{$url_id}' class='button'>{t}Back{/t}</a></div>
<div style="clear:both"></div>

{if $smarty.session.my_login=='alexx' || $smarty.session.my_login=='mathieu'}
<form action='/action/{$url_id}/admin/delete_image' method='post'>
Indiquer les raisons de la suppression de l'image:<br />
<textarea name='reason'></textarea><br />
<input type='hidden' name='image_path' value='{$album.image.path}' />
<input type='submit' value='Delete' />
</form>
{/if}
