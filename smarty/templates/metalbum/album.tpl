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
</div> {* leftblock *}

<div id='home'>
<h2>{t 1=$metalbum.name}Photos of album %1{/t}</h2>
{if $photos}

<table class='album'>
<thead>
<tr class='{cycle values='odd,even'}'><td colspan='4'><a href='{$metalbum.url}'>{t 1=$metalbum.type}See this album directly on %1{/t}</a></td><td class='pagination' colspan='2'>{$pager.all}</td></tr>
</thead>
<tbody>
{foreach name=album from=$photos item=photo}
{if ($smarty.foreach.album.iteration-1)%6 == 0}<tr class='{cycle values='odd,even'}'>{/if}
  <td align='center'>
    <a href='/metalbum/{$url_id}/view/{$metalbum.name}/{$photo.id}'>
    <img style='margin: 3px;' src='{$photo.url_thumb}' alt='$photo.title|escape' /></a><br />
  {$photo.title|truncate:30|escape}<br />
  <span class='subimage'><a href="/metalbum/{$url_id}/view/{$metalbum.name}/{$photo.id}">{t}View full photo{/t}</a></span>
  </td>
{if ($smarty.foreach.album.iteration-1)%6 == 5 || $smarty.foreach.album.teration.last}</tr>{/if}
{/foreach}
</tbody>
<tfoot>
<tr><td class='{cycle values='odd,even'} pagination' colspan='6'>{$pager.all}</td></tr>
</tfoot>
</table>

{else}
{t}Nothing here{/t}
{/if}

<br />
<br />
</div>
<div style="clear:both"></div>
