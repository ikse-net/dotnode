<div id='blockmenu' style='text-align: left;'>
{if  $blog || $bookmarks || $albums || $blog_rss}<a href="javascript:display_profile('summary')">{t}Summary{/t}</a>{/if}
{if $user.general}<a href="javascript:display_profile('general')">{t}General profile{/t}</a>{/if}
{if $user.interests}<a href="javascript:display_profile('interests')">{t}Interests{/t}</a>{/if}
{if $user.contact}<a href="javascript:display_profile('contact')">{t}Contact{/t}</a>{/if}
{if $user.professional}<a href="javascript:display_profile('professional')">{t}Professional{/t}</a>{/if}
{if $user.personal}<a href="javascript:display_profile('personal')">{t}Personal{/t}</a>{/if}
</div>
{if $blog || $bookmarks || $albums || $blog_rss}
<table id='profile_summary' class='profile-summary'>
<tr>
                <th class='profileHeader'>{t}Summary{/t}</th>
</tr>
{if $blog}
<tr class='{cycle name='general' values='odd,even'}'>
	<td class='section'>
		<img src='/img/blog.png' align='middle' />&nbsp;<a href='/blog/{$url_id}'>{t}Last blog's ticket{/t}</a>
	</td>
</tr>
<tr class='{cycle name='general' values='odd,even'}'>
	<td>
	<dl><dt><a href='/blog/{$url_id}/view/{$blog.id_blog}'>{$blog.title|wikise}</a></dt>
	<dd>
{if $blog.chapeau}
		{$blog.chapeau|wikise}
{else}
		{$blog.ticket|wikise}
{/if}
	<br />
	<a href='/blog/{$url_id}/view/{$blog.id_blog}#comments'>{t count=$blog.nb_comments plural='%1 comments'}%1 comment{/t}</a>	
	</dd>
	</dl>
</td>
</tr>
{/if}

{if $blog_rss}
<tr class='{cycle name='general' values='odd,even'}'>
        <td class='section'>
                <img src='/img/blog.png' align='middle' />&nbsp;<a href='/blog/{$url_id}'>{t}Last blog's ticket{/t}</a>
        </td>
</tr>
<tr class='{cycle name='general' values='odd,even'}'>
        <td>
        <dl><dt><a href='{$blog_rss.link}'>{$blog_rss.title|escape}</a></dt>
        <dd>
                {$blog_rss.description|escape}
        <br />
        <a href='{$blog_rss.link}'>{t}Read more{/t}</a>    
        </dd>
        </dl>
</td>
</tr>

{/if}

{if $bookmarks}
<tr class='{cycle name='general' values='odd,even'}'>
<td class='section'>
        <img src='/img/link.png' align='middle' />&nbsp;<a href='/bookmarks/{$url_id}'>{t}Last links added{/t}</a>
</td>
</tr>
<tr class='{cycle name='general' values='odd,even'}'>
<td>
	<dl>
	{foreach from=$bookmarks item=link}
                <dt><a href='{$link.link}'>{$link.link|truncate:'40':'(...)'}</a></dt><dd>{$link.comment|escape|nl2br}</dd>
	{/foreach}
	</dl>
</td>
</tr>
{/if}

{if $albums}
<tr class='{cycle name='general' values='odd,even'}'>
<td class='section'>
         <img src='/img/photo.png' align='middle' />&nbsp;<a href='/album/{$url_id}/page/1'>{t}Last photo added{/t}</a>
</td>
</tr>
<tr class='{cycle name='general' values='odd,even'}'>
<td>
        {foreach name='album' from=$albums item=photo}
        <a href='/album/{$url_id}/view/{$smarty.foreach.album.iteration}' title='{$photo.caption|escape} ({$photo.width}x{$photo.height})'><img src='{$photo.thumb_path}' alt='{$photo.caption|escape}' /></a>
        {/foreach}
</td>
</tr>
{/if}
</table>

{/if}
<table id='profile_general' class='profile-summary'{if $blog || $bookmarks || $albums || $blog_rss} style='display: none;'{/if}>
	<tr>
		<th class='profileHeader' colspan='2'>{t}General profile{/t}</th>
	</tr>
	{foreach from=$user.general item=item key=key}
	{if $item}
	<tr class='{cycle name='general' values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$key} : </td>
		<td class='value'>{$item|escape|nl2br|linkurl}</td>
	</tr>
	{/if}
	{/foreach}
	{if $user.relation_type == 'myself'}
	<tr class='{cycle name='general' values='odd,even'}'>
		<td colspan='2' align='right'><a class='button' href='/my/profile/general/edit'>{t}Edit{/t}</a></td>
	</tr>
	{/if}
</table>

{if $user.interests}
<table id='profile_interests' class='profile-summary' style='display: none;'>
	<tr>
		<th class='profileHeader' colspan='2'>{t}Interests{/t}</th>
	</tr>
	{foreach from=$user.interests item=item key=key}
	{if $item}
	<tr class='{cycle name='interests' values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$key} : </td>
		<td class='value'>{$item|escape|nl2br|linkurl}</td>
	</tr>
	{/if}
	{/foreach}
	{if $url_id == $smarty.session.my_id}
	<tr class='{cycle name='interests' values='odd,even'}'>
		<td colspan='2' align='right'><a class='button' href='/my/profile/interests/edit'>{t}Edit{/t}</a></td>
	</tr>
	{/if}
</table>
{/if}

