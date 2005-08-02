#/bin/sh

CURRENT_DIR=`dirname $0`
cd ~/$CURRENT_DIR

export BASEPATH=$PWD/../www

nice -19 /usr/bin/php dispatch_message.bot.php && sleep 1

for lang in fr_FR en_US es_ES pt_BR ja_JP fa_IR; do
	nice -19 /usr/bin/php send_invitation.bot.php $lang && sleep 1
done

for lang in fr_FR en_US es_ES pt_BR ja_JP fa_IR; do
	nice -19 /usr/bin/php send_password.bot.php $lang && sleep 1
done

for lang in fr_FR en_US es_ES pt_BR ja_JP fa_IR; do
	nice -19 /usr/bin/php send_confirmation_email.bot.php fr_FR && sleep 1
done

nice -19 /usr/bin/php maj_session.bot.php
nice -19 /usr/bin/php gen_stats.bot.php > /dev/null
