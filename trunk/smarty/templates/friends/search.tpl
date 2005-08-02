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

<div id='mainblock'>
<h2>{t}Search friends{/t}</h2>
<form method='post'>
<table>
<tr><th class='profileHeader'>{t}Search for friends on .node network{/t}</th></tr>
<tr class='odd'><td>
<span class='label'>{t}First name{/t}</span>: <input type='text' name='fname' value='{$smarty.post.fname|@stripslashes|escape}' />&nbsp;
<span class='label'>{t}Nickname{/t}</span>: <input type='text' name='nick' value='{$smarty.post.nick|@stripslashes|escape}' />&nbsp;
<span class='label'>{t}Last name{/t}</span>: <input type='text' name='lname' value='{$smarty.post.lname|@stripslashes|escape}' />&nbsp;
<input type='submit' value='{t}Search{/t}' /></td></tr>
</table>
</form>

{if $smarty.post.fname || $smarty.post.lname || $smarty.post.nick}
<br />
<table>
<tr class='profileHeader'><th colspan='4'>{t}Results{/t}</th></tr>
{foreach from=$result item=profile key=id}
<tr class='{cycle values='odd,even'}'>
  <td width='64'><img src='{$profile.photo}' alt='photo' /></td>

  <td><a href='/profile/{$id}'>{$profile.fname|escape} {$profile.lname|escape}</a><br />{if $profile.gender}{$profile.gender_t}{/if}{if $profile.gender && $profile.relationship_status}, {/if}{if $profile.relationship_status}{$profile.relationship_status_t}{/if}<br />{$profile.country|escape}</td>
  <td>{if $profile.here_for}<span class='label'>{t}Interested in{/t}:</span><br />{$profile.here_for_t}{/if}</td>

  <td align='right' wdth='64'>{"<img src='/img/etoile16.png' />"|@str_repeat:$profile.pertinence}</td>
</tr>
{foreachelse}
<tr class='{cycle values='odd,even'}'><td colspan='4'>{t}Nobody match your search. Try again !{/t}</td></tr>
{/foreach}
</table>
{/if}

</div>
<div style='clear:both'></div>
