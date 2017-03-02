#!/usr/bin/env bash
docker-compose run php-composer clear-cache
rm ./.tmp/composerinit

./stop.sh

docker rm -f $(docker ps -f "status=exited" -q) 2>/dev/null; docker rmi $(docker images -q -f dangling=true) 2>/dev/null; docker volume rm $(docker volume ls -q -f dangling=true | grep -v '\-data') 2>/dev/null;

exit 0