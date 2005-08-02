<div id='rightblock'>
<div id='flipblock'>
<div id='blockmenu'>
<a class='even' href="javascript:display_pan('members')">{t}Members{/t} ({$community.info.nb_members})</a>
{if $related_communities}
<a class='odd' href="javascript:display_pan('communities')">{t}Related communities{/t}</a>
{/if}
</div>
<div id='pan_members' class='pan active even'>
{if $community.info.nb_members > 1}{t escape=no 1=$community.members|@count 2=$community.info.name 3=$community.info.id_comm}The %1 last %2's members who have visited this community (<a href='/communities/members/%3'>View full list</a>):{/t}{/if}
<table>
{foreach name=members from=$community.members item=member key=id_member}
<tr>
        {strip}
  <td class='thumb'><a href='/profile/{$id_member}'><img src='{$member.thumb_path}' alt='[photo]' class='{$member.gender}' /></a></td>
  <td style='width: 100%'>
        <a class='name' href='/profile/{$id_member}' title='{$member.fname|escape}{if $member.nick} "{$member.nick|escape}"{/if} {$member.lname|escape}'>
        {$member.fname|escape|truncate:'15'}{if $member.nick} <i>"{$member.nick|escape|truncate:'15'}"</i>{/if} {$member.lname|escape|truncate:'15'}</a>
        {$member.country|escape}<br />
        <a href='/friends/{$id_member}/list'>{t escape=no count=$member.nb_friends plural="<b>%1</b> friends"}<b>%1</b> friend{/t}</a>{if $member.nb_fans>0} (<a href='/friends/{$id_member}/fans'>{t escape=no count=$member.nb_fans plural="<b>%1</b> fans"}<b>%1</b> fan{/t}</a>){/if}.<br />
        {if $member.nb_blogs>0}<a href='/blog/{$id_member}'>{t escape=no count=$member.nb_blogs plural="<b>%1</b> blogs"}<b>%1</b> blog{/t}</a>{/if}

        {if $member.nb_blogs>0 && $member.nb_photos>0}, {/if}

        {if $member.nb_photos>0}<a href='/album/{$id_member}'>{t escape=no count=$member.nb_photos plural="<b>%1</b> photos"}<b>%1</b> photo{/t}</a>{/if}

        {if ($member.nb_photos>0 || $member.nb_blogs>0) && $member.nb_bookmarks}, {/if}

        {if $member.nb_bookmarks>0}<a href='/bookmarks/{$id_member}'>{t escape=no count=$member.nb_bookmarks plural="<b>%1</b> bookmarks"}<b>%1</b> bookmark{/t}</a>{/if}
        {if $member.nb_bookmarks>0 || $member.nb_photos>0 || $member.nb_bookmarks>0}{/if}
  </td>
        {/strip}
</tr>
{/foreach}
</table>

</div>
{if $related_communities}
<div id='pan_communities' class='pan odd'>
{t escape=no 1=$related_communities|@count 2=$url_id}The first %1 related communities: {/t}
<table>
{foreach name=comm from=$related_communities item=comm key=id_comm}
<tr>
  <td class='thumb'><a href='/communities/view/{$id_comm}'><img src='{$comm.logo}' alt='[logo]'{if $smarty.session.my_id == $comm.id} class='owner'{/if} /></a></td>
  <td style='width: 100%'>
    <a class='name' href='/communities/view/{$id_comm}' title='{$comm.name|escape}'>{$comm.name|escape|truncate:'25'}</a>
    Score: {$comm.score|string_format:"%.2f"} %<br />
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
</div>

<div id='bigblock'>

<div id='leftblock' >
<img src='{$community.logo}' alt='logo' /><br />
{if $leftmenu}
{strip}
<ul class='menu'>
{foreach name=leftmenu from=$leftmenu item=title key=link}
{strip}<li><a href="
{if $link[0] neq '/'}
        /{$token[0]}/{$link}
{else}
        {$link}
{/if}
"
{if $token[1] eq $link}class='active'{/if}>{t}{$title}{/t}</a></li>{/strip}
{/foreach}
</ul>
{/strip}
{/if}
</div> {* leftblock *}

<div id='mainblock'>
<h2>{$community.info.name|escape}</h2>

<table>
<tr><th class='profileHeader' colspan='2'>{t}Details{/t}</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Description{/t} : </td>
<td class='value'>{$community.info.description|wikise}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Category{/t} : </td>
<td class='value'><a href='/communities/category/{$community.info.id_cat}'>{t}{$community.info.category}{/t}</a></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Owner{/t} : </td>
<td class='value'><a href='/profile/{$community.info.id}'>{$community.owner.fname|escape} {if $community.owner.nick}"{$community.owner.nick|escape}" {/if}{$community.owner.lname|escape}</a></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Moderated{/t} : </td>
<td class='value'>{$community.info.moderated_t}</td>
</tr>

