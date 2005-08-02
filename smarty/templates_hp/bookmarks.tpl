<div id='leftside'>
<img src='{$profile.info.photo_path}' alt='{$profile.info.fname|escape} {$profile.info.lname|escape}' /><br />
{include file=_inc/leftmenu.tpl}
</div> {* leftside *}

<div id='middle'>

{if $bookmarks}
<div id='bookmark'>
<h2>{t}Some bookmarks{/t}</h2>
<ul>
{foreach name=bookmark from=$bookmarks item=link_info key=link}
<li><a href='{$link|escape}'>{$link|escape|truncate:'40':'...'}</a><br />{$link_info.comment|escape}</li>
{/foreach}
</ul>
</div> {* bookmark *}
{/if}

</div> {* middle *}
