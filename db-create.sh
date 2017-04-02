#!/usr/bin/env bash
function test_database {
  mysqladmin -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" ping
}

## Ensure that the database is up and running
count=0
until ( test_database )
do
  ((count++))
  if [ ${count} -gt 100 ]
  then
    echo "Services didn't become ready in time"
    exit 1
  fi
  sleep 1
done

## Create the database table
mysql -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" -e 'CREATE DATABASE IF NOT EXISTS laravel'
