<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{$smarty.session.my_fname} {$smarty.session.my_lname}</h2>
<form action='/action/my/profile/personal/record' method='post'>
<table>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Headline{/t} : </td><td class='value'><input type='text' name='headline' value='{$my.personal.headline|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t escape=no}First thing you will notice<br />about me{/t} : </td><td class='value'><input type='text' name='notice' value='{$my.personal.notice|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Size{/t} : </td><td class='value'><input type='text' name='size' value='{$my.personal.size|escape}' /> cm</td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Eye color{/t} : </td><td class='value'>{html_options name='eye' options=$labels.profile.eye selected=$my.personal.eye}</td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Hair color{/t} : </td><td class='value'>{html_options name='hair' options=$labels.profile.hair selected=$my.personal.hair}</td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Body art{/t} : </td><td class='value'>{html_checkboxes name='body_art' options=$labels.profile.body_art checked=$my.personal.body_art separator='<br />'}</td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Best feature{/t} : </td><td class='value'>{html_options name='best_feature' options=$labels.profile.best_feature selected=$my.personal.best_feature}</td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Things I can't live without{/t} : </td><td class='value'><textarea name='things_i_cant_live_without' rows='5' cols='36'>{$my.personal.things_i_cant_live_without|escape}</textarea></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Describe your ideal match{/t} : </td><td class='value'><textarea name='ideal_match' rows='5' cols='36'>{$my.personal.ideal_match|escape}</textarea></td></tr>
<tr class='{cycle values='odd,even'}'><td colspan='2' align='center'><input type='submit' value='{t}Record{/t}'><td></tr>
</table>
</form>
</div>
<div style="clear:both"></div>

