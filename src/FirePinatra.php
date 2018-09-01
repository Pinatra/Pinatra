<?php

use Pinatra\Routing\Router;

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
  Router::dispatch();
}

register_shutdown_function('dispatch');
