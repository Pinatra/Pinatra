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
function headMethod(...$params)
{
  Router::head(...$params);
}

function dispatch()
{
  try {
    $result = Router::dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], '\Pinatra\View\View@process');
    if ($result === false) {
      http_response_code(404);
      echo '404 Not Found';
    }
  } catch (Exception $e) {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->handleException($e);
  }
}

function view($name = null)
{
  return View::make($name);
}

register_shutdown_function('dispatch');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
