#!/usr/bin/env bash
echo "Starting memcached $1"
memcached -u daemon -l "172.90.1.$1:1121$1"
