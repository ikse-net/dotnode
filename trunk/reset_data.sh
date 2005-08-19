#!/bin/sh

rm -fr smarty/templates_c/*
rm -fr smarty/cache/*
rm -fr data/*/??
rm -fr data/*/thumb/??
rm -fr data/*/sized/*
rm -fr sessions/*
:> log/*

if [ -e data.tar.gz ]; then
	tar xzf data.tar.gz
fi

chmod 707 smarty/templates_c
chmod 707 smarty/cache
chmod -R 707 log
chmod 707 sessions
chmod -R 707 data 

