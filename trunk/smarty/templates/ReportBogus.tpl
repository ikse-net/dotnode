<h2>{t}You have found a problem ?{/t}</h2>
{t escape=no 1=$smarty.get.url}If you have found a problem (bad translation, bug, illegal thing, explicit content, ...) on page "<a href='%1'>http://dotnode.com%1</a>", report it here. Describe the problem and send the message.{/t}
<br />
<form action='/action/ReportBogus/send' method='post'>
<fieldset>
<legend>{t}Report an error{/t}</legend>
{t}Subject{/t}: <input type='text' name='subject' /><br />
{t}Message{/t}:<br >
<textarea name='message' cols='80' rows='10'></textarea>
<input type='hidden' name='url' value='{$smarty.get.url|escape}' />
<br />
<input type='submit' value='{t}Send{/t}' />
</fieldset>
</form>
