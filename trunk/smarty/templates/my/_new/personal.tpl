<p>{t}Fill it seriously ... :-){/t}</p>
<table>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Headline{/t} : </td><td class='value'><input type='text' name='personal[headline]' value='{$my.personal.headline|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t escape=no}First thing you will notice<br />about me{/t} : </td><td class='value'><input type='text' name='personal[notice]' value='{$my.personal.notice|escape}' /></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Things I can't live without{/t} : </td><td class='value'><textarea name='personal[things_i_cant_live_without]' rows='5' cols='36'>{$my.personal.things_i_cant_live_without|escape}</textarea></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Describe your ideal match{/t} : </td><td class='value'><textarea name='personal[ideal_match]' rows='5' cols='36'>{$my.personal.ideal_match|escape}</textarea></td></tr>
</table>

