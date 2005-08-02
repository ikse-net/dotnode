<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{t}Edit{/t}</h2>
{if $my.bookmarks.link}
<form action='/action/my/bookmarks/record/{$token[3]}' method='post'>

<table width='400'>
<tr class='{cycle values='odd,even'}'>
<td class='value' colspan='2'>
<p>{t}Please, do not add illegal sites.{/t}</p>
</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}URL Address{/t} :</td>
<td class='value'><input type='text' name='link' style="width:100%" value='{$my.bookmarks.link.link}' /></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Comment{/t} :</td>
<td class='value'><textarea name='comment' style="width:100%" rows='5' cols='36'>{$my.bookmarks.link.comment|escape}</textarea></td>
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
{html_options options=$bookmarks_cat name='id_cat' selected=$my.bookmarks.link.id_cat onChange='display_input(this.value);'}
<span id='cat_name'{if $my.bookmarks.link.id_cat != 0} style='display:none'{/if}>
<br />{t}Name :{/t}<input type='text' name='cat_name' value='{$my.bookmarks.link.cat_name}'/><br />
in {html_options options=$bookmarks_cat_parent name='id_cat_parent' selected=$my.bookmarks.link.post.id_cat_parent}
</span>
</td>
</tr>


<tr class='{cycle values='odd,even'}'>
<td align='center' colspan='2'><input type='submit' value='{t}Record{/t}' /></td>
</tr>

</table>
</form>
{else}
{t}Nothing here{/t}
{/if}

</div>
<div style="clear:both"></div>
