<div id='leftblock' >
<img src='{$smarty.session.my_photo}' alt='photo' />
</div>

<div id='home'>
<h2>{$smarty.session.my_fname|escape} {$smarty.session.my_lname|escape}</h2>
<h3>{t}Modify your password{/t}</h3>
<form action='/action/my/password/record' method='post'>
{if !$smarty.session.old_password}
{t}Old password{/t}: <input type='password' name='oldpasswd' value='' /><br />
{/if}
{t}New password{/t}: <input type='password' name='passwd1' value='' /><br />
{t}Confirm new password{/t}: <input type='password' name='passwd2' value='' /><br />
<input type='submit' value='{t}Record{/t}' />
</form>
</div>
<div style="clear:both"></div>

{if $token[2] == 'success'}
<script type="text/javascript">
alert('{t}New password recorded{/t}');
</script>
{/if}

