# File authentication driver for Laravel

A File Authentication Driver for [Laravel](http://laravel.com).

[![Total Downloads](https://poser.pugx.org/lucor/laravel-auth-file-driver/downloads.png)](https://packagist.org/packages/lucor/laravel-auth-file-driver)
[![Latest Stable Version](https://poser.pugx.org/lucor/laravel-auth-file-driver/v/stable.png)](https://packagist.org/packages/lucor/laravel-auth-file-driver)
[![Build Status](https://travis-ci.org/lucor/laravel-auth-file-driver.png)](https://travis-ci.org/lucor/laravel-auth-file-driver)

## Installation

### Composer

As usual, install this package through Composer.

```js
"require": {
    "lucor/laravel-auth-file-driver": "0.9.*"
}
```

### Service Provider configuration
Add the service provider in `app/config/app.php` in the `providers` section:

```php
'providers' => array(
	...
    'Lucor\Auth\AuthServiceProvider',
)
```

### Driver configuration

Change the default driver in `app/config/auth.php`:

```php
'driver' => 'file',
```

### Users configuration
Execute the config publish command:

`php artisan config:publish lucor/laravel-auth-file-driver`.

this will add the users configuration file in `app/config/packages/lucor/auth/users.php`.

## Copyright and License
This package is released under the MIT License. See the LICENSE file for details.
