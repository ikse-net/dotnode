<h2>{t}I want to become a .node translator{/t}</h2>
{if $token[2] != 'thanks'}
<p>{t}If you want to become a .node translator, just fill this form :{/t}</p>
<p>{t}If you are accepted, your login/password will be your actual .node login/password.{/t}</p>
<form action='/action/my/register_translator' method='post'>
<fieldset>
<legend>Translator information form</legend>
{t}Language i want to translate .node to: {/t}<input name='lang' type='text' /><br />
{t}Enter here some information about you and your language (level of practice, mother tongue or not, ...):{/t}<br />
<textarea name='comment' style='width: 50%' rows='6'></textarea><br />
{t}Select your wanted level : {/t}
<select name='level'>
<option value='verif'>{t}Re-reader{/t}</option>
<option value='translator'>{t}Translator{/t}</option>
<option value='admin'>{t}Administrator{/t}</option>
</select><br />
<input type='submit' value='{t}Send{/t}' />
</fieldset>
</form>
{else}
Thanks for your interest of .node Translatation Project
{/if}
