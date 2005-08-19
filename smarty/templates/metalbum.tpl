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
{if $metalbumSet}
<h2>{t}Meta Album list{/t}</h2>

<table>
<thead>
<tr class='{cycle values='odd,even'}'><td class='pagination' colspan='6'>{$pager.all}</td></tr>
</thead>
<tbody>
{foreach name=albums from=$metalbumSet item=album}
{if ($smarty.foreach.albums.iteration-1)%6 == 0}
<tr>
{/if}
<td align='center'>
<a href='/metalbum/{$url_id}/album/{$album.login}@{$album.type}'>
<img style='margin: 3px;' src='/img/icons/{$album.type}.png' alt='photo' /></a><br />
<span class='subimage'><a href="/metalbum/{$url_id}/album/{$album.login}@{$album.type}">{$album.login}@{$album.type}</a></span><br />
{if $url_id == $smarty.session.my_id}<span class='subimage'><a href="/action/metalbum/delete/{$album.login}@{$album.type}">{t}Delete ?{/t}</a></span>{/if}
</td>
{if ($smarty.foreach.albums.iteration-1)%6 == 5 || $smarty.foreach.albums.teration.last}
</tr>
{/if}
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

{if $url_id == $smarty.session.my_id}
<form action='/action/metalbum/add' method='post' enctype="multipart/form-data">
<table width='480'>
<tr class='{cycle values='odd,even'}'>
<td class='value' colspan='2'>
<p>{t}You can link your album hosted by a supported site with your .node profile.{/t}</p>
<p>{t}No verification can be done, so becareful with data submitted here.{/t}</p>
</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}The site that host your album{/t} :</td>
<td class='value'>{html_options name='type' options=$labels.metalbum.type}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Your login{/t} :</td>
<td class='value'><input type='text' name='login' /></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='center' colspan='2'><input type='submit' value='{t}Add{/t}' /></td>
</tr>
</table>
{/if}

<br />
</div>
<div style="clear:both"></div>
