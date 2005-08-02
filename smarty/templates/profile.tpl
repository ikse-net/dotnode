<div id='rightblock'>
<div id='flipblock'>
<div id='blockmenu'>
<a class='even' href="javascript:display_pan('friends')">{t}Friends{/t} ({$user.info.nb_friends})</a>
{if $user.communities}
<a class='odd' href="javascript:display_pan('communities')">{t}Communities{/t} ({$user.info.nb_communities})</a>
{/if}
{if $user.relation_type == 'friends'}
<a class='even' href="javascript:display_pan('karma')">{t}Karma{/t}</a>
{/if}
</div>
<div id='pan_friends' class='pan active even'>
{if $user.friends|@count>1}{t escape=no 1=$user.friends|@count 2=$user.info.fname 3=$url_id}The %1 last %2's friends who have visited that profile (<a href='/friends/%3/list'>View full list</a>):{/t}{/if}
<table>
{foreach name=friends from=$user.friends item=friend key=id_friend}
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
	{if $friend.nb_bookmarks>0 || $friend.nb_photos>0 || $friend.nb_bookmarks>0}{/if}
  </td>
	{/strip}
</tr>
{/foreach}
</table>
</div>

{if $user.communities}
<div id='pan_communities' class='pan odd'>
{t escape=no 1=$user.communities|@count 2=$url_id}The %1 last communities' post (<a href='/profile/%2/communities'>View all communities subscribed</a>): {/t}
<table>
{foreach name=comm from=$user.communities item=comm key=id_comm}
<tr>
  <td class='thumb'><a href='/communities/view/{$id_comm}'><img src='{$comm.photo}' alt='[logo]'{if $smarty.session.my_id == $comm.id} class='owner'{/if} /></a></td>
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

{if $user.relation_type == 'friends'}
<div id='pan_karma' class='pan even'>
{t}Rate your friend to build his/her karma: {/t}
<table style='width: 98%'>

<tr>
<td style='vertical-align: middle; text-align: right;'>{t}Fan: {/t}</td>
<td colspan='2'><img id='karma_fan' src='/img/karma/fan{$user.karma.fan|default:0}.png' onClick="setKarma('{$url_id}', 'fan', null)" style="cursor: pointer;" /></td>
</tr>

<tr>
  <td style='vertical-align: middle; text-align: right;'>
{t}Fun: {/t}
</td>
<td dir='ltr' style='width: 110px'>
{strip}
<img src='/img/karma/minus.png' onClick="setKarma('{$url_id}', 'fun', '-1')" style="cursor: pointer;" />
<img id='karma_fun' src='/img/karma/fun{$user.karma.fun|default:0}.png' alt='fun: {$user.karma.fun}' />
<img src='/img/karma/plus.png' onClick="setKarma('{$url_id}', 'fun', '+1')" style="cursor: pointer;" />
{/strip}
  </td>
<td style='vertical-align: middle;'>
<span id='span_fun'>{$user.karma.fun|default:0}</span>
</td>
</tr>
<tr>
  <td style='vertical-align: middle; text-align: right;'>
{t}Cool: {/t}
</td>
  <td dir='ltr' style='width: 110px'>
{strip}
<img src='/img/karma/minus.png' onClick="setKarma('{$url_id}', 'cool', '-1')" style="cursor: pointer;" />
<img id='karma_cool' src='/img/karma/cool{$user.karma.cool|default:0}.png' alt='cool: {$user.karma.cool}' />
<img src='/img/karma/plus.png' onClick="setKarma('{$url_id}', 'cool', '+1')" style="cursor: pointer;" />
{/strip}
  </td>
<td style='vertical-align: middle;'>
<span id='span_cool'>{$user.karma.cool|default:0}</span>
</td>
</tr>
<tr>
  <td style='vertical-align: middle; text-align: right;'>
{t}Sexy: {/t}
</td>
  <td dir='ltr' style='width: 110px'>
{strip}
<img src='/img/karma/minus.png' onClick="setKarma('{$url_id}', 'sexy', '-1')" style="cursor: pointer;" />

<img id='karma_sexy' src='/img/karma/sexy{$user.karma.sexy|default:0}.png' alt='sexy: {$user.karma.sexy}' />
<img src='/img/karma/plus.png' onClick="setKarma('{$url_id}', 'sexy', '+1')" style="cursor: pointer;" />

{/strip}
  </td>
<td style='vertical-align: middle;'>
<span id='span_sexy'>{$user.karma.sexy|default:0}</span>
</td>
</tr>
<tr>
<td style='vertical-align: middle; text-align: right;'>{t}Relation: {/t}</td>
<td colspan='2'>{html_options name=level options=$labels.friends.relation selected=$user.karma.level onChange="setKarma('$url_id', 'level', this.value)"}</td>
</tr>

<tr>
<td style='vertical-align: middle; text-align: right;'>{t}Type: {/t}</td>
<td colspan='2'>{html_options name=type options=$labels.friends.type selected=$user.karma.type onChange="setKarma('$url_id', 'type', this.value)"}</td>
</tr>

</table>

</div>
{/if}

<script type='text/javascript'>

var karma_fan={$user.karma.fan|default:0};
var karma_fun={$user.karma.fun|default:0};
var karma_cool={$user.karma.cool|default:0};
var karma_sexy={$user.karma.sexy|default:0};

