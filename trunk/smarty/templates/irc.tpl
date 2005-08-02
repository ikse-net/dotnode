<applet codebase="/java/irc/" code="IRCApplet.class" archive="irc.jar,pixx.jar" width='100%' height='480'>
<param name="CABINETS" value="irc.cab,securedirc.cab,pixx.cab">

{if $lang=='fr_FR'}
<param name="pixx:language" value="/java/irc/pixx-french">
<param name="language" value="/java/irc/pixx-french">
{/if}

<param name="nick" value="{$smarty.session.my_login}">
<param name="alternatenick" value="{$smarty.session.my_login}|dotnode">
<param name="name" value="{$smarty.session.my_fname|escape}">
<param name="host" value="irc.eu.freenode.net">
<param name="gui" value="pixx">
<param name="coding" value="2">
<param name="command1" value="/join #dotnode">
{if $lang=='fr_FR'}
<param name="command2" value="/join #dotnode-fr">
{else}
<param name="command2" value="/join #dotnode-en">
{/if}
<param name="quitmessage" value=".node forever! See my .page : http://{$smarty.session.my_login}.dotnode.com">
<param name="asl" value="true">

<param name="style:bitmapsmileys" value="false">
<param name="pixx:highlight" value="true">
<param name="pixx:highlightnick" value="true">

</applet>
