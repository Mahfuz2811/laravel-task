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
- Run `php artisan key:generate` to generate application key.
- Loading `http://127.0.0.1:{NGINX_PORT}` in your browser.
- If you don't have `composer` locally, then `exec`-ing to php container after containers are up and install the dependencies will work. Just restart the containers.