{if $community.info.country}
<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Country{/t} : </td>
<td class='value'>{$community.info.country}</td>
</tr>
{/if}

<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Created{/t} : </td>
<td class='value'>{$community.info.date|date_format:"%a %e %B %Y"}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'>{t}Size{/t} : </td>
<td class='value'><a href='/communities/members/{$community.info.id_comm}'>{t count=$community.info.nb_members plural="%1 members"}%1 member{/t}</a></td>
</tr>
</table>
</div> {* mainblock*}
<div style='clear: both'></div>

<div id='subblock'>

{* **************
 * Moderation
 * ************** *}
{if $community.moderations}
<form action='/action/communities/moderation/{$token[2]}' method='post'>
<table>
{foreach from=$community.moderations key=id_moderation item=moderation}
<tr class='{cycle name='moderation' values='odd,even'}'>
<td width='64'><img src='{$moderation.photo}' alt='{$moderation.fname|escape}' /></td>
<td><a href='/profile/{$id_moderation}'>{$moderation.fname|escape} {$moderation.lname|escape}</td>
<td align='right'>
	<select name='moderation[{$moderation.id}]'>
	<option value='waiting'>{t}Stand in moderation{/t}</option>
	<option value='ok'>{t}Accept{/t}</option>
	<option value='refuse'>{t}Refuse{/t}</option>
	</select>
</td>
</tr>
{/foreach}
<tr class='{cycle name='moderation' values='odd,even'}'>
<td colspan='3' align='right'><input type='submit' value='{t}Record{/t}' /></td>
</tr>
</table>
</form>
<br />
{/if}
{* ************** *}

<table class='forum'>
<tr><th colspan='4' class='profileHeader'>{t}Forum{/t}</tr>

<tr class='{cycle name='forum' values='odd,even'}'>
<th>{t}Subject{/t}</th>
<th>{t}Author{/t}</th>
<th>{t}Posts{/t}</th>
<th>{t}Last post{/t}</th>
</tr>
{foreach from=$community.sticky_topics item=topic}
<tr class='{cycle name='forum' values='odd,even'}'>
<td><img src='/img/sticky-15.png' alt='sticky topic' align='top' />&nbsp;<a href='/communities/viewTopic/{$topic.id_topic}'>{$topic.title|escape}</a></td> 
<td><a href='/profile/{$topic.id}'>{$topic.author|escape}</a></td>
<td>{$topic.nb_posts-1}</td>
<td>{$topic.last_post_date|date_format:"%e %B %Y %H:%M"}</td>
</tr>
{/foreach}

{foreach from=$community.topics item=topic}
<tr class='{cycle name='forum' values='odd,even'}'>
<td><img src='/img/topic.png' alt='topic' align='top' />&nbsp;<a href='/communities/viewTopic/{$topic.id_topic}'>{$topic.title|escape}</a></td>
<td><a href='/profile/{$topic.id}'>{$topic.author|escape}</a></td>
<td>{$topic.nb_posts-1}</td>
<td>{$topic.last_post_date|date_format:"%e %B %Y %H:%M"}</td>
</tr>

{foreachelse}
{if !$community.sticky_topics}
<tr class='{cycle name='forum' values='odd,even'}'>
<td colspan='4' align='center'>{t}No topic{/t}</td>
</tr>
{/if}
{/foreach}
{if $is_member}
<tr class='{cycle name='forum' values='odd,even'}'>
<td colspan='4' align='right'><a class='button' href='/communities/createTopic/{$token[2]}'>{t}New topic{/t}</a></td>
</tr>
{/if}
<tr class='{cycle name='forum' values='odd,even'}'>
<td colspan='4' align='right'><a href='/communities/forum/{$token[2]}'>{t}View all topics{/t}</a></td>
</tr>

</table>

<br />

<table class='events'>
<tr><th colspan='3' class='profileHeader'>{t}Event{/t}</tr>
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
{if $is_member}
<tr class='{cycle name='events' values='odd,even'}'>
<td colspan='3' align='right'><a class='button' href='/communities/createEvent/{$token[2]}'>{t}New event{/t}</a></td>
</tr>
{/if}
<tr class='{cycle name='events' values='odd,even'}'>
<td colspan='3' align='right'><a href='/communities/events/{$token[2]}'>{t}View all events{/t}</a></td>
</tr>
</table>

</div> {* subblock *}
</div> {* bigblock*}

{literal}
<script type='text/javascript'>
var current_pan_o = document.getElementById('pan_members');

function display_pan(what)
{
        current_pan_o.style.display = "none";
        current_pan_o = document.getElementById('pan_'+what);
        current_pan_o.style.display = "block";
}
</script>
{/literal}

