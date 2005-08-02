{literal}
<script type='text/javascript'>
last_open_reasons=0;

function close_reasons(id)
{
	reasons = document.getElementById('reasons_' + id);
	reasons.style.display = 'none';
}

function show_reasons(id)
{
	if(last_open_reasons != 0)
		close_reasons(last_open_reasons);
	new_reasons = document.getElementById('reasons_' + id);
	new_reasons.style.display = 'block';
	last_open_reasons = id;
}

</script>
{/literal}

<div id='leftblock' >
<a href='/profile/{$url_id}'><img src='{$user.info.photo_path}' alt='photo' /></a><br />
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

<div id='mainblock'>
<h2>{t}Invite friends{/t}</h2>

{if $token[2] != $smarty.session.my_id}
<form action='/action/friends/join' method='post' enctype='multipart/form-data'>
<div id='blockmenu' style='text-align: left;'>
<a class='even' href="javascript:display_form('invitation')">{t}Invitation{/t}</a>
<a class='odd' href="javascript:display_form('import')">{t}Import from CSV{/t}</a>
</div>
<table id='form_invitation'>
<tr><th colspan='2' class='profileHeader'>{t}Fill this form to invite your friend{/t}</th></tr>
<tr class='{cycle values='odd,even'}'><td colspan='2' align='center'><a href='/my/settings'>{t}Personalize your invitation{/t} !</a></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}First name{/t}:</td><td><input type='text' name='fname' value='{$smarty.session.temp.post.fname|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Last name{/t}:</td><td><input type='text' name='lname' value='{$smarty.session.temp.post.lname|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Email{/t}:</td><td><input type='text' name='email' value='{$smarty.session.temp.post.email|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Language{/t}:</td><td>{html_options name='lang' options=$labels.language selected=$nyrk.lang}</td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label' colspan='2'>
{if !$smarty.session.temp.post.id}<input type='submit' name='add' value='{t}Invite{/t}' />
{else}<input type='hidden' name='id' value='{$smarty.session.temp.post.id}' /> <input name='resend' type='submit' value='{t}Resend{/t}' />
{/if}
</td></tr>
</table>
<table id='form_import' style='display: none'>
<tr><th class='profileHeader'>{t}Import a CSV file{/t}</th></tr>
<tr class='{cycle values='odd,even'}'><td class='value'>{t}The CSV format is: {/t}"{t}First name{/t}","{t}Last name{/t}","address@email.tld"<br />
{t}Eg.: You can import your Orkut contacts here: {/t}<a href='http://orkut.com/contacts.CSV'>orkut.com/contacts.CSV</a></td></tr>

<tr class='{cycle values='odd,even'}'><td class='label'>{t}File location: {/t}<input type='file' name='csv'></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'><input type='submit' name='import' value='{t}Import{/t}' /></td></tr>
</table>
<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
</form>
{else}
{/if}

<br />

<table>
<tr><th colspan='6' class='profileHeader'>{t}Status of your invitations{/t}</th></tr>
<tr class='{cycle name='invit' values='odd,even'}'><th>{t}First name{/t}</th><th>{t}Last name{/t}</th><th>{t}Email{/t}</th><th>{t}Status{/t}</th><th>{t}Response{/t}</th>{*<th>{t}Send date{/t}</th><th></th>*}</tr>

{foreach from=$invitations item=invit key=id}
<tr class='{cycle name='invit' values='odd,even'}'>
<td>{$invit.fname|escape|truncate:23:'...':true}</td>
<td>{$invit.lname|escape|truncate:23:'...':true}</td>
<td>{$invit.email|escape|truncate:23:'...':true}</td>
<td>{$invit.status_str|escape}</td>
<td>
{if !$invit.response && $invit.status=='doing'}
{t}No response{/t}{if $invit.date_begin+600<$smarty.now}&nbsp;-&nbsp;<a href='/action/{$invit.id}/friends/join/resend'>{t}Modify/Resend{/t}</a> | <a href='/action/{$invit.id}/friends/join/delete'>{t}Delete{/t}</a>{/if}
{else}
 {if $invit.status=='done'}
{t}Accepted{/t}: <a href='/profile/{$invit.id}'>{t}Profile{/t}</a>
 {else}
   {if $invit.status == 'stop' && $invit.response == 'rejected'}
<a href="javascript:show_reasons('{$invit.id}')">{t}Refused{/t}</a> | <a href='/action/{$invit.id}/friends/join/delete'>{t}Delete{/t}</a>
   {/if}
   {if $invit.status == 'stop' && $invit.response == 'blacklist'}
<a href="javascript:show_reasons('{$invit.id}')">{t}Refuse all .node invitations{/t}</a> | <a href='/action/{$invit.id}/friends/join/delete'>{t}Delete{/t}</a>
   {/if}
   {if $invit.status == 'stop' && $invit.response == 'mailproblem'}
<a href="javascript:show_reasons('{$invit.id}')">{t}Mail problem{/t}</a>&nbsp;-&nbsp;<a href='/action/{$invit.id}/friends/join/resend'>{t}Modify/Resend{/t}</a> | <a href='/action/{$invit.id}/friends/join/delete'>{t}Delete{/t}</a>
   {/if}
 {/if}
{/if}
</td>
{*<td>{$invit.date_begin|date_format:"%c"}</td>*}
</tr>
{foreachelse}
<tr class='{cycle name='invit' values='odd,even'}'><td colspan='6' align='center'>{t}No invitation. Don't wait ! Invite your friends !{/t}</td></tr>
{/foreach}

</table>

{foreach from=$invitations item=invit key=id}
{if $invit.failure_notice}

<div id='reasons_{$invit.id}' style='display:none;'> 
<h3>{t}Reasons{/t}</h3>
<pre class='scroll'>
{$invit.failure_notice|escape}
</pre>
<a href="javascript:close_reasons('{$invit.id}')">{t}Close{/t}</a>
</div>

{/if}
{/foreach}
</div>
<div style='clear:both'></div>

{literal}
<script type='text/javascript'>
var current_pan_o = document.getElementById('form_invitation');

function display_form(what)
{
        current_pan_o.style.display = "none";
        current_pan_o = document.getElementById('form_'+what);
        current_pan_o.style.display = "table";
}
</script>
{/literal}

