# Laravel Task

## Laravel Version
This repository contains Laravel `8.x`

## Dependencies, requirements and build tools
This project comes with `docker` & `docker-compose`. But to minimize the boot up time when you try `docker-compose up -d --build` the local files are mounted to application.
Thus, it's recommended to use PHP & composer locally. Resolve your project dependency before you run your application using `composer install`.

This project contains,
- `nginx` for web server.
- `postgres` for database.

## How to use?
- Clone the repository.
- `cp docker-compose.yml.example docker-compose.yml`.
- Make the required changes to your `docker-compose.yml`.
- `cp .env.example .env`.
- Make the required changes to your `.env`.
- `docker-compose up -d --build` to build your containers.
- After build `exec`-ing to php container by running cmd `docker-compose exec php bash`
- And inside container run the following cmd - 
  - `composer install`
  - `php artisan key:generate`
  - `php artisan migrate`
- If you don't change anything in your `docker-compose.yml` for postgres, then don't need to change anything in your env for database connection.
- For working `queue` run `php artisan queue:work` inside container
- Loading `http://127.0.0.1:{NGINX_PORT}` in your browser. Here I have used `8001` port. If you don't change port in `docker-compose.yml` file make sure `8001` port is free.
- Browse `http://127.0.0.1:{NGINX_PORT}/pockets` to get all pocket data.
- For api testing, pass `Accept: application/json` in header.

## Postman collection link
https://www.getpostman.com/collections/2f3c7585f90740117ea8

## Troubleshooting
- If you fetch any error during docker up like `ERROR [internal] load metadata for docker.io/library/php:7.4-fpm` then open terminal and run `docker login`
