<div id='searchblock'>
<form action='/search' method='get'>
<table>
<tr><th class='profileHeader'>{t}Search{/t}</th></tr>
<tr class='{cycle values='odd,even'}'><td>{html_checkboxes name='search[photo]' options=$search.photo checked=$smarty.get.search.photo}</td></tr>
<tr class='{cycle values='odd,even'}'><td><span class='label'>{t}Gender{/t}</span>: {html_checkboxes name='search[gender]' options=$labels.profile.gender checked=$smarty.get.search.gender}</td></tr>
<tr class='{cycle values='odd,even'}'><td><span class='label'>{t}Age{/t}</span>: <input type='text' name='search[agemin]' maxlength='2' size='2' value='{$smarty.get.search.agemin|@stripslashes|escape}' /> {t}to{/t} <input type='text' name='search[agemax]' maxlength='2' size='2' value='{$smarty.get.search.agemax|@stripslashes|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td><span class='label'>{t}Country{/t}</span>: {html_options name='search[country]' options=$labels.profile.country selected=$smarty.get.search.country|default:$smarty.session.my_country} </td></tr>
<tr class='{cycle values='odd,even'}'><td><span class='label'>{t}Interested in{/t}</span>:<br />{html_checkboxes name='search[here_for]' options=$search.here_for checked=$smarty.get.search.here_for separator='<br />'}</td></tr>
<tr class='{cycle values='odd,even'}'><td><span class='label'>{t}Relationship status{/t}</span>:<br />{html_checkboxes name='search[relationship_status]' options=$labels.profile.relationship_status_cb checked=$smarty.get.search.relationship_status  separator='<br />'}</td></tr>
<tr class='{cycle values='odd,even'}'><td><input type='submit' name='do' value='{t}Search{/t}' /></td></tr>
</table>
</form>
<br />
{t escape='no'}To perform a search by name, go to <a href='/friends/search'>Friends / Search</a> page{/t}.
</div>
<div id='resultblock'>
<table>
<tr><th colspan='3' class='profileHeader'>{t}Results{/t}</th></tr>

{strip}
<tr><td class='{cycle values='odd,even'} pagination' colspan='4'>
{t}Page:{/t}
{foreach from=$pagination.pages item=none key=page}
{if $pagination.current_page == $page}
&nbsp;<strong>{$page}</strong>
{else}
&nbsp;<a href='/search/{$page}?{$smarty.server.QUERY_STRING}'>{$page}</a>
{/if}
{/foreach}
</td></tr>
{/strip}

{foreach from=$result item=profile key=id}
<tr class='{cycle name=result values='odd,even'}'>
  <td width='64'><a href='/profile/{$id}'><img src='{$profile.photo}' alt='photo' /></a></td>

  <td><a href='/profile/{$id}'>{$profile.fname|escape} {$profile.lname|escape}</a><br />{if $profile.gender}{$profile.gender_t}{/if}{if $profile.gender && $profile.relationship_status}, {/if}{if $profile.relationship_status}{$profile.relationship_status_t}{/if}<br />{$profile.country|escape}</td>
  <td>{if $profile.here_for}<span class='label'>{t}Interested in{/t}:</span><br />{$profile.here_for_t}{/if}</td>
</tr>
{foreachelse}
<tr class='{cycle name='result' values='odd,even'}'><td colspan='4'>{t}Nobody match your search. Try again !{/t}</td></tr>
{/foreach}

{strip}
<tr><td class='{cycle values='odd,even'} pagination' colspan='4'>
{t}Page:{/t}
{foreach from=$pagination.pages item=none key=page}
{if $pagination.current_page == $page}
&nbsp;<strong>{$page}</strong>
{else}
&nbsp;<a href='/search/{$page}?{$smarty.server.QUERY_STRING}'>{$page}</a>
{/if}
{/foreach}
</td></tr>
{/strip}


</table>

</div>
<div style='clear: both'></div>
