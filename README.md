# TV API

JSON API that allows the consumer to search for TV shows by their name.

## Technologies used:
- Laravel 9
- PHP 8.1

## Environment requisites:
- docker 20.10.14
- docker-compose 1.25.0
- make 4.3 (optional, but recommended)

## First setup:
All the commands in this guide are meant to be run in project's root directory.

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
