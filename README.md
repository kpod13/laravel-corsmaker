# CORSmaker middleware for Laravel 5
See also 
* [barryvdh/laravel-cors](https://github.com/barryvdh/laravel-cors),
* [CORS](https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS)

## About

## Features
* Adds CORS headers to responses
* Supports multirule configuration

## Installation
### Install package
```bash
composer require kpod13/laravel-corsmaker
```
### Add ServiceProvider into app
Add `Kpod13\CorsMaker\ServiceProvider::class` into `providers` in `config/app.php`.
Clear cache `php artisan config:cache`

### Setup middleware as global
```php
protected $middleware = [
    CorsMakerHandler::class
];
```

### Install default config
```bash
php artisan vendor:publish --provider="Kpod13\Corsmaker\ServiceProvider"
```

## Configuration
See example in `config/corsmaker.php`

## Testing

### Install dependencies
```bash
composer install --dev
```

### Run tests
```bash
./vendor/bin/phpunit
```

