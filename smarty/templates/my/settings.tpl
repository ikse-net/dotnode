<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{$smarty.session.my_fname} {$smarty.session.my_lname}</h2>

<form action='/action/my/settings/record' method='post'>
<table width=500>
<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}New friend notification{/t} : </td>
<td class='value' colspan='2'>{html_checkboxes name='new_friend_notifications' options=$labels.settings checked=$my.settings.new_friend_notifications}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}New friend approval{/t} : </td>
<td class='value' colspan='2'>{html_checkboxes name='new_friend_approval'  options=$labels.settings checked=$my.settings.new_friend_approval}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}New blog comment{/t} : </td>
<td class='value' colspan='2'>{html_checkboxes name='new_blog_comment' options=$labels.settings checked=$my.settings.new_blog_comment}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Messages sent directly to me{/t} : </td>
<td class='value' colspan='2'>{html_checkboxes name='messages_sent_directly_to_me' options=$labels.settings checked=$my.settings.messages_sent_directly_to_me}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Messages sent to friends{/t} : </td>
<td class='value' colspan='2'>{html_checkboxes name='messages_sent_to_friends' options=$labels.settings checked=$my.settings.messages_sent_to_friends}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Messages sent to friends of friends{/t} : </td>
<td class='value' colspan='2'>{html_checkboxes name='messages_sent_to_friends_of_friends' options=$labels.settings checked=$my.settings.messages_sent_to_friends_of_friends}</td>
</tr>

{*
<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t}Birthday reminder{/t} : </td>
<td class='value' colspan='2'>{html_checkboxes name='birthday_reminder' options=$labels.settings checked=$my.settings.birthday_reminder}</td>
</tr>
*}
<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'>{t escape='no' 1=$smarty.session.my_login 2=$config.domain}<b>Publish my .page</b><br />(<a href='http://%1.%2'>%1.%2</a>: blog, album, ...){/t} : </td>
<td class='value' nowrap='nowrap'>{html_radios name='publish' options=$labels.yesno checked=$my.settings.publish}</td>
<td rowspan='2' style='vertical-align: middle'>({t}this parameter take 10 minutes to be applied{/t})</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'><b>{t}Select .page style{/t}</b> : </td>
<td class='value' nowrap='nowrap'>{html_options name='dotpage_css' options=$css selected=$my.settings.dotpage_css}</td>
</tr>


<tr class='{cycle values='odd,even'}'>
<td align='right' class='label'><b>{t}Invitation message{/t}</b> :<br /><i>{t escape='no' 1=#SiteName#}Add your personal message<br />into invitation to join %1{/t}</i></td>
<td class='value' colspan='2'><textarea name='invitation_message' rows='5' cols='36'>{$my.settings.invitation_message|escape}</textarea></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td colspan='3' align='center'><input type='submit' value='{t}Record{/t}'><td>
</tr>
</table>
</form>
</div>
<div style="clear:both"></div>

{if $token[2] == 'success'}
<script type="text/javascript">
alert('{t}Settings recorded{/t}');
</script>
{/if}

