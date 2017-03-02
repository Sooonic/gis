#!/usr/bin/env bash

docker_exists=`apt-cache search --names-only docker.io`
docker_compose_exists=`apt-cache search --names-only docker-compose`

sudo apt-get update

if [ -n "docker_exists" ]
    then
    echo " docker exists"
    else
        sudo apt-get install -y apt-transport-https ca-certificates
        sudo apt-key adv --keyserver hkp://ha.pool.sks-keyservers.net:80 --recv-keys 58118E89F3A912897C070ADBF76221572C52609D
        # Ubuntu 16
        echo "deb https://apt.dockerproject.org/repo ubuntu-xenial main" | sudo tee /etc/apt/sources.list.d/docker.list
        # Ubuntu 15
        #echo "deb https://apt.dockerproject.org/repo ubuntu-wily main" | sudo tee /etc/apt/sources.list.d/docker.list
        # Ubuntu 14
        #echo "deb https://apt.dockerproject.org/repo ubuntu-trusty main" | sudo tee /etc/apt/sources.list.d/docker.list
        sudo apt-get update
        sudo apt-get install -y docker-engine
        sudo groupadd docker
        sudo gpasswd -a ${USER} docker
fi

if [ -n "docker_compose_exists" ]
    then
    echo " docker-compose exists"
    else
        curl -L https://github.com/docker/compose/releases/download/1.8.0/docker-compose-`uname -s`-`uname -m` >~/docker-compose
        chmod +x ~/docker-compose
        sudo mv ~/docker-compose /usr/bin/docker-compose
fi

exit 0






