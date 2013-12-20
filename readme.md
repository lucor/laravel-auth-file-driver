# File authentication driver for Laravel

A File Authentication Driver for [Laravel](http://laravel.com).

## Installation

### Composer

As usual, install this package through Composer.

```js
"require": {
    "lucor/laravel-file-auth-driver": "dev-master"
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
