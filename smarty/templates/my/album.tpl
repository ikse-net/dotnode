<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{t 1=$smarty.session.my_fname}%1's Album{/t}</h2>
{if $album.image}
<table>
{foreach name=album from=$album.image item=image key=id_image}
{if ($smarty.foreach.album.iteration-1)%4 == 0}
<tr>
{/if}
  <td align='center'>
    <a href='/album/{$url_id}/view/{$smarty.foreach.album.iteration}'>
    <img style='margin: 3px;' src='{$image.thumb_path}' alt='photo' /></a><br />
  {$image.caption|escape|linkurl}<br />
  <span class='subimage'><a href="/my/album/edit/{$smarty.foreach.album.iteration}">{t}Edit caption{/t}</a>&nbsp;|&nbsp;<a onClick="return confirm('{t}Confirm delete ?{/t}')" href="/my/album/delete/{$smarty.foreach.album.iteration}">{t}Delete{/t}</a></span>
  </td>
{if ($smarty.foreach.album.iteration-1)%4 == 3 || $smarty.foreach.album.iteration.last}
</tr>
{/if}
{/foreach}
</table>

{else}
{t}Nothing here{/t}
{/if}
<br />
<br />
<form action='/action/my/album/upload' method='post' enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="500000" />
<table width='480'>
<tr class='{cycle values='odd,even'}'>
<td class='value' colspan='2'>
<p>{t}You can upload a JPEG (.jpg), GIF (.gif), or PNG (.png) file (maximum size of 500KB).{/t}</p>
<p>{t}Please, do not upload photos containing celebrities, nudity, cartoons or copyrighted images.{/t}</p>
</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Select image{/t} :</td>
<td class='value'><input type='file' name='image' /></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Caption{/t} :</td>
<td class='value'><input type='text' name='caption' /></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='center' colspan='2'><input type='submit' value='{t}Uploader{/t}' /></td>
</tr>
</table>

</div>
<div style="clear:both"></div>
