<?php

use Pinatra\Routing\Router;
use Pinatra\View\View;

function get(...$params)
{
  Router::get(...$params);
}
function post(...$params)
{
  Router::post(...$params);
}
function put(...$params)
{
  Router::put(...$params);
}
function patch(...$params)
{
  Router::patch(...$params);
}
function delete(...$params)
{
  Router::delete(...$params);
}
function options(...$params)
{
  Router::options(...$params);
}
function head(...$params)
{
  Router::head(...$params);
}

function dispatch()
{
  Router::dispatch('\Pinatra\View\View@process');
}

function view($name = null)
{
  try {
    return View::make($name);
  } catch (Exception $e) {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->handleException($e);
  }
}

if (getenv('APP_ENV') != 'testing') {
  register_shutdown_function('dispatch');
}

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();