#/bin/sh

cd `dirname $0`

nice -19 /usr/bin/php fetch_rss.bot.php
