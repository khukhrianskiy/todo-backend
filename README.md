## Installation

### Docker

Run a local container using

`$ docker-compose up --build -d`

### Laravel

Create `.env` file, based on `.env.example`

Open console

`$ docker-compose exec app bash`

Install dependencies

`$ composer install`

Generate application key

`$ php artisan key:generate`

Regenerate cache

`$ php artisan config:cache`
