<div id='leftblock' >
<a href='/profile/{$url_id}'><img src='{$user.photo}' alt='photo' /></a><br />
<ul class='info'>
<li><a href='/profile/{$url_id}'>{$user.info.fname|escape} {$user.info.lname|escape}</a></li>
<li>{$user.info.gender_t}{if $user.info.relationship_status_t}, {$user.info.relationship_status_t}{/if}</li>
<li>{$user.info.country}</li>
<li>&nbsp;</li>
{if $user.info.here_for_t}
<li><span class='label'>{t}Interested in{/t}:</span><br />{$user.info.here_for_t}</li>
{/if}
</ul>

{if $leftmenu}
{strip}
<ul class='menu'>
{foreach name=leftmenu from=$leftmenu item=title key=link}
{strip}<li><a href='
{if $link[0] neq '/'}
        /{$token[0]}/{$link}
{else}
        {$link}
{/if}
'{if $token[1] eq $link} class='active'{/if}>{t}{$title}{/t}</a></li>{/strip}
{/foreach}
</ul>
{/strip}
{/if}
</div>

<div id='home'>
<h2>{t 1=$user.info.fname}%1's Album{/t}</h2>
{if $album.image}

<table>
{strip}
<tr><td class='{cycle values='odd,even'} pagination' colspan='4'>
{t}Page:{/t}
{foreach from=$pagination.pages item=none key=page}
{if $pagination.current_page == $page}
&nbsp;<strong>{$page}</strong>
{else}
&nbsp;<a href='/album/{$url_id}/page/{$page}'>{$page}</a>
{/if}
{/foreach}
</td></tr>
{/strip}

{foreach name=album from=$album.image item=image key=id_image}
{if ($smarty.foreach.album.iteration-1)%4 == 0}
<tr>
{/if}
  <td align='center'>
    <a href='/album/{$url_id}/view/{$pagination.elmt_by_page*$pagination.last_page+$smarty.foreach.album.iteration}'>
    <img style='margin: 3px;' src='{$image.thumb_path}' alt='photo' /></a><br />
  {$image.caption|escape|linkurl}<br />
  <span class='subimage'><a href="/album/{$url_id}/view/{$pagination.elmt_by_page*$pagination.last_page+$smarty.foreach.album.iteration}">{t}View full photo{/t}</a></span>
  </td>
{if ($smarty.foreach.album.iteration-1)%4 == 3 || $smarty.foreach.album.teration.last}
</tr>
{/if}
{/foreach}

{strip}
<tr><td class='{cycle values='odd,even'} pagination' colspan='4'>
{t}Page:{/t}
{foreach from=$pagination.pages item=none key=page}
{if $pagination.current_page == $page}
&nbsp;<strong>{$page}</strong>
{else}
&nbsp;<a href='/album/{$url_id}/page/{$page}'>{$page}</a>
{/if}
{/foreach}
</td></tr>
{/strip}

</table>

{else}
{t}Nothing here{/t}
{/if}
<br />
<br />
</div>
<div style="clear:both"></div>
