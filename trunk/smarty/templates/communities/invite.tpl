<div id='leftblock' >
<img src='{$community.logo}' alt='logo' /><br />

<ul class='info'>
<li><a href='/communities/view/{$token[2]}'>{$community.info.name|escape}</a></li>
<li>({t count=$community.info.nb_members plural="%1 members"}%1 member{/t})</li>
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
<h2>{t 1=$community.info.name}Invite friends to %1{/t}</h2>
<form action='/action/communities/invite/{$token[2]}' method='post'>
<table>
<tr>
<th class='profileHeader' colspan='6'>{t}Choose friends{/t}</th>
</tr>
{foreach name='friends' from=$friends item=friend key=friend_id}
{if ($smarty.foreach.friends.iteration-1)%3 == 0}
<tr class='{cycle values='odd,even'}'>
{/if}
<td width='25'><input type='checkbox' name='invitation[]' value='{$friend_id}' /></td>
<td><a href='/profile/{$friend_id}'>{$friend.fname|escape} {$friend.lname|escape}</a></td>
{if ($smarty.foreach.friends.iteration-1)%3 == 2}
</tr>
{/if}
{/foreach}
<tr  class='{cycle values='odd,even'}'>
<td align='right' colspan='6'><input type='submit' value='{t}Invite{/t}'></td>
</tr>

</table>
</form>
</div>
<div style='clear:both'></div>
