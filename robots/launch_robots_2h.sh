#/bin/sh

CURRENT_DIR=`dirname $0`
cd ~/$CURRENT_DIR

export BASEPATH=$PWD/../www

nice -19 /usr/bin/php fetch_rss.bot.php
