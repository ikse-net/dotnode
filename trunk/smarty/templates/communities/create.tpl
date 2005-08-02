<h2>{t}Create your community{/t}</h2>
<form action='/action/communities/create' method='post' enctype='multipart/form-data'>
<table width='500'>
<tr class='{cycle name='parity' values='odd,even'}'>
<td class='label'>{t}Name{/t} :</td>
<td><input type='text' name='name' value='{$smarty.session.error.post.name|escape}' /></td>
</tr>
<tr class='{cycle name='parity' values='odd,even'}'>
<td class='label'>{t}Category{/t} :</td>
<td>{html_options name='id_cat' options=$categories selected=$smarty.session.error.post.id_cat}</td>
</tr>
<tr class='{cycle name='parity' values='odd,even'}'>
<td class='label'>{t}Type{/t} :</td>
<td>{html_radios name='moderated' options=$labels.communities.moderated separator='<br />' checked='no'}</td>
</tr>
<tr class='{cycle name='parity' values='odd,even'}'>
<td class='label'>{t}Country{/t} :</td>
<td>{html_options name='country' options=$labels.profile.country selected=$smarty.session.error.post.country}</td>
</tr>

<tr class='{cycle name='parity' values='odd,even'}'>
<td class='label'>{t}Photo/Logo{/t} :</td>
<td><input type='file' name='logo'></td>
</tr>

<tr class='{cycle name='parity' values='odd,even'}'>
<td class='label'>{t}Description{/t} :</td>
<td><textarea name='description' rows='5' cols='36'>{$smarty.session.error.post.description|escape}</textarea></td>
</tr>

<tr class='{cycle name='parity' values='odd,even'}'>
<td colspan='2' align='center'><span class='label'>{t}Type the code displayed inside this image{/t} :</span>
<input type='text' name='code' maxlength='4' size='4' /><br /><img style='border: 2px silver solid; padding: 2px;width:237px; height: 48px;' src='/pix/{$smarty.now}.png' alt='{t}If you have trouble, send an email on: pixcode-pb@dotnode.net{/t}'/></td>
</tr>


<tr class='{cycle name='parity' values='odd,even'}'>
<td colspan='2' align='center'><input type='submit' value='{t}Create{/t}' /></td>
</tr>

</table>
</form>
