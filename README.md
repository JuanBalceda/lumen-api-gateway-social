# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Getting started

This api gateway allows you to login with facebook and google

This project uses [lumen-password](https://github.com/dusterio/lumen-passport "Lumen Password repository")

1. Rename the [.env.example](.env.example) file to **.env** and setup databse, facebook app and google configuration.
2. Add an APP_KEY to your **.env** file
3. Copy your Google **client_secret.json** to the project base directory.
4. Install all dependencies, run:
```shell script
composer install
```
3. Setup your database:
```shell script
# Create new tables users and Passport
php artisan migrate

# Install encryption keys and other necessary stuff for Passport
php artisan passport:install
```
4. Test your app:
```shell script
php -S localhost:8002 -t public/
```
