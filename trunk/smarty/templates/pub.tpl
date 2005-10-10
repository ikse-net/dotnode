<h2>{t}What is it ?{/t}</h2>
<div id='loginbox'>

<form action='/action/login' method='post' onSubmit="document.getElementById('md5_passwd').value = MD5_hexhash(document.getElementById('passwd').value);">
<fieldset>
<legend>{t}Connect{/t}</legend>
{if $smarty.get.url}<p class='warning'>{t}You must be connected to view this page{/t}.</p>{/if}
<label for='login'>{t}Login{/t} :</label><br /><input type='text' name='login' id='login' /><br />
<label for='passwd'>{t}Password{/t} :</label><br /><input type='password' name='passwd' id='passwd' /><input type='hidden' id='md5_passwd' name='md5_passwd' value='' /><br />
{if $smarty.get.url}<input type='hidden' name='url' value='{$smarty.get.url}'  />{/if}
<input type='submit' value='{t}Enter{/t}' /><br />
<a href='/error/forgot_password'>{t}Forgot your password ?{/t}</a><br />
<br />
{t}Not a member?{/t}<br /><a href='/pub/join'>{t}Join .node{/t}</a>
</fieldset>
</form>

<script type='text/javascript'>
        document.getElementById('login').focus();
</script>

</div>
<p><img src='/img/who_do_you.png' alt="Who do you want to meet today ?" align='left' style='margin-right: 10px;'/>
{t escape=no}.node is an online community connecting people through a trusted friends network{/t}.<br />
<br />
{t}We wish to create a worldwide friendship network without any language barrier{/t}.<br />
<br />
{t escape=no}By joining <strong>.node</strong>, you can use lots of little services based on trusted friends{/t}.
</p>
<div style='clear:both;'></div>
