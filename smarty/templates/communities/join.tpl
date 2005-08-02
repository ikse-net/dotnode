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
<h2>{t 1=$community.info.name}Join %1{/t}</h2>
{if $token[3]=='moderated'}
<img src='/img/warning-32.png' alt='Warning' />&nbsp;{t}This community is moderated. Your inscription must be validated by the moderator{/t}.
{/if}
<form action='/action/communities/join/{$token[2]}' method='post'>
<p class='confirmJoin'>
{t}Are you sure you want to join this community ?{/t}
</p>
<a class='button' href='/communities/view/{$token[2]}'>{t}No, back to the community{/t}</a>
<input type='submit' value='{t}Join{/t}' />
</form>
</div>
<div style='clear:both'></div>
