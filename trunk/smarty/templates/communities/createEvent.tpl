<div id='leftblock' >
<img src='{$community.logo}' alt='logo' /><br />

<ul class='info'>
<li><a href='/communities/view/{$token[2]}'>{$community.info.name|escape}</a></li>
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
<h2>Create event in {$community.info.name|escape}</h2>
<form action='/action/communities/createEvent/{$token[2]}' method='post'>
<table>
<tr class='{cycle values='odd,even'}'>
<td class='label' align='right'>{t}Title{/t} :</td>
<td><input type='text' name='title' value='{$smarty.session.error.post.title|escape}' /></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td class='label' align='right'>{t}Date{/t} :</td>
<td>{html_select_date end_year=2006 field_array=date time=$smarty.session.error.post.date}</td>
</tr>
<tr class='{cycle values='odd,even'}'>
<td class='label' align='right'>{t}Time{/t} :</td>
<td>{html_select_time field_array=date display_seconds=false time=$smarty.session.error.post.date}</td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td class='label' align='right'>{t}Location{/t} :</td>
<td><input type='text' name='location' value='{$smarty.session.error.post.location|escape}'/></td>
</tr>

<tr class='{cycle values='odd,even'}'>
<td class='label' align='right'>{t}City{/t} :</td>
<td><input type='text' name='city' value='{$smarty.session.error.post.city|escape}'/></td>
</tr>
<tr class='{cycle values='odd,even'}'>
<td class='label' align='right'>{t}Country{/t} :</td>
<td>{html_options name='country' options=$labels.profile.country selected=$smarty.session.error.country}</td>
</tr>


<tr class='{cycle values='odd,even'}'>
<td class='label' align='right'>{t}Details{/t} :</td>
<td><textarea cols='35' rows='5' name='details'>{$smarty.session.error.post.details|escape}</textarea></td>
</tr>
<tr class='{cycle values='odd,even'}'>
<td align='right' colspan='2'><input type='submit' value='{t}Submit{/t}'></td>
</tr>

</table>
</form>
</div>
<div style='clear:both'></div>
