# NhiepPhong/Backend is CMS for Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

### Requirements

- PHP 5.5
- Laravel 5.2

### Installation

**Composer**

Run the following to include this via Composer

```shell
composer require nhiepphong/backend
```

#### Laravel 5.2 Configuration

To install into a Laravel project, first do the composer install then add *ONE *of the following classes to your config/app.php service providers list.

```php
// FOR LARAVEL 5.1 AND ABOVE
Nhiepphong\Backend\Providers\BackendServiceProvider::class,
```

Publish the storage configuration file.

```php 
php artisan vendor:publish --provider="Nhiepphong\Backend\Providers\BackendServiceProvider"
```
## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

composer require nhiepphong/backend