{literal}
function setKarma(id, type, value)
{
	if(type == 'cool' || type == 'fun' || type == 'sexy')
	{
		if(value == '-1')
		{
			karma_value = eval('karma_'+type);
			if(karma_value > -1)
			{
				eval('karma_'+type+' -= 1');
				image = document.getElementById('karma_'+type);
				image.src = "/img/karma/"+type+eval('karma_'+type)+".png";
				span = document.getElementById('span_'+type);
				span.innerHTML = eval('karma_'+type);
				SendRequest('/action/'+id+'/friends/karma/'+type+'/'+eval('karma_'+type));
			}
		}
		else if(value == '+1')
		{
			karma_value = eval('karma_'+type);
			if(karma_value < 3)
			{
				eval('karma_'+type+' += 1');
				image = document.getElementById('karma_'+type);
				image.src = "/img/karma/"+type+eval('karma_'+type)+".png";
				span = document.getElementById('span_'+type);
				span.innerHTML = eval('karma_'+type);
				SendRequest('/action/'+id+'/friends/karma/'+type+'/'+eval('karma_'+type));
			}

		}
	}
	else if(type == 'level' || type == 'type')
	{
		SendRequest('/action/'+id+'/friends/karma/'+type+'/'+value);
	}
	else if(type == 'fan')
	{
		if(karma_fan == 0)
		{
			karma_fan = 1;
			SendRequest('/action/'+id+'/friends/karma/'+type+'/'+karma_fan);
		}
		else
		{
			karma_fan = 0;
			SendRequest('/action/'+id+'/friends/karma/'+type+'/'+karma_fan);
		}
		image_fan = document.getElementById('karma_fan');
		image_fan.src = '/img/karma/fan'+karma_fan+'.png';
	}
}
{/literal}
</script>

</div>
{if $user.invitation}
{t}Successful invitation{/t}: {$user.invitation.done}<br />
{t}Invitation in waiting state{/t}: {$user.invitation.waiting}<br />
{t}Failed invitation{/t}: {$user.invitation.failed}<br />
{/if}
</div>

<div id='bigblock'>
<div id='leftblock' >
<img class='profile_photo' src='{$user.photo}' alt='photo' /><br />
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
<h2>{$user.info.fname|escape} {if $user.info.nick}"{$user.info.nick|escape}" {/if}{$user.info.lname|escape}</h2>

<div style='color: silver; text-align: right'>{t 1=$user.info.join_date|date_format:'%c'}.nodian since %1{/t}</div>

<div id='relation'>
{foreach name='relation' from=$user.path item='item' key='key'}
<a href='/profile/{$key}'>{$item|escape}</a>{if !$smarty.foreach.relation.last} &raquo; {/if}
{/foreach}
</div> {* relation *}


{if $user.info.fun>0 || $user.info.cool>0 || $user.info.sexy>0}
{strip}
<div id='karma'>karma...&nbsp;
{if $user.relation_type == 'friends'}<a href="javascript:display_pan('karma')">{/if}
{if $user.info.fun }<strong>fun</strong>: {$user.info.fun}{/if}
{if $user.info.cool }, <strong>cool</strong>: {$user.info.cool}{/if}
{if $user.info.sexy }, <strong>sexy</strong>: {$user.info.sexy}{/if}
{if $user.relation_type == 'friends'}</a>{/if}.
</div> {* karma *}
{/strip}
{/if}


<div id='numbers'>
{if $user.info.nb_fans > 0}
<img src='/img/fan.png' alt='' align='middle' />&nbsp;<a href='/friends/{$url_id}/fans'>{t escape='no' count=$user.info.nb_fans plural="<b>%1</b> fans"}<b>%1</b> fan{/t}</a>&nbsp;&nbsp;
{/if}
{if $user.info.nb_blogs > 0}
<img src='/img/blog.png' alt='' align='middle' />&nbsp;&nbsp;<a href='/blog/{$url_id}'>{t escape='no' count=$user.info.nb_blogs plural="<b>%1</b> blogs"}<b>%1</b> blog{/t}</a>&nbsp;&nbsp;
{/if}
{if $user.info.nb_photos > 0}
<img src='/img/photo.png' alt='' align='middle' />&nbsp;&nbsp;<a href='/album/{$url_id}'>{t escape='no' count=$user.info.nb_photos plural="<b>%1</b> photos"}<b>%1</b> photo{/t}</a>&nbsp;&nbsp;
{/if}

{if $user.info.nb_bookmarks > 0}
<img src='/img/link.png' alt='' align='middle' />&nbsp;&nbsp;<a href='/bookmarks/{$url_id}'>{t escape='no' count=$user.info.nb_bookmarks plural="<b>%1</b> bookmarks"}<b>%1</b> bookmark{/t}</a>
{/if}

{if $user.professional.6nergies_profile_address}
<a href="http://www.6nergies.net/people/{$user.professional.6nergies_profile_address}"><img src="/img/profil-6nergies.png" alt="{t}My 6nergies.net profile{/t}" align='middle' /></a>
{/if}

</div> {* numbers *}
<br />

{include file=_profile/all.tpl}

{if $smarty.session.my_login=='alexx' || $smarty.session.my_login=='mathieu'}
<form action='/action/{$url_id}/admin/delete_photo' method='post'>
Indiquer les raisons de la suppression de la photo:<br />
<textarea name='reason'></textarea><br />
<input type='hidden' name='image_path' value='{$album.image.path}' />
<input type='submit' value='Delete' />
</form>
{/if}

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