{if $user.contact}
<table id='profile_contact' class='profile-summary' style='display: none;'>
	<tr>
		<th class='profileHeader' colspan='2'>{t}Contact{/t}</th>
	</tr>
	{if $user.contact.email}
	<tr class='{cycle name='contact' values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$user.contact.email.key} : </td>
		<td class='value'>{mailto address=$user.contact.email.value encode="javascript"}</td>
	</tr>
	{/if}
	{if $user.contact.email2}
	<tr class='{cycle name='contact' values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$user.contact.email2.key} : </td>
		<td class='value'>{mailto address=$user.contact.email2.value encode="javascript"}</td>
	</tr>
	{/if}
	{if $user.contact.email3}
	<tr class='{cycle name='contact' values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$user.contact.email3.key} : </td>
		<td class='value'>{mailto address=$user.contact.email3.value encode="javascript"}</td>
	</tr>
	{/if}
	{if $user.contact.email4}
	<tr class='{cycle name='contact' values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$user.contact.email4.key} : </td>
		<td class='value'>{mailto address=$user.contact.email4.value encode="javascript"}</td>
	</tr>
	{/if}
	{if $user.contact.im && $user.contact.im_type}
	<tr class='{cycle name='contact' values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$user.contact.im.key} : </td>
		<td class='value'>{$user.contact.im.value|escape:'hexentity'}, {$user.contact.im_type.value}</td>
	</tr>
	{/if}

	{if $user.contact.im2 && $user.contact.im2_type}
	<tr class='{cycle name='contact' values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$user.contact.im2.key} : </td>
		<td class='value'>{$user.contact.im2.value|escape:'hexentity'}, {$user.contact.im2_type.value}</td>
	</tr>
	{/if}

	{if $user.contact.phone}
	<tr class='{cycle name='contact' values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$user.contact.phone.key} : </td>
		<td class='value'>{$user.contact.phone.value|escape}</td>
	</tr>
	{/if}
	{if $user.contact.cell_phone}
	<tr class='{cycle name='contact' values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$user.contact.cell_phone.key} : </td>
		<td class='value'>{$user.contact.cell_phone.value|escape}</td>
	</tr>
	{/if}

	{if $user.contact.address}
	<tr class='{cycle name='contact' values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$user.contact.address.key} : </td>
		<td class='value'>{$user.contact.address.value|escape}</td>
	</tr>
	{/if}
	{if $user.contact.zip}
	<tr class='{cycle name='contact' values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$user.contact.zip.key} : </td>
		<td class='value'>{$user.contact.zip.value|escape}</td>
	</tr>
	{/if}
	{if $user.contact.city}
	<tr class='{cycle name='contact' values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$user.contact.city.key} : </td>
		<td class='value'>{$user.contact.city.value|escape}</td>
	</tr>
	{/if}
	{if $user.contact.country}
	<tr class='{cycle name='contact' values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$user.contact.country.key} : </td>
		<td class='value'>{$user.contact.country.value|escape|linkurl}</td>
	</tr>
	{/if}

	{if $url_id == $smarty.session.my_id}
	<tr class='{cycle name='contact' values='odd,even'}'>
		<td colspan='2' align='right'><a class='button' href='/my/profile/contact/edit'>{t}Edit{/t}</a></td>
	</tr>
	{/if}
</table>
{/if}

{if $user.professional}
<table id='profile_professional' class='profile-summary' style='display: none;'>
	<tr>
		<th class='profileHeader' colspan='2'>{t}Professional{/t}</th>
	</tr>
	{foreach from=$user.professional item=item key=key}
{if $key=='6nergies_profile_address'}
	<tr class='{cycle values='odd,even'}'>
<td align='right' nowrap='nowrap' class='label'><a href='http://www.6nergies.net'><img src='/img/6nergies-favicon.png' alt='6nergies.net' /></a>&nbsp;{t escape='no'}My <a href='http://www.6nergies.net'>6nergies.net</a> profile{/t} : </td>
<td class='value'><a href='http://www.6nergies.net/people/{$item|escape}'><img src='/img/profil-6nergies.png' alt='{t}My 6nergies.net profile{/t}' /></a></td>
</tr>

{else}
	<tr class='{cycle values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$key} : </td>
		<td class='value'>{$item|escape|linkurl|nl2br}</td>
	</tr>
{/if}
	{/foreach}
	{if $url_id == $smarty.session.my_id}
	<tr class='{cycle values='odd,even'}'>
		<td colspan='2' align='right' ><a class='button' href='/my/profile/professional/edit'>{t}Edit{/t}</a></td>
	</tr>
	{/if}
</table>
{/if}

{if $user.personal}
<table id='profile_personal' class='profile-summary' style='display: none'>
	<tr>
		<th class='profileHeader' colspan='2'>{t}Personal{/t}</th>
	</tr>
	{foreach from=$user.personal item=item key=key}
	<tr class='{cycle values='odd,even'}'>
		<td align='right' nowrap='nowrap' class='label'>{$key} : </td>
		<td class='value'>{$item|escape|nl2br|linkurl}</td>
	</tr>
	{/foreach}
	{if $url_id == $smarty.session.my_id}
	<tr class='{cycle values='odd,even'}'>
		<td colspan='2' align='right'><a class='button' href='/my/profile/personal/edit'>{t}Edit{/t}</a></td>
	</tr>
	{/if}
</table>
{/if}

<script type='text/javascript'>
var agent = navigator.userAgent.toLowerCase();
var is_ie = (agent.indexOf('msie') != -1);

{if $blog || $bookmarks || $albums || $blog_rss}
var currently_displayed_o = document.getElementById('profile_summary');
{else}
var currently_displayed_o = document.getElementById('profile_general');
{/if}
{literal}
function display_profile(what)
{
	currently_displayed_o.style.display = 'none';
	currently_displayed_o = document.getElementById('profile_'+what);
	if(is_ie) currently_displayed_o.style.display = 'block';
	else currently_displayed_o.style.display = 'table'; 
}
{/literal}
</script>
