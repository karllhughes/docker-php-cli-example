#!/usr/bin/env bash

## Pull the latest code
git pull origin master

## Rebuild the containers
docker-compose up -d --build

## Run migrations
docker exec dockerphpcliexample_app_1 php artisan migrate --force
