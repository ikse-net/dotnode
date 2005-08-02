<rss version="2.0">
	<channel>
		<title>{$rss.title|escape}</title>
		<link>{$rss.link|escape}</link>
		<description>{$rss.description|escape}</description>

		{foreach from=$rss.item key=guid item=item}
		<item>
			<title>{$item.title|escape}</title>
			<author>{$item.author|escape}</author>
			<pubDate>{$item.pubDate}</pubDate>
			<link>{$item.link|escape}</link>
			<guid>{$guid|escape}</guid>
			<description>{$item.description|escape}</description>
		</item>
		{/foreach}
	</channel>
</rss>
