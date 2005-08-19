<h2>{$photo.title|truncate:50|escape}</h2>

<a href='/metalbum/{$url_id}/album/{$metalbum.name}' class='button'>{t}Back{/t}</a><br />
<div style='text-align:center'>
{if $photo}
<img src='{$photo.url_full}' alt='{$photo.title|escape}' /><br />
{$photo.description|escape}
{else}
{t}Nothing here{/t}
{/if}
</div>
<div style='text-align: right'><a href='/metalbum/{$url_id}/album/{$metalbum.name}' class='button'>{t}Back{/t}</a></div>
