<div id='leftblock' >
<img src='{$community.logo}' alt='logo' /><br />

<ul class='info'>
<li><a href='/communities/view/{$community.info.id_comm}'>{$community.info.name|escape}</a></li>
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
<h2>{$event.info.title|escape}</h2>
<table width='400'>
<tr class='{cycle values='odd,even'}'>
<td class='label' align='right'>{t}Date{/t} :</td>
<td>{$event.info.date_event|date_format:"%c"}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td class='label' align='right'>{t}Location{/t} :</td>
<td>{$event.info.location|escape}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td class='label' align='right'>{t}City{/t} :</td>
<td>{$event.info.city|escape}</td>
</tr>
<tr class='{cycle values='odd,even'}'>
<td class='label' align='right'>{t}Country{/t} :</td>
<td>{$event.info.country|escape}</td>
</tr>


<tr class='{cycle values='odd,even'}'>
<td class='label' align='right'>{t}Details{/t} :</td>
<td>{$event.info.details|escape|nl2br|linkurl}</td>
</tr>

{if $event.info.id == $smarty.session.my_id}
<tr class='{cycle values='odd,even'}'>
<td colspan='2' align='right'><a class='button' href='/communities/editEvent/{$token[2]}'>Edit</a> <a class='button' href='/communities/deleteEvent/{$token[2]}' onClick="return confirm('{t}Confirm delete ?{/t}')">Delete</a></td>
</tr>
{/if}
</table>
</form>
</div>
<div style='clear:both'></div>
