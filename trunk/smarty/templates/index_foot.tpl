</div>
<div id='footer'>
{if $token[0] != 'pub'}

<p>{t}Review this page for moderation ?{/t} <a href='/ReportBogus?url={$smarty.server.PHP_SELF|escape:'url'}'>{t}Report bogus{/t}</a><br />
{t}A problem with this page ? Bad translation ?{/t} <a href='http://opensource.ikse.net/projects/dotnode/newticket'>{t}Report a problem{/t}</a><br />
</p>

{/if}
 <form style="display: inline;" method='post' id='cnil' action='http://www.cnil.fr/index.php?id=29'><p>{t}CNIL registration number{/t}: <input type='hidden' name='txtCritere' value='1011429' /><a href='http://www.cnil.fr/index.php?id=29' onClick="document.forms['cnil'].submit(); return false;">1011429</a> - {t}To contact me{/t} : {mailto address=$config.email encode="javascript"}</p></form>
<p>
<a href="http://opensource.ikse.net/projects/dotnode"><img alt="Powered by Open .node" title="Powered by Open .node" src="/img/powered-by.png" style="border: 0" /></a>
<a href="http://www.spreadfirefox.com/?q=affiliates&amp;id=49635&amp;t=70"><img alt="Get Firefox!" title="Get Firefox!" src="http://sfx-images.mozilla.org/affiliates/Buttons/88x31/get.gif" style="border: 0" /></a>
<a href="http://ikse.net" title='Hébergé sur un serveur dédié virtuel de Ikse / Conception Ikse'><img style="width:88px;height:31px;border:0;" src="http://ikse.net/images/ikse.net-88x31.png" alt="Hébergé sur un serveur dédié virtuel de Ikse / Conception Ikse" /></a>
</p>

{if $smarty.session.my_login eq $config.admin_login}
:: {$smarty.env.LANG} ::
Template utilisé : {$tpl}<br />
Help template utilisé : {$help_tpl}<br />
Include utilisé: {$inc}<br />
dotnodeSessID: <a href='?SMARTY_DEBUG' >{$smarty.cookies.dotnodeSessID}</a><br />
Accept-language: {$smarty.server.HTTP_ACCEPT_LANGUAGE}<br />
Langue:  {$lang}<br />
Cookie lang: {$smarty.cookies.lang}<br />
Mémoire utilisée: {$php_mem} KiB
{/if}
</div>

</body>
</html>
