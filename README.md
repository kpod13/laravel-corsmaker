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

### Install default config
```bash
php artisan vendor:publish --provider="Kpod13\Corsmaker\ServiceProvider"
```

## Configuration
See example of `corsmaker.php`
```php
<?php

return [
  'rules' => [
    [
      'requestHeaders' => [
        'origin' => '/https?:\/\/([^\/]+\.)?(hostname\.(com|edu|ru))(:[0-9]{2,5})?$/i',
        'methods' => ['GET', 'POST', 'PUT', 'DELETE'],
        'locations' => ['*'],
      ],
      'CORSHeaders' => [
        'credentials' => TRUE,
        'allowedHeaders' => [
          'Accept',
          'Accept-Encoding',
          'Accept-Language',
          'Authorization',
          'Cache-Control',
          'Connection',
          'DNT',
          'Keep-Alive',
          'If-Modified-Since',
          'Origin',
          'Save-Data',
          'User-Agent',
          'X-Requested-With',
          'Content-Type',
        ],
      ],
      'p3pHeaders' => [
        'CP=IDC',
        'DSP',
        'COR',
        'ADM',
        'DEVi',
        'TAIi',
        'PSA',
        'PSD',
        'IVAi',
        'IVDi',
        'CONi',
        'HIS',
        'OUR',
        'IND',
        'CNT',
      ],
    ],
    [
      'requestHeaders' => [
        'origin' => '*',
        'methods' => ['GET'],
        'locations' => [
          '/v1/account',
          '/v1/changes',
          '/v2/subscriptions',
        ],
      ],
      'CORSHeaders' => [
        'credentials' => TRUE,
        'allowedHeaders' => [
          'Accept',
          'Accept-Encoding',
          'Accept-Language',
          'Authorization',
          'Cache-Control',
          'Connection',
          'DNT',
          'Keep-Alive',
          'If-Modified-Since',
          'Origin',
          'Save-Data',
          'User-Agent',
          'X-Requested-With',
          'Content-Type',
        ],
      ],
      'p3pHeaders' => [
        'CP=IDC',
        'DSP',
        'COR',
        'ADM',
        'DEVi',
        'TAIi',
        'PSA',
        'PSD',
        'IVAi',
        'IVDi',
        'CONi',
        'HIS',
        'OUR',
        'IND',
        'CNT',
      ],
    ],
    [
      'requestHeaders' => [
        'origin' => ['*'],
        'methods' => ['POST'],
        'locations' => [
          '/v1/login/auth',
          '/v1/products/trial',
          '/v2/products/licenses',
        ],
      ],
      'CORSHeaders' => [
        'credentials' => TRUE,
        'allowedHeaders' => [
          'Accept',
          'Accept-Encoding',
          'Accept-Language',
          'Authorization',
          'Cache-Control',
          'Connection',
          'DNT',
          'Keep-Alive',
          'If-Modified-Since',
          'Origin',
          'Save-Data',
          'User-Agent',
          'X-Requested-With',
          'Content-Type',
        ],
      ],
      'p3pHeaders' => [
        'CP=IDC',
        'DSP',
        'COR',
        'ADM',
        'DEVi',
        'TAIi',
        'PSA',
        'PSD',
        'IVAi',
        'IVDi',
        'CONi',
        'HIS',
        'OUR',
        'IND',
        'CNT',
      ],
    ],
    [
      'requestHeaders' => [
        'origin' => ['*'],
        'methods' => ['PUT'],
        'locations' => ['*'],
      ],
      'CORSHeaders' => [
        'credentials' => TRUE,
        'allowedHeaders' => [
          'Accept',
          'Accept-Encoding',
          'Accept-Language',
          'Authorization',
          'Cache-Control',
          'Connection',
          'DNT',
          'Keep-Alive',
          'If-Modified-Since',
          'Origin',
          'Save-Data',
          'User-Agent',
          'X-Requested-With',
          'Content-Type',
        ],
      ],
      'p3pHeaders' => [
        'CP=IDC',
        'DSP',
        'COR',
        'ADM',
        'DEVi',
        'TAIi',
        'PSA',
        'PSD',
        'IVAi',
        'IVDi',
        'CONi',
        'HIS',
        'OUR',
        'IND',
        'CNT',
      ],
    ],
  ],
];
```

## Testing

### Install dependencies
```bash
composer install --dev
```

### Run tests
```bash
./vendor/bin/phpunit
```

