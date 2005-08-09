<div id='leftside'>
<img src='{$profile.info.photo_path}' alt='{$profile.info.fname|escape} {$profile.info.lname|escape}' /><br />
{include file=_inc/leftmenu.tpl}
</div> {* leftside *}

<div id='rightside'>
{if $user.info.nb_blogs==0 || $albums || $bookmarks}
<div id='miniprofile'>
<h2>{$profile.info.fname|escape} {$profile.info.lname|escape}</h2>
{*
{if $profile.info.address && $profile.info.zip && $profile.info.city}
{$profile.info.address}<br />
{$profile.info.zip} {$profile.info.city}<br />
{/if}
{if $profile.info.country}{$profile.info.country}<br />{/if}
<br />
{if $profile.info.im && $profile.info.im_type}IM ({$profile.info.im_type}): {$profile.info.im|escape:'hexentity'}{/if}
<h3>{t}About me{/t}...</h3>
{if $profile.info.description}{$profile.info.description|escape|nl2br}<br />{/if}
{if $profile.info.relationship_status}<b>{t}Relationship status{/t}</b>: {$profile.info.relationship_status_t}<br />{/if}
*}
{if $profile.info.passions}<b>{t}Passions{/t}</b>: {$profile.info.passions|escape|nl2br}<br />{/if}
{if $profile.info.sports}<b>{t}Sports{/t}</b>: {$profile.info.sports|escape|nl2br}<br />{/if}
</div> {* miniprofile *}
{/if}

<div id='friends'>
<h2><a href='/friends'>{t}Some friends{/t}</a></h2>
<table>

{foreach name=friends from=$friends item=friend key=id_friend}
{if ($smarty.foreach.friends.iteration-1)%2 == 0}
<tr>
{/if}
  <td>
    <a href='http://{$friend.login}.{$config.domain}'>
  <img src='{$friend.thumb_path}' alt='photo' /><br />
<span class="friend">{$friend.fname|escape} {$friend.lname|escape}</span>
{if $friend.photo=='y'}
  </a>
{/if}

  </td>
{if ($smarty.foreach.friends.iteration-1)%2 == 1 || $smarty.foreach.friends.last}
</tr>
{/if}
{/foreach}

</table>
</div> {* friends*}
</div> {* rightside *}


<div id='middle'>

{if $user.info.nb_blogs>0 && !$albums && !$bookmarks}
<h2>{$profile.info.fname|escape} {$profile.info.lname|escape}</h2>
{if $profile.info.address && $profile.info.zip && $profile.info.city}
{$profile.info.address}<br />
{$profile.info.zip} {$profile.info.city}<br />
{/if}
{if $profile.info.country}{$profile.info.country}<br />{/if}
<br />
{if $profile.info.im && $profile.info.im_type}IM ({$profile.info.im_type}): {$profile.info.im|escape}{/if}
<h3>{t}About me{/t}...</h3>
{if $profile.info.description}{$profile.info.description|escape|nl2br}<br />{/if}
{if $profile.info.relationship_status}<b>{t}Relationship status{/t}</b>: {$profile.info.relationship_status_t}<br />{/if}
{if $profile.info.passions}<b>{t}Passions{/t}</b>: {$profile.info.passions|escape|nl2br}<br />{/if}
{if $profile.info.sports}<b>{t}Sports{/t}</b>: {$profile.info.sports|escape|nl2br}<br />{/if}
</div> {* miniprofile *}
<br /><br />
{/if}

{if $rss_blog}
<div id='blog'>
<h2><a href='/blog'>Blog</a>: <a href='{$rss_blog.link|escape}'>{$rss_blog.title|escape|utf8}</a></h2>

{foreach from=$rss_blog.item item=item key=link}
<h3>{$item.title|escape|utf8}</h3>

{if $item.description}
<p class='summary'>{$item.description|@html_entity_decode|strip_tags|utf8|nl2br}</p>
{/if}
<span class='blogReadmore'><a href='{$link|escape}'>{t}Read more{/t}</a></span>
{/foreach}
</div> {* blog *}

{elseif $blogs}

<div id='blog'>
<h2><a href='/blog'>{t}My Blog{/t}</a></h2>
{foreach name=blog from=$blogs item=blog key=id_blog}
<h3><a href='/blog/view/{$id_blog}'>{$blog.title|escape}</a></h3>
<span class='date'>{t}On{/t} {$blog.date|date_format:"%A %e %B %Y"}</span><br />
{if $blog.chapeau}
<p>{$blog.chapeau|wikise}</p>
{else}
<p>{$blog.ticket|wikise}</p>
{/if}
<span class='blogCatComm'><a href='/blog/categorie/{$blog.id_cat}'>{$blog.categorie|default:'Nothing'}</a> :: <a href='/blog/view/{$id_blog}#comments'>{t count=$blog.nb_comments plural='%1 comments'}%1 comment{/t}</a></span>
{/foreach}
{*<div style='clear: both'></div>*}
</div> {* blog *}
{/if}

{if $bookmarks}
<div id='bookmark'>
<h2><a href='/bookmarks'>{t}Some bookmarks{/t}</a></h2>
<ul>
{foreach name=bookmark from=$bookmarks item=link_info key=link}
<li><a href='{$link|escape}'>{$link|escape|truncate:'40':'...'}</a><br />{$link_info.comment|escape}</li>
{/foreach}
</ul>
</div> {* bookmark *}
{/if}

{if $albums}
<div id='album'>
<h2><a href='/album'>{t}Some photos{/t}</a></h2>
<table><tr>
{foreach name=album from=$albums item=photo key=id_image}
<td><a href='{$photo.photo|escape}'><img src='{$photo.thumb|escape}' alt='photo' /></a><br />{$photo.caption|escape}</td>
{/foreach}
</tr></table>
</div> {* album *}
{/if}
</div> {* middle *}
