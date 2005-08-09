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

<table class='forum'>
<tr><th colspan='4' class='profileHeader' colspan='2'>{t}Forum{/t}</tr>

<tr class='{cycle name='forum' values='odd,even'}'>
<th>{t}Subject{/t}</th>
<th>{t}Author{/t}</th>
<th>{t}Posts{/t}</th>
<th>{t}Last post{/t}</th>
</tr>
{foreach from=$community.topics item=topic}
<tr class='{cycle name='forum' values='odd,even'}'>
<td><img src='/img/topic.png' alt='topic' align='top' />&nbsp;<a href='/communities/viewTopic/{$topic.id_topic}'>{$topic.title|escape}</a></td>
<td><a href='/profile/{$topic.id}'>{$topic.author|escape}</a></td>
<td>{$topic.nb_posts-1}</td>
<td>{$topic.last_post_date|date_format:"%e %B %Y %H:%M"}</td>
</tr>

{foreachelse}
<tr class='{cycle name='forum' values='odd,even'}'>
<td colspan='4' align='center'>No topic</td>
</tr>
{/foreach}
{if $is_member}
<tr class='{cycle name='forum' values='odd,even'}'>
<td colspan='4' align='right'><a class='button' href='/communities/createTopic/{$token[2]}'>{t}New topic{/t}</a></td>
</tr>
{/if}
</table>

</div> {* mainblock *}
<div style='clear:both'></div>
</div> {* largeblock *}
