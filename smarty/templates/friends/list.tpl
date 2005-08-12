
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
</div> {* leftblock *}

<div id='mainblock'>
<h2>{t}Friends list{/t}</h2>

<div id='relation'>
{foreach name='relation' from=$user.path item='item' key='key'}
<a href='/profile/{$key}'>{$item|escape}</a>{if !$smarty.foreach.relation.last} &raquo; {/if}
{/foreach}
</div> {* relation *}
<br />

<table>
<tr><td class='{cycle values='odd,even'} pagination' colspan='4'>{$pager.all}</td></tr>
{foreach name=friends from=$friends item=friend key=id_friend}
{if ($smarty.foreach.friends.iteration-1)%3 == 0}
<tr  class='{cycle values='odd,even'}'>
{/if}
<td><img src='{$friend.thumb_path}' alt='[photo]' class='{$friend.gender}' /></td>
<td>
        <a class='name' href='/profile/{$id_friend}' title='{$friend.fname|escape}{if $friend.nick} "{$friend.nick|escape}"{/if} {$friend.lname|escape}'>
        {$friend.fname|escape|truncate:'15'}{if $friend.nick} <i>"{$friend.nick|escape|truncate:'15'}"</i>{/if} {$friend.lname|escape|truncate:'15'}</a>
        {$friend.country|escape}<br />
        <a href='/friends/{$id_friend}/list'>{t escape=no count=$friend.nb_friends plural="<b>%1</b> friends"}<b>%1</b> friend{/t}</a>{if $friend.nb_fans>0} (<a href='/friends/{$id_friend}/fans'>{t escape=no count=$friend.nb_fans plural="<b>%1</b> fans"}<b>%1</b> fan{/t}</a>){/if}.<br />
        {if $friend.nb_blogs>0}<a href='/blog/{$id_friend}'>{t escape=no count=$friend.nb_blogs plural="<b>%1</b> blogs"}<b>%1</b> blog{/t}</a>{/if}

        {if $friend.nb_blogs>0 && $friend.nb_photos>0}, {/if}

        {if $friend.nb_photos>0}<a href='/album/{$id_friend}'>{t escape=no count=$friend.nb_photos plural="<b>%1</b> photos"}<b>%1</b> photo{/t}</a>{/if}

        {if ($friend.nb_photos>0 || $friend.nb_blogs>0) && $friend.nb_bookmarks}, {/if}

        {if $friend.nb_bookmarks>0}<a href='/bookmarks/{$id_friend}'>{t escape=no count=$friend.nb_bookmarks plural="<b>%1</b> bookmarks"}<b>%1</b> bookmark{/t}</a>{/if}
        {if $friend.nb_bookmarks>0 || $friend.nb_photos>0 || $friend.nb_bookmarks>0}<br />{/if}
        <a class='contact' href='/messages/write/{$id_friend}/contact'><img src='/img/message_one.png' alt='' align='middle' />&nbsp;{t}Send message{/t}</a>
  </td>
{if ($smarty.foreach.friends.iteration-1)%3 == 2 || $smarty.foreach.friends.last}
</tr>
{/if}
{/foreach}
<tr><td class='{cycle values='odd,even'} pagination' colspan='4'>{$pager.all}</td></tr>
</table>

</div> {* mainblock *}
<div style='clear:both'></div>
