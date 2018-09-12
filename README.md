<p align="center">
    <a href="https://github.com/Pinatra/Pinatra"><img src="https://github.com/Pinatra/Pinatra/blob/master/assets/Pinatra.jpg"></a>
</p>

<p align="center">
  <a href="https://travis-ci.org/Pinatra/Pinatra"><img src="https://travis-ci.org/Pinatra/Pinatra.svg?branch=master"></a>
  <a href="https://packagist.org/packages/pinatra/framework"><img src="https://poser.pugx.org/pinatra/framework/license.svg" alt="License"></a>
</p>

<br>

Pinatra is a PHP micro framework inspired by [Sinatra](https://github.com/sinatra/sinatra): a DSL for quickly creating web applications in PHP with minimal effort.

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

## Documentation

### [read the documentation](https://pinatra.github.io/)
### [中文文档](https://pinatra.github.io/zh/)

## Developing Logs

* 2018-09-11 100% code-coverage done
* 2018-09-08 Eloquent model done
* 2018-09-06 new router is fine
* 2018-09-04 amazing new router is done
* 2018-09-04 view is done
* 2018-09-03 routing is done
* 2018-08-31 first composer package released

## License

The Pinatra framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
