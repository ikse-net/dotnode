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
<h2>{$photo.title|escape}</h2>

<a href='/metalbum/{$url_id}/album/{$metalbum.name}' class='button'>{t}Back{/t}</a><br />
<div style='text-align:center'>
{if $photo}
<img src='{$photo.url_full}' alt='{$photo.description|escape}' /><br />
{$photo.description|escape}
{else}
{t}Nothing here{/t}
{/if}
</div>
<div style='text-align: right'><a href='/metalbum/{$url_id}/album/{$metalbum.name}' class='button'>{t}Back{/t}</a></div>

<br />
<br />
</div>
<div style="clear:both"></div>
