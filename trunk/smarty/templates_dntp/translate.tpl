<b>msgid</b>:<pre>{$msgid.msgid|escape}</pre>
{if $msgid.msgid_plural}<b>msgid</b>:<pre>{$msgid.msgid_plural|escape}</pre>{/if}
<hr />

<form method='post' action='/action/msgstr/record/{$msgid.id}'>
<fieldset>
<legend>Entry #{$msgid.id}</legend>
{foreach from=$msgstr item=msg key=key}
msgstr{if $msgid.msgid_plural}[{$key}]{/if} : 

{if $msg.multiline == 'y'}
<textarea name='msgstr[{$key}]'>{$msg.msgstr|escape}</textarea>
{else}
<input type='text' name='msgstr[{$key}]' value='{$msg.msgstr|escape}'{if $rtl} dir='rtl'{/if} />
{/if}

{foreachelse}
msgstr{if $msgid.msgid_plural}[{$key}]{/if} : 

{if $msg.multiline == 'y'}
<textarea name='msgstr[{$key}]'{if $rtl} dir='rtl'{/if}>{$msg.msgstr|escape}</textarea>
{else}
<input type='text' name='msgstr[{$key}]' value='{$msg.msgstr|escape}' />
{/if}

{if $msgid.msgid_plural}
msgstr{if $msgid.msgid_plural}[{$key}]{/if} : 

{if $msg.multiline == 'y'}
<textarea name='msgstr[{$key}]'{if $rtl} dir='rtl'{/if}>{$msg.msgstr|escape}</textarea>
{else}
<input type='text' name='msgstr[{$key}]' value='{$msg.msgstr|escape}'{if $rtl} dir='rtl'{/if} />
{/if}


{/if}
{/foreach}
<br />
Comment: <textarea name='comment'{if $rtl} dir='rtl'{/if}></textarea>
<input type='submit' value='Record' />
</fieldset>
</form>
