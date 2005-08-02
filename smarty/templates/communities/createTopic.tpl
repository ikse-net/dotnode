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
<h2>{t 1=$community.info.name}Write a new topic in %1{/t}</h2>
<form action='/action/communities/createTopic/{$token[2]}' method='post'>
<table width='400'>
<tr class='{cycle values='odd,even'}'>
<td class='label' align='right'>{t}Subject{/t} :</td>
<td><input type='text' name='title' /></td>
</tr>
<tr class='{cycle values='odd,even'}'>
<td class='label' align='right'>{t}Message{/t} :</td>
<td><textarea style='width: 100%' cols='35' rows='5' name='message'></textarea></td>
</tr>
<tr class='{cycle values='odd,even'}'>
<td align='right' colspan='2'><input type='submit' value='{t}Submit{/t}'></td>
</tr>

</table>
</form>
</div>
<div style='clear:both'></div>
