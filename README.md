# Todo-System

``` bash
$ composer install
$ yarn
$ cp .env.example .env
$ php artisan key:generate
$ php artisan jwt:secret
$ php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```

> Connect to Database, and seeding data to create super user.

```bash
$ php artisan migrate
$ php artisan db:seed
```

> It's Done, visit [http://localhost:8000](http://localhost:8000).