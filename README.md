## create env file

cp .env.local .env

## create app key

php artisan key:generate

## create database

php artisan migrate

## seed database

php artisan db:seed

## serve app

php artisan serve
