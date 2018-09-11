<?php

require dirname(dirname(dirname(__FILE__))).'/vendor/autoload.php';

require 'HomeController.php';
require 'User.php';
require 'DatabaseConfig.php';

define('VIEW_BASE_PATH_PREPARE', __DIR__.'/');


if (getenv('APP_MACHINE') == 'MAC') {
  $coverage = new \SebastianBergmann\CodeCoverage\CodeCoverage;
  $coverage->filter()->addDirectoryToWhitelist(dirname(dirname(dirname(__FILE__))).'/src');
  $coverage->start('PinatraTesting');
}

// test 'foo' and '/foo'
if (@$_GET['slash']) {
  require 'routesWithFirstSlash.php';
} else {
  require 'routesWithOutFirstSlash.php';
}

require 'whatNeedsToDoToIncreasingCodeCoverage.php';

get('model', function() {
  print_r(User::all());
});

if (getenv('APP_MACHINE') == 'MAC') {
  register_shutdown_function(function() use ($coverage) {
    $coverage->stop();

    $writer = new \SebastianBergmann\CodeCoverage\Report\Html\Facade;
    $writer->process($coverage, __DIR__.'/code-coverage-report');
  });
}