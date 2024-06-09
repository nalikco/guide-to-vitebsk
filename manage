#!/bin/bash

CONTAINER_NAME="guide-to-vitebsk-php"

if [ $# -eq 0 ]; then
    echo "Usage: manage <artisan|composer> [arguments]"
    exit 1
fi

COMMAND=$1
shift
ARGS="$@"

case $COMMAND in
    artisan)
        docker exec -it $CONTAINER_NAME php artisan $ARGS
        ;;
    composer)
        docker exec -it $CONTAINER_NAME composer $ARGS
        ;;
    *)
        echo "Unknown command: $COMMAND"
        echo "Usage: manage <artisan|composer> [arguments]"
        exit 1
        ;;
esac
