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
<h2>{$community.info.name|escape}</h2>
<form action='/action/communities/editPost/{$post.info.id_topic}/{$token[2]}' method='post'>
<fieldset class='post'>
<legend>{t}Edit a post{/t}</legend>
{t}Title (optional): {/t}<input type='text' name='title' value='{$smarty.session.error.post.title|default:$post.info.title|escape}' /><br />
{t}Message: {/t}<br />
<textarea name='message' cols='70' rows='20'>{$smarty.session.error.post.message|default:$post.info.message|escape}</textarea><br />
<input type='submit' value='{t}Send{/t}' />
</fieldset>
</form>

</div>
<div style='clear:both'></div>
