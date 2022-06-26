# TV API

JSON API that allows the consumer to search for TV shows by their name.

## Technologies used:
- Laravel 9
- PHP 8.1
- Redis

## Environment requisites:
- docker 20.10.14
- docker-compose 1.25.0
- make 4.3 (optional, but recommended)

## First setup:
All the commands in this guide are meant to be run in project's root directory.
Commands are only compatible with Linux/macOS systems (I'm using Ubuntu 21.04).

### Copy ``.env.example`` file into ``.env``:
``$ cp .env.example .env``

### Run ``composer install`` from container:
``$ docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php81-composer:latest composer install --ignore-platform-reqs``

## Start containers:
``$ make sail up``\
or\
``$ ./vendor/bin/sail up``

## Testing

``$ make test`` \
or\
``$ docker exec -e APP_ENV tv_app php artisan test --stop-on-failure`` 

## Calling the API

The only valid endpoint is:

    GET http://localhost:8000/?q=SHOW_NAME

Where 'q' is the required parameter that contains the name of the show you want to search.\
Any other request to the API is invalid.
