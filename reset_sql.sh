#!/bin/sh

cat dotnode-clear.sql | mysql dotnode_$LOGNAME
cat dotnode-struct.sql | mysql dotnode_$LOGNAME
cat dotnode-data.sql | mysql dotnode_$LOGNAME
