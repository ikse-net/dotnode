<div id='bigblock'>

<div id='leftblock' >
<img src='{$community.logo}' alt='logo' /><br />
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
<h2>{t 1=$community.info.name}Edit %1{/t}</h2>

<form action='/action/communities/record/{$token[2]}' method='post' enctype='multipart/form-data'>
<table width='400'>
<tr class='{cycle name='parity' values='odd,even'}'>
<td class='label'>{t}Name{/t} :</td>
<td><input type='text' name='name' value='{$community.info.name|escape}' /></td>
</tr>
<tr class='{cycle name='parity' values='odd,even'}'>
<td class='label'>{t}Category{/t} :</td>
<td>{html_options name='id_cat' options=$categories selected=$community.info.id_cat}</td>
</tr>
<tr class='{cycle name='parity' values='odd,even'}'>
<td class='label'>{t}Type{/t} :</td>
<td>{html_radios name='moderated' options=$labels.communities.moderated separator='<br />' checked=$community.info.moderated}</td>
</tr>
<tr class='{cycle name='parity' values='odd,even'}'>
<td class='label'>{t}Country{/t} :</td>
<td>{html_options name='country' options=$labels.profile.country selected=$community.info.country}</td>
</tr>

<tr class='{cycle name='parity' values='odd,even'}'>
<td class='label'>{t}Photo/Logo{/t} :</td>
<td><input type='file' name='logo'></td>
</tr>

<tr class='{cycle name='parity' values='odd,even'}'>
<td class='label'>{t}Description{/t} :</td>
<td><textarea name='description' rows='5' cols='36'>{$community.info.description|escape}</textarea></td>
</tr>


<tr class='{cycle name='parity' values='odd,even'}'>
<td colspan='2' align='center'><input type='submit' value='{t}Record{/t}' /></td>
</tr>

</table>
</form>

{if $smarty.session.my_login == $config.admin_login}
<br />
{if $community.info.status=='ok'}

<h2>{t 1=$community.info.name}Destroy %1{/t} ?</h2>
<form action='/action/communities/destroy' medhod='post'>
{if $community.info.nb_members > 1}
<p>{t}To destroy your commununity, you must send a message to member by using the form{/t}.</p>
<label for='reason'>{t}Explain why they should unjoin your community{/t}.<br >
{t}It can be{/t}:<br />
<i>"{t}because it's redondant with the community{/t} http://{$config.domain}/communities/view/XXXX"</i></label><br />
<textarea id='reason' name='reason' cols='60' rows='5'></textarea><br />
{else}
<p>{t}You are the only member of your community. You can destroy it now.{/t}</p>
{/if}
{t}Are you sure ?{/t}&nbsp;
<input type='hidden' name='action' value='delete'>
<input type='submit' value='{t}Destroy{/t}' />
</form>

{elseif $community.info.status=='pending_delete'}

<h2>{t 1=$community.info.name}Restore %1{/t} ?</h2>
<form action='/action/communities/destroy' medhod='post'>
<input type='hidden' name='action' value='restore' />
<input type='submit' value='{t}Stop deletation process{/t}' />
</form>

{/if}

{/if}

</div> {* mainblock *}
</div> {* subblock *}
</div> {* bigblock*}
