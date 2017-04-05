#!/usr/bin/env bash

## Create the database
bash docker/db-create.sh

## Run migrations
php artisan migrate

## Run the test suite
vendor/bin/phpunit
