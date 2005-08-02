<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{$smarty.session.my_fname} {$smarty.session.my_lname}</h2>
<form action='/action/my/profile/interests/record' method='post'>
<table>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Passions{/t} : </td><td class='value'><textarea name='passions' rows='5' cols='36'>{$my.interests.passions|escape}</textarea></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Sports{/t} : </td><td class='value'><textarea name='sports' rows='5' cols='36'>{$my.interests.sports|escape}</textarea></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Activities{/t} : </td><td class='value'><textarea name='activities' rows='5' cols='36'>{$my.interests.activities|escape}</textarea></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Favorite books{/t} : </td><td class='value'><textarea name='favorite_books' rows='5' cols='36'>{$my.interests.favorite_books|escape}</textarea></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Favorite music{/t} : </td><td class='value'><textarea name='favorite_music' rows='5' cols='36'>{$my.interests.favorite_music|escape}</textarea></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Favorite tvshow{/t} : </td><td class='value'><textarea name='favorite_tvshow' rows='5' cols='36'>{$my.interests.favorite_tvshow|escape}</textarea></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Favorite movies{/t} : </td><td class='value'><textarea name='favorite_movies' rows='5' cols='36'>{$my.interests.favorite_movies|escape}</textarea></td></tr>
<tr class='{cycle values='odd,even'}'><td align='right' class='label'>{t}Favorite cuisines{/t} : </td><td class='value'><textarea name='favorite_cuisines' rows='5' cols='36'>{$my.interests.favorite_cuisines|escape}</textarea></td></tr>
<tr class='{cycle values='odd,even'}'><td colspan='2' align='center'><input type='submit' value='{t}Record{/t}'><td></tr>
</table>
</form>
</div>
<div style="clear:both"></div>

