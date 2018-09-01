<p align="center">
    <a href="https://github.com/Pinatra/framework"><img src="https://github.com/Pinatra/framework/blob/master/assets/Pinatra.jpg"></a>
</p>

<p align="center">
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

<br>

Pinatra is a PHP copy of [Sinatra](https://github.com/sinatra/sinatra): a DSL for quickly creating web applications in PHP with minimal effort.

> Pinatra is still under the initial development.

<br>

## Example

### install

```bash
composer require pinatra/framework=dev-master
```

### run your own application!

```php
require __DIR__.'/../vendor/autoload.php';

get('/', function() {
  echo "I am Pinatra framework!";
});
```

## Developing Logs

* 2018-08-31 first composer package released

## License

The Pinatra framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
