<h2>{t}What is it ?{/t}</h2>
<div id='loginbox'>
{if $smarty.server.REMOTE_ADDR == 'ok82.226.113.191'}

<fieldset>
<legend>En maintenance !</legend>
.node est en cours de conversion en UTF-8 pour accepter des langues avec un alphabet différent.<br />
<br />
Merci de votre comprehension. Retour prevu a 10h30 (j'espere).<br />
(cela fonctionne déjà presque parfaitement ... plus que 2-3 petites choses à régler)<br />
<br />
Alexx <br />
</fieldset>

{else}

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

{/if}

</div>
<p><img src='/img/who_do_you.png' alt="Who do you want to meet today ?" align='left' style='margin-right: 10px;'/>
{t escape=no}.node is an online community connecting people through a trusted friends network{/t}.<br />
<br />
{t}We wish to create a worldwide friendship network without any language barrier{/t}.<br />
<br />
{t escape=no}By joining <strong>.node</strong>, you can use lots of little services based on trusted friends{/t}.
</p>
<div style='clear:both;'></div>
