<dv id='bigblock'>
<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='mainblock'>
<h2>{t 1=$smarty.session.my_fname}%1's Bookmarks{/t}</h2>
<a name='form'></a>
<form action='/action/my/bookmarks/add' method='post'>

<table>
<tr><th class='title' colspan='2'>{t}Add a bookmark{/t}</th></tr>
<tr class='{cycle values='odd,even'}'>
<td class='value' colspan='2'>
<p>{t}Share your best links with your friends and other .nodians.{/t}</p>
<p>{t}Please, do not add illegal sites.{/t}</p>
</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}URL Address{/t} :</td>
<td class='value'><input type='text' name='link' value='{$smarty.session.error.post.link|default:'http://'}' /></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Comment{/t} :</td>
<td class='value'>
<textarea name='comment' rows='5' cols='36'>{$smarty.session.error.post.comment}</textarea>
</td>
</tr>


<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Category{/t} :</td>
<td class='value'>
{literal}
<script type='text/javascript'>
function display_input(value)
{
	input_form = document.getElementById('cat_name');
	if(value == 0)
		input_form.style.display = 'inline';
	else
		input_form.style.display = 'none';
	return true;
}
</script>
{/literal}
{html_options options=$bookmarks_cat name='id_cat' selected=$smarty.session.error.post.id_cat onChange='display_input(this.value);'}
<span id='cat_name'{if $smarty.session.error.post.id_cat != 0} style='display:none'{/if}>
<br />{t}Name :{/t}<input type='text' name='cat_name' value='{$smarty.session.error.post.cat_name}'/><br />
in {html_options options=$bookmarks_cat_parent name='id_cat_parent' selected=$smarty.session.error.post.id_cat_parent}
</span>
</td>
</tr>


<tr class='{cycle values='odd,even'}'>
<td align='center' colspan='2'><input type='submit' value='{t}Add{/t}' /></td>

</tr>
</table>

{if $my.bookmarks}
<dl id='bookmarks'>
{foreach name='bookmarks' from=$my.bookmarks item=link}
<dt>&raquo;&nbsp;<a href='{$link.link|escape}'>{$link.link|escape|truncate:'64':'(...)'}</a></dt>
<dd>
{foreach name=path from=$link.path item=item}
<a href='/my/bookmarks/category/{$item[0]}'>{$item[1]}</a>{if !$smarty.foreach.path.last} / {/if}
{/foreach}
<br />

{$link.comment|escape|nl2br}<br />

<a href='/my/bookmarks/edit/{$smarty.foreach.bookmarks.iteration}'>{t}Edit{/t}</a>&nbsp;-&nbsp;<a onClick="return confirm('{t}Confirm delete ?{/t}')" href='/my/bookmarks/delete/{$smarty.foreach.bookmarks.iteration}'>{t}Delete{/t}</a>
</dd>
{/foreach}
</dl>
{else}
{t}Nothing here{/t}
{/if}
</div> {* mainblock *}
</div> {* bigblock *}

<div style="clear:both"></div>
