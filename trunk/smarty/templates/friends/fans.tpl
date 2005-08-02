<div id='bigblock'>
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
<h2>{t}Fans list{/t}</h2>

<div id='relation'>
{foreach name='relation' from=$user.path item='item' key='key'}
<a href='/profile/{$key}'>{$item|escape}</a>{if !$smarty.foreach.relation.last} &raquo; {/if}
{/foreach}
</div>
<br />
<table>
{foreach from=$fans key=friend_id item=friend}
<tr class='{cycle values='even,odd'}'>
<td width='64'><img src='{$friend.photo}' alt='photo' /></td>
<td><a href='/profile/{$friend_id}'>{$friend.info.fname|escape} {$friend.info.lname|escape}</a><br />{if $friend.info.gender}{$friend.info.gender_t}{/if}{if $friend.info.gender && $friend.info.relationship_status}, {/if}{if $friend.info.relationship_status}{$friend.info.relationship_status_t}{/if}<br />{$friend.info.country|escape}</td>
<td>{if $friend.info.here_for}<span class='label'>{t}Interested in{/t}:</span><br />{$friend.info.here_for_t}{/if}</td>
</tr>
{/foreach}
</table>
</div> {* mainblock*}
</div> {* bigblock *}
<div style='clear:both'></div>
