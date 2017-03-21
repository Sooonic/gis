#!/usr/bin/env bash

docker-compose exec php-fpm bash -c  "cd /app && php yii $*"