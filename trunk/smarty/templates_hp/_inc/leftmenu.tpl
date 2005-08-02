{strip}
<ul id='menu'>
{* <li class='contact'><a href='/write'>{t}Contact me{/t}</a></li> *}
{if $profile.info.nb_blogs>0}
<li class='blog'><a href='/blog'>{t}Blog{/t}</a></li>
{/if}
{if $profile.info.nb_bookmarks>0}
<li class='bookmark'><a href='/bookmarks'>{t}Bookmarks{/t}</a></li>
{/if}
{if $profile.info.nb_photos>0}
<li class='album'><a href='/album'>{t}Album{/t}</a></li>
{/if}
</ul>
{/strip}
<br />
<a href='/xml/foaf' class='foaf'><img src='/img/foaf' alt='FOAF' /></a>
{if $profile.info.6nergies_url}
<a href='http://www.6nergies.net/people/{$profile.info.6nergies_url}' class='6nergies'><img src='/img/profil-6nergies.png' alt='6nergie.net profile' /></a>
{/if}
