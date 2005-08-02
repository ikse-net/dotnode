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
<h2>{t}Friends list{/t}</h2>

<form action='/action/{$url_id}/friends/invitation' method='post'>
<p>{t}Specify how close you are to your friend{/t}:</p>
<div style='padding: 5px;' class='odd'>
{html_radios name='level' options=$labels.friends.relation selected='friend'}<br />
</div>
<p>{t 1=$user.info.fname}Confirm %1 is your friend{/t}:</p>
<input type='submit' name='yes' value='{t}Yes{/t}'>&nbsp;{t 1=$user.info.fname}%1 is my friend{/t}.<br />
<br />
<input type='submit' name='no' value='{t}No{/t}'>&nbsp;{t 1=$user.info.fname}%1 is not my friend{/t}.
</form>
</div>
<div style='clear:both'></div>
