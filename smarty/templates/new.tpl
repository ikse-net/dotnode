<h2>{t}Do you want to join the .node network ?{/t}</h2>

{t escape='no'}If you want more information, <a href='/pub'>see the .node site</a> and <a href='/pub/help'>his help</a>{/t}.

<form action='/action/register' method='post'>

<fieldset>
<h3>{t}Yes, I want{/t}</h3>
{t}To join .node network, fill this little form then click the 'Accept' button{/t} :<br />
<br />
<span class='label'>{t}Your login{/t}:</span>&nbsp;<input type='text' name='login' value='{$suggestion.login|escape}' /><br />
<span class='label'>{t}Password{/t}:</span>&nbsp;<input type='password' name='passwd' /><br />
<span class='label'>{t}Comfirm password{/t}:</span>&nbsp;<input type='password' name='passwd2' /><br />
<span class='label'>{t}Type the code displayed inside this image{/t} :</span>&nbsp;<input type='text' name='code' maxlength='4' size='4' /><br />
<img style='border: 2px silver solid; padding: 2px;width:237px; height: 48px;' src='/pix/{$smarty.now}.png' alt='{t}If you have trouble, send an email on: pixcode-pb@dotnode.net{/t}'/><br />
<br />
<input type='submit' name='accept' value='{t}Accept{/t}' />
</fieldset>

<fieldset>
<h3>{t}No, I don't want to join .node{/t}</h3>
{t escape='no'}The person who have invited you will be informed of your refusal.<br />If another person invite you, you will still receive an invitation.<br >Indicate the reasons of your refusal (optional) then click the 'Refuse' button to refuse this invitation{/t} :<br />
<br />
<span class='label'>{t}Reasons{/t}:</span><br />
<textarea name='refuse_motif' style='width: 100%' rows='6'></textarea><br />
<input type='submit' name='refuse'  value='{t}Refuse{/t}' />
</fieldset>

<fieldset>
<h3>{t}No, I don't want to be contacted by .node anymore{/t}</h3>
{t escape='no'}You don't want to join .node network, and you don't want to receive any future invitation.<br />Your email will be added on a black list.<br />If it's realy what you want, indicate the reasons of your refusal (optional) then click on 'Blacklist me' button{/t} :<br />
<br />
<span class='label'>{t}Reasons{/t}:</span><br />
<textarea name='bl_motif' style='width: 100%' rows='6'></textarea><br />
<input type='submit' name='blacklist' value='{t}Blacklist me{/t}' />
</fieldset>

</form>
