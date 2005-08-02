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
<h2>{$user.info.fname|escape} {$user.info.lname|escape}</h2>
<table width='500'>
<tr><th colspan='2' class='profileHeader'>{t}Communities{/t}</th></tr>
{foreach from=$communities item=comm}
<tr class='{cycle values='odd,even'}'>
<td><img src='{$comm.logo}' alt='' /></td>
<td>
<a href='/communities/view/{$comm.id_comm}'>{$comm.name|escape}</a> ({t count=$comm.nb_members plural="%1 members"}%1 member{/t})<br />
{$comm.categorie|escape}
{$comm.description|escape|truncate:120}
</td>
</tr>
{/foreach}
</table>
</div>
<div style='clear:both'></div>
