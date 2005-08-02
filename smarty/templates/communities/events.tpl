<div id='largeblock'>

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
</div> {* leftblock *}

<div id='mainblock'>
<h2>{$community.info.name|escape}</h2>
<table class='events'>
<tr><th colspan='3' class='profileHeader' colspan='2'>{t}Event{/t}</tr>
<tr class='{cycle name='events' values='odd,even'}'>
<th>{t}Title{/t}</th>
<th>{t}Location{/t}</th>
<th>{t}Date{/t}</th>
</tr>
{foreach from=$community.events item=event}
<tr class='{cycle name='events' values='odd,even'}'>
<td><img src='/img/event.png' alt='event' align='top' />&nbsp;<a href='/communities/viewEvent/{$event.id_event}'>{$event.title|escape}</a></td>
<td>{$event.city|escape}, {$event.country|escape}</td>
<td>{$event.date_event|date_format:"%c"}</td>
</tr>

{foreachelse}
<tr class='{cycle name='events' values='odd,even'}'>
<td colspan='3' align='center'>{t}No event{/t}</td>
</tr>
{/foreach}
{if $member}
<tr class='{cycle name='events' values='odd,even'}'>
<td colspan='3' align='right'><a class='button' href='/communities/createEvent/{$token[2]}'>{t}New event{/t}</a></td>
</tr>
{/if}
</table>

</div> {* mainblock *}
<div style='clear: both'></div>
</div> {* largeblock *}
