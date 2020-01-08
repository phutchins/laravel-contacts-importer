## A realtime contact viewer and importer app built with Laravel, Vue.js, Vuex, and Redis Queues.

A realtime contact viewer and importer app built with Laravel, Vue.js, Vuex, and Redis Queues

## Getting Started
Make sure you have `npm`, `docker` and `composer` on your local machine

1.  Clone this repository and cd into it
2.  Run `composer install` and `npm install` to download laravel dependencies
3.  (optional) Run `php artisan key:generate` to generate a key for the app (or for testing use the one in .env.example)
5.  (optional) Set up your database in your `.env` (or use defaults in .env.example if using docker-compose)
6.  Execute `npm run dev` to build project assets
7.  Run `docker-compose up`
8.  Run `docker exec -it laravel-contacts-importer_app_1 php artisan migrate` to build your database with tables

### Prerequisites

* Laravel
* Vue
* Vuex
* npm
* Pusher account
* Docker
* Docker Compose

## Built With

* [Laravel](https://laravel.com/) - Beautiful Php framework
* [Vue](https://vuejs.org/) - A Great reactive Js framework
* [Vuex](https://vuejs.org/) - Vuejs state management made simple
* [Bootstrap](https://getbootstrap.com) - A beautiful Css framework
* [Axios](https://vuejs.org/) - A Js library to handle ajax requests easily
