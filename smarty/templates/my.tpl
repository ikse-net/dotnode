<div id='rightblock'>
<div id='flipblock'>
<div id='blockmenu'>
<a class='even' href="javascript:display_pan('friends')">{t}Friends{/t} ({$my.info.nb_friends})</a>
{if $my.communities}
<a class='odd' href="javascript:display_pan('communities')">{t}Communities{/t} ({$my.info.nb_communities})</a>
{/if}
</div>
<div id='pan_friends' class='pan active even'>
{if $my.friends|@count>1}{t escape=no 1=$my.friends|@count}The %1 last friends who have visited my profile (<a href='/friends/list'>View full list</a>):{/t}{/if}
<table>
{foreach name=friends from=$my.friends item=friend key=id_friend}
<tr>
	{strip}
  <td class='thumb'><a href='/profile/{$id_friend}'><img src='{$friend.thumb_path}' alt='[photo]' class='{$friend.gender}' /></a></td>
<td style='width: 100%'>
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
	{/strip}
</tr>
{/foreach}
</table>
</div>
{if $my.communities}
<div id='pan_communities' class='pan odd'>
{t escape=no 1=$my.communities|@count}The %1 last communities' post (<a href='/profile/communities'>View all communities subscribed</a>): {/t}
<table>
{foreach name=comm from=$my.communities item=comm key=id_comm}
<tr>
  <td>
    <a href='/communities/view/{$id_comm}'><img src='{$comm.photo}' alt='[logo]' {if $smarty.session.my_id == $comm.id} class='owner'{/if}/></a>
  </td>
  <td style='width: 100%'>
    <a class='name' href='/communities/view/{$id_comm}' title='{$comm.name|escape}'>{$comm.name|escape|truncate:'25'}</a>
    <a href='/communities/members/{$id_comm}'>{t escape=no count=$comm.nb_members plural="<b>%1</b> members"}%1 member{/t}</a>.<br />
    {if $comm.moderated == 'yes'}{t}Moderated{/t}.<br />{/if}
    {if $comm.last_post_date}{t escape=no 1=$comm.id_comm 2=$comm.last_post_date|date_format:'%x %X'}Last post: <a href='/communities/forum/%1'>%2</a>{/t}{/if}
  </td>
</tr>
{/foreach}
</table>
</div>
{/if}
</div>
</div> {* rightblock *}

<div id='bigblock'>
<div id='leftblock'>
<img class='profile_photo' src='{$smarty.session.my_photo}' alt='photo' />

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

</div>  {* leftblock *}

<div id='mainblock'>
<h2>{t 1=$smarty.session.my_fname}Welcome %1{/t}</h2>
<p>
{t escape='no' count=$nyrk.total}.node counts <b>%1</b> people{/t}.<br />
{t escape='no' count=$my.info.nb_friends_of_friends plural='Your network (direct connect + friends of friends) counts <b>%1</b> persons'}Your network (direct connect + friends of friends) counts <b>%1</b> person{/t}.<br />
{t 1=$nyrk.actually escape=no}Right now, <b>%1</b> people are on .node{/t}.</p>

<ul style='list-style: url(/img/arrow.png)'>
<li><a href='/friends/join'>{t}Invite my friends to join .node...{/t}</a></li>
<li><a href='/my/profile'>{t}Fill my extended profile{/t}</a></li>
{if $my.info.photo == 'n'}<li><a href='/my/profile/photo'>{t}Put my photo{/t}</a></li>{/if}
{if $my.info.nb_photos == 0}<li><a href='/my/album'>{t}Create my album{/t}</a></li>
{elseif $my.info.nb_photos<10}<li><a href='/my/album'>{t}Add more photo in my album{/t}</a></li>{/if}
{if $my.info.nb_blogs == 0}<li><a href='/my/blog'>{t}Create my blog{/t}</a></li>
{else}<li><a href='/my/blog/add'>{t}Write a ticket in my blog{/t}</a></li>{/if}
{if $my.info.nb_bookmarks == 0}<li><a href='/my/bookmarks'>{t}Create my bookmarks{/t}</a></li>
{else}<li><a href='/my/bookmarks#form'>{t}Add a link in my bookmarks{/t}</a></li>{/if}
{if $my.info.nb_communities<10}<li><a href='/communities/search'>{t}Search & subscribe to communities{/t}</a></li>{/if}
</ul>

{if $my.info.nb_fans > 0}
<p>
<img src='/img/fan.png' alt='' align='middle' />&nbsp;<a href='/friends/fans'>{t escape='no' count=$my.info.nb_fans plural="You have <b>%1</b> fans"}You have <b>%1</b> fan{/t}</a>
</p>
{/if}

{if $smarty.session.nb_new_messages > 0}
<p><img src='/img/message_one.png' alt='' align='middle' />&nbsp;<a href='/messages/inbox'>{t escape='no' count=$smarty.session.nb_new_messages plural="You have <b>%1</b> new messages"}You have <b>%1</b> new message{/t}</a></p>
{/if}

<p><img class='icon' src='/img/help.png' alt='help' align='left' />&nbsp;{t}Tell people your dotpage address:{/t} <a href='http://{$my.info.login}.{$config.domain}'>{$my.info.login}.{$config.domain}</a>
</p>

<p><img src='/img/bulle-chat.png' alt='Chat !!' align='left' style='width: 100px; height: 53px;' />{t}Come on the .node IRC channel{/t}: <a href='/irc'>#dotnode@irc.freenode.net</a></p>

</div> {* mainblock *}
<div style="clear:both"></div>
</div> {* bigblock *}
<div style="clear:both"></div>
{literal}
<script type='text/javascript'>
var current_pan_o = document.getElementById('pan_friends');

function display_pan(what)
{
	current_pan_o.style.display = "none";
	current_pan_o = document.getElementById('pan_'+what);
	current_pan_o.style.display = "block";
}
</script>
{/literal}


