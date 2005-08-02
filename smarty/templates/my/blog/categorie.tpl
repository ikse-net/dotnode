<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{t 1=$smarty.session.my_fname}%1's Blog{/t}</h2>
{if $my.blog.categorie}
<table width='400'>
{foreach name='categorie' from=$my.blog.categorie item=cat}
<tr class='{cycle values='odd,even'}'>
<td class='value'>
<form action='/action/my/blog/categorie/record/{$smarty.foreach.categorie.iteration}' method='post'>
<input type='text' name='name' value='{$cat.name|escape}' />
<input type='submit' value='{t}Modify{/t}'>&nbsp;
<a class='button' href='/my/blog/categorie/delete/{$smarty.foreach.categorie.iteration}' onClick="return confirm('{t}Confirm delete ?{/t}')">{t}Delete{/t}</a>
</form>
</td>
</tr>
{/foreach}
</table>
{else}
{t}No category{/t} ... {t}add one now{/t} !
{/if}

<br />
<br />

<form action='/action/my/blog/categorie/add' method='post'>

<table width='400'>
<tr class='{cycle values='odd,even'}'>
<td class='value' colspan='2'>
<p>{t}Organize your blog with categories...{/t}</p>
</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Name{/t} :</td>
<td class='value'><input type='text' name='name' /></td>
</tr>
{*
<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Comment{/t} :</td>
<td class='value'><input type='text' name='comment' value='' /></td>
</tr>
*}
<tr class='{cycle values='odd,even'}'>
<td align='center' colspan='2'><input type='submit' value='{t}Add this categorie{/t}' /></td>
</tr>
</table>


</div>
<div style="clear:both"></div>
