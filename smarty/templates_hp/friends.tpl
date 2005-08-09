<div id='leftside'>
<img src='{$profile.info.photo_path}' alt='{$profile.info.fname|escape} {$profile.info.lname|escape}' /><br />
{include file=_inc/leftmenu.tpl}
</div> {* leftside *}

<div id='middle'>
<div id='friends'>
<h2>{t}My Friends{/t}</h2>
<table style='width: 100%'>
{foreach name=friends from=$friends item=friend key=id_friend}
{if ($smarty.foreach.friends.iteration-1)%5 == 0}
<tr>
{/if}
  <td align='center'>
    <a href='http://{$friend.login}.{$config.domain}'>
  <img src='{$friend.thumb_path}' alt='photo' /><br />
  {$friend.fname|escape} {$friend.lname|escape}
  </a>

  </td>
{if ($smarty.foreach.friends.iteration-1)%5 == 4 || $smarty.foreach.friends.last}
</tr>
{/if}
{/foreach}
</table>
</div> {* friends*}
</div> {* middle *}
