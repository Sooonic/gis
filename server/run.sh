#!/usr/bin/env bash

if [ ! -f ./.tmp/dockerinit ]; then
    ./scripts/init.docker.sh
    touch ./.tmp/dockerinit
fi

docker rm -f $(docker ps -f "status=exited" -q) >/dev/null 2>&1;
docker-compose up -d --remove-orphans

if [ ! -f ./.tmp/composerinit ]; then
    docker-compose run php-composer install
    touch ./.tmp/composerinit
fi

mustcount="6";
count="$(docker ps | wc -l)";
count=$((count-1));
if [ $count = $mustcount ]; then
    echo "Congratulation! All $count containers are running!";
else
    red=`tput setaf 1`;
    echo "${red}$count from $mustcount containers are running. Use 'docker ps' for more details.";
fi

exit 0
