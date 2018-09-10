<?php

require dirname(dirname(dirname(__FILE__))).'/vendor/autoload.php';

require 'HomeController.php';

define('VIEW_BASE_PATH', __DIR__.'/');

$coverage = new \SebastianBergmann\CodeCoverage\CodeCoverage;

$coverage->filter()->addDirectoryToWhitelist(dirname(dirname(dirname(__FILE__))).'/src');

$coverage->start('ooxx');

// test 'foo' and '/foo'
if (@$_GET['slash']) {
  require 'routesWithFirstSlash.php';
} else {
  require 'routesWithOutFirstSlash.php';
}

if (getenv('APP_ENV') == 'testing') {
  register_shutdown_function('dispatch');
}

register_shutdown_function(function() use ($coverage) {
  $coverage->stop();

  $writer = new \SebastianBergmann\CodeCoverage\Report\Html\Facade;
  $writer->process($coverage, __DIR__.'/code-coverage-report');
});