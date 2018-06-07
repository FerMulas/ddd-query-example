#!/bin/bash

DOCKER_BUILD=0

while test $# -gt 0; do
    case "$1" in
        --rebuild)
            DOCKER_BUILD=1
            shift
            ;;
        *)
            shift
            ;;
    esac
done

docker build -t docker_php -f docker/php/Dockerfile .

if [ $DOCKER_BUILD = 1 ]
then
    echo "Rebuild images."
    docker-compose build
fi

docker-compose up -d
docker exec -ti -u $UID:$UID spotahome-exercise-php bash -c  "cd /var/www/html/spotahome-exercise; php ./composer.phar update"