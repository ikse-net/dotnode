<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{t}Photo{/t}</h2>
<p>{t 1=#SiteName#}You can upload a JPEG (.jpg), GIF (.gif), or PNG (.png) file (maximum size of 500KB) to represent you into %1.{/t}</p>
<p>{t}Please, do not upload photos containing celebrities, nudity, artwork, children, pets/animals, cartoons or copyrighted images.{/t}</p>
<form action='/action/my/profile/photo/upload' method='post' enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="500000" />
<table>
<tr class='{cycle name='parity' values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Select photo{/t} :</td>
<td class='value'><input type='file' name='photo' /></td>
</tr>
<tr class='{cycle name='parity' values='odd,even'}'>
<td align='center' colspan='2'><input type='submit' value='{t}Send{/t}' /></td>
</tr>
</table>

{if $token[3] == 'success'}
<p><img style='float:left' src='/img/warning-32.png' /><a href="javascript: window.location.reload(false)">{t escape=no}Remember to reload to<br />view the new photo{/t}</a></p>
{/if}



</form>
</div>
<div style="clear:both"></div>


