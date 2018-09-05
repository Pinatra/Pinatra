<?php

require dirname(dirname(dirname(__FILE__))).'/vendor/autoload.php';

require 'HomeController.php';

define('VIEW_BASE_PATH', __DIR__.'/');

// test 'foo' and '/foo'
if (@$_GET['slash']) {
  require 'routesWithFirstSlash.php';
} else {
  require 'routesWithOutFirstSlash.php';
}

if (getenv('APP_ENV') == 'testing') {
  register_shutdown_function('dispatch');
}
