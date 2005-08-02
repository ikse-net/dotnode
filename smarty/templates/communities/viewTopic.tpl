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
<h2{if $topic.info.sticky=='true'} style="background-image: url(/img/sticky-24.png);"{/if}>{$topic.info.title|escape}</h2>
<table class='topic'>
{foreach name=post from=$topic.posts key=id_post item=post}
<tr>
<td class='{cycle name='photo' values='odd,even'}'width='64'><a href='/profile/{$post.id}' title='{$post.author|escape}'><img src='{$post.author_photo}' alt='photo' /></a><br /><a title='{$post.author|escape}' href='/profile/{$post.id}'>{$post.author|escape|truncate:'15'}</a></td>
<td class='{cycle name='topic' values='even,odd'}'><strong>{$post.title|escape}</strong> <span class='label'>{$post.date|date_format:"%e %B %Y %H:%M"}</span><br />{$post.message|wikise}
{if $post.id == $smarty.session.my_id || $community.info.id == $smarty.session.my_id}
<br /><span class='action'>
  {if $community.info.id == $smarty.session.my_id}{t}Moderation{/t}{/if}
  {if $post.id == $smarty.session.my_id}&nbsp;::&nbsp;<a href='/communities/editPost/{$post.id_post}'>{t}Edit{/t}</a>{/if}
  {if $smarty.foreach.post.first && $community.info.id == $smarty.session.my_id}&nbsp;::&nbsp;
   {if $topic.info.sticky=='true'}
    <a href='/communities/stickyTopic/{$token[2]}/false'>{t}Unstick it{/t}</a>
   {else}
    <a href='/communities/stickyTopic/{$token[2]}/true'>{t}Stick it{/t}</a>
   {/if}
  {/if}

  {if !$smarty.foreach.post.first && ($post.id == $smarty.session.my_id || $community.info.id == $smarty.session.my_id)}&nbsp;::&nbsp;<a href='/communities/deletePost/{$post.id_post}' onClick="return confirm('{t}Confirm delete ?{/t}')">{t}Delete{/t}</a>{/if}
</span>
{/if}
</td>
</tr>
{/foreach}
{if $member}
<tr class='{cycle name='topic' values='even,odd'}'>
<td align='right' colspan='2'><a class='button' href='/communities/replyTopic/{$token[2]}'>{t}Reply to topic{/t}</a></td>
</tr>
{/if}
</table>
</div>
<div style='clear:both'></div>
