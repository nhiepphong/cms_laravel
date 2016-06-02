# NhiepPhong/Backend is CMS for Laravel PHP Framework

[![Build Status](https://travis-ci.org/nhiepphong/cms_laravel.svg?branch=master)](https://travis-ci.org/nhiepphong/cms_laravel)
[![Latest Stable Version](https://poser.pugx.org/nhiepphong/backend/v/stable)](https://packagist.org/packages/nhiepphong/backend)
[![Total Downloads](https://poser.pugx.org/nhiepphong/backend/downloads)](https://packagist.org/packages/nhiepphong/backend)
[![Latest Unstable Version](https://poser.pugx.org/nhiepphong/backend/v/unstable)](https://packagist.org/packages/nhiepphong/backend)
[![License](https://poser.pugx.org/nhiepphong/backend/license)](https://packagist.org/packages/nhiepphong/backend)

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