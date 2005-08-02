<div id='largeblock'>

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
</div> {* leftblock *}

<div id='mainblock'>

<h2>{t}Members list{/t}</h2>

<table>
{foreach name=members from=$community.member item=member key=id_member}
{if ($smarty.foreach.members.iteration-1)%2 == 0}
<tr  class='{cycle values='odd,even'}'>
{/if}
  <td align='center'><a href='/profile/{$id_member}'><img src='{$member.thumb_path}' alt='photo' /></a></td>
  <td>
    <a href='/profile/{$id_member}'>{$member.fname|escape} {$member.lname|escape}</a> ({$member.nb_friends})<br />
  {$member.gender_t}{if $member.gender},{/if} 
  {$member.relationship_status_t}<br />
  {$member.country}
  </td>
{if ($smarty.foreach.members.iteration-1)%2 == 1 || $smarty.foreach.members.last}
</tr>
{/if}
{/foreach}
</table>

</div> {* mainblock *}
</div> {* bigblock *}
<div style='clear:both'></div>
