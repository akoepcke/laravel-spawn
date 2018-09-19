# Generate CRUD+view files

This package provides some Laravel commands to help speed up Laravel development by generating several often needed files.
It complements my [Laravel-Skeleton](https://github.com/akoepcke/laravel-skeleton).

### Features

- create soft-deletable model with Uuid
- create ModelController and TrashedModelController
- create default feature tests for ModelController and TrashedModelController
- create and register ModelPolicy
- register Role and Permissions
- create _model/[create,edit,index].blade.php_
- create _trashedModel/index.blade.php_
- create and register DB migration, factory and seed files
- register routes and route model binding in _Routes/web.php_

The following features are planned for Someday<sup>TM</sup>
- register route model binding in RouteServiceProvider
- make uuid flaggable

## Installation

You can install the package via composer:

```bash
composer require "akoepcke/laravel-spawn"
```

## Usage

Run the following to publish the config file to _config/spawn.php_

```php artisan vendor:publish --provider="AKoepcke\LaravelSpawn\ServiceProvider" --tag="stubs""```

Run the following to publish the file stubs to _resources/stubs_

```php artisan vendor:publish --provider="AKoepcke\LaravelSpawn\ServiceProvider" --tag="config""```

This package provides the following commands:

- ```php artisan spawn:monster {model}``` will run through all of spawn's commands
- ```php artisan spawn:model {model}``` will create a _{Model}.php_
- ```php artisan spawn:controller {model}``` will create _{Model}Controller.php_ and _Trashed{Model}Controller.php_
- ```php artisan spawn:test {model}``` will create several feature tests for the controllers
- ```php artisan spawn:policy {model}``` will create _{Model}Policy.php_
- ```php artisan spawn:role {model}``` will create an administrative role with basic CRUD permissions
- ```php artisan spawn:view {model}``` will create _{Model}Policy.php_ and register it in AuthServiceProvider
- ```php artisan spawn:database {model}``` will create migration, factory and seed files, and register the seed in DatabaseSeeder
- ```php artisan spawn:route {model}``` will create CRUD routes and route model binding

**Attention**: Most commands will overwrite existing files. Some commands, like ```spawn:route```, will append to existing files.There are also commands, such as the registration of seeders, that will insert into existing files.

## Gotchas

- This package supplements my [Laravel-Skeleton](https://github.com/akoepcke/laravel-skeleton) which has already some stuff installed.
  Several spawn commands will fail without the proper setup.
- This package will register some routes in your _routes/web.php_.
  You might want to protect these routes by wrapping them into an auth-protected group.
  I also use this group to assign a route admin prefix.
  ```php
    Route::group(['prefix' => 'admin', 'middleware' => 'auth']), function() {
      // copy here
    }
  ```
- Some PHPUnit tests will fail if the spawned routes are not auth-middleware-checked.
- Also, I like to cut/paste the route model binding to the top of the routes file.
  Other people prefer to put it into _app/Providers/RouteServiceProvider.php_

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Anne Köpcke](https://github.com/akoepcke)
- This package is inspired by work shown in an article called [Laravel CRUD generator from Scratch](https://medium.com/@devlob/laravel-crud-generators-614caddf8bea)
- Shoutout also to [Sander van Hooft](https://github.com/sandervanhooft) for his _Laravel package development from scratch_ email course

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